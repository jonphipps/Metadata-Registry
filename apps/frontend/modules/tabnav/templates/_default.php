<?php
if (isset( $breadcrumbs )): ?>
    <h1>
        <?php
        $spaces = '';
        $html   = '';
        //Show the breadcrumbs
        for ($i = 0; $i <= 3; $i++) {
            /** @var \apps\frontend\lib\Breadcrumb $breadcrumb */
            $breadcrumb = $breadcrumbs[$i];
            $html .= $spaces;
            $html .= link_to(__($breadcrumb->getEntityTypeLabel()) . ':&nbsp;', $breadcrumb->getEntityTypeUrl());
            $html = empty( $breadcrumb->getEntityUrl() )
                ? $html . __($breadcrumb->getEntityLabel())
                : $html . link_to('"' . __($breadcrumb->getEntityLabel() . '"'), $breadcrumb->getEntityUrl());
            $html .= "<br>\n";
            $spaces .= "&nbsp;&nbsp;";
        }
        echo $html;
        ?>
    </h1>
<?php endif; ?>
<?php if (isset($tabs)): ?>
<div id="tab_container">
    <ul class="ui-tabs-nav">
        <?php
        //get the current module/action
        /** @var sfParameterHolder $sf_params */
        $module   = $sf_params->get('module');
        $action   = $sf_params->get('action');
        $route = sfRouting::getInstance()->getCurrentInternalUri(true);
        //add the truncate helper if it's a list
        if ('list' == $action) {
          use_helper('TruncateUri');
        }
        //Show the tabs
        foreach ($tabs as $key => $tab):
          $options = [ 'id' => 'a' . $key ];
          $selected = ($route == $tab['link']) ? ' class = "ui-tabs-selected"' : '';
          echo '<li' . $selected . '>' . link_to('<span>' . __($tab['title']) . '</span>',
                                                 $tab['link'],
                                                 $options) . '
                    </li>';
        endforeach;
        ?>
    </ul>
</div>
<?php  endif; ?>
