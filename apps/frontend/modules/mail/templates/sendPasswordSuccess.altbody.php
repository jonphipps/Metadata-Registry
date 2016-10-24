Dear Registry user,

A request for <?php echo $mail->getSubject() ?> was sent to this address.

For safety reasons, the Registry website does not store unencrypted passwords.
When you forget your password, the Registry assigns you a new one..

You can now connect to your Registry profile with:

login name: <?php echo $nickname ?>
  password: <?php echo $password ?>

To get connected, go to the login page (<?php echo url_for('@login', true) ?>).

We hope to see you soon on The Registry!

The Registry email robot
