<?php
namespace App\Models\Dices;

/**
 * Created by PhpStorm.
 * User: Lucky
 * Date: 27/10/2017
 * Time: 18:06
 */
class Modificador extends Valor
{
	public $numero;
	
	public function __construct($numero, $descripcion = "")
	{
		$this->numero = $numero;
		$this->descripcion = $descripcion;
	}
	
	public function getValor() : int {
		return $this->numero;
	}
	

}