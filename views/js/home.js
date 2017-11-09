$(document).ready(function(){
		$(".like").on("click",function(e){
			// console.log("adass");
			var emoName = e.currentTarget.className;
			var msgId = parseInt(e.currentTarget.id);
			var reactionsArr = {'msgId':msgId,'emoName':emoName};
			$.ajax({
				method: 'post',
				url: './reactions.php',
				data: {'msgId':msgId, 'emoName':emoName},
				// success: success,
				dataType: 'text',
				success: function(data){
					// console.log(data);
					// $.ajax({
					// 	method: 'post',
					// 	url: './reactions.php',
					// 	data: {'msgId':msgId, 'emoName':emoName},
					// 	dataType: 'text',
					// 	success: function(data){
					// 		$("#likeResponse" + msgId).html(data);
					// 	},
					// });

						$("#likeResponse" + msgId).html(data);
							// console.log(data);
			       	// $('#response pre').html( JSON.stringify( data ) );
		    	},
		    	error: function(){
		    		console.log("Error");
		    	}
			});
		});

		$(".dislike").on("click",function(e){
			var emoName = e.currentTarget.className;
			console.log(emoName);
			var msgId = parseInt(e.currentTarget.id);
			var reactionsArr = {'msgId':msgId,'emoName':emoName};
			$.ajax({
				method: 'post',
				url: './reactions.php',
				data: {'msgId':msgId, 'emoName':emoName},
				// success: success,
				dataType: 'text',
				success: function(data){
					// console.log(data);
						// $('#dislikeResponse' + msgId).html(data);
						// $.ajax({
						// 	method: 'post',
						// 	url: './reactions.php',
						// 	data: {'msgId':msgId, 'emoName':emoName},
						// 	dataType: 'text',
						// 	success: function(data){
						// 		$("#dislikeResponse" + msgId).html(data);
						// 	},
						// });

						$("#dislikeResponse" + msgId).html(data);
							// console.log(data);
			       	// $('#response pre').html( JSON.stringify( data ) );
		    	},
		    	error: function(){
		    		console.log("Error");
		    	}
			});

		});

		$(".threadIdSubmit").on("click",function(e){
			$(".client_main_continer").removeClass("col-xs-10").addClass("col-xs-7");
			$(".client_thread_display_main").show();
			var thread_id = parseInt(e.currentTarget.id);
			$.ajax({
				method: 'post',
				url: './homepage.php',
				data: {'thread_id':thread_id},
				dataType: 'json',
				success: function(data){
					var str="";
					data.forEach(function(e){
						console.log(e);
						str+="<div class='row'><div class='col-xs-4'><b>"+e['user_id']+"</b></div><div class='col-xs-2'></div><div class='col-xs-6'><span>"+e['created_time']+"</span></div></div><br /><div class='row'><div class='col-xs-12'>"+e['message']+"</div></div>";
					});
					$(".client_thread_list").html(str);
				},
			})
		});

		$(".close_thread_dispaly_area").on("click",function(e){
			$(".client_thread_display_main").hide();
			$(".client_main_continer").removeClass("col-xs-7").addClass("col-xs-10")
		});


});
