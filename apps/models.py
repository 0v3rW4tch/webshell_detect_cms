from exts import db
from werkzeug.security import generate_password_hash,check_password_hash

class CMSUser(db.Model):
    __tablename__ = 'cms_user'
    id = db.Column(db.Integer,autoincrement=True,primary_key=True)
    username = db.Column(db.String(45),nullable=False)
    _password = db.Column(db.String(100),nullable=False)
    email = db.Column(db.String(30),nullable=False)

    def __init__(self,username,password,email):
        self.username = username
        self.password = password
        self.email = email

    @property
    def password(self):
        return self._password

    @password.setter
    def password(self,raw_password):
        self._password = generate_password_hash(raw_password)


    def check_password(self,raw_password):
        result = check_password_hash(self.password,raw_password)
        return result


