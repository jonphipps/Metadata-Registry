[?php
  /** @var sfContext $sf_context */
  /** @var sfParameterHolder $sf_flash */
  /** @var sfParameterHolder $sf_params */
  /** @var myWebRequest $sf_request */
  /** @var myUser $sf_user */
  /** @var sfPartialView $sf_view */
  /** @var <?php /** @var sfPropelAdminGenerator $this */
echo $this->getClassName() ?>  $<?php echo $this->getSingularName() ?> */
if ($sf_flash->has('notice')): ?]
<div class="save-ok">
  <h2 class="message">[?php echo __s($sf_flash->get('notice')) ?]</h2>
</div>[?php endif; ?]
[?php  /** @var myWebRequest $sf_request */
if ($sf_request->getError('delete')): ?]
<div class="form-errors">
  <h2 class="message">[?php echo __s('Could not delete the selected %name%', array('%name%' => '<?php echo sfInflector::humanize($this->getSingularName()) ?>')) ?]</h2>
  <ul>
    <li>[?php echo $sf_request->getError('delete') ?]</li>
  </ul>
</div>
[?php endif; ?]

