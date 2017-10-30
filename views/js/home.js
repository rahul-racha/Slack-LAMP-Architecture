$(document).ready(function(){
		$(".like").on("click",function(e){
			console.log("adass");
			emoName = e.currentTarget.className;
			msgId = parseInt(e.currentTarget.id);
			isInsert = "true";
			var reactionsArr = {'msgId':msgId,'emoName':emoName,'isInsert':isInsert};
			$.ajax({
				method: 'post',
				url: './reactions.php',
				data: {'reactionsData':reactionsArr},
				// success: success,
				dataType: 'text',
				success: function(data){
					console.log(data);
					
			       	// $('#response pre').html( JSON.stringify( data ) );
		    	},
		    	error: function(){
		    		console.log("Error");
		    	}
			});
		});
		// body...
		// alert(e);
		// $homeControlVar = new HomeController();
		// $homeControlVar->getRepliesForThread(e);
		// var data1 = {'msg_id':msg_id,'user_email':user_email,'emoji_id':emoji_id};

});

