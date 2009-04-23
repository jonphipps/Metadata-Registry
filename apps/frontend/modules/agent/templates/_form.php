<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<form action="<?php echo url_for('agent/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields() ?>
          &nbsp;<a href="<?php echo url_for('agent/index') ?>">Cancel</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'agent/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['last_updated']->renderLabel() ?></th>
        <td>
          <?php echo $form['last_updated']->renderError() ?>
          <?php echo $form['last_updated'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['deleted_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['deleted_at']->renderError() ?>
          <?php echo $form['deleted_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['org_email']->renderLabel() ?></th>
        <td>
          <?php echo $form['org_email']->renderError() ?>
          <?php echo $form['org_email'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['org_name']->renderLabel() ?></th>
        <td>
          <?php echo $form['org_name']->renderError() ?>
          <?php echo $form['org_name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ind_affiliation']->renderLabel() ?></th>
        <td>
          <?php echo $form['ind_affiliation']->renderError() ?>
          <?php echo $form['ind_affiliation'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['ind_role']->renderLabel() ?></th>
        <td>
          <?php echo $form['ind_role']->renderError() ?>
          <?php echo $form['ind_role'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['address1']->renderLabel() ?></th>
        <td>
          <?php echo $form['address1']->renderError() ?>
          <?php echo $form['address1'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['address2']->renderLabel() ?></th>
        <td>
          <?php echo $form['address2']->renderError() ?>
          <?php echo $form['address2'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['city']->renderLabel() ?></th>
        <td>
          <?php echo $form['city']->renderError() ?>
          <?php echo $form['city'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['state']->renderLabel() ?></th>
        <td>
          <?php echo $form['state']->renderError() ?>
          <?php echo $form['state'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['postal_code']->renderLabel() ?></th>
        <td>
          <?php echo $form['postal_code']->renderError() ?>
          <?php echo $form['postal_code'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['country']->renderLabel() ?></th>
        <td>
          <?php echo $form['country']->renderError() ?>
          <?php echo $form['country'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['phone']->renderLabel() ?></th>
        <td>
          <?php echo $form['phone']->renderError() ?>
          <?php echo $form['phone'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['web_address']->renderLabel() ?></th>
        <td>
          <?php echo $form['web_address']->renderError() ?>
          <?php echo $form['web_address'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['type']->renderLabel() ?></th>
        <td>
          <?php echo $form['type']->renderError() ?>
          <?php echo $form['type'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
