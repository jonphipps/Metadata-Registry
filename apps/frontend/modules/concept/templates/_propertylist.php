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
  <?php $relatedConcept = $property->getConceptRelatedByRelatedConceptId();
    if ($relatedConcept)
    {
       echo link_to($relatedConcept->getPrefLabel(), 'concept/show?id=' . $relatedConcept->getId()) ;
    }
    else
    {
       echo $property->getObject();
    } ?>
<?php else: ?>
  <?php echo $property->getObject(); ?>
<?php endif; ?>
</td></tr>
  <?php endforeach ?>
  </table>
