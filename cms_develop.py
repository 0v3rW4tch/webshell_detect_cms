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
                   "seconds": 36000  # 时间间隔
                   }
                  ]}
    )
    scheduler.init_app(app)
    scheduler.start()

    CSRFProtect(app)

    return app






if __name__ == '__main__':
    app = create_app()
    app.run(port=8888,threaded=True)
