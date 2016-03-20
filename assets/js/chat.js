var cnt_chat=0;
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
        }
    });
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
