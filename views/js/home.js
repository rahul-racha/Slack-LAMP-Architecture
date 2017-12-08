
$(document).ready(function(){
		if (userRole == "admin") {
			$(".delPost").show();
			$(".fa-trash-o").show();
			$("#archiveButton").show();
		} else {
			$(".delPost").hide();
			$(".fa-trash-o").hide();
			$("#archiveButton").hide();
		}

		var archBtnName = $("#archiveButton").text();
		if (archBtnName == "Archive") {
			$("#archiveButton").removeClass("btn btn-danger").addClass("btn btn-primary");
			$('#msg-cont').css('background-color', 'white');
		} else {
			$("#archiveButton").removeClass("btn btn-primary").addClass("btn btn-danger");
			$('#msg-cont').css('background-color', 'darkseagreen');
		}

		$("#archiveButton").on("click",function(e) {
			var status = $("#archiveButton").text();
			var channel = $("#archiveButton").attr("value");
			if (status == "Archive") {
				status = "archived";
			} else {
				status = "unarchived";
			}
			$.ajax({
				method: 'post',
				url: './router.php',
				data: {'channel_status': {'status': status, 'channel': channel}},
				dataType: 'text',
				success: function(data) {
					if (data == "true") {
						var str = null;
						if (status == "archived") {
							str = "Unarchive";
						} else {
							str = "Archive";
						}
						$("#archiveButton").html(str);
						if (str == "Archive") {
							$("#archiveButton").removeClass("btn btn-danger").addClass("btn btn-primary");
							$('#msg-cont').css('background-color', 'white');
						} else {
							$("#archiveButton").removeClass("btn btn-primary").addClass("btn btn-danger");
							$('#msg-cont').css('background-color', 'darkseagreen');
						}
					}
				},
				error: function(){
					console.log("Error");
				}
			});
		});


		var substringMatcher = function(strs) {
		  return function findMatches(q, cb) {
		    var matches, substringRegex;

		    // an array that will be populated with substring matches
		    matches = [];

		    // regex used to determine if a string contains the substring `q`
		    substrRegex = new RegExp(q, 'i');

		    // iterate through the pool of strings and for any string that
		    // contains the substring `q`, add it to the `matches` array
		    $.each(strs, function(i, str) {
		      if (substrRegex.test(str)) {
		        matches.push(str);
		      }
		    });

		    cb(matches);
		  };
		};

		$(document).on("click","#removeUserLink",function(e){
			var channel = $(".delUserClass > :input[name=channel]").val();
			var userList = null;
			$.ajax({
				method: 'post',
				url: './router.php',
				data: {'getUsersForChannel': channel},
				dataType: 'json',
				success: function(data) {
					//$.parseJSON(data);
					console.log(data);
					var userList = data;
					$('#delUsersSearchBox .typeahead').typeahead({
					  hint: true,
					  highlight: true,
					  minLength: 1
					},
					{
					  name: 'userList',
					  source: substringMatcher(userList)
					});
				},
				error: function() {
					console.log("Error");
				}
			});

		});

		$(document).on("click","#inviteUserLink",function(e){
			var channel = $(".inviteUserClass > :input[name=channel]").val();
			var userList = null;
			$.ajax({
				method: 'post',
				url: './router.php',
				data: {'inviteUsersForChannel': channel},
				dataType: 'json',
				success: function(data) {
					//$.parseJSON(data);
					console.log(data);
					var userList = data;
					$('#inviteUsersSearchBox .typeahead').typeahead({
					  hint: true,
					  highlight: true,
					  minLength: 1
					},
					{
					  name: 'userList',
					  source: substringMatcher(userList)
					});
				},
				error: function() {
					console.log("Error");
				}
			});

		});


		$(document).on("click",".like",function(e){
			var emoName = e.currentTarget.className;
			var msgId = parseInt(e.currentTarget.id);
			$.ajax({
				method: 'post',
				url: './router.php',
				//cache: false,
				data: {'insertReaction': {'msgId':msgId, 'emoName':emoName}},
				dataType: 'json',
				success: function(data){
					//data = $.parseJSON(data)
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
		$(document).on("click",".dislike",function(e){
		// $(".dislike").on("click",function(e){
			var emoName = e.currentTarget.className;
			var msgId = parseInt(e.currentTarget.id);
			$.ajax({
				method: 'post',
				url: './router.php',
				//cache: false,
				data: {'insertReaction': {'msgId':msgId, 'emoName':emoName, 'isInsert': "true"}},
				dataType: 'json',
				success: function(data){
					 //data = $.parseJSON(data)
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

		$(document).on("click",".delPost",function(e){
		// $(".delPost").on("click", function(e) {
			var channelName = $(".chNameForMsg").attr("value");
			var msgID = parseInt(e.currentTarget.id);
			var retHeading = $(".delHeading").val();
			var retStatus = $(".delStatus").val();

			$.ajax({
				method: 'post',
				url: './router.php',
				data: { 'deletePostID': msgID, 'channel': channelName, 'channelHeading':
								retHeading, 'chStatus': retStatus},
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

		$(document).on("click",".threadIdSubmit",function(e){
		// $(".threadIdSubmit").on("click",function(e){
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
							if(e["message"] != "" || e["image_path"] != "" || e["snippet"] != ""){
								str+="<div class='row'><div class='col-xs-2'><img src='"+e["avatar"]+"' style='width:40px;'></div>";
								str+= "<div class='col-xs-4'><b>"+e['last_name']+"</b></div><div class='col-xs-6'><span>"+e['created_time']+"</span></div></div>";
								str+= "<div class='row' style='overflow-x:scroll;'><div class='col-xs-12'>";
								if(e["message"] != ""){
									str+= e["message"];
								}
								else if (e["image_path"]) {
									// var uploadedFileName = e["image_path"];
									// var extension = uploadedFileName.replace(/^.*\./, '');
									// if (extension == uploadedFileName) {
					        //   extension = '';
					        // }
									// else {
									// 	extension = extension.toLowerCase();
									// }
									// if(extension == "jpg" || extension == "jpeg" || extension == "png" || extension == "gif"){
										str+= "<img src='"+e["image_path"]+"' style='width:250px;'>";
									//}
								}
								else {
									str+= "<pre><code>"+e["snippet"]+"</code></pre>";
								}
								str+= "</div></div>";
							}
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
								if(e["message"]!= "" || e["image_path"]!= "" || e["snippet"]!= ""){
									str+="<div class='row'><div class='col-xs-2'><img src='"+e["avatar"]+"' style='width:40px;'></div>";
									str+= "<div class='col-xs-4'><b>"+e['last_name']+"</b></div><div class='col-xs-6'><span>"+e['created_time']+"</span></div></div>";
									str+= "<div class='row' style='overflow-x:scroll;'><div class='col-xs-12'>";
									if(e["message"] != ""){
										str+= e["message"];
									}
									else if (e["image_path"]) {
										// var uploadedFileName = e["image_path"];
										// var extension = uploadedFileName.replace(/^.*\./, '');
										// if (extension == uploadedFileName) {
						        //   extension = '';
						        // }
										// else {
										// 	extension = extension.toLowerCase();
										// }
										// if(extension == "jpg" || extension == "jpeg" || extension == "png" || extension == "gif"){
											str+= "<img src='"+e["image_path"]+"' style='width:250px;'>";
										//}
									}
									else {
										str+= "<pre><code>"+e["snippet"]+"</code></pre>";
									}
									str+= "</div></div>";
								}
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
					$('div.client_user_search_suggestions').empty();
					var str = "<ul class='list-group'>";
					data.forEach(function(e){
						user_id = e['user_id'];
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

		//web image - ajax
		$(document).on("click",".client_web_image_submit_button",function(e) {
		//$(".client_web_image_submit_button").on("click",function(e) {
			$("#client_web_image_to_post #msg-log").html();
			var image_upload_from_url_path = $(".client_image_upload_from_url").val();
			if ($.trim(image_upload_from_url_path) != "") {
				var retChannel = $("#client_web_image_to_post #retChannel").val();
				var retHeading = $("#client_web_image_to_post #retHeading").val();
				var retStatus = $("#client_web_image_to_post #retStatus").val();

				$.ajax({
					method: 'post',
					url: './router.php',
					//data: {'image_insertion_from_url':{'image_upload_from_url_path':image_upload_from_url_path,'retChannel':retChannel}},
					data: {'image_upload_from_url_path': image_upload_from_url_path,'channel':retChannel, 'channelHeading': retHeading,
								'chStatus': retStatus},
					dataType: 'text',
					success: function(data){
						if (data != null && data != "") {
							window.location.href='./home.php';
						} else {
							//to do: display error msg
						}
			    	},
			    	error: function(){
			    		console.log("Error");
							//$("#client_web_image_to_post #msg-log").html("file type invalid");
			    	}
				});
			}
		});

		$("#uploadImageForm").submit(function(event) {
			event.preventDefault();
		});

		//upload image
		$(".client_upload_image_submit_button").on("click",function(e) {
			var image_upload_path = $(".client_image_upload_read").val();
			if($.trim(image_upload_path) != "")
			{
				var retChannel = $("#client_upload_image_to_post #retChannel").val();
				var retHeading = $("#client_upload_image_to_post #retHeading").val();
				var retStatus = $("#client_upload_image_to_post #retStatus").val();

				//var file_data = $('#client_upload_image_to_post #imgInp').files[0];
				var form_data = new FormData($('#uploadImageForm')[0]);

				// form_data.append("localfile", file_data);
				// form_data.append("channel", retChannel);
				// form_data.append("channelHeading", retHeading);
				// form_data.append("chStatus", retStatus);

				$.ajax({
					method: 'post',
					url: './router.php',
					data: form_data,
					//data: {'image_insertion':{'image_path':image_upload_path,'retChannel':retChannel}},
					cache: false,
					contentType: false,
					processData: false,
					dataType: 'json',
					success: function(data) {
						if (data['result'] == "true") {
							window.location.href='./home.php';
						} else {
							console.log(data["message"]);
						}
						},
						error: function(){
							console.log("Error");
						}
				});
			}
		});

		// code snippet ajax
		$(".client_snippet_submit").on("click",function(e){
			var snippet_text = $(".client_code_snippet_textarea").val();

			var retChannel = $("#client_code_snippet #retChannel").val();
			var retHeading = $("#client_code_snippet #retHeading").val();
			var retStatus = $("#client_code_snippet #retStatus").val();

			$.ajax({
				method: 'post',
				url: './router.php',
				data: {'snippet_text':snippet_text,'channel':retChannel, 'channelHeading': retHeading,
							'chStatus': retStatus},
				dataType: 'text',
				success: function(data){
					window.location.href='./home.php';
		    	},
		    	error: function(){
		    		console.log("Error");
		    	}
			});
		});

		// post load pagination
		$(document).on("click",".client_posts_load_more",function(e){
		// $(".client_posts_load_more").on("click",function(e){
			var retChannel = parseInt($(".post_load_retChannel").val());
			var Channel_name = $(".post_load_ret_channel_name").val();
			$.ajax({
				method:'post',
				url: './homepage.php',
				data: {'pagination':{'retChannel':retChannel,'Channel_name':Channel_name}},
				dataType: 'text',
				success: function(data){
					$('.loadMoreButton').remove();
					$(".client_message_display").prepend(data);
					if (userRole == "admin") {
						$(".delPost").show();
						$(".fa-trash-o").show();
						$("#archiveButton").show();
					} else {
						$(".delPost").hide();
						$(".fa-trash-o").hide();
						$("#archiveButton").hide();
					}
		    },
		    error: function(){
		    	console.log("Error");
		    }
			});
		});

});
