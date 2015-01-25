<?php
class sfWidgetFormI18nSelect2ChoiceCurrency extends sfWidgetFormSelect2Choice
{
    protected function configure($options = array(), $attributes = array())
    {
        parent::configure($options, $attributes);

        $this->addOption('culture', sfContext::getInstance()->getUser()->getCulture());
        $this->addOption('currencies');
        $this->addOption('add_empty', false);

        // populate choices with all currencies
        $culture = isset($options['culture']) ? $options['culture'] : 'en';

        $currencies = sfCultureInfo::getInstance($culture)->getCurrencies(isset($options['currencies']) ? $options['currencies'] : null);

        $addEmpty = isset($options['add_empty']) ? $options['add_empty'] : false;
        if (false !== $addEmpty)
        {
            $currencies = array_merge(array('' => true === $addEmpty ? '' : $addEmpty), $currencies);
        }

        $this->setOption('choices', $currencies);
    }
}