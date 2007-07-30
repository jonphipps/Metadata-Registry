<?php decorate_with(sfLoader::getTemplatePath('default', 'defaultLayout.php')) ?>

<div class="sfTMessageContainer sfTAlert"> 
  <?php echo image_tag('/sf/sf_default/images/icons/tools48.png', array('alt' => 'website unavailable', 'class' => 'sfTMessageIcon', 'size' => '48x48')) ?>
  <div class="sfTMessageWrap">
    <h1>We're Sorry!<br />The Metadata Registry is briefly unavailable</h1>
    <h5>We're moving the site to a new host, so the Registry on this host has been temporarily disabled. You're only seeing this message because the transfer hasn't been completed. <br /><br />Please try again later.</h5>
  </div>
</div>
