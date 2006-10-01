<table cellspacing="0" class="sf_admin_list">
<?php $skosProps = SkosPropertyPeer::getResourceProperties(); ?>
<?php foreach($properties as $property): ?>
  <tr>
    <td>
  <?php if ($sf_user->hasCredential(array (0 => array (0 => 'administrator', 1 => 'vocabularymaintainer')))): ?>
      <?php echo link_to($property->getSkosProperty()->getLabel(), 'conceptprop/edit?id=' . $property->getId()) ?>
  <?php else: ?>
      <?php echo link_to($property->getSkosProperty()->getLabel(), 'conceptprop/show?id=' . $property->getId()) ?>
  <?php endif; ?>
    </td>
    <td>
<?php $skos = $property->getSkosPropertyId(); ?>
<?php if (in_array($skos, $skosProps)): ?>
  <?php $relatedConcept = $property->getConceptRelatedByRelatedConceptId(); ?>
      <?php echo ($relatedConcept) ? link_to($relatedConcept->getPrefLabel(), 'concept/show?id=' . $relatedConcept->getId()) : $property->getObject(); ?>
<?php else: ?>
      <?php echo $property->getObject(); ?>
<?php endif; ?>
    </td>
  </tr>
<?php endforeach ?>
</table>