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
class sfWidgetFormSelect2Autocompleter extends sfWidgetFormInput
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
        $this->addRequiredOption('url');
        $this->addRequiredOption('model');
        $this->addOption('value_callback', array($this, 'toString'));
        $this->addOption('method', '__toString');

        $this->addOption('culture', sfContext::getInstance()->getUser()->getCulture());
        $this->addOption('width', 'resolve');
        $this->addOption('minimumInputLength', 2);
        $this->addOption('placeholder', '');
        $this->addOption('allowClear', true);
        $this->addOption('formatSelection', 'defaultFormatResult');
        $this->addOption('formatResult', 'defaultFormatResult');
        $this->addOption('formatNoMatches', 'defaultFormatNoMatches');
        $this->addOption('formatInputTooShort', 'defaultFormatInputTooShort');
        $this->addOption('containerCss', '');
        $this->addOption('containerCssClass', '');
        $this->addOption('dropdownCss', '');
        $this->addOption('dropdownCssClass', '');

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
        $visible_value = escape_javascript($this->getOption('value_callback') ? call_user_func($this->getOption('value_callback'), $value) : $value);

        sfContext::getInstance()->getConfiguration()->loadHelpers('Url');

        $id = $this->generateId($name);

        $return = $this->renderTag('input', array(
            'type'  => 'hidden',
            'name'  => $name,
            'value' => $value
        ));

        $return .= sprintf(<<<EOF
<script type="text/javascript">
function defaultFormatResult(item)
{
    return item.text;
}

function defaultFormatNoMatches(term)
{
    return 'Keine Ergebnisse gefunden.';
}

function defaultFormatInputTooShort(term, minLength)
{
    return 'Bitte geben Sie mind. ' + minLength + ' Zeichen ein.';
}

jQuery("#%s").select2(
{
    width:                  '%s',
    minimumInputLength:     %s,
    placeholder:            '%s',
    allowClear:             %s,
    formatSelection:        %s,
    formatResult:           %s,
    formatNoMatches:        %s,
    formatInputTooShort:    %s,
    containerCss:           '%s',
    containerCssClass:      '%s',
    dropdownCss:            '%s',
    dropdownCssClass:       '%s',
    ajax: {
        url:        '%s',
        dataType:   'json',
        quietMillis: 100,
        data:       function (term, page)
        {
            return {
                q:     term,
                limit: 10,
                page:  page
            };
        },
        results: function (data, page)
        {
            var more = (page * 10) < data.total;

            return {results: data.items, more: more};
        }
    }
});

jQuery('#%s').select2('data', { id: '%s', text: '%s' });
</script>
EOF
            ,
            $id,
            $this->getOption('width'),
            $this->getOption('minimumInputLength'),
            $this->getOption('placeholder', ''),
            $this->getOption('allowClear') == true ? 'true' : 'false',
            $this->getOption('formatSelection'),
            $this->getOption('formatResult'),
            $this->getOption('formatNoMatches'),
            $this->getOption('formatInputTooShort'),
            $this->getOption('containerCss'),
            $this->getOption('containerCssClass'),
            $this->getOption('dropdownCss'),
            $this->getOption('dropdownCssClass'),
            url_for($this->getOption('url')),
            $id,
            $value,
            $visible_value ? $visible_value : $this->getOption('placeholder', '')
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

    protected function toString($value)
    {
        $class = constant($this->getOption('model').'::PEER');

        if ($class::hasBehavior('soft_delete'))
        {
            $class::disableSoftDelete();
        }

        $object = call_user_func(array($class, 'retrieveByPK'), $value);

        if ($class::hasBehavior('soft_delete'))
        {
            $class::enableSoftDelete();
        }

        $method = $this->getOption('method');

        if (!method_exists($this->getOption('model'), $method))
        {
            throw new RuntimeException(sprintf('Class "%s" must implement a "%s" method to be rendered in a "%s" widget', $this->getOption('model'), $method, __CLASS__));
        }

        return !is_null($object) ? $object->$method() : '';
    }
}
