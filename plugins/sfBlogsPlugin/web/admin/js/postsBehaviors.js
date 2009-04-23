jQuery(function($){
  function clearSelection() {
     var sel ;
     if(document.selection && document.selection.empty)
     {
       document.selection.empty();
     } 
     else if(window.getSelection)
     {
       sel=window.getSelection();
       if(sel && sel.removeAllRanges) sel.removeAllRanges();
     }
  }
  
  // Preview pane
  $('#list').height(150).css('min-height', '60px');
  $("#content")
    .css('overflow', 'hidden')
    .splitter({
      splitHorizontal: true,
      sizeTop: true,
      cookie: 'preview'
    });
  $('#preview').css('overflow', 'auto');
  
  // Filters
  $('#post_filter_form').submit(function() {
    $("#list .items").trigger('refreshList');
    return false;
  });
  $('#filters_text')
    .change(function() {
      $("#list .items").trigger('refreshList');
    })
    .click(function() {
      if($(this).val() == initial_search) $(this).val('');
    });
  $('#navigation a').live('click', function(e) {
      if ($(this).hasClass('tag'))
      {
        $("#filters_tag").val($.getQueryParameter(this.href, 'filters[tag]'));
      }
      else if ($(this).hasClass('blog'))
      {
        $("#filters_blog_id").val($.getQueryParameter(this.href, 'filters[blog_id]'));
      }
      else if ($(this).hasClass('filter_is_published'))
      {
        $("#filters_is_published").val($.getQueryParameter(this.href, 'filters[is_published]'));
      }
      $('#navigation').trigger('selectFilter');
      $("#list .items").trigger('refreshList');
      return false;
  });
  $('#navigation')
    .bind('selectFilter', function() {
      $("#tree_filter a.selected").removeClass('selected');
      $('#filter_blog_' + $("#filters_blog_id").val()).addClass('selected');
      $('#filter_tag_'  + $("#filters_tag").val()).addClass('selected');
      $('#filter_is_published_'  + $("#filters_is_published").val()).addClass('selected');
    })
    .trigger('selectFilter');
  
  // Contextual buttons
  var buttonList = $('#toolbar ul.buttons');
  $('li.contextual', buttonList).css('display', 'inline');
  function editSelected() {
    document.location = $('#content table.list tr#post_' + $(this).parent().parent().data('id') + ' a').attr('href');
    return false;
  };
  function deleteSelected() {
    if (confirm(delete_message))
    {
      var id = buttonList.data('id');
      $.post(delete_url, {'id' : id }, function() {
        $('#content table.list tr#post_' + id).slideUp();
      });
    }
  };
  function publishSelected() {
    if (confirm(publish_message))
    {
      var id = buttonList.data('id');
      $.post(publish_url, {'id' : id }, function(data) {
        $('#content table.list tr#post_' + id).replaceWith(data);
        $('#list .items').trigger('selectRow', [id]);
      });
    }
  };
  
  // Datagrid
  $('#list table').datagrid({
    container: '#list',
    idStartsAt: 5,        // tr ids look like post_123, so the real id starts at 5
    // contextual buttons
    select: function(id) {
      // Change buttons target
      buttonList.data('id', id);
      // Add click handlers
      $('li.contextual', buttonList).addClass('active');
      $('li.contextual.post_edit a').click(editSelected);
      $('li.contextual.post_delete a').click(deleteSelected);
      $('li.contextual.publish a').click(publishSelected);
      // Change publish / unpublish button
      if($('table.list tr.selected').hasClass('draft'))
      {
        $('li.contextual.publish', buttonList)
          .addClass('draft')
          .find('a').text('Publish');
      }
      else
      {
        $('li.contextual.publish', buttonList)
          .removeClass('draft')
          .find('a').text('Unpublish');
      }
    },
    blur: function() {
      // disable contexual buttons
      $('#toolbar ul.buttons li.contextual.active').removeClass('active').find('a').unbind('click');
    },
    // preview
    click: function(id) {
      $('#preview').html('').load(preview_url, { 'id': id });
      return false;
    },
    // edition
    dblclick: function(id, target) {
      clearSelection();
      $('#loader').show();
      document.location = target.find('a').attr('href');
      return false;
    }
  });
  
  // Autopager
  $('#list .items').autopager({
    container:  '#list',
    listHeader: '#list thead',
    url:         $('form.filter').attr('action'),
    form:       'form.filter'
  });
});