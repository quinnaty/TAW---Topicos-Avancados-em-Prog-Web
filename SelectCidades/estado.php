<?php

/**
* 
*/
require_once 'conexao.php';
$conn=$conn;
class Estado 
{
	public $conn;
	public function __construct($conn){
		$this->conn=$conn;
	}
	public function get_estado(){
		$estado= $this->conn->query('SELECT * FROM estado');
		$estado= $estado->fetchAll(PDO::FETCH_ASSOC);
		echo"<pre>";
		var_dump($estado);
	}
}
$opition = new Estado($conn);
$opition->get_estado();