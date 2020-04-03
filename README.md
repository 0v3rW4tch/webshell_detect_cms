## Detect_Webshell_CMS

本人的毕设项目，写得很烂，请大佬们多多见谅，使用的flask+scikit-learn完成的，目前测试只在window环境下，主要是跟非机器学习类的webshell扫描器，比如：D盾，做一个对比，如果想在Linux环境下使用可能需要重新修改代码里面的一些东西，路径啥的。这整个项目下来用实力验证了下面的图片：

![GUxa1x.png](https://s1.ax1x.com/2020/04/03/GUxa1x.png)

#### 数据与模型的一些处理

因为这个东西是处理php的webshell的，所以特征化就使用了`opcode+TF-IDF`这种方法进行处理，因为opcode相比普通代码文字，更有代表性，而TF-IDF相比一般的词频统计更加有效，所以就选了这两种结合。

而训练的模型使用的是`xgboost`，因为`xgboost`普遍来说比随机森林要更好些，拟合度更高，速度也经过了优化，参考论文：[基于XGBoost算法的Webshell检测方法研究](http://kns.cnki.net/kcms/detail/detail.aspx?DBCode=CJFQ&FileName=JSJA2018S1082&DBName=CJFDLAST2018&v=MzI3NTdMM0pMejdCYjdHNEg5bXZybzlOWm9RSUJYMU55aEJtNms0SVRBbVhyaGN5RnJDVVI3cWZZK1pzRnk3blU=)

而本人在测试过程中也对比这几种算法的准确性，在普通的词袋模型，发现xgboost确实是比较有有优势的。

![GaVH56.png](https://s1.ax1x.com/2020/04/03/GaVH56.png)



#### 效果展示

因为一开始这个东西，本身是打算给网站的一些管理员做的，所以这个后台模板有CMS的风范(到处找的前端代码拼拼凑凑，某些时候前端可能有点bug请见谅)。。

![GUx6Nd.png](https://s1.ax1x.com/2020/04/03/GUx6Nd.png)

登陆之后可以根据右边的功能栏选择想要使用的功能点，可以查看当前本机的一些信息，还有修改当前用户的一个密码等等

![GUzNVg.png](https://s1.ax1x.com/2020/04/03/GUzNVg.png)

当然比较重要的就是这几个检测功能：

##### 1.上传检测

使用了bootstrap的一个文件上传的框架，可以多文件上传并进行检测。

![GanFG6.png](https://s1.ax1x.com/2020/04/03/GanFG6.png)

检测出来的文件会标记红色展示在下方的表格内。

##### 2.输入检测

输入相关的php代码之后会返回相应的结果

![GaC7pd.png](https://s1.ax1x.com/2020/04/03/GaC7pd.png)

![GaPU9H.png](https://s1.ax1x.com/2020/04/03/GaPU9H.png)

##### 3.目录检测

发现做这个CMS最有关系的就是这个功能，给管理员扫描本机的一些目录，但是过程中遇到了问题，发现flask很少那种可以打开文件夹让管理员选择目录的插件，有一个可以利用的就是`flask-Admin`这个插件，但是吧，我都写了那么多东西，叫我重新写一遍，不可能吧，再者这种图形化的东西有点难写，本来是想用`tkinter`写一个的，发现`tkinter`的`mainloop`跳不出去，其实写这种东西最好使用`Django`，查资料的过程中发现其后台实现文件的管理比较好实现，到这阶段，没办法，退而求其次，让用户输入一下吧，再次体现这个图：

![GUxa1x.png](https://s1.ax1x.com/2020/04/03/GUxa1x.png)

当用户输入要扫描的目录的时候，就会展示出当前目录所存在的木马，并附带删除功能，把危险文件删掉，保证自己网站目录的一个健康环境

![GaiwiF.png](https://s1.ax1x.com/2020/04/03/GaiwiF.png)

后面老师说要有可视化界面也是在添加黑样本的界面上添加上模型的一个训练报告，然后弄了几个图构造一个最新一次训练的报告吧，包括交叉验证，训练出来的报告，还有近几次的一个准确率等。

![GapOgI.png](https://s1.ax1x.com/2020/04/03/GapOgI.png)

当然我们可以继续添加新样本，因为训练时间比较长所以以定时任务执行，每隔10小时就会进行一次训练与学习保证时效性。

![GaZwi6.png](https://s1.ax1x.com/2020/04/03/GaZwi6.png)

![GaZjYV.png](https://s1.ax1x.com/2020/04/03/GaZjYV.png)


#### 效果

尝试使用一个Webshell文件进行对比，对比最新版D盾查杀和该扫描器的一个效果，可以看到D盾没发现任何东西，这时候机器学习的优势就出来了。

![GaoRYT.png](https://s1.ax1x.com/2020/04/03/GaoRYT.png)


最后的最后，毕设这种东西，做出来的东西能(好)跑(看)就(就)行(行)啦XD



#### 启动

先配置好所需要的一些变量

```bash
pip install -r requirements.txt
```

若果不想看到一些编码类的警告的话，可以把目录下的whl文件给安装

```
pip install curses-2.2.1+utf8-cp36-cp36m-win_amd64.whl
```

后面就常规启动一下就好

```
python cms_develop.py
```

因为本人在蓝图那里加了前缀，所以访问的时候加上`cms`，也就是`http://127.0.0.1:8888/cms/`，不喜欢的可以去掉就行。

当然window下面还有其他的部署方法，参考：[此链接](https://blog.csdn.net/u010501845/article/details/80878553)

把mod_wsgi目录下的选好版本安装之后，启动`start.py`就可以了

```
python start.py
```

这种方法本人测试后效果不好，比直接启动的效果更慢，毕竟不是Linux上跑，也就这样吧ε=(´ο｀*)))唉

当然数据库也需要自己设置一下，不喜欢我原来的数据库的话可以重新migrate一下，我一开始的数据库是这个样子的，数据库名字是`dl_cms`。

![GUXQXD.png](https://s1.ax1x.com/2020/04/03/GUXQXD.png)

添加用户也是可以通过migrate去进行的

![GUXL36.png](https://s1.ax1x.com/2020/04/03/GUXL36.png)

#### 参考：

书籍：《Web安全机器学习入门》

