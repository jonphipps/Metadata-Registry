<?php echo use_helper('Javascript') ?>
<?php echo use_javascript(sfConfig::get('sf_prototype_web_dir').'/js/prototype') ?>
<?php slot('sidebar') ?>
<ul>
  <li class="category empty">sfConfig</li>
</ul>
<?php end_slot() ?>

<div id="filter">
<input name="filter_text" id="filter_text" value="filter" onClick="this.value='';"/>
<?php echo javascript_tag('
new Form.Element.Observer("filter_text", 1, function(input, value) {
   $$(".parameter").each(function (parameter) { 
     parameter.style.display = (parameter.id.indexOf(value) == 0) ? "block" : "none";
   });
});
') ?>
</div>

<div id="sfConfig">
<?php foreach($config as $key => $value): ?>
  <div id="<?php echo $key ?>" class="parameter">
    <div class="key"><?php echo $key ?></div>
    <div class="value"><?php print_r($value) ?></div>
  </div>
<?php endforeach; ?>
</div>
