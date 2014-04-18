<?php
class Select2
{
    /**
     * Adds javascripts for Select2 Widgets
     *
     * @param null|string $culture Culture
     * @return array Array of javascripts
     */
    public static function addJavascripts($culture = null)
    {
        $path = sfConfig::get('sf_select2_web_dir');
        $available_cultures = sfConfig::get('sf_available_cultures');

        $javascripts = array($path . '/select2.js');

        if ($culture != 'en' && in_array($culture, $available_cultures)) {
            $javascripts[] = $path . '/select2_locale_' . $culture . '.js';
        }

        return $javascripts;
    }

    /**
     * Adds stylesheets for Select2 Widgets
     *
     * @return array Array of stylesheets
     */
    public static function addStylesheets()
    {
        $path = sfConfig::get('sf_select2_web_dir');

        return array($path . '/select2.css' => 'all');
    }
}