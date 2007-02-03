<p>Dear Registry user,</p>
 
<p>A request for <?php echo $mail->getSubject() ?> was sent to this address.</p>
 
<p>For safety reasons, the Registry website does not store passwords in clear.
When you forget your password, Registry creates a new one that can be used in place.</p>
 
<p>You can now connect to your Registry profile with:</p>
 
<p>
login name: <strong><?php echo $nickname ?></strong><br/>
  password: <strong><?php echo $password ?></strong>
</p>
 
<p>To get connected, go to the <?php echo link_to('login page', '@login') ?>
and enter these codes.</p>
 
<p>We hope to see you soon on <img src="cid:CID1" /></p>
 
<p>The Registry email robot</p>