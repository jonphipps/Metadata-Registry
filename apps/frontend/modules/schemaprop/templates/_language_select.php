<div class="show-row" style="padding-left: 10px; padding-top: 5px; border-top: 1px solid #DDDDDD;">
  <?php
/**
 * Created by jonphipps, on 2014-03-29 at 7:19 PM
 * for the registry project
 */
  //here we're going to put a select box to change the culture
  //it should have an array of potential languages from the schema for list and show
  //it should have an array of potential languages from schema_user for edit
  //it should append the selected language to the url and change the location onChange
  //we'll need to add the array of languages to use to the $sf_user session in the action class
?>
  <?php echo form_tag('@schemaprop_language') ?>
      <?php echo label_for('culture', __('Current content language').':', array("style" =>"float: left; width: 148px; padding-top: 5px; font-weight: bold;")) ?>
  <?php /** @var $sf_user MyUser */
      $languages = $sf_user->getAttribute("languages", null);
      $CurrentLanguage = $sf_user->getAttribute("CurrentLanguage", null);
      //if the current culture setting isn't in the allowed list, we reset the culture to the default
      echo select_language_tag('culture', $CurrentLanguage, array('id' => 'culture', "languages" => $languages)) ?>
      <?php echo submit_tag('Go') ?>
    </form>
  </div>
