<?php echo '<?xml version="1.0" encoding = "UTF-8"?>' ?>
<xs:schema
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    xmlns="<?php echo $vocabulary->getUri(); ?>"
    targetNamespace="<?php echo $vocabulary->getUri(); ?>"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    elementFormDefault="qualified"
    attributeFormDefault="unqualified"
    version="1.00.000">

    <xs:annotation>
        <xs:documentation xml:lang="en">
            <?php echo htmlspecialchars($vocabulary->getName(), ENT_NOQUOTES, 'UTF-8'); ?> XML Schema
            XML Schema for <?php echo $vocabulary->getUri(); ?> namespace
            Date created: <?php echo $vocabulary->getCreatedAt() . "\n" ?>
            Date of last update: <?php echo $vocabulary->getLastUpdated() . "\n" ?>
<?php if ($vocabulary->getNote()): ?>
            <?php echo htmlspecialchars($vocabulary->getNote(), ENT_NOQUOTES, 'UTF-8') . "\n" ?>
<?php endif; ?>
            Further information about this schema is available at <?php echo $vocabulary->getUri() . ".html\n" ?>
        </xs:documentation>
    </xs:annotation>

    <xs:simpleType name="DCMIType">
        <xs:restriction base="xs:string">
            <?php foreach ($concepts as $concept): ?><xs:enumeration value="<?php echo htmlspecialchars($concept->getPrefLabel(), ENT_NOQUOTES, 'UTF-8'); ?>"/><?php endforeach; ?>
        </xs:restriction>
    </xs:simpleType>

</xs:schema>
