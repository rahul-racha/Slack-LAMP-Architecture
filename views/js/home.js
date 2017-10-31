$(document).ready(function(){
		$(".like").on("click",function(e){
			// console.log("adass");
			emoName = e.currentTarget.className;
			msgId = parseInt(e.currentTarget.id);
			var reactionsArr = {'msgId':msgId,'emoName':emoName};
			$.ajax({
				method: 'post',
				url: './reactions.php',
				data: {'reactionsData':reactionsArr},
				// success: success,
				dataType: 'text',
				success: function(data){
					// console.log(data);
					$.ajax({
						method: 'post',
						url: './reactions.php',
						data: {'checkReactions':reactionsArr},
						dataType: 'text',
						success: function(data){
							$(".likeResponse" + msgId).html(data);
						},
					});

						$(".likeResponse" + msgId).html(data);
							// console.log(data);
			       	// $('#response pre').html( JSON.stringify( data ) );
		    	},
		    	error: function(){
		    		console.log("Error");
		    	}
			});
		});

		$(".dislike").on("click",function(e){
			emoName = e.currentTarget.className;
			console.log(emoName);
			msgId = parseInt(e.currentTarget.id);
			var reactionsArr = {'msgId':msgId,'emoName':emoName};
			$.ajax({
				method: 'post',
				url: './reactions.php',
				data: {'reactionsData':reactionsArr},
				// success: success,
				dataType: 'text',
				success: function(data){
					// console.log(data);
						$('.dislikeResponse' + msgId).html(data);
						$.ajax({
							method: 'post',
							url: './reactions.php',
							data: {'checkReactions':reactionsArr},
							dataType: 'text',
							success: function(data){
								$(".dislikeResponse" + msgId).html(data);
							},
						});
							// console.log(data);
			       	// $('#response pre').html( JSON.stringify( data ) );
		    	},
		    	error: function(){
		    		console.log("Error");
		    	}
			});

		});

		// $(".treadIdSubmit").submit(function(event){
		// 	event.preventDefault();
		// 	$(this)
		// 	$(".MessageHome").removeClass("col-xs-10");
		// 	$(".MessageHome").addClass("col-xs-8");
		//
		// 	// $(".threadDiv").show("slow");
		// 	$(".threadDiv").show();


				// .closest('[class^="MessageHome"]')
				// .removeClass('col-xs-10')
				// .addClass('col-md-8')
				//
				// .siblings('[class^="threadExtension"]')
		    // .removeClass('col-xs-0')
		    // .addClass('col-md-2');
		// });
});
