<br/>
<br/>

<strong><?php echo link_to('Manage menu pages','sfBreadNavAdmin/index') ?></strong>

<br/>
<br/>

<h2>Menu List</h2>


<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Application</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sf_bread_nav_applicationList as $sf_bread_nav_application): ?>
    <tr>
      <td><a href="<?php echo url_for('sfBreadNavAdmin/edit?id='.$sf_bread_nav_application->getId()) ?>"><?php echo $sf_bread_nav_application->getName() ?></a></td>
      
      
      <td><?php echo $sf_bread_nav_application->getApplication() ?></td>
      
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<br/>
<a href="<?php echo url_for('sfBreadNavAdmin/create') ?>">Create</a>
