<?php


namespace ptiuma\chat;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Andy Fitria <ptiuma@gmail.com>
 */
class ChatJs extends AssetBundle {

    public $sourcePath = '@vendor/ptiuma/yii2-chat-adminlte/assets';
     public $css = [
    'css/chat.css',
    ];
    public $js = [
        'js/chat.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
