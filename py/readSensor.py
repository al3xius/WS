#Import Librarys
import RPi.GPIO as GPIO
import time
import mysql.connector
from datetime import date, datetime, timedelta

#MYSQL connection
cnx = mysql.connector.connect(user='root', database='weather_station')

#GPIO Modus (BOARD / BCM)
GPIO.setmode(GPIO.BOARD)

#Sample Querrys
add_temp = ("Insert Into temp "
                "(sensor_id, time, value)"
                "VALUES (%(sensor_id)s, %(time)s, %(value)s)")
				
add_pres = ("Insert Into pres "
                "(sensor_id, time, value)"
                "VALUES (%(sensor_id)s, %(time)s, %(value)s)")
				
add_humi = ("Insert Into humi "
                "(sensor_id, time, value)"
                "VALUES (%(sensor_id)s, %(time)s, %(value)s)")
				
#Insert Temperatur
def insert_temp():

#current Time
ts = time.time()
st = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')

#if (newdata)
	date_temp = {
	  'sensor_id': 1,
	  'time': ts,
	  'value': 20,
	}
cursor.execute(add_temp, date_temp)
