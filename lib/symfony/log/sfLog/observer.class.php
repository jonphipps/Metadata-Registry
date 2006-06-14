<?php
/**
 * $Header: /repository/pear/sfLog/sfLog/observer.php,v 1.12 2004/01/11 20:49:49 jon Exp $
 * $Horde: horde/lib/sfLog/observer.php,v 1.5 2000/06/28 21:36:13 jon Exp $
 *
 * @version $Revision$
 * @package sfLog
 */

/**
 * The sfLog_observer:: class implements the Observer end of a Subject-Observer
 * pattern for watching log activity and taking actions on exceptional events.
 *
 * @author  Chuck Hagenbuch <chuck@horde.org>
 * @since   Horde 1.3
 * @since   sfLog 1.0
 * @package sfLog
 */
class sfLog_observer
{
    /**
     * Instance-specific unique identification number.
     *
     * @var integer
     * @access private
     */
    var $_id = 0;

    /**
     * The minimum priority level of message that we want to hear about.
     * SF_PEAR_LOG_EMERG is the highest priority, so we will only hear messages
     * with an integer priority value less than or equal to ours.  It defaults
     * to SF_PEAR_LOG_INFO, which listens to everything except SF_PEAR_LOG_DEBUG.
     *
     * @var string
     * @access private
     */
    var $_priority = SF_PEAR_LOG_INFO;

    /**
     * Creates a new basic sfLog_observer instance.
     *
     * @param integer   $priority   The highest priority at which to receive
     *                              log event notifications.
     *
     * @access public
     */
    function sfLog_observer($priority = SF_PEAR_LOG_INFO)
    {
        $this->_id = md5(microtime());
        $this->_priority = $priority;
    }

    /**
     * Attempts to return a new concrete sfLog_observer instance of the requested
     * type.
     *
     * @param string    $type       The type of concreate sfLog_observer subclass
     *                              to return.
     * @param integer   $priority   The highest priority at which to receive
     *                              log event notifications.
     * @param array     $conf       Optional associative array of additional
     *                              configuration values.
     *
     * @return object               The newly created concrete sfLog_observer
     *                              instance, or an false on an error.
     */
    function &factory($type, $priority = SF_PEAR_LOG_INFO, $conf = array())
    {
        $type = strtolower($type);
        $class = 'sfLog_observer_' . $type;

        /* Support both the new-style and old-style file naming conventions. */
        if (file_exists(dirname(__FILE__) . '/observer_' . $type . '.php')) {
            $classfile = 'sfLog/observer_' . $type . '.php';
            $newstyle = true;
        } else {
            $classfile = 'sfLog/' . $type . '.php';
            $newstyle = false;
        }

        /* Issue a warning if the old-style conventions are being used. */
        if (!$newstyle)
        {
            trigger_error('Using old-style sfLog_observer conventions',
                          E_USER_WARNING);
        }

        /*
         * Attempt to include our version of the named class, but don't treat
         * a failure as fatal.  The caller may have already included their own
         * version of the named class.
         */
        @include_once $classfile;

        /* If the class exists, return a new instance of it. */
        if (class_exists($class)) {
            /* Support both new-style and old-style construction. */
            if ($newstyle) {
                return new $class($priority, $conf);
            } else {
                return new $class($priority);
            }
        }

        return false;
    }

    /**
     * This is a stub method to make sure that sfLog_Observer classes do
     * something when they are notified of a message.  The default behavior
     * is to just print the message, which is obviously not desireable in
     * practically any situation - which is why you need to override this
     * method. :)
     *
     * @param array     $event      A hash describing the log event.
     */
    function notify($event)
    {
        print_r($event);
    }
}
