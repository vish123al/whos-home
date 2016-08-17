import bluetooth
import MySQLdb

first = 1
NewList = []
NewListCat = []
OldList = []

# writes data to a file
def write_to_file ():
    filewrite = open("BluetoothData.txt", "wr+")
    no = str(len(nearby_devices))
    filewrite.write(no + '\n' + '\n')
    for name, addr in nearby_devices:
        filewrite.write("%s - %s\n" % (addr, name))
    filewrite.close()
    return

# defines NewList and NewListCat as the names and addresses of devices
def create_lists():
    for name, addr in nearby_devices:

        NewList =  [addr, name]

        NewListCat = []
        # used for historical references
        NewListCat = NewListCat.append(NewList)

    return

def write_to_db():
    db = MySQLdb.connect("localhost", "SPAWARDemoPi", "SPAWARPi", "snifferdb")
    cursor = db.cursor()
    sql = "SELECT * FROM ActiveBlueTooth"
    for name, addr in nearby_devices:
        
	print "%s, %s" % (name, addr)
        sql = """REPLACE INTO ActiveBlueTooth (TIMESTAMP, MAC, DeviceName, SensorID)
            VALUES (CURRENT_TIMESTAMP, '%s', '%s', '%s')""" % (name, addr, 'SPAWARPi')
        try:
            cursor.execute(sql)
            db.commit()
        except IOError as error: 
            print error
            pass
    db.close()
        

while True:              #Loops code infinitely.

    nearby_devices = bluetooth.discover_devices(lookup_names = True)

    # Defines lists for each iteration.
    OldList = NewListCat

    NewListCat = []
    NewList = []

    # Begins first iteration.
    if first == 1:

# possiblity of simplifying conditionals
# creating method.
        if len(nearby_devices) == 1:

            print "Found %d device." % len(nearby_devices)

        else:

            print "Found %d devices." % len(nearby_devices)

        # Creates lists of devices
        create_lists()

# look into using try/except block
        # Tests that the lists are correct
        from Test_Bluetooth import test_lists

# Writes number of devices and mac addresses to a file Bluetoothdata.txt
        write_to_file()

        write_to_db()

        # look into ways of counters for recursion counter = counter +
        first = 2

        # testing
        from Test_Bluetooth import test_first

  
#If one or more devices is connected:
#    Writes NewList to OldList
#    Compares NewList and OldList

    elif len(nearby_devices) == 0:
	create_lists()
	write_to_file()

    else:

        # Creates lists of devices
        create_lists()

        if len(nearby_devices) == 1:

            print "Found %d device." % len(nearby_devices)

        else:

            print "Found %d devices." % len(nearby_devices)

        # Tests Lists
        from Test_Bluetooth import test_lists

# Writes data to file
        write_to_file()
        write_to_db()
