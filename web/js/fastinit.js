/*
*
* Copyright (c) 2007 Andrew Tetlaw
* 
* Permission is hereby granted, free of charge, to any person
* obtaining a copy of this software and associated documentation
* files (the "Software"), to deal in the Software without
* restriction, including without limitation the rights to use, copy,
* modify, merge, publish, distribute, sublicense, and/or sell copies
* of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
* 
* The above copyright notice and this permission notice shall be
* included in all copies or substantial portions of the Software.
* 
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
* EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
* MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
* NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS
* BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
* ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
* CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
* * 
*
*
* FastInit
* http://tetlaw.id.au/view/javascript/fastinit
* Andrew Tetlaw
* Version 1.3 (2007-01-09)
* Based on:
* http://dean.edwards.name/weblog/2006/03/faster
* http://dean.edwards.name/weblog/2006/06/again/
* Help from:
* http://www.cherny.com/webdev/26/domloaded-object-literal-updated
* 
*/
var FastInit = {
	done : false,
	onload : function() {
		if (FastInit.done) return;
		FastInit.done = true;
		FastInit.actions.each(function(func) {
			func();
		})
	},
	actions : $A([]),
	addOnLoad : function() {
		for(var x = 0; x < arguments.length; x++) {
			var func = arguments[x];
			if(!func || typeof func != 'function') continue;
			FastInit.actions.push(func);
		}
	},
	listen : function() {
		if (/WebKit|khtml/i.test(navigator.userAgent)) {
			FastInit._timer = setInterval(function() {
				if (/loaded|complete/.test(document.readyState)) {
					clearInterval(FastInit._timer);
					delete FastInit._timer;
					FastInit.onload();
				}
			}, 10);
		} else if (document.addEventListener) {
			document.addEventListener('DOMContentLoaded', FastInit.onload, false);
		} else if(!FastInit._iew32) {
			Event.observe(window, 'load', FastInit.onload);
		}
	},
	_timer : null,
	_iew32 : false
}
/*@cc_on @*/
/*@if (@_win32)
FastInit._iew32 = true;
document.write('<script id="__ie_onload" defer src="' + ((location.protocol == 'https:') ? '//0' : 'javascript:void(0)') + '"><\/script>');
$('__ie_onload').onreadystatechange = function(){if (this.readyState == 'complete') FastInit.onload();};
/*@end @*/
FastInit.listen();
