<?php return '{
    "@context": "http://rdaregistry.info/termList/Contexts/concepts_langmap.jsonld",
    "@graph": [
        {
            "@id": "http://rdaregistry.info/termList/RDAMediaType",
            "@type": "ConceptScheme",
            "title": {
                "en": "RDA Media Type"
            },
            "description": {
                "en": "A categorization reflecting the general type of intermediation device required to view, play, run, etc., the content of a resource."
            },
            "prefix": "rdamt",
            "token": "RDAMediaType",
            "status": {
                "@id": "http://metadataregistry.org/uri/RegStatus/1001",
                "label": "Published"
            },
            "omr_api": "http://api.metadataregistry.org/vocabularies/37",
            "omr_home": "http://metadataregistry.org/vocabularies/37",
            "documentation": "http://www.rdaregistry.info/termList/RDAMediaType/",
            "count": 8,
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
                    "code": "hu",
                    "lang": "Hungarian",
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
            "@id": "http://rdaregistry.info/termList/RDAMediaType/1001",
            "@type": "Concept",
            "api": "http://api.metadataregistry.org/concepts/475",
            "definition": {
                "en": "A media type used to store recorded sound, designed for use with a playback device such as a turntable, audiocassette player, CD player, or MP3 player.",
                "fr": "Média servant à emmagasiner du son enregistré et conçu pour une utilisation au moyen d’un dispositif de lecture tel qu’une platine, un lecteur de cassette audio, un lecteur de CD ou un lecteur MP3."
            },
            "inScheme": "http://rdaregistry.info/termList/RDAMediaType",
            "prefLabel": {
                "en": "audio",
                "fr": "audio"
            },
            "scopeNote": {
                "en": "Media used to store digitally encoded as well as analog sound are included.",
                "fr": "Comprend tout média servant à emmagasiner du son encodé numériquement aussi bien que du son analogique."
            },
            "status": "Published",
            "ToolkitDefinition": {
                "en": "A media type used to store recorded sound, designed for use with a playback device such as a turntable, audiocassette player, CD player, or MP3 player."
            },
            "ToolkitLabel": {
                "en": "audio",
                "fr": "audio"
            }
        },
        {
            "@id": "http://rdaregistry.info/termList/RDAMediaType/1002",
            "@type": "Concept",
            "api": "http://api.metadataregistry.org/concepts/476",
            "definition": {
                "en": "A media type used to store reduced-size images not readable to the human eye, designed for use with a device such as a microfilm or microfiche reader.",
                "fr": "Média servant à emmagasiner des images de taille réduite non lisibles à l’œil nu, et conçu pour une utilisation au moyen d’un dispositif tel que : lecteur de microfilm ou de microfiche."
            },
            "inScheme": "http://rdaregistry.info/termList/RDAMediaType",
            "prefLabel": {
                "en": "microform",
                "fr": "microforme"
            },
            "scopeNote": {
                "en": "Both transparent and opaque micrographic media are included.",
                "fr": "Comprend les deux médias microphotographiques, transparent et opaque."
            },
            "status": "Published",
            "ToolkitDefinition": {
                "en": "A media type used to store reduced-size images not readable to the human eye, designed for use with a device such as a microfilm or microfiche reader."
            },
            "ToolkitLabel": {
                "en": "microform",
                "fr": "microforme"
            }
        },
        {
            "@id": "http://rdaregistry.info/termList/RDAMediaType/1003",
            "@type": "Concept",
            "api": "http://api.metadataregistry.org/concepts/477",
            "definition": {
                "en": "A media type used to store electronic files, designed for use with a computer.",
                "fr": "Média servant à emmagasiner des fichiers électroniques et conçu pour une utilisation au moyen d’un ordinateur."
            },
            "inScheme": "http://rdaregistry.info/termList/RDAMediaType",
            "prefLabel": {
                "en": "computer",
                "fr": "informatique"
            },
            "scopeNote": {
                "en": "Media that are accessed remotely through file servers as well as direct-access media such as computer tapes and discs are included.",
                "fr": "Comprend tout média accessible à distance par serveur aussi bien que tout média en accès direct tel que des bandes et des disques informatiques."
            },
            "status": "Published",
            "ToolkitDefinition": {
                "en": "A media type used to store electronic files, designed for use with a computer."
            },
            "ToolkitLabel": {
                "en": "computer",
                "fr": "informatique"
            }
        },
        {
            "@id": "http://rdaregistry.info/termList/RDAMediaType/1004",
            "@type": "Concept",
            "api": "http://api.metadataregistry.org/concepts/478",
            "definition": {
                "en": "A media type used to store minute objects, designed for use with a device such as a microscope to reveal details invisible to the naked eye.",
                "fr": "Média servant à emmagasiner des objets minuscules et conçu pour une utilisation au moyen d’un dispositif tel qu’un microscope, pour faire apparaître des détails invisibles à l’œil nu."
            },
            "inScheme": "http://rdaregistry.info/termList/RDAMediaType",
            "prefLabel": {
                "en": "microscopic",
                "fr": "microscopique"
            },
            "status": "Published",
            "ToolkitDefinition": {
                "en": "A media type used to store minute objects, designed for use with a device such as a microscope to reveal details invisible to the naked eye."
            },
            "ToolkitLabel": {
                "en": "microscopic",
                "fr": "microscopique"
            }
        },
        {
            "@id": "http://rdaregistry.info/termList/RDAMediaType/1005",
            "@type": "Concept",
            "api": "http://api.metadataregistry.org/concepts/479",
            "definition": {
                "en": "A media type used to store moving or still images, designed for use with a projection device such as a motion picture film projector, slide projector, or overhead projector.",
                "fr": "Média servant à emmagasiner des images, animées ou fixes, et conçu pour une utilisation au moyen d’un dispositif de projection tel que : projecteur de film cinématographique, projecteur de diapositives ou rétroprojecteur."
            },
            "inScheme": "http://rdaregistry.info/termList/RDAMediaType",
            "prefLabel": {
                "en": "projected",
                "fr": "projeté"
            },
            "scopeNote": {
                "en": "Media designed to project both two-dimensional and three-dimensional images are included.",
                "fr": "Comprend tout média conçu pour projeter des images bidimensionnelles et tridimensionnelles."
            },
            "status": "Published",
            "ToolkitDefinition": {
                "en": "A media type used to store moving or still images, designed for use with a projection device such as a motion picture film projector, slide projector, or overhead projector."
            },
            "ToolkitLabel": {
                "en": "projected",
                "fr": "projeté"
            }
        },
        {
            "@id": "http://rdaregistry.info/termList/RDAMediaType/1006",
            "@type": "Concept",
            "api": "http://api.metadataregistry.org/concepts/480",
            "definition": {
                "en": "A media type used to store pairs of still images, designed for use with a device such as a stereoscope or stereograph viewer to give the effect of three dimensions.",
                "fr": "Média servant à emmagasiner des paires d’images fixes et conçu pour une utilisation au moyen d’un dispositif tel qu’un stéréoscope ou une visionneuse stéréoscopique pour donner l’impression des trois dimensions."
            },
            "inScheme": "http://rdaregistry.info/termList/RDAMediaType",
            "prefLabel": {
                "en": "stereographic",
                "fr": "stéréoscopique"
            },
            "status": "Published",
            "ToolkitDefinition": {
                "en": "A media type used to store pairs of still images, designed for use with a device such as a stereoscope or stereograph viewer to give the effect of three dimensions."
            },
            "ToolkitLabel": {
                "en": "stereographic",
                "fr": "stéréoscopique"
            }
        },
        {
            "@id": "http://rdaregistry.info/termList/RDAMediaType/1007",
            "@type": "Concept",
            "api": "http://api.metadataregistry.org/concepts/481",
            "definition": {
                "en": "A media type used to store content designed to be perceived directly through one or more of the human senses without the aid of an intermediating device.",
                "fr": "Média servant à emmagasiner un contenu conçu pour être perçu directement par un ou plusieurs sens humains sans l’aide d’un dispositif de médiation."
            },
            "inScheme": "http://rdaregistry.info/termList/RDAMediaType",
            "prefLabel": {
                "en": "unmediated",
                "fr": "sans médiation"
            },
            "scopeNote": {
                "en": [
                    "Media containing visual and/or tactile content produced using processes such as printing, engraving, lithography, etc., embossing, texturing, etc., or by means of handwriting, drawing, painting, etc., are included. Media used to convey three-dimensional forms such as sculptures, models, etc., are also included.",
                    "Also includes media used to convey three-dimensional forms such as sculptures, models, etc."
                ],
                "fr": "Comprend tout média à contenu visuel et/ou tactile produit selon des procédés tels que : impression, gravure, lithographie, etc. ; embossage, texturation, etc. ; ou bien encore au moyen de l’écriture à la main, du dessin, de la peinture, etc. Comprend également tout média servant à communiquer des formes tridimensionnelles telles que : sculptures, maquettes, etc."
            },
            "status": "Published",
            "ToolkitDefinition": {
                "en": "A media type used to store content designed to be perceived directly through one or more of the human senses without the aid of an intermediating device."
            },
            "ToolkitLabel": {
                "en": "unmediated",
                "fr": "sans médiation"
            }
        },
        {
            "@id": "http://rdaregistry.info/termList/RDAMediaType/1008",
            "@type": "Concept",
            "api": "http://api.metadataregistry.org/concepts/482",
            "definition": {
                "en": "A media type used to store moving or still images, designed for use with a playback device such as a videocassette player or DVD player.",
                "fr": "Média servant à emmagasiner des images animées ou fixes et conçu pour une utilisation au moyen d’un dispositif de lecture tel qu’un lecteur de cassette vidéo ou de DVD."
            },
            "inScheme": "http://rdaregistry.info/termList/RDAMediaType",
            "prefLabel": {
                "en": "video",
                "fr": "vidéo"
            },
            "scopeNote": {
                "en": "Media used to store digitally encoded as well as analog images are included.",
                "fr": "Comprend tout média servant à emmagasiner des images encodées numériquement aussi bien que des images analogiques."
            },
            "status": "Published",
            "ToolkitDefinition": {
                "en": "A media type used to store moving or still images, designed for use with a playback device such as a videocassette player or DVD player."
            },
            "ToolkitLabel": {
                "en": "video",
                "fr": "vidéo"
            }
        }
    ]
}';
