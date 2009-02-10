   <ul class="plain_list">
   <?php $vocabularys = $user->getVocabularyHasUsersJoinVocabulary() ?>
   <?php if (count($vocabularys)): ?>
   <?php foreach ($vocabularys as $vocabulary):  ?>
     <li><?php $voc = $vocabulary->getVocabulary(); echo link_to($voc->getName(), 'vocabulary/show?id=' . $voc->getId()) ?></li>
   <?php endforeach ?>
   <?php else: ?>
   <li>None</li>
   <?php endif; ?>
   </ul>
