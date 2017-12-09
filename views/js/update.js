$(document).ready(function(){
      $(document).on("click","#profile-pic",function(e) {
      //$("#profile-pic").click(function() {
  			$("input[id='profile-browse']").trigger("click");
  		});

  		$( "#editForm" ).submit(function(event) {
    		event.preventDefault();
  		});

      $(document).on("click","#editForm button[type='submit']",function(e) {
      //$("#editForm button[type='submit']").click(function() {
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

      $("#default-pic-form").submit(function(event) {
        event.preventDefault();
      });

      $(document).on("click","#default-pic-form button[type='submit']",function(e) {
        $("#msg-log-default").empty();
        $.ajax({
          url: $("#default-pic-form").attr("action"),
          type: $("#default-pic-form").attr("method"),
          data: {"default-image-reset": $("#default-profile-pic").attr("src"),
                "profile_id": $("#default-pic-form input[name='profile_id']").attr("value")},
          dataType: 'text',
          success: function(data) {
            if (data == "true") {
              $("#msg-log-default").html("default pic is set successfully!");
            } else {
              $("#msg-log-default").html("failed to set deafult pic :(");
            }
          },
          error: function() {
            console.log("Error");
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
