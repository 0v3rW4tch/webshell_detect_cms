from flask import session,redirect,url_for,render_template
from functools import wraps

def login_required(func):

    @wraps(func)   #保留func原本的一些属性
    def inner(*args,**kwargs):
        if 'user_id' in session:
            return func(*args,**kwargs)
        else:
            return redirect(url_for("cms.login"))

    return inner