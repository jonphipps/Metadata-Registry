document.getElementById('vocabulary_token');
tokenField.onblur = function(){
var domainField = $F('vocabulary[base_domain]');
var tokenField = $F('vocabulary[token]');
var uriField = $F('vocabulary[uri]');
uriField.value = domainField.value + tokenField.value};