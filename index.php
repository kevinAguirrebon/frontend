<?php
	session_start();
	$_SESSION['usuario'] = ['User_directory'=>"cicprac",'PKUsuario' => 'kevin'];
	require_once 'core/configGeneral.php';
	include_once 'controllers/vistasControlador.php';
	$plantilla = new vistasControlador();
	$plantilla->obtener_plantilla_controlador();