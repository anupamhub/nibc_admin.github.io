<?php
session_start();
	require_once 'functions.php';
	require_once 'config.php';
if(session_destroy()){
	header('location:login.php');
}
 ?>
