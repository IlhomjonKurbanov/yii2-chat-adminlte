var cnt_chat=0;
; (function($) {
    $.fn.focusToEnd = function(defaultValue) {
        return this.each(function() {
            var prevValue = $(this).val();
            if (typeof prevValue == undefined || prevValue == "") {
                prevValue = defaultValue;
            }
            $(this).focus().val("").val(prevValue);
        });
    };
})(jQuery)
    $(function() {

    $("#chat_message").bind('keyup', function(e) {
        if (e.keyCode == 13) {
            msg = $("#chat_message").val();
            if (msg.length > 0) {
				if(window.whileSending != true){
	               reloadchat(msg,true)
				}
            }
        }
    });
});
function reloadchat(message, clearChat) {
    var url = $(".btn-send-comment").data("url");
    var model = $(".btn-send-comment").data("model");
    var chatid = $(".btn-send-comment").data("chatid");
    $.ajax({
        url: url,
        type: "POST",
        data: {message: message, model: model, chatid: chatid, sessionid: sessionid},
        success: function (html) {
            if (clearChat == true) {
                $("#chat_message").val("");
            }
            $("#chat-box").html(html);
            $("#chat-box").focusToEnd();
        }
    });
}
function headClick()
{ o=$("#main-chat");
 o.hasClass("chat-hide")?o.removeClass("chat-hide").addClass("chat-open"):o.removeClass("chat-open").addClass("chat-hide");
}
/*
setInterval(function () {
cnt_chat=cnt_chat+1;
    reloadchat('', false);
}, 26000);
*/
$(".btn-send-comment").on("click", function () {
    var message = $("#chat_message").val();
    reloadchat(message, true);
});
