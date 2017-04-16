<?php

namespace Vendor\Email\Shopping;
use Lib\Entity as Entity;

class ContatoLoja extends Entity
{
	
	protected $nomeResponsavel;
    protected $nome;
    protected $email;
    protected $telefone;
    protected $pedido;
    protected $mensagem;
	
    protected $html;

    /**
     * @return string
     */
    public function template()
	{

		//ENVIA O EMAIL PARA O SITE
		$this->html = "
		<html>
		<body>
		<font color='#003399' size='4' face='Arial, Helvetica, sans-serif'>Contato no site - ". env('HTTP_HOST') ."</font><br /><br />
		 
		<b>". mb_strtoupper( $this->nomeResponsavel ) ."</b><br />
		Este e-mail foi enviado através de formulário do site, para entrar em contato com o cliente, use os dados abaixo:<br /><br />
		----------------------------------------------------------<br />

		Nome: <b>". $this->nome ."</b><br /><br />
		Email: <b>". $this->email ."</b><br /><br />
		Telefone: <b>". $this->telefone ."</b><br /><br />
		Pedido: <b>". $this->pedido ."</b><br /><br />
		Descrição: <b>". nl2br( $this->mensagem ) ."</b><br /><br />		

		----------------------------------------------------------<br /><br />
		<font color='#666666' size='1' face='verdana, Arial, Helvetica, sans-serif'>																		
		Atenciosamente,<br />
		Equipe ViaLoja.com<br />
		IP de origem: ". getenv("REMOTE_ADDR") ."<br />
		Emitido: ". date("d/m/Y H:i:s") ."
		</font>
		</body>
		</html>";
		
		return $this->html;
	
	}

}
