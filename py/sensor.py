import smbus
import time
import comdb

# Get I2C bus
bus = smbus.SMBus(1)
address = 0x27  #sensor address

def get_temp():
    '''
    Returns current temp value of I2C sensor
    '''

    data = bus.read_i2c_block_data(address, 0x00, 4)
    time.sleep(0.1)
    data = bus.read_i2c_block_data(address, 0x00, 4)
    temp = (((data[2] & 0xFF) * 256) + (data[3] & 0xFC)) / 4
    cTemp = (temp / 16384.0) * 165.0 - 40.0
    return cTemp

def get_humi():
    '''
    Returns current humidity value of I2C sensor
    '''

    data = bus.read_i2c_block_data(address, 0x00, 4)
    time.sleep(0.1)
    data = bus.read_i2c_block_data(address, 0x00, 4)
    humidity = ((((data[0] & 0x3F) * 256) + data[1]) * 100.0) / 16383.0
    return humidity
