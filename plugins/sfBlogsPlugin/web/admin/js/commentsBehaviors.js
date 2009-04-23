jQuery(function($){
  
  // Filters
  $('#comment_filter_form').submit(function(){
    $("#list .items").trigger('refreshList');
    return false;
  });
  $('#filters_text')
    .change(function(){
      $("#list .items").trigger('refreshList');
    })
    .click(function(){
      if($(this).val() == initial_search) $(this).val('');
    });
  $('#navigation a').live('click', function(){
    if ($(this).hasClass('filter_blog'))
    {
      $("#filters_parent_id").val($.getQueryParameter(this.href, 'filters[parent_id]'));
    }
    else if ($(this).hasClass('filter_status'))
    {
      $("#filters_status").val($.getQueryParameter(this.href, 'filters[status]'));
    };

    $('#navigation').trigger('selectFilter');
    $("#list .items").trigger('refreshList');
    return false;
  });
  $('#navigation')
    .bind('selectFilter', function(){
      $("#tree_filter a.selected").removeClass('selected');
      $('#filter_' + $("#filters_parent_id").val()).addClass('selected');
      $('#filter_status_'  + $("#filters_status").val()).addClass('selected');
    })
    .trigger('selectFilter');
  
  // Comment actions
  $('#list ul.comment_actions a').live('click', function(e) {
    var id = '#' + $(this).parents('div.comment').attr('id');
    $.ajax({
      type: 'POST',
      url: this.href,
      success: function(data) {
        if(data)
          $(id).replaceWith(data);
        else
          $(id).slideUp();
        if($(this).hasClass('decrease'))
        {
          nb_results_element = $("#nb_results");
          nb_results_element.html(nb_results_element.html() - 1)
        }
      }
    });
    return false;
  });
  
  // Autopager
  $('#list .items').autopager({
    container:  '#content',
    listHeader: '#list list_details',
    url:         $('form.filter').attr('action'),
    form:       'form.filter'
  });
});