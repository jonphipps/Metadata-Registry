jQuery(function($){
  
  // Contextual buttons
  $('#toolbar ul.buttons li.contextual').css('display', 'inline');
  function editSelected() {
    document.location = $('#navigation').data('edit_url');
    return false;
  };
  function deleteSelected() {
    if (confirm(delete_message))
    {
      var id = $("#navigation").data('blog_id');
      $.post(delete_url, {'id' : id }, function() {
        $('#blog_' + id).slideUp();
      });
    }
  };
  
  // Filters
  $('#navigation .level1.blog a').live('click', function(e) {
    $('#preview').html('');
    $('#tree_filter .selected').removeClass('selected');
    $(this).addClass('selected');
    $("#navigation")
      .data('blog_id',  $.getQueryParameter(this.href, 'id'))
      .data('edit_url', this.href);
    $('#toolbar ul.buttons li.contextual').addClass('active');
    $('#toolbar ul.buttons li.blog_edit a').click(editSelected);
    $('#toolbar ul.buttons li.blog_delete a').click(deleteSelected);
    $('#preview').load(preview_url + '?id=' + $("#navigation").data('blog_id'));
    return false;
  });
  $('#navigation .level0 a').click(function() {
    $('#tree_filter .selected').removeClass('selected');
    $("#navigation")
      .data('blog_id',  null)
      .data('edit_url', null);
    $('#toolbar ul.buttons li.contextual').removeClass('active');
    $('#toolbar ul.buttons li.blog_edit a').unbind('click', editSelected);
    $('#toolbar ul.buttons li.blog_delete a').unbind('click', deleteSelected);
    return false;
  });
  $('#navigation .level1.blog a').live('dblclick', function(e) {
    document.location = this.href;
  });
});