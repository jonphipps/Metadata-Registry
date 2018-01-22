<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Writedown Parser
    |--------------------------------------------------------------------------
    |
    | Writedown supports a variety of popular markdown parsers as drivers for
    | the parsing of markdown syntax inside your views or / and files. You
    | may specify which driver you wish to use throughout your app here.
    |
    | Supported: "parsedown", "parsedownextra", "markdown",
    |            "markdownextra", "commonmark", "null"
    |
    | Default: null
    |
    */

    'default' => env('WRITEDOWN_PARSER', 'parsedown'),

    /*
    |--------------------------------------------------------------------------
    | Enable Markdown Extensions
    |--------------------------------------------------------------------------
    |
    | This option specifies if you want Writedown to extend the blade template
    | engine with a markdown specific "curly" braces '{%' & '%}', also with
    | a markdown specific directives such as '@writedown('expression')',
    | @writedown expression @endwritedown and an alias '@markdown()'.
    |
    | Default: true
    |
    */

    'extend' => true,

    /*
    |--------------------------------------------------------------------------
    | Enable View Extensions
    |--------------------------------------------------------------------------
    |
    | This option specifies if you want Writedown to integrate markdown views
    | that will be automatically parsed and rendered as html. The following
    | view extensions will become available and renderable, if set to true:
    | ".md", ".md.php", ".md.blade.php", and ".blade-md.php"
    |
    | Default: true
    |
    */

    'views' => true,

    /*
    |--------------------------------------------------------------------------
    | Parsers Configuration
    |--------------------------------------------------------------------------
    |
    | Here are each of the parsers driver name and configuration available to
    | use for your application. You may configure and extend your chosen
    | parser here. Those are the parser's current default configuration.
    |
    */

    'parsers' => [

        'parsedown' => [
            'driver' => 'parsedown',
            'config' => [
                'breaks_enabled' => true,
                'markup_escaped' => true,
                'urls_linked' => true,
            ],
        ],

        'parsedownextra' => [
            'driver' => 'parsedownextra',
            'config' => [
                'breaks_enabled' => null,
                'markup_escaped' => null,
                'urls_linked' => null,
            ],
        ],

        'markdown' => [
            'driver' => 'markdown',
            'config' => [
                'empty_element_suffix' => ' />',
                'tab_width' => 4,
                'no_markup  ' => false,
                'no_entities' => false,
                'hard_wrap' => false,
                'predef_urls  ' => [],
                'predef_titles' => [],
                'url_filter_func' => null,
                'header_id_func' => null,
                'code_block_content_func' => null,
                'code_span_content_func' => null,
                'enhanced_ordered_list' => false,
            ],
        ],

        'markdownextra' => [
            'driver' => 'markdownextra',
            'config' => [
                'empty_element_suffix' => ' />',
                'tab_width' => 4,
                'no_markup  ' => false,
                'no_entities' => false,
                'hard_wrap' => false,
                'predef_urls  ' => [],
                'predef_titles' => [],
                'url_filter_func' => null,
                'header_id_func' => null,
                'code_block_content_func' => null,
                'code_span_content_func' => null,
                'enhanced_ordered_list' => false,
                'fn_id_prefix' => '',
                'fn_link_title' => '',
                'fn_backlink_title' => '',
                'fn_link_class' => 'footnote-ref',
                'fn_backlink_class' => 'footnote-backref',
                'fn_backlink_html' => '&#8617,&#xFE0E,',
                'table_align_class_tmpl' => '',
                'code_class_prefix' => '',
                'code_attr_on_pre' => false,
                'predef_abbr' => [],
            ],
        ],

        'commonmark' => [
            'driver' => 'commonmark',
            'config' => [
                'renderer' => [
                    'block_separator' => "\n",
                    'inner_separator' => "\n",
                    'soft_break' => "\n",
                ],
                'enable_emphasis' => true,
                'enable_strong' => true,
                'use_asterisk' => true,
                'use_underscore' => true,
                'html_input' => 'escape',
                'allow_unsafe_links' => false,
            ],
            'extensions' => [
                //
            ],
        ],
    ],
];
