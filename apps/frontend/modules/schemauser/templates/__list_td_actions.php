<td>
  <ul class="sf_admin_td_actions">
    <li><?php echo sf_link_to(
          image_tag( '/jpAdminPlugin/images/show_icon.png', array ( 'alt' => __s( 'show' ), 'title' => __s( 'show' ) ) ),
          'schemauser/show?id=' . $schema_has_user->getId()
      ) ?></li>
    <li><?php if ( $sf_user->hasObjectCredential(
              $schema_has_user->getSchemaId(),
              'schema',
              array (
                  0 => array (
                      0 => 'administrator',
                      1 => 'schemaadmin',
              2 => 'schemamaintainer',
              3 => 'agentadmin'
                  ),
              )
          )
      ): ?>
        <?php echo sf_link_to(
            image_tag(
                '/jpAdminPlugin/images/edit_icon.png',
                array ( 'alt' => __s( 'edit' ), 'title' => __s( 'edit' ) )
            ),
            'schemauser/edit?id=' . $schema_has_user->getId()
        ) ?>
      <?php else: ?>
        &nbsp;
      <?php endif; ?></li>
    <li><?php if ( $sf_user->hasObjectCredential(
              $schema_has_user->getSchemaId(),
              'schema',
              array (
                  0 => array (
                      0 => 'administrator',
                      1 => 'schemaadmin',
                      2 => 'agentadmin',
                  ),
              )
          )
                   && $schema_has_user->getUserId() != $sf_user->getAttribute( 'subscriber_id', '', 'subscriber' )
      ): ?>
        <?php echo sf_link_to(
            image_tag(
                '/jpAdminPlugin/images/delete_icon.png',
                array ( 'alt' => __s( 'delete' ), 'title' => __s( 'delete' ) )
            ),
            'schemauser/delete?id=' . $schema_has_user->getId(),
            array (
                'post' => true,
                'confirm' => __s( 'Are you sure?' ),
            )
        ) ?>
      <?php else: ?>
        &nbsp;
      <?php endif; ?></li>
  </ul>
</td>
