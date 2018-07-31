(function(){

	var user;
        var language;
	var messages = [];
        var users = [];

	var my_messages_template = Handlebars.compile($('#my-messages-template').html());
        var other_messages_template = Handlebars.compile($('#other-messages-template').html());
        var online_user_template = Handlebars.compile($('#online-user-template').html());

	function updateMessages(msg){
		messages.push(msg);
		var messages_html = other_messages_template(msg);
		$('.chat_box_area_messages').html($('.chat_box_area_messages').html()+messages_html);
		$(".chat_box_area_messages").animate({ scrollTop: $('.chat_box_area_messages')[0].scrollHeight}, 1000);
	}
        
        function updateMyMessages(msg){
		messages.push(msg);
                console.log(messages);
		var messages_html = my_messages_template(msg);
		$('.chat_box_area_messages').html($('.chat_box_area_messages').html()+messages_html);
		$(".chat_box_area_messages").animate({ scrollTop: $('.chat_box_area_messages')[0].scrollHeight}, 1000);
	}

        function updateUsers(msg){
            var new_user = {
                'username' : msg.user,
                'language' : msg.lang
            };
            users.push(new_user);
            var user_html = online_user_template({'users':users});
            $('.chat_box_user_online_wrapper').html(user_html);
            
        }
        
	var conn = new WebSocket('ws://localhost:8080');
	conn.onopen = function(e) {
	    console.log("Connection established!");
            console.log(conn);
	};

	conn.onmessage = function(e) {
		var msg = JSON.parse(e.data);
                if(msg.type === "new user"){
                    updateUsers(msg);
                }
		updateMessages(msg);
	};


	$('#start-chat').click(function(e){
                e.preventDefault();
		user = $('#username').val();
                language = $('#language').val();
		$('.init-window').addClass('hide');
		$('.chat-window').removeClass('hide');

		var msg = {
			'user': user,
			'text': user + ' entered the room',
			'time': moment().format('hh:mm a'),
                        'lang': 'en',
                        
                        'type': 'new user'
		};

		updateMyMessages(msg);
		conn.send(JSON.stringify(msg));
		$('#user').val('');
	});


	$('#send').click(function(e){
            e.preventDefault();
		var text = $('#msg-text').val();
		var msg = {
			'user': user,
			'text': text,
			'time': moment().format('hh:mm a'),
                        'lang':language,
                        'type':'new msg'
		};
		updateMyMessages(msg);
		conn.send(JSON.stringify(msg));

		$('#msg-text').val('');
	});


	$('#end-chat').click(function(e){
		e.preventDefault();
		var msg = {
			'user': user,
			'text': user + ' has left the room',
			'time': moment().format('hh:mm a'),
                        'language':'en',
                        'type':'end chat'
		};
		updateMyMessages(msg);
		conn.send(JSON.stringify(msg));
                conn.close();
		$('.chat_box_area_messages').html('');
		messages = [];

                $('.chat-window').addClass('hide');
		$('.init-window').removeClass('hide');
		
	});

})();