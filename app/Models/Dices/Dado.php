<?php
namespace App\Models\Dices;
/**
 * Created by PhpStorm.
 * User: Lucky
 * Date: 27/10/2017
 * Time: 18:06
 */
class Dado extends Valor
{
	public $cantidad;
	public $dados;
	public $valor;
	
	public function __construct($cantidad, $dados, $descripcion = "")
	{
		$tirada = 0;
		$this->cantidad = $cantidad;
		$this->dados = $dados;
		$this->descripcion = $descripcion;
		
		for($x = 0; $x < $this->cantidad; $x++)
		{
			$tirada += rand(1, $this->dados);
		}
		$this->valor = $tirada;
	}
	
	public function getValor() : int {
		
		return $this->valor;
	}
}