<html>
  <head>
    <?php include_title() ?>
    <?php include_stylesheets() ?>
    <!--[if IE]>
    <?php echo stylesheet_tag(_compute_public_path('sfControlPanelPlugin/css/ie', '.', 'css')) ?>
    <![endif]-->
  </head>
  <body>
    
    <div id="header">
    <?php include_component('sfControlPanel', 'header') ?>
    </div>
    
    <div id="sidebar">
    <?php if(has_slot('sidebar')): ?>
      <?php include_slot('sidebar') ?>
    <?php else: ?>
      <?php include_component('sfControlPanel', 'dataSidebar') ?>
    <?php endif; ?>
    </div>
    
    <div id="main">
    <?php echo $sf_data->getRaw('sf_content') ?>
    </div>
    
  </body>
</html>