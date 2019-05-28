<?php
namespace App\Models\Dices;

/**
 * Created by PhpStorm.
 * User: Lucky
 * Date: 27/10/2017
 * Time: 17:21
 */
class TiradaDado
{
	private $cola;
	private $tirada;
	public function __construct($texto)
	{
		$this->cola = [];
		$this->tirada = [];
		$cola = [];
		$cadena = $texto;
		$constructor = "";
		for($x = 0; $x < strlen($cadena); $x++) {
			$c = $cadena[$x];
			if($c == " ") continue;
			if($c == "+" OR $c == "-") {
				$cola[] = $constructor;
				$cola[] = $c;
				$constructor = "";
				continue;
			}
			$constructor .= $c;
		}
		$cola[] = $constructor;
		$this->cola = $cola;
		$this->formatear();
	}
	
	private function formatear()
	{
		foreach($this->cola as $item)
		{
			$output = $item;
			if($item[0] == "[") {
				$corchetes = ["[", "]"];
				$texto = str_replace($corchetes, "", $item);
				$pack = explode("d", $texto);
				$this->tirada[] = new Dado($pack[0], $pack[1]);;
				continue;
			}
			if(is_numeric($item)) {
				$this->tirada[] = new Modificador($item);
				continue;
			}
			if(strpos($item, ":") !== false) {
				$pack = explode(":", $item);
				$this->tirada[] = new Modificador($pack[0], $pack[1]);
				continue;
			}
			$this->tirada[] = $item;
			
		}
	}
	
	public function getTira()
	{
		$pila = new Stack;
		$texto = [];
		foreach($this->tirada as $t) {
			$num = $t;
			if($t instanceof Dado)
				$texto[] = "[".$t->getValor()."]";
			else if($t instanceof Modificador)
				$texto[] = "".$t->getValor()."";
			else
				$texto[] = $t;
			
			if($t instanceof Valor) {
				$num = $t->getValor();
				if(!$pila->isEmpty()) {
					$operador = $pila->pop();
					if ($operador == "+")
						$pila->push(new Modificador($pila->pop()->getValor() + $t->getValor()));
					if ($operador == "-")
						$pila->push(new Modificador($pila->pop()->getValor() - $t->getValor()));
					continue;
				}
			}
			$pila->push($t);
		}
		$total = $pila->top()->getValor();
		return implode(" ", $texto) . " = " . $total;
	}
}