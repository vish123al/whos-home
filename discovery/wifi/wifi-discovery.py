#! /usr/bin/env python

import nmap
import time
import sys
import os
import json
import socket
import requests
import itertools
from collections import OrderedDict

# Scan your local network for all hosts
def scan():

  hosts= str(get_lan_ip()) + "/24"
  nmap_args = "-sn" #simple host discovery without portscan

  scanner = nmap.PortScanner()
  scanner.scan(hosts=hosts, arguments=nmap_args)

  hostList = []

  for ip in scanner.all_hosts():

    host = {"ip" : ip}

    if "hostname" in scanner[ip]:
      host["hostname"] = scanner[ip]["hostname"]

    if "mac" in scanner[ip]["addresses"]:
      host["mac"] = scanner[ip]["addresses"]["mac"].upper()

    hostList.append(host)

  return hostList


# Get your local network IP address. e.g. 192.168.178.X
def get_lan_ip():

  try:
    return ([(s.connect(('8.8.8.8', 80)), s.getsockname()[0], s.close()) for s in [socket.socket(socket.AF_INET, socket.SOCK_DGRAM)]][0][1])
  except socket.error as e:
    sys.stderr.write(str(e) + "\n") # probably offline / no internet connection
    sys.exit(e.errno)


# Entry point
if __name__ == "__main__":


  while True:

# Find the number of devices and their MAC addresses, prining the data.
    scannedHosts = [host["mac"] for host in scan() if "mac" in host]

    print "scannedHosts"
    print len(scannedHosts)
    print scannedHosts

# Write number of hosts and their MAC addresses to a file ccalled WifiData.txt
    no = str(len(scannedHosts))
    filewrite = open("WifiData.txt", "wr+")

    filewrite.write(no + '\n' +"\n")
    for addr in scannedHosts:
      filewrite.write("%s\n" % addr)

    print "----------------------------------"

    # wait 30 seconds before trying again
    time.sleep(10)
