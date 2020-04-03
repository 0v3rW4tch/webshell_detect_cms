from flask import Flask
from apps import bp_app
import config
from exts import db,scheduler
from flask_wtf import CSRFProtect
from utils import detectcore


def create_app():
    app = Flask(__name__)
    app.register_blueprint(bp_app)
    app.config.from_object(config)
    db.init_app(app)

    app.config.update(
        {"SCHEDULER_API_ENABLED": True,
         "JOBS": [{"id": "mission_1",
                   "func": "utils.detectcore:train_save_model",
                   "trigger": "interval",
                   "seconds": 36000
                   },{"id": "mission_2",  # 任务ID
                   "func": "apps.views:del_upload_file",  # 任务位置
                   "trigger": "interval",  # 触发器
                   "seconds": 3600*11  # 时间间隔
                   },{"id": "mission_3",  # 任务ID
                   "func": "utils.detectcore:do_cross_validate",  # 任务位置
                   "trigger": "interval",  # 触发器
                   "seconds": 3600*12  # 时间间隔
                   }
                  ]},threaded=True
    )
    scheduler.init_app(app)
    scheduler.start()

    CSRFProtect(app)

    return app



app = create_app()

if __name__ == '__main__':
    app.run(threaded=True,port=8888)
