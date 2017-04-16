<?php

App::uses('AppController', 'Controller');

class CriarContaController extends AppController {

	public $layout = 'ajax';

	public function index() {

		echo '{"hasError":true,"errors":["Uma conta usando o endereço de email já foi registrado. Por favor, insira uma senha válida ou solicitar um novo. "],"page":"<h1 class=\"page-heading\">Autentica&ccedil;&atilde;o<\/h1>\n\n\n\t<!---->\n\t<div class=\"row\">\n\t\t<div class=\"col-xs-12 col-sm-6\">\n\t\t\t<form action=\"http:\/\/demo4leotheme.com\/prestashop\/leo_shopping\/br\/login\" method=\"post\" id=\"create-account_form\" class=\"box\">\n\t\t\t\t<h3 class=\"page-subheading\">Criar uma conta<\/h3>\n\t\t\t\t<div class=\"form_content clearfix\">\n\t\t\t\t\t<p>Informe o seu e-mail para cadastro<\/p>\n\t\t\t\t\t<div class=\"alert alert-danger\" id=\"create_account_error\" style=\"display:none\"><\/div>\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"email_create\">E-mail<\/label>\n\t\t\t\t\t\t<input type=\"text\" class=\"is_required validate account_input form-control\" data-validate=\"isEmail\" id=\"email_create\" name=\"email_create\" value=\"\" \/>\n\t\t\t\t\t<\/div>\n\t\t\t\t\t<div class=\"submit\">\n\t\t\t\t\t\t<input type=\"hidden\" class=\"hidden\" name=\"back\" value=\"my-account\" \/>\t\t\t\t\t\t<button class=\"btn btn-outline button button-medium exclusive\" type=\"submit\" id=\"SubmitCreate\" name=\"SubmitCreate\">\n\t\t\t\t\t\t\t<span>\n\t\t\t\t\t\t\t\t<i class=\"fa fa-user left\"><\/i>&nbsp;\n\t\t\t\t\t\t\t\tCriar uma conta\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/button>\n\t\t\t\t\t\t<input type=\"hidden\" class=\"hidden\" name=\"SubmitCreate\" value=\"Criar uma conta\" \/>\n\t\t\t\t\t<\/div>\n\t\t\t\t<\/div>\n\t\t\t<\/form>\n\t\t<\/div>\n\t\t<div class=\"col-xs-12 col-sm-6\">\n\t\t\t<form action=\"http:\/\/demo4leotheme.com\/prestashop\/leo_shopping\/br\/login\" method=\"post\" id=\"login_form\" class=\"box\">\n\t\t\t\t<h3 class=\"page-subheading\">J&aacute; tem cadastro?<\/h3>\n\t\t\t\t<div class=\"form_content clearfix\">\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"email\">E-mail<\/label>\n\t\t\t\t\t\t<input class=\"is_required validate account_input form-control\" data-validate=\"isEmail\" type=\"text\" id=\"email\" name=\"email\" value=\"wsduarte@outlook.com.br\" \/>\n\t\t\t\t\t<\/div>\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"passwd\">Senha<\/label>\n\t\t\t\t\t\t<span><input class=\"is_required validate account_input form-control\" type=\"password\" data-validate=\"isPasswd\" id=\"passwd\" name=\"passwd\" value=\"\" \/><\/span>\n\t\t\t\t\t<\/div>\n\t\t\t\t\t<p class=\"lost_password form-group\"><a href=\"http:\/\/demo4leotheme.com\/prestashop\/leo_shopping\/br\/password-recovery\" title=\"Recuperar sua senha\" rel=\"nofollow\">Esqueceu sua senha?<\/a><\/p>\n\t\t\t\t\t<p class=\"submit\">\n\t\t\t\t\t\t<input type=\"hidden\" class=\"hidden\" name=\"back\" value=\"my-account\" \/>\t\t\t\t\t\t<button type=\"submit\" id=\"SubmitLogin\" name=\"SubmitLogin\" class=\"button btn btn-outline button-medium\">\n\t\t\t\t\t\t\t<span>\n\t\t\t\t\t\t\t\t<i class=\"fa fa-lock left\"><\/i>&nbsp;\n\t\t\t\t\t\t\t\tEntrar\n\t\t\t\t\t\t\t<\/span>\n\t\t\t\t\t\t<\/button>\n\t\t\t\t\t<\/p>\n\t\t\t\t<\/div>\n\t\t\t<\/form>\n\t\t<\/div>\n\t<\/div>\n\t","token":"c0b3b2573da6513d5d166afa8159f33b"}';


		//pr($_POST);

		$this->render(false);

	}

}
