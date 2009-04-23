<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_solved">
        <div>
      <label for="sf_webpanel_bugs_solved">Solved</label>
      <?php
		use_helper('Form');
		echo select_tag('sf_webpanel_bugs[solved]', options_for_select(array('No', 'Yes'), $form->getObject()->getSolved()));
		
		?>
          </div>
  </div>