from flask_sqlalchemy import SQLAlchemy
from flask_apscheduler import APScheduler

db = SQLAlchemy()
scheduler = APScheduler()
