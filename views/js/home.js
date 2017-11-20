
$(document).ready(function(){
		if (userRole == "admin") {
			$(".delPost").show();
			$(".fa-trash-o").show();
		} else {
			$(".delPost").hide();
			$(".fa-trash-o").hide();
		}
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

		$(".delPost").on("click", function(e) {
			var channelName = $(".chNameForMsg").attr("value");
			var msgID = parseInt(e.currentTarget.id);
			$.ajax({
				method: 'post',
				url: './router.php',
				data: { 'deletePost' : {'msgID': msgID, 'ch_name': channelName}},
				dataType: 'text',
				success: function(data) {
					if (data == "true") {
						window.location.reload(true);
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
							// console.log(e);
							// var lastElement = data.length;
							// console.log(lastElement);
							// if(lastElement != data.length){
								str+="<div class='row'><div class='col-xs-4'><b>"+e['last_name']+"</b></div><div class='col-xs-2'></div><div class='col-xs-6'><span>"+e['created_time']+"</span></div></div><div class='row'><div class='col-xs-12'>"+e['message']+"</div></div>";
							//}
							// else{
							// 	str+="<div id='bottom_reply' class='row'><div class='col-xs-4'><b>"+e['user_id']+"</b></div><div class='col-xs-2'></div><div class='col-xs-6'><span>"+e['created_time']+"</span></div></div><br /><div class='row'><div class='col-xs-12'>"+e['message']+"</div></div>";
							// }
						});
					//}
					str+="<div class='row client_thread_reply_entry_area'><div class = 'col-xs-12'><input type='text' class='client_reply_message' required><input type='submit' id="+thread_id+" class='client_reply_message_submit'required></div></div>";
					$(".client_thread_list").html(str);
				},
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
							str+="<div class='row client_thread_reply_entry_area'><div class = 'col-xs-12'><input type='text' class='client_reply_message' required><input type='submit' id="+thread_id+" class='client_reply_message_submit'></div></div>";
							$(".client_thread_list").html(str);
						},
					});
				},
			});
		});

		$(".client_user_search").keyup(function(){
			var UserName = $('.client_user_search').val();
			$(".client_user_search_suggestions").show();
			// var p = $( ".client_user_search" );
			// var offset = p.offset();
			// p.html( "left: " + offset.left + ", top: " + offset.top );
			// $(".client_user_search_suggestions").css({
		  //   'width': ($(".client_user_search").width() + '%')
		  // });
			var inp=$(this);
			var user_id;
			$.ajax({
				method:'post',
				url:'./router.php',
				data: {'UserName':UserName},
				dataType: 'json',
				success: function(data){
					console.log(data);
					$('div.client_user_search_suggestions').empty();
					var str = "<ul class='list-group'>";
					data.forEach(function(e){
						user_id = e['user_id'];
						console.log(e);
						// if(user_id.length){
							str += "<li class='list-group-item search_suggestion_li'><a class='sugg_elements' href='./profile.php?userid="+user_id+"'>" + user_id + "</a></li>";
							// $('<li />', {html:user_id}).appendTo('ul.justList');
						// }
					});
					str+= "</ul>"
					$(".client_user_search_suggestions").append(str);
					$('.client_user_search_suggestions').css({
						position:'absolute',
							top:inp.offset().top+25,
							left:inp.offset().left-$('.serch_users_in_workspace').width()+15,
							width:$('.serch_users_in_workspace').width()
					});
				}
			})
		});

		$('body').click(function(){
		    $('.client_user_search_suggestions').hide();
		    // alert('hide');
		})
		// image upload modal preview
		$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {

		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;

		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }

		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();

		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$("#imgInp").change(function(){
		    readURL(this);
		});

		//image upload ajax
		$(".client_add_image_submit_button").on("click",function(e){
			var image_upload_path = $(".client_image_upload_read").val();
			var retChannel = $("#retChannel").val();
			$.ajax({
				method: 'post',
				url: './router.php',
				data: {'image_insertion':{'image_path':image_upload_path,'retChannel':retChannel}},
				dataType: 'text',
				success: function(data){
					// console.log(data);

		    	},
		    	error: function(){
		    		console.log("Error");
		    	}
			});
		});
		// code snippet ajax
		$(".client_snippet_submit").on("click",function(e){
			var snippet_text = $(".client_code_snippet_textarea").val();
			var retChannel = $("#retChannel").val();
			$.ajax({
				method: 'post',
				url: './router.php',
				data: {'snippet_insertion':{'snippet_text':snippet_text,'retChannel':retChannel}},
				dataType: 'text',
				success: function(data){
					console.log(data);

		    	},
		    	error: function(){
		    		console.log("Error");
		    	}
			});
		});


});
