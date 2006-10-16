<?php echo $html ?>
<div id="Home_menu">
   <?php echo __('From here you can...') ?>
   <ul>
      <li><?php echo link_to(__('Browse the Registered Vocabularies'), 'vocabulary/list') ?></li>
      <li><?php echo link_to(__('Browse the Vocabulary Owners'), 'agent/list') ?></li>
   </ul>
</div>
<div id="home_menu2">
   <?php echo __("Once you've registered <em>yourself</em> with The Registry, you can...") ?>
   <ul>
      <li><?php echo __("Register yourself or your organization as a Vocabulary Owner.")?></li>
      <li><?php echo __("Register a vocabulary and enter concepts.")?></li>
      <li><?php echo __("Export your vocabulary as rdf:SKOS or as an XML Schema")?></li>
      <li><?php echo __("Register other individuals as maintainers of your vocabulary")?></li>
      <li><?php echo __("And much more...")?></li>
   </ul>
</div>

