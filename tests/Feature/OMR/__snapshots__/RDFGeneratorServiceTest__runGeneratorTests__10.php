<?php return '@prefix dc: <http://purl.org/dc/elements/1.1/> .
@prefix rdakit: <http://metadataregistry.org/uri/profile/rdakit/> .
@prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> .
@prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> .
@prefix reg: <http://metadataregistry.org/uri/profile/regap/> .
@prefix skos: <http://www.w3.org/2004/02/skos/core#> .
@prefix xml: <http://www.w3.org/XML/1998/namespace> .
@prefix xsd: <http://www.w3.org/2001/XMLSchema#> .

<http://rdaregistry.info/termList/RDAMediaType/1001> a skos:Concept ;
    rdakit:toolkitDefinition "A media type used to store recorded sound, designed for use with a playback device such as a turntable, audiocassette player, CD player, or MP3 player."@en ;
    rdakit:toolkitLabel "audio"@en,
        "audio"@fr ;
    reg:identifier <http://metadataregistry.org/concepts/475> ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    skos:definition "A media type used to store recorded sound, designed for use with a playback device such as a turntable, audiocassette player, CD player, or MP3 player."@en,
        "Média servant à emmagasiner du son enregistré et conçu pour une utilisation au moyen d’un dispositif de lecture tel qu’une platine, un lecteur de cassette audio, un lecteur de CD ou un lecteur MP3."@fr ;
    skos:inScheme <http://rdaregistry.info/termList/RDAMediaType> ;
    skos:prefLabel "audio"@en,
        "audio"@fr ;
    skos:scopeNote "Media used to store digitally encoded as well as analog sound are included."@en,
        "Comprend tout média servant à emmagasiner du son encodé numériquement aussi bien que du son analogique."@fr .

<http://rdaregistry.info/termList/RDAMediaType/1002> a skos:Concept ;
    rdakit:toolkitDefinition "A media type used to store reduced-size images not readable to the human eye, designed for use with a device such as a microfilm or microfiche reader."@en ;
    rdakit:toolkitLabel "microform"@en,
        "microforme"@fr ;
    reg:identifier <http://metadataregistry.org/concepts/476> ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    skos:definition "A media type used to store reduced-size images not readable to the human eye, designed for use with a device such as a microfilm or microfiche reader."@en,
        "Média servant à emmagasiner des images de taille réduite non lisibles à l’œil nu, et conçu pour une utilisation au moyen d’un dispositif tel que : lecteur de microfilm ou de microfiche."@fr ;
    skos:inScheme <http://rdaregistry.info/termList/RDAMediaType> ;
    skos:prefLabel "microform"@en,
        "microforme"@fr ;
    skos:scopeNote "Both transparent and opaque micrographic media are included."@en,
        "Comprend les deux médias microphotographiques, transparent et opaque."@fr .

<http://rdaregistry.info/termList/RDAMediaType/1003> a skos:Concept ;
    rdakit:toolkitDefinition "A media type used to store electronic files, designed for use with a computer."@en ;
    rdakit:toolkitLabel "computer"@en,
        "informatique"@fr ;
    reg:identifier <http://metadataregistry.org/concepts/477> ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    skos:definition "A media type used to store electronic files, designed for use with a computer."@en,
        "Média servant à emmagasiner des fichiers électroniques et conçu pour une utilisation au moyen d’un ordinateur."@fr ;
    skos:inScheme <http://rdaregistry.info/termList/RDAMediaType> ;
    skos:prefLabel "computer"@en,
        "informatique"@fr ;
    skos:scopeNote "Media that are accessed remotely through file servers as well as direct-access media such as computer tapes and discs are included."@en,
        "Comprend tout média accessible à distance par serveur aussi bien que tout média en accès direct tel que des bandes et des disques informatiques."@fr .

<http://rdaregistry.info/termList/RDAMediaType/1004> a skos:Concept ;
    rdakit:toolkitDefinition "A media type used to store minute objects, designed for use with a device such as a microscope to reveal details invisible to the naked eye."@en ;
    rdakit:toolkitLabel "microscopic"@en,
        "microscopique"@fr ;
    reg:identifier <http://metadataregistry.org/concepts/478> ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    skos:definition "A media type used to store minute objects, designed for use with a device such as a microscope to reveal details invisible to the naked eye."@en,
        "Média servant à emmagasiner des objets minuscules et conçu pour une utilisation au moyen d’un dispositif tel qu’un microscope, pour faire apparaître des détails invisibles à l’œil nu."@fr ;
    skos:inScheme <http://rdaregistry.info/termList/RDAMediaType> ;
    skos:prefLabel "microscopic"@en,
        "microscopique"@fr .

<http://rdaregistry.info/termList/RDAMediaType/1005> a skos:Concept ;
    rdakit:toolkitDefinition "A media type used to store moving or still images, designed for use with a projection device such as a motion picture film projector, slide projector, or overhead projector."@en ;
    rdakit:toolkitLabel "projected"@en,
        "projeté"@fr ;
    reg:identifier <http://metadataregistry.org/concepts/479> ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    skos:definition "A media type used to store moving or still images, designed for use with a projection device such as a motion picture film projector, slide projector, or overhead projector."@en,
        "Média servant à emmagasiner des images, animées ou fixes, et conçu pour une utilisation au moyen d’un dispositif de projection tel que : projecteur de film cinématographique, projecteur de diapositives ou rétroprojecteur."@fr ;
    skos:inScheme <http://rdaregistry.info/termList/RDAMediaType> ;
    skos:prefLabel "projected"@en,
        "projeté"@fr ;
    skos:scopeNote "Media designed to project both two-dimensional and three-dimensional images are included."@en,
        "Comprend tout média conçu pour projeter des images bidimensionnelles et tridimensionnelles."@fr .

<http://rdaregistry.info/termList/RDAMediaType/1006> a skos:Concept ;
    rdakit:toolkitDefinition "A media type used to store pairs of still images, designed for use with a device such as a stereoscope or stereograph viewer to give the effect of three dimensions."@en ;
    rdakit:toolkitLabel "stereographic"@en,
        "stéréoscopique"@fr ;
    reg:identifier <http://metadataregistry.org/concepts/480> ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    skos:definition "A media type used to store pairs of still images, designed for use with a device such as a stereoscope or stereograph viewer to give the effect of three dimensions."@en,
        "Média servant à emmagasiner des paires d’images fixes et conçu pour une utilisation au moyen d’un dispositif tel qu’un stéréoscope ou une visionneuse stéréoscopique pour donner l’impression des trois dimensions."@fr ;
    skos:inScheme <http://rdaregistry.info/termList/RDAMediaType> ;
    skos:prefLabel "stereographic"@en,
        "stéréoscopique"@fr .

<http://rdaregistry.info/termList/RDAMediaType/1007> a skos:Concept ;
    rdakit:toolkitDefinition "A media type used to store content designed to be perceived directly through one or more of the human senses without the aid of an intermediating device."@en ;
    rdakit:toolkitLabel "unmediated"@en,
        "sans médiation"@fr ;
    reg:identifier <http://metadataregistry.org/concepts/481> ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    skos:definition "A media type used to store content designed to be perceived directly through one or more of the human senses without the aid of an intermediating device."@en,
        "Média servant à emmagasiner un contenu conçu pour être perçu directement par un ou plusieurs sens humains sans l’aide d’un dispositif de médiation."@fr ;
    skos:inScheme <http://rdaregistry.info/termList/RDAMediaType> ;
    skos:prefLabel "unmediated"@en,
        "sans médiation"@fr ;
    skos:scopeNote "Also includes media used to convey three-dimensional forms such as sculptures, models, etc."@en,
        "Media containing visual and/or tactile content produced using processes such as printing, engraving, lithography, etc., embossing, texturing, etc., or by means of handwriting, drawing, painting, etc., are included. Media used to convey three-dimensional forms such as sculptures, models, etc., are also included."@en,
        "Comprend tout média à contenu visuel et/ou tactile produit selon des procédés tels que : impression, gravure, lithographie, etc. ; embossage, texturation, etc. ; ou bien encore au moyen de l’écriture à la main, du dessin, de la peinture, etc. Comprend également tout média servant à communiquer des formes tridimensionnelles telles que : sculptures, maquettes, etc."@fr .

<http://rdaregistry.info/termList/RDAMediaType/1008> a skos:Concept ;
    rdakit:toolkitDefinition "A media type used to store moving or still images, designed for use with a playback device such as a videocassette player or DVD player."@en ;
    rdakit:toolkitLabel "video"@en,
        "vidéo"@fr ;
    reg:identifier <http://metadataregistry.org/concepts/482> ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    skos:definition "A media type used to store moving or still images, designed for use with a playback device such as a videocassette player or DVD player."@en,
        "Média servant à emmagasiner des images animées ou fixes et conçu pour une utilisation au moyen d’un dispositif de lecture tel qu’un lecteur de cassette vidéo ou de DVD."@fr ;
    skos:inScheme <http://rdaregistry.info/termList/RDAMediaType> ;
    skos:prefLabel "video"@en,
        "vidéo"@fr ;
    skos:scopeNote "Media used to store digitally encoded as well as analog images are included."@en,
        "Comprend tout média servant à emmagasiner des images encodées numériquement aussi bien que des images analogiques."@fr .

<http://metadataregistry.org/uri/RegStatus/1001> a skos:Concept ;
    skos:prefLabel "Published"@en .

<http://rdaregistry.info/termList/RDAMediaType> a skos:ConceptScheme ;
    dc:title "RDA Media Type" .

';
