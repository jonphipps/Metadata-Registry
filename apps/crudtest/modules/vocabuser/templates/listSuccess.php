<?php
// auto-generated by sfPropelCrud
// date: 2007/02/03 15:47:09
?>
<h1>vocabuser</h1>

<table>
<thead>
<tr>
  <th>Vocabulary</th>
  <th>User</th>
  <th>Is maintainer for</th>
  <th>Is registrar for</th>
  <th>Is admin for</th>
</tr>
</thead>
<tbody>
<?php foreach ($vocabulary_has_users as $vocabulary_has_user): ?>
<tr>
    <td><?php echo link_to($vocabulary_has_user->getVocabularyId(), 'vocabuser/show?vocabulary_id='.$vocabulary_has_user->getVocabularyId().'&user_id='.$vocabulary_has_user->getUserId()) ?></td>
      <td><?php echo link_to($vocabulary_has_user->getUserId(), 'vocabuser/show?vocabulary_id='.$vocabulary_has_user->getVocabularyId().'&user_id='.$vocabulary_has_user->getUserId()) ?></td>
      <td><?php echo $vocabulary_has_user->getIsMaintainerFor() ?></td>
      <td><?php echo $vocabulary_has_user->getIsRegistrarFor() ?></td>
      <td><?php echo $vocabulary_has_user->getIsAdminFor() ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo link_to ('create', 'vocabuser/create') ?>
