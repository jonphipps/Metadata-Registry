<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-01-28,  Time: 6:01 PM */

namespace App\Http\omr\Extensions;

use Encore\Admin\Form\Field;

class jdisplay extends Field
{
  protected $view = 'admin.jdisplay';


  public function render()
  {
    return parent::render();
  }

}
