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