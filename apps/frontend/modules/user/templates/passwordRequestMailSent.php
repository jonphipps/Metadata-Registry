<div id="sf_admin_container">
<div id="login_div">
<h1><?php echo __s('Confirmation - login information sent') ?></h1>

<p><br /><?php echo __s('Your login information was sent to') ?></p>
<p><?php echo $sf_request->getParameter('email') ?></p>
<p><?php echo __s('You should receive it shortly, so you can proceed to the %1%.', array('%1%' => sf_link_to(__s('login page'),'@login'))) ?></p>
</div>
</div>
