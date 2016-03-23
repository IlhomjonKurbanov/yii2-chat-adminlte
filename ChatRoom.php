<?php

namespace ptiuma\chat;

use Yii;
use yii\base\Widget;
use ptiuma\chat\models\Chat;

/**
 * @author Andy Fitria <ptiuma@gmail.com>
 */
class ChatRoom extends Widget {

    public $sourcePath = '@vendor/ptiuma/yii2-chat-adminlte/assets';
    public $css = [
    //'css/chat.css',
    ];
    public $js = [ // Configured conditionally (source/minified) during init()
        'js/chat.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    public $models;
    public $url;
    public $chatId;
    public $model;

    public function init() {
        $this->model = new Chat();
        Yii::$app->assetManager->publish("@vendor/ptiuma/yii2-chat-adminlte/assets/img/avatar.png");

        parent::init();
    }

    public function run() {
        parent::init();
        ChatJs::register($this->view);
        $model = new Chat();
        $model->chatId = $this->chatId;
        $data = $model->data();
        return $this->render('index', [
                    'data' => $data,
                    'model'=> $model,
                    'url' => $this->url,
                    'chatId' => $this->chatId,
        ]);
    }

    public static function sendChat($post) {
        if (isset($post['message']))
            $message = $post['message'];
        if (isset($post['chatid']))
            $chatId = $post['chatid'];

        $model = new \ptiuma\chat\models\Chat;
            $model->chatId=$chatId;
             $model->Hash_code=$post['sessionid'];
        if ($message) {
            $model->message = $message;
            $model->sendTo=$model->view->link->user->telegram->chat_id;

            if ($model->save()) {            	$msg="Пользователь прислал сообщение из чата № ".$model->chatId." \n";
            	$msg.="Текст: ";
            	$msg.=$model->message;
            	$msg.="\n Для ответа введите /chat ".$model->chatId." ваш_ответ ";
               \Yii::$app->bot->sendMessage($model->sendTo, $msg);
                echo $model->data();
            } else {
                print_r($model->getErrors());
                exit(0);
            }
        } else {
            echo $model->data();
        }
    }
      public static function send2Telegram($model) {


    }
}
