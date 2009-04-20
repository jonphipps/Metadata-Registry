/*
 (C) Copyright MetaCommunications, Inc. 2006.
     http://www.meta-comm.com
     http://engineering.meta-comm.com
*/

// Labels for gotoLabel
var gotoLabels = null;
// Array for DoWhile return points (stacked to support inherited DoWhile's)
var lastWhile = new Array();
var forceNextCommandRow = 0;


// Modified to initialize GoTo labels list
function startTest() {
    startTime = (new Date()).getTime();
    removeLoadListener(getTestFrame(), startTest);

    // Scroll to the top of the test frame
    if (getTestFrame().contentWindow) {
        getTestFrame().contentWindow.scrollTo(0,0);
    }
    else {
        frames['testFrame'].scrollTo(0,0);
    }

    inputTable = getIframeDocument(getTestFrame()).getElementsByTagName("table")[0];
    inputTableRows = inputTable.rows;
    currentCommandRow = 0;
    testFailed = false;
    storedVars = new Object();
    /// ADDITION START
    gotoLabels = initialiseGotoLabels();
    lastWhile = new Array();
    /// ADDITION END

    clearRowColours();

    testLoop = initialiseTestLoop();
    testLoop.start();
}


// initializes GoTo labels
function initialiseGotoLabels() {
    var labels = new Array();
    for (var i = 1; i <= inputTableRows.length - 1; i++) {
        if (getText(inputTableRows[i].cells[0]) == 'label')
            {
            labels[getText(inputTableRows[i].cells[1])] = i;
            }
    }
    return labels;
}


// do nothing: this is just a label
Selenium.prototype.doLabel = function() {
};


Selenium.prototype.doGotolabel = gotoLabel;

Selenium.prototype.doGotoIf = function( condition, label ) {
    if( eval(condition) ) {
        gotoLabel( label )
        }
    }

// sets current command row to row labeled with [label]
function gotoLabel( label ) {
    if( gotoLabels[label])
        {
        setRowPassed();
        currentCommandRow=gotoLabels[label];
        commandStarted();
//        setRowPassed();
        }
    else
        {
        throw new Error("Specified label " + label + " not found.");
        }
};


// if next assert not fails: goto [label]
// if next assert fails with [message]: continue execution (expected failure)
// if next assert fails with message other than [message]: fail test.
Selenium.prototype.assertNoFailureOnNextAndGoto = function(message, label) {
    if (!message) {
        throw new Error("Message must be provided");
    }

    var expectFailureAndGotoCommandFactory =
        new ExpectFailureAndGotoCommandFactory(testLoop.commandFactory, message, label);
    expectFailureAndGotoCommandFactory.baseExecutor = executeCommandAndReturnFailureMessage;
    testLoop.commandFactory = expectFailureAndGotoCommandFactory;
};


// if next assert returns no error: goto [label]
// if next assert returns error [message]: continue execution (expected error)
// if next assert returns error other than [message]: fail test.
Selenium.prototype.assertNoErrorOnNextAndGoto = function(message, label) {
    if (!message) {
        throw new Error("Message must be provided");
    }

    var expectFailureAndGotoCommandFactory =
        new ExpectFailureAndGotoCommandFactory(testLoop.commandFactory, message, label);
    expectFailureAndGotoCommandFactory.baseExecutor = executeCommandAndReturnErrorMessage;
    testLoop.commandFactory = expectFailureAndGotoCommandFactory;
};


// builds seleniun command factory to support assertNoError/FailureOnNextAndGoto()'s
function ExpectFailureAndGotoCommandFactory(originalCommandFactory, expectedErrorMessage, label) {
    this.getCommandHandler = function(name) {
        var baseHandler = originalCommandFactory.getCommandHandler(name);
        var baseExecutor = this.baseExecutor;
        var expectFailureCommand = {};
        expectFailureCommand.execute = function() {
            var baseFailureMessage = baseExecutor(baseHandler, arguments);
            var result = new CommandResult();
            if (!baseFailureMessage) {
                result.passed = true;
                result.result = baseFailureMessage;
//                result.failed = true;
//                result.failureMessage = "Command should have failed.";
                gotoLabel(label);
            }
            else {
                if (baseFailureMessage != expectedErrorMessage) {
                    result.failed = true;
                    result.failureMessage = "Expected failure message '" + expectedErrorMessage
                                            + "' but was '" + baseFailureMessage + "'";
                    throw new Error(result.failureMessage);
                }
                else {
                    result.passed = true;
                    result.result = baseFailureMessage;
                }
            }
            testLoop.commandFactory = originalCommandFactory;
            return result;
        };
        return expectFailureCommand;
    };
};


// "do while" loop
// executes commands up to endWhile while [condition] = true
Selenium.prototype.doWhile = function( condition )
    {
    if( !eval(condition) )
        {
        skipWhile();
        }
    else
        {
        lastWhile.push( currentCommandRow );
        }
    }


// EndWhile command marks end of DoWhile loop
Selenium.prototype.doEndWhile = function()
    {
    if( lastWhile.length != 0 )
        {
        currentCommandRow=lastWhile.pop() - 1;
        }
    else
        {
        throw new Error("unexpected endWhile");
        }
    }


// skips commands up to endWhile (if DoWhile [condition] != true)
function skipWhile()
    {
    var i = currentCommandRow + 1;
    var done=0;
    var text;
    while( done<=0 )
        {
        text = getText(inputTableRows[i].cells[0]).toLowerCase();
        switch( text )
            {
            case 'while':
                done--;
                break;
            case 'endwhile':
                done++;
                break;
            }
        i++;
        if( i >= inputTableRows.length )
            {
            throw new Error("endWhile Not Found");
            }
        }
    setRowPassed();
    currentCommandRow = i - 1;
    }
