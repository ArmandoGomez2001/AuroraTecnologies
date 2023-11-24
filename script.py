import pandas as pd
import numpy as np
from datetime import datetime, timedelta
from sklearn.linear_model import LinearRegression
import mysql.connector

# Definir el rango de fechas
start_date = datetime(2023, 1, 1)
end_date = datetime(2023, 1, 10)
date_range = [start_date + timedelta(days=x) for x in range((end_date-start_date).days + 1)]

# Crear el DataFrame
data = {'ID': range(1, len(date_range)+1),
        'DATE-TIME': date_range,
        'Cocina': np.random.uniform(4, 7, len(date_range)),
        'sala': np.random.uniform(4, 7, len(date_range)),
        'comedor': np.random.uniform(4, 7, len(date_range)),
        'patio': np.random.uniform(4, 7, len(date_range)),
        'patio trasero': np.random.uniform(4, 7, len(date_range)),
        'cuarto': np.random.uniform(4, 7, len(date_range)),
        'baño': np.random.uniform(4, 7, len(date_range)),
        'garage': np.random.uniform(4, 7, len(date_range))}

df = pd.DataFrame(data)

# Redondear los valores a dos decimales
df = df.round(2)

# Conectar a la base de datos MySQL
conn = mysql.connector.connect(
    host="127.0.0.1",
    user="root",
    password="",
    database="crud_roles_stisla"
)

# Crear un cursor
cursor = conn.cursor()

cursor.execute("""
    CREATE TABLE IF NOT EXISTS consumo_ubicacion (
        ID INT PRIMARY KEY,
        DATE_TIME DATETIME,
        Cocina FLOAT,
        sala FLOAT,
        comedor FLOAT,
        patio FLOAT,
        patio_trasero FLOAT,
        cuarto FLOAT,
        baño FLOAT,
        garage FLOAT
    )
""")

conn.commit()

# Iterate through columns and fit a linear regression model for each
for column in df.columns[2:]:  # Skip 'ID' and 'DATE-TIME'
    model = LinearRegression()
    model.fit(df[['ID']], df[column])

    # Generate predictions for the given IDs
    df[f'{column}_Prediction'] = model.predict(df[['ID']])

# Insert predicted values into the database
for index, row in df.iterrows():
    cursor.execute("""
        INSERT INTO consumo_ubicacion (ID, DATE_TIME, Cocina, sala, comedor, patio, patio_trasero, cuarto, baño, garage)
        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
    """, (row['ID'], row['DATE-TIME'], row['Cocina_Prediction'], row['sala_Prediction'], row['comedor_Prediction'], row['patio_Prediction'], row['patio trasero_Prediction'], row['cuarto_Prediction'], row['baño_Prediction'], row['garage_Prediction']))

# Hacer commit para guardar los cambios
conn.commit()

# Cerrar el cursor y la conexión
cursor.close()
conn.close()
