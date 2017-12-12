$(document).ready(function(){
  var two_factor_db_value = $('#two_factor_database_value').val();
  var user_id_session = $('#user_id_session').val();
  var user_id_get = $('#user_id_get').val();
  if(user_id_session == user_id_get){
    $("#toggle_button_id").show();
  }else{
    $("#toggle_button_id").hide();
  }
  if(two_factor_db_value == 0){
    $('#toggle-event').bootstrapToggle('on');
  }
  else if(two_factor_db_value == 1){
    $('#toggle-event').bootstrapToggle('off');
  }
  $(function() {
    $('#toggle-event').change(function() {

      // $('#console-event').html('Toggle: ' + $(this).prop('checked'))
      var toggle_value = $(this).prop('checked');
      $.ajax({
        method:'post',
        url: './homepage.php',
        data: {'toggle_value': toggle_value},
        dataType: 'text',
        success: function(data){
        },
        error: function(){
          console.log("Error");
        }
      });

    });
 });
});
