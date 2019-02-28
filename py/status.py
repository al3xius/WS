import comdb
import socket
import os
from subprocess import check_output


#get hostname and ip_address
gw = os.popen("ip -4 route show default").read().split()
s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
s.connect((gw[2], 0))
ip_addr = s.getsockname()[0]
host = socket.gethostname()
#get ssid
scanoutput = check_output(["iwgetid", "-r"])
ssid = scanoutput
#update db
comdb.update_setting("ip_addr", ip_addr)
comdb.update_setting("hostname", host)
comdb.update_setting("ssid", ssid)


#get Network data
def network_status():
	'''
	Updates settings table to the current network network_status.
	IP address, hostname and WiFi SSID
	'''

	#get hostname and ip_address
	gw = os.popen("ip -4 route show default").read().split()
	s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
	s.connect((gw[2], 0))
	ip_addr = s.getsockname()[0]
	host = socket.gethostname()
	#get ssid
	scanoutput = check_output(["iwgetid", "-r"])
	ssid = scanoutput
	#update db
	comdb.update_setting("ip_addr", ip_addr)
	comdb.update_setting("hostname", host)
	comdb.update_setting("ssid", ssid)
	return
