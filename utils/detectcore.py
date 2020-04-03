import xgboost as xgb
from sklearn.feature_extraction.text import CountVectorizer,TfidfTransformer
import numpy as np
import os
import pickle,re,subprocess
from sklearn import metrics
from sklearn.model_selection import train_test_split,cross_val_score
from sklearn.metrics import classification_report
from sklearn.externals import joblib
import matplotlib.pyplot as plt
import pandas as pd


max_features=10000
min_opcode_count = 2
white_count = 0
black_count = 0
max_document_length = 4000

webshell_dir = "F:/毕设准备/2book-master/data/webshell/webshell/PHP/"
whitefile_dir = "F:/毕设准备/2book-master/data/webshell/normal/php/"
php_bin = "D:\\phpStudy\\PHPTutorial\\php\\php-7.0.12-nts\\php.exe"


DATA_PATH = os.path.dirname(__file__) + '/pkl_data/'
TMP_PHP_PATH = os.path.dirname(__file__).replace('utils','tmp')
PICTURE_FILE_PATH = os.path.dirname(__file__).replace('utils','static') + '/picture/report/'
TEMPLATE_PATH = os.path.dirname(__file__).replace('utils','templates')
data_pkl_file= DATA_PATH + "data-webshell-opcode-tf.pkl"
label_pkl_file= DATA_PATH + "label-webshell-opcode-tf.pkl"




'''
加载单个文件内容
'''
def load_file(file_path):
    x = ""
    with open(file_path,encoding='ISO-8859-1') as f:
        for line in f:
            line = line.strip('\n')
            line = line.strip('\r')
            x += line
    return x


'''
遍历目录下所有文件内容
'''
def load_file_re(dir):
    files_list= []
    g = os.walk(dir)
    for path , d , filelist in g:
        for filename in  filelist:
            if filename.endswith('.php') or filename.endswith('.txt'):
                filepath = os.path.join(path,filename)
                # print("loading file is {}".format(filepath))
                t = load_file(filepath)
                files_list.append(t)
    return files_list


'''
加载所有的opcode
'''
def load_file_opcode(file_path):
    global php_bin
    t = ""
    try:
        cmd = php_bin+" -dvld.active=1 -dvld.execute=0 "+file_path
        # locale.getpreferredencoding(True)
        status,output = subprocess.getstatusoutput(cmd)

        t = output
        # print(t)
        tokens  = re.findall(r'\s(\b[A-Z_]+\b)\s',output)
        #保证长度  过滤不是正确的opcode
        tmp = []
        for x in tokens:
            if len(x) >=2 and x!='PHP':
                tmp.append(x)
        tokens = tmp
        t = " ".join(tokens)
        return t
    except:
        return ""
    # print("tokens is {}".format(tokens))
    # print("opcode's  length is {}".format(len(t)))

    # print("t is{}".format(t))


'''
只返回opcode和文件列表内容，用于目录检测
'''
def load_files_opcode_re(dir):
    global min_opcode_count
    files_list = []
    g = os.walk(dir)
    file_list_name = []
    for path,r,filelist in g:
        file_list_name = filelist
        for filename in filelist:
            # print("filename:{}".format(filename))
            if filename.endswith(".php"):
                fulepath = os.path.join(path,filename)
                # print("Loading {} opcode".format(fulepath))
                t = load_file_opcode(fulepath)
                if len(t) > min_opcode_count:
                    #保证长度
                    files_list.append(t)
                else:
                    print("Load File is not fit!!!")

    return files_list,file_list_name



'''
只返回opcode内容
'''
def load_files_opcode_re_train(dir):
    global min_opcode_count
    files_list = []
    g = os.walk(dir)
    for path,r,filelist in g:
        for filename in filelist:
            print("filename:{}".format(filename))
            if filename.endswith(".php"):
                fulepath = os.path.join(path,filename)
                # print("Loading {} opcode".format(fulepath))
                t = load_file_opcode(fulepath)
                if len(t) > min_opcode_count:
                    #保证长度
                    files_list.append(t)
                else:
                    print("Load File is not fit!!!")

    return files_list


'''
训练数据特征化
'''
def get_feature_by_opcode():
    global white_count
    global black_count
    global max_features
    global webshell_dir
    global whitefile_dir
    # print("max features is {}".format(max_features))


    webshell_files_list = load_files_opcode_re_train(webshell_dir)
    y1=[1]*len(webshell_files_list)
    black_count=len(webshell_files_list)
    wp_files_list =load_files_opcode_re_train(whitefile_dir)
    y2=[0]*len(wp_files_list)
    white_count=len(wp_files_list)


    x=webshell_files_list+wp_files_list
    #print x
    y=y1+y2
    #
    CV = CountVectorizer(ngram_range=(2, 4), decode_error="ignore", max_features=max_features,
                             token_pattern=r'\b\w+\b', min_df=1, max_df=1.0)
    #
    # #保存特征
    #
    #
    x = CV.fit_transform(x).toarray()
    # print(DATA_PATH)

    feature_path = DATA_PATH + 'the_last_feature.pkl'

    with open(feature_path, 'wb') as fw:
        pickle.dump(CV, fw)
    #
    #
    #
    transformer = TfidfTransformer(smooth_idf=False)
    x_tfidf = transformer.fit_transform(x)
    x = x_tfidf.toarray()


    #保存tf-idf模型
    tfidftransformer_path = DATA_PATH + 'the_last_tfidf.pkl'
    with open(tfidftransformer_path, 'wb') as fw:
        pickle.dump(transformer, fw)


    #保存x,y特征后的模型
    with open(data_pkl_file,'wb') as f:
        pickle.dump(x, f)

    with open(label_pkl_file, 'wb') as f:
        pickle.dump(y, f)

    return x,y



'''
生成最新训练数据并保存
'''
def do_metrics(y_test,y_pred):
    print("metrics.accuracy_score:{}".format(metrics.accuracy_score(y_test,y_pred)))
    print("metrics.confusion_matrix:{}".format(metrics.confusion_matrix(y_test,y_pred)))
    print("metrics.precision_score:{}".format(metrics.precision_score(y_test,y_pred)))
    print("metrics.recall_score:{}".format(metrics.recall_score(y_test,y_pred)))
    print("metrics.f1_score:{}".format(metrics.f1_score(y_test,y_pred)))
    metrics_result = {'accuracy' : metrics.accuracy_score(y_test,y_pred),
                      'precision' : metrics.precision_score(y_test,y_pred),
                       'recall_score' : metrics.recall_score(y_test,y_pred),
                        'f1_score' : metrics.f1_score(y_test,y_pred)
                      }

    #一开始pkl文件里面就带有5次数据，不需要初始化
    last_five_list = pickle.load(open(DATA_PATH + 'last_five_list.pkl','rb'))

    last_five_list.append(metrics.accuracy_score(y_test,y_pred))


    #更新pkl文件
    with open(DATA_PATH + 'last_five_list.pkl', 'wb') as fw:
        pickle.dump(last_five_list[-5:], fw)

    with open(DATA_PATH + 'do_metrics.pkl','wb') as fp:
        pickle.dump(metrics_result,fp)




'''
保存训练模型并生成报告表格
'''
def do_xgboost(x,y):
    # x = pickle.load(open(data_pkl_file, "rb"))
    # y = pickle.load(open(label_pkl_file, "rb"))
    xgb_classifier = xgb.XGBClassifier()

    # cross_result = cross_val_score(xgb_classifier,x,y,n_jobs=-1,cv=10)

    x_train,x_test,y_train,y_test = train_test_split(x,y,test_size=0.4,random_state=0)
    xgb_model = xgb_classifier.fit(x_train,y_train)

    model_filename = DATA_PATH + 'finalized_model.sav'
    joblib.dump(xgb_model, model_filename)


    y_pred = xgb_model.predict(x_test)


    report = classification_report(y_test,y_pred,output_dict=True,target_names=['white_file','webshell_file'])

    df = pd.DataFrame(report).transpose()

    #生成表格
    df.to_html(TEMPLATE_PATH+ '/classification_report.html',table_id='df_table')

    print(report,type(df))
    print(do_metrics(y_test, y_pred))



'''
上传检测接口
'''
def do_upload_check(dir_name):
    opcode_test_list, file_name_list = load_files_opcode_re(dir_name)


    feature_path = DATA_PATH + 'the_last_feature.pkl'

    loaded_vec = pickle.load(open(feature_path, "rb"))
    tfidftransformer_path = DATA_PATH + 'the_last_tfidf.pkl'

    tfidftransformer = pickle.load(open(tfidftransformer_path, "rb"))

    test_tfidf = tfidftransformer.transform(loaded_vec.transform(opcode_test_list).toarray()).toarray()

    model_filename = DATA_PATH + 'finalized_model.sav'
    xgb_model = joblib.load(model_filename)

    y_pred = xgb_model.predict(test_tfidf)
    # print(y_pred)
    tmp = dict(zip(file_name_list, y_pred))
    print(tmp)
    # num_list_new = [str(x) for x in y_pred]
    result= []

    for key,value in tmp.items():
        if value == 1:
            result.append({'filename':key,'property':'危险'})
        else:
            result.append({'filename': key, 'property': '安全'})


    return result


'''
目录检测接口
'''
def do_dictionary_check(dir_name):
    # dir_name = 'C:/Users/4me/Desktop/test'
    opcode_test_list,file_name_list = load_files_opcode_re(dir_name)

    for j in file_name_list:
        if not j.endswith('.php'):
            file_name_list.remove(j)

    feature_path = DATA_PATH + 'the_last_feature.pkl'

    loaded_vec = pickle.load(open(feature_path, "rb"))
    tfidftransformer_path = DATA_PATH + 'the_last_tfidf.pkl'

    tfidftransformer = pickle.load(open(tfidftransformer_path, "rb"))

    test_tfidf = tfidftransformer.transform(loaded_vec.transform(opcode_test_list).toarray()).toarray()

    model_filename = DATA_PATH + 'finalized_model.sav'
    xgb_model = joblib.load(model_filename)

    y_pred = xgb_model.predict(test_tfidf)
    print(y_pred)
    num_list_new = [str(x) for x in y_pred]
    result = dict(zip(file_name_list,num_list_new))

    # return y_pred[0]
    return result


'''
输入检测接口
'''
def do_single_check(content):
    # content = "<?php eval($_GET[1]); ?>"
    dir_test = TMP_PHP_PATH + "/tmp.php"
    with open(dir_test,'w') as fp:
        fp.write(content)

    t = []
    tmp = load_file_opcode(dir_test)
    t.append(tmp)

    # x = pickle.load(open('opcode4_list.pkl', 'rb'))  #最后的x特征

    # 保存特征
    # feature_path = 'feature3.pkl'
    # tfidftransformer_path = 'tfidftransformer.pkl'
    # CV = CountVectorizer(decode_error="replace", vocabulary=pickle.load(open(feature_path, "rb")))
    #
    # CV = CountVectorizer(ngram_range=(2, 4), decode_error="replace", max_features=max_features,
    #                      token_pattern=r'\b\w+\b', min_df=1, max_df=1.0)
    # x = CV.fit_transform(x).toarray()

    feature_path = DATA_PATH + 'the_last_feature.pkl'
    # with open(feature_path, 'wb') as fw:
    #     pickle.dump(CV.vocabulary_, fw)

    # loaded_vec = CountVectorizer(decode_error="replace", vocabulary=pickle.load(open(feature_path, "rb")),max_features=max_features,
    #                      token_pattern=r'\b\w+\b', min_df=1, max_df=1.0)
    loaded_vec = pickle.load(open(feature_path, "rb"))
    tfidftransformer_path = DATA_PATH + 'the_last_tfidf.pkl'

    # transformer = TfidfTransformer(smooth_idf=False)
    # x_tfidf = transformer.fit_transform(x)

    # with open(tfidftransformer_path, 'wb') as fw:
    #     pickle.dump(transformer, fw)
    tfidftransformer = pickle.load(open(tfidftransformer_path, "rb"))
    # x = x_tfidf.toarray()
    test_tfidf = tfidftransformer.transform(loaded_vec.transform(t).toarray()).toarray()




    # x_train, x_test, y_train, y_test = train_test_split(x, y, test_size=0.4, random_state=0)


    # x1 = transformer.transform(t)
    # print(x1)
    # xgb_model = xgb.XGBClassifier().fit(x_train, y_train)
    model_filename = DATA_PATH + 'finalized_model.sav'
    xgb_model = joblib.load(model_filename)
    # result = xgb_model.score(x_test, y_test)

    y_pred = xgb_model.predict(test_tfidf)
    # print(y_pred[0])
    # print(result)
    return  y_pred[0]




'''
训练接口
'''
def train_save_model():
    # print('test123')
    # get_feature_by_opcode()
    x,y = get_feature_by_opcode()
    do_xgboost(x,y)


'''
生成报告柱状图
'''
def do_cross_validate():
    global data_pkl_file
    global label_pkl_file
    x = pickle.load(open(data_pkl_file, "rb"))
    y = pickle.load(open(label_pkl_file,"rb"))
    print(x,y)

    xgb_classifier = xgb.XGBClassifier()

    cross_result = cross_val_score(xgb_classifier,x,y,n_jobs=1,cv=6)

    cross_accuracy_path = DATA_PATH + 'cross_accuracy.pkl'
    with open(cross_accuracy_path,'wb') as fw:
        pickle.dump(cross_result,fw)

    cross_result = pickle.load(open(cross_accuracy_path,'rb'))
    plt.rcParams['font.sans-serif'] = ['SimHei']  # 显示中文标签
    plt_x = ['测试1','测试2','测试3','测试4','测试5','测试6']
    plt_y = cross_result
    #
    plt.bar(plt_x, plt_y, color='g', align='center')
    # plt.axis([,,0.5, 1])
    for a,b in zip(plt_x,plt_y):
        plt.text(a, b, '%.3f' % b, ha='center', va='bottom', fontsize=11)

    plt.title('交叉验证柱状图')
    plt.ylabel('准确率')
    plt.xlabel('测试次数')
    plt.savefig(PICTURE_FILE_PATH + 'bar.jpg')
    print(cross_result,type(cross_result))



'''
生成近5次数据变化图
'''
def last_five_train_graph():
    plt.rcParams['font.sans-serif'] = ['SimHei']  # 显示中文标签

    plt.ylabel('准确率')
    plt.xlabel('测试次数')
    plt.figure(figsize=(8, 1.8))

    x = [1, 2, 3, 4, 5]
    y = pickle.load(open(DATA_PATH + 'last_five_list.pkl', 'rb'))

    #设置x,y间距
    plt.axis([0, 6, 0.9, 1])

    for a, b in zip(x, y):
        plt.text(a, b, '%.3f' % b, ha='center', va='bottom', fontsize=11)

    plt.plot(x, y)

    # plt.show()
    plt.savefig(PICTURE_FILE_PATH + 'last_five_train.jpg')






if __name__ == "__main__":
    x, y = get_feature_by_opcode()
    # print(TMP_PHP_PATH + '/tmp.php')
    do_xgboost(x,y)
    # do_single_check(x,y)
    # print(os.path.dirname(__file__))
    # do_dictionary_check()
    # do_cross_validate()
    pass