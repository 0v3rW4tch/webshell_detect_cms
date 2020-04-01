from flask_script import Manager
from flask_migrate import Migrate,MigrateCommand
from cms_develop import create_app
from exts import db
from apps.models import CMSUser


app = create_app()
manager = Manager(app)



Migrate(app,db)
manager.add_command('db',MigrateCommand)

@manager.option('-u','--username',dest='username')
@manager.option('-p','--password',dest = 'password')
@manager.option('-e','--email',dest = 'email')
def create_cms_user(username,password,email):
   user = CMSUser(username,password,email)
   db.session.add(user)
   db.session.commit()
   print("用户增加成功")


if __name__  == '__main__':
    manager.run()