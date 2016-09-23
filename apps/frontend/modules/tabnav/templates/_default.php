<?php
//get the current module/action
/** @var sfParameterHolder $sf_params */
$module = $sf_params->get('module');
$action = $sf_params->get('action');
$route  = sfRouting::getInstance()->getCurrentInternalUri(true);
$breadcrumbPrefix = '';
$metaAction = '';
$title = '';

//which tab are we showing?
if (isset( $tabs )) {
    foreach ($tabs as $tab) {
        if ($route == $tab['link'] ) {
            $metaAction = ucfirst(__($action)) . ' the ' . __($tab['title']);
            $breadcrumbPrefix = $metaAction . " of ";
        }
    }
} else {
    $metaAction = ucfirst(__($action));
}

$metaAction = " :: " . $metaAction;

if (isset( $breadcrumbs) && count( $breadcrumbs )): ?>
    <h1>
        <?php
        $spaces = '';
        $html   = '';
        $filterParam = '';
        $options = [];

        //Show the breadcrumbs
        for ($i = 0; $i <= count($breadcrumbs)-1; $i++) {
            /** @var \apps\frontend\lib\Breadcrumb $breadcrumb */
            $breadcrumb = $breadcrumbs[$i];
            if ($breadcrumb->getEntityTypeUrl()) {
                $url = $breadcrumb->getEntityTypeUrl();
                $html .= $spaces;
                $namespace = $breadcrumb->getNamespace();
                if ($namespace) {
                    $filters = $sf_user->getAttributeHolder()->getAll('sf_admin/' . $namespace . '/filters');
                    if (count($filters)) {
                        foreach ($filters as $index => $item) {
                            if ($item) {
                                if (isset( $breadcrumb->getFilters()[$index] )) {
                                    $url = $breadcrumb->getFilters()[$index] . $item;
                                } else {
                                    $filterParam .= "$index=$item";
                                }
                            }
                        }
                    }
                }
                if ( !empty($filterParam)) {
                    $options = [ 'query_string' => $filterParam ];
                }
                $html .= link_to(__($breadcrumb->getEntityTypeLabel()) . ':&nbsp;', $url, $options);
                $html = empty( $breadcrumb->getEntityUrl() )
                    ? $html . $breadcrumbPrefix . '"' . __($breadcrumb->getEntityLabel() . '"')
                    : $html . link_to('"' . __($breadcrumb->getEntityLabel() . '"'), $breadcrumb->getEntityUrl());
                $title = __($breadcrumb->getEntityLabel());
            } else { //There's just a top level list
                $title = __($breadcrumb->getEntityTypeLabel());
                $html .= $title;
            }
            $html .= "<br>\n";
            $spaces .= "&nbsp;&nbsp;";
        }
        echo $html;
        ?>
    </h1>
<?php endif;

//set the meta title
/** @var sfContext $sf_context */
if ($title) {
    $sf_context->getResponse()->setTitle(sfConfig::get('app_title_prefix') . $title . $metaAction);
}

?>
<?php if (isset($tabs)): ?>
<div id="tab_container">
    <ul class="ui-tabs-nav">
        <?php
        //Show the tabs
        foreach ($tabs as $key => $tab):
            $options  = [ 'id' => 'a' . $key ];
            $selected = ( isset( $tab[$action . '_module'] ) && $module == $tab[$action . '_module'] ) ? ' class = "ui-tabs-selected"' : '';
            echo '<li' . $selected . '>' . link_to('<span>' . __($tab['title']) . '</span>',
                                                   $tab['link'],
                                                   $options) . '
                    </li>';
        endforeach;
        ?>
    </ul>
</div>
<?php  endif; ?>
