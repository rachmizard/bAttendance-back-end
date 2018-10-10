var username;

$(document).ready(function()
{
	username = $('#username').html();

	pullData();
	$(document).keyup(function(e){
		if (e.keyCode == 13)
			sendMessage();
	});
});

function sendMessage()
{
	var text = $('#text').val();
	if (text.length > 0) 
	{
		$.post('http://127.0.0.1:8000/personal-messages', {text: text, username: username}, function()
		{
			$('#chat-window').append('<br><div style="text-align: right;">'+ text +'</div><br>');
			$('text').val('');
		});
	}
}

function pullData()
{
	retrieveChatMessages();
	setTimeout(pullData,3000);
}

function retrieveChatMessages()
{

	$.post('http://127.0.0.1:8000/retrieveChatMessages', function(data)
	{
		if (data.length > 0) 
		{
			
		}
	});
}
