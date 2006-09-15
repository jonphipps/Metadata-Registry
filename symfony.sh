#!/bin/sh
#
# Shell wrapper for symfony (based on Phing shell wrapper)
# $Id: symfony.sh 1885 2006-08-30 16:17:14Z fabien $
#
# This script will do the following:
# - check for PHP_COMMAND env, if found, use it.
#   - if not found assume php is on the path
# - check for SYMFONY_HOME env, if found use it
#   - if not found, use a sensible default

if [ -z "$PHP_COMMAND" ] ; then
  PHP_COMMAND=php
fi

if [ -z "$SYMFONY_HOME" ] ; then
  SYMFONY_HOME="@DATA-DIR@/symfony"
fi

if [ -d "$SYMFONY_HOME" ] ; then
  COMMAND=$SYMFONY_HOME/bin/symfony.php
else
  COMMAND=`dirname $0`/symfony.php
fi

$PHP_COMMAND -d html_errors=off $COMMAND $*
