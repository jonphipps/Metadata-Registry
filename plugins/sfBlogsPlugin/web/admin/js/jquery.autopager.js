;(function($){

$.getQueryParameter = function (url, name) {
  url = url.substr(url.indexOf('?') + 1);
  var pairs = url.split('&');
  var i, res;
  for(i in pairs)
  {
    res = pairs[i];
    if(res.indexOf(name) === 0)
    {
      return res.substr(name.length + 1);
    }
  }
}
  
$.fn.autopager = function(options) {
  
  // Merge options with default settings
  var settings = $.extend({
    listHeader:   'thead',
    container:    '#list',
    url:          '', 
    form:         '',
    triggerMargin: 50,
    debug:         false
  }, options);
  
  var container = $(settings.container);
  
  return this.each(function() {
  
    var items = $(this);
  
    items.bind('refreshList', function(e, page){
      if(!container.data('loading'))
      {
        if(typeof(page) == "undefined")
        {
          // replace current list content
          items.html('').trigger('selectRow');
          var pageParam = '';
        }
        else
        {
          // add to existing table
          var pageParam = (settings.url.indexOf('?') == -1 ? '?' : '&') + 'page=' + page;
        }
        if(settings.debug)
        {
          console.log('{Autopager::refreshList} page: ' + pageParam);
        }
        container.data('loading', true);
        $.get(settings.url + pageParam, jQuery(settings.form).serializeArray(), function(data){
          container.data('loading', false);
          items.append(data);
        });
      }
    });
  
    container
      .data('loading', false)
      .bind('watchScroll', function(){
        if(settings.debug)
        {
          console.log('{Autopager::watchScroll} items.height: ' + (items.height() + $(settings.listHeader).height()) + ' - (container.scrollTop: ' + container.scrollTop() + ' + container.height:' + container.height() + ') = scrollBottom: ' + (items.height() + $(settings.listHeader).height() - (container.scrollTop() + container.height())));
        }

        if (current_page < max_page)
        {
          var scrollBottom = items.height() + $(settings.listHeader).height() - (container.scrollTop() + container.height());
          if (scrollBottom <  settings.triggerMargin)
          {
            items.trigger('refreshList', [current_page + 1]);
          }
        }
      })
      .scroll(function(){
        container.trigger('watchScroll')
      })
      .resize(function(){
        container.trigger('watchScroll')
      })
      .ready(function(){
        container.trigger('watchScroll')
      });
  });
};

})(jQuery);