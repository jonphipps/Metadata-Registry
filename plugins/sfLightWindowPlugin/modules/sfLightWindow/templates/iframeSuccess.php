<?php use_helper('LightWindow', 'Javascript') ?>  
<html>
<head></head>
<body>
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

<p>
  <?php echo lw_iframe_link('<strong>Open a LightWindow from an iframe!</strong>', 'http://www.stereointeractive.com', '_lwAddResources=false') ?>
</p>

<?php echo javascript_tag(lw_iframe_js()) ?>
</body>
</html>