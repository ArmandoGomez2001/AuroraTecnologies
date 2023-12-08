import mysql.connector
from datetime import datetime, timedelta
import random

# Conéctate a tu base de datos MySQL
connection = mysql.connector.connect(
    host="127.0.0.1",
    user="root",
    password="",
    database="newproject"
)

try:
    with connection.cursor() as cursor:
        # Itera para realizar 10 inserciones con code_sensor = 1231
        for _ in range(10):
            code_sensor = '1231'
            kw_per_day = round(random.uniform(0.4001, 0.999), 4)
            date = datetime.now() - timedelta(days=random.randint(1, 30))

            # Inserta el nuevo registro en la tabla
            sql = "INSERT INTO `reading` (`code_sensor`, `kw_per_day`, `date`) VALUES (%s, %s, %s)"
            cursor.execute(sql, (code_sensor, kw_per_day, date))

        # Hacer commit para guardar los cambios
        connection.commit()

finally:
    # Cierra la conexión, independientemente de si la inserción fue exitosa o no
    connection.close()
