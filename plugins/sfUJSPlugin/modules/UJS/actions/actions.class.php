<?php


class UJSactions extends sfActions
{
	public function executeScript()
	{
		$this->getResponse()->setContentType('text/javascript');
		$this->setLayout(false);
		$key = substr($this->getRequestParameter('key'), 0, 32);
		return $this->renderText($this->getUser()->getAttribute('UJS_'.$key, '', 'symfony/flash'));
	}
}
