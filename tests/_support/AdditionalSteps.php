<?php

namespace Tests\_support;


class AdditionalSteps
{

    protected $I;


    function __construct(AcceptanceTester $I)
    {
        $this->I = $I;
    }


  /**
   * @When I do something
   */
    function additionalActions()
    {
    }
}
