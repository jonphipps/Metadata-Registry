<?php

class sfBreadNav extends BasesfBreadNavNestedSet
{
  
    public function toForm() {
    
    $data = array();
    $data['page'] = $this->getPage();
    $data['module'] = $this->getModule();
    $data['action'] = $this->getAction();
    $data['credential'] = $this->getCredential();
    $data['catch_all'] = $this->getCatchall();
    return $data;
  }
  
  public function __toString() {
    return $this->getPage();
  }
  
}
