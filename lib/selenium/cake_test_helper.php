<?php
	/** 
	 * Selenium Helper
	 *
	 * Requires Selenium Core 0.7  (http://www.openqa.org/selenium-core/)
	 *
	 * Author: Daniel Hofstetter  (http://cakebaker.wordpress.com)
	 * License: MIT
	 *
	 * For installation instructions, see http://cakebaker.wordpress.com/tag/selenium/
	 * Selenium documentation: http://release.openqa.org/selenium-core/nightly/reference.html
	*/
	class SeleniumHelper extends Helper
	{		
		/**
		 * Outputs the title of the test suite. There is no output if the constant ALL_SUITE is defined. 
		 */
		function suiteTitle($title)
		{
			if (defined('ALL_SUITE'))
			{
				echo '';
			}
			else
			{
				echo '<tr><td><b>'.$title.'</b></td></tr>';
			}
		}
		
		/**
		 * Adds a testcase to a suite.
		 */
		function addTestCase($title, $view)
		{
			echo '<tr><td><a href="'.$view.'" target="testFrame">'.$title.'</a></td></tr>';
		}
		
		/**
		 * Outputs the title of the test case.
		 */
		function caseTitle($title)
		{
			echo '<tr><td rowspan="1" colspan="3">'.$title.'</td></tr>';
		}
		
		// Selenium actions
		
		/**
		 * Clicks on a link, button, checkbox or radio button. If the click action causes a new page to load (like a link 
		 * usually does), call waitForPageToLoad.
		 * @param locator an element locator
		 * @since 0.6
		 */
		function click($locator)
		{
			echo $this->__getRow('click', $locator);
		}
		
		/**
		 * Clicks on a link, button, checkbox or radio button. If the click action causes a new page to load (like a link 
		 * usually does), use "clickAndWait".
		 * @param locator an element locator
		 * @since 0.6
		 */
		function clickAndWait($locator)
		{
			echo $this->__getRow('clickAndWait', $locator);
		}

		/**
		 * Explicitly simulate an event, to trigger the corresponding "onevent" handler.
		 * @param locator an element locator
		 * @param eventName the event name, e.g. "focus" or "blur"
		 * @since 0.6
		 */
		function fireEvent($locator, $eventName)
		{
			echo $this->__getRow('fireEvent', $locator, $eventName);
		}
		
		/**
		 * Simulates a user pressing and releasing a key.
		 * @param locator an element locator
		 * @param keycode the numeric keycode of the key to be pressed, normally the ASCII value of that key.
		 * @since 0.7
		 */
		function keyPress($locator, $keycode)
		{
			echo $this->__getRow('keyPress', $locator, $keycode);
		}
		
		/**
		 * Simulates a user pressing a key (without releasing it yet).
		 * @param locator an element locator 
		 * @param keycode the numeric keycode of the key to be pressed, normally the ASCII value of that key.
		 * @since 0.7
		 */
		function keyDown($locator, $keycode)
		{
			echo $this->__getRow('keyDown', $locator, $keycode);
		}
		
		/**
		 * Simulates a user releasing a key. 
		 * @param locator an element locator 
		 * @param keycode the numeric keycode of the key to be released, normally the ASCII value of that key.
		 * @since 0.7
		 */
		function keyUp($locator, $keycode)
		{
			echo $this->__getRow('keyUp', $locator, $keycode);
		}   
		
		/**
		 * Simulates a user hovering a mouse over the specified element. 
		 * @param locator an element locator
		 * @since 0.7
		 */
		function mouseOver($locator)
		{
			echo $this->__getRow('mouseOver', $locator);
		}   

		/**
		 * Simulates a user pressing the mouse button (without releasing it yet) on the specified element. 
		 * @param locator an element locator
		 * @since 0.7
		 */
		function mouseDown($locator)
		{
			echo $this->__getRow('mouseDown', $locator);
		}   

		/**
		 * Sets the value of an input field, as though you typed it in.
		 * Can also be used to set the value of combo boxes, check boxes, etc. In these cases, value should be the 
		 * value of the option selected, not the visible text.
		 * @param locator an element locator 
		 * @param value the value to type
		 * @since 0.6
		 */
		function type($locator, $value)
		{
			echo $this->__getRow('type', $locator, $value);
		}

		/**
		 * Sets the value of an input field, as though you typed it in.
		 * Can also be used to set the value of combo boxes, check boxes, etc. In these cases, value should be the 
		 * value of the option selected, not the visible text.
		 * @param locator an element locator 
		 * @param value the value to type
		 * @since 0.6
		 */
		function typeAndWait($locator, $value)
		{
			echo $this->__getRow('typeAndWait', $locator, $value);
		}

		/**
		 * Check a toggle-button (checkbox/radio) 
		 * @param locator an element locator
		 * @since 0.7
		 */
		function check($locator)
		{
			echo $this->__getRow('check', $locator);
		}   

		/**
		 * Uncheck a toggle-button (checkbox/radio) 
		 * @param locator an element locator
		 * @since 0.7
		 */
		function uncheck($locator )
		{
			echo $this->__getRow('uncheck', $locator);
		}   

		/**
		 * Select an option from a drop-down using an option locator.
		 * @param locator an element locator identifying a drop-down menu
         	 * @param optionLocator an option locator (a label by default)
         	 * @since 0.6
		 */
		function select($locator, $optionLocator)
		{
			echo $this->__getRow('select', $locator, $optionLocator);
		}

		/**
		 * Select an option from a drop-down using an option locator.
		 * @param locator an element locator identifying a drop-down menu
         	 * @param optionLocator an option locator (a label by default)
         	 * @since 0.6
		 */
		function selectAndWait($locator, $optionLocator)
		{
			echo $this->__getRow('selectAndWait', $locator, $optionLocator);
		}

		/**
		 * Add a selection to the set of selected options in a multi-select element using an option locator. 
		 * @param locator an element locator identifying a multi-select box
         	 * @param optionLocator an option locator (a label by default)
         	 * @since 0.7
		 */
		function addSelection($locator, $optionLocator)
		{
			echo $this->__getRow('addSelection', $locator, $optionLocator);
		}   

		/**
		 * Remove a selection from the set of selected options in a multi-select element using an option locator. 
		 * @param locator an element locator identifying a multi-select box
		 * @param optionLocator an option locator (a label by default)
		 * @since 0.7
		 */
		function removeSelection($locator, $optionLocator)
		{
			echo $this->__getRow('removeSelection', $locator, $optionLocator);
		}   

		/**
		 * Submit the specified form. This is particularly useful for forms without submit buttons, e.g. single-input 
		 * "Search" forms. 
		 * @param formLocator an element locator for the form you want to submit
		 * @since 0.7
		 */
		function submit($formLocator)
		{
			echo $this->__getRow('submit', $formLocator);
		}   

		/**
		 * Opens a URL in the test frame. This accepts both relative and absolute URLs. The "open" command waits for the 
		 * page to load before proceeding, ie. the "AndWait" suffix is implicit. Note: The URL must be on the same domain 
		 * as the runner HTML due to security restrictions in the browser (Same Origin Policy). If you need to open an URL 
		 * on another domain, use the Selenium Server to start a new browser session on that domain.
		 * @param $url the URL to open; may be relative or absolute
		 * @since 0.6
		 */
		function open($url)
		{
			echo $this->__getRow('open', $url);
		}

		/**
		 * Selects a popup window. Once a popup window has been selected, all commands go to that window. To select the 
		 * main window again, use "null" as the target.
		 * @param windowId the JavaScript window ID of the window to select
		 * @since 0.6
		 */
		function selectWindow($windowId)
		{
			echo $this->__getRow('selectWindow', $windowId);
		}

		/**
		 * Waits for a popup window to appear and load up. 
		 * @param windowID the JavaScript window ID of the window that will appear
		 * @param timeout a timeout in milliseconds, after which the action will return with an error
		 * @since 0.7
		 */
		function waitForPopUp($windowID, $timeout)
		{
			echo $this->__getRow('waitForPopUp', $windowID, $timeout);
		}   

		/**
		 * By default, Selenium's overridden window.confirm() function will return true, as if the user had manually 
		 * clicked OK. After running this command, the next call to confirm() will return false, as if the user had 
		 * clicked Cancel.
		 * @since 0.6
		 */
		function chooseCancelOnNextConfirmation()
		{
			echo $this->__getRow('chooseCancelOnNextConfirmation');
		}
		
		/**
		 * Instructs Selenium to return the specified answer string in response to the next JavaScript prompt [window.prompt()].
		 * @param answer the answer to give in response to the prompt pop-up
		 * @since 0.6
		 */
		function answerOnNextPrompt($answer)
		{
			echo $this->__getRow('answerOnNextPrompt', $answer);
		}
		
		/**
		 * Simulates the user clicking the "back" button on their browser.
		 * @since 0.6
		 */
		function goBack()
		{
			echo $this->__getRow('goBack');
		}
		
		/**
		 * Simulates the user clicking the "Refresh" button on their browser.
		 * @since 0.7
		 */
		function refresh()
		{
			echo $this->__getRow('refresh');
		}
 
 		/**
		 * Simulates the user clicking the "close" button in the titlebar of a popup window.
		 * @since 0.6
		 */
		function close()
		{
			echo $this->__getRow('close');
		}
		
		/**
		 * Writes a message to the status bar and adds a note to the browser-side log. 
		 * If logLevelThreshold is specified, set the threshold for logging to that level (debug, info, warn, error).
		 * (Note that the browser-side logs will not be sent back to the server, and are invisible to the Client Driver.)
		 * @param context the message to be sent to the browser
		 * @param logLevelThreshold one of "debug", "info", "warn", "error", sets the threshold for browser-side logging
		 * @since 0.7
		 */
		function setContext($context, $logLevelThreshold)
		{
			echo $this->__getRow('setContext', $context, $logLevelThreshold);
		}   

		/**
		 * Runs the specified JavaScript snippet repeatedly until it evaluates to "true". The snippet may have multiple lines, 
		 * but only the result of the last line will be considered. 
		 * Note that, by default, the snippet will be run in the runner's test window, not in the window of your application. 
		 * To get the window of your application, you can use the JavaScript snippet selenium.browserbot.getCurrentWindow(), 
		 * and then run your JavaScript in there
		 * @param script the JavaScript snippet to run
		 * @param timeout a timeout in milliseconds, after which this command will return with an error
		 * @since 0.7
		 */
		function waitForCondition($script, $timeout)
		{
			echo $this->__getRow('waitForCondition', $script, $timeout);
		}
		
		/**
		 * Specifies the amount of time that Selenium will wait for actions to complete. 
		 * Actions that require waiting include "open" and the "waitFor*" actions.
 		 * The default timeout is 30 seconds. 
		 * @param timeout a timeout in milliseconds, after which the action will return with an error
		 * @since 0.7
		 */
		function setTimeout($timeout)
		{
			echo $this->__getRow('setTimeout', $timeout);
		}   

		/**
		 * Waits for a new page to load. 
		 * You can use this command instead of the "AndWait" suffixes, "clickAndWait", "selectAndWait", "typeAndWait" etc. 
		 * (which are only available in the JS API).
		 * Selenium constantly keeps track of new pages loading, and sets a "newPageLoaded" flag when it first notices a page 
		 * load. Running any other Selenium command after turns the flag to false. Hence, if you want to wait for a page to 
		 * load, you must wait immediately after a Selenium command that caused a page-load.
		 * @param timeout a timeout in milliseconds, after which this command will return with an error
		 * @since 0.7
		 */
		function waitForPageToLoad($timeout)
		{
			echo $this->__getRow('waitForPageToLoad', $timeout);
		}   

		// Selenium Accessors/Assertions
		
		/**
		 * Has an alert occurred? 
 		 * This function never throws an exception 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		 */
		function storeAlertPresent($variableName)
		{
			echo $this->__getRow('storeAlertPresent', $variableName);
		}   

		/**
		 * Has an alert occurred?
		 * @since 0.7
		 */
		function assertAlertPresent()
		{
			echo $this->__getRow('assertAlertPresent');
		}
		
		/**
		 * Has an alert not occurred?
		 * @since 0.7
		 */
		function assertAlertNotPresent()
		{
			echo $this->__getRow('assertAlertNotPresent');
		}
		
		/**
		 * Has an alert occurred?
		 * @since 0.7
		 */
		function verifyAlertPresent()
		{
			echo $this->__getRow('verifyAlertPresent');
		}
		
		/**
		 * Has an alert not occurred?
		 * @since 0.7
		 */
		function verifyAlertNotPresent()
		{
			echo $this->__getRow('verifyAlertNotPresent');
		}
		
		/**
		 * Has an alert occurred?
		 * @since 0.7
		 */
		function waitForAlertPresent()
		{
			echo $this->__getRow('waitForAlertPresent');
		}
		
		/**
		 * Has an alert not occurred?
		 * @since 0.7
		 */
		function waitForAlertNotPresent()
		{
			echo $this->__getRow('waitForAlertNotPresent');
		}
		
		/**
		 * Has a prompt occurred? 
 		 * This function never throws an exception 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		 */
		function storePromptPresent($variableName)
		{
			echo $this->__getRow('storePromptPresent', $variableName);
		}   

		/**
		 * Has a prompt occurred?
		 * @since 0.7
		 */
		function assertPromptPresent()
		{
			echo $this->__getRow('assertPromptPresent');
		}
		
		/**
		 * Has a prompt not occurred?
		 * @since 0.7
		 */
		function assertPromptNotPresent()
		{
			echo $this->__getRow('assertPromptNotPresent');
		}
		
		/**
		 * Has a prompt occurred?
		 * @since 0.7
		 */
		function verifyPromptPresent()
		{
			echo $this->__getRow('verifyPromptPresent');
		}
		
		/**
		 * Has a prompt not occurred?
		 * @since 0.7
		 */
		function verifyPromptNotPresent()
		{
			echo $this->__getRow('verifyPromptNotPresent');
		}
		
		/**
		 * Has a prompt occurred?
		 * @since 0.7
		 */
		function waitForPromptPresent()
		{
			echo $this->__getRow('waitForPromptPresent');
		}
		
		/**
		 * Has an alert occurred?
		 * @since 0.7
		 */
		function waitForPromptNotPresent()
		{
			echo $this->__getRow('waitForPromptNotPresent');
		}
		
		/**
		 * Has confirm() been called?
 		 * This function never throws an exception 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeConfirmationPresent($variableName)
		{
			echo $this->__getRow('storeConfirmationPresent', $variableName);
		}

		/**
		 * Has confirm() been called?
		 * @since 0.7
		*/
		function assertConfirmationPresent()
		{
			echo $this->__getRow('assertConfirmationPresent');
		}

		/**
		 * Has confirm() not been called?
		 * @since 0.7
		*/
		function assertConfirmationNotPresent()
		{
			echo $this->__getRow('assertConfirmationNotPresent');
		}

		/**
		 * Has confirm() been called?
		 * @since 0.7
		*/
		function verifyConfirmationPresent()
		{
			echo $this->__getRow('verifyConfirmationPresent');
		}

		/**
		 * Has confirm() not been called?
		 * @since 0.7
		*/
		function verifyConfirmationNotPresent()
		{
			echo $this->__getRow('verifyConfirmationNotPresent');
		}

		/**
		 * Has confirm() been called?
		 * @since 0.7
		*/
		function waitForConfirmationPresent()
		{
			echo $this->__getRow('waitForConfirmationPresent');
		}

		/**
		 * Has confirm() not been called?
		 * @since 0.7
		*/
		function waitForConfirmationNotPresent()
		{
			echo $this->__getRow('waitForConfirmationNotPresent');
		}

		/**
		 * Retrieves the message of a JavaScript alert generated during the previous action, or fail if there were no alerts. 
		 * Getting an alert has the same effect as manually clicking OK. If an alert is generated but you do not get/verify it, the next Selenium action will fail.
		 * NOTE: under Selenium, JavaScript alerts will NOT pop up a visible alert dialog.
		 * NOTE: Selenium does NOT support JavaScript alerts that are generated in a page's onload() event handler. In this case a visible dialog WILL be generated 
		 * and Selenium will hang until someone manually clicks OK.
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeAlert($variableName)
		{
			echo $this->__getRow('storeAlert', $variableName);
		}

		/**
		 * Retrieves the message of a JavaScript alert generated during the previous action, or fail if there were no alerts.
		 * @param pattern
		 * @since 0.6
		 */
		function assertAlert($pattern)
		{
			echo $this->__getRow('assertAlert', $pattern);
		}
		
		/**
		 * Fails if there is a JavaScript alert.
		 * @param pattern
		 * @since 0.7
		 */
		function assertNotAlert($pattern)
		{
			echo $this->__getRow('assertNotAlert', $pattern);
		}

		/**
		 * Retrieves the message of a JavaScript alert generated during the previous action, or fail if there were no alerts.
		 * @param pattern
		 * @since 0.6
		 */
		function verifyAlert($pattern)
		{
			echo $this->__getRow('verifyAlert', $pattern);
		}

		/**
		 * Fails if there is a JavaScript alert.
		 * @param pattern
		 * @since 0.7
		 */
		function verifyNotAlert($pattern)
		{
			echo $this->__getRow('verifyNotAlert', $pattern);
		}

		/**
		 * Retrieves the message of a JavaScript alert generated during the previous action, or fail if there were no alerts.
		 * @param pattern
		 * @since 0.7
		 */
		function waitForAlert($pattern)
		{
			echo $this->__getRow('waitForAlert', $pattern);
		}

		/**
		 * Fails if there is a JavaScript alert.
		 * @param pattern
		 * @since 0.7
		 */
		function waitForNotAlert($pattern)
		{
			echo $this->__getRow('waitForNotAlert', $pattern);
		}

		/**
		 * Retrieves the message of a JavaScript confirmation dialog generated during the previous action. 
		 * By default, the confirm function will return true, having the same effect as manually clicking OK. This can be changed by prior execution of the 
		 * chooseCancelOnNextConfirmation command. If an confirmation is generated but you do not get/verify it, the next Selenium action will fail. 
		 * NOTE: under Selenium, JavaScript confirmations will NOT pop up a visible dialog. 
		 * NOTE: Selenium does NOT support JavaScript confirmations that are generated in a page's onload() event handler. In this case a visible dialog WILL 
		 * be generated and Selenium will hang until you manually click OK. 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeConfirmation($variableName)
		{
			echo $this->__getRow('storeConfirmation', $variableName);
		}

		/**
		 * Retrieves the message of a JavaScript confirmation dialog generated during the previous action.
		 * @param pattern
		 * @since 0.6
		 */
		function assertConfirmation($pattern)
		{
			echo $this->__getRow('asssertConfirmation', $pattern);
		}
		
		/**
		 * Retrieves the message of a JavaScript confirmation dialog generated during the previous action.
		 * @param pattern
		 * @since 0.7
		 */
		function assertNotConfirmation($pattern)
		{
			echo $this->__getRow('asssertNotConfirmation', $pattern);
		}

		/**
		 * Retrieves the message of a JavaScript confirmation dialog generated during the previous action. 
		 * @param pattern
		 * @since 0.6
		 */
		function verifyConfirmation($pattern)
		{
			echo $this->__getRow('verifyConfirmation', $pattern);
		}

		/**
		 * Retrieves the message of a JavaScript confirmation dialog generated during the previous action. 
		 * @param pattern
		 * @since 0.7
		 */
		function verifyNotConfirmation($pattern)
		{
			echo $this->__getRow('verifyNotConfirmation', $pattern);
		}

		/**
		 * Retrieves the message of a JavaScript confirmation dialog generated during the previous action. 
		 * @param pattern
		 * @since 0.7
		 */
		function waitForConfirmation($pattern)
		{
			echo $this->__getRow('waitForConfirmation', $pattern);
		}

		/**
		 * Retrieves the message of a JavaScript confirmation dialog generated during the previous action. 
		 * @param pattern
		 * @since 0.7
		 */
		function waitForNotConfirmation($pattern)
		{
			echo $this->__getRow('waitForNotConfirmation', $pattern);
		}
		
		/**
		 * Retrieves the message of a JavaScript question prompt dialog generated during the previous action. 
		 * Successful handling of the prompt requires prior execution of the answerOnNextPrompt command. If a prompt is generated but you do not get/verify it, 
		 * the next Selenium action will fail.
		 * NOTE: under Selenium, JavaScript prompts will NOT pop up a visible dialog.
		 * NOTE: Selenium does NOT support JavaScript prompts that are generated in a page's onload() event handler. In this case a visible dialog WILL be generated 
		 * and Selenium will hang until someone manually clicks OK.
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storePrompt($variableName)
		{
			echo $this->__getRow('storePrompt', $variableName);
		}

		/**
		 * Retrieves the message of a JavaScript question prompt dialog generated during the previous action.
		 * @param pattern
		 * @since 0.6
		 */
		function assertPrompt($pattern)
		{
			echo $this->__getRow('assertPrompt', $pattern);
		}
		
		/**
		 * Retrieves the message of a JavaScript question prompt dialog generated during the previous action.
		 * @param pattern
		 * @since 0.7
		 */
		function assertNotPrompt($pattern)
		{
			echo $this->__getRow('assertNotPrompt', $pattern);
		}

		/**
		 * Retrieves the message of a JavaScript question prompt dialog generated during the previous action.
		 * @param pattern
		 * @since 0.6
		 */
		function verifyPrompt($pattern)
		{
			echo $this->__getRow('verifyPrompt', $pattern);
		}

		/**
		 * Retrieves the message of a JavaScript question prompt dialog generated during the previous action.
		 * @param pattern
		 * @since 0.7
		 */
		function verifyNotPrompt($pattern)
		{
			echo $this->__getRow('verifyNotPrompt', $pattern);
		}

		/**
		 * Retrieves the message of a JavaScript question prompt dialog generated during the previous action.
		 * @param pattern
		 * @since 0.7
		 */
		function waitForPrompt($pattern)
		{
			echo $this->__getRow('waitForPrompt', $pattern);
		}

		/**
		 * Retrieves the message of a JavaScript question prompt dialog generated during the previous action.
		 * @param pattern
		 * @since 0.7
		 */
		function waitForNotPrompt($pattern)
		{
			echo $this->__getRow('waitForNotPrompt', $pattern);
		}

		/**
		 * Gets the absolute URL of the current page. 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeAbsoluteLocation($variableName)
		{
			echo $this->__getRow('storeAbsoluteLocation', $variableName);
		}

		/**
		 * Gets the absolute URL of the current page. 
		 * @param pattern
		 * @since 0.7
		*/
		function assertAbsoluteLocation($pattern)
		{
			echo $this->__getRow('assertAbsoluteLocation', $pattern);
		}

		/**
		 * Gets the absolute URL of the current page. 
		 * @param pattern
		 * @since 0.7
		*/
		function assertNotAbsoluteLocation($pattern)
		{
			echo $this->__getRow('assertNotAbsoluteLocation', $pattern);
		}

		/**
		 * Gets the absolute URL of the current page. 
		 * @param pattern
		 * @since 0.7
		*/
		function verifyAbsoluteLocation($pattern)
		{
			echo $this->__getRow('verifyAbsoluteLocation', $pattern);
		}

		/**
		 * Gets the absolute URL of the current page. 
		 * @param pattern
		 * @since 0.7
		*/
		function verifyNotAbsoluteLocation($pattern)
		{
			echo $this->__getRow('verifyNotAbsoluteLocation', $pattern);
		}

		/**
		 * Gets the absolute URL of the current page. 
		 * @param pattern
		 * @since 0.7
		*/
		function waitForAbsoluteLocation($pattern)
		{
			echo $this->__getRow('waitForAbsoluteLocation', $pattern);
		}

		/**
		 * Gets the absolute URL of the current page. 
		 * @param pattern
		 * @since 0.7
		*/
		function waitForNotAbsoluteLocation($pattern)
		{
			echo $this->__getRow('waitForNotAbsoluteLocation', $pattern);
		}

		/**
		 * Verify the location of the current page ends with the expected location. If an URL querystring is provided, this is checked as well.
		 " @param expectedLocation the location to match
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeLocation($expectedLocation, $variableName)
		{
			echo $this->__getRow('storeLocation', $expectedLocation, $variableName);
		}

		/**
		 * Verify the location of the current page ends with the expected location. If an URL querystring is provided, this is checked as well.
		 " @param expectedLocation
		 * @since 0.6
		 */
		function assertLocation($expectedLocation)
		{
			echo $this->__getRow('assertLocation', $expectedLocation);
		}
		
		/**
		 * Verify the location of the current page ends with the expected location. If an URL querystring is provided, this is checked as well.
		 " @param expectedLocation
		 * @since 0.7
		 */
		function assertNotLocation($expectedLocation)
		{
			echo $this->__getRow('assertNotLocation', $expectedLocation);
		}

		/**
		 * Verify the location of the current page ends with the expected location. If an URL querystring is provided, this is checked as well.
		 " @param expectedLocation
		 * @since 0.6
		 */
		function verifyLocation($expectedLocation)
		{
			echo $this->__getRow('verifyLocation', $expectedLocation);
		}

		/**
		 * Verify the location of the current page ends with the expected location. If an URL querystring is provided, this is checked as well.
		 " @param expectedLocation
		 * @since 0.7
		 */
		function verifyNotLocation($expectedLocation)
		{
			echo $this->__getRow('verifyNotLocation', $expectedLocation);
		}

		/**
		 * Verify the location of the current page ends with the expected location. If an URL querystring is provided, this is checked as well.
		 " @param expectedLocation
		 * @since 0.7
		 */
		function waitForLocation($expectedLocation)
		{
			echo $this->__getRow('waitForLocation', $expectedLocation);
		}

		/**
		 * Verify the location of the current page ends with the expected location. If an URL querystring is provided, this is checked as well.
		 " @param expectedLocation
		 * @since 0.7
		 */
		function waitForNotLocation($expectedLocation)
		{
			echo $this->__getRow('waitForNotLocation', $expectedLocation);
		}

		/**
		 * Gets the title of the current page. 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeTitle($variableName)
		{
			echo $this->__getRow('storeTitle', $variableName);
		}

		/**
		 * Verifies the title of the current page.
		 * @param pattern
		 * @since 0.6
		 */
		function assertTitle($pattern)
		{
			echo $this->__getRow('assertTitle', $pattern);
		}
		
		/**
		 * Verifies the title of the current page.
		 * @param pattern
		 * @since 0.7
		 */
		function assertNotTitle($pattern)
		{
			echo $this->__getRow('assertNotTitle', $pattern);
		}

		/**
		 * Verifies the title of the current page.
		 * @param pattern
		 * @since 0.6
		 */
		function verifyTitle($pattern)
		{
			echo $this->__getRow('verifyTitle', $pattern);
		}

		/**
		 * Verifies the title of the current page.
		 * @param pattern
		 * @since 0.7
		 */
		function verifyNotTitle($pattern)
		{
			echo $this->__getRow('verifyNotTitle', $pattern);
		}

		/**
		 * Verifies the title of the current page.
		 * @param pattern
		 * @since 0.7
		 */
		function waitForTitle($pattern)
		{
			echo $this->__getRow('waitForTitle', $pattern);
		}

		/**
		 * Verifies the title of the current page.
		 * @param pattern
		 * @since 0.7
		 */
		function waitForNotTitle($pattern)
		{
			echo $this->__getRow('waitForNotTitle', $pattern);
		}

		/**
		 * Gets the entire text of the page. 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeBodyText($variableName)
		{
			echo $this->__getRow('storeBodyText', $variableName);
		}

		/**
		 * Gets the entire text of the page. 
		 * @param pattern
		 * @since 0.7
		*/
		function assertBodyText($pattern)
		{
			echo $this->__getRow('assertBodyText', $pattern);
		}

		/**
		 * Gets the entire text of the page. 
		 * @param pattern
		 * @since 0.7
		*/
		function assertNotBodyText($pattern)
		{
			echo $this->__getRow('assertNotBodyText', $pattern);
		}

		/**
		 * Gets the entire text of the page. 
		 * @param pattern
		 * @since 0.7
		*/
		function verifyBodyText($pattern)
		{
			echo $this->__getRow('verifyBodyText', $pattern);
		}

		/**
		 * Gets the entire text of the page. 
		 * @param pattern
		 * @since 0.7
		*/
		function verifyNotBodyText($pattern)
		{
			echo $this->__getRow('verifyNotBodyText', $pattern);
		}

		/**
		 * Gets the entire text of the page. 
		 * @param pattern
		 * @since 0.7
		*/
		function waitForBodyText($pattern)
		{
			echo $this->__getRow('waitForBodyText', $pattern);
		}

		/**
		 * Gets the entire text of the page. 
		 * @param pattern
		 * @since 0.7
		*/
		function waitForNotBodyText($pattern)
		{
			echo $this->__getRow('waitForNotBodyText', $pattern);
		}

		/**
		 * Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter). For checkbox/radio elements, the value will 
		 * be "on" or "off" depending on whether the element is checked or not. 	
		 * @param locator an element locator 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.6
		 */
		function storeValue($locator, $variableName)
		{
			echo $this->__getRow('storeValue', $locator, $variableName);
		}

		/**
		 * Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter).
		 * @param locator
		 * @param pattern
		 * @since 0.6
		 */
		function assertValue($locator, $pattern)
		{
			echo $this->__getRow('assertValue', $locator, $pattern);
		}
		
		/**
		 * Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter).
		 * @param locator
		 * @param pattern
		 * @since 0.7
		 */
		function assertNotValue($locator, $pattern)
		{
			echo $this->__getRow('assertNotValue', $locator, $pattern);
		}

		/**
		 * Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter).
		 * @param locator
		 * @param pattern
		 * @since 0.6
		 */
		function verifyValue($locator, $pattern)
		{
			echo $this->__getRow('verifyValue', $locator, $pattern);
		}
		
		/**
		 * Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter).
		 * @param locator
		 * @param pattern
		 * @since 0.7
		 */
		function verifyNotValue($locator, $pattern)
		{
			echo $this->__getRow('verifyNotValue', $locator, $pattern);
		}

		/**
		 * Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter).
		 * @param locator
		 * @param pattern
		 * @since 0.7
		 */
		function waitForValue($locator, $pattern)
		{
			echo $this->__getRow('waitForValue', $locator, $pattern);
		}

		/**
		 * Gets the (whitespace-trimmed) value of an input field (or anything else with a value parameter).
		 * @param locator
		 * @param pattern
		 * @since 0.7
		 */
		function waitForNotValue($locator, $pattern)
		{
			echo $this->__getRow('waitForNotValue', $locator, $pattern);
		}

		/**
		 * Gets the text of an element. This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers) 
		 * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user. 
		 * @param locator an element locator 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.6
		 */
		function storeText($locator, $variableName)
		{
			echo $this->__getRow('storeText', $locator, $variableName);
		}

		/**
		 * Gets the text of an element. This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers) 
		 * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user. 
		 * @param locator
		 * @param pattern
		 * @since 0.6
		 */
		function assertText($locator, $pattern)
		{
			echo $this->__getRow('assertText', $locator, $pattern);
		}
		
		/**
		 * Gets the text of an element. This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers) 
		 * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user. 
		 * @param locator
		 * @param pattern
		 * @since 0.7
		 */
		function assertNotText($locator, $pattern)
		{
			echo $this->__getRow('assertNotText', $locator, $pattern);
		}

		/**
		 * Gets the text of an element. This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers) 
		 * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user. 
		 * @param locator
		 * @param pattern
		 * @since 0.6
		 */
		function verifyText($locator, $pattern)
		{
			echo $this->__getRow('verifyText', $locator, $pattern);
		}

		/**
		 * Gets the text of an element. This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers) 
		 * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user. 
		 * @param locator
		 * @param pattern
		 * @since 0.7
		 */
		function verifyNotText($locator, $pattern)
		{
			echo $this->__getRow('verifyNotText', $locator, $pattern);
		}

		/**
		 * Gets the text of an element. This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers) 
		 * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user. 
		 * @param locator
		 * @param pattern
		 * @since 0.7
		 */
		function waitForText($locator, $pattern)
		{
			echo $this->__getRow('waitForText', $locator, $pattern);
		}

		/**
		 * Gets the text of an element. This works for any element that contains text. This command uses either the textContent (Mozilla-like browsers) 
		 * or the innerText (IE-like browsers) of the element, which is the rendered text shown to the user. 
		 * @param locator
		 * @param pattern
		 * @since 0.7
		 */
		function waitForNotText($locator, $pattern)
		{
			echo $this->__getRow('waitForNotText', $locator, $pattern);
		}

		/**
		 * Gets the result of evaluating the specified JavaScript snippet. The snippet may have multiple lines, but only the result of the last line will be returned. 
		 * Note that, by default, the snippet will run in the context of the "selenium" object itself, so this will refer to the Selenium object, and window will refer 
		 * to the top-level runner test window, not the window of your application.
		 * If you need a reference to the window of your application, you can refer to this.browserbot.getCurrentWindow() and if you need to use a locator to refer to 
		 * a single element in your application page, you can use this.page().findElement("foo") where "foo" is your locator.
		 * @param script the JavaScript snippet to run
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeEval($script, $variableName)
		{
			echo $this->__getRow('storeEval', $script, $variableName);
		}

		/**
		 * Gets the result of evaluating the specified JavaScript snippet. The snippet may have multiple lines, but only the result of the last line will be returned. 
		 * Note that, by default, the snippet will run in the context of the "selenium" object itself, so this will refer to the Selenium object, and window will refer 
		 * to the top-level runner test window, not the window of your application.
		 * If you need a reference to the window of your application, you can refer to this.browserbot.getCurrentWindow() and if you need to use a locator to refer to 
		 * a single element in your application page, you can use this.page().findElement("foo") where "foo" is your locator.
		 * @param script
		 * @param pattern
		 * @since 0.7
		*/
		function assertEval($script, $pattern)
		{
			echo $this->__getRow('assertEval', $script, $pattern);
		}

		/**
		 * Gets the result of evaluating the specified JavaScript snippet. The snippet may have multiple lines, but only the result of the last line will be returned. 
		 * Note that, by default, the snippet will run in the context of the "selenium" object itself, so this will refer to the Selenium object, and window will refer 
		 * to the top-level runner test window, not the window of your application.
		 * If you need a reference to the window of your application, you can refer to this.browserbot.getCurrentWindow() and if you need to use a locator to refer to 
		 * a single element in your application page, you can use this.page().findElement("foo") where "foo" is your locator.
		 * @param script
		 * @param pattern
		 * @since 0.7
		*/
		function assertNotEval($script, $pattern)
		{
			echo $this->__getRow('assertNotEval', $script, $pattern);
		}
	
		/**
		 * Gets the result of evaluating the specified JavaScript snippet. The snippet may have multiple lines, but only the result of the last line will be returned. 
		 * Note that, by default, the snippet will run in the context of the "selenium" object itself, so this will refer to the Selenium object, and window will refer 
		 * to the top-level runner test window, not the window of your application.
		 * If you need a reference to the window of your application, you can refer to this.browserbot.getCurrentWindow() and if you need to use a locator to refer to 
		 * a single element in your application page, you can use this.page().findElement("foo") where "foo" is your locator.
		 * @param script
		 * @param pattern
		 * @since 0.7
		*/
		function verifyEval($script, $pattern)
		{
			echo $this->__getRow('verifyEval', $script, $pattern);
		}

		/**
		 * Gets the result of evaluating the specified JavaScript snippet. The snippet may have multiple lines, but only the result of the last line will be returned. 
		 * Note that, by default, the snippet will run in the context of the "selenium" object itself, so this will refer to the Selenium object, and window will refer 
		 * to the top-level runner test window, not the window of your application.
		 * If you need a reference to the window of your application, you can refer to this.browserbot.getCurrentWindow() and if you need to use a locator to refer to 
		 * a single element in your application page, you can use this.page().findElement("foo") where "foo" is your locator.
		 * @param script
		 * @param pattern
		 * @since 0.7
		*/
		function verifyNotEval($script, $pattern)
		{
			echo $this->__getRow('verifyNotEval', $script, $pattern);
		}

		/**
		 * Gets the result of evaluating the specified JavaScript snippet. The snippet may have multiple lines, but only the result of the last line will be returned. 
		 * Note that, by default, the snippet will run in the context of the "selenium" object itself, so this will refer to the Selenium object, and window will refer 
		 * to the top-level runner test window, not the window of your application.
		 * If you need a reference to the window of your application, you can refer to this.browserbot.getCurrentWindow() and if you need to use a locator to refer to 
		 * a single element in your application page, you can use this.page().findElement("foo") where "foo" is your locator.
		 * @param script
		 * @param pattern
		 * @since 0.7
		*/
		function waitForEval($script, $pattern)
		{
			echo $this->__getRow('waitForEval', $script, $pattern);
		}

		/**
		 * Gets the result of evaluating the specified JavaScript snippet. The snippet may have multiple lines, but only the result of the last line will be returned. 
		 * Note that, by default, the snippet will run in the context of the "selenium" object itself, so this will refer to the Selenium object, and window will refer 
		 * to the top-level runner test window, not the window of your application.
		 * If you need a reference to the window of your application, you can refer to this.browserbot.getCurrentWindow() and if you need to use a locator to refer to 
		 * a single element in your application page, you can use this.page().findElement("foo") where "foo" is your locator.
		 * @param script
		 * @param pattern
		 * @since 0.7
		*/
		function waitForNotEval($script, $pattern)
		{
			echo $this->__getRow('waitForNotEval', $script, $pattern);
		}

		/**
		 * Gets whether a toggle-button (checkbox/radio) is checked. Fails if the specified element doesn't exist or isn't a toggle-button. 
		 * @param locator an element locator pointing to a checkbox or radio button
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeChecked($locator, $variableName)
		{
			echo $this->__getRow('storeChecked', $locator, $variableName);
		}

		/**
		 * Gets whether a toggle-button (checkbox/radio) is checked. Fails if the specified element doesn't exist or isn't a toggle-button. 
		 * @param locator 
		 * @param pattern
		 * @since 0.7
		*/
		function assertChecked($locator, $pattern)
		{
			echo $this->__getRow('assertChecked', $locator, $pattern);
		}

		/**
		 * Gets whether a toggle-button (checkbox/radio) is checked. Fails if the specified element doesn't exist or isn't a toggle-button. 
		 * @param locator 
		 * @param pattern
		 * @since 0.7
		*/
		function assertNotChecked($locator, $pattern)
		{
			echo $this->__getRow('assertNotChecked', $locator, $pattern);
		}

		/**
		 * Gets whether a toggle-button (checkbox/radio) is checked. Fails if the specified element doesn't exist or isn't a toggle-button. 
		 * @param locator 
		 * @param pattern
		 * @since 0.7
		*/
		function verifyChecked($locator, $pattern)
		{
			echo $this->__getRow('verifyChecked', $locator, $pattern);
		}

		/**
		 * Gets whether a toggle-button (checkbox/radio) is checked. Fails if the specified element doesn't exist or isn't a toggle-button. 
		 * @param locator 
		 * @param pattern
		 * @since 0.7
		*/
		function verifyNotChecked($locator, $pattern)
		{
			echo $this->__getRow('verifyNotChecked', $locator, $pattern);
		}

		/**
		 * Gets whether a toggle-button (checkbox/radio) is checked. Fails if the specified element doesn't exist or isn't a toggle-button. 
		 * @param locator 
		 * @param pattern
		 * @since 0.7
		*/
		function waitForChecked($locator, $pattern)
		{
			echo $this->__getRow('waitForChecked', $locator, $pattern);
		}

		/**
		 * Gets whether a toggle-button (checkbox/radio) is checked. Fails if the specified element doesn't exist or isn't a toggle-button. 
		 * @param locator 
		 * @param pattern
		 * @since 0.7
		*/
		function waitForNotChecked($locator, $pattern)
		{
			echo $this->__getRow('waitForNotChecked', $locator, $pattern);
		}

		/**
		 * Gets the text from a cell of a table. The cellAddress syntax tableLocator.row.column, where row and column start at 0. 
		 * @param tableCellAddress a cell address, e.g. "foo.1.4"
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeTable($tableCellAddress, $variableName)
		{
			echo $this->__getRow('storeTable', $tableCellAddress, $variableName);
		}

		/**
		 * Gets the text from a cell of a table. The cellAddress syntax tableLocator.row.column, where row and column start at 0. 
		 * @param tableCellAddress a cell address, e.g. "foo.1.4"
		 * @param pattern 
		 * @since 0.6
		 */
		function assertTable($tableCellAddress, $pattern)
		{
			echo $this->__getRow('assertTable', $tableCellAddress, $pattern);
		}

		/**
		 * Gets the text from a cell of a table. The cellAddress syntax tableLocator.row.column, where row and column start at 0. 
		 * @param tableCellAddress a cell address, e.g. "foo.1.4"
		 * @param pattern 
		 * @since 0.7
		 */
		function assertNotTable($tableCellAddress, $pattern)
		{
			echo $this->__getRow('assertNotTable', $tableCellAddress, $pattern);
		}
		
		/**
		 * Gets the text from a cell of a table. The cellAddress syntax tableLocator.row.column, where row and column start at 0. 
		 * @param tableCellAddress a cell address, e.g. "foo.1.4"
		 * @param pattern 
		 * @since 0.6
		 */
		function verifyTable($tableCellAddress, $pattern)
		{
			echo $this->__getRow('verifyTable', $tableCellAddress, $pattern);
		}

		/**
		 * Gets the text from a cell of a table. The cellAddress syntax tableLocator.row.column, where row and column start at 0. 
		 * @param tableCellAddress a cell address, e.g. "foo.1.4"
		 * @param pattern 
		 * @since 0.7
		 */
		function verifyNotTable($tableCellAddress, $pattern)
		{
			echo $this->__getRow('verifyNotTable', $tableCellAddress, $pattern);
		}

		/**
		 * Gets the text from a cell of a table. The cellAddress syntax tableLocator.row.column, where row and column start at 0. 
		 * @param tableCellAddress a cell address, e.g. "foo.1.4"
		 * @param pattern 
		 * @since 0.7
		 */
		function waitForTable($tableCellAddress, $pattern)
		{
			echo $this->__getRow('waitForTable', $tableCellAddress, $pattern);
		}

		/**
		 * Gets the text from a cell of a table. The cellAddress syntax tableLocator.row.column, where row and column start at 0. 
		 * @param tableCellAddress a cell address, e.g. "foo.1.4"
		 * @param pattern 
		 * @since 0.7
		 */
		function waitForNotTable($tableCellAddress, $pattern)
		{
			echo $this->__getRow('waitForNotTable', $tableCellAddress, $pattern);
		}

		/**
		 * Verifies that the selected option of a drop-down satisfies the optionSpecifier.
		 * @param locator an element locator 
		 * @param optionLocator an option locator, typically just an option label (e.g. "John Smith")
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		// this function in invalid
		/*function storeSelected($locator, $optionLocator, $variableName)
		{
			echo $this->__getRow('storeSelected', $locator, $optionLocator, $variableName);
		}*/

		/**
		 * Verifies that the selected option of a drop-down satisfies the optionSpecifier.
		 * @param locator an element locator 
		 * @param optionLocator an option locator, typically just an option label (e.g. "John Smith")
		 * @since 0.6
		 */
		function assertSelected($locator, $optionLocator)
		{
			echo $this->__getRow('assertSelected', $locator, $optionLocator);
		}

		/**
		 * Verifies that the selected option of a drop-down satisfies the optionSpecifier.
		 * @param locator an element locator 
		 * @param optionLocator an option locator, typically just an option label (e.g. "John Smith")
		 * @since 0.7
		 */
		function assertNotSelected($locator, $optionLocator)
		{
			echo $this->__getRow('assertNotSelected', $locator, $optionLocator);
		}

		/**
		 * Verifies that the selected option of a drop-down satisfies the optionSpecifier.
		 * @param locator an element locator 
		 * @param optionLocator an option locator, typically just an option label (e.g. "John Smith")
		 * @since 0.6
		 */
		function verifySelected($locator, $optionLocator)
		{
			echo $this->__getRow('verifySelected', $locator, $optionLocator);
		}

		/**
		 * Verifies that the selected option of a drop-down satisfies the optionSpecifier.
		 * @param locator an element locator 
		 * @param optionLocator an option locator, typically just an option label (e.g. "John Smith")
		 * @since 0.7
		 */
		function verifyNotSelected($locator, $optionLocator)
		{
			echo $this->__getRow('verifyNotSelected', $locator, $optionLocator);
		}

		/**
		 * Verifies that the selected option of a drop-down satisfies the optionSpecifier.
		 * @param locator an element locator 
		 * @param optionLocator an option locator, typically just an option label (e.g. "John Smith")
		 * @since 0.7
		 */
		function waitForSelected($locator, $optionLocator)
		{
			echo $this->__getRow('waitForSelected', $locator, $optionLocator);
		}

		/**
		 * Verifies that the selected option of a drop-down satisfies the optionSpecifier.
		 * @param locator an element locator 
		 * @param optionLocator an option locator, typically just an option label (e.g. "John Smith")
		 * @since 0.7
		 */
		function waitForNotSelected($locator, $optionLocator)
		{
			echo $this->__getRow('waitNotSelected', $locator, $optionLocator);
		}

		/**
		 * Gets all option labels for selected options in the specified select or multi-select element. 
		 * @param locator an element locator 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeSelectedOptions($locator, $variableName)
		{
			echo $this->__getRow('storeSelectedOptions', $locator, $variableName);
		}

		/**
		 * Gets all option labels for selected options in the specified select or multi-select element. 
		 * @param locator an element locator 
		 * @param pattern
		 * @since 0.7
		*/
		function assertSelectedOptions($locator, $pattern)
		{
			echo $this->__getRow('assertSelectedOptions', $locator, $pattern);
		}

		/**
		 * Gets all option labels for selected options in the specified select or multi-select element. 
		 * @param locator an element locator 
		 * @param pattern
		 * @since 0.7
		*/
		function assertNotSelectedOptions($locator, $pattern)
		{
			echo $this->__getRow('assertNotSelectedOptions', $locator, $pattern);
		}

		/**
		 * Gets all option labels for selected options in the specified select or multi-select element. 
		 * @param locator an element locator 
		 * @param pattern
		 * @since 0.7
		*/
		function verifySelectedOptions($locator, $pattern)
		{
			echo $this->__getRow('verifySelectedOptions', $locator, $pattern);
		}

		/**
		 * Gets all option labels for selected options in the specified select or multi-select element. 
		 * @param locator an element locator 
		 * @param pattern
		 * @since 0.7
		*/
		function verifyNotSelectedOptions($locator, $pattern)
		{
			echo $this->__getRow('verifyNotSelectedOptions', $locator, $pattern);
		}

		/**
		 * Gets all option labels for selected options in the specified select or multi-select element. 
		 * @param locator an element locator 
		 * @param pattern
		 * @since 0.7
		*/
		function waitForSelectedOptions($locator, $pattern)
		{
			echo $this->__getRow('waitForSelectedOptions', $locator, $pattern);
		}

		/**
		 * Gets all option labels for selected options in the specified select or multi-select element. 
		 * @param locator an element locator 
		 * @param pattern
		 * @since 0.7
		*/
		function waitForNotSelectedOptions($locator, $pattern)
		{
			echo $this->__getRow('waitForNotSelectedOptions', $locator, $pattern);
		}

		/**
		 * Gets all option labels in the specified select drop-down.
		 * @param locator an element locator 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeSelectOptions($locator, $variableName)
		{
			echo $this->__getRow('storeSelectOptions', $locator, $variableName);
		}

		/**
		 * Gets all option labels in the specified select drop-down.
		 * @param locator an element locator 
		 * @param pattern
		 * @since 0.6
		 */
		function assertSelectOptions($locator, $pattern)
		{
			echo $this->__getRow('assertSelectOptions', $locator, $pattern);
		}
		
		/**
		 * Gets all option labels in the specified select drop-down.
		 * @param locator an element locator 
		 * @param pattern
		 * @since 0.7
		 */
		function assertNotSelectOptions($locator, $pattern)
		{
			echo $this->__getRow('assertNotSelectOptions', $locator, $pattern);
		}

		/**
		 * Gets all option labels in the specified select drop-down.
		 * @param locator an element locator 
		 * @param pattern
		 * @since 0.6
		 */
		function verifySelectOptions($locator, $pattern)
		{
			echo $this->__getRow('verifySelectOptions', $locator, $pattern);
		}

		/**
		 * Gets all option labels in the specified select drop-down.
		 * @param locator an element locator 
		 * @param pattern
		 * @since 0.7
		 */
		function verifyNotSelectOptions($locator, $pattern)
		{
			echo $this->__getRow('verifyNotSelectOptions', $locator, $pattern);
		}

		/**
		 * Gets all option labels in the specified select drop-down.
		 * @param locator an element locator 
		 * @param pattern
		 * @since 0.7
		 */
		function waitForSelectOptions($locator, $pattern)
		{
			echo $this->__getRow('waitForSelectOptions', $locator, $pattern);
		}

		/**
		 * Gets all option labels in the specified select drop-down.
		 * @param locator an element locator 
		 * @param pattern
		 * @since 0.7
		 */
		function waitForNotSelectOptions($locator, $pattern)
		{
			echo $this->__getRow('waitForNotSelectOptions', $locator, $pattern);
		}

		/**
		 * Gets the value of an element attribute. 
		 * @param attributeLocator an element locator
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.6
		 */
		function storeAttribute($attributeLocator, $variableName)
		{
			echo $this->__getRow('storeAttribute', $attributeLocator, $variableName);
		}

		/**
		 * Gets the value of an element attribute. 
		 * @param attributeLocator an element locator
		 * @param pattern
		 * @since 0.6
		 */
		function assertAttribute($attributeLocator, $pattern)
		{
			echo $this->__getRow('assertAttribute', $attributeLocator, $pattern);
		}
		
		/**
		 * Gets the value of an element attribute. 
		 * @param attributeLocator an element locator
		 * @param pattern
		 * @since 0.7
		 */
		function assertNotAttribute($attributeLocator, $pattern)
		{
			echo $this->__getRow('assertNotAttribute', $attributeLocator, $pattern);
		}

		/**
		 * Gets the value of an element attribute. 
		 * @param attributeLocator an element locator
		 * @param pattern
		 * @since 0.6
		 */
		function verifyAttribute($attributeLocator, $pattern)
		{
			echo $this->__getRow('verifyAttribute', $attributeLocator, $pattern);
		}

		/**
		 * Gets the value of an element attribute. 
		 * @param attributeLocator an element locator
		 * @param pattern
		 * @since 0.7
		 */
		function verifyNotAttribute($attributeLocator, $pattern)
		{
			echo $this->__getRow('verifyNotAttribute', $attributeLocator, $pattern);
		}

		/**
		 * Gets the value of an element attribute. 
		 * @param attributeLocator an element locator
		 * @param pattern
		 * @since 0.7
		 */
		function waitForAttribute($attributeLocator, $pattern)
		{
			echo $this->__getRow('waitForAttribute', $attributeLocator, $pattern);
		}

		/**
		 * Gets the value of an element attribute. 
		 * @param attributeLocator an element locator
		 * @param pattern
		 * @since 0.7
		 */
		function waitForNotAttribute($attributeLocator, $pattern)
		{
			echo $this->__getRow('waitForNotAttribute', $attributeLocator, $pattern);
		}

		/**
		 * Verifies that the specified text pattern appears somewhere on the rendered page shown to the user. 
		 * @param pattern a pattern to match with the text of the page
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeTextPresent($pattern, $variableName)
		{
			echo $this->__getRow('storeTextPresent', $pattern, $variableName);
		}

		/**
		 * Verifies that the specified text pattern appears somewhere on the rendered page shown to the user. 
		 * @param pattern
		 * @since 0.6
		 */
		function assertTextPresent($pattern)
		{
			echo $this->__getRow('assertTextPresent', $pattern);
		}

		/**
		 * Verifies that the specified text pattern does not appear somewhere on the rendered page shown to the user. 
		 * @param pattern
		 * @since 0.6
		 */
		function assertTextNotPresent($pattern)
		{
			echo $this->__getRow('assertTextNotPresent', $pattern);
		}
		
		/**
		 * Verifies that the specified text pattern appears somewhere on the rendered page shown to the user. 
		 * @param pattern
		 * @since 0.6
		 */
		function verifyTextPresent($pattern)
		{
			echo $this->__getRow('verifyTextPresent', $pattern);
		}

		/**
		 * Verifies that the specified text pattern does not appear somewhere on the rendered page shown to the user. 
		 * @param pattern
		 * @since 0.6
		 */
		function verifyTextNotPresent($pattern)
		{
			echo $this->__getRow('verifyTextNotPresent', $pattern);
		}
		
		/**
		 * Verifies that the specified text pattern appears somewhere on the rendered page shown to the user. 
		 * @param pattern
		 * @since 0.7
		 */
		function waitForTextPresent($pattern)
		{
			echo $this->__getRow('waitForTextPresent', $pattern);
		}

		/**
		 * Verifies that the specified text pattern does not appear somewhere on the rendered page shown to the user. 
		 * @param pattern
		 * @since 0.7
		 */
		function waitForTextNotPresent($pattern)
		{
			echo $this->__getRow('waitForTextNotPresent', $pattern);
		}
		
		/**
		 * Verifies that the specified element is somewhere on the page. 
		 * @param locator an element locator 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeElementPresent($locator, $variableName)
		{
			echo $this->__getRow('storeElementPresent', $locator, $variableName);
		}

		/**
		 * Verifies that the specified element is somewhere on the page.
		 * @param locator
		 * @since 0.6
		 */
		function assertElementPresent($locator)
		{
			echo $this->__getRow('assertElementPresent', $locator);
		}
		
		/**
		 * Verifies that the specified element is NOT on the page.
		 * @param locator
		 * @since 0.6
		 */
		function assertElementNotPresent($locator)
		{
			echo $this->__getRow('assertElementNotPresent', $locator);
		}

		/**
		 * Verifies that the specified element is somewhere on the page.
		 * @param locator
		 * @since 0.6
		 */
		function verifyElementPresent($locator)
		{
			echo $this->__getRow('verifyElementPresent', $locator);
		}
		
		/**
		 * Verifies that the specified element is NOT on the page.
		 * @param locator
		 * @since 0.6
		 */
		function verifyElementNotPresent($locator)
		{
			echo $this->__getRow('verifyElementNotPresent', $locator);
		}

		/**
		 * Verifies that the specified element is somewhere on the page.
		 * @param locator
		 * @since 0.7
		 */
		function waitForElementPresent($locator)
		{
			echo $this->__getRow('waitForElementPresent', $locator);
		}
		
		/**
		 * Verifies that the specified element is NOT on the page.
		 * @param locator
		 * @since 0.7
		 */
		function waitForElementNotPresent($locator)
		{
			echo $this->__getRow('waitForElementNotPresent', $locator);
		}

		/**
		 * Determines if the specified element is visible. An element can be rendered invisible by setting the CSS "visibility" property to "hidden", 
		 * or the "display" property to "none", either for the element itself or one if its ancestors. This method will fail if the element is not present. 
		 * @param locator an element locator 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeVisible($locator, $variableName)
		{
			echo $this->__getRow('storeVisible', $locator, $variableName);
		}

		/**
		 * Determines if the specified element is visible. An element can be rendered invisible by setting the CSS "visibility" property to "hidden", 
		 * or the "display" property to "none", either for the element itself or one if its ancestors. This method will fail if the element is not present. 
		 * @param locator an element locator 
		 * @since 0.6
		 */
		function assertVisible($locator)
		{
			echo $this->__getRow('assertVisible', $locator);
		}
		
		/**
		 * Determines if the specified element is visible. An element can be rendered invisible by setting the CSS "visibility" property to "hidden", 
		 * or the "display" property to "none", either for the element itself or one if its ancestors. This method will fail if the element is not present. 
		 * @param locator an element locator 
		 * @since 0.6
		 */
		function assertNotVisible($locator)
		{
			echo $this->__getRow('assertNotVisible', $locator);
		}

		/**
		 * Determines if the specified element is visible. An element can be rendered invisible by setting the CSS "visibility" property to "hidden", 
		 * or the "display" property to "none", either for the element itself or one if its ancestors. This method will fail if the element is not present. 
		 * @param locator an element locator 
		 * @since 0.6
		 */
		function verifyVisible($locator)
		{
			echo $this->__getRow('verifyVisible', $locator);
		}
		
		/**
		 * Determines if the specified element is visible. An element can be rendered invisible by setting the CSS "visibility" property to "hidden", 
		 * or the "display" property to "none", either for the element itself or one if its ancestors. This method will fail if the element is not present. 
		 * @param locator an element locator 
		 * @since 0.6
		 */
		function verifyNotVisible($locator)
		{
			echo $this->__getRow('verifyNotVisible', $locator);
		}

		/**
		 * Determines if the specified element is visible. An element can be rendered invisible by setting the CSS "visibility" property to "hidden", 
		 * or the "display" property to "none", either for the element itself or one if its ancestors. This method will fail if the element is not present. 
		 * @param locator an element locator 
		 * @since 0.6
		 */
		function waitForVisible($locator)
		{
			echo $this->__getRow('waitForVisible', $locator);
		}
		
		/**
		 * Determines if the specified element is visible. An element can be rendered invisible by setting the CSS "visibility" property to "hidden", 
		 * or the "display" property to "none", either for the element itself or one if its ancestors. This method will fail if the element is not present. 
		 * @param locator an element locator 
		 * @since 0.6
		 */
		function waitForNotVisible($locator)
		{
			echo $this->__getRow('waitForNotVisible', $locator);
		}

		/**
		 * Determines whether the specified input element is editable, ie hasn't been disabled. This method will fail if the specified element isn't an input element. 
		 * @param locator an element locator 
		 * @param variableName the name of a variable in which the result is to be stored. 
		 * @since 0.7
		*/
		function storeEditable($locator, $variableName)
		{
			echo $this->__getRow('storeEditable', $locator, $variableName);
		}

		/**
		 * Determines whether the specified input element is editable, ie hasn't been disabled. This method will fail if the specified element isn't an input element. 
		 * @param locator an element locator 
		 * @since 0.6
		 */
		function assertEditable($locator)
		{
			echo $this->__getRow('assertEditable', $locator);
		}
		
		/**
		 * Determines whether the specified input element is editable, ie hasn't been disabled. This method will fail if the specified element isn't an input element. 
		 * @param locator an element locator 
		 * @since 0.6
		 */
		function assertNotEditable($locator)
		{
			echo $this->__getRow('assertNotEditable', $locator);
		}

		/**
		 * Determines whether the specified input element is editable, ie hasn't been disabled. This method will fail if the specified element isn't an input element. 
		 * @param locator an element locator 
		 * @since 0.6
		 */
		function verifyEditable($locator)
		{
			echo $this->__getRow('verifyEditable', $locator);
		}
		
		/**
		 * Determines whether the specified input element is editable, ie hasn't been disabled. This method will fail if the specified element isn't an input element. 
		 * @param locator an element locator 
		 * @since 0.6
		 */
		function verifyNotEditable($locator)
		{
			echo $this->__getRow('verifyNotEditable', $locator);
		}

		/**
		 * Determines whether the specified input element is editable, ie hasn't been disabled. This method will fail if the specified element isn't an input element. 
		 * @param locator an element locator 
		 * @since 0.7
		 */
		function waitForEditable($locator)
		{
			echo $this->__getRow('waitForEditable', $locator);
		}
		
		/**
		 * Determines whether the specified input element is editable, ie hasn't been disabled. This method will fail if the specified element isn't an input element. 
		 * @param locator an element locator 
		 * @since 0.7
		 */
		function waitForNotEditable($locator)
		{
			echo $this->__getRow('waitForNotEditable', $locator);
		}

		/**
		 * Returns the IDs of all buttons on the page. 
		 * If a given button has no ID, it will appear as "" in this array.
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeAllButtons($variableName)
		{
			echo $this->__getRow('storeAllButtons', $variableName);
		}

		/**
		 * Returns the IDs of all buttons on the page. 
		 * If a given button has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function assertAllButtons($pattern)
		{
			echo $this->__getRow('assertAllButtons', $pattern);
		}
		
		/**
		 * Returns the IDs of all buttons on the page. 
		 * If a given button has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function assertNotAllButtons($pattern)
		{
			echo $this->__getRow('assertNotAllButtons', $pattern);
		}

		/**
		 * Returns the IDs of all buttons on the page. 
		 * If a given button has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function verifyAllButtons($pattern)
		{
			echo $this->__getRow('verifyAllButtons', $pattern);
		}
		
		/**
		 * Returns the IDs of all buttons on the page. 
		 * If a given button has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function verifyNotAllButtons($pattern)
		{
			echo $this->__getRow('verifyNotAllButtons', $pattern);
		}
		
		/**
		 * Returns the IDs of all buttons on the page. 
		 * If a given button has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function waitForAllButtons($pattern)
		{
			echo $this->__getRow('waitForAllButtons', $pattern);
		}
		
		/**
		 * Returns the IDs of all buttons on the page. 
		 * If a given button has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function waitForNotAllButtons($pattern)
		{
			echo $this->__getRow('waitForNotAllButtons', $pattern);
		}

		/**
		 * Returns the IDs of all links on the page. 
		 * If a given link has no ID, it will appear as "" in this array.
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeAllLinks($variableName)
		{
			echo $this->__getRow('storeAllLinks', $variableName);
		}

		/**
		 * Returns the IDs of all links on the page. 
		 * If a given link has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function assertAllLinks($pattern)
		{
			echo $this->__getRow('assertAllLinks', $pattern);
		}

		/**
		 * Returns the IDs of all links on the page. 
		 * If a given link has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function assertNotAllLinks($pattern)
		{
			echo $this->__getRow('assertNotAllLinks', $pattern);
		}

		/**
		 * Returns the IDs of all links on the page. 
		 * If a given link has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function verifyAllLinks($pattern)
		{
			echo $this->__getRow('verifyAllLinks', $pattern);
		}

		/**
		 * Returns the IDs of all links on the page. 
		 * If a given link has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function verifyNotAllLinks($pattern)
		{
			echo $this->__getRow('verifyNotAllLinks', $pattern);
		}

		/**
		 * Returns the IDs of all links on the page. 
		 * If a given link has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function waitForAllLinks($pattern)
		{
			echo $this->__getRow('waitForAllLinks', $pattern);
		}

		/**
		 * Returns the IDs of all links on the page. 
		 * If a given link has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function waitForNotAllLinks($pattern)
		{
			echo $this->__getRow('waitForNotAllLinks', $pattern);
		}

		/**
		 * Returns the IDs of all input fields on the page. 
		 * If a given field has no ID, it will appear as "" in this array.
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeAllFields($variableName)
		{
			echo $this->__getRow('storeAllFields', $variableName);
		}

		/**
		 * Returns the IDs of all input fields on the page. 
		 * If a given field has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function assertAllFields($pattern)
		{
			echo $this->__getRow('assertAllFields', $pattern);
		}

		/**
		 * Returns the IDs of all input fields on the page. 
		 * If a given field has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function assertNotAllFields($pattern)
		{
			echo $this->__getRow('assertNotAllFields', $pattern);
		}

		/**
		 * Returns the IDs of all input fields on the page. 
		 * If a given field has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function verifyAllFields($pattern)
		{
			echo $this->__getRow('verifyAllFields', $pattern);
		}

		/**
		 * Returns the IDs of all input fields on the page. 
		 * If a given field has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function verifyNotAllFields($pattern)
		{
			echo $this->__getRow('verifyNotAllFields', $pattern);
		}

		/**
		 * Returns the IDs of all input fields on the page. 
		 * If a given field has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function waitForAllFields($pattern)
		{
			echo $this->__getRow('waitForAllFields', $pattern);
		}

		/**
		 * Returns the IDs of all input fields on the page. 
		 * If a given field has no ID, it will appear as "" in this array.
		 * @param pattern
		 * @since 0.7
		*/
		function waitForNotAllFields($pattern)
		{
			echo $this->__getRow('waitForNotAllFields', $pattern);
		}

		/**
		 * Returns the entire HTML source between the opening and closing "html" tags. 
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeHtmlSource($variableName)
		{
			echo $this->__getRow('storeHtmlSource', $variableName);
		}

		/**
		 * Returns the entire HTML source between the opening and closing "html" tags. 
		 * @param pattern
		 * @since 0.7
		*/
		function assertHtmlSource($pattern)
		{
			echo $this->__getRow('assertHtmlSource', $pattern);
		}

		/**
		 * Returns the entire HTML source between the opening and closing "html" tags. 
		 * @param pattern
		 * @since 0.7
		*/
		function assertNotHtmlSource($pattern)
		{
			echo $this->__getRow('assertNotHtmlSource', $pattern);
		}

		/**
		 * Returns the entire HTML source between the opening and closing "html" tags. 
		 * @param pattern
		 * @since 0.7
		*/
		function verifyHtmlSource($pattern)
		{
			echo $this->__getRow('verifyHtmlSource', $pattern);
		}

		/**
		 * Returns the entire HTML source between the opening and closing "html" tags. 
		 * @param pattern
		 * @since 0.7
		*/
		function verifyNotHtmlSource($pattern)
		{
			echo $this->__getRow('verifyNotHtmlSource', $pattern);
		}

		/**
		 * Returns the entire HTML source between the opening and closing "html" tags. 
		 * @param pattern
		 * @since 0.7
		*/
		function waitForHtmlSource($pattern)
		{
			echo $this->__getRow('waitForHtmlSource', $pattern);
		}

		/**
		 * Returns the entire HTML source between the opening and closing "html" tags. 
		 * @param pattern
		 * @since 0.7
		*/
		function waitNotHtmlSource($pattern)
		{
			echo $this->__getRow('waitNotHtmlSource', $pattern);
		}

		/**
		 * Returns the specified expression. 
		 * This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and storeExpression.
		 * @param expression the value to return
		 * @param variableName the name of a variable in which the result is to be stored.
		 * @since 0.7
		*/
		function storeExpression($expression, $variableName)
		{
			echo $this->__getRow('storeExpression', $expression, $variableName);
		}

		/**
		 * Returns the specified expression. 
		 * This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and storeExpression.
		 * @param expression the value to return
		 * @param pattern
		 * @since 0.7
		*/
		function assertExpression($expression, $pattern)
		{
			echo $this->__getRow('assertExpression', $expression, $pattern);
		}

		/**
		 * Returns the specified expression. 
		 * This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and storeExpression.
		 * @param expression the value to return
		 * @param pattern
		 * @since 0.7
		*/
		function assertNotExpression($expression, $pattern)
		{
			echo $this->__getRow('assertNotExpression', $expression, $pattern);
		}

		/**
		 * Returns the specified expression. 
		 * This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and storeExpression.
		 * @param expression the value to return
		 * @param pattern
		 * @since 0.7
		*/
		function verifyExpression($expression, $pattern)
		{
			echo $this->__getRow('verifyExpression', $expression, $pattern);
		}

		/**
		 * Returns the specified expression. 
		 * This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and storeExpression.
		 * @param expression the value to return
		 * @param pattern
		 * @since 0.7
		*/
		function verifyNotExpression($expression, $pattern)
		{
			echo $this->__getRow('verifyNotExpression', $expression, $pattern);
		}

		/**
		 * Returns the specified expression. 
		 * This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and storeExpression.
		 * @param expression the value to return
		 * @param pattern
		 * @since 0.7
		*/
		function waitForExpression($expression, $pattern)
		{
			echo $this->__getRow('waitForExpression', $expression, $pattern);
		}

		/**
		 * Returns the specified expression. 
		 * This is useful because of JavaScript preprocessing. It is used to generate commands like assertExpression and storeExpression.
		 * @param expression the value to return
		 * @param pattern
		 * @since 0.7
		*/
		function waitForNotExpression($expression, $pattern)
		{
			echo $this->__getRow('waitForNotExpression', $expression, $pattern);
		}
				
		// private functions
		
		function __getRow($value1, $value2 = '&nbsp;', $value3 = '&nbsp;')
		{
		    $value2 = $this->__ieXpathFix($value2); 
		    $value3 = $this->__ieXpathFix($value3); 
			return '<tr><td>'.$value1.'</td><td>'.$value2.'</td><td>'.$value3.'</td></tr>';
		}

		
	    function __ieXpathFix($value)
	    {
            // Check if the value is ment to be an xpath	    
            if ((strpos($value, 'xpath=')===0) || (strpos($value, '//')===0))
            {
                $regex = "/id\('(.+)'\)/iUs";
                $replace = "//*[@id='\\1']";                
                
                $value = preg_replace($regex, $replace, $value);
                return $value;
            }
            else
                return $value; // If not return the value without modifications
	    }
	}
?>