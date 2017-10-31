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

		$(".treadIdSubmit").submit(function(event){
			event.preventDefault();
			$(this)
			$(".MessageHome").removeClass("col-xs-10");
			$(".MessageHome").addClass("col-xs-8");

			// $(".threadDiv").show("slow");
			$(".threadDiv").show();


				// .closest('[class^="MessageHome"]')
				// .removeClass('col-xs-10')
				// .addClass('col-md-8')
				//
				// .siblings('[class^="threadExtension"]')
		    // .removeClass('col-xs-0')
		    // .addClass('col-md-2');
		});
});
