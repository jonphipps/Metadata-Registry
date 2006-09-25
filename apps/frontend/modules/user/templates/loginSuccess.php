<?php use_helper('Validation', 'Javascript') ?>

<div id="sf_admin_container">
<?php echo javascript_tag("formUtil.focusOnFirst('login_form');") ?>

<h1><?php echo __('sign in / register') ?></h1>

<div style="padding:10px 0px 10px 6px;"><?php echo __('User Registration is only required if you want to register or maintain resources.') ?></div>

<?php echo form_tag($sf_request->getAttribute('newaccount', false) ? '@add_account' : '@login', 'id=login_form') ?>

   <fieldset id="sf_fieldset_login">
      <div class="form-row">
         <?php echo form_error('nickname') ?>
         <label for="nickname"><?php echo __('login name:') ?></label>
         <div class="content">
            <?php echo input_tag('nickname', $sf_params->get('nickname')) ?>
         </div>
      </div>

      <div class="form-row">
         <?php echo form_error('password') ?>
         <label for="password"><?php echo __('password:') ?></label>
         <div class="content">
            <?php echo input_password_tag('password') ?>&nbsp;<?php echo link_to(__('forgot your password?'), '@user_require_password') ?>
         </div>
      </div>

      <div class="form-row">
         <?php echo checkbox_tag('new', 1, $sf_request->getAttribute('newaccount', false) ? 1 : 0, array('onclick' => 'toggleForm()')) ?>
         &nbsp;<label for="new" style="display: inline; float: none"><?php echo __('click here to create a new account') ?></label>
      </div>

      <div id="new_account"<?php echo $sf_request->getAttribute('newaccount', false) ? '' : ' style="display: none"' ?>>
         <div class="form-row">
            <label for="password_bis"><?php echo __('confirm your password:') ?></label>
            <div class="content">
               <?php echo input_password_tag('password_bis') ?>
            </div>
         </div>

         <div class="form-row">
            <?php echo form_error('email') ?>
            <label for="email"><?php echo __('your email:') ?></label>
            <div class="content">
               <?php echo input_tag('email', $sf_params->get('email')) ?>
               <div style="padding:10px 0px 10px 0px;"><?php echo __('The Registry will never disclose this address to a third party') ?></div>
            </div>
         </div>

      </div>

   </fieldset>

   <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>

   <ul class="sf_admin_actions">
      <li><?php echo submit_tag(__('sign in'),'class=sf_admin_action_save') ?></li>
   </ul>

</form>

<?php echo javascript_tag("function toggleForm()
{
  if (Element.visible('new_account'))
  {
    ".visual_effect('BlindUp', 'new_account')."
    $('login_form').action = '".url_for('@login')."';
  }
  else
  {
    ".visual_effect('BlindDown', 'new_account')."
    $('login_form').action = '".url_for('@add_account')."';
  }

  return false;
}") ?>
</div>