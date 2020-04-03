#models views forms
from datetime import timedelta
DEBUG=True


SECRET_KEY = "SGVsbG8sIFdvcmxkIQ=="

HOSTNAME = '127.0.0.1'
PORT = '3306'
USERNAME = 'root'
PASSWORD = 'root'
DATABASE = 'dl_cms'

DB_URI = 'mysql+pymysql://{username}:{password}@{host}:{port}/{db}?charset=utf8'.format(username=USERNAME,password=PASSWORD,host=HOSTNAME,port=PORT,db=DATABASE)

SQLALCHEMY_DATABASE_URI = DB_URI
SQLALCHEMY_TRACK_MODIFICATIONS = False


PERMANENT_SESSION_LIFETIME = timedelta(hours=3)
