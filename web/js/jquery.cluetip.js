/*
 * jQuery clueTip plugin
 * Version 0.8.2  (08/09/2007)
 * @requires jQuery v1.1.1
 * @requires Dimensions plugin 
 *
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 *
 * @name clueTip
 * @type jQuery
 * @cat Plugins/tooltip
 * @return jQuery
 * @author Karl Swedberg
 */
 
 /*
 * @credit Inspired by Cody Lindley's jTip (http://www.codylindley.com)
 * @credit Thanks to Shelane Enos for the feature ideas 
 * @credit Thanks to Glen Lipka, Jörn Zaefferer, and Dan G. Switzer for their expert advice
 * @credit Thanks to Jonathan Chaffer, as always, for help with the hard parts. :-)
 */

 /**
 * 
 * Displays a highly customizable tooltip when the user hovers (default) or clicks (optional) the matched element. 
 * By default, the clueTip plugin loads a page indicated by the "rel" attribute via ajax and displays its contents.
 * If a "title" attribute is specified, its value is used as the clueTip's heading.
 * The attribute to be used for both the body and the heading of the clueTip is user-configurable. 
 * Optionally, the clueTip's body can display content from an element on the same page.
 * * Just indicate the element's id (e.g. "#some-id") in the rel attribute.
 * Optionally, the clueTip's body can display content from the title attribute, when a delimiter is indicated. 
 * * The string before the first instance of the delimiter is set as the clueTip's heading.
 * * All subsequent strings are wrapped in separate DIVs and placed in the clueTip's body.
 * The clueTip plugin allows for many, many more options. Pleasee see the examples and the option descriptions below...
 * 
 * 
 * @example $('#tip).cluetip();
 * @desc This is the most basic clueTip. It displays a 275px-wide clueTip on mouseover of the element with an ID of "tip." On mouseout, the clueTip is hidden.
 *
 *
 * @example $('a.clue').cluetip({
 *  hoverClass: 'highlight',
 *  sticky: true,
 *  closePosition: 'bottom',
 *  closeText: '<img src="cross.png" alt="close" />',
 *  truncate: 60,
 *  ajaxSettings: {
 *    type: 'POST'
 *  }
 * });
 * @desc Displays a clueTip on mouseover of all <a> elements with class="clue". The hovered element gets a class of "highlight" added to it (so that it can be styled appropriately. This is esp. useful for non-anchor elements.). The clueTip is "sticky," which means that it will not be hidden until the user either clicks on its "close" text/graphic or displays another clueTip. The "close" text/graphic is set to diplay at the bottom of the clueTip (default is top) and display an image rather than the default "Close" text. Moreover, the body of the clueTip is truncated to the first 60 characters, which are followed by an ellipsis (...). Finally, the clueTip retrieves the content using POST rather than the $.ajax method's default "GET."
 * 
 *
 *
 * @param Object defaults (optional) Customize your clueTips
 * @option Number width: default is 275. The width of the clueTip
 * @option Boolean local: default is false. Whether to use content from the same page (using ID) for clueTip body
 * @option Boolean hideLocal: default is true. If local option is set to true, determine whether local content to be shown in clueTip should be hidden at its original location. 
 * @option String attribute default is 'rel'. The attribute to be used for the URL of the ajaxed content
 * @option String titleAttribute: default is 'title'. The attribute to be used for the clueTip's heading, if the attribute exists for the hovered element.
 * @option String splitTitle: default is '' (empty string). A character used to split the title attribute into the clueTip title and divs within the clueTip body; if used, the clueTip will be populated only by the title attribute, 
 * @option String hoverClass: default is empty string. designate one to apply to the hovered element
 * @option String waitImage: default is 'wait.gif'. set it to '' or false to avoid having the plugin try to show/hide the image.
 * @option Boolean sticky: default is false. Set to true to keep the clueTip visible until the user either closes it manually by clicking on the CloseText or display another clueTip.
 * @option String activation: default is 'hover'. Set to 'toggle' to force the user to click the element in order to activate the clueTip.
 * @option String closePosition: default is 'top'. Set to 'bottom' to put the closeText at the bottom of the clueTip body
 * @option String closeText: default is 'Close'. This determines the text to be clicked to close a clueTip when sticky is set to true.
 * @option Number truncate: default is 0. Set to some number greater than 0 to truncate the text in the body of the clueTip. This also removes all HTML/images from the clueTip body.
 * @option Boolean hoverIntent: default is true. If jquery.hoverintent.js plugin is included in <head>, hoverIntent() will be used instead of hover()
 * @option Boolean arrows: Default is false. Sets background-position-y to line up an arrow background image with the hovered element.
 * @option Boolean dropShadow: Default is true. Adds a drop shadow to the clueTip. Default is true
 * @option Object ajaxProcess: Default is function(data) { data = $(data).not('style, meta, link, script, title); return data; } . When getting clueTip content via ajax, allows processing of it before it's displayed. The default value strips out elements typically found in the <head> that might interfere with current page.
 * @option Object ajaxSettings: allows you to pass in standard $.ajax() parameters for specifying dataType, error, success, etc. Default is { dataType: 'html'}
 *
 */

(function($) { 
    
  var $cluetip, $cluetipInner, $cluetipOuter, $cluetipTitle, $dropShadow;
  var msie6 = $.browser.msie && ($.browser.version && $.browser.version < 7 || (/5\.5|6.0/).test(navigator.userAgent));
  $.fn.cluetip = function(options) {
    
    // set up default options
    var defaults = {
      width: 275,
      local: false,
      hideLocal: true,
      attribute: 'rel',
      titleAttribute: 'title',
      splitTitle: '',
      showTitle: true,
      cluetipClass: 'default',
      hoverClass: '',
      waitImage: 'wait.gif',
      cursor: 'help',
      arrows: false, // CHANGE THIS TO true IF YOU WANT jTip-STYLE ARROWS FOR ALL clueTips
      dropShadow: true,
      dropShadowSteps: 6,
      sticky: false,
      activation: 'hover',
      closePosition: 'top',
      closeText: 'Close',
      truncate: 0,
      cluezIndex: 97,
      positionBy: 'auto', // CHANGES THIS TO mouse TO FORCE CLUETIP TO BE POSITIONED NEXT TO THE MOUSE
      fx: {
        open: 'fadeIn',
        openSpeed: 'fast',
        close: 'hide',
        closeSpeed: ''
      },
      hoverIntent: true,
      onShow: function (ct, c){},      
      ajaxProcess: function(data) {
        data = $(data).not('style, meta, link, script, title');
        return data;
      },
      ajaxSettings: {
        dataType: 'html'
      }
    };
    
    if (options && options.ajaxSettings) {
      $.extend(defaults.ajaxSettings, options.ajaxSettings);
      delete options.ajaxSettings;
    }
    if (options && options.fx) {
      $.extend(defaults.fx, options.fx);
      delete options.fx;
    }
    
    $.extend(defaults, options);
    
    return this.each(function() {
      // start out with no contents (for ajax activation)
      var cluetipContents = false;
      var cluezIndex = parseInt(defaults.cluezIndex, 10)-1;
      var isActive = false;
      
      // create the cluetip divs
      if (!$cluetip) {
        $cluetipInner = $('<div id="cluetip-inner"></div>');
        $cluetipTitle = $('<h3 id="cluetip-title"></h3>');        
        $cluetipOuter = $('<div id="cluetip-outer"></div>').append($cluetipInner).prepend($cluetipTitle);
        $cluetip = $('<div></div>')
          .attr({'id': 'cluetip'})
          .css({zIndex: defaults.cluezIndex})
        .append($cluetipOuter)
        .appendTo('body')
        .hide();
        $('<img src="' + defaults.waitImage + '" />')
          .attr({'id': 'cluetip-waitimage'})
          .css({position: 'absolute', zIndex: cluezIndex-1})
        .insertBefore('#cluetip')
        .hide();
        $cluetip.css({position: 'absolute', zIndex: cluezIndex});
        $cluetipOuter.css({position: 'relative', zIndex: cluezIndex+1});
      }
      var dropShadowSteps = (defaults.dropShadow) ? +defaults.dropShadowSteps : 0;
      // if (!$dropShadow && defaults.dropShadow) {
      if (!$dropShadow) {
        $dropShadow = $([]);
        for (var i=0; i < dropShadowSteps; i++) {
          $dropShadow = $dropShadow.add($('<div></div>').css({zIndex: cluezIndex-i-1, opacity:.1, top: 1+i, left: 1+i}));
        };
        $dropShadow.css({position: 'absolute', backgroundColor: '#000'})
          .prependTo($cluetip);
      }

      var $this = $(this);      
      var tipAttribute = $this.attr(defaults.attribute), ctClass = defaults.cluetipClass;
      if (!tipAttribute && !defaults.splitTitle) return true;
      // if hideLocal is set to true, initially hide the local content that will be displayed in the clueTip
      if (defaults.local && defaults.hideLocal) { $(tipAttribute).hide(); }
      // vertical measurement variables
      var tipHeight, wHeight;
      var sTop, linkTop, posY, tipY, mouseY;
      // horizontal measurement variables
      
      var tipWidth = parseInt(defaults.width, 10) + parseInt($cluetip.css('paddingLeft')) + parseInt($cluetip.css('paddingRight')) + dropShadowSteps;
      if( isNaN(tipWidth) ) tipWidth = 275;
      var linkWidth = this.offsetWidth;
      var linkLeft, posX, tipX, mouseX, winWidth;
            
      // parse the title
      var tipParts;
      var tipTitle = (defaults.attribute != 'title') ? $this.attr(defaults.titleAttribute) : '';
      if (defaults.splitTitle) {
        tipParts = tipTitle.split(defaults.splitTitle);
        tipTitle = tipParts.shift();
      }
      var localContent;

/***************************************      
* ACTIVATION
****************************************/
    
//activate clueTip
    var activate = function(event) {
      isActive = true;
      if (tipAttribute == $this.attr('href')) {
        $this.css('cursor', defaults.cursor);
      }
      //$this.removeAttr('title');
      $this.attr('title','');
      if (defaults.hoverClass) {
        $this.addClass(defaults.hoverClass);
      }
      linkTop = posY = $this.offset().top;
      linkLeft = $this.offset().left;
      mouseX = event.pageX;
      mouseY = event.pageY;
      if ($this[0].tagName.toLowerCase() != 'area') {
        sTop = $(document).scrollTop();
        winWidth = $(window).width();
// position clueTip horizontally
        posX = (linkWidth > linkLeft && linkLeft > tipWidth)
          || linkLeft + linkWidth + tipWidth > winWidth 
          ? linkLeft - tipWidth - 15 
          : linkWidth + linkLeft + 15;
      }
      $cluetip.removeClass().css({width: defaults.width});
      if ($this.css('display') == 'block' || $this[0].tagName.toLowerCase() == 'area' || defaults.positionBy == 'mouse') { // position by mouse
        if (mouseX + 20 + tipWidth > winWidth) {
          posX = (mouseX - tipWidth - 20) >= 0 ? mouseX - tipWidth - 20 :  mouseX - (tipWidth/2);
        } else {
          posX = mouseX + 20;
        }
        var pY = posX < 0 ? event.pageY + 20 : event.pageY;
      }

      posX < linkLeft ? $cluetip.addClass('clue-left-' + ctClass).removeClass('clue-right-' + ctClass)
      : $cluetip.addClass('clue-right-' + ctClass).removeClass('clue-left-' + ctClass);                
      $cluetip.css({left: (posX > 0) ? posX :( mouseX + (tipWidth/2) > winWidth) ? winWidth/2 - tipWidth/2 : Math.max(mouseX - (tipWidth/2),0)});
      wHeight = $(window).height();

/***************************************
* load the title attribute only (or user-selected attribute). 
* clueTip title is the string before the first delimiter
* subsequent delimiters place clueTip body text on separate lines
***************************************/
      if (tipParts) {
        for (var i=0; i < tipParts.length; i++){
          if (i == 0) {
            $cluetipInner.html(tipParts[i]);
          } else { 
            $cluetipInner.append('<div class="split-body">' + tipParts[i] + '</div>');
          }            
        };
        cluetipShow(pY);
      }
/***************************************
* load external file via ajax          
***************************************/
      else if (!defaults.local && tipAttribute.indexOf('#') != 0) {
        if (cluetipContents) {
          $cluetipInner.html(cluetipContents);
          cluetipShow(pY);
        }
        else {
          var ajaxSettings = defaults.ajaxSettings;
          ajaxSettings.url = tipAttribute;
          ajaxSettings.beforeSend = function() {
            if (defaults.waitImage) {
              $('#cluetip-waitimage')
              .css({top: mouseY-10, left: parseInt(posX+(tipWidth/2),10)})
              .show();
            }
          };
          ajaxSettings.success = function(data) {
            cluetipContents = defaults.ajaxProcess(data);
            if (isActive) {
              $cluetipInner.html(cluetipContents);
              cluetipShow(pY);
            }
            $('#cluetip-waitimage').hide();
          };
          $.ajax(ajaxSettings);
        }

/***************************************
* load an element from the same page
***************************************/
      } else if (defaults.local && tipAttribute.indexOf('#') == 0){
        var localContent = $(tipAttribute).html();
        $cluetipInner.html(localContent);
        cluetipShow(pY);
      }
    };

// get dimensions and options for cluetip and prepare it to be shown
    var cluetipShow = function(bpY) {
      $cluetip.addClass('cluetip-' + ctClass);
      
      if (defaults.truncate) { 
        var $truncloaded = $cluetipInner.text().slice(0,defaults.truncate) + '...';
        $cluetipInner.html($truncloaded);
      }

      tipTitle ? $cluetipTitle.show().html(tipTitle) : (defaults.showTitle) ? $cluetipTitle.show().html('&nbsp;') : $cluetipTitle.hide();
      if (defaults.sticky) {
        var $closeLink = $('<div id="cluetip-close"><a href="#">' + defaults.closeText + '</a></div>');
        (defaults.closePosition == 'bottom') ? $closeLink.appendTo($cluetipInner) : (defaults.closePosition == 'title') ? $closeLink.prependTo($cluetipTitle) : $closeLink.prependTo($cluetipInner);
        $closeLink.click(function() {
          cluetipClose();
          return false;
        });
      }
// now that content is loaded, finish the positioning      
      tipHeight = $cluetip.outerHeight();
      tipY = posY;
      if ( posX < mouseX && Math.max(posX, 0) + tipWidth > mouseX ) {
        tipY = posY + tipHeight > sTop + wHeight && mouseY - sTop > tipHeight + 10 ? mouseY - tipHeight - 10 : mouseY + 20;
      } else if ( posY + tipHeight > sTop + wHeight ) {
        tipY = (tipHeight >= wHeight) ? sTop : sTop + wHeight - tipHeight - 10;
      } else if ($this.css('display') == 'block' || $this[0].tagName.toLowerCase() == 'area' || defaults.positionBy == "mouse") {
        tipY = bpY - 10;
      } else {
        tipY = posY - defaults.dropShadowSteps;
      } 
      $cluetip.css({top: tipY + 'px'});

      if (defaults.arrows) {
        var bgPos = '0 0';
        var bgY = (posY - tipY - defaults.dropShadowSteps);
        if ($cluetip.is('.clue-left-' + ctClass)) {
          bgPos = posX >=0 ? '100% ' + bgY + 'px' : '100% 0';
        } else if ($cluetip.is('.clue-right-' +ctClass)) {
          bgPos = (posX >=0 && bgY > 0) ? '0 ' + bgY + 'px' : '0 0';
        }        
      } else {
        bgPos = '0 100%';
      }
      $cluetip.css({backgroundPosition: bgPos});

// (first hide, then) ***SHOW THE CLUETIP***
      $cluetip.hide()[defaults.fx.open](defaults.fx.openSpeed);
      if ($dropShadow) {
        defaults.dropShadow ? $dropShadow.show().css({height: tipHeight, width: defaults.width}) : $dropShadow.hide();
      }
      // trigger the optional onShow function
      defaults.onShow($cluetip, $cluetipInner);
    };

/***************************************
   =INACTIVATION
-------------------------------------- */
    var inactivate = function() {
      isActive = false;
      $('#cluetip-waitimage').hide();
      if (!defaults.sticky) {
        cluetipClose();
      };
      if (defaults.hoverClass) {
        $this.removeClass(defaults.hoverClass);
      }
    };
// close cluetip and reset title attribute if one exists
    var cluetipClose = function() {
      $cluetipOuter 
      .parent()[defaults.fx.close](defaults.fx.closeSpeed).removeClass().end()
      .children().empty();

      if (tipTitle) {
        $this.attr('title', tipTitle);
      }
    };

/***************************************
   =BIND EVENTS
-------------------------------------- */
  // activate by click
      if (defaults.activation == 'click'||defaults.activation == 'toggle') {
        $this.click(function(event) {
          if ($cluetip.is(':hidden')) {
            activate(event);
          } else {
            inactivate(event);
          }
          this.blur();
          return false;
        });
  // activate by hover
    // clicking is returned false if cluetip url is same as href url
      } else {
        $this.click(function() {
          if (tipAttribute == $this.attr('href')) {
            return false;
          }
        });

        $this[($.fn.hoverIntent) && defaults.hoverIntent ? 'hoverIntent' : 'hover'](function(event) {
          activate(event);
        }, function(event) {
          inactivate(event);
        });
      }
    });
  };
})(jQuery);