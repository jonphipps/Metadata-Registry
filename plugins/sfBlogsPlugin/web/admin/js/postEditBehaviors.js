function resizeElement(el)
{
  var top = el.offset().top;
  var wh = $(window).height();
  // Account for margin or border on the splitter container
  var mrg = parseInt(el.css("marginBottom")) || 0;
  var brd = parseInt(el.css("borderBottomWidth")) || 0;
  el.height(wh-top-mrg-brd);
  // IE fires resize for splitter; others don't so do it here
  if ( !jQuery.browser.msie )
    el.trigger("resize");
}
jQuery(function($) {
  // post preview on a new window
  $('ul.buttons li.post_preview input').click(function() {
    $('#edit_object_form').attr('target', 'blogPreview');
  });
  $('ul.buttons li:not(.post_preview)').find('input').click(function() {
    $('#edit_object_form').attr('target', '');
  });
  $('body, #content').css('overflow', 'hidden');
  // Rich text editor
  $('#post_content').wymeditor({
    //we customize the XHTML structure of WYMeditor by overwriting 
    //the value of boxHtml. In this example, "CONTAINERS" and 
    //"CLASSES" have been moved from "wym_area_right" to "wym_area_top":
    boxHtml:  "<div class='wym_box'>"
            + "<div class='wym_area_top'>"
            + WYMeditor.CONTAINERS
            + WYMeditor.TOOLS
            + "</div>"
            + "<div class='wym_area_main'>"
            + WYMeditor.HTML
            + WYMeditor.IFRAME
            + "</div>"
            + "</div>",
    classesHtml: '',
    editorStyles: [
        {'name': 'p,h1,h2,h3,h4,h5,h6,ul,ol,table,blockquote,pre', 'css': 'background: none; padding: 0;max-width:670px'},
        {'name': 'body', 'css': 'background: white;font-family:georgia,"Lucida Grande",arial,helvetica,sans-serif;font-size:15.4px;'}
      ],
    postInit: function(wym) {
      //construct the button's html
       var html = "<li class='wym_tools_newbutton'>"
                + "<a name='NewButton' href='#'"
                + " style='background:"
                + "url(/sfBlogsPlugin/admin/wymeditor/skins/default/icons.png) no-repeat 0 -263px'>"
                + "End excerpt"
                + "</a></li>";
       
       //add the button to the tools box
       $(wym._box)
       .find(wym._options.toolsSelector + wym._options.toolsListSelector)
       .append(html);
       
       //handle click event
       $(wym._box)
       .find('li.wym_tools_newbutton a').click(function() {
           wym.insert('<hr class="end_excerpt"/>');
           return(false);
       });
    }
  });
  // Auto resize of content
  $(window).bind("resize", function(){
      resizeElement($(".wym_box iframe"));
  }).trigger("resize");
  // Hide notice
  $('#notice').fadeOut(4000);
});