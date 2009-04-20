<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<title>LightWindow frame Demo</title>

	<!-- Meta Tags -->
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="robots" content="index, follow" />
	
	<!-- JavaScript -->
	
  <title>sfLightWindowPlugin Demo</title>

  <script type="text/javascript" src="/sf/sf_web_debug/js/main.js"></script>
  <script type="text/javascript" src="/sfLightWindowPlugin/js/prototype.js"></script>
  
	<style type="text/css">
        
        *, body {
            margin: 0 0 0 0;
            padding: 0 0 0 0;
        }
        
        body {
            background-color: #ffffff;
        }
        
        p {
            font-size: 12px;
            line-height: 25px;
            padding: 0 0 0 5px;
        }
    
	</style>
    
</head>

<body style="margin:0; padding:0">

	<p style="padding: 0 0 0 5px">
		<a href="http://www.stereointeractive.com" class="lightwindow_iframe_link" ><strong>Open a LightWindow from an iframe!</strong></a>
	</p>
  
	<script type="text/javascript">
		var links = $$('.lightwindow_iframe_link');
		links.each(function(link) {
			Event.observe(link, 'click', function() {parent.myLightWindow.activate(null, link);}, false);
			link.onclick = function() {return false;};
		});		
	</script>  
    
</body>
</html>
