import pandas as pd
import numpy as np
from sklearn.linear_model import LinearRegression
import mysql.connector

# Sample data
data = {
    "ID": [1231, 1231, 1231, 1231, 1231, 1231, 1231],
    'timestamp': ['1/1/2022 0:00', '1/2/2022 0:00', '1/3/2022 0:00', '1/4/2022 0:00', '1/5/2022 0:00', '1/6/2022 0:00', '1/7/2022 0:00'],
    'energy_consumption': [0.270, 0.290, 0.288, 0.275, 0.287, 0.282, 0.288]
}

# Create a DataFrame
df = pd.DataFrame(data)

# Convert 'timestamp' to datetime format
df['timestamp'] = pd.to_datetime(df['timestamp'], format="%m/%d/%Y %H:%M")

# Set 'timestamp' as the index
df.set_index('timestamp', inplace=True)

# Extract day of the month as a feature
df['day'] = df.index.day

# Assuming you have an 'energy_consumption' column
y = df['energy_consumption']  # Target variable

# Features (excluding the target variable)
X = df.drop(columns=['energy_consumption'])

# Train a linear regression model
model = LinearRegression()
model.fit(X, y)

# Now, let's make predictions for a new month (e.g., February 2023)
# Create new timestamps for February
new_timestamps = pd.date_range(start='1/1/2023', end='11/28/2023', freq='D')  # Daily frequency

# Create a DataFrame for the new month with ID=1 for all rows and day as a feature
new_data = pd.DataFrame({'timestamp': new_timestamps})
new_data['ID'] = 1231  # Set ID as 1 for all rows
new_data['day'] = new_data['timestamp'].dt.day  # Extract day of the month

# Make predictions for the new month
new_predictions = model.predict(new_data[['ID', 'day']])  # Include 'ID' column in predictions

# Create a DataFrame to display the results
result_df = pd.DataFrame({'ID': 1231, 'timestamp': new_timestamps, 'predicted_energy_consumption': new_predictions})

# Save the results to MySQL
=======
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
    database="newproject"
)

# Create a cursor
cursor = conn.cursor()

# Insert data into the table
for index, row in result_df.iterrows():
    insert_query = "INSERT INTO reading (code_sensor, kw_per_day, date) VALUES (%s, %s, %s)"
    cursor.execute(insert_query, (row['ID'], row['predicted_energy_consumption'], row['timestamp']))

# Commit the changes and close the connection
conn.commit()
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
