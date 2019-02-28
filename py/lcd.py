import RPi.GPIO as GPIO
import lcddriver
import comdb
import status
from time import sleep
from time import *
GPIO.setmode(GPIO.BCM)

#Button
GPIO.setup(4, GPIO.IN, pull_up_down=GPIO.PUD_UP)

#LCD
lcd = lcddriver.lcd()
lcd.lcd_clear()
comdb.start_con()

def disp_settings(channel):
    '''
    When GPIO pin 4 is pulled to GND,
    displays network status.
    '''

    status.network_status() #Uptate network status
    cycle_rate = float(comdb.get_setting("lcd_cycle_rate"))
    #get current values
    ssid = str(comdb.get_setting("ssid"))
    ip_addr = str(comdb.get_setting("ip_addr"))

    if len(ip_addr) < 14 and len(ssid) < 11:
        lcd.lcd_clear()
        lcd.lcd_display_string("SSID:" + ssid,1)
        lcd.lcd_display_string("IP:" + ip_addr,2)
        sleep(cycle_rate)
        break
    #cycle through ip addres if longer than display
    if len(ip_addr) > 13:
        for i in range(len_ip-12):
            lcd.lcd_clear()
            lcd.lcd_display_string("SSID:" + ssid,1)
            lcd.lcd_display_string("IP:" + ip_addr[i:len_ip],2)
            sleep(cycle_rate/(len_ip-12))
            break

def output():
    '''
    Displays current sensor values on LCD display
    '''

    while True:
        cycle_rate = float(comdb.get_setting("lcd_cycle_rate"))

        #Inside Values
        temp1 = comdb.get_temp(1)
        humi1 = comdb.get_humi(1)
        pres1 = comdb.get_pres(1)
        lcd.lcd_clear()
        lcd.lcd_display_string("I: Temp. :" + str(temp1) + "C",1)
        lcd.lcd_display_string("   Luftf.:" + str(humi1) + "%",2)
        sleep(cycle_rate)

        #outside values
        temp2 = comdb.get_temp(2)
        humi2 = comdb.get_humi(2)
        lcd.lcd_clear()
        lcd.lcd_display_string("A: Temp. :" + str(temp2) + "C",1)
        lcd.lcd_display_string("   Luftf.:" + str(humi2) + "%",2)
        sleep(cycle_rate)


GPIO.add_event_detect(4, GPIO.FALLING, callback=disp_settings, bouncetime=100)

output()
