<?php
	session_start();
	require_once 'Host.php';
	$host = new HostController();
	$result=$host->searchData($_GET['t1'],$_GET['t2']);
?>