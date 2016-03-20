<?php

namespace ptiuma\chat\models;

use Yii;
use yii\behaviors\TimestampBehavior;
 use frontend\models\LinksViews;

/**
 * This is the model class for table "chat".
 *
 * @property integer $id
 * @property string $message
 * @property integer $userId
 * @property string $updateDate
 */
class Chat extends \yii\db\ActiveRecord {


    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'chat';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),

            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['message','chatId'], 'required'],
            [['userId','sendTo','replyTo'], 'integer'],
            [['fromName','message'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'userId' => 'User',
            'chatId'=>'chatId',
            'sendTo'=>'sendTo',
            'replyTo'=>'replyTo',
            'Hash_code'=>'Hash_code',
            'isTelegram'=>'isTelegram',
            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата обновление'),
        ];
    }

    public function beforeSave($insert) {
        $this->userId = Yii::$app->user->id;
        return parent::beforeSave($insert);
    }
    public function getChatId() {
        return $this->chatId;
    }
    public function records() {
        return $this::find()
        ->where(['chatId'=>$this->getChatId()])
        ->orderBy('id desc')->limit(10)->all();
    }
      public function getView()
    {
          return $this->hasOne(LinksViews::className(), ['id' => 'chatId']);
    }
    public function data() {
        $output = '';
        $models = Chat::records();
        $models=array_reverse($models);
        $output = '';
        if ($models)
        {
            foreach ($models as $model) {
                 $me=!$model->isTelegram?1:0;
                 $name=$me==1?"Вы":"Менеджер";
                 $output .= '<div class="direct-chat-msg '.($me==1?'':'right').'">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-'.($me==1?'left':'right').'"> ' . $name . '</span>
                    <span class="direct-chat-timestamp pull-'.($me==1?'right':'left').'"><i class="fa fa-clock-o"></i> ' . date('d F, H:i',$model->created_at) . '</span>
                  </div>
                   <div class="direct-chat-text" style="'.($me!==1?'background: #3c8dbc;color:#fff;':'').'">
                    ' . $model->message . '
                  </div></div>';

            }
         }
          return $output;
    }

}
