<?php use_helper('Validation', 'Javascript') ?>

<?php echo javascript_tag("formUtil.focusOnFirst('email_password');") ?>

<div id="sf_admin_container">
   <h1><?php echo __('Receive a new password by email') ?></h1>

   <div style="padding:10px 0px 10px 6px;">
      <?php echo __('Did you forget your password?') ?>
      <br />
      <?php echo __('Enter your email to receive your login details:') ?>
   </div>

   <?php echo form_tag('@user_require_password', 'id=email_password') ?>

      <fieldset id="sf_fieldset_password">
         <div class="form-row">
            <?php echo form_error('email') ?>
            <label for="email"><?php echo __('email:') ?></label>
            <div class="content">
               <?php echo input_tag('email', $sf_params->get('email'), 'style=width:300px') ?>
            </div>
         </div>
      </fieldset>

      <ul class="sf_admin_actions">
         <li><?php echo submit_tag(__('send it'),'class=sf_admin_action_save') ?></li>
      </ul>

   </form>
</div>