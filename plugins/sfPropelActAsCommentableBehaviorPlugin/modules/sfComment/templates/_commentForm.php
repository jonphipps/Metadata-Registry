<?php use_helper('Form'); ?>
<?php use_helper('I18N'); ?>
<?php use_helper('Date'); ?>

<?php if (($sf_user->isAuthenticated() && $config_user['enabled'])
          || $config_anonymous['enabled']): ?>
  <?php
  $options = array('class' => 'sf_comment_form',
                   'id'    => 'sf_comment_form');
  echo form_tag('sfComment/comment', $options);
  ?>
    <fieldset>
      <?php foreach ($layout as $field => $required): ?>
        <?php if (isset($form[$field])): ?>
          <div<?php echo ($required == 'required') ? ' class="required"' : '' ?>>
            <?php echo $form[$field]->renderLabel() ?>
            <?php echo $form[$field]->renderError() ?>
            <?php echo $form[$field]->render() ?>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>

      <?php
      if (count($allowed_html_tags) > 0):
      ?>
        <div>
          <?php echo __('Allowed HTML tags are: %1%', array('%1%' => htmlspecialchars(implode(', ', $allowed_html_tags)))) ?>
        </div>
      <?php endif; ?>

      <?php echo $form['referer']->render() ?>
      <?php echo $form['token']->render() ?>

      <?php if (isset($namespace) && ($namespace != null)): ?>
        <?php echo input_hidden_tag('sf_comment_namespace', $namespace) ?>
      <?php endif; ?>

      <?php echo submit_tag(__('Post this comment'), array('class' => 'submit')) ?>
    </fieldset>
  </form>
<?php endif; ?>