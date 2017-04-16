<?php

namespace Commons;
/**
* SituacaoProdutoEstoque de Produto em estoque
*/
class SituacaoProdutoEstoque
{

	public static function optionSemEstoque($situacao='')
	{

		$option = '';
		//array de disponiblidade de produto
		$array_value = array('-1',0,1,2,3,4,5,6,7,8,9,10,15,20,25,30,45,60,90);

		foreach ($array_value  as $key => $value) {

			switch ($value) {

				case '-1':

					if (!(strcmp("-1", $situacao)))
						$option .= '<option value="-1" selected="selected">Tornar o produto indisponível</option>'. PHP_EOL;
					else {
						$option .= '<option value="-1">Tornar o produto indisponível</option>'. PHP_EOL;
					}
					break;

				case 0:

					if (!(strcmp(0, $situacao)))
						$option .= '<option value="0" selected="selected">Continuar vendendo normalmente</option>'. PHP_EOL;
					else {
						$option .= '<option value="0">Continuar vendendo normalmente</option>'. PHP_EOL;
					}
					break;

				case 1:

					if (!(strcmp(1, $situacao)))
						$option .= '<option value="1" selected="selected">Mudar a disponibilidade para 1 dia útil</option>'. PHP_EOL;
					else {
						$option .= '<option value="1">Mudar a disponibilidade para 1 dia útil</option>'. PHP_EOL;
					}
					break;

				default:

					if (!(strcmp($value, $situacao)))
						$option .= sprintf('<option value="%d" selected="selected">Mudar a disponibilidade para %d dias úteis</option>', $value, $value) . PHP_EOL;
					else {
						$option .= sprintf('<option value="%d">Mudar a disponibilidade para %d dias úteis</option>', $value, $value) . PHP_EOL;
					}
					break;
			}

		}

		return $option;

	}

	public static function optionEmEstoque($situacao='')
	{

		//array de disponiblidade de produto
		$array_value = array(0,1,2,3,4,5,6,7,8,9,10,15,20,25,30,45,60,90);

		$option = '';

		foreach ($array_value  as $key => $value) {

			switch ($value) {
				case 0:

					if (!(strcmp(0, $situacao)))
						$option .= '<option value="0" selected="selected">Disponibilidade imediata</option>'. PHP_EOL;
					else {
						$option .= '<option value="0">Disponibilidade imediata</option>'. PHP_EOL;
					}
					break;

				case 1:

					if (!(strcmp(1, $situacao)))
						$option .= '<option value="1" selected="selected">Disponibilidade para 1 dia útil</option>'. PHP_EOL;
					else {
						$option .= '<option value="1">Disponibilidade para 1 dia útil</option>'. PHP_EOL;
					}
					break;

				default:

					if (!(strcmp($value, $situacao)))
						$option .= sprintf('<option value="%d" selected="selected">Disponibilidade para %d dias úteis</option>', $value, $value) . PHP_EOL;
					else {
						$option .= sprintf('<option value="%d">Disponibilidade para %d dias úteis</option>', $value, $value) . PHP_EOL;
					}
					break;
			}

		}

		return $option;

	}


	public static function disponibilidade($situacao='')
	{

		//array de disponiblidade de produto
		$array_value = array(0,1,2,3,4,5,6,7,8,9,10,15,20,25,30,45,60,90);

		foreach ($array_value  as $key => $value) {

			switch ($value) {
				case 0:

					if (!(strcmp(0, $situacao)))
						return '<strong>Disponibilidade:</strong> imediata'. PHP_EOL;
					break;

				case 1:

					if (!(strcmp(1, $situacao)))
						return '<strong>Disponibilidade:</strong> para 1 dia útil'. PHP_EOL;
					break;

				default:

					if (!(strcmp($value, $situacao)))
						return sprintf('<strong>Disponibilidade:</strong> para %d dias úteis', $value) . PHP_EOL;
					break;

			}

		}

		return $option;

	}

}
