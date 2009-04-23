function dg_send(form, datagridName, type, url)
{
    var oForm = $(form);
    
    switch(type)
    {
        case 'search':
            new Ajax.Updater(datagridName, url, {asynchronous:true, evalScripts:true, method:'get', parameters:oForm.serialize(this), onLoading: function(request, json){dg_hide_show(datagridName)}}); return false;
            break;
        
        case 'reset':
        	oForm=document.getElementById(form);
        	el=oForm.elements;
        
        	
        	for(i in el){
        		
        			el[i].value='';
        			
        		
        	}
        	url+='/reset/1';
        	dg_send(form, datagridName, 'search', url);
            break;
        case 'action':
            
            if($(datagridName + '_select').options[$(datagridName + '_select').selectedIndex].value != '#')
            {
                new Ajax.Updater(datagridName, $(datagridName + '_select').options[$(datagridName + '_select').selectedIndex].value, {asynchronous:true, evalScripts:true, parameters:oForm.serialize(this), onLoading: function(request, json){dg_hide_show(datagridName)}}); return false;
            }
            
            break;
    }
}

function dg_keydown(form, datagridName, type, url, e)
{
    if(e.keyCode == 13)
    {
        dg_send(form, datagridName, type, url);
    }
    
    return false;
}

function dg_hide_show(name)
{    
    if($('loader-' + name))
    {
        $('loader-' + name).style.display = 'block';
    }
}