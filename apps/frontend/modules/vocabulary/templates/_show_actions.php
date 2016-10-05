<?php
// auto-generated by sfPropelAdmin
// date: 2016/10/04 22:33:15
?>
<ul class="sf_admin_actions">
  <?php
  /** @var myWebRequest $sf_request */
  /** @var MyUser $sf_user */ ?>
<?php if ($sf_user->hasObjectCredential($vocabulary->getId(),
      'vocabulary',
      [ 0 => [ 0 => 'administrator', 1 => 'vocabularymaintainer', 2 => 'vocabularyadmin', ], ])
  ): ?>
    <li><?php echo button_to(__('Edit'),
          '@agent_vocabulary_edit?agent_id=' . $vocabulary->getAgentId() . '&id=' . $vocabulary->getId() . '',
          [
              'title' => 'Edit',
              'class' => 'sf_admin_action_edit',
          ]) ?></li>
<?php endif; ?>
  <?php if ($sf_user->hasObjectCredential($vocabulary->getId(), 'vocabulary', [ 0 => [ 0 => 'administrator', ], ])): ?>
    <li><?php echo button_to(__('Publish'),
          '@vocabulary_publish?id=' . $vocabulary->getId(),
          [
              'title' => 'Publish',
              'class' => 'sf_admin_action_publish',
          ]) ?></li>
  <?php endif; ?>
  <li><?php echo button_to(__('Get RDF'),
        '@rdf_vocabulary?id=' . $vocabulary->getId(),
        [
            'title' => 'rdf',
            'style' => 'background: #ffc url(/jpAdminPlugin/images/rdf_icon.png) no-repeat 2px 3px; padding-left:20px !important',
        ]) ?></li>
  <li><?php echo button_to(__('Get XML Schema'),
        '@xml_schema_vocabulary?id=' . $vocabulary->getId(),
        [
            'style' => 'background: #ffc url(/jpAdminPlugin/images/xmlschema_icon.png) no-repeat 3px; padding-left:25px !important',
            'title' => 'xml',
        ]) ?></li>
</ul>
