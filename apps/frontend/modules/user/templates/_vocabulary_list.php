   <ul class="plain_list">
   <?php $vocabularys = $user->getVocabularyHasUsersJoinVocabulary() ?>
   <?php if (count($vocabularys)): ?>
   <?php foreach ($vocabularys as $vocabulary):  ?>
     <li><?php $voc = $vocabulary->getVocabulary(); echo sf_link_to($voc->getName(), '@vocabulary_show?id=' . $voc->getId()) ?></li>
   <?php endforeach ?>
   <?php else: ?>
   <li>None</li>
   <?php endif; ?>
   </ul>
