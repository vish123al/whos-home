import bluetooth
import MySQLdb
import bluesniff.py
import os

#first = 1
#NewList = []
#NewListCat = []
#OldList = []

def __init__(self):
#dbconfig should have the DBuser,DBPword,DBName,DBHost
#in that order each as its own line
    config = open(dbconfig)
    self.DBUser = config.readline()
    self.DBPword = config.readline()
    self.DBName = config.readline()
    self.host = config.readline()
    self.bluesniff = bluesniff.bluesniff(self.DBUser,self.DBPword,self.DBName,self.host)
def main():
    __init__()
    while True:              #Loops code infinitely.
        nearby_devices = []
        nearby_devices = bluetooth.discover_devices(lookup_names = True)
    # Defines lists for each iteration.
#    OldList = NewListCat
#    NewListCat = []
#    NewList = []
    # Begins first iteration.
#    if first == 1:
# possiblity of simplifying conditionals
# creating method.
#      if len(nearby_devices) == 1:
#            print "Found %d device." % len(nearby_devices)
#        else:
#            print "Found %d devices." % len(nearby_devices)
        # Creates lists of devices
#        self.bluesniff.create_lists()
# look into using try/except block
        # Tests that the lists are correct
        #from Test_Bluetooth import test_lists
# Writes number of devices and mac addresses to a file Bluetoothdata.txt
#        self.bluesniff.write_to_db(nearby_devices)
        # look into ways of counters for recursion counter = counter +
#        first = 2
        # testing
        #from Test_Bluetooth import test_first
        self.bluesniff.write_to_db(nearby_devices)
#If one or more devices is connected:
#    Writes NewList to OldList
#    Compares NewList and OldList
#    elif len(nearby_devices) == 0:
#	create_lists()
#    else:
        # Creates lists of devices
#        create_lists()
#        if len(nearby_devices) == 1:
#            print "Found %d device." % len(nearby_devices)
#        else:
#            print "Found %d devices." % len(nearby_devices)
        # Tests Lists
#        from Test_Bluetooth import test_lists
if __name__ == "__main__":
    main()
