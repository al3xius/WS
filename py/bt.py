import bluetooth
import time
import comdb

def get_data():
	'''
	Requests data from Arduino
	'''
	try:
		bd_addr = "98:D3:32:31:33:29"	#Arduinoo Bluetooth-MAC
		port = 1
		sock = bluetooth.BluetoothSocket (bluetooth.RFCOMM)
		sock.connect((bd_addr,port))
		sock.send("t") #request data
		time.sleep(1.5)
		buffer = sock.recv(4096)	#recive data
		sock.close()
		return buffer
	except:
		print("No connection to Arduino!")
		return None

def data():
	'''
	Inserts recived data into database
	'''
	rawdata = get_data()
	if rawdata:	#data recived?
		data = rawdata.split('\r\n')	#process recived data
		# instert data into database
		comdb.insert_temp(2, data[0])
		comdb.insert_humi(2, data[1])
		comdb.insert_pres(1, data[2])
