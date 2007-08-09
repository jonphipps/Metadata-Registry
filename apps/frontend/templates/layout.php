<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php echo include_http_metas() ?>
<?php echo include_metas() ?>

<?php echo include_title() ?>

<?php if ($_SERVER['HTTP_HOST'] == 'registry'): ?>
   <link rel="shortcut icon" href="/registry_favicon_dev.ico" />
<?php elseif ($_SERVER['HTTP_HOST'] == 'beta.metadataregistry.org' || $_SERVER['HTTP_HOST'] == 'betas.metadataregistry.org'): ?>
   <link rel="shortcut icon" href="/registry_favicon_beta.ico" />
<?php elseif ($_SERVER['HTTP_HOST'] == 'sandbox.metadataregistry.org'): ?>
   <link rel="shortcut icon" href="/registry_favicon_sand.ico" />
<?php else: ?>
   <link rel="shortcut icon" href="/registry_favicon_prod.ico" />
<?php endif; ?>

</head>
<body>

  <?php use_helper('Javascript')?>

  <div id="indicator" style="display: none"></div>

  <div id="header">
    <ul>
      <?php if ($sf_user->isAuthenticated()): ?>
        <li><?php echo link_to(__('%1% profile', array('%1%' => $sf_user->getAttribute('nickname', '', 'subscriber'))), '@current_user_profile') ?></li>
        <li><?php echo link_to(__('sign out'), '@logout') ?></li>
      <?php else: ?>
        <li><?php echo link_to(__('sign in / register'), '@login') ?></li>
      <?php endif ?>
      <li class="last"><?php echo link_to(__('about'), '@about') ?></li>
    </ul>
    <div style="padding-top: 10px;">
      <?php echo link_to(image_tag('logo.gif.jpg', 'alt=registry align=left'), '@homepage') ?>
    </div>
    
    <div id="search">
      <?php include_partial('conceptprop/search', array('searchTerm' => $sf_params->get('term'))) ?>
    </div>
  </div>

  <div id="login" style="display: none">
    <h2><?php echo __('please sign-in first') ?></h2>
    <?php echo form_tag('@login', 'id=loginform') ?>
      <label for="nickname"><?php echo __('nickname:') ?></label><?php echo input_tag('nickname') ?>
      <label for="password"><?php echo __('password:') ?></label><?php echo input_password_tag('password') ?>
      <?php echo input_hidden_tag('referer', $sf_params->get('referer') ? $sf_params->get('referer') : $sf_request->getUri()) ?>
      <?php echo submit_tag(__('login')) ?>
      <?php echo link_to_function(__('cancel'), visual_effect('blind_up', 'login', array('duration' => 0.5))) ?>
    </form>
  </div>


  <div id="content">
    <div id="content_main">
      <?php echo $sf_data->getRaw('sf_content') ?>
      <div class="verticalalign"></div>
    </div>

    <div id="content_bar">
      <?php include_component_slot('sidebar') ?>
      <div class="verticalalign"></div>
    </div>
    </div>

  <div id="footer">
  <?php echo __('powered by %1%', array('%1%' => link_to(image_tag('symfony.gif', 'align=middle'), 'http://www.symfony-project.com/'))) ?>
  <?php echo __('%1%', array('%1%' => link_to(image_tag('poweredby.png', 'align=middle'), 'http://www.redhat.com/'))) ?>
  </div>

<?php
  //Google analytics
  if ($_SERVER['HTTP_HOST'] == 'sandbox.metadataregistry.org')
  {
    echo '<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>';
    echo javascript_tag('
      _uacct = "UA-840150-2";
      urchinTracker();
    ');
  }

  if ($_SERVER['HTTP_HOST'] == 'metadataregistry.org')
  {
    echo '<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>';
    echo javascript_tag('
      _uacct = "UA-840150-1";
      urchinTracker();
    ');
  }
?>
<?php //<script type="text/javascript" src="http://cetrk.com/pages/scripts/0005/6031.js"> </script> ?>
</body>
</html>