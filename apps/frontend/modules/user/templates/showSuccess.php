<?php use_helper('Validation', 'Javascript','Date', 'Text', 'Object') ?>

<?php echo javascript_tag("formUtil.focusOnFirst('user_edit');") ?>

<div id="sf_admin_container">
   <h1><?php echo __('%1%\'s profile', array('%1%' => $subscriber->__toString())) ?>
   <?php if ($subscriber->getIsModerator()): ?> [<?php echo __('moderator') ?>]<?php endif ?>
   <?php if ($subscriber->getIsAdministrator()): ?> [<?php echo __('administrator') ?>]<?php endif ?>
   </h1>

   <?php echo include_partial('administrator/user_options', array('subscriber' => $subscriber)) ?>

   <?php if ($subscriber->getId() == $sf_user->getSubscriberId()): ?>
      <?php echo form_tag('user/update', 'user_edit') ?>
         <fieldset>

            <div class="form-row">
               <label for="nickname"><?php echo __('login name:') ?></label>
               <div class="content">
                  <strong><?php echo $subscriber->getNickname() ?></strong>
               </div>
            </div>

            <div class="form-row">
               <?php echo form_error('first_name') ?>
               <label for="first_name"><?php echo __('first name:') ?></label>
               <div class="content">
                  <?php echo object_input_tag($subscriber, 'getFirstName', 'size=30') ?>
               </div>
            </div>

            <div class="form-row">
               <?php echo form_error('last_name') ?>
               <label for="last_name"><?php echo __('last name:') ?></label>
               <div class="content">
                  <?php echo object_input_tag($subscriber, 'getLastName', 'size=30') ?>
               </div>
            </div>

            <div class="form-row">
               <?php echo form_error('email') ?>
               <label for="email"><?php echo __('email:') ?></label>
               <div class="content">
                  <?php echo object_input_tag($subscriber, 'getEmail', 'size=30') ?>
               </div>
            </div>

            <div class="form-row">
               <?php echo form_error('password') ?>
               <label for="password"><?php echo __('password:') ?></label>
               <div class="content">
                  <?php echo input_password_tag('password', '', 'size=30') ?>
               </div>
            </div>

            <div class="form-row">
               <?php echo form_error('password_bis') ?>
               <label for="password_bis"><?php echo __('confirm your password:') ?></label>
               <div class="content">
                  <?php echo input_password_tag('password_bis', '', 'size=30') ?>
               </div>
            </div>

         </fieldset>

         <ul class="sf_admin_actions">
            <li><?php echo submit_tag(__('update it'),'class=sf_admin_action_save') ?></li>
         </ul>
      </form>
   <?php endif ?>

   <h3><?php echo __('Registered Vocabularies') ?></h3>

   <ul class="plain_list">
   <?php $vocabularys = $subscriber->getVocabularyHasUsersJoinVocabulary() ?>
   <?php foreach ($vocabularys as $vocabulary):  ?>
     <li><?php $voc = $vocabulary->getVocabulary(); echo link_to($voc->getName(), 'vocabulary/edit?id=' . $voc->getId()) ?></li>
   <?php endforeach ?>
   </ul>
</div>