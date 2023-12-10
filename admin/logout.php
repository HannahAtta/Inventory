<?php

	session_start(); // Start The Session

	session_unset(); // Unset The Data  $_SESSION = array();

	session_destroy(); // Destory The Session تحطيم
	
	header('Location: index.php');

	exit();