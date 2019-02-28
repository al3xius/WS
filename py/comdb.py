#Import Librarys
import time
import mysql.connector
from datetime import date, datetime, timedelta
from mysql.connector import (connection)
#MYSQL connection
cnx = mysql.connector.connect(user='root', password='raspberry',
host='localhost',
database='weather_station')
cursor = cnx.cursor()
cnx = mysql.connector.connect(user='root', password='raspberry',
host='localhost',
database='weather_station')
cursor = cnx.cursor()

#Start Connection
def start_con():
	#Import Librarys
	import mysql.connector
	from datetime import date, datetime, timedelta
	from mysql.connector import (connection)
	#MYSQL connection
	cnx = mysql.connector.connect(user='root', password='raspberry',
	host='localhost',
	database='weather_station')
	cursor = cnx.cursor()
	cnx = mysql.connector.connect(user='root', password='raspberry',
	host='localhost',
	database='weather_station')
	cursor = cnx.cursor()
	return;

#End Connection
def end_con():
	cursor.close()
	cnx.close()
	return;
#Change Settings
def update_setting (name , value):
	start_con()
	change_setting = ("Update settings "
	"set value = %(value)s "
	"Where name = %(name)s")
	data_setting = {
	'name': name,
	'value': value,}
	cursor.execute(change_setting, data_setting)
	cnx.commit()
	return

#Insert Temperatur
def insert_temp (sensor_id, value):
	start_con()
	add_temp = ("Insert Into temp "
	"(sensor_id, time, value) "
	"VALUES (%(sensor_id)s, CURTIME(), %(value)s)")
	data_temp = {
	'sensor_id': sensor_id,
	'value': value,}
	cursor.execute(add_temp, data_temp)
	cnx.commit()
	return

#Insert Air Pressure
def insert_pres (sensor_id, value):
  start_con()
  add_pres = ("Insert Into pres "
  "(sensor_id, time, value) "
  "VALUES (%(sensor_id)s, CURTIME(), %(value)s)")
  data_pres = {
  'sensor_id': sensor_id,
  'value': value,}
  cursor.execute(add_pres, data_pres)
  cnx.commit()
  return;

#Insert Humiddity
def insert_humi (sensor_id, value):
  start_con()
  add_humi = ("Insert Into humi "
  "(sensor_id, time, value) "
  "VALUES (%(sensor_id)s, CURTIME(), %(value)s)")
  data_humi = {
  'sensor_id': sensor_id,
  'value': value,}
  cursor.execute(add_humi, data_humi)
  cnx.commit()
  return

#Read Last Temp Value
def get_temp (sensor_id):
	read_temp = ("SELECT value FROM `temp` WHERE sensor_id = %(sensor_id)s AND time = (SELECT MAX(time)" 
	"from temp where sensor_id = %(sensor_id)s)")
	data_temp = {
	'sensor_id': sensor_id}
	cursor.execute(read_temp, data_temp)
	data = cursor.fetchall()
	cnx.commit()
	for row in data:
		value = row[0]
  	return value

#Read Last Temp Value
def get_pres (sensor_id):
	read_temp = ("SELECT value FROM `pres` WHERE sensor_id = %(sensor_id)s AND time = (SELECT MAX(time)" 
	"from pres where sensor_id = %(sensor_id)s)")
	data_temp = {
	'sensor_id': sensor_id}
	cursor.execute(read_temp, data_temp)
	data = cursor.fetchall()
	cnx.commit()
	for row in data:
		value = row[0]
  	return value

#Read Last Temp Value
def get_humi (sensor_id):
	read_temp = ("SELECT value FROM `humi` WHERE sensor_id = %(sensor_id)s AND time = (SELECT MAX(time)" 
	"from humi where sensor_id = %(sensor_id)s)")
	data_temp = {
	'sensor_id': sensor_id}
	cursor.execute(read_temp, data_temp)
	data = cursor.fetchall()
	cnx.commit()
	for row in data:
		value = row[0]
  	return value

#Read Setting Value
def get_setting (name):
	read_setting = ("SELECT value FROM `settings` " 
	"Where name = %(name)s")
	data_setting = {
	'name': name}
	cursor.execute(read_setting, data_setting)
	data = cursor.fetchall()
	cnx.commit()
	for row in data:
		value = row[0]
  	return value
