function updateUri()
{
   var domainField = $('vocabulary_base_domain');
   var tokenField = $('vocabulary_token');
   var uriField = $('vocabulary_uri');
   var updateIt = true;
   if(uriField.value != "")
   {
      updateIt = confirm("Update the URI?");
   }
   if(updateIt)
   {
      uriField.value = domainField.value + tokenField.value
   }
};