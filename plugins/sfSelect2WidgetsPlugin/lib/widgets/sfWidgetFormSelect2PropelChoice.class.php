<?php
require_once(dirname(__FILE__) . '/../select2/Select2.class.php');

/**
 * This widget is designed to generate more user friendly autocomplete widgets.
 *
 * @package     symfony
 * @subpackage  widget
 * @link        https://github.com/19Gerhard85/sfSelect2WidgetsPlugin
 * @author      Ing. Gerhard Schranz <g.schranz@bgcc.at>
 * @version     0.1 2013-03-11
 */
class sfWidgetFormSelect2PropelChoice extends sfWidgetFormPropelChoice
{
    /**
     * Configures the current widget.
     *
     * Available options:
     *
     *  * url:            The URL to call to get the choices to use (required)
     *  * config:         A JavaScript array that configures the JQuery autocompleter widget
     *  * value_callback: A callback that converts the value before it is displayed
     *
     * @param array $options     An array of options
     * @param array $attributes  An array of default HTML attributes
     *
     * @see sfWidgetForm
     */
    protected function configure($options = array(), $attributes = array())
    {
        $this->addOption('culture', sfContext::getInstance()->getUser()->getCulture());
        $this->addOption('width', 'resolve');

        parent::configure($options, $attributes);
    }

    public function getChoices()
    {
        $choices = parent::getChoices();

        if (count($choices) > 0 && isset($choices['']) && $choices[''] == '') {
            $choices[''] = '&nbsp;';
        }

        return $choices;
    }

    /**
     * @param  string $name        The element name
     * @param  string $value       The date displayed in this widget
     * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
     * @param  array  $errors      An array of errors for the field
     *
     * @return string An HTML tag string
     *
     * @see sfWidgetForm
     */
    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        $id = $this->generateId($name);

        $return = parent::render($name, $value, $attributes, $errors);

        $return .= sprintf(<<<EOF
<script type="text/javascript">
function formatResult(item)
{
    return item.text;
}

jQuery("#%s").select2(
{
    width:              '%s',
    allowClear:         %s
});
</script>
EOF
            ,
            $id,
            $this->getOption('width'),
            $this->getOption('add_empty') == true ? 'true' : 'false'
        );

        return $return;
    }

    /**
     * Gets the stylesheet paths associated with the widget.
     *
     * @return array An array of stylesheet paths
     */
    public function getStylesheets()
    {
        return Select2::addStylesheets();
    }

    /**
     * Gets the JavaScript paths associated with the widget.
     *
     * @return array An array of JavaScript paths
     */
    public function getJavascripts()
    {
        return Select2::addJavascripts($this->getOption('culture'));
    }
}
