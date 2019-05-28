<?php
namespace App\Models\Dices;

/**
 * Created by PhpStorm.
 * User: Lucky
 * Date: 27/10/2017
 * Time: 18:25
 */
abstract class Valor
{
	protected $descripcion;
	
	public abstract function getValor() : int;
	
	public function getDesc() : string {
		return $this->descripcion;
	}
	
	public function hasDesc() : bool {
		return $this->descripcion != "";
	}
}