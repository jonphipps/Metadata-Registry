<table cellspacing="0" class="sf_admin_list">
<?php $skosProps = SkosPropertyPeer::getResourceProperties(); ?>
    <?php /** @var ConceptProperty $property */
foreach($properties as $property): ?>
  <tr>
    <td>
      <?php echo link_to($property->getProfileProperty()->getLabel(), 'conceptprop/show?id=' . $property->getId(), array('title' => 'skos:' . $property->getProfileProperty()->getName())) ?>
    </td>
    <td>
<?php $skos = $property->getSkosPropertyId(); ?>
<?php if (in_array($skos, $skosProps)): ?>
  <?php $relatedConcept = $property->getConceptRelatedByRelatedConceptId(); ?>
      <?php echo ($relatedConcept) ? link_to($relatedConcept->getPrefLabel(), 'concept/show?id=' . $relatedConcept->getId(), array('title' => $relatedConcept->getUri())) : htmlspecialchars(html_entity_decode($property->getObject(), ENT_QUOTES | ENT_HTML5, 'UTF-8')); ?>
<?php else: ?>
      <?php echo $property->getObject(); ?>
<?php endif; ?>
    </td>
    <td><?php $value = format_language($property->getLanguage()); echo ($value) ? $value : '&nbsp;' ?></td>
    <td><?php $value = $property->getStatus(); echo ($value) ? $value : '&nbsp;' ?></td>
<?php if ($sf_user->isAuthenticated()): ?>
<?php if ($sf_user->hasObjectCredential($sf_user->getCurrentVocabulary()->getId(), 'vocabulary',  array (   0 =>    array (     0 => 'administrator',     1 => 'vocabularymaintainer',     2 => 'vocabularyadmin',   ), ))): ?>
    <td>
      <ul class="sf_admin_td_actions">
        <li>
          <?php echo link_to(image_tag('/jpAdminPlugin/images/edit_icon.png', array('alt' => __('edit'), 'title' => __('edit'))), 'conceptprop/edit?id='.$property->getId()) ?>
        </li>
      </ul>
    </td>
<?php endif; ?>
<?php endif; ?>
  </tr>
<?php endforeach ?>
</table>
