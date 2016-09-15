<ul class="plain_list">
   <?php $schemas = $user->getSchemaHasUsersJoinSchema() ?>
   <?php if (count($schemas)): ?>
   <?php /** @var SchemaHasUser $schema */
       foreach ($schemas as $schema):  ?>
     <li><?php $sch = $schema->getSchema(); echo link_to($sch->getName(), '@schema_detail?id=' . $sch->getId()) ?></li>
   <?php endforeach ?>
   <?php else: ?>
   <li>None</li>
   <?php endif; ?>
   </ul>
