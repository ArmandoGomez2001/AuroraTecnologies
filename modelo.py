import pandas as pd
import numpy as np
from sklearn.linear_model import LinearRegression
from sklearn.model_selection import train_test_split
from sklearn.metrics import mean_absolute_error
import mysql.connector

# Sample data
data = {
    'timestamp': ['1/1/2023 0:00', '1/1/2023 1:00', '1/1/2023 2:00', '1/1/2023 3:00', '1/1/2023 4:00', '1/1/2023 5:00'],
    'energy_consumption': [180, 200, 210, 190, 205, 220]
}

# Create a DataFrame
df = pd.DataFrame(data)

# Convert 'timestamp' to datetime format
df['timestamp'] = pd.to_datetime(df['timestamp'], format="%m/%d/%Y %H:%M")

# Set 'timestamp' as the index
df.set_index('timestamp', inplace=True)

# Extract hour of the day as a feature
df['hour'] = df.index.hour

# Assuming you have an 'energy_consumption' column
y = df['energy_consumption']  # Target variable

# Features (excluding the target variable)
X = df.drop(columns=['energy_consumption'])

# Split the data into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Train a linear regression model
model = LinearRegression()
model.fit(X_train, y_train)

# Extract hour of the day for the testing set
X_test['hour'] = X_test.index.hour

# Make predictions on the testing set
predictions = model.predict(X_test)

# Evaluate model performance using MAE
mae = mean_absolute_error(y_test, predictions)

print(f'Mean Absolute Error: {mae:.2f}')

# Now, let's make predictions for a new month (e.g., February 2023)
# Create new timestamps for February
new_timestamps = pd.date_range(start='1/1/2023 0:00', end='30/12/2023 23:00', freq='H')

# Extract hour of the day as a feature for the new timestamps
new_data = pd.DataFrame({'timestamp': new_timestamps})
new_data['hour'] = new_data['timestamp'].dt.hour

# Make predictions for the new month
new_predictions = model.predict(new_data[['hour']])

# Create a DataFrame to display the results
result_df = pd.DataFrame({'timestamp': new_timestamps, 'hour': new_data['hour'], 'predicted_energy_consumption': new_predictions})

# Save the results to MySQL
# Assuming you have a MySQL server running locally on the default port with a database 'your_database'
# Replace 'your_username' and 'your_password' with your MySQL username and password

conn = mysql.connector.connect(
    host="127.0.0.1",
    user="root",
    password="",
    database="crud_roles_stisla"
)

# Create a cursor
cursor = conn.cursor()

# Create a table (if not exists) with DATE type for the timestamp and FLOAT type for the predicted_energy_consumption
table_creation_query = """
CREATE TABLE IF NOT EXISTS predicted_energy_consumption (
    timestamp DATETIME,
    hour INT,
    predicted_energy_consumption FLOAT
)
"""
cursor.execute(table_creation_query)

# Insert data into the table with the date and hour
for index, row in result_df.iterrows():
    insert_query = "INSERT INTO predicted_energy_consumption (timestamp, hour, predicted_energy_consumption) VALUES (%s, %s, %s)"
    cursor.execute(insert_query, (str(row['timestamp']), row['hour'], row['predicted_energy_consumption']))

# Commit the changes and close the connection
conn.commit()
conn.close()
