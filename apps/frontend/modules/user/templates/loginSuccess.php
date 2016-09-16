<?php use_helper('Validation', 'Javascript') ?>
<div id="login_div">
    <div id="sf_admin_container">
        <div id="sf_admin_header" style="border-bottom: 1px solid lightgray">
            <h1><?php echo __('sign in / register') ?></h1></div>
        <div id="sf_admin_content">
            <?php
            if ($sf_request->hasErrors()):
                $labels['password'] = 'password';
                $labels['password_bis'] = 'confirm password';
                $labels['nickname'] = 'login name';
                $labels['email'] = 'your email';
                $errorNames = $sf_request->getErrorNames();
                $nickError = $sf_request->getError('nickname');
                $nickKey = array_search('nickname', $errorNames);

                if ($nickKey && '' == $nickError) {
                    unset( $errorNames[$nickKey] );
                }
                ?>
                <div class="form-errors">
                    <h2><?php echo __('Please correct the following errors...') ?></h2>
                    <dl>
                        <?php foreach ($errorNames as $name): ?>
                            <dt><?php echo __($labels[$name]) ?></dt>
                            <dd><?php echo $sf_request->getError($name) ?></dd>
                        <?php endforeach; ?>
                    </dl>
                </div>
            <?php endif; ?>

            <?php echo form_tag($sf_request->getAttribute('newaccount', false) ? '@add_account' : '@login',
                                ['id'=>'login_form', 'autocomplete'=>'off']) ?>
            <fieldset id="sf_fieldset_login">
                <div class="form-row">
                    <?php echo form_error('nickname') ?>
                    <label for="nickname" class="required"><?php echo __('login name:') ?></label>
                    <div class="content<?php if ($sf_request->hasError('nickname')): ?> form-error<?php endif; ?>">
                        <?php echo input_tag('nickname', $sf_params->get('nickname'), [ 'autofocus', 'required' ]) ?>
                    </div>
                </div>
                <div class="form-row">
                    <?php echo form_error('password') ?>
                    <label for="password" class="required"><?php echo __('password:') ?></label>
                    <div class="content<?php if ($sf_request->hasError('password')): ?> form-error<?php endif; ?>">
                        <?php if ($sf_request->getParameter('new', false)) {
                            $param = [ 'id' => 'forgot', 'style' => "display: none" ];
                        } else {
                            $param = [ 'id' => 'forgot' ];
                        }
                        ?>
                        <?php echo input_password_tag('password', null, [ 'required' ]) ?>
                        &nbsp;<?php echo link_to(__('forgot your password?'),
                                                 '@user_require_password',
                                                 $param) ?>
                    </div>
                </div>
                <div id="new_account" <?php echo $sf_request->getAttribute('newaccount',
                                                                           false) ? '' : ' style="display: none"' ?>>
                    <div class="form-row">
                        <label for="password_bis" class="required"><?php echo __('confirm password:') ?></label>
                        <div class="content">
                            <?php echo input_password_tag('password_bis') ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <?php echo form_error('email') ?>
                        <label for="email" class="required"><?php echo __('your email:') ?></label>
                        <div class="content<?php if ($sf_request->hasError('email')): ?> form-error<?php endif; ?>">
                            <?php echo input_tag('email', $sf_params->get('email'), [ 'size'=>'65', 'type'=>'email' ]) ?>
                            <div style="padding:10px 0px 10px 0px;"><?php echo __('The Registry will never disclose this address to a third party') ?></div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <?php echo checkbox_tag('new',
                                            1,
                                            $sf_request->getAttribute('newaccount', false) ? 1 : 0,
                                            [ 'onclick' => 'toggleForm()' ]) ?>
                    &nbsp;<label for="new" style="display: inline; float: none"><?php echo __('click here to create a new account') ?></label>
                </div>
            </fieldset>
            <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
            <ul class="sf_admin_actions">
                <li><?php echo submit_tag(__('sign in'), 'class=sf_admin_action_save') ?></li>
            </ul>
            </form></div>
        <p style="padding-left: 1rem"><?php echo __('Note: User Registration is only required if you want to register or maintain resources.') ?></p>
    </div>
</div>
<?php echo javascript_tag("function toggleForm()
{
  if (Element.visible('new_account'))
  {
    " . visual_effect('BlindUp', 'new_account') . "
    $('login_form').action = '" . url_for('@login') . "';
    $('forgot').show();
    $('nickname').activate();
  }
  else
  {
    " . visual_effect('BlindDown', 'new_account') . "
    $('login_form').action = '" . url_for('@add_account') . "';
    $('forgot').hide();
    $('nickname').activate();
  }

  return false;
}") ?>

