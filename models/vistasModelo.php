<?php
class vistasModelo
{
	protected function obtener_vistas_modelo($vistas)
	{
		$Lista_Blanca = ["home", "conductores","alineacion","camiones","conductores","rutas","viajes","lista"];

		if (in_array($vistas, $Lista_Blanca)) {
			$url = "./views/contenidos/" . $vistas . "-view.php";
			if (is_file($url)) {
				$contenido = $url;
			} else {
				$contenido = "home";
			}
		} elseif ($vistas == "login" || $vistas == "forgotPassword") {
			if ($vistas == "login") {
				$contenido = "home";
			} else {
				$contenido = "forgotPassword";
			}
		} elseif ($vistas == "index") {
			$contenido = "home";
		} else {
			$contenido = "404";
		}
		return $contenido;
	}
}
