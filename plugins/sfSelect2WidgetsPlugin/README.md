sfSelect2WidgetsPlugin
======================

Description
-----------
The `sfSelect2WidgetsPlugin` is a symfony 1.2/1.3/1.4 plugin that provides several form widgets with `Select2` functionality.
Following widgets are included:
  * I18n Choice Country
  * I18n Choice Currency
  * I18n Choice Language
  * Autocomplete (for [Propel ORM](https://github.com/propelorm/sfPropelORMPlugin))
  * Choice
  * Propel Choice (for [Propel ORM](https://github.com/propelorm/sfPropelORMPlugin))
 
Requirements
------------
  * symfony 1.2 / 1.3 / 1.4
  * [jQuery](https://github.com/jquery/jquery), see [Select2](https://github.com/ivaynberg/select2) for the latest supported version
  * Optional: [Propel ORM](https://github.com/propelorm/sfPropelORMPlugin)

Installation via Composer
-------------------------
```json
{
    "require": {
        "bgcc/sf-select2-widgets-plugin": "~1.0"
    }
}
```

Installation via Git
--------------------
  * Install the plugin and init submodule

        $ git submodule add git://github.com/19Gerhard85/sfSelect2WidgetsPlugin.git plugins/sfSelect2WidgetsPlugin
        $ git submodule update --init --recursive

  * Enable the plugin in your `/config/ProjectConfiguration.class.php`
``` php
 $this->enablePlugins('sfSelect2WidgetsPlugin');
```
  
  * Publish assets

        $ ./symfony plugin:publish-assets

  * Clear you cache

        $ ./symfony cc
        
Installation via SVN
--------------------
  * Install the plugin and Select2 JavaScript library

        $ svn propedit svn:externals plugins
        Enter (without quotes) "sfSelect2WidgetsPlugin https://github.com/19Gerhard85/sfSelect2WidgetsPlugin/trunk"
        $ svn update
        $ svn propedit svn:externals plugins/sfSelect2WidgetsPlugin/web
        Enter (without quotes) "select2 https://github.com/ivaynberg/select2/trunk"
        $ svn update

  * Enable the plugin in your `/config/ProjectConfiguration.class.php`
``` php
 $this->enablePlugins('sfSelect2WidgetsPlugin');
```

  * Publish assets

        $ ./symfony plugin:publish-assets

  * Clear you cache

        $ ./symfony cc
        
Usage
-----
Coming soon...
