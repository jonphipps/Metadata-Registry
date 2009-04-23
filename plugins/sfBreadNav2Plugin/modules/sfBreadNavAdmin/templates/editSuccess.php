<br/>
<br/>

<strong><?php echo link_to('Manage menu pages','sfBreadNavAdmin/index') ?></strong>

<br/>
<br/>
<?php $sf_bread_nav_application = $form->getObject() ?>
<h2><?php echo $sf_bread_nav_application->isNew() ? 'New' : 'Edit' ?> Menu</h2>

<form action="<?php echo url_for('sfBreadNavAdmin/update'.(!$sf_bread_nav_application->isNew() ? '?id='.$sf_bread_nav_application->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('sfBreadNavAdmin/list') ?>">Cancel</a>
          <?php if (!$sf_bread_nav_application->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'sfBreadNavAdmin/delete?id='.$sf_bread_nav_application->getId(), array('post' => true, 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><label for="sf_bread_nav_application_name">Name</label></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><label for="sf_bread_nav_application_application">Application</label></th>
        <td>
          <?php echo $form['application']->renderError() ?>
          <?php echo $form['application'] ?>
        </td>
      </tr>
      <tr>
        <th><label for="sf_bread_nav_application_css">Css</label></th>
        <td>
          <?php echo $form['css']->renderError() ?>
          <?php echo $form['css'] ?>

        <?php echo $form['id'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
