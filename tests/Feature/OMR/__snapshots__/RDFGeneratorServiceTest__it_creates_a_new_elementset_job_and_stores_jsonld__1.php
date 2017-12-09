<?php return '{
    "@context": "http://rdaregistry.info/Contexts/elements_langmap.jsonld",
    "@graph": [
        {
            "@id": "http://rdaregistry.info/Elements/c/",
            "@type": "ElementSet",
            "title": {
                "en": "RDA Classes"
            },
            "description": {
                "en": "Classes derived from RDA entities based on FRBR and FRAD entities."
            },
            "prefix": "",
            "token": "rdac",
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "label": "Published"
            },
            "omr_api": "http://api.metadataregistry.org/elementsets/83",
            "omr_home": "http://metadataregistry.org/elementsets/83",
            "documentation": "http://www.rdaregistry.info/Elements/c/",
            "count": 13,
            "languages": [
                {
                    "code": "ar",
                    "lang": "Arabic",
                    "version": "WIP"
                },
                {
                    "code": "ca",
                    "lang": "Catalan",
                    "version": "WIP"
                },
                {
                    "code": "zh",
                    "lang": "Chinese",
                    "version": "WIP"
                },
                {
                    "code": "da",
                    "lang": "Danish",
                    "version": "WIP"
                },
                {
                    "code": "nl",
                    "lang": "Dutch",
                    "version": "WIP"
                },
                {
                    "code": "en",
                    "lang": "English",
                    "version": "v2.7.3"
                },
                {
                    "code": "fi",
                    "lang": "Finnish",
                    "version": "WIP"
                },
                {
                    "code": "fr",
                    "lang": "French",
                    "version": "v2.7.3"
                },
                {
                    "code": "de",
                    "lang": "German",
                    "version": "WIP"
                },
                {
                    "code": "el",
                    "lang": "Greek",
                    "version": "WIP"
                },
                {
                    "code": "he",
                    "lang": "Hebrew",
                    "version": "WIP"
                },
                {
                    "code": "it",
                    "lang": "Italian",
                    "version": "WIP"
                },
                {
                    "code": "no",
                    "lang": "Norwegian",
                    "version": "WIP"
                },
                {
                    "code": "pl",
                    "lang": "Polish",
                    "version": "WIP"
                },
                {
                    "code": "pt",
                    "lang": "Portuguese",
                    "version": "WIP"
                },
                {
                    "code": "sk",
                    "lang": "Slovak",
                    "version": "WIP"
                },
                {
                    "code": "es",
                    "lang": "Spanish",
                    "version": "WIP"
                },
                {
                    "code": "sv",
                    "lang": "Swedish",
                    "version": "WIP"
                },
                {
                    "code": "uk",
                    "lang": "Ukrainian",
                    "version": "WIP"
                },
                {
                    "code": "vi",
                    "lang": "Vietnamese",
                    "version": "WIP"
                }
            ],
            "dateOfPublication": "October 17, 2017"
        },
        {
            "@id": "http://rdaregistry.info/Elements/c/C10001",
            "@type": "Class",
            "description": {
                "en": [
                    "A distinct intellectual or artistic creation, that is, the intellectual or artistic content."
                ],
                "fr": [
                    "Création intellectuelle ou artistique déterminée, c’est-à-dire le contenu intellectuel ou artistique."
                ]
            },
            "instructionNumber": "5.1.2",
            "isDefinedBy": {
                "@id": "http://rdaregistry.info/Elements/c/",
                "url": "http://metadataregistry.org/schema/show/id/83.html",
                "label": "RDA Classes"
            },
            "label": {
                "en": "work",
                "fr": "Œuvre"
            },
            "lexicalAlias": "http://rdaregistry.info/Elements/c/Work.en",
            "name": {
                "en": "Work"
            },
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
                "url": "http://metadataregistry.org/concept/show/id/412.html",
                "label": "Published"
            },
            "subClassOf": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10013",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/RDAEntity.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25154.html",
                    "label": "RDA entity"
                }
            ],
            "ToolkitDefinition": {
                "en": "A distinct intellectual or artistic creation, that is, the intellectual or artistic content.",
                "fr": "Création intellectuelle ou artistique déterminée, c’est-à-dire le contenu intellectuel ou artistique."
            },
            "ToolkitLabel": {
                "en": "work",
                "fr": "Œuvre"
            },
            "url": "http://metadataregistry.org/schemaprop/show/id/14328.html"
        },
        {
            "@id": "http://rdaregistry.info/Elements/c/C10002",
            "@type": "Class",
            "description": {
                "en": [
                    "A person, family, or corporate body."
                ],
                "fr": [
                    "Personne, famille ou collectivité."
                ]
            },
            "hasSubClass": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10004",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/Person.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/14331.html",
                    "label": "person"
                },
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10005",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/CorporateBody.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/14332.html",
                    "label": "corporate body"
                },
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10008",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/Family.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/14335.html",
                    "label": "family"
                },
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10011",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/CollectiveAgent.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25152.html",
                    "label": "collective agent"
                }
            ],
            "isDefinedBy": {
                "@id": "http://rdaregistry.info/Elements/c/",
                "url": "http://metadataregistry.org/schema/show/id/83.html",
                "label": "RDA Classes"
            },
            "label": {
                "en": "agent",
                "fr": "Agent"
            },
            "lexicalAlias": "http://rdaregistry.info/Elements/c/Agent.en",
            "name": {
                "en": "Agent"
            },
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
                "url": "http://metadataregistry.org/concept/show/id/412.html",
                "label": "Published"
            },
            "subClassOf": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10013",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/RDAEntity.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25154.html",
                    "label": "RDA entity"
                }
            ],
            "ToolkitDefinition": {
                "en": "A person, family, or corporate body.",
                "fr": "Personne, famille ou collectivité."
            },
            "ToolkitLabel": {
                "en": "agent",
                "fr": "Agent"
            },
            "url": "http://metadataregistry.org/schemaprop/show/id/14329.html"
        },
        {
            "@id": "http://rdaregistry.info/Elements/c/C10003",
            "@type": "Class",
            "description": {
                "en": [
                    "A single exemplar or instance of a manifestation."
                ],
                "fr": [
                    "Exemplaire isolé ou occurrence d’une manifestation."
                ]
            },
            "instructionNumber": "1.1.5",
            "isDefinedBy": {
                "@id": "http://rdaregistry.info/Elements/c/",
                "url": "http://metadataregistry.org/schema/show/id/83.html",
                "label": "RDA Classes"
            },
            "label": {
                "en": "item",
                "fr": "Item"
            },
            "lexicalAlias": "http://rdaregistry.info/Elements/c/Item.en",
            "name": {
                "en": "Item"
            },
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
                "url": "http://metadataregistry.org/concept/show/id/412.html",
                "label": "Published"
            },
            "subClassOf": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10013",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/RDAEntity.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25154.html",
                    "label": "RDA entity"
                }
            ],
            "ToolkitDefinition": {
                "en": "A single exemplar or instance of a manifestation.",
                "fr": "Exemplaire isolé ou occurrence d’une manifestation."
            },
            "ToolkitLabel": {
                "en": "item",
                "fr": "Item"
            },
            "url": "http://metadataregistry.org/schemaprop/show/id/14330.html"
        },
        {
            "@id": "http://rdaregistry.info/Elements/c/C10004",
            "@type": "Class",
            "description": {
                "en": [
                    "An individual or an identity established by an individual, either alone or in collaboration with one or more other individuals."
                ],
                "fr": [
                    "Individu ou identité établie par un individu, seul ou en collaboration avec un ou plusieurs autres individus."
                ]
            },
            "instructionNumber": "8.1.2",
            "isDefinedBy": {
                "@id": "http://rdaregistry.info/Elements/c/",
                "url": "http://metadataregistry.org/schema/show/id/83.html",
                "label": "RDA Classes"
            },
            "label": {
                "en": "person",
                "fr": "Personne"
            },
            "lexicalAlias": "http://rdaregistry.info/Elements/c/Person.en",
            "name": {
                "en": "Person"
            },
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
                "url": "http://metadataregistry.org/concept/show/id/412.html",
                "label": "Published"
            },
            "subClassOf": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10002",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/Agent.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/14329.html",
                    "label": "agent"
                }
            ],
            "ToolkitDefinition": {
                "en": "An individual or an identity established by an individual, either alone or in collaboration with one or more other individuals.",
                "fr": "Individu ou identité établie par un individu, seul ou en collaboration avec un ou plusieurs autres individus."
            },
            "ToolkitLabel": {
                "en": "person",
                "fr": "Personne"
            },
            "url": "http://metadataregistry.org/schemaprop/show/id/14331.html"
        },
        {
            "@id": "http://rdaregistry.info/Elements/c/C10005",
            "@type": "Class",
            "description": {
                "en": [
                    "An organization or group of persons and/or organizations that is identified by a particular name and that acts, or may act, as a unit."
                ],
                "fr": [
                    "Organisation, ou groupe de personnes et/ou d’organisations, qui est identifiée par un nom particulier et qui agit ou peut agir comme une unité."
                ]
            },
            "instructionNumber": "8.1.2",
            "isDefinedBy": {
                "@id": "http://rdaregistry.info/Elements/c/",
                "url": "http://metadataregistry.org/schema/show/id/83.html",
                "label": "RDA Classes"
            },
            "label": {
                "en": "corporate body",
                "fr": "Collectivité"
            },
            "lexicalAlias": "http://rdaregistry.info/Elements/c/CorporateBody.en",
            "name": {
                "en": "CorporateBody"
            },
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
                "url": "http://metadataregistry.org/concept/show/id/412.html",
                "label": "Published"
            },
            "subClassOf": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10011",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/CollectiveAgent.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25152.html",
                    "label": "collective agent"
                }
            ],
            "ToolkitDefinition": {
                "en": "An organization or group of persons and/or organizations that is identified by a particular name and that acts, or may act, as a unit.",
                "fr": "Organisation, ou groupe de personnes et/ou d’organisations, qui est identifiée par un nom particulier et qui agit ou peut agir comme une unité."
            },
            "ToolkitLabel": {
                "en": "corporate body",
                "fr": "Collectivité"
            },
            "url": "http://metadataregistry.org/schemaprop/show/id/14332.html"
        },
        {
            "@id": "http://rdaregistry.info/Elements/c/C10006",
            "@type": "Class",
            "description": {
                "en": [
                    "An intellectual or artistic realization of a work in the form of alpha-numeric, musical or choreographic notation, sound, image, object, movement, etc., or any combination of such forms."
                ],
                "fr": [
                    "La réalisation intellectuelle ou artistique d’une œuvre sous la forme d’une notation alphanumérique, musicale ou chorégraphique, de son, d’image, d’objet, de mouvement, etc. ou de toute combinaison de ces formes."
                ]
            },
            "instructionNumber": "5.1.2",
            "isDefinedBy": {
                "@id": "http://rdaregistry.info/Elements/c/",
                "url": "http://metadataregistry.org/schema/show/id/83.html",
                "label": "RDA Classes"
            },
            "label": {
                "en": "expression",
                "fr": "Expression"
            },
            "lexicalAlias": "http://rdaregistry.info/Elements/c/Expression.en",
            "name": {
                "en": "Expression"
            },
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
                "url": "http://metadataregistry.org/concept/show/id/412.html",
                "label": "Published"
            },
            "subClassOf": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10013",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/RDAEntity.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25154.html",
                    "label": "RDA entity"
                }
            ],
            "ToolkitDefinition": {
                "en": "An intellectual or artistic realization of a work in the form of alpha-numeric, musical or choreographic notation, sound, image, object, movement, etc., or any combination of such forms.",
                "fr": "La réalisation intellectuelle ou artistique d’une œuvre sous la forme d’une notation alphanumérique, musicale ou chorégraphique, de son, d’image, d’objet, de mouvement, etc. ou de toute combinaison de ces formes."
            },
            "ToolkitLabel": {
                "en": "expression",
                "fr": "Expression"
            },
            "url": "http://metadataregistry.org/schemaprop/show/id/14333.html"
        },
        {
            "@id": "http://rdaregistry.info/Elements/c/C10007",
            "@type": "Class",
            "description": {
                "en": [
                    "A physical embodiment of an expression of a work."
                ],
                "fr": [
                    "La matérialisation d’une expression d’une œuvre."
                ]
            },
            "instructionNumber": "1.1.5",
            "isDefinedBy": {
                "@id": "http://rdaregistry.info/Elements/c/",
                "url": "http://metadataregistry.org/schema/show/id/83.html",
                "label": "RDA Classes"
            },
            "label": {
                "en": "manifestation",
                "fr": "Manifestation"
            },
            "lexicalAlias": "http://rdaregistry.info/Elements/c/Manifestation.en",
            "name": {
                "en": "Manifestation"
            },
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
                "url": "http://metadataregistry.org/concept/show/id/412.html",
                "label": "Published"
            },
            "subClassOf": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10013",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/RDAEntity.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25154.html",
                    "label": "RDA entity"
                }
            ],
            "ToolkitDefinition": {
                "en": "A physical embodiment of an expression of a work.",
                "fr": "La matérialisation d’une expression d’une œuvre."
            },
            "ToolkitLabel": {
                "en": "manifestation",
                "fr": "Manifestation"
            },
            "url": "http://metadataregistry.org/schemaprop/show/id/14334.html"
        },
        {
            "@id": "http://rdaregistry.info/Elements/c/C10008",
            "@type": "Class",
            "description": {
                "en": [
                    "Two or more persons related by birth, marriage, adoption, civil union, or similar legal status, or who otherwise present themselves as a family."
                ],
                "fr": [
                    "Deux ou plusieurs personnes liées par la naissance, le mariage, l’adoption, l’union civile ou tout autre statut légal de même ordre ou bien des personnes qui, pour toute autre raison, se présentent elles-mêmes comme une famille."
                ]
            },
            "instructionNumber": "8.1.2",
            "isDefinedBy": {
                "@id": "http://rdaregistry.info/Elements/c/",
                "url": "http://metadataregistry.org/schema/show/id/83.html",
                "label": "RDA Classes"
            },
            "label": {
                "en": "family",
                "fr": "Famille"
            },
            "lexicalAlias": "http://rdaregistry.info/Elements/c/Family.en",
            "name": {
                "en": "Family"
            },
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
                "url": "http://metadataregistry.org/concept/show/id/412.html",
                "label": "Published"
            },
            "subClassOf": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10011",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/CollectiveAgent.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25152.html",
                    "label": "collective agent"
                }
            ],
            "ToolkitDefinition": {
                "en": "Two or more persons related by birth, marriage, adoption, civil union, or similar legal status, or who otherwise present themselves as a family.",
                "fr": "Deux ou plusieurs personnes liées par la naissance, le mariage, l’adoption, l’union civile ou tout autre statut légal de même ordre ou bien des personnes qui, pour toute autre raison, se présentent elles-mêmes comme une famille."
            },
            "ToolkitLabel": {
                "en": "family",
                "fr": "Famille"
            },
            "url": "http://metadataregistry.org/schemaprop/show/id/14335.html"
        },
        {
            "@id": "http://rdaregistry.info/Elements/c/C10009",
            "@type": "Class",
            "description": {
                "en": [
                    "A given extent of space."
                ]
            },
            "isDefinedBy": {
                "@id": "http://rdaregistry.info/Elements/c/",
                "url": "http://metadataregistry.org/schema/show/id/83.html",
                "label": "RDA Classes"
            },
            "label": {
                "en": "place"
            },
            "lexicalAlias": "http://rdaregistry.info/Elements/c/Place.en",
            "name": {
                "en": "Place"
            },
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
                "url": "http://metadataregistry.org/concept/show/id/412.html",
                "label": "Published"
            },
            "subClassOf": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10013",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/RDAEntity.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25154.html",
                    "label": "RDA entity"
                }
            ],
            "ToolkitDefinition": {
                "en": "A given extent of space."
            },
            "ToolkitLabel": {
                "en": "place"
            },
            "url": "http://metadataregistry.org/schemaprop/show/id/22989.html"
        },
        {
            "@id": "http://rdaregistry.info/Elements/c/C10010",
            "@type": "Class",
            "description": {
                "en": [
                    "A temporal extent having a beginning, an end and a duration."
                ]
            },
            "isDefinedBy": {
                "@id": "http://rdaregistry.info/Elements/c/",
                "url": "http://metadataregistry.org/schema/show/id/83.html",
                "label": "RDA Classes"
            },
            "label": {
                "en": "time-span"
            },
            "lexicalAlias": "http://rdaregistry.info/Elements/c/Timespan.en",
            "name": {
                "en": "Timespan"
            },
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
                "url": "http://metadataregistry.org/concept/show/id/412.html",
                "label": "Published"
            },
            "subClassOf": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10013",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/RDAEntity.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25154.html",
                    "label": "RDA entity"
                }
            ],
            "ToolkitDefinition": {
                "en": "A temporal extent having a beginning, an end and a duration."
            },
            "ToolkitLabel": {
                "en": "time-span"
            },
            "url": "http://metadataregistry.org/schemaprop/show/id/25151.html"
        },
        {
            "@id": "http://rdaregistry.info/Elements/c/C10011",
            "@type": "Class",
            "description": {
                "en": [
                    "A gathering or organization of persons bearing a particular name and capable of acting as a unit."
                ]
            },
            "isDefinedBy": {
                "@id": "http://rdaregistry.info/Elements/c/",
                "url": "http://metadataregistry.org/schema/show/id/83.html",
                "label": "RDA Classes"
            },
            "label": {
                "en": "collective agent"
            },
            "lexicalAlias": "http://rdaregistry.info/Elements/c/CollectiveAgent.en",
            "name": {
                "en": "CollectiveAgent"
            },
            "note": {
                "en": [
                    "A collective agent includes a corporate body and a family."
                ]
            },
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
                "url": "http://metadataregistry.org/concept/show/id/412.html",
                "label": "Published"
            },
            "subClassOf": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10002",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/Agent.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/14329.html",
                    "label": "agent"
                },
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10013",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/RDAEntity.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25154.html",
                    "label": "RDA entity"
                }
            ],
            "ToolkitDefinition": {
                "en": "A gathering or organization of persons bearing a particular name and capable of acting as a unit."
            },
            "ToolkitLabel": {
                "en": "collective agent"
            },
            "url": "http://metadataregistry.org/schemaprop/show/id/25152.html"
        },
        {
            "@id": "http://rdaregistry.info/Elements/c/C10012",
            "@type": "Class",
            "description": {
                "en": [
                    "A designation that refers to an RDA entity."
                ]
            },
            "isDefinedBy": {
                "@id": "http://rdaregistry.info/Elements/c/",
                "url": "http://metadataregistry.org/schema/show/id/83.html",
                "label": "RDA Classes"
            },
            "label": {
                "en": "nomen"
            },
            "lexicalAlias": "http://rdaregistry.info/Elements/c/Nomen.en",
            "name": {
                "en": "Nomen"
            },
            "note": {
                "en": [
                    "A designation includes a name, title, access point, identifier, and subject classification codes and headings."
                ]
            },
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
                "url": "http://metadataregistry.org/concept/show/id/412.html",
                "label": "Published"
            },
            "subClassOf": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10013",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/RDAEntity.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25154.html",
                    "label": "RDA entity"
                }
            ],
            "ToolkitDefinition": {
                "en": "A designation that refers to an RDA entity."
            },
            "ToolkitLabel": {
                "en": "nomen"
            },
            "url": "http://metadataregistry.org/schemaprop/show/id/25153.html"
        },
        {
            "@id": "http://rdaregistry.info/Elements/c/C10013",
            "@type": "Class",
            "description": {
                "en": [
                    "An abstract class of key conceptual objects in the universe of human discourse that is a focus of interest to users of RDA metadata in library information systems."
                ]
            },
            "hasSubClass": [
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10003",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/Item.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/14330.html",
                    "label": "item"
                },
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10006",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/Expression.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/14333.html",
                    "label": "expression"
                },
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10007",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/Manifestation.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/14334.html",
                    "label": "manifestation"
                },
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10009",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/Place.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/22989.html",
                    "label": "place"
                },
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10010",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/Timespan.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25151.html",
                    "label": "time-span"
                },
                {
                    "@id": "http://rdaregistry.info/Elements/c/C10012",
                    "lexicalAlias": "http://rdaregistry.info/Elements/c/Nomen.en",
                    "url": "http://metadataregistry.org/schemaprop/show/id/25153.html",
                    "label": "nomen"
                }
            ],
            "isDefinedBy": {
                "@id": "http://rdaregistry.info/Elements/c/",
                "url": "http://metadataregistry.org/schema/show/id/83.html",
                "label": "RDA Classes"
            },
            "label": {
                "en": "RDA entity"
            },
            "lexicalAlias": "http://rdaregistry.info/Elements/c/RDAEntity.en",
            "name": {
                "en": "RDAEntity"
            },
            "note": {
                "en": [
                    "An RDA entity includes an agent, collective agent, corporate body, expression, family, item, manifestation, nomen, person, place, time-span, and work."
                ]
            },
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "lexicalAlias": "http://metadataregistry.org/uri/RegStatus/Published.en",
                "url": "http://metadataregistry.org/concept/show/id/412.html",
                "label": "Published"
            },
            "ToolkitDefinition": {
                "en": "An abstract class of key conceptual objects in the universe of human discourse that is a focus of interest to users of RDA metadata in library information systems."
            },
            "ToolkitLabel": {
                "en": "RDA entity"
            },
            "url": "http://metadataregistry.org/schemaprop/show/id/25154.html"
        }
    ]
}';
