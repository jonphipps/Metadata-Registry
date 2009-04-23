jQuery(function($){
  
  // Hide notice
  $('#notice').fadeOut(4000);
  
  $('a.ajax_removable').click(function(){
    var link = $(this);
    $.post(link.attr('href'), function(){ link.parent().slideUp(); });
    return false;
  });
});