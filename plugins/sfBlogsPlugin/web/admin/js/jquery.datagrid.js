;(function($){
  
$.fn.datagrid = function(options) {
  
  // Merge options with default settings
  var settings = $.extend({
    container: 'body',
    idStartsAt: 0,
    select: function() {},
    blur: function() {},
    click: function() {},
    dblclick: function() {}
  }, options);
  
  var container = $(settings.container);
  
  return this.each(function() {
    
    var main_table = $(this);
    
    // Fixed table header
    var table_header = main_table
      .clone()
      .find('tbody').remove().end()
      .attr('id', 'fixed_header')
      .css({ position: 'absolute', top: 0, background: 'white' })
      .insertBefore(main_table);
    container.scroll(function() {
      table_header.css('top', $(this).scrollTop() + 'px');
    });
    
    // Ajax sort
    table_header.find('thead th').live('click', function() {
       var target = $(this);
       var href = target.find('a').attr('href');
       if(href)
       {
         $('#sort').val($.getQueryParameter(href, 'sort'));
         var type = target.hasClass('desc') ? 'asc' : (target.hasClass('asc') ? 'desc' : $.getQueryParameter(href, 'type'));
         $('#type').val(type);
         target.find('a').blur();
         $(".items", main_table).trigger('refreshList');
         target
           .parent()
             .find('.desc').removeClass('desc').end()
             .find('.asc').removeClass('asc').end()
            .end()
            .addClass(type);
         return false;
       }
    });
    
    // Contextual actions (using custom event)
    $('.items', main_table).bind('selectRow', function(e, id) {
      if(id)
      {
        // highlight line
        $('table.list tr.selected').removeClass('selected');
        $('table.list tr#post_' + id).addClass('selected');
        return settings.select(id);
      }
      else
      {
        // unhighlight line
        $('table.list tr.selected').removeClass('selected');
        return settings.blur();
      }
    });
    
    // Click actions
    function clickHandler(e) {
      var id = this.id.substr(settings.idStartsAt);
      $('.items', main_table).trigger('selectRow', [id]);
      e.stopPropagation();
      return settings[e.type](id, $(this));
    };
    main_table.find('tbody tr').live('click', clickHandler).live('dblclick', clickHandler);
    // Also handle click outside the table to deselect
    $('#list').click(function(e){
      if($(e.target).closest('table').size() == 0)
      {
        $('.items', main_table).trigger('selectRow');
      }
    });
  });
};

})(jQuery);