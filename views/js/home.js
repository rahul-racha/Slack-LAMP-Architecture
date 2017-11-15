
$(document).ready(function(){
		$(".like").on("click",function(e){
			var emoName = e.currentTarget.className;
			var msgId = parseInt(e.currentTarget.id);
			$.ajax({
				method: 'post',
				url: './router.php',
				data: {'insertReaction': {'msgId':msgId, 'emoName':emoName}},
				dataType: 'text',
				success: function(data){
					data = $.parseJSON(data)
					$("#likeResponse" + msgId).html(data['emoResp']['count']);
					var disCount = data['dislikeCount'];
					if (disCount != null) {
						$("#dislikeResponse" + msgId).html(disCount);
					}
		    	},
		    	error: function(){
		    		console.log("Error");
		    	}
			});
		});

		$(".dislike").on("click",function(e){
			var emoName = e.currentTarget.className;
			var msgId = parseInt(e.currentTarget.id);
			$.ajax({
				method: 'post',
				url: './router.php',
				data: {'insertReaction': {'msgId':msgId, 'emoName':emoName, 'isInsert': "true"}},
				dataType: 'text',
				success: function(data){
					 data = $.parseJSON(data)
						$("#dislikeResponse" + msgId).html(data['emoResp']['count']);
						var likeCount = data['likeCount'];
						if (likeCount != null) {
							$("#likeResponse" + msgId).html(likeCount);
						}
		    	},
		    	error: function(){
		    		console.log("Error");
		    	}
			});

		});

		$(".threadIdSubmit").on("click",function(e){
			$(".client_main_continer").removeClass("col-xs-10").addClass("col-xs-7");
			$(".client_thread_display_main").addClass("col-xs-3");
			$(".client_thread_display_main").show();
			var thread_id = parseInt(e.currentTarget.id);
			e.preventDefault();
			$.ajax({
				method: 'post',
				url: './homepage.php',
				data: {'thread_id':thread_id},
				dataType: 'json',
				success: function(data){
					var str="";
					//if(data.length){
						data.forEach(function(e){
							console.log(e);
							// var lastElement = data.length;
							// console.log(lastElement);
							// if(lastElement != data.length){
								str+="<div class='row'><div class='col-xs-4'><b>"+e['user_id']+"</b></div><div class='col-xs-2'></div><div class='col-xs-6'><span>"+e['created_time']+"</span></div></div><br /><div class='row'><div class='col-xs-12'>"+e['message']+"</div></div>";
							//}
							// else{
							// 	str+="<div id='bottom_reply' class='row'><div class='col-xs-4'><b>"+e['user_id']+"</b></div><div class='col-xs-2'></div><div class='col-xs-6'><span>"+e['created_time']+"</span></div></div><br /><div class='row'><div class='col-xs-12'>"+e['message']+"</div></div>";
							// }
						});
					//}
					str+="<div class='row client_thread_reply_entry_area'><div class = 'col-xs-12'><input type='text' class='client_reply_message'><input type='submit' id="+thread_id+" class='client_reply_message_submit'></div></div>";
					$(".client_thread_list").html(str);
				},
				error: function(data){
					console.log(data);
				}
			});
		});

		$(".close_thread_display").on("click",function(e){
			$(".client_thread_display_main").removeClass("col-xs-3");
			$(".client_thread_display_main").hide();
			$(".client_main_continer").removeClass("col-xs-7").addClass("col-xs-10")
		});



		$(document).on("click",".client_reply_message_submit",function(e){
			var channel = $('#retChannel').val();
			var thread_id = parseInt(e.currentTarget.id);
			var reply_message = $('.client_reply_message').val();
			var str="";
			$.ajax({
				method: 'post',
				url: './router.php',
				data: {'thread_insertion':{'channel_name': channel, 'thread_id':thread_id,'reply_message':reply_message}},
				dataType: 'text',
				success: function(data){
					$.ajax({
						method: 'post',
						url: './homepage.php',
						data: {'thread_id':thread_id},
						dataType: 'json',
						success: function(data){
							data.forEach(function(e){
								str+="<div class='row'><div class='col-xs-4'><b>"+e['user_id']+"</b></div><div class='col-xs-2'></div><div class='col-xs-6'><span>"+e['created_time']+"</span></div></div><br /><div class='row'><div class='col-xs-12'>"+e['message']+"</div></div>";
							});
							str+="<div class='row client_thread_reply_entry_area'><div class = 'col-xs-12'><input type='text' class='client_reply_message'><input type='submit' id="+thread_id+" class='client_reply_message_submit'></div></div>";
							$(".client_thread_list").html(str);
						},
					});
				},
			});
		});

		$(".client_user_search").keyup(function(){
			var UserName = $('.client_user_search').val();
			$(".client_user_search_suggestions").show();
			var user_id;
			$.ajax({
				method:'post',
				url:'./router.php',
				data: {'UserName':UserName},
				dataType: 'json',
				success: function(data){
					$('ul.justList').empty();
					data.forEach(function(e){
						user_id = e['user_id'];
						// console.log(user_id);
						if(user_id.length){
							$('<li />', {html:user_id}).appendTo('ul.justList');
						}
					});
				},
			})
		});

});
