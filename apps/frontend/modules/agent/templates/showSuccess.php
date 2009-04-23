<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $agent->getId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $agent->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Last updated:</th>
      <td><?php echo $agent->getLastUpdated() ?></td>
    </tr>
    <tr>
      <th>Deleted at:</th>
      <td><?php echo $agent->getDeletedAt() ?></td>
    </tr>
    <tr>
      <th>Org email:</th>
      <td><?php echo $agent->getOrgEmail() ?></td>
    </tr>
    <tr>
      <th>Org name:</th>
      <td><?php echo $agent->getOrgName() ?></td>
    </tr>
    <tr>
      <th>Ind affiliation:</th>
      <td><?php echo $agent->getIndAffiliation() ?></td>
    </tr>
    <tr>
      <th>Ind role:</th>
      <td><?php echo $agent->getIndRole() ?></td>
    </tr>
    <tr>
      <th>Address1:</th>
      <td><?php echo $agent->getAddress1() ?></td>
    </tr>
    <tr>
      <th>Address2:</th>
      <td><?php echo $agent->getAddress2() ?></td>
    </tr>
    <tr>
      <th>City:</th>
      <td><?php echo $agent->getCity() ?></td>
    </tr>
    <tr>
      <th>State:</th>
      <td><?php echo $agent->getState() ?></td>
    </tr>
    <tr>
      <th>Postal code:</th>
      <td><?php echo $agent->getPostalCode() ?></td>
    </tr>
    <tr>
      <th>Country:</th>
      <td><?php echo $agent->getCountry() ?></td>
    </tr>
    <tr>
      <th>Phone:</th>
      <td><?php echo $agent->getPhone() ?></td>
    </tr>
    <tr>
      <th>Web address:</th>
      <td><?php echo $agent->getWebAddress() ?></td>
    </tr>
    <tr>
      <th>Type:</th>
      <td><?php echo $agent->getType() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('agent/edit?id='.$agent->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('agent/index') ?>">List</a>
