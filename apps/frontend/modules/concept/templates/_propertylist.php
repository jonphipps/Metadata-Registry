<table cellspacing="0" class="sf_admin_list">
<?php
  $i = 1;  $skosProps = SkosPropertyPeer::getResourceProperties();
  foreach($properties as $property): $odd = fmod(++$i, 2); ?>
<tr class="sf_admin_row_<?php echo $odd ?>">
<td nowrap><?php echo link_to($property->getSkosProperty()->getLabel(), 'conceptprop/show?id=' . $property->getId()) ?>
</td>
<td>
<?php $skos = $property->getSkosPropertyId();
  if (in_array($skos, $skosProps)): ?>
  <?php echo $property->getConceptRelatedByRelatedConceptId()->getPrefLabel(); ?>
<?php else: ?>
  <?php echo $property->getObject(); ?>
<?php endif; ?>
</td></tr>
  <?php endforeach ?>
  </table>

