<?php

if ($this instanceof sfApplicationConfiguration)
{
  $this->getConfigCache()->registerConfigHandler('config/forms.yml', 'sfSimpleYamlConfigHandler');
  sfViewableForm::connect($this);
}
