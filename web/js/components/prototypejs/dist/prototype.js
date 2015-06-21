/**
 * @preserve
 * Prototype JavaScript framework, version 1.7.1
 *  (c) 2005-2010 Sam Stephenson
 *
 *  Prototype is freely distributable under the terms of an MIT-style license.
 *  For details, see the Prototype web site: http://www.prototypejs.org/
 *
 *--------------------------------------------------------------------------*/
/*
 * Prototype JavaScript framework, version 1.7.1
 *  (c) 2005-2010 Sam Stephenson
 *
 *  Prototype is freely distributable under the terms of an MIT-style license.
 *  For details, see the Prototype web site: http://www.prototypejs.org/
 *
 *--------------------------------------------------------------------------*/
var Prototype = {
  Version: '1.7.1',
  Browser: (function(){
    var ua = navigator.userAgent;
    // Opera (at least) 8.x+ has "Opera" as a [[Class]] of `window.opera`
    // This is a safer inference than plain boolean type conversion of `window.opera`
    var isOpera = Object.prototype.toString.call(window.opera) == '[object Opera]';
    return {
      IE:             !!window.attachEvent && !isOpera,
      Opera:          isOpera,
      WebKit:         ua.indexOf('AppleWebKit/') > -1,
      Gecko:          ua.indexOf('Gecko') > -1 && ua.indexOf('KHTML') === -1,
      MobileSafari:   /Apple.*Mobile/.test(ua)
    }
  })(),
  BrowserFeatures: {
    XPath: !!document.evaluate,
    SelectorsAPI: !!document.querySelector,
    ElementExtensions: (function() {
      var constructor = window.Element || window.HTMLElement;
      return !!(constructor && constructor.prototype);
    })(),
    SpecificElementExtensions: (function() {
      // First, try the named class
      if (typeof window.HTMLDivElement !== 'undefined')
        return true;
      var div = document.createElement('div'),
          form = document.createElement('form'),
          isSupported = false;
      if (div['__proto__'] && (div['__proto__'] !== form['__proto__'])) {
        isSupported = true;
      }
      div = form = null;
      return isSupported;
    })()
  },
  ScriptFragment: '<script[^>]*>([\\S\\s]*?)<\/script\\s*>',
  JSONFilter: /^\/\*-secure-([\s\S]*)\*\/\s*$/,
  emptyFunction: function() { },
  K: function(x) { return x }
};
if (Prototype.Browser.MobileSafari)
  Prototype.BrowserFeatures.SpecificElementExtensions = false;
/* Based on Alex Arnell's inheritance implementation. */
var Class = (function() {
  
  // Some versions of JScript fail to enumerate over properties, names of which 
  // correspond to non-enumerable properties in the prototype chain
  var IS_DONTENUM_BUGGY = (function(){
    for (var p in { toString: 1 }) {
      // check actual property name, so that it works with augmented Object.prototype
      if (p === 'toString') return false;
    }
    return true;
  })();
  
  function subclass() {};
  function create() {
    var parent = null, properties = $A(arguments);
    if (Object.isFunction(properties[0]))
      parent = properties.shift();
    function klass() {
      this.initialize.apply(this, arguments);
    }
    Object.extend(klass, Class.Methods);
    klass.superclass = parent;
    klass.subclasses = [];
    if (parent) {
      subclass.prototype = parent.prototype;
      klass.prototype = new subclass;
      parent.subclasses.push(klass);
    }
    for (var i = 0, length = properties.length; i < length; i++)
      klass.addMethods(properties[i]);
    if (!klass.prototype.initialize)
      klass.prototype.initialize = Prototype.emptyFunction;
    klass.prototype.constructor = klass;
    return klass;
  }
  function addMethods(source) {
    var ancestor   = this.superclass && this.superclass.prototype,
        properties = Object.keys(source);
    // IE6 doesn't enumerate `toString` and `valueOf` (among other built-in `Object.prototype`) properties,
    // Force copy if they're not Object.prototype ones.
    // Do not copy other Object.prototype.* for performance reasons
    if (IS_DONTENUM_BUGGY) {
      if (source.toString != Object.prototype.toString)
        properties.push("toString");
      if (source.valueOf != Object.prototype.valueOf)
        properties.push("valueOf");
    }
    for (var i = 0, length = properties.length; i < length; i++) {
      var property = properties[i], value = source[property];
      if (ancestor && Object.isFunction(value) &&
          value.argumentNames()[0] == "$super") {
        var method = value;
        value = (function(m) {
          return function() { return ancestor[m].apply(this, arguments); };
        })(property).wrap(method);
        
        // We used to use `bind` to ensure that `toString` and `valueOf`
        // methods were called in the proper context, but now that we're 
        // relying on native bind and/or an existing polyfill, we can't rely
        // on the nuanced behavior of whatever `bind` implementation is on
        // the page.
        //
        // MDC's polyfill, for instance, doesn't like binding functions that
        // haven't got a `prototype` property defined.
        value.valueOf = (function(method) {
          return function() { return method.valueOf.call(method); };
        })(method);
        
        value.toString = (function(method) {
          return function() { return method.toString.call(method); };
        })(method);
      }
      this.prototype[property] = value;
    }
    return this;
  }
  return {
    create: create,
    Methods: {
      addMethods: addMethods
    }
  };
})();
(function() {
  var _toString = Object.prototype.toString,
      _hasOwnProperty = Object.prototype.hasOwnProperty,
      NULL_TYPE = 'Null',
      UNDEFINED_TYPE = 'Undefined',
      BOOLEAN_TYPE = 'Boolean',
      NUMBER_TYPE = 'Number',
      STRING_TYPE = 'String',
      OBJECT_TYPE = 'Object',
      FUNCTION_CLASS = '[object Function]',
      BOOLEAN_CLASS = '[object Boolean]',
      NUMBER_CLASS = '[object Number]',
      STRING_CLASS = '[object String]',
      ARRAY_CLASS = '[object Array]',
      DATE_CLASS = '[object Date]',
      NATIVE_JSON_STRINGIFY_SUPPORT = window.JSON &&
        typeof JSON.stringify === 'function' &&
        JSON.stringify(0) === '0' &&
        typeof JSON.stringify(Prototype.K) === 'undefined';
        
  
  
  var DONT_ENUMS = ['toString', 'toLocaleString', 'valueOf',
   'hasOwnProperty', 'isPrototypeOf', 'propertyIsEnumerable', 'constructor'];
  
  // Some versions of JScript fail to enumerate over properties, names of which 
  // correspond to non-enumerable properties in the prototype chain
  var IS_DONTENUM_BUGGY = (function(){
    for (var p in { toString: 1 }) {
      // check actual property name, so that it works with augmented Object.prototype
      if (p === 'toString') return false;
    }
    return true;
  })();
        
  function Type(o) {
    switch(o) {
      case null: return NULL_TYPE;
      case (void 0): return UNDEFINED_TYPE;
    }
    var type = typeof o;
    switch(type) {
      case 'boolean': return BOOLEAN_TYPE;
      case 'number':  return NUMBER_TYPE;
      case 'string':  return STRING_TYPE;
    }
    return OBJECT_TYPE;
  }
  
  function extend(destination, source) {
    for (var property in source)
      destination[property] = source[property];
    return destination;
  }
  function inspect(object) {
    try {
      if (isUndefined(object)) return 'undefined';
      if (object === null) return 'null';
      return object.inspect ? object.inspect() : String(object);
    } catch (e) {
      if (e instanceof RangeError) return '...';
      throw e;
    }
  }
  function toJSON(value) {
    return Str('', { '': value }, []);
  }
  function Str(key, holder, stack) {
    var value = holder[key];
    if (Type(value) === OBJECT_TYPE && typeof value.toJSON === 'function') {
      value = value.toJSON(key);
    }
    var _class = _toString.call(value);
    switch (_class) {
      case NUMBER_CLASS:
      case BOOLEAN_CLASS:
      case STRING_CLASS:
        value = value.valueOf();
    }
    switch (value) {
      case null: return 'null';
      case true: return 'true';
      case false: return 'false';
    }
    var type = typeof value;
    switch (type) {
      case 'string':
        return value.inspect(true);
      case 'number':
        return isFinite(value) ? String(value) : 'null';
      case 'object':
        for (var i = 0, length = stack.length; i < length; i++) {
          if (stack[i] === value) {
            throw new TypeError("Cyclic reference to '" + value + "' in object");
          }
        }
        stack.push(value);
        var partial = [];
        if (_class === ARRAY_CLASS) {
          for (var i = 0, length = value.length; i < length; i++) {
            var str = Str(i, value, stack);
            partial.push(typeof str === 'undefined' ? 'null' : str);
          }
          partial = '[' + partial.join(',') + ']';
        } else {
          var keys = Object.keys(value);
          for (var i = 0, length = keys.length; i < length; i++) {
            var key = keys[i], str = Str(key, value, stack);
            if (typeof str !== "undefined") {
               partial.push(key.inspect(true)+ ':' + str);
             }
          }
          partial = '{' + partial.join(',') + '}';
        }
        stack.pop();
        return partial;
    }
  }
  function stringify(object) {
    return JSON.stringify(object);
  }
  function toQueryString(object) {
    return $H(object).toQueryString();
  }
  function toHTML(object) {
    return object && object.toHTML ? object.toHTML() : String.interpret(object);
  }
  function keys(object) {
    if (Type(object) !== OBJECT_TYPE) { throw new TypeError(); }
    var results = [];
    for (var property in object) {
      if (_hasOwnProperty.call(object, property))
        results.push(property);
    }
    
    // Account for the DontEnum properties in affected browsers.
    if (IS_DONTENUM_BUGGY) {
      for (var i = 0; property = DONT_ENUMS[i]; i++) {
        if (_hasOwnProperty.call(object, property))
          results.push(property);
      }
    }
    
    return results;
  }
  function values(object) {
    var results = [];
    for (var property in object)
      results.push(object[property]);
    return results;
  }
  function clone(object) {
    return extend({ }, object);
  }
  function isElement(object) {
    return !!(object && object.nodeType == 1);
  }
  function isArray(object) {
    return _toString.call(object) === ARRAY_CLASS;
  }
  
  var hasNativeIsArray = (typeof Array.isArray == 'function') 
    && Array.isArray([]) && !Array.isArray({});
  
  if (hasNativeIsArray) {
    isArray = Array.isArray;
  }
  function isHash(object) {
    return object instanceof Hash;
  }
  function isFunction(object) {
    return _toString.call(object) === FUNCTION_CLASS;
  }
  function isString(object) {
    return _toString.call(object) === STRING_CLASS;
  }
  function isNumber(object) {
    return _toString.call(object) === NUMBER_CLASS;
  }
  
  function isDate(object) {
    return _toString.call(object) === DATE_CLASS;
  }
  function isUndefined(object) {
    return typeof object === "undefined";
  }
  extend(Object, {
    extend:        extend,
    inspect:       inspect,
    toJSON:        NATIVE_JSON_STRINGIFY_SUPPORT ? stringify : toJSON,
    toQueryString: toQueryString,
    toHTML:        toHTML,
    keys:          Object.keys || keys,
    values:        values,
    clone:         clone,
    isElement:     isElement,
    isArray:       isArray,
    isHash:        isHash,
    isFunction:    isFunction,
    isString:      isString,
    isNumber:      isNumber,
    isDate:        isDate,
    isUndefined:   isUndefined
  });
})();
Object.extend(Function.prototype, (function() {
  var slice = Array.prototype.slice;
  function update(array, args) {
    var arrayLength = array.length, length = args.length;
    while (length--) array[arrayLength + length] = args[length];
    return array;
  }
  function merge(array, args) {
    array = slice.call(array, 0);
    return update(array, args);
  }
  function argumentNames() {
    var names = this.toString().match(/^[\s\(]*function[^(]*\(([^)]*)\)/)[1]
      .replace(/\/\/.*?[\r\n]|\/\*(?:.|[\r\n])*?\*\//g, '')
      .replace(/\s+/g, '').split(',');
    return names.length == 1 && !names[0] ? [] : names;
  }
  function bind(context) {
    if (arguments.length < 2 && Object.isUndefined(arguments[0]))
      return this;
    if (!Object.isFunction(this))
      throw new TypeError("The object is not callable.");
      
    var nop = function() {};
    var __method = this, args = slice.call(arguments, 1);
    
    var bound = function() {
      var a = merge(args, arguments);
      // Ignore the supplied context when the bound function is called with
      // the "new" keyword.
      var c = this instanceof bound ? this : context;
      return __method.apply(c, a);
    };
        
    nop.prototype   = this.prototype;
    bound.prototype = new nop();
    return bound;
  }
  function bindAsEventListener(context) {
    var __method = this, args = slice.call(arguments, 1);
    return function(event) {
      var a = update([event || window.event], args);
      return __method.apply(context, a);
    }
  }
  function curry() {
    if (!arguments.length) return this;
    var __method = this, args = slice.call(arguments, 0);
    return function() {
      var a = merge(args, arguments);
      return __method.apply(this, a);
    }
  }
  function delay(timeout) {
    var __method = this, args = slice.call(arguments, 1);
    timeout = timeout * 1000;
    return window.setTimeout(function() {
      return __method.apply(__method, args);
    }, timeout);
  }
  function defer() {
    var args = update([0.01], arguments);
    return this.delay.apply(this, args);
  }
  function wrap(wrapper) {
    var __method = this;
    return function() {
      var a = update([__method.bind(this)], arguments);
      return wrapper.apply(this, a);
    }
  }
  function methodize() {
    if (this._methodized) return this._methodized;
    var __method = this;
    return this._methodized = function() {
      var a = update([this], arguments);
      return __method.apply(null, a);
    };
  }
  
  var extensions = {
    argumentNames:       argumentNames,
    bindAsEventListener: bindAsEventListener,
    curry:               curry,
    delay:               delay,
    defer:               defer,
    wrap:                wrap,
    methodize:           methodize
  };
  
  if (!Function.prototype.bind)
    extensions.bind = bind;
  return extensions;
})());
(function(proto) {
  
  
  function toISOString() {
    return this.getUTCFullYear() + '-' +
      (this.getUTCMonth() + 1).toPaddedString(2) + '-' +
      this.getUTCDate().toPaddedString(2) + 'T' +
      this.getUTCHours().toPaddedString(2) + ':' +
      this.getUTCMinutes().toPaddedString(2) + ':' +
      this.getUTCSeconds().toPaddedString(2) + 'Z';
  }
  
  function toJSON() {
    return this.toISOString();
  }
  
  if (!proto.toISOString) proto.toISOString = toISOString;
  if (!proto.toJSON) proto.toJSON = toJSON;
  
})(Date.prototype);
RegExp.prototype.match = RegExp.prototype.test;
RegExp.escape = function(str) {
  return String(str).replace(/([.*+?^=!:${}()|[\]\/\\])/g, '\\$1');
};
var PeriodicalExecuter = Class.create({
  initialize: function(callback, frequency) {
    this.callback = callback;
    this.frequency = frequency;
    this.currentlyExecuting = false;
    this.registerCallback();
  },
  registerCallback: function() {
    this.timer = setInterval(this.onTimerEvent.bind(this), this.frequency * 1000);
  },
  execute: function() {
    this.callback(this);
  },
  stop: function() {
    if (!this.timer) return;
    clearInterval(this.timer);
    this.timer = null;
  },
  onTimerEvent: function() {
    if (!this.currentlyExecuting) {
      // IE doesn't support `finally` statements unless all errors are caught.
      // We mimic the behaviour of `finally` statements by duplicating code
      // that would belong in it. First at the bottom of the `try` statement
      // (for errorless cases). Secondly, inside a `catch` statement which
      // rethrows any caught errors.
      try {
        this.currentlyExecuting = true;
        this.execute();
        this.currentlyExecuting = false;
      } catch(e) {
        this.currentlyExecuting = false;
        throw e;
      }
    }
  }
});
Object.extend(String, {
  interpret: function(value) {
    return value == null ? '' : String(value);
  },
  specialChar: {
    '\b': '\\b',
    '\t': '\\t',
    '\n': '\\n',
    '\f': '\\f',
    '\r': '\\r',
    '\\': '\\\\'
  }
});
Object.extend(String.prototype, (function() {
  var NATIVE_JSON_PARSE_SUPPORT = window.JSON &&
    typeof JSON.parse === 'function' &&
    JSON.parse('{"test": true}').test;
  function prepareReplacement(replacement) {
    if (Object.isFunction(replacement)) return replacement;
    var template = new Template(replacement);
    return function(match) { return template.evaluate(match) };
  }
  function gsub(pattern, replacement) {
    var result = '', source = this, match;
    replacement = prepareReplacement(replacement);
    if (Object.isString(pattern))
      pattern = RegExp.escape(pattern);
    if (!(pattern.length || pattern.source)) {
      replacement = replacement('');
      return replacement + source.split('').join(replacement) + replacement;
    }
    while (source.length > 0) {
      match = source.match(pattern);
      if (match && match[0].length > 0) {
        result += source.slice(0, match.index);
        result += String.interpret(replacement(match));
        source  = source.slice(match.index + match[0].length);
      } else {
        result += source, source = '';
      }
    }
    return result;
  }
  function sub(pattern, replacement, count) {
    replacement = prepareReplacement(replacement);
    count = Object.isUndefined(count) ? 1 : count;
    return this.gsub(pattern, function(match) {
      if (--count < 0) return match[0];
      return replacement(match);
    });
  }
  function scan(pattern, iterator) {
    this.gsub(pattern, iterator);
    return String(this);
  }
  function truncate(length, truncation) {
    length = length || 30;
    truncation = Object.isUndefined(truncation) ? '...' : truncation;
    return this.length > length ?
      this.slice(0, length - truncation.length) + truncation : String(this);
  }
  function strip() {
    return this.replace(/^\s+/, '').replace(/\s+$/, '');
  }
  function stripTags() {
    return this.replace(/<\w+(\s+("[^"]*"|'[^']*'|[^>])+)?>|<\/\w+>/gi, '');
  }
  function stripScripts() {
    return this.replace(new RegExp(Prototype.ScriptFragment, 'img'), '');
  }
  function extractScripts() {
    var matchAll = new RegExp(Prototype.ScriptFragment, 'img'),
        matchOne = new RegExp(Prototype.ScriptFragment, 'im');
    return (this.match(matchAll) || []).map(function(scriptTag) {
      return (scriptTag.match(matchOne) || ['', ''])[1];
    });
  }
  function evalScripts() {
    return this.extractScripts().map(function(script) { return eval(script); });
  }
  function escapeHTML() {
    return this.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
  }
  function unescapeHTML() {
    // Warning: In 1.7 String#unescapeHTML will no longer call String#stripTags.
    return this.stripTags().replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&amp;/g,'&');
  }
  function toQueryParams(separator) {
    var match = this.strip().match(/([^?#]*)(#.*)?$/);
    if (!match) return { };
    return match[1].split(separator || '&').inject({ }, function(hash, pair) {
      if ((pair = pair.split('='))[0]) {
        var key = decodeURIComponent(pair.shift()),
            value = pair.length > 1 ? pair.join('=') : pair[0];
        if (value != undefined) {
          value = value.gsub('+', ' ');
          value = decodeURIComponent(value);
        }
        if (key in hash) {
          if (!Object.isArray(hash[key])) hash[key] = [hash[key]];
          hash[key].push(value);
        }
        else hash[key] = value;
      }
      return hash;
    });
  }
  function toArray() {
    return this.split('');
  }
  function succ() {
    return this.slice(0, this.length - 1) +
      String.fromCharCode(this.charCodeAt(this.length - 1) + 1);
  }
  function times(count) {
    return count < 1 ? '' : new Array(count + 1).join(this);
  }
  function camelize() {
    return this.replace(/-+(.)?/g, function(match, chr) {
      return chr ? chr.toUpperCase() : '';
    });
  }
  function capitalize() {
    return this.charAt(0).toUpperCase() + this.substring(1).toLowerCase();
  }
  function underscore() {
    return this.replace(/::/g, '/')
               .replace(/([A-Z]+)([A-Z][a-z])/g, '$1_$2')
               .replace(/([a-z\d])([A-Z])/g, '$1_$2')
               .replace(/-/g, '_')
               .toLowerCase();
  }
  function dasherize() {
    return this.replace(/_/g, '-');
  }
  function inspect(useDoubleQuotes) {
    var escapedString = this.replace(/[\x00-\x1f\\]/g, function(character) {
      if (character in String.specialChar) {
        return String.specialChar[character];
      }
      return '\\u00' + character.charCodeAt().toPaddedString(2, 16);
    });
    if (useDoubleQuotes) return '"' + escapedString.replace(/"/g, '\\"') + '"';
    return "'" + escapedString.replace(/'/g, '\\\'') + "'";
  }
  function unfilterJSON(filter) {
    return this.replace(filter || Prototype.JSONFilter, '$1');
  }
  function isJSON() {
    var str = this;
    if (str.blank()) return false;
    str = str.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@');
    str = str.replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']');
    str = str.replace(/(?:^|:|,)(?:\s*\[)+/g, '');
    return (/^[\],:{}\s]*$/).test(str);
  }
  function evalJSON(sanitize) {
    var json = this.unfilterJSON(),
        cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;
    if (cx.test(json)) {
      json = json.replace(cx, function (a) {
        return '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4);
      });
    }
    try {
      if (!sanitize || json.isJSON()) return eval('(' + json + ')');
    } catch (e) { }
    throw new SyntaxError('Badly formed JSON string: ' + this.inspect());
  }
  
  function parseJSON() {
    var json = this.unfilterJSON();
    return JSON.parse(json);
  }
  function include(pattern) {
    return this.indexOf(pattern) !== -1;
  }
  function startsWith(pattern, position) {
    position = Object.isNumber(position) ? position : 0;
    // We use `lastIndexOf` instead of `indexOf` to avoid tying execution
    // time to string length when string doesn't start with pattern.
    return this.lastIndexOf(pattern, position) === position;
  }
  function endsWith(pattern, position) {
    pattern = String(pattern);
    position = Object.isNumber(position) ? position : this.length;
    if (position < 0) position = 0;
    if (position > this.length) position = this.length;
    var d = position - pattern.length;
    // We use `indexOf` instead of `lastIndexOf` to avoid tying execution
    // time to string length when string doesn't end with pattern.
    return d >= 0 && this.indexOf(pattern, d) === d;
  }
  function empty() {
    return this == '';
  }
  function blank() {
    return /^\s*$/.test(this);
  }
  function interpolate(object, pattern) {
    return new Template(this, pattern).evaluate(object);
  }
  return {
    gsub:           gsub,
    sub:            sub,
    scan:           scan,
    truncate:       truncate,
    // Firefox 3.5+ supports String.prototype.trim
    // (`trim` is ~ 5x faster than `strip` in FF3.5)
    strip:          String.prototype.trim || strip,
    stripTags:      stripTags,
    stripScripts:   stripScripts,
    extractScripts: extractScripts,
    evalScripts:    evalScripts,
    escapeHTML:     escapeHTML,
    unescapeHTML:   unescapeHTML,
    toQueryParams:  toQueryParams,
    parseQuery:     toQueryParams,
    toArray:        toArray,
    succ:           succ,
    times:          times,
    camelize:       camelize,
    capitalize:     capitalize,
    underscore:     underscore,
    dasherize:      dasherize,
    inspect:        inspect,
    unfilterJSON:   unfilterJSON,
    isJSON:         isJSON,
    evalJSON:       NATIVE_JSON_PARSE_SUPPORT ? parseJSON : evalJSON,
    //ECMA 6 supports contains(), if it exists map include() to contains()
    include:        String.prototype.contains || include,
    // Firefox 18+ supports String.prototype.startsWith, String.prototype.endsWith
    startsWith:     String.prototype.startsWith || startsWith,
    endsWith:       String.prototype.endsWith || endsWith,
    empty:          empty,
    blank:          blank,
    interpolate:    interpolate
  };
})());
var Template = Class.create({
  initialize: function(template, pattern) {
    this.template = template.toString();
    this.pattern = pattern || Template.Pattern;
  },
  evaluate: function(object) {
    if (object && Object.isFunction(object.toTemplateReplacements))
      object = object.toTemplateReplacements();
    return this.template.gsub(this.pattern, function(match) {
      if (object == null) return (match[1] + '');
      var before = match[1] || '';
      if (before == '\\') return match[2];
      var ctx = object, expr = match[3],
          pattern = /^([^.[]+|\[((?:.*?[^\\])?)\])(\.|\[|$)/;
          
      match = pattern.exec(expr);
      if (match == null) return before;
      while (match != null) {
        var comp = match[1].startsWith('[') ? match[2].replace(/\\\\]/g, ']') : match[1];
        ctx = ctx[comp];
        if (null == ctx || '' == match[3]) break;
        expr = expr.substring('[' == match[3] ? match[1].length : match[0].length);
        match = pattern.exec(expr);
      }
      return before + String.interpret(ctx);
    });
  }
});
Template.Pattern = /(^|.|\r|\n)(#\{(.*?)\})/;
var $break = { };
var Enumerable = (function() {
  function each(iterator, context) {
    try {
      this._each(iterator, context);
    } catch (e) {
      if (e != $break) throw e;
    }
    return this;
  }
  function eachSlice(number, iterator, context) {
    var index = -number, slices = [], array = this.toArray();
    if (number < 1) return array;
    while ((index += number) < array.length)
      slices.push(array.slice(index, index+number));
    return slices.collect(iterator, context);
  }
  function all(iterator, context) {
    iterator = iterator || Prototype.K;
    var result = true;
    this.each(function(value, index) {
      if (!iterator.call(context, value, index, this)) {
          result = false;
          throw $break;
      }
    }, this);
    return result;
  }
  function any(iterator, context) {
    iterator = iterator || Prototype.K;
    var result = false;
    this.each(function(value, index) {
      if (result = !!iterator.call(context, value, index, this))
        throw $break;
    }, this);
    return result;
  }
  function collect(iterator, context) {
    iterator = iterator || Prototype.K;
    var results = [];
    this.each(function(value, index) {
      results.push(iterator.call(context, value, index, this));
    }, this);
    return results;
  }
  function detect(iterator, context) {
    var result;
    this.each(function(value, index) {
      if (iterator.call(context, value, index, this)) {
        result = value;
        throw $break;
      }
    }, this);
    return result;
  }
  function findAll(iterator, context) {
    var results = [];
    this.each(function(value, index) {
      if (iterator.call(context, value, index, this))
        results.push(value);
    }, this);
    return results;
  }
  function grep(filter, iterator, context) {
    iterator = iterator || Prototype.K;
    var results = [];
    if (Object.isString(filter))
      filter = new RegExp(RegExp.escape(filter));
    this.each(function(value, index) {
      if (filter.match(value))
        results.push(iterator.call(context, value, index, this));
    }, this);
    return results;
  }
  function include(object) {
    if (Object.isFunction(this.indexOf) && this.indexOf(object) != -1)
      return true;
    var found = false;
    this.each(function(value) {
      if (value == object) {
        found = true;
        throw $break;
      }
    });
    return found;
  }
  function inGroupsOf(number, fillWith) {
    fillWith = Object.isUndefined(fillWith) ? null : fillWith;
    return this.eachSlice(number, function(slice) {
      while(slice.length < number) slice.push(fillWith);
      return slice;
    });
  }
  function inject(memo, iterator, context) {
    this.each(function(value, index) {
      memo = iterator.call(context, memo, value, index, this);
    }, this);
    return memo;
  }
  function invoke(method) {
    var args = $A(arguments).slice(1);
    return this.map(function(value) {
      return value[method].apply(value, args);
    });
  }
  function max(iterator, context) {
    iterator = iterator || Prototype.K;
    var result;
    this.each(function(value, index) {
      value = iterator.call(context, value, index, this);
      if (result == null || value >= result)
        result = value;
    }, this);
    return result;
  }
  function min(iterator, context) {
    iterator = iterator || Prototype.K;
    var result;
    this.each(function(value, index) {
      value = iterator.call(context, value, index, this);
      if (result == null || value < result)
        result = value;
    }, this);
    return result;
  }
  function partition(iterator, context) {
    iterator = iterator || Prototype.K;
    var trues = [], falses = [];
    this.each(function(value, index) {
      (iterator.call(context, value, index, this) ?
        trues : falses).push(value);
    }, this);
    return [trues, falses];
  }
  function pluck(property) {
    var results = [];
    this.each(function(value) {
      results.push(value[property]);
    });
    return results;
  }
  function reject(iterator, context) {
    var results = [];
    this.each(function(value, index) {
      if (!iterator.call(context, value, index, this))
        results.push(value);
    }, this);
    return results;
  }
  function sortBy(iterator, context) {
    return this.map(function(value, index) {
      return {
        value: value,
        criteria: iterator.call(context, value, index, this)
      };
    }, this).sort(function(left, right) {
      var a = left.criteria, b = right.criteria;
      return a < b ? -1 : a > b ? 1 : 0;
    }).pluck('value');
  }
  function toArray() {
    return this.map();
  }
  function zip() {
    var iterator = Prototype.K, args = $A(arguments);
    if (Object.isFunction(args.last()))
      iterator = args.pop();
    var collections = [this].concat(args).map($A);
    return this.map(function(value, index) {
      return iterator(collections.pluck(index));
    });
  }
  function size() {
    return this.toArray().length;
  }
  function inspect() {
    return '#<Enumerable:' + this.toArray().inspect() + '>';
  }
  return {
    each:       each,
    eachSlice:  eachSlice,
    all:        all,
    every:      all,
    any:        any,
    some:       any,
    collect:    collect,
    map:        collect,
    detect:     detect,
    findAll:    findAll,
    select:     findAll,
    filter:     findAll,
    grep:       grep,
    include:    include,
    member:     include,
    inGroupsOf: inGroupsOf,
    inject:     inject,
    invoke:     invoke,
    max:        max,
    min:        min,
    partition:  partition,
    pluck:      pluck,
    reject:     reject,
    sortBy:     sortBy,
    toArray:    toArray,
    entries:    toArray,
    zip:        zip,
    size:       size,
    inspect:    inspect,
    find:       detect
  };
})();
function $A(iterable) {
  if (!iterable) return [];
  // Safari <2.0.4 crashes when accessing property of a node list with property accessor.
  // It nevertheless works fine with `in` operator, which is why we use it here
  if ('toArray' in Object(iterable)) return iterable.toArray();
  var length = iterable.length || 0, results = new Array(length);
  while (length--) results[length] = iterable[length];
  return results;
}
function $w(string) {
  if (!Object.isString(string)) return [];
  string = string.strip();
  return string ? string.split(/\s+/) : [];
}
Array.from = $A;
(function() {
  var arrayProto = Array.prototype,
      slice = arrayProto.slice,
      _each = arrayProto.forEach,
      _entries = arrayProto.entries; // use native browser JS 1.6 implementation if available
  function each(iterator, context) {
    for (var i = 0, length = this.length >>> 0; i < length; i++) {
      if (i in this) iterator.call(context, this[i], i, this);
    }
  }
  if (!_each) _each = each;
  
  function clear() {
    this.length = 0;
    return this;
  }
  function first() {
    return this[0];
  }
  function last() {
    return this[this.length - 1];
  }
  function compact() {
    return this.select(function(value) {
      return value != null;
    });
  }
  function flatten() {
    return this.inject([], function(array, value) {
      if (Object.isArray(value))
        return array.concat(value.flatten());
      array.push(value);
      return array;
    });
  }
  function without() {
    var values = slice.call(arguments, 0);
    return this.select(function(value) {
      return !values.include(value);
    });
  }
  function reverse(inline) {
    return (inline === false ? this.toArray() : this)._reverse();
  }
  function uniq(sorted) {
    return this.inject([], function(array, value, index) {
      if (0 == index || (sorted ? array.last() != value : !array.include(value)))
        array.push(value);
      return array;
    });
  }
  function intersect(array) {
    return this.uniq().findAll(function(item) {
      return array.indexOf(item) !== -1;
    });
  }
  function clone() {
    return slice.call(this, 0);
  }
  function size() {
    return this.length;
  }
  function inspect() {
    return '[' + this.map(Object.inspect).join(', ') + ']';
  }
  function indexOf(item, i) {
    if (this == null) throw new TypeError();
    
    var array = Object(this), length = array.length >>> 0;
    if (length === 0) return -1;
    
    // The rules for the `fromIndex` argument are tricky. Let's follow the
    // spec line-by-line.
    i = Number(i);
    if (isNaN(i)) {
      i = 0;
    } else if (i !== 0 && isFinite(i)) {
      // Equivalent to ES5's `ToInteger` operation.
      i = (i > 0 ? 1 : -1) * Math.floor(Math.abs(i));
    }
    
    // If the search index is greater than the length of the array,
    // return -1.
    if (i > length) return -1;
    
    // If the search index is negative, take its absolute value, subtract it
    // from the length, and make that the new search index. If it's still
    // negative, make it 0.
    var k = i >= 0 ? i : Math.max(length - Math.abs(i), 0);
    for (; k < length; k++)
      if (k in array && array[k] === item) return k;
    return -1;
  }
  
  function lastIndexOf(item, i) {
    if (this == null) throw new TypeError();
    
    var array = Object(this), length = array.length >>> 0;
    if (length === 0) return -1;
    
    // The rules for the `fromIndex` argument are tricky. Let's follow the
    // spec line-by-line.
    if (!Object.isUndefined(i)) {
      i = Number(i);
      if (isNaN(i)) {
        i = 0;
      } else if (i !== 0 && isFinite(i)) {
        // Equivalent to ES5's `ToInteger` operation.
        i = (i > 0 ? 1 : -1) * Math.floor(Math.abs(i));
      }
    } else {
      i = length;
    }
    
    // If fromIndex is positive, clamp it to the last index in the array;
    // if it's negative, subtract its absolute value from the array's length.
    var k = i >= 0 ? Math.min(i, length - 1) :
     length - Math.abs(i);
    // (If fromIndex is still negative, it'll bypass this loop altogether and
    // return -1.)
    for (; k >= 0; k--)
      if (k in array && array[k] === item) return k;
    return -1;
  }
  // Replaces a built-in function. No PDoc needed.
  //
  // Used instead of the broken version of Array#concat in some versions of
  // Opera. Made to be ES5-compliant.
  function concat(_) {
    var array = [], items = slice.call(arguments, 0), item, n = 0;
    items.unshift(this);
    for (var i = 0, length = items.length; i < length; i++) {
      item = items[i];
      if (Object.isArray(item) && !('callee' in item)) {
        for (var j = 0, arrayLength = item.length; j < arrayLength; j++) {
          if (j in item) array[n] = item[j];
          n++;
        }
      } else {
        array[n++] = item;
      }
    }
    array.length = n;
    return array;
  }
  
  // Certain ES5 array methods have the same names as Prototype array methods
  // and perform the same functions.
  //
  // Prototype's implementations of these methods differ from the ES5 spec in
  // the way a missing iterator function is handled. Prototype uses 
  // `Prototype.K` as a default iterator, while ES5 specifies that a
  // `TypeError` must be thrown. Implementing the ES5 spec completely would 
  // break backward compatibility and would force users to pass `Prototype.K`
  // manually. 
  //
  // Instead, if native versions of these methods exist, we wrap the existing
  // methods with our own behavior. This has very little performance impact.
  // It violates the spec by suppressing `TypeError`s for certain methods,
  // but that's an acceptable trade-off.
  
  function wrapNative(method) {
    return function() {
      if (arguments.length === 0) {
        // No iterator was given. Instead of throwing a `TypeError`, use
        // `Prototype.K` as the default iterator.
        return method.call(this, Prototype.K);
      } else if (arguments[0] === undefined) {
        // Same as above.
        var args = slice.call(arguments, 1);
        args.unshift(Prototype.K);
        return method.apply(this, args);
      } else {
        // Pass straight through to the native method.
        return method.apply(this, arguments);
      }
    };
  }
  
  // Note that #map, #filter, #some, and #every take some extra steps for
  // ES5 compliance: the context in which they're called is coerced to an
  // object, and that object's `length` property is coerced to a finite
  // integer. This makes it easier to use the methods as generics.
  //
  // This means that they behave a little differently from other methods in
  // `Enumerable`/`Array` that don't collide with ES5, but that's OK.
  
  function map(iterator) {
    if (this == null) throw new TypeError();
    iterator = iterator || Prototype.K;
    var object = Object(this);
    var results = [], context = arguments[1], n = 0;
    for (var i = 0, length = object.length >>> 0; i < length; i++) {
      if (i in object) {
        results[n] = iterator.call(context, object[i], i, object);
      }
      n++;
    }
    results.length = n;
    return results;
  }
  
  if (arrayProto.map) {
    map = wrapNative(Array.prototype.map);
  }
  
  function filter(iterator) {
    if (this == null || !Object.isFunction(iterator))
      throw new TypeError();
    
    var object = Object(this);
    var results = [], context = arguments[1], value;
    for (var i = 0, length = object.length >>> 0; i < length; i++) {
      if (i in object) {
        value = object[i];
        if (iterator.call(context, value, i, object)) {
          results.push(value);
        }
      }
    }
    return results;
  }
  if (arrayProto.filter) {
    // `Array#filter` requires an iterator by nature, so we don't need to
    // wrap it.
    filter = Array.prototype.filter;
  }
  function some(iterator) {
    if (this == null) throw new TypeError();
    iterator = iterator || Prototype.K;
    var context = arguments[1];
    var object = Object(this);
    for (var i = 0, length = object.length >>> 0; i < length; i++) {
      if (i in object && iterator.call(context, object[i], i, object)) {
        return true;
      }
    }
      
    return false;
  }
  
  if (arrayProto.some) {
    var some = wrapNative(Array.prototype.some);
  }
  
  
  function every(iterator) {
    if (this == null) throw new TypeError();
    iterator = iterator || Prototype.K;
    var context = arguments[1];
    var object = Object(this);
    for (var i = 0, length = object.length >>> 0; i < length; i++) {
      if (i in object && !iterator.call(context, object[i], i, object)) {
        return false;
      }
    }
      
    return true;
  }
  
  if (arrayProto.every) {
    var every = wrapNative(Array.prototype.every);
  }
  
  function entries() {
    if (this == null) throw new TypeError();
    return this.map(function(i,index) {
        return [index,i];
    });
  }
  // Prototype's `Array#inject` behaves similarly to ES5's `Array#reduce`.
  var _reduce = arrayProto.reduce;
  function inject(memo, iterator) {
    iterator = iterator || Prototype.K;
    var context = arguments[2];
    // The iterator must be bound, as `Array#reduce` always binds to
    // `undefined`.
    return _reduce.call(this, iterator.bind(context), memo);
  }
  
  // Piggyback on `Array#reduce` if it exists; otherwise fall back to the
  // standard `Enumerable.inject`.
  if (!arrayProto.reduce) {
    var inject = Enumerable.inject;
  }
  Object.extend(arrayProto, Enumerable);
  if (!arrayProto._reverse)
    arrayProto._reverse = arrayProto.reverse;
  Object.extend(arrayProto, {
    _each:     _each,
    
    map:       map,
    collect:   map,
    select:    filter,
    filter:    filter,
    findAll:   filter,
    some:      some,
    any:       some,
    every:     every,
    all:       every,
    inject:    inject,
    
    clear:     clear,
    first:     first,
    last:      last,
    compact:   compact,
    flatten:   flatten,
    without:   without,
    reverse:   reverse,
    uniq:      uniq,
    intersect: intersect,
    clone:     clone,
    toArray:   clone,
    size:      size,
    inspect:   inspect,
    entries:   _entries || entries
  });
  // fix for opera
  var CONCAT_ARGUMENTS_BUGGY = (function() {
    return [].concat(arguments)[0][0] !== 1;
  })(1,2);
  if (CONCAT_ARGUMENTS_BUGGY) arrayProto.concat = concat;
  // Use native browser JS 1.6 implementations if available.
  if (!arrayProto.indexOf) arrayProto.indexOf = indexOf;
  if (!arrayProto.lastIndexOf) arrayProto.lastIndexOf = lastIndexOf;
})();
function $H(object) {
  return new Hash(object);
};
var Hash = Class.create(Enumerable, (function() {
  function initialize(object) {
    this._object = Object.isHash(object) ? object.toObject() : Object.clone(object);
  }
  // Docs for #each even though technically it's implemented by Enumerable
  // Our _internal_ each
  function _each(iterator, context) {
    var i = 0;
    for (var key in this._object) {
      var value = this._object[key], pair = [key, value];
      pair.key = key;
      pair.value = value;
      iterator.call(context, pair, i);
      i++;
    }
  }
  function set(key, value) {
    return this._object[key] = value;
  }
  function get(key) {
    // simulating poorly supported hasOwnProperty
    if (this._object[key] !== Object.prototype[key])
      return this._object[key];
  }
  function unset(key) {
    var value = this._object[key];
    delete this._object[key];
    return value;
  }
  function toObject() {
    return Object.clone(this._object);
  }
  
  
  function keys() {
    return this.pluck('key');
  }
  function values() {
    return this.pluck('value');
  }
  function index(value) {
    var match = this.detect(function(pair) {
      return pair.value === value;
    });
    return match && match.key;
  }
  function merge(object) {
    return this.clone().update(object);
  }
  function update(object) {
    return new Hash(object).inject(this, function(result, pair) {
      result.set(pair.key, pair.value);
      return result;
    });
  }
  // Private. No PDoc necessary.
  function toQueryPair(key, value) {
    if (Object.isUndefined(value)) return key;
    
    value = String.interpret(value);
    // Normalize newlines as \r\n because the HTML spec says newlines should
    // be encoded as CRLFs.
    value = value.gsub(/(\r)?\n/, '\r\n');
    value = encodeURIComponent(value);
    // Likewise, according to the spec, spaces should be '+' rather than
    // '%20'.
    value = value.gsub(/%20/, '+');
    return key + '=' + value;
  }
  function toQueryString() {
    return this.inject([], function(results, pair) {
      var key = encodeURIComponent(pair.key), values = pair.value;
      
      if (values && typeof values == 'object') {
        if (Object.isArray(values)) {
          // We used to use `Array#map` here to get the query pair for each
          // item in the array, but that caused test regressions once we
          // added the sparse array behavior for array iterator methods.
          // Changed to an ordinary `for` loop so that we can handle
          // `undefined` values ourselves rather than have them skipped.
          var queryValues = [];
          for (var i = 0, len = values.length, value; i < len; i++) {
            value = values[i];
            queryValues.push(toQueryPair(key, value));            
          }
          return results.concat(queryValues);
        }
      } else results.push(toQueryPair(key, values));
      return results;
    }).join('&');
  }
  function inspect() {
    return '#<Hash:{' + this.map(function(pair) {
      return pair.map(Object.inspect).join(': ');
    }).join(', ') + '}>';
  }
  function clone() {
    return new Hash(this);
  }
  return {
    initialize:             initialize,
    _each:                  _each,
    set:                    set,
    get:                    get,
    unset:                  unset,
    toObject:               toObject,
    toTemplateReplacements: toObject,
    keys:                   keys,
    values:                 values,
    index:                  index,
    merge:                  merge,
    update:                 update,
    toQueryString:          toQueryString,
    inspect:                inspect,
    toJSON:                 toObject,
    clone:                  clone
  };
})());
Hash.from = $H;
Object.extend(Number.prototype, (function() {
  function toColorPart() {
    return this.toPaddedString(2, 16);
  }
  function succ() {
    return this + 1;
  }
  function times(iterator, context) {
    $R(0, this, true).each(iterator, context);
    return this;
  }
  function toPaddedString(length, radix) {
    var string = this.toString(radix || 10);
    return '0'.times(length - string.length) + string;
  }
  function abs() {
    return Math.abs(this);
  }
  function round() {
    return Math.round(this);
  }
  function ceil() {
    return Math.ceil(this);
  }
  function floor() {
    return Math.floor(this);
  }
  return {
    toColorPart:    toColorPart,
    succ:           succ,
    times:          times,
    toPaddedString: toPaddedString,
    abs:            abs,
    round:          round,
    ceil:           ceil,
    floor:          floor
  };
})());
function $R(start, end, exclusive) {
  return new ObjectRange(start, end, exclusive);
}
var ObjectRange = Class.create(Enumerable, (function() {
  function initialize(start, end, exclusive) {
    this.start = start;
    this.end = end;
    this.exclusive = exclusive;
  }
  function _each(iterator, context) {
    var value = this.start, i;
    for (i = 0; this.include(value); i++) {
      iterator.call(context, value, i);
      value = value.succ();
    }
  }
  function include(value) {
    if (value < this.start)
      return false;
    if (this.exclusive)
      return value < this.end;
    return value <= this.end;
  }
  return {
    initialize: initialize,
    _each:      _each,
    include:    include
  };
})());
var Abstract = { };
var Try = {
  these: function() {
    var returnValue;
    for (var i = 0, length = arguments.length; i < length; i++) {
      var lambda = arguments[i];
      try {
        returnValue = lambda();
        break;
      } catch (e) { }
    }
    return returnValue;
  }
};
var Ajax = {
  getTransport: function() {
    return Try.these(
      function() {return new XMLHttpRequest()},
      function() {return new ActiveXObject('Msxml2.XMLHTTP')},
      function() {return new ActiveXObject('Microsoft.XMLHTTP')}
    ) || false;
  },
  activeRequestCount: 0
};
Ajax.Responders = {
  responders: [],
  _each: function(iterator, context) {
    this.responders._each(iterator, context);
  },
  register: function(responder) {
    if (!this.include(responder))
      this.responders.push(responder);
  },
  unregister: function(responder) {
    this.responders = this.responders.without(responder);
  },
  dispatch: function(callback, request, transport, json) {
    this.each(function(responder) {
      if (Object.isFunction(responder[callback])) {
        try {
          responder[callback].apply(responder, [request, transport, json]);
        } catch (e) { }
      }
    });
  }
};
Object.extend(Ajax.Responders, Enumerable);
Ajax.Responders.register({
  onCreate:   function() { Ajax.activeRequestCount++ },
  onComplete: function() { Ajax.activeRequestCount-- }
});
Ajax.Base = Class.create({
  initialize: function(options) {
    this.options = {
      method:       'post',
      asynchronous: true,
      contentType:  'application/x-www-form-urlencoded',
      encoding:     'UTF-8',
      parameters:   '',
      evalJSON:     true,
      evalJS:       true
    };
    Object.extend(this.options, options || { });
    this.options.method = this.options.method.toLowerCase();
    if (Object.isHash(this.options.parameters))
      this.options.parameters = this.options.parameters.toObject();
  }
});
Ajax.Request = Class.create(Ajax.Base, {
  _complete: false,
  initialize: function($super, url, options) {
    $super(options);
    this.transport = Ajax.getTransport();
    this.request(url);
  },
  request: function(url) {
    this.url = url;
    this.method = this.options.method;
    var params = Object.isString(this.options.parameters) ?
          this.options.parameters :
          Object.toQueryString(this.options.parameters);
    if (!['get', 'post'].include(this.method)) {
      // simulate other verbs over post
      params += (params ? '&' : '') + "_method=" + this.method;
      this.method = 'post';
    }
    if (params && this.method === 'get') {
      // when GET, append parameters to URL
      this.url += (this.url.include('?') ? '&' : '?') + params;
    }
    this.parameters = params.toQueryParams();
    try {
      var response = new Ajax.Response(this);
      if (this.options.onCreate) this.options.onCreate(response);
      Ajax.Responders.dispatch('onCreate', this, response);
      this.transport.open(this.method.toUpperCase(), this.url,
        this.options.asynchronous);
      if (this.options.asynchronous) this.respondToReadyState.bind(this).defer(1);
      this.transport.onreadystatechange = this.onStateChange.bind(this);
      this.setRequestHeaders();
      this.body = this.method == 'post' ? (this.options.postBody || params) : null;
      this.transport.send(this.body);
      /* Force Firefox to handle ready state 4 for synchronous requests */
      if (!this.options.asynchronous && this.transport.overrideMimeType)
        this.onStateChange();
    }
    catch (e) {
      this.dispatchException(e);
    }
  },
  onStateChange: function() {
    var readyState = this.transport.readyState;
    if (readyState > 1 && !((readyState == 4) && this._complete))
      this.respondToReadyState(this.transport.readyState);
  },
  setRequestHeaders: function() {
    var headers = {
      'X-Requested-With': 'XMLHttpRequest',
      'X-Prototype-Version': Prototype.Version,
      'Accept': 'text/javascript, text/html, application/xml, text/xml, */*'
    };
    if (this.method == 'post') {
      headers['Content-type'] = this.options.contentType +
        (this.options.encoding ? '; charset=' + this.options.encoding : '');
      /* Force "Connection: close" for older Mozilla browsers to work
       * around a bug where XMLHttpRequest sends an incorrect
       * Content-length header. See Mozilla Bugzilla #246651.
       */
      if (this.transport.overrideMimeType &&
          (navigator.userAgent.match(/Gecko\/(\d{4})/) || [0,2005])[1] < 2005)
            headers['Connection'] = 'close';
    }
    // user-defined headers
    if (typeof this.options.requestHeaders == 'object') {
      var extras = this.options.requestHeaders;
      if (Object.isFunction(extras.push))
        for (var i = 0, length = extras.length; i < length; i += 2)
          headers[extras[i]] = extras[i+1];
      else
        $H(extras).each(function(pair) { headers[pair.key] = pair.value });
    }
    // skip null or undefined values
    for (var name in headers)
      if (headers[name] != null)
        this.transport.setRequestHeader(name, headers[name]);
  },
  success: function() {
    var status = this.getStatus();
    return !status || (status >= 200 && status < 300) || status == 304;
  },
  getStatus: function() {
    try {
      // IE sometimes returns 1223 for a 204 response.
      if (this.transport.status === 1223) return 204;
      return this.transport.status || 0;
    } catch (e) { return 0 }
  },
  respondToReadyState: function(readyState) {
    var state = Ajax.Request.Events[readyState], response = new Ajax.Response(this);
    if (state == 'Complete') {
      try {
        this._complete = true;
        (this.options['on' + response.status]
         || this.options['on' + (this.success() ? 'Success' : 'Failure')]
         || Prototype.emptyFunction)(response, response.headerJSON);
      } catch (e) {
        this.dispatchException(e);
      }
      var contentType = response.getHeader('Content-type');
      if (this.options.evalJS == 'force'
          || (this.options.evalJS && this.isSameOrigin() && contentType
          && contentType.match(/^\s*(text|application)\/(x-)?(java|ecma)script(;.*)?\s*$/i)))
        this.evalResponse();
    }
    try {
      (this.options['on' + state] || Prototype.emptyFunction)(response, response.headerJSON);
      Ajax.Responders.dispatch('on' + state, this, response, response.headerJSON);
    } catch (e) {
      this.dispatchException(e);
    }
    if (state == 'Complete') {
      // avoid memory leak in MSIE: clean up
      this.transport.onreadystatechange = Prototype.emptyFunction;
    }
  },
  isSameOrigin: function() {
    var m = this.url.match(/^\s*https?:\/\/[^\/]*/);
    return !m || (m[0] == '#{protocol}//#{domain}#{port}'.interpolate({
      protocol: location.protocol,
      domain: document.domain,
      port: location.port ? ':' + location.port : ''
    }));
  },
  getHeader: function(name) {
    try {
      return this.transport.getResponseHeader(name) || null;
    } catch (e) { return null; }
  },
  evalResponse: function() {
    try {
      return eval((this.transport.responseText || '').unfilterJSON());
    } catch (e) {
      this.dispatchException(e);
    }
  },
  dispatchException: function(exception) {
    (this.options.onException || Prototype.emptyFunction)(this, exception);
    Ajax.Responders.dispatch('onException', this, exception);
  }
});
Ajax.Request.Events =
  ['Uninitialized', 'Loading', 'Loaded', 'Interactive', 'Complete'];
Ajax.Response = Class.create({
  // Don't document the constructor; should never be manually instantiated.
  initialize: function(request){
    this.request = request;
    var transport  = this.transport  = request.transport,
        readyState = this.readyState = transport.readyState;
    if ((readyState > 2 && !Prototype.Browser.IE) || readyState == 4) {
      this.status       = this.getStatus();
      this.statusText   = this.getStatusText();
      this.responseText = String.interpret(transport.responseText);
      this.headerJSON   = this._getHeaderJSON();
    }
    if (readyState == 4) {
      var xml = transport.responseXML;
      this.responseXML  = Object.isUndefined(xml) ? null : xml;
      this.responseJSON = this._getResponseJSON();
    }
  },
  status:      0,
  statusText: '',
  getStatus: Ajax.Request.prototype.getStatus,
  getStatusText: function() {
    try {
      return this.transport.statusText || '';
    } catch (e) { return '' }
  },
  getHeader: Ajax.Request.prototype.getHeader,
  getAllHeaders: function() {
    try {
      return this.getAllResponseHeaders();
    } catch (e) { return null }
  },
  getResponseHeader: function(name) {
    return this.transport.getResponseHeader(name);
  },
  getAllResponseHeaders: function() {
    return this.transport.getAllResponseHeaders();
  },
  _getHeaderJSON: function() {
    var json = this.getHeader('X-JSON');
    if (!json) return null;
    try {
      // Browsers expect HTTP headers to be ASCII and nothing else. Running
      // them through `decodeURIComponent` processes them with the page's
      // specified encoding.
      json = decodeURIComponent(escape(json));
    } catch(e) {
      // Except Chrome doesn't seem to need this, and calling
      // `decodeURIComponent` on text that's already in the proper encoding
      // will throw a `URIError`. The ugly solution is to assume that a
      // `URIError` raised here signifies that the text is, in fact, already 
      // in the correct encoding, and treat the failure as a good sign.
      //
      // This is ugly, but so too is sending extended characters in an HTTP
      // header with no spec to back you up.
    }
    
    try {
      return json.evalJSON(this.request.options.sanitizeJSON ||
        !this.request.isSameOrigin());
    } catch (e) {
      this.request.dispatchException(e);
    }
  },
  _getResponseJSON: function() {
    var options = this.request.options;
    if (!options.evalJSON || (options.evalJSON != 'force' &&
      !(this.getHeader('Content-type') || '').include('application/json')) ||
        this.responseText.blank())
          return null;
    try {
      return this.responseText.evalJSON(options.sanitizeJSON ||
        !this.request.isSameOrigin());
    } catch (e) {
      this.request.dispatchException(e);
    }
  }
});
Ajax.Updater = Class.create(Ajax.Request, {
  initialize: function($super, container, url, options) {
    this.container = {
      success: (container.success || container),
      failure: (container.failure || (container.success ? null : container))
    };
    options = Object.clone(options);
    var onComplete = options.onComplete;
    options.onComplete = (function(response, json) {
      this.updateContent(response.responseText);
      if (Object.isFunction(onComplete)) onComplete(response, json);
    }).bind(this);
    $super(url, options);
  },
  updateContent: function(responseText) {
    var receiver = this.container[this.success() ? 'success' : 'failure'],
        options = this.options;
    if (!options.evalScripts) responseText = responseText.stripScripts();
    if (receiver = $(receiver)) {
      if (options.insertion) {
        if (Object.isString(options.insertion)) {
          var insertion = { }; insertion[options.insertion] = responseText;
          receiver.insert(insertion);
        }
        else options.insertion(receiver, responseText);
      }
      else receiver.update(responseText);
    }
  }
});
Ajax.PeriodicalUpdater = Class.create(Ajax.Base, {
  initialize: function($super, container, url, options) {
    $super(options);
    this.onComplete = this.options.onComplete;
    this.frequency = (this.options.frequency || 2);
    this.decay = (this.options.decay || 1);
    this.updater = { };
    this.container = container;
    this.url = url;
    this.start();
  },
  start: function() {
    this.options.onComplete = this.updateComplete.bind(this);
    this.onTimerEvent();
  },
  stop: function() {
    this.updater.options.onComplete = undefined;
    clearTimeout(this.timer);
    (this.onComplete || Prototype.emptyFunction).apply(this, arguments);
  },
  updateComplete: function(response) {
    if (this.options.decay) {
      this.decay = (response.responseText == this.lastText ?
        this.decay * this.options.decay : 1);
      this.lastText = response.responseText;
    }
    this.timer = this.onTimerEvent.bind(this).delay(this.decay * this.frequency);
  },
  onTimerEvent: function() {
    this.updater = new Ajax.Updater(this.container, this.url, this.options);
  }
});
(function(GLOBAL) {
  
  var UNDEFINED;
  var SLICE = Array.prototype.slice;
  
  // Try to reuse the same created element as much as possible. We'll use
  // this DIV for capability checks (where possible) and for normalizing
  // HTML content.
  var DIV = document.createElement('div');
  
  function $(element) {
    if (arguments.length > 1) {
      for (var i = 0, elements = [], length = arguments.length; i < length; i++)
        elements.push($(arguments[i]));
      return elements;
    }
    
    if (Object.isString(element))
      element = document.getElementById(element);
    return Element.extend(element);
  }
  
  GLOBAL.$ = $;
  
  
  // Define the DOM Level 2 node type constants if they're missing.
  if (!GLOBAL.Node) GLOBAL.Node = {};
  
  if (!GLOBAL.Node.ELEMENT_NODE) {
    Object.extend(GLOBAL.Node, {
      ELEMENT_NODE:                1,
      ATTRIBUTE_NODE:              2,
      TEXT_NODE:                   3,
      CDATA_SECTION_NODE:          4,
      ENTITY_REFERENCE_NODE:       5,
      ENTITY_NODE:                 6,
      PROCESSING_INSTRUCTION_NODE: 7,
      COMMENT_NODE:                8,
      DOCUMENT_NODE:               9,
      DOCUMENT_TYPE_NODE:         10,
      DOCUMENT_FRAGMENT_NODE:     11,
      NOTATION_NODE:              12
    });
  }
  
  // The cache for all our created elements.
  var ELEMENT_CACHE = {};
  
  // For performance reasons, we create new elements by cloning a "blank"
  // version of a given element. But sometimes this causes problems. Skip
  // the cache if:
  //   (a) We're creating a SELECT element (troublesome in IE6);
  //   (b) We're setting the `type` attribute on an INPUT element
  //       (troublesome in IE9).
  function shouldUseCreationCache(tagName, attributes) {
    if (tagName === 'select') return false;
    if ('type' in attributes) return false;
    return true;
  }
  
  // IE requires that `name` and `type` attributes be set this way.
  var HAS_EXTENDED_CREATE_ELEMENT_SYNTAX = (function(){
    try {
      var el = document.createElement('<input name="x">');
      return el.tagName.toLowerCase() === 'input' && el.name === 'x';
    } 
    catch(err) {
      return false;
    }
  })();
  
  
  var oldElement = GLOBAL.Element;
  function Element(tagName, attributes) {
    attributes = attributes || {};
    tagName = tagName.toLowerCase();
    
    if (HAS_EXTENDED_CREATE_ELEMENT_SYNTAX && attributes.name) {
      tagName = '<' + tagName + ' name="' + attributes.name + '">';
      delete attributes.name;
      return Element.writeAttribute(document.createElement(tagName), attributes);
    }
    
    if (!ELEMENT_CACHE[tagName])
      ELEMENT_CACHE[tagName] = Element.extend(document.createElement(tagName));
    
    var node = shouldUseCreationCache(tagName, attributes) ?
     ELEMENT_CACHE[tagName].cloneNode(false) : document.createElement(tagName);
     
    return Element.writeAttribute(node, attributes);
  }
  
  GLOBAL.Element = Element;
  
  Object.extend(GLOBAL.Element, oldElement || {});
  if (oldElement) GLOBAL.Element.prototype = oldElement.prototype;
  
  Element.Methods = { ByTag: {}, Simulated: {} };
  // Temporary object for holding all our initial element methods. We'll add
  // them all at once at the bottom of this file.
  var methods = {};
  
  var INSPECT_ATTRIBUTES = { id: 'id', className: 'class' };
  function inspect(element) {
    element = $(element);
    var result = '<' + element.tagName.toLowerCase();
    
    var attribute, value;
    for (var property in INSPECT_ATTRIBUTES) {
      attribute = INSPECT_ATTRIBUTES[property];
      value = (element[property] || '').toString();
      if (value) result += ' ' + attribute + '=' + value.inspect(true);
    }
    
    return result + '>';
  }
  
  methods.inspect = inspect;
  
  // VISIBILITY
  
  function visible(element) {
    return $(element).style.display !== 'none';
  }
  
  function toggle(element, bool) {
    element = $(element);
    if (Object.isUndefined(bool))
      bool = !Element.visible(element);
    Element[bool ? 'show' : 'hide'](element);
    
    return element;
  }
  function hide(element) {
    element = $(element);
    element.style.display = 'none';
    return element;
  }
  
  function show(element) {
    element = $(element);
    element.style.display = '';
    return element;
  }
  
  
  Object.extend(methods, {
    visible: visible,
    toggle:  toggle,
    hide:    hide,
    show:    show
  });
  
  // MANIPULATION
  
  function remove(element) {
    element = $(element);
    element.parentNode.removeChild(element);
    return element;
  }
  
  // see: http://support.microsoft.com/kb/276228
  var SELECT_ELEMENT_INNERHTML_BUGGY = (function(){
    var el = document.createElement("select"),
        isBuggy = true;
    el.innerHTML = "<option value=\"test\">test</option>";
    if (el.options && el.options[0]) {
      isBuggy = el.options[0].nodeName.toUpperCase() !== "OPTION";
    }
    el = null;
    return isBuggy;
  })();
  // see: http://msdn.microsoft.com/en-us/library/ms533897(VS.85).aspx
  var TABLE_ELEMENT_INNERHTML_BUGGY = (function(){
    try {
      var el = document.createElement("table");
      if (el && el.tBodies) {
        el.innerHTML = "<tbody><tr><td>test</td></tr></tbody>";
        var isBuggy = typeof el.tBodies[0] == "undefined";
        el = null;
        return isBuggy;
      }
    } catch (e) {
      return true;
    }
  })();
  
  var LINK_ELEMENT_INNERHTML_BUGGY = (function() {
    try {
      var el = document.createElement('div');
      el.innerHTML = "<link />";
      var isBuggy = (el.childNodes.length === 0);
      el = null;
      return isBuggy;
    } catch(e) {
      return true;
    }
  })();
  
  var ANY_INNERHTML_BUGGY = SELECT_ELEMENT_INNERHTML_BUGGY ||
   TABLE_ELEMENT_INNERHTML_BUGGY || LINK_ELEMENT_INNERHTML_BUGGY;    
  var SCRIPT_ELEMENT_REJECTS_TEXTNODE_APPENDING = (function () {
    var s = document.createElement("script"),
        isBuggy = false;
    try {
      s.appendChild(document.createTextNode(""));
      isBuggy = !s.firstChild ||
        s.firstChild && s.firstChild.nodeType !== 3;
    } catch (e) {
      isBuggy = true;
    }
    s = null;
    return isBuggy;
  })();
  
  function update(element, content) {
    element = $(element);
    
    // Purge the element's existing contents of all storage keys and
    // event listeners, since said content will be replaced no matter
    // what.
    var descendants = element.getElementsByTagName('*'),
     i = descendants.length;
    while (i--) purgeElement(descendants[i]);
    
    if (content && content.toElement)
      content = content.toElement();
      
    if (Object.isElement(content))
      return element.update().insert(content);
      
    
    content = Object.toHTML(content);
    var tagName = element.tagName.toUpperCase();
    
    if (tagName === 'SCRIPT' && SCRIPT_ELEMENT_REJECTS_TEXTNODE_APPENDING) {
      // Scripts are not evaluated when updating a SCRIPT element.
      element.text = content;
      return element;
    }
    
    if (ANY_INNERHTML_BUGGY) {
      if (tagName in INSERTION_TRANSLATIONS.tags) {
        while (element.firstChild)
          element.removeChild(element.firstChild);
        
        var nodes = getContentFromAnonymousElement(tagName, content.stripScripts());        
        for (var i = 0, node; node = nodes[i]; i++)
          element.appendChild(node);
        
      } else if (LINK_ELEMENT_INNERHTML_BUGGY && Object.isString(content) && content.indexOf('<link') > -1) {
        // IE barfs when inserting a string that beings with a LINK
        // element. The workaround is to add any content to the beginning
        // of the string; we'll be inserting a text node (see
        // getContentFromAnonymousElement below).
        while (element.firstChild)
          element.removeChild(element.firstChild);
          
        var nodes = getContentFromAnonymousElement(tagName,
         content.stripScripts(), true);
        
        for (var i = 0, node; node = nodes[i]; i++)
          element.appendChild(node);
      } else {
        element.innerHTML = content.stripScripts();
      }
    } else {
      element.innerHTML = content.stripScripts();
    }
    
    content.evalScripts.bind(content).defer();
    return element;
  }
  
  function replace(element, content) {
    element = $(element);
    
    if (content && content.toElement) {
      content = content.toElement();      
    } else if (!Object.isElement(content)) {
      content = Object.toHTML(content);
      var range = element.ownerDocument.createRange();
      range.selectNode(element);
      content.evalScripts.bind(content).defer();
      content = range.createContextualFragment(content.stripScripts());
    }
      
    element.parentNode.replaceChild(content, element);
    return element;
  }
  
  var INSERTION_TRANSLATIONS = {
    before: function(element, node) {
      element.parentNode.insertBefore(node, element);
    },
    top: function(element, node) {
      element.insertBefore(node, element.firstChild);
    },
    bottom: function(element, node) {
      element.appendChild(node);
    },
    after: function(element, node) {
      element.parentNode.insertBefore(node, element.nextSibling);
    },
    
    tags: {
      TABLE:  ['<table>',                '</table>',                   1],
      TBODY:  ['<table><tbody>',         '</tbody></table>',           2],
      TR:     ['<table><tbody><tr>',     '</tr></tbody></table>',      3],
      TD:     ['<table><tbody><tr><td>', '</td></tr></tbody></table>', 4],
      SELECT: ['<select>',               '</select>',                  1]
    }
  };
  
  var tags = INSERTION_TRANSLATIONS.tags;
  
  Object.extend(tags, {
    THEAD: tags.TBODY,
    TFOOT: tags.TBODY,
    TH:    tags.TD
  });
  
  function replace_IE(element, content) {
    element = $(element);
    if (content && content.toElement)
      content = content.toElement();
    if (Object.isElement(content)) {
      element.parentNode.replaceChild(content, element);
      return element;
    }
    
    content = Object.toHTML(content);
    var parent = element.parentNode, tagName = parent.tagName.toUpperCase();
    
    if (tagName in INSERTION_TRANSLATIONS.tags) {
      var nextSibling = Element.next(element);
      var fragments = getContentFromAnonymousElement(
       tagName, content.stripScripts());
      
      parent.removeChild(element);
      
      var iterator;
      if (nextSibling)
        iterator = function(node) { parent.insertBefore(node, nextSibling) };
      else
        iterator = function(node) { parent.appendChild(node); }
        
      fragments.each(iterator);
    } else {
      // We don't need to special-case this one.
      element.outerHTML = content.stripScripts();
    }
    
    content.evalScripts.bind(content).defer();
    return element;
  }
  
  if ('outerHTML' in document.documentElement)
    replace = replace_IE;
  
  function isContent(content) {
    if (Object.isUndefined(content) || content === null) return false;
    
    if (Object.isString(content) || Object.isNumber(content)) return true;
    if (Object.isElement(content)) return true;    
    if (content.toElement || content.toHTML) return true;
    
    return false;
  }
  
  // This private method does the bulk of the work for Element#insert. The
  // actual insert method handles argument normalization and multiple
  // content insertions.
  function insertContentAt(element, content, position) {
    position   = position.toLowerCase();
    var method = INSERTION_TRANSLATIONS[position];
    
    if (content && content.toElement) content = content.toElement();
    if (Object.isElement(content)) {
      method(element, content);
      return element;
    }
    
    content = Object.toHTML(content);      
    var tagName = ((position === 'before' || position === 'after') ?
     element.parentNode : element).tagName.toUpperCase();
    
    var childNodes = getContentFromAnonymousElement(tagName, content.stripScripts());
    
    if (position === 'top' || position === 'after') childNodes.reverse();
    
    for (var i = 0, node; node = childNodes[i]; i++)
      method(element, node);
      
    content.evalScripts.bind(content).defer();    
  }
  function insert(element, insertions) {
    element = $(element);
    
    if (isContent(insertions))
      insertions = { bottom: insertions };
      
    for (var position in insertions)
      insertContentAt(element, insertions[position], position);
    
    return element;    
  }
  
  function wrap(element, wrapper, attributes) {
    element = $(element);
    
    if (Object.isElement(wrapper)) {
      // The wrapper argument is a DOM node.
      $(wrapper).writeAttribute(attributes || {});      
    } else if (Object.isString(wrapper)) {
      // The wrapper argument is a string representing a tag name.
      wrapper = new Element(wrapper, attributes);
    } else {
      // No wrapper was specified, which means the second argument is a set
      // of attributes.
      wrapper = new Element('div', wrapper);
    }
    
    if (element.parentNode)
      element.parentNode.replaceChild(wrapper, element);
    
    wrapper.appendChild(element);
    
    return wrapper;
  }
  
  function cleanWhitespace(element) {
    element = $(element);
    var node = element.firstChild;
    
    while (node) {
      var nextNode = node.nextSibling;
      if (node.nodeType === Node.TEXT_NODE && !/\S/.test(node.nodeValue))
        element.removeChild(node);
      node = nextNode;
    }
    return element;
  }
  
  function empty(element) {
    return $(element).innerHTML.blank();
  }
  
  // In older versions of Internet Explorer, certain elements don't like
  // having innerHTML set on them — including SELECT and most table-related
  // tags. So we wrap the string with enclosing HTML (if necessary), stick it
  // in a DIV, then grab the DOM nodes.
  function getContentFromAnonymousElement(tagName, html, force) {
    var t = INSERTION_TRANSLATIONS.tags[tagName], div = DIV;
    
    var workaround = !!t;
    if (!workaround && force) {
      workaround = true;
      t = ['', '', 0];
    }
    
    if (workaround) {
      div.innerHTML = '&#160;' + t[0] + html + t[1];
      div.removeChild(div.firstChild);
      for (var i = t[2]; i--; )
        div = div.firstChild;
    } else {
      div.innerHTML = html;
    }
    
    return $A(div.childNodes);
    //return SLICE.call(div.childNodes, 0);
  }
  
  function clone(element, deep) {
    if (!(element = $(element))) return;
    var clone = element.cloneNode(deep);
    if (!HAS_UNIQUE_ID_PROPERTY) {
      clone._prototypeUID = UNDEFINED;
      if (deep) {
        var descendants = Element.select(clone, '*'),
         i = descendants.length;
        while (i--)
          descendants[i]._prototypeUID = UNDEFINED;
      }
    }
    return Element.extend(clone);
  }
  
  // Performs cleanup on a single element before it is removed from the page.
  function purgeElement(element) {
    var uid = getUniqueElementID(element);
    if (uid) {
      Element.stopObserving(element);
      if (!HAS_UNIQUE_ID_PROPERTY)
        element._prototypeUID = UNDEFINED;
      delete Element.Storage[uid];
    }
  }
  
  function purgeCollection(elements) {
    var i = elements.length;
    while (i--)
      purgeElement(elements[i]);
  }
  
  function purgeCollection_IE(elements) {
    var i = elements.length, element, uid;
    while (i--) {
      element = elements[i];
      uid = getUniqueElementID(element);
      delete Element.Storage[uid];
      delete Event.cache[uid];
    }
  }
  
  if (HAS_UNIQUE_ID_PROPERTY) {
    purgeCollection = purgeCollection_IE;
  }
  
  
  function purge(element) {
    if (!(element = $(element))) return;
    purgeElement(element);
    
    var descendants = element.getElementsByTagName('*'),
     i = descendants.length;
     
    while (i--) purgeElement(descendants[i]);
    
    return null;
  }
  
  Object.extend(methods, {
    remove:  remove,
    update:  update,
    replace: replace,
    insert:  insert,
    wrap:    wrap,
    cleanWhitespace: cleanWhitespace,
    empty:   empty,
    clone:   clone,
    purge:   purge
  });
  
  // TRAVERSAL
  
  function recursivelyCollect(element, property, maximumLength) {
    element = $(element);
    maximumLength = maximumLength || -1;
    var elements = [];
    
    while (element = element[property]) {
      if (element.nodeType === Node.ELEMENT_NODE)
        elements.push(Element.extend(element));
        
      if (elements.length === maximumLength) break;
    }
    
    return elements;    
  }
  
  function ancestors(element) {
    return recursivelyCollect(element, 'parentNode');
  }
  
  function descendants(element) {
    return Element.select(element, '*');
  }
  
  function firstDescendant(element) {
    element = $(element).firstChild;
    while (element && element.nodeType !== Node.ELEMENT_NODE)
      element = element.nextSibling;
    return $(element);
  }
  
  function immediateDescendants(element) {
    var results = [], child = $(element).firstChild;
    
    while (child) {
      if (child.nodeType === Node.ELEMENT_NODE)
        results.push(Element.extend(child));
      
      child = child.nextSibling;
    }
    
    return results;
  }
  
  function previousSiblings(element) {
    return recursivelyCollect(element, 'previousSibling');
  }
  
  function nextSiblings(element) {
    return recursivelyCollect(element, 'nextSibling');
  }
  
  function siblings(element) {
    element = $(element);    
    var previous = previousSiblings(element),
     next = nextSiblings(element);
    return previous.reverse().concat(next);
  }
  
  function match(element, selector) {
    element = $(element);
    
    // If selector is a string, we assume it's a CSS selector.
    if (Object.isString(selector))
      return Prototype.Selector.match(element, selector);
      
    // Otherwise, we assume it's an object with its own `match` method.
    return selector.match(element);
  }
  
  
  // Internal method for optimizing traversal. Works like 
  // `recursivelyCollect`, except it stops at the first match and doesn't
  // extend any elements except for the returned element.
  function _recursivelyFind(element, property, expression, index) {
    element = $(element), expression = expression || 0, index = index || 0;
    if (Object.isNumber(expression)) {
      index = expression, expression = null;
    }
    
    while (element = element[property]) {
      // Skip any non-element nodes.
      if (element.nodeType !== 1) continue;
      // Skip any nodes that don't match the expression, if there is one.
      if (expression && !Prototype.Selector.match(element, expression))
        continue;
      // Skip the first `index` matches we find.
      if (--index >= 0) continue;
      
      return Element.extend(element);
    }
  }
  
  
  function up(element, expression, index) {
    element = $(element);
    if (arguments.length === 1) return $(element.parentNode);
    return _recursivelyFind(element, 'parentNode', expression, index);
  }
  function down(element, expression, index) {
    if (arguments.length === 1) return firstDescendant(element);
    element = $(element), expression = expression || 0, index = index || 0;
    
    if (Object.isNumber(expression))
      index = expression, expression = '*';
    
    var node = Prototype.Selector.select(expression, element)[index];
    return Element.extend(node);
  }
  function previous(element, expression, index) {
    return _recursivelyFind(element, 'previousSibling', expression, index);
  }
  
  function next(element, expression, index) {
    return _recursivelyFind(element, 'nextSibling', expression, index);
  }
    
  function select(element) {
    element = $(element);
    var expressions = SLICE.call(arguments, 1).join(', ');
    return Prototype.Selector.select(expressions, element);
  }
  function adjacent(element) {
    element = $(element);
    var expressions = SLICE.call(arguments, 1).join(', ');
    var siblings = Element.siblings(element), results = [];
    for (var i = 0, sibling; sibling = siblings[i]; i++) {
      if (Prototype.Selector.match(sibling, expressions))
        results.push(sibling);
    }
    
    return results;
  }
  
  function descendantOf_DOM(element, ancestor) {
    element = $(element), ancestor = $(ancestor);
    while (element = element.parentNode)
      if (element === ancestor) return true;
    return false;
  }
  
  function descendantOf_contains(element, ancestor) {
    element = $(element), ancestor = $(ancestor);
    // Some nodes, like `document`, don't have the "contains" method.
    if (!ancestor.contains) return descendantOf_DOM(element, ancestor);
    return ancestor.contains(element) && ancestor !== element;
  }
  
  function descendantOf_compareDocumentPosition(element, ancestor) {
    element = $(element), ancestor = $(ancestor);
    return (element.compareDocumentPosition(ancestor) & 8) === 8;
  }
  
  var descendantOf;
  if (DIV.compareDocumentPosition) {
    descendantOf = descendantOf_compareDocumentPosition;
  } else if (DIV.contains) {
    descendantOf = descendantOf_contains;
  } else {
    descendantOf = descendantOf_DOM;
  }
  
  
  Object.extend(methods, {
    recursivelyCollect:   recursivelyCollect,
    ancestors:            ancestors,
    descendants:          descendants,
    firstDescendant:      firstDescendant,
    immediateDescendants: immediateDescendants,
    previousSiblings:     previousSiblings,
    nextSiblings:         nextSiblings,
    siblings:             siblings,
    match:                match,
    up:                   up,
    down:                 down,
    previous:             previous,
    next:                 next,
    select:               select,
    adjacent:             adjacent,
    descendantOf:         descendantOf,
    
    // ALIASES
    getElementsBySelector: select,
    
    childElements:         immediateDescendants
  });
  
  
  // ATTRIBUTES
  var idCounter = 1;
  function identify(element) {
    element = $(element);
    var id = Element.readAttribute(element, 'id');
    if (id) return id;
    
    // The element doesn't have an ID of its own. Give it one, first ensuring
    // that it's unique.
    do { id = 'anonymous_element_' + idCounter++ } while ($(id));
    
    Element.writeAttribute(element, 'id', id);
    return id;
  }
  
  function readAttribute(element, name) {
    return $(element).getAttribute(name);
  }
  
  function readAttribute_IE(element, name) {
    element = $(element);
    
    // If the attribute name exists in the value translation table, it means
    // we should use a custom method for retrieving that attribute's value.
    var table = ATTRIBUTE_TRANSLATIONS.read;
    if (table.values[name])
      return table.values[name](element, name);
      
    // If it exists in the name translation table, it means the attribute has
    // an alias.
    if (table.names[name]) name = table.names[name];
    
    // Special-case namespaced attributes.
    if (name.include(':')) {
      if (!element.attributes || !element.attributes[name]) return null;
      return element.attributes[name].value;
    }
    
    return element.getAttribute(name);
  }
  
  function readAttribute_Opera(element, name) {
    if (name === 'title') return element.title;
    return element.getAttribute(name);
  }
  
  var PROBLEMATIC_ATTRIBUTE_READING = (function() {
    // This test used to set 'onclick' to `Prototype.emptyFunction`, but that
    // caused an (uncatchable) error in IE 10. For some reason, switching to
    // an empty array prevents this issue.
    DIV.setAttribute('onclick', []);
    var value = DIV.getAttribute('onclick');
    var isFunction = Object.isArray(value);
    DIV.removeAttribute('onclick');
    return isFunction;
  })();
  
  if (PROBLEMATIC_ATTRIBUTE_READING) {
    readAttribute = readAttribute_IE;
  } else if (Prototype.Browser.Opera) {
    readAttribute = readAttribute_Opera;
  }
  
  
  function writeAttribute(element, name, value) {
    element = $(element);
    var attributes = {}, table = ATTRIBUTE_TRANSLATIONS.write;
    
    if (typeof name === 'object') {
      attributes = name;
    } else {
      attributes[name] = Object.isUndefined(value) ? true : value;
    }
    
    for (var attr in attributes) {
      name = table.names[attr] || attr;
      value = attributes[attr];
      if (table.values[attr])
        name = table.values[attr](element, value) || name;
      if (value === false || value === null)
        element.removeAttribute(name);
      else if (value === true)
        element.setAttribute(name, name);
      else element.setAttribute(name, value);
    }
    return element;
  }
  
  function hasAttribute(element, attribute) {
    attribute = ATTRIBUTE_TRANSLATIONS.has[attribute] || attribute;
    var node = $(element).getAttributeNode(attribute);
    return !!(node && node.specified);
  }
  
  GLOBAL.Element.Methods.Simulated.hasAttribute = hasAttribute;
  
  function classNames(element) {
    return new Element.ClassNames(element);
  }
  
  var regExpCache = {};
  function getRegExpForClassName(className) {
    if (regExpCache[className]) return regExpCache[className];
    
    var re = new RegExp("(^|\\s+)" + className + "(\\s+|$)");
    regExpCache[className] = re;
    return re;
  }
  
  function hasClassName(element, className) {
    if (!(element = $(element))) return;
    
    var elementClassName = element.className;
    // We test these common cases first because we'd like to avoid creating
    // the regular expression, if possible.
    if (elementClassName.length === 0) return false;
    if (elementClassName === className) return true;
    
    return getRegExpForClassName(className).test(elementClassName);
  }
  
  function addClassName(element, className) {
    if (!(element = $(element))) return;
    
    if (!hasClassName(element, className))
      element.className += (element.className ? ' ' : '') + className;
      
    return element;
  }
  
  function removeClassName(element, className) {
    if (!(element = $(element))) return;
    
    element.className = element.className.replace(
     getRegExpForClassName(className), ' ').strip();
     
    return element;
  }
  
  function toggleClassName(element, className, bool) {
    if (!(element = $(element))) return;
    
    if (Object.isUndefined(bool))
      bool = !hasClassName(element, className);
      
    var method = Element[bool ? 'addClassName' : 'removeClassName'];
    return method(element, className);
  }
  
  var ATTRIBUTE_TRANSLATIONS = {};
  
  // Test attributes.
  var classProp = 'className', forProp = 'for';
  
  // Try "className" first (IE <8)
  DIV.setAttribute(classProp, 'x');
  if (DIV.className !== 'x') {
    // Try "class" (IE >=8)
    DIV.setAttribute('class', 'x');
    if (DIV.className === 'x')
      classProp = 'class';
  }
  
  var LABEL = document.createElement('label');
  LABEL.setAttribute(forProp, 'x');
  if (LABEL.htmlFor !== 'x') {
    LABEL.setAttribute('htmlFor', 'x');
    if (LABEL.htmlFor === 'x')
      forProp = 'htmlFor';
  }
  LABEL = null;
  
  function _getAttr(element, attribute) {
    return element.getAttribute(attribute);
  }
  
  function _getAttr2(element, attribute) {
    return element.getAttribute(attribute, 2);
  }
  
  function _getAttrNode(element, attribute) {
    var node = element.getAttributeNode(attribute);
    return node ? node.value : '';
  }
  
  function _getFlag(element, attribute) {
    return $(element).hasAttribute(attribute) ? attribute : null;
  }
  
  // Test whether attributes like `onclick` have their values serialized.
  DIV.onclick = Prototype.emptyFunction;
  var onclickValue = DIV.getAttribute('onclick');
  
  var _getEv;
  
  // IE <8
  if (String(onclickValue).indexOf('{') > -1) {
    // intrinsic event attributes are serialized as `function { ... }`
    _getEv = function(element, attribute) {
      var value = element.getAttribute(attribute);
      if (!value) return null;
      value = value.toString();
      value = value.split('{')[1];
      value = value.split('}')[0];
      return value.strip();
    };
  } 
  // IE >=8
  else if (onclickValue === '') {
    // only function body is serialized
    _getEv = function(element, attribute) {
      var value = element.getAttribute(attribute);
      if (!value) return null;
      return value.strip();
    };
  }
  
  ATTRIBUTE_TRANSLATIONS.read = {
    names: {
      'class':     classProp,
      'className': classProp,
      'for':       forProp,
      'htmlFor':   forProp
    },
        
    values: {
      style: function(element) {
        return element.style.cssText.toLowerCase();
      },
      title: function(element) {
        return element.title;
      }
    }
  };
  
  ATTRIBUTE_TRANSLATIONS.write = {
    names: {
      className:   'class',
      htmlFor:     'for',
      cellpadding: 'cellPadding',
      cellspacing: 'cellSpacing'
    },
    
    values: {
      checked: function(element, value) {
        element.checked = !!value;
      },
      
      style: function(element, value) {
        element.style.cssText = value ? value : '';
      }
    }
  };
  
  ATTRIBUTE_TRANSLATIONS.has = { names: {} };
  
  Object.extend(ATTRIBUTE_TRANSLATIONS.write.names,
   ATTRIBUTE_TRANSLATIONS.read.names);
   
  var CAMEL_CASED_ATTRIBUTE_NAMES = $w('colSpan rowSpan vAlign dateTime ' +
   'accessKey tabIndex encType maxLength readOnly longDesc frameBorder');
   
  for (var i = 0, attr; attr = CAMEL_CASED_ATTRIBUTE_NAMES[i]; i++) {
    ATTRIBUTE_TRANSLATIONS.write.names[attr.toLowerCase()] = attr;
    ATTRIBUTE_TRANSLATIONS.has.names[attr.toLowerCase()]   = attr;
  }
  
  // The rest of the oddballs.
  Object.extend(ATTRIBUTE_TRANSLATIONS.read.values, {
    href:        _getAttr2,
    src:         _getAttr2,
    type:        _getAttr,
    action:      _getAttrNode,
    disabled:    _getFlag,
    checked:     _getFlag,
    readonly:    _getFlag,
    multiple:    _getFlag,
    onload:      _getEv,
    onunload:    _getEv,
    onclick:     _getEv,
    ondblclick:  _getEv,
    onmousedown: _getEv,
    onmouseup:   _getEv,
    onmouseover: _getEv,
    onmousemove: _getEv,
    onmouseout:  _getEv,
    onfocus:     _getEv,
    onblur:      _getEv,
    onkeypress:  _getEv,
    onkeydown:   _getEv,
    onkeyup:     _getEv,
    onsubmit:    _getEv,
    onreset:     _getEv,
    onselect:    _getEv,
    onchange:    _getEv    
  });
  
  
  Object.extend(methods, {
    identify:        identify,
    readAttribute:   readAttribute,
    writeAttribute:  writeAttribute,
    classNames:      classNames,
    hasClassName:    hasClassName,
    addClassName:    addClassName,
    removeClassName: removeClassName,
    toggleClassName: toggleClassName
  });
  
  
  // STYLES
  function normalizeStyleName(style) {
    if (style === 'float' || style === 'styleFloat')
      return 'cssFloat';
    return style.camelize();
  }
  
  function normalizeStyleName_IE(style) {
    if (style === 'float' || style === 'cssFloat')
      return 'styleFloat';
    return style.camelize();
  }
  function setStyle(element, styles) {
    element = $(element);
    var elementStyle = element.style, match;
    
    if (Object.isString(styles)) {
      // Set the element's CSS text directly.
      elementStyle.cssText += ';' + styles;
      if (styles.include('opacity')) {
        var opacity = styles.match(/opacity:\s*(\d?\.?\d*)/)[1];
        Element.setOpacity(element, opacity);
      }
      return element;
    }
    
    for (var property in styles) {
      if (property === 'opacity') {
        Element.setOpacity(element, styles[property]);
      } else {
        var value = styles[property];
        if (property === 'float' || property === 'cssFloat') {
          // Browsers disagree on whether this should be called `cssFloat`
          // or `styleFloat`. Check both.
          property = Object.isUndefined(elementStyle.styleFloat) ?
           'cssFloat' : 'styleFloat';
        }
        elementStyle[property] = value;
      }
    }
    
    return element;    
  }
  
  function getStyle(element, style) {
    if (style === 'opacity') return getOpacity(element);
    element = $(element);
    style = normalizeStyleName(style);
    // Try inline styles first.
    var value = element.style[style];
    if (!value || value === 'auto') {
      // Reluctantly retrieve the computed style.
      var css = document.defaultView.getComputedStyle(element, null);
      value = css ? css[style] : null;
    }
    
    return value === 'auto' ? null : value;
  }
  
  function getStyle_Opera(element, style) {
    switch (style) {
      case 'height': case 'width':
        // returns '0px' for hidden elements; we want it to return null
        if (!Element.visible(element)) return null;
        
        // Certain versions of Opera return border-box dimensions instead of
        // content-box dimensions, so we need to determine if we should
        // subtract padding and borders from the value.
        var dim = parseInt(getStyle(element, style), 10);
        
        if (dim !== element['offset' + style.capitalize()])
          return dim + 'px';
       
        return Element.measure(element, style);
        
      default: return getStyle(element, style);
    }
  }
  
  function getStyle_IE(element, style) {
    if (style === 'opacity') return getOpacity_IE(element);
    element = $(element);
    style = normalizeStyleName_IE(style);
    // Try inline styles first.
    var value = element.style[style];    
    if (!value && element.currentStyle) {
      // Reluctantly retrieve the current style.
      value = element.currentStyle[style];
    }
    
    if (value === 'auto') {
      // If we need a dimension, return null for hidden elements, but return
      // pixel values for visible elements.
      if ((style === 'width' || style === 'height') && Element.visible(element))
        return Element.measure(element, style) + 'px';
      return null;
    }
    
    return value;    
  }
  
  function stripAlphaFromFilter_IE(filter) {
    return (filter || '').replace(/alpha\([^\)]*\)/gi, '');
  }
  
  function hasLayout_IE(element) {
    if (!element.currentStyle || !element.currentStyle.hasLayout)
      element.style.zoom = 1;
    return element;
  }
  // Opacity feature test borrowed from Modernizr.
  var STANDARD_CSS_OPACITY_SUPPORTED = (function() {
    DIV.style.cssText = "opacity:.55";
    return /^0.55/.test(DIV.style.opacity);
  })();
  function setOpacity(element, value) {
    element = $(element);
    if (value == 1 || value === '') value = '';
    else if (value < 0.00001) value = 0;    
    element.style.opacity = value;    
    return element;
  }
  
  // The IE versions of `setOpacity` and `getOpacity` are aware of both
  // the standard approach (an `opacity` property in CSS) and the old-style
  // IE approach (a proprietary `filter` property). They are written to
  // prefer the standard approach unless it isn't supported.
  var setOpacity_IE = STANDARD_CSS_OPACITY_SUPPORTED ? setOpacity : function(element, value) {
    element = $(element);
    var style = element.style;
    if (!element.currentStyle || !element.currentStyle.hasLayout)
      style.zoom = 1;
    var filter = Element.getStyle(element, 'filter');
     
    if (value == 1 || value === '') {
      // Remove the `alpha` filter from IE's `filter` CSS property. If there
      // is anything left after removal, put it back where it was; otherwise
      // remove the property.
      filter = stripAlphaFromFilter_IE(filter);
      if (filter) style.filter = filter;
      else style.removeAttribute('filter');      
      return element;
    }
    
    if (value < 0.00001) value = 0;
        
    style.filter = stripAlphaFromFilter_IE(filter) + 
     ' alpha(opacity=' + (value * 100) + ')';
     
    return element;
  };
  
  
  function getOpacity(element) {
    element = $(element);
    // Try inline styles first.
    var value = element.style.opacity;
    if (!value || value === 'auto') {
      // Reluctantly retrieve the computed style.
      var css = document.defaultView.getComputedStyle(element, null);
      value = css ? css.opacity : null;
    }
    return value ? parseFloat(value) : 1.0;
  }
  
  // Prefer the standard CSS approach unless it's not supported.
  var getOpacity_IE = STANDARD_CSS_OPACITY_SUPPORTED ? getOpacity : function(element) {
    var filter = Element.getStyle(element, 'filter');
    if (filter.length === 0) return 1.0;
    var match = (filter || '').match(/alpha\(opacity=(.*)\)/i);
    if (match && match[1]) return parseFloat(match[1]) / 100;
    return 1.0;
  };
  
  
  Object.extend(methods, {
    setStyle:   setStyle,
    getStyle:   getStyle,
    setOpacity: setOpacity,
    getOpacity: getOpacity
  });
  if (Prototype.Browser.Opera) {
    // Opera also has 'styleFloat' in DIV.style
    methods.getStyle = getStyle_Opera;
  } else if ('styleFloat' in DIV.style) {
    methods.getStyle = getStyle_IE;
    methods.setOpacity = setOpacity_IE;
    methods.getOpacity = getOpacity_IE;
  }
  
  // STORAGE
  var UID = 0;
  
  GLOBAL.Element.Storage = { UID: 1 };
  
  function getUniqueElementID(element) {
    if (element === window) return 0;
    // Need to use actual `typeof` operator to prevent errors in some
    // environments when accessing node expandos.
    if (typeof element._prototypeUID === 'undefined')
      element._prototypeUID = Element.Storage.UID++;
    return element._prototypeUID;
  }
  
  // In Internet Explorer, DOM nodes have a `uniqueID` property. Saves us
  // from inventing our own.
  function getUniqueElementID_IE(element) {
    if (element === window) return 0;
    // The document object's `uniqueID` property changes each time you read it.
    if (element == document) return 1;
    return element.uniqueID;
  }
  
  var HAS_UNIQUE_ID_PROPERTY = ('uniqueID' in DIV);
  if (HAS_UNIQUE_ID_PROPERTY)
    getUniqueElementID = getUniqueElementID_IE;
  
  function getStorage(element) {
    if (!(element = $(element))) return;
    
    var uid = getUniqueElementID(element);
    
    if (!Element.Storage[uid])
      Element.Storage[uid] = $H();
      
    return Element.Storage[uid];
  }
  
  function store(element, key, value) {
    if (!(element = $(element))) return;
    var storage = getStorage(element);
    if (arguments.length === 2) {
      // Assume we've been passed an object full of key/value pairs.
      storage.update(key);
    } else {
      storage.set(key, value);
    }
    return element;
  }
  
  function retrieve(element, key, defaultValue) {
    if (!(element = $(element))) return;
    var storage = getStorage(element), value = storage.get(key);
    
    if (Object.isUndefined(value)) {
      storage.set(key, defaultValue);
      value = defaultValue;
    }
    
    return value;
  }
  
  
  Object.extend(methods, {
    getStorage: getStorage,
    store:      store,
    retrieve:   retrieve
  });
  
  
  // ELEMENT EXTENSION
  var Methods = {}, ByTag = Element.Methods.ByTag,
   F = Prototype.BrowserFeatures;
  
  // Handle environments which support extending element prototypes
  // but don't expose the standard class name.
  if (!F.ElementExtensions && ('__proto__' in DIV)) {
    GLOBAL.HTMLElement = {};
    GLOBAL.HTMLElement.prototype = DIV['__proto__'];
    F.ElementExtensions = true;
  }
  
  // Certain oddball element types can't be extended in IE8.
  function checkElementPrototypeDeficiency(tagName) {
    if (typeof window.Element === 'undefined') return false;
    var proto = window.Element.prototype;
    if (proto) {
      var id = '_' + (Math.random() + '').slice(2),
       el = document.createElement(tagName);
      proto[id] = 'x';
      var isBuggy = (el[id] !== 'x');
      delete proto[id];
      el = null;
      return isBuggy;
    }
    
    return false;    
  }
  
  var HTMLOBJECTELEMENT_PROTOTYPE_BUGGY = 
   checkElementPrototypeDeficiency('object');
  
  function extendElementWith(element, methods) {
    for (var property in methods) {
      var value = methods[property];
      if (Object.isFunction(value) && !(property in element))
        element[property] = value.methodize();
    }
  }
  
  // Keeps track of the UIDs of extended elements.
  var EXTENDED = {};
  function elementIsExtended(element) {
    var uid = getUniqueElementID(element);
    return (uid in EXTENDED);
  }
  
  function extend(element) {
    if (!element || elementIsExtended(element)) return element;
    if (element.nodeType !== Node.ELEMENT_NODE || element == window)
      return element;
      
    var methods = Object.clone(Methods),
     tagName = element.tagName.toUpperCase();
     
    // Add methods for specific tags.
    if (ByTag[tagName]) Object.extend(methods, ByTag[tagName]);
    
    extendElementWith(element, methods);
    EXTENDED[getUniqueElementID(element)] = true;
    return element;
  }
  
  // Because of the deficiency mentioned above, IE8 needs a very thin version
  // of Element.extend that acts like Prototype.K _except_ when the element
  // is one of the problematic types.
  function extend_IE8(element) {
    if (!element || elementIsExtended(element)) return element;
    
    var t = element.tagName;
    if (t && (/^(?:object|applet|embed)$/i.test(t))) {
      extendElementWith(element, Element.Methods);
      extendElementWith(element, Element.Methods.Simulated);
      extendElementWith(element, Element.Methods.ByTag[t.toUpperCase()]);
    }
    
    return element;
  }
  // If the browser lets us extend specific elements, we can replace `extend`
  // with a thinner version (or, ideally, an empty version).
  if (F.SpecificElementExtensions) {
    extend = HTMLOBJECTELEMENT_PROTOTYPE_BUGGY ? extend_IE8 : Prototype.K;
  }
  
  function addMethodsToTagName(tagName, methods) {
    tagName = tagName.toUpperCase();
    if (!ByTag[tagName]) ByTag[tagName] = {};
    Object.extend(ByTag[tagName], methods);
  }
  
  function mergeMethods(destination, methods, onlyIfAbsent) {
    if (Object.isUndefined(onlyIfAbsent)) onlyIfAbsent = false;
    for (var property in methods) {
      var value = methods[property];
      if (!Object.isFunction(value)) continue;
      if (!onlyIfAbsent || !(property in destination))
        destination[property] = value.methodize();
    }
  }
  
  function findDOMClass(tagName) {
    var klass;
    var trans = {
      "OPTGROUP": "OptGroup", "TEXTAREA": "TextArea", "P": "Paragraph",
      "FIELDSET": "FieldSet", "UL": "UList", "OL": "OList", "DL": "DList",
      "DIR": "Directory", "H1": "Heading", "H2": "Heading", "H3": "Heading",
      "H4": "Heading", "H5": "Heading", "H6": "Heading", "Q": "Quote",
      "INS": "Mod", "DEL": "Mod", "A": "Anchor", "IMG": "Image", "CAPTION":
      "TableCaption", "COL": "TableCol", "COLGROUP": "TableCol", "THEAD":
      "TableSection", "TFOOT": "TableSection", "TBODY": "TableSection", "TR":
      "TableRow", "TH": "TableCell", "TD": "TableCell", "FRAMESET":
      "FrameSet", "IFRAME": "IFrame"
    };
    if (trans[tagName]) klass = 'HTML' + trans[tagName] + 'Element';
    if (window[klass]) return window[klass];
    klass = 'HTML' + tagName + 'Element';
    if (window[klass]) return window[klass];
    klass = 'HTML' + tagName.capitalize() + 'Element';
    if (window[klass]) return window[klass];
    var element = document.createElement(tagName),
     proto = element['__proto__'] || element.constructor.prototype;
        
    element = null;
    return proto;
  }
  
  function addMethods(methods) {
    if (arguments.length === 0) addFormMethods();
    
    if (arguments.length === 2) {
      // Tag names have been specified.
      var tagName = methods;
      methods = arguments[1];
    }
    
    if (!tagName) {
      Object.extend(Element.Methods, methods || {});
    } else {
      if (Object.isArray(tagName)) {
        for (var i = 0, tag; tag = tagName[i]; i++)
          addMethodsToTagName(tag, methods);
      } else {
        addMethodsToTagName(tagName, methods);
      }
    }
    
    var ELEMENT_PROTOTYPE = window.HTMLElement ? HTMLElement.prototype :
     Element.prototype;
     
    if (F.ElementExtensions) {
      mergeMethods(ELEMENT_PROTOTYPE, Element.Methods);
      mergeMethods(ELEMENT_PROTOTYPE, Element.Methods.Simulated, true);
    }
    
    if (F.SpecificElementExtensions) {
      for (var tag in Element.Methods.ByTag) {
        var klass = findDOMClass(tag);
        if (Object.isUndefined(klass)) continue;
        mergeMethods(klass.prototype, ByTag[tag]);
      }
    }
    
    Object.extend(Element, Element.Methods);
    Object.extend(Element, Element.Methods.Simulated);
    delete Element.ByTag;
    delete Element.Simulated;
    
    Element.extend.refresh();
    
    // We need to replace the element creation cache because the nodes in the
    // cache now have stale versions of the element methods.
    ELEMENT_CACHE = {};
  }
  
  Object.extend(GLOBAL.Element, {
    extend:     extend,
    addMethods: addMethods
  });
  
  if (extend === Prototype.K) {
    GLOBAL.Element.extend.refresh = Prototype.emptyFunction;
  } else {
    GLOBAL.Element.extend.refresh = function() {
      if (Prototype.BrowserFeatures.ElementExtensions) return;
      Object.extend(Methods, Element.Methods);
      Object.extend(Methods, Element.Methods.Simulated);
      // All existing extended elements are stale and need to be refreshed.
      EXTENDED = {};
    };
  }
  
  function addFormMethods() {
    // Add relevant element methods from the forms API.
    Object.extend(Form, Form.Methods);
    Object.extend(Form.Element, Form.Element.Methods);
    Object.extend(Element.Methods.ByTag, {
      "FORM":     Object.clone(Form.Methods),
      "INPUT":    Object.clone(Form.Element.Methods),
      "SELECT":   Object.clone(Form.Element.Methods),
      "TEXTAREA": Object.clone(Form.Element.Methods),
      "BUTTON":   Object.clone(Form.Element.Methods)
    });
  }
  Element.addMethods(methods);
  // Prevent IE leaks on DIV and ELEMENT_CACHE
  function destroyCache_IE() {
    DIV = null;
    ELEMENT_CACHE = null;
  }
  if (window.attachEvent)
    window.attachEvent('onunload', destroyCache_IE);
})(this);
(function() {
  
  // Converts a CSS percentage value to a decimal.
  // Ex: toDecimal("30%"); // -> 0.3
  function toDecimal(pctString) {
    var match = pctString.match(/^(\d+)%?$/i);
    if (!match) return null;
    return (Number(match[1]) / 100);
  }
  
  // A bare-bones version of Element.getStyle. Needed because getStyle is
  // public-facing and too user-friendly for our tastes. We need raw,
  // non-normalized values.
  //
  // Camel-cased property names only.
  function getRawStyle(element, style) {
    element = $(element);
    // Try inline styles first.
    var value = element.style[style];
    if (!value || value === 'auto') {
      // Reluctantly retrieve the computed style.
      var css = document.defaultView.getComputedStyle(element, null);
      value = css ? css[style] : null;
    }
    
    if (style === 'opacity') return value ? parseFloat(value) : 1.0;
    return value === 'auto' ? null : value;
  }
  
  function getRawStyle_IE(element, style) {
    // Try inline styles first.
    var value = element.style[style];    
    if (!value && element.currentStyle) {
      // Reluctantly retrieve the current style.
      value = element.currentStyle[style];
    }
    return value;
  }
  
  // Quickly figures out the content width of an element. Used instead of
  // `element.measure('width')` in several places below; we don't want to 
  // call back into layout code recursively if we don't have to.
  //
  // But this means it doesn't handle edge cases. Use it when you know the
  // element in question is visible and will give accurate measurements.
  function getContentWidth(element, context) {
    var boxWidth = element.offsetWidth;
    
    var bl = getPixelValue(element, 'borderLeftWidth',  context) || 0;
    var br = getPixelValue(element, 'borderRightWidth', context) || 0;
    var pl = getPixelValue(element, 'paddingLeft',      context) || 0;
    var pr = getPixelValue(element, 'paddingRight',     context) || 0;
    
    return boxWidth - bl - br - pl - pr;
  }
  
  if ('currentStyle' in document.documentElement) {
    getRawStyle = getRawStyle_IE;
  }
  
  
  // Can be called like this:
  //   getPixelValue("11px");
  // Or like this:
  //   getPixelValue(someElement, 'paddingTop');  
  function getPixelValue(value, property, context) {
    var element = null;
    if (Object.isElement(value)) {
      element = value;
      value = getRawStyle(element, property);
    }
    if (value === null || Object.isUndefined(value)) {
      return null;
    }
    
    // Non-IE browsers will always return pixels if possible.
    // (We use parseFloat instead of parseInt because Firefox can return
    // non-integer pixel values.)
    if ((/^(?:-)?\d+(\.\d+)?(px)?$/i).test(value)) {
      return window.parseFloat(value);
    }
    var isPercentage = value.include('%'), isViewport = (context === document.viewport);
    
    // When IE gives us something other than a pixel value, this technique
    // (invented by Dean Edwards) will convert it to pixels.
    //
    // (This doesn't work for percentage values on elements with `position: fixed`
    // because those percentages are relative to the viewport.)
    if (/\d/.test(value) && element && element.runtimeStyle && !(isPercentage && isViewport)) {
      var style = element.style.left, rStyle = element.runtimeStyle.left; 
      element.runtimeStyle.left = element.currentStyle.left;
      element.style.left = value || 0;  
      value = element.style.pixelLeft;
      element.style.left = style;
      element.runtimeStyle.left = rStyle;
      
      return value;
    }
    // For other browsers, we have to do a bit of work.
    // (At this point, only percentages should be left; all other CSS units
    // are converted to pixels by getComputedStyle.)
    if (element && isPercentage) {
      // The `context` argument comes into play for percentage units; it's
      // the thing that the unit represents a percentage of. When an
      // absolutely-positioned element has a width of 50%, we know that's
      // 50% of its offset parent. If it's `position: fixed` instead, we know
      // it's 50% of the viewport. And so on.
      context = context || element.parentNode;
      var decimal = toDecimal(value), whole = null;
      
      var isHorizontal = property.include('left') || property.include('right') ||
       property.include('width');
       
      var isVertical   = property.include('top') || property.include('bottom') ||
        property.include('height');
        
      if (context === document.viewport) {
        if (isHorizontal) {
          whole = document.viewport.getWidth();
        } else if (isVertical) {
          whole = document.viewport.getHeight();
        }
      } else {
        if (isHorizontal) {
          whole = $(context).measure('width');
        } else if (isVertical) {
          whole = $(context).measure('height');
        }
      }
      
      return (whole === null) ? 0 : whole * decimal;
    }
    
    // If we get this far, we should probably give up.
    return 0;
  }
  
  // Turns plain numbers into pixel measurements.
  function toCSSPixels(number) {
    if (Object.isString(number) && number.endsWith('px'))
      return number;
    return number + 'px';    
  }
  
  // Shortcut for figuring out if an element is `display: none` or not.
  function isDisplayed(element) {
    while (element && element.parentNode) {
      var display = element.getStyle('display');
      if (display === 'none') {
        return false;
      }
      element = $(element.parentNode);
    }
    return true;
  }
  
  // In IE6-7, positioned elements often need hasLayout triggered before they
  // report accurate measurements.
  var hasLayout = Prototype.K;  
  if ('currentStyle' in document.documentElement) {
    hasLayout = function(element) {
      if (!element.currentStyle.hasLayout) {
        element.style.zoom = 1;
      }
      return element;
    };
  }
  // Converts the layout hash property names back to the CSS equivalents.
  // For now, only the border properties differ.
  function cssNameFor(key) {
    if (key.include('border')) key = key + '-width';
    return key.camelize();
  }
  
  Element.Layout = Class.create(Hash, {
    initialize: function($super, element, preCompute) {
      $super();
      this.element = $(element);
      
      // nullify all properties keys
      Element.Layout.PROPERTIES.each( function(property) {
        this._set(property, null);
      }, this);
      
      // The 'preCompute' boolean tells us whether we should fetch all values
      // at once. If so, we should do setup/teardown only once. We set a flag
      // so that we can ignore calls to `_begin` and `_end` elsewhere.
      if (preCompute) {
        this._preComputing = true;
        this._begin();
        Element.Layout.PROPERTIES.each( this._compute, this );
        this._end();
        this._preComputing = false;
      }
    },
    
    _set: function(property, value) {
      return Hash.prototype.set.call(this, property, value);
    },    
    
    // TODO: Investigate.
    set: function(property, value) {
      throw "Properties of Element.Layout are read-only.";
    },
    
    get: function($super, property) {
      // Try to fetch from the cache.
      var value = $super(property);
      return value === null ? this._compute(property) : value;
    },
    
    // `_begin` and `_end` are two functions that are called internally 
    // before and after any measurement is done. In certain conditions (e.g.,
    // when hidden), elements need a "preparation" phase that ensures
    // accuracy of measurements.
    _begin: function() {
      if (this._isPrepared()) return;
      
      var element = this.element;
      if (isDisplayed(element)) {
        this._setPrepared(true);
        return;
      }
      
      // If we get this far, it means this element is hidden. To get usable
      // measurements, we must remove `display: none`, but in a manner that 
      // isn't noticeable to the user. That means we also set
      // `visibility: hidden` to make it invisible, and `position: absolute`
      // so that it won't alter the document flow when displayed.
      //
      // Once we do this, the element is "prepared," and we can make our
      // measurements. When we're done, the `_end` method cleans up our
      // changes.
      
      // Remember the original values for some styles we're going to alter.
      var originalStyles = {
        position:   element.style.position   || '',
        width:      element.style.width      || '',
        visibility: element.style.visibility || '',
        display:    element.style.display    || ''
      };
      
      // We store them so that the `_end` method can retrieve them later.
      element.store('prototype_original_styles', originalStyles);
      
      var position = getRawStyle(element, 'position'), width = element.offsetWidth;
      if (width === 0 || width === null) {
        // Opera/IE won't report the true width of the element through
        // `getComputedStyle` if it's hidden. If we got a nonsensical value,
        // we need to show the element and try again.
        element.style.display = 'block';
        width = element.offsetWidth;
      }
      
      // Preserve the context in case we get a percentage value.  
      var context = (position === 'fixed') ? document.viewport :
       element.parentNode;
       
      var tempStyles = {
        visibility: 'hidden',
        display:    'block'
      };
      
      // If the element's `position: fixed`, it's already out of the document
      // flow, so it's both unnecessary and inaccurate to set
      // `position: absolute`.
      if (position !== 'fixed') tempStyles.position = 'absolute';
       
      element.setStyle(tempStyles);
      
      var positionedWidth = element.offsetWidth, newWidth;
      if (width && (positionedWidth === width)) {
        // If the element's width is the same both before and after
        // we set absolute positioning, that means:
        //  (a) it was already absolutely-positioned; or
        //  (b) it has an explicitly-set width, instead of width: auto.
        // Either way, it means the element is the width it needs to be
        // in order to report an accurate height.
        newWidth = getContentWidth(element, context);
      } else if (position === 'absolute' || position === 'fixed') {
        // Absolute- and fixed-position elements' dimensions don't depend
        // upon those of their parents.
        newWidth = getContentWidth(element, context);
      } else {
        // Otherwise, the element's width depends upon the width of its
        // parent.
        var parent = element.parentNode, pLayout = $(parent).getLayout();
        newWidth = pLayout.get('width') -
         this.get('margin-left') -
         this.get('border-left') -
         this.get('padding-left') -
         this.get('padding-right') -
         this.get('border-right') -
         this.get('margin-right');
      }
      
      // Whatever the case, we've now figured out the correct `width` value
      // for the element.
      element.setStyle({ width: newWidth + 'px' });
      
      // The element is now ready for measuring.
      this._setPrepared(true);
    },
    
    _end: function() {
      var element = this.element;
      var originalStyles = element.retrieve('prototype_original_styles');
      element.store('prototype_original_styles', null);
      element.setStyle(originalStyles);
      this._setPrepared(false);
    },
    
    _compute: function(property) {
      var COMPUTATIONS = Element.Layout.COMPUTATIONS;
      if (!(property in COMPUTATIONS)) {
        throw "Property not found.";
      }
      
      return this._set(property, COMPUTATIONS[property].call(this, this.element));
    },
    
    _isPrepared: function() {
      return this.element.retrieve('prototype_element_layout_prepared', false);
    },
    
    _setPrepared: function(bool) {
      return this.element.store('prototype_element_layout_prepared', bool);
    },
    
    toObject: function() {
      var args = $A(arguments);
      var keys = (args.length === 0) ? Element.Layout.PROPERTIES :
       args.join(' ').split(' ');
      var obj = {};
      keys.each( function(key) {
        // Key needs to be a valid Element.Layout property.
        if (!Element.Layout.PROPERTIES.include(key)) return;
        var value = this.get(key);
        if (value != null) obj[key] = value;
      }, this);
      return obj;
    },
    
    toHash: function() {
      var obj = this.toObject.apply(this, arguments);
      return new Hash(obj);
    },
    
    toCSS: function() {
      var args = $A(arguments);
      var keys = (args.length === 0) ? Element.Layout.PROPERTIES :
       args.join(' ').split(' ');
      var css = {};
      keys.each( function(key) {
        // Key needs to be a valid Element.Layout property...
        if (!Element.Layout.PROPERTIES.include(key)) return;        
        // ...but not a composite property.
        if (Element.Layout.COMPOSITE_PROPERTIES.include(key)) return;
        var value = this.get(key);
        if (value != null) css[cssNameFor(key)] = value + 'px';
      }, this);
      return css;
    },
    
    inspect: function() {
      return "#<Element.Layout>";
    }
  });
  
  Object.extend(Element.Layout, {
    PROPERTIES: $w('height width top left right bottom border-left border-right border-top border-bottom padding-left padding-right padding-top padding-bottom margin-top margin-bottom margin-left margin-right padding-box-width padding-box-height border-box-width border-box-height margin-box-width margin-box-height'),
    
    COMPOSITE_PROPERTIES: $w('padding-box-width padding-box-height margin-box-width margin-box-height border-box-width border-box-height'),
    
    COMPUTATIONS: {
      'height': function(element) {
        if (!this._preComputing) this._begin();
        
        var bHeight = this.get('border-box-height');
        if (bHeight <= 0) {
          if (!this._preComputing) this._end();
          return 0;
        }
        
        var bTop = this.get('border-top'),
         bBottom = this.get('border-bottom');
        var pTop = this.get('padding-top'),
         pBottom = this.get('padding-bottom');
        if (!this._preComputing) this._end();
        return bHeight - bTop - bBottom - pTop - pBottom;
      },
      
      'width': function(element) {
        if (!this._preComputing) this._begin();
        
        var bWidth = this.get('border-box-width');
        if (bWidth <= 0) {
          if (!this._preComputing) this._end();
          return 0;
        }
        var bLeft = this.get('border-left'),
         bRight = this.get('border-right');
        var pLeft = this.get('padding-left'),
         pRight = this.get('padding-right');
         
        if (!this._preComputing) this._end();
        return bWidth - bLeft - bRight - pLeft - pRight;
      },
      
      'padding-box-height': function(element) {
        var height = this.get('height'),
         pTop = this.get('padding-top'),
         pBottom = this.get('padding-bottom');
         
        return height + pTop + pBottom;
      },
      'padding-box-width': function(element) {
        var width = this.get('width'),
         pLeft = this.get('padding-left'),
         pRight = this.get('padding-right');
         
        return width + pLeft + pRight;
      },
      
      'border-box-height': function(element) {
        if (!this._preComputing) this._begin();
        var height = element.offsetHeight;
        if (!this._preComputing) this._end();
        return height;
      },
            
      'border-box-width': function(element) {
        if (!this._preComputing) this._begin();
        var width = element.offsetWidth;
        if (!this._preComputing) this._end();
        return width;
      },
      
      'margin-box-height': function(element) {
        var bHeight = this.get('border-box-height'),
         mTop = this.get('margin-top'),
         mBottom = this.get('margin-bottom');
         
        if (bHeight <= 0) return 0;
         
        return bHeight + mTop + mBottom;        
      },
      'margin-box-width': function(element) {
        var bWidth = this.get('border-box-width'),
         mLeft = this.get('margin-left'),
         mRight = this.get('margin-right');
        if (bWidth <= 0) return 0;
         
        return bWidth + mLeft + mRight;
      },
      
      'top': function(element) {
        var offset = element.positionedOffset();
        return offset.top;
      },
      
      'bottom': function(element) {
        var offset = element.positionedOffset(),
         parent = element.getOffsetParent(),
         pHeight = parent.measure('height');
        
        var mHeight = this.get('border-box-height');
        
        return pHeight - mHeight - offset.top;
        // 
        // return getPixelValue(element, 'bottom');
      },
      
      'left': function(element) {
        var offset = element.positionedOffset();
        return offset.left;
      },
      
      'right': function(element) {
        var offset = element.positionedOffset(),
         parent = element.getOffsetParent(),
         pWidth = parent.measure('width');
        
        var mWidth = this.get('border-box-width');
        
        return pWidth - mWidth - offset.left;
        //  
        // return getPixelValue(element, 'right');
      },
      
      'padding-top': function(element) {
        return getPixelValue(element, 'paddingTop');
      },
      
      'padding-bottom': function(element) {
        return getPixelValue(element, 'paddingBottom');
      },
      
      'padding-left': function(element) {
        return getPixelValue(element, 'paddingLeft');
      },
      
      'padding-right': function(element) {
        return getPixelValue(element, 'paddingRight');
      },
      
      'border-top': function(element) {
        return getPixelValue(element, 'borderTopWidth');
      },
      
      'border-bottom': function(element) {
        return getPixelValue(element, 'borderBottomWidth');
      },
      
      'border-left': function(element) {
        return getPixelValue(element, 'borderLeftWidth');
      },
      
      'border-right': function(element) {
        return getPixelValue(element, 'borderRightWidth');
      },
      
      'margin-top': function(element) {
        return getPixelValue(element, 'marginTop');
      },
      
      'margin-bottom': function(element) {
        return getPixelValue(element, 'marginBottom');
      },
      
      'margin-left': function(element) {
        return getPixelValue(element, 'marginLeft');
      },
      
      'margin-right': function(element) {
        return getPixelValue(element, 'marginRight');
      }
    }
  });
  
  // An easier way to compute right and bottom offsets.
  if ('getBoundingClientRect' in document.documentElement) {
    Object.extend(Element.Layout.COMPUTATIONS, {
      'right': function(element) {
        var parent = hasLayout(element.getOffsetParent());
        var rect = element.getBoundingClientRect(),
         pRect = parent.getBoundingClientRect();
         
        return (pRect.right - rect.right).round();
      },
      
      'bottom': function(element) {
        var parent = hasLayout(element.getOffsetParent());
        var rect = element.getBoundingClientRect(),
         pRect = parent.getBoundingClientRect();
         
        return (pRect.bottom - rect.bottom).round();
      }
    });
  }
  
  Element.Offset = Class.create({
    initialize: function(left, top) {
      this.left = left.round();
      this.top  = top.round();
      
      // Act like an array.
      this[0] = this.left;
      this[1] = this.top;
    },
    
    relativeTo: function(offset) {
      return new Element.Offset(
        this.left - offset.left, 
        this.top  - offset.top
      );
    },
    
    inspect: function() {
      return "#<Element.Offset left: #{left} top: #{top}>".interpolate(this);
    },
    
    toString: function() {
      return "[#{left}, #{top}]".interpolate(this);
    },
    
    toArray: function() {
      return [this.left, this.top];
    }
  });
  
  function getLayout(element, preCompute) {
    return new Element.Layout(element, preCompute);
  }
    
  function measure(element, property) {
    return $(element).getLayout().get(property);  
  }
  function getHeight(element) {
    return Element.getDimensions(element).height;
  }
  
  function getWidth(element) {
    return Element.getDimensions(element).width;
  }
  function getDimensions(element) {
    element = $(element);
    var display = Element.getStyle(element, 'display');
    
    if (display && display !== 'none') {
      return { width: element.offsetWidth, height: element.offsetHeight };
    }
    
    // All *Width and *Height properties give 0 on elements with
    // `display: none`, so show the element temporarily.
    var style = element.style;
    var originalStyles = {
      visibility: style.visibility,
      position:   style.position,
      display:    style.display
    };
    
    var newStyles = {
      visibility: 'hidden',
      display:    'block'
    };
    // Switching `fixed` to `absolute` causes issues in Safari.
    if (originalStyles.position !== 'fixed')
      newStyles.position = 'absolute';
    
    Element.setStyle(element, newStyles);
    
    var dimensions = {
      width:  element.offsetWidth,
      height: element.offsetHeight
    };
    
    Element.setStyle(element, originalStyles);
    return dimensions;
  }
  
  function getOffsetParent(element) {
    element = $(element);
    
    // For unusual cases like these, we standardize on returning the BODY
    // element as the offset parent.
    if (isDocument(element) || isDetached(element) || isBody(element) || isHtml(element))
      return $(document.body);
    // IE reports offset parent incorrectly for inline elements.
    var isInline = (Element.getStyle(element, 'display') === 'inline');
    if (!isInline && element.offsetParent) return isHtml(element.offsetParent) ? $(document.body) : $(element.offsetParent);
    
    while ((element = element.parentNode) && element !== document.body) {
      if (Element.getStyle(element, 'position') !== 'static') {
        return isHtml(element) ? $(document.body) : $(element);
      }
    }
    
    return $(document.body);
  }
  
  
  function cumulativeOffset(element) {
    element = $(element);
    var valueT = 0, valueL = 0;
    if (element.parentNode) {
      do {
        valueT += element.offsetTop  || 0;
        valueL += element.offsetLeft || 0;
        element = element.offsetParent;
      } while (element);
    }
    return new Element.Offset(valueL, valueT);
  }
  
  function positionedOffset(element) {    
    element = $(element);
    // Account for the margin of the element.
    var layout = element.getLayout();
    
    var valueT = 0, valueL = 0;
    do {
      valueT += element.offsetTop  || 0;
      valueL += element.offsetLeft || 0;
      element = element.offsetParent;
      if (element) {
        if (isBody(element)) break;
        var p = Element.getStyle(element, 'position');
        if (p !== 'static') break;
      }
    } while (element);
    
    valueT -= layout.get('margin-top');
    valueL -= layout.get('margin-left');
    
    return new Element.Offset(valueL, valueT);
  }
  function cumulativeScrollOffset(element) {
    var valueT = 0, valueL = 0;
    do {
      if(element == document.body){
        valueT += (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop || 0;
        valueL += (window.pageXOffset !== undefined) ? window.pageXOffset : (document.documentElement || document.body.parentNode || document.body).scrollLeft || 0;
        break;
      } else {
        valueT += element.scrollTop  || 0;
        valueL += element.scrollLeft || 0;
        element = element.parentNode;
      }
    } while (element);
    return new Element.Offset(valueL, valueT);
  }
  function viewportOffset(forElement) {
    var valueT = 0, valueL = 0, docBody = document.body;
    forElement = $(forElement);
    var element = forElement;
    do {
      valueT += element.offsetTop  || 0;
      valueL += element.offsetLeft || 0;
      // Safari fix
      if (element.offsetParent == docBody &&
        Element.getStyle(element, 'position') == 'absolute') break;
    } while (element = element.offsetParent);
    element = forElement;
    do {
      // Opera < 9.5 sets scrollTop/Left on both HTML and BODY elements.
      // Other browsers set it only on the HTML element. The BODY element
      // can be skipped since its scrollTop/Left should always be 0.
      if (element != docBody) {
        valueT -= element.scrollTop  || 0;
        valueL -= element.scrollLeft || 0;
      }
    } while (element = element.parentNode);    
    return new Element.Offset(valueL, valueT);
  }
  
  function absolutize(element) {
    element = $(element);
    
    if (Element.getStyle(element, 'position') === 'absolute') {
      return element;
    }
    
    var offsetParent = getOffsetParent(element);    
    var eOffset = element.viewportOffset(),
     pOffset = offsetParent.viewportOffset();
     
    var offset = eOffset.relativeTo(pOffset);
    var layout = element.getLayout();    
    
    element.store('prototype_absolutize_original_styles', {
      position: element.getStyle('position'),
      left:     element.getStyle('left'),
      top:      element.getStyle('top'),
      width:    element.getStyle('width'),
      height:   element.getStyle('height')
    });
    
    element.setStyle({
      position: 'absolute',
      top:    offset.top + 'px',
      left:   offset.left + 'px',
      width:  layout.get('width') + 'px',
      height: layout.get('height') + 'px'
    });
    
    return element;
  }
  
  function relativize(element) {
    element = $(element);
    if (Element.getStyle(element, 'position') === 'relative') {
      return element;
    }
    
    // Restore the original styles as captured by Element#absolutize.
    var originalStyles = 
     element.retrieve('prototype_absolutize_original_styles');
    
    if (originalStyles) element.setStyle(originalStyles);
    return element;
  }
  
  
  function scrollTo(element) {
    element = $(element);
    var pos = Element.cumulativeOffset(element);
    window.scrollTo(pos.left, pos.top);
    return element;
  }
  
  function makePositioned(element) {
    element = $(element);
    var position = Element.getStyle(element, 'position'), styles = {};
    if (position === 'static' || !position) {
      styles.position = 'relative';
      // When an element is `position: relative` with an undefined `top` and
      // `left`, Opera returns the offset relative to positioning context.
      if (Prototype.Browser.Opera) {
        styles.top  = 0;
        styles.left = 0;
      }
      Element.setStyle(element, styles);
      Element.store(element, 'prototype_made_positioned', true);
    }
    return element;
  }
  
  function undoPositioned(element) {
    element = $(element);
    var storage = Element.getStorage(element),
     madePositioned = storage.get('prototype_made_positioned');
    
    if (madePositioned) {
      storage.unset('prototype_made_positioned');
      Element.setStyle(element, {
        position: '',
        top:      '',
        bottom:   '',
        left:     '',
        right:    ''
      });
    }  
    return element;
  }
  
  function makeClipping(element) {
    element = $(element);
    
    var storage = Element.getStorage(element),
     madeClipping = storage.get('prototype_made_clipping');
    
    // The "prototype_made_clipping" storage key is meant to hold the
    // original CSS overflow value. A string value or `null` means that we've
    // called `makeClipping` already. An `undefined` value means we haven't.
    if (Object.isUndefined(madeClipping)) {
      var overflow = Element.getStyle(element, 'overflow');
      storage.set('prototype_made_clipping', overflow);
      if (overflow !== 'hidden')
        element.style.overflow = 'hidden';
    }
    
    return element;
  }
  
  function undoClipping(element) {
    element = $(element);
    var storage = Element.getStorage(element),
     overflow = storage.get('prototype_made_clipping');
    
    if (!Object.isUndefined(overflow)) {
      storage.unset('prototype_made_clipping');
      element.style.overflow = overflow || '';
    }
    
    return element;
  }
  
  function clonePosition(element, source, options) {
    options = Object.extend({
      setLeft:    true,
      setTop:     true,
      setWidth:   true,
      setHeight:  true,
      offsetTop:  0,
      offsetLeft: 0
    }, options || {});
    
    // Find page position of source.    
    source  = $(source);
    element = $(element);    
    var p, delta, layout, styles = {};
    if (options.setLeft || options.setTop) {
      p = Element.viewportOffset(source);
      delta = [0, 0];
      // A delta of 0/0 will work for `positioned: fixed` elements, but
      // for `position: absolute` we need to get the parent's offset.
      if (Element.getStyle(element, 'position') === 'absolute') {
        var parent = Element.getOffsetParent(element);
        if (parent !== document.body) delta = Element.viewportOffset(parent);
      }
    }
    if (options.setWidth || options.setHeight) {
      layout = Element.getLayout(source);
    }
    // Set position.
    if (options.setLeft)
      styles.left = (p[0] - delta[0] + options.offsetLeft) + 'px';
    if (options.setTop)
      styles.top  = (p[1] - delta[1] + options.offsetTop)  + 'px';
    
    if (options.setWidth)
      styles.width  = layout.get('border-box-width')  + 'px';
    if (options.setHeight)
      styles.height = layout.get('border-box-height') + 'px';
    
    return Element.setStyle(element, styles);
  }
  
    
  if (Prototype.Browser.IE) {
    // IE doesn't report offsets correctly for static elements, so we change them
    // to "relative" to get the values, then change them back.
    getOffsetParent = getOffsetParent.wrap(
      function(proceed, element) {
        element = $(element);
        
        // For unusual cases like these, we standardize on returning the BODY
        // element as the offset parent.
        if (isDocument(element) || isDetached(element) || isBody(element) || isHtml(element))
          return $(document.body);
        var position = element.getStyle('position');
        if (position !== 'static') return proceed(element);
        element.setStyle({ position: 'relative' });
        var value = proceed(element);
        element.setStyle({ position: position });
        return value;
      }
    );
    
    positionedOffset = positionedOffset.wrap(function(proceed, element) {
      element = $(element);
      if (!element.parentNode) return new Element.Offset(0, 0);
      var position = element.getStyle('position');
      if (position !== 'static') return proceed(element);
      // Trigger hasLayout on the offset parent so that IE6 reports
      // accurate offsetTop and offsetLeft values for position: fixed.
      var offsetParent = element.getOffsetParent();
      if (offsetParent && offsetParent.getStyle('position') === 'fixed')
        hasLayout(offsetParent);
      element.setStyle({ position: 'relative' });
      var value = proceed(element);
      element.setStyle({ position: position });
      return value;
    });
  } else if (Prototype.Browser.Webkit) {    
    // Safari returns margins on body which is incorrect if the child is absolutely
    // positioned.  For performance reasons, redefine Element#cumulativeOffset for
    // KHTML/WebKit only.
    cumulativeOffset = function(element) {
      element = $(element);
      var valueT = 0, valueL = 0;
      do {
        valueT += element.offsetTop  || 0;
        valueL += element.offsetLeft || 0;
        if (element.offsetParent == document.body) {
          if (Element.getStyle(element, 'position') == 'absolute') break;
        }
        element = element.offsetParent;
      } while (element);
      return new Element.Offset(valueL, valueT);
    };
  }
  
  
  Element.addMethods({
    getLayout:              getLayout,
    measure:                measure,
    getWidth:               getWidth,
    getHeight:              getHeight,
    getDimensions:          getDimensions,
    getOffsetParent:        getOffsetParent,
    cumulativeOffset:       cumulativeOffset,
    positionedOffset:       positionedOffset,
    cumulativeScrollOffset: cumulativeScrollOffset,
    viewportOffset:         viewportOffset,    
    absolutize:             absolutize,
    relativize:             relativize,
    scrollTo:               scrollTo,
    makePositioned:         makePositioned,
    undoPositioned:         undoPositioned,
    makeClipping:           makeClipping,
    undoClipping:           undoClipping,
    clonePosition:          clonePosition
  });
  
  function isBody(element) {
    return element.nodeName.toUpperCase() === 'BODY';
  }
  
  function isHtml(element) {
    return element.nodeName.toUpperCase() === 'HTML';
  }
  
  function isDocument(element) {
    return element.nodeType === Node.DOCUMENT_NODE;
  }
  
  function isDetached(element) {
    return element !== document.body &&
     !Element.descendantOf(element, document.body);
  }
  
  // If the browser supports the nonstandard `getBoundingClientRect`
  // (currently only IE and Firefox), it becomes far easier to obtain
  // true offsets.
  if ('getBoundingClientRect' in document.documentElement) {
    Element.addMethods({
      viewportOffset: function(element) {
        element = $(element);        
        if (isDetached(element)) return new Element.Offset(0, 0);
        var rect = element.getBoundingClientRect(),
         docEl = document.documentElement;
        // The HTML element on IE < 8 has a 2px border by default, giving
        // an incorrect offset. We correct this by subtracting clientTop
        // and clientLeft.
        return new Element.Offset(rect.left - docEl.clientLeft,
         rect.top - docEl.clientTop);
      }
    }); 
  }
  
  
})();
(function() {
  
  var IS_OLD_OPERA = Prototype.Browser.Opera &&
   (window.parseFloat(window.opera.version()) < 9.5);
  var ROOT = null;
  function getRootElement() {
    if (ROOT) return ROOT;    
    ROOT = IS_OLD_OPERA ? document.body : document.documentElement;
    return ROOT;
  }
  function getDimensions() {
    return { width: this.getWidth(), height: this.getHeight() };
  }
  
  function getWidth() {
    return getRootElement().clientWidth;
  }
  
  function getHeight() {
    return getRootElement().clientHeight;
  }
  
  function getScrollOffsets() {
    var x = window.pageXOffset || document.documentElement.scrollLeft ||
     document.body.scrollLeft;
    var y = window.pageYOffset || document.documentElement.scrollTop ||
     document.body.scrollTop;
     
    return new Element.Offset(x, y);
  }
  
  document.viewport = {
    getDimensions:    getDimensions,
    getWidth:         getWidth,
    getHeight:        getHeight,
    getScrollOffsets: getScrollOffsets
  };
  
})();
window.$$ = function() {
  var expression = $A(arguments).join(', ');
  return Prototype.Selector.select(expression, document);
};
Prototype.Selector = (function() {
  
  function select() {
    throw new Error('Method "Prototype.Selector.select" must be defined.');
  }
  function match() {
    throw new Error('Method "Prototype.Selector.match" must be defined.');
  }
  function find(elements, expression, index) {
    index = index || 0;
    var match = Prototype.Selector.match, length = elements.length, matchIndex = 0, i;
    for (i = 0; i < length; i++) {
      if (match(elements[i], expression) && index == matchIndex++) {
        return Element.extend(elements[i]);
      }
    }
  }
  
  function extendElements(elements) {
    for (var i = 0, length = elements.length; i < length; i++) {
      Element.extend(elements[i]);
    }
    return elements;
  }
  
  
  var K = Prototype.K;
  
  return {
    select: select,
    match: match,
    find: find,
    extendElements: (Element.extend === K) ? K : extendElements,
    extendElement: Element.extend
  };
})();
/*!
 * Sizzle CSS Selector Engine v1.9.4-pre
 * http://sizzlejs.com/
 *
 * Copyright 2013 jQuery Foundation, Inc. and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2013-06-03
 */
(function( window, undefined ) {
var i,
	support,
	cachedruns,
	Expr,
	getText,
	isXML,
	compile,
	outermostContext,
	sortInput,
	// Local document vars
	setDocument,
	document,
	docElem,
	documentIsHTML,
	rbuggyQSA,
	rbuggyMatches,
	matches,
	contains,
	// Instance-specific data
	expando = "sizzle" + -(new Date()),
	preferredDoc = window.document,
	dirruns = 0,
	done = 0,
	classCache = createCache(),
	tokenCache = createCache(),
	compilerCache = createCache(),
	hasDuplicate = false,
	sortOrder = function( a, b ) {
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}
		return 0;
	},
	// General-purpose constants
	strundefined = typeof undefined,
	MAX_NEGATIVE = 1 << 31,
	// Instance methods
	hasOwn = ({}).hasOwnProperty,
	arr = [],
	pop = arr.pop,
	push_native = arr.push,
	push = arr.push,
	slice = arr.slice,
	// Use a stripped-down indexOf if we can't use a native one
	indexOf = arr.indexOf || function( elem ) {
		var i = 0,
			len = this.length;
		for ( ; i < len; i++ ) {
			if ( this[i] === elem ) {
				return i;
			}
		}
		return -1;
	},
	booleans = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
	// Regular expressions
	// Whitespace characters http://www.w3.org/TR/css3-selectors/#whitespace
	whitespace = "[\\x20\\t\\r\\n\\f]",
	// http://www.w3.org/TR/css3-syntax/#characters
	characterEncoding = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
	// Loosely modeled on CSS identifier characters
	// An unquoted value should be a CSS identifier http://www.w3.org/TR/css3-selectors/#attribute-selectors
	// Proper syntax: http://www.w3.org/TR/CSS21/syndata.html#value-def-identifier
	identifier = characterEncoding.replace( "w", "w#" ),
	// Acceptable operators http://www.w3.org/TR/selectors/#attribute-selectors
	attributes = "\\[" + whitespace + "*(" + characterEncoding + ")" + whitespace +
		"*(?:([*^$|!~]?=)" + whitespace + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + identifier + ")|)|)" + whitespace + "*\\]",
	// Prefer arguments quoted,
	//   then not containing pseudos/brackets,
	//   then attribute selectors/non-parenthetical expressions,
	//   then anything else
	// These preferences are here to reduce the number of selectors
	//   needing tokenize in the PSEUDO preFilter
	pseudos = ":(" + characterEncoding + ")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + attributes.replace( 3, 8 ) + ")*)|.*)\\)|)",
	// Leading and non-escaped trailing whitespace, capturing some non-whitespace characters preceding the latter
	rtrim = new RegExp( "^" + whitespace + "+|((?:^|[^\\\\])(?:\\\\.)*)" + whitespace + "+$", "g" ),
	rcomma = new RegExp( "^" + whitespace + "*," + whitespace + "*" ),
	rcombinators = new RegExp( "^" + whitespace + "*([>+~]|" + whitespace + ")" + whitespace + "*" ),
	rsibling = new RegExp( whitespace + "*[+~]" ),
	rattributeQuotes = new RegExp( "=" + whitespace + "*([^\\]'\"]*)" + whitespace + "*\\]", "g" ),
	rpseudo = new RegExp( pseudos ),
	ridentifier = new RegExp( "^" + identifier + "$" ),
	matchExpr = {
		"ID": new RegExp( "^#(" + characterEncoding + ")" ),
		"CLASS": new RegExp( "^\\.(" + characterEncoding + ")" ),
		"TAG": new RegExp( "^(" + characterEncoding.replace( "w", "w*" ) + ")" ),
		"ATTR": new RegExp( "^" + attributes ),
		"PSEUDO": new RegExp( "^" + pseudos ),
		"CHILD": new RegExp( "^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + whitespace +
			"*(even|odd|(([+-]|)(\\d*)n|)" + whitespace + "*(?:([+-]|)" + whitespace +
			"*(\\d+)|))" + whitespace + "*\\)|)", "i" ),
		"bool": new RegExp( "^(?:" + booleans + ")$", "i" ),
		// For use in libraries implementing .is()
		// We use this for POS matching in `select`
		"needsContext": new RegExp( "^" + whitespace + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" +
			whitespace + "*((?:-\\d)?\\d*)" + whitespace + "*\\)|)(?=[^-]|$)", "i" )
	},
	rnative = /^[^{]+\{\s*\[native \w/,
	// Easily-parseable/retrievable ID or TAG or CLASS selectors
	rquickExpr = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
	rinputs = /^(?:input|select|textarea|button)$/i,
	rheader = /^h\d$/i,
	rescape = /'|\\/g,
	// CSS escapes http://www.w3.org/TR/CSS21/syndata.html#escaped-characters
	runescape = new RegExp( "\\\\([\\da-f]{1,6}" + whitespace + "?|(" + whitespace + ")|.)", "ig" ),
	funescape = function( _, escaped, escapedWhitespace ) {
		var high = "0x" + escaped - 0x10000;
		// NaN means non-codepoint
		// Support: Firefox
		// Workaround erroneous numeric interpretation of +"0x"
		return high !== high || escapedWhitespace ?
			escaped :
			// BMP codepoint
			high < 0 ?
				String.fromCharCode( high + 0x10000 ) :
				// Supplemental Plane codepoint (surrogate pair)
				String.fromCharCode( high >> 10 | 0xD800, high & 0x3FF | 0xDC00 );
	};
try {
	push.apply(
		(arr = slice.call( preferredDoc.childNodes )),
		preferredDoc.childNodes
	);
	// Support: Android<4.0
	// Detect silently failing push.apply
	arr[ preferredDoc.childNodes.length ].nodeType;
} catch ( e ) {
	push = { apply: arr.length ?
		// Leverage slice if possible
		function( target, els ) {
			push_native.apply( target, slice.call(els) );
		} :
		// Support: IE<9
		// Otherwise append directly
		function( target, els ) {
			var j = target.length,
				i = 0;
			// Can't trust NodeList.length
			while ( (target[j++] = els[i++]) ) {}
			target.length = j - 1;
		}
	};
}
function Sizzle( selector, context, results, seed ) {
	var match, elem, m, nodeType,
		// QSA vars
		i, groups, old, nid, newContext, newSelector;
	if ( ( context ? context.ownerDocument || context : preferredDoc ) !== document ) {
		setDocument( context );
	}
	context = context || document;
	results = results || [];
	if ( !selector || typeof selector !== "string" ) {
		return results;
	}
	if ( (nodeType = context.nodeType) !== 1 && nodeType !== 9 ) {
		return [];
	}
	if ( documentIsHTML && !seed ) {
		// Shortcuts
		if ( (match = rquickExpr.exec( selector )) ) {
			// Speed-up: Sizzle("#ID")
			if ( (m = match[1]) ) {
				if ( nodeType === 9 ) {
					elem = context.getElementById( m );
					// Check parentNode to catch when Blackberry 4.6 returns
					// nodes that are no longer in the document #6963
					if ( elem && elem.parentNode ) {
						// Handle the case where IE, Opera, and Webkit return items
						// by name instead of ID
						if ( elem.id === m ) {
							results.push( elem );
							return results;
						}
					} else {
						return results;
					}
				} else {
					// Context is not a document
					if ( context.ownerDocument && (elem = context.ownerDocument.getElementById( m )) &&
						contains( context, elem ) && elem.id === m ) {
						results.push( elem );
						return results;
					}
				}
			// Speed-up: Sizzle("TAG")
			} else if ( match[2] ) {
				push.apply( results, context.getElementsByTagName( selector ) );
				return results;
			// Speed-up: Sizzle(".CLASS")
			} else if ( (m = match[3]) && support.getElementsByClassName && context.getElementsByClassName ) {
				push.apply( results, context.getElementsByClassName( m ) );
				return results;
			}
		}
		// QSA path
		if ( support.qsa && (!rbuggyQSA || !rbuggyQSA.test( selector )) ) {
			nid = old = expando;
			newContext = context;
			newSelector = nodeType === 9 && selector;
			// qSA works strangely on Element-rooted queries
			// We can work around this by specifying an extra ID on the root
			// and working up from there (Thanks to Andrew Dupont for the technique)
			// IE 8 doesn't work on object elements
			if ( nodeType === 1 && context.nodeName.toLowerCase() !== "object" ) {
				groups = tokenize( selector );
				if ( (old = context.getAttribute("id")) ) {
					nid = old.replace( rescape, "\\$&" );
				} else {
					context.setAttribute( "id", nid );
				}
				nid = "[id='" + nid + "'] ";
				i = groups.length;
				while ( i-- ) {
					groups[i] = nid + toSelector( groups[i] );
				}
				newContext = rsibling.test( selector ) && context.parentNode || context;
				newSelector = groups.join(",");
			}
			if ( newSelector ) {
				try {
					push.apply( results,
						newContext.querySelectorAll( newSelector )
					);
					return results;
				} catch(qsaError) {
				} finally {
					if ( !old ) {
						context.removeAttribute("id");
					}
				}
			}
		}
	}
	// All others
	return select( selector.replace( rtrim, "$1" ), context, results, seed );
}
function createCache() {
	var keys = [];
	function cache( key, value ) {
		// Use (key + " ") to avoid collision with native prototype properties (see Issue #157)
		if ( keys.push( key += " " ) > Expr.cacheLength ) {
			// Only keep the most recent entries
			delete cache[ keys.shift() ];
		}
		return (cache[ key ] = value);
	}
	return cache;
}
function markFunction( fn ) {
	fn[ expando ] = true;
	return fn;
}
function assert( fn ) {
	var div = document.createElement("div");
	try {
		return !!fn( div );
	} catch (e) {
		return false;
	} finally {
		// Remove from its parent by default
		if ( div.parentNode ) {
			div.parentNode.removeChild( div );
		}
		// release memory in IE
		div = null;
	}
}
function addHandle( attrs, handler ) {
	var arr = attrs.split("|"),
		i = attrs.length;
	while ( i-- ) {
		Expr.attrHandle[ arr[i] ] = handler;
	}
}
function siblingCheck( a, b ) {
	var cur = b && a,
		diff = cur && a.nodeType === 1 && b.nodeType === 1 &&
			( ~b.sourceIndex || MAX_NEGATIVE ) -
			( ~a.sourceIndex || MAX_NEGATIVE );
	// Use IE sourceIndex if available on both nodes
	if ( diff ) {
		return diff;
	}
	// Check if b follows a
	if ( cur ) {
		while ( (cur = cur.nextSibling) ) {
			if ( cur === b ) {
				return -1;
			}
		}
	}
	return a ? 1 : -1;
}
function createInputPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return name === "input" && elem.type === type;
	};
}
function createButtonPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return (name === "input" || name === "button") && elem.type === type;
	};
}
function createPositionalPseudo( fn ) {
	return markFunction(function( argument ) {
		argument = +argument;
		return markFunction(function( seed, matches ) {
			var j,
				matchIndexes = fn( [], seed.length, argument ),
				i = matchIndexes.length;
			// Match elements found at the specified indexes
			while ( i-- ) {
				if ( seed[ (j = matchIndexes[i]) ] ) {
					seed[j] = !(matches[j] = seed[j]);
				}
			}
		});
	});
}
isXML = Sizzle.isXML = function( elem ) {
	// documentElement is verified for cases where it doesn't yet exist
	// (such as loading iframes in IE - #4833)
	var documentElement = elem && (elem.ownerDocument || elem).documentElement;
	return documentElement ? documentElement.nodeName !== "HTML" : false;
};
support = Sizzle.support = {};
setDocument = Sizzle.setDocument = function( node ) {
	var doc = node ? node.ownerDocument || node : preferredDoc,
		parent = doc.defaultView;
	// If no document and documentElement is available, return
	if ( doc === document || doc.nodeType !== 9 || !doc.documentElement ) {
		return document;
	}
	// Set our document
	document = doc;
	docElem = doc.documentElement;
	// Support tests
	documentIsHTML = !isXML( doc );
	// Support: IE>8
	// If iframe document is assigned to "document" variable and if iframe has been reloaded,
	// IE will throw "permission denied" error when accessing "document" variable, see jQuery #13936
	// IE6-8 do not support the defaultView property so parent will be undefined
	if ( parent && parent.attachEvent && parent !== parent.top ) {
		parent.attachEvent( "onbeforeunload", function() {
			setDocument();
		});
	}
	/* Attributes
	---------------------------------------------------------------------- */
	// Support: IE<8
	// Verify that getAttribute really returns attributes and not properties (excepting IE8 booleans)
	support.attributes = assert(function( div ) {
		div.className = "i";
		return !div.getAttribute("className");
	});
	/* getElement(s)By*
	---------------------------------------------------------------------- */
	// Check if getElementsByTagName("*") returns only elements
	support.getElementsByTagName = assert(function( div ) {
		div.appendChild( doc.createComment("") );
		return !div.getElementsByTagName("*").length;
	});
	// Check if getElementsByClassName can be trusted
	support.getElementsByClassName = assert(function( div ) {
		div.innerHTML = "<div class='a'></div><div class='a i'></div>";
		// Support: Safari<4
		// Catch class over-caching
		div.firstChild.className = "i";
		// Support: Opera<10
		// Catch gEBCN failure to find non-leading classes
		return div.getElementsByClassName("i").length === 2;
	});
	// Support: IE<10
	// Check if getElementById returns elements by name
	// The broken getElementById methods don't pick up programatically-set names,
	// so use a roundabout getElementsByName test
	support.getById = assert(function( div ) {
		docElem.appendChild( div ).id = expando;
		return !doc.getElementsByName || !doc.getElementsByName( expando ).length;
	});
	// ID find and filter
	if ( support.getById ) {
		Expr.find["ID"] = function( id, context ) {
			if ( typeof context.getElementById !== strundefined && documentIsHTML ) {
				var m = context.getElementById( id );
				// Check parentNode to catch when Blackberry 4.6 returns
				// nodes that are no longer in the document #6963
				return m && m.parentNode ? [m] : [];
			}
		};
		Expr.filter["ID"] = function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				return elem.getAttribute("id") === attrId;
			};
		};
	} else {
		// Support: IE6/7
		// getElementById is not reliable as a find shortcut
		delete Expr.find["ID"];
		Expr.filter["ID"] =  function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				var node = typeof elem.getAttributeNode !== strundefined && elem.getAttributeNode("id");
				return node && node.value === attrId;
			};
		};
	}
	// Tag
	Expr.find["TAG"] = support.getElementsByTagName ?
		function( tag, context ) {
			if ( typeof context.getElementsByTagName !== strundefined ) {
				return context.getElementsByTagName( tag );
			}
		} :
		function( tag, context ) {
			var elem,
				tmp = [],
				i = 0,
				results = context.getElementsByTagName( tag );
			// Filter out possible comments
			if ( tag === "*" ) {
				while ( (elem = results[i++]) ) {
					if ( elem.nodeType === 1 ) {
						tmp.push( elem );
					}
				}
				return tmp;
			}
			return results;
		};
	// Class
	Expr.find["CLASS"] = support.getElementsByClassName && function( className, context ) {
		if ( typeof context.getElementsByClassName !== strundefined && documentIsHTML ) {
			return context.getElementsByClassName( className );
		}
	};
	/* QSA/matchesSelector
	---------------------------------------------------------------------- */
	// QSA and matchesSelector support
	// matchesSelector(:active) reports false when true (IE9/Opera 11.5)
	rbuggyMatches = [];
	// qSa(:focus) reports false when true (Chrome 21)
	// We allow this because of a bug in IE8/9 that throws an error
	// whenever `document.activeElement` is accessed on an iframe
	// So, we allow :focus to pass through QSA all the time to avoid the IE error
	// See http://bugs.jquery.com/ticket/13378
	rbuggyQSA = [];
	if ( (support.qsa = rnative.test( doc.querySelectorAll )) ) {
		// Build QSA regex
		// Regex strategy adopted from Diego Perini
		assert(function( div ) {
			// Select is set to empty string on purpose
			// This is to test IE's treatment of not explicitly
			// setting a boolean content attribute,
			// since its presence should be enough
			// http://bugs.jquery.com/ticket/12359
			div.innerHTML = "<select><option selected=''></option></select>";
			// Support: IE8
			// Boolean attributes and "value" are not treated correctly
			if ( !div.querySelectorAll("[selected]").length ) {
				rbuggyQSA.push( "\\[" + whitespace + "*(?:value|" + booleans + ")" );
			}
			// Webkit/Opera - :checked should return selected option elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			// IE8 throws error here and will not see later tests
			if ( !div.querySelectorAll(":checked").length ) {
				rbuggyQSA.push(":checked");
			}
		});
		assert(function( div ) {
			// Support: Opera 10-12/IE8
			// ^= $= *= and empty values
			// Should not select anything
			// Support: Windows 8 Native Apps
			// The type attribute is restricted during .innerHTML assignment
			var input = doc.createElement("input");
			input.setAttribute( "type", "hidden" );
			div.appendChild( input ).setAttribute( "t", "" );
			if ( div.querySelectorAll("[t^='']").length ) {
				rbuggyQSA.push( "[*^$]=" + whitespace + "*(?:''|\"\")" );
			}
			// FF 3.5 - :enabled/:disabled and hidden elements (hidden elements are still enabled)
			// IE8 throws error here and will not see later tests
			if ( !div.querySelectorAll(":enabled").length ) {
				rbuggyQSA.push( ":enabled", ":disabled" );
			}
			// Opera 10-11 does not throw on post-comma invalid pseudos
			div.querySelectorAll("*,:x");
			rbuggyQSA.push(",.*:");
		});
	}
	if ( (support.matchesSelector = rnative.test( (matches = docElem.webkitMatchesSelector ||
		docElem.mozMatchesSelector ||
		docElem.oMatchesSelector ||
		docElem.msMatchesSelector) )) ) {
		assert(function( div ) {
			// Check to see if it's possible to do matchesSelector
			// on a disconnected node (IE 9)
			support.disconnectedMatch = matches.call( div, "div" );
			// This should fail with an exception
			// Gecko does not error, returns false instead
			matches.call( div, "[s!='']:x" );
			rbuggyMatches.push( "!=", pseudos );
		});
	}
	rbuggyQSA = rbuggyQSA.length && new RegExp( rbuggyQSA.join("|") );
	rbuggyMatches = rbuggyMatches.length && new RegExp( rbuggyMatches.join("|") );
	/* Contains
	---------------------------------------------------------------------- */
	// Element contains another
	// Purposefully does not implement inclusive descendent
	// As in, an element does not contain itself
	contains = rnative.test( docElem.contains ) || docElem.compareDocumentPosition ?
		function( a, b ) {
			var adown = a.nodeType === 9 ? a.documentElement : a,
				bup = b && b.parentNode;
			return a === bup || !!( bup && bup.nodeType === 1 && (
				adown.contains ?
					adown.contains( bup ) :
					a.compareDocumentPosition && a.compareDocumentPosition( bup ) & 16
			));
		} :
		function( a, b ) {
			if ( b ) {
				while ( (b = b.parentNode) ) {
					if ( b === a ) {
						return true;
					}
				}
			}
			return false;
		};
	/* Sorting
	---------------------------------------------------------------------- */
	// Document order sorting
	sortOrder = docElem.compareDocumentPosition ?
	function( a, b ) {
		// Flag for duplicate removal
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}
		var compare = b.compareDocumentPosition && a.compareDocumentPosition && a.compareDocumentPosition( b );
		if ( compare ) {
			// Disconnected nodes
			if ( compare & 1 ||
				(!support.sortDetached && b.compareDocumentPosition( a ) === compare) ) {
				// Choose the first element that is related to our preferred document
				if ( a === doc || contains(preferredDoc, a) ) {
					return -1;
				}
				if ( b === doc || contains(preferredDoc, b) ) {
					return 1;
				}
				// Maintain original order
				return sortInput ?
					( indexOf.call( sortInput, a ) - indexOf.call( sortInput, b ) ) :
					0;
			}
			return compare & 4 ? -1 : 1;
		}
		// Not directly comparable, sort on existence of method
		return a.compareDocumentPosition ? -1 : 1;
	} :
	function( a, b ) {
		var cur,
			i = 0,
			aup = a.parentNode,
			bup = b.parentNode,
			ap = [ a ],
			bp = [ b ];
		// Exit early if the nodes are identical
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		// Parentless nodes are either documents or disconnected
		} else if ( !aup || !bup ) {
			return a === doc ? -1 :
				b === doc ? 1 :
				aup ? -1 :
				bup ? 1 :
				sortInput ?
				( indexOf.call( sortInput, a ) - indexOf.call( sortInput, b ) ) :
				0;
		// If the nodes are siblings, we can do a quick check
		} else if ( aup === bup ) {
			return siblingCheck( a, b );
		}
		// Otherwise we need full lists of their ancestors for comparison
		cur = a;
		while ( (cur = cur.parentNode) ) {
			ap.unshift( cur );
		}
		cur = b;
		while ( (cur = cur.parentNode) ) {
			bp.unshift( cur );
		}
		// Walk down the tree looking for a discrepancy
		while ( ap[i] === bp[i] ) {
			i++;
		}
		return i ?
			// Do a sibling check if the nodes have a common ancestor
			siblingCheck( ap[i], bp[i] ) :
			// Otherwise nodes in our document sort first
			ap[i] === preferredDoc ? -1 :
			bp[i] === preferredDoc ? 1 :
			0;
	};
	return doc;
};
Sizzle.matches = function( expr, elements ) {
	return Sizzle( expr, null, null, elements );
};
Sizzle.matchesSelector = function( elem, expr ) {
	// Set document vars if needed
	if ( ( elem.ownerDocument || elem ) !== document ) {
		setDocument( elem );
	}
	// Make sure that attribute selectors are quoted
	expr = expr.replace( rattributeQuotes, "='$1']" );
	if ( support.matchesSelector && documentIsHTML &&
		( !rbuggyMatches || !rbuggyMatches.test( expr ) ) &&
		( !rbuggyQSA     || !rbuggyQSA.test( expr ) ) ) {
		try {
			var ret = matches.call( elem, expr );
			// IE 9's matchesSelector returns false on disconnected nodes
			if ( ret || support.disconnectedMatch ||
					// As well, disconnected nodes are said to be in a document
					// fragment in IE 9
					elem.document && elem.document.nodeType !== 11 ) {
				return ret;
			}
		} catch(e) {}
	}
	return Sizzle( expr, document, null, [elem] ).length > 0;
};
Sizzle.contains = function( context, elem ) {
	// Set document vars if needed
	if ( ( context.ownerDocument || context ) !== document ) {
		setDocument( context );
	}
	return contains( context, elem );
};
Sizzle.attr = function( elem, name ) {
	// Set document vars if needed
	if ( ( elem.ownerDocument || elem ) !== document ) {
		setDocument( elem );
	}
	var fn = Expr.attrHandle[ name.toLowerCase() ],
		// Don't get fooled by Object.prototype properties (jQuery #13807)
		val = fn && hasOwn.call( Expr.attrHandle, name.toLowerCase() ) ?
			fn( elem, name, !documentIsHTML ) :
			undefined;
	return val === undefined ?
		support.attributes || !documentIsHTML ?
			elem.getAttribute( name ) :
			(val = elem.getAttributeNode(name)) && val.specified ?
				val.value :
				null :
		val;
};
Sizzle.error = function( msg ) {
	throw new Error( "Syntax error, unrecognized expression: " + msg );
};
Sizzle.uniqueSort = function( results ) {
	var elem,
		duplicates = [],
		j = 0,
		i = 0;
	// Unless we *know* we can detect duplicates, assume their presence
	hasDuplicate = !support.detectDuplicates;
	sortInput = !support.sortStable && results.slice( 0 );
	results.sort( sortOrder );
	if ( hasDuplicate ) {
		while ( (elem = results[i++]) ) {
			if ( elem === results[ i ] ) {
				j = duplicates.push( i );
			}
		}
		while ( j-- ) {
			results.splice( duplicates[ j ], 1 );
		}
	}
	return results;
};
getText = Sizzle.getText = function( elem ) {
	var node,
		ret = "",
		i = 0,
		nodeType = elem.nodeType;
	if ( !nodeType ) {
		// If no nodeType, this is expected to be an array
		for ( ; (node = elem[i]); i++ ) {
			// Do not traverse comment nodes
			ret += getText( node );
		}
	} else if ( nodeType === 1 || nodeType === 9 || nodeType === 11 ) {
		// Use textContent for elements
		// innerText usage removed for consistency of new lines (see #11153)
		if ( typeof elem.textContent === "string" ) {
			return elem.textContent;
		} else {
			// Traverse its children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				ret += getText( elem );
			}
		}
	} else if ( nodeType === 3 || nodeType === 4 ) {
		return elem.nodeValue;
	}
	// Do not include comment or processing instruction nodes
	return ret;
};
Expr = Sizzle.selectors = {
	// Can be adjusted by the user
	cacheLength: 50,
	createPseudo: markFunction,
	match: matchExpr,
	attrHandle: {},
	find: {},
	relative: {
		">": { dir: "parentNode", first: true },
		" ": { dir: "parentNode" },
		"+": { dir: "previousSibling", first: true },
		"~": { dir: "previousSibling" }
	},
	preFilter: {
		"ATTR": function( match ) {
			match[1] = match[1].replace( runescape, funescape );
			// Move the given value to match[3] whether quoted or unquoted
			match[3] = ( match[4] || match[5] || "" ).replace( runescape, funescape );
			if ( match[2] === "~=" ) {
				match[3] = " " + match[3] + " ";
			}
			return match.slice( 0, 4 );
		},
		"CHILD": function( match ) {
			/* matches from matchExpr["CHILD"]
				1 type (only|nth|...)
				2 what (child|of-type)
				3 argument (even|odd|\d*|\d*n([+-]\d+)?|...)
				4 xn-component of xn+y argument ([+-]?\d*n|)
				5 sign of xn-component
				6 x of xn-component
				7 sign of y-component
				8 y of y-component
			*/
			match[1] = match[1].toLowerCase();
			if ( match[1].slice( 0, 3 ) === "nth" ) {
				// nth-* requires argument
				if ( !match[3] ) {
					Sizzle.error( match[0] );
				}
				// numeric x and y parameters for Expr.filter.CHILD
				// remember that false/true cast respectively to 0/1
				match[4] = +( match[4] ? match[5] + (match[6] || 1) : 2 * ( match[3] === "even" || match[3] === "odd" ) );
				match[5] = +( ( match[7] + match[8] ) || match[3] === "odd" );
			// other types prohibit arguments
			} else if ( match[3] ) {
				Sizzle.error( match[0] );
			}
			return match;
		},
		"PSEUDO": function( match ) {
			var excess,
				unquoted = !match[5] && match[2];
			if ( matchExpr["CHILD"].test( match[0] ) ) {
				return null;
			}
			// Accept quoted arguments as-is
			if ( match[3] && match[4] !== undefined ) {
				match[2] = match[4];
			// Strip excess characters from unquoted arguments
			} else if ( unquoted && rpseudo.test( unquoted ) &&
				// Get excess from tokenize (recursively)
				(excess = tokenize( unquoted, true )) &&
				// advance to the next closing parenthesis
				(excess = unquoted.indexOf( ")", unquoted.length - excess ) - unquoted.length) ) {
				// excess is a negative index
				match[0] = match[0].slice( 0, excess );
				match[2] = unquoted.slice( 0, excess );
			}
			// Return only captures needed by the pseudo filter method (type and argument)
			return match.slice( 0, 3 );
		}
	},
	filter: {
		"TAG": function( nodeNameSelector ) {
			var nodeName = nodeNameSelector.replace( runescape, funescape ).toLowerCase();
			return nodeNameSelector === "*" ?
				function() { return true; } :
				function( elem ) {
					return elem.nodeName && elem.nodeName.toLowerCase() === nodeName;
				};
		},
		"CLASS": function( className ) {
			var pattern = classCache[ className + " " ];
			return pattern ||
				(pattern = new RegExp( "(^|" + whitespace + ")" + className + "(" + whitespace + "|$)" )) &&
				classCache( className, function( elem ) {
					return pattern.test( typeof elem.className === "string" && elem.className || typeof elem.getAttribute !== strundefined && elem.getAttribute("class") || "" );
				});
		},
		"ATTR": function( name, operator, check ) {
			return function( elem ) {
				var result = Sizzle.attr( elem, name );
				if ( result == null ) {
					return operator === "!=";
				}
				if ( !operator ) {
					return true;
				}
				result += "";
				return operator === "=" ? result === check :
					operator === "!=" ? result !== check :
					operator === "^=" ? check && result.indexOf( check ) === 0 :
					operator === "*=" ? check && result.indexOf( check ) > -1 :
					operator === "$=" ? check && result.slice( -check.length ) === check :
					operator === "~=" ? ( " " + result + " " ).indexOf( check ) > -1 :
					operator === "|=" ? result === check || result.slice( 0, check.length + 1 ) === check + "-" :
					false;
			};
		},
		"CHILD": function( type, what, argument, first, last ) {
			var simple = type.slice( 0, 3 ) !== "nth",
				forward = type.slice( -4 ) !== "last",
				ofType = what === "of-type";
			return first === 1 && last === 0 ?
				// Shortcut for :nth-*(n)
				function( elem ) {
					return !!elem.parentNode;
				} :
				function( elem, context, xml ) {
					var cache, outerCache, node, diff, nodeIndex, start,
						dir = simple !== forward ? "nextSibling" : "previousSibling",
						parent = elem.parentNode,
						name = ofType && elem.nodeName.toLowerCase(),
						useCache = !xml && !ofType;
					if ( parent ) {
						// :(first|last|only)-(child|of-type)
						if ( simple ) {
							while ( dir ) {
								node = elem;
								while ( (node = node[ dir ]) ) {
									if ( ofType ? node.nodeName.toLowerCase() === name : node.nodeType === 1 ) {
										return false;
									}
								}
								// Reverse direction for :only-* (if we haven't yet done so)
								start = dir = type === "only" && !start && "nextSibling";
							}
							return true;
						}
						start = [ forward ? parent.firstChild : parent.lastChild ];
						// non-xml :nth-child(...) stores cache data on `parent`
						if ( forward && useCache ) {
							// Seek `elem` from a previously-cached index
							outerCache = parent[ expando ] || (parent[ expando ] = {});
							cache = outerCache[ type ] || [];
							nodeIndex = cache[0] === dirruns && cache[1];
							diff = cache[0] === dirruns && cache[2];
							node = nodeIndex && parent.childNodes[ nodeIndex ];
							while ( (node = ++nodeIndex && node && node[ dir ] ||
								// Fallback to seeking `elem` from the start
								(diff = nodeIndex = 0) || start.pop()) ) {
								// When found, cache indexes on `parent` and break
								if ( node.nodeType === 1 && ++diff && node === elem ) {
									outerCache[ type ] = [ dirruns, nodeIndex, diff ];
									break;
								}
							}
						// Use previously-cached element index if available
						} else if ( useCache && (cache = (elem[ expando ] || (elem[ expando ] = {}))[ type ]) && cache[0] === dirruns ) {
							diff = cache[1];
						// xml :nth-child(...) or :nth-last-child(...) or :nth(-last)?-of-type(...)
						} else {
							// Use the same loop as above to seek `elem` from the start
							while ( (node = ++nodeIndex && node && node[ dir ] ||
								(diff = nodeIndex = 0) || start.pop()) ) {
								if ( ( ofType ? node.nodeName.toLowerCase() === name : node.nodeType === 1 ) && ++diff ) {
									// Cache the index of each encountered element
									if ( useCache ) {
										(node[ expando ] || (node[ expando ] = {}))[ type ] = [ dirruns, diff ];
									}
									if ( node === elem ) {
										break;
									}
								}
							}
						}
						// Incorporate the offset, then check against cycle size
						diff -= last;
						return diff === first || ( diff % first === 0 && diff / first >= 0 );
					}
				};
		},
		"PSEUDO": function( pseudo, argument ) {
			// pseudo-class names are case-insensitive
			// http://www.w3.org/TR/selectors/#pseudo-classes
			// Prioritize by case sensitivity in case custom pseudos are added with uppercase letters
			// Remember that setFilters inherits from pseudos
			var args,
				fn = Expr.pseudos[ pseudo ] || Expr.setFilters[ pseudo.toLowerCase() ] ||
					Sizzle.error( "unsupported pseudo: " + pseudo );
			// The user may use createPseudo to indicate that
			// arguments are needed to create the filter function
			// just as Sizzle does
			if ( fn[ expando ] ) {
				return fn( argument );
			}
			// But maintain support for old signatures
			if ( fn.length > 1 ) {
				args = [ pseudo, pseudo, "", argument ];
				return Expr.setFilters.hasOwnProperty( pseudo.toLowerCase() ) ?
					markFunction(function( seed, matches ) {
						var idx,
							matched = fn( seed, argument ),
							i = matched.length;
						while ( i-- ) {
							idx = indexOf.call( seed, matched[i] );
							seed[ idx ] = !( matches[ idx ] = matched[i] );
						}
					}) :
					function( elem ) {
						return fn( elem, 0, args );
					};
			}
			return fn;
		}
	},
	pseudos: {
		// Potentially complex pseudos
		"not": markFunction(function( selector ) {
			// Trim the selector passed to compile
			// to avoid treating leading and trailing
			// spaces as combinators
			var input = [],
				results = [],
				matcher = compile( selector.replace( rtrim, "$1" ) );
			return matcher[ expando ] ?
				markFunction(function( seed, matches, context, xml ) {
					var elem,
						unmatched = matcher( seed, null, xml, [] ),
						i = seed.length;
					// Match elements unmatched by `matcher`
					while ( i-- ) {
						if ( (elem = unmatched[i]) ) {
							seed[i] = !(matches[i] = elem);
						}
					}
				}) :
				function( elem, context, xml ) {
					input[0] = elem;
					matcher( input, null, xml, results );
					return !results.pop();
				};
		}),
		"has": markFunction(function( selector ) {
			return function( elem ) {
				return Sizzle( selector, elem ).length > 0;
			};
		}),
		"contains": markFunction(function( text ) {
			return function( elem ) {
				return ( elem.textContent || elem.innerText || getText( elem ) ).indexOf( text ) > -1;
			};
		}),
		// "Whether an element is represented by a :lang() selector
		// is based solely on the element's language value
		// being equal to the identifier C,
		// or beginning with the identifier C immediately followed by "-".
		// The matching of C against the element's language value is performed case-insensitively.
		// The identifier C does not have to be a valid language name."
		// http://www.w3.org/TR/selectors/#lang-pseudo
		"lang": markFunction( function( lang ) {
			// lang value must be a valid identifier
			if ( !ridentifier.test(lang || "") ) {
				Sizzle.error( "unsupported lang: " + lang );
			}
			lang = lang.replace( runescape, funescape ).toLowerCase();
			return function( elem ) {
				var elemLang;
				do {
					if ( (elemLang = documentIsHTML ?
						elem.lang :
						elem.getAttribute("xml:lang") || elem.getAttribute("lang")) ) {
						elemLang = elemLang.toLowerCase();
						return elemLang === lang || elemLang.indexOf( lang + "-" ) === 0;
					}
				} while ( (elem = elem.parentNode) && elem.nodeType === 1 );
				return false;
			};
		}),
		// Miscellaneous
		"target": function( elem ) {
			var hash = window.location && window.location.hash;
			return hash && hash.slice( 1 ) === elem.id;
		},
		"root": function( elem ) {
			return elem === docElem;
		},
		"focus": function( elem ) {
			return elem === document.activeElement && (!document.hasFocus || document.hasFocus()) && !!(elem.type || elem.href || ~elem.tabIndex);
		},
		// Boolean properties
		"enabled": function( elem ) {
			return elem.disabled === false;
		},
		"disabled": function( elem ) {
			return elem.disabled === true;
		},
		"checked": function( elem ) {
			// In CSS3, :checked should return both checked and selected elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			var nodeName = elem.nodeName.toLowerCase();
			return (nodeName === "input" && !!elem.checked) || (nodeName === "option" && !!elem.selected);
		},
		"selected": function( elem ) {
			// Accessing this property makes selected-by-default
			// options in Safari work properly
			if ( elem.parentNode ) {
				elem.parentNode.selectedIndex;
			}
			return elem.selected === true;
		},
		// Contents
		"empty": function( elem ) {
			// http://www.w3.org/TR/selectors/#empty-pseudo
			// :empty is only affected by element nodes and content nodes(including text(3), cdata(4)),
			//   not comment, processing instructions, or others
			// Thanks to Diego Perini for the nodeName shortcut
			//   Greater than "@" means alpha characters (specifically not starting with "#" or "?")
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				if ( elem.nodeName > "@" || elem.nodeType === 3 || elem.nodeType === 4 ) {
					return false;
				}
			}
			return true;
		},
		"parent": function( elem ) {
			return !Expr.pseudos["empty"]( elem );
		},
		// Element/input types
		"header": function( elem ) {
			return rheader.test( elem.nodeName );
		},
		"input": function( elem ) {
			return rinputs.test( elem.nodeName );
		},
		"button": function( elem ) {
			var name = elem.nodeName.toLowerCase();
			return name === "input" && elem.type === "button" || name === "button";
		},
		"text": function( elem ) {
			var attr;
			// IE6 and 7 will map elem.type to 'text' for new HTML5 types (search, etc)
			// use getAttribute instead to test this case
			return elem.nodeName.toLowerCase() === "input" &&
				elem.type === "text" &&
				( (attr = elem.getAttribute("type")) == null || attr.toLowerCase() === elem.type );
		},
		// Position-in-collection
		"first": createPositionalPseudo(function() {
			return [ 0 ];
		}),
		"last": createPositionalPseudo(function( matchIndexes, length ) {
			return [ length - 1 ];
		}),
		"eq": createPositionalPseudo(function( matchIndexes, length, argument ) {
			return [ argument < 0 ? argument + length : argument ];
		}),
		"even": createPositionalPseudo(function( matchIndexes, length ) {
			var i = 0;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),
		"odd": createPositionalPseudo(function( matchIndexes, length ) {
			var i = 1;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),
		"lt": createPositionalPseudo(function( matchIndexes, length, argument ) {
			var i = argument < 0 ? argument + length : argument;
			for ( ; --i >= 0; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),
		"gt": createPositionalPseudo(function( matchIndexes, length, argument ) {
			var i = argument < 0 ? argument + length : argument;
			for ( ; ++i < length; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		})
	}
};
Expr.pseudos["nth"] = Expr.pseudos["eq"];
for ( i in { radio: true, checkbox: true, file: true, password: true, image: true } ) {
	Expr.pseudos[ i ] = createInputPseudo( i );
}
for ( i in { submit: true, reset: true } ) {
	Expr.pseudos[ i ] = createButtonPseudo( i );
}
function setFilters() {}
setFilters.prototype = Expr.filters = Expr.pseudos;
Expr.setFilters = new setFilters();
function tokenize( selector, parseOnly ) {
	var matched, match, tokens, type,
		soFar, groups, preFilters,
		cached = tokenCache[ selector + " " ];
	if ( cached ) {
		return parseOnly ? 0 : cached.slice( 0 );
	}
	soFar = selector;
	groups = [];
	preFilters = Expr.preFilter;
	while ( soFar ) {
		// Comma and first run
		if ( !matched || (match = rcomma.exec( soFar )) ) {
			if ( match ) {
				// Don't consume trailing commas as valid
				soFar = soFar.slice( match[0].length ) || soFar;
			}
			groups.push( tokens = [] );
		}
		matched = false;
		// Combinators
		if ( (match = rcombinators.exec( soFar )) ) {
			matched = match.shift();
			tokens.push({
				value: matched,
				// Cast descendant combinators to space
				type: match[0].replace( rtrim, " " )
			});
			soFar = soFar.slice( matched.length );
		}
		// Filters
		for ( type in Expr.filter ) {
			if ( (match = matchExpr[ type ].exec( soFar )) && (!preFilters[ type ] ||
				(match = preFilters[ type ]( match ))) ) {
				matched = match.shift();
				tokens.push({
					value: matched,
					type: type,
					matches: match
				});
				soFar = soFar.slice( matched.length );
			}
		}
		if ( !matched ) {
			break;
		}
	}
	// Return the length of the invalid excess
	// if we're just parsing
	// Otherwise, throw an error or return tokens
	return parseOnly ?
		soFar.length :
		soFar ?
			Sizzle.error( selector ) :
			// Cache the tokens
			tokenCache( selector, groups ).slice( 0 );
}
function toSelector( tokens ) {
	var i = 0,
		len = tokens.length,
		selector = "";
	for ( ; i < len; i++ ) {
		selector += tokens[i].value;
	}
	return selector;
}
function addCombinator( matcher, combinator, base ) {
	var dir = combinator.dir,
		checkNonElements = base && dir === "parentNode",
		doneName = done++;
	return combinator.first ?
		// Check against closest ancestor/preceding element
		function( elem, context, xml ) {
			while ( (elem = elem[ dir ]) ) {
				if ( elem.nodeType === 1 || checkNonElements ) {
					return matcher( elem, context, xml );
				}
			}
		} :
		// Check against all ancestor/preceding elements
		function( elem, context, xml ) {
			var data, cache, outerCache,
				dirkey = dirruns + " " + doneName;
			// We can't set arbitrary data on XML nodes, so they don't benefit from dir caching
			if ( xml ) {
				while ( (elem = elem[ dir ]) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						if ( matcher( elem, context, xml ) ) {
							return true;
						}
					}
				}
			} else {
				while ( (elem = elem[ dir ]) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						outerCache = elem[ expando ] || (elem[ expando ] = {});
						if ( (cache = outerCache[ dir ]) && cache[0] === dirkey ) {
							if ( (data = cache[1]) === true || data === cachedruns ) {
								return data === true;
							}
						} else {
							cache = outerCache[ dir ] = [ dirkey ];
							cache[1] = matcher( elem, context, xml ) || cachedruns;
							if ( cache[1] === true ) {
								return true;
							}
						}
					}
				}
			}
		};
}
function elementMatcher( matchers ) {
	return matchers.length > 1 ?
		function( elem, context, xml ) {
			var i = matchers.length;
			while ( i-- ) {
				if ( !matchers[i]( elem, context, xml ) ) {
					return false;
				}
			}
			return true;
		} :
		matchers[0];
}
function condense( unmatched, map, filter, context, xml ) {
	var elem,
		newUnmatched = [],
		i = 0,
		len = unmatched.length,
		mapped = map != null;
	for ( ; i < len; i++ ) {
		if ( (elem = unmatched[i]) ) {
			if ( !filter || filter( elem, context, xml ) ) {
				newUnmatched.push( elem );
				if ( mapped ) {
					map.push( i );
				}
			}
		}
	}
	return newUnmatched;
}
function setMatcher( preFilter, selector, matcher, postFilter, postFinder, postSelector ) {
	if ( postFilter && !postFilter[ expando ] ) {
		postFilter = setMatcher( postFilter );
	}
	if ( postFinder && !postFinder[ expando ] ) {
		postFinder = setMatcher( postFinder, postSelector );
	}
	return markFunction(function( seed, results, context, xml ) {
		var temp, i, elem,
			preMap = [],
			postMap = [],
			preexisting = results.length,
			// Get initial elements from seed or context
			elems = seed || multipleContexts( selector || "*", context.nodeType ? [ context ] : context, [] ),
			// Prefilter to get matcher input, preserving a map for seed-results synchronization
			matcherIn = preFilter && ( seed || !selector ) ?
				condense( elems, preMap, preFilter, context, xml ) :
				elems,
			matcherOut = matcher ?
				// If we have a postFinder, or filtered seed, or non-seed postFilter or preexisting results,
				postFinder || ( seed ? preFilter : preexisting || postFilter ) ?
					// ...intermediate processing is necessary
					[] :
					// ...otherwise use results directly
					results :
				matcherIn;
		// Find primary matches
		if ( matcher ) {
			matcher( matcherIn, matcherOut, context, xml );
		}
		// Apply postFilter
		if ( postFilter ) {
			temp = condense( matcherOut, postMap );
			postFilter( temp, [], context, xml );
			// Un-match failing elements by moving them back to matcherIn
			i = temp.length;
			while ( i-- ) {
				if ( (elem = temp[i]) ) {
					matcherOut[ postMap[i] ] = !(matcherIn[ postMap[i] ] = elem);
				}
			}
		}
		if ( seed ) {
			if ( postFinder || preFilter ) {
				if ( postFinder ) {
					// Get the final matcherOut by condensing this intermediate into postFinder contexts
					temp = [];
					i = matcherOut.length;
					while ( i-- ) {
						if ( (elem = matcherOut[i]) ) {
							// Restore matcherIn since elem is not yet a final match
							temp.push( (matcherIn[i] = elem) );
						}
					}
					postFinder( null, (matcherOut = []), temp, xml );
				}
				// Move matched elements from seed to results to keep them synchronized
				i = matcherOut.length;
				while ( i-- ) {
					if ( (elem = matcherOut[i]) &&
						(temp = postFinder ? indexOf.call( seed, elem ) : preMap[i]) > -1 ) {
						seed[temp] = !(results[temp] = elem);
					}
				}
			}
		// Add elements to results, through postFinder if defined
		} else {
			matcherOut = condense(
				matcherOut === results ?
					matcherOut.splice( preexisting, matcherOut.length ) :
					matcherOut
			);
			if ( postFinder ) {
				postFinder( null, results, matcherOut, xml );
			} else {
				push.apply( results, matcherOut );
			}
		}
	});
}
function matcherFromTokens( tokens ) {
	var checkContext, matcher, j,
		len = tokens.length,
		leadingRelative = Expr.relative[ tokens[0].type ],
		implicitRelative = leadingRelative || Expr.relative[" "],
		i = leadingRelative ? 1 : 0,
		// The foundational matcher ensures that elements are reachable from top-level context(s)
		matchContext = addCombinator( function( elem ) {
			return elem === checkContext;
		}, implicitRelative, true ),
		matchAnyContext = addCombinator( function( elem ) {
			return indexOf.call( checkContext, elem ) > -1;
		}, implicitRelative, true ),
		matchers = [ function( elem, context, xml ) {
			return ( !leadingRelative && ( xml || context !== outermostContext ) ) || (
				(checkContext = context).nodeType ?
					matchContext( elem, context, xml ) :
					matchAnyContext( elem, context, xml ) );
		} ];
	for ( ; i < len; i++ ) {
		if ( (matcher = Expr.relative[ tokens[i].type ]) ) {
			matchers = [ addCombinator(elementMatcher( matchers ), matcher) ];
		} else {
			matcher = Expr.filter[ tokens[i].type ].apply( null, tokens[i].matches );
			// Return special upon seeing a positional matcher
			if ( matcher[ expando ] ) {
				// Find the next relative operator (if any) for proper handling
				j = ++i;
				for ( ; j < len; j++ ) {
					if ( Expr.relative[ tokens[j].type ] ) {
						break;
					}
				}
				return setMatcher(
					i > 1 && elementMatcher( matchers ),
					i > 1 && toSelector(
						// If the preceding token was a descendant combinator, insert an implicit any-element `*`
						tokens.slice( 0, i - 1 ).concat({ value: tokens[ i - 2 ].type === " " ? "*" : "" })
					).replace( rtrim, "$1" ),
					matcher,
					i < j && matcherFromTokens( tokens.slice( i, j ) ),
					j < len && matcherFromTokens( (tokens = tokens.slice( j )) ),
					j < len && toSelector( tokens )
				);
			}
			matchers.push( matcher );
		}
	}
	return elementMatcher( matchers );
}
function matcherFromGroupMatchers( elementMatchers, setMatchers ) {
	// A counter to specify which element is currently being matched
	var matcherCachedRuns = 0,
		bySet = setMatchers.length > 0,
		byElement = elementMatchers.length > 0,
		superMatcher = function( seed, context, xml, results, expandContext ) {
			var elem, j, matcher,
				setMatched = [],
				matchedCount = 0,
				i = "0",
				unmatched = seed && [],
				outermost = expandContext != null,
				contextBackup = outermostContext,
				// We must always have either seed elements or context
				elems = seed || byElement && Expr.find["TAG"]( "*", expandContext && context.parentNode || context ),
				// Use integer dirruns iff this is the outermost matcher
				dirrunsUnique = (dirruns += contextBackup == null ? 1 : Math.random() || 0.1);
			if ( outermost ) {
				outermostContext = context !== document && context;
				cachedruns = matcherCachedRuns;
			}
			// Add elements passing elementMatchers directly to results
			// Keep `i` a string if there are no elements so `matchedCount` will be "00" below
			for ( ; (elem = elems[i]) != null; i++ ) {
				if ( byElement && elem ) {
					j = 0;
					while ( (matcher = elementMatchers[j++]) ) {
						if ( matcher( elem, context, xml ) ) {
							results.push( elem );
							break;
						}
					}
					if ( outermost ) {
						dirruns = dirrunsUnique;
						cachedruns = ++matcherCachedRuns;
					}
				}
				// Track unmatched elements for set filters
				if ( bySet ) {
					// They will have gone through all possible matchers
					if ( (elem = !matcher && elem) ) {
						matchedCount--;
					}
					// Lengthen the array for every element, matched or not
					if ( seed ) {
						unmatched.push( elem );
					}
				}
			}
			// Apply set filters to unmatched elements
			matchedCount += i;
			if ( bySet && i !== matchedCount ) {
				j = 0;
				while ( (matcher = setMatchers[j++]) ) {
					matcher( unmatched, setMatched, context, xml );
				}
				if ( seed ) {
					// Reintegrate element matches to eliminate the need for sorting
					if ( matchedCount > 0 ) {
						while ( i-- ) {
							if ( !(unmatched[i] || setMatched[i]) ) {
								setMatched[i] = pop.call( results );
							}
						}
					}
					// Discard index placeholder values to get only actual matches
					setMatched = condense( setMatched );
				}
				// Add matches to results
				push.apply( results, setMatched );
				// Seedless set matches succeeding multiple successful matchers stipulate sorting
				if ( outermost && !seed && setMatched.length > 0 &&
					( matchedCount + setMatchers.length ) > 1 ) {
					Sizzle.uniqueSort( results );
				}
			}
			// Override manipulation of globals by nested matchers
			if ( outermost ) {
				dirruns = dirrunsUnique;
				outermostContext = contextBackup;
			}
			return unmatched;
		};
	return bySet ?
		markFunction( superMatcher ) :
		superMatcher;
}
compile = Sizzle.compile = function( selector, group /* Internal Use Only */ ) {
	var i,
		setMatchers = [],
		elementMatchers = [],
		cached = compilerCache[ selector + " " ];
	if ( !cached ) {
		// Generate a function of recursive functions that can be used to check each element
		if ( !group ) {
			group = tokenize( selector );
		}
		i = group.length;
		while ( i-- ) {
			cached = matcherFromTokens( group[i] );
			if ( cached[ expando ] ) {
				setMatchers.push( cached );
			} else {
				elementMatchers.push( cached );
			}
		}
		// Cache the compiled function
		cached = compilerCache( selector, matcherFromGroupMatchers( elementMatchers, setMatchers ) );
	}
	return cached;
};
function multipleContexts( selector, contexts, results ) {
	var i = 0,
		len = contexts.length;
	for ( ; i < len; i++ ) {
		Sizzle( selector, contexts[i], results );
	}
	return results;
}
function select( selector, context, results, seed ) {
	var i, tokens, token, type, find,
		match = tokenize( selector );
	if ( !seed ) {
		// Try to minimize operations if there is only one group
		if ( match.length === 1 ) {
			// Take a shortcut and set the context if the root selector is an ID
			tokens = match[0] = match[0].slice( 0 );
			if ( tokens.length > 2 && (token = tokens[0]).type === "ID" &&
					support.getById && context.nodeType === 9 && documentIsHTML &&
					Expr.relative[ tokens[1].type ] ) {
				context = ( Expr.find["ID"]( token.matches[0].replace(runescape, funescape), context ) || [] )[0];
				if ( !context ) {
					return results;
				}
				selector = selector.slice( tokens.shift().value.length );
			}
			// Fetch a seed set for right-to-left matching
			i = matchExpr["needsContext"].test( selector ) ? 0 : tokens.length;
			while ( i-- ) {
				token = tokens[i];
				// Abort if we hit a combinator
				if ( Expr.relative[ (type = token.type) ] ) {
					break;
				}
				if ( (find = Expr.find[ type ]) ) {
					// Search, expanding context for leading sibling combinators
					if ( (seed = find(
						token.matches[0].replace( runescape, funescape ),
						rsibling.test( tokens[0].type ) && context.parentNode || context
					)) ) {
						// If seed is empty or no tokens remain, we can return early
						tokens.splice( i, 1 );
						selector = seed.length && toSelector( tokens );
						if ( !selector ) {
							push.apply( results, seed );
							return results;
						}
						break;
					}
				}
			}
		}
	}
	// Compile and execute a filtering function
	// Provide `match` to avoid retokenization if we modified the selector above
	compile( selector, match )(
		seed,
		context,
		!documentIsHTML,
		results,
		rsibling.test( selector )
	);
	return results;
}
support.sortStable = expando.split("").sort( sortOrder ).join("") === expando;
support.detectDuplicates = hasDuplicate;
setDocument();
support.sortDetached = assert(function( div1 ) {
	// Should return 1, but returns 4 (following)
	return div1.compareDocumentPosition( document.createElement("div") ) & 1;
});
if ( !assert(function( div ) {
	div.innerHTML = "<a href='#'></a>";
	return div.firstChild.getAttribute("href") === "#" ;
}) ) {
	addHandle( "type|href|height|width", function( elem, name, isXML ) {
		if ( !isXML ) {
			return elem.getAttribute( name, name.toLowerCase() === "type" ? 1 : 2 );
		}
	});
}
if ( !support.attributes || !assert(function( div ) {
	div.innerHTML = "<input/>";
	div.firstChild.setAttribute( "value", "" );
	return div.firstChild.getAttribute( "value" ) === "";
}) ) {
	addHandle( "value", function( elem, name, isXML ) {
		if ( !isXML && elem.nodeName.toLowerCase() === "input" ) {
			return elem.defaultValue;
		}
	});
}
if ( !assert(function( div ) {
	return div.getAttribute("disabled") == null;
}) ) {
	addHandle( booleans, function( elem, name, isXML ) {
		var val;
		if ( !isXML ) {
			return (val = elem.getAttributeNode( name )) && val.specified ?
				val.value :
				elem[ name ] === true ? name.toLowerCase() : null;
		}
	});
}
if ( typeof define === "function" && define.amd ) {
	define(function() { return Sizzle; });
} else {
	window.Sizzle = Sizzle;
}
})( window );
Prototype._original_property = window.Sizzle;
;(function(engine) {
  var extendElements = Prototype.Selector.extendElements;
  function select(selector, scope) {
    return extendElements(engine(selector, scope || document));
  }
  function match(element, selector) {
    return engine.matches(selector, [element]).length == 1;
  }
  Prototype.Selector.engine = engine;
  Prototype.Selector.select = select;
  Prototype.Selector.match = match;
})(Sizzle);
window.Sizzle = Prototype._original_property;
delete Prototype._original_property;
var Form = {
  reset: function(form) {
    form = $(form);
    form.reset();
    return form;
  },
  serializeElements: function(elements, options) {
    // An earlier version accepted a boolean second parameter (hash) where
    // the default if omitted was false; respect that, but if they pass in an
    // options object (e.g., the new signature) but don't specify the hash option,
    // default true, as that's the new preferred approach.
    if (typeof options != 'object') options = { hash: !!options };
    else if (Object.isUndefined(options.hash)) options.hash = true;
    var key, value, submitted = false, submit = options.submit, accumulator, initial;
    
    if (options.hash) {
      initial = {};
      accumulator = function(result, key, value) {
        if (key in result) {
          if (!Object.isArray(result[key])) result[key] = [result[key]];
          result[key] = result[key].concat(value);
        } else result[key] = value;
        return result;
      };
    } else {
      initial = '';
      accumulator = function(result, key, values) {
        if (!Object.isArray(values)) {values = [values];}
        if (!values.length) {return result;}
        // According to the spec, spaces should be '+' rather than '%20'.
        var encodedKey = encodeURIComponent(key).gsub(/%20/, '+');
        return result + (result ? "&" : "") + values.map(function (value) {
          // Normalize newlines as \r\n because the HTML spec says newlines should
          // be encoded as CRLFs.
          value = value.gsub(/(\r)?\n/, '\r\n');
          value = encodeURIComponent(value);
          // According to the spec, spaces should be '+' rather than '%20'.
          value = value.gsub(/%20/, '+');
          return encodedKey + "=" + value;
        }).join("&");
      };
    }
    
    return elements.inject(initial, function(result, element) {
      if (!element.disabled && element.name) {
        key = element.name; value = $(element).getValue();
        if (value != null && element.type != 'file' && (element.type != 'submit' || (!submitted &&
            submit !== false && (!submit || key == submit) && (submitted = true)))) {
          result = accumulator(result, key, value);
        }
      }
      return result;
    });
  }
};
Form.Methods = {
  serialize: function(form, options) {
    return Form.serializeElements(Form.getElements(form), options);
  },
  
  getElements: function(form) {
    var elements = $(form).getElementsByTagName('*');
    var element, results = [], serializers = Form.Element.Serializers;
    
    for (var i = 0; element = elements[i]; i++) {
      if (serializers[element.tagName.toLowerCase()])
        results.push(Element.extend(element));
    }
    return results;
  },
  getInputs: function(form, typeName, name) {
    form = $(form);
    var inputs = form.getElementsByTagName('input');
    if (!typeName && !name) return $A(inputs).map(Element.extend);
    for (var i = 0, matchingInputs = [], length = inputs.length; i < length; i++) {
      var input = inputs[i];
      if ((typeName && input.type != typeName) || (name && input.name != name))
        continue;
      matchingInputs.push(Element.extend(input));
    }
    return matchingInputs;
  },
  disable: function(form) {
    form = $(form);
    Form.getElements(form).invoke('disable');
    return form;
  },
  enable: function(form) {
    form = $(form);
    Form.getElements(form).invoke('enable');
    return form;
  },
  findFirstElement: function(form) {
    var elements = $(form).getElements().findAll(function(element) {
      return 'hidden' != element.type && !element.disabled;
    });
    var firstByIndex = elements.findAll(function(element) {
      return element.hasAttribute('tabIndex') && element.tabIndex >= 0;
    }).sortBy(function(element) { return element.tabIndex }).first();
    return firstByIndex ? firstByIndex : elements.find(function(element) {
      return /^(?:input|select|textarea)$/i.test(element.tagName);
    });
  },
  focusFirstElement: function(form) {
    form = $(form);
    var element = form.findFirstElement();
    if (element) element.activate();
    return form;
  },
  request: function(form, options) {
    form = $(form), options = Object.clone(options || { });
    var params = options.parameters, action = form.readAttribute('action') || '';
    if (action.blank()) action = window.location.href;
    options.parameters = form.serialize(true);
    if (params) {
      if (Object.isString(params)) params = params.toQueryParams();
      Object.extend(options.parameters, params);
    }
    if (form.hasAttribute('method') && !options.method)
      options.method = form.method;
    return new Ajax.Request(action, options);
  }
};
/*--------------------------------------------------------------------------*/
Form.Element = {
  focus: function(element) {
    $(element).focus();
    return element;
  },
  select: function(element) {
    $(element).select();
    return element;
  }
};
Form.Element.Methods = {
  serialize: function(element) {
    element = $(element);
    if (!element.disabled && element.name) {
      var value = element.getValue();
      if (value != undefined) {
        var pair = { };
        pair[element.name] = value;
        return Object.toQueryString(pair);
      }
    }
    return '';
  },
  getValue: function(element) {
    element = $(element);
    var method = element.tagName.toLowerCase();
    return Form.Element.Serializers[method](element);
  },
  setValue: function(element, value) {
    element = $(element);
    var method = element.tagName.toLowerCase();
    Form.Element.Serializers[method](element, value);
    return element;
  },
  clear: function(element) {
    $(element).value = '';
    return element;
  },
  present: function(element) {
    return $(element).value != '';
  },
  activate: function(element) {
    element = $(element);
    try {
      element.focus();
      if (element.select && (element.tagName.toLowerCase() != 'input' ||
          !(/^(?:button|reset|submit)$/i.test(element.type))))
        element.select();
    } catch (e) { }
    return element;
  },
  disable: function(element) {
    element = $(element);
    element.disabled = true;
    return element;
  },
  enable: function(element) {
    element = $(element);
    element.disabled = false;
    return element;
  }
};
/*--------------------------------------------------------------------------*/
var Field = Form.Element;
var $F = Form.Element.Methods.getValue;
/*--------------------------------------------------------------------------*/
Form.Element.Serializers = (function() {
  function input(element, value) {
    switch (element.type.toLowerCase()) {
      case 'checkbox':
      case 'radio':
        return inputSelector(element, value);
      default:
        return valueSelector(element, value);
    }
  }
  
  function inputSelector(element, value) {
    if (Object.isUndefined(value))
      return element.checked ? element.value : null;
    else element.checked = !!value;    
  }
  
  function valueSelector(element, value) {
    if (Object.isUndefined(value)) return element.value;
    else element.value = value;
  }
  
  function select(element, value) {
    if (Object.isUndefined(value))
      return (element.type === 'select-one' ? selectOne : selectMany)(element);
       
    var opt, currentValue, single = !Object.isArray(value);
    for (var i = 0, length = element.length; i < length; i++) {
      opt = element.options[i];
      currentValue = this.optionValue(opt);
      if (single) {
        if (currentValue == value) {
          opt.selected = true;
          return;
        }
      }
      else opt.selected = value.include(currentValue);
    }
  }
  
  function selectOne(element) {
    var index = element.selectedIndex;
    return index >= 0 ? optionValue(element.options[index]) : null;
  }
  
  function selectMany(element) {
    var values, length = element.length;
    if (!length) return null;
    for (var i = 0, values = []; i < length; i++) {
      var opt = element.options[i];
      if (opt.selected) values.push(optionValue(opt));
    }
    return values;
  }
  
  function optionValue(opt) {
    return Element.hasAttribute(opt, 'value') ? opt.value : opt.text;
  }
  
  return {
    input:         input,
    inputSelector: inputSelector,
    textarea:      valueSelector,
    select:        select,
    selectOne:     selectOne,
    selectMany:    selectMany,
    optionValue:   optionValue,
    button:        valueSelector
  };
})();
/*--------------------------------------------------------------------------*/
Abstract.TimedObserver = Class.create(PeriodicalExecuter, {
  initialize: function($super, element, frequency, callback) {
    $super(callback, frequency);
    this.element   = $(element);
    this.lastValue = this.getValue();
  },
  execute: function() {
    var value = this.getValue();
    if (Object.isString(this.lastValue) && Object.isString(value) ?
        this.lastValue != value : String(this.lastValue) != String(value)) {
      this.callback(this.element, value);
      this.lastValue = value;
    }
  }
});
Form.Element.Observer = Class.create(Abstract.TimedObserver, {
  getValue: function() {
    return Form.Element.getValue(this.element);
  }
});
Form.Observer = Class.create(Abstract.TimedObserver, {
  getValue: function() {
    return Form.serialize(this.element);
  }
});
/*--------------------------------------------------------------------------*/
Abstract.EventObserver = Class.create({
  initialize: function(element, callback) {
    this.element  = $(element);
    this.callback = callback;
    this.lastValue = this.getValue();
    if (this.element.tagName.toLowerCase() == 'form')
      this.registerFormCallbacks();
    else
      this.registerCallback(this.element);
  },
  onElementEvent: function() {
    var value = this.getValue();
    if (this.lastValue != value) {
      this.callback(this.element, value);
      this.lastValue = value;
    }
  },
  registerFormCallbacks: function() {
    Form.getElements(this.element).each(this.registerCallback, this);
  },
  registerCallback: function(element) {
    if (element.type) {
      switch (element.type.toLowerCase()) {
        case 'checkbox':
        case 'radio':
          Event.observe(element, 'click', this.onElementEvent.bind(this));
          break;
        default:
          Event.observe(element, 'change', this.onElementEvent.bind(this));
          break;
      }
    }
  }
});
Form.Element.EventObserver = Class.create(Abstract.EventObserver, {
  getValue: function() {
    return Form.Element.getValue(this.element);
  }
});
Form.EventObserver = Class.create(Abstract.EventObserver, {
  getValue: function() {
    return Form.serialize(this.element);
  }
});
(function(GLOBAL) {
  var DIV = document.createElement('div');
  var docEl = document.documentElement;
  var MOUSEENTER_MOUSELEAVE_EVENTS_SUPPORTED = 'onmouseenter' in docEl
   && 'onmouseleave' in docEl;
  
  var Event = {
    KEY_BACKSPACE: 8,
    KEY_TAB:       9,
    KEY_RETURN:   13,
    KEY_ESC:      27,
    KEY_LEFT:     37,
    KEY_UP:       38,
    KEY_RIGHT:    39,
    KEY_DOWN:     40,
    KEY_DELETE:   46,
    KEY_HOME:     36,
    KEY_END:      35,
    KEY_PAGEUP:   33,
    KEY_PAGEDOWN: 34,
    KEY_INSERT:   45
  };
  
  // We need to support three different event "modes":
  //  1. browsers with only DOM L2 Events (WebKit, FireFox);
  //  2. browsers with only IE's legacy events system (IE 6-8);
  //  3. browsers with _both_ systems (IE 9 and arguably Opera).
  //
  // Groups 1 and 2 are easy; group three is trickier.
  var isIELegacyEvent = function(event) { return false; };
  if (window.attachEvent) {
    if (window.addEventListener) {
      // Both systems are supported. We need to decide at runtime.
      // (Though Opera supports both systems, the event object appears to be
      // the same no matter which system is used. That means that this function
      // will always return `true` in Opera, but that's OK; it keeps us from
      // having to do a browser sniff.)
      isIELegacyEvent = function(event) {
        return !(event instanceof window.Event);
      };
    } else {
      // No support for DOM L2 events. All events will be legacy.
      isIELegacyEvent = function(event) { return true; };
    }
  }
  
  // The two systems have different ways of indicating which button was used
  // for a mouse event.
  var _isButton;
  function _isButtonForDOMEvents(event, code) {
    return event.which ? (event.which === code + 1) : (event.button === code);
  }
  var legacyButtonMap = { 0: 1, 1: 4, 2: 2 };
  function _isButtonForLegacyEvents(event, code) {
    return event.button === legacyButtonMap[code];
  }
  // In WebKit we have to account for when the user holds down the "meta" key.
  function _isButtonForWebKit(event, code) {
    switch (code) {
      case 0: return event.which == 1 && !event.metaKey;
      case 1: return event.which == 2 || (event.which == 1 && event.metaKey);
      case 2: return event.which == 3;
      default: return false;
    }
  }
  if (window.attachEvent) {
    if (!window.addEventListener) {
      // Legacy IE events only.
      _isButton = _isButtonForLegacyEvents;      
    } else {
      // Both systems are supported; decide at runtime.
      _isButton = function(event, code) {
        return isIELegacyEvent(event) ? _isButtonForLegacyEvents(event, code) :
         _isButtonForDOMEvents(event, code);
      }
    }
  } else if (Prototype.Browser.WebKit) {
    _isButton = _isButtonForWebKit;
  } else {
    _isButton = _isButtonForDOMEvents;
  }
  
  function isLeftClick(event)   { return _isButton(event, 0) }
  function isMiddleClick(event) { return _isButton(event, 1) }
  function isRightClick(event)  { return _isButton(event, 2) }
  
  function element(event) {
    // The public version of `Event.element` is a thin wrapper around the
    // private `_element` method below. We do this so that we can use it
    // internally as `_element` without having to extend the node.
    return Element.extend(_element(event));
  }
  
  function _element(event) {
    event = Event.extend(event);
    var node = event.target, type = event.type,
     currentTarget = event.currentTarget;
    if (currentTarget && currentTarget.tagName) {
      // Firefox screws up the "click" event when moving between radio buttons
      // via arrow keys. It also screws up the "load" and "error" events on images,
      // reporting the document as the target instead of the original image.
      if (type === 'load' || type === 'error' ||
        (type === 'click' && currentTarget.tagName.toLowerCase() === 'input'
          && currentTarget.type === 'radio'))
            node = currentTarget;
    }
    // Fix a Safari bug where a text node gets passed as the target of an
    // anchor click rather than the anchor itself.
    return node.nodeType == Node.TEXT_NODE ? node.parentNode : node;
  }
  function findElement(event, expression) {
    var element = _element(event), selector = Prototype.Selector;
    if (!expression) return Element.extend(element);
    while (element) {
      if (Object.isElement(element) && selector.match(element, expression))
        return Element.extend(element);
      element = element.parentNode;
    }
  }
  
  function pointer(event) {
    return { x: pointerX(event), y: pointerY(event) };
  }
  function pointerX(event) {
    var docElement = document.documentElement,
     body = document.body || { scrollLeft: 0 };
    return event.pageX || (event.clientX +
      (docElement.scrollLeft || body.scrollLeft) -
      (docElement.clientLeft || 0));
  }
  function pointerY(event) {
    var docElement = document.documentElement,
     body = document.body || { scrollTop: 0 };
    return  event.pageY || (event.clientY +
       (docElement.scrollTop || body.scrollTop) -
       (docElement.clientTop || 0));
  }
  function stop(event) {
    Event.extend(event);
    event.preventDefault();
    event.stopPropagation();
    // Set a "stopped" property so that a custom event can be inspected
    // after the fact to determine whether or not it was stopped.
    event.stopped = true;
  }
  Event.Methods = {
    isLeftClick:   isLeftClick,
    isMiddleClick: isMiddleClick,
    isRightClick:  isRightClick,
    element:     element,
    findElement: findElement,
    pointer:  pointer,
    pointerX: pointerX,
    pointerY: pointerY,
    stop: stop
  };
  // Compile the list of methods that get extended onto Events.
  var methods = Object.keys(Event.Methods).inject({ }, function(m, name) {
    m[name] = Event.Methods[name].methodize();
    return m;
  });
  if (window.attachEvent) {
    // For IE's event system, we need to do some work to make the event
    // object behave like a standard event object.
    function _relatedTarget(event) {
      var element;
      switch (event.type) {
        case 'mouseover':
        case 'mouseenter':
          element = event.fromElement;
          break;
        case 'mouseout':
        case 'mouseleave':
          element = event.toElement;
          break;
        default:
          return null;
      }
      return Element.extend(element);
    }
    // These methods should be added _only_ to legacy IE event objects.
    var additionalMethods = {
      stopPropagation: function() { this.cancelBubble = true },
      preventDefault:  function() { this.returnValue = false },
      inspect: function() { return '[object Event]' }
    };
    // IE's method for extending events.
    Event.extend = function(event, element) {
      if (!event) return false;
      
      // If it's not a legacy event, it doesn't need extending.
      if (!isIELegacyEvent(event)) return event;
      // Mark this event so we know not to extend a second time.
      if (event._extendedByPrototype) return event;
      event._extendedByPrototype = Prototype.emptyFunction;
      
      var pointer = Event.pointer(event);
      // The optional `element` argument gives us a fallback value for the
      // `target` property in case IE doesn't give us through `srcElement`.
      Object.extend(event, {
        target: event.srcElement || element,
        relatedTarget: _relatedTarget(event),
        pageX:  pointer.x,
        pageY:  pointer.y
      });
      
      Object.extend(event, methods);
      Object.extend(event, additionalMethods);
      
      return event;
    };
  } else {
    // Only DOM events, so no manual extending necessary.
    Event.extend = Prototype.K;
  }
  
  if (window.addEventListener) {
    // In all browsers that support DOM L2 Events, we can augment
    // `Event.prototype` directly.
    Event.prototype = window.Event.prototype || document.createEvent('HTMLEvents').__proto__;
    Object.extend(Event.prototype, methods);
  }
  
  //
  // EVENT REGISTRY
  //
  var EVENT_TRANSLATIONS = {
    mouseenter: 'mouseover',
    mouseleave: 'mouseout'
  };
  
  function getDOMEventName(eventName) {
    return EVENT_TRANSLATIONS[eventName] || eventName;
  }
  
  if (MOUSEENTER_MOUSELEAVE_EVENTS_SUPPORTED)
    getDOMEventName = Prototype.K;
  
  function getUniqueElementID(element) {
    if (element === window) return 0;
    // Need to use actual `typeof` operator to prevent errors in some
    // environments when accessing node expandos.
    if (typeof element._prototypeUID === 'undefined')
      element._prototypeUID = Element.Storage.UID++;
    return element._prototypeUID;
  }
  
  // In Internet Explorer, DOM nodes have a `uniqueID` property. Saves us
  // from inventing our own.
  function getUniqueElementID_IE(element) {
    if (element === window) return 0;
    // The document object's `uniqueID` property changes each time you read it.
    if (element == document) return 1;
    return element.uniqueID;
  }
  
  if ('uniqueID' in DIV)
    getUniqueElementID = getUniqueElementID_IE;
  function isCustomEvent(eventName) {
    return eventName.include(':');
  }
  Event._isCustomEvent = isCustomEvent;
  // These two functions take an optional UID as a second argument so that we
  // can skip lookup if we've already got the element's UID.
  function getRegistryForElement(element, uid) {
    var CACHE = GLOBAL.Event.cache;
    if (Object.isUndefined(uid))
      uid = getUniqueElementID(element);
    if (!CACHE[uid]) CACHE[uid] = { element: element };
    return CACHE[uid];
  }
  
  function destroyRegistryForElement(element, uid) {
    if (Object.isUndefined(uid))
      uid = getUniqueElementID(element);
    delete GLOBAL.Event.cache[uid];
  }
  
  // The `register` and `unregister` functions handle creating the responder
  // and managing an event registry. They _don't_ attach and detach the
  // listeners themselves.
  
  // Add an event to the element's event registry.
  function register(element, eventName, handler) {
    var registry = getRegistryForElement(element);
    if (!registry[eventName]) registry[eventName] = [];
    var entries = registry[eventName];
    // Make sure this handler isn't already attached.
    var i = entries.length;
    while (i--)
      if (entries[i].handler === handler) return null;
      
    var uid = getUniqueElementID(element);
    var responder = GLOBAL.Event._createResponder(uid, eventName, handler);
    var entry = {
      responder: responder,
      handler:   handler
    };
    entries.push(entry);    
    return entry;
  }
  
  // Remove an event from the element's event registry.
  function unregister(element, eventName, handler) {
    var registry = getRegistryForElement(element);
    var entries = registry[eventName];
    if (!entries) return;
    
    var i = entries.length, entry;
    while (i--) {
      if (entries[i].handler === handler) {
        entry = entries[i];
        break;
      }
    }
    
    // This handler wasn't in the collection, so it doesn't need to be
    // unregistered.
    if (!entry) return;
    // Remove the entry from the collection;
    var index = entries.indexOf(entry);
    entries.splice(index, 1);
    if (entries.length == 0) {
      stopObservingEventName(element, eventName);
    }
    return entry;
  }  
  
  
  //
  // EVENT OBSERVING
  //
  function observe(element, eventName, handler) {
    element = $(element);
    var entry = register(element, eventName, handler);
    
    if (entry === null) return element;
    var responder = entry.responder;    
    if (isCustomEvent(eventName))
      observeCustomEvent(element, eventName, responder);
    else
      observeStandardEvent(element, eventName, responder);
      
    return element;
  }
  
  function observeStandardEvent(element, eventName, responder) {
    var actualEventName = getDOMEventName(eventName);
    if (element.addEventListener) {
      element.addEventListener(actualEventName, responder, false);
    } else {
      element.attachEvent('on' + actualEventName, responder);
    }
  }
  
  function observeCustomEvent(element, eventName, responder) {
    if (element.addEventListener) {
      element.addEventListener('dataavailable', responder, false);
    } else {
      // We observe two IE-proprietarty events: one for custom events that
      // bubble and one for custom events that do not bubble.
      element.attachEvent('ondataavailable', responder);
      element.attachEvent('onlosecapture',   responder);
    }
  }
  
  function stopObserving(element, eventName, handler) {
    element = $(element);
    var handlerGiven = !Object.isUndefined(handler),
     eventNameGiven = !Object.isUndefined(eventName);
     
    if (!eventNameGiven && !handlerGiven) {
      stopObservingElement(element);
      return element;
    }
    
    if (!handlerGiven) {
      stopObservingEventName(element, eventName);
      return element;
    }
    
    var entry = unregister(element, eventName, handler);
    
    if (!entry) return element; 
    removeEvent(element, eventName, entry.responder);
    return element;
  }
  
  function stopObservingStandardEvent(element, eventName, responder) {
    var actualEventName = getDOMEventName(eventName);
    if (element.removeEventListener) {
      element.removeEventListener(actualEventName, responder, false);      
    } else {
      element.detachEvent('on' + actualEventName, responder);
    }
  }
  
  function stopObservingCustomEvent(element, eventName, responder) {
    if (element.removeEventListener) {
      element.removeEventListener('dataavailable', responder, false);
    } else {
      element.detachEvent('ondataavailable', responder);
      element.detachEvent('onlosecapture',   responder);
    }
  }
  
  // The `stopObservingElement` and `stopObservingEventName` functions are
  // for bulk removal of event listeners. We use them rather than recurse
  // back into `stopObserving` to avoid touching the registry more often than
  // necessary.
  // Stop observing _all_ listeners on an element.
  function stopObservingElement(element) {
    // Do a manual registry lookup because we don't want to create a registry
    // if one doesn't exist.
    var uid = getUniqueElementID(element), registry = GLOBAL.Event.cache[uid];
    // This way we can return early if there is no registry.
    if (!registry) return;
    destroyRegistryForElement(element, uid);
    var entries, i;
    for (var eventName in registry) {
      // Explicitly skip elements so we don't accidentally find one with a
      // `length` property.
      if (eventName === 'element') continue;
      entries = registry[eventName];
      i = entries.length;
      while (i--)
        removeEvent(element, eventName, entries[i].responder);
    }
  }
  
  // Stop observing all listeners of a certain event name on an element.
  function stopObservingEventName(element, eventName) {
    var registry = getRegistryForElement(element);
    var entries = registry[eventName];
    if (!entries) return;
    delete registry[eventName];
    
    var i = entries.length;
    while (i--)
      removeEvent(element, eventName, entries[i].responder);
    for (var name in registry) {
      if (name === 'element') continue;
      return; // There is another registered event
    }
    // No other events for the element, destroy the registry:
    destroyRegistryForElement(element);
  }
  
  function removeEvent(element, eventName, handler) {
    if (isCustomEvent(eventName))
      stopObservingCustomEvent(element, eventName, handler);
    else
      stopObservingStandardEvent(element, eventName, handler);
  }
  
  
  
  // FIRING CUSTOM EVENTS
  function getFireTarget(element) {
    if (element !== document) return element;
    if (document.createEvent && !element.dispatchEvent)
      return document.documentElement;
    return element;
  }
  
  function fire(element, eventName, memo, bubble) {
    element = getFireTarget($(element));
    if (Object.isUndefined(bubble)) bubble = true;      
    memo = memo || {};
      
    var event = fireEvent(element, eventName, memo, bubble);
    return Event.extend(event);
  }
  
  function fireEvent_DOM(element, eventName, memo, bubble) {
    var event = document.createEvent('HTMLEvents');
    event.initEvent('dataavailable', bubble, true);
    
    event.eventName = eventName;
    event.memo = memo;
    
    element.dispatchEvent(event);
    return event;
  }
  
  function fireEvent_IE(element, eventName, memo, bubble) {
    var event = document.createEventObject();
    event.eventType = bubble ? 'ondataavailable' : 'onlosecapture';
    
    event.eventName = eventName;
    event.memo = memo;
    
    element.fireEvent(event.eventType, event);    
    return event;
  }
  
  var fireEvent = document.createEvent ? fireEvent_DOM : fireEvent_IE;
  
  
  // EVENT DELEGATION
  
  Event.Handler = Class.create({
    initialize: function(element, eventName, selector, callback) {
      this.element   = $(element);
      this.eventName = eventName;
      this.selector  = selector;
      this.callback  = callback;
      this.handler   = this.handleEvent.bind(this);
    },
    
    start: function() {
      Event.observe(this.element, this.eventName, this.handler);
      return this;
    },
    
    stop: function() {
      Event.stopObserving(this.element, this.eventName, this.handler);
      return this;
    },
    
    handleEvent: function(event) {
      var element = Event.findElement(event, this.selector);
      if (element) this.callback.call(this.element, event, element);
    }
  });
  
  function on(element, eventName, selector, callback) {
    element = $(element);
    if (Object.isFunction(selector) && Object.isUndefined(callback)) {
      callback = selector, selector = null;
    }
    
    return new Event.Handler(element, eventName, selector, callback).start();
  }
  
  Object.extend(Event, Event.Methods);
  Object.extend(Event, {
    fire:          fire,
    observe:       observe,
    stopObserving: stopObserving,
    on:            on
  });
  Element.addMethods({
    fire:          fire,
    observe:       observe,
    stopObserving: stopObserving,
    
    on:            on
  });
  Object.extend(document, {
    fire:          fire.methodize(),
    observe:       observe.methodize(),
    stopObserving: stopObserving.methodize(),
    
    on:            on.methodize(),
    loaded:        false
  });
  // Export to the global scope.
  if (GLOBAL.Event) Object.extend(window.Event, Event);
  else GLOBAL.Event = Event;
  
  GLOBAL.Event.cache = {};
    
  function destroyCache_IE() {
    GLOBAL.Event.cache = null;
  }
  
  if (window.attachEvent)
    window.attachEvent('onunload', destroyCache_IE);
    
  DIV = null;
  docEl = null;
})(this);
(function(GLOBAL) {  
  /* Code for creating leak-free event responders is based on work by
   John-David Dalton. */
  
  var docEl = document.documentElement;
  var MOUSEENTER_MOUSELEAVE_EVENTS_SUPPORTED = 'onmouseenter' in docEl
    && 'onmouseleave' in docEl;
    
  function isSimulatedMouseEnterLeaveEvent(eventName) {
    return !MOUSEENTER_MOUSELEAVE_EVENTS_SUPPORTED &&
     (eventName === 'mouseenter' || eventName === 'mouseleave');
  }
  
  // The functions for creating responders accept the element's UID rather
  // than the element itself. This way, there are _no_ DOM objects inside the
  // closure we create, meaning there's no need to unregister event listeners
  // on unload.
  function createResponder(uid, eventName, handler) {    
    if (Event._isCustomEvent(eventName))
      return createResponderForCustomEvent(uid, eventName, handler);      
    if (isSimulatedMouseEnterLeaveEvent(eventName))
      return createMouseEnterLeaveResponder(uid, eventName, handler);
    
    return function(event) {
      if (!Event.cache) return;
      
      var element = Event.cache[uid].element;
      Event.extend(event, element);
      handler.call(element, event);
    };
  }
  
  function createResponderForCustomEvent(uid, eventName, handler) {
    return function(event) {
      var element = Event.cache[uid] !== undefined ? Event.cache[uid].element : event.target;
      if (Object.isUndefined(event.eventName))
        return false;
        
      if (event.eventName !== eventName)
        return false;
        
      Event.extend(event, element);
      handler.call(element, event);
    };
  }
  
  function createMouseEnterLeaveResponder(uid, eventName, handler) {
    return function(event) {
      var element = Event.cache[uid].element;
      
      Event.extend(event, element);
      var parent = event.relatedTarget;
      
      // Walk up the DOM tree to see if the related target is a descendant of
      // the original element. If it is, we ignore the event to match the
      // behavior of mouseenter/mouseleave.
      while (parent && parent !== element) {
        try { parent = parent.parentNode; }
        catch(e) { parent = element; }
      }
      
      if (parent === element) return;      
      handler.call(element, event);
    }
  }
  
  GLOBAL.Event._createResponder = createResponder;
  docEl = null;
})(this);
(function(GLOBAL) {
  /* Support for the DOMContentLoaded event is based on work by Dan Webb,
     Matthias Miller, Dean Edwards, John Resig, and Diego Perini. */
  
  var TIMER;
  
  function fireContentLoadedEvent() {
    if (document.loaded) return;
    if (TIMER) window.clearTimeout(TIMER);
    document.loaded = true;
    document.fire('dom:loaded');
  }
  
  function checkReadyState() {
    if (document.readyState === 'complete') {
      document.detachEvent('onreadystatechange', checkReadyState);
      fireContentLoadedEvent();
    }
  }
  
  function pollDoScroll() {
    try {
      document.documentElement.doScroll('left');
    } catch (e) {
      TIMER = pollDoScroll.defer();
      return;
    }
    
    fireContentLoadedEvent();
  }
  if (document.readyState === 'complete') {
    // We must have been loaded asynchronously, because the DOMContentLoaded
    // event has already fired. We can just fire `dom:loaded` and be done
    // with it.
    fireContentLoadedEvent();
    return;
  }
  
  if (document.addEventListener) {
    // All browsers that support DOM L2 Events support DOMContentLoaded,
    // including IE 9.
    document.addEventListener('DOMContentLoaded', fireContentLoadedEvent, false);
  } else {
    document.attachEvent('onreadystatechange', checkReadyState);
    if (window == top) TIMER = pollDoScroll.defer();
  }
  
  // Worst-case fallback.
  Event.observe(window, 'load', fireContentLoadedEvent);
})(this);
Element.addMethods();
/*------------------------------- DEPRECATED -------------------------------*/
Hash.toQueryString = Object.toQueryString;
var Toggle = { display: Element.toggle };
Element.Methods.childOf = Element.Methods.descendantOf;
var Insertion = {
  Before: function(element, content) {
    return Element.insert(element, {before:content});
  },
  Top: function(element, content) {
    return Element.insert(element, {top:content});
  },
  Bottom: function(element, content) {
    return Element.insert(element, {bottom:content});
  },
  After: function(element, content) {
    return Element.insert(element, {after:content});
  }
};
var $continue = new Error('"throw $continue" is deprecated, use "return" instead');
var Position = {
  // set to true if needed, warning: firefox performance problems
  // NOT neeeded for page scrolling, only if draggable contained in
  // scrollable elements
  includeScrollOffsets: false,
  // must be called before calling withinIncludingScrolloffset, every time the
  // page is scrolled
  prepare: function() {
    this.deltaX =  window.pageXOffset
                || document.documentElement.scrollLeft
                || document.body.scrollLeft
                || 0;
    this.deltaY =  window.pageYOffset
                || document.documentElement.scrollTop
                || document.body.scrollTop
                || 0;
  },
  // caches x/y coordinate pair to use with overlap
  within: function(element, x, y) {
    if (this.includeScrollOffsets)
      return this.withinIncludingScrolloffsets(element, x, y);
    this.xcomp = x;
    this.ycomp = y;
    this.offset = Element.cumulativeOffset(element);
    return (y >= this.offset[1] &&
            y <  this.offset[1] + element.offsetHeight &&
            x >= this.offset[0] &&
            x <  this.offset[0] + element.offsetWidth);
  },
  withinIncludingScrolloffsets: function(element, x, y) {
    var offsetcache = Element.cumulativeScrollOffset(element);
    this.xcomp = x + offsetcache[0] - this.deltaX;
    this.ycomp = y + offsetcache[1] - this.deltaY;
    this.offset = Element.cumulativeOffset(element);
    return (this.ycomp >= this.offset[1] &&
            this.ycomp <  this.offset[1] + element.offsetHeight &&
            this.xcomp >= this.offset[0] &&
            this.xcomp <  this.offset[0] + element.offsetWidth);
  },
  // within must be called directly before
  overlap: function(mode, element) {
    if (!mode) return 0;
    if (mode == 'vertical')
      return ((this.offset[1] + element.offsetHeight) - this.ycomp) /
        element.offsetHeight;
    if (mode == 'horizontal')
      return ((this.offset[0] + element.offsetWidth) - this.xcomp) /
        element.offsetWidth;
  },
  // Deprecation layer -- use newer Element methods now (1.5.2).
  cumulativeOffset: Element.Methods.cumulativeOffset,
  positionedOffset: Element.Methods.positionedOffset,
  absolutize: function(element) {
    Position.prepare();
    return Element.absolutize(element);
  },
  relativize: function(element) {
    Position.prepare();
    return Element.relativize(element);
  },
  realOffset: Element.Methods.cumulativeScrollOffset,
  offsetParent: Element.Methods.getOffsetParent,
  page: Element.Methods.viewportOffset,
  clone: function(source, target, options) {
    options = options || { };
    return Element.clonePosition(target, source, options);
  }
};
/*--------------------------------------------------------------------------*/
if (!document.getElementsByClassName) document.getElementsByClassName = function(instanceMethods){
  function iter(name) {
    return name.blank() ? null : "[contains(concat(' ', @class, ' '), ' " + name + " ')]";
  }
  instanceMethods.getElementsByClassName = Prototype.BrowserFeatures.XPath ?
  function(element, className) {
    className = className.toString().strip();
    var cond = /\s/.test(className) ? $w(className).map(iter).join('') : iter(className);
    return cond ? document._getElementsByXPath('.//*' + cond, element) : [];
  } : function(element, className) {
    className = className.toString().strip();
    var elements = [], classNames = (/\s/.test(className) ? $w(className) : null);
    if (!classNames && !className) return elements;
    var nodes = $(element).getElementsByTagName('*');
    className = ' ' + className + ' ';
    for (var i = 0, child, cn; child = nodes[i]; i++) {
      if (child.className && (cn = ' ' + child.className + ' ') && (cn.include(className) ||
          (classNames && classNames.all(function(name) {
            return !name.toString().blank() && cn.include(' ' + name + ' ');
          }))))
        elements.push(Element.extend(child));
    }
    return elements;
  };
  return function(className, parentElement) {
    return $(parentElement || document.body).getElementsByClassName(className);
  };
}(Element.Methods);
/*--------------------------------------------------------------------------*/
Element.ClassNames = Class.create();
Element.ClassNames.prototype = {
  initialize: function(element) {
    this.element = $(element);
  },
  _each: function(iterator, context) {
    this.element.className.split(/\s+/).select(function(name) {
      return name.length > 0;
    })._each(iterator, context);
  },
  set: function(className) {
    this.element.className = className;
  },
  add: function(classNameToAdd) {
    if (this.include(classNameToAdd)) return;
    this.set($A(this).concat(classNameToAdd).join(' '));
  },
  remove: function(classNameToRemove) {
    if (!this.include(classNameToRemove)) return;
    this.set($A(this).without(classNameToRemove).join(' '));
  },
  toString: function() {
    return $A(this).join(' ');
  }
};
Object.extend(Element.ClassNames.prototype, Enumerable);
/*--------------------------------------------------------------------------*/
(function() {
  window.Selector = Class.create({
    initialize: function(expression) {
      this.expression = expression.strip();
    },
  
    findElements: function(rootElement) {
      return Prototype.Selector.select(this.expression, rootElement);
    },
  
    match: function(element) {
      return Prototype.Selector.match(element, this.expression);
    },
  
    toString: function() {
      return this.expression;
    },
  
    inspect: function() {
      return "#<Selector: " + this.expression + ">";
    }
  });
  Object.extend(Selector, {
    matchElements: function(elements, expression) {
      var match = Prototype.Selector.match,
          results = [];
          
      for (var i = 0, length = elements.length; i < length; i++) {
        var element = elements[i];
        if (match(element, expression)) {
          results.push(Element.extend(element));
        }
      }
      return results;
    },
    findElement: function(elements, expression, index) {
      index = index || 0;
      var matchIndex = 0, element;
      // Match each element individually, since Sizzle.matches does not preserve order
      for (var i = 0, length = elements.length; i < length; i++) {
        element = elements[i];
        if (Prototype.Selector.match(element, expression) && index === matchIndex++) {
          return Element.extend(element);
        }
      }
    },
    findChildElements: function(element, expressions) {
      var selector = expressions.toArray().join(', ');
      return Prototype.Selector.select(selector, element || document);
    }
  });
})();