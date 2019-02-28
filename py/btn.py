import RPi.GPIO as GPIO
import os
import comdb

btn_off_pin = int(comdb.get_setting("btn_off_pin"))
GPIO.setmode(GPIO.BCM)
GPIO.setup(btn_off_pin, GPIO.IN, pull_up_down=GPIO.PUD_UP)

try:
	GPIO.wait_for_edge(btn_off_pin, GPIO.FALLING)
	os.system("sudo shutdown now")
except:
	pass

GPIO.cleanup()
