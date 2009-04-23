<h1>Agent List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Created at</th>
      <th>Last updated</th>
      <th>Deleted at</th>
      <th>Org email</th>
      <th>Org name</th>
      <th>Ind affiliation</th>
      <th>Ind role</th>
      <th>Address1</th>
      <th>Address2</th>
      <th>City</th>
      <th>State</th>
      <th>Postal code</th>
      <th>Country</th>
      <th>Phone</th>
      <th>Web address</th>
      <th>Type</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($agent_list as $agent): ?>
    <tr>
      <td><a href="<?php echo url_for('agent/show?id='.$agent->getId()) ?>"><?php echo $agent->getId() ?></a></td>
      <td><?php echo $agent->getCreatedAt() ?></td>
      <td><?php echo $agent->getLastUpdated() ?></td>
      <td><?php echo $agent->getDeletedAt() ?></td>
      <td><?php echo $agent->getOrgEmail() ?></td>
      <td><?php echo $agent->getOrgName() ?></td>
      <td><?php echo $agent->getIndAffiliation() ?></td>
      <td><?php echo $agent->getIndRole() ?></td>
      <td><?php echo $agent->getAddress1() ?></td>
      <td><?php echo $agent->getAddress2() ?></td>
      <td><?php echo $agent->getCity() ?></td>
      <td><?php echo $agent->getState() ?></td>
      <td><?php echo $agent->getPostalCode() ?></td>
      <td><?php echo $agent->getCountry() ?></td>
      <td><?php echo $agent->getPhone() ?></td>
      <td><?php echo $agent->getWebAddress() ?></td>
      <td><?php echo $agent->getType() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('agent/new') ?>">New</a>
