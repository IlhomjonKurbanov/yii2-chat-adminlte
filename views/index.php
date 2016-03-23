<div id="chatPop" class="popover popover-default popover-md bottom bottom-right in" role="dialog" style="">
<div class="popover-title">
<i class="glyphicon glyphicon-lock"></i> Telegram - Chat
</div>
<div class="popover-content">

<div class="box box-success">
    <div class="box-header ui-sortable-handle" style="cursor: move;">
        <i class="fa fa-comments-o"></i>
    </div>
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
        <div id="chat-box" class="box-body2 chat2" style="overflow: auto; width: auto; height: 250px;">
        <div class="box box-primary direct-chat direct-chat-primary">
        <div class="box-body" style="display: block;">
      		<div class="direct-chat-messages">
            <?=$data?>
          </div>
        </div>
    </div>
        </div>

    </div><!-- /.chat -->
    &nbsp;
    <div class="box-footer" style="margin-top:20px;border-top:1px solid">
        <div class="input-group">
            <input name="Chat[message]" id="chat_message" placeholder="Введите сообщение..." class="form-control">
            <div class="input-group-btn">
                <button class="btn btn-success btn-send-comment" data-url="<?=$url;?>"  data-chatid="<?=$chatId;?>"><i class="fa fa-hand-pointer-o"></i></button>
            </div>
        </div>
    </div>
</div><!-- /.box (chat box) -->
</div>

</div>


<div id="main-chat" class="transform chat chat-bottom manager-off chat-open">
    <div class="chat-header" onclick="headClick()">
        <span class="">Связаться с менеджером</span>
        <i class="close-btn">×</i>
    </div>
<div id="box-welcome" class="chat-container transform">
    <div class="main-chat-window message-offline transform-opacity">
            <div class="chat-manager">
          <div>
                    Ваш менеджер
                </div>
                <h3><b><?=$model->view->link->user->profile->name?></b></h3>
                <div>
                    Телефон: <?=$model->view->link->user->profile->phone?>
                </div>
                <?php if($model->view->link->user->profile->public_email):?>
                 <div>
                    Email: <?=$model->view->link->user->profile->public_email?>
                </div>
                <?php endif;?>
             <p>
                    Вы можете связаться с Вашим менеджером, позвонив ему или написав ему в телеграм-чат!
                </p>
            </div>

    </div>
</div>


</div>