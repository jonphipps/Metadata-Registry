<!DOCTYPE html>
<html lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>

<?php use_stylesheet('/sf/sf_default/css/screen.css', 'last') ?>

<link rel="icon" href="/favicon.ico" />

<!--[if lt IE 7.]>
<?php echo stylesheet_tag('/sf/sf_default/css/ie.css') ?>
<![endif]-->

</head>
<body>
<div class="sfTContainer">
  <?php echo link_to(image_tag('/sf/sf_default/images/sfTLogo.png', array('alt' => 'symfony PHP Framework', 'class' => 'sfTLogo', 'size' => '186x39')), 'http://www.symfony-project.org/') ?>
  <?php echo $sf_data->getRaw('sf_content') ?>
</div>
</body>
</html>
