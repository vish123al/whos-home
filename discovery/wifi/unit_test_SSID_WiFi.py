#python modules
import sys
import subprocess
import MySQLdb
import os
import unittest
import gc
#project code
import SSID_WiFi

# pulls environement variables needed for connection to the database from openshift
DBUser = os.getenv("OPENSHIFT_MYSQL_DB_USERNAME")
DBPword = os.getenv("OPENSHIFT_MYSQL_DB_PASSWORD")
DBName = os.getenv("DBName")
DBHost = os.getenv("OPENSHIFT_MYSQL_DB_HOST")
DBPort  = os.getenv("OPENSHIFT_MYSQL_DB_PORT")
class TestSSIDsniff(unittest.TestCase):
    def setUp(self,DBUser,DBPword,DBName,DBHost):
        db = SSID_WiFi.SSID_WiFi(self,DBUser,DBPword,DBName,DBHost)

    def tearDown(self):
        del db
#if any errors were thrown this will clean them
        gc.collect()

    def DBExistTest(self):
        # prepare a cursor object using cursor() method
        cursor = db.cursor()
        # execute SQL query using execute() method.
        cursor.execute("SELECT VERSION()")
        # Fetch a single row using fetchone() method.
        data = cursor.fetchone()
	    self.assertEqual(1,data)

    def write2dbtest(self):
#       DeviceList = (DeviceName,MacAddr)
        DeviceList = ('00:01:02:03:04:05','DeviceName2')
# Im not sure about this line. should it be testdb.bluesniff.write_to_db ??
        SSID_WiFi.write_to_db(self,DeviceList)
        cursor = db.cursor()
        data = cursor.fetchone()
        self.assertEqual(1,data)

if __name__ == '__main__':
 	unittest.main()
