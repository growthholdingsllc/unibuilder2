<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
			<?php
			$hostname = "mail.ttkservices.com";
			$port = '993';
			$username = "ittesting@ttkservices";
			$password = "12345678";
			$mailType = "imap";
			
			$mailBox = imap_open ("{" . $hostname .":" . $port . "/" . $mailType . "/ssl/novalidate-cert}", $username, $password);
			?>
	</body>
</html>
