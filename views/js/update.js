$(document).ready(function(){
  		$("#profile-pic").click(function() {
  			$("input[id='profile-browse']").trigger("click");
  		});

  		$( "#editForm" ).submit(function(event) {
    		event.preventDefault();
  		});

      $("button[type='submit']").click(function() {
        //document.getElementById("editForm").submit()
        $("#message").empty();
        $("#message").html("loading");
        var formData = new FormData($("#editForm")[0]);
        $.ajax({
          url: $("#editForm").attr("action"),
          type: $("#editForm").attr("method"),
          data: formData,
          //async: false,
          contentType: false,
          cache: false,
          processData: false,
          dataType: 'json',
          success: function(data) {
            //data = $.parseJSON(data);
            console.log(data);
            $("#message").empty();
            if (data["result"] == "true") {
              $("#message").html(data["message"]);
            } else {
              $("#profile-pic").attr("src","images/users/default-avatar.png");
              $("#message").html(data["message"]);
            }
          }
        });
      });
  	// function readURL(input) {
  	//
    // 	if (input.files && input.files[0]) {
    //   	var reader = new FileReader();
  	//
    //   	reader.onload = function(e) {
    //     	$('#').attr('src', e.target.result);
    //   	}
  	//
    //   	reader.readAsDataURL(input.files[0]);
    // 	}
  	// }
  		//$("#profilePic").change(function(){
          //readURL(this);
      //});
});


var  loadFile  = function (event) {
 var output = document.getElementById('profile-pic');
 output.src = URL.createObjectURL(event.target.files[0]);
}
