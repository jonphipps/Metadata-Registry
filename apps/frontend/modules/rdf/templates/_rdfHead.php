<?php echo '<?xml version="1.0" encoding = "UTF-8"?>' ?>

<rdf:RDF<?php foreach ($namespaces as $key => $namespace) {
    echo "\n".'    xmlns:'.$key.'="'.$namespace.'"';
}?>>
