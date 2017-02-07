<?php
// auto-generated by sfPropelAdmin
// date: 2015/01/27 16:41:38
?>
<ul class="sf_admin_actions">

  <li><?php echo submit_tag(
        __s( 'Get CSV' ),
        array (
            'name'  => 'getCSV',
            'title' => 'Get CSV',
            'style' => 'background: #ffc url(/jpAdminPlugin/images/csv_text.png) no-repeat 2px 3px; padding-left:20px !important',
        )
    ) ?></li>
    <li><?php echo button_to(__s('Get RDF'), '@rdf_vocabulary?id='.$vocabulary->getId(), array (
            'title' => 'rdf',
            'style' => 'background: #ffc url(/jpAdminPlugin/images/rdf_icon.png) no-repeat 2px 3px; padding-left:20px !important',
        )) ?></li>
    <li><?php echo button_to(__s('Get XML Schema'), '@xml_schema_vocabulary?id='.$vocabulary->getId(), array (
            'title' => 'xml',
            'style' => 'background: #ffc url(/jpAdminPlugin/images/xmlschema_icon.png) no-repeat 3px; padding-left:25px !important',
        )) ?></li>
</ul>
