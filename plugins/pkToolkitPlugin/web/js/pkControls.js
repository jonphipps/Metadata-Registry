// Copyright 2009 P'unk Avenue LLC. Released under the MIT license.
// See http://www.symfony-project.org/plugins/pkToolkitPlugin and
// http://www.punkave.com/ for more information.

// pkMultipleSelect transforms multiple selection elements into
// attractive, user-friendly replacements. 

// pkRadioSelect transforms single-select elements into a set of pill 
// buttons (you probably won't always want this, it's handy when used 
// selectively). 

// pkSelectToList transforms single-select elements into
// <ul> lists in which the list items set the underlying, hidden
// select element and then immediately submit the form. There is also
// special support for lists of tags with a count in parentheses
// following the tag name in the label, like so: 
//
// <option value="foo">foo (5)</option>

function pkMultipleSelectAll()
{
  $(document).ready(
    function() {
      pkMultipleSelect('body', { } )
    }
  );
}

// Transforms multiple select elements into a much more attractive
// and user-friendly control with a pulldown on the left and links
// to remove already-selected choices on the right

function pkMultipleSelect(target, options)
{
  $(target + ' select[multiple]').each(
    function(i) {
      var name = $(this).attr('name');
      var id = $(this).attr('id');
      var values = [];
      var labels = [];
      var selected = [];
      var j;
      for (j = 0; (j < this.options.length); j++)
      {
        var option = this.options[j];
        values.push(option.value);
        labels.push(option.innerHTML);
        // Firefox is a little cranky about this,
        // try it both ways
        selected.push(option.getAttribute('selected') || option.selected);
      }
      if (id === '')
      {
        // Hopefully unique
        id = name;
      }
      var html = "<div class='pk-multiple-select' id='" + id + "'>";
      html += "<select name='select-" + name + "'>";
      html += "</select>\n";
      for (j = 0; (j < values.length); j++)
      {
        html += "<input type='checkbox' name='" + name + "'";
        if (selected[j])
        {
          html += " checked";
        }
        html += " value=\"" + pkHtmlEscape(values[j]) + 
          "\" style='display: none'/>";
      }
      html += "<ul class='pk-multiple-select-list'>";
      if (!options['remove'])
      {
        options['remove'] = ' <span>Remove</span>';
      }
      for (j = 0; (j < values.length); j++)
      {
        html += "<li style='display: none'><a href='#' title='Remove this item' class='pk-multiple-select-remove'>" + 
          pkHtmlEscape(labels[j]) + 
          options['remove'] + "</a></li>\n";
      }
      html += "</ul>\n";
      // Handy for clearing floats
      html += "<div class='pk-multiple-select-after'></div>\n";
      html += "</div>\n";
      $(this).replaceWith(html);
      var select = $("#" + id + " select");
      var k;
      var items = $('#' + id + ' ul li');
      for (k = 0; (k < values.length); k++)
      {
        $(items[k]).data("boxid", values[k]);
        $(items[k]).click(function() { update($(this).data("boxid")); return false; });
      }
      function update(remove)
      {
        var ul = $("#" + id + " ul");
        var select = $("#" + id + " select")[0];
        var index = select.selectedIndex;
        var value = false;
        if (index > 0)
        {
          value = select.options[index].value;
        }
        var boxes = $('#' + id + " input[type=checkbox]");
        boxes[0].checked = false;
        for (k = 1; (k < values.length); k++)
        {
          if (boxes[k].value === remove)
          {
            boxes[k].checked = false;
          }
          if (boxes[k].value === value)
          {
            boxes[k].checked = true;
          }
        }
        var items = $('#' + id + ' ul li');
        var k;
        var html;
        for (k = 0; (k < values.length); k++)
        {
          if (boxes[k].checked)
          {
            $(items[k]).show();
          }
          else
          {
            $(items[k]).hide();
            html += "<option ";
            if (k == 0)
            {
              // First option is "pick one" message
              html += " selected ";
            }
            html += "value=\"" + pkHtmlEscape(values[k]) + "\">" +
              pkHtmlEscape(labels[k]) + "</option>";
          }
        }
        // Necessary in IE
        $(select).replaceWith("<select name='select-" + name + "'>" + html + "</select>");
        $("#" + id + " select").change(function() { update(false); });
      }
      function pkHtmlEscape(html)
      {
        html = html.replace('&', '&amp;'); 
        html = html.replace('<', '&lt;'); 
        html = html.replace('>', '&gt;'); 
        html = html.replace('"', '&quot;'); 
        return html;
      }  
      update(false);
    }
  );
}

// Transforms select elements matching the specified selector.  
// You won't want to do this to every select element in your form,
// so give them a class like .pk-radio-select and use a class selector like 
// .pkRadioSelect (but not .pk-radio-select-container, which we use for
// the span that encloses our toggle buttons). Make sure your selector is 
// specific enough not to match other elements as well.
//
// We set the pk-radio-option-selected class on the currently selected link
// element.
//
// If the autoSubmit option is true, changing the selection immediately
// submits the form. There are no guarantees that will work with
// wacky AJAX forms. It works fine with normal forms.
//
// Note the getOption calls that allow the use of custom templates.

function pkRadioSelect(target, options)
{
  $(target).each(
    function(i) {
      $(this).hide();
      var html = "";
      var links = "";
      var j;
			var total = this.options.length;
      linkTemplate = getOption("linkTemplate",
        "<a href='#'>_LABEL_</a>");
      spanTemplate = getOption("spanTemplate",
        "<span class='pk-radio-select-container'>_LINKS_</span>");
      betweenLinks = getOption("betweenLinks", " ");
      autoSubmit = getOption("autoSubmit", false);
      for (j = 0; (j < this.options.length); j++)
      {
        if (j > 0)
        {
          links += betweenLinks;
        }
        links += 
          linkTemplate.replace("_LABEL_", $(this.options[j]).html());
      }
      span = $(spanTemplate.replace("_LINKS_", links));
      var select = this;
      links = span.find('a');
      $(links[select.selectedIndex]).addClass('pk-radio-option-selected');
      links.each(
        function (j)
        {
          $(this).data("pkIndex", j);
					$(this).addClass('option-'+j);
					
					if (j == 0)
					{
						$(this).addClass('first');
					}
					
					if (j == total-1)
					{
						$(this).addClass('last');						
					}
          $(this).click(
            function (e)
            {
              select.selectedIndex = $(this).data("pkIndex");
              var parent = ($(this).parent());
              parent.find('a').removeClass('pk-radio-option-selected'); 
              $(this).addClass('pk-radio-option-selected'); 
              if (autoSubmit)
              {
                select.form.submit();
              }
              return false;
            }
          );
        }
      );
      $(this).after(span);
      function getOption(name, def)
      {
        if (name in options)
        {
          return options[name];
        }
        else
        {
          return def;
        }
      }
    }
  );
}

// Simple usage example
// pkSelectToList('#pk-media-type', {} );

// Usage example where the labels are tags with usage counts, with the
// both alphabetical and popular tag lists present and custom labels:

// pkSelectToList('#pk-media-tag', 
//   { 
//     tags: true,
//     // MUST contain an anchor tag so our code can bind the click 
//     currentTemplate: "<h5>_LABEL_ <a href='#'><font color='red'><i>x</i></font></a></h5>",
//     popularLabel: "<h4>Popular Tags</h4>",
//     popular: <?php echo pkMediaTools::getOption('popular_tags') ?>,
//     alpha: true,
//     // If this contains an 'a' tag it gets turned into a toggle 
//     allLabel: "<h4><a href='#'>All Tags</a></h4>",
//     itemTemplate: "_LABEL_ <span>(_COUNT_)",
//     allVisible: false,
//     all: true
//   });

function pkSelectToList(selector, options)
{
  $(selector).each(
    function(i) {
      $(this).hide();
      var total = this.options.length;
      var html = "<ul>";
      var selectElement = this;
      var tags = options['tags'];
      var popular = false;
      var alpha = false;
      var all = true;
      var itemTemplate = options['itemTemplate'];
      if (!itemTemplate)
      {
        if (tags)
        {
          itemTemplate = "_LABEL_ <span>(_COUNT_)";
        }
        else
        {
          itemTemplate = "_LABEL_";
        }
      }
      var currentTemplate;
      if (tags)
      {
        popular = options['popular'];
        all = options['all'];
        alpha = options['alpha'];
      }
      if (options['currentTemplate'])
      {
        currentTemplate = options['currentTemplate'];
      }
      else
      {
        currentTemplate = "<h5>_LABEL_ <a href='#'><font color='red'><i>x</i></font></a></h5>";
      }
      var data = [];
      var re = /^(.*)?\s+\((\d+)\)\s*$/;
      index = -1;
      for (i = 0; (i < total); i++)
      {
        var html = this.options[i].innerHTML;
        if (tags)
        {
          var result = re.exec(html);
          if (result)
          {
            data.push({ 
              label: result[1], 
              count: result[2], 
              value: this.options[i].value
            });
          }
          else
          {
            continue;
          }
        } 
        else
        {
          // Test... carefully... for a non-empty string
          if ((this.options[i].value + '') !== '')
          {
            data.push({
              label: html,
              value: this.options[i].value
            });
          }
          else
          {
            continue;
          }
        }
        if (selectElement.selectedIndex == i)
        {
          // Don't let skipped valueless entries throw off the index
          index = data.length - 1;
        }
      }
      // Make our after() calls in the reverse order so we get
      // the correct final order
      if (all)
      {
        var sorted = data;
        if (alpha)
        {
          sorted = sorted.sort(sortItemsAlpha);
        }
				var lclass = options['listAllClass'];
        var allList = appendList(sorted, lclass);
        if (!options['allVisible'])
        {
          allList.hide();
        }
        if (options['allLabel'])
        {
          var allLabel = $(options['allLabel']);
          if (allLabel)
          {
            var a = allLabel.find('a');
            if (a)
            {
              a.click(function() 
              {
                allList.toggle("slow");
                return false;
              });
            }
          }
          $(selectElement).after(allLabel);
        }
      }
      if (popular)
      {
        var sorted = data;
        sorted = sorted.sort(sortItemsPopular);
        sorted = sorted.slice(0, popular);
        appendList(sorted, options['listPopularClass']);
        if (options['popularLabel'])
        {
          $(selectElement).after($(options['popularLabel']));
        }
      }
      if (index >= 0)
      {
        var current = currentTemplate;
        current = current.replace("_LABEL_", data[index].label);
        current = current.replace("_COUNT_", data[index].count);
        current = $(current);
        var a = current.find('a');
        a.click(function()
        {
          selectElement.selectedIndex = 0;
          $(selectElement.form).submit();
          return false;
        });
        $(selectElement).after(current);
      }
      function appendList(data, c)
      {
        var list = $('<ul></ul>');
        if (c)
        {
          list.addClass(c);
        }
        for (i = 0; (i < data.length); i++)
        {
          var item = itemTemplate;
          if (tags)
          {
            item = item.replace("_COUNT_", data[i].count);
          }
          item = item.replace("_LABEL_", data[i].label);
          var liHtml = "<li><a href='#'>" + item + "</a></li>";
          var li = $(liHtml);
          var a = li.find('a');
          a.data('label', data[i].label);
          a.data('value', data[i].value);
          a.click(function() {
            $(selectElement).val($(this).data('value'));
            $(selectElement.form).submit();
            return false;
          });
          list.append(li);
        }
        $(selectElement).after(list); 
        return list;
      }
    }
  );
  function sortItemsAlpha(a, b)
  {
    x = a.label.toLowerCase();
    y = b.label.toLowerCase();
    // JavaScript has no <> operator 
    return x > y ? 1 :x < y ? -1 : 0;
  }
  function sortItemsPopular(a, b)
  {
    // Most popular should appear first
    return b.count - a.count;
  }
}
