<?php
require_once '../core/configAPP.php';
class mainModel
{
	public function conectar()
	{
		$enlace = new PDO(SGBD, USER, PASS);
		return $enlace;
	}

	public function conectarsqlsrv()
	{
		try {
			$enlace = new PDO(SGBDSRV, USERSRV, PASSSRV);
			return $enlace;
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}

}
