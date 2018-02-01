<?php if ('create' == $mode): ?><?php $value = object_select_tag($schema_property_element,
    'getProfilePropertyId',
    [
        'related_class' => 'ProfileProperty',
        'control_name'  => 'schema_property_element[profile_property_id]',
        'peer_method'   => 'getProfilePropertiesForCreate',
        'include_blank' => false,
        'onchange'      => 'swapOptions()',
        'text_method'   => 'getUri',
    ]);
    echo $value ? $value : '&nbsp;' ?><?php endif; ?><?php if ('edit' == $mode): ?><?php echo object_input_hidden_tag($schema_property_element,
    'getProfilePropertyId',
    ['control_name' => 'schema_property_element[profile_property_id]',]) ?><?php $value = $schema_property_element->getProfileProperty();
    echo $value ? $value : '&nbsp;' ?><?php endif; ?>
