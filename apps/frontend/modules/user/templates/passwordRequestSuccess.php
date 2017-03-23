<?php use_helper('Validation', 'Javascript') ?>

<div id="sf_admin_container">
<div id="login_div">
   <h1><?php echo __s('Receive a new password by email') ?></h1>

   <div style="padding:10px 0px 10px 6px;">
      <?php echo __s('Did you forget your password?') ?>
      <br />
      <?php echo __s('Enter your email to receive your login details:') ?>
   </div>

   <?php echo form_tag('@user_require_password', 'id=email_password') ?>

      <fieldset id="sf_fieldset_password">
         <div class="form-row">
            <?php echo form_error('email') ?>
            <label for="email"><?php echo __s('email:') ?></label>
            <div class="content">
               <?php echo input_tag('email', $sf_params->get('email'), 'style=width:300px autofocus=autofocus') ?>
            </div>
         </div>
      </fieldset>

      <ul class="sf_admin_actions">
         <li><?php echo submit_tag(__s('send it'),'class=sf_admin_action_save') ?></li>
      </ul>

   </form>
</div>
</div>
