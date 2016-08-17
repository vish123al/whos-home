#python modules
import bluetooth
import MySQLdb
import os
import unittest
import gc
#project code
import bluesniff



class TestBluesniff(unittest.TestCase):
    def setUp(self,DBUser,DBPword,DBName,DBHost):
        db = bluesniff.bluesniff(self,DBUser,DBPword,DBName,DBHost)
        # pulls environement variables needed for connection to the database from openshift
        DBUser = os.getenv("OPENSHIFT_MYSQL_DB_USERNAME")
        DBPword = os.getenv("OPENSHIFT_MYSQL_DB_PASSWORD")
        DBName = os.getenv("DBName")
        DBHost = os.getenv("OPENSHIFT_MYSQL_DB_HOST")
        DBPort  = os.getenv("OPENSHIFT_MYSQL_DB_PORT")

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
        DeviceList = ('DeviceName1','00:01:02:03:04:05','DeviceName2','00:01:02:03:04:06')
# Im not sure about this line. should it be testdb.bluesniff.write_to_db ??
        bluesniff.write_to_db(self,DeviceList)
        cursor = db.cursor()
        data = cursor.fetchone()
        self.assertEqual(1,data)

if __name__ == '__main__':
 	unittest.main()
