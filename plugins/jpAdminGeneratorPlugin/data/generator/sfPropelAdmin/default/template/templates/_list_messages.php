[?php if ($sf_flash->has('notice')): ?]
<div class="save-ok">
  <h2 class="message">[?php echo __($sf_flash->get('notice')) ?]</h2>
</div>[?php endif; ?]
[?php  /** @var myWebRequest $sf_request */
if ($sf_request->getError('delete')): ?]
<div class="form-errors">
  <h2 class="message">[?php echo __('Could not delete the selected %name%', array('%name%' => '<?php echo sfInflector::humanize($this->getSingularName()) ?>')) ?]</h2>
  <ul>
    <li>[?php echo $sf_request->getError('delete') ?]</li>
  </ul>
</div>
[?php endif; ?]

