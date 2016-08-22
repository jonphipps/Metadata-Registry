<div id="tab_container">
    <ul class="ui-tabs-nav">
        [?php
        //get the current module/action
        /** @var sfParameterHolder $sf_params */
        $module = $sf_params->get('module');
        $action = $sf_params->get('action');
        $selected = sfRouting::getInstance()->getCurrentInternalUri(true);
        //add the truncate helper if it's a list
        if ('list' == $action) {
            use_helper('TruncateUri');
        }
        //Show the tabs
            foreach ($tabs as $key => $tab):
                $options = ['id' => 'a' . $key];
                $selected == $tab['link'] ? ' class = "ui-tabs-selected"' : '';
                echo '<li' . $selected .'>' . link_to('<span>' . __($tab['title']) . '</span>',
                    $tab['link'],
                    $options) . '
                    </li>';
            endforeach;

        ?]
    </ul>
</div>
