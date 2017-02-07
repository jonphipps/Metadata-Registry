<?php use_helper('Validation');
/** @var sfWebRequest $sf_request */
 $newAccount = $sf_request->getAttribute('newaccount', false) ?>
<div id="login_div">
    <div id="sf_admin_container">
        <div id="sf_admin_header" style="border-bottom: 1px solid lightgray">
            <h1><?php echo __s('sign in / register') ?></h1></div>
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
                    <h2><?php echo __s('Please correct the following errors...') ?></h2>
                    <dl>
                        <?php foreach ($errorNames as $name): ?>
                            <dt><?php echo __s($labels[$name]) ?></dt>
                            <dd><?php echo $sf_request->getError($name) ?></dd>
                        <?php endforeach; ?>
                    </dl>
                </div>
            <?php endif; ?>

            <?php echo form_tag($newAccount ? '@add_account' : '@login',
                                ['id'=>'login_form', 'autocomplete'=>'off']) ?>
            <fieldset id="sf_fieldset_login">
                <div class="form-row">
                    <?php echo form_error('nickname') ?>
                    <label for="nickname" class="required"><?php echo __s('login name:') ?></label>
                    <div class="content<?php if ($sf_request->hasError('nickname')): ?> form-error<?php endif; ?>">
                        <?php echo input_tag('nickname', $sf_params->get('nickname'), [ 'autofocus', 'required' ]) ?>
                    </div>
                </div>
                <div class="form-row">
                    <?php echo form_error('password') ?>
                    <label for="password" class="required"><?php echo __s('password:') ?></label>
                    <div class="content<?php if ($sf_request->hasError('password')): ?> form-error<?php endif; ?>">
                        <?php if ($sf_request->getParameter('new', false)) {
                            $param = [ 'id' => 'forgot', 'style' => "display: none" ];
                        } else {
                            $param = [ 'id' => 'forgot' ];
                        }
                        ?>
                        <?php echo input_password_tag('password', null, [ 'required' ]) ?>
                        &nbsp;<?php echo $newAccount ? '' : sf_link_to(__s('forgot your password?'), '@user_require_password', $param) ?>
                    </div>
                </div>
                <div id="new_account" <?php echo $newAccount ? '' : ' style="display: none"' ?>>
                    <div class="form-row">
                        <label for="password_bis" class="required"><?php echo __s('confirm password:') ?></label>
                        <div class="content">
                            <?php echo input_password_tag('password_bis') ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <?php echo form_error('email') ?>
                        <label for="email" class="required"><?php echo __s('your email:') ?></label>
                        <div class="content<?php if ($sf_request->hasError('email')): ?> form-error<?php endif; ?>">
                            <?php echo input_tag('email', $sf_params->get('email'), [ 'size'=>'65', 'type'=>'email' ]) ?>
                            <div style="padding:10px 0px 10px 0px;"><?php echo __s('The Registry will never disclose this address to a third party') ?></div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
            <ul class="sf_admin_actions">
                <li><?php echo submit_tag(__s($newAccount ? 'register' : 'sign in'),
                        'class=sf_admin_action_save') ?></li>
                <li><?php echo $newAccount ? '' : button_to(__s('Register a new account'),
                        '@add_account',
                        [
                            'title' => 'Register a new account',
                            'class' => 'sf_admin_action_create',
                        ]) ?></li>
            </ul>
            </form></div>
        <p style="padding-left: 1rem"><?php echo __s('Note: User Registration is only required if you want to register or maintain resources.') ?></p>
    </div>
</div>
