<?php return '@prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> .
@prefix dc: <http://purl.org/dc/elements/1.1/> .
@prefix foaf: <http://xmlns.com/foaf/0.1/> .
@prefix rdakit: <http://metadataregistry.org/uri/profile/rdakit/> .
@prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> .
@prefix reg: <http://metadataregistry.org/uri/profile/regap/> .
@prefix skos: <http://www.w3.org/2004/02/skos/core#> .

<http://metadataregistry.org/uri/RegStatus/1001>
    a skos:Concept ;
    skos:prefLabel "Published"@en .

<http://rdaregistry.info/Elements/c/>
    dc:title "RDA Classes"@en ;
    skos:note "Classes derived from RDA entities based on FRBR and FRAD entities."@en ;
    foaf:homepage <http://www.rdaregistry.info/Elements/c/> .

<http://rdaregistry.info/Elements/c/C10001>
    rdakit:instructionNumber "5.1.2" ;
    rdakit:toolkitDefinition "A distinct intellectual or artistic creation, that is, the intellectual or artistic content."@en, "Création intellectuelle ou artistique déterminée, c’est-à-dire le contenu intellectuel ou artistique."@fr ;
    rdakit:toolkitLabel "work"@en, "Œuvre"@fr ;
    reg:lexicalAlias <http://rdaregistry.info/Elements/c/Work.en> ;
    reg:name "Work"@en ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    a <http://www.w3.org/2002/07/owl#Class> ;
    rdfs:isDefinedBy <http://rdaregistry.info/Elements/c/> ;
    rdfs:label "work"@en, "Œuvre"@fr ;
    rdfs:subClassOf <http://rdaregistry.info/Elements/c/C10013> ;
    skos:definition "A distinct intellectual or artistic creation, that is, the intellectual or artistic content."@en, "Création intellectuelle ou artistique déterminée, c’est-à-dire le contenu intellectuel ou artistique."@fr .

<http://rdaregistry.info/Elements/c/C10002>
    rdakit:toolkitDefinition "A person, family, or corporate body."@en, "Personne, famille ou collectivité."@fr ;
    rdakit:toolkitLabel "Agent"@fr, "agent"@en ;
    reg:hasSubClass <http://rdaregistry.info/Elements/c/C10004>, <http://rdaregistry.info/Elements/c/C10005>, <http://rdaregistry.info/Elements/c/C10008>, <http://rdaregistry.info/Elements/c/C10011> ;
    reg:lexicalAlias <http://rdaregistry.info/Elements/c/Agent.en> ;
    reg:name "Agent"@en ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    a <http://www.w3.org/2002/07/owl#Class> ;
    rdfs:isDefinedBy <http://rdaregistry.info/Elements/c/> ;
    rdfs:label "Agent"@fr, "agent"@en ;
    rdfs:subClassOf <http://rdaregistry.info/Elements/c/C10013> ;
    skos:definition "A person, family, or corporate body."@en, "Personne, famille ou collectivité."@fr .

<http://rdaregistry.info/Elements/c/C10003>
    rdakit:instructionNumber "1.1.5" ;
    rdakit:toolkitDefinition "A single exemplar or instance of a manifestation."@en, "Exemplaire isolé ou occurrence d’une manifestation."@fr ;
    rdakit:toolkitLabel "Item"@fr, "item"@en ;
    reg:lexicalAlias <http://rdaregistry.info/Elements/c/Item.en> ;
    reg:name "Item"@en ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    a <http://www.w3.org/2002/07/owl#Class> ;
    rdfs:isDefinedBy <http://rdaregistry.info/Elements/c/> ;
    rdfs:label "Item"@fr, "item"@en ;
    rdfs:subClassOf <http://rdaregistry.info/Elements/c/C10013> ;
    skos:definition "A single exemplar or instance of a manifestation."@en, "Exemplaire isolé ou occurrence d’une manifestation."@fr .

<http://rdaregistry.info/Elements/c/C10004>
    rdakit:instructionNumber "8.1.2" ;
    rdakit:toolkitDefinition "An individual or an identity established by an individual, either alone or in collaboration with one or more other individuals."@en, "Individu ou identité établie par un individu, seul ou en collaboration avec un ou plusieurs autres individus."@fr ;
    rdakit:toolkitLabel "Personne"@fr, "person"@en ;
    reg:lexicalAlias <http://rdaregistry.info/Elements/c/Person.en> ;
    reg:name "Person"@en ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    a <http://www.w3.org/2002/07/owl#Class> ;
    rdfs:isDefinedBy <http://rdaregistry.info/Elements/c/> ;
    rdfs:label "Personne"@fr, "person"@en ;
    rdfs:subClassOf <http://rdaregistry.info/Elements/c/C10002> ;
    skos:definition "An individual or an identity established by an individual, either alone or in collaboration with one or more other individuals."@en, "Individu ou identité établie par un individu, seul ou en collaboration avec un ou plusieurs autres individus."@fr .

<http://rdaregistry.info/Elements/c/C10005>
    rdakit:instructionNumber "8.1.2" ;
    rdakit:toolkitDefinition "An organization or group of persons and/or organizations that is identified by a particular name and that acts, or may act, as a unit."@en, "Organisation, ou groupe de personnes et/ou d’organisations, qui est identifiée par un nom particulier et qui agit ou peut agir comme une unité."@fr ;
    rdakit:toolkitLabel "Collectivité"@fr, "corporate body"@en ;
    reg:lexicalAlias <http://rdaregistry.info/Elements/c/CorporateBody.en> ;
    reg:name "CorporateBody"@en ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    a <http://www.w3.org/2002/07/owl#Class> ;
    rdfs:isDefinedBy <http://rdaregistry.info/Elements/c/> ;
    rdfs:label "Collectivité"@fr, "corporate body"@en ;
    rdfs:subClassOf <http://rdaregistry.info/Elements/c/C10011> ;
    skos:definition "An organization or group of persons and/or organizations that is identified by a particular name and that acts, or may act, as a unit."@en, "Organisation, ou groupe de personnes et/ou d’organisations, qui est identifiée par un nom particulier et qui agit ou peut agir comme une unité."@fr .

<http://rdaregistry.info/Elements/c/C10006>
    rdakit:instructionNumber "5.1.2" ;
    rdakit:toolkitDefinition "An intellectual or artistic realization of a work in the form of alpha-numeric, musical or choreographic notation, sound, image, object, movement, etc., or any combination of such forms."@en, "La réalisation intellectuelle ou artistique d’une œuvre sous la forme d’une notation alphanumérique, musicale ou chorégraphique, de son, d’image, d’objet, de mouvement, etc. ou de toute combinaison de ces formes."@fr ;
    rdakit:toolkitLabel "Expression"@fr, "expression"@en ;
    reg:lexicalAlias <http://rdaregistry.info/Elements/c/Expression.en> ;
    reg:name "Expression"@en ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    a <http://www.w3.org/2002/07/owl#Class> ;
    rdfs:isDefinedBy <http://rdaregistry.info/Elements/c/> ;
    rdfs:label "Expression"@fr, "expression"@en ;
    rdfs:subClassOf <http://rdaregistry.info/Elements/c/C10013> ;
    skos:definition "An intellectual or artistic realization of a work in the form of alpha-numeric, musical or choreographic notation, sound, image, object, movement, etc., or any combination of such forms."@en, "La réalisation intellectuelle ou artistique d’une œuvre sous la forme d’une notation alphanumérique, musicale ou chorégraphique, de son, d’image, d’objet, de mouvement, etc. ou de toute combinaison de ces formes."@fr .

<http://rdaregistry.info/Elements/c/C10007>
    rdakit:instructionNumber "1.1.5" ;
    rdakit:toolkitDefinition "A physical embodiment of an expression of a work."@en, "La matérialisation d’une expression d’une œuvre."@fr ;
    rdakit:toolkitLabel "Manifestation"@fr, "manifestation"@en ;
    reg:lexicalAlias <http://rdaregistry.info/Elements/c/Manifestation.en> ;
    reg:name "Manifestation"@en ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    a <http://www.w3.org/2002/07/owl#Class> ;
    rdfs:isDefinedBy <http://rdaregistry.info/Elements/c/> ;
    rdfs:label "Manifestation"@fr, "manifestation"@en ;
    rdfs:subClassOf <http://rdaregistry.info/Elements/c/C10013> ;
    skos:definition "A physical embodiment of an expression of a work."@en, "La matérialisation d’une expression d’une œuvre."@fr .

<http://rdaregistry.info/Elements/c/C10008>
    rdakit:instructionNumber "8.1.2" ;
    rdakit:toolkitDefinition "Deux ou plusieurs personnes liées par la naissance, le mariage, l’adoption, l’union civile ou tout autre statut légal de même ordre ou bien des personnes qui, pour toute autre raison, se présentent elles-mêmes comme une famille."@fr, "Two or more persons related by birth, marriage, adoption, civil union, or similar legal status, or who otherwise present themselves as a family."@en ;
    rdakit:toolkitLabel "Famille"@fr, "family"@en ;
    reg:lexicalAlias <http://rdaregistry.info/Elements/c/Family.en> ;
    reg:name "Family"@en ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    a <http://www.w3.org/2002/07/owl#Class> ;
    rdfs:isDefinedBy <http://rdaregistry.info/Elements/c/> ;
    rdfs:label "Famille"@fr, "family"@en ;
    rdfs:subClassOf <http://rdaregistry.info/Elements/c/C10011> ;
    skos:definition "Deux ou plusieurs personnes liées par la naissance, le mariage, l’adoption, l’union civile ou tout autre statut légal de même ordre ou bien des personnes qui, pour toute autre raison, se présentent elles-mêmes comme une famille."@fr, "Two or more persons related by birth, marriage, adoption, civil union, or similar legal status, or who otherwise present themselves as a family."@en .

<http://rdaregistry.info/Elements/c/C10009>
    rdakit:toolkitDefinition "A given extent of space."@en ;
    rdakit:toolkitLabel "place"@en ;
    reg:lexicalAlias <http://rdaregistry.info/Elements/c/Place.en> ;
    reg:name "Place"@en ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    a <http://www.w3.org/2002/07/owl#Class> ;
    rdfs:isDefinedBy <http://rdaregistry.info/Elements/c/> ;
    rdfs:label "place"@en ;
    rdfs:subClassOf <http://rdaregistry.info/Elements/c/C10013> ;
    skos:definition "A given extent of space."@en .

<http://rdaregistry.info/Elements/c/C10010>
    rdakit:toolkitDefinition "A temporal extent having a beginning, an end and a duration."@en ;
    rdakit:toolkitLabel "time-span"@en ;
    reg:lexicalAlias <http://rdaregistry.info/Elements/c/Timespan.en> ;
    reg:name "Timespan"@en ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    a <http://www.w3.org/2002/07/owl#Class> ;
    rdfs:isDefinedBy <http://rdaregistry.info/Elements/c/> ;
    rdfs:label "time-span"@en ;
    rdfs:subClassOf <http://rdaregistry.info/Elements/c/C10013> ;
    skos:definition "A temporal extent having a beginning, an end and a duration."@en .

<http://rdaregistry.info/Elements/c/C10011>
    rdakit:toolkitDefinition "A gathering or organization of persons bearing a particular name and capable of acting as a unit."@en ;
    rdakit:toolkitLabel "collective agent"@en ;
    reg:lexicalAlias <http://rdaregistry.info/Elements/c/CollectiveAgent.en> ;
    reg:name "CollectiveAgent"@en ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    a <http://www.w3.org/2002/07/owl#Class> ;
    rdfs:isDefinedBy <http://rdaregistry.info/Elements/c/> ;
    rdfs:label "collective agent"@en ;
    rdfs:subClassOf <http://rdaregistry.info/Elements/c/C10002>, <http://rdaregistry.info/Elements/c/C10013> ;
    skos:definition "A gathering or organization of persons bearing a particular name and capable of acting as a unit."@en ;
    skos:scopeNote "A collective agent includes a corporate body and a family."@en .

<http://rdaregistry.info/Elements/c/C10012>
    rdakit:toolkitDefinition "A designation that refers to an RDA entity."@en ;
    rdakit:toolkitLabel "nomen"@en ;
    reg:lexicalAlias <http://rdaregistry.info/Elements/c/Nomen.en> ;
    reg:name "Nomen"@en ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    a <http://www.w3.org/2002/07/owl#Class> ;
    rdfs:isDefinedBy <http://rdaregistry.info/Elements/c/> ;
    rdfs:label "nomen"@en ;
    rdfs:subClassOf <http://rdaregistry.info/Elements/c/C10013> ;
    skos:definition "A designation that refers to an RDA entity."@en ;
    skos:scopeNote "A designation includes a name, title, access point, identifier, and subject classification codes and headings."@en .

<http://rdaregistry.info/Elements/c/C10013>
    rdakit:toolkitDefinition "An abstract class of key conceptual objects in the universe of human discourse that is a focus of interest to users of RDA metadata in library information systems."@en ;
    rdakit:toolkitLabel "RDA entity"@en ;
    reg:hasSubClass <http://rdaregistry.info/Elements/c/C10003>, <http://rdaregistry.info/Elements/c/C10006>, <http://rdaregistry.info/Elements/c/C10007>, <http://rdaregistry.info/Elements/c/C10009>, <http://rdaregistry.info/Elements/c/C10010>, <http://rdaregistry.info/Elements/c/C10012> ;
    reg:lexicalAlias <http://rdaregistry.info/Elements/c/RDAEntity.en> ;
    reg:name "RDAEntity"@en ;
    reg:status <http://metadataregistry.org/uri/RegStatus/1001> ;
    a <http://www.w3.org/2002/07/owl#Class> ;
    rdfs:isDefinedBy <http://rdaregistry.info/Elements/c/> ;
    rdfs:label "RDA entity"@en ;
    skos:definition "An abstract class of key conceptual objects in the universe of human discourse that is a focus of interest to users of RDA metadata in library information systems."@en ;
    skos:scopeNote "An RDA entity includes an agent, collective agent, corporate body, expression, family, item, manifestation, nomen, person, place, time-span, and work."@en .

';
