
<html>
<title>User Activation Link</title>
<head>

</head>
<body>
<div style="-moz-box-shadow:inset 0 0 10px #000066;-webkit-box-shadow: inset 0 0 10px #000066;box-shadow:inset 0 0 10px #000066;padding: 20px;border: 1px solid #000066;border-radius: 5px 5px 5px 5px;line-height: 26px;width: 80%;">
    <div style="background-color: #f5f5f5;margin-bottom: 10px;"><img style="margin: 3px 0px 3px 10px;" src="<?php echo $logo; ?>"/></div>
    <b>Welcome <?php echo $user_email.","; ?><br /></b>
    <div style="margin: 20px 0px 0px 30px;">
        Confirm your subscription <a href="<?php echo $activation_key; ?>">Confirm<br /> </a>
        If above Link is not working then copy below url and paste it in your browser to activate your account.
        <b><br /><?php echo $activation_key; ?><br /><br /><br /></b> 
        <h2> Your Account Created Successfully. </h2>
	   <h3> Enjoy the no5ive services. </h3>
    </div>
    <div>
        Thanks,<br />
        No5ive Team
    </div>
</div>
</body>
</html>