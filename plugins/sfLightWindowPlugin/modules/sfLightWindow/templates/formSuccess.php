<form id="sample-form" name="sample-form">
		<ul style="list-style-type: none;margin: 0; padding: 0;">
			<li>
			
            </li>
            <li>
				<input id="name" name="name" type="text" value="What is your name?" />
			</li>
			<li>
        <a class="lightwindow_action" style="line-height: 100%;" rel="submitForm" params="lightwindow_form=sample-form" href="/hello.php">
        <button>Submit</button>
        </a>
        or
        <a class="lightwindow_action" rel="deactivate" style="color: blue;" href="#">Cancel</a>
			</li>
		</ul>
</form>
<?php /*

<?php use_helper('LightWindow') ?>

<?php if ($name) : ?>
  <?php echo 'Hi, '.$name.'!' ?>
<?php else : ?>
<form id="sample-form" name="sample-form">
	<ul style="list-style-type: none;margin: 0; padding: 0;">
		<li></li>
    <li>
			<?php echo input_tag('name', 'What is your name?') ?>
		</li>
		<li>
		  <?php echo lw_form_submit('<button>Submit</button>', 'hello.php', 'form=sample-form') ?>
			or
			<?php echo lw_form_cancel('Cancel', 'style="color:#00f"') ?>
		</li>
	</ul>
</form>
<?php endif ?>

*/ ?>