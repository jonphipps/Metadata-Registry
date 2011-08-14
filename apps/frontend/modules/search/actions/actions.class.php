<?php

/**
 * search actions.
 *
 * @package    registry
 * @subpackage search
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 210 2007-03-01 23:59:16Z jphipps $
 */
class searchActions extends sfActions
{
  public function preExecute ()
  {
    $this->getResponse()->addStylesheet('/jpAdminPlugin/css/main');
  }

  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $sort_column = $this->getRequestParameter('sort');
    if ($sort_column)
    {
      switch ($sort_column)
      {
       case 'concept_pref_label':
        $sort_column = ConceptPropertyPeer::CONCEPT_PREF_LABEL;
        break;
       case 'vocabulary_name':
        $sort_column = ConceptPropertyPeer::VOCABULARY_NAME;
        break;
       case 'skos_property_name':
        $sort_column = ConceptPropertyPeer::SKOS_PROPERTY_NAME;
        break;
       case 'object':
        $sort_column = ConceptPropertyPeer::OBJECT;
        break;
      }
    $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/concept_search/sort');
    $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/concept_search/sort');
    }

   if ($this->getRequest()->hasParameter('term'))
    {
      $this->getRequest()->setParameter('filter','filter');
      $filters = array('label' => $this->getRequestParameter('term'));
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/concept_search/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/concept_search/filters');
   }
   $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/concept_search/filters');

    // pager
   $this->pager = new sfPropelPager('ConceptProperty', 20);

   $c = new Criteria();

   //set sort criteria
   if ($sort_column)
   {
    if ($this->getUser()->getAttribute('type', null, 'sf_admin/concept_search/sort') == 'asc')
    {
      $c->addAscendingOrderByColumn($sort_column);
    }
    else
    {
      $c->addDescendingOrderByColumn($sort_column);
    }
   }

   if (isset($this->filters['label']) && $this->filters['label'] !== '')
    {
      $c->add(ConceptPropertyPeer::OBJECT, '%' . $this->filters['label'] . '%', Criteria::LIKE);
      $c->add(ConceptPropertyPeer::SKOS_PROPERTY_ID,
      array(SkosPropertyPeer::LABEL_ID,
       SkosPropertyPeer::LABEL_ALT_ID,
       SkosPropertyPeer::LABEL_HIDDEN_ID,
       SkosPropertyPeer::LABEL_PREF_ID), Criteria::IN);
    }

    $this->pager->setCriteria($c);
    $this->pager->setPeerMethod('doSelectSearchResults');
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  } //executeSearch
}
