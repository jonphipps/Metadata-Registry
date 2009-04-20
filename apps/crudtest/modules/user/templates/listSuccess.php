<?php
// auto-generated by sfPropelCrud
// date: 2007/02/03 15:43:22
?>
<h1>user</h1>

<table>
<thead>
<tr>
  <th>Id</th>
  <th>Created at</th>
  <th>Last updated</th>
  <th>Nickname</th>
  <th>Salutation</th>
  <th>First name</th>
  <th>Last name</th>
  <th>Email</th>
  <th>Sha1 password</th>
  <th>Salt</th>
  <th>Want to be moderator</th>
  <th>Is moderator</th>
  <th>Is administrator</th>
  <th>Deletions</th>
  <th>Password</th>
</tr>
</thead>
<tbody>
<?php foreach ($users as $user): ?>
<tr>
    <td><?php echo link_to($user->getId(), 'user/show?id='.$user->getId()) ?></td>
      <td><?php echo $user->getCreatedAt() ?></td>
      <td><?php echo $user->getLastUpdated() ?></td>
      <td><?php echo $user->getNickname() ?></td>
      <td><?php echo $user->getSalutation() ?></td>
      <td><?php echo $user->getFirstName() ?></td>
      <td><?php echo $user->getLastName() ?></td>
      <td><?php echo $user->getEmail() ?></td>
      <td><?php echo $user->getSha1Password() ?></td>
      <td><?php echo $user->getSalt() ?></td>
      <td><?php echo $user->getWantToBeModerator() ?></td>
      <td><?php echo $user->getIsModerator() ?></td>
      <td><?php echo $user->getIsAdministrator() ?></td>
      <td><?php echo $user->getDeletions() ?></td>
      <td><?php echo $user->getPassword() ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo link_to ('create', 'user/create') ?>
