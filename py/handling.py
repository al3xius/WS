#Main program
import comdb
import status
import threading
import bt
import sensor

def new_sample ():
	'''
	Updates database to current sensor values.
	'''

	temp1 = sensor.get_temp()
	humi1 = sensor.get_humi()
	comdb.insert_temp(1, temp1)
	comdb.insert_humi(1, humi1)
	bt.data() #new data from arduino

	#sleep for set amount of time
	sample_rate = comdb.get_setting("sample_rate")
	threading.Timer(int(sample_rate), new_sample).start()

new_sample()
