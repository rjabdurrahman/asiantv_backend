<?php 
if(!isset($_SERVER['PHP_AUTH_USER'])){
	header("WWW-Authenticate: Basic realm=\"Private Area\"");
	header("HTTP/1.0 401 Unauthorized");
	print("sorry you need proper credentials");
	exit;
}