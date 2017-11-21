
$(document).ready(function(){
  $(".help_links_action0").on("click",function(e){
    $("#Channels").hide();
    $("#help_workspace").show();
  });
  $(".help_links_action1").on("click",function(e){
    $("#help_workspace").hide();
    $("#Channels").show();
  });
  $(".help_links_action2").on("click",function(e){
    $("#Channels").hide();
    $("#help_workspace").hide();
    $("#messages").show();
  });
});
