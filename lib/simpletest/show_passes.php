<?php
if (! defined('SIMPLE_TEST'))
{
    define('SIMPLE_TEST', '../simpletest/');
}
require_once(SIMPLE_TEST . 'reporter.php');

class ShowPasses extends HtmlReporter {

    function ShowPasses() {
        $this->HtmlReporter();
    }

    function paintPass($message) {
        parent::paintPass($message);
        if (isset($_GET["showpasses"]))
        {
            print "<span class=\"pass\">Pass</span>: ";
            $breadcrumb = $this->getTestList();
            array_shift($breadcrumb);
            print implode("-&gt;", $breadcrumb);
            print "->$message<br />\n";
            flush();
        }
    }

    function _getCss() {
        return parent::_getCss() . ' .pass { color: green; }';
    }
}
?>