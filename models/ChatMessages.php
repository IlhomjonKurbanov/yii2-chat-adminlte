<?php
namespace ptiuma\chat\models;

use Yii;
use \ptiuma\chat\models\Chat;

/**
 * This is the model class for table "{{%chat_messages}}".
 *
 * @property integer $msgId
 * @property integer $chatId
 * @property integer $userId
 * @property integer $sendTo
 * @property integer $replyTo
 * @property string $Hash_code
 * @property string $fromName
 * @property string $message
 * @property integer $isManager
 * @property integer $isTelegram
 * @property integer $msgTime
 */
class ChatMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%chat_messages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chatId', 'userId', 'sendTo', 'replyTo', 'isManager', 'isTelegram', 'msgTime'], 'integer'],
            [['chatId', 'msgTime'], 'required'],
            [['message'], 'string'],
            [['Hash_code', 'fromName'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'msgId' => Yii::t('app', 'Msg ID'),
            'chatId' => Yii::t('app', 'Chat ID'),
            'userId' => Yii::t('app', 'User ID'),
            'sendTo' => Yii::t('app', 'Send To'),
            'replyTo' => Yii::t('app', 'Reply To'),
            'Hash_code' => Yii::t('app', 'Hash Code'),
            'fromName' => Yii::t('app', 'From Name'),
            'message' => Yii::t('app', 'Message'),
            'isManager' => Yii::t('app', 'Is Manager'),
            'isTelegram' => Yii::t('app', 'Is Telegram'),
            'msgTime' => Yii::t('app', 'Msg Time'),
        ];
    }
        public function getChat()
    {
          return $this->hasOne(Chat::className(), ['id' => 'chatId']);
    }
}