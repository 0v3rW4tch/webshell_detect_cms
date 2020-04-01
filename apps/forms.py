from wtforms import Form,StringField,IntegerField,FileField
from wtforms.validators import InputRequired,Length,ValidationError,Regexp,EqualTo
from flask import g    # def validate_graph_captcha(self,field):
from flask_wtf.file import FileAllowed,FileRequired



class LoginForm(Form):
    username = StringField(validators=[Length(4,10,message="用户名长度为4-10"),InputRequired(message="请输入用户名")])
    password = StringField(validators=[Length(4,20,message="请输入正确格式密码")])
    # graph_captcha = StringField(validators=[Regexp(r"\w{4}",message="图形验证码错误")])
    remember = IntegerField()
    # graph_captcha = StringField(validators=[Length(4,4,message="验证码长度为4"),InputRequired(message="请输入验证码")])

    #     graph_captcha = field.data
    #     graph_captcha_mem = g.graph_text
    #
    #     if not graph_captcha_mem:
    #         raise ValidationError(message="图形验证码错误！！！")

class ResetForm(Form):
    oldpwd = StringField(validators=[InputRequired(message="请输入旧密码")])
    newpwd = StringField(validators=[InputRequired(message="请输入新密码")])
    newpwd2 = StringField(validators=[EqualTo("newpwd",message="确认与新密码一致"),InputRequired(message="请输入确认密码")])


    def get_errors(self):
        message = self.errors.popitem()[1][0]
        return message




class InputCheckForm(Form):
    input_data = StringField(validators=[InputRequired(message="请输入相关内容"),Regexp(r"<\?*",message="输入的内容不符合格式")])



class UploadForm(Form):
    #靠一個name值確認是否上傳文件  其是可以繞過
    input_file = FileField(validators=[FileRequired(message="确认是否上传文件"),FileAllowed(['php','php3','php4','php5','phtml'])])


class DictionaryForm(Form):
    #windows格式
    input_dictionary = StringField(validators=[InputRequired(message="请输入路径"),Regexp(r"[a-zA-Z]:\\(?:[^\\/:*?<>|\r\n]+\\)*",message="输入的内容不符合路径格式")])
    #Linux格式
    #input_dictionary = StringField(validators=[InputRequired(message="请输入路径"),Regexp(r"^\/(\w+\/?)+$",message="输入的内容不符合路径格式")])

