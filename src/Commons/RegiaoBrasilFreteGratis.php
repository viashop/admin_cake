<?php

namespace Commons;

class RegiaoBrasilFreteGratis
{

	/**
	 *
	 * Região Norte – 07 estados
	 *
	 * 1 - Amazonas (AM) = Manaus
	 * 2- Roraima (RR) = Boa Vista
	 * 3- Amapá (AP) = Macapá
	 * 4- Pará (PA) = Belém
	 * 5- Tocantins (TO) = Palmas
	 * 6- Rondônia (RO) = Porto Velho
	 * 7- Acre (AC) = Rio Branco
	 *
	 * Região Nordeste – 09 estados
	 *
	 * 8-Maranhão (MA) = São Luiz
	 * 9- Piauí (PI) = Teresina
	 * 10- Ceará (CE) = Fortaleza
	 * 11- Rio Grande do Norte (RN) = Natal
	 * 12- Pernambuco (PE) = Recife
	 * 13- Paraíba (PB) = João Pessoa
	 * 14- Sergipe (SE) = Aracaju
	 * 15- Alagoas (AL) = Maceió
	 * 16- Bahia (BA) = Salvador
	 *
	 * Região Centro-Oeste – 03 estados
	 *
	 * 24- Mato Grosso (MT) = Cuiabá
	 * 25- Mato Grosso do Sul (MS) = Campo Grande
	 * 26- Goiás (GO) = Goiânia	 *
	 *
	 * Região Sudeste – 04 estados
	 *
	 * 17- São Paulo (SP) = São Paulo
	 * 18- Rio de Janeiro (RJ) = Rio de Janeiro
	 * 19- Espírito Santo (ES) = Vitória
	 * 20- Minas Gerais (MG) = Belo Horizonte
	 *
	 * Região Sul – 03 estados
	 *
	 * 21- Paraná (PR) = Curitiba
	 * 22- Rio Grande do Sul (RS) = Porto Alegre
	 * 23- Santa Catarina (SC) = Florianópolis
	 *
	 */

	public function regiaoEstado($uf='')
	{
		switch ($uf) {

			/**
			 * Região Norte – 07 estados
			 */
			case 'AM':
			case 'RR':
			case 'AP':
			case 'PA':
			case 'TO':
			case 'RO':
			case 'AC':
				return 'norte';
				break;


			/**
			 * Região Nordeste – 09 estados
			 */
			case 'MA':
			case 'PI':
			case 'CE':
			case 'RN':
			case 'PE':
			case 'PB':
			case 'SE':
			case 'AL':
			case 'BA':
				return 'nordeste';
				break;


			/**
			 * Região Centro-Oeste – 03 estados
			 */
			case 'MT':
			case 'MS':
			case 'GO':
				return 'centro_oeste';
				break;


			/**
			 * Região Sudeste – 04 estados
			 */
			case 'SP':
			case 'RJ':
			case 'ES':
			case 'MG':
				return 'sudeste';
				break;


			/**
			 * Região Sul – 03 estados
			 */
			case 'PR':
			case 'RS':
			case 'SC':
				return 'sul';
				break;

			default:
				return false;
				break;
		}

	}

}
