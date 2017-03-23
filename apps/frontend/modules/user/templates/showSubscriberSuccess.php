<?php use_helper('Validation', 'Javascript', 'Date', 'Text', 'Object') ?>

<?php echo javascript_tag("formUtil.focusOnFirst('sf_admin_edit_form');") ?>
<div id="sf_admin_container">
    <h1><?php echo __s('%1%\'s profile', [ '%1%' => $subscriber->__toString() ]) ?>
        <?php if ($subscriber->getIsModerator()): ?> [<?php echo __s('moderator') ?>]<?php endif ?>
        <?php if ($subscriber->getIsAdministrator()): ?> [<?php echo __s('administrator') ?>]<?php endif ?>
    </h1>
    <?php echo include_partial('administrator/user_options', [ 'subscriber' => $subscriber ]) ?>

    <?php if ($subscriber->getId() == $sf_user->getSubscriberId()): ?><?php echo form_tag('user/update',
                                                                                          [
                                                                                              'id'        => 'sf_admin_edit_form',
                                                                                              'name'      => 'sf_admin_edit_form',
                                                                                              'multipart' => true,
                                                                                          ]) ?>
        <fieldset>
            <div class="form-row">
                <label for="nickname"><?php echo __s('login name:') ?></label>
                <div class="content">
                    <strong><?php echo $subscriber->getNickname() ?></strong>
                </div>
            </div>
            <div class="form-row">
                <?php echo form_error('first_name') ?>
                <label for="first_name"><?php echo __s('first name:') ?></label>
                <div class="content">
                    <?php echo object_input_tag($subscriber, 'getFirstName', 'size=30 autofocus=autofocus') ?>
                </div>
            </div>
            <div class="form-row">
                <?php echo form_error('last_name') ?>
                <label for="last_name"><?php echo __s('last name:') ?></label>
                <div class="content">
                    <?php echo object_input_tag($subscriber, 'getLastName', 'size=30') ?>
                </div>
            </div>
            <div class="form-row">
                <?php echo form_error('email') ?>
                <label for="email"><?php echo __s('email:') ?></label>
                <div class="content">
                    <?php echo object_input_tag($subscriber, 'getEmail', 'size=30') ?>
                </div>
            </div>
            <div class="form-row">
                <?php echo form_error('password') ?>
                <label for="password"><?php echo __s('password:') ?></label>
                <div class="content">
                    <?php echo input_password_tag('password', '', 'size=30') ?>
                </div>
            </div>
            <div class="form-row">
                <?php echo form_error('password_bis') ?>
                <label for="password_bis"><?php echo __s('confirm your password:') ?></label>
                <div class="content">
                    <?php echo input_password_tag('password_bis', '', 'size=30') ?>
                </div>
            </div>
        </fieldset>
        <ul class="sf_admin_actions">
            <li><?php echo submit_tag(__s('update it'), 'class=sf_admin_action_save') ?></li>
        </ul></form>
    <?php endif ?>
    <fieldset id="sf_fieldset_schemas">
        <h2><?php echo __s('Element Sets') ?></h2>
        <div id="show_row_user_schema_list" class="show-row">
            <div id="show_row_content_user_schema_list" class="content">
                <?php $showValue = get_partial('schema_list', [ 'type' => 'list', 'user' => $subscriber ]);
                if ($showValue) {
                    echo get_partial('schema_list',
                                     [
                                         'type' => 'list',
                                         'user' => $subscriber
                                     ]);
                } ?>
            </div>
        </div>
    </fieldset>
    <fieldset id="sf_fieldset_vocabularies">
        <h2><?php echo __s('Vocabularies') ?></h2>
        <div id="show_row_user_vocabulary_list" class="show-row">
            <div id="show_row_content_user_vocabulary_list" class="content">
                <?php $showValue = get_partial('vocabulary_list', [ 'type' => 'list', 'user' => $subscriber ]);
                if ($showValue) {
                    echo get_partial('vocabulary_list',
                                     [
                                         'type' => 'list',
                                         'user' => $subscriber
                                     ]);
                } ?>
            </div>
        </div>
    </fieldset>
    <fieldset id="sf_fieldset_agents">
        <h2><?php echo __s('Projects') ?></h2>
        <div id="show_row_user_agent_list" class="show-row">
            <div id="show_row_content_user_agent_list" class="content">
                <?php $showValue = get_partial('agent_list', [ 'type' => 'list', 'user' => $subscriber ]);
                if ($showValue) {
                    echo get_partial('agent_list',
                                     [
                                         'type' => 'list',
                                         'user' => $subscriber
                                     ]);
                } ?>
            </div>
        </div>
    </fieldset>
</div>
