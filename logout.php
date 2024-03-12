<?php
	session_start();
		if($_SESSION['TYPE']=="CUSTOMER")
		{
			session_destroy();
			unset($_SESSION['TYPE']);
			header("Location: login.php");
		}
		else if($_SESSION['TYPE']=="ADMIN")
		{
			session_destroy();
			unset($_SESSION['TYPE']);
			header("Location: index.php");
		}
?>