<?php

namespace ptiuma\chat\models;

use Yii;
use yii\behaviors\TimestampBehavior;
 use common\models\User;
 use frontend\models\LinksViews;
 use \ptiuma\chat\models\ChatMessages;
 		 use ElephantIO\Client;
		 use ElephantIO\Engine\SocketIO\Version1X as Version1X;

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
              [['userId','viewId','presentationId'], 'integer'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'userId' => 'User',
            'chatId'=>'chatId',
            'presentationId'=>'presentationId',


            'created_at' => Yii::t('app', 'Дата создания'),
            'updated_at' => Yii::t('app', 'Дата обновления'),
        ];
    }
    public function getMessages()
    {
          return $this->hasMany(ChatMessages::className(), ['chatId' => 'id'])->orderBy('msgId desc');
    }
          public function getUser()
    {
          return $this->hasOne(User::className(), ['id' => 'userId']);
    }
    public function beforeSave($insert) {
       // $this->userId = Yii::$app->user->id;
        return parent::beforeSave($insert);
    }
    public function getChatId() {
        return $this->chatId;
    }
    public function records() {
        return ChatMessages::find()
        ->where(['chatId'=>$this->getChatId()])
        ->orderBy('id desc')->limit(10)->all();
    }
      public function getView()
    {
          return $this->hasOne(LinksViews::className(), ['id' => 'chatId']);
    }
    public function data() {
        $output = '';
        $models = $this->messages;
        $models=array_reverse($models);
        $output = '';
        if ($models)
        {
            foreach ($models as $model) {
                 $me=!$model->isManager?1:0;
                 $name=$me==1?"Вы":"Менеджер";
                 $output .= '<div class="direct-chat-msg '.($me==1?'':'right').'">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-'.($me==1?'left':'right').'"> ' . $name . '</span>
                    <span class="direct-chat-timestamp pull-'.($me==1?'right':'left').'"><i class="fa fa-clock-o"></i> ' . date('d F, H:i',$model->msgTime) . '</span>
                  </div>
                   <div class="direct-chat-text" style="'.($me!==1?'background: #3c8dbc;color:#fff;':'').'">
                    ' . $model->message . '
                  </div></div>';

            }
         }
          return $output;
    }
   public function emitChat($chatid,$action='refreshchat')
    {

        if($chatid)
        {
				$client = new Client(new Version1X(Yii::$app->params['socketServer'].':3000'));

				$client->initialize();
				$client->emit($action, ['sid' => $chatid]);
				$client->close();
		}
    }
}
