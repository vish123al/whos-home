import bluetooth
import MySQLdb


class bluesniff:
    def __init__(self,DBUser,DBPword,DBName,DBHost):
        self.DBUser = DBUser
        self.DBPword = DBPword
        self.DBName = DBName
        self.host = DBHost

    def write_to_db(self,nearbylist):
        #(host,user,password,database)
        db = MySQLdb.connect(self.host,self.DBUser,self.DBPword,self.DBName)
        cursor = db.cursor()
        sql = "SELECT * FROM ActiveBlueTooth"
        for name, addr in nearbylist:
            print "%s, %s" % (name, addr)
            sql = """REPLACE INTO ActiveBlueTooth (TIMESTAMP, MAC, DeviceName, SensorID)
                VALUES (CURRENT_TIMESTAMP, '%s', '%s', '%s')""" % (name, addr, self.host)
            try:
                cursor.execute(sql)
                db.commit()
            except IOError as error:
                print error
                pass
        db.close()
