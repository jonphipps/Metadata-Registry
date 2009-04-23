[?php

/**
 * <?php echo $this->getGeneratedModuleName() ?> actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getGeneratedModuleName() ?>

 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 3501 2007-02-18 10:28:17Z fabien $
 */
class <?php echo $this->getGeneratedModuleName() ?>Actions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('<?php echo $this->getModuleName() ?>', 'list');
  }

  public function executeList()
  {
    $this->processSort();

    $this->processFilters();

<?php if ($this->getParameterValue('list.filters')): ?>
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/<?php echo $this->getSingularName() ?>/filters');
<?php endif ?>
    
    // pager
    $this->finder = DbFinder::from('<?php echo $this->getClassName() ?>');
<?php if ($this->getParameterValue('list.with')): ?>
<?php foreach ($this->getParameterValue('list.with') as $withClass): ?>
<?php if (strtolower($withClass) != 'i18n'): ?>
    $this->finder->leftJoin('<?php echo $withClass ?>');
<?php endif ?>
    $this->finder->with('<?php echo $withClass ?>');
<?php endforeach ?>
<?php endif ?>
<?php if ($this->getParameterValue('list.finder_methods')): ?>
<?php foreach ($this->getParameterValue('list.finder_methods') as $method): ?>
    $this->finder-><?php echo $method ?>();
<?php endforeach ?>
<?php endif ?>
    $this->addSort($this->finder);
    $this->addFilters($this->finder);
    $this->pager = $this->finder->paginate($this->getRequestParameter('page', 1), <?php echo $this->getParameterValue('list.max_per_page', 20) ?>);
  }

  public function executeCreate()
  {
    return $this->forward('<?php echo $this->getModuleName() ?>', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('<?php echo $this->getModuleName() ?>', 'edit');
  }

  public function executeEdit()
  {
    $this-><?php echo $this->getSingularName() ?> = $this->get<?php echo $this->getClassName() ?>OrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->update<?php echo $this->getClassName() ?>FromRequest();

      $this->save<?php echo $this->getClassName() ?>($this-><?php echo $this->getSingularName() ?>);

      $this->setFlashCompatible('notice', 'Your modifications have been saved');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('<?php echo $this->getModuleName() ?>/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('<?php echo $this->getModuleName() ?>/list');
      }
      else
      {
        return $this->redirect('<?php echo $this->getModuleName() ?>/edit?<?php echo $this->getPrimaryKeyUrlParams('this->') ?>);
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
    $this-><?php echo $this->getSingularName() ?> = DbFinder::from('<?php echo $this->getClassName() ?>')->findPk(<?php echo $this->getRetrieveByPkParamsForAction(40) ?>);
    $this->forward404Unless($this-><?php echo $this->getSingularName() ?>);

    try
    {
      $this->delete<?php echo $this->getClassName() ?>($this-><?php echo $this->getSingularName() ?>);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected <?php echo sfInflector::humanize($this->getSingularName()) ?>. Make sure it does not have any associated items.');
      return $this->forward('<?php echo $this->getModuleName() ?>', 'list');
    }

<?php foreach ($this->getColumnCategories('edit.display') as $category): ?>
<?php foreach ($this->getColumns('edit.display', $category) as $name => $column): ?>
<?php $input_type = $this->getParameterValue('edit.fields.'.$column->getName().'.type') ?>
<?php if ($input_type == 'admin_input_file_tag'): ?>
<?php $upload_dir = $this->replaceConstants($this->getParameterValue('edit.fields.'.$column->getName().'.upload_dir')) ?>
      $currentFile = sfConfig::get('sf_upload_dir')."/<?php echo $upload_dir ?>/".$this-><?php echo $this->getSingularName() ?>->get<?php echo $column->getPhpName() ?>();
      if (is_file($currentFile))
      {
        unlink($currentFile);
      }

<?php endif; ?>
<?php endforeach; ?>
<?php endforeach; ?>
    return $this->redirect('<?php echo $this->getModuleName() ?>/list');
  }

<?php $listActions = $this->getParameterValue('list.batch_actions') ?>
<?php if (null !== $listActions): ?>
  public function executeBatchAction()
  {
    $action = $this->getRequestParameter('sf_admin_batch_action');
    switch($action)
    {
<?php foreach ((array) $listActions as $actionName => $params): ?>
<?php
// default values
if ($actionName[0] == '_')
{ 
  $actionName = substr($actionName, 1);
  $name       = $actionName;
  $action     = $actionName;
}
else
{
  $name   = $actionName;
  $action = isset($params['action']) ? $params['action'] : sfInflector::camelize($actionName);
} ?>
      case "<?php echo $name ?>":
        $this->forward('<?php echo $this->getModuleName() ?>', '<?php echo $action ?>');
        break;
<?php endforeach; ?>
    }

    return $this->redirect('<?php echo $this->getModuleName() ?>/list');
  }

  public function executeDeleteSelected()
  { 
    $this->selectedItems = $this->getRequestParameter('sf_admin_batch_selection', array());

    try
    {
      $nbDeleted = DbFinder::fromArray($this->selectedItems, '<?php echo $this->getClassName() ?>', 'Id')->delete();
      $this->setFlash('notice', sprintf('%s elements deleted', $nbDeleted));
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected <?php echo sfInflector::humanize($this->getPluralName()) ?>. Make sure they do not have any associated items.');
      return $this->forward('<?php echo $this->getModuleName() ?>', 'list');
    }

    return $this->redirect('<?php echo $this->getModuleName() ?>/list?page='.$this->getRequestParameter('page'));
  }
  
<?php endif; ?>
  public function handleErrorEdit()
  {
    $this->preExecute();
    $this-><?php echo $this->getSingularName() ?> = $this->get<?php echo $this->getClassName() ?>OrCreate();
    $this->update<?php echo $this->getClassName() ?>FromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function save<?php echo $this->getClassName() ?>($<?php echo $this->getSingularName() ?>)
  {
    $<?php echo $this->getSingularName() ?>->save();

<?php foreach ($this->getColumnCategories('edit.display') as $category): ?>
<?php foreach ($this->getColumns('edit.display', $category) as $name => $column): $type = $this->DbFinderAdminGenerator->getColumnType($column); ?>
<?php $name = $column->getName() ?>
<?php if ($column->isPrimaryKey()) continue ?>
<?php $credentials = $this->getParameterValue('edit.fields.'.$column->getName().'.credentials') ?>
<?php $input_type = $this->getParameterValue('edit.fields.'.$column->getName().'.type') ?>
<?php

$user_params = $this->getParameterValue('edit.fields.'.$column->getName().'.params');
$user_params = is_array($user_params) ? $user_params : sfToolkit::stringToArray($user_params);
$through_class = isset($user_params['through_class']) ? $user_params['through_class'] : '';

?>
<?php if ($through_class): ?>
<?php

$class = $this->getClassName();
$related_class = sfPropelManyToMany::getRelatedClass($class, $through_class);
$related_table = constant($related_class.'Peer::TABLE_NAME');
$middle_table = constant($through_class.'Peer::TABLE_NAME');
$this_table = constant($class.'Peer::TABLE_NAME');

$related_column = sfPropelManyToMany::getRelatedColumn($class, $through_class);
$column = sfPropelManyToMany::getColumn($class, $through_class);

?>
<?php if ($input_type == 'admin_double_list' || $input_type == 'admin_check_list' || $input_type == 'admin_select_list'): ?>
<?php if ($credentials): $credentials = str_replace("\n", ' ', var_export($credentials, true)) ?>
    if ($this->getUser()->hasCredential(<?php echo $credentials ?>))
    {
<?php endif; ?>
      // Update many-to-many for "<?php echo $name ?>"
      $c = new Criteria();
      $c->add(<?php echo $through_class ?>Peer::<?php echo strtoupper($column->getColumnName()) ?>, $<?php echo $this->getSingularName() ?>->getPrimaryKey());
      <?php echo $through_class ?>Peer::doDelete($c);

      $ids = $this->getRequestParameter('associated_<?php echo $name ?>');
      if (is_array($ids))
      {
        foreach ($ids as $id)
        {
          $<?php echo ucfirst($through_class) ?> = new <?php echo $through_class ?>();
          $<?php echo ucfirst($through_class) ?>->set<?php echo $column->getPhpName() ?>($<?php echo $this->getSingularName() ?>->getPrimaryKey());
          $<?php echo ucfirst($through_class) ?>->set<?php echo $related_column->getPhpName() ?>($id);
          $<?php echo ucfirst($through_class) ?>->save();
        }
      }

<?php if ($credentials): ?>
    }
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php endforeach; ?>
  }

  protected function delete<?php echo $this->getClassName() ?>($<?php echo $this->getSingularName() ?>)
  {
    $<?php echo $this->getSingularName() ?>->delete();
  }

  protected function update<?php echo $this->getClassName() ?>FromRequest()
  {
    $<?php echo $this->getSingularName() ?> = $this->getRequestParameter('<?php echo $this->getSingularName() ?>');

<?php foreach ($this->getColumnCategories('edit.display') as $category): ?>
<?php foreach ($this->getColumns('edit.display', $category) as $name => $column): $type = $this->DbFinderAdminGenerator->getColumnType($column); ?>
<?php $name = $column->getName() ?>
<?php if ($column->isPrimaryKey()) continue ?>
<?php $credentials = $this->getParameterValue('edit.fields.'.$column->getName().'.credentials') ?>
<?php $input_type = $this->getParameterValue('edit.fields.'.$column->getName().'.type') ?>
<?php if ($credentials): $credentials = str_replace("\n", ' ', var_export($credentials, true)) ?>
    if ($this->getUser()->hasCredential(<?php echo $credentials ?>))
    {
<?php endif; ?>
<?php if ($input_type == 'admin_input_file_tag'): ?>
<?php $upload_dir = $this->replaceConstants($this->getParameterValue('edit.fields.'.$column->getName().'.upload_dir')) ?>
    $currentFile = sfConfig::get('sf_upload_dir')."/<?php echo $upload_dir ?>/".$this-><?php echo $this->getSingularName() ?>->get<?php echo $column->getPhpName() ?>();
    if (!$this->getRequest()->hasErrors() && isset($<?php echo $this->getSingularName() ?>['<?php echo $name ?>_remove']))
    {
      <?php echo $this->DbFinderAdminGenerator->getColumnSetter($column, '', true) ?>;
      if (is_file($currentFile))
      {
        unlink($currentFile);
      }
    }

    if (!$this->getRequest()->hasErrors() && $this->getRequest()->getFileSize('<?php echo $this->getSingularName() ?>[<?php echo $name ?>]'))
    {
<?php elseif ($type != sfModelFinderColumn::BOOLEAN): ?>
    if (isset($<?php echo $this->getSingularName() ?>['<?php echo $name ?>']))
    {
<?php endif; ?>
<?php if ($input_type == 'admin_input_file_tag'): ?>
<?php if ($this->getParameterValue('edit.fields.'.$column->getName().'.filename')): ?>
      $fileName = "<?php echo str_replace('"', '\\"', $this->replaceConstants($this->getParameterValue('edit.fields.'.$column->getName().'.filename'))) ?>";
<?php else: ?>
      $fileName = md5($this->getRequest()->getFileName('<?php echo $this->getSingularName() ?>[<?php echo $name ?>]').time().rand(0, 99999));
<?php endif ?>
      $ext = $this->getRequest()->getFileExtension('<?php echo $this->getSingularName() ?>[<?php echo $name ?>]');
      if (is_file($currentFile))
      {
        unlink($currentFile);
      }
      $this->getRequest()->moveFile('<?php echo $this->getSingularName() ?>[<?php echo $name ?>]', sfConfig::get('sf_upload_dir')."/<?php echo $upload_dir ?>/".$fileName.$ext);
      <?php echo $this->DbFinderAdminGenerator->getColumnSetter($column, '$fileName.$ext') ?>;
<?php elseif ($type == sfModelFinderColumn::DATE || $type == sfModelFinderColumn::TIMESTAMP): ?>
      if ($<?php echo $this->getSingularName() ?>['<?php echo $name ?>'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
          <?php $inputPattern  = $type == sfModelFinderColumn::DATE ? 'd' : 'g'; ?>
          <?php $outputPattern = $type == sfModelFinderColumn::DATE ? 'i' : 'I'; ?>
          if (!is_array($<?php echo $this->getSingularName() ?>['<?php echo $name ?>']))
          {
            $value = $dateFormat->format($<?php echo $this->getSingularName() ?>['<?php echo $name ?>'], '<?php echo $outputPattern ?>', $dateFormat->getInputPattern('<?php echo $inputPattern ?>'));
          }
          else
          {
            $value_array = $<?php echo $this->getSingularName() ?>['<?php echo $name ?>'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          <?php echo $this->DbFinderAdminGenerator->getColumnSetter($column, '$value') ?>;
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        <?php echo $this->DbFinderAdminGenerator->getColumnSetter($column, 'null') ?>;
      }
<?php elseif ($type == sfModelFinderColumn::BOOLEAN): ?>
    <?php $boolVar = "\${$this->getSingularName()}['$name']";
      echo $this->DbFinderAdminGenerator->getColumnSetter($column, "isset($boolVar) ? $boolVar : 0") ?>;
<?php elseif ($column->isForeignKey()): ?>
  <?php $fkVar = "\${$this->getSingularName()}['$name']";
    echo $this->DbFinderAdminGenerator->getColumnSetter($column, "$fkVar ? $fkVar : null") ?>;
<?php else: ?>
    <?php echo $this->DbFinderAdminGenerator->getColumnSetter($column, "\${$this->getSingularName()}['$name']") ?>;
<?php endif; ?>
<?php if ($type != sfModelFinderColumn::BOOLEAN): ?>
    }
<?php endif; ?>
<?php if ($credentials): ?>
      }
<?php endif; ?>
<?php endforeach; ?>
<?php endforeach; ?>
  }

  protected function get<?php echo $this->getClassName() ?>OrCreate(<?php echo $this->getMethodParamsForGetOrCreate() ?>)
  {
    if (<?php echo $this->getTestPksForGetOrCreate() ?>)
    {
      $<?php echo $this->getSingularName() ?> = new <?php echo $this->getClassName() ?>();
    }
    else
    {
      $finder = DbFinder::from('<?php echo $this->getClassName() ?>');
<?php if ($this->getParameterValue('edit.with')): ?>
<?php foreach ($this->getParameterValue('edit.with') as $withClass): ?>
<?php if (strtolower($withClass) != 'i18n'): ?>
      $finder->leftJoin('<?php echo $withClass ?>');
<?php endif; ?>
      $finder->with('<?php echo $withClass ?>');
<?php endforeach; ?>
<?php endif; ?>
<?php if ($this->getParameterValue('edit.finder_methods')): ?>
<?php foreach ($this->getParameterValue('edit.finder_methods') as $method): ?>
      $finder-><?php echo $method ?>();
<?php endforeach; ?>
<?php endif; ?>
      $<?php echo $this->getSingularName() ?> = $finder->findPk(<?php echo $this->getRetrieveByPkParamsForGetOrCreate() ?>);
      
      $this->forward404Unless($<?php echo $this->getSingularName() ?>);
    }

    return $<?php echo $this->getSingularName() ?>;
  }

  protected function processFilters()
  {
<?php if ($this->getParameterValue('list.filters')): ?>
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');
<?php foreach ($this->getColumns('list.filters') as $column): $type = $this->DbFinderAdminGenerator->getColumnType($column); ?>
<?php if ($type == sfModelFinderColumn::DATE || $type == sfModelFinderColumn::TIMESTAMP): ?>
      if (isset($filters['<?php echo $column->getName() ?>']['from']) && $filters['<?php echo $column->getName() ?>']['from'] !== '')
      {
        $filters['<?php echo $column->getName() ?>']['from'] = sfI18N::getTimestampForCulture($filters['<?php echo $column->getName() ?>']['from'], $this->getUser()->getCulture());
      }
      if (isset($filters['<?php echo $column->getName() ?>']['to']) && $filters['<?php echo $column->getName() ?>']['to'] !== '')
      {
        $filters['<?php echo $column->getName() ?>']['to'] = sfI18N::getTimestampForCulture($filters['<?php echo $column->getName() ?>']['to'], $this->getUser()->getCulture());
      }
<?php endif; ?>
<?php endforeach; ?>

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/<?php echo $this->getSingularName() ?>/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/<?php echo $this->getSingularName() ?>/filters');
    }
<?php endif; ?>
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/<?php echo $this->getSingularName() ?>/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/<?php echo $this->getSingularName() ?>/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/<?php echo $this->getSingularName() ?>/sort'))
    {
<?php if ($sort = $this->getParameterValue('list.sort')): ?>
<?php if (is_array($sort)): ?>
      $this->getUser()->setAttribute('sort', '<?php echo $sort[0] ?>', 'sf_admin/<?php echo $this->getSingularName() ?>/sort');
      $this->getUser()->setAttribute('type', '<?php echo $sort[1] ?>', 'sf_admin/<?php echo $this->getSingularName() ?>/sort');
<?php else: ?>
      $this->getUser()->setAttribute('sort', '<?php echo $sort ?>', 'sf_admin/<?php echo $this->getSingularName() ?>/sort');
      $this->getUser()->setAttribute('type', 'asc', 'sf_admin/<?php echo $this->getSingularName() ?>/sort');
<?php endif; ?>
<?php endif; ?>
    }
  }

  protected function addFilters($finder)
  {
<?php if ($this->getParameterValue('list.filters')): ?>
<?php foreach ($this->getColumns('list.filters') as $column): $type = $this->DbFinderAdminGenerator->getColumnType($column); ?>
<?php $name = sfInflector::camelize($column->getName()) ?>
<?php if (($column->isPartial() || $column->isComponent()) && $this->getParameterValue('list.fields.'.$column->getName().'.filter_criteria_disabled')) continue ?>
    if (isset($this->filters['<?php echo $column->getName() ?>_is_empty']))
    {
      $finder->where('<?php echo $name ?>', '=', '');
      $finder->_or('<?php echo $name ?>', 'is null', null);
    }
<?php if ($type == sfModelFinderColumn::DATE || $type == sfModelFinderColumn::TIMESTAMP): ?>
    else if (isset($this->filters['<?php echo $column->getName() ?>']))
    {
      if (isset($this->filters['<?php echo $column->getName() ?>']['from']) && $this->filters['<?php echo $column->getName() ?>']['from'] !== '')
      {
<?php if ($type == sfModelFinderColumn::DATE): ?>
        $finder->where('<?php echo $name ?>', '>=', date('Y-m-d', $this->filters['<?php echo $column->getName() ?>']['from']));
<?php else: ?>
        $finder->where('<?php echo $name ?>', '>=', $this->filters['<?php echo $column->getName() ?>']['from']);
<?php endif; ?>
      }
      if (isset($this->filters['<?php echo $column->getName() ?>']['to']) && $this->filters['<?php echo $column->getName() ?>']['to'] !== '')
      {
<?php if ($type == sfModelFinderColumn::DATE): ?>
        $finder->where('<?php echo $name ?>', '<=', date('Y-m-d', $this->filters['<?php echo $column->getName() ?>']['to']));
<?php else: ?>
        $finder->where('<?php echo $name ?>', '<=', $this->filters['<?php echo $column->getName() ?>']['to']);
<?php endif; ?>
      }

    }
<?php else: ?>
    else if (isset($this->filters['<?php echo $column->getName() ?>']) && $this->filters['<?php echo $column->getName() ?>'] !== '')
    {
<?php if ($type == sfModelFinderColumn::STRING): ?>
      $finder->where('<?php echo $name ?>', 'like', '%'.trim($this->filters['<?php echo $column->getName() ?>'], '*%').'%');
<?php elseif ($type == sfModelFinderColumn::BOOLEAN): ?>
      $finder->where('<?php echo $name ?>', (boolean) $this->filters['<?php echo $column->getName() ?>']);
<?php else: ?>
      $finder->where('<?php echo $name ?>', $this->filters['<?php echo $column->getName() ?>']);
<?php endif; ?>
    }
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
  }

  protected function addSort($finder)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/<?php echo $this->getSingularName() ?>/sort'))
    {
      $sort_order = $this->getUser()->getAttribute('type', null, 'sf_admin/<?php echo $this->getSingularName() ?>/sort');
      switch($sort_column)
      {
<?php foreach ($this->getColumns('list.display') as $column): ?>
<?php if ($sort_method = $this->getParameterValue('list.fields.'.$column->getName().'.sort_method')): ?>
        case '<?php echo $column->getName() ?>':
          $finder-><?php echo $sort_method ?>($sort_order);
          break;
<?php endif; ?>
<?php endforeach; ?>
        default:
          $sort_column = sfInflector::camelize($sort_column);
          $finder->orderBy($sort_column, $sort_order);
      }
    }
  }

  protected function getLabels()
  {
    return array(
<?php foreach ($this->getColumnCategories('edit.display') as $category): ?>
<?php foreach ($this->getColumns('edit.display', $category) as $name => $column): ?>
      '<?php echo $this->getSingularName() ?>{<?php echo $column->getName() ?>}' => '<?php $label_name = str_replace("'", "\\'", $this->getParameterValue('edit.fields.'.$column->getName().'.name')); echo $label_name ?><?php if ($label_name): ?>:<?php endif ?>',
<?php endforeach; ?>
<?php endforeach; ?>
    );
  }
  
  // For 1.1 compatibility (why doesn't sfCompat10Plugin take care of that ?)
  protected function setFlashCompatible($name, $value)
  {
    if(method_exists($this, 'setFlash'))
    {
      parent::setFlash($name, $value);
    }
    else
    {
      $this->getUser()->setFlash($name, $value);
    }
  }
}
