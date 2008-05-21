<p>Dear Registry user,</p>

<p>A request for <?php echo $mail->getSubject() ?> was sent to this address.</p>

<p>For safety reasons, the Registry website does not store unencrypted passwords.
When you forget your password, the Registry creates a new one.</p>

<p>You can now connect to your Registry profile with:</p>

<p>
login name: <strong><?php echo $nickname ?></strong><br/>
  password: <strong><?php echo $password ?></strong>
</p>

<p>To get connected, go to the <?php echo link_to('Registry login page', rtrim(sfConfig::get('app_base_domain') ," /") . '/login.html') ?>.</p>

<p>We hope to see you soon on the <?php echo link_to('Registry!', '@homepage') ?></p>

<p>The Registry email robot</p>