var formUtil = new Object;
formUtil.focusOnFirst = function(formId)
{
   Event.observe(window, 'load', function()
   {
      var theForm = (typeof formId == "undefined") ? "sf_admin_edit_form" : formId;
      var f = $(theForm);
      if (f)
      {
         for (var i=0; i < f.elements.length; i++)
         {
            var e = f.elements[i];
            var tag = e.tagName;
            if (e.type != "hidden" && tag != "FIELDSET" && !e.disabled)
            {
               e.focus();
               return;
            }
         }
      }
   });
}

formUtil.focusOnFirst();
