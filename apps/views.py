from flask import Blueprint,render_template,views,request,session,redirect,url_for,g,make_response,jsonify
from .forms import LoginForm,ResetForm,InputCheckForm,UploadForm,DictionaryForm
from .models import CMSUser
from .decorators import login_required
from utils.captcha import Captcha
from utils.detectcore import do_single_check,do_dictionary_check,do_upload_check,webshell_dir,DATA_PATH
from io import BytesIO
from exts import db
import subprocess
import re,os,pickle
from werkzeug.utils import secure_filename
import shutil,hashlib,time
from pypinyin import lazy_pinyin



UPLOAD_PATH =  os.path.dirname(__file__).replace('apps','upload').replace('\\','/')
CAPTHCHA_PATH = os.path.dirname(__file__).replace('apps','tmp').replace('\\','/')


bp = Blueprint("cms",__name__,url_prefix='/cms/')
info_list = []

@bp.route('/')
@login_required
def index():
    # print(UPLOAD_PATH)
    return render_template('index.html')
    # return jsonify({"code": 200, "message": '1'})



@bp.route('/logout/')
@login_required
def logout():
    del session['user_id']
    return redirect(url_for('cms.login'))


@bp.route('/captcha/')
def graph_captcha():
    #获取验证码
    text,image = Captcha.gene_graph_captcha()
    #通过网络传输需要二进制去进行传输
    graph_text = text.lower()
    with open(CAPTHCHA_PATH + '/captcha.txt','w') as fp:
        fp.write(graph_text)
    # print(g.graph_text)
    out  = BytesIO()
    image.save(out,'png')
    out.seek(0)
    resp = make_response(out.read())
    resp.content_type = 'image/png'
    return resp


@bp.route('/upload_check/',methods=['GET','POST'])
@login_required
def upload_check():
    if request.method == 'GET':
        return render_template('uploadcheck.html')
    if request.method == 'POST':
        form = UploadForm(request.files)
        if form.validate():
            file_content =  request.files.getlist('input_file')
            t = str(time.time())
            print(file_content)
            hash = hashlib.md5()
            hash.update(t.encode('utf-8'))
            save_path = UPLOAD_PATH + '/' +hash.hexdigest() + '/'
            print(save_path)
            os.mkdir(save_path)

            # 未完成的随机文件名
            # suffix = file_content.filename.split('.')[-1]
            # timestamp = datetime.datetime
            # filename = hashlib.md5(timestamp).hexdigest()+suffix
            #防止目录穿越

            for j in file_content:
                filename = "".join(lazy_pinyin(j.filename))
                filename = secure_filename(filename)
                # print(filename)
                j.save(os.path.join(save_path,filename))
            #可以使用send_from_directory实现查看文件的需求

            result = do_upload_check(save_path)
            print(result)

            return jsonify({"code": 200, "message": result})
            # return render_template('uploadcheck.html',**context={'code':200,'message':12334})
        else:
            message = form.errors.popitem()[1][0]
            print(message)
            return jsonify({"code": 400, "message": message})



'''
输入目录检测成功
'''
@bp.route('/dictionary_check/',methods=['GET','POST'])
@login_required
def dictionary_check():
    if request.method == "GET":
        return render_template('dictionarycheck.html')
    if request.method == "POST":
        form = DictionaryForm(request.form)
        print(form)


        if form.validate():
            path_data = request.form.get('input_dictionary')
            if os.path.exists(path_data):
                result = do_dictionary_check(path_data)
                # print(path_data,result)

                return jsonify({"code": 200, "message": result})
            else:
                # print("不存在该路径，请重新输入！！！")
                return jsonify({"code": 401, "message": "不存在该路径，请重新输入！！！"})
        #
        #     #得到结果然后需要怎么处理？
        else:
            message = form.errors.popitem()[1][0]
            print(message)
            return jsonify({"code": 400, "message": message})
    # return render_template('dictionarycheck.html')
#C:\\Users\\4me\\Desktop\\test
#C:\\www



@bp.route('/del_shell/',methods=['POST'])
@login_required
def del_shell():
    shell_file_path  = request.form.get('shell_file_path')
    print(shell_file_path)
    try:
        os.remove(shell_file_path)
        return jsonify({"code": 200, "message": shell_file_path})
    except:
        return jsonify({"code": 400, "message": "未删除成功"})
    # return jsonify({"code": 200, "message": shell_file_path})


#获取机器信息  已完成
def get_server_info():
    cmd = 'php -i'
    status, output = subprocess.getstatusoutput(cmd)
    # print(output)
    php_info = re.findall(r'PHP Version => (.*)', output)[0]
    system_info = re.findall(r'System => (.*)', output)[0]
    apache_cmd = 'D:/phpStudy/PHPTutorial/Apache/bin/httpd.exe -v'
    status, output = subprocess.getstatusoutput(apache_cmd)
    # print(output)
    server_info = re.findall(r'Server version: (.*)', output)[0]
    # print(php_info,system_info,server_info)
    user_cmd = 'whoami'
    status, output = subprocess.getstatusoutput(user_cmd)
    user_info = output.strip('\n')
    mysql_cmd = 'mysql --version'
    status, output = subprocess.getstatusoutput(mysql_cmd)
    mysql_info = output.strip('\n')
    info_dict = {
        'php_info': php_info,
        'system_info': system_info,
        'server_info': server_info,
        'user_info': user_info,
        'mysql_info': mysql_info,
    }
    print(info_dict)
    return info_dict



#删除上传文件
def del_upload_file():
    shutil.rmtree('./upload')

    os.mkdir('./upload')
    print('del_upload_test_success')
    # print(os.getcwd())


@bp.route('/upload_data_set/',methods=['POST'])
@login_required
def upload_data_set():
    form = UploadForm(request.files)
    if form.validate():
        file_content = request.files.getlist('input_file')

        for j in file_content:
            t = str(time.time())
            hash = hashlib.md5()
            hash.update(t.encode('utf-8'))
            filename = hash.hexdigest() + '.php'
            filename = secure_filename(filename)
            print(filename,os.path.join(webshell_dir, filename))
            # j.save(os.path.join(webshell_dir, filename))

        return jsonify({"code": 200, "message": "保存成功！"})
    else:
        message = form.errors.popitem()[1][0]
        print(message)
        return jsonify({"code": 400, "message": message})





@bp.route('/profile/')
@login_required
def profile():
    server_info_list = get_server_info()
    # print(type)
    return render_template("profile.html",**server_info_list)




'''
登录模块，已完成
'''
class LoginView(views.MethodView):

    def get(self,message=None):
        return render_template('login.html',message=message)


    def post(self):
        form = LoginForm(request.form)
        if form.validate():
            username = request.form.get("username")
            password = request.form.get("password")
            remember = form.remember.data
            # graph_num = request.form.get("graph_captcha")
            user = CMSUser.query.filter_by(username=username).first()
            if user and user.check_password(password) :
                session['user_id'] = user.id
                if remember:
                    #长久保存，过期时间31天
                    session.permanent = True
                # if graph_num == g.graph_text:
                #     print("right")
                return redirect(url_for('cms.index'))    #cms是这个蓝图的名字
            else:
                # return "用户名或密码错误"
                return self.get(message="用户名或密码错误")
        else:
            # print(form.errors)
            # return "表单验证错误"
            message = form.errors.popitem()[1][0]
            return self.get(message=message)



'''
重置密码已完成
'''
class ResetPwdView(views.MethodView):
    decorators = [login_required]
    def get(self):
        return render_template('resetpwd.html')

    def post(self):
        form = ResetForm(request.form)
        if form.validate():
            oldpwd = form.oldpwd.data
            newpwd  = form.newpwd.data
            user = g.cms_user
            if user.check_password(oldpwd):
                user.password = newpwd
                db.session.commit()
                # logout()
                return jsonify({"code":200,"message":""})
            else:
                return jsonify({"code":400,"message":"旧密码错误"})
        else:
            message = form.get_errors()
            return jsonify({"code":400,"message":message})



'''
输入性检测测试成功
'''
class InputCheckView(views.MethodView):
    decorators = [login_required]

    def get(self):
        return render_template('inputcheck.html')

    def post(self):
        form = InputCheckForm(request.form)
        # print(form.input_data.data)
        if form.validate():
            input_data = form.input_data.data.strip('\n').strip('\r')
            #输入性功能点检测，引入机器学习内容
            detect_result = int(do_single_check(input_data))
            # print(type(input_data))
            print(detect_result)
            if detect_result == 1:
                return jsonify({"code":201,"message":"danger"})
            if detect_result == 0:
                return jsonify({"code": 200, "message": "safe"})
            # context = {"code":200,"message":"1"}
            # return render_template('inputcheck.html',result_json = jsonify({"code":200,"message":"1"}))
        else:
            message = form.errors.popitem()[1][0]
            # print(message)
            return jsonify({"code": 400, "message": message})



@bp.route('/add_black_data/',methods=['GET'])
@login_required
def Add_Black_Data():
    context = pickle.load(open(DATA_PATH + 'do_metrics.pkl','rb'))
    return render_template('addblackdata.html',**context)




bp.add_url_rule('/login/',view_func=LoginView.as_view('login'))
bp.add_url_rule('/resetpwd/',view_func=ResetPwdView.as_view('resetpwd'))
bp.add_url_rule('/input_check/',view_func=InputCheckView.as_view('input_check'))