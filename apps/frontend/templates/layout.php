<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_http_metas() ?>
  <?php include_metas() ?>

  <?php include_title() ?>

  <?php if (has_slot('data')): ?><?php include_slot('data') ?><?php endif; ?>
  <?php if ($_SERVER['SERVER_NAME'] == 'registry.dev' || $_SERVER['SERVER_NAME'] == 'beta.metadataregistry.net'): ?>
    <link rel="shortcut icon" href="/registry_favicon_dev.ico"/>
  <?php elseif ($_SERVER['SERVER_NAME'] == 'beta.metadataregistry.org' || $_SERVER['SERVER_NAME'] == 'beta-sand.metadataregistry.org' || $_SERVER['SERVER_NAME'] == 'beta-prod.metadataregistry.org'): ?>
    <link rel="shortcut icon" href="/registry_favicon_beta.ico"/>
  <?php elseif ($_SERVER['SERVER_NAME'] == 'sandbox.metadataregistry.org'): ?>
    <link rel="shortcut icon" href="/registry_favicon_sand.ico"/>
  <?php else: ?>
    <link rel="shortcut icon" href="/registry_favicon_prod.ico"/>
  <?php endif; ?>

  <?php if (has_slot('feeds')): ?><?php include_slot('feeds') ?><?php endif; ?>
</head>
<body>

<?php use_helper('Javascript') ?>
<div id="indicator" style="display: none"></div>
<div id="header">
  <ul>
    <?php if ($sf_user->isAuthenticated()): ?>
      <li><?php echo link_to(__('%1% profile', [ '%1%' => $sf_user->getAttribute('nickname', '', 'subscriber') ]),
                             '@current_user_profile') ?></li>
      <li><?php echo link_to(__('sign out'), '@logout') ?></li>
    <?php else: ?>
      <li><?php echo link_to(__('sign in / register'), '@login') ?></li>
    <?php endif ?>
    <li class="last"><?php echo link_to(__('about'), '@about') ?></li>
  </ul>
  <div style="padding-left: 10px;">
    <?php echo link_to(image_tag('open_metadata_logo_with_interoperability.png', 'alt=registry align=left'),
                       '@homepage') ?>
  </div>
  <div id="search">
    <table>
      <tr><?php include_partial('conceptprop/search', [ 'searchTerm' => $sf_params->get('term') ]) ?></tr>
      <tr><?php include_partial('schemaprop/search', [ 'searchTerm' => $sf_params->get('term') ]) ?></tr>
    </table>
    <?php if ($_SERVER['SERVER_NAME'] == 'registry.dev'): ?>
      <br/><a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/load_test_db.php">Load test database</a>
    <?php endif; ?>
  </div>
</div>
<div id="content">
  <table class="layout">
    <tr>
      <td class="left">
        <div id="content_main" class="Left">
          <?php echo $sf_data->getRaw('sf_content') ?>
        </div>
      </td>
      <td class="right">
        <div id="content_bar" class="main-subcontent">
          <?php include_component_slot('sidebar') ?>
          <div>See a problem? <br/><?php echo link_to(__('Make an issue out of it...'),
                                                      'https://github.com/jonphipps/Metadata-Registry/issues/') ?></div>
        </div>
      </td>
    </tr>
  </table>
</div>
<div id="footer">
  <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="/images/cc_by-nc-sa_3.0_80x15.png"/></a>
  <?php echo __('powered by %1%',
                [ '%1%' => link_to(image_tag('symfony.gif', 'align=bottom'), 'http://www.symfony-project.com/') ]); ?>
  <?php echo link_to(image_tag('DO_Proudly_Hosted_Badge_Blue-735d53ec.png',
                               [ 'alt' => 'Powered by Digital Ocean', 'size' => '75x20' ]),
                     'https://www.digitalocean.com/'); ?>
</div>
<?php
//Google analytics
if ($_SERVER['SERVER_NAME'] == 'sandbox.metadataregistry.org') {
  echo '<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>';
  echo javascript_tag('
      _uacct = "UA-840150-2";
      urchinTracker();
    ');
}

if ($_SERVER['SERVER_NAME'] == 'metadataregistry.org') {
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
