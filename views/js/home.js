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
