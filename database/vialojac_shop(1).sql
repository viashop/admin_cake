/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50716
Source Host           : localhost:3306
Source Database       : vialojac_shop

Target Server Type    : MYSQL
Target Server Version : 50716
File Encoding         : 65001

Date: 2016-11-17 01:35:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bancos
-- ----------------------------
DROP TABLE IF EXISTS `bancos`;
CREATE TABLE `bancos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` char(3) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `logo` varchar(45) NOT NULL,
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bancos
-- ----------------------------
INSERT INTO `bancos` VALUES ('1', '001', 'Banco do Brasil', 'banco-bb-logo', '1');
INSERT INTO `bancos` VALUES ('2', '341', 'Banco Itaú', 'banco-itau-logo', '1');
INSERT INTO `bancos` VALUES ('3', '237', 'Bradesco', 'banco-bradesco-logo', '1');
INSERT INTO `bancos` VALUES ('4', '104', 'Caixa Econômica', 'banco-caixa-logo', '1');
INSERT INTO `bancos` VALUES ('5', '477', 'CitiBank', 'banco-citi-logo', '1');
INSERT INTO `bancos` VALUES ('6', '399', 'HSBC', 'banco-hsbc-logo', '1');
INSERT INTO `bancos` VALUES ('7', '033', 'Santander', 'banco-santander-logo', '1');
INSERT INTO `bancos` VALUES ('8', '756', 'SICOOB', 'banco-sicoob-logo', '1');
INSERT INTO `bancos` VALUES ('9', '748', 'SICREDI', 'banco-sicredi-logo', '1');

-- ----------------------------
-- Table structure for bancos_configuracao
-- ----------------------------
DROP TABLE IF EXISTS `bancos_configuracao`;
CREATE TABLE `bancos_configuracao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_banco` tinyint(3) NOT NULL DEFAULT '104',
  `numero_operacao` tinyint(3) NOT NULL,
  `nome_operacao` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bancos_configuracao
-- ----------------------------
INSERT INTO `bancos_configuracao` VALUES ('1', '104', '1', 'Conta Corrente de Pessoa Física', '1');
INSERT INTO `bancos_configuracao` VALUES ('2', '104', '2', 'Conta Simples de Pessoa Física', '1');
INSERT INTO `bancos_configuracao` VALUES ('3', '104', '3', 'Conta Corrente de Pessoa Jurídica', '1');
INSERT INTO `bancos_configuracao` VALUES ('4', '104', '6', 'Entidades Públicas', '1');
INSERT INTO `bancos_configuracao` VALUES ('5', '104', '7', 'Depósitos Instituições Financeiras', '1');
INSERT INTO `bancos_configuracao` VALUES ('6', '104', '13', 'Poupança de Pessoa Física', '1');
INSERT INTO `bancos_configuracao` VALUES ('7', '104', '22', 'Poupança de Pessoa Jurídica', '1');
INSERT INTO `bancos_configuracao` VALUES ('8', '104', '28', 'Poupança de Crédito Imobiliário', '1');
INSERT INTO `bancos_configuracao` VALUES ('9', '104', '43', 'Depósitos Lotéricos', '1');

-- ----------------------------
-- Table structure for banner_local
-- ----------------------------
DROP TABLE IF EXISTS `banner_local`;
CREATE TABLE `banner_local` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `pagina_publicacao` enum('todas','pagina','busca','produto','marca','categoria','pagina_inicial') NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`,`pagina_publicacao`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banner_local
-- ----------------------------
INSERT INTO `banner_local` VALUES ('1', 'Somente na página inicial', 'pagina_inicial', '1', '2014-10-06 14:18:34');
INSERT INTO `banner_local` VALUES ('2', 'Em todas as categorias', 'categoria', '1', '2014-10-06 14:20:13');
INSERT INTO `banner_local` VALUES ('3', 'Em todas as marcas', 'marca', '1', '2014-10-06 14:20:15');
INSERT INTO `banner_local` VALUES ('4', 'Em todos os produtos', 'produto', '1', '2014-10-06 14:20:16');
INSERT INTO `banner_local` VALUES ('5', 'Na página de busca', 'busca', '1', '2014-10-06 14:20:18');
INSERT INTO `banner_local` VALUES ('6', 'Nas páginas de conteúdo', 'pagina', '1', '2014-10-06 14:20:19');
INSERT INTO `banner_local` VALUES ('7', 'Em todas as páginas', 'todas', '1', '2014-10-06 14:20:21');

-- ----------------------------
-- Table structure for banner_posicao
-- ----------------------------
DROP TABLE IF EXISTS `banner_posicao`;
CREATE TABLE `banner_posicao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `local_publicacao` enum('minibanner','banner','sidebar','vitrine','tarja','defaultbanner','fullbanner') NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `posicao` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`,`local_publicacao`),
  UNIQUE KEY `posicao` (`posicao`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of banner_posicao
-- ----------------------------
INSERT INTO `banner_posicao` VALUES ('1', 'Banner Tarja', 'tarja', '1', '2015-02-27 01:02:44', '4');
INSERT INTO `banner_posicao` VALUES ('2', 'Banner Vitrine', 'vitrine', '1', '2015-02-27 14:44:07', '3');
INSERT INTO `banner_posicao` VALUES ('3', 'Slider Full Banner', 'fullbanner', '1', '2015-02-27 14:42:56', '0');
INSERT INTO `banner_posicao` VALUES ('4', 'Mini banner', 'minibanner', '1', '2015-02-27 14:44:49', '6');
INSERT INTO `banner_posicao` VALUES ('5', 'Banner lateral do Full banner', 'sidebar', '0', '2015-02-27 14:44:46', '5');
INSERT INTO `banner_posicao` VALUES ('6', 'Banner', 'banner', '1', '2015-02-27 01:02:50', '2');
INSERT INTO `banner_posicao` VALUES ('7', 'Slider Default Banner', 'defaultbanner', '1', '2016-08-11 02:33:39', '1');

-- ----------------------------
-- Table structure for cancelar_shop
-- ----------------------------
DROP TABLE IF EXISTS `cancelar_shop`;
CREATE TABLE `cancelar_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) unsigned NOT NULL,
  `id_cliente` int(11) unsigned NOT NULL,
  `status_ativo` tinyint(4) DEFAULT NULL,
  `motivos` enum('estou_migrando_para_outra_plataforma','estou_desistindo_de_ter_loja_virtual') DEFAULT NULL,
  `sugestao` text COMMENT 'Sugestao de melhorias',
  `data_remover` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cancelar_shop
-- ----------------------------
INSERT INTO `cancelar_shop` VALUES ('20', '5', '5', '0', 'estou_desistindo_de_ter_loja_virtual', '', '2015-11-12', '2015-10-28 16:18:01');

-- ----------------------------
-- Table structure for cancelar_shop_recuperacao
-- ----------------------------
DROP TABLE IF EXISTS `cancelar_shop_recuperacao`;
CREATE TABLE `cancelar_shop_recuperacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cancelar_shop_recuperacao_fk_1_idx` (`id_shop_default`)) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cancelar_shop_recuperacao
-- ----------------------------
INSERT INTO `cancelar_shop_recuperacao` VALUES ('41', '5', 'b9df03ca2c2ab35a86a18f720e2f0e9e', '2015-10-28 16:21:05');

-- ----------------------------
-- Table structure for cidades
-- ----------------------------
DROP TABLE IF EXISTS `cidades`;
CREATE TABLE `cidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `codigo_ibge` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `populacao_2010` int(11) DEFAULT NULL,
  `densidade_demo` varchar(255) DEFAULT NULL,
  `gentilico` varchar(255) DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5566 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cidades
-- ----------------------------
INSERT INTO `cidades` VALUES ('1', 'Acrelândia', '120001', '1', '12538', '6.94', 'acrelandense', '1808');
INSERT INTO `cidades` VALUES ('2', 'Assis Brasil', '120005', '1', '6072', '1.22', 'assis-brasiliense', '4974');
INSERT INTO `cidades` VALUES ('3', 'Brasiléia', '120010', '1', '21398', '5.46', 'brasileense', '3917');
INSERT INTO `cidades` VALUES ('4', 'Bujari', '120013', '1', '8471', '2.79', 'bujariense', '3035');
INSERT INTO `cidades` VALUES ('5', 'Capixaba', '120017', '1', '8798', '5.17', 'capixabense', '1703');
INSERT INTO `cidades` VALUES ('5565', 'Xambioá', '172210', '27', '11484', '9.68', 'xambioaense', '1186');

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_grupo` int(11) unsigned DEFAULT '1',
  `id_shop` int(11) unsigned DEFAULT NULL,
  `id_grupo` int(11) DEFAULT '1',
  `id_default_grupo` int(10) unsigned DEFAULT '1',
  `tipo_cadastro` enum('cnpj','cpf') DEFAULT NULL,
  `id_sexo` int(11) NOT NULL DEFAULT '3',
  `nome` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `ativo` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `cpf` varchar(32) DEFAULT NULL,
  `rg` varchar(32) DEFAULT NULL,
  `cnpj` varchar(32) DEFAULT NULL,
  `razao_social` varchar(128) DEFAULT NULL,
  `info_tributo` varchar(45) DEFAULT NULL,
  `telefone_celular` varchar(32) DEFAULT NULL,
  `telefone_residencial` varchar(32) DEFAULT NULL,
  `telefone_comercial` varchar(32) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `ie` varchar(45) DEFAULT NULL,
  `responsavel` varchar(128) DEFAULT NULL,
  `aliases` varchar(128) DEFAULT NULL,
  `receber_ofertas_shopping` enum('N','S') DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `security_key` varchar(40) NOT NULL,
  `ultima_troca_senha` datetime DEFAULT NULL,
  `conta_auto_login` enum('False','True') DEFAULT 'True',
  `black_list` enum('true') DEFAULT NULL,
  `data_black_list` datetime DEFAULT NULL,
  `boletim_shopping` enum('True') DEFAULT NULL,
  `up_nivel_validar` text,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `cliente_fk_1_idx` (`id_sexo`) USING BTREE,
  KEY `cliente_fk_2_idx` (`id_grupo`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES ('1', '1', '4', '1', '1', null, '3', 'Comercial', 'comercial@vialoja.com.br', '$2y$07$fGFpfQQBN0i/NHWa2lMNQeCqxaytX11F5KEGutzm4GZtGV4Jfw0zC', '90', '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '127.0.0.1', 'dd5735f84e9c95d0b50c8ccf1ded2b0314a88d34', null, 'False', null, null, null, null, '2014-06-03 15:23:37', '2014-09-05 23:35:34');
INSERT INTO `cliente` VALUES ('2', '1', '1', '1', '1', null, '3', 'Suporte', 'suporte@vialoja.com.br', '$2y$07$fGFpfQQBN0i/NHWa2lMNQeCqxaytX11F5KEGutzm4GZtGV4Jfw0zC', '90', '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '127.0.0.1', '86d63fc197f4020957e67750941c55459c9bd249', null, 'False', null, null, null, null, '2014-04-30 16:11:18', '2014-09-05 23:35:46');
INSERT INTO `cliente` VALUES ('3', '1', null, '1', '1', null, '3', 'Financeiro', 'financeiro@vialoja.com.br', '$2y$07$ie0iUP/9xAY/33QiS0QB9.m/iphwP/2sdb/9HzfAeYvqwLVEhNGz.', '1', '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '127.0.0.1', 'ca836c8883e521ee8440fc4c2362d6a9f8b1c1f8', null, 'False', null, null, null, null, '2016-05-03 15:19:13', '2016-05-03 18:06:17');
INSERT INTO `cliente` VALUES ('5', '1', '5', '1', '1', null, '3', 'Williams Duarte', 'wsduarte@outlook.com', '$2y$07$0D1b6OUL4scB6Fg/P6vnneczRTMBf6ukf21TSTwDSaf0q.rDP8byW', '6', '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '127.0.0.1', 'c6168f143b2bacda2ca860c9ebf866160e113ba4', '2016-10-24 18:26:57', 'False', null, null, null, null, '2014-06-06 13:53:29', '2016-10-24 19:26:57');
INSERT INTO `cliente` VALUES ('6', '13', '7', '1', '1', null, '1', 'Joanilson N Souza', 'joanilson_souza@outlook.com', '$2y$07$adGfShyoKjn7LIcOWy1PzeTJE1KdCRPOvUtmlXpXSzZmQO2vEwdVi', '4', '1', null, null, null, null, null, '(65)', '(65)', '', '1979-08-23', null, null, null, null, '127.0.0.1', '00f5aab16a39688dec3f47424382eab148f195a8', '2016-04-21 02:33:24', 'False', null, null, null, null, '2014-05-16 23:22:02', '2016-05-11 17:02:23');
INSERT INTO `cliente` VALUES ('7', '1', null, '1', '1', null, '3', 'williams junior', 'silvanomendesmkt@gmail.com', '', '5', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, '127.0.0.1', 'e99fb5aa6f80acd3c50f24cd98d03a52c88247d2', null, 'True', null, null, null, null, '2016-01-04 13:09:13', '2016-01-04 14:09:13');
INSERT INTO `cliente` VALUES ('11', '1', null, '1', '1', null, '3', 'William Facom Duarte', 'wsduarte@outlook.com.br', '$2y$07$/O94Wd.PrqSepDJdKH.Co.ozmBsDQfKQmF2c6vMNZ1GLHmHsOcvK6', '5', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, '127.0.0.1', 'd1a8def6c94336a2cc0459a6d8e97ff31011ea7f', null, 'True', null, null, null, '{\"nome\":\"williams junior\",\"senha\":\"$2y$07$FettC1sDZaWVKBpJXuwto..rrwSjuCRXALcyK5ynL2i0su1fCE6wO\",\"security_key\":\"d1a8def6c94336a2cc0459a6d8e97ff31011ea7f\",\"nivel\":5,\"url_upgrade\":\"http:\\/\\/app.vialoja.com.br\\/public\\/criar-conta-loja-virtual\",\"ip\":\"127.0.0.1\"}', '2016-01-07 16:00:10', '2016-01-07 21:01:27');
INSERT INTO `cliente` VALUES ('24', '1', '15', '1', '1', null, '3', 'Will Duarte Oficial', 'williamduarteoficial@gmail.com', '$2y$07$gIBK04zw8gxp.IjIG3vUs.kgQ7EGklRfOItoHnvSWK7OM0zK.pcaS', '5', '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '127.0.0.1', 'c1753143b59167e1fe4a4040b9dc5b6f9c322a50', '2016-04-21 02:46:13', 'False', null, null, null, null, '2016-04-20 23:44:26', '2016-04-21 03:46:13');
INSERT INTO `cliente` VALUES ('35', '1', '25', '1', '1', null, '3', 'Maycon Oliveira', 'vania.diamantinomt@gmail.com', '$2y$07$FPRvoTfIrolA1Djo4SasA.RAYRbFtbT4Xvmzu0JXf3zEI6vINP3Hy', '5', '1', null, null, null, null, null, null, null, null, null, null, null, null, null, '127.0.0.1', '157ce879816b0a14c890c8a2fd7804755813a8b8', null, 'False', null, null, null, null, '2016-04-23 02:00:25', '2016-04-23 03:02:04');

-- ----------------------------
-- Table structure for cliente_convite
-- ----------------------------
DROP TABLE IF EXISTS `cliente_convite`;
CREATE TABLE `cliente_convite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_cliente_default` int(11) DEFAULT NULL,
  `id_cliente_grupo` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(64) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`,`id_shop_default`),
  UNIQUE KEY `email` (`email`),
  KEY `id_cliente_grupo` (`id_cliente_grupo`),
  KEY `cliente_convite_fk_1_idx` (`id_shop_default`) USING BTREE,
  KEY `cliente_convite_fk_2_idx` (`id_cliente_default`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cliente_convite
-- ----------------------------

-- ----------------------------
-- Table structure for cliente_endereco
-- ----------------------------
DROP TABLE IF EXISTS `cliente_endereco`;
CREATE TABLE `cliente_endereco` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente_default` int(11) DEFAULT NULL,
  `id_estado` int(11) NOT NULL,
  `id_cidade` int(11) NOT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `cep` char(12) DEFAULT NULL,
  `bairro` varchar(128) DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `complemento` varchar(128) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_endereco`),
  KEY `cliente_endereco_fk_1_idx` (`id_cliente_default`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cliente_endereco
-- ----------------------------

-- ----------------------------
-- Table structure for cliente_grupo
-- ----------------------------
DROP TABLE IF EXISTS `cliente_grupo`;
CREATE TABLE `cliente_grupo` (
  `id_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupo_tipo` int(11) NOT NULL DEFAULT '1',
  `id_shop` int(11) DEFAULT '1',
  PRIMARY KEY (`id_grupo`),
  KEY `cliente_grupo_fk_1_idx` (`id_grupo_tipo`) USING BTREE,
  KEY `cliente_grupo_fk_2_idx` (`id_shop`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cliente_grupo
-- ----------------------------

-- ----------------------------
-- Table structure for cliente_grupo_shop
-- ----------------------------
DROP TABLE IF EXISTS `cliente_grupo_shop`;
CREATE TABLE `cliente_grupo_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente_default` int(11) NOT NULL,
  `id_shop_default` int(11) NOT NULL,
  `id_grupo_default` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cliente` (`id_cliente_default`,`id_shop_default`) USING BTREE,
  KEY `cliente_grupo_shop_fk_1_idx` (`id_cliente_default`) USING BTREE,
  KEY `cliente_grupo_shop_fk_2_idx` (`id_grupo_default`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cliente_grupo_shop
-- ----------------------------

-- ----------------------------
-- Table structure for cliente_grupo_tipo
-- ----------------------------
DROP TABLE IF EXISTS `cliente_grupo_tipo`;
CREATE TABLE `cliente_grupo_tipo` (
  `id_grupo_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(10) NOT NULL DEFAULT 'Default',
  `ativo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_grupo_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cliente_grupo_tipo
-- ----------------------------
INSERT INTO `cliente_grupo_tipo` VALUES ('1', 'Default', '1');
INSERT INTO `cliente_grupo_tipo` VALUES ('2', 'Shop', '1');
INSERT INTO `cliente_grupo_tipo` VALUES ('3', 'Admin', '1');

-- ----------------------------
-- Table structure for cliente_newsletter_shop
-- ----------------------------
DROP TABLE IF EXISTS `cliente_newsletter_shop`;
CREATE TABLE `cliente_newsletter_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente_default` int(11) DEFAULT NULL,
  `id_shop_default` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cliente` (`id_cliente_default`,`id_shop_default`) USING BTREE,
  KEY `cliente_newsletter_shop_fk_1_idx` (`id_cliente_default`) USING BTREE,
  KEY `cliente_newsletter_shop_fk_2_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cliente_newsletter_shop
-- ----------------------------
INSERT INTO `cliente_newsletter_shop` VALUES ('1', '1', '5', null, null);
INSERT INTO `cliente_newsletter_shop` VALUES ('2', '2', '5', null, null);
INSERT INTO `cliente_newsletter_shop` VALUES ('5', '3', '5', null, '2014-09-11 23:09:33');
INSERT INTO `cliente_newsletter_shop` VALUES ('6', '6', '5', null, '2014-09-11 20:09:23');
INSERT INTO `cliente_newsletter_shop` VALUES ('7', '3', '7', null, '2014-09-11 21:34:38');

-- ----------------------------
-- Table structure for cliente_recuperar
-- ----------------------------
DROP TABLE IF EXISTS `cliente_recuperar`;
CREATE TABLE `cliente_recuperar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT '0',
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_recuperar_fk_1_idx` (`id_cliente`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cliente_recuperar
-- ----------------------------
INSERT INTO `cliente_recuperar` VALUES ('8', '6', 'f777467012681f4d9d52beaf9c7929c1fde6a4e7', '2015-03-23 13:05:06', '2015-03-23 14:05:06', '0', '127.0.0.1');
INSERT INTO `cliente_recuperar` VALUES ('168', '11', 'db5ef8bb0ba120e00649e2c0691da248e469ae41', '2016-07-15 16:11:18', '2016-07-15 17:11:18', '0', '127.0.0.1');

-- ----------------------------
-- Table structure for cliente_sexo
-- ----------------------------
DROP TABLE IF EXISTS `cliente_sexo`;
CREATE TABLE `cliente_sexo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sexo` char(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cliente_sexo
-- ----------------------------
INSERT INTO `cliente_sexo` VALUES ('1', 'Masculino');
INSERT INTO `cliente_sexo` VALUES ('2', 'Feminino');
INSERT INTO `cliente_sexo` VALUES ('3', 'Indefinido');

-- ----------------------------
-- Table structure for cliente_shop
-- ----------------------------
DROP TABLE IF EXISTS `cliente_shop`;
CREATE TABLE `cliente_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente_default` int(11) NOT NULL,
  `id_shop_default` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cliente` (`id_cliente_default`,`id_shop_default`) USING BTREE,
  KEY `cliente_shop_fk_1_idx` (`id_cliente_default`) USING BTREE,
  KEY `cliente_shop_fk_2_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cliente_shop
-- ----------------------------
INSERT INTO `cliente_shop` VALUES ('1', '1', '5', null, null);
INSERT INTO `cliente_shop` VALUES ('2', '2', '5', null, null);
INSERT INTO `cliente_shop` VALUES ('5', '3', '5', null, '2014-09-11 23:09:33');
INSERT INTO `cliente_shop` VALUES ('6', '6', '5', null, '2014-09-11 20:09:23');
INSERT INTO `cliente_shop` VALUES ('7', '3', '7', null, '2014-09-11 21:34:38');

-- ----------------------------
-- Table structure for cliente_shop_grupo
-- ----------------------------
DROP TABLE IF EXISTS `cliente_shop_grupo`;
CREATE TABLE `cliente_shop_grupo` (
  `id_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_grupo`),
  UNIQUE KEY `nome` (`id_shop_default`,`nome`) USING BTREE,
  KEY `cliente_shop_grupo_fk_1_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cliente_shop_grupo
-- ----------------------------
INSERT INTO `cliente_shop_grupo` VALUES ('13', '5', 'Mato Grosso', '2016-05-06 16:48:06', '2016-05-06 17:48:06');
INSERT INTO `cliente_shop_grupo` VALUES ('14', '5', 'São Paulo', '2016-05-10 16:41:33', '2016-05-10 17:41:33');
INSERT INTO `cliente_shop_grupo` VALUES ('15', '5', 'gdsfgdsfgsdg', '2016-05-17 19:53:04', '2016-05-17 20:53:04');

-- ----------------------------
-- Table structure for codigo_correios
-- ----------------------------
DROP TABLE IF EXISTS `codigo_correios`;
CREATE TABLE `codigo_correios` (
  `codigo` int(11) NOT NULL,
  `id_envio` int(11) NOT NULL,
  `contrato` enum('False','True') NOT NULL,
  `servico` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `default` enum('False','True') DEFAULT 'False',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of codigo_correios
-- ----------------------------
INSERT INTO `codigo_correios` VALUES ('40010', '1', 'False', 'SEDEX Varejo', 'SEDEX', 'True');
INSERT INTO `codigo_correios` VALUES ('40045', '1', 'False', 'SEDEX a Cobrar Varejo\r', 'SEDEX', 'False');
INSERT INTO `codigo_correios` VALUES ('40096', '1', 'True', 'SEDEX com Contrato', 'SEDEX', 'False');
INSERT INTO `codigo_correios` VALUES ('40290', '1', 'False', 'SEDEX Hoje Varejo\r', 'SEDEX', 'False');
INSERT INTO `codigo_correios` VALUES ('40436', '1', 'True', 'SEDEX com Contrato', 'SEDEX', 'False');
INSERT INTO `codigo_correios` VALUES ('40444', '1', 'True', 'SEDEX com Contrato', 'SEDEX', 'False');
INSERT INTO `codigo_correios` VALUES ('41068', '2', 'True', 'PAC com Contrato', 'PAC', 'False');
INSERT INTO `codigo_correios` VALUES ('41106', '2', 'False', 'PAC Varejo', 'PAC', 'True');
INSERT INTO `codigo_correios` VALUES ('81019', '3', 'True', 'e-SEDEX com Contrato', 'e-SEDEX', 'True');

-- ----------------------------
-- Table structure for comparador
-- ----------------------------
DROP TABLE IF EXISTS `comparador`;
CREATE TABLE `comparador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `url` varchar(128) DEFAULT NULL,
  `img` varchar(128) NOT NULL,
  `ativo` enum('False','True') DEFAULT 'True',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comparador
-- ----------------------------
INSERT INTO `comparador` VALUES ('1', 'Buscapé', 'http://negocios.buscapecompany.com.br/', 'buscape.png', 'True', '2014-09-16 23:50:11');
INSERT INTO `comparador` VALUES ('2', 'Shopping UOL', '', 'shoppinguol.png', 'False', '2015-08-19 20:05:57');
INSERT INTO `comparador` VALUES ('3', 'Google Merchant', 'http://www.google.com.br/merchants', 'googlemerchant.png', 'True', '2014-09-16 23:50:18');
INSERT INTO `comparador` VALUES ('5', 'MuccaShop', 'http://www.muccashop.com.br/anuncie/', 'muccashop.png', 'True', '2015-08-25 13:07:15');

-- ----------------------------
-- Table structure for configuracao_atividade
-- ----------------------------
DROP TABLE IF EXISTS `configuracao_atividade`;
CREATE TABLE `configuracao_atividade` (
  `id_atividade` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  `descricao` text,
  `link_rewrite` varchar(128) NOT NULL,
  `meta_title` varchar(128) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_atividade`),
  KEY `categoria_master_nome` (`nome`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of configuracao_atividade
-- ----------------------------
INSERT INTO `configuracao_atividade` VALUES ('1', 'Acessórios Automotivos', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('2', 'Alimentos e Bebidas', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('3', 'Arte e Antiguidades', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('4', 'Artesanato', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('5', 'Artigos promocionais', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('6', 'Artigos Religiosos', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('7', 'Bebês e Cia', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('8', 'Blu-Ray, DVD, CD e VHS', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('9', 'Brinquedos e Colecionáveis', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('10', 'Casa e Decoração', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('11', 'Construção e Ferramentas', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('12', 'Cosméticos, Perfumaria e Cuidados Pessoais', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('13', 'Eletrodomésticos', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('14', 'Eletrônicos', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('15', 'Esporte e Lazer', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('16', 'Fitness e Suplementos', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('17', 'Fotografia', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('18', 'Games', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('19', 'Gráfica', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('20', 'Informática', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('21', 'Ingressos', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('22', 'Instrumentos Musicais', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('23', 'Livros e Revistas', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('24', 'Moda e Acessórios', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('25', 'Móveis', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('26', 'Papelaria e Escritório', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('27', 'Pet Shop', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('28', 'Presentes, Flores e Cestas', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('29', 'Relojoaria e Joalheria', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('30', 'Saúde', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('31', 'Sex Shop', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('32', 'Telefonia e Celulares', null, '', null, null, null, '1');
INSERT INTO `configuracao_atividade` VALUES ('33', 'Viagens e Turismo', null, '', null, null, null, '1');

-- ----------------------------
-- Table structure for configuracao_envio
-- ----------------------------
DROP TABLE IF EXISTS `configuracao_envio`;
CREATE TABLE `configuracao_envio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(30) NOT NULL,
  `logo` varchar(45) DEFAULT NULL,
  `id_js` char(20) DEFAULT NULL,
  `checked` enum('checked="checked"') DEFAULT NULL,
  `configuracao` enum('precisa_configuracao') DEFAULT NULL,
  `ativo` tinyint(4) unsigned DEFAULT '1',
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=501 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of configuracao_envio
-- ----------------------------
INSERT INTO `configuracao_envio` VALUES ('1', 'SEDEX', 'sedex-logo.png', 'sedex', 'checked=\"checked\"', null, '1', 'sedex');
INSERT INTO `configuracao_envio` VALUES ('2', 'PAC', 'pac-logo.png', 'pac', 'checked=\"checked\"', null, '1', 'pac');
INSERT INTO `configuracao_envio` VALUES ('3', 'e-SEDEX', 'e_sedex-logo.png', 'e_sedex', null, 'precisa_configuracao', '1', 'e-sedex');
INSERT INTO `configuracao_envio` VALUES ('100', 'Motoboy', 'motoboy-logo.png', 'motoboy', null, 'precisa_configuracao', '1', 'motoboy');
INSERT INTO `configuracao_envio` VALUES ('200', 'Transportadora', 'transportadora-logo.png', 'transportadora', null, 'precisa_configuracao', '1', 'transportadora');
INSERT INTO `configuracao_envio` VALUES ('300', 'Retirar pessoalmente', 'retirar_pessoalmente-logo.png', 'pessoalmente', null, 'precisa_configuracao', '1', 'pessoalmente');
INSERT INTO `configuracao_envio` VALUES ('400', 'Frete Fixo', null, null, null, null, '0', null);
INSERT INTO `configuracao_envio` VALUES ('500', 'Frete Grátis (CUPOM)', null, null, null, null, '0', null);

-- ----------------------------
-- Table structure for configuracao_pagamento
-- ----------------------------
DROP TABLE IF EXISTS `configuracao_pagamento`;
CREATE TABLE `configuracao_pagamento` (
  `id_config_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `logo` varchar(45) NOT NULL,
  `id_for` varchar(45) NOT NULL,
  `slug` char(45) NOT NULL,
  `checked` enum('checked="checked"') DEFAULT NULL,
  `ativo_wizard` tinyint(4) DEFAULT NULL,
  `ativo` tinyint(4) unsigned DEFAULT '1',
  `cartao_visa` enum('none','greycheck') DEFAULT 'greycheck',
  `cartao_master_card` enum('none','greycheck') DEFAULT 'greycheck',
  `cartao_hipercard` enum('none','greycheck') DEFAULT NULL,
  `banco_itau` enum('none','greycheck') DEFAULT 'greycheck',
  `banco_bradesco` enum('none','greycheck') DEFAULT 'greycheck',
  `banco_bb` enum('none','greycheck') DEFAULT 'greycheck',
  `boleto` enum('none','greycheck') DEFAULT 'greycheck',
  PRIMARY KEY (`id_config_pagamento`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of configuracao_pagamento
-- ----------------------------
INSERT INTO `configuracao_pagamento` VALUES ('1', 'MercadoPago', 'mercado_pago-logo.png', 'mercadopago', 'pagamento_mercado_pago', null, '1', '1', 'greycheck', 'greycheck', 'none', 'greycheck', 'greycheck', 'greycheck', 'greycheck');
INSERT INTO `configuracao_pagamento` VALUES ('2', 'PagSeguro', 'pagseguro-logo.png', 'pagseguro', 'pagamento_pagseguro', null, '1', '1', 'greycheck', 'greycheck', 'greycheck', 'greycheck', 'greycheck', 'greycheck', 'greycheck');
INSERT INTO `configuracao_pagamento` VALUES ('3', 'Bcash', 'bcash-logo.png', 'pagamentodigital', 'pagamento_pagamento_digital', 'checked=\"checked\"', '1', '1', 'greycheck', 'greycheck', 'greycheck', 'greycheck', 'greycheck', 'greycheck', 'greycheck');
INSERT INTO `configuracao_pagamento` VALUES ('4', 'PayPal', 'paypal-logo.png', 'paypal', 'pagamento_paypal', null, '1', '1', 'greycheck', 'greycheck', 'none', 'none', 'none', 'none', 'none');
INSERT INTO `configuracao_pagamento` VALUES ('5', 'Depósito Bancário', 'deposito-logo.png', 'deposito', 'pagamento_deposito', null, '1', '1', 'none', 'none', 'none', 'none', 'none', 'none', 'none');
INSERT INTO `configuracao_pagamento` VALUES ('6', 'Boleto Bancário', 'boleto-logo.png', 'boleto', 'pagamento_boleto', null, '0', '0', 'none', 'none', 'none', 'none', 'none', 'none', 'none');

-- ----------------------------
-- Table structure for estados
-- ----------------------------
DROP TABLE IF EXISTS `estados`;
CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_ibge` varchar(4) NOT NULL,
  `sigla` char(2) NOT NULL,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of estados
-- ----------------------------
INSERT INTO `estados` VALUES ('1', '12', 'AC', 'Acre');
INSERT INTO `estados` VALUES ('2', '27', 'AL', 'Alagoas');
INSERT INTO `estados` VALUES ('3', '13', 'AM', 'Amazonas');
INSERT INTO `estados` VALUES ('4', '16', 'AP', 'Amapá');
INSERT INTO `estados` VALUES ('5', '29', 'BA', 'Bahia');
INSERT INTO `estados` VALUES ('6', '23', 'CE', 'Ceará');
INSERT INTO `estados` VALUES ('7', '53', 'DF', 'Distrito Federal');
INSERT INTO `estados` VALUES ('8', '32', 'ES', 'Espírito Santo');
INSERT INTO `estados` VALUES ('9', '52', 'GO', 'Goiás');
INSERT INTO `estados` VALUES ('10', '21', 'MA', 'Maranhão');
INSERT INTO `estados` VALUES ('11', '31', 'MG', 'Minas Gerais');
INSERT INTO `estados` VALUES ('12', '50', 'MS', 'Mato Grosso do Sul');
INSERT INTO `estados` VALUES ('13', '51', 'MT', 'Mato Grosso');
INSERT INTO `estados` VALUES ('14', '15', 'PA', 'Pará');
INSERT INTO `estados` VALUES ('15', '25', 'PB', 'Paraíba');
INSERT INTO `estados` VALUES ('16', '26', 'PE', 'Pernambuco');
INSERT INTO `estados` VALUES ('17', '22', 'PI', 'Piauí');
INSERT INTO `estados` VALUES ('18', '41', 'PR', 'Paraná');
INSERT INTO `estados` VALUES ('19', '33', 'RJ', 'Rio de Janeiro');
INSERT INTO `estados` VALUES ('20', '24', 'RN', 'Rio Grande do Norte');
INSERT INTO `estados` VALUES ('21', '11', 'RO', 'Rondônia');
INSERT INTO `estados` VALUES ('22', '14', 'RR', 'Roraima');
INSERT INTO `estados` VALUES ('23', '43', 'RS', 'Rio Grande do Sul');
INSERT INTO `estados` VALUES ('24', '42', 'SC', 'Santa Catarina');
INSERT INTO `estados` VALUES ('25', '28', 'SE', 'Sergipe');
INSERT INTO `estados` VALUES ('26', '35', 'SP', 'São Paulo');
INSERT INTO `estados` VALUES ('27', '17', 'TO', 'Tocantis');

-- ----------------------------
-- Table structure for grade_default_protected
-- ----------------------------
DROP TABLE IF EXISTS `grade_default_protected`;
CREATE TABLE `grade_default_protected` (
  `id_grade_default_protected_fk` int(10) NOT NULL,
  PRIMARY KEY (`id_grade_default_protected_fk`),
  KEY `grade_default_fk` (`id_grade_default_protected_fk`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of grade_default_protected
-- ----------------------------
INSERT INTO `grade_default_protected` VALUES ('1');
INSERT INTO `grade_default_protected` VALUES ('2');
INSERT INTO `grade_default_protected` VALUES ('3');
INSERT INTO `grade_default_protected` VALUES ('4');
INSERT INTO `grade_default_protected` VALUES ('5');
INSERT INTO `grade_default_protected` VALUES ('6');
INSERT INTO `grade_default_protected` VALUES ('7');
INSERT INTO `grade_default_protected` VALUES ('8');
INSERT INTO `grade_default_protected` VALUES ('9');

-- ----------------------------
-- Table structure for log_login
-- ----------------------------
DROP TABLE IF EXISTS `log_login`;
CREATE TABLE `log_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `url_referer` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_login_fk_1_idx` (`id_cliente`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_login
-- ----------------------------

-- ----------------------------
-- Table structure for log_login_all
-- ----------------------------
DROP TABLE IF EXISTS `log_login_all`;
CREATE TABLE `log_login_all` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `url_referer` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_login_all
-- ----------------------------

-- ----------------------------
-- Table structure for log_shop
-- ----------------------------
DROP TABLE IF EXISTS `log_shop`;
CREATE TABLE `log_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_shop` int(11) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `url_referer` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`id_cliente`,`id_shop`,`url`,`url_referer`) USING BTREE,
  KEY `vl_log_shop_fk_1_idx` (`id_shop`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_shop
-- ----------------------------

-- ----------------------------
-- Table structure for log_shop_atividade
-- ----------------------------
DROP TABLE IF EXISTS `log_shop_atividade`;
CREATE TABLE `log_shop_atividade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT NULL,
  `content_type` varchar(45) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `details` varchar(128) DEFAULT NULL,
  `action` enum('created_item','added_item','posted_item','updated_item','edited_item','revised_item','replied_to_item','deleted_item','cleared_item','removed_item','uploaded_item','downloaded_item','activated_item','submitted_item','accepted_item','declined_item','approved_item','unapproved_item','mailed_item','emailed_item','sent_item','flagged_item','upvoted_item','downvoted_item','created_items','added_items','posted_items','updated_items','edited_items','revised_items','replied_to_items','deleted_items','removed_items','cleared_items','uploaded_items','downloaded_items','activated_items','submitted_items','accepted_items','declined_items','approved_items','unapproved_items','mailed_items','emailed_items','sent_items','flagged_items','upvoted_items','downvoted_items','created_item_in_area','added_item_to_area','logged_in','attempted_log_in','logged_out','registered_account','activated_account','closed_account','changed_password') DEFAULT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `shop_atividade_fk_1_idx` (`id_shop_default`)) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of log_shop_atividade
-- ----------------------------
INSERT INTO `log_shop_atividade` VALUES ('1', '15', 'Marca', '20', 'Nova Categoria', 'created_item', '2016-10-02 02:25:30');
INSERT INTO `log_shop_atividade` VALUES ('2', '15', 'shop_marca', '20', 'Nova Categoria', 'edited_item', '2016-10-02 02:26:53');
INSERT INTO `log_shop_atividade` VALUES ('3', '15', 'shop_marca', '20', 'Nova Categorias', 'removed_item', '2016-10-02 02:27:43');
INSERT INTO `log_shop_atividade` VALUES ('4', '5', 'shop_marca', '19', 'teste', 'removed_item', '2016-10-02 02:31:09');
INSERT INTO `log_shop_atividade` VALUES ('5', '5', 'shop_marca', '16', 'Apple Teste', 'removed_item', '2016-10-02 02:48:06');
INSERT INTO `log_shop_atividade` VALUES ('6', '25', 'shop_arquivo', '16', '12250143-1523508594625795-6281072873716623339-n.jpg', 'removed_item', '2016-10-02 03:08:45');

-- ----------------------------
-- Table structure for log_shop_trafego
-- ----------------------------
DROP TABLE IF EXISTS `log_shop_trafego`;
CREATE TABLE `log_shop_trafego` (
  `id_trafego` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT NULL,
  `bytes` int(11) DEFAULT NULL,
  `http_referer` varchar(255) DEFAULT NULL,
  `http_user_agent` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `time_unique` char(13) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_trafego`),
  UNIQUE KEY `time_unique` (`id_shop_default`,`http_user_agent`,`time_unique`,`url`) USING BTREE,
  KEY `log_shop_trafego_fk_1_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Log de Visitas';

-- ----------------------------
-- Records of log_shop_trafego
-- ----------------------------

-- ----------------------------
-- Table structure for log_shop_visita
-- ----------------------------
DROP TABLE IF EXISTS `log_shop_visita`;
CREATE TABLE `log_shop_visita` (
  `id_visita` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT NULL,
  `http_referer` varchar(255) DEFAULT NULL COMMENT 'HTTP Referrer',
  `http_user_agent` varchar(255) DEFAULT NULL COMMENT 'HTTP User-Agent',
  `session_id` varchar(130) DEFAULT NULL,
  `ip` varchar(98) DEFAULT NULL COMMENT 'Remote Address',
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_visita`),
  UNIQUE KEY `session_Unique` (`id_shop_default`,`session_id`,`ip`) USING BTREE,
  KEY `log_shop_visita_fk_1_idx` (`id_shop_default`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=450 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='Log Visitor Info Table';

-- ----------------------------
-- Records of log_shop_visita
-- ----------------------------
INSERT INTO `log_shop_visita` VALUES ('1', '5', '/', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', '402da62a0a4322a2480013816d7adfe77947a8729b41a585ea0f1b26c31b186c', '127.0.0.1', '2016-04-28 16:42:34');
INSERT INTO `log_shop_visita` VALUES ('2', '5', '/', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 'a981822a9e1f6a6a3a325bde63eb4ba31471ef122622169c4bbd895b35c1c9e3', '127.0.0.1', '2016-04-28 16:42:34');
INSERT INTO `log_shop_visita` VALUES ('3', '5', '/', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', 'efc1be03dd4b561f4147b0fe2315d8a017904f88c1df50902105f76017949d8f', '127.0.0.1', '2016-04-28 16:42:34');
INSERT INTO `log_shop_visita` VALUES ('4', '5', '/', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', '9c9e93346e0c34865fc577708c80c704085b7243aa6096330b422937cda5b296', '127.0.0.1', '2016-04-28 16:42:34');
INSERT INTO `log_shop_visita` VALUES ('5', '5', '/', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36', '31a493ee2add0c8dfa09da63d4857d49015296d1d7b9223b0ddba035129e08d1', '127.0.0.1', '2016-04-28 16:42:34');

-- ----------------------------
-- Table structure for log_shop_visita_url
-- ----------------------------
DROP TABLE IF EXISTS `log_shop_visita_url`;
CREATE TABLE `log_shop_visita_url` (
  `id_url` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'URL ID',
  `id_visita_default` bigint(20) unsigned DEFAULT NULL COMMENT 'Visitante ID',
  `url` varchar(255) DEFAULT NULL,
  `referer` varchar(255) DEFAULT NULL,
  `visita_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Visita Time',
  PRIMARY KEY (`id_url`),
  KEY `log_shop_visita_url_fk_1_idx` (`id_visita_default`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1537 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='Log URL Table';

-- ----------------------------
-- Records of log_shop_visita_url
-- ----------------------------
INSERT INTO `log_shop_visita_url` VALUES ('2', '1', 'http://styleshop.vialoja.com.br', '/', '2015-08-11 22:06:23');
INSERT INTO `log_shop_visita_url` VALUES ('8', '2', 'http://styleshop.vialoja.com.br/produto/751-abusiness-holster.html', '/', '2015-08-11 22:32:21');
INSERT INTO `log_shop_visita_url` VALUES ('9', '2', 'http://styleshop.vialoja.com.br', 'http://styleshop.vialoja.com.br/produto/751-abusiness-holster.html', '2015-08-11 22:32:39');
INSERT INTO `log_shop_visita_url` VALUES ('11', '2', 'http://styleshop.vialoja.com.br', 'http://styleshop.vialoja.com.br/produto/751-abusiness-holster.html', '2015-08-11 22:36:54');
INSERT INTO `log_shop_visita_url` VALUES ('12', '2', 'http://styleshop.vialoja.com.br', '/', '2015-08-11 22:37:08');

-- ----------------------------
-- Table structure for modelo_produto_importar
-- ----------------------------
DROP TABLE IF EXISTS `modelo_produto_importar`;
CREATE TABLE `modelo_produto_importar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(45) DEFAULT NULL,
  `sku_do_produto_pai` varchar(45) DEFAULT NULL,
  `ativo` varchar(45) DEFAULT NULL,
  `condicao` varchar(45) NOT NULL,
  `nome_produto` varchar(128) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `disponibilidade_quando_nao_gerenciar_estoque` varchar(128) DEFAULT NULL,
  `gerenciar_estoque` varchar(128) DEFAULT NULL,
  `quantidade` smallint(6) DEFAULT NULL,
  `disponibilidade_dos_produtos_em_estoque` smallint(6) DEFAULT NULL,
  `disponibilidade_quando_acabar_produtos_em_estoque` smallint(6) DEFAULT NULL,
  `preco_custo` decimal(10,2) DEFAULT NULL,
  `preco_venda` decimal(10,2) DEFAULT NULL,
  `preco_promocional` decimal(10,2) DEFAULT NULL,
  `categoria_nivel_1` varchar(128) DEFAULT NULL,
  `categoria_nivel_2` varchar(128) DEFAULT NULL,
  `categoria_nivel_3` varchar(128) DEFAULT NULL,
  `marca` varchar(128) DEFAULT NULL,
  `peso_kg` decimal(10,3) DEFAULT NULL,
  `altura_cm` smallint(6) DEFAULT NULL,
  `largura_cm` smallint(6) DEFAULT NULL,
  `comprimento_cm` smallint(6) DEFAULT NULL,
  `link_para_a_foto_principal` varchar(128) DEFAULT NULL,
  `link_para_foto_adicional_1` varchar(128) DEFAULT NULL,
  `link_para_foto_adicional_2` varchar(128) DEFAULT NULL,
  `link_para_foto_adicional_3` varchar(128) DEFAULT NULL,
  `url_antiga_do_produto` varchar(128) DEFAULT NULL,
  `link_do_video_no_youtube` varchar(128) DEFAULT NULL,
  `tamanho_de_tenis` varchar(128) DEFAULT NULL,
  `produto_com_uma_cor` varchar(128) DEFAULT NULL,
  `tamanho_de_capacete` varchar(128) DEFAULT NULL,
  `tamanho_de_calca` varchar(128) DEFAULT NULL,
  `produto_com_duas_cores` varchar(128) DEFAULT NULL,
  `voltagem` varchar(128) DEFAULT NULL,
  `tamanho_de_camisa_camiseta` varchar(128) DEFAULT NULL,
  `tamanho_de_anel_alianca` varchar(128) DEFAULT NULL,
  `genero` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of modelo_produto_importar
-- ----------------------------
INSERT INTO `modelo_produto_importar` VALUES ('1', '7P7EE868P', null, 'Sim', 'Novo', 'Camiseta Marrom', 'Camisa masculina 100% algodão.', '10.0', 'Não', null, null, null, '75.49', '169.00', '161.00', 'Roupas', null, null, 'Polo', '0.500', '15', '13', '13', 'http://www.seueshop.com.br/images/_product/650/650277/produto-com-1-atributo-varias-imagens-483e8994cc.jpg', 'http://www.seueshop.com.br/images/_product/650/650277/produto-com-1-atributo-varias-imagens-22e02454f9.jpg', null, null, 'http://www.seueshop.com.br/p/camiseta-marrom.html', 'https://www.youtube.com/watch?v=w3Omp7Zymtg', null, null, null, null, null, null, null, null, null);
INSERT INTO `modelo_produto_importar` VALUES ('2', 'N3B937VN4', null, 'Sim', 'Novo', 'Cargo Camera Bag Large', 'Esta bolsa lhe permite dar mais segurança a sua câmera. Seu design foi projetado para acomodar melhor o equipamento.', '20.0', 'Não', null, null, null, '108.00', '188.00', '172.80', 'Acessórios', 'Bolsas', null, 'Cargo', '2.000', '15', '13', '13', 'http://www.seueshop.com.br/images/_product/275/275282/cargo-camera-bag-large-60.jpg', null, null, null, 'http://www.seueshop.com.br/p/cargo-camera-bag-large.html', 'https://www.youtube.com/watch?v=w3Omp7Zymtg', null, null, null, null, null, null, null, null, null);
INSERT INTO `modelo_produto_importar` VALUES ('3', 'V3HCWQTSC', null, 'Sim', 'Usado', 'Livro Construindo Sistemas Linux Embarcados', 'Este é o livro para Linux embarcado. Embora muitas empresas usem o Linux em todo tipo de sistemas embarcados, há poucas fontes de informação sobre a criação, instalação e realização de testes no kernel do Linux e nas ferramentas relacionadas a ele.', null, 'Sim', '10', null, '10', '16.00', '46.00', '43.00', 'Livros', 'Informática', 'Linux', 'Alta Books', '0.800', '15', '20', '15', 'http://www.seueshop.com.br/images/_product/275/275206/livro-construindo-sistemas-linux-embarcados-16.jpg', null, null, null, 'http://www.seueshop.com.br/p/livro-construindo-sistemas-linux-embarcados.html', 'https://www.youtube.com/watch?v=QozCc2wX85U', null, null, null, null, null, null, null, null, null);
INSERT INTO `modelo_produto_importar` VALUES ('4', 'DV83PB4LT', null, 'Sim', 'Novo', 'Business Holster', 'O Business Holster é um colete/coldre moderno que serve para guardar aparelhos como iPod ou smartphone, além da carteira, entre outros gadgets que pode ser usado por baixo do palitó de um terno ou jaqueta.', null, 'Sim', '10', null, null, '21.00', '47.00', '39.00', 'Cases', null, null, 'Apple', '0.300', '15', '16', '15', 'http://www.seueshop.com.br/images/_product/275/275292/business-holster-76.jpg', null, null, null, 'http://www.seueshop.com.br/p/business-holster.html', 'https://www.youtube.com/watch?v=w3Omp7Zymtg', null, null, null, null, null, null, null, null, null);
INSERT INTO `modelo_produto_importar` VALUES ('5', 'KNNT9GQSY', null, 'Sim', 'Novo', 'Button Pinguim', 'Coisa linda este Button, muito bonito e barato!', null, 'Não', null, null, null, null, null, null, null, null, null, null, null, null, null, null, 'http://www.seueshop.com.br/images/_product/554/553547/produto-com-2-atributos-a-partir-de-baaf698145.jpg', null, null, null, 'http://www.seueshop.com.br/p/produto-com-2-atributos-a-partir-de.html', 'https://www.youtube.com/watch?v=QozCc2wX85U', null, null, null, null, null, null, null, null, null);
INSERT INTO `modelo_produto_importar` VALUES ('6', '7PWXWU6RE', 'KNNT9GQSY', 'Sim', 'Novo', 'Button Pinguim', 'Coisa linda este Button, muito bonito e barato!', null, 'Sim', '35', null, null, '5.00', '13.00', null, 'Button', null, null, 'Tokidoki', '0.600', '9', '11', '11', null, null, null, null, null, null, null, 'Verde', null, null, null, null, null, null, null);
INSERT INTO `modelo_produto_importar` VALUES ('7', '6ZM6ASBYJ', 'KNNT9GQSY', 'Sim', 'Novo', 'Button Pinguim', 'Coisa linda este Button, muito bonito e barato!', null, 'Sim', '50', null, null, '5.00', '1600.00', null, 'Button', null, null, 'Tokidoki', '0.600', '9', '11', '11', null, null, null, null, null, null, null, 'Azul', null, null, null, null, null, null, null);
INSERT INTO `modelo_produto_importar` VALUES ('8', '3H23SQCKZ', 'KNNT9GQSY', 'Sim', 'Novo', 'Button Pinguim', 'Coisa linda este Button, muito bonito e barato!', null, 'Sim', '60', null, null, '5.00', '21.00', null, 'Button', null, null, 'Tokidoki', '0.600', '9', '11', '11', null, null, null, null, null, null, null, 'Vermelho', null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for modelo_transportadora
-- ----------------------------
DROP TABLE IF EXISTS `modelo_transportadora`;
CREATE TABLE `modelo_transportadora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regiao` varchar(128) NOT NULL,
  `cep_inicial` char(9) NOT NULL,
  `cep_final` char(9) NOT NULL,
  `peso_inicial` decimal(10,3) NOT NULL,
  `peso_final` decimal(10,3) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `prazo_entrega` tinyint(4) NOT NULL,
  `ad_valorem` decimal(10,2) DEFAULT NULL,
  `kg_adicional` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of modelo_transportadora
-- ----------------------------
INSERT INTO `modelo_transportadora` VALUES ('1', 'SAO PAULO - CAPITAL', '01000-001', '05999-999', '0.000', '1.000', '22.70', '7', '1.00', '1.72');
INSERT INTO `modelo_transportadora` VALUES ('2', 'SAO PAULO - CAPITAL', '01000-001', '05999-999', '1.000', '2.000', '26.81', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('3', 'SAO PAULO - CAPITAL', '01000-001', '05999-999', '2.000', '3.000', '28.96', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('4', 'SAO PAULO - CAPITAL', '01000-001', '05999-999', '3.000', '4.000', '30.85', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('5', 'SAO PAULO - CAPITAL', '01000-001', '05999-999', '4.000', '5.000', '32.84', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('6', 'SAO PAULO - CAPITAL', '01000-001', '05999-999', '5.000', '10.000', '37.90', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('7', 'SAO PAULO - CAPITAL', '01000-001', '05999-999', '10.000', '15.000', '43.00', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('8', 'SAO PAULO - CAPITAL', '01000-001', '05999-999', '15.000', '30.000', '49.72', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('9', 'SAO PAULO - CAPITAL', '01000-001', '05999-999', '30.000', '50.000', '52.99', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('10', 'SAO PAULO - CAPITAL', '01000-001', '05999-999', '50.000', '80.000', '55.36', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('11', 'SAO PAULO - CAPITAL', '01000-001', '05999-999', '0.000', '1.000', '26.00', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('12', 'SAO PAULO - CAPITAL', '08000-000', '08499-999', '0.000', '1.000', '22.70', '7', '1.00', '1.72');
INSERT INTO `modelo_transportadora` VALUES ('13', 'SAO PAULO - CAPITAL', '08000-000', '08499-999', '1.000', '2.000', '26.81', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('14', 'SAO PAULO - CAPITAL', '08000-000', '08499-999', '2.000', '3.000', '28.96', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('15', 'SAO PAULO - CAPITAL', '08000-000', '08499-999', '3.000', '4.000', '30.85', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('16', 'SAO PAULO - CAPITAL', '08000-000', '08499-999', '4.000', '5.000', '32.84', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('17', 'SAO PAULO - CAPITAL', '08000-000', '08499-999', '5.000', '10.000', '37.90', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('18', 'SAO PAULO - CAPITAL', '08000-000', '08499-999', '10.000', '15.000', '43.00', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('19', 'SAO PAULO - CAPITAL', '08000-000', '08499-999', '15.000', '30.000', '49.72', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('20', 'SAO PAULO - CAPITAL', '08000-000', '08499-999', '30.000', '50.000', '52.99', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('21', 'SAO PAULO - CAPITAL', '08000-000', '08499-999', '50.000', '80.000', '55.36', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('22', 'SAO PAULO - CAPITAL', '08000-000', '08499-999', '0.000', '1.000', '26.00', '7', null, null);
INSERT INTO `modelo_transportadora` VALUES ('23', 'SAO PAULO - INTERIOR', '01000-000', '19999-999', '1.000', '2.000', '36.65', '12', '1.49', '2.50');
INSERT INTO `modelo_transportadora` VALUES ('24', 'SAO PAULO - INTERIOR', '01000-000', '19999-999', '2.000', '3.000', '65.56', '12', null, null);
INSERT INTO `modelo_transportadora` VALUES ('25', 'SAO PAULO - INTERIOR', '01000-000', '19999-999', '3.000', '4.000', '74.00', '12', null, null);
INSERT INTO `modelo_transportadora` VALUES ('26', 'SAO PAULO - INTERIOR', '01000-000', '19999-999', '4.000', '5.000', '87.00', '12', null, null);
INSERT INTO `modelo_transportadora` VALUES ('27', 'SAO PAULO - INTERIOR', '01000-000', '19999-999', '5.000', '10.000', '94.00', '12', null, null);
INSERT INTO `modelo_transportadora` VALUES ('28', 'SAO PAULO - INTERIOR', '01000-000', '19999-999', '10.000', '15.000', '107.50', '12', null, null);
INSERT INTO `modelo_transportadora` VALUES ('29', 'SAO PAULO - INTERIOR', '01000-000', '19999-999', '15.000', '30.000', '115.60', '12', null, null);
INSERT INTO `modelo_transportadora` VALUES ('30', 'SAO PAULO - INTERIOR', '01000-000', '19999-999', '30.000', '50.000', '125.00', '12', null, null);
INSERT INTO `modelo_transportadora` VALUES ('31', 'SAO PAULO - INTERIOR', '01000-000', '19999-999', '50.000', '80.000', '136.00', '12', null, null);
INSERT INTO `modelo_transportadora` VALUES ('32', 'SAO PAULO - INTERIOR', '01000-000', '19999-999', '90.000', '100.000', '142.56', '12', null, null);

-- ----------------------------
-- Table structure for modo
-- ----------------------------
DROP TABLE IF EXISTS `modo`;
CREATE TABLE `modo` (
  `id_modo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(128) NOT NULL,
  `valor` char(30) NOT NULL,
  `ativo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_modo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of modo
-- ----------------------------
INSERT INTO `modo` VALUES ('1', 'Para venda de produtos', 'loja', '1');
INSERT INTO `modo` VALUES ('2', 'Como um catálogo sem apresentar o preço dos produtos', 'catalogo_sem_preco', '1');
INSERT INTO `modo` VALUES ('3', 'Como um catálogo, apresentando o preço dos produtos', 'catalogo_com_preco', '1');
INSERT INTO `modo` VALUES ('4', 'Como um catálogo com preço para solicitação de orçamento', 'orcamento_com_preco', '1');
INSERT INTO `modo` VALUES ('5', 'Como um catálogo sem preço para solicitação de orçamento', 'orcamento_sem_preco', '1');

-- ----------------------------
-- Table structure for newsletter
-- ----------------------------
DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT '0',
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modifield` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emial_Unique` (`id_shop_default`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of newsletter
-- ----------------------------
INSERT INTO `newsletter` VALUES ('1', '5', null, 'teste@fsadf.com', '0', '2015-02-10 22:43:52', null);
INSERT INTO `newsletter` VALUES ('2', '5', '', 'willa@fsasdf.com', '0', '2015-02-10 22:47:36', '2015-05-10 15:18:00');
INSERT INTO `newsletter` VALUES ('3', '5', null, 'vialoja@gmail.com', '0', '2015-02-10 22:54:11', null);
INSERT INTO `newsletter` VALUES ('4', '5', null, 'dtno@gmail.com', '0', '2015-03-24 00:11:18', null);
INSERT INTO `newsletter` VALUES ('5', '5', null, 'joanilson_souzas@outlook.com', '0', '2015-03-24 11:01:14', null);
INSERT INTO `newsletter` VALUES ('6', '0', null, 'vialojac_shopping@gmail.com', '0', '2015-03-24 11:08:54', null);
INSERT INTO `newsletter` VALUES ('7', '0', 'Wuliams', 'copacabana@gmail.com', '0', '2015-03-24 11:10:35', '2015-05-10 16:11:55');
INSERT INTO `newsletter` VALUES ('8', '0', null, 'teste@fsdinfo.com', '0', '2015-03-24 11:11:49', null);
INSERT INTO `newsletter` VALUES ('9', '0', null, 'sadas@fsd.com', '0', '2015-03-24 11:19:05', null);
INSERT INTO `newsletter` VALUES ('10', '0', null, 'wsduarte@outlook.com', '0', '2015-03-24 11:19:14', null);
INSERT INTO `newsletter` VALUES ('11', '5', null, 'joanilson_souza@outlook.com.br', '0', '2015-03-24 11:24:24', null);
INSERT INTO `newsletter` VALUES ('12', '5', null, 'wsduarte@outlook.com', '0', '2015-03-24 14:08:37', null);
INSERT INTO `newsletter` VALUES ('13', '7', null, 'wsduarte@gmail.com', '0', '2015-06-30 00:00:40', null);
INSERT INTO `newsletter` VALUES ('14', '7', null, 'wsduarte@outlook.com', '0', '2015-06-30 00:00:52', null);
INSERT INTO `newsletter` VALUES ('15', '5', null, 'williamsdesigner@hotmail.com', '0', '2015-07-04 22:26:20', null);
INSERT INTO `newsletter` VALUES ('16', '0', null, 'williams.junior@outlook.com.br', '0', '2016-01-20 18:49:00', null);

-- ----------------------------
-- Table structure for plano_shop
-- ----------------------------
DROP TABLE IF EXISTS `plano_shop`;
CREATE TABLE `plano_shop` (
  `id_plano` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,2) DEFAULT NULL,
  `de_valor` decimal(10,2) DEFAULT NULL,
  `por_valor` decimal(10,2) DEFAULT NULL,
  `status` varchar(45) DEFAULT '1',
  `produtos` varchar(45) DEFAULT NULL,
  `visitas` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `trafego` smallint(6) DEFAULT NULL,
  `bytes` char(20) DEFAULT NULL,
  `comissao` smallint(6) DEFAULT '0',
  `ativo` tinyint(4) DEFAULT '1',
  `desconto` decimal(10,2) DEFAULT NULL,
  `preco_por_produto` decimal(10,2) DEFAULT NULL,
  `preco_por_gb` decimal(10,2) DEFAULT NULL,
  `equipe_suporte` enum('N','S') DEFAULT 'S',
  `equipe_marketing` enum('N','S') DEFAULT 'S',
  PRIMARY KEY (`id_plano`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of plano_shop
-- ----------------------------
INSERT INTO `plano_shop` VALUES ('1', '0.00', null, null, '1', '50', '5000', null, '2', '2147483648', '0', '1', null, null, null, 'N', 'N');
INSERT INTO `plano_shop` VALUES ('2', '47.00', '47.00', '37.00', '1', '100', '10000', null, '4', '4294967296', '0', '1', '15.00', '0.30', '11.70', 'S', 'N');
INSERT INTO `plano_shop` VALUES ('3', '97.00', '97.00', '87.00', '1', '200', '20000', null, '8', '8589934592', '0', '1', '15.00', '0.30', '11.60', 'S', 'N');
INSERT INTO `plano_shop` VALUES ('4', '197.00', '197.00', '167.00', '1', '300', '30000', null, '16', '17179869184', '0', '1', '15.00', '0.30', '11.50', 'S', 'N');
INSERT INTO `plano_shop` VALUES ('5', '397.00', '397.00', '367.00', '1', 'ilimitado', 'ilimitado', null, '32', '34359738368', '0', '1', '15.00', '0.30', '11.40', 'S', 'S');
INSERT INTO `plano_shop` VALUES ('6', '747.00', '747.00', '697.00', '1', 'ilimitado', 'ilimitado', null, '64', '68719476736', '0', '1', '10.00', '0.30', '11.30', 'S', 'S');
INSERT INTO `plano_shop` VALUES ('7', '1397.00', '1397.00', '1347.00', '1', 'ilimitado', 'ilimitado', null, '128', '137438953472', '0', '1', '7.00', '0.30', '11.00', 'S', 'S');
INSERT INTO `plano_shop` VALUES ('8', '2467.00', '2497.00', '2297.00', '1', 'ilimitado', 'ilimitado', null, '256', '274877906944', '0', '1', '5.00', '0.30', '10.00', 'S', 'S');
INSERT INTO `plano_shop` VALUES ('9', '4697.00', '4697.00', '4497.00', '1', 'ilimitado', 'ilimitado', null, '512', '549755813888', '0', '1', '5.00', '0.30', '9.00', 'S', 'S');
INSERT INTO `plano_shop` VALUES ('10', '7997.00', '7997.00', '7497.00', '1', 'ilimitado', 'ilimitado', null, '1024', '1099511627776', '0', '1', '5.00', '0.30', '8.00', 'S', 'S');

-- ----------------------------
-- Table structure for recurso_frete_gratis
-- ----------------------------
DROP TABLE IF EXISTS `recurso_frete_gratis`;
CREATE TABLE `recurso_frete_gratis` (
  `id_frete` int(11) NOT NULL AUTO_INCREMENT,
  `regiao` varchar(45) NOT NULL,
  `name` char(15) NOT NULL,
  `ativo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_frete`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of recurso_frete_gratis
-- ----------------------------
INSERT INTO `recurso_frete_gratis` VALUES ('1', 'Sul', 'sul', '1');
INSERT INTO `recurso_frete_gratis` VALUES ('2', 'Sudeste', 'sudeste', '1');
INSERT INTO `recurso_frete_gratis` VALUES ('3', 'Centro-Oeste', 'centro_oeste', '1');
INSERT INTO `recurso_frete_gratis` VALUES ('4', 'Nordeste', 'nordeste', '1');
INSERT INTO `recurso_frete_gratis` VALUES ('5', 'Norte', 'norte', '1');

-- ----------------------------
-- Table structure for shop
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `id_shop` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_grupo` int(11) unsigned NOT NULL DEFAULT '1',
  `id_plano` tinyint(4) unsigned DEFAULT '1',
  `id_cliente` int(10) DEFAULT '1',
  `loja_tipo` enum('PF','PJ') DEFAULT NULL,
  `nome_loja` varchar(128) NOT NULL,
  `descricao` text,
  `loja_razao_social` varchar(128) DEFAULT NULL,
  `loja_nome_responsavel` varchar(128) DEFAULT NULL,
  `loja_cnpj` varchar(32) DEFAULT NULL,
  `loja_cpf` varchar(32) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `telefone` char(45) DEFAULT NULL,
  `id_categoria` int(11) unsigned NOT NULL DEFAULT '1',
  `id_theme` int(11) unsigned NOT NULL DEFAULT '1',
  `logo` varchar(45) DEFAULT NULL,
  `logo_social` varchar(45) DEFAULT NULL,
  `favicon` varchar(45) DEFAULT NULL,
  `background` varchar(45) DEFAULT NULL,
  `modo` enum('loja','catalogo_sem_preco','catalogo_com_preco','orcamento_com_preco','orcamento_sem_preco') DEFAULT 'loja',
  `copiar_dados` enum('True','False') DEFAULT 'False',
  `ativo` int(1) NOT NULL DEFAULT '1',
  `habilitar_mobile` enum('False','True') DEFAULT 'True',
  `manutencao` enum('False','True') DEFAULT 'False',
  `numero_pedido` int(11) DEFAULT '0',
  `numero_minimo_pedido` int(11) DEFAULT NULL,
  `pedido_valor_minimo` decimal(10,2) DEFAULT NULL,
  `valor_produto_restrito` enum('False','True') DEFAULT 'False',
  `gerenciar_cliente` enum('False','True') DEFAULT 'False',
  `comentarios_produtos` enum('False','True') DEFAULT 'True',
  `blog` varchar(255) DEFAULT NULL,
  `preferencia_url_dominio` enum('off_www','on_www','undefined') DEFAULT 'undefined',
  `ativar_novos_planos` enum('N','S') DEFAULT 'N',
  `conta_cancelada` enum('False','True') DEFAULT 'False' COMMENT 'Ativa o cancelamento de conta',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_shop`),
  KEY `id_shop_group` (`id_shop_grupo`),
  KEY `id_category` (`id_categoria`),
  KEY `id_theme` (`id_theme`),
  KEY `shop_fk_1_idx` (`id_cliente`)) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop
-- ----------------------------
INSERT INTO `shop` VALUES ('1', '1', '1', '1', null, '', null, null, null, null, null, null, null, '1', '1', null, null, null, null, 'catalogo_sem_preco', 'False', '1', 'True', 'False', '1', null, null, 'False', 'False', 'True', null, 'off_www', 'N', 'False', '2016-10-28 13:01:01', '2016-10-28 15:01:03');
INSERT INTO `shop` VALUES ('2', '1', '1', '2', null, '', null, null, null, null, null, null, null, '1', '1', null, null, null, null, 'loja', 'False', '1', 'True', 'False', '1', null, null, 'False', 'False', 'True', null, 'undefined', 'N', 'False', '2016-10-28 13:01:12', '2016-10-28 15:01:14');
INSERT INTO `shop` VALUES ('5', '1', '8', '5', 'PF', 'Universidade do Inglês', 'Duis at nisl quis quam condimentum pulvar.\r\nQuisque euismod convallis eros, quis lacinia\r\nenim rhoncus sed. Duis at nisl quis quam condimentum pulvar.\r\nQuisque euismod convallis eros, quis lacinia\r\nenim rhoncus sed.s', '', 'William Duarte', 'zO+9vOZfXog=000000', 'yz/UpNdnjU4=B2gRXWRxNw0=000014', 'wsduarte@outlook.com', '', '1', '1', 'will.jpg', 'captura-de-tela-de-2016-06-13-12-31-43.png', null, 'captura-de-tela-de-2016-06-14-12-27-06.png', 'loja', 'False', '0', 'True', 'False', '99999', null, '130.00', 'True', 'False', 'False', 'http://blog.vialoja.com.br/sds', 'undefined', 'N', 'False', '2014-07-01 23:21:07', '2016-11-02 00:43:31');
INSERT INTO `shop` VALUES ('7', '1', '1', '6', null, 'Jiboia Shop', null, null, null, null, null, 'joanilson_souza@outlook.com', '', '1', '1', 'logo.png', null, null, null, 'catalogo_sem_preco', 'False', '1', 'True', 'True', '0', null, '0.00', 'False', 'False', 'True', null, 'undefined', 'N', 'False', '2014-09-05 22:45:55', '2016-10-28 15:00:57');
INSERT INTO `shop` VALUES ('15', '1', '1', '24', null, 'Loja 12 Calaçados', null, null, null, null, null, 'williamduarteoficial@gmail.com', '', '1', '1', null, null, null, null, 'loja', 'False', '1', 'True', 'False', '0', null, null, 'False', 'False', 'True', null, 'undefined', 'N', 'False', '2016-04-20 23:46:30', '2016-10-28 14:59:40');
INSERT INTO `shop` VALUES ('25', '1', '1', '35', null, 'ssssssss', null, null, null, null, null, 'vania.diamantinomt@gmail.com', '', '1', '1', '2013-11-19-ps4-02.jpg', null, null, null, 'loja', 'False', '1', 'True', 'False', '0', null, null, 'False', 'False', 'True', null, 'undefined', 'N', 'False', '2016-04-23 02:01:04', '2016-10-28 14:59:43');

-- ----------------------------
-- Table structure for shop_arquivo
-- ----------------------------
DROP TABLE IF EXISTS `shop_arquivo`;
CREATE TABLE `shop_arquivo` (
  `id_arquivo` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `tipo` enum('pdf','js','css','img') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id_arquivo`),
  KEY `tipo` (`tipo`),
  KEY `shop_arquivo_fk_1_idx` (`id_shop_default`)) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_arquivo
-- ----------------------------
INSERT INTO `shop_arquivo` VALUES ('14', '5', 'boleto-1.pdf', 'pdf', '2015-05-27 10:57:21');
INSERT INTO `shop_arquivo` VALUES ('15', '5', '12986584-1175742182437463-142227257-o-1.jpg', 'img', '2016-04-22 01:34:25');

-- ----------------------------
-- Table structure for shop_atividade
-- ----------------------------
DROP TABLE IF EXISTS `shop_atividade`;
CREATE TABLE `shop_atividade` (
  `id_atividade` int(11) NOT NULL,
  `id_shop_default` int(11) NOT NULL,
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  `ativo` tinyint(4) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_atividade`),
  UNIQUE KEY `id_categoria_idx` (`id_atividade`,`id_shop_default`) USING BTREE,
  KEY `categoria_shop_fk_1_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_atividade
-- ----------------------------
INSERT INTO `shop_atividade` VALUES ('1', '5', '0', '1', '2016-10-24 14:54:29', '2016-10-24 15:54:29');
INSERT INTO `shop_atividade` VALUES ('17', '5', '0', '1', '2016-10-24 14:54:29', '2016-10-24 15:54:29');
INSERT INTO `shop_atividade` VALUES ('24', '15', '0', '1', '2016-01-22 17:37:44', '2016-04-21 00:54:43');

-- ----------------------------
-- Table structure for shop_banner
-- ----------------------------
DROP TABLE IF EXISTS `shop_banner`;
CREATE TABLE `shop_banner` (
  `id_banner` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT NULL,
  `ativo` enum('False','True') DEFAULT 'True',
  `nome` varchar(128) NOT NULL,
  `caminho` varchar(255) DEFAULT NULL,
  `local_publicacao` varchar(45) NOT NULL,
  `pagina_publicacao` varchar(45) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `target` enum('_blank') DEFAULT NULL,
  `titulo` text,
  `mapa_imagem` text,
  `posicao` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_banner`),
  UNIQUE KEY `banner_Unique` (`id_shop_default`,`nome`,`local_publicacao`) USING BTREE,
  KEY `shop_banner_fk_1_idx` (`id_shop_default`)) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_banner
-- ----------------------------
INSERT INTO `shop_banner` VALUES ('16', '5', 'True', 'Banner1', 'img-baner4.jpg', 'banner', 'pagina_inicial', '', null, 'titulo Banner1', '', '1', '2015-02-26 13:54:48', '2016-10-28 15:12:47');
INSERT INTO `shop_banner` VALUES ('17', '5', 'True', 'Banner2', 'img-baner3.jpg', 'banner', 'pagina_inicial', '', null, 'Banner2 titluo', '', '0', '2015-02-26 13:56:06', '2016-09-24 04:17:36');
INSERT INTO `shop_banner` VALUES ('18', '5', 'True', 'Banner3', 'img-baner7.jpg', 'banner', 'pagina_inicial', '', null, 'Banner3', '', '2', '2015-02-26 13:56:49', '2016-09-24 04:17:11');
INSERT INTO `shop_banner` VALUES ('19', '5', 'True', 'Banner4', 'img-baner10.jpg', 'banner', 'pagina_inicial', '', null, 'Banner 4', '', '3', '2015-02-26 13:57:14', '2016-10-28 15:12:47');
INSERT INTO `shop_banner` VALUES ('22', '5', 'True', 'Mini Banner 5', 'img-baner9-2.jpg', 'minibanner', 'pagina_inicial', 'https://support.google.com/webmasters/answer/96569?hl=pt-BR', null, 'Mini Banner 5', '', '0', '2015-02-26 13:59:23', '2016-10-28 15:12:47');
INSERT INTO `shop_banner` VALUES ('25', '5', 'False', 'Slider Full Banner 2', '5-1.jpg', 'fullbanner', 'todas', 'https://support.google.com/webmasters/answer/96569?hl=pt-BR', null, 'teste', '', '1', '2015-02-27 10:51:47', '2016-10-28 15:12:47');
INSERT INTO `shop_banner` VALUES ('26', '5', 'False', 'Slider Default Banner 1', '1-1.jpg', 'defaultbanner', 'pagina_inicial', '', null, '', '', '0', '2015-02-27 12:22:39', '2016-10-28 15:12:47');
INSERT INTO `shop_banner` VALUES ('27', '5', 'False', 'Slider Default Banner 2', '4-1-2.jpg', 'defaultbanner', 'pagina_inicial', '', null, '', '', '1', '2015-02-27 12:22:56', '2016-10-28 15:12:47');
INSERT INTO `shop_banner` VALUES ('29', '5', 'True', 'Banner Tarja 1', 'img-baner11.jpg', 'tarja', 'pagina_inicial', '', null, '', '', '0', '2015-02-28 16:40:28', '2015-02-28 17:40:28');
INSERT INTO `shop_banner` VALUES ('30', '5', 'True', 'Banner Tarja 2', 'img-baner12.jpg', 'tarja', 'pagina_inicial', 'http://abelhas.pt/MeuSucesso', null, '', '', '1', '2015-02-28 17:18:35', '2016-10-28 15:12:47');
INSERT INTO `shop_banner` VALUES ('31', '5', 'True', 'Banner Vitrine1', 'img-category5-873x270.jpg', 'vitrine', 'pagina_inicial', 'https://support.google.com/webmasters/answer/96569?hl=pt-BR', null, 'teste', '', '0', '2015-02-28 18:23:25', '2016-10-28 15:12:47');
INSERT INTO `shop_banner` VALUES ('32', '5', 'True', 'Dfgsd', 'img-20150325-152552.jpg', 'fullbanner', 'pagina_inicial', 'gdsfg', null, 'gdsfg', '', '0', '2015-06-01 18:35:20', '2016-09-24 04:15:18');

-- ----------------------------
-- Table structure for shop_carrinho
-- ----------------------------
DROP TABLE IF EXISTS `shop_carrinho`;
CREATE TABLE `shop_carrinho` (
  `id_carrinho` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_cliente_default` int(11) DEFAULT NULL,
  `id_envio_default` int(11) DEFAULT NULL,
  `id_cupom_default` int(11) DEFAULT NULL,
  `cookie_session_id` varchar(130) DEFAULT NULL,
  `frete_valor` decimal(10,2) DEFAULT NULL,
  `cep` char(10) DEFAULT NULL,
  `status` smallint(6) DEFAULT '0',
  `ip` varchar(98) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_carrinho`),
  UNIQUE KEY `session_id_Unique` (`cookie_session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_carrinho
-- ----------------------------
INSERT INTO `shop_carrinho` VALUES ('53', '5', null, null, null, '840e1587f7732b64481053ba75216e221745bc09218c5aafac6d3c786f82cf69', null, '78450-000', '0', '127.0.0.1', '2015-07-13 14:39:43', '2015-07-13 15:39:43');
INSERT INTO `shop_carrinho` VALUES ('55', '5', null, null, null, '672a429e7a2077a1e177018368397fd480180326a10ff43b5969f0c91b0dc3df', null, '78450-000', '0', '127.0.0.1', '2015-07-15 09:47:40', '2015-07-15 10:47:40');
INSERT INTO `shop_carrinho` VALUES ('56', '5', null, null, null, 'ace006a943232c69f78050cb6b2f40f907ff04fd87ff4d4d61b6cb0e821d972f', null, null, '0', '127.0.0.1', '2015-07-20 13:52:39', '2015-07-20 14:52:39');
INSERT INTO `shop_carrinho` VALUES ('58', '5', null, null, null, 'e0feb93ce1b1467b07b33e58bea83dfefd01530049ae247f0c9032c8e11eae58', null, '78450000', '0', '127.0.0.1', '2015-07-21 09:42:06', '2015-07-21 10:42:46');
INSERT INTO `shop_carrinho` VALUES ('59', '5', '5', null, null, '6279457fd4ec085b21d44711cf751c46a30201f0b851a379540bb92e42eff96f', null, null, '0', '127.0.0.1', '2015-08-26 02:23:26', '2015-08-26 03:23:26');
INSERT INTO `shop_carrinho` VALUES ('60', '5', '5', null, null, '47cf7770de4eddf2eca391317f22661d615c78d988a901fd108931cefff1dff6', null, '78450-000', '0', '127.0.0.1', '2016-01-08 02:20:37', '2016-01-08 03:27:08');
INSERT INTO `shop_carrinho` VALUES ('61', '5', null, '100', null, '69f472ebf9e175ed291b8135798b261ce9c5e508d50d6a1b3c3efc4aa4c204df', null, '78450-000', '0', '127.0.0.1', '2016-01-08 15:43:23', '2016-01-14 02:47:56');
INSERT INTO `shop_carrinho` VALUES ('62', '5', null, null, null, 'f0f51c57ee9be8aab784fd3f9263d2a9f3766c87738953bcea10161aaf8e81f1', null, '78450-000', '0', '127.0.0.1', '2016-01-09 14:53:39', '2016-01-09 15:54:11');
INSERT INTO `shop_carrinho` VALUES ('65', '5', null, '1', null, 'b5d97791a2ba48d8c82c675c0c9dbba11cbd7bb19175b22edfb5de7221b217dc', null, '78450-000', '0', '127.0.0.1', '2016-01-14 15:54:20', '2016-01-15 15:36:52');
INSERT INTO `shop_carrinho` VALUES ('67', '5', null, '2', '11', 'c4eb88afd2de82d357a3ec2ceb536d9a8d9214061fac5468b398f6a8767bf67f', null, '78450-000', '0', '127.0.0.1', '2016-01-18 10:24:11', '2016-01-19 16:09:54');
INSERT INTO `shop_carrinho` VALUES ('68', '5', '5', null, null, '5b7cceed2ce58e7deae0bf7908b7aa3328b12b775ab43d9ceea2619addae2595', null, null, '0', '127.0.0.1', '2016-01-25 11:54:07', '2016-01-25 12:54:07');

-- ----------------------------
-- Table structure for shop_carrinho_produto_atributo
-- ----------------------------
DROP TABLE IF EXISTS `shop_carrinho_produto_atributo`;
CREATE TABLE `shop_carrinho_produto_atributo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrinho_descricao_default` int(11) DEFAULT NULL,
  `id_produto_default` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_carrinho_produto_atributo_fk_1_idx` (`id_carrinho_descricao_default`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_carrinho_produto_atributo
-- ----------------------------

-- ----------------------------
-- Table structure for shop_carrinho_produto_descricao
-- ----------------------------
DROP TABLE IF EXISTS `shop_carrinho_produto_descricao`;
CREATE TABLE `shop_carrinho_produto_descricao` (
  `id_carrinho_descricao` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrinho_default` int(11) DEFAULT NULL,
  `id_produto_default` int(11) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `qtde` smallint(6) DEFAULT NULL,
  `session_id` varchar(130) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `key` char(32) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_carrinho_descricao`),
  KEY `shop_carrinho_produto_descricao_fk_1_idx` (`id_carrinho_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_carrinho_produto_descricao
-- ----------------------------
INSERT INTO `shop_carrinho_produto_descricao` VALUES ('104', '53', '733', '89.00', '2', null, null, '794ddcb7bd59ebd32d2eed35d43c0b7d', '2015-07-13 14:39:43', '2015-07-14 02:25:28');
INSERT INTO `shop_carrinho_produto_descricao` VALUES ('107', '53', '732', '289.00', '1', null, null, '4ade5f88207ed92ad28cfa2f1ef50815', '2015-07-13 15:24:24', '2015-07-13 19:31:44');
INSERT INTO `shop_carrinho_produto_descricao` VALUES ('108', '55', '732', '289.00', '1', null, null, '9359fa6611bee3c81c541f5f520e5c90', '2015-07-15 09:47:40', '2015-07-15 10:47:40');

-- ----------------------------
-- Table structure for shop_categoria
-- ----------------------------
DROP TABLE IF EXISTS `shop_categoria`;
CREATE TABLE `shop_categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_atividade` int(10) unsigned DEFAULT '0',
  `categoria_parent_id` int(11) unsigned DEFAULT '0',
  `id_shop_default` int(11) NOT NULL,
  `ativa` enum('False','True') DEFAULT 'True',
  `nome_categoria` varchar(128) NOT NULL,
  `apelido` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `descricao` text,
  `title` varchar(70) DEFAULT NULL,
  `description` varchar(160) DEFAULT NULL,
  `posicao` int(11) unsigned DEFAULT '0',
  `nleft` int(11) unsigned DEFAULT '0',
  `nright` int(10) unsigned DEFAULT NULL,
  `is_root_categoria` tinyint(6) unsigned DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `categoria_Unique` (`id_shop_default`,`nome_categoria`),
  KEY `shop_categoria_fk_1_idx` (`id_shop_default`),
  KEY `categoria_parent_id` (`categoria_parent_id`) USING BTREE,
  KEY `posicao` (`posicao`),
  KEY `nleft` (`nleft`),
  KEY `nright` (`nright`)) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_categoria
-- ----------------------------
INSERT INTO `shop_categoria` VALUES ('241', '0', '0', '5', 'True', 'Roupas  Teste', 'roupas-teste', 'roupas-teste', null, null, null, '4', '0', null, '0', '2016-09-02 17:50:33', '2016-09-24 04:06:29');
INSERT INTO `shop_categoria` VALUES ('242', '0', '0', '5', 'True', 'Acessórios', 'acessorios', 'acessorios', null, null, null, '0', '0', null, '0', '2016-09-02 17:50:33', '2016-09-24 04:06:28');
INSERT INTO `shop_categoria` VALUES ('243', '0', '242', '5', 'True', 'Bolsas  Teste', 'bolsas-teste', 'bolsas-teste', null, null, null, '0', '1', null, '0', '2016-09-02 17:50:33', '2016-09-02 18:50:33');
INSERT INTO `shop_categoria` VALUES ('244', '0', '0', '5', 'True', 'Livros  Teste', 'livros-teste', 'livros-teste', null, null, null, '3', '0', null, '0', '2016-09-02 17:50:33', '2016-09-24 04:06:29');
INSERT INTO `shop_categoria` VALUES ('245', '0', '244', '5', 'True', 'Informática Teste', 'informatica-teste', 'informatica-teste', null, null, null, '0', '1', null, '0', '2016-09-02 17:50:33', '2016-09-02 18:50:33');
INSERT INTO `shop_categoria` VALUES ('246', '0', '245', '5', 'True', 'Linux Teste', 'linux-teste', 'linux-teste', null, null, null, '0', '2', null, '0', '2016-09-02 17:50:33', '2016-09-02 18:50:33');
INSERT INTO `shop_categoria` VALUES ('247', '0', '0', '5', 'True', 'Cases  Teste', 'cases-teste', 'cases-teste', null, null, null, '1', '0', null, '0', '2016-09-02 17:50:33', '2016-09-24 04:06:29');
INSERT INTO `shop_categoria` VALUES ('248', '0', '0', '5', 'True', 'Button  Teste', 'button-teste', 'button-teste', null, null, null, '2', '0', null, '0', '2016-09-02 17:50:33', '2016-09-24 04:06:29');

-- ----------------------------
-- Table structure for shop_code
-- ----------------------------
DROP TABLE IF EXISTS `shop_code`;
CREATE TABLE `shop_code` (
  `id_code` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `descricao` char(32) NOT NULL,
  `local_publicacao` enum('rodape','cabecalho') NOT NULL DEFAULT 'rodape',
  `tipo` enum('javascript','html','css') NOT NULL DEFAULT 'html',
  `pagina_publicacao` varchar(255) NOT NULL,
  `conteudo` mediumtext NOT NULL,
  `ativo` tinyint(4) unsigned DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `time` int(11) DEFAULT NULL,
  `auditoria` tinyint(4) DEFAULT '0',
  `data_auditoria` datetime DEFAULT NULL,
  `reprovado` tinyint(4) DEFAULT '0',
  `edit_basico` enum('cabecalho','rodape') DEFAULT NULL,
  PRIMARY KEY (`id_code`),
  UNIQUE KEY `id_shop_default_UNIQUE` (`id_shop_default`,`descricao`) USING BTREE,
  KEY `shop_code_fk_1_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_code
-- ----------------------------
INSERT INTO `shop_code` VALUES ('9', '5', 'Código do cabeçalho', 'cabecalho', 'html', 'todas', 'sdsdbc dd', '1', '2016-04-22 01:13:16', '2016-04-22 02:13:16', '1461298396', '0', null, '0', 'cabecalho');
INSERT INTO `shop_code` VALUES ('10', '5', 'Código do rodapé', 'rodape', 'html', 'todas', 'dsbcxvb dd', '1', '2016-04-22 01:13:16', '2016-04-22 02:13:16', '1461298396', '0', null, '0', 'rodape');
INSERT INTO `shop_code` VALUES ('11', '5', 'teste', 'cabecalho', 'html', 'loja/index', 'dsafsdfsad', '1', '2016-04-22 01:13:33', '2016-04-22 02:13:33', '1461298413', '0', null, '0', null);
INSERT INTO `shop_code` VALUES ('13', '25', 'Código do cabeçalho', 'cabecalho', 'html', 'todas', '/* !\r\n* Bootstrap v2.3.1\r\n*\r\n* Copyright 2012 Twitter, Inc\r\n* Licensed under the Apache License v2.0\r\n* http://www.apache.org/licenses/LICENSE-2.0\r\n*\r\n* Designed and built with all the love in the world @twitter by @mdo and @fat. */.clearfix {\r\n	*zoom: 1\r\n}\r\n.clearfix:before, .clearfix:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.clearfix:after {\r\n	clear: both\r\n}\r\n.hide-text {\r\n	font: 0/0 a;\r\n	color: transparent;\r\n	text-shadow: none;\r\n	background-color: transparent;\r\n	border: 0\r\n}\r\n.input-block-level {\r\n	display: block;\r\n	width: 100%;\r\n	min-height: 30px;\r\n	-webkit-box-sizing: border-box;\r\n	-moz-box-sizing: border-box;\r\n	box-sizing: border-box\r\n}\r\narticle, aside, details, figcaption, figure, footer, header, hgroup, nav, section {\r\n	display: block\r\n}\r\naudio, canvas, video {\r\n	display: inline-block;\r\n	*display: inline;\r\n	*zoom: 1\r\n}\r\naudio:not([controls]) {\r\n	display: none\r\n}\r\nhtml {\r\n	font-size: 100%;\r\n	-webkit-text-size-adjust: 100%;\r\n	-ms-text-size-adjust: 100%\r\n}\r\na:focus {\r\n	outline: thin dotted #333;\r\n	outline: 5px auto -webkit-focus-ring-color;\r\n	outline-offset: -2px\r\n}\r\na:hover, a:active {\r\n	outline: 0\r\n}\r\nsub, sup {\r\n	position: relative;\r\n	font-size: 75%;\r\n	line-height: 0;\r\n	vertical-align: baseline\r\n}\r\nsup {\r\n	top: -0.5em\r\n}\r\nsub {\r\n	bottom: -0.25em\r\n}\r\nimg {\r\n	width: auto\\9;\r\n	height: auto;\r\n	max-width: 100%;\r\n	vertical-align: middle;\r\n	border: 0;\r\n	-ms-interpolation-mode: bicubic\r\n}\r\n#map_canvas img, .google-maps img {\r\n	max-width: none\r\n}\r\nbutton, input, select, textarea {\r\n	margin: 0;\r\n	font-size: 100%;\r\n	vertical-align: middle\r\n}\r\nbutton, input {\r\n	*overflow: visible;\r\n	line-height: normal\r\n}\r\nbutton::-moz-focus-inner, input::-moz-focus-inner {\r\n	padding: 0;\r\n	border: 0\r\n}\r\nbutton, html input[type=&quot;button&quot;], input[type=&quot;reset&quot;], input[type=&quot;submit&quot;] {\r\n	cursor: pointer;\r\n	-webkit-appearance: button\r\n}\r\nlabel, select, button, input[type=&quot;button&quot;], input[type=&quot;reset&quot;], input[type=&quot;submit&quot;], input[type=&quot;radio&quot;], input[type=&quot;checkbox&quot;] {\r\n	cursor: pointer\r\n}\r\ninput[type=&quot;search&quot;] {\r\n	-webkit-box-sizing: content-box;\r\n	-moz-box-sizing: content-box;\r\n	box-sizing: content-box;\r\n	-webkit-appearance: textfield\r\n}\r\ninput[type=&quot;search&quot;]::-webkit-search-decoration, input[type=&quot;search&quot;]::-webkit-search-cancel-button {\r\n	-webkit-appearance: none\r\n}\r\ntextarea {\r\n	overflow: auto;\r\n	vertical-align: top\r\n}\r\n@media print {\r\n	*{color: #000 !important;\r\n		text-shadow: none !important;\r\n		background: transparent !important;\r\n		box-shadow: none !important\r\n	}\r\n	a, a:visited {\r\n		text-decoration: underline\r\n	}\r\n	a[href]:after {\r\n		content: &quot; (&quot; attr(href) &quot;)&quot;\r\n	}\r\n	abbr[title]:after {\r\n		content: &quot; (&quot; attr(title) &quot;)&quot;\r\n	}\r\n	.ir a:after, a[href^=&quot;javascript:&quot;]:after, a[href^=&quot;#&quot;]:after {\r\n		content: &quot;&quot;\r\n	}\r\n	pre, blockquote {\r\n		border: 1px solid #999;\r\n		page-break-inside: avoid\r\n	}\r\n	thead {\r\n		display: table-header-group\r\n	}\r\n	tr, img {\r\n		page-break-inside: avoid\r\n	}\r\n	img {\r\n		max-width: 100% !important\r\n	}\r\n	@page {\r\n		margin: .5cm\r\n	}\r\n	p, h2, h3 {\r\n		orphans: 3;\r\n		widows: 3\r\n	}\r\n	h2, h3 {\r\n		page-break-after: avoid\r\n	}\r\n}\r\nbody {\r\n	margin: 0;\r\n	font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\r\n	font-size: 14px;\r\n	line-height: 20px;\r\n	color: #333;\r\n	background-color: #fff\r\n}\r\na {\r\n	color: #08c;\r\n	text-decoration: none\r\n}\r\na:hover, a:focus {\r\n	color: #005580;\r\n	text-decoration: underline\r\n}\r\n.img-rounded {\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px\r\n}\r\n.img-polaroid {\r\n	padding: 4px;\r\n	background-color: #fff;\r\n	border: 1px solid #ccc;\r\n	border: 1px solid rgba(0, 0, 0, 0.2);\r\n	-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);\r\n	-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);\r\n	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1)\r\n}\r\n.img-circle {\r\n	-webkit-border-radius: 500px;\r\n	-moz-border-radius: 500px;\r\n	border-radius: 500px\r\n}\r\n.row {\r\n	margin-left: -20px;\r\n	*zoom: 1\r\n}\r\n.row:before, .row:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.row:after {\r\n	clear: both\r\n}\r\n[class*=&quot;span&quot;] {\r\n	float: left;\r\n	min-height: 1px;\r\n	margin-left: 20px\r\n}\r\n.container, .navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container {\r\n	width: 940px\r\n}\r\n.span12 {\r\n	width: 940px\r\n}\r\n.span11 {\r\n	width: 860px\r\n}\r\n.span10 {\r\n	width: 780px\r\n}\r\n.span9 {\r\n	width: 700px\r\n}\r\n.span8 {\r\n	width: 620px\r\n}\r\n.span7 {\r\n	width: 540px\r\n}\r\n.span6 {\r\n	width: 460px\r\n}\r\n.span5 {\r\n	width: 380px\r\n}\r\n.span4 {\r\n	width: 300px\r\n}\r\n.span3 {\r\n	width: 220px\r\n}\r\n.span2 {\r\n	width: 140px\r\n}\r\n.span1 {\r\n	width: 60px\r\n}\r\n.offset12 {\r\n	margin-left: 980px\r\n}\r\n.offset11 {\r\n	margin-left: 900px\r\n}\r\n.offset10 {\r\n	margin-left: 820px\r\n}\r\n.offset9 {\r\n	margin-left: 740px\r\n}\r\n.offset8 {\r\n	margin-left: 660px\r\n}\r\n.offset7 {\r\n	margin-left: 580px\r\n}\r\n.offset6 {\r\n	margin-left: 500px\r\n}\r\n.offset5 {\r\n	margin-left: 420px\r\n}\r\n.offset4 {\r\n	margin-left: 340px\r\n}\r\n.offset3 {\r\n	margin-left: 260px\r\n}\r\n.offset2 {\r\n	margin-left: 180px\r\n}\r\n.offset1 {\r\n	margin-left: 100px\r\n}\r\n.row-fluid {\r\n	width: 100%;\r\n	*zoom: 1\r\n}\r\n.row-fluid:before, .row-fluid:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.row-fluid:after {\r\n	clear: both\r\n}\r\n.row-fluid [class*=&quot;span&quot;] {\r\n	display: block;\r\n	float: left;\r\n	width: 100%;\r\n	min-height: 30px;\r\n	margin-left: 2.127659574468085%;\r\n	*margin-left: 2.074468085106383%;\r\n	-webkit-box-sizing: border-box;\r\n	-moz-box-sizing: border-box;\r\n	box-sizing: border-box\r\n}\r\n.row-fluid [class*=&quot;span&quot;]:first-child {\r\n	margin-left: 0\r\n}\r\n.row-fluid .controls-row [class*=&quot;span&quot;]+[class*=&quot;span&quot;] {\r\n	margin-left: 2.127659574468085%\r\n}\r\n.row-fluid .span12 {\r\n	width: 100%;\r\n	*width: 99.94680851063829%\r\n}\r\n.row-fluid .span11 {\r\n	width: 91.48936170212765%;\r\n	*width: 91.43617021276594%\r\n}\r\n.row-fluid .span10 {\r\n	width: 82.97872340425532%;\r\n	*width: 82.92553191489361%\r\n}\r\n.row-fluid .span9 {\r\n	width: 74.46808510638297%;\r\n	*width: 74.41489361702126%\r\n}\r\n.row-fluid .span8 {\r\n	width: 65.95744680851064%;\r\n	*width: 65.90425531914893%\r\n}\r\n.row-fluid .span7 {\r\n	width: 57.44680851063829%;\r\n	*width: 57.39361702127659%\r\n}\r\n.row-fluid .span6 {\r\n	width: 48.93617021276595%;\r\n	*width: 48.88297872340425%\r\n}\r\n.row-fluid .span5 {\r\n	width: 40.42553191489362%;\r\n	*width: 40.37234042553192%\r\n}\r\n.row-fluid .span4 {\r\n	width: 31.914893617021278%;\r\n	*width: 31.861702127659576%\r\n}\r\n.row-fluid .span3 {\r\n	width: 23.404255319148934%;\r\n	*width: 23.351063829787233%\r\n}\r\n.row-fluid .span2 {\r\n	width: 14.893617021276595%;\r\n	*width: 14.840425531914894%\r\n}\r\n.row-fluid .span1 {\r\n	width: 6.382978723404255%;\r\n	*width: 6.329787234042553%\r\n}\r\n.row-fluid .offset12 {\r\n	margin-left: 104.25531914893617%;\r\n	*margin-left: 104.14893617021275%\r\n}\r\n.row-fluid .offset12:first-child {\r\n	margin-left: 102.12765957446808%;\r\n	*margin-left: 102.02127659574467%\r\n}\r\n.row-fluid .offset11 {\r\n	margin-left: 95.74468085106382%;\r\n	*margin-left: 95.6382978723404%\r\n}\r\n.row-fluid .offset11:first-child {\r\n	margin-left: 93.61702127659574%;\r\n	*margin-left: 93.51063829787232%\r\n}\r\n.row-fluid .offset10 {\r\n	margin-left: 87.23404255319149%;\r\n	*margin-left: 87.12765957446807%\r\n}\r\n.row-fluid .offset10:first-child {\r\n	margin-left: 85.1063829787234%;\r\n	*margin-left: 84.99999999999999%\r\n}\r\n.row-fluid .offset9 {\r\n	margin-left: 78.72340425531914%;\r\n	*margin-left: 78.61702127659572%\r\n}\r\n.row-fluid .offset9:first-child {\r\n	margin-left: 76.59574468085106%;\r\n	*margin-left: 76.48936170212764%\r\n}\r\n.row-fluid .offset8 {\r\n	margin-left: 70.2127659574468%;\r\n	*margin-left: 70.10638297872339%\r\n}\r\n.row-fluid .offset8:first-child {\r\n	margin-left: 68.08510638297872%;\r\n	*margin-left: 67.9787234042553%\r\n}\r\n.row-fluid .offset7 {\r\n	margin-left: 61.70212765957446%;\r\n	*margin-left: 61.59574468085106%\r\n}\r\n.row-fluid .offset7:first-child {\r\n	margin-left: 59.574468085106375%;\r\n	*margin-left: 59.46808510638297%\r\n}\r\n.row-fluid .offset6 {\r\n	margin-left: 53.191489361702125%;\r\n	*margin-left: 53.085106382978715%\r\n}\r\n.row-fluid .offset6:first-child {\r\n	margin-left: 51.063829787234035%;\r\n	*margin-left: 50.95744680851063%\r\n}\r\n.row-fluid .offset5 {\r\n	margin-left: 44.68085106382979%;\r\n	*margin-left: 44.57446808510638%\r\n}\r\n.row-fluid .offset5:first-child {\r\n	margin-left: 42.5531914893617%;\r\n	*margin-left: 42.4468085106383%\r\n}\r\n.row-fluid .offset4 {\r\n	margin-left: 36.170212765957444%;\r\n	*margin-left: 36.06382978723405%\r\n}\r\n.row-fluid .offset4:first-child {\r\n	margin-left: 34.04255319148936%;\r\n	*margin-left: 33.93617021276596%\r\n}\r\n.row-fluid .offset3 {\r\n	margin-left: 27.659574468085104%;\r\n	*margin-left: 27.5531914893617%\r\n}\r\n.row-fluid .offset3:first-child {\r\n	margin-left: 25.53191489361702%;\r\n	*margin-left: 25.425531914893618%\r\n}\r\n.row-fluid .offset2 {\r\n	margin-left: 19.148936170212764%;\r\n	*margin-left: 19.04255319148936%\r\n}\r\n.row-fluid .offset2:first-child {\r\n	margin-left: 17.02127659574468%;\r\n	*margin-left: 16.914893617021278%\r\n}\r\n.row-fluid .offset1 {\r\n	margin-left: 10.638297872340425%;\r\n	*margin-left: 10.53191489361702%\r\n}\r\n.row-fluid .offset1:first-child {\r\n	margin-left: 8.51063829787234%;\r\n	*margin-left: 8.404255319148938%\r\n}\r\n[class*=&quot;span&quot;].hide, .row-fluid [class*=&quot;span&quot;].hide {\r\n	display: none\r\n}\r\n[class*=&quot;span&quot;].pull-right, .row-fluid [class*=&quot;span&quot;].pull-right {\r\n	float: right\r\n}\r\n.container {\r\n	margin-right: auto;\r\n	margin-left: auto;\r\n	*zoom: 1\r\n}\r\n.container:before, .container:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.container:after {\r\n	clear: both\r\n}\r\n.container-fluid {\r\n	padding-right: 20px;\r\n	padding-left: 20px;\r\n	*zoom: 1\r\n}\r\n.container-fluid:before, .container-fluid:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.container-fluid:after {\r\n	clear: both\r\n}\r\np {\r\n	margin: 0 0 10px\r\n}\r\n.lead {\r\n	margin-bottom: 20px;\r\n	font-size: 21px;\r\n	font-weight: 200;\r\n	line-height: 30px\r\n}\r\nsmall {\r\n	font-size: 85%\r\n}\r\nstrong {\r\n	font-weight: bold\r\n}\r\nem {\r\n	font-style: italic\r\n}\r\ncite {\r\n	font-style: normal\r\n}\r\n.muted {\r\n	color: #999\r\n}\r\na.muted:hover, a.muted:focus {\r\n	color: #808080\r\n}\r\n.text-warning {\r\n	color: #c09853\r\n}\r\na.text-warning:hover, a.text-warning:focus {\r\n	color: #a47e3c\r\n}\r\n.text-error {\r\n	color: #b94a48\r\n}\r\na.text-error:hover, a.text-error:focus {\r\n	color: #953b39\r\n}\r\n.text-info {\r\n	color: #3a87ad\r\n}\r\na.text-info:hover, a.text-info:focus {\r\n	color: #2d6987\r\n}\r\n.text-success {\r\n	color: #468847\r\n}\r\na.text-success:hover, a.text-success:focus {\r\n	color: #356635\r\n}\r\n.text-left {\r\n	text-align: left\r\n}\r\n.text-right {\r\n	text-align: right\r\n}\r\n.text-center {\r\n	text-align: center\r\n}\r\nh1, h2, h3, h4, h5, h6 {\r\n	margin: 10px 0;\r\n	font-family: inherit;\r\n	font-weight: bold;\r\n	line-height: 20px;\r\n	color: inherit;\r\n	text-rendering: optimizelegibility\r\n}\r\nh1 small, h2 small, h3 small, h4 small, h5 small, h6 small {\r\n	font-weight: normal;\r\n	line-height: 1;\r\n	color: #999\r\n}\r\nh1, h2, h3 {\r\n	line-height: 40px\r\n}\r\nh1 {\r\n	font-size: 38.5px\r\n}\r\nh2 {\r\n	font-size: 31.5px\r\n}\r\nh3 {\r\n	font-size: 24.5px\r\n}\r\nh4 {\r\n	font-size: 17.5px\r\n}\r\nh5 {\r\n	font-size: 14px\r\n}\r\nh6 {\r\n	font-size: 11.9px\r\n}\r\nh1 small {\r\n	font-size: 24.5px\r\n}\r\nh2 small {\r\n	font-size: 17.5px\r\n}\r\nh3 small {\r\n	font-size: 14px\r\n}\r\nh4 small {\r\n	font-size: 14px\r\n}\r\n.page-header {\r\n	padding-bottom: 9px;\r\n	margin: 20px 0 30px;\r\n	border-bottom: 1px solid #eee\r\n}\r\nul, ol {\r\n	padding: 0;\r\n	margin: 0 0 10px 25px\r\n}\r\nul ul, ul ol, ol ol, ol ul {\r\n	margin-bottom: 0\r\n}\r\nli {\r\n	line-height: 20px\r\n}\r\nul.unstyled, ol.unstyled {\r\n	margin-left: 0;\r\n	list-style: none\r\n}\r\nul.inline, ol.inline {\r\n	margin-left: 0;\r\n	list-style: none\r\n}\r\nul.inline&gt;li, ol.inline&gt;li {\r\n	display: inline-block;\r\n	*display: inline;\r\n	padding-right: 5px;\r\n	padding-left: 5px;\r\n	*zoom: 1\r\n}\r\ndl {\r\n	margin-bottom: 20px\r\n}\r\ndt, dd {\r\n	line-height: 20px\r\n}\r\ndt {\r\n	font-weight: bold\r\n}\r\ndd {\r\n	margin-left: 10px\r\n}\r\n.dl-horizontal {\r\n	*zoom: 1\r\n}\r\n.dl-horizontal:before, .dl-horizontal:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.dl-horizontal:after {\r\n	clear: both\r\n}\r\n.dl-horizontal dt {\r\n	float: left;\r\n	width: 160px;\r\n	overflow: hidden;\r\n	clear: left;\r\n	text-align: right;\r\n	text-overflow: ellipsis;\r\n	white-space: nowrap\r\n}\r\n.dl-horizontal dd {\r\n	margin-left: 180px\r\n}\r\nhr {\r\n	margin: 20px 0;\r\n	border: 0;\r\n	border-top: 1px solid #eee;\r\n	border-bottom: 1px solid #fff\r\n}\r\nabbr[title], abbr[data-original-title] {\r\n	cursor: help;\r\n	border-bottom: 1px dotted #999\r\n}\r\nabbr.initialism {\r\n	font-size: 90%;\r\n	text-transform: uppercase\r\n}\r\nblockquote {\r\n	padding: 0 0 0 15px;\r\n	margin: 0 0 20px;\r\n	border-left: 5px solid #eee\r\n}\r\nblockquote p {\r\n	margin-bottom: 0;\r\n	font-size: 17.5px;\r\n	font-weight: 300;\r\n	line-height: 1.25\r\n}\r\nblockquote small {\r\n	display: block;\r\n	line-height: 20px;\r\n	color: #999\r\n}\r\nblockquote small:before {\r\n	content: &#039;\\2014 \\00A0&#039;\r\n}\r\nblockquote.pull-right {\r\n	float: right;\r\n	padding-right: 15px;\r\n	padding-left: 0;\r\n	border-right: 5px solid #eee;\r\n	border-left: 0\r\n}\r\nblockquote.pull-right p, blockquote.pull-right small {\r\n	text-align: right\r\n}\r\nblockquote.pull-right small:before {\r\n	content: &#039;&#039;\r\n}\r\nblockquote.pull-right small:after {\r\n	content: &#039;\\00A0 \\2014&#039;\r\n}\r\nq:before, q:after, blockquote:before, blockquote:after {\r\n	content: &quot;&quot;\r\n}\r\naddress {\r\n	display: block;\r\n	margin-bottom: 20px;\r\n	font-style: normal;\r\n	line-height: 20px\r\n}\r\ncode, pre {\r\n	padding: 0 3px 2px;\r\n	font-family: Monaco, Menlo, Consolas, &quot;Courier New&quot;, monospace;\r\n	font-size: 12px;\r\n	color: #333;\r\n	-webkit-border-radius: 3px;\r\n	-moz-border-radius: 3px;\r\n	border-radius: 3px\r\n}\r\ncode {\r\n	padding: 2px 4px;\r\n	color: #d14;\r\n	white-space: nowrap;\r\n	background-color: #f7f7f9;\r\n	border: 1px solid #e1e1e8\r\n}\r\npre {\r\n	display: block;\r\n	padding: 9.5px;\r\n	margin: 0 0 10px;\r\n	font-size: 13px;\r\n	line-height: 20px;\r\n	word-break: break-all;\r\n	word-wrap: break-word;\r\n	white-space: pre;\r\n	white-space: pre-wrap;\r\n	background-color: #f5f5f5;\r\n	border: 1px solid #ccc;\r\n	border: 1px solid rgba(0, 0, 0, 0.15);\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\npre.prettyprint {\r\n	margin-bottom: 20px\r\n}\r\npre code {\r\n	padding: 0;\r\n	color: inherit;\r\n	white-space: pre;\r\n	white-space: pre-wrap;\r\n	background-color: transparent;\r\n	border: 0\r\n}\r\n.pre-scrollable {\r\n	max-height: 340px;\r\n	overflow-y: scroll\r\n}\r\nform {\r\n	margin: 0 0 20px\r\n}\r\nfieldset {\r\n	padding: 0;\r\n	margin: 0;\r\n	border: 0\r\n}\r\nlegend {\r\n	display: block;\r\n	width: 100%;\r\n	padding: 0;\r\n	margin-bottom: 20px;\r\n	font-size: 21px;\r\n	line-height: 40px;\r\n	color: #333;\r\n	border: 0;\r\n	border-bottom: 1px solid #e5e5e5\r\n}\r\nlegend small {\r\n	font-size: 15px;\r\n	color: #999\r\n}\r\nlabel, input, button, select, textarea {\r\n	font-size: 14px;\r\n	font-weight: normal;\r\n	line-height: 20px\r\n}\r\ninput, button, select, textarea {\r\n	font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif\r\n}\r\nlabel {\r\n	display: block;\r\n	margin-bottom: 5px\r\n}\r\nselect, textarea, input[type=&quot;text&quot;], input[type=&quot;password&quot;], input[type=&quot;datetime&quot;], input[type=&quot;datetime-local&quot;], input[type=&quot;date&quot;], input[type=&quot;month&quot;], input[type=&quot;time&quot;], input[type=&quot;week&quot;], input[type=&quot;number&quot;], input[type=&quot;email&quot;], input[type=&quot;url&quot;], input[type=&quot;search&quot;], input[type=&quot;tel&quot;], input[type=&quot;color&quot;], .uneditable-input {\r\n	display: inline-block;\r\n	height: 20px;\r\n	padding: 4px 6px;\r\n	margin-bottom: 10px;\r\n	font-size: 14px;\r\n	line-height: 20px;\r\n	color: #555;\r\n	vertical-align: middle;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\ninput, textarea, .uneditable-input {\r\n	width: 206px\r\n}\r\ntextarea {\r\n	height: auto\r\n}\r\ntextarea, input[type=&quot;text&quot;], input[type=&quot;password&quot;], input[type=&quot;datetime&quot;], input[type=&quot;datetime-local&quot;], input[type=&quot;date&quot;], input[type=&quot;month&quot;], input[type=&quot;time&quot;], input[type=&quot;week&quot;], input[type=&quot;number&quot;], input[type=&quot;email&quot;], input[type=&quot;url&quot;], input[type=&quot;search&quot;], input[type=&quot;tel&quot;], input[type=&quot;color&quot;], .uneditable-input {\r\n	background-color: #fff;\r\n	border: 1px solid #ccc;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	-webkit-transition: border linear .2s, box-shadow linear .2s;\r\n	-moz-transition: border linear .2s, box-shadow linear .2s;\r\n	-o-transition: border linear .2s, box-shadow linear .2s;\r\n	transition: border linear .2s, box-shadow linear .2s\r\n}\r\ntextarea:focus, input[type=&quot;text&quot;]:focus, input[type=&quot;password&quot;]:focus, input[type=&quot;datetime&quot;]:focus, input[type=&quot;datetime-local&quot;]:focus, input[type=&quot;date&quot;]:focus, input[type=&quot;month&quot;]:focus, input[type=&quot;time&quot;]:focus, input[type=&quot;week&quot;]:focus, input[type=&quot;number&quot;]:focus, input[type=&quot;email&quot;]:focus, input[type=&quot;url&quot;]:focus, input[type=&quot;search&quot;]:focus, input[type=&quot;tel&quot;]:focus, input[type=&quot;color&quot;]:focus, .uneditable-input:focus {\r\n	border-color: rgba(82, 168, 236, 0.8);\r\n	outline: 0;\r\n	outline: thin dotted \\9;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6)\r\n}\r\ninput[type=&quot;radio&quot;], input[type=&quot;checkbox&quot;] {\r\n	margin: 4px 0 0;\r\n	margin-top: 1px \\9;\r\n	*margin-top: 0;\r\n	line-height: normal\r\n}\r\ninput[type=&quot;file&quot;], input[type=&quot;image&quot;], input[type=&quot;submit&quot;], input[type=&quot;reset&quot;], input[type=&quot;button&quot;], input[type=&quot;radio&quot;], input[type=&quot;checkbox&quot;] {\r\n	width: auto\r\n}\r\nselect, input[type=&quot;file&quot;] {\r\n	height: 30px;\r\n	*margin-top: 4px;\r\n	line-height: 30px\r\n}\r\nselect {\r\n	width: 220px;\r\n	background-color: #fff;\r\n	border: 1px solid #ccc\r\n}\r\nselect[multiple], select[size] {\r\n	height: auto\r\n}\r\nselect:focus, input[type=&quot;file&quot;]:focus, input[type=&quot;radio&quot;]:focus, input[type=&quot;checkbox&quot;]:focus {\r\n	outline: thin dotted #333;\r\n	outline: 5px auto -webkit-focus-ring-color;\r\n	outline-offset: -2px\r\n}\r\n.uneditable-input, .uneditable-textarea {\r\n	color: #999;\r\n	cursor: not-allowed;\r\n	background-color: #fcfcfc;\r\n	border-color: #ccc;\r\n	-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.025);\r\n	-moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.025);\r\n	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.025)\r\n}\r\n.uneditable-input {\r\n	overflow: hidden;\r\n	white-space: nowrap\r\n}\r\n.uneditable-textarea {\r\n	width: auto;\r\n	height: auto\r\n}\r\ninput:-moz-placeholder, textarea:-moz-placeholder {\r\n	color: #999\r\n}\r\ninput:-ms-input-placeholder, textarea:-ms-input-placeholder {\r\n	color: #999\r\n}\r\ninput::-webkit-input-placeholder, textarea::-webkit-input-placeholder {\r\n	color: #999\r\n}\r\n.radio, .checkbox {\r\n	min-height: 20px;\r\n	padding-left: 20px\r\n}\r\n.radio input[type=&quot;radio&quot;], .checkbox input[type=&quot;checkbox&quot;] {\r\n	float: left;\r\n	margin-left: -20px\r\n}\r\n.controls&gt;.radio:first-child, .controls&gt;.checkbox:first-child {\r\n	padding-top: 5px\r\n}\r\n.radio.inline, .checkbox.inline {\r\n	display: inline-block;\r\n	padding-top: 5px;\r\n	margin-bottom: 0;\r\n	vertical-align: middle\r\n}\r\n.radio.inline+.radio.inline, .checkbox.inline+.checkbox.inline {\r\n	margin-left: 10px\r\n}\r\n.input-mini {\r\n	width: 60px\r\n}\r\n.input-small {\r\n	width: 90px\r\n}\r\n.input-medium {\r\n	width: 150px\r\n}\r\n.input-large {\r\n	width: 210px\r\n}\r\n.input-xlarge {\r\n	width: 270px\r\n}\r\n.input-xxlarge {\r\n	width: 530px\r\n}\r\ninput[class*=&quot;span&quot;], select[class*=&quot;span&quot;], textarea[class*=&quot;span&quot;], .uneditable-input[class*=&quot;span&quot;], .row-fluid input[class*=&quot;span&quot;], .row-fluid select[class*=&quot;span&quot;], .row-fluid textarea[class*=&quot;span&quot;], .row-fluid .uneditable-input[class*=&quot;span&quot;] {\r\n	float: none;\r\n	margin-left: 0\r\n}\r\n.input-append input[class*=&quot;span&quot;], .input-append .uneditable-input[class*=&quot;span&quot;], .input-prepend input[class*=&quot;span&quot;], .input-prepend .uneditable-input[class*=&quot;span&quot;], .row-fluid input[class*=&quot;span&quot;], .row-fluid select[class*=&quot;span&quot;], .row-fluid textarea[class*=&quot;span&quot;], .row-fluid .uneditable-input[class*=&quot;span&quot;], .row-fluid .input-prepend [class*=&quot;span&quot;], .row-fluid .input-append [class*=&quot;span&quot;] {\r\n	display: inline-block\r\n}\r\ninput, textarea, .uneditable-input {\r\n	margin-left: 0\r\n}\r\n.controls-row [class*=&quot;span&quot;]+[class*=&quot;span&quot;] {\r\n	margin-left: 20px\r\n}\r\ninput.span12, textarea.span12, .uneditable-input.span12 {\r\n	width: 926px\r\n}\r\ninput.span11, textarea.span11, .uneditable-input.span11 {\r\n	width: 846px\r\n}\r\ninput.span10, textarea.span10, .uneditable-input.span10 {\r\n	width: 766px\r\n}\r\ninput.span9, textarea.span9, .uneditable-input.span9 {\r\n	width: 686px\r\n}\r\ninput.span8, textarea.span8, .uneditable-input.span8 {\r\n	width: 606px\r\n}\r\ninput.span7, textarea.span7, .uneditable-input.span7 {\r\n	width: 526px\r\n}\r\ninput.span6, textarea.span6, .uneditable-input.span6 {\r\n	width: 446px\r\n}\r\ninput.span5, textarea.span5, .uneditable-input.span5 {\r\n	width: 366px\r\n}\r\ninput.span4, textarea.span4, .uneditable-input.span4 {\r\n	width: 286px\r\n}\r\ninput.span3, textarea.span3, .uneditable-input.span3 {\r\n	width: 206px\r\n}\r\ninput.span2, textarea.span2, .uneditable-input.span2 {\r\n	width: 126px\r\n}\r\ninput.span1, textarea.span1, .uneditable-input.span1 {\r\n	width: 46px\r\n}\r\n.controls-row {\r\n	*zoom: 1\r\n}\r\n.controls-row:before, .controls-row:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.controls-row:after {\r\n	clear: both\r\n}\r\n.controls-row [class*=&quot;span&quot;], .row-fluid .controls-row [class*=&quot;span&quot;] {\r\n	float: left\r\n}\r\n.controls-row .checkbox[class*=&quot;span&quot;], .controls-row .radio[class*=&quot;span&quot;] {\r\n	padding-top: 5px\r\n}\r\ninput[disabled], select[disabled], textarea[disabled], input[readonly], select[readonly], textarea[readonly] {\r\n	cursor: not-allowed;\r\n	background-color: #eee\r\n}\r\ninput[type=&quot;radio&quot;][disabled], input[type=&quot;checkbox&quot;][disabled], input[type=&quot;radio&quot;][readonly], input[type=&quot;checkbox&quot;][readonly] {\r\n	background-color: transparent\r\n}\r\n.control-group.warning .control-label, .control-group.warning .help-block, .control-group.warning .help-inline {\r\n	color: #c09853\r\n}\r\n.control-group.warning .checkbox, .control-group.warning .radio, .control-group.warning input, .control-group.warning select, .control-group.warning textarea {\r\n	color: #c09853\r\n}\r\n.control-group.warning input, .control-group.warning select, .control-group.warning textarea {\r\n	border-color: #c09853;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075)\r\n}\r\n.control-group.warning input:focus, .control-group.warning select:focus, .control-group.warning textarea:focus {\r\n	border-color: #a47e3c;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #dbc59e;\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #dbc59e;\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #dbc59e\r\n}\r\n.control-group.warning .input-prepend .add-on, .control-group.warning .input-append .add-on {\r\n	color: #c09853;\r\n	background-color: #fcf8e3;\r\n	border-color: #c09853\r\n}\r\n.control-group.error .control-label, .control-group.error .help-block, .control-group.error .help-inline {\r\n	color: #b94a48\r\n}\r\n.control-group.error .checkbox, .control-group.error .radio, .control-group.error input, .control-group.error select, .control-group.error textarea {\r\n	color: #b94a48\r\n}\r\n.control-group.error input, .control-group.error select, .control-group.error textarea {\r\n	border-color: #b94a48;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075)\r\n}\r\n.control-group.error input:focus, .control-group.error select:focus, .control-group.error textarea:focus {\r\n	border-color: #953b39;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #d59392;\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #d59392;\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #d59392\r\n}\r\n.control-group.error .input-prepend .add-on, .control-group.error .input-append .add-on {\r\n	color: #b94a48;\r\n	background-color: #f2dede;\r\n	border-color: #b94a48\r\n}\r\n.control-group.success .control-label, .control-group.success .help-block, .control-group.success .help-inline {\r\n	color: #468847\r\n}\r\n.control-group.success .checkbox, .control-group.success .radio, .control-group.success input, .control-group.success select, .control-group.success textarea {\r\n	color: #468847\r\n}\r\n.control-group.success input, .control-group.success select, .control-group.success textarea {\r\n	border-color: #468847;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075)\r\n}\r\n.control-group.success input:focus, .control-group.success select:focus, .control-group.success textarea:focus {\r\n	border-color: #356635;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7aba7b;\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7aba7b;\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7aba7b\r\n}\r\n.control-group.success .input-prepend .add-on, .control-group.success .input-append .add-on {\r\n	color: #468847;\r\n	background-color: #dff0d8;\r\n	border-color: #468847\r\n}\r\n.control-group.info .control-label, .control-group.info .help-block, .control-group.info .help-inline {\r\n	color: #3a87ad\r\n}\r\n.control-group.info .checkbox, .control-group.info .radio, .control-group.info input, .control-group.info select, .control-group.info textarea {\r\n	color: #3a87ad\r\n}\r\n.control-group.info input, .control-group.info select, .control-group.info textarea {\r\n	border-color: #3a87ad;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075)\r\n}\r\n.control-group.info input:focus, .control-group.info select:focus, .control-group.info textarea:focus {\r\n	border-color: #2d6987;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7ab5d3;\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7ab5d3;\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7ab5d3\r\n}\r\n.control-group.info .input-prepend .add-on, .control-group.info .input-append .add-on {\r\n	color: #3a87ad;\r\n	background-color: #d9edf7;\r\n	border-color: #3a87ad\r\n}\r\ninput:focus:invalid, textarea:focus:invalid, select:focus:invalid {\r\n	color: #b94a48;\r\n	border-color: #ee5f5b\r\n}\r\ninput:focus:invalid:focus, textarea:focus:invalid:focus, select:focus:invalid:focus {\r\n	border-color: #e9322d;\r\n	-webkit-box-shadow: 0 0 6px #f8b9b7;\r\n	-moz-box-shadow: 0 0 6px #f8b9b7;\r\n	box-shadow: 0 0 6px #f8b9b7\r\n}\r\n.form-actions {\r\n	padding: 19px 20px 20px;\r\n	margin-top: 20px;\r\n	margin-bottom: 20px;\r\n	background-color: #f5f5f5;\r\n	border-top: 1px solid #e5e5e5;\r\n	*zoom: 1\r\n}\r\n.form-actions:before, .form-actions:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.form-actions:after {\r\n	clear: both\r\n}\r\n.help-block, .help-inline {\r\n	color: #595959\r\n}\r\n.help-block {\r\n	display: block;\r\n	margin-bottom: 10px\r\n}\r\n.help-inline {\r\n	display: inline-block;\r\n	*display: inline;\r\n	padding-left: 5px;\r\n	vertical-align: middle;\r\n	*zoom: 1\r\n}\r\n.input-append, .input-prepend {\r\n	display: inline-block;\r\n	margin-bottom: 10px;\r\n	font-size: 0;\r\n	white-space: nowrap;\r\n	vertical-align: middle\r\n}\r\n.input-append input, .input-prepend input, .input-append select, .input-prepend select, .input-append .uneditable-input, .input-prepend .uneditable-input, .input-append .dropdown-menu, .input-prepend .dropdown-menu, .input-append .popover, .input-prepend .popover {\r\n	font-size: 14px\r\n}\r\n.input-append input, .input-prepend input, .input-append select, .input-prepend select, .input-append .uneditable-input, .input-prepend .uneditable-input {\r\n	position: relative;\r\n	margin-bottom: 0;\r\n	*margin-left: 0;\r\n	vertical-align: top;\r\n	-webkit-border-radius: 0 4px 4px 0;\r\n	-moz-border-radius: 0 4px 4px 0;\r\n	border-radius: 0 4px 4px 0\r\n}\r\n.input-append input:focus, .input-prepend input:focus, .input-append select:focus, .input-prepend select:focus, .input-append .uneditable-input:focus, .input-prepend .uneditable-input:focus {\r\n	z-index: 2\r\n}\r\n.input-append .add-on, .input-prepend .add-on {\r\n	display: inline-block;\r\n	width: auto;\r\n	height: 20px;\r\n	min-width: 16px;\r\n	padding: 4px 5px;\r\n	font-size: 14px;\r\n	font-weight: normal;\r\n	line-height: 20px;\r\n	text-align: center;\r\n	text-shadow: 0 1px 0 #fff;\r\n	background-color: #eee;\r\n	border: 1px solid #ccc\r\n}\r\n.input-append .add-on, .input-prepend .add-on, .input-append .btn, .input-prepend .btn, .input-append .btn-group&gt;.dropdown-toggle, .input-prepend .btn-group&gt;.dropdown-toggle {\r\n	vertical-align: top;\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.input-append .active, .input-prepend .active {\r\n	background-color: #a9dba9;\r\n	border-color: #46a546\r\n}\r\n.input-prepend .add-on, .input-prepend .btn {\r\n	margin-right: -1px\r\n}\r\n.input-prepend .add-on:first-child, .input-prepend .btn:first-child {\r\n	-webkit-border-radius: 4px 0 0 4px;\r\n	-moz-border-radius: 4px 0 0 4px;\r\n	border-radius: 4px 0 0 4px\r\n}\r\n.input-append input, .input-append select, .input-append .uneditable-input {\r\n	-webkit-border-radius: 4px 0 0 4px;\r\n	-moz-border-radius: 4px 0 0 4px;\r\n	border-radius: 4px 0 0 4px\r\n}\r\n.input-append input+.btn-group .btn:last-child, .input-append select+.btn-group .btn:last-child, .input-append .uneditable-input+.btn-group .btn:last-child {\r\n	-webkit-border-radius: 0 4px 4px 0;\r\n	-moz-border-radius: 0 4px 4px 0;\r\n	border-radius: 0 4px 4px 0\r\n}\r\n.input-append .add-on, .input-append .btn, .input-append .btn-group {\r\n	margin-left: -1px\r\n}\r\n.input-append .add-on:last-child, .input-append .btn:last-child, .input-append .btn-group:last-child&gt;.dropdown-toggle {\r\n	-webkit-border-radius: 0 4px 4px 0;\r\n	-moz-border-radius: 0 4px 4px 0;\r\n	border-radius: 0 4px 4px 0\r\n}\r\n.input-prepend.input-append input, .input-prepend.input-append select, .input-prepend.input-append .uneditable-input {\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.input-prepend.input-append input+.btn-group .btn, .input-prepend.input-append select+.btn-group .btn, .input-prepend.input-append .uneditable-input+.btn-group .btn {\r\n	-webkit-border-radius: 0 4px 4px 0;\r\n	-moz-border-radius: 0 4px 4px 0;\r\n	border-radius: 0 4px 4px 0\r\n}\r\n.input-prepend.input-append .add-on:first-child, .input-prepend.input-append .btn:first-child {\r\n	margin-right: -1px;\r\n	-webkit-border-radius: 4px 0 0 4px;\r\n	-moz-border-radius: 4px 0 0 4px;\r\n	border-radius: 4px 0 0 4px\r\n}\r\n.input-prepend.input-append .add-on:last-child, .input-prepend.input-append .btn:last-child {\r\n	margin-left: -1px;\r\n	-webkit-border-radius: 0 4px 4px 0;\r\n	-moz-border-radius: 0 4px 4px 0;\r\n	border-radius: 0 4px 4px 0\r\n}\r\n.input-prepend.input-append .btn-group:first-child {\r\n	margin-left: 0\r\n}\r\ninput.search-query {\r\n	padding-right: 14px;\r\n	padding-right: 4px \\9;\r\n	padding-left: 14px;\r\n	padding-left: 4px \\9;\r\n	margin-bottom: 0;\r\n	-webkit-border-radius: 15px;\r\n	-moz-border-radius: 15px;\r\n	border-radius: 15px\r\n}\r\n.form-search .input-append .search-query, .form-search .input-prepend .search-query {\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.form-search .input-append .search-query {\r\n	-webkit-border-radius: 14px 0 0 14px;\r\n	-moz-border-radius: 14px 0 0 14px;\r\n	border-radius: 14px 0 0 14px\r\n}\r\n.form-search .input-append .btn {\r\n	-webkit-border-radius: 0 14px 14px 0;\r\n	-moz-border-radius: 0 14px 14px 0;\r\n	border-radius: 0 14px 14px 0\r\n}\r\n.form-search .input-prepend .search-query {\r\n	-webkit-border-radius: 0 14px 14px 0;\r\n	-moz-border-radius: 0 14px 14px 0;\r\n	border-radius: 0 14px 14px 0\r\n}\r\n.form-search .input-prepend .btn {\r\n	-webkit-border-radius: 14px 0 0 14px;\r\n	-moz-border-radius: 14px 0 0 14px;\r\n	border-radius: 14px 0 0 14px\r\n}\r\n.form-search input, .form-inline input, .form-horizontal input, .form-search textarea, .form-inline textarea, .form-horizontal textarea, .form-search select, .form-inline select, .form-horizontal select, .form-search .help-inline, .form-inline .help-inline, .form-horizontal .help-inline, .form-search .uneditable-input, .form-inline .uneditable-input, .form-horizontal .uneditable-input, .form-search .input-prepend, .form-inline .input-prepend, .form-horizontal .input-prepend, .form-search .input-append, .form-inline .input-append, .form-horizontal .input-append {\r\n	display: inline-block;\r\n	*display: inline;\r\n	margin-bottom: 0;\r\n	vertical-align: middle;\r\n	*zoom: 1\r\n}\r\n.form-search .hide, .form-inline .hide, .form-horizontal .hide {\r\n	display: none\r\n}\r\n.form-search label, .form-inline label, .form-search .btn-group, .form-inline .btn-group {\r\n	display: inline-block\r\n}\r\n.form-search .input-append, .form-inline .input-append, .form-search .input-prepend, .form-inline .input-prepend {\r\n	margin-bottom: 0\r\n}\r\n.form-search .radio, .form-search .checkbox, .form-inline .radio, .form-inline .checkbox {\r\n	padding-left: 0;\r\n	margin-bottom: 0;\r\n	vertical-align: middle\r\n}\r\n.form-search .radio input[type=&quot;radio&quot;], .form-search .checkbox input[type=&quot;checkbox&quot;], .form-inline .radio input[type=&quot;radio&quot;], .form-inline .checkbox input[type=&quot;checkbox&quot;] {\r\n	float: left;\r\n	margin-right: 3px;\r\n	margin-left: 0\r\n}\r\n.control-group {\r\n	margin-bottom: 10px\r\n}\r\nlegend+.control-group {\r\n	margin-top: 20px;\r\n	-webkit-margin-top-collapse: separate\r\n}\r\n.form-horizontal .control-group {\r\n	margin-bottom: 20px;\r\n	*zoom: 1\r\n}\r\n.form-horizontal .control-group:before, .form-horizontal .control-group:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.form-horizontal .control-group:after {\r\n	clear: both\r\n}\r\n.form-horizontal .control-label {\r\n	float: left;\r\n	width: 160px;\r\n	padding-top: 5px;\r\n	text-align: right\r\n}\r\n.form-horizontal .controls {\r\n	*display: inline-block;\r\n	*padding-left: 20px;\r\n	margin-left: 180px;\r\n	*margin-left: 0\r\n}\r\n.form-horizontal .controls:first-child {\r\n	*padding-left: 180px\r\n}\r\n.form-horizontal .help-block {\r\n	margin-bottom: 0\r\n}\r\n.form-horizontal input+.help-block, .form-horizontal select+.help-block, .form-horizontal textarea+.help-block, .form-horizontal .uneditable-input+.help-block, .form-horizontal .input-prepend+.help-block, .form-horizontal .input-append+.help-block {\r\n	margin-top: 10px\r\n}\r\n.form-horizontal .form-actions {\r\n	padding-left: 180px\r\n}\r\ntable {\r\n	max-width: 100%;\r\n	background-color: transparent;\r\n	border-collapse: collapse;\r\n	border-spacing: 0\r\n}\r\n.table {\r\n	width: 100%;\r\n	margin-bottom: 20px\r\n}\r\n.table th, .table td {\r\n	padding: 8px;\r\n	line-height: 20px;\r\n	text-align: left;\r\n	vertical-align: top;\r\n	border-top: 1px solid #ddd\r\n}\r\n.table th {\r\n	font-weight: bold\r\n}\r\n.table thead th {\r\n	vertical-align: bottom\r\n}\r\n.table caption+thead tr:first-child th, .table caption+thead tr:first-child td, .table colgroup+thead tr:first-child th, .table colgroup+thead tr:first-child td, .table thead:first-child tr:first-child th, .table thead:first-child tr:first-child td {\r\n	border-top: 0\r\n}\r\n.table tbody+tbody {\r\n	border-top: 2px solid #ddd\r\n}\r\n.table .table {\r\n	background-color: #fff\r\n}\r\n.table-condensed th, .table-condensed td {\r\n	padding: 4px 5px\r\n}\r\n.table-bordered {\r\n	border: 1px solid #ddd;\r\n	border-collapse: separate;\r\n	*border-collapse: collapse;\r\n	border-left: 0;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\n.table-bordered th, .table-bordered td {\r\n	border-left: 1px solid #ddd\r\n}\r\n.table-bordered caption+thead tr:first-child th, .table-bordered caption+tbody tr:first-child th, .table-bordered caption+tbody tr:first-child td, .table-bordered colgroup+thead tr:first-child th, .table-bordered colgroup+tbody tr:first-child th, .table-bordered colgroup+tbody tr:first-child td, .table-bordered thead:first-child tr:first-child th, .table-bordered tbody:first-child tr:first-child th, .table-bordered tbody:first-child tr:first-child td {\r\n	border-top: 0\r\n}\r\n.table-bordered thead:first-child tr:first-child&gt;th:first-child, .table-bordered tbody:first-child tr:first-child&gt;td:first-child, .table-bordered tbody:first-child tr:first-child&gt;th:first-child {\r\n	-webkit-border-top-left-radius: 4px;\r\n	border-top-left-radius: 4px;\r\n	-moz-border-radius-topleft: 4px\r\n}\r\n.table-bordered thead:first-child tr:first-child&gt;th:last-child, .table-bordered tbody:first-child tr:first-child&gt;td:last-child, .table-bordered tbody:first-child tr:first-child&gt;th:last-child {\r\n	-webkit-border-top-right-radius: 4px;\r\n	border-top-right-radius: 4px;\r\n	-moz-border-radius-topright: 4px\r\n}\r\n.table-bordered thead:last-child tr:last-child&gt;th:first-child, .table-bordered tbody:last-child tr:last-child&gt;td:first-child, .table-bordered tbody:last-child tr:last-child&gt;th:first-child, .table-bordered tfoot:last-child tr:last-child&gt;td:first-child, .table-bordered tfoot:last-child tr:last-child&gt;th:first-child {\r\n	-webkit-border-bottom-left-radius: 4px;\r\n	border-bottom-left-radius: 4px;\r\n	-moz-border-radius-bottomleft: 4px\r\n}\r\n.table-bordered thead:last-child tr:last-child&gt;th:last-child, .table-bordered tbody:last-child tr:last-child&gt;td:last-child, .table-bordered tbody:last-child tr:last-child&gt;th:last-child, .table-bordered tfoot:last-child tr:last-child&gt;td:last-child, .table-bordered tfoot:last-child tr:last-child&gt;th:last-child {\r\n	-webkit-border-bottom-right-radius: 4px;\r\n	border-bottom-right-radius: 4px;\r\n	-moz-border-radius-bottomright: 4px\r\n}\r\n.table-bordered tfoot+tbody:last-child tr:last-child td:first-child {\r\n	-webkit-border-bottom-left-radius: 0;\r\n	border-bottom-left-radius: 0;\r\n	-moz-border-radius-bottomleft: 0\r\n}\r\n.table-bordered tfoot+tbody:last-child tr:last-child td:last-child {\r\n	-webkit-border-bottom-right-radius: 0;\r\n	border-bottom-right-radius: 0;\r\n	-moz-border-radius-bottomright: 0\r\n}\r\n.table-bordered caption+thead tr:first-child th:first-child, .table-bordered caption+tbody tr:first-child td:first-child, .table-bordered colgroup+thead tr:first-child th:first-child, .table-bordered colgroup+tbody tr:first-child td:first-child {\r\n	-webkit-border-top-left-radius: 4px;\r\n	border-top-left-radius: 4px;\r\n	-moz-border-radius-topleft: 4px\r\n}\r\n.table-bordered caption+thead tr:first-child th:last-child, .table-bordered caption+tbody tr:first-child td:last-child, .table-bordered colgroup+thead tr:first-child th:last-child, .table-bordered colgroup+tbody tr:first-child td:last-child {\r\n	-webkit-border-top-right-radius: 4px;\r\n	border-top-right-radius: 4px;\r\n	-moz-border-radius-topright: 4px\r\n}\r\n.table-striped tbody&gt;tr:nth-child(odd)&gt;td, .table-striped tbody&gt;tr:nth-child(odd)&gt;th {\r\n	background-color: #f9f9f9\r\n}\r\n.table-hover tbody tr:hover&gt;td, .table-hover tbody tr:hover&gt;th {\r\n	background-color: #f5f5f5\r\n}\r\ntable td[class*=&quot;span&quot;], table th[class*=&quot;span&quot;], .row-fluid table td[class*=&quot;span&quot;], .row-fluid table th[class*=&quot;span&quot;] {\r\n	display: table-cell;\r\n	float: none;\r\n	margin-left: 0\r\n}\r\n.table td.span1, .table th.span1 {\r\n	float: none;\r\n	width: 44px;\r\n	margin-left: 0\r\n}\r\n.table td.span2, .table th.span2 {\r\n	float: none;\r\n	width: 124px;\r\n	margin-left: 0\r\n}\r\n.table td.span3, .table th.span3 {\r\n	float: none;\r\n	width: 204px;\r\n	margin-left: 0\r\n}\r\n.table td.span4, .table th.span4 {\r\n	float: none;\r\n	width: 284px;\r\n	margin-left: 0\r\n}\r\n.table td.span5, .table th.span5 {\r\n	float: none;\r\n	width: 364px;\r\n	margin-left: 0\r\n}\r\n.table td.span6, .table th.span6 {\r\n	float: none;\r\n	width: 444px;\r\n	margin-left: 0\r\n}\r\n.table td.span7, .table th.span7 {\r\n	float: none;\r\n	width: 524px;\r\n	margin-left: 0\r\n}\r\n.table td.span8, .table th.span8 {\r\n	float: none;\r\n	width: 604px;\r\n	margin-left: 0\r\n}\r\n.table td.span9, .table th.span9 {\r\n	float: none;\r\n	width: 684px;\r\n	margin-left: 0\r\n}\r\n.table td.span10, .table th.span10 {\r\n	float: none;\r\n	width: 764px;\r\n	margin-left: 0\r\n}\r\n.table td.span11, .table th.span11 {\r\n	float: none;\r\n	width: 844px;\r\n	margin-left: 0\r\n}\r\n.table td.span12, .table th.span12 {\r\n	float: none;\r\n	width: 924px;\r\n	margin-left: 0\r\n}\r\n.table tbody tr.success&gt;td {\r\n	background-color: #dff0d8\r\n}\r\n.table tbody tr.error&gt;td {\r\n	background-color: #f2dede\r\n}\r\n.table tbody tr.warning&gt;td {\r\n	background-color: #fcf8e3\r\n}\r\n.table tbody tr.info&gt;td {\r\n	background-color: #d9edf7\r\n}\r\n.table-hover tbody tr.success:hover&gt;td {\r\n	background-color: #d0e9c6\r\n}\r\n.table-hover tbody tr.error:hover&gt;td {\r\n	background-color: #ebcccc\r\n}\r\n.table-hover tbody tr.warning:hover&gt;td {\r\n	background-color: #faf2cc\r\n}\r\n.table-hover tbody tr.info:hover&gt;td {\r\n	background-color: #c4e3f3\r\n}\r\n[class^=&quot;icon-&quot;], [class*=&quot; icon-&quot;] {\r\n	display: inline-block;\r\n	width: 14px;\r\n	height: 14px;\r\n	margin-top: 1px;\r\n	*margin-right: .3em;\r\n	line-height: 14px;\r\n	vertical-align: text-top;\r\n	background-image: url(&quot;../img/glyphicons-halflings.png&quot;);\r\n	background-position: 14px 14px;\r\n	background-repeat: no-repeat\r\n}\r\n.icon-white, .nav-pills&gt;.active&gt;a&gt;[class^=&quot;icon-&quot;], .nav-pills&gt;.active&gt;a&gt;[class*=&quot; icon-&quot;], .nav-list&gt;.active&gt;a&gt;[class^=&quot;icon-&quot;], .nav-list&gt;.active&gt;a&gt;[class*=&quot; icon-&quot;], .navbar-inverse .nav&gt;.active&gt;a&gt;[class^=&quot;icon-&quot;], .navbar-inverse .nav&gt;.active&gt;a&gt;[class*=&quot; icon-&quot;], .dropdown-menu&gt;li&gt;a:hover&gt;[class^=&quot;icon-&quot;], .dropdown-menu&gt;li&gt;a:focus&gt;[class^=&quot;icon-&quot;], .dropdown-menu&gt;li&gt;a:hover&gt;[class*=&quot; icon-&quot;], .dropdown-menu&gt;li&gt;a:focus&gt;[class*=&quot; icon-&quot;], .dropdown-menu&gt;.active&gt;a&gt;[class^=&quot;icon-&quot;], .dropdown-menu&gt;.active&gt;a&gt;[class*=&quot; icon-&quot;], .dropdown-submenu:hover&gt;a&gt;[class^=&quot;icon-&quot;], .dropdown-submenu:focus&gt;a&gt;[class^=&quot;icon-&quot;], .dropdown-submenu:hover&gt;a&gt;[class*=&quot; icon-&quot;], .dropdown-submenu:focus&gt;a&gt;[class*=&quot; icon-&quot;] {\r\n	background-image: url(&quot;../img/glyphicons-halflings-white.png&quot;)\r\n}\r\n.icon-glass {\r\n	background-position: 0 0\r\n}\r\n.icon-music {\r\n	background-position: -24px 0\r\n}\r\n.icon-search {\r\n	background-position: -48px 0\r\n}\r\n.icon-envelope {\r\n	background-position: -72px 0\r\n}\r\n.icon-heart {\r\n	background-position: -96px 0\r\n}\r\n.icon-star {\r\n	background-position: -120px 0\r\n}\r\n.icon-star-empty {\r\n	background-position: -144px 0\r\n}\r\n.icon-user {\r\n	background-position: -168px 0\r\n}\r\n.icon-film {\r\n	background-position: -192px 0\r\n}\r\n.icon-th-large {\r\n	background-position: -216px 0\r\n}\r\n.icon-th {\r\n	background-position: -240px 0\r\n}\r\n.icon-th-list {\r\n	background-position: -264px 0\r\n}\r\n.icon-ok {\r\n	background-position: -288px 0\r\n}\r\n.icon-remove {\r\n	background-position: -312px 0\r\n}\r\n.icon-zoom-in {\r\n	background-position: -336px 0\r\n}\r\n.icon-zoom-out {\r\n	background-position: -360px 0\r\n}\r\n.icon-off {\r\n	background-position: -384px 0\r\n}\r\n.icon-signal {\r\n	background-position: -408px 0\r\n}\r\n.icon-cog {\r\n	background-position: -432px 0\r\n}\r\n.icon-trash {\r\n	background-position: -456px 0\r\n}\r\n.icon-home {\r\n	background-position: 0 -24px\r\n}\r\n.icon-file {\r\n	background-position: -24px -24px\r\n}\r\n.icon-time {\r\n	background-position: -48px -24px\r\n}\r\n.icon-road {\r\n	background-position: -72px -24px\r\n}\r\n.icon-download-alt {\r\n	background-position: -96px -24px\r\n}\r\n.icon-download {\r\n	background-position: -120px -24px\r\n}\r\n.icon-upload {\r\n	background-position: -144px -24px\r\n}\r\n.icon-inbox {\r\n	background-position: -168px -24px\r\n}\r\n.icon-play-circle {\r\n	background-position: -192px -24px\r\n}\r\n.icon-repeat {\r\n	background-position: -216px -24px\r\n}\r\n.icon-refresh {\r\n	background-position: -240px -24px\r\n}\r\n.icon-list-alt {\r\n	background-position: -264px -24px\r\n}\r\n.icon-lock {\r\n	background-position: -287px -24px\r\n}\r\n.icon-flag {\r\n	background-position: -312px -24px\r\n}\r\n.icon-headphones {\r\n	background-position: -336px -24px\r\n}\r\n.icon-volume-off {\r\n	background-position: -360px -24px\r\n}\r\n.icon-volume-down {\r\n	background-position: -384px -24px\r\n}\r\n.icon-volume-up {\r\n	background-position: -408px -24px\r\n}\r\n.icon-qrcode {\r\n	background-position: -432px -24px\r\n}\r\n.icon-barcode {\r\n	background-position: -456px -24px\r\n}\r\n.icon-tag {\r\n	background-position: 0 -48px\r\n}\r\n.icon-tags {\r\n	background-position: -25px -48px\r\n}\r\n.icon-book {\r\n	background-position: -48px -48px\r\n}\r\n.icon-bookmark {\r\n	background-position: -72px -48px\r\n}\r\n.icon-print {\r\n	background-position: -96px -48px\r\n}\r\n.icon-camera {\r\n	background-position: -120px -48px\r\n}\r\n.icon-font {\r\n	background-position: -144px -48px\r\n}\r\n.icon-bold {\r\n	background-position: -167px -48px\r\n}\r\n.icon-italic {\r\n	background-position: -192px -48px\r\n}\r\n.icon-text-height {\r\n	background-position: -216px -48px\r\n}\r\n.icon-text-width {\r\n	background-position: -240px -48px\r\n}\r\n.icon-align-left {\r\n	background-position: -264px -48px\r\n}\r\n.icon-align-center {\r\n	background-position: -288px -48px\r\n}\r\n.icon-align-right {\r\n	background-position: -312px -48px\r\n}\r\n.icon-align-justify {\r\n	background-position: -336px -48px\r\n}\r\n.icon-list {\r\n	background-position: -360px -48px\r\n}\r\n.icon-indent-left {\r\n	background-position: -384px -48px\r\n}\r\n.icon-indent-right {\r\n	background-position: -408px -48px\r\n}\r\n.icon-facetime-video {\r\n	background-position: -432px -48px\r\n}\r\n.icon-picture {\r\n	background-position: -456px -48px\r\n}\r\n.icon-pencil {\r\n	background-position: 0 -72px\r\n}\r\n.icon-map-marker {\r\n	background-position: -24px -72px\r\n}\r\n.icon-adjust {\r\n	background-position: -48px -72px\r\n}\r\n.icon-tint {\r\n	background-position: -72px -72px\r\n}\r\n.icon-edit {\r\n	background-position: -96px -72px\r\n}\r\n.icon-share {\r\n	background-position: -120px -72px\r\n}\r\n.icon-check {\r\n	background-position: -144px -72px\r\n}\r\n.icon-move {\r\n	background-position: -168px -72px\r\n}\r\n.icon-step-backward {\r\n	background-position: -192px -72px\r\n}\r\n.icon-fast-backward {\r\n	background-position: -216px -72px\r\n}\r\n.icon-backward {\r\n	background-position: -240px -72px\r\n}\r\n.icon-play {\r\n	background-position: -264px -72px\r\n}\r\n.icon-pause {\r\n	background-position: -288px -72px\r\n}\r\n.icon-stop {\r\n	background-position: -312px -72px\r\n}\r\n.icon-forward {\r\n	background-position: -336px -72px\r\n}\r\n.icon-fast-forward {\r\n	background-position: -360px -72px\r\n}\r\n.icon-step-forward {\r\n	background-position: -384px -72px\r\n}\r\n.icon-eject {\r\n	background-position: -408px -72px\r\n}\r\n.icon-chevron-left {\r\n	background-position: -432px -72px\r\n}\r\n.icon-chevron-right {\r\n	background-position: -456px -72px\r\n}\r\n.icon-plus-sign {\r\n	background-position: 0 -96px\r\n}\r\n.icon-minus-sign {\r\n	background-position: -24px -96px\r\n}\r\n.icon-remove-sign {\r\n	background-position: -48px -96px\r\n}\r\n.icon-ok-sign {\r\n	background-position: -72px -96px\r\n}\r\n.icon-question-sign {\r\n	background-position: -96px -96px\r\n}\r\n.icon-info-sign {\r\n	background-position: -120px -96px\r\n}\r\n.icon-screenshot {\r\n	background-position: -144px -96px\r\n}\r\n.icon-remove-circle {\r\n	background-position: -168px -96px\r\n}\r\n.icon-ok-circle {\r\n	background-position: -192px -96px\r\n}\r\n.icon-ban-circle {\r\n	background-position: -216px -96px\r\n}\r\n.icon-arrow-left {\r\n	background-position: -240px -96px\r\n}\r\n.icon-arrow-right {\r\n	background-position: -264px -96px\r\n}\r\n.icon-arrow-up {\r\n	background-position: -289px -96px\r\n}\r\n.icon-arrow-down {\r\n	background-position: -312px -96px\r\n}\r\n.icon-share-alt {\r\n	background-position: -336px -96px\r\n}\r\n.icon-resize-full {\r\n	background-position: -360px -96px\r\n}\r\n.icon-resize-small {\r\n	background-position: -384px -96px\r\n}\r\n.icon-plus {\r\n	background-position: -408px -96px\r\n}\r\n.icon-minus {\r\n	background-position: -433px -96px\r\n}\r\n.icon-asterisk {\r\n	background-position: -456px -96px\r\n}\r\n.icon-exclamation-sign {\r\n	background-position: 0 -120px\r\n}\r\n.icon-gift {\r\n	background-position: -24px -120px\r\n}\r\n.icon-leaf {\r\n	background-position: -48px -120px\r\n}\r\n.icon-fire {\r\n	background-position: -72px -120px\r\n}\r\n.icon-eye-open {\r\n	background-position: -96px -120px\r\n}\r\n.icon-eye-close {\r\n	background-position: -120px -120px\r\n}\r\n.icon-warning-sign {\r\n	background-position: -144px -120px\r\n}\r\n.icon-plane {\r\n	background-position: -168px -120px\r\n}\r\n.icon-calendar {\r\n	background-position: -192px -120px\r\n}\r\n.icon-random {\r\n	width: 16px;\r\n	background-position: -216px -120px\r\n}\r\n.icon-comment {\r\n	background-position: -240px -120px\r\n}\r\n.icon-magnet {\r\n	background-position: -264px -120px\r\n}\r\n.icon-chevron-up {\r\n	background-position: -288px -120px\r\n}\r\n.icon-chevron-down {\r\n	background-position: -313px -119px\r\n}\r\n.icon-retweet {\r\n	background-position: -336px -120px\r\n}\r\n.icon-shopping-cart {\r\n	background-position: -360px -120px\r\n}\r\n.icon-folder-close {\r\n	width: 16px;\r\n	background-position: -384px -120px\r\n}\r\n.icon-folder-open {\r\n	width: 16px;\r\n	background-position: -408px -120px\r\n}\r\n.icon-resize-vertical {\r\n	background-position: -432px -119px\r\n}\r\n.icon-resize-horizontal {\r\n	background-position: -456px -118px\r\n}\r\n.icon-hdd {\r\n	background-position: 0 -144px\r\n}\r\n.icon-bullhorn {\r\n	background-position: -24px -144px\r\n}\r\n.icon-bell {\r\n	background-position: -48px -144px\r\n}\r\n.icon-certificate {\r\n	background-position: -72px -144px\r\n}\r\n.icon-thumbs-up {\r\n	background-position: -96px -144px\r\n}\r\n.icon-thumbs-down {\r\n	background-position: -120px -144px\r\n}\r\n.icon-hand-right {\r\n	background-position: -144px -144px\r\n}\r\n.icon-hand-left {\r\n	background-position: -168px -144px\r\n}\r\n.icon-hand-up {\r\n	background-position: -192px -144px\r\n}\r\n.icon-hand-down {\r\n	background-position: -216px -144px\r\n}\r\n.icon-circle-arrow-right {\r\n	background-position: -240px -144px\r\n}\r\n.icon-circle-arrow-left {\r\n	background-position: -264px -144px\r\n}\r\n.icon-circle-arrow-up {\r\n	background-position: -288px -144px\r\n}\r\n.icon-circle-arrow-down {\r\n	background-position: -312px -144px\r\n}\r\n.icon-globe {\r\n	background-position: -336px -144px\r\n}\r\n.icon-wrench {\r\n	background-position: -360px -144px\r\n}\r\n.icon-tasks {\r\n	background-position: -384px -144px\r\n}\r\n.icon-filter {\r\n	background-position: -408px -144px\r\n}\r\n.icon-briefcase {\r\n	background-position: -432px -144px\r\n}\r\n.icon-fullscreen {\r\n	background-position: -456px -144px\r\n}\r\n.dropup, .dropdown {\r\n	position: relative\r\n}\r\n.dropdown-toggle {\r\n	*margin-bottom: -3px\r\n}\r\n.dropdown-toggle:active, .open .dropdown-toggle {\r\n	outline: 0\r\n}\r\n.caret {\r\n	display: inline-block;\r\n	width: 0;\r\n	height: 0;\r\n	vertical-align: top;\r\n	border-top: 4px solid #000;\r\n	border-right: 4px solid transparent;\r\n	border-left: 4px solid transparent;\r\n	content: &quot;&quot;\r\n}\r\n.dropdown .caret {\r\n	margin-top: 8px;\r\n	margin-left: 2px\r\n}\r\n.dropdown-menu {\r\n	position: absolute;\r\n	top: 100%;\r\n	left: 0;\r\n	z-index: 1000;\r\n	display: none;\r\n	float: left;\r\n	min-width: 160px;\r\n	padding: 5px 0;\r\n	margin: 2px 0 0;\r\n	list-style: none;\r\n	background-color: #fff;\r\n	border: 1px solid #ccc;\r\n	border: 1px solid rgba(0, 0, 0, 0.2);\r\n	*border-right-width: 2px;\r\n	*border-bottom-width: 2px;\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px;\r\n	-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n	-moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n	-webkit-background-clip: padding-box;\r\n	-moz-background-clip: padding;\r\n	background-clip: padding-box\r\n}\r\n.dropdown-menu.pull-right {\r\n	right: 0;\r\n	left: auto\r\n}\r\n.dropdown-menu .divider {\r\n	*width: 100%;\r\n	height: 1px;\r\n	margin: 9px 1px;\r\n	*margin: -5px 0 5px;\r\n	overflow: hidden;\r\n	background-color: #e5e5e5;\r\n	border-bottom: 1px solid #fff\r\n}\r\n.dropdown-menu&gt;li&gt;a {\r\n	display: block;\r\n	padding: 3px 20px;\r\n	clear: both;\r\n	font-weight: normal;\r\n	line-height: 20px;\r\n	color: #333;\r\n	white-space: nowrap\r\n}\r\n.dropdown-menu&gt;li&gt;a:hover, .dropdown-menu&gt;li&gt;a:focus, .dropdown-submenu:hover&gt;a, .dropdown-submenu:focus&gt;a {\r\n	color: #fff;\r\n	text-decoration: none;\r\n	background-color: #0081c2;\r\n	background-image: -moz-linear-gradient(top, #08c, #0077b3);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#08c), to(#0077b3));\r\n	background-image: -webkit-linear-gradient(top, #08c, #0077b3);\r\n	background-image: -o-linear-gradient(top, #08c, #0077b3);\r\n	background-image: linear-gradient(to bottom, #08c, #0077b3);\r\n	background-repeat: repeat-x;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff0088cc&#039;, endColorstr=&#039;#ff0077b3&#039;, GradientType=0)\r\n}\r\n.dropdown-menu&gt;.active&gt;a, .dropdown-menu&gt;.active&gt;a:hover, .dropdown-menu&gt;.active&gt;a:focus {\r\n	color: #fff;\r\n	text-decoration: none;\r\n	background-color: #0081c2;\r\n	background-image: -moz-linear-gradient(top, #08c, #0077b3);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#08c), to(#0077b3));\r\n	background-image: -webkit-linear-gradient(top, #08c, #0077b3);\r\n	background-image: -o-linear-gradient(top, #08c, #0077b3);\r\n	background-image: linear-gradient(to bottom, #08c, #0077b3);\r\n	background-repeat: repeat-x;\r\n	outline: 0;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff0088cc&#039;, endColorstr=&#039;#ff0077b3&#039;, GradientType=0)\r\n}\r\n.dropdown-menu&gt;.disabled&gt;a, .dropdown-menu&gt;.disabled&gt;a:hover, .dropdown-menu&gt;.disabled&gt;a:focus {\r\n	color: #999\r\n}\r\n.dropdown-menu&gt;.disabled&gt;a:hover, .dropdown-menu&gt;.disabled&gt;a:focus {\r\n	text-decoration: none;\r\n	cursor: default;\r\n	background-color: transparent;\r\n	background-image: none;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.open {\r\n	*z-index: 1000\r\n}\r\n.open&gt;.dropdown-menu {\r\n	display: block\r\n}\r\n.pull-right&gt;.dropdown-menu {\r\n	right: 0;\r\n	left: auto\r\n}\r\n.dropup .caret, .navbar-fixed-bottom .dropdown .caret {\r\n	border-top: 0;\r\n	border-bottom: 4px solid #000;\r\n	content: &quot;&quot;\r\n}\r\n.dropup .dropdown-menu, .navbar-fixed-bottom .dropdown .dropdown-menu {\r\n	top: auto;\r\n	bottom: 100%;\r\n	margin-bottom: 1px\r\n}\r\n.dropdown-submenu {\r\n	position: relative\r\n}\r\n.dropdown-submenu&gt;.dropdown-menu {\r\n	top: 0;\r\n	left: 100%;\r\n	margin-top: -6px;\r\n	margin-left: -1px;\r\n	-webkit-border-radius: 0 6px 6px 6px;\r\n	-moz-border-radius: 0 6px 6px 6px;\r\n	border-radius: 0 6px 6px 6px\r\n}\r\n.dropdown-submenu:hover&gt;.dropdown-menu {\r\n	display: block\r\n}\r\n.dropup .dropdown-submenu&gt;.dropdown-menu {\r\n	top: auto;\r\n	bottom: 0;\r\n	margin-top: 0;\r\n	margin-bottom: -2px;\r\n	-webkit-border-radius: 5px 5px 5px 0;\r\n	-moz-border-radius: 5px 5px 5px 0;\r\n	border-radius: 5px 5px 5px 0\r\n}\r\n.dropdown-submenu&gt;a:after {\r\n	display: block;\r\n	float: right;\r\n	width: 0;\r\n	height: 0;\r\n	margin-top: 5px;\r\n	margin-right: -10px;\r\n	border-color: transparent;\r\n	border-left-color: #ccc;\r\n	border-style: solid;\r\n	border-width: 5px 0 5px 5px;\r\n	content: &quot; &quot;\r\n}\r\n.dropdown-submenu:hover&gt;a:after {\r\n	border-left-color: #fff\r\n}\r\n.dropdown-submenu.pull-left {\r\n	float: none\r\n}\r\n.dropdown-submenu.pull-left&gt;.dropdown-menu {\r\n	left: -100%;\r\n	margin-left: 10px;\r\n	-webkit-border-radius: 6px 0 6px 6px;\r\n	-moz-border-radius: 6px 0 6px 6px;\r\n	border-radius: 6px 0 6px 6px\r\n}\r\n.dropdown .dropdown-menu .nav-header {\r\n	padding-right: 20px;\r\n	padding-left: 20px\r\n}\r\n.typeahead {\r\n	z-index: 1051;\r\n	margin-top: 2px;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\n.well {\r\n	min-height: 20px;\r\n	padding: 19px;\r\n	margin-bottom: 20px;\r\n	background-color: #f5f5f5;\r\n	border: 1px solid #e3e3e3;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05)\r\n}\r\n.well blockquote {\r\n	border-color: #ddd;\r\n	border-color: rgba(0, 0, 0, 0.15)\r\n}\r\n.well-large {\r\n	padding: 24px;\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px\r\n}\r\n.well-small {\r\n	padding: 9px;\r\n	-webkit-border-radius: 3px;\r\n	-moz-border-radius: 3px;\r\n	border-radius: 3px\r\n}\r\n.fade {\r\n	opacity: 0;\r\n	-webkit-transition: opacity .15s linear;\r\n	-moz-transition: opacity .15s linear;\r\n	-o-transition: opacity .15s linear;\r\n	transition: opacity .15s linear\r\n}\r\n.fade.in {\r\n	opacity: 1\r\n}\r\n.collapse {\r\n	position: relative;\r\n	height: 0;\r\n	overflow: hidden;\r\n	-webkit-transition: height .35s ease;\r\n	-moz-transition: height .35s ease;\r\n	-o-transition: height .35s ease;\r\n	transition: height .35s ease\r\n}\r\n.collapse.in {\r\n	height: auto\r\n}\r\n.close {\r\n	float: right;\r\n	font-size: 20px;\r\n	font-weight: bold;\r\n	line-height: 20px;\r\n	color: #000;\r\n	text-shadow: 0 1px 0 #fff;\r\n	opacity: .2;\r\n	filter: alpha(opacity=20)\r\n}\r\n.close:hover, .close:focus {\r\n	color: #000;\r\n	text-decoration: none;\r\n	cursor: pointer;\r\n	opacity: .4;\r\n	filter: alpha(opacity=40)\r\n}\r\nbutton.close {\r\n	padding: 0;\r\n	cursor: pointer;\r\n	background: transparent;\r\n	border: 0;\r\n	-webkit-appearance: none\r\n}\r\n.btn {\r\n	display: inline-block;\r\n	*display: inline;\r\n	padding: 4px 12px;\r\n	margin-bottom: 0;\r\n	*margin-left: .3em;\r\n	font-size: 14px;\r\n	line-height: 20px;\r\n	color: #333;\r\n	text-align: center;\r\n	text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);\r\n	vertical-align: middle;\r\n	cursor: pointer;\r\n	background-color: #f5f5f5;\r\n	*background-color: #e6e6e6;\r\n	background-image: -moz-linear-gradient(top, #fff, #e6e6e6);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), to(#e6e6e6));\r\n	background-image: -webkit-linear-gradient(top, #fff, #e6e6e6);\r\n	background-image: -o-linear-gradient(top, #fff, #e6e6e6);\r\n	background-image: linear-gradient(to bottom, #fff, #e6e6e6);\r\n	background-repeat: repeat-x;\r\n	border: 1px solid #ccc;\r\n	*border: 0;\r\n	border-color: #e6e6e6 #e6e6e6 #bfbfbf;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	border-bottom-color: #b3b3b3;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ffffffff&#039;, endColorstr=&#039;#ffe6e6e6&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);\r\n	*zoom: 1;\r\n	-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05)\r\n}\r\n.btn:hover, .btn:focus, .btn:active, .btn.active, .btn.disabled, .btn[disabled] {\r\n	color: #333;\r\n	background-color: #e6e6e6;\r\n	*background-color: #d9d9d9\r\n}\r\n.btn:active, .btn.active {\r\n	background-color: #ccc \\9\r\n}\r\n.btn:first-child {\r\n	*margin-left: 0\r\n}\r\n.btn:hover, .btn:focus {\r\n	color: #333;\r\n	text-decoration: none;\r\n	background-position: 0 -15px;\r\n	-webkit-transition: background-position .1s linear;\r\n	-moz-transition: background-position .1s linear;\r\n	-o-transition: background-position .1s linear;\r\n	transition: background-position .1s linear\r\n}\r\n.btn:focus {\r\n	outline: thin dotted #333;\r\n	outline: 5px auto -webkit-focus-ring-color;\r\n	outline-offset: -2px\r\n}\r\n.btn.active, .btn:active {\r\n	background-image: none;\r\n	outline: 0;\r\n	-webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	-moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05)\r\n}\r\n.btn.disabled, .btn[disabled] {\r\n	cursor: default;\r\n	background-image: none;\r\n	opacity: .65;\r\n	filter: alpha(opacity=65);\r\n	-webkit-box-shadow: none;\r\n	-moz-box-shadow: none;\r\n	box-shadow: none\r\n}\r\n.btn-large {\r\n	padding: 11px 19px;\r\n	font-size: 17.5px;\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px\r\n}\r\n.btn-large [class^=&quot;icon-&quot;], .btn-large [class*=&quot; icon-&quot;] {\r\n	margin-top: 4px\r\n}\r\n.btn-small {\r\n	padding: 2px 10px;\r\n	font-size: 11.9px;\r\n	-webkit-border-radius: 3px;\r\n	-moz-border-radius: 3px;\r\n	border-radius: 3px\r\n}\r\n.btn-small [class^=&quot;icon-&quot;], .btn-small [class*=&quot; icon-&quot;] {\r\n	margin-top: 0\r\n}\r\n.btn-mini [class^=&quot;icon-&quot;], .btn-mini [class*=&quot; icon-&quot;] {\r\n	margin-top: -1px\r\n}\r\n.btn-mini {\r\n	padding: 0 6px;\r\n	font-size: 10.5px;\r\n	-webkit-border-radius: 3px;\r\n	-moz-border-radius: 3px;\r\n	border-radius: 3px\r\n}\r\n.btn-block {\r\n	display: block;\r\n	width: 100%;\r\n	padding-right: 0;\r\n	padding-left: 0;\r\n	-webkit-box-sizing: border-box;\r\n	-moz-box-sizing: border-box;\r\n	box-sizing: border-box\r\n}\r\n.btn-block+.btn-block {\r\n	margin-top: 5px\r\n}\r\ninput[type=&quot;submit&quot;].btn-block, input[type=&quot;reset&quot;].btn-block, input[type=&quot;button&quot;].btn-block {\r\n	width: 100%\r\n}\r\n.btn-primary.active, .btn-warning.active, .btn-danger.active, .btn-success.active, .btn-info.active, .btn-inverse.active {\r\n	color: rgba(255, 255, 255, 0.75)\r\n}\r\n.btn-primary {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #006dcc;\r\n	*background-color: #04c;\r\n	background-image: -moz-linear-gradient(top, #08c, #04c);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#08c), to(#04c));\r\n	background-image: -webkit-linear-gradient(top, #08c, #04c);\r\n	background-image: -o-linear-gradient(top, #08c, #04c);\r\n	background-image: linear-gradient(to bottom, #08c, #04c);\r\n	background-repeat: repeat-x;\r\n	border-color: #04c #04c #002a80;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff0088cc&#039;, endColorstr=&#039;#ff0044cc&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] {\r\n	color: #fff;\r\n	background-color: #04c;\r\n	*background-color: #003bb3\r\n}\r\n.btn-primary:active, .btn-primary.active {\r\n	background-color: #039 \\9\r\n}\r\n.btn-warning {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #faa732;\r\n	*background-color: #f89406;\r\n	background-image: -moz-linear-gradient(top, #fbb450, #f89406);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fbb450), to(#f89406));\r\n	background-image: -webkit-linear-gradient(top, #fbb450, #f89406);\r\n	background-image: -o-linear-gradient(top, #fbb450, #f89406);\r\n	background-image: linear-gradient(to bottom, #fbb450, #f89406);\r\n	background-repeat: repeat-x;\r\n	border-color: #f89406 #f89406 #ad6704;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#fffbb450&#039;, endColorstr=&#039;#fff89406&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.btn-warning:hover, .btn-warning:focus, .btn-warning:active, .btn-warning.active, .btn-warning.disabled, .btn-warning[disabled] {\r\n	color: #fff;\r\n	background-color: #f89406;\r\n	*background-color: #df8505\r\n}\r\n.btn-warning:active, .btn-warning.active {\r\n	background-color: #c67605 \\9\r\n}\r\n.btn-danger {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #da4f49;\r\n	*background-color: #bd362f;\r\n	background-image: -moz-linear-gradient(top, #ee5f5b, #bd362f);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ee5f5b), to(#bd362f));\r\n	background-image: -webkit-linear-gradient(top, #ee5f5b, #bd362f);\r\n	background-image: -o-linear-gradient(top, #ee5f5b, #bd362f);\r\n	background-image: linear-gradient(to bottom, #ee5f5b, #bd362f);\r\n	background-repeat: repeat-x;\r\n	border-color: #bd362f #bd362f #802420;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ffee5f5b&#039;, endColorstr=&#039;#ffbd362f&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.btn-danger:hover, .btn-danger:focus, .btn-danger:active, .btn-danger.active, .btn-danger.disabled, .btn-danger[disabled] {\r\n	color: #fff;\r\n	background-color: #bd362f;\r\n	*background-color: #a9302a\r\n}\r\n.btn-danger:active, .btn-danger.active {\r\n	background-color: #942a25 \\9\r\n}\r\n.btn-success {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #5bb75b;\r\n	*background-color: #51a351;\r\n	background-image: -moz-linear-gradient(top, #62c462, #51a351);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#51a351));\r\n	background-image: -webkit-linear-gradient(top, #62c462, #51a351);\r\n	background-image: -o-linear-gradient(top, #62c462, #51a351);\r\n	background-image: linear-gradient(to bottom, #62c462, #51a351);\r\n	background-repeat: repeat-x;\r\n	border-color: #51a351 #51a351 #387038;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff62c462&#039;, endColorstr=&#039;#ff51a351&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.btn-success:hover, .btn-success:focus, .btn-success:active, .btn-success.active, .btn-success.disabled, .btn-success[disabled] {\r\n	color: #fff;\r\n	background-color: #51a351;\r\n	*background-color: #499249\r\n}\r\n.btn-success:active, .btn-success.active {\r\n	background-color: #408140 \\9\r\n}\r\n.btn-info {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #49afcd;\r\n	*background-color: #2f96b4;\r\n	background-image: -moz-linear-gradient(top, #5bc0de, #2f96b4);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#5bc0de), to(#2f96b4));\r\n	background-image: -webkit-linear-gradient(top, #5bc0de, #2f96b4);\r\n	background-image: -o-linear-gradient(top, #5bc0de, #2f96b4);\r\n	background-image: linear-gradient(to bottom, #5bc0de, #2f96b4);\r\n	background-repeat: repeat-x;\r\n	border-color: #2f96b4 #2f96b4 #1f6377;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff5bc0de&#039;, endColorstr=&#039;#ff2f96b4&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .btn-info.disabled, .btn-info[disabled] {\r\n	color: #fff;\r\n	background-color: #2f96b4;\r\n	*background-color: #2a85a0\r\n}\r\n.btn-info:active, .btn-info.active {\r\n	background-color: #24748c \\9\r\n}\r\n.btn-inverse {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #363636;\r\n	*background-color: #222;\r\n	background-image: -moz-linear-gradient(top, #444, #222);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#444), to(#222));\r\n	background-image: -webkit-linear-gradient(top, #444, #222);\r\n	background-image: -o-linear-gradient(top, #444, #222);\r\n	background-image: linear-gradient(to bottom, #444, #222);\r\n	background-repeat: repeat-x;\r\n	border-color: #222 #222 #000;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff444444&#039;, endColorstr=&#039;#ff222222&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.btn-inverse:hover, .btn-inverse:focus, .btn-inverse:active, .btn-inverse.active, .btn-inverse.disabled, .btn-inverse[disabled] {\r\n	color: #fff;\r\n	background-color: #222;\r\n	*background-color: #151515\r\n}\r\n.btn-inverse:active, .btn-inverse.active {\r\n	background-color: #080808 \\9\r\n}\r\nbutton.btn, input[type=&quot;submit&quot;].btn {\r\n	*padding-top: 3px;\r\n	*padding-bottom: 3px\r\n}\r\nbutton.btn::-moz-focus-inner, input[type=&quot;submit&quot;].btn::-moz-focus-inner {\r\n	padding: 0;\r\n	border: 0\r\n}\r\nbutton.btn.btn-large, input[type=&quot;submit&quot;].btn.btn-large {\r\n	*padding-top: 7px;\r\n	*padding-bottom: 7px\r\n}\r\nbutton.btn.btn-small, input[type=&quot;submit&quot;].btn.btn-small {\r\n	*padding-top: 3px;\r\n	*padding-bottom: 3px\r\n}\r\nbutton.btn.btn-mini, input[type=&quot;submit&quot;].btn.btn-mini {\r\n	*padding-top: 1px;\r\n	*padding-bottom: 1px\r\n}\r\n.btn-link, .btn-link:active, .btn-link[disabled] {\r\n	background-color: transparent;\r\n	background-image: none;\r\n	-webkit-box-shadow: none;\r\n	-moz-box-shadow: none;\r\n	box-shadow: none\r\n}\r\n.btn-link {\r\n	color: #08c;\r\n	cursor: pointer;\r\n	border-color: transparent;\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.btn-link:hover, .btn-link:focus {\r\n	color: #005580;\r\n	text-decoration: underline;\r\n	background-color: transparent\r\n}\r\n.btn-link[disabled]:hover, .btn-link[disabled]:focus {\r\n	color: #333;\r\n	text-decoration: none\r\n}\r\n.btn-group {\r\n	position: relative;\r\n	display: inline-block;\r\n	*display: inline;\r\n	*margin-left: .3em;\r\n	font-size: 0;\r\n	white-space: nowrap;\r\n	vertical-align: middle;\r\n	*zoom: 1\r\n}\r\n.btn-group:first-child {\r\n	*margin-left: 0\r\n}\r\n.btn-group+.btn-group {\r\n	margin-left: 5px\r\n}\r\n.btn-toolbar {\r\n	margin-top: 10px;\r\n	margin-bottom: 10px;\r\n	font-size: 0\r\n}\r\n.btn-toolbar&gt;.btn+.btn, .btn-toolbar&gt;.btn-group+.btn, .btn-toolbar&gt;.btn+.btn-group {\r\n	margin-left: 5px\r\n}\r\n.btn-group&gt;.btn {\r\n	position: relative;\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.btn-group&gt;.btn+.btn {\r\n	margin-left: -1px\r\n}\r\n.btn-group&gt;.btn, .btn-group&gt;.dropdown-menu, .btn-group&gt;.popover {\r\n	font-size: 14px\r\n}\r\n.btn-group&gt;.btn-mini {\r\n	font-size: 10.5px\r\n}\r\n.btn-group&gt;.btn-small {\r\n	font-size: 11.9px\r\n}\r\n.btn-group&gt;.btn-large {\r\n	font-size: 17.5px\r\n}\r\n.btn-group&gt;.btn:first-child {\r\n	margin-left: 0;\r\n	-webkit-border-bottom-left-radius: 4px;\r\n	border-bottom-left-radius: 4px;\r\n	-webkit-border-top-left-radius: 4px;\r\n	border-top-left-radius: 4px;\r\n	-moz-border-radius-bottomleft: 4px;\r\n	-moz-border-radius-topleft: 4px\r\n}\r\n.btn-group&gt;.btn:last-child, .btn-group&gt;.dropdown-toggle {\r\n	-webkit-border-top-right-radius: 4px;\r\n	border-top-right-radius: 4px;\r\n	-webkit-border-bottom-right-radius: 4px;\r\n	border-bottom-right-radius: 4px;\r\n	-moz-border-radius-topright: 4px;\r\n	-moz-border-radius-bottomright: 4px\r\n}\r\n.btn-group&gt;.btn.large:first-child {\r\n	margin-left: 0;\r\n	-webkit-border-bottom-left-radius: 6px;\r\n	border-bottom-left-radius: 6px;\r\n	-webkit-border-top-left-radius: 6px;\r\n	border-top-left-radius: 6px;\r\n	-moz-border-radius-bottomleft: 6px;\r\n	-moz-border-radius-topleft: 6px\r\n}\r\n.btn-group&gt;.btn.large:last-child, .btn-group&gt;.large.dropdown-toggle {\r\n	-webkit-border-top-right-radius: 6px;\r\n	border-top-right-radius: 6px;\r\n	-webkit-border-bottom-right-radius: 6px;\r\n	border-bottom-right-radius: 6px;\r\n	-moz-border-radius-topright: 6px;\r\n	-moz-border-radius-bottomright: 6px\r\n}\r\n.btn-group&gt;.btn:hover, .btn-group&gt;.btn:focus, .btn-group&gt;.btn:active, .btn-group&gt;.btn.active {\r\n	z-index: 2\r\n}\r\n.btn-group .dropdown-toggle:active, .btn-group.open .dropdown-toggle {\r\n	outline: 0\r\n}\r\n.btn-group&gt;.btn+.dropdown-toggle {\r\n	*padding-top: 5px;\r\n	padding-right: 8px;\r\n	*padding-bottom: 5px;\r\n	padding-left: 8px;\r\n	-webkit-box-shadow: inset 1px 0 0 rgba(255, 255, 255, 0.125), inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	-moz-box-shadow: inset 1px 0 0 rgba(255, 255, 255, 0.125), inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	box-shadow: inset 1px 0 0 rgba(255, 255, 255, 0.125), inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05)\r\n}\r\n.btn-group&gt;.btn-mini+.dropdown-toggle {\r\n	*padding-top: 2px;\r\n	padding-right: 5px;\r\n	*padding-bottom: 2px;\r\n	padding-left: 5px\r\n}\r\n.btn-group&gt;.btn-small+.dropdown-toggle {\r\n	*padding-top: 5px;\r\n	*padding-bottom: 4px\r\n}\r\n.btn-group&gt;.btn-large+.dropdown-toggle {\r\n	*padding-top: 7px;\r\n	padding-right: 12px;\r\n	*padding-bottom: 7px;\r\n	padding-left: 12px\r\n}\r\n.btn-group.open .dropdown-toggle {\r\n	background-image: none;\r\n	-webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	-moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05)\r\n}\r\n.btn-group.open .btn.dropdown-toggle {\r\n	background-color: #e6e6e6\r\n}\r\n.btn-group.open .btn-primary.dropdown-toggle {\r\n	background-color: #04c\r\n}\r\n.btn-group.open .btn-warning.dropdown-toggle {\r\n	background-color: #f89406\r\n}\r\n.btn-group.open .btn-danger.dropdown-toggle {\r\n	background-color: #bd362f\r\n}\r\n.btn-group.open .btn-success.dropdown-toggle {\r\n	background-color: #51a351\r\n}\r\n.btn-group.open .btn-info.dropdown-toggle {\r\n	background-color: #2f96b4\r\n}\r\n.btn-group.open .btn-inverse.dropdown-toggle {\r\n	background-color: #222\r\n}\r\n.btn .caret {\r\n	margin-top: 8px;\r\n	margin-left: 0\r\n}\r\n.btn-large .caret {\r\n	margin-top: 6px\r\n}\r\n.btn-large .caret {\r\n	border-top-width: 5px;\r\n	border-right-width: 5px;\r\n	border-left-width: 5px\r\n}\r\n.btn-mini .caret, .btn-small .caret {\r\n	margin-top: 8px\r\n}\r\n.dropup .btn-large .caret {\r\n	border-bottom-width: 5px\r\n}\r\n.btn-primary .caret, .btn-warning .caret, .btn-danger .caret, .btn-info .caret, .btn-success .caret, .btn-inverse .caret {\r\n	border-top-color: #fff;\r\n	border-bottom-color: #fff\r\n}\r\n.btn-group-vertical {\r\n	display: inline-block;\r\n	*display: inline;\r\n	*zoom: 1\r\n}\r\n.btn-group-vertical&gt;.btn {\r\n	display: block;\r\n	float: none;\r\n	max-width: 100%;\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.btn-group-vertical&gt;.btn+.btn {\r\n	margin-top: -1px;\r\n	margin-left: 0\r\n}\r\n.btn-group-vertical&gt;.btn:first-child {\r\n	-webkit-border-radius: 4px 4px 0 0;\r\n	-moz-border-radius: 4px 4px 0 0;\r\n	border-radius: 4px 4px 0 0\r\n}\r\n.btn-group-vertical&gt;.btn:last-child {\r\n	-webkit-border-radius: 0 0 4px 4px;\r\n	-moz-border-radius: 0 0 4px 4px;\r\n	border-radius: 0 0 4px 4px\r\n}\r\n.btn-group-vertical&gt;.btn-large:first-child {\r\n	-webkit-border-radius: 6px 6px 0 0;\r\n	-moz-border-radius: 6px 6px 0 0;\r\n	border-radius: 6px 6px 0 0\r\n}\r\n.btn-group-vertical&gt;.btn-large:last-child {\r\n	-webkit-border-radius: 0 0 6px 6px;\r\n	-moz-border-radius: 0 0 6px 6px;\r\n	border-radius: 0 0 6px 6px\r\n}\r\n.alert {\r\n	padding: 8px 35px 8px 14px;\r\n	margin-bottom: 20px;\r\n	text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);\r\n	background-color: #fcf8e3;\r\n	border: 1px solid #fbeed5;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\n.alert, .alert h4 {\r\n	color: #c09853\r\n}\r\n.alert h4 {\r\n	margin: 0\r\n}\r\n.alert .close {\r\n	position: relative;\r\n	top: -2px;\r\n	right: -21px;\r\n	line-height: 20px\r\n}\r\n.alert-success {\r\n	color: #468847;\r\n	background-color: #dff0d8;\r\n	border-color: #d6e9c6\r\n}\r\n.alert-success h4 {\r\n	color: #468847\r\n}\r\n.alert-danger, .alert-error {\r\n	color: #b94a48;\r\n	background-color: #f2dede;\r\n	border-color: #eed3d7\r\n}\r\n.alert-danger h4, .alert-error h4 {\r\n	color: #b94a48\r\n}\r\n.alert-info {\r\n	color: #3a87ad;\r\n	background-color: #d9edf7;\r\n	border-color: #bce8f1\r\n}\r\n.alert-info h4 {\r\n	color: #3a87ad\r\n}\r\n.alert-block {\r\n	padding-top: 14px;\r\n	padding-bottom: 14px\r\n}\r\n.alert-block&gt;p, .alert-block&gt;ul {\r\n	margin-bottom: 0\r\n}\r\n.alert-block p+p {\r\n	margin-top: 5px\r\n}\r\n.nav {\r\n	margin-bottom: 20px;\r\n	margin-left: 0;\r\n	list-style: none\r\n}\r\n.nav&gt;li&gt;a {\r\n	display: block\r\n}\r\n.nav&gt;li&gt;a:hover, .nav&gt;li&gt;a:focus {\r\n	text-decoration: none;\r\n	background-color: #eee\r\n}\r\n.nav&gt;li&gt;a&gt;img {\r\n	max-width: none\r\n}\r\n.nav&gt;.pull-right {\r\n	float: right\r\n}\r\n.nav-header {\r\n	display: block;\r\n	padding: 3px 15px;\r\n	font-size: 11px;\r\n	font-weight: bold;\r\n	line-height: 20px;\r\n	color: #999;\r\n	text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);\r\n	text-transform: uppercase\r\n}\r\n.nav li+.nav-header {\r\n	margin-top: 9px\r\n}\r\n.nav-list {\r\n	padding-right: 15px;\r\n	padding-left: 15px;\r\n	margin-bottom: 0\r\n}\r\n.nav-list&gt;li&gt;a, .nav-list .nav-header {\r\n	margin-right: -15px;\r\n	margin-left: -15px;\r\n	text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5)\r\n}\r\n.nav-list&gt;li&gt;a {\r\n	padding: 3px 15px\r\n}\r\n.nav-list&gt;.active&gt;a, .nav-list&gt;.active&gt;a:hover, .nav-list&gt;.active&gt;a:focus {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2);\r\n	background-color: #08c\r\n}\r\n.nav-list [class^=&quot;icon-&quot;], .nav-list [class*=&quot; icon-&quot;] {\r\n	margin-right: 2px\r\n}\r\n.nav-list .divider {\r\n	*width: 100%;\r\n	height: 1px;\r\n	margin: 9px 1px;\r\n	*margin: -5px 0 5px;\r\n	overflow: hidden;\r\n	background-color: #e5e5e5;\r\n	border-bottom: 1px solid #fff\r\n}\r\n.nav-tabs, .nav-pills {\r\n	*zoom: 1\r\n}\r\n.nav-tabs:before, .nav-pills:before, .nav-tabs:after, .nav-pills:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.nav-tabs:after, .nav-pills:after {\r\n	clear: both\r\n}\r\n.nav-tabs&gt;li, .nav-pills&gt;li {\r\n	float: left\r\n}\r\n.nav-tabs&gt;li&gt;a, .nav-pills&gt;li&gt;a {\r\n	padding-right: 12px;\r\n	padding-left: 12px;\r\n	margin-right: 2px;\r\n	line-height: 14px\r\n}\r\n.nav-tabs {\r\n	border-bottom: 1px solid #ddd\r\n}\r\n.nav-tabs&gt;li {\r\n	margin-bottom: -1px\r\n}\r\n.nav-tabs&gt;li&gt;a {\r\n	padding-top: 8px;\r\n	padding-bottom: 8px;\r\n	line-height: 20px;\r\n	border: 1px solid transparent;\r\n	-webkit-border-radius: 4px 4px 0 0;\r\n	-moz-border-radius: 4px 4px 0 0;\r\n	border-radius: 4px 4px 0 0\r\n}\r\n.nav-tabs&gt;li&gt;a:hover, .nav-tabs&gt;li&gt;a:focus {\r\n	border-color: #eee #eee #ddd\r\n}\r\n.nav-tabs&gt;.active&gt;a, .nav-tabs&gt;.active&gt;a:hover, .nav-tabs&gt;.active&gt;a:focus {\r\n	color: #555;\r\n	cursor: default;\r\n	background-color: #fff;\r\n	border: 1px solid #ddd;\r\n	border-bottom-color: transparent\r\n}\r\n.nav-pills&gt;li&gt;a {\r\n	padding-top: 8px;\r\n	padding-bottom: 8px;\r\n	margin-top: 2px;\r\n	margin-bottom: 2px;\r\n	-webkit-border-radius: 5px;\r\n	-moz-border-radius: 5px;\r\n	border-radius: 5px\r\n}\r\n.nav-pills&gt;.active&gt;a, .nav-pills&gt;.active&gt;a:hover, .nav-pills&gt;.active&gt;a:focus {\r\n	color: #fff;\r\n	background-color: #08c\r\n}\r\n.nav-stacked&gt;li {\r\n	float: none\r\n}\r\n.nav-stacked&gt;li&gt;a {\r\n	margin-right: 0\r\n}\r\n.nav-tabs.nav-stacked {\r\n	border-bottom: 0\r\n}\r\n.nav-tabs.nav-stacked&gt;li&gt;a {\r\n	border: 1px solid #ddd;\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.nav-tabs.nav-stacked&gt;li:first-child&gt;a {\r\n	-webkit-border-top-right-radius: 4px;\r\n	border-top-right-radius: 4px;\r\n	-webkit-border-top-left-radius: 4px;\r\n	border-top-left-radius: 4px;\r\n	-moz-border-radius-topright: 4px;\r\n	-moz-border-radius-topleft: 4px\r\n}\r\n.nav-tabs.nav-stacked&gt;li:last-child&gt;a {\r\n	-webkit-border-bottom-right-radius: 4px;\r\n	border-bottom-right-radius: 4px;\r\n	-webkit-border-bottom-left-radius: 4px;\r\n	border-bottom-left-radius: 4px;\r\n	-moz-border-radius-bottomright: 4px;\r\n	-moz-border-radius-bottomleft: 4px\r\n}\r\n.nav-tabs.nav-stacked&gt;li&gt;a:hover, .nav-tabs.nav-stacked&gt;li&gt;a:focus {\r\n	z-index: 2;\r\n	border-color: #ddd\r\n}\r\n.nav-pills.nav-stacked&gt;li&gt;a {\r\n	margin-bottom: 3px\r\n}\r\n.nav-pills.nav-stacked&gt;li:last-child&gt;a {\r\n	margin-bottom: 1px\r\n}\r\n.nav-tabs .dropdown-menu {\r\n	-webkit-border-radius: 0 0 6px 6px;\r\n	-moz-border-radius: 0 0 6px 6px;\r\n	border-radius: 0 0 6px 6px\r\n}\r\n.nav-pills .dropdown-menu {\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px\r\n}\r\n.nav .dropdown-toggle .caret {\r\n	margin-top: 6px;\r\n	border-top-color: #08c;\r\n	border-bottom-color: #08c\r\n}\r\n.nav .dropdown-toggle:hover .caret, .nav .dropdown-toggle:focus .caret {\r\n	border-top-color: #005580;\r\n	border-bottom-color: #005580\r\n}\r\n.nav-tabs .dropdown-toggle .caret {\r\n	margin-top: 8px\r\n}\r\n.nav .active .dropdown-toggle .caret {\r\n	border-top-color: #fff;\r\n	border-bottom-color: #fff\r\n}\r\n.nav-tabs .active .dropdown-toggle .caret {\r\n	border-top-color: #555;\r\n	border-bottom-color: #555\r\n}\r\n.nav&gt;.dropdown.active&gt;a:hover, .nav&gt;.dropdown.active&gt;a:focus {\r\n	cursor: pointer\r\n}\r\n.nav-tabs .open .dropdown-toggle, .nav-pills .open .dropdown-toggle, .nav&gt;li.dropdown.open.active&gt;a:hover, .nav&gt;li.dropdown.open.active&gt;a:focus {\r\n	color: #fff;\r\n	background-color: #999;\r\n	border-color: #999\r\n}\r\n.nav li.dropdown.open .caret, .nav li.dropdown.open.active .caret, .nav li.dropdown.open a:hover .caret, .nav li.dropdown.open a:focus .caret {\r\n	border-top-color: #fff;\r\n	border-bottom-color: #fff;\r\n	opacity: 1;\r\n	filter: alpha(opacity=100)\r\n}\r\n.tabs-stacked .open&gt;a:hover, .tabs-stacked .open&gt;a:focus {\r\n	border-color: #999\r\n}\r\n.tabbable {\r\n	*zoom: 1\r\n}\r\n\r\n.tabbable:before, .tabbable:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.tabbable:after {\r\n	clear: both\r\n}\r\n.tab-content {\r\n	overflow: auto\r\n}\r\n.tabs-below&gt;.nav-tabs, .tabs-right&gt;.nav-tabs, .tabs-left&gt;.nav-tabs {\r\n	border-bottom: 0\r\n}\r\n.tab-content&gt;.tab-pane, .pill-content&gt;.pill-pane {\r\n	display: none\r\n}\r\n.tab-content&gt;.active, .pill-content&gt;.active {\r\n	display: block\r\n}\r\n.tabs-below&gt;.nav-tabs {\r\n	border-top: 1px solid #ddd\r\n}\r\n.tabs-below&gt;.nav-tabs&gt;li {\r\n	margin-top: -1px;\r\n	margin-bottom: 0\r\n}\r\n.tabs-below&gt;.nav-tabs&gt;li&gt;a {\r\n	-webkit-border-radius: 0 0 4px 4px;\r\n	-moz-border-radius: 0 0 4px 4px;\r\n	border-radius: 0 0 4px 4px\r\n}\r\n.tabs-below&gt;.nav-tabs&gt;li&gt;a:hover, .tabs-below&gt;.nav-tabs&gt;li&gt;a:focus {\r\n	border-top-color: #ddd;\r\n	border-bottom-color: transparent\r\n}\r\n.tabs-below&gt;.nav-tabs&gt;.active&gt;a, .tabs-below&gt;.nav-tabs&gt;.active&gt;a:hover, .tabs-below&gt;.nav-tabs&gt;.active&gt;a:focus {\r\n	border-color: transparent #ddd #ddd #ddd\r\n}\r\n.tabs-left&gt;.nav-tabs&gt;li, .tabs-right&gt;.nav-tabs&gt;li {\r\n	float: none\r\n}\r\n.tabs-left&gt;.nav-tabs&gt;li&gt;a, .tabs-right&gt;.nav-tabs&gt;li&gt;a {\r\n	min-width: 74px;\r\n	margin-right: 0;\r\n	margin-bottom: 3px\r\n}\r\n.tabs-left&gt;.nav-tabs {\r\n	float: left;\r\n	margin-right: 19px;\r\n	border-right: 1px solid #ddd\r\n}\r\n.tabs-left&gt;.nav-tabs&gt;li&gt;a {\r\n	margin-right: -1px;\r\n	-webkit-border-radius: 4px 0 0 4px;\r\n	-moz-border-radius: 4px 0 0 4px;\r\n	border-radius: 4px 0 0 4px\r\n}\r\n.tabs-left&gt;.nav-tabs&gt;li&gt;a:hover, .tabs-left&gt;.nav-tabs&gt;li&gt;a:focus {\r\n	border-color: #eee #ddd #eee #eee\r\n}\r\n.tabs-left&gt;.nav-tabs .active&gt;a, .tabs-left&gt;.nav-tabs .active&gt;a:hover, .tabs-left&gt;.nav-tabs .active&gt;a:focus {\r\n	border-color: #ddd transparent #ddd #ddd;\r\n	*border-right-color: #fff\r\n}\r\n.tabs-right&gt;.nav-tabs {\r\n	float: right;\r\n	margin-left: 19px;\r\n	border-left: 1px solid #ddd\r\n}\r\n\r\n.tabs-right&gt;.nav-tabs&gt;li&gt;a {\r\n	margin-left: -1px;\r\n	-webkit-border-radius: 0 4px 4px 0;\r\n	-moz-border-radius: 0 4px 4px 0;\r\n	border-radius: 0 4px 4px 0\r\n}\r\n.tabs-right&gt;.nav-tabs&gt;li&gt;a:hover, .tabs-right&gt;.nav-tabs&gt;li&gt;a:focus {\r\n	border-color: #eee #eee #eee #ddd\r\n}\r\n.tabs-right&gt;.nav-tabs .active&gt;a, .tabs-right&gt;.nav-tabs .active&gt;a:hover, .tabs-right&gt;.nav-tabs .active&gt;a:focus {\r\n	border-color: #ddd #ddd #ddd transparent;\r\n	*border-left-color: #fff\r\n}\r\n.nav&gt;.disabled&gt;a {\r\n	color: #999\r\n}\r\n.nav&gt;.disabled&gt;a:hover, .nav&gt;.disabled&gt;a:focus {\r\n	text-decoration: none;\r\n	cursor: default;\r\n	background-color: transparent\r\n}\r\n.navbar {\r\n	*position: relative;\r\n	*z-index: 2;\r\n	margin-bottom: 20px;\r\n	overflow: visible\r\n}\r\n.navbar-inner {\r\n	min-height: 40px;\r\n	padding-right: 20px;\r\n	padding-left: 20px;\r\n	background-color: #fafafa;\r\n	background-image: -moz-linear-gradient(top, #fff, #f2f2f2);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), to(#f2f2f2));\r\n	background-image: -webkit-linear-gradient(top, #fff, #f2f2f2);\r\n	background-image: -o-linear-gradient(top, #fff, #f2f2f2);\r\n	background-image: linear-gradient(to bottom, #fff, #f2f2f2);\r\n	background-repeat: repeat-x;\r\n	border: 1px solid #d4d4d4;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ffffffff&#039;, endColorstr=&#039;#fff2f2f2&#039;, GradientType=0);\r\n	*zoom: 1;\r\n	-webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065);\r\n	-moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065);\r\n	box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065)\r\n}\r\n.navbar-inner:before, .navbar-inner:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n\r\n.navbar-inner:after {\r\n	clear: both\r\n}\r\n.navbar .container {\r\n	width: auto\r\n}\r\n.nav-collapse.collapse {\r\n	height: auto;\r\n	overflow: visible\r\n}\r\n.navbar .brand {\r\n	display: block;\r\n	float: left;\r\n	padding: 10px 20px 10px;\r\n	margin-left: -20px;\r\n	font-size: 20px;\r\n	font-weight: 200;\r\n	color: #777;\r\n	text-shadow: 0 1px 0 #fff\r\n}\r\n.navbar .brand:hover, .navbar .brand:focus {\r\n	text-decoration: none\r\n}\r\n.navbar-text {\r\n	margin-bottom: 0;\r\n	line-height: 40px;\r\n	color: #777\r\n}\r\n.navbar-link {\r\n	color: #777\r\n}\r\n.navbar-link:hover, .navbar-link:focus {\r\n	color: #333\r\n}\r\n.navbar .divider-vertical {\r\n	height: 40px;\r\n	margin: 0 9px;\r\n	border-right: 1px solid #fff;\r\n	border-left: 1px solid #f2f2f2\r\n}\r\n.navbar .btn, .navbar .btn-group {\r\n	margin-top: 5px\r\n}\r\n.navbar .btn-group .btn, .navbar .input-prepend .btn, .navbar .input-append .btn, .navbar .input-prepend .btn-group, .navbar .input-append .btn-group {\r\n	margin-top: 0\r\n}\r\n.navbar-form {\r\n	margin-bottom: 0;\r\n	*zoom: 1\r\n}\r\n.navbar-form:before, .navbar-form:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n\r\n.navbar-form:after {\r\n	clear: both\r\n}\r\n.navbar-form input, .navbar-form select, .navbar-form .radio, .navbar-form .checkbox {\r\n	margin-top: 5px\r\n}\r\n.navbar-form input, .navbar-form select, .navbar-form .btn {\r\n	display: inline-block;\r\n	margin-bottom: 0\r\n}\r\n.navbar-form input[type=&quot;image&quot;], .navbar-form input[type=&quot;checkbox&quot;], .navbar-form input[type=&quot;radio&quot;] {\r\n	margin-top: 3px\r\n}\r\n.navbar-form .input-append, .navbar-form .input-prepend {\r\n	margin-top: 5px;\r\n	white-space: nowrap\r\n}\r\n.navbar-form .input-append input, .navbar-form .input-prepend input {\r\n	margin-top: 0\r\n}\r\n.navbar-search {\r\n	position: relative;\r\n	float: left;\r\n	margin-top: 5px;\r\n	margin-bottom: 0\r\n}\r\n.navbar-search .search-query {\r\n	padding: 4px 14px;\r\n	margin-bottom: 0;\r\n	font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\r\n	font-size: 13px;\r\n	font-weight: normal;\r\n	line-height: 1;\r\n	-webkit-border-radius: 15px;\r\n	-moz-border-radius: 15px;\r\n	border-radius: 15px\r\n}\r\n.navbar-static-top {\r\n	position: static;\r\n	margin-bottom: 0\r\n}\r\n.navbar-static-top .navbar-inner {\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.navbar-fixed-top, .navbar-fixed-bottom {\r\n	position: fixed;\r\n	right: 0;\r\n	left: 0;\r\n	z-index: 1030;\r\n	margin-bottom: 0\r\n}\r\n.navbar-fixed-top .navbar-inner, .navbar-static-top .navbar-inner {\r\n	border-width: 0 0 1px\r\n}\r\n\r\n.navbar-fixed-bottom .navbar-inner {\r\n	border-width: 1px 0 0\r\n}\r\n.navbar-fixed-top .navbar-inner, .navbar-fixed-bottom .navbar-inner {\r\n	padding-right: 0;\r\n	padding-left: 0;\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container {\r\n	width: 940px\r\n}\r\n.navbar-fixed-top {\r\n	top: 0\r\n}\r\n.navbar-fixed-top .navbar-inner, .navbar-static-top .navbar-inner {\r\n	-webkit-box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);\r\n	-moz-box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);\r\n	box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1)\r\n}\r\n.navbar-fixed-bottom {\r\n	bottom: 0\r\n}\r\n.navbar-fixed-bottom .navbar-inner {\r\n	-webkit-box-shadow: 0 -1px 10px rgba(0, 0, 0, 0.1);\r\n	-moz-box-shadow: 0 -1px 10px rgba(0, 0, 0, 0.1);\r\n	box-shadow: 0 -1px 10px rgba(0, 0, 0, 0.1)\r\n}\r\n\r\n.navbar .nav {\r\n	position: relative;\r\n	left: 0;\r\n	display: block;\r\n	float: left;\r\n	margin: 0 10px 0 0\r\n}\r\n\r\n.navbar .nav.pull-right {\r\n	float: right;\r\n	margin-right: 0\r\n}\r\n.navbar .nav&gt;li {\r\n	float: left\r\n}\r\n\r\n.navbar .nav&gt;li&gt;a {\r\n	float: none;\r\n	padding: 20px 20px 10px;\r\n	color: #777;\r\n	text-decoration: none;\r\n}\r\n.navbar .nav .messages-menu, .notifications-menu, .tasks-menu{\r\n	margin-top: 4px;\r\n}\r\n\r\n.navbar .nav .dropdown-toggle .caret {\r\n	margin: 8px 5px;\r\n}\r\n.navbar .nav&gt;li&gt;a:focus, .navbar .nav&gt;li&gt;a:hover {\r\n	color: #333;\r\n	text-decoration: none;\r\n	background-color: transparent\r\n}\r\n.navbar .nav&gt;.active&gt;a, .navbar .nav&gt;.active&gt;a:hover, .navbar .nav&gt;.active&gt;a:focus {\r\n	color: #555;\r\n	text-decoration: none;\r\n	background-color: #e5e5e5;\r\n	-webkit-box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.125);\r\n	-moz-box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.125);\r\n	box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.125)\r\n}\r\n\r\n.navbar .btn-navbar {\r\n	display: none;\r\n	float: right;\r\n	padding: 7px 10px;\r\n	margin-right: 5px;\r\n	margin-left: 5px;\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #ededed;\r\n	*background-color: #e5e5e5;\r\n	background-image: -moz-linear-gradient(top, #f2f2f2, #e5e5e5);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f2f2f2), to(#e5e5e5));\r\n	background-image: -webkit-linear-gradient(top, #f2f2f2, #e5e5e5);\r\n	background-image: -o-linear-gradient(top, #f2f2f2, #e5e5e5);\r\n	background-image: linear-gradient(to bottom, #f2f2f2, #e5e5e5);\r\n	background-repeat: repeat-x;\r\n	border-color: #e5e5e5 #e5e5e5 #bfbfbf;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#fff2f2f2&#039;, endColorstr=&#039;#ffe5e5e5&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);\r\n	-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 0 rgba(255, 255, 255, 0.075);\r\n	-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 0 rgba(255, 255, 255, 0.075);\r\n	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 0 rgba(255, 255, 255, 0.075)\r\n}\r\n.navbar .btn-navbar:hover, .navbar .btn-navbar:focus, .navbar .btn-navbar:active, .navbar .btn-navbar.active, .navbar .btn-navbar.disabled, .navbar .btn-navbar[disabled] {\r\n	color: #fff;\r\n	background-color: #e5e5e5;\r\n	*background-color: #d9d9d9\r\n}\r\n.navbar .btn-navbar:active, .navbar .btn-navbar.active {\r\n	background-color: #ccc \\9\r\n}\r\n\r\n.navbar .btn-navbar .icon-bar {\r\n	display: block;\r\n	width: 18px;\r\n	height: 2px;\r\n	background-color: #f5f5f5;\r\n	-webkit-border-radius: 1px;\r\n	-moz-border-radius: 1px;\r\n	border-radius: 1px;\r\n	-webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);\r\n	-moz-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);\r\n	box-shadow: 0 1px 0 rgba(0, 0, 0, 0.25)\r\n}\r\n.btn-navbar .icon-bar+.icon-bar {\r\n	margin-top: 3px\r\n}\r\n.navbar .nav&gt;li&gt;.dropdown-menu:before {\r\n	position: absolute;\r\n	top: -7px;\r\n	left: 245px;\r\n	border-right: 7px solid transparent;\r\n	border-bottom: 7px solid #ccc;\r\n	border-left: 7px solid transparent;\r\n	border-bottom-color: rgba(0, 0, 0, 0.2);\r\n}\r\n.navbar .nav&gt;li&gt;.dropdown-menu:after {\r\n	position: absolute;\r\n	top: -15px;\r\n	left: 255px;\r\n	border-right: 6px solid transparent;\r\n	border-bottom: 6px solid #fff;\r\n	border-left: 6px solid transparent;\r\n}\r\n\r\n.navbar-fixed-bottom .nav&gt;li&gt;.dropdown-menu:before {\r\n	top: auto;\r\n	bottom: -7px;\r\n	border-top: 7px solid #ccc;\r\n	border-bottom: 0;\r\n	border-top-color: rgba(0, 0, 0, 0.2)\r\n}\r\n.navbar-fixed-bottom .nav&gt;li&gt;.dropdown-menu:after {\r\n	top: auto;\r\n	bottom: -6px;\r\n	border-top: 6px solid #fff;\r\n	border-bottom: 0\r\n}\r\n\r\n.navbar .nav li.dropdown&gt;a:hover .caret, .navbar .nav li.dropdown&gt;a:focus .caret {\r\n	border-top-color: #333;\r\n	border-bottom-color: #333\r\n}\r\n\r\n\r\n.navbar .nav li.dropdown&gt;.dropdown-toggle .caret {\r\n	border-top-color: #777;\r\n	border-bottom-color: #777\r\n}\r\n.navbar .nav li.dropdown.open&gt;.dropdown-toggle .caret, .navbar .nav li.dropdown.active&gt;.dropdown-toggle .caret, .navbar .nav li.dropdown.open.active&gt;.dropdown-toggle .caret {\r\n	border-top-color: #555;\r\n	border-bottom-color: #555\r\n}\r\n.navbar .pull-right&gt;li&gt;.dropdown-menu, .navbar .nav&gt;li&gt;.dropdown-menu.pull-right {\r\n	right: 0;\r\n	left: auto\r\n}\r\n.navbar .pull-right&gt;li&gt;.dropdown-menu:before, .navbar .nav&gt;li&gt;.dropdown-menu.pull-right:before {\r\n	right: 12px;\r\n	left: auto\r\n}\r\n.navbar .pull-right&gt;li&gt;.dropdown-menu:after, .navbar .nav&gt;li&gt;.dropdown-menu.pull-right:after {\r\n	right: 13px;\r\n	left: auto\r\n}\r\n.navbar .pull-right&gt;li&gt;.dropdown-menu .dropdown-menu, .navbar .nav&gt;li&gt;.dropdown-menu.pull-right .dropdown-menu {\r\n	right: 100%;\r\n	left: auto;\r\n	margin-right: -1px;\r\n	margin-left: 0;\r\n	-webkit-border-radius: 6px 0 6px 6px;\r\n	-moz-border-radius: 6px 0 6px 6px;\r\n	border-radius: 6px 0 6px 6px\r\n}\r\n\r\n.navbar-inverse .navbar-inner {\r\n	background-color: #1b1b1b;\r\n	background-image: -moz-linear-gradient(top, #222, #111);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#222), to(#111));\r\n	background-image: -webkit-linear-gradient(top, #222, #111);\r\n	background-image: -o-linear-gradient(top, #222, #111);\r\n	background-image: linear-gradient(to bottom, #222, #111);\r\n	background-repeat: repeat-x;\r\n	border-color: #252525;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff222222&#039;, endColorstr=&#039;#ff111111&#039;, GradientType=0)\r\n}\r\n.navbar-inverse .brand, .navbar-inverse .nav&gt;li&gt;a {\r\n	color: #999;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25)\r\n}\r\n.navbar-inverse .brand:hover, .navbar-inverse .nav&gt;li&gt;a:hover, .navbar-inverse .brand:focus, .navbar-inverse .nav&gt;li&gt;a:focus {\r\n	color: #fff\r\n}\r\n.navbar-inverse .brand {\r\n	color: #999\r\n}\r\n.navbar-inverse .navbar-text {\r\n	color: #999\r\n}\r\n.navbar-inverse .nav&gt;li&gt;a:focus, .navbar-inverse .nav&gt;li&gt;a:hover {\r\n	color: #fff;\r\n	background-color: transparent\r\n}\r\n.navbar-inverse .nav .active&gt;a, .navbar-inverse .nav .active&gt;a:hover, .navbar-inverse .nav .active&gt;a:focus {\r\n	color: #fff;\r\n	background-color: #111\r\n}\r\n.navbar-inverse .navbar-link {\r\n	color: #999\r\n}\r\n.navbar-inverse .navbar-link:hover, .navbar-inverse .navbar-link:focus {\r\n	color: #fff\r\n}\r\n.navbar-inverse .divider-vertical {\r\n	border-right-color: #222;\r\n	border-left-color: #111\r\n}\r\n.navbar-inverse .nav li.dropdown.open&gt;.dropdown-toggle, .navbar-inverse .nav li.dropdown.active&gt;.dropdown-toggle, .navbar-inverse .nav li.dropdown.open.active&gt;.dropdown-toggle {\r\n	color: #fff;\r\n	background-color: #111\r\n}\r\n.navbar-inverse .nav li.dropdown&gt;a:hover .caret, .navbar-inverse .nav li.dropdown&gt;a:focus .caret {\r\n	border-top-color: #fff;\r\n	border-bottom-color: #fff\r\n}\r\n.navbar-inverse .nav li.dropdown&gt;.dropdown-toggle .caret {\r\n	border-top-color: #999;\r\n	border-bottom-color: #999\r\n}\r\n.navbar-inverse .nav li.dropdown.open&gt;.dropdown-toggle .caret, .navbar-inverse .nav li.dropdown.active&gt;.dropdown-toggle .caret, .navbar-inverse .nav li.dropdown.open.active&gt;.dropdown-toggle .caret {\r\n	border-top-color: #fff;\r\n	border-bottom-color: #fff\r\n}\r\n.navbar-inverse .navbar-search .search-query {\r\n	color: #fff;\r\n	background-color: #515151;\r\n	border-color: #111;\r\n	-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 1px 0 rgba(255, 255, 255, 0.15);\r\n	-moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 1px 0 rgba(255, 255, 255, 0.15);\r\n	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 1px 0 rgba(255, 255, 255, 0.15);\r\n	-webkit-transition: none;\r\n	-moz-transition: none;\r\n	-o-transition: none;\r\n	transition: none\r\n}\r\n.navbar-inverse .navbar-search .search-query:-moz-placeholder {\r\n	color: #ccc\r\n}\r\n.navbar-inverse .navbar-search .search-query:-ms-input-placeholder {\r\n	color: #ccc\r\n}\r\n.navbar-inverse .navbar-search .search-query::-webkit-input-placeholder {\r\n	color: #ccc\r\n}\r\n\r\n.navbar-inverse .navbar-search .search-query:focus, .navbar-inverse .navbar-search .search-query.focused {\r\n	padding: 5px 15px;\r\n	color: #333;\r\n	text-shadow: 0 1px 0 #fff;\r\n	background-color: #fff;\r\n	border: 0;\r\n	outline: 0;\r\n	-webkit-box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);\r\n	-moz-box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);\r\n	box-shadow: 0 0 3px rgba(0, 0, 0, 0.15)\r\n}\r\n.navbar-inverse .btn-navbar {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #0e0e0e;\r\n	*background-color: #040404;\r\n	background-image: -moz-linear-gradient(top, #151515, #040404);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#151515), to(#040404));\r\n	background-image: -webkit-linear-gradient(top, #151515, #040404);\r\n	background-image: -o-linear-gradient(top, #151515, #040404);\r\n	background-image: linear-gradient(to bottom, #151515, #040404);\r\n	background-repeat: repeat-x;\r\n	border-color: #040404 #040404 #000;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff151515&#039;, endColorstr=&#039;#ff040404&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.navbar-inverse .btn-navbar:hover, .navbar-inverse .btn-navbar:focus, .navbar-inverse .btn-navbar:active, .navbar-inverse .btn-navbar.active, .navbar-inverse .btn-navbar.disabled, .navbar-inverse .btn-navbar[disabled] {\r\n	color: #fff;\r\n	background-color: #040404;\r\n	*background-color: #000\r\n}\r\n.navbar-inverse .btn-navbar:active, .navbar-inverse .btn-navbar.active {\r\n	background-color: #000 \\9\r\n}\r\n.breadcrumb {\r\n	padding: 8px 15px;\r\n	margin: 0 0 20px;\r\n	list-style: none;\r\n	background-color: #f5f5f5;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\n.breadcrumb&gt;li {\r\n	display: inline-block;\r\n	*display: inline;\r\n	text-shadow: 0 1px 0 #fff;\r\n	*zoom: 1\r\n}\r\n.breadcrumb&gt;li&gt;.divider {\r\n	padding: 0 5px;\r\n	color: #ccc\r\n}\r\n.breadcrumb&gt;.active {\r\n	color: #999\r\n}\r\n.pagination {\r\n	margin: 20px 0\r\n}\r\n.pagination ul {\r\n	display: inline-block;\r\n	*display: inline;\r\n	margin-bottom: 0;\r\n	margin-left: 0;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px;\r\n	*zoom: 1;\r\n	-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05)\r\n}\r\n.pagination ul&gt;li {\r\n	display: inline\r\n}\r\n.pagination ul&gt;li&gt;a, .pagination ul&gt;li&gt;span {\r\n	float: left;\r\n	padding: 4px 12px;\r\n	line-height: 20px;\r\n	text-decoration: none;\r\n	background-color: #fff;\r\n	border: 1px solid #ddd;\r\n	border-left-width: 0\r\n}\r\n.pagination ul&gt;li&gt;a:hover, .pagination ul&gt;li&gt;a:focus, .pagination ul&gt;.active&gt;a, .pagination ul&gt;.active&gt;span {\r\n	background-color: #f5f5f5\r\n}\r\n.pagination ul&gt;.active&gt;a, .pagination ul&gt;.active&gt;span {\r\n	color: #999;\r\n	cursor: default\r\n}\r\n.pagination ul&gt;.disabled&gt;span, .pagination ul&gt;.disabled&gt;a, .pagination ul&gt;.disabled&gt;a:hover, .pagination ul&gt;.disabled&gt;a:focus {\r\n	color: #999;\r\n	cursor: default;\r\n	background-color: transparent\r\n}\r\n.pagination ul&gt;li:first-child&gt;a, .pagination ul&gt;li:first-child&gt;span {\r\n	border-left-width: 1px;\r\n	-webkit-border-bottom-left-radius: 4px;\r\n	border-bottom-left-radius: 4px;\r\n	-webkit-border-top-left-radius: 4px;\r\n	border-top-left-radius: 4px;\r\n	-moz-border-radius-bottomleft: 4px;\r\n	-moz-border-radius-topleft: 4px\r\n}\r\n.pagination ul&gt;li:last-child&gt;a, .pagination ul&gt;li:last-child&gt;span {\r\n	-webkit-border-top-right-radius: 4px;\r\n	border-top-right-radius: 4px;\r\n	-webkit-border-bottom-right-radius: 4px;\r\n	border-bottom-right-radius: 4px;\r\n	-moz-border-radius-topright: 4px;\r\n	-moz-border-radius-bottomright: 4px\r\n}\r\n.pagination-centered {\r\n	text-align: center\r\n}\r\n.pagination-right {\r\n	text-align: right\r\n}\r\n.pagination-large ul&gt;li&gt;a, .pagination-large ul&gt;li&gt;span {\r\n	padding: 11px 19px;\r\n	font-size: 17.5px\r\n}\r\n.pagination-large ul&gt;li:first-child&gt;a, .pagination-large ul&gt;li:first-child&gt;span {\r\n	-webkit-border-bottom-left-radius: 6px;\r\n	border-bottom-left-radius: 6px;\r\n	-webkit-border-top-left-radius: 6px;\r\n	border-top-left-radius: 6px;\r\n	-moz-border-radius-bottomleft: 6px;\r\n	-moz-border-radius-topleft: 6px\r\n}\r\n.pagination-large ul&gt;li:last-child&gt;a, .pagination-large ul&gt;li:last-child&gt;span {\r\n	-webkit-border-top-right-radius: 6px;\r\n	border-top-right-radius: 6px;\r\n	-webkit-border-bottom-right-radius: 6px;\r\n	border-bottom-right-radius: 6px;\r\n	-moz-border-radius-topright: 6px;\r\n	-moz-border-radius-bottomright: 6px\r\n}\r\n.pagination-mini ul&gt;li:first-child&gt;a, .pagination-small ul&gt;li:first-child&gt;a, .pagination-mini ul&gt;li:first-child&gt;span, .pagination-small ul&gt;li:first-child&gt;span {\r\n	-webkit-border-bottom-left-radius: 3px;\r\n	border-bottom-left-radius: 3px;\r\n	-webkit-border-top-left-radius: 3px;\r\n	border-top-left-radius: 3px;\r\n	-moz-border-radius-bottomleft: 3px;\r\n	-moz-border-radius-topleft: 3px\r\n}\r\n.pagination-mini ul&gt;li:last-child&gt;a, .pagination-small ul&gt;li:last-child&gt;a, .pagination-mini ul&gt;li:last-child&gt;span, .pagination-small ul&gt;li:last-child&gt;span {\r\n	-webkit-border-top-right-radius: 3px;\r\n	border-top-right-radius: 3px;\r\n	-webkit-border-bottom-right-radius: 3px;\r\n	border-bottom-right-radius: 3px;\r\n	-moz-border-radius-topright: 3px;\r\n	-moz-border-radius-bottomright: 3px\r\n}\r\n.pagination-small ul&gt;li&gt;a, .pagination-small ul&gt;li&gt;span {\r\n	padding: 2px 10px;\r\n	font-size: 11.9px\r\n}\r\n.pagination-mini ul&gt;li&gt;a, .pagination-mini ul&gt;li&gt;span {\r\n	padding: 0 6px;\r\n	font-size: 10.5px\r\n}\r\n.pager {\r\n	margin: 20px 0;\r\n	text-align: center;\r\n	list-style: none;\r\n	*zoom: 1\r\n}\r\n.pager:before, .pager:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.pager:after {\r\n	clear: both\r\n}\r\n.pager li {\r\n	display: inline\r\n}\r\n.pager li&gt;a, .pager li&gt;span {\r\n	display: inline-block;\r\n	padding: 5px 14px;\r\n	background-color: #fff;\r\n	border: 1px solid #ddd;\r\n	-webkit-border-radius: 15px;\r\n	-moz-border-radius: 15px;\r\n	border-radius: 15px\r\n}\r\n.pager li&gt;a:hover, .pager li&gt;a:focus {\r\n	text-decoration: none;\r\n	background-color: #f5f5f5\r\n}\r\n.pager .next&gt;a, .pager .next&gt;span {\r\n	float: right\r\n}\r\n.pager .previous&gt;a, .pager .previous&gt;span {\r\n	float: left\r\n}\r\n.pager .disabled&gt;a, .pager .disabled&gt;a:hover, .pager .disabled&gt;a:focus, .pager .disabled&gt;span {\r\n	color: #999;\r\n	cursor: default;\r\n	background-color: #fff\r\n}\r\n.modal-backdrop {\r\n	position: fixed;\r\n	top: 0;\r\n	right: 0;\r\n	bottom: 0;\r\n	left: 0;\r\n	z-index: 1040;\r\n	background-color: #000\r\n}\r\n.modal-backdrop.fade {\r\n	opacity: 0\r\n}\r\n.modal-backdrop, .modal-backdrop.fade.in {\r\n	opacity: .8;\r\n	filter: alpha(opacity=80)\r\n}\r\n\r\n.modal-open {\r\n  overflow: hidden;\r\n}\r\n\r\n.modal {\r\n	display: none;\r\n	overflow: hidden;\r\n	position: fixed;\r\n	top: 10%;\r\n	left: 50%;\r\n	z-index: 1050;\r\n	width: 560px;\r\n	margin-left: -280px;\r\n	background-color: #fff;\r\n	border: 1px solid #999;\r\n	border: 1px solid rgba(0, 0, 0, 0.3);\r\n	*border: 1px solid #999;\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px;\r\n	outline: 0;\r\n	-webkit-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);\r\n	-moz-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);\r\n	box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);\r\n	-webkit-background-clip: padding-box;\r\n	-moz-background-clip: padding-box;\r\n	background-clip: padding-box\r\n}\r\n.modal.fade {\r\n	top: -25%;\r\n	-webkit-transition: opacity .3s linear, top .3s ease-out;\r\n	-moz-transition: opacity .3s linear, top .3s ease-out;\r\n	-o-transition: opacity .3s linear, top .3s ease-out;\r\n	transition: opacity .3s linear, top .3s ease-out\r\n}\r\n.modal.fade.in {\r\n	top: 10%\r\n}\r\n.modal-header {\r\n	padding: 9px 15px;\r\n	border-bottom: 1px solid #eee\r\n}\r\n.modal-header .close {\r\n	margin-top: 2px\r\n}\r\n.modal-header h3 {\r\n	margin: 0;\r\n	line-height: 30px\r\n}\r\n.modal-body {\r\n	position: relative;\r\n	max-height: 400px;\r\n	padding: 15px;\r\n	overflow-y: auto\r\n}\r\n.modal-form {\r\n	margin-bottom: 0\r\n}\r\n.modal-footer {\r\n	padding: 14px 15px 15px;\r\n	margin-bottom: 0;\r\n	text-align: right;\r\n	background-color: #f5f5f5;\r\n	border-top: 1px solid #ddd;\r\n	-webkit-border-radius: 0 0 6px 6px;\r\n	-moz-border-radius: 0 0 6px 6px;\r\n	border-radius: 0 0 6px 6px;\r\n	*zoom: 1;\r\n	-webkit-box-shadow: inset 0 1px 0 #fff;\r\n	-moz-box-shadow: inset 0 1px 0 #fff;\r\n	box-shadow: inset 0 1px 0 #fff\r\n}\r\n.modal-footer:before, .modal-footer:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.modal-footer:after {\r\n	clear: both\r\n}\r\n.modal-footer .btn+.btn {\r\n	margin-bottom: 0;\r\n	margin-left: 5px\r\n}\r\n.modal-footer .btn-group .btn+.btn {\r\n	margin-left: -1px\r\n}\r\n.modal-footer .btn-block+.btn-block {\r\n	margin-left: 0\r\n}\r\n.tooltip {\r\n	position: absolute;\r\n	z-index: 1030;\r\n	display: block;\r\n	font-size: 11px;\r\n	line-height: 1.4;\r\n	opacity: 0;\r\n	filter: alpha(opacity=0);\r\n	visibility: visible\r\n}\r\n.tooltip.in {\r\n	opacity: .8;\r\n	filter: alpha(opacity=80)\r\n}\r\n.tooltip.top {\r\n	padding: 5px 0;\r\n	margin-top: -3px\r\n}\r\n.tooltip.right {\r\n	padding: 0 5px;\r\n	margin-left: 3px\r\n}\r\n.tooltip.bottom {\r\n	padding: 5px 0;\r\n	margin-top: 3px\r\n}\r\n.tooltip.left {\r\n	padding: 0 5px;\r\n	margin-left: -3px\r\n}\r\n.tooltip-inner {\r\n	max-width: 200px;\r\n	padding: 8px;\r\n	color: #fff;\r\n	text-align: center;\r\n	text-decoration: none;\r\n	background-color: #000;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\n.tooltip-arrow {\r\n	position: absolute;\r\n	width: 0;\r\n	height: 0;\r\n	border-color: transparent;\r\n	border-style: solid\r\n}\r\n.tooltip.top .tooltip-arrow {\r\n	bottom: 0;\r\n	left: 50%;\r\n	margin-left: -5px;\r\n	border-top-color: #000;\r\n	border-width: 5px 5px 0\r\n}\r\n.tooltip.right .tooltip-arrow {\r\n	top: 50%;\r\n	left: 0;\r\n	margin-top: -5px;\r\n	border-right-color: #000;\r\n	border-width: 5px 5px 5px 0\r\n}\r\n.tooltip.left .tooltip-arrow {\r\n	top: 50%;\r\n	right: 0;\r\n	margin-top: -5px;\r\n	border-left-color: #000;\r\n	border-width: 5px 0 5px 5px\r\n}\r\n.tooltip.bottom .tooltip-arrow {\r\n	top: 0;\r\n	left: 50%;\r\n	margin-left: -5px;\r\n	border-bottom-color: #000;\r\n	border-width: 0 5px 5px\r\n}\r\n.popover {\r\n	position: absolute;\r\n	top: 0;\r\n	left: 0;\r\n	z-index: 1010;\r\n	display: none;\r\n	max-width: 276px;\r\n	padding: 1px;\r\n	text-align: left;\r\n	white-space: normal;\r\n	background-color: #fff;\r\n	border: 1px solid #ccc;\r\n	border: 1px solid rgba(0, 0, 0, 0.2);\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px;\r\n	-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n	-moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n	-webkit-background-clip: padding-box;\r\n	-moz-background-clip: padding;\r\n	background-clip: padding-box\r\n}\r\n.popover.top {\r\n	margin-top: -10px\r\n}\r\n.popover.right {\r\n	margin-left: 10px\r\n}\r\n.popover.bottom {\r\n	margin-top: 10px\r\n}\r\n.popover.left {\r\n	margin-left: -10px\r\n}\r\n.popover-title {\r\n	padding: 8px 14px;\r\n	margin: 0;\r\n	font-size: 14px;\r\n	font-weight: normal;\r\n	line-height: 18px;\r\n	background-color: #f7f7f7;\r\n	border-bottom: 1px solid #ebebeb;\r\n	-webkit-border-radius: 5px 5px 0 0;\r\n	-moz-border-radius: 5px 5px 0 0;\r\n	border-radius: 5px 5px 0 0\r\n}\r\n.popover-title:empty {\r\n	display: none\r\n}\r\n.popover-content {\r\n	padding: 9px 14px\r\n}\r\n.popover .arrow, .popover .arrow:after {\r\n	position: absolute;\r\n	display: block;\r\n	width: 0;\r\n	height: 0;\r\n	border-color: transparent;\r\n	border-style: solid\r\n}\r\n.popover .arrow {\r\n	border-width: 11px\r\n}\r\n.popover .arrow:after {\r\n	border-width: 10px;\r\n	content: &quot;&quot;\r\n}\r\n.popover.top .arrow {\r\n	bottom: -11px;\r\n	left: 50%;\r\n	margin-left: -11px;\r\n	border-top-color: #999;\r\n	border-top-color: rgba(0, 0, 0, 0.25);\r\n	border-bottom-width: 0\r\n}\r\n.popover.top .arrow:after {\r\n	bottom: 1px;\r\n	margin-left: -10px;\r\n	border-top-color: #fff;\r\n	border-bottom-width: 0\r\n}\r\n.popover.right .arrow {\r\n	top: 50%;\r\n	left: -11px;\r\n	margin-top: -11px;\r\n	border-right-color: #999;\r\n	border-right-color: rgba(0, 0, 0, 0.25);\r\n	border-left-width: 0\r\n}\r\n.popover.right .arrow:after {\r\n	bottom: -10px;\r\n	left: 1px;\r\n	border-right-color: #fff;\r\n	border-left-width: 0\r\n}\r\n.popover.bottom .arrow {\r\n	top: -11px;\r\n	left: 50%;\r\n	margin-left: -11px;\r\n	border-bottom-color: #999;\r\n	border-bottom-color: rgba(0, 0, 0, 0.25);\r\n	border-top-width: 0\r\n}\r\n.popover.bottom .arrow:after {\r\n	top: 1px;\r\n	margin-left: -10px;\r\n	border-bottom-color: #fff;\r\n	border-top-width: 0\r\n}\r\n.popover.left .arrow {\r\n	top: 50%;\r\n	right: -11px;\r\n	margin-top: -11px;\r\n	border-left-color: #999;\r\n	border-left-color: rgba(0, 0, 0, 0.25);\r\n	border-right-width: 0\r\n}\r\n.popover.left .arrow:after {\r\n	right: 1px;\r\n	bottom: -10px;\r\n	border-left-color: #fff;\r\n	border-right-width: 0\r\n}\r\n.thumbnails {\r\n	margin-left: -20px;\r\n	list-style: none;\r\n	*zoom: 1\r\n}\r\n.thumbnails:before, .thumbnails:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.thumbnails:after {\r\n	clear: both\r\n}\r\n.row-fluid .thumbnails {\r\n	margin-left: 0\r\n}\r\n.thumbnails&gt;li {\r\n	float: left;\r\n	margin-bottom: 20px;\r\n	margin-left: 20px\r\n}\r\n.thumbnail {\r\n	display: block;\r\n	padding: 4px;\r\n	line-height: 20px;\r\n	border: 1px solid #ddd;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px;\r\n	-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);\r\n	-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);\r\n	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);\r\n	-webkit-transition: all .2s ease-in-out;\r\n	-moz-transition: all .2s ease-in-out;\r\n	-o-transition: all .2s ease-in-out;\r\n	transition: all .2s ease-in-out\r\n}\r\na.thumbnail:hover, a.thumbnail:focus {\r\n	border-color: #08c;\r\n	-webkit-box-shadow: 0 1px 4px rgba(0, 105, 214, 0.25);\r\n	-moz-box-shadow: 0 1px 4px rgba(0, 105, 214, 0.25);\r\n	box-shadow: 0 1px 4px rgba(0, 105, 214, 0.25)\r\n}\r\n.thumbnail&gt;img {\r\n	display: block;\r\n	max-width: 100%;\r\n	margin-right: auto;\r\n	margin-left: auto\r\n}\r\n.thumbnail .caption {\r\n	padding: 9px;\r\n	color: #555\r\n}\r\n.media, .media-body {\r\n	overflow: hidden;\r\n	*overflow: visible;\r\n	zoom: 1\r\n}\r\n.media, .media .media {\r\n	margin-top: 15px\r\n}\r\n.media:first-child {\r\n	margin-top: 0\r\n}\r\n.media-object {\r\n	display: block\r\n}\r\n.media-heading {\r\n	margin: 0 0 5px\r\n}\r\n.media&gt;.pull-left {\r\n	margin-right: 10px\r\n}\r\n.media&gt;.pull-right {\r\n	margin-left: 10px\r\n}\r\n.media-list {\r\n	margin-left: 0;\r\n	list-style: none\r\n}\r\n.label, .badge {\r\n	display: inline-block;\r\n	padding: 2px 4px;\r\n	font-size: 11.844px;\r\n	font-weight: bold;\r\n	line-height: 14px;\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	white-space: nowrap;\r\n	vertical-align: baseline;\r\n	background-color: #999\r\n}\r\n.label {\r\n	-webkit-border-radius: 3px;\r\n	-moz-border-radius: 3px;\r\n	border-radius: 3px\r\n}\r\n.badge {\r\n	padding-right: 9px;\r\n	padding-left: 9px;\r\n	-webkit-border-radius: 9px;\r\n	-moz-border-radius: 9px;\r\n	border-radius: 9px\r\n}\r\n.label:empty, .badge:empty {\r\n	display: none\r\n}\r\na.label:hover, a.label:focus, a.badge:hover, a.badge:focus {\r\n	color: #fff;\r\n	text-decoration: none;\r\n	cursor: pointer\r\n}\r\n.label-important, .badge-important {\r\n	background-color: #b94a48\r\n}\r\n.label-important[href], .badge-important[href] {\r\n	background-color: #953b39\r\n}\r\n.label-warning, .badge-warning {\r\n	background-color: #f89406\r\n}\r\n.label-warning[href], .badge-warning[href] {\r\n	background-color: #c67605\r\n}\r\n.label-success, .badge-success {\r\n	background-color: #468847\r\n}\r\n.label-success[href], .badge-success[href] {\r\n	background-color: #356635\r\n}\r\n.label-info, .badge-info {\r\n	background-color: #3a87ad\r\n}\r\n.label-info[href], .badge-info[href] {\r\n	background-color: #2d6987\r\n}\r\n.label-inverse, .badge-inverse {\r\n	background-color: #333\r\n}\r\n.label-inverse[href], .badge-inverse[href] {\r\n	background-color: #1a1a1a\r\n}\r\n.btn .label, .btn .badge {\r\n	position: relative;\r\n	top: -1px\r\n}\r\n.btn-mini .label, .btn-mini .badge {\r\n	top: 0\r\n}\r\n@-webkit-keyframes progress-bar-stripes {\r\n	from {\r\n		background-position: 40px 0\r\n	}\r\n	to {\r\n		background-position: 0 0\r\n	}\r\n}\r\n@-moz-keyframes progress-bar-stripes {\r\n	from {\r\n		background-position: 40px 0\r\n	}\r\n	to {\r\n		background-position: 0 0\r\n	}\r\n}\r\n@-ms-keyframes progress-bar-stripes {\r\n	from {\r\n		background-position: 40px 0\r\n	}\r\n	to {\r\n		background-position: 0 0\r\n	}\r\n}\r\n@-o-keyframes progress-bar-stripes {\r\n	from {\r\n		background-position: 0 0\r\n	}\r\n	to {\r\n		background-position: 40px 0\r\n	}\r\n}\r\n@keyframes progress-bar-stripes {\r\n	from {\r\n		background-position: 40px 0\r\n	}\r\n	to {\r\n		background-position: 0 0\r\n	}\r\n}\r\n.progress {\r\n	height: 20px;\r\n	margin-bottom: 20px;\r\n	overflow: hidden;\r\n	background-color: #f7f7f7;\r\n	background-image: -moz-linear-gradient(top, #f5f5f5, #f9f9f9);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f5f5f5), to(#f9f9f9));\r\n	background-image: -webkit-linear-gradient(top, #f5f5f5, #f9f9f9);\r\n	background-image: -o-linear-gradient(top, #f5f5f5, #f9f9f9);\r\n	background-image: linear-gradient(to bottom, #f5f5f5, #f9f9f9);\r\n	background-repeat: repeat-x;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#fff5f5f5&#039;, endColorstr=&#039;#fff9f9f9&#039;, GradientType=0);\r\n	-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);\r\n	-moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);\r\n	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1)\r\n}\r\n.progress .bar {\r\n	float: left;\r\n	width: 0;\r\n	height: 100%;\r\n	font-size: 12px;\r\n	color: #fff;\r\n	text-align: center;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #0e90d2;\r\n	background-image: -moz-linear-gradient(top, #149bdf, #0480be);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#149bdf), to(#0480be));\r\n	background-image: -webkit-linear-gradient(top, #149bdf, #0480be);\r\n	background-image: -o-linear-gradient(top, #149bdf, #0480be);\r\n	background-image: linear-gradient(to bottom, #149bdf, #0480be);\r\n	background-repeat: repeat-x;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff149bdf&#039;, endColorstr=&#039;#ff0480be&#039;, GradientType=0);\r\n	-webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);\r\n	-moz-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);\r\n	box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);\r\n	-webkit-box-sizing: border-box;\r\n	-moz-box-sizing: border-box;\r\n	box-sizing: border-box;\r\n	-webkit-transition: width .6s ease;\r\n	-moz-transition: width .6s ease;\r\n	-o-transition: width .6s ease;\r\n	transition: width .6s ease\r\n}\r\n.progress .bar+.bar {\r\n	-webkit-box-shadow: inset 1px 0 0 rgba(0, 0, 0, 0.15), inset 0 -1px 0 rgba(0, 0, 0, 0.15);\r\n	-moz-box-shadow: inset 1px 0 0 rgba(0, 0, 0, 0.15), inset 0 -1px 0 rgba(0, 0, 0, 0.15);\r\n	box-shadow: inset 1px 0 0 rgba(0, 0, 0, 0.15), inset 0 -1px 0 rgba(0, 0, 0, 0.15)\r\n}\r\n.progress-striped .bar {\r\n	background-color: #149bdf;\r\n	background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));\r\n	background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	-webkit-background-size: 40px 40px;\r\n	-moz-background-size: 40px 40px;\r\n	-o-background-size: 40px 40px;\r\n	background-size: 40px 40px\r\n}\r\n.progress.active .bar {\r\n	-webkit-animation: progress-bar-stripes 2s linear infinite;\r\n	-moz-animation: progress-bar-stripes 2s linear infinite;\r\n	-ms-animation: progress-bar-stripes 2s linear infinite;\r\n	-o-animation: progress-bar-stripes 2s linear infinite;\r\n	animation: progress-bar-stripes 2s linear infinite\r\n}\r\n.progress-danger .bar, .progress .bar-danger {\r\n	background-color: #dd514c;\r\n	background-image: -moz-linear-gradient(top, #ee5f5b, #c43c35);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ee5f5b), to(#c43c35));\r\n	background-image: -webkit-linear-gradient(top, #ee5f5b, #c43c35);\r\n	background-image: -o-linear-gradient(top, #ee5f5b, #c43c35);\r\n	background-image: linear-gradient(to bottom, #ee5f5b, #c43c35);\r\n	background-repeat: repeat-x;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ffee5f5b&#039;, endColorstr=&#039;#ffc43c35&#039;, GradientType=0)\r\n}\r\n.progress-danger.progress-striped .bar, .progress-striped .bar-danger {\r\n	background-color: #ee5f5b;\r\n	background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));\r\n	background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent)\r\n}\r\n.progress-success .bar, .progress .bar-success {\r\n	background-color: #5eb95e;\r\n	background-image: -moz-linear-gradient(top, #62c462, #57a957);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#57a957));\r\n	background-image: -webkit-linear-gradient(top, #62c462, #57a957);\r\n	background-image: -o-linear-gradient(top, #62c462, #57a957);\r\n	background-image: linear-gradient(to bottom, #62c462, #57a957);\r\n	background-repeat: repeat-x;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff62c462&#039;, endColorstr=&#039;#ff57a957&#039;, GradientType=0)\r\n}\r\n.progress-success.progress-striped .bar, .progress-striped .bar-success {\r\n	background-color: #62c462;\r\n	background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));\r\n	background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent)\r\n}\r\n.progress-info .bar, .progress .bar-info {\r\n	background-color: #4bb1cf;\r\n	background-image: -moz-linear-gradient(top, #5bc0de, #339bb9);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#5bc0de), to(#339bb9));\r\n	background-image: -webkit-linear-gradient(top, #5bc0de, #339bb9);\r\n	background-image: -o-linear-gradient(top, #5bc0de, #339bb9);\r\n	background-image: linear-gradient(to bottom, #5bc0de, #339bb9);\r\n	background-repeat: repeat-x;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff5bc0de&#039;, endColorstr=&#039;#ff339bb9&#039;, GradientType=0)\r\n}\r\n.progress-info.progress-striped .bar, .progress-striped .bar-info {\r\n	background-color: #5bc0de;\r\n	background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));\r\n	background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent)\r\n}\r\n.progress-warning .bar, .progress .bar-warning {\r\n	background-color: #faa732;\r\n	background-image: -moz-linear-gradient(top, #fbb450, #f89406);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fbb450), to(#f89406));\r\n	background-image: -webkit-linear-gradient(top, #fbb450, #f89406);\r\n	background-image: -o-linear-gradient(top, #fbb450, #f89406);\r\n	background-image: linear-gradient(to bottom, #fbb450, #f89406);\r\n	background-repeat: repeat-x;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#fffbb450&#039;, endColorstr=&#039;#fff89406&#039;, GradientType=0)\r\n}\r\n.progress-warning.progress-striped .bar, .progress-striped .bar-warning {\r\n	background-color: #fbb450;\r\n	background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));\r\n	background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent)\r\n}\r\n.accordion {\r\n	margin-bottom: 20px\r\n}\r\n.accordion-group {\r\n	margin-bottom: 2px;\r\n	border: 1px solid #e5e5e5;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\n.accordion-heading {\r\n	border-bottom: 0\r\n}\r\n.accordion-heading .accordion-toggle {\r\n	display: block;\r\n	padding: 8px 15px\r\n}\r\n.accordion-toggle {\r\n	cursor: pointer\r\n}\r\n.accordion-inner {\r\n	padding: 9px 15px;\r\n	border-top: 1px solid #e5e5e5\r\n}\r\n.carousel {\r\n	position: relative;\r\n	margin-bottom: 20px;\r\n	line-height: 1\r\n}\r\n.carousel-inner {\r\n	position: relative;\r\n	width: 100%;\r\n	overflow: hidden\r\n}\r\n.carousel-inner&gt;.item {\r\n	position: relative;\r\n	display: none;\r\n	-webkit-transition: .6s ease-in-out left;\r\n	-moz-transition: .6s ease-in-out left;\r\n	-o-transition: .6s ease-in-out left;\r\n	transition: .6s ease-in-out left\r\n}\r\n.carousel-inner&gt;.item&gt;img, .carousel-inner&gt;.item&gt;a&gt;img {\r\n	display: block;\r\n	line-height: 1\r\n}\r\n.carousel-inner&gt;.active, .carousel-inner&gt;.next, .carousel-inner&gt;.prev {\r\n	display: block\r\n}\r\n.carousel-inner&gt;.active {\r\n	left: 0\r\n}\r\n.carousel-inner&gt;.next, .carousel-inner&gt;.prev {\r\n	position: absolute;\r\n	top: 0;\r\n	width: 100%\r\n}\r\n.carousel-inner&gt;.next {\r\n	left: 100%\r\n}\r\n.carousel-inner&gt;.prev {\r\n	left: -100%\r\n}\r\n.carousel-inner&gt;.next.left, .carousel-inner&gt;.prev.right {\r\n	left: 0\r\n}\r\n.carousel-inner&gt;.active.left {\r\n	left: -100%\r\n}\r\n.carousel-inner&gt;.active.right {\r\n	left: 100%\r\n}\r\n.carousel-control {\r\n	position: absolute;\r\n	top: 40%;\r\n	left: 15px;\r\n	width: 40px;\r\n	height: 40px;\r\n	margin-top: -20px;\r\n	font-size: 60px;\r\n	font-weight: 100;\r\n	line-height: 30px;\r\n	color: #fff;\r\n	text-align: center;\r\n	background: #222;\r\n	border: 3px solid #fff;\r\n	-webkit-border-radius: 23px;\r\n	-moz-border-radius: 23px;\r\n	border-radius: 23px;\r\n	opacity: .5;\r\n	filter: alpha(opacity=50)\r\n}\r\n.carousel-control.right {\r\n	right: 15px;\r\n	left: auto\r\n}\r\n.carousel-control:hover, .carousel-control:focus {\r\n	color: #fff;\r\n	text-decoration: none;\r\n	opacity: .9;\r\n	filter: alpha(opacity=90)\r\n}\r\n.carousel-indicators {\r\n	position: absolute;\r\n	top: 15px;\r\n	right: 15px;\r\n	z-index: 5;\r\n	margin: 0;\r\n	list-style: none\r\n}\r\n.carousel-indicators li {\r\n	display: block;\r\n	float: left;\r\n	width: 10px;\r\n	height: 10px;\r\n	margin-left: 5px;\r\n	text-indent: -999px;\r\n	background-color: #ccc;\r\n	background-color: rgba(255, 255, 255, 0.25);\r\n	border-radius: 5px\r\n}\r\n.carousel-indicators .active {\r\n	background-color: #fff\r\n}\r\n.carousel-caption {\r\n	position: absolute;\r\n	right: 0;\r\n	bottom: 0;\r\n	left: 0;\r\n	padding: 15px;\r\n	background: #333;\r\n	background: rgba(0, 0, 0, 0.75)\r\n}\r\n.carousel-caption h4, .carousel-caption p {\r\n	line-height: 20px;\r\n	color: #fff\r\n}\r\n.carousel-caption h4 {\r\n	margin: 0 0 5px\r\n}\r\n.carousel-caption p {\r\n	margin-bottom: 0\r\n}\r\n.hero-unit {\r\n	padding: 60px;\r\n	margin-bottom: 30px;\r\n	font-size: 18px;\r\n	font-weight: 200;\r\n	line-height: 30px;\r\n	color: inherit;\r\n	background-color: #eee;\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px\r\n}\r\n.hero-unit h1 {\r\n	margin-bottom: 0;\r\n	font-size: 60px;\r\n	line-height: 1;\r\n	letter-spacing: -1px;\r\n	color: inherit\r\n}\r\n.hero-unit li {\r\n	line-height: 30px\r\n}\r\n.pull-right {\r\n	float: right\r\n}\r\n.pull-left {\r\n	float: left\r\n}\r\n.hide {\r\n	display: none\r\n}\r\n.show {\r\n	display: block\r\n}\r\n.invisible {\r\n	visibility: hidden\r\n}\r\n.affix {\r\n	position: fixed\r\n}', '1', '2016-04-23 03:33:53', '2016-04-23 04:33:53', '1461393233', '0', null, '0', 'cabecalho');
INSERT INTO `shop_code` VALUES ('14', '25', 'Código do rodapé', 'rodape', 'html', 'todas', '/* !\r\n* Bootstrap v2.3.1\r\n*\r\n* Copyright 2012 Twitter, Inc\r\n* Licensed under the Apache License v2.0\r\n* http://www.apache.org/licenses/LICENSE-2.0\r\n*\r\n* Designed and built with all the love in the world @twitter by @mdo and @fat. */.clearfix {\r\n	*zoom: 1\r\n}\r\n.clearfix:before, .clearfix:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.clearfix:after {\r\n	clear: both\r\n}\r\n.hide-text {\r\n	font: 0/0 a;\r\n	color: transparent;\r\n	text-shadow: none;\r\n	background-color: transparent;\r\n	border: 0\r\n}\r\n.input-block-level {\r\n	display: block;\r\n	width: 100%;\r\n	min-height: 30px;\r\n	-webkit-box-sizing: border-box;\r\n	-moz-box-sizing: border-box;\r\n	box-sizing: border-box\r\n}\r\narticle, aside, details, figcaption, figure, footer, header, hgroup, nav, section {\r\n	display: block\r\n}\r\naudio, canvas, video {\r\n	display: inline-block;\r\n	*display: inline;\r\n	*zoom: 1\r\n}\r\naudio:not([controls]) {\r\n	display: none\r\n}\r\nhtml {\r\n	font-size: 100%;\r\n	-webkit-text-size-adjust: 100%;\r\n	-ms-text-size-adjust: 100%\r\n}\r\na:focus {\r\n	outline: thin dotted #333;\r\n	outline: 5px auto -webkit-focus-ring-color;\r\n	outline-offset: -2px\r\n}\r\na:hover, a:active {\r\n	outline: 0\r\n}\r\nsub, sup {\r\n	position: relative;\r\n	font-size: 75%;\r\n	line-height: 0;\r\n	vertical-align: baseline\r\n}\r\nsup {\r\n	top: -0.5em\r\n}\r\nsub {\r\n	bottom: -0.25em\r\n}\r\nimg {\r\n	width: auto\\9;\r\n	height: auto;\r\n	max-width: 100%;\r\n	vertical-align: middle;\r\n	border: 0;\r\n	-ms-interpolation-mode: bicubic\r\n}\r\n#map_canvas img, .google-maps img {\r\n	max-width: none\r\n}\r\nbutton, input, select, textarea {\r\n	margin: 0;\r\n	font-size: 100%;\r\n	vertical-align: middle\r\n}\r\nbutton, input {\r\n	*overflow: visible;\r\n	line-height: normal\r\n}\r\nbutton::-moz-focus-inner, input::-moz-focus-inner {\r\n	padding: 0;\r\n	border: 0\r\n}\r\nbutton, html input[type=&quot;button&quot;], input[type=&quot;reset&quot;], input[type=&quot;submit&quot;] {\r\n	cursor: pointer;\r\n	-webkit-appearance: button\r\n}\r\nlabel, select, button, input[type=&quot;button&quot;], input[type=&quot;reset&quot;], input[type=&quot;submit&quot;], input[type=&quot;radio&quot;], input[type=&quot;checkbox&quot;] {\r\n	cursor: pointer\r\n}\r\ninput[type=&quot;search&quot;] {\r\n	-webkit-box-sizing: content-box;\r\n	-moz-box-sizing: content-box;\r\n	box-sizing: content-box;\r\n	-webkit-appearance: textfield\r\n}\r\ninput[type=&quot;search&quot;]::-webkit-search-decoration, input[type=&quot;search&quot;]::-webkit-search-cancel-button {\r\n	-webkit-appearance: none\r\n}\r\ntextarea {\r\n	overflow: auto;\r\n	vertical-align: top\r\n}\r\n@media print {\r\n	*{color: #000 !important;\r\n		text-shadow: none !important;\r\n		background: transparent !important;\r\n		box-shadow: none !important\r\n	}\r\n	a, a:visited {\r\n		text-decoration: underline\r\n	}\r\n	a[href]:after {\r\n		content: &quot; (&quot; attr(href) &quot;)&quot;\r\n	}\r\n	abbr[title]:after {\r\n		content: &quot; (&quot; attr(title) &quot;)&quot;\r\n	}\r\n	.ir a:after, a[href^=&quot;javascript:&quot;]:after, a[href^=&quot;#&quot;]:after {\r\n		content: &quot;&quot;\r\n	}\r\n	pre, blockquote {\r\n		border: 1px solid #999;\r\n		page-break-inside: avoid\r\n	}\r\n	thead {\r\n		display: table-header-group\r\n	}\r\n	tr, img {\r\n		page-break-inside: avoid\r\n	}\r\n	img {\r\n		max-width: 100% !important\r\n	}\r\n	@page {\r\n		margin: .5cm\r\n	}\r\n	p, h2, h3 {\r\n		orphans: 3;\r\n		widows: 3\r\n	}\r\n	h2, h3 {\r\n		page-break-after: avoid\r\n	}\r\n}\r\nbody {\r\n	margin: 0;\r\n	font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\r\n	font-size: 14px;\r\n	line-height: 20px;\r\n	color: #333;\r\n	background-color: #fff\r\n}\r\na {\r\n	color: #08c;\r\n	text-decoration: none\r\n}\r\na:hover, a:focus {\r\n	color: #005580;\r\n	text-decoration: underline\r\n}\r\n.img-rounded {\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px\r\n}\r\n.img-polaroid {\r\n	padding: 4px;\r\n	background-color: #fff;\r\n	border: 1px solid #ccc;\r\n	border: 1px solid rgba(0, 0, 0, 0.2);\r\n	-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);\r\n	-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);\r\n	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1)\r\n}\r\n.img-circle {\r\n	-webkit-border-radius: 500px;\r\n	-moz-border-radius: 500px;\r\n	border-radius: 500px\r\n}\r\n.row {\r\n	margin-left: -20px;\r\n	*zoom: 1\r\n}\r\n.row:before, .row:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.row:after {\r\n	clear: both\r\n}\r\n[class*=&quot;span&quot;] {\r\n	float: left;\r\n	min-height: 1px;\r\n	margin-left: 20px\r\n}\r\n.container, .navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container {\r\n	width: 940px\r\n}\r\n.span12 {\r\n	width: 940px\r\n}\r\n.span11 {\r\n	width: 860px\r\n}\r\n.span10 {\r\n	width: 780px\r\n}\r\n.span9 {\r\n	width: 700px\r\n}\r\n.span8 {\r\n	width: 620px\r\n}\r\n.span7 {\r\n	width: 540px\r\n}\r\n.span6 {\r\n	width: 460px\r\n}\r\n.span5 {\r\n	width: 380px\r\n}\r\n.span4 {\r\n	width: 300px\r\n}\r\n.span3 {\r\n	width: 220px\r\n}\r\n.span2 {\r\n	width: 140px\r\n}\r\n.span1 {\r\n	width: 60px\r\n}\r\n.offset12 {\r\n	margin-left: 980px\r\n}\r\n.offset11 {\r\n	margin-left: 900px\r\n}\r\n.offset10 {\r\n	margin-left: 820px\r\n}\r\n.offset9 {\r\n	margin-left: 740px\r\n}\r\n.offset8 {\r\n	margin-left: 660px\r\n}\r\n.offset7 {\r\n	margin-left: 580px\r\n}\r\n.offset6 {\r\n	margin-left: 500px\r\n}\r\n.offset5 {\r\n	margin-left: 420px\r\n}\r\n.offset4 {\r\n	margin-left: 340px\r\n}\r\n.offset3 {\r\n	margin-left: 260px\r\n}\r\n.offset2 {\r\n	margin-left: 180px\r\n}\r\n.offset1 {\r\n	margin-left: 100px\r\n}\r\n.row-fluid {\r\n	width: 100%;\r\n	*zoom: 1\r\n}\r\n.row-fluid:before, .row-fluid:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.row-fluid:after {\r\n	clear: both\r\n}\r\n.row-fluid [class*=&quot;span&quot;] {\r\n	display: block;\r\n	float: left;\r\n	width: 100%;\r\n	min-height: 30px;\r\n	margin-left: 2.127659574468085%;\r\n	*margin-left: 2.074468085106383%;\r\n	-webkit-box-sizing: border-box;\r\n	-moz-box-sizing: border-box;\r\n	box-sizing: border-box\r\n}\r\n.row-fluid [class*=&quot;span&quot;]:first-child {\r\n	margin-left: 0\r\n}\r\n.row-fluid .controls-row [class*=&quot;span&quot;]+[class*=&quot;span&quot;] {\r\n	margin-left: 2.127659574468085%\r\n}\r\n.row-fluid .span12 {\r\n	width: 100%;\r\n	*width: 99.94680851063829%\r\n}\r\n.row-fluid .span11 {\r\n	width: 91.48936170212765%;\r\n	*width: 91.43617021276594%\r\n}\r\n.row-fluid .span10 {\r\n	width: 82.97872340425532%;\r\n	*width: 82.92553191489361%\r\n}\r\n.row-fluid .span9 {\r\n	width: 74.46808510638297%;\r\n	*width: 74.41489361702126%\r\n}\r\n.row-fluid .span8 {\r\n	width: 65.95744680851064%;\r\n	*width: 65.90425531914893%\r\n}\r\n.row-fluid .span7 {\r\n	width: 57.44680851063829%;\r\n	*width: 57.39361702127659%\r\n}\r\n.row-fluid .span6 {\r\n	width: 48.93617021276595%;\r\n	*width: 48.88297872340425%\r\n}\r\n.row-fluid .span5 {\r\n	width: 40.42553191489362%;\r\n	*width: 40.37234042553192%\r\n}\r\n.row-fluid .span4 {\r\n	width: 31.914893617021278%;\r\n	*width: 31.861702127659576%\r\n}\r\n.row-fluid .span3 {\r\n	width: 23.404255319148934%;\r\n	*width: 23.351063829787233%\r\n}\r\n.row-fluid .span2 {\r\n	width: 14.893617021276595%;\r\n	*width: 14.840425531914894%\r\n}\r\n.row-fluid .span1 {\r\n	width: 6.382978723404255%;\r\n	*width: 6.329787234042553%\r\n}\r\n.row-fluid .offset12 {\r\n	margin-left: 104.25531914893617%;\r\n	*margin-left: 104.14893617021275%\r\n}\r\n.row-fluid .offset12:first-child {\r\n	margin-left: 102.12765957446808%;\r\n	*margin-left: 102.02127659574467%\r\n}\r\n.row-fluid .offset11 {\r\n	margin-left: 95.74468085106382%;\r\n	*margin-left: 95.6382978723404%\r\n}\r\n.row-fluid .offset11:first-child {\r\n	margin-left: 93.61702127659574%;\r\n	*margin-left: 93.51063829787232%\r\n}\r\n.row-fluid .offset10 {\r\n	margin-left: 87.23404255319149%;\r\n	*margin-left: 87.12765957446807%\r\n}\r\n.row-fluid .offset10:first-child {\r\n	margin-left: 85.1063829787234%;\r\n	*margin-left: 84.99999999999999%\r\n}\r\n.row-fluid .offset9 {\r\n	margin-left: 78.72340425531914%;\r\n	*margin-left: 78.61702127659572%\r\n}\r\n.row-fluid .offset9:first-child {\r\n	margin-left: 76.59574468085106%;\r\n	*margin-left: 76.48936170212764%\r\n}\r\n.row-fluid .offset8 {\r\n	margin-left: 70.2127659574468%;\r\n	*margin-left: 70.10638297872339%\r\n}\r\n.row-fluid .offset8:first-child {\r\n	margin-left: 68.08510638297872%;\r\n	*margin-left: 67.9787234042553%\r\n}\r\n.row-fluid .offset7 {\r\n	margin-left: 61.70212765957446%;\r\n	*margin-left: 61.59574468085106%\r\n}\r\n.row-fluid .offset7:first-child {\r\n	margin-left: 59.574468085106375%;\r\n	*margin-left: 59.46808510638297%\r\n}\r\n.row-fluid .offset6 {\r\n	margin-left: 53.191489361702125%;\r\n	*margin-left: 53.085106382978715%\r\n}\r\n.row-fluid .offset6:first-child {\r\n	margin-left: 51.063829787234035%;\r\n	*margin-left: 50.95744680851063%\r\n}\r\n.row-fluid .offset5 {\r\n	margin-left: 44.68085106382979%;\r\n	*margin-left: 44.57446808510638%\r\n}\r\n.row-fluid .offset5:first-child {\r\n	margin-left: 42.5531914893617%;\r\n	*margin-left: 42.4468085106383%\r\n}\r\n.row-fluid .offset4 {\r\n	margin-left: 36.170212765957444%;\r\n	*margin-left: 36.06382978723405%\r\n}\r\n.row-fluid .offset4:first-child {\r\n	margin-left: 34.04255319148936%;\r\n	*margin-left: 33.93617021276596%\r\n}\r\n.row-fluid .offset3 {\r\n	margin-left: 27.659574468085104%;\r\n	*margin-left: 27.5531914893617%\r\n}\r\n.row-fluid .offset3:first-child {\r\n	margin-left: 25.53191489361702%;\r\n	*margin-left: 25.425531914893618%\r\n}\r\n.row-fluid .offset2 {\r\n	margin-left: 19.148936170212764%;\r\n	*margin-left: 19.04255319148936%\r\n}\r\n.row-fluid .offset2:first-child {\r\n	margin-left: 17.02127659574468%;\r\n	*margin-left: 16.914893617021278%\r\n}\r\n.row-fluid .offset1 {\r\n	margin-left: 10.638297872340425%;\r\n	*margin-left: 10.53191489361702%\r\n}\r\n.row-fluid .offset1:first-child {\r\n	margin-left: 8.51063829787234%;\r\n	*margin-left: 8.404255319148938%\r\n}\r\n[class*=&quot;span&quot;].hide, .row-fluid [class*=&quot;span&quot;].hide {\r\n	display: none\r\n}\r\n[class*=&quot;span&quot;].pull-right, .row-fluid [class*=&quot;span&quot;].pull-right {\r\n	float: right\r\n}\r\n.container {\r\n	margin-right: auto;\r\n	margin-left: auto;\r\n	*zoom: 1\r\n}\r\n.container:before, .container:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.container:after {\r\n	clear: both\r\n}\r\n.container-fluid {\r\n	padding-right: 20px;\r\n	padding-left: 20px;\r\n	*zoom: 1\r\n}\r\n.container-fluid:before, .container-fluid:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.container-fluid:after {\r\n	clear: both\r\n}\r\np {\r\n	margin: 0 0 10px\r\n}\r\n.lead {\r\n	margin-bottom: 20px;\r\n	font-size: 21px;\r\n	font-weight: 200;\r\n	line-height: 30px\r\n}\r\nsmall {\r\n	font-size: 85%\r\n}\r\nstrong {\r\n	font-weight: bold\r\n}\r\nem {\r\n	font-style: italic\r\n}\r\ncite {\r\n	font-style: normal\r\n}\r\n.muted {\r\n	color: #999\r\n}\r\na.muted:hover, a.muted:focus {\r\n	color: #808080\r\n}\r\n.text-warning {\r\n	color: #c09853\r\n}\r\na.text-warning:hover, a.text-warning:focus {\r\n	color: #a47e3c\r\n}\r\n.text-error {\r\n	color: #b94a48\r\n}\r\na.text-error:hover, a.text-error:focus {\r\n	color: #953b39\r\n}\r\n.text-info {\r\n	color: #3a87ad\r\n}\r\na.text-info:hover, a.text-info:focus {\r\n	color: #2d6987\r\n}\r\n.text-success {\r\n	color: #468847\r\n}\r\na.text-success:hover, a.text-success:focus {\r\n	color: #356635\r\n}\r\n.text-left {\r\n	text-align: left\r\n}\r\n.text-right {\r\n	text-align: right\r\n}\r\n.text-center {\r\n	text-align: center\r\n}\r\nh1, h2, h3, h4, h5, h6 {\r\n	margin: 10px 0;\r\n	font-family: inherit;\r\n	font-weight: bold;\r\n	line-height: 20px;\r\n	color: inherit;\r\n	text-rendering: optimizelegibility\r\n}\r\nh1 small, h2 small, h3 small, h4 small, h5 small, h6 small {\r\n	font-weight: normal;\r\n	line-height: 1;\r\n	color: #999\r\n}\r\nh1, h2, h3 {\r\n	line-height: 40px\r\n}\r\nh1 {\r\n	font-size: 38.5px\r\n}\r\nh2 {\r\n	font-size: 31.5px\r\n}\r\nh3 {\r\n	font-size: 24.5px\r\n}\r\nh4 {\r\n	font-size: 17.5px\r\n}\r\nh5 {\r\n	font-size: 14px\r\n}\r\nh6 {\r\n	font-size: 11.9px\r\n}\r\nh1 small {\r\n	font-size: 24.5px\r\n}\r\nh2 small {\r\n	font-size: 17.5px\r\n}\r\nh3 small {\r\n	font-size: 14px\r\n}\r\nh4 small {\r\n	font-size: 14px\r\n}\r\n.page-header {\r\n	padding-bottom: 9px;\r\n	margin: 20px 0 30px;\r\n	border-bottom: 1px solid #eee\r\n}\r\nul, ol {\r\n	padding: 0;\r\n	margin: 0 0 10px 25px\r\n}\r\nul ul, ul ol, ol ol, ol ul {\r\n	margin-bottom: 0\r\n}\r\nli {\r\n	line-height: 20px\r\n}\r\nul.unstyled, ol.unstyled {\r\n	margin-left: 0;\r\n	list-style: none\r\n}\r\nul.inline, ol.inline {\r\n	margin-left: 0;\r\n	list-style: none\r\n}\r\nul.inline&gt;li, ol.inline&gt;li {\r\n	display: inline-block;\r\n	*display: inline;\r\n	padding-right: 5px;\r\n	padding-left: 5px;\r\n	*zoom: 1\r\n}\r\ndl {\r\n	margin-bottom: 20px\r\n}\r\ndt, dd {\r\n	line-height: 20px\r\n}\r\ndt {\r\n	font-weight: bold\r\n}\r\ndd {\r\n	margin-left: 10px\r\n}\r\n.dl-horizontal {\r\n	*zoom: 1\r\n}\r\n.dl-horizontal:before, .dl-horizontal:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.dl-horizontal:after {\r\n	clear: both\r\n}\r\n.dl-horizontal dt {\r\n	float: left;\r\n	width: 160px;\r\n	overflow: hidden;\r\n	clear: left;\r\n	text-align: right;\r\n	text-overflow: ellipsis;\r\n	white-space: nowrap\r\n}\r\n.dl-horizontal dd {\r\n	margin-left: 180px\r\n}\r\nhr {\r\n	margin: 20px 0;\r\n	border: 0;\r\n	border-top: 1px solid #eee;\r\n	border-bottom: 1px solid #fff\r\n}\r\nabbr[title], abbr[data-original-title] {\r\n	cursor: help;\r\n	border-bottom: 1px dotted #999\r\n}\r\nabbr.initialism {\r\n	font-size: 90%;\r\n	text-transform: uppercase\r\n}\r\nblockquote {\r\n	padding: 0 0 0 15px;\r\n	margin: 0 0 20px;\r\n	border-left: 5px solid #eee\r\n}\r\nblockquote p {\r\n	margin-bottom: 0;\r\n	font-size: 17.5px;\r\n	font-weight: 300;\r\n	line-height: 1.25\r\n}\r\nblockquote small {\r\n	display: block;\r\n	line-height: 20px;\r\n	color: #999\r\n}\r\nblockquote small:before {\r\n	content: &#039;\\2014 \\00A0&#039;\r\n}\r\nblockquote.pull-right {\r\n	float: right;\r\n	padding-right: 15px;\r\n	padding-left: 0;\r\n	border-right: 5px solid #eee;\r\n	border-left: 0\r\n}\r\nblockquote.pull-right p, blockquote.pull-right small {\r\n	text-align: right\r\n}\r\nblockquote.pull-right small:before {\r\n	content: &#039;&#039;\r\n}\r\nblockquote.pull-right small:after {\r\n	content: &#039;\\00A0 \\2014&#039;\r\n}\r\nq:before, q:after, blockquote:before, blockquote:after {\r\n	content: &quot;&quot;\r\n}\r\naddress {\r\n	display: block;\r\n	margin-bottom: 20px;\r\n	font-style: normal;\r\n	line-height: 20px\r\n}\r\ncode, pre {\r\n	padding: 0 3px 2px;\r\n	font-family: Monaco, Menlo, Consolas, &quot;Courier New&quot;, monospace;\r\n	font-size: 12px;\r\n	color: #333;\r\n	-webkit-border-radius: 3px;\r\n	-moz-border-radius: 3px;\r\n	border-radius: 3px\r\n}\r\ncode {\r\n	padding: 2px 4px;\r\n	color: #d14;\r\n	white-space: nowrap;\r\n	background-color: #f7f7f9;\r\n	border: 1px solid #e1e1e8\r\n}\r\npre {\r\n	display: block;\r\n	padding: 9.5px;\r\n	margin: 0 0 10px;\r\n	font-size: 13px;\r\n	line-height: 20px;\r\n	word-break: break-all;\r\n	word-wrap: break-word;\r\n	white-space: pre;\r\n	white-space: pre-wrap;\r\n	background-color: #f5f5f5;\r\n	border: 1px solid #ccc;\r\n	border: 1px solid rgba(0, 0, 0, 0.15);\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\npre.prettyprint {\r\n	margin-bottom: 20px\r\n}\r\npre code {\r\n	padding: 0;\r\n	color: inherit;\r\n	white-space: pre;\r\n	white-space: pre-wrap;\r\n	background-color: transparent;\r\n	border: 0\r\n}\r\n.pre-scrollable {\r\n	max-height: 340px;\r\n	overflow-y: scroll\r\n}\r\nform {\r\n	margin: 0 0 20px\r\n}\r\nfieldset {\r\n	padding: 0;\r\n	margin: 0;\r\n	border: 0\r\n}\r\nlegend {\r\n	display: block;\r\n	width: 100%;\r\n	padding: 0;\r\n	margin-bottom: 20px;\r\n	font-size: 21px;\r\n	line-height: 40px;\r\n	color: #333;\r\n	border: 0;\r\n	border-bottom: 1px solid #e5e5e5\r\n}\r\nlegend small {\r\n	font-size: 15px;\r\n	color: #999\r\n}\r\nlabel, input, button, select, textarea {\r\n	font-size: 14px;\r\n	font-weight: normal;\r\n	line-height: 20px\r\n}\r\ninput, button, select, textarea {\r\n	font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif\r\n}\r\nlabel {\r\n	display: block;\r\n	margin-bottom: 5px\r\n}\r\nselect, textarea, input[type=&quot;text&quot;], input[type=&quot;password&quot;], input[type=&quot;datetime&quot;], input[type=&quot;datetime-local&quot;], input[type=&quot;date&quot;], input[type=&quot;month&quot;], input[type=&quot;time&quot;], input[type=&quot;week&quot;], input[type=&quot;number&quot;], input[type=&quot;email&quot;], input[type=&quot;url&quot;], input[type=&quot;search&quot;], input[type=&quot;tel&quot;], input[type=&quot;color&quot;], .uneditable-input {\r\n	display: inline-block;\r\n	height: 20px;\r\n	padding: 4px 6px;\r\n	margin-bottom: 10px;\r\n	font-size: 14px;\r\n	line-height: 20px;\r\n	color: #555;\r\n	vertical-align: middle;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\ninput, textarea, .uneditable-input {\r\n	width: 206px\r\n}\r\ntextarea {\r\n	height: auto\r\n}\r\ntextarea, input[type=&quot;text&quot;], input[type=&quot;password&quot;], input[type=&quot;datetime&quot;], input[type=&quot;datetime-local&quot;], input[type=&quot;date&quot;], input[type=&quot;month&quot;], input[type=&quot;time&quot;], input[type=&quot;week&quot;], input[type=&quot;number&quot;], input[type=&quot;email&quot;], input[type=&quot;url&quot;], input[type=&quot;search&quot;], input[type=&quot;tel&quot;], input[type=&quot;color&quot;], .uneditable-input {\r\n	background-color: #fff;\r\n	border: 1px solid #ccc;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	-webkit-transition: border linear .2s, box-shadow linear .2s;\r\n	-moz-transition: border linear .2s, box-shadow linear .2s;\r\n	-o-transition: border linear .2s, box-shadow linear .2s;\r\n	transition: border linear .2s, box-shadow linear .2s\r\n}\r\ntextarea:focus, input[type=&quot;text&quot;]:focus, input[type=&quot;password&quot;]:focus, input[type=&quot;datetime&quot;]:focus, input[type=&quot;datetime-local&quot;]:focus, input[type=&quot;date&quot;]:focus, input[type=&quot;month&quot;]:focus, input[type=&quot;time&quot;]:focus, input[type=&quot;week&quot;]:focus, input[type=&quot;number&quot;]:focus, input[type=&quot;email&quot;]:focus, input[type=&quot;url&quot;]:focus, input[type=&quot;search&quot;]:focus, input[type=&quot;tel&quot;]:focus, input[type=&quot;color&quot;]:focus, .uneditable-input:focus {\r\n	border-color: rgba(82, 168, 236, 0.8);\r\n	outline: 0;\r\n	outline: thin dotted \\9;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6)\r\n}\r\ninput[type=&quot;radio&quot;], input[type=&quot;checkbox&quot;] {\r\n	margin: 4px 0 0;\r\n	margin-top: 1px \\9;\r\n	*margin-top: 0;\r\n	line-height: normal\r\n}\r\ninput[type=&quot;file&quot;], input[type=&quot;image&quot;], input[type=&quot;submit&quot;], input[type=&quot;reset&quot;], input[type=&quot;button&quot;], input[type=&quot;radio&quot;], input[type=&quot;checkbox&quot;] {\r\n	width: auto\r\n}\r\nselect, input[type=&quot;file&quot;] {\r\n	height: 30px;\r\n	*margin-top: 4px;\r\n	line-height: 30px\r\n}\r\nselect {\r\n	width: 220px;\r\n	background-color: #fff;\r\n	border: 1px solid #ccc\r\n}\r\nselect[multiple], select[size] {\r\n	height: auto\r\n}\r\nselect:focus, input[type=&quot;file&quot;]:focus, input[type=&quot;radio&quot;]:focus, input[type=&quot;checkbox&quot;]:focus {\r\n	outline: thin dotted #333;\r\n	outline: 5px auto -webkit-focus-ring-color;\r\n	outline-offset: -2px\r\n}\r\n.uneditable-input, .uneditable-textarea {\r\n	color: #999;\r\n	cursor: not-allowed;\r\n	background-color: #fcfcfc;\r\n	border-color: #ccc;\r\n	-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.025);\r\n	-moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.025);\r\n	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.025)\r\n}\r\n.uneditable-input {\r\n	overflow: hidden;\r\n	white-space: nowrap\r\n}\r\n.uneditable-textarea {\r\n	width: auto;\r\n	height: auto\r\n}\r\ninput:-moz-placeholder, textarea:-moz-placeholder {\r\n	color: #999\r\n}\r\ninput:-ms-input-placeholder, textarea:-ms-input-placeholder {\r\n	color: #999\r\n}\r\ninput::-webkit-input-placeholder, textarea::-webkit-input-placeholder {\r\n	color: #999\r\n}\r\n.radio, .checkbox {\r\n	min-height: 20px;\r\n	padding-left: 20px\r\n}\r\n.radio input[type=&quot;radio&quot;], .checkbox input[type=&quot;checkbox&quot;] {\r\n	float: left;\r\n	margin-left: -20px\r\n}\r\n.controls&gt;.radio:first-child, .controls&gt;.checkbox:first-child {\r\n	padding-top: 5px\r\n}\r\n.radio.inline, .checkbox.inline {\r\n	display: inline-block;\r\n	padding-top: 5px;\r\n	margin-bottom: 0;\r\n	vertical-align: middle\r\n}\r\n.radio.inline+.radio.inline, .checkbox.inline+.checkbox.inline {\r\n	margin-left: 10px\r\n}\r\n.input-mini {\r\n	width: 60px\r\n}\r\n.input-small {\r\n	width: 90px\r\n}\r\n.input-medium {\r\n	width: 150px\r\n}\r\n.input-large {\r\n	width: 210px\r\n}\r\n.input-xlarge {\r\n	width: 270px\r\n}\r\n.input-xxlarge {\r\n	width: 530px\r\n}\r\ninput[class*=&quot;span&quot;], select[class*=&quot;span&quot;], textarea[class*=&quot;span&quot;], .uneditable-input[class*=&quot;span&quot;], .row-fluid input[class*=&quot;span&quot;], .row-fluid select[class*=&quot;span&quot;], .row-fluid textarea[class*=&quot;span&quot;], .row-fluid .uneditable-input[class*=&quot;span&quot;] {\r\n	float: none;\r\n	margin-left: 0\r\n}\r\n.input-append input[class*=&quot;span&quot;], .input-append .uneditable-input[class*=&quot;span&quot;], .input-prepend input[class*=&quot;span&quot;], .input-prepend .uneditable-input[class*=&quot;span&quot;], .row-fluid input[class*=&quot;span&quot;], .row-fluid select[class*=&quot;span&quot;], .row-fluid textarea[class*=&quot;span&quot;], .row-fluid .uneditable-input[class*=&quot;span&quot;], .row-fluid .input-prepend [class*=&quot;span&quot;], .row-fluid .input-append [class*=&quot;span&quot;] {\r\n	display: inline-block\r\n}\r\ninput, textarea, .uneditable-input {\r\n	margin-left: 0\r\n}\r\n.controls-row [class*=&quot;span&quot;]+[class*=&quot;span&quot;] {\r\n	margin-left: 20px\r\n}\r\ninput.span12, textarea.span12, .uneditable-input.span12 {\r\n	width: 926px\r\n}\r\ninput.span11, textarea.span11, .uneditable-input.span11 {\r\n	width: 846px\r\n}\r\ninput.span10, textarea.span10, .uneditable-input.span10 {\r\n	width: 766px\r\n}\r\ninput.span9, textarea.span9, .uneditable-input.span9 {\r\n	width: 686px\r\n}\r\ninput.span8, textarea.span8, .uneditable-input.span8 {\r\n	width: 606px\r\n}\r\ninput.span7, textarea.span7, .uneditable-input.span7 {\r\n	width: 526px\r\n}\r\ninput.span6, textarea.span6, .uneditable-input.span6 {\r\n	width: 446px\r\n}\r\ninput.span5, textarea.span5, .uneditable-input.span5 {\r\n	width: 366px\r\n}\r\ninput.span4, textarea.span4, .uneditable-input.span4 {\r\n	width: 286px\r\n}\r\ninput.span3, textarea.span3, .uneditable-input.span3 {\r\n	width: 206px\r\n}\r\ninput.span2, textarea.span2, .uneditable-input.span2 {\r\n	width: 126px\r\n}\r\ninput.span1, textarea.span1, .uneditable-input.span1 {\r\n	width: 46px\r\n}\r\n.controls-row {\r\n	*zoom: 1\r\n}\r\n.controls-row:before, .controls-row:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.controls-row:after {\r\n	clear: both\r\n}\r\n.controls-row [class*=&quot;span&quot;], .row-fluid .controls-row [class*=&quot;span&quot;] {\r\n	float: left\r\n}\r\n.controls-row .checkbox[class*=&quot;span&quot;], .controls-row .radio[class*=&quot;span&quot;] {\r\n	padding-top: 5px\r\n}\r\ninput[disabled], select[disabled], textarea[disabled], input[readonly], select[readonly], textarea[readonly] {\r\n	cursor: not-allowed;\r\n	background-color: #eee\r\n}\r\ninput[type=&quot;radio&quot;][disabled], input[type=&quot;checkbox&quot;][disabled], input[type=&quot;radio&quot;][readonly], input[type=&quot;checkbox&quot;][readonly] {\r\n	background-color: transparent\r\n}\r\n.control-group.warning .control-label, .control-group.warning .help-block, .control-group.warning .help-inline {\r\n	color: #c09853\r\n}\r\n.control-group.warning .checkbox, .control-group.warning .radio, .control-group.warning input, .control-group.warning select, .control-group.warning textarea {\r\n	color: #c09853\r\n}\r\n.control-group.warning input, .control-group.warning select, .control-group.warning textarea {\r\n	border-color: #c09853;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075)\r\n}\r\n.control-group.warning input:focus, .control-group.warning select:focus, .control-group.warning textarea:focus {\r\n	border-color: #a47e3c;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #dbc59e;\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #dbc59e;\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #dbc59e\r\n}\r\n.control-group.warning .input-prepend .add-on, .control-group.warning .input-append .add-on {\r\n	color: #c09853;\r\n	background-color: #fcf8e3;\r\n	border-color: #c09853\r\n}\r\n.control-group.error .control-label, .control-group.error .help-block, .control-group.error .help-inline {\r\n	color: #b94a48\r\n}\r\n.control-group.error .checkbox, .control-group.error .radio, .control-group.error input, .control-group.error select, .control-group.error textarea {\r\n	color: #b94a48\r\n}\r\n.control-group.error input, .control-group.error select, .control-group.error textarea {\r\n	border-color: #b94a48;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075)\r\n}\r\n.control-group.error input:focus, .control-group.error select:focus, .control-group.error textarea:focus {\r\n	border-color: #953b39;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #d59392;\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #d59392;\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #d59392\r\n}\r\n.control-group.error .input-prepend .add-on, .control-group.error .input-append .add-on {\r\n	color: #b94a48;\r\n	background-color: #f2dede;\r\n	border-color: #b94a48\r\n}\r\n.control-group.success .control-label, .control-group.success .help-block, .control-group.success .help-inline {\r\n	color: #468847\r\n}\r\n.control-group.success .checkbox, .control-group.success .radio, .control-group.success input, .control-group.success select, .control-group.success textarea {\r\n	color: #468847\r\n}\r\n.control-group.success input, .control-group.success select, .control-group.success textarea {\r\n	border-color: #468847;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075)\r\n}\r\n.control-group.success input:focus, .control-group.success select:focus, .control-group.success textarea:focus {\r\n	border-color: #356635;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7aba7b;\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7aba7b;\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7aba7b\r\n}\r\n.control-group.success .input-prepend .add-on, .control-group.success .input-append .add-on {\r\n	color: #468847;\r\n	background-color: #dff0d8;\r\n	border-color: #468847\r\n}\r\n.control-group.info .control-label, .control-group.info .help-block, .control-group.info .help-inline {\r\n	color: #3a87ad\r\n}\r\n.control-group.info .checkbox, .control-group.info .radio, .control-group.info input, .control-group.info select, .control-group.info textarea {\r\n	color: #3a87ad\r\n}\r\n.control-group.info input, .control-group.info select, .control-group.info textarea {\r\n	border-color: #3a87ad;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075)\r\n}\r\n.control-group.info input:focus, .control-group.info select:focus, .control-group.info textarea:focus {\r\n	border-color: #2d6987;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7ab5d3;\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7ab5d3;\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #7ab5d3\r\n}\r\n.control-group.info .input-prepend .add-on, .control-group.info .input-append .add-on {\r\n	color: #3a87ad;\r\n	background-color: #d9edf7;\r\n	border-color: #3a87ad\r\n}\r\ninput:focus:invalid, textarea:focus:invalid, select:focus:invalid {\r\n	color: #b94a48;\r\n	border-color: #ee5f5b\r\n}\r\ninput:focus:invalid:focus, textarea:focus:invalid:focus, select:focus:invalid:focus {\r\n	border-color: #e9322d;\r\n	-webkit-box-shadow: 0 0 6px #f8b9b7;\r\n	-moz-box-shadow: 0 0 6px #f8b9b7;\r\n	box-shadow: 0 0 6px #f8b9b7\r\n}\r\n.form-actions {\r\n	padding: 19px 20px 20px;\r\n	margin-top: 20px;\r\n	margin-bottom: 20px;\r\n	background-color: #f5f5f5;\r\n	border-top: 1px solid #e5e5e5;\r\n	*zoom: 1\r\n}\r\n.form-actions:before, .form-actions:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.form-actions:after {\r\n	clear: both\r\n}\r\n.help-block, .help-inline {\r\n	color: #595959\r\n}\r\n.help-block {\r\n	display: block;\r\n	margin-bottom: 10px\r\n}\r\n.help-inline {\r\n	display: inline-block;\r\n	*display: inline;\r\n	padding-left: 5px;\r\n	vertical-align: middle;\r\n	*zoom: 1\r\n}\r\n.input-append, .input-prepend {\r\n	display: inline-block;\r\n	margin-bottom: 10px;\r\n	font-size: 0;\r\n	white-space: nowrap;\r\n	vertical-align: middle\r\n}\r\n.input-append input, .input-prepend input, .input-append select, .input-prepend select, .input-append .uneditable-input, .input-prepend .uneditable-input, .input-append .dropdown-menu, .input-prepend .dropdown-menu, .input-append .popover, .input-prepend .popover {\r\n	font-size: 14px\r\n}\r\n.input-append input, .input-prepend input, .input-append select, .input-prepend select, .input-append .uneditable-input, .input-prepend .uneditable-input {\r\n	position: relative;\r\n	margin-bottom: 0;\r\n	*margin-left: 0;\r\n	vertical-align: top;\r\n	-webkit-border-radius: 0 4px 4px 0;\r\n	-moz-border-radius: 0 4px 4px 0;\r\n	border-radius: 0 4px 4px 0\r\n}\r\n.input-append input:focus, .input-prepend input:focus, .input-append select:focus, .input-prepend select:focus, .input-append .uneditable-input:focus, .input-prepend .uneditable-input:focus {\r\n	z-index: 2\r\n}\r\n.input-append .add-on, .input-prepend .add-on {\r\n	display: inline-block;\r\n	width: auto;\r\n	height: 20px;\r\n	min-width: 16px;\r\n	padding: 4px 5px;\r\n	font-size: 14px;\r\n	font-weight: normal;\r\n	line-height: 20px;\r\n	text-align: center;\r\n	text-shadow: 0 1px 0 #fff;\r\n	background-color: #eee;\r\n	border: 1px solid #ccc\r\n}\r\n.input-append .add-on, .input-prepend .add-on, .input-append .btn, .input-prepend .btn, .input-append .btn-group&gt;.dropdown-toggle, .input-prepend .btn-group&gt;.dropdown-toggle {\r\n	vertical-align: top;\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.input-append .active, .input-prepend .active {\r\n	background-color: #a9dba9;\r\n	border-color: #46a546\r\n}\r\n.input-prepend .add-on, .input-prepend .btn {\r\n	margin-right: -1px\r\n}\r\n.input-prepend .add-on:first-child, .input-prepend .btn:first-child {\r\n	-webkit-border-radius: 4px 0 0 4px;\r\n	-moz-border-radius: 4px 0 0 4px;\r\n	border-radius: 4px 0 0 4px\r\n}\r\n.input-append input, .input-append select, .input-append .uneditable-input {\r\n	-webkit-border-radius: 4px 0 0 4px;\r\n	-moz-border-radius: 4px 0 0 4px;\r\n	border-radius: 4px 0 0 4px\r\n}\r\n.input-append input+.btn-group .btn:last-child, .input-append select+.btn-group .btn:last-child, .input-append .uneditable-input+.btn-group .btn:last-child {\r\n	-webkit-border-radius: 0 4px 4px 0;\r\n	-moz-border-radius: 0 4px 4px 0;\r\n	border-radius: 0 4px 4px 0\r\n}\r\n.input-append .add-on, .input-append .btn, .input-append .btn-group {\r\n	margin-left: -1px\r\n}\r\n.input-append .add-on:last-child, .input-append .btn:last-child, .input-append .btn-group:last-child&gt;.dropdown-toggle {\r\n	-webkit-border-radius: 0 4px 4px 0;\r\n	-moz-border-radius: 0 4px 4px 0;\r\n	border-radius: 0 4px 4px 0\r\n}\r\n.input-prepend.input-append input, .input-prepend.input-append select, .input-prepend.input-append .uneditable-input {\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.input-prepend.input-append input+.btn-group .btn, .input-prepend.input-append select+.btn-group .btn, .input-prepend.input-append .uneditable-input+.btn-group .btn {\r\n	-webkit-border-radius: 0 4px 4px 0;\r\n	-moz-border-radius: 0 4px 4px 0;\r\n	border-radius: 0 4px 4px 0\r\n}\r\n.input-prepend.input-append .add-on:first-child, .input-prepend.input-append .btn:first-child {\r\n	margin-right: -1px;\r\n	-webkit-border-radius: 4px 0 0 4px;\r\n	-moz-border-radius: 4px 0 0 4px;\r\n	border-radius: 4px 0 0 4px\r\n}\r\n.input-prepend.input-append .add-on:last-child, .input-prepend.input-append .btn:last-child {\r\n	margin-left: -1px;\r\n	-webkit-border-radius: 0 4px 4px 0;\r\n	-moz-border-radius: 0 4px 4px 0;\r\n	border-radius: 0 4px 4px 0\r\n}\r\n.input-prepend.input-append .btn-group:first-child {\r\n	margin-left: 0\r\n}\r\ninput.search-query {\r\n	padding-right: 14px;\r\n	padding-right: 4px \\9;\r\n	padding-left: 14px;\r\n	padding-left: 4px \\9;\r\n	margin-bottom: 0;\r\n	-webkit-border-radius: 15px;\r\n	-moz-border-radius: 15px;\r\n	border-radius: 15px\r\n}\r\n.form-search .input-append .search-query, .form-search .input-prepend .search-query {\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.form-search .input-append .search-query {\r\n	-webkit-border-radius: 14px 0 0 14px;\r\n	-moz-border-radius: 14px 0 0 14px;\r\n	border-radius: 14px 0 0 14px\r\n}\r\n.form-search .input-append .btn {\r\n	-webkit-border-radius: 0 14px 14px 0;\r\n	-moz-border-radius: 0 14px 14px 0;\r\n	border-radius: 0 14px 14px 0\r\n}\r\n.form-search .input-prepend .search-query {\r\n	-webkit-border-radius: 0 14px 14px 0;\r\n	-moz-border-radius: 0 14px 14px 0;\r\n	border-radius: 0 14px 14px 0\r\n}\r\n.form-search .input-prepend .btn {\r\n	-webkit-border-radius: 14px 0 0 14px;\r\n	-moz-border-radius: 14px 0 0 14px;\r\n	border-radius: 14px 0 0 14px\r\n}\r\n.form-search input, .form-inline input, .form-horizontal input, .form-search textarea, .form-inline textarea, .form-horizontal textarea, .form-search select, .form-inline select, .form-horizontal select, .form-search .help-inline, .form-inline .help-inline, .form-horizontal .help-inline, .form-search .uneditable-input, .form-inline .uneditable-input, .form-horizontal .uneditable-input, .form-search .input-prepend, .form-inline .input-prepend, .form-horizontal .input-prepend, .form-search .input-append, .form-inline .input-append, .form-horizontal .input-append {\r\n	display: inline-block;\r\n	*display: inline;\r\n	margin-bottom: 0;\r\n	vertical-align: middle;\r\n	*zoom: 1\r\n}\r\n.form-search .hide, .form-inline .hide, .form-horizontal .hide {\r\n	display: none\r\n}\r\n.form-search label, .form-inline label, .form-search .btn-group, .form-inline .btn-group {\r\n	display: inline-block\r\n}\r\n.form-search .input-append, .form-inline .input-append, .form-search .input-prepend, .form-inline .input-prepend {\r\n	margin-bottom: 0\r\n}\r\n.form-search .radio, .form-search .checkbox, .form-inline .radio, .form-inline .checkbox {\r\n	padding-left: 0;\r\n	margin-bottom: 0;\r\n	vertical-align: middle\r\n}\r\n.form-search .radio input[type=&quot;radio&quot;], .form-search .checkbox input[type=&quot;checkbox&quot;], .form-inline .radio input[type=&quot;radio&quot;], .form-inline .checkbox input[type=&quot;checkbox&quot;] {\r\n	float: left;\r\n	margin-right: 3px;\r\n	margin-left: 0\r\n}\r\n.control-group {\r\n	margin-bottom: 10px\r\n}\r\nlegend+.control-group {\r\n	margin-top: 20px;\r\n	-webkit-margin-top-collapse: separate\r\n}\r\n.form-horizontal .control-group {\r\n	margin-bottom: 20px;\r\n	*zoom: 1\r\n}\r\n.form-horizontal .control-group:before, .form-horizontal .control-group:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.form-horizontal .control-group:after {\r\n	clear: both\r\n}\r\n.form-horizontal .control-label {\r\n	float: left;\r\n	width: 160px;\r\n	padding-top: 5px;\r\n	text-align: right\r\n}\r\n.form-horizontal .controls {\r\n	*display: inline-block;\r\n	*padding-left: 20px;\r\n	margin-left: 180px;\r\n	*margin-left: 0\r\n}\r\n.form-horizontal .controls:first-child {\r\n	*padding-left: 180px\r\n}\r\n.form-horizontal .help-block {\r\n	margin-bottom: 0\r\n}\r\n.form-horizontal input+.help-block, .form-horizontal select+.help-block, .form-horizontal textarea+.help-block, .form-horizontal .uneditable-input+.help-block, .form-horizontal .input-prepend+.help-block, .form-horizontal .input-append+.help-block {\r\n	margin-top: 10px\r\n}\r\n.form-horizontal .form-actions {\r\n	padding-left: 180px\r\n}\r\ntable {\r\n	max-width: 100%;\r\n	background-color: transparent;\r\n	border-collapse: collapse;\r\n	border-spacing: 0\r\n}\r\n.table {\r\n	width: 100%;\r\n	margin-bottom: 20px\r\n}\r\n.table th, .table td {\r\n	padding: 8px;\r\n	line-height: 20px;\r\n	text-align: left;\r\n	vertical-align: top;\r\n	border-top: 1px solid #ddd\r\n}\r\n.table th {\r\n	font-weight: bold\r\n}\r\n.table thead th {\r\n	vertical-align: bottom\r\n}\r\n.table caption+thead tr:first-child th, .table caption+thead tr:first-child td, .table colgroup+thead tr:first-child th, .table colgroup+thead tr:first-child td, .table thead:first-child tr:first-child th, .table thead:first-child tr:first-child td {\r\n	border-top: 0\r\n}\r\n.table tbody+tbody {\r\n	border-top: 2px solid #ddd\r\n}\r\n.table .table {\r\n	background-color: #fff\r\n}\r\n.table-condensed th, .table-condensed td {\r\n	padding: 4px 5px\r\n}\r\n.table-bordered {\r\n	border: 1px solid #ddd;\r\n	border-collapse: separate;\r\n	*border-collapse: collapse;\r\n	border-left: 0;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\n.table-bordered th, .table-bordered td {\r\n	border-left: 1px solid #ddd\r\n}\r\n.table-bordered caption+thead tr:first-child th, .table-bordered caption+tbody tr:first-child th, .table-bordered caption+tbody tr:first-child td, .table-bordered colgroup+thead tr:first-child th, .table-bordered colgroup+tbody tr:first-child th, .table-bordered colgroup+tbody tr:first-child td, .table-bordered thead:first-child tr:first-child th, .table-bordered tbody:first-child tr:first-child th, .table-bordered tbody:first-child tr:first-child td {\r\n	border-top: 0\r\n}\r\n.table-bordered thead:first-child tr:first-child&gt;th:first-child, .table-bordered tbody:first-child tr:first-child&gt;td:first-child, .table-bordered tbody:first-child tr:first-child&gt;th:first-child {\r\n	-webkit-border-top-left-radius: 4px;\r\n	border-top-left-radius: 4px;\r\n	-moz-border-radius-topleft: 4px\r\n}\r\n.table-bordered thead:first-child tr:first-child&gt;th:last-child, .table-bordered tbody:first-child tr:first-child&gt;td:last-child, .table-bordered tbody:first-child tr:first-child&gt;th:last-child {\r\n	-webkit-border-top-right-radius: 4px;\r\n	border-top-right-radius: 4px;\r\n	-moz-border-radius-topright: 4px\r\n}\r\n.table-bordered thead:last-child tr:last-child&gt;th:first-child, .table-bordered tbody:last-child tr:last-child&gt;td:first-child, .table-bordered tbody:last-child tr:last-child&gt;th:first-child, .table-bordered tfoot:last-child tr:last-child&gt;td:first-child, .table-bordered tfoot:last-child tr:last-child&gt;th:first-child {\r\n	-webkit-border-bottom-left-radius: 4px;\r\n	border-bottom-left-radius: 4px;\r\n	-moz-border-radius-bottomleft: 4px\r\n}\r\n.table-bordered thead:last-child tr:last-child&gt;th:last-child, .table-bordered tbody:last-child tr:last-child&gt;td:last-child, .table-bordered tbody:last-child tr:last-child&gt;th:last-child, .table-bordered tfoot:last-child tr:last-child&gt;td:last-child, .table-bordered tfoot:last-child tr:last-child&gt;th:last-child {\r\n	-webkit-border-bottom-right-radius: 4px;\r\n	border-bottom-right-radius: 4px;\r\n	-moz-border-radius-bottomright: 4px\r\n}\r\n.table-bordered tfoot+tbody:last-child tr:last-child td:first-child {\r\n	-webkit-border-bottom-left-radius: 0;\r\n	border-bottom-left-radius: 0;\r\n	-moz-border-radius-bottomleft: 0\r\n}\r\n.table-bordered tfoot+tbody:last-child tr:last-child td:last-child {\r\n	-webkit-border-bottom-right-radius: 0;\r\n	border-bottom-right-radius: 0;\r\n	-moz-border-radius-bottomright: 0\r\n}\r\n.table-bordered caption+thead tr:first-child th:first-child, .table-bordered caption+tbody tr:first-child td:first-child, .table-bordered colgroup+thead tr:first-child th:first-child, .table-bordered colgroup+tbody tr:first-child td:first-child {\r\n	-webkit-border-top-left-radius: 4px;\r\n	border-top-left-radius: 4px;\r\n	-moz-border-radius-topleft: 4px\r\n}\r\n.table-bordered caption+thead tr:first-child th:last-child, .table-bordered caption+tbody tr:first-child td:last-child, .table-bordered colgroup+thead tr:first-child th:last-child, .table-bordered colgroup+tbody tr:first-child td:last-child {\r\n	-webkit-border-top-right-radius: 4px;\r\n	border-top-right-radius: 4px;\r\n	-moz-border-radius-topright: 4px\r\n}\r\n.table-striped tbody&gt;tr:nth-child(odd)&gt;td, .table-striped tbody&gt;tr:nth-child(odd)&gt;th {\r\n	background-color: #f9f9f9\r\n}\r\n.table-hover tbody tr:hover&gt;td, .table-hover tbody tr:hover&gt;th {\r\n	background-color: #f5f5f5\r\n}\r\ntable td[class*=&quot;span&quot;], table th[class*=&quot;span&quot;], .row-fluid table td[class*=&quot;span&quot;], .row-fluid table th[class*=&quot;span&quot;] {\r\n	display: table-cell;\r\n	float: none;\r\n	margin-left: 0\r\n}\r\n.table td.span1, .table th.span1 {\r\n	float: none;\r\n	width: 44px;\r\n	margin-left: 0\r\n}\r\n.table td.span2, .table th.span2 {\r\n	float: none;\r\n	width: 124px;\r\n	margin-left: 0\r\n}\r\n.table td.span3, .table th.span3 {\r\n	float: none;\r\n	width: 204px;\r\n	margin-left: 0\r\n}\r\n.table td.span4, .table th.span4 {\r\n	float: none;\r\n	width: 284px;\r\n	margin-left: 0\r\n}\r\n.table td.span5, .table th.span5 {\r\n	float: none;\r\n	width: 364px;\r\n	margin-left: 0\r\n}\r\n.table td.span6, .table th.span6 {\r\n	float: none;\r\n	width: 444px;\r\n	margin-left: 0\r\n}\r\n.table td.span7, .table th.span7 {\r\n	float: none;\r\n	width: 524px;\r\n	margin-left: 0\r\n}\r\n.table td.span8, .table th.span8 {\r\n	float: none;\r\n	width: 604px;\r\n	margin-left: 0\r\n}\r\n.table td.span9, .table th.span9 {\r\n	float: none;\r\n	width: 684px;\r\n	margin-left: 0\r\n}\r\n.table td.span10, .table th.span10 {\r\n	float: none;\r\n	width: 764px;\r\n	margin-left: 0\r\n}\r\n.table td.span11, .table th.span11 {\r\n	float: none;\r\n	width: 844px;\r\n	margin-left: 0\r\n}\r\n.table td.span12, .table th.span12 {\r\n	float: none;\r\n	width: 924px;\r\n	margin-left: 0\r\n}\r\n.table tbody tr.success&gt;td {\r\n	background-color: #dff0d8\r\n}\r\n.table tbody tr.error&gt;td {\r\n	background-color: #f2dede\r\n}\r\n.table tbody tr.warning&gt;td {\r\n	background-color: #fcf8e3\r\n}\r\n.table tbody tr.info&gt;td {\r\n	background-color: #d9edf7\r\n}\r\n.table-hover tbody tr.success:hover&gt;td {\r\n	background-color: #d0e9c6\r\n}\r\n.table-hover tbody tr.error:hover&gt;td {\r\n	background-color: #ebcccc\r\n}\r\n.table-hover tbody tr.warning:hover&gt;td {\r\n	background-color: #faf2cc\r\n}\r\n.table-hover tbody tr.info:hover&gt;td {\r\n	background-color: #c4e3f3\r\n}\r\n[class^=&quot;icon-&quot;], [class*=&quot; icon-&quot;] {\r\n	display: inline-block;\r\n	width: 14px;\r\n	height: 14px;\r\n	margin-top: 1px;\r\n	*margin-right: .3em;\r\n	line-height: 14px;\r\n	vertical-align: text-top;\r\n	background-image: url(&quot;../img/glyphicons-halflings.png&quot;);\r\n	background-position: 14px 14px;\r\n	background-repeat: no-repeat\r\n}\r\n.icon-white, .nav-pills&gt;.active&gt;a&gt;[class^=&quot;icon-&quot;], .nav-pills&gt;.active&gt;a&gt;[class*=&quot; icon-&quot;], .nav-list&gt;.active&gt;a&gt;[class^=&quot;icon-&quot;], .nav-list&gt;.active&gt;a&gt;[class*=&quot; icon-&quot;], .navbar-inverse .nav&gt;.active&gt;a&gt;[class^=&quot;icon-&quot;], .navbar-inverse .nav&gt;.active&gt;a&gt;[class*=&quot; icon-&quot;], .dropdown-menu&gt;li&gt;a:hover&gt;[class^=&quot;icon-&quot;], .dropdown-menu&gt;li&gt;a:focus&gt;[class^=&quot;icon-&quot;], .dropdown-menu&gt;li&gt;a:hover&gt;[class*=&quot; icon-&quot;], .dropdown-menu&gt;li&gt;a:focus&gt;[class*=&quot; icon-&quot;], .dropdown-menu&gt;.active&gt;a&gt;[class^=&quot;icon-&quot;], .dropdown-menu&gt;.active&gt;a&gt;[class*=&quot; icon-&quot;], .dropdown-submenu:hover&gt;a&gt;[class^=&quot;icon-&quot;], .dropdown-submenu:focus&gt;a&gt;[class^=&quot;icon-&quot;], .dropdown-submenu:hover&gt;a&gt;[class*=&quot; icon-&quot;], .dropdown-submenu:focus&gt;a&gt;[class*=&quot; icon-&quot;] {\r\n	background-image: url(&quot;../img/glyphicons-halflings-white.png&quot;)\r\n}\r\n.icon-glass {\r\n	background-position: 0 0\r\n}\r\n.icon-music {\r\n	background-position: -24px 0\r\n}\r\n.icon-search {\r\n	background-position: -48px 0\r\n}\r\n.icon-envelope {\r\n	background-position: -72px 0\r\n}\r\n.icon-heart {\r\n	background-position: -96px 0\r\n}\r\n.icon-star {\r\n	background-position: -120px 0\r\n}\r\n.icon-star-empty {\r\n	background-position: -144px 0\r\n}\r\n.icon-user {\r\n	background-position: -168px 0\r\n}\r\n.icon-film {\r\n	background-position: -192px 0\r\n}\r\n.icon-th-large {\r\n	background-position: -216px 0\r\n}\r\n.icon-th {\r\n	background-position: -240px 0\r\n}\r\n.icon-th-list {\r\n	background-position: -264px 0\r\n}\r\n.icon-ok {\r\n	background-position: -288px 0\r\n}\r\n.icon-remove {\r\n	background-position: -312px 0\r\n}\r\n.icon-zoom-in {\r\n	background-position: -336px 0\r\n}\r\n.icon-zoom-out {\r\n	background-position: -360px 0\r\n}\r\n.icon-off {\r\n	background-position: -384px 0\r\n}\r\n.icon-signal {\r\n	background-position: -408px 0\r\n}\r\n.icon-cog {\r\n	background-position: -432px 0\r\n}\r\n.icon-trash {\r\n	background-position: -456px 0\r\n}\r\n.icon-home {\r\n	background-position: 0 -24px\r\n}\r\n.icon-file {\r\n	background-position: -24px -24px\r\n}\r\n.icon-time {\r\n	background-position: -48px -24px\r\n}\r\n.icon-road {\r\n	background-position: -72px -24px\r\n}\r\n.icon-download-alt {\r\n	background-position: -96px -24px\r\n}\r\n.icon-download {\r\n	background-position: -120px -24px\r\n}\r\n.icon-upload {\r\n	background-position: -144px -24px\r\n}\r\n.icon-inbox {\r\n	background-position: -168px -24px\r\n}\r\n.icon-play-circle {\r\n	background-position: -192px -24px\r\n}\r\n.icon-repeat {\r\n	background-position: -216px -24px\r\n}\r\n.icon-refresh {\r\n	background-position: -240px -24px\r\n}\r\n.icon-list-alt {\r\n	background-position: -264px -24px\r\n}\r\n.icon-lock {\r\n	background-position: -287px -24px\r\n}\r\n.icon-flag {\r\n	background-position: -312px -24px\r\n}\r\n.icon-headphones {\r\n	background-position: -336px -24px\r\n}\r\n.icon-volume-off {\r\n	background-position: -360px -24px\r\n}\r\n.icon-volume-down {\r\n	background-position: -384px -24px\r\n}\r\n.icon-volume-up {\r\n	background-position: -408px -24px\r\n}\r\n.icon-qrcode {\r\n	background-position: -432px -24px\r\n}\r\n.icon-barcode {\r\n	background-position: -456px -24px\r\n}\r\n.icon-tag {\r\n	background-position: 0 -48px\r\n}\r\n.icon-tags {\r\n	background-position: -25px -48px\r\n}\r\n.icon-book {\r\n	background-position: -48px -48px\r\n}\r\n.icon-bookmark {\r\n	background-position: -72px -48px\r\n}\r\n.icon-print {\r\n	background-position: -96px -48px\r\n}\r\n.icon-camera {\r\n	background-position: -120px -48px\r\n}\r\n.icon-font {\r\n	background-position: -144px -48px\r\n}\r\n.icon-bold {\r\n	background-position: -167px -48px\r\n}\r\n.icon-italic {\r\n	background-position: -192px -48px\r\n}\r\n.icon-text-height {\r\n	background-position: -216px -48px\r\n}\r\n.icon-text-width {\r\n	background-position: -240px -48px\r\n}\r\n.icon-align-left {\r\n	background-position: -264px -48px\r\n}\r\n.icon-align-center {\r\n	background-position: -288px -48px\r\n}\r\n.icon-align-right {\r\n	background-position: -312px -48px\r\n}\r\n.icon-align-justify {\r\n	background-position: -336px -48px\r\n}\r\n.icon-list {\r\n	background-position: -360px -48px\r\n}\r\n.icon-indent-left {\r\n	background-position: -384px -48px\r\n}\r\n.icon-indent-right {\r\n	background-position: -408px -48px\r\n}\r\n.icon-facetime-video {\r\n	background-position: -432px -48px\r\n}\r\n.icon-picture {\r\n	background-position: -456px -48px\r\n}\r\n.icon-pencil {\r\n	background-position: 0 -72px\r\n}\r\n.icon-map-marker {\r\n	background-position: -24px -72px\r\n}\r\n.icon-adjust {\r\n	background-position: -48px -72px\r\n}\r\n.icon-tint {\r\n	background-position: -72px -72px\r\n}\r\n.icon-edit {\r\n	background-position: -96px -72px\r\n}\r\n.icon-share {\r\n	background-position: -120px -72px\r\n}\r\n.icon-check {\r\n	background-position: -144px -72px\r\n}\r\n.icon-move {\r\n	background-position: -168px -72px\r\n}\r\n.icon-step-backward {\r\n	background-position: -192px -72px\r\n}\r\n.icon-fast-backward {\r\n	background-position: -216px -72px\r\n}\r\n.icon-backward {\r\n	background-position: -240px -72px\r\n}\r\n.icon-play {\r\n	background-position: -264px -72px\r\n}\r\n.icon-pause {\r\n	background-position: -288px -72px\r\n}\r\n.icon-stop {\r\n	background-position: -312px -72px\r\n}\r\n.icon-forward {\r\n	background-position: -336px -72px\r\n}\r\n.icon-fast-forward {\r\n	background-position: -360px -72px\r\n}\r\n.icon-step-forward {\r\n	background-position: -384px -72px\r\n}\r\n.icon-eject {\r\n	background-position: -408px -72px\r\n}\r\n.icon-chevron-left {\r\n	background-position: -432px -72px\r\n}\r\n.icon-chevron-right {\r\n	background-position: -456px -72px\r\n}\r\n.icon-plus-sign {\r\n	background-position: 0 -96px\r\n}\r\n.icon-minus-sign {\r\n	background-position: -24px -96px\r\n}\r\n.icon-remove-sign {\r\n	background-position: -48px -96px\r\n}\r\n.icon-ok-sign {\r\n	background-position: -72px -96px\r\n}\r\n.icon-question-sign {\r\n	background-position: -96px -96px\r\n}\r\n.icon-info-sign {\r\n	background-position: -120px -96px\r\n}\r\n.icon-screenshot {\r\n	background-position: -144px -96px\r\n}\r\n.icon-remove-circle {\r\n	background-position: -168px -96px\r\n}\r\n.icon-ok-circle {\r\n	background-position: -192px -96px\r\n}\r\n.icon-ban-circle {\r\n	background-position: -216px -96px\r\n}\r\n.icon-arrow-left {\r\n	background-position: -240px -96px\r\n}\r\n.icon-arrow-right {\r\n	background-position: -264px -96px\r\n}\r\n.icon-arrow-up {\r\n	background-position: -289px -96px\r\n}\r\n.icon-arrow-down {\r\n	background-position: -312px -96px\r\n}\r\n.icon-share-alt {\r\n	background-position: -336px -96px\r\n}\r\n.icon-resize-full {\r\n	background-position: -360px -96px\r\n}\r\n.icon-resize-small {\r\n	background-position: -384px -96px\r\n}\r\n.icon-plus {\r\n	background-position: -408px -96px\r\n}\r\n.icon-minus {\r\n	background-position: -433px -96px\r\n}\r\n.icon-asterisk {\r\n	background-position: -456px -96px\r\n}\r\n.icon-exclamation-sign {\r\n	background-position: 0 -120px\r\n}\r\n.icon-gift {\r\n	background-position: -24px -120px\r\n}\r\n.icon-leaf {\r\n	background-position: -48px -120px\r\n}\r\n.icon-fire {\r\n	background-position: -72px -120px\r\n}\r\n.icon-eye-open {\r\n	background-position: -96px -120px\r\n}\r\n.icon-eye-close {\r\n	background-position: -120px -120px\r\n}\r\n.icon-warning-sign {\r\n	background-position: -144px -120px\r\n}\r\n.icon-plane {\r\n	background-position: -168px -120px\r\n}\r\n.icon-calendar {\r\n	background-position: -192px -120px\r\n}\r\n.icon-random {\r\n	width: 16px;\r\n	background-position: -216px -120px\r\n}\r\n.icon-comment {\r\n	background-position: -240px -120px\r\n}\r\n.icon-magnet {\r\n	background-position: -264px -120px\r\n}\r\n.icon-chevron-up {\r\n	background-position: -288px -120px\r\n}\r\n.icon-chevron-down {\r\n	background-position: -313px -119px\r\n}\r\n.icon-retweet {\r\n	background-position: -336px -120px\r\n}\r\n.icon-shopping-cart {\r\n	background-position: -360px -120px\r\n}\r\n.icon-folder-close {\r\n	width: 16px;\r\n	background-position: -384px -120px\r\n}\r\n.icon-folder-open {\r\n	width: 16px;\r\n	background-position: -408px -120px\r\n}\r\n.icon-resize-vertical {\r\n	background-position: -432px -119px\r\n}\r\n.icon-resize-horizontal {\r\n	background-position: -456px -118px\r\n}\r\n.icon-hdd {\r\n	background-position: 0 -144px\r\n}\r\n.icon-bullhorn {\r\n	background-position: -24px -144px\r\n}\r\n.icon-bell {\r\n	background-position: -48px -144px\r\n}\r\n.icon-certificate {\r\n	background-position: -72px -144px\r\n}\r\n.icon-thumbs-up {\r\n	background-position: -96px -144px\r\n}\r\n.icon-thumbs-down {\r\n	background-position: -120px -144px\r\n}\r\n.icon-hand-right {\r\n	background-position: -144px -144px\r\n}\r\n.icon-hand-left {\r\n	background-position: -168px -144px\r\n}\r\n.icon-hand-up {\r\n	background-position: -192px -144px\r\n}\r\n.icon-hand-down {\r\n	background-position: -216px -144px\r\n}\r\n.icon-circle-arrow-right {\r\n	background-position: -240px -144px\r\n}\r\n.icon-circle-arrow-left {\r\n	background-position: -264px -144px\r\n}\r\n.icon-circle-arrow-up {\r\n	background-position: -288px -144px\r\n}\r\n.icon-circle-arrow-down {\r\n	background-position: -312px -144px\r\n}\r\n.icon-globe {\r\n	background-position: -336px -144px\r\n}\r\n.icon-wrench {\r\n	background-position: -360px -144px\r\n}\r\n.icon-tasks {\r\n	background-position: -384px -144px\r\n}\r\n.icon-filter {\r\n	background-position: -408px -144px\r\n}\r\n.icon-briefcase {\r\n	background-position: -432px -144px\r\n}\r\n.icon-fullscreen {\r\n	background-position: -456px -144px\r\n}\r\n.dropup, .dropdown {\r\n	position: relative\r\n}\r\n.dropdown-toggle {\r\n	*margin-bottom: -3px\r\n}\r\n.dropdown-toggle:active, .open .dropdown-toggle {\r\n	outline: 0\r\n}\r\n.caret {\r\n	display: inline-block;\r\n	width: 0;\r\n	height: 0;\r\n	vertical-align: top;\r\n	border-top: 4px solid #000;\r\n	border-right: 4px solid transparent;\r\n	border-left: 4px solid transparent;\r\n	content: &quot;&quot;\r\n}\r\n.dropdown .caret {\r\n	margin-top: 8px;\r\n	margin-left: 2px\r\n}\r\n.dropdown-menu {\r\n	position: absolute;\r\n	top: 100%;\r\n	left: 0;\r\n	z-index: 1000;\r\n	display: none;\r\n	float: left;\r\n	min-width: 160px;\r\n	padding: 5px 0;\r\n	margin: 2px 0 0;\r\n	list-style: none;\r\n	background-color: #fff;\r\n	border: 1px solid #ccc;\r\n	border: 1px solid rgba(0, 0, 0, 0.2);\r\n	*border-right-width: 2px;\r\n	*border-bottom-width: 2px;\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px;\r\n	-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n	-moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n	-webkit-background-clip: padding-box;\r\n	-moz-background-clip: padding;\r\n	background-clip: padding-box\r\n}\r\n.dropdown-menu.pull-right {\r\n	right: 0;\r\n	left: auto\r\n}\r\n.dropdown-menu .divider {\r\n	*width: 100%;\r\n	height: 1px;\r\n	margin: 9px 1px;\r\n	*margin: -5px 0 5px;\r\n	overflow: hidden;\r\n	background-color: #e5e5e5;\r\n	border-bottom: 1px solid #fff\r\n}\r\n.dropdown-menu&gt;li&gt;a {\r\n	display: block;\r\n	padding: 3px 20px;\r\n	clear: both;\r\n	font-weight: normal;\r\n	line-height: 20px;\r\n	color: #333;\r\n	white-space: nowrap\r\n}\r\n.dropdown-menu&gt;li&gt;a:hover, .dropdown-menu&gt;li&gt;a:focus, .dropdown-submenu:hover&gt;a, .dropdown-submenu:focus&gt;a {\r\n	color: #fff;\r\n	text-decoration: none;\r\n	background-color: #0081c2;\r\n	background-image: -moz-linear-gradient(top, #08c, #0077b3);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#08c), to(#0077b3));\r\n	background-image: -webkit-linear-gradient(top, #08c, #0077b3);\r\n	background-image: -o-linear-gradient(top, #08c, #0077b3);\r\n	background-image: linear-gradient(to bottom, #08c, #0077b3);\r\n	background-repeat: repeat-x;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff0088cc&#039;, endColorstr=&#039;#ff0077b3&#039;, GradientType=0)\r\n}\r\n.dropdown-menu&gt;.active&gt;a, .dropdown-menu&gt;.active&gt;a:hover, .dropdown-menu&gt;.active&gt;a:focus {\r\n	color: #fff;\r\n	text-decoration: none;\r\n	background-color: #0081c2;\r\n	background-image: -moz-linear-gradient(top, #08c, #0077b3);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#08c), to(#0077b3));\r\n	background-image: -webkit-linear-gradient(top, #08c, #0077b3);\r\n	background-image: -o-linear-gradient(top, #08c, #0077b3);\r\n	background-image: linear-gradient(to bottom, #08c, #0077b3);\r\n	background-repeat: repeat-x;\r\n	outline: 0;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff0088cc&#039;, endColorstr=&#039;#ff0077b3&#039;, GradientType=0)\r\n}\r\n.dropdown-menu&gt;.disabled&gt;a, .dropdown-menu&gt;.disabled&gt;a:hover, .dropdown-menu&gt;.disabled&gt;a:focus {\r\n	color: #999\r\n}\r\n.dropdown-menu&gt;.disabled&gt;a:hover, .dropdown-menu&gt;.disabled&gt;a:focus {\r\n	text-decoration: none;\r\n	cursor: default;\r\n	background-color: transparent;\r\n	background-image: none;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.open {\r\n	*z-index: 1000\r\n}\r\n.open&gt;.dropdown-menu {\r\n	display: block\r\n}\r\n.pull-right&gt;.dropdown-menu {\r\n	right: 0;\r\n	left: auto\r\n}\r\n.dropup .caret, .navbar-fixed-bottom .dropdown .caret {\r\n	border-top: 0;\r\n	border-bottom: 4px solid #000;\r\n	content: &quot;&quot;\r\n}\r\n.dropup .dropdown-menu, .navbar-fixed-bottom .dropdown .dropdown-menu {\r\n	top: auto;\r\n	bottom: 100%;\r\n	margin-bottom: 1px\r\n}\r\n.dropdown-submenu {\r\n	position: relative\r\n}\r\n.dropdown-submenu&gt;.dropdown-menu {\r\n	top: 0;\r\n	left: 100%;\r\n	margin-top: -6px;\r\n	margin-left: -1px;\r\n	-webkit-border-radius: 0 6px 6px 6px;\r\n	-moz-border-radius: 0 6px 6px 6px;\r\n	border-radius: 0 6px 6px 6px\r\n}\r\n.dropdown-submenu:hover&gt;.dropdown-menu {\r\n	display: block\r\n}\r\n.dropup .dropdown-submenu&gt;.dropdown-menu {\r\n	top: auto;\r\n	bottom: 0;\r\n	margin-top: 0;\r\n	margin-bottom: -2px;\r\n	-webkit-border-radius: 5px 5px 5px 0;\r\n	-moz-border-radius: 5px 5px 5px 0;\r\n	border-radius: 5px 5px 5px 0\r\n}\r\n.dropdown-submenu&gt;a:after {\r\n	display: block;\r\n	float: right;\r\n	width: 0;\r\n	height: 0;\r\n	margin-top: 5px;\r\n	margin-right: -10px;\r\n	border-color: transparent;\r\n	border-left-color: #ccc;\r\n	border-style: solid;\r\n	border-width: 5px 0 5px 5px;\r\n	content: &quot; &quot;\r\n}\r\n.dropdown-submenu:hover&gt;a:after {\r\n	border-left-color: #fff\r\n}\r\n.dropdown-submenu.pull-left {\r\n	float: none\r\n}\r\n.dropdown-submenu.pull-left&gt;.dropdown-menu {\r\n	left: -100%;\r\n	margin-left: 10px;\r\n	-webkit-border-radius: 6px 0 6px 6px;\r\n	-moz-border-radius: 6px 0 6px 6px;\r\n	border-radius: 6px 0 6px 6px\r\n}\r\n.dropdown .dropdown-menu .nav-header {\r\n	padding-right: 20px;\r\n	padding-left: 20px\r\n}\r\n.typeahead {\r\n	z-index: 1051;\r\n	margin-top: 2px;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\n.well {\r\n	min-height: 20px;\r\n	padding: 19px;\r\n	margin-bottom: 20px;\r\n	background-color: #f5f5f5;\r\n	border: 1px solid #e3e3e3;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px;\r\n	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);\r\n	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);\r\n	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05)\r\n}\r\n.well blockquote {\r\n	border-color: #ddd;\r\n	border-color: rgba(0, 0, 0, 0.15)\r\n}\r\n.well-large {\r\n	padding: 24px;\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px\r\n}\r\n.well-small {\r\n	padding: 9px;\r\n	-webkit-border-radius: 3px;\r\n	-moz-border-radius: 3px;\r\n	border-radius: 3px\r\n}\r\n.fade {\r\n	opacity: 0;\r\n	-webkit-transition: opacity .15s linear;\r\n	-moz-transition: opacity .15s linear;\r\n	-o-transition: opacity .15s linear;\r\n	transition: opacity .15s linear\r\n}\r\n.fade.in {\r\n	opacity: 1\r\n}\r\n.collapse {\r\n	position: relative;\r\n	height: 0;\r\n	overflow: hidden;\r\n	-webkit-transition: height .35s ease;\r\n	-moz-transition: height .35s ease;\r\n	-o-transition: height .35s ease;\r\n	transition: height .35s ease\r\n}\r\n.collapse.in {\r\n	height: auto\r\n}\r\n.close {\r\n	float: right;\r\n	font-size: 20px;\r\n	font-weight: bold;\r\n	line-height: 20px;\r\n	color: #000;\r\n	text-shadow: 0 1px 0 #fff;\r\n	opacity: .2;\r\n	filter: alpha(opacity=20)\r\n}\r\n.close:hover, .close:focus {\r\n	color: #000;\r\n	text-decoration: none;\r\n	cursor: pointer;\r\n	opacity: .4;\r\n	filter: alpha(opacity=40)\r\n}\r\nbutton.close {\r\n	padding: 0;\r\n	cursor: pointer;\r\n	background: transparent;\r\n	border: 0;\r\n	-webkit-appearance: none\r\n}\r\n.btn {\r\n	display: inline-block;\r\n	*display: inline;\r\n	padding: 4px 12px;\r\n	margin-bottom: 0;\r\n	*margin-left: .3em;\r\n	font-size: 14px;\r\n	line-height: 20px;\r\n	color: #333;\r\n	text-align: center;\r\n	text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);\r\n	vertical-align: middle;\r\n	cursor: pointer;\r\n	background-color: #f5f5f5;\r\n	*background-color: #e6e6e6;\r\n	background-image: -moz-linear-gradient(top, #fff, #e6e6e6);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), to(#e6e6e6));\r\n	background-image: -webkit-linear-gradient(top, #fff, #e6e6e6);\r\n	background-image: -o-linear-gradient(top, #fff, #e6e6e6);\r\n	background-image: linear-gradient(to bottom, #fff, #e6e6e6);\r\n	background-repeat: repeat-x;\r\n	border: 1px solid #ccc;\r\n	*border: 0;\r\n	border-color: #e6e6e6 #e6e6e6 #bfbfbf;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	border-bottom-color: #b3b3b3;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ffffffff&#039;, endColorstr=&#039;#ffe6e6e6&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);\r\n	*zoom: 1;\r\n	-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05)\r\n}\r\n.btn:hover, .btn:focus, .btn:active, .btn.active, .btn.disabled, .btn[disabled] {\r\n	color: #333;\r\n	background-color: #e6e6e6;\r\n	*background-color: #d9d9d9\r\n}\r\n.btn:active, .btn.active {\r\n	background-color: #ccc \\9\r\n}\r\n.btn:first-child {\r\n	*margin-left: 0\r\n}\r\n.btn:hover, .btn:focus {\r\n	color: #333;\r\n	text-decoration: none;\r\n	background-position: 0 -15px;\r\n	-webkit-transition: background-position .1s linear;\r\n	-moz-transition: background-position .1s linear;\r\n	-o-transition: background-position .1s linear;\r\n	transition: background-position .1s linear\r\n}\r\n.btn:focus {\r\n	outline: thin dotted #333;\r\n	outline: 5px auto -webkit-focus-ring-color;\r\n	outline-offset: -2px\r\n}\r\n.btn.active, .btn:active {\r\n	background-image: none;\r\n	outline: 0;\r\n	-webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	-moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05)\r\n}\r\n.btn.disabled, .btn[disabled] {\r\n	cursor: default;\r\n	background-image: none;\r\n	opacity: .65;\r\n	filter: alpha(opacity=65);\r\n	-webkit-box-shadow: none;\r\n	-moz-box-shadow: none;\r\n	box-shadow: none\r\n}\r\n.btn-large {\r\n	padding: 11px 19px;\r\n	font-size: 17.5px;\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px\r\n}\r\n.btn-large [class^=&quot;icon-&quot;], .btn-large [class*=&quot; icon-&quot;] {\r\n	margin-top: 4px\r\n}\r\n.btn-small {\r\n	padding: 2px 10px;\r\n	font-size: 11.9px;\r\n	-webkit-border-radius: 3px;\r\n	-moz-border-radius: 3px;\r\n	border-radius: 3px\r\n}\r\n.btn-small [class^=&quot;icon-&quot;], .btn-small [class*=&quot; icon-&quot;] {\r\n	margin-top: 0\r\n}\r\n.btn-mini [class^=&quot;icon-&quot;], .btn-mini [class*=&quot; icon-&quot;] {\r\n	margin-top: -1px\r\n}\r\n.btn-mini {\r\n	padding: 0 6px;\r\n	font-size: 10.5px;\r\n	-webkit-border-radius: 3px;\r\n	-moz-border-radius: 3px;\r\n	border-radius: 3px\r\n}\r\n.btn-block {\r\n	display: block;\r\n	width: 100%;\r\n	padding-right: 0;\r\n	padding-left: 0;\r\n	-webkit-box-sizing: border-box;\r\n	-moz-box-sizing: border-box;\r\n	box-sizing: border-box\r\n}\r\n.btn-block+.btn-block {\r\n	margin-top: 5px\r\n}\r\ninput[type=&quot;submit&quot;].btn-block, input[type=&quot;reset&quot;].btn-block, input[type=&quot;button&quot;].btn-block {\r\n	width: 100%\r\n}\r\n.btn-primary.active, .btn-warning.active, .btn-danger.active, .btn-success.active, .btn-info.active, .btn-inverse.active {\r\n	color: rgba(255, 255, 255, 0.75)\r\n}\r\n.btn-primary {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #006dcc;\r\n	*background-color: #04c;\r\n	background-image: -moz-linear-gradient(top, #08c, #04c);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#08c), to(#04c));\r\n	background-image: -webkit-linear-gradient(top, #08c, #04c);\r\n	background-image: -o-linear-gradient(top, #08c, #04c);\r\n	background-image: linear-gradient(to bottom, #08c, #04c);\r\n	background-repeat: repeat-x;\r\n	border-color: #04c #04c #002a80;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff0088cc&#039;, endColorstr=&#039;#ff0044cc&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] {\r\n	color: #fff;\r\n	background-color: #04c;\r\n	*background-color: #003bb3\r\n}\r\n.btn-primary:active, .btn-primary.active {\r\n	background-color: #039 \\9\r\n}\r\n.btn-warning {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #faa732;\r\n	*background-color: #f89406;\r\n	background-image: -moz-linear-gradient(top, #fbb450, #f89406);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fbb450), to(#f89406));\r\n	background-image: -webkit-linear-gradient(top, #fbb450, #f89406);\r\n	background-image: -o-linear-gradient(top, #fbb450, #f89406);\r\n	background-image: linear-gradient(to bottom, #fbb450, #f89406);\r\n	background-repeat: repeat-x;\r\n	border-color: #f89406 #f89406 #ad6704;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#fffbb450&#039;, endColorstr=&#039;#fff89406&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.btn-warning:hover, .btn-warning:focus, .btn-warning:active, .btn-warning.active, .btn-warning.disabled, .btn-warning[disabled] {\r\n	color: #fff;\r\n	background-color: #f89406;\r\n	*background-color: #df8505\r\n}\r\n.btn-warning:active, .btn-warning.active {\r\n	background-color: #c67605 \\9\r\n}\r\n.btn-danger {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #da4f49;\r\n	*background-color: #bd362f;\r\n	background-image: -moz-linear-gradient(top, #ee5f5b, #bd362f);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ee5f5b), to(#bd362f));\r\n	background-image: -webkit-linear-gradient(top, #ee5f5b, #bd362f);\r\n	background-image: -o-linear-gradient(top, #ee5f5b, #bd362f);\r\n	background-image: linear-gradient(to bottom, #ee5f5b, #bd362f);\r\n	background-repeat: repeat-x;\r\n	border-color: #bd362f #bd362f #802420;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ffee5f5b&#039;, endColorstr=&#039;#ffbd362f&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.btn-danger:hover, .btn-danger:focus, .btn-danger:active, .btn-danger.active, .btn-danger.disabled, .btn-danger[disabled] {\r\n	color: #fff;\r\n	background-color: #bd362f;\r\n	*background-color: #a9302a\r\n}\r\n.btn-danger:active, .btn-danger.active {\r\n	background-color: #942a25 \\9\r\n}\r\n.btn-success {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #5bb75b;\r\n	*background-color: #51a351;\r\n	background-image: -moz-linear-gradient(top, #62c462, #51a351);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#51a351));\r\n	background-image: -webkit-linear-gradient(top, #62c462, #51a351);\r\n	background-image: -o-linear-gradient(top, #62c462, #51a351);\r\n	background-image: linear-gradient(to bottom, #62c462, #51a351);\r\n	background-repeat: repeat-x;\r\n	border-color: #51a351 #51a351 #387038;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff62c462&#039;, endColorstr=&#039;#ff51a351&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.btn-success:hover, .btn-success:focus, .btn-success:active, .btn-success.active, .btn-success.disabled, .btn-success[disabled] {\r\n	color: #fff;\r\n	background-color: #51a351;\r\n	*background-color: #499249\r\n}\r\n.btn-success:active, .btn-success.active {\r\n	background-color: #408140 \\9\r\n}\r\n.btn-info {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #49afcd;\r\n	*background-color: #2f96b4;\r\n	background-image: -moz-linear-gradient(top, #5bc0de, #2f96b4);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#5bc0de), to(#2f96b4));\r\n	background-image: -webkit-linear-gradient(top, #5bc0de, #2f96b4);\r\n	background-image: -o-linear-gradient(top, #5bc0de, #2f96b4);\r\n	background-image: linear-gradient(to bottom, #5bc0de, #2f96b4);\r\n	background-repeat: repeat-x;\r\n	border-color: #2f96b4 #2f96b4 #1f6377;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff5bc0de&#039;, endColorstr=&#039;#ff2f96b4&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .btn-info.disabled, .btn-info[disabled] {\r\n	color: #fff;\r\n	background-color: #2f96b4;\r\n	*background-color: #2a85a0\r\n}\r\n.btn-info:active, .btn-info.active {\r\n	background-color: #24748c \\9\r\n}\r\n.btn-inverse {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #363636;\r\n	*background-color: #222;\r\n	background-image: -moz-linear-gradient(top, #444, #222);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#444), to(#222));\r\n	background-image: -webkit-linear-gradient(top, #444, #222);\r\n	background-image: -o-linear-gradient(top, #444, #222);\r\n	background-image: linear-gradient(to bottom, #444, #222);\r\n	background-repeat: repeat-x;\r\n	border-color: #222 #222 #000;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff444444&#039;, endColorstr=&#039;#ff222222&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.btn-inverse:hover, .btn-inverse:focus, .btn-inverse:active, .btn-inverse.active, .btn-inverse.disabled, .btn-inverse[disabled] {\r\n	color: #fff;\r\n	background-color: #222;\r\n	*background-color: #151515\r\n}\r\n.btn-inverse:active, .btn-inverse.active {\r\n	background-color: #080808 \\9\r\n}\r\nbutton.btn, input[type=&quot;submit&quot;].btn {\r\n	*padding-top: 3px;\r\n	*padding-bottom: 3px\r\n}\r\nbutton.btn::-moz-focus-inner, input[type=&quot;submit&quot;].btn::-moz-focus-inner {\r\n	padding: 0;\r\n	border: 0\r\n}\r\nbutton.btn.btn-large, input[type=&quot;submit&quot;].btn.btn-large {\r\n	*padding-top: 7px;\r\n	*padding-bottom: 7px\r\n}\r\nbutton.btn.btn-small, input[type=&quot;submit&quot;].btn.btn-small {\r\n	*padding-top: 3px;\r\n	*padding-bottom: 3px\r\n}\r\nbutton.btn.btn-mini, input[type=&quot;submit&quot;].btn.btn-mini {\r\n	*padding-top: 1px;\r\n	*padding-bottom: 1px\r\n}\r\n.btn-link, .btn-link:active, .btn-link[disabled] {\r\n	background-color: transparent;\r\n	background-image: none;\r\n	-webkit-box-shadow: none;\r\n	-moz-box-shadow: none;\r\n	box-shadow: none\r\n}\r\n.btn-link {\r\n	color: #08c;\r\n	cursor: pointer;\r\n	border-color: transparent;\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.btn-link:hover, .btn-link:focus {\r\n	color: #005580;\r\n	text-decoration: underline;\r\n	background-color: transparent\r\n}\r\n.btn-link[disabled]:hover, .btn-link[disabled]:focus {\r\n	color: #333;\r\n	text-decoration: none\r\n}\r\n.btn-group {\r\n	position: relative;\r\n	display: inline-block;\r\n	*display: inline;\r\n	*margin-left: .3em;\r\n	font-size: 0;\r\n	white-space: nowrap;\r\n	vertical-align: middle;\r\n	*zoom: 1\r\n}\r\n.btn-group:first-child {\r\n	*margin-left: 0\r\n}\r\n.btn-group+.btn-group {\r\n	margin-left: 5px\r\n}\r\n.btn-toolbar {\r\n	margin-top: 10px;\r\n	margin-bottom: 10px;\r\n	font-size: 0\r\n}\r\n.btn-toolbar&gt;.btn+.btn, .btn-toolbar&gt;.btn-group+.btn, .btn-toolbar&gt;.btn+.btn-group {\r\n	margin-left: 5px\r\n}\r\n.btn-group&gt;.btn {\r\n	position: relative;\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.btn-group&gt;.btn+.btn {\r\n	margin-left: -1px\r\n}\r\n.btn-group&gt;.btn, .btn-group&gt;.dropdown-menu, .btn-group&gt;.popover {\r\n	font-size: 14px\r\n}\r\n.btn-group&gt;.btn-mini {\r\n	font-size: 10.5px\r\n}\r\n.btn-group&gt;.btn-small {\r\n	font-size: 11.9px\r\n}\r\n.btn-group&gt;.btn-large {\r\n	font-size: 17.5px\r\n}\r\n.btn-group&gt;.btn:first-child {\r\n	margin-left: 0;\r\n	-webkit-border-bottom-left-radius: 4px;\r\n	border-bottom-left-radius: 4px;\r\n	-webkit-border-top-left-radius: 4px;\r\n	border-top-left-radius: 4px;\r\n	-moz-border-radius-bottomleft: 4px;\r\n	-moz-border-radius-topleft: 4px\r\n}\r\n.btn-group&gt;.btn:last-child, .btn-group&gt;.dropdown-toggle {\r\n	-webkit-border-top-right-radius: 4px;\r\n	border-top-right-radius: 4px;\r\n	-webkit-border-bottom-right-radius: 4px;\r\n	border-bottom-right-radius: 4px;\r\n	-moz-border-radius-topright: 4px;\r\n	-moz-border-radius-bottomright: 4px\r\n}\r\n.btn-group&gt;.btn.large:first-child {\r\n	margin-left: 0;\r\n	-webkit-border-bottom-left-radius: 6px;\r\n	border-bottom-left-radius: 6px;\r\n	-webkit-border-top-left-radius: 6px;\r\n	border-top-left-radius: 6px;\r\n	-moz-border-radius-bottomleft: 6px;\r\n	-moz-border-radius-topleft: 6px\r\n}\r\n.btn-group&gt;.btn.large:last-child, .btn-group&gt;.large.dropdown-toggle {\r\n	-webkit-border-top-right-radius: 6px;\r\n	border-top-right-radius: 6px;\r\n	-webkit-border-bottom-right-radius: 6px;\r\n	border-bottom-right-radius: 6px;\r\n	-moz-border-radius-topright: 6px;\r\n	-moz-border-radius-bottomright: 6px\r\n}\r\n.btn-group&gt;.btn:hover, .btn-group&gt;.btn:focus, .btn-group&gt;.btn:active, .btn-group&gt;.btn.active {\r\n	z-index: 2\r\n}\r\n.btn-group .dropdown-toggle:active, .btn-group.open .dropdown-toggle {\r\n	outline: 0\r\n}\r\n.btn-group&gt;.btn+.dropdown-toggle {\r\n	*padding-top: 5px;\r\n	padding-right: 8px;\r\n	*padding-bottom: 5px;\r\n	padding-left: 8px;\r\n	-webkit-box-shadow: inset 1px 0 0 rgba(255, 255, 255, 0.125), inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	-moz-box-shadow: inset 1px 0 0 rgba(255, 255, 255, 0.125), inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	box-shadow: inset 1px 0 0 rgba(255, 255, 255, 0.125), inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05)\r\n}\r\n.btn-group&gt;.btn-mini+.dropdown-toggle {\r\n	*padding-top: 2px;\r\n	padding-right: 5px;\r\n	*padding-bottom: 2px;\r\n	padding-left: 5px\r\n}\r\n.btn-group&gt;.btn-small+.dropdown-toggle {\r\n	*padding-top: 5px;\r\n	*padding-bottom: 4px\r\n}\r\n.btn-group&gt;.btn-large+.dropdown-toggle {\r\n	*padding-top: 7px;\r\n	padding-right: 12px;\r\n	*padding-bottom: 7px;\r\n	padding-left: 12px\r\n}\r\n.btn-group.open .dropdown-toggle {\r\n	background-image: none;\r\n	-webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	-moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05)\r\n}\r\n.btn-group.open .btn.dropdown-toggle {\r\n	background-color: #e6e6e6\r\n}\r\n.btn-group.open .btn-primary.dropdown-toggle {\r\n	background-color: #04c\r\n}\r\n.btn-group.open .btn-warning.dropdown-toggle {\r\n	background-color: #f89406\r\n}\r\n.btn-group.open .btn-danger.dropdown-toggle {\r\n	background-color: #bd362f\r\n}\r\n.btn-group.open .btn-success.dropdown-toggle {\r\n	background-color: #51a351\r\n}\r\n.btn-group.open .btn-info.dropdown-toggle {\r\n	background-color: #2f96b4\r\n}\r\n.btn-group.open .btn-inverse.dropdown-toggle {\r\n	background-color: #222\r\n}\r\n.btn .caret {\r\n	margin-top: 8px;\r\n	margin-left: 0\r\n}\r\n.btn-large .caret {\r\n	margin-top: 6px\r\n}\r\n.btn-large .caret {\r\n	border-top-width: 5px;\r\n	border-right-width: 5px;\r\n	border-left-width: 5px\r\n}\r\n.btn-mini .caret, .btn-small .caret {\r\n	margin-top: 8px\r\n}\r\n.dropup .btn-large .caret {\r\n	border-bottom-width: 5px\r\n}\r\n.btn-primary .caret, .btn-warning .caret, .btn-danger .caret, .btn-info .caret, .btn-success .caret, .btn-inverse .caret {\r\n	border-top-color: #fff;\r\n	border-bottom-color: #fff\r\n}\r\n.btn-group-vertical {\r\n	display: inline-block;\r\n	*display: inline;\r\n	*zoom: 1\r\n}\r\n.btn-group-vertical&gt;.btn {\r\n	display: block;\r\n	float: none;\r\n	max-width: 100%;\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.btn-group-vertical&gt;.btn+.btn {\r\n	margin-top: -1px;\r\n	margin-left: 0\r\n}\r\n.btn-group-vertical&gt;.btn:first-child {\r\n	-webkit-border-radius: 4px 4px 0 0;\r\n	-moz-border-radius: 4px 4px 0 0;\r\n	border-radius: 4px 4px 0 0\r\n}\r\n.btn-group-vertical&gt;.btn:last-child {\r\n	-webkit-border-radius: 0 0 4px 4px;\r\n	-moz-border-radius: 0 0 4px 4px;\r\n	border-radius: 0 0 4px 4px\r\n}\r\n.btn-group-vertical&gt;.btn-large:first-child {\r\n	-webkit-border-radius: 6px 6px 0 0;\r\n	-moz-border-radius: 6px 6px 0 0;\r\n	border-radius: 6px 6px 0 0\r\n}\r\n.btn-group-vertical&gt;.btn-large:last-child {\r\n	-webkit-border-radius: 0 0 6px 6px;\r\n	-moz-border-radius: 0 0 6px 6px;\r\n	border-radius: 0 0 6px 6px\r\n}\r\n.alert {\r\n	padding: 8px 35px 8px 14px;\r\n	margin-bottom: 20px;\r\n	text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);\r\n	background-color: #fcf8e3;\r\n	border: 1px solid #fbeed5;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\n.alert, .alert h4 {\r\n	color: #c09853\r\n}\r\n.alert h4 {\r\n	margin: 0\r\n}\r\n.alert .close {\r\n	position: relative;\r\n	top: -2px;\r\n	right: -21px;\r\n	line-height: 20px\r\n}\r\n.alert-success {\r\n	color: #468847;\r\n	background-color: #dff0d8;\r\n	border-color: #d6e9c6\r\n}\r\n.alert-success h4 {\r\n	color: #468847\r\n}\r\n.alert-danger, .alert-error {\r\n	color: #b94a48;\r\n	background-color: #f2dede;\r\n	border-color: #eed3d7\r\n}\r\n.alert-danger h4, .alert-error h4 {\r\n	color: #b94a48\r\n}\r\n.alert-info {\r\n	color: #3a87ad;\r\n	background-color: #d9edf7;\r\n	border-color: #bce8f1\r\n}\r\n.alert-info h4 {\r\n	color: #3a87ad\r\n}\r\n.alert-block {\r\n	padding-top: 14px;\r\n	padding-bottom: 14px\r\n}\r\n.alert-block&gt;p, .alert-block&gt;ul {\r\n	margin-bottom: 0\r\n}\r\n.alert-block p+p {\r\n	margin-top: 5px\r\n}\r\n.nav {\r\n	margin-bottom: 20px;\r\n	margin-left: 0;\r\n	list-style: none\r\n}\r\n.nav&gt;li&gt;a {\r\n	display: block\r\n}\r\n.nav&gt;li&gt;a:hover, .nav&gt;li&gt;a:focus {\r\n	text-decoration: none;\r\n	background-color: #eee\r\n}\r\n.nav&gt;li&gt;a&gt;img {\r\n	max-width: none\r\n}\r\n.nav&gt;.pull-right {\r\n	float: right\r\n}\r\n.nav-header {\r\n	display: block;\r\n	padding: 3px 15px;\r\n	font-size: 11px;\r\n	font-weight: bold;\r\n	line-height: 20px;\r\n	color: #999;\r\n	text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);\r\n	text-transform: uppercase\r\n}\r\n.nav li+.nav-header {\r\n	margin-top: 9px\r\n}\r\n.nav-list {\r\n	padding-right: 15px;\r\n	padding-left: 15px;\r\n	margin-bottom: 0\r\n}\r\n.nav-list&gt;li&gt;a, .nav-list .nav-header {\r\n	margin-right: -15px;\r\n	margin-left: -15px;\r\n	text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5)\r\n}\r\n.nav-list&gt;li&gt;a {\r\n	padding: 3px 15px\r\n}\r\n.nav-list&gt;.active&gt;a, .nav-list&gt;.active&gt;a:hover, .nav-list&gt;.active&gt;a:focus {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2);\r\n	background-color: #08c\r\n}\r\n.nav-list [class^=&quot;icon-&quot;], .nav-list [class*=&quot; icon-&quot;] {\r\n	margin-right: 2px\r\n}\r\n.nav-list .divider {\r\n	*width: 100%;\r\n	height: 1px;\r\n	margin: 9px 1px;\r\n	*margin: -5px 0 5px;\r\n	overflow: hidden;\r\n	background-color: #e5e5e5;\r\n	border-bottom: 1px solid #fff\r\n}\r\n.nav-tabs, .nav-pills {\r\n	*zoom: 1\r\n}\r\n.nav-tabs:before, .nav-pills:before, .nav-tabs:after, .nav-pills:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.nav-tabs:after, .nav-pills:after {\r\n	clear: both\r\n}\r\n.nav-tabs&gt;li, .nav-pills&gt;li {\r\n	float: left\r\n}\r\n.nav-tabs&gt;li&gt;a, .nav-pills&gt;li&gt;a {\r\n	padding-right: 12px;\r\n	padding-left: 12px;\r\n	margin-right: 2px;\r\n	line-height: 14px\r\n}\r\n.nav-tabs {\r\n	border-bottom: 1px solid #ddd\r\n}\r\n.nav-tabs&gt;li {\r\n	margin-bottom: -1px\r\n}\r\n.nav-tabs&gt;li&gt;a {\r\n	padding-top: 8px;\r\n	padding-bottom: 8px;\r\n	line-height: 20px;\r\n	border: 1px solid transparent;\r\n	-webkit-border-radius: 4px 4px 0 0;\r\n	-moz-border-radius: 4px 4px 0 0;\r\n	border-radius: 4px 4px 0 0\r\n}\r\n.nav-tabs&gt;li&gt;a:hover, .nav-tabs&gt;li&gt;a:focus {\r\n	border-color: #eee #eee #ddd\r\n}\r\n.nav-tabs&gt;.active&gt;a, .nav-tabs&gt;.active&gt;a:hover, .nav-tabs&gt;.active&gt;a:focus {\r\n	color: #555;\r\n	cursor: default;\r\n	background-color: #fff;\r\n	border: 1px solid #ddd;\r\n	border-bottom-color: transparent\r\n}\r\n.nav-pills&gt;li&gt;a {\r\n	padding-top: 8px;\r\n	padding-bottom: 8px;\r\n	margin-top: 2px;\r\n	margin-bottom: 2px;\r\n	-webkit-border-radius: 5px;\r\n	-moz-border-radius: 5px;\r\n	border-radius: 5px\r\n}\r\n.nav-pills&gt;.active&gt;a, .nav-pills&gt;.active&gt;a:hover, .nav-pills&gt;.active&gt;a:focus {\r\n	color: #fff;\r\n	background-color: #08c\r\n}\r\n.nav-stacked&gt;li {\r\n	float: none\r\n}\r\n.nav-stacked&gt;li&gt;a {\r\n	margin-right: 0\r\n}\r\n.nav-tabs.nav-stacked {\r\n	border-bottom: 0\r\n}\r\n.nav-tabs.nav-stacked&gt;li&gt;a {\r\n	border: 1px solid #ddd;\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.nav-tabs.nav-stacked&gt;li:first-child&gt;a {\r\n	-webkit-border-top-right-radius: 4px;\r\n	border-top-right-radius: 4px;\r\n	-webkit-border-top-left-radius: 4px;\r\n	border-top-left-radius: 4px;\r\n	-moz-border-radius-topright: 4px;\r\n	-moz-border-radius-topleft: 4px\r\n}\r\n.nav-tabs.nav-stacked&gt;li:last-child&gt;a {\r\n	-webkit-border-bottom-right-radius: 4px;\r\n	border-bottom-right-radius: 4px;\r\n	-webkit-border-bottom-left-radius: 4px;\r\n	border-bottom-left-radius: 4px;\r\n	-moz-border-radius-bottomright: 4px;\r\n	-moz-border-radius-bottomleft: 4px\r\n}\r\n.nav-tabs.nav-stacked&gt;li&gt;a:hover, .nav-tabs.nav-stacked&gt;li&gt;a:focus {\r\n	z-index: 2;\r\n	border-color: #ddd\r\n}\r\n.nav-pills.nav-stacked&gt;li&gt;a {\r\n	margin-bottom: 3px\r\n}\r\n.nav-pills.nav-stacked&gt;li:last-child&gt;a {\r\n	margin-bottom: 1px\r\n}\r\n.nav-tabs .dropdown-menu {\r\n	-webkit-border-radius: 0 0 6px 6px;\r\n	-moz-border-radius: 0 0 6px 6px;\r\n	border-radius: 0 0 6px 6px\r\n}\r\n.nav-pills .dropdown-menu {\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px\r\n}\r\n.nav .dropdown-toggle .caret {\r\n	margin-top: 6px;\r\n	border-top-color: #08c;\r\n	border-bottom-color: #08c\r\n}\r\n.nav .dropdown-toggle:hover .caret, .nav .dropdown-toggle:focus .caret {\r\n	border-top-color: #005580;\r\n	border-bottom-color: #005580\r\n}\r\n.nav-tabs .dropdown-toggle .caret {\r\n	margin-top: 8px\r\n}\r\n.nav .active .dropdown-toggle .caret {\r\n	border-top-color: #fff;\r\n	border-bottom-color: #fff\r\n}\r\n.nav-tabs .active .dropdown-toggle .caret {\r\n	border-top-color: #555;\r\n	border-bottom-color: #555\r\n}\r\n.nav&gt;.dropdown.active&gt;a:hover, .nav&gt;.dropdown.active&gt;a:focus {\r\n	cursor: pointer\r\n}\r\n.nav-tabs .open .dropdown-toggle, .nav-pills .open .dropdown-toggle, .nav&gt;li.dropdown.open.active&gt;a:hover, .nav&gt;li.dropdown.open.active&gt;a:focus {\r\n	color: #fff;\r\n	background-color: #999;\r\n	border-color: #999\r\n}\r\n.nav li.dropdown.open .caret, .nav li.dropdown.open.active .caret, .nav li.dropdown.open a:hover .caret, .nav li.dropdown.open a:focus .caret {\r\n	border-top-color: #fff;\r\n	border-bottom-color: #fff;\r\n	opacity: 1;\r\n	filter: alpha(opacity=100)\r\n}\r\n.tabs-stacked .open&gt;a:hover, .tabs-stacked .open&gt;a:focus {\r\n	border-color: #999\r\n}\r\n.tabbable {\r\n	*zoom: 1\r\n}\r\n\r\n.tabbable:before, .tabbable:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.tabbable:after {\r\n	clear: both\r\n}\r\n.tab-content {\r\n	overflow: auto\r\n}\r\n.tabs-below&gt;.nav-tabs, .tabs-right&gt;.nav-tabs, .tabs-left&gt;.nav-tabs {\r\n	border-bottom: 0\r\n}\r\n.tab-content&gt;.tab-pane, .pill-content&gt;.pill-pane {\r\n	display: none\r\n}\r\n.tab-content&gt;.active, .pill-content&gt;.active {\r\n	display: block\r\n}\r\n.tabs-below&gt;.nav-tabs {\r\n	border-top: 1px solid #ddd\r\n}\r\n.tabs-below&gt;.nav-tabs&gt;li {\r\n	margin-top: -1px;\r\n	margin-bottom: 0\r\n}\r\n.tabs-below&gt;.nav-tabs&gt;li&gt;a {\r\n	-webkit-border-radius: 0 0 4px 4px;\r\n	-moz-border-radius: 0 0 4px 4px;\r\n	border-radius: 0 0 4px 4px\r\n}\r\n.tabs-below&gt;.nav-tabs&gt;li&gt;a:hover, .tabs-below&gt;.nav-tabs&gt;li&gt;a:focus {\r\n	border-top-color: #ddd;\r\n	border-bottom-color: transparent\r\n}\r\n.tabs-below&gt;.nav-tabs&gt;.active&gt;a, .tabs-below&gt;.nav-tabs&gt;.active&gt;a:hover, .tabs-below&gt;.nav-tabs&gt;.active&gt;a:focus {\r\n	border-color: transparent #ddd #ddd #ddd\r\n}\r\n.tabs-left&gt;.nav-tabs&gt;li, .tabs-right&gt;.nav-tabs&gt;li {\r\n	float: none\r\n}\r\n.tabs-left&gt;.nav-tabs&gt;li&gt;a, .tabs-right&gt;.nav-tabs&gt;li&gt;a {\r\n	min-width: 74px;\r\n	margin-right: 0;\r\n	margin-bottom: 3px\r\n}\r\n.tabs-left&gt;.nav-tabs {\r\n	float: left;\r\n	margin-right: 19px;\r\n	border-right: 1px solid #ddd\r\n}\r\n.tabs-left&gt;.nav-tabs&gt;li&gt;a {\r\n	margin-right: -1px;\r\n	-webkit-border-radius: 4px 0 0 4px;\r\n	-moz-border-radius: 4px 0 0 4px;\r\n	border-radius: 4px 0 0 4px\r\n}\r\n.tabs-left&gt;.nav-tabs&gt;li&gt;a:hover, .tabs-left&gt;.nav-tabs&gt;li&gt;a:focus {\r\n	border-color: #eee #ddd #eee #eee\r\n}\r\n.tabs-left&gt;.nav-tabs .active&gt;a, .tabs-left&gt;.nav-tabs .active&gt;a:hover, .tabs-left&gt;.nav-tabs .active&gt;a:focus {\r\n	border-color: #ddd transparent #ddd #ddd;\r\n	*border-right-color: #fff\r\n}\r\n.tabs-right&gt;.nav-tabs {\r\n	float: right;\r\n	margin-left: 19px;\r\n	border-left: 1px solid #ddd\r\n}\r\n\r\n.tabs-right&gt;.nav-tabs&gt;li&gt;a {\r\n	margin-left: -1px;\r\n	-webkit-border-radius: 0 4px 4px 0;\r\n	-moz-border-radius: 0 4px 4px 0;\r\n	border-radius: 0 4px 4px 0\r\n}\r\n.tabs-right&gt;.nav-tabs&gt;li&gt;a:hover, .tabs-right&gt;.nav-tabs&gt;li&gt;a:focus {\r\n	border-color: #eee #eee #eee #ddd\r\n}\r\n.tabs-right&gt;.nav-tabs .active&gt;a, .tabs-right&gt;.nav-tabs .active&gt;a:hover, .tabs-right&gt;.nav-tabs .active&gt;a:focus {\r\n	border-color: #ddd #ddd #ddd transparent;\r\n	*border-left-color: #fff\r\n}\r\n.nav&gt;.disabled&gt;a {\r\n	color: #999\r\n}\r\n.nav&gt;.disabled&gt;a:hover, .nav&gt;.disabled&gt;a:focus {\r\n	text-decoration: none;\r\n	cursor: default;\r\n	background-color: transparent\r\n}\r\n.navbar {\r\n	*position: relative;\r\n	*z-index: 2;\r\n	margin-bottom: 20px;\r\n	overflow: visible\r\n}\r\n.navbar-inner {\r\n	min-height: 40px;\r\n	padding-right: 20px;\r\n	padding-left: 20px;\r\n	background-color: #fafafa;\r\n	background-image: -moz-linear-gradient(top, #fff, #f2f2f2);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), to(#f2f2f2));\r\n	background-image: -webkit-linear-gradient(top, #fff, #f2f2f2);\r\n	background-image: -o-linear-gradient(top, #fff, #f2f2f2);\r\n	background-image: linear-gradient(to bottom, #fff, #f2f2f2);\r\n	background-repeat: repeat-x;\r\n	border: 1px solid #d4d4d4;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ffffffff&#039;, endColorstr=&#039;#fff2f2f2&#039;, GradientType=0);\r\n	*zoom: 1;\r\n	-webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065);\r\n	-moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065);\r\n	box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065)\r\n}\r\n.navbar-inner:before, .navbar-inner:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n\r\n.navbar-inner:after {\r\n	clear: both\r\n}\r\n.navbar .container {\r\n	width: auto\r\n}\r\n.nav-collapse.collapse {\r\n	height: auto;\r\n	overflow: visible\r\n}\r\n.navbar .brand {\r\n	display: block;\r\n	float: left;\r\n	padding: 10px 20px 10px;\r\n	margin-left: -20px;\r\n	font-size: 20px;\r\n	font-weight: 200;\r\n	color: #777;\r\n	text-shadow: 0 1px 0 #fff\r\n}\r\n.navbar .brand:hover, .navbar .brand:focus {\r\n	text-decoration: none\r\n}\r\n.navbar-text {\r\n	margin-bottom: 0;\r\n	line-height: 40px;\r\n	color: #777\r\n}\r\n.navbar-link {\r\n	color: #777\r\n}\r\n.navbar-link:hover, .navbar-link:focus {\r\n	color: #333\r\n}\r\n.navbar .divider-vertical {\r\n	height: 40px;\r\n	margin: 0 9px;\r\n	border-right: 1px solid #fff;\r\n	border-left: 1px solid #f2f2f2\r\n}\r\n.navbar .btn, .navbar .btn-group {\r\n	margin-top: 5px\r\n}\r\n.navbar .btn-group .btn, .navbar .input-prepend .btn, .navbar .input-append .btn, .navbar .input-prepend .btn-group, .navbar .input-append .btn-group {\r\n	margin-top: 0\r\n}\r\n.navbar-form {\r\n	margin-bottom: 0;\r\n	*zoom: 1\r\n}\r\n.navbar-form:before, .navbar-form:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n\r\n.navbar-form:after {\r\n	clear: both\r\n}\r\n.navbar-form input, .navbar-form select, .navbar-form .radio, .navbar-form .checkbox {\r\n	margin-top: 5px\r\n}\r\n.navbar-form input, .navbar-form select, .navbar-form .btn {\r\n	display: inline-block;\r\n	margin-bottom: 0\r\n}\r\n.navbar-form input[type=&quot;image&quot;], .navbar-form input[type=&quot;checkbox&quot;], .navbar-form input[type=&quot;radio&quot;] {\r\n	margin-top: 3px\r\n}\r\n.navbar-form .input-append, .navbar-form .input-prepend {\r\n	margin-top: 5px;\r\n	white-space: nowrap\r\n}\r\n.navbar-form .input-append input, .navbar-form .input-prepend input {\r\n	margin-top: 0\r\n}\r\n.navbar-search {\r\n	position: relative;\r\n	float: left;\r\n	margin-top: 5px;\r\n	margin-bottom: 0\r\n}\r\n.navbar-search .search-query {\r\n	padding: 4px 14px;\r\n	margin-bottom: 0;\r\n	font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\r\n	font-size: 13px;\r\n	font-weight: normal;\r\n	line-height: 1;\r\n	-webkit-border-radius: 15px;\r\n	-moz-border-radius: 15px;\r\n	border-radius: 15px\r\n}\r\n.navbar-static-top {\r\n	position: static;\r\n	margin-bottom: 0\r\n}\r\n.navbar-static-top .navbar-inner {\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.navbar-fixed-top, .navbar-fixed-bottom {\r\n	position: fixed;\r\n	right: 0;\r\n	left: 0;\r\n	z-index: 1030;\r\n	margin-bottom: 0\r\n}\r\n.navbar-fixed-top .navbar-inner, .navbar-static-top .navbar-inner {\r\n	border-width: 0 0 1px\r\n}\r\n\r\n.navbar-fixed-bottom .navbar-inner {\r\n	border-width: 1px 0 0\r\n}\r\n.navbar-fixed-top .navbar-inner, .navbar-fixed-bottom .navbar-inner {\r\n	padding-right: 0;\r\n	padding-left: 0;\r\n	-webkit-border-radius: 0;\r\n	-moz-border-radius: 0;\r\n	border-radius: 0\r\n}\r\n.navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container {\r\n	width: 940px\r\n}\r\n.navbar-fixed-top {\r\n	top: 0\r\n}\r\n.navbar-fixed-top .navbar-inner, .navbar-static-top .navbar-inner {\r\n	-webkit-box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);\r\n	-moz-box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);\r\n	box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1)\r\n}\r\n.navbar-fixed-bottom {\r\n	bottom: 0\r\n}\r\n.navbar-fixed-bottom .navbar-inner {\r\n	-webkit-box-shadow: 0 -1px 10px rgba(0, 0, 0, 0.1);\r\n	-moz-box-shadow: 0 -1px 10px rgba(0, 0, 0, 0.1);\r\n	box-shadow: 0 -1px 10px rgba(0, 0, 0, 0.1)\r\n}\r\n\r\n.navbar .nav {\r\n	position: relative;\r\n	left: 0;\r\n	display: block;\r\n	float: left;\r\n	margin: 0 10px 0 0\r\n}\r\n\r\n.navbar .nav.pull-right {\r\n	float: right;\r\n	margin-right: 0\r\n}\r\n.navbar .nav&gt;li {\r\n	float: left\r\n}\r\n\r\n.navbar .nav&gt;li&gt;a {\r\n	float: none;\r\n	padding: 20px 20px 10px;\r\n	color: #777;\r\n	text-decoration: none;\r\n}\r\n.navbar .nav .messages-menu, .notifications-menu, .tasks-menu{\r\n	margin-top: 4px;\r\n}\r\n\r\n.navbar .nav .dropdown-toggle .caret {\r\n	margin: 8px 5px;\r\n}\r\n.navbar .nav&gt;li&gt;a:focus, .navbar .nav&gt;li&gt;a:hover {\r\n	color: #333;\r\n	text-decoration: none;\r\n	background-color: transparent\r\n}\r\n.navbar .nav&gt;.active&gt;a, .navbar .nav&gt;.active&gt;a:hover, .navbar .nav&gt;.active&gt;a:focus {\r\n	color: #555;\r\n	text-decoration: none;\r\n	background-color: #e5e5e5;\r\n	-webkit-box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.125);\r\n	-moz-box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.125);\r\n	box-shadow: inset 0 3px 8px rgba(0, 0, 0, 0.125)\r\n}\r\n\r\n.navbar .btn-navbar {\r\n	display: none;\r\n	float: right;\r\n	padding: 7px 10px;\r\n	margin-right: 5px;\r\n	margin-left: 5px;\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #ededed;\r\n	*background-color: #e5e5e5;\r\n	background-image: -moz-linear-gradient(top, #f2f2f2, #e5e5e5);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f2f2f2), to(#e5e5e5));\r\n	background-image: -webkit-linear-gradient(top, #f2f2f2, #e5e5e5);\r\n	background-image: -o-linear-gradient(top, #f2f2f2, #e5e5e5);\r\n	background-image: linear-gradient(to bottom, #f2f2f2, #e5e5e5);\r\n	background-repeat: repeat-x;\r\n	border-color: #e5e5e5 #e5e5e5 #bfbfbf;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#fff2f2f2&#039;, endColorstr=&#039;#ffe5e5e5&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);\r\n	-webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 0 rgba(255, 255, 255, 0.075);\r\n	-moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 0 rgba(255, 255, 255, 0.075);\r\n	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 0 rgba(255, 255, 255, 0.075)\r\n}\r\n.navbar .btn-navbar:hover, .navbar .btn-navbar:focus, .navbar .btn-navbar:active, .navbar .btn-navbar.active, .navbar .btn-navbar.disabled, .navbar .btn-navbar[disabled] {\r\n	color: #fff;\r\n	background-color: #e5e5e5;\r\n	*background-color: #d9d9d9\r\n}\r\n.navbar .btn-navbar:active, .navbar .btn-navbar.active {\r\n	background-color: #ccc \\9\r\n}\r\n\r\n.navbar .btn-navbar .icon-bar {\r\n	display: block;\r\n	width: 18px;\r\n	height: 2px;\r\n	background-color: #f5f5f5;\r\n	-webkit-border-radius: 1px;\r\n	-moz-border-radius: 1px;\r\n	border-radius: 1px;\r\n	-webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);\r\n	-moz-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);\r\n	box-shadow: 0 1px 0 rgba(0, 0, 0, 0.25)\r\n}\r\n.btn-navbar .icon-bar+.icon-bar {\r\n	margin-top: 3px\r\n}\r\n.navbar .nav&gt;li&gt;.dropdown-menu:before {\r\n	position: absolute;\r\n	top: -7px;\r\n	left: 245px;\r\n	border-right: 7px solid transparent;\r\n	border-bottom: 7px solid #ccc;\r\n	border-left: 7px solid transparent;\r\n	border-bottom-color: rgba(0, 0, 0, 0.2);\r\n}\r\n.navbar .nav&gt;li&gt;.dropdown-menu:after {\r\n	position: absolute;\r\n	top: -15px;\r\n	left: 255px;\r\n	border-right: 6px solid transparent;\r\n	border-bottom: 6px solid #fff;\r\n	border-left: 6px solid transparent;\r\n}\r\n\r\n.navbar-fixed-bottom .nav&gt;li&gt;.dropdown-menu:before {\r\n	top: auto;\r\n	bottom: -7px;\r\n	border-top: 7px solid #ccc;\r\n	border-bottom: 0;\r\n	border-top-color: rgba(0, 0, 0, 0.2)\r\n}\r\n.navbar-fixed-bottom .nav&gt;li&gt;.dropdown-menu:after {\r\n	top: auto;\r\n	bottom: -6px;\r\n	border-top: 6px solid #fff;\r\n	border-bottom: 0\r\n}\r\n\r\n.navbar .nav li.dropdown&gt;a:hover .caret, .navbar .nav li.dropdown&gt;a:focus .caret {\r\n	border-top-color: #333;\r\n	border-bottom-color: #333\r\n}\r\n\r\n\r\n.navbar .nav li.dropdown&gt;.dropdown-toggle .caret {\r\n	border-top-color: #777;\r\n	border-bottom-color: #777\r\n}\r\n.navbar .nav li.dropdown.open&gt;.dropdown-toggle .caret, .navbar .nav li.dropdown.active&gt;.dropdown-toggle .caret, .navbar .nav li.dropdown.open.active&gt;.dropdown-toggle .caret {\r\n	border-top-color: #555;\r\n	border-bottom-color: #555\r\n}\r\n.navbar .pull-right&gt;li&gt;.dropdown-menu, .navbar .nav&gt;li&gt;.dropdown-menu.pull-right {\r\n	right: 0;\r\n	left: auto\r\n}\r\n.navbar .pull-right&gt;li&gt;.dropdown-menu:before, .navbar .nav&gt;li&gt;.dropdown-menu.pull-right:before {\r\n	right: 12px;\r\n	left: auto\r\n}\r\n.navbar .pull-right&gt;li&gt;.dropdown-menu:after, .navbar .nav&gt;li&gt;.dropdown-menu.pull-right:after {\r\n	right: 13px;\r\n	left: auto\r\n}\r\n.navbar .pull-right&gt;li&gt;.dropdown-menu .dropdown-menu, .navbar .nav&gt;li&gt;.dropdown-menu.pull-right .dropdown-menu {\r\n	right: 100%;\r\n	left: auto;\r\n	margin-right: -1px;\r\n	margin-left: 0;\r\n	-webkit-border-radius: 6px 0 6px 6px;\r\n	-moz-border-radius: 6px 0 6px 6px;\r\n	border-radius: 6px 0 6px 6px\r\n}\r\n\r\n.navbar-inverse .navbar-inner {\r\n	background-color: #1b1b1b;\r\n	background-image: -moz-linear-gradient(top, #222, #111);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#222), to(#111));\r\n	background-image: -webkit-linear-gradient(top, #222, #111);\r\n	background-image: -o-linear-gradient(top, #222, #111);\r\n	background-image: linear-gradient(to bottom, #222, #111);\r\n	background-repeat: repeat-x;\r\n	border-color: #252525;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff222222&#039;, endColorstr=&#039;#ff111111&#039;, GradientType=0)\r\n}\r\n.navbar-inverse .brand, .navbar-inverse .nav&gt;li&gt;a {\r\n	color: #999;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25)\r\n}\r\n.navbar-inverse .brand:hover, .navbar-inverse .nav&gt;li&gt;a:hover, .navbar-inverse .brand:focus, .navbar-inverse .nav&gt;li&gt;a:focus {\r\n	color: #fff\r\n}\r\n.navbar-inverse .brand {\r\n	color: #999\r\n}\r\n.navbar-inverse .navbar-text {\r\n	color: #999\r\n}\r\n.navbar-inverse .nav&gt;li&gt;a:focus, .navbar-inverse .nav&gt;li&gt;a:hover {\r\n	color: #fff;\r\n	background-color: transparent\r\n}\r\n.navbar-inverse .nav .active&gt;a, .navbar-inverse .nav .active&gt;a:hover, .navbar-inverse .nav .active&gt;a:focus {\r\n	color: #fff;\r\n	background-color: #111\r\n}\r\n.navbar-inverse .navbar-link {\r\n	color: #999\r\n}\r\n.navbar-inverse .navbar-link:hover, .navbar-inverse .navbar-link:focus {\r\n	color: #fff\r\n}\r\n.navbar-inverse .divider-vertical {\r\n	border-right-color: #222;\r\n	border-left-color: #111\r\n}\r\n.navbar-inverse .nav li.dropdown.open&gt;.dropdown-toggle, .navbar-inverse .nav li.dropdown.active&gt;.dropdown-toggle, .navbar-inverse .nav li.dropdown.open.active&gt;.dropdown-toggle {\r\n	color: #fff;\r\n	background-color: #111\r\n}\r\n.navbar-inverse .nav li.dropdown&gt;a:hover .caret, .navbar-inverse .nav li.dropdown&gt;a:focus .caret {\r\n	border-top-color: #fff;\r\n	border-bottom-color: #fff\r\n}\r\n.navbar-inverse .nav li.dropdown&gt;.dropdown-toggle .caret {\r\n	border-top-color: #999;\r\n	border-bottom-color: #999\r\n}\r\n.navbar-inverse .nav li.dropdown.open&gt;.dropdown-toggle .caret, .navbar-inverse .nav li.dropdown.active&gt;.dropdown-toggle .caret, .navbar-inverse .nav li.dropdown.open.active&gt;.dropdown-toggle .caret {\r\n	border-top-color: #fff;\r\n	border-bottom-color: #fff\r\n}\r\n.navbar-inverse .navbar-search .search-query {\r\n	color: #fff;\r\n	background-color: #515151;\r\n	border-color: #111;\r\n	-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 1px 0 rgba(255, 255, 255, 0.15);\r\n	-moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 1px 0 rgba(255, 255, 255, 0.15);\r\n	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 1px 0 rgba(255, 255, 255, 0.15);\r\n	-webkit-transition: none;\r\n	-moz-transition: none;\r\n	-o-transition: none;\r\n	transition: none\r\n}\r\n.navbar-inverse .navbar-search .search-query:-moz-placeholder {\r\n	color: #ccc\r\n}\r\n.navbar-inverse .navbar-search .search-query:-ms-input-placeholder {\r\n	color: #ccc\r\n}\r\n.navbar-inverse .navbar-search .search-query::-webkit-input-placeholder {\r\n	color: #ccc\r\n}\r\n\r\n.navbar-inverse .navbar-search .search-query:focus, .navbar-inverse .navbar-search .search-query.focused {\r\n	padding: 5px 15px;\r\n	color: #333;\r\n	text-shadow: 0 1px 0 #fff;\r\n	background-color: #fff;\r\n	border: 0;\r\n	outline: 0;\r\n	-webkit-box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);\r\n	-moz-box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);\r\n	box-shadow: 0 0 3px rgba(0, 0, 0, 0.15)\r\n}\r\n.navbar-inverse .btn-navbar {\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #0e0e0e;\r\n	*background-color: #040404;\r\n	background-image: -moz-linear-gradient(top, #151515, #040404);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#151515), to(#040404));\r\n	background-image: -webkit-linear-gradient(top, #151515, #040404);\r\n	background-image: -o-linear-gradient(top, #151515, #040404);\r\n	background-image: linear-gradient(to bottom, #151515, #040404);\r\n	background-repeat: repeat-x;\r\n	border-color: #040404 #040404 #000;\r\n	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff151515&#039;, endColorstr=&#039;#ff040404&#039;, GradientType=0);\r\n	filter: progid:DXImageTransform.Microsoft.gradient(enabled=false)\r\n}\r\n.navbar-inverse .btn-navbar:hover, .navbar-inverse .btn-navbar:focus, .navbar-inverse .btn-navbar:active, .navbar-inverse .btn-navbar.active, .navbar-inverse .btn-navbar.disabled, .navbar-inverse .btn-navbar[disabled] {\r\n	color: #fff;\r\n	background-color: #040404;\r\n	*background-color: #000\r\n}\r\n.navbar-inverse .btn-navbar:active, .navbar-inverse .btn-navbar.active {\r\n	background-color: #000 \\9\r\n}\r\n.breadcrumb {\r\n	padding: 8px 15px;\r\n	margin: 0 0 20px;\r\n	list-style: none;\r\n	background-color: #f5f5f5;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\n.breadcrumb&gt;li {\r\n	display: inline-block;\r\n	*display: inline;\r\n	text-shadow: 0 1px 0 #fff;\r\n	*zoom: 1\r\n}\r\n.breadcrumb&gt;li&gt;.divider {\r\n	padding: 0 5px;\r\n	color: #ccc\r\n}\r\n.breadcrumb&gt;.active {\r\n	color: #999\r\n}\r\n.pagination {\r\n	margin: 20px 0\r\n}\r\n.pagination ul {\r\n	display: inline-block;\r\n	*display: inline;\r\n	margin-bottom: 0;\r\n	margin-left: 0;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px;\r\n	*zoom: 1;\r\n	-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);\r\n	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05)\r\n}\r\n.pagination ul&gt;li {\r\n	display: inline\r\n}\r\n.pagination ul&gt;li&gt;a, .pagination ul&gt;li&gt;span {\r\n	float: left;\r\n	padding: 4px 12px;\r\n	line-height: 20px;\r\n	text-decoration: none;\r\n	background-color: #fff;\r\n	border: 1px solid #ddd;\r\n	border-left-width: 0\r\n}\r\n.pagination ul&gt;li&gt;a:hover, .pagination ul&gt;li&gt;a:focus, .pagination ul&gt;.active&gt;a, .pagination ul&gt;.active&gt;span {\r\n	background-color: #f5f5f5\r\n}\r\n.pagination ul&gt;.active&gt;a, .pagination ul&gt;.active&gt;span {\r\n	color: #999;\r\n	cursor: default\r\n}\r\n.pagination ul&gt;.disabled&gt;span, .pagination ul&gt;.disabled&gt;a, .pagination ul&gt;.disabled&gt;a:hover, .pagination ul&gt;.disabled&gt;a:focus {\r\n	color: #999;\r\n	cursor: default;\r\n	background-color: transparent\r\n}\r\n.pagination ul&gt;li:first-child&gt;a, .pagination ul&gt;li:first-child&gt;span {\r\n	border-left-width: 1px;\r\n	-webkit-border-bottom-left-radius: 4px;\r\n	border-bottom-left-radius: 4px;\r\n	-webkit-border-top-left-radius: 4px;\r\n	border-top-left-radius: 4px;\r\n	-moz-border-radius-bottomleft: 4px;\r\n	-moz-border-radius-topleft: 4px\r\n}\r\n.pagination ul&gt;li:last-child&gt;a, .pagination ul&gt;li:last-child&gt;span {\r\n	-webkit-border-top-right-radius: 4px;\r\n	border-top-right-radius: 4px;\r\n	-webkit-border-bottom-right-radius: 4px;\r\n	border-bottom-right-radius: 4px;\r\n	-moz-border-radius-topright: 4px;\r\n	-moz-border-radius-bottomright: 4px\r\n}\r\n.pagination-centered {\r\n	text-align: center\r\n}\r\n.pagination-right {\r\n	text-align: right\r\n}\r\n.pagination-large ul&gt;li&gt;a, .pagination-large ul&gt;li&gt;span {\r\n	padding: 11px 19px;\r\n	font-size: 17.5px\r\n}\r\n.pagination-large ul&gt;li:first-child&gt;a, .pagination-large ul&gt;li:first-child&gt;span {\r\n	-webkit-border-bottom-left-radius: 6px;\r\n	border-bottom-left-radius: 6px;\r\n	-webkit-border-top-left-radius: 6px;\r\n	border-top-left-radius: 6px;\r\n	-moz-border-radius-bottomleft: 6px;\r\n	-moz-border-radius-topleft: 6px\r\n}\r\n.pagination-large ul&gt;li:last-child&gt;a, .pagination-large ul&gt;li:last-child&gt;span {\r\n	-webkit-border-top-right-radius: 6px;\r\n	border-top-right-radius: 6px;\r\n	-webkit-border-bottom-right-radius: 6px;\r\n	border-bottom-right-radius: 6px;\r\n	-moz-border-radius-topright: 6px;\r\n	-moz-border-radius-bottomright: 6px\r\n}\r\n.pagination-mini ul&gt;li:first-child&gt;a, .pagination-small ul&gt;li:first-child&gt;a, .pagination-mini ul&gt;li:first-child&gt;span, .pagination-small ul&gt;li:first-child&gt;span {\r\n	-webkit-border-bottom-left-radius: 3px;\r\n	border-bottom-left-radius: 3px;\r\n	-webkit-border-top-left-radius: 3px;\r\n	border-top-left-radius: 3px;\r\n	-moz-border-radius-bottomleft: 3px;\r\n	-moz-border-radius-topleft: 3px\r\n}\r\n.pagination-mini ul&gt;li:last-child&gt;a, .pagination-small ul&gt;li:last-child&gt;a, .pagination-mini ul&gt;li:last-child&gt;span, .pagination-small ul&gt;li:last-child&gt;span {\r\n	-webkit-border-top-right-radius: 3px;\r\n	border-top-right-radius: 3px;\r\n	-webkit-border-bottom-right-radius: 3px;\r\n	border-bottom-right-radius: 3px;\r\n	-moz-border-radius-topright: 3px;\r\n	-moz-border-radius-bottomright: 3px\r\n}\r\n.pagination-small ul&gt;li&gt;a, .pagination-small ul&gt;li&gt;span {\r\n	padding: 2px 10px;\r\n	font-size: 11.9px\r\n}\r\n.pagination-mini ul&gt;li&gt;a, .pagination-mini ul&gt;li&gt;span {\r\n	padding: 0 6px;\r\n	font-size: 10.5px\r\n}\r\n.pager {\r\n	margin: 20px 0;\r\n	text-align: center;\r\n	list-style: none;\r\n	*zoom: 1\r\n}\r\n.pager:before, .pager:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.pager:after {\r\n	clear: both\r\n}\r\n.pager li {\r\n	display: inline\r\n}\r\n.pager li&gt;a, .pager li&gt;span {\r\n	display: inline-block;\r\n	padding: 5px 14px;\r\n	background-color: #fff;\r\n	border: 1px solid #ddd;\r\n	-webkit-border-radius: 15px;\r\n	-moz-border-radius: 15px;\r\n	border-radius: 15px\r\n}\r\n.pager li&gt;a:hover, .pager li&gt;a:focus {\r\n	text-decoration: none;\r\n	background-color: #f5f5f5\r\n}\r\n.pager .next&gt;a, .pager .next&gt;span {\r\n	float: right\r\n}\r\n.pager .previous&gt;a, .pager .previous&gt;span {\r\n	float: left\r\n}\r\n.pager .disabled&gt;a, .pager .disabled&gt;a:hover, .pager .disabled&gt;a:focus, .pager .disabled&gt;span {\r\n	color: #999;\r\n	cursor: default;\r\n	background-color: #fff\r\n}\r\n.modal-backdrop {\r\n	position: fixed;\r\n	top: 0;\r\n	right: 0;\r\n	bottom: 0;\r\n	left: 0;\r\n	z-index: 1040;\r\n	background-color: #000\r\n}\r\n.modal-backdrop.fade {\r\n	opacity: 0\r\n}\r\n.modal-backdrop, .modal-backdrop.fade.in {\r\n	opacity: .8;\r\n	filter: alpha(opacity=80)\r\n}\r\n\r\n.modal-open {\r\n  overflow: hidden;\r\n}\r\n\r\n.modal {\r\n	display: none;\r\n	overflow: hidden;\r\n	position: fixed;\r\n	top: 10%;\r\n	left: 50%;\r\n	z-index: 1050;\r\n	width: 560px;\r\n	margin-left: -280px;\r\n	background-color: #fff;\r\n	border: 1px solid #999;\r\n	border: 1px solid rgba(0, 0, 0, 0.3);\r\n	*border: 1px solid #999;\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px;\r\n	outline: 0;\r\n	-webkit-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);\r\n	-moz-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);\r\n	box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);\r\n	-webkit-background-clip: padding-box;\r\n	-moz-background-clip: padding-box;\r\n	background-clip: padding-box\r\n}\r\n.modal.fade {\r\n	top: -25%;\r\n	-webkit-transition: opacity .3s linear, top .3s ease-out;\r\n	-moz-transition: opacity .3s linear, top .3s ease-out;\r\n	-o-transition: opacity .3s linear, top .3s ease-out;\r\n	transition: opacity .3s linear, top .3s ease-out\r\n}\r\n.modal.fade.in {\r\n	top: 10%\r\n}\r\n.modal-header {\r\n	padding: 9px 15px;\r\n	border-bottom: 1px solid #eee\r\n}\r\n.modal-header .close {\r\n	margin-top: 2px\r\n}\r\n.modal-header h3 {\r\n	margin: 0;\r\n	line-height: 30px\r\n}\r\n.modal-body {\r\n	position: relative;\r\n	max-height: 400px;\r\n	padding: 15px;\r\n	overflow-y: auto\r\n}\r\n.modal-form {\r\n	margin-bottom: 0\r\n}\r\n.modal-footer {\r\n	padding: 14px 15px 15px;\r\n	margin-bottom: 0;\r\n	text-align: right;\r\n	background-color: #f5f5f5;\r\n	border-top: 1px solid #ddd;\r\n	-webkit-border-radius: 0 0 6px 6px;\r\n	-moz-border-radius: 0 0 6px 6px;\r\n	border-radius: 0 0 6px 6px;\r\n	*zoom: 1;\r\n	-webkit-box-shadow: inset 0 1px 0 #fff;\r\n	-moz-box-shadow: inset 0 1px 0 #fff;\r\n	box-shadow: inset 0 1px 0 #fff\r\n}\r\n.modal-footer:before, .modal-footer:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.modal-footer:after {\r\n	clear: both\r\n}\r\n.modal-footer .btn+.btn {\r\n	margin-bottom: 0;\r\n	margin-left: 5px\r\n}\r\n.modal-footer .btn-group .btn+.btn {\r\n	margin-left: -1px\r\n}\r\n.modal-footer .btn-block+.btn-block {\r\n	margin-left: 0\r\n}\r\n.tooltip {\r\n	position: absolute;\r\n	z-index: 1030;\r\n	display: block;\r\n	font-size: 11px;\r\n	line-height: 1.4;\r\n	opacity: 0;\r\n	filter: alpha(opacity=0);\r\n	visibility: visible\r\n}\r\n.tooltip.in {\r\n	opacity: .8;\r\n	filter: alpha(opacity=80)\r\n}\r\n.tooltip.top {\r\n	padding: 5px 0;\r\n	margin-top: -3px\r\n}\r\n.tooltip.right {\r\n	padding: 0 5px;\r\n	margin-left: 3px\r\n}\r\n.tooltip.bottom {\r\n	padding: 5px 0;\r\n	margin-top: 3px\r\n}\r\n.tooltip.left {\r\n	padding: 0 5px;\r\n	margin-left: -3px\r\n}\r\n.tooltip-inner {\r\n	max-width: 200px;\r\n	padding: 8px;\r\n	color: #fff;\r\n	text-align: center;\r\n	text-decoration: none;\r\n	background-color: #000;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\n.tooltip-arrow {\r\n	position: absolute;\r\n	width: 0;\r\n	height: 0;\r\n	border-color: transparent;\r\n	border-style: solid\r\n}\r\n.tooltip.top .tooltip-arrow {\r\n	bottom: 0;\r\n	left: 50%;\r\n	margin-left: -5px;\r\n	border-top-color: #000;\r\n	border-width: 5px 5px 0\r\n}\r\n.tooltip.right .tooltip-arrow {\r\n	top: 50%;\r\n	left: 0;\r\n	margin-top: -5px;\r\n	border-right-color: #000;\r\n	border-width: 5px 5px 5px 0\r\n}\r\n.tooltip.left .tooltip-arrow {\r\n	top: 50%;\r\n	right: 0;\r\n	margin-top: -5px;\r\n	border-left-color: #000;\r\n	border-width: 5px 0 5px 5px\r\n}\r\n.tooltip.bottom .tooltip-arrow {\r\n	top: 0;\r\n	left: 50%;\r\n	margin-left: -5px;\r\n	border-bottom-color: #000;\r\n	border-width: 0 5px 5px\r\n}\r\n.popover {\r\n	position: absolute;\r\n	top: 0;\r\n	left: 0;\r\n	z-index: 1010;\r\n	display: none;\r\n	max-width: 276px;\r\n	padding: 1px;\r\n	text-align: left;\r\n	white-space: normal;\r\n	background-color: #fff;\r\n	border: 1px solid #ccc;\r\n	border: 1px solid rgba(0, 0, 0, 0.2);\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px;\r\n	-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n	-moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n	-webkit-background-clip: padding-box;\r\n	-moz-background-clip: padding;\r\n	background-clip: padding-box\r\n}\r\n.popover.top {\r\n	margin-top: -10px\r\n}\r\n.popover.right {\r\n	margin-left: 10px\r\n}\r\n.popover.bottom {\r\n	margin-top: 10px\r\n}\r\n.popover.left {\r\n	margin-left: -10px\r\n}\r\n.popover-title {\r\n	padding: 8px 14px;\r\n	margin: 0;\r\n	font-size: 14px;\r\n	font-weight: normal;\r\n	line-height: 18px;\r\n	background-color: #f7f7f7;\r\n	border-bottom: 1px solid #ebebeb;\r\n	-webkit-border-radius: 5px 5px 0 0;\r\n	-moz-border-radius: 5px 5px 0 0;\r\n	border-radius: 5px 5px 0 0\r\n}\r\n.popover-title:empty {\r\n	display: none\r\n}\r\n.popover-content {\r\n	padding: 9px 14px\r\n}\r\n.popover .arrow, .popover .arrow:after {\r\n	position: absolute;\r\n	display: block;\r\n	width: 0;\r\n	height: 0;\r\n	border-color: transparent;\r\n	border-style: solid\r\n}\r\n.popover .arrow {\r\n	border-width: 11px\r\n}\r\n.popover .arrow:after {\r\n	border-width: 10px;\r\n	content: &quot;&quot;\r\n}\r\n.popover.top .arrow {\r\n	bottom: -11px;\r\n	left: 50%;\r\n	margin-left: -11px;\r\n	border-top-color: #999;\r\n	border-top-color: rgba(0, 0, 0, 0.25);\r\n	border-bottom-width: 0\r\n}\r\n.popover.top .arrow:after {\r\n	bottom: 1px;\r\n	margin-left: -10px;\r\n	border-top-color: #fff;\r\n	border-bottom-width: 0\r\n}\r\n.popover.right .arrow {\r\n	top: 50%;\r\n	left: -11px;\r\n	margin-top: -11px;\r\n	border-right-color: #999;\r\n	border-right-color: rgba(0, 0, 0, 0.25);\r\n	border-left-width: 0\r\n}\r\n.popover.right .arrow:after {\r\n	bottom: -10px;\r\n	left: 1px;\r\n	border-right-color: #fff;\r\n	border-left-width: 0\r\n}\r\n.popover.bottom .arrow {\r\n	top: -11px;\r\n	left: 50%;\r\n	margin-left: -11px;\r\n	border-bottom-color: #999;\r\n	border-bottom-color: rgba(0, 0, 0, 0.25);\r\n	border-top-width: 0\r\n}\r\n.popover.bottom .arrow:after {\r\n	top: 1px;\r\n	margin-left: -10px;\r\n	border-bottom-color: #fff;\r\n	border-top-width: 0\r\n}\r\n.popover.left .arrow {\r\n	top: 50%;\r\n	right: -11px;\r\n	margin-top: -11px;\r\n	border-left-color: #999;\r\n	border-left-color: rgba(0, 0, 0, 0.25);\r\n	border-right-width: 0\r\n}\r\n.popover.left .arrow:after {\r\n	right: 1px;\r\n	bottom: -10px;\r\n	border-left-color: #fff;\r\n	border-right-width: 0\r\n}\r\n.thumbnails {\r\n	margin-left: -20px;\r\n	list-style: none;\r\n	*zoom: 1\r\n}\r\n.thumbnails:before, .thumbnails:after {\r\n	display: table;\r\n	line-height: 0;\r\n	content: &quot;&quot;\r\n}\r\n.thumbnails:after {\r\n	clear: both\r\n}\r\n.row-fluid .thumbnails {\r\n	margin-left: 0\r\n}\r\n.thumbnails&gt;li {\r\n	float: left;\r\n	margin-bottom: 20px;\r\n	margin-left: 20px\r\n}\r\n.thumbnail {\r\n	display: block;\r\n	padding: 4px;\r\n	line-height: 20px;\r\n	border: 1px solid #ddd;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px;\r\n	-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);\r\n	-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);\r\n	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.055);\r\n	-webkit-transition: all .2s ease-in-out;\r\n	-moz-transition: all .2s ease-in-out;\r\n	-o-transition: all .2s ease-in-out;\r\n	transition: all .2s ease-in-out\r\n}\r\na.thumbnail:hover, a.thumbnail:focus {\r\n	border-color: #08c;\r\n	-webkit-box-shadow: 0 1px 4px rgba(0, 105, 214, 0.25);\r\n	-moz-box-shadow: 0 1px 4px rgba(0, 105, 214, 0.25);\r\n	box-shadow: 0 1px 4px rgba(0, 105, 214, 0.25)\r\n}\r\n.thumbnail&gt;img {\r\n	display: block;\r\n	max-width: 100%;\r\n	margin-right: auto;\r\n	margin-left: auto\r\n}\r\n.thumbnail .caption {\r\n	padding: 9px;\r\n	color: #555\r\n}\r\n.media, .media-body {\r\n	overflow: hidden;\r\n	*overflow: visible;\r\n	zoom: 1\r\n}\r\n.media, .media .media {\r\n	margin-top: 15px\r\n}\r\n.media:first-child {\r\n	margin-top: 0\r\n}\r\n.media-object {\r\n	display: block\r\n}\r\n.media-heading {\r\n	margin: 0 0 5px\r\n}\r\n.media&gt;.pull-left {\r\n	margin-right: 10px\r\n}\r\n.media&gt;.pull-right {\r\n	margin-left: 10px\r\n}\r\n.media-list {\r\n	margin-left: 0;\r\n	list-style: none\r\n}\r\n.label, .badge {\r\n	display: inline-block;\r\n	padding: 2px 4px;\r\n	font-size: 11.844px;\r\n	font-weight: bold;\r\n	line-height: 14px;\r\n	color: #fff;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	white-space: nowrap;\r\n	vertical-align: baseline;\r\n	background-color: #999\r\n}\r\n.label {\r\n	-webkit-border-radius: 3px;\r\n	-moz-border-radius: 3px;\r\n	border-radius: 3px\r\n}\r\n.badge {\r\n	padding-right: 9px;\r\n	padding-left: 9px;\r\n	-webkit-border-radius: 9px;\r\n	-moz-border-radius: 9px;\r\n	border-radius: 9px\r\n}\r\n.label:empty, .badge:empty {\r\n	display: none\r\n}\r\na.label:hover, a.label:focus, a.badge:hover, a.badge:focus {\r\n	color: #fff;\r\n	text-decoration: none;\r\n	cursor: pointer\r\n}\r\n.label-important, .badge-important {\r\n	background-color: #b94a48\r\n}\r\n.label-important[href], .badge-important[href] {\r\n	background-color: #953b39\r\n}\r\n.label-warning, .badge-warning {\r\n	background-color: #f89406\r\n}\r\n.label-warning[href], .badge-warning[href] {\r\n	background-color: #c67605\r\n}\r\n.label-success, .badge-success {\r\n	background-color: #468847\r\n}\r\n.label-success[href], .badge-success[href] {\r\n	background-color: #356635\r\n}\r\n.label-info, .badge-info {\r\n	background-color: #3a87ad\r\n}\r\n.label-info[href], .badge-info[href] {\r\n	background-color: #2d6987\r\n}\r\n.label-inverse, .badge-inverse {\r\n	background-color: #333\r\n}\r\n.label-inverse[href], .badge-inverse[href] {\r\n	background-color: #1a1a1a\r\n}\r\n.btn .label, .btn .badge {\r\n	position: relative;\r\n	top: -1px\r\n}\r\n.btn-mini .label, .btn-mini .badge {\r\n	top: 0\r\n}\r\n@-webkit-keyframes progress-bar-stripes {\r\n	from {\r\n		background-position: 40px 0\r\n	}\r\n	to {\r\n		background-position: 0 0\r\n	}\r\n}\r\n@-moz-keyframes progress-bar-stripes {\r\n	from {\r\n		background-position: 40px 0\r\n	}\r\n	to {\r\n		background-position: 0 0\r\n	}\r\n}\r\n@-ms-keyframes progress-bar-stripes {\r\n	from {\r\n		background-position: 40px 0\r\n	}\r\n	to {\r\n		background-position: 0 0\r\n	}\r\n}\r\n@-o-keyframes progress-bar-stripes {\r\n	from {\r\n		background-position: 0 0\r\n	}\r\n	to {\r\n		background-position: 40px 0\r\n	}\r\n}\r\n@keyframes progress-bar-stripes {\r\n	from {\r\n		background-position: 40px 0\r\n	}\r\n	to {\r\n		background-position: 0 0\r\n	}\r\n}\r\n.progress {\r\n	height: 20px;\r\n	margin-bottom: 20px;\r\n	overflow: hidden;\r\n	background-color: #f7f7f7;\r\n	background-image: -moz-linear-gradient(top, #f5f5f5, #f9f9f9);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#f5f5f5), to(#f9f9f9));\r\n	background-image: -webkit-linear-gradient(top, #f5f5f5, #f9f9f9);\r\n	background-image: -o-linear-gradient(top, #f5f5f5, #f9f9f9);\r\n	background-image: linear-gradient(to bottom, #f5f5f5, #f9f9f9);\r\n	background-repeat: repeat-x;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#fff5f5f5&#039;, endColorstr=&#039;#fff9f9f9&#039;, GradientType=0);\r\n	-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);\r\n	-moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);\r\n	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1)\r\n}\r\n.progress .bar {\r\n	float: left;\r\n	width: 0;\r\n	height: 100%;\r\n	font-size: 12px;\r\n	color: #fff;\r\n	text-align: center;\r\n	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);\r\n	background-color: #0e90d2;\r\n	background-image: -moz-linear-gradient(top, #149bdf, #0480be);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#149bdf), to(#0480be));\r\n	background-image: -webkit-linear-gradient(top, #149bdf, #0480be);\r\n	background-image: -o-linear-gradient(top, #149bdf, #0480be);\r\n	background-image: linear-gradient(to bottom, #149bdf, #0480be);\r\n	background-repeat: repeat-x;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff149bdf&#039;, endColorstr=&#039;#ff0480be&#039;, GradientType=0);\r\n	-webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);\r\n	-moz-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);\r\n	box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);\r\n	-webkit-box-sizing: border-box;\r\n	-moz-box-sizing: border-box;\r\n	box-sizing: border-box;\r\n	-webkit-transition: width .6s ease;\r\n	-moz-transition: width .6s ease;\r\n	-o-transition: width .6s ease;\r\n	transition: width .6s ease\r\n}\r\n.progress .bar+.bar {\r\n	-webkit-box-shadow: inset 1px 0 0 rgba(0, 0, 0, 0.15), inset 0 -1px 0 rgba(0, 0, 0, 0.15);\r\n	-moz-box-shadow: inset 1px 0 0 rgba(0, 0, 0, 0.15), inset 0 -1px 0 rgba(0, 0, 0, 0.15);\r\n	box-shadow: inset 1px 0 0 rgba(0, 0, 0, 0.15), inset 0 -1px 0 rgba(0, 0, 0, 0.15)\r\n}\r\n.progress-striped .bar {\r\n	background-color: #149bdf;\r\n	background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));\r\n	background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	-webkit-background-size: 40px 40px;\r\n	-moz-background-size: 40px 40px;\r\n	-o-background-size: 40px 40px;\r\n	background-size: 40px 40px\r\n}\r\n.progress.active .bar {\r\n	-webkit-animation: progress-bar-stripes 2s linear infinite;\r\n	-moz-animation: progress-bar-stripes 2s linear infinite;\r\n	-ms-animation: progress-bar-stripes 2s linear infinite;\r\n	-o-animation: progress-bar-stripes 2s linear infinite;\r\n	animation: progress-bar-stripes 2s linear infinite\r\n}\r\n.progress-danger .bar, .progress .bar-danger {\r\n	background-color: #dd514c;\r\n	background-image: -moz-linear-gradient(top, #ee5f5b, #c43c35);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ee5f5b), to(#c43c35));\r\n	background-image: -webkit-linear-gradient(top, #ee5f5b, #c43c35);\r\n	background-image: -o-linear-gradient(top, #ee5f5b, #c43c35);\r\n	background-image: linear-gradient(to bottom, #ee5f5b, #c43c35);\r\n	background-repeat: repeat-x;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ffee5f5b&#039;, endColorstr=&#039;#ffc43c35&#039;, GradientType=0)\r\n}\r\n.progress-danger.progress-striped .bar, .progress-striped .bar-danger {\r\n	background-color: #ee5f5b;\r\n	background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));\r\n	background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent)\r\n}\r\n.progress-success .bar, .progress .bar-success {\r\n	background-color: #5eb95e;\r\n	background-image: -moz-linear-gradient(top, #62c462, #57a957);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#57a957));\r\n	background-image: -webkit-linear-gradient(top, #62c462, #57a957);\r\n	background-image: -o-linear-gradient(top, #62c462, #57a957);\r\n	background-image: linear-gradient(to bottom, #62c462, #57a957);\r\n	background-repeat: repeat-x;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff62c462&#039;, endColorstr=&#039;#ff57a957&#039;, GradientType=0)\r\n}\r\n.progress-success.progress-striped .bar, .progress-striped .bar-success {\r\n	background-color: #62c462;\r\n	background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));\r\n	background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent)\r\n}\r\n.progress-info .bar, .progress .bar-info {\r\n	background-color: #4bb1cf;\r\n	background-image: -moz-linear-gradient(top, #5bc0de, #339bb9);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#5bc0de), to(#339bb9));\r\n	background-image: -webkit-linear-gradient(top, #5bc0de, #339bb9);\r\n	background-image: -o-linear-gradient(top, #5bc0de, #339bb9);\r\n	background-image: linear-gradient(to bottom, #5bc0de, #339bb9);\r\n	background-repeat: repeat-x;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#ff5bc0de&#039;, endColorstr=&#039;#ff339bb9&#039;, GradientType=0)\r\n}\r\n.progress-info.progress-striped .bar, .progress-striped .bar-info {\r\n	background-color: #5bc0de;\r\n	background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));\r\n	background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent)\r\n}\r\n.progress-warning .bar, .progress .bar-warning {\r\n	background-color: #faa732;\r\n	background-image: -moz-linear-gradient(top, #fbb450, #f89406);\r\n	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fbb450), to(#f89406));\r\n	background-image: -webkit-linear-gradient(top, #fbb450, #f89406);\r\n	background-image: -o-linear-gradient(top, #fbb450, #f89406);\r\n	background-image: linear-gradient(to bottom, #fbb450, #f89406);\r\n	background-repeat: repeat-x;\r\n	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#fffbb450&#039;, endColorstr=&#039;#fff89406&#039;, GradientType=0)\r\n}\r\n.progress-warning.progress-striped .bar, .progress-striped .bar-warning {\r\n	background-color: #fbb450;\r\n	background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));\r\n	background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n	background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent)\r\n}\r\n.accordion {\r\n	margin-bottom: 20px\r\n}\r\n.accordion-group {\r\n	margin-bottom: 2px;\r\n	border: 1px solid #e5e5e5;\r\n	-webkit-border-radius: 4px;\r\n	-moz-border-radius: 4px;\r\n	border-radius: 4px\r\n}\r\n.accordion-heading {\r\n	border-bottom: 0\r\n}\r\n.accordion-heading .accordion-toggle {\r\n	display: block;\r\n	padding: 8px 15px\r\n}\r\n.accordion-toggle {\r\n	cursor: pointer\r\n}\r\n.accordion-inner {\r\n	padding: 9px 15px;\r\n	border-top: 1px solid #e5e5e5\r\n}\r\n.carousel {\r\n	position: relative;\r\n	margin-bottom: 20px;\r\n	line-height: 1\r\n}\r\n.carousel-inner {\r\n	position: relative;\r\n	width: 100%;\r\n	overflow: hidden\r\n}\r\n.carousel-inner&gt;.item {\r\n	position: relative;\r\n	display: none;\r\n	-webkit-transition: .6s ease-in-out left;\r\n	-moz-transition: .6s ease-in-out left;\r\n	-o-transition: .6s ease-in-out left;\r\n	transition: .6s ease-in-out left\r\n}\r\n.carousel-inner&gt;.item&gt;img, .carousel-inner&gt;.item&gt;a&gt;img {\r\n	display: block;\r\n	line-height: 1\r\n}\r\n.carousel-inner&gt;.active, .carousel-inner&gt;.next, .carousel-inner&gt;.prev {\r\n	display: block\r\n}\r\n.carousel-inner&gt;.active {\r\n	left: 0\r\n}\r\n.carousel-inner&gt;.next, .carousel-inner&gt;.prev {\r\n	position: absolute;\r\n	top: 0;\r\n	width: 100%\r\n}\r\n.carousel-inner&gt;.next {\r\n	left: 100%\r\n}\r\n.carousel-inner&gt;.prev {\r\n	left: -100%\r\n}\r\n.carousel-inner&gt;.next.left, .carousel-inner&gt;.prev.right {\r\n	left: 0\r\n}\r\n.carousel-inner&gt;.active.left {\r\n	left: -100%\r\n}\r\n.carousel-inner&gt;.active.right {\r\n	left: 100%\r\n}\r\n.carousel-control {\r\n	position: absolute;\r\n	top: 40%;\r\n	left: 15px;\r\n	width: 40px;\r\n	height: 40px;\r\n	margin-top: -20px;\r\n	font-size: 60px;\r\n	font-weight: 100;\r\n	line-height: 30px;\r\n	color: #fff;\r\n	text-align: center;\r\n	background: #222;\r\n	border: 3px solid #fff;\r\n	-webkit-border-radius: 23px;\r\n	-moz-border-radius: 23px;\r\n	border-radius: 23px;\r\n	opacity: .5;\r\n	filter: alpha(opacity=50)\r\n}\r\n.carousel-control.right {\r\n	right: 15px;\r\n	left: auto\r\n}\r\n.carousel-control:hover, .carousel-control:focus {\r\n	color: #fff;\r\n	text-decoration: none;\r\n	opacity: .9;\r\n	filter: alpha(opacity=90)\r\n}\r\n.carousel-indicators {\r\n	position: absolute;\r\n	top: 15px;\r\n	right: 15px;\r\n	z-index: 5;\r\n	margin: 0;\r\n	list-style: none\r\n}\r\n.carousel-indicators li {\r\n	display: block;\r\n	float: left;\r\n	width: 10px;\r\n	height: 10px;\r\n	margin-left: 5px;\r\n	text-indent: -999px;\r\n	background-color: #ccc;\r\n	background-color: rgba(255, 255, 255, 0.25);\r\n	border-radius: 5px\r\n}\r\n.carousel-indicators .active {\r\n	background-color: #fff\r\n}\r\n.carousel-caption {\r\n	position: absolute;\r\n	right: 0;\r\n	bottom: 0;\r\n	left: 0;\r\n	padding: 15px;\r\n	background: #333;\r\n	background: rgba(0, 0, 0, 0.75)\r\n}\r\n.carousel-caption h4, .carousel-caption p {\r\n	line-height: 20px;\r\n	color: #fff\r\n}\r\n.carousel-caption h4 {\r\n	margin: 0 0 5px\r\n}\r\n.carousel-caption p {\r\n	margin-bottom: 0\r\n}\r\n.hero-unit {\r\n	padding: 60px;\r\n	margin-bottom: 30px;\r\n	font-size: 18px;\r\n	font-weight: 200;\r\n	line-height: 30px;\r\n	color: inherit;\r\n	background-color: #eee;\r\n	-webkit-border-radius: 6px;\r\n	-moz-border-radius: 6px;\r\n	border-radius: 6px\r\n}\r\n.hero-unit h1 {\r\n	margin-bottom: 0;\r\n	font-size: 60px;\r\n	line-height: 1;\r\n	letter-spacing: -1px;\r\n	color: inherit\r\n}\r\n.hero-unit li {\r\n	line-height: 30px\r\n}\r\n.pull-right {\r\n	float: right\r\n}\r\n.pull-left {\r\n	float: left\r\n}\r\n.hide {\r\n	display: none\r\n}\r\n.show {\r\n	display: block\r\n}\r\n.invisible {\r\n	visibility: hidden\r\n}\r\n.affix {\r\n	position: fixed\r\n}', '1', '2016-04-23 03:33:54', '2016-04-23 04:33:54', '1461393234', '0', null, '0', 'rodape');
INSERT INTO `shop_code` VALUES ('15', '25', 'teste', 'rodape', 'html', 'loja/index', '	&lt;link rel=&quot;shortcut icon&quot; href=&quot;http://contentools.com/wp-content/uploads/2016/02/contentools-favicon.ico&quot; /&gt;&lt;style type=&quot;text/css&quot;&gt;.essb_links_list li.essb_totalcount_item .essb_t_l_big .essb_t_nb:after, .essb_links_list li.essb_totalcount_item .essb_t_r_big .essb_t_nb:after { color: #777777;content: &quot;shares&quot;;display: block;font-size: 11px;font-weight: normal;text-align: center;text-transform: uppercase;margin-top: -5px; } .essb_links_list li.essb_totalcount_item .essb_t_l_big, .essb_links_list li.essb_totalcount_item .essb_t_r_big { text-align: center; } .essb_displayed_sidebar .essb_links_list li.essb_totalcount_item .essb_t_l_big .essb_t_nb:after, .essb_displayed_sidebar .essb_links_list li.essb_totalcount_item .essb_t_r_big .essb_t_nb:after { margin-top: 0px; } .essb_displayed_sidebar_right .essb_links_list li.essb_totalcount_item .essb_t_l_big .essb_t_nb:after, .essb_displayed_sidebar_right .essb_links_list li.essb_totalcount_item .essb_t_r_big .essb_t_nb:after { margin-top: 0px; } .essb_totalcount_item_before, .essb_totalcount_item_after { display: block !important; } .essb_totalcount_item_before .essb_totalcount, .essb_totalcount_item_after .essb_totalcount { border: 0px !important; } .essb_counter_insidebeforename { margin-right: 5px; font-weight: bold; } .essb_width_columns_1 li { width: 100%; } .essb_width_columns_1 li a { width: 92%; } .essb_width_columns_2 li { width: 49%; } .essb_width_columns_2 li a { width: 86%; } .essb_width_columns_3 li { width: 32%; } .essb_width_columns_3 li a { width: 80%; } .essb_width_columns_4 li { width: 24%; } .essb_width_columns_4 li a { width: 70%; } .essb_width_columns_5 li { width: 19.5%; } .essb_width_columns_5 li a { width: 60%; } .essb_links li.essb_totalcount_item_before, .essb_width_columns_1 li.essb_totalcount_item_after { width: 100%; text-align: left; } .essb_network_align_center a { text-align: center; } .essb_network_align_right .essb_network_name { float: right;}&lt;/style&gt;\r\n&lt;script type=&quot;text/javascript&quot;&gt;var essb_settings = {&quot;ajax_url&quot;:&quot;http://contentools.com.br/wp-admin/admin-ajax.php&quot;,&quot;essb3_nonce&quot;:&quot;35f614c113&quot;,&quot;essb3_plugin_url&quot;:&quot;http://contentools.com/wp-content/plugins/easy-social-share-buttons3&quot;,&quot;essb3_facebook_total&quot;:true,&quot;essb3_admin_ajax&quot;:false,&quot;essb3_internal_counter&quot;:false,&quot;essb3_stats&quot;:false,&quot;essb3_ga&quot;:false,&quot;essb3_ga_mode&quot;:&quot;simple&quot;,&quot;essb3_counter_button_min&quot;:0,&quot;essb3_counter_total_min&quot;:0,&quot;blog_url&quot;:&quot;http://contentools.com/&quot;,&quot;ajax_type&quot;:&quot;wp&quot;,&quot;essb3_postfloat_stay&quot;:false,&quot;essb3_no_counter_mailprint&quot;:false,&quot;essb3_single_ajax&quot;:false,&quot;twitter_counter&quot;:&quot;&quot;,&quot;post_id&quot;:2201};&lt;/script&gt;&lt;style type=&quot;text/css&quot;&gt;.broken_link, a.broken_link {\r\n	text-decoration: line-through;\r\n}&lt;/style&gt;&lt;!-- Hotjar Tracking Code for http://contentools.com/ --&gt;\r\n\r\n\r\n	&lt;link rel=&quot;shortcut icon&quot; href=&quot;http://contentools.com/wp-content/uploads/2016/02/contentools-favicon.ico&quot; /&gt;&lt;style type=&quot;text/css&quot;&gt;.essb_links_list li.essb_totalcount_item .essb_t_l_big .essb_t_nb:after, .essb_links_list li.essb_totalcount_item .essb_t_r_big .essb_t_nb:after { color: #777777;content: &quot;shares&quot;;display: block;font-size: 11px;font-weight: normal;text-align: center;text-transform: uppercase;margin-top: -5px; } .essb_links_list li.essb_totalcount_item .essb_t_l_big, .essb_links_list li.essb_totalcount_item .essb_t_r_big { text-align: center; } .essb_displayed_sidebar .essb_links_list li.essb_totalcount_item .essb_t_l_big .essb_t_nb:after, .essb_displayed_sidebar .essb_links_list li.essb_totalcount_item .essb_t_r_big .essb_t_nb:after { margin-top: 0px; } .essb_displayed_sidebar_right .essb_links_list li.essb_totalcount_item .essb_t_l_big .essb_t_nb:after, .essb_displayed_sidebar_right .essb_links_list li.essb_totalcount_item .essb_t_r_big .essb_t_nb:after { margin-top: 0px; } .essb_totalcount_item_before, .essb_totalcount_item_after { display: block !important; } .essb_totalcount_item_before .essb_totalcount, .essb_totalcount_item_after .essb_totalcount { border: 0px !important; } .essb_counter_insidebeforename { margin-right: 5px; font-weight: bold; } .essb_width_columns_1 li { width: 100%; } .essb_width_columns_1 li a { width: 92%; } .essb_width_columns_2 li { width: 49%; } .essb_width_columns_2 li a { width: 86%; } .essb_width_columns_3 li { width: 32%; } .essb_width_columns_3 li a { width: 80%; } .essb_width_columns_4 li { width: 24%; } .essb_width_columns_4 li a { width: 70%; } .essb_width_columns_5 li { width: 19.5%; } .essb_width_columns_5 li a { width: 60%; } .essb_links li.essb_totalcount_item_before, .essb_width_columns_1 li.essb_totalcount_item_after { width: 100%; text-align: left; } .essb_network_align_center a { text-align: center; } .essb_network_align_right .essb_network_name { float: right;}&lt;/style&gt;\r\n&lt;script type=&quot;text/javascript&quot;&gt;var essb_settings = {&quot;ajax_url&quot;:&quot;http://contentools.com.br/wp-admin/admin-ajax.php&quot;,&quot;essb3_nonce&quot;:&quot;35f614c113&quot;,&quot;essb3_plugin_url&quot;:&quot;http://contentools.com/wp-content/plugins/easy-social-share-buttons3&quot;,&quot;essb3_facebook_total&quot;:true,&quot;essb3_admin_ajax&quot;:false,&quot;essb3_internal_counter&quot;:false,&quot;essb3_stats&quot;:false,&quot;essb3_ga&quot;:false,&quot;essb3_ga_mode&quot;:&quot;simple&quot;,&quot;essb3_counter_button_min&quot;:0,&quot;essb3_counter_total_min&quot;:0,&quot;blog_url&quot;:&quot;http://contentools.com/&quot;,&quot;ajax_type&quot;:&quot;wp&quot;,&quot;essb3_postfloat_stay&quot;:false,&quot;essb3_no_counter_mailprint&quot;:false,&quot;essb3_single_ajax&quot;:false,&quot;twitter_counter&quot;:&quot;&quot;,&quot;post_id&quot;:2201};&lt;/script&gt;&lt;style type=&quot;text/css&quot;&gt;.broken_link, a.broken_link {\r\n	text-decoration: line-through;\r\n}&lt;/style&gt;&lt;!-- Hotjar Tracking Code for http://contentools.com/ --&gt;', '1', '2016-04-23 03:46:50', '2016-04-23 04:51:49', '1461394309', '0', null, '0', null);

-- ----------------------------
-- Table structure for shop_comparador_produto
-- ----------------------------
DROP TABLE IF EXISTS `shop_comparador_produto`;
CREATE TABLE `shop_comparador_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_produto_default` int(11) NOT NULL,
  `id_comparador_default` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_comparador_produto_fk_1_idx` (`id_shop_default`),
  KEY `shop_comparador_produto_fk_2_idx` (`id_produto_default`),
  KEY `shop_comparador_produto_fk_3_idx` (`id_comparador_default`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_comparador_produto
-- ----------------------------

-- ----------------------------
-- Table structure for shop_comparador_xml
-- ----------------------------
DROP TABLE IF EXISTS `shop_comparador_xml`;
CREATE TABLE `shop_comparador_xml` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_comparador_default` int(11) NOT NULL,
  `todos_os_produtos` enum('False','True') DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `nome` varchar(45) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `shop_comparador_xml_fk_1_idx` (`id_shop_default`) USING BTREE,
  KEY `shop_comparador_xml_fk_2_idx` (`id_comparador_default`)) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_comparador_xml
-- ----------------------------
INSERT INTO `shop_comparador_xml` VALUES ('6', '5', '5', 'True', 'kndsgk', 'muccashop', 'http://styleshop.vialoja.com.br/xml/kndsgk/muccashop.xml', '2015-08-25 16:02:10', '2015-08-25 17:02:10');
INSERT INTO `shop_comparador_xml` VALUES ('10', '5', '3', 'True', 'yc5b33', 'google-merchant', 'http://styleshop.vialoja.com.br/xml/yc5b33/google-merchant.xml', '2015-08-26 18:38:27', '2015-08-26 19:38:27');
INSERT INTO `shop_comparador_xml` VALUES ('11', '5', '2', 'True', 'kuaztl', 'shopping-uol', 'http://styleshop.vialoja.com.br/xml/kuaztl/shopping-uol.xml', '2015-08-27 15:53:36', '2015-08-27 16:53:36');
INSERT INTO `shop_comparador_xml` VALUES ('17', '5', '1', 'False', '51yg6w', 'buscape', 'http://styleshop.vialoja.com.br/xml/51yg6w/buscape.xml', '2016-04-22 01:00:48', '2016-04-22 02:00:48');

-- ----------------------------
-- Table structure for shop_configuracoes_google
-- ----------------------------
DROP TABLE IF EXISTS `shop_configuracoes_google`;
CREATE TABLE `shop_configuracoes_google` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `google_analytics_code` char(45) DEFAULT NULL,
  `google_verification_file` varchar(45) DEFAULT NULL,
  `google_adwords_code` text,
  `google_adwords_remarketing_code` text,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_shop_default_UNIQUE` (`id_shop_default`),
  KEY `shop_configuracoes_google_fk_1_idx` (`id_shop_default`)) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_configuracoes_google
-- ----------------------------
INSERT INTO `shop_configuracoes_google` VALUES ('1', '5', 'UA-31855766-1', 'googlef7804416f93fdd6b.html', 'dsadsa', 'das', '2014-09-10 18:06:33', '2016-06-11 21:25:00');
INSERT INTO `shop_configuracoes_google` VALUES ('2', '25', 'UA-31855766-1.', 'googlef7804416f93fdd6b.html', 'gdsfgffffffffffffff', 'gdfgdsf', '2016-04-23 02:11:26', '2016-04-23 03:21:23');

-- ----------------------------
-- Table structure for shop_conta
-- ----------------------------
DROP TABLE IF EXISTS `shop_conta`;
CREATE TABLE `shop_conta` (
  `id_conta` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `tipo` enum('PF','PJ') DEFAULT NULL,
  `email_nota_fiscal` varchar(128) DEFAULT NULL,
  `nome_responsavel` varchar(128) DEFAULT NULL,
  `razao_social` varchar(128) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `cnpj` varchar(45) DEFAULT NULL,
  `telefone_principal` varchar(32) DEFAULT NULL,
  `telefone_celular` varchar(32) DEFAULT NULL,
  `endereco_logradouro` varchar(255) DEFAULT NULL,
  `endereco_complemento` varchar(255) DEFAULT NULL,
  `endereco_bairro` varchar(128) DEFAULT NULL,
  `endereco_cep` varchar(10) DEFAULT NULL,
  `endereco_estado` int(11) DEFAULT NULL,
  `endereco_cidade` int(11) DEFAULT NULL,
  `forma_pagamento` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `editar_cartao` tinyint(4) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cvv` varchar(255) DEFAULT NULL,
  `mes_expiracao` smallint(255) DEFAULT NULL,
  `ano_expiracao` smallint(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_conta`),
  KEY `shop_conta_fk_1_idx` (`id_shop_default`)) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_conta
-- ----------------------------
INSERT INTO `shop_conta` VALUES ('1', '5', 'PF', 'wsduarte@outlook.com', 'William Duarte', '', 'yz/UpNdnjU4=B2gRXWRxNw0=000014', 'zO+9vOZfXog=000000', '', '', 'dfsdf', 'fsdf', 'centro', '78400-000', '13', '510340', 'boleto', 'zO+9vOZfXog=000000', '0', 'zO+9vOZfXog=000000', 'zO+9vOZfXog=000000', '0', '0', '2014-07-03 20:03:14', '2015-07-04 21:41:24');

-- ----------------------------
-- Table structure for shop_cupom_desconto
-- ----------------------------
DROP TABLE IF EXISTS `shop_cupom_desconto`;
CREATE TABLE `shop_cupom_desconto` (
  `id_cupom` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `ativo` enum('False','True') DEFAULT 'True',
  `codigo` varchar(45) NOT NULL,
  `descricao` text,
  `tipo` enum('frete_gratis','porcentagem','fixo') DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `valor_minimo` decimal(10,2) DEFAULT NULL,
  `quantidade` int(11) DEFAULT '0',
  `cumulativo` enum('False','True') DEFAULT 'False',
  `quantidade_por_cliente` smallint(11) DEFAULT '1',
  `validade` date DEFAULT NULL,
  `aplicar_no_total` enum('False','True') DEFAULT 'False',
  `utilizados` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cupom`),
  UNIQUE KEY `codigo_Unique` (`id_shop_default`,`codigo`),
  KEY `shop_cupom_desconto_fk_1_idx` (`id_shop_default`)) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_cupom_desconto
-- ----------------------------
INSERT INTO `shop_cupom_desconto` VALUES ('9', '5', 'True', 'GP786XQLT-FRETE-GRATIS', 'cupom de frete gratis', 'frete_gratis', '0.00', '20.00', '2', 'True', '2', '2016-07-18', 'False', '0', '2015-07-04 16:40:12', '2016-01-18 13:12:54');
INSERT INTO `shop_cupom_desconto` VALUES ('10', '5', 'True', 'M5HG4UAL2-INDETERMINADO', '-INDETERMINADO', 'fixo', '15.00', '50.00', '1500', 'True', '1', '2016-01-19', 'False', '0', '2015-07-04 21:24:03', '2016-01-18 14:19:26');
INSERT INTO `shop_cupom_desconto` VALUES ('11', '5', 'True', 'P6WR6G7CZ', 'ss', 'porcentagem', '10.00', '50.00', '1', 'False', '0', '2016-01-20', 'False', '0', '2015-07-05 01:35:16', '2016-01-19 15:50:41');

-- ----------------------------
-- Table structure for shop_deposito
-- ----------------------------
DROP TABLE IF EXISTS `shop_deposito`;
CREATE TABLE `shop_deposito` (
  `id_deposito` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT NULL,
  `email` varchar(96) DEFAULT NULL,
  `desconto` decimal(10,2) DEFAULT NULL,
  `informacao` text,
  `desconto_total` enum('False','True') DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_deposito`),
  UNIQUE KEY `id_shop_default_UNIQUE` (`id_shop_default`),
  KEY `shop_deposito_fk_1_idx` (`id_shop_default`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_deposito
-- ----------------------------

-- ----------------------------
-- Table structure for shop_dominio
-- ----------------------------
DROP TABLE IF EXISTS `shop_dominio`;
CREATE TABLE `shop_dominio` (
  `id_dominio` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `dominio` varchar(150) NOT NULL,
  `subdominio_plataforma` enum('False','True') DEFAULT 'False',
  `subdominio_add` datetime DEFAULT NULL,
  `dominio_ssl` varchar(150) NOT NULL,
  `dominio_manutencao` varchar(150) DEFAULT NULL,
  `ssl_ativo` enum('False','True') DEFAULT 'False',
  `physical_uri` varchar(64) DEFAULT NULL,
  `virtual_uri` varchar(64) NOT NULL,
  `main` tinyint(4) DEFAULT '0',
  `ativo` tinyint(4) NOT NULL DEFAULT '1',
  `add_cpanel` tinyint(4) DEFAULT '0',
  `date_add_cpanel` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_dominio`),
  UNIQUE KEY `dominio_Unique` (`dominio`,`physical_uri`,`virtual_uri`) USING BTREE,
  KEY `shop_url_fk_1_idx` (`id_shop_default`),
  KEY `full_shop_url` (`dominio`,`physical_uri`,`virtual_uri`) USING BTREE,
  KEY `full_shop_url_ssl` (`dominio_ssl`,`physical_uri`,`virtual_uri`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_dominio
-- ----------------------------
INSERT INTO `shop_dominio` VALUES ('15', '2', 'style-shop.com', 'False', null, 'style-shop.com', null, 'False', '', '', '0', '1', '1', '2014-06-26 17:34:08', '2014-06-26 17:34:04', '2014-06-26 19:10:31');
INSERT INTO `shop_dominio` VALUES ('16', '2', 'd.net', 'False', null, 'd.net', null, 'False', '', '', '1', '1', '0', '2014-06-26 18:02:47', '2014-06-26 18:02:39', '2014-06-26 19:10:34');
INSERT INTO `shop_dominio` VALUES ('23', '2', 'ted.com', 'False', null, 'ted.com', null, 'False', '', '', '1', '1', '1', '2014-06-28 22:59:03', '2014-06-28 22:58:48', '2014-06-29 00:04:29');
INSERT INTO `shop_dominio` VALUES ('26', '7', 'zagonel.com.br', 'True', '2014-07-01 23:22:40', 'zagonel.com.br', null, 'False', '', 'zagonel.com.br', '1', '1', '0', null, '2014-07-01 23:22:40', '2014-11-05 19:12:22');
INSERT INTO `shop_dominio` VALUES ('53', '15', 'loja-kketab.vialoja.com.br', 'True', '2016-04-20 23:54:41', 'loja-kketab.vialoja.com.br', 'loja-kketab-manutencao.vialoja.com.br', 'False', '', 'loja-kketab', '1', '1', '0', null, '2016-10-22 21:35:42', '2016-10-22 22:35:44');
INSERT INTO `shop_dominio` VALUES ('63', '25', 'loja-acrtab.vialoja.com.br', 'True', '2016-04-23 03:39:13', 'loja-acrtab.vialoja.com.br', 'loja-acrtab-manutencao.vialoja.com.br', 'False', '', 'loja-acrtab', '1', '1', '0', null, '2016-10-22 21:35:48', '2016-10-22 22:35:51');
INSERT INTO `shop_dominio` VALUES ('99', '5', 'loja-k4psonqgh.vialoja.com.br', 'True', '2016-10-21 03:47:29', 'loja-k4psonqgh.vialoja.com.br', 'loja-k4psonqgh-manutencao.vialoja.com.br', 'False', null, 'loja-k4psonqgh', '1', '1', '0', null, '2016-10-21 03:47:29', '2016-10-21 04:47:29');

-- ----------------------------
-- Table structure for shop_dominio_redirect
-- ----------------------------
DROP TABLE IF EXISTS `shop_dominio_redirect`;
CREATE TABLE `shop_dominio_redirect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dominio` int(11) NOT NULL DEFAULT '0',
  `id_shop_default` int(11) NOT NULL,
  `dominio` varchar(150) NOT NULL,
  `subdominio_plataforma` enum('False','True') DEFAULT NULL,
  `dominio_ssl` varchar(150) NOT NULL,
  `physical_uri` varchar(64) NOT NULL,
  `virtual_uri` varchar(64) NOT NULL,
  `main` tinyint(4) NOT NULL,
  `ativo` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `shop_url_redirect_fk_1_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_dominio_redirect
-- ----------------------------
INSERT INTO `shop_dominio_redirect` VALUES ('1', '53', '15', 'loja-kketab.vialoja.com.br', 'True', 'loja-kketab.vialoja.com.br', '', 'loja-kketab', '1', '1', '2016-10-22 21:35:44', '2016-10-22 22:35:44');
INSERT INTO `shop_dominio_redirect` VALUES ('2', '63', '25', 'loja-acrtab.vialoja.com.br', 'True', 'loja-acrtab.vialoja.com.br', '', 'loja-acrtab', '1', '1', '2016-10-22 21:35:51', '2016-10-22 22:35:51');

-- ----------------------------
-- Table structure for shop_endereco
-- ----------------------------
DROP TABLE IF EXISTS `shop_endereco`;
CREATE TABLE `shop_endereco` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `id_estado` int(11) NOT NULL,
  `id_cidade` int(11) DEFAULT '0',
  `id_shop_default` int(10) NOT NULL DEFAULT '0',
  `endereco` varchar(255) NOT NULL,
  `cep` char(12) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `numero` varchar(45) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `mostrar_endereco` enum('False','True') DEFAULT 'True',
  `outros` text,
  `created` datetime NOT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_endereco`),
  KEY `shop_endereco_fk_1_idx` (`id_shop_default`) USING BTREE,
  KEY `id_estado` (`id_estado`) USING BTREE,
  KEY `id_cidade` (`id_cidade`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of shop_endereco
-- ----------------------------
INSERT INTO `shop_endereco` VALUES ('3', '22', '220095', '15', 'Rua Tels Marinhio', '78450-000', 'centro', '632', 'centro', 'True', null, '2016-04-20 23:54:43', '2016-05-12 18:46:41');
INSERT INTO `shop_endereco` VALUES ('4', '22', '0', '5', 'teste', '78450-000', 'trevo0', '631', 'fundo santa carmem', 'True', null, '2016-10-20 22:40:11', '2016-10-24 15:54:29');

-- ----------------------------
-- Table structure for shop_envio
-- ----------------------------
DROP TABLE IF EXISTS `shop_envio`;
CREATE TABLE `shop_envio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_envio` int(11) NOT NULL,
  `ativo` enum('False','True') DEFAULT 'True',
  `limite_peso` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `shop_envio_fk_1_idx` (`id_shop_default`) USING BTREE,
  KEY `id_shop_envio_default` (`id_envio`)) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_envio
-- ----------------------------
INSERT INTO `shop_envio` VALUES ('99', '15', '1', 'True', null, '2016-04-20 23:54:58', '2016-04-21 00:54:58');
INSERT INTO `shop_envio` VALUES ('100', '15', '2', 'True', null, '2016-04-20 23:54:58', '2016-04-21 00:54:58');
INSERT INTO `shop_envio` VALUES ('101', '15', '3', 'True', null, '2016-04-20 23:54:58', '2016-04-21 00:54:58');
INSERT INTO `shop_envio` VALUES ('122', '25', '1', 'True', null, '2016-04-23 03:39:25', '2016-04-23 04:39:25');
INSERT INTO `shop_envio` VALUES ('123', '25', '2', 'True', null, '2016-04-23 03:39:25', '2016-04-23 04:39:25');
INSERT INTO `shop_envio` VALUES ('137', '5', '1', 'True', null, '2016-10-21 13:57:38', '2016-10-21 14:57:38');
INSERT INTO `shop_envio` VALUES ('138', '5', '2', 'True', null, '2016-10-21 13:57:38', '2016-10-21 14:57:38');

-- ----------------------------
-- Table structure for shop_envio_correios
-- ----------------------------
DROP TABLE IF EXISTS `shop_envio_correios`;
CREATE TABLE `shop_envio_correios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_envio_default` int(11) NOT NULL,
  `ativo` enum('False','True') DEFAULT 'True',
  `cep_origem` char(11) NOT NULL,
  `prazo_adicional` int(11) DEFAULT NULL,
  `taxa_tipo` enum('porcentagem','fixo') DEFAULT 'fixo',
  `taxa_valor` decimal(10,2) DEFAULT NULL,
  `com_contrato` enum('False','True') DEFAULT 'False',
  `codigo_servico` int(10) NOT NULL,
  `codigo` char(8) DEFAULT NULL,
  `senha` char(8) DEFAULT NULL,
  `mao_propria` enum('N','S') DEFAULT 'N',
  `valor_declarado` enum('N','S') DEFAULT 'N',
  `aviso_recebimento` enum('N','S') DEFAULT 'N',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_envio` (`id_shop_default`,`id_envio_default`) USING BTREE,
  KEY `shop_envio_correios_fk_1_idx` (`id_shop_default`) USING BTREE,
  KEY `shop_envio_correios_fk_2_idx` (`id_envio_default`)) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_envio_correios
-- ----------------------------
INSERT INTO `shop_envio_correios` VALUES ('25', '5', '1', 'True', '78450-000', null, 'fixo', null, 'False', '40010', null, null, 'N', 'N', 'N', '2016-10-21 13:57:38', '2016-10-21 14:57:38');
INSERT INTO `shop_envio_correios` VALUES ('26', '5', '2', 'True', '78450-000', null, 'fixo', null, 'False', '41106', null, null, 'N', 'N', 'N', '2016-10-21 13:57:38', '2016-10-21 14:57:38');

-- ----------------------------
-- Table structure for shop_envio_motoboy
-- ----------------------------
DROP TABLE IF EXISTS `shop_envio_motoboy`;
CREATE TABLE `shop_envio_motoboy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_envio_default` int(11) NOT NULL DEFAULT '100',
  `limite_peso` int(10) NOT NULL,
  `regiao` varchar(128) NOT NULL,
  `cep_inicio` char(10) NOT NULL,
  `cep_fim` char(10) NOT NULL,
  `prazo_entrega` int(10) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_envio` (`id_shop_default`,`id_envio_default`,`regiao`,`limite_peso`,`cep_inicio`,`cep_fim`) USING BTREE,
  KEY `shop_envio_motoboy_fk_1_idx` (`id_shop_default`) USING BTREE,
  KEY `shop_envio_motoboy_fk_2_idx` (`id_envio_default`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_envio_motoboy
-- ----------------------------

-- ----------------------------
-- Table structure for shop_envio_personalizado
-- ----------------------------
DROP TABLE IF EXISTS `shop_envio_personalizado`;
CREATE TABLE `shop_envio_personalizado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_envio_default` int(11) NOT NULL DEFAULT '400',
  `ativo` enum('False','True') DEFAULT NULL,
  `nome` varchar(128) NOT NULL,
  `prazo_adicional` int(11) DEFAULT NULL,
  `taxa_tipo` enum('fixo','porcentagem') DEFAULT NULL,
  `taxa_valor` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modifield` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_Unique` (`id_shop_default`,`nome`),
  KEY `shop_envio_personalizado_fk_1_idx` (`id_shop_default`) USING BTREE,
  KEY `shop_envio_personalizado_fk_2_idx` (`id_envio_default`)) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_envio_personalizado
-- ----------------------------
INSERT INTO `shop_envio_personalizado` VALUES ('31', '5', '400', 'True', 'Frete Fixo', '4', 'fixo', '5.00', '2013-11-19-ps4-02.jpg', '2015-08-06 16:04:09', '2016-04-22 02:20:36');

-- ----------------------------
-- Table structure for shop_envio_personalizado_faixa
-- ----------------------------
DROP TABLE IF EXISTS `shop_envio_personalizado_faixa`;
CREATE TABLE `shop_envio_personalizado_faixa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_envio_personalizado_default` int(11) NOT NULL,
  `id_personalizado_regiao_default` int(11) NOT NULL,
  `cep_inicio` char(10) NOT NULL,
  `cep_fim` char(10) NOT NULL,
  `prazo_entrega` smallint(6) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faixa_cep_Unique` (`id_envio_personalizado_default`,`id_personalizado_regiao_default`,`cep_inicio`,`cep_fim`) USING BTREE,
  KEY `shop_envio_personalizado_faixa_fk_2_idx` (`id_personalizado_regiao_default`) USING BTREE,
  KEY `shop_envio_personalizado_faixa_fk_1_idx` (`id_envio_personalizado_default`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_envio_personalizado_faixa
-- ----------------------------
INSERT INTO `shop_envio_personalizado_faixa` VALUES ('25', '31', '74', '78400-000', '78400-000', '0', '2015-08-06 16:06:08', '2015-08-06 17:06:08');
INSERT INTO `shop_envio_personalizado_faixa` VALUES ('27', '31', '73', '78450-000', '78450-000', '1', '2015-08-06 19:49:20', '2015-08-06 20:49:20');

-- ----------------------------
-- Table structure for shop_envio_personalizado_peso
-- ----------------------------
DROP TABLE IF EXISTS `shop_envio_personalizado_peso`;
CREATE TABLE `shop_envio_personalizado_peso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_envio_personalizado_default` int(11) NOT NULL,
  `id_personalizado_regiao_default` int(11) NOT NULL,
  `peso_inicio` decimal(10,3) NOT NULL,
  `peso_fim` decimal(10,3) NOT NULL,
  `valor` decimal(11,2) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faixa_peso_Unique` (`id_envio_personalizado_default`,`id_personalizado_regiao_default`,`peso_inicio`,`peso_fim`) USING BTREE,
  KEY `shop_envio_personalizado_peso_fk_2_idx` (`id_personalizado_regiao_default`) USING BTREE,
  KEY `shop_envio_personalizado_peso_fk_1_idx` (`id_envio_personalizado_default`)

) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_envio_personalizado_peso
-- ----------------------------
INSERT INTO `shop_envio_personalizado_peso` VALUES ('26', '31', '73', '0.001', '1.000', '20.00', '2015-08-06 16:05:13', '2015-08-06 17:05:13');
INSERT INTO `shop_envio_personalizado_peso` VALUES ('27', '31', '74', '0.300', '1.000', '15.00', '2015-08-06 16:06:30', '2015-08-06 17:06:30');
INSERT INTO `shop_envio_personalizado_peso` VALUES ('29', '31', '73', '1.000', '2.000', '30.00', '2015-08-07 13:19:51', '2015-08-07 14:19:51');
INSERT INTO `shop_envio_personalizado_peso` VALUES ('30', '31', '73', '5.000', '6.000', '50.00', '2015-08-07 13:20:22', '2015-08-07 14:20:22');
INSERT INTO `shop_envio_personalizado_peso` VALUES ('31', '31', '73', '8.000', '9.000', '60.00', '2015-08-07 13:44:29', '2015-08-07 14:44:29');

-- ----------------------------
-- Table structure for shop_envio_personalizado_regiao
-- ----------------------------
DROP TABLE IF EXISTS `shop_envio_personalizado_regiao`;
CREATE TABLE `shop_envio_personalizado_regiao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_envio_personalizado_default` int(11) DEFAULT NULL,
  `pais` varchar(128) DEFAULT NULL,
  `nome` varchar(128) NOT NULL,
  `ad_valorem` decimal(10,2) DEFAULT NULL,
  `kg_adicional` decimal(10,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_Unique` (`id_envio_personalizado_default`,`nome`) USING BTREE,
  KEY `shop_envio_personalizado_regiao_fk_1_idx` (`id_envio_personalizado_default`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_envio_personalizado_regiao
-- ----------------------------
INSERT INTO `shop_envio_personalizado_regiao` VALUES ('73', '31', 'Brasil', 'Centro Nova Mutum', '0.00', '1.00', '2015-08-06 16:04:29', '2016-01-15 16:32:28');
INSERT INTO `shop_envio_personalizado_regiao` VALUES ('74', '31', 'Brasil', 'Centro Diamantino', '0.00', '10.00', '2015-08-06 16:05:50', '2015-08-07 01:49:55');

-- ----------------------------
-- Table structure for shop_envio_pessoalmente
-- ----------------------------
DROP TABLE IF EXISTS `shop_envio_pessoalmente`;
CREATE TABLE `shop_envio_pessoalmente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT NULL,
  `id_envio_default` int(11) DEFAULT '300',
  `regiao` varchar(255) DEFAULT NULL,
  `cep_inicio` char(10) DEFAULT NULL,
  `cep_fim` char(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_envio` (`id_shop_default`,`id_envio_default`,`regiao`,`cep_inicio`,`cep_fim`) USING BTREE,
  KEY `shop_envio_pessoalmente_fk_1_idx` (`id_shop_default`) USING BTREE,
  KEY `shop_envio_pessoalmente_fk_2_idx` (`id_envio_default`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_envio_pessoalmente
-- ----------------------------

-- ----------------------------
-- Table structure for shop_envio_transportadora
-- ----------------------------
DROP TABLE IF EXISTS `shop_envio_transportadora`;
CREATE TABLE `shop_envio_transportadora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_envio_default` int(11) NOT NULL DEFAULT '200',
  `regiao` varchar(255) NOT NULL,
  `cep_inicio` char(9) NOT NULL,
  `cep_fim` char(9) NOT NULL,
  `peso_inicial` decimal(10,3) NOT NULL,
  `peso_final` decimal(10,3) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `prazo_entrega` smallint(6) NOT NULL,
  `ad_valorem` decimal(10,2) DEFAULT NULL,
  `kg_adicional` decimal(10,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faixa_Unique` (`id_shop_default`,`id_envio_default`,`regiao`,`cep_inicio`,`cep_fim`,`peso_inicial`,`peso_final`,`valor`,`prazo_entrega`) USING BTREE,
  KEY `shop_envio_transportadora_fk_1_idx` (`id_shop_default`),
  KEY `shop_envio_transportadora_fk_2_idx` (`id_envio_default`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_envio_transportadora
-- ----------------------------

-- ----------------------------
-- Table structure for shop_fatura
-- ----------------------------
DROP TABLE IF EXISTS `shop_fatura`;
CREATE TABLE `shop_fatura` (
  `id_fatura` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_plano` int(11) NOT NULL DEFAULT '1',
  `referencia` int(11) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `desconto` decimal(10,2) DEFAULT NULL,
  `situacao` tinyint(4) DEFAULT '2' COMMENT 'Rel. situacao_fatura\r\n\r\n1 = Aguardando processamento...\r\n2 = Pendente\r\n3 = Cancelado\r\n4 = Em suspenso\r\n5 = Pago',
  `data_dia` char(2) DEFAULT NULL,
  `data_mes_inicial` date DEFAULT NULL,
  `data_mes_final` date DEFAULT NULL,
  `periodicidade` varchar(45) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` smallint(6) DEFAULT '0',
  `fatura_gerada` enum('AUTOMATICA','MANUAL') DEFAULT 'AUTOMATICA',
  PRIMARY KEY (`id_fatura`),
  UNIQUE KEY `fatura_UNIQUE` (`id_shop_default`,`referencia`),
  KEY `shop_fatura_fk_1_idx` (`id_shop_default`)) ENGINE=InnoDB AUTO_INCREMENT=11049 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_fatura
-- ----------------------------
INSERT INTO `shop_fatura` VALUES ('10013', '5', '1', null, null, null, '5', '06', '2014-07-06', '2014-08-05', 'MENSAL', '5b6515a1f1bc6f908aeae4e9e815e2c7d628036f', '2014-07-06 20:45:58', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('10972', '5', '8', '10031', '949.00', '59.98', '5', '08', '2014-07-02', '2014-08-01', 'MENSAL', 'dae8777be86ab506cd1a11fca8647fb7', '2014-07-08 15:45:30', '2014-07-08 16:45:30', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10974', '5', '9', '10033', '1849.00', null, '3', '08', '2014-07-08', '2014-08-07', 'MENSAL', 'e3121a8a65f44abfb28b17779a3cfc5d', '2014-07-08 15:47:34', '2014-07-08 16:47:34', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10975', '5', '9', '10034', '1849.00', null, '3', '08', '2014-07-08', '2014-08-07', 'MENSAL', '147ed4e9bb89356eb00654d73f14c984', '2014-07-08 15:48:34', '2014-07-08 16:48:34', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10976', '5', '9', '10035', '1849.00', '734.71', '3', '08', '2014-07-08', '2014-08-07', 'MENSAL', '8752bb89145c4d1d0ddfa2eec5b5184e', '2014-07-08 15:49:25', '2014-07-08 16:49:25', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10977', '5', '7', '10036', '549.00', '0.00', '3', '08', '2014-07-08', '2014-08-07', 'MENSAL', 'dd1c0f1eff5d8251a16190ec64a5be02', '2014-07-08 16:17:44', '2014-07-08 17:17:44', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10978', '5', '7', '10037', '549.00', '549.00', '3', '08', '2014-07-08', '2014-08-07', 'MENSAL', 'b568d72d7e6199aeb4f2799534daeb37', '2014-07-08 16:23:13', '2014-07-08 17:23:13', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10979', '5', '7', '10038', '549.00', '549.00', '3', '08', '2014-07-08', '2014-08-07', 'MENSAL', '8ae192a89ba9626b7294d2618eaa946f', '2014-07-08 16:24:18', '2014-07-08 17:24:18', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10980', '5', '7', '10039', '549.00', '549.00', '3', '08', '2014-07-08', '2014-08-07', 'MENSAL', 'f975ca25fcfac20e33d3663ca33b0fff', '2014-07-08 16:24:55', '2014-07-08 17:24:55', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10981', '5', '6', '10040', '299.90', '299.90', '3', '08', '2014-07-08', '2014-08-07', 'MENSAL', '8028f88a2ea9d1957dfc751f134eaa29', '2014-07-08 21:39:39', '2014-07-08 22:39:39', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10982', '5', '6', '10041', '299.90', '299.90', '3', '08', '2014-07-08', '2014-08-07', 'MENSAL', '116b1d2c6d267a2449deffe011a90695', '2014-07-08 22:26:37', '2014-07-08 23:26:37', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10983', '5', '6', '10042', '299.90', '299.90', '3', '08', '2014-07-08', '2014-08-07', 'MENSAL', 'ad825687438382efeb0387ce6c64162f', '2014-07-08 22:29:12', '2014-07-08 23:29:12', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10984', '5', '6', '10043', '299.90', null, '3', '08', '2014-07-08', '2014-08-07', 'MENSAL', '239e307485fc13f5fe51e73beeb4c4f1', '2014-07-08 22:30:30', '2014-07-08 23:30:30', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10985', '5', '6', '10044', '299.90', null, '3', '08', '2014-07-08', '2014-08-07', 'MENSAL', '4b7bd6fdf2c9ac7f4a906034722f237a', '2014-07-08 22:35:01', '2014-07-08 23:35:01', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10986', '5', '7', '10045', '549.00', null, '3', '14', '2014-07-14', '2014-08-13', 'MENSAL', 'ec21ef2b361620c4d83a8ba7b9f6968c', '2014-07-14 23:13:23', '2014-07-15 00:13:23', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10987', '5', '9', '10046', '1849.00', null, '3', '29', '2015-01-29', '2015-02-28', 'MENSAL', '16054cad778c33dfd1adf4a8748864d3', '2015-01-29 15:39:41', '2015-01-29 16:39:41', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10988', '5', '7', '10047', '549.00', null, '3', '28', '2016-02-29', '2016-03-28', 'MENSAL', '9ae0f3cea4866c6ca801f789ce0f4bfb', '2016-02-29 15:41:27', '2016-02-29 16:41:27', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10989', '5', '6', '10048', '299.90', null, '3', '28', '2016-02-29', '2016-03-28', 'MENSAL', '6e7f06dd2c9ce7bdb7cfbb63fa875cde', '2016-02-29 17:09:19', '2016-02-29 18:09:19', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10990', '5', '7', '10049', '549.00', null, '3', '01', '2016-01-30', '2016-02-29', 'MENSAL', '5f43377d7e9f030b07cab8be28840668', '2016-01-30 17:10:31', '2016-01-30 18:10:31', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10991', '5', '9', '10050', '1447.00', null, '3', '01', '2015-06-01', '2015-06-30', 'MENSAL', '25ed26961121bfa5b7efb874d966e3a8', '2015-06-01 19:09:02', '2015-06-01 20:09:02', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10992', '5', '7', '10051', '847.00', null, '3', '05', '2015-06-05', '2015-07-04', 'MENSAL', 'fd5fca04aa687ea7392038e9c3833dfb', '2015-06-05 15:17:52', '2015-06-05 16:17:52', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10993', '5', '7', '10052', '847.00', null, '3', '05', '2015-06-05', '2015-07-04', 'MENSAL', '3ec416f4a712926f47b5d7991461f2e9', '2015-06-05 15:31:19', '2015-06-05 16:31:19', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10994', '5', '7', '10053', '847.00', null, '3', '05', '2015-06-05', '2015-07-04', 'MENSAL', '1badb27de8b89bcdd85dc4089ab972c5', '2015-06-05 15:32:07', '2015-06-05 16:32:07', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10995', '5', '7', '10054', '847.00', null, '3', '05', '2015-06-05', '2015-07-04', 'MENSAL', '44e9537543c8249bbc3d0dbe1a10ff44', '2015-06-05 15:32:29', '2015-06-05 16:32:29', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10996', '5', '10', '10055', '1847.00', null, '3', '05', '2015-06-05', '2015-07-04', 'MENSAL', '8858dd368b2914674f40446af60017de', '2015-06-05 15:44:56', '2015-06-05 16:44:56', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10997', '5', '7', '10056', '847.00', null, '3', '05', '2015-06-05', '2015-07-04', 'MENSAL', 'b972cc6185d43462006f61d01bad81b5', '2015-06-05 15:45:51', '2015-06-05 16:45:51', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('10998', '5', '4', '10057', '147.00', null, '3', '05', '2015-06-05', '2015-07-04', 'MENSAL', '0eb36ea075843a74688e21e0448e2e6c', '2015-06-05 16:50:19', '2015-06-05 17:50:19', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('11003', '5', '9', '10062', '1447.00', null, '3', '05', '2015-06-05', '2015-07-04', 'MENSAL', '0afad74ff542a952dc5cf62d5d93f468', '2015-06-05 17:52:57', '2015-06-05 18:52:57', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('11004', '5', '10', '10063', '1847.00', null, '3', '05', '2015-06-05', '2015-07-04', 'MENSAL', '9000bddde34270cb2a825a521c7a1e5e', '2015-06-05 18:09:48', '2015-06-05 19:09:48', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('11005', '5', '8', '10064', '1147.00', null, '4', '06', '2015-08-06', '2015-09-05', 'MENSAL', 'b5fdb91c8025a845cf7612a4720916cbf6e34c3f', '2015-08-06 00:00:08', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11006', '2', '2', '10065', '27.00', null, '2', '06', '2015-08-06', '2015-09-05', 'MENSAL', 'fe9dd458d2e8b93ac655517ab9b4c035ccef807c', '2015-08-06 00:00:18', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11008', '5', '1', '10067', '0.00', null, '3', '08', '2015-08-08', '2015-09-07', 'MENSAL', '33e081a924e0546f184fea46bde0ac6a', '2015-08-08 20:32:47', '2015-08-08 21:32:47', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('11009', '5', '1', '10068', '0.00', null, '3', '08', '2015-08-08', '2015-09-07', 'MENSAL', '6f90b4abd9a127ebef3e7b115ab001c9', '2015-08-08 20:36:12', '2015-08-08 21:36:12', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('11011', '5', '1', '10069', '0.00', null, '3', '20', '2015-09-20', '2015-10-19', 'MENSAL', 'd69e3ebaccb759b40f04e862c063a379', '2015-09-20 01:54:45', '2015-09-20 02:54:45', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('11012', '5', '1', '10070', '0.00', null, '3', '20', '2015-09-20', '2015-10-19', 'MENSAL', '1d4d342c785ceaf393d02133f4bc758c', '2015-09-20 01:55:15', '2015-09-20 02:55:15', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('11013', '7', '1', null, null, null, '5', '05', '2015-10-05', '2015-11-04', 'MENSAL', null, '2015-10-05 08:37:28', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11014', '7', '1', null, null, null, '5', '05', '2016-01-05', '2016-02-04', 'MENSAL', null, '2016-01-05 00:00:08', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11015', '5', '8', '10071', '1147.00', null, '5', '06', '2016-01-06', '2016-02-05', 'MENSAL', 'fdbf675029f54e9e54a6b60e49ff0c59d9c3a7c1', '2016-01-06 00:00:08', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11016', '2', '2', '10072', '27.00', null, '2', '06', '2016-01-06', '2016-02-05', 'MENSAL', 'dcb0cc2b552852eb9b82440beb4e8afdfce39870', '2016-01-06 00:00:18', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11018', '5', '8', '10074', '1147.00', null, '5', '06', '2016-04-06', '2016-05-05', 'MENSAL', 'dae881765b3f8f65ab4c04f6ff8a721367c7e0e4', '2016-04-06 03:05:28', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11019', '2', '2', '10075', '27.00', null, '2', '06', '2016-04-06', '2016-05-05', 'MENSAL', '18fe4a712d211b6ee9fb0cf0f7f4a458fae361c8', '2016-04-06 03:05:38', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11022', '15', '1', null, null, null, '5', '20', '2016-04-20', '2016-05-19', 'MENSAL', null, '2016-04-20 23:55:18', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11035', '25', '1', null, null, null, '5', '23', '2016-04-23', '2016-05-22', 'MENSAL', null, '2016-04-23 02:01:38', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11036', '5', '6', '10077', '747.00', '305.87', '3', '27', '2016-04-27', '2016-05-26', 'MENSAL', '3064deb21513ebb41b98cfa60943333c', '2016-04-27 18:20:50', '2016-04-27 19:20:50', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('11037', '5', '3', '10078', '97.00', null, '3', '28', '2016-04-28', '2016-05-27', 'MENSAL', '7e160f85be620cec0bf104a06412594d', '2016-04-28 19:08:43', '2016-04-28 20:08:43', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('11038', '5', '8', '10079', '2467.00', null, '5', '06', '2016-05-06', '2016-06-05', 'MENSAL', '033cca86e075e239a0f0ec5f57c7817680a04ef5', '2016-05-06 16:43:00', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11039', '2', '2', '10080', '47.00', null, '2', '06', '2016-05-06', '2016-06-05', 'MENSAL', '9872f42f870b5acf3441e33c4b7ce94f64d6bc96', '2016-05-06 16:43:08', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11041', '15', '1', null, null, null, '5', '20', '2016-05-20', '2016-06-19', 'MENSAL', null, '2016-05-20 00:00:08', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11042', '25', '1', null, null, null, '5', '23', '2016-05-23', '2016-06-22', 'MENSAL', null, '2016-05-23 02:11:18', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11043', '7', '1', null, null, null, '5', '05', '2016-07-05', '2016-08-04', 'MENSAL', null, '2016-07-05 14:19:58', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11044', '5', '8', '10082', '2467.00', null, '5', '06', '2016-07-06', '2016-08-05', 'MENSAL', '7c151c12a0d7f9ac82f1678ac7bcb7837912f8ce', '2016-07-06 00:00:09', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11045', '2', '2', '10083', '47.00', null, '2', '06', '2016-07-06', '2016-08-05', 'MENSAL', 'a26c88fb2fb67a63b51a7d3cefae8872dfbaa7f7', '2016-07-06 00:00:18', null, '0', 'AUTOMATICA');
INSERT INTO `shop_fatura` VALUES ('11046', '5', '1', '10084', '0.00', null, '3', '14', '2016-10-14', '2016-11-13', 'MENSAL', '888e1ec30b9e4eeaacd2f32839f0e6ba', '2016-10-14 22:36:36', '2016-10-14 23:36:36', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('11047', '5', '3', '10085', '97.00', null, '3', '14', '2016-10-14', '2016-11-13', 'MENSAL', '94b7b37649ab20ee50596062e7f4d568', '2016-10-14 22:37:06', '2016-10-14 23:37:06', '0', 'MANUAL');
INSERT INTO `shop_fatura` VALUES ('11048', '5', '5', '10086', '397.00', null, '3', '21', '2016-10-21', '2016-11-20', 'MENSAL', '1c7fc1c3ccc48bf3d3a230b311aef6ac', '2016-10-21 04:14:41', '2016-10-21 05:14:41', '0', 'MANUAL');

-- ----------------------------
-- Table structure for shop_fatura_config
-- ----------------------------
DROP TABLE IF EXISTS `shop_fatura_config`;
CREATE TABLE `shop_fatura_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_plano` smallint(6) NOT NULL DEFAULT '1',
  `periodicidade` enum('ANUAL','SEMESTRAL','TRIMESTRAL','MENSAL') DEFAULT 'MENSAL',
  `dia_mes_free` smallint(2) DEFAULT '1',
  `dia_mes_pay` smallint(2) DEFAULT '1',
  `vigencia_begin` date DEFAULT NULL,
  `vigencia_end` date DEFAULT NULL,
  `data_status_fatura_free` date DEFAULT NULL,
  `data_status_fatura_pay` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `shop_fatura_config_fk_1_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='INSERT INTO `shop_data_fatura` (`dia_mes_free`) VALUES ( DAYOFMONTH( CURDATE() ) );';

-- ----------------------------
-- Records of shop_fatura_config
-- ----------------------------
INSERT INTO `shop_fatura_config` VALUES ('1', '5', '8', 'MENSAL', '6', '6', null, null, '2014-07-06', '2016-07-06', '2014-07-01 23:21:07', '2016-07-05 22:00:09');
INSERT INTO `shop_fatura_config` VALUES ('2', '2', '2', 'MENSAL', '6', '6', null, null, '2014-07-01', '2016-07-06', null, '2016-07-05 22:00:18');
INSERT INTO `shop_fatura_config` VALUES ('4', '7', '1', 'MENSAL', '5', '1', null, null, '2016-07-05', '2016-07-06', '2014-09-05 22:45:55', '2016-10-22 22:36:06');
INSERT INTO `shop_fatura_config` VALUES ('6', '15', '1', 'MENSAL', '20', '1', null, null, '2016-05-20', '2016-07-06', '2016-04-20 23:55:09', '2016-10-22 22:36:17');
INSERT INTO `shop_fatura_config` VALUES ('19', '25', '1', 'MENSAL', '23', '1', null, null, '2016-05-23', '2016-07-06', '2016-04-23 02:01:29', '2016-10-22 22:36:17');
INSERT INTO `shop_fatura_config` VALUES ('20', '5', '1', 'MENSAL', '20', '1', null, null, '2016-07-06', '2016-07-06', '2016-10-20 23:34:08', '2016-10-22 22:36:18');
INSERT INTO `shop_fatura_config` VALUES ('21', '5', '1', 'MENSAL', '21', '1', null, null, '2016-07-06', '2016-07-06', '2016-10-21 00:55:59', '2016-10-22 22:36:18');

-- ----------------------------
-- Table structure for shop_fatura_credito
-- ----------------------------
DROP TABLE IF EXISTS `shop_fatura_credito`;
CREATE TABLE `shop_fatura_credito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `valido` enum('False','True') DEFAULT 'True',
  `created` datetime DEFAULT NULL,
  `data_utilizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_fatura_credito_fk_1_idx` (`id_shop_default`)) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of shop_fatura_credito
-- ----------------------------
INSERT INTO `shop_fatura_credito` VALUES ('1', '5', '434.81', 'True', '2014-07-08 22:35:01', null);
INSERT INTO `shop_fatura_credito` VALUES ('2', '5', '2.03', 'True', '2014-07-14 23:13:23', null);
INSERT INTO `shop_fatura_credito` VALUES ('3', '5', '170.63', 'True', '2016-04-28 19:08:43', null);

-- ----------------------------
-- Table structure for shop_fatura_referencia
-- ----------------------------
DROP TABLE IF EXISTS `shop_fatura_referencia`;
CREATE TABLE `shop_fatura_referencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_fatura_referencia_fk_1_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=10087 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_fatura_referencia
-- ----------------------------
INSERT INTO `shop_fatura_referencia` VALUES ('10000', '5', '2014-07-06 23:09:13');
INSERT INTO `shop_fatura_referencia` VALUES ('10001', '5', '2014-07-06 23:10:03');
INSERT INTO `shop_fatura_referencia` VALUES ('10002', '5', '2014-07-06 23:18:10');
INSERT INTO `shop_fatura_referencia` VALUES ('10003', '5', '2014-07-06 23:19:05');
INSERT INTO `shop_fatura_referencia` VALUES ('10004', '5', '2014-07-06 23:19:27');
INSERT INTO `shop_fatura_referencia` VALUES ('10005', '5', '2014-07-06 23:23:48');
INSERT INTO `shop_fatura_referencia` VALUES ('10006', '5', '2014-07-06 23:24:48');
INSERT INTO `shop_fatura_referencia` VALUES ('10007', '5', '2014-07-06 23:25:59');
INSERT INTO `shop_fatura_referencia` VALUES ('10008', '5', '2014-07-06 23:26:31');
INSERT INTO `shop_fatura_referencia` VALUES ('10009', '5', '2014-07-06 23:26:55');
INSERT INTO `shop_fatura_referencia` VALUES ('10010', '5', '2014-07-06 23:43:48');
INSERT INTO `shop_fatura_referencia` VALUES ('10011', '5', '2014-07-06 23:49:08');
INSERT INTO `shop_fatura_referencia` VALUES ('10012', '5', '2014-07-06 23:49:36');
INSERT INTO `shop_fatura_referencia` VALUES ('10013', '5', '2014-07-06 23:53:58');
INSERT INTO `shop_fatura_referencia` VALUES ('10014', '5', '2014-07-07 00:10:43');
INSERT INTO `shop_fatura_referencia` VALUES ('10015', '5', '2014-07-07 00:12:04');
INSERT INTO `shop_fatura_referencia` VALUES ('10016', '5', '2014-07-07 00:13:02');
INSERT INTO `shop_fatura_referencia` VALUES ('10017', '5', '2014-07-07 10:25:00');
INSERT INTO `shop_fatura_referencia` VALUES ('10018', '5', '2014-07-07 23:07:15');
INSERT INTO `shop_fatura_referencia` VALUES ('10019', '5', '2014-07-08 12:23:36');
INSERT INTO `shop_fatura_referencia` VALUES ('10020', '5', '2014-07-08 12:28:14');
INSERT INTO `shop_fatura_referencia` VALUES ('10021', '5', '2014-07-08 12:33:02');
INSERT INTO `shop_fatura_referencia` VALUES ('10022', '5', '2014-07-08 13:01:00');
INSERT INTO `shop_fatura_referencia` VALUES ('10023', '5', '2014-07-08 13:12:57');
INSERT INTO `shop_fatura_referencia` VALUES ('10024', '5', '2014-07-08 13:23:19');
INSERT INTO `shop_fatura_referencia` VALUES ('10025', '5', '2014-07-08 13:25:06');
INSERT INTO `shop_fatura_referencia` VALUES ('10026', '5', '2014-07-08 13:26:12');
INSERT INTO `shop_fatura_referencia` VALUES ('10027', '5', '2014-07-08 13:46:48');
INSERT INTO `shop_fatura_referencia` VALUES ('10028', '5', '2014-07-08 14:07:38');
INSERT INTO `shop_fatura_referencia` VALUES ('10029', '5', '2014-07-08 14:09:32');
INSERT INTO `shop_fatura_referencia` VALUES ('10030', '5', '2014-07-08 14:10:12');
INSERT INTO `shop_fatura_referencia` VALUES ('10031', '5', '2014-07-08 15:45:30');
INSERT INTO `shop_fatura_referencia` VALUES ('10032', '5', '2014-07-08 15:45:50');
INSERT INTO `shop_fatura_referencia` VALUES ('10033', '5', '2014-07-08 15:47:34');
INSERT INTO `shop_fatura_referencia` VALUES ('10034', '5', '2014-07-08 15:48:33');
INSERT INTO `shop_fatura_referencia` VALUES ('10035', '5', '2014-07-08 15:49:25');
INSERT INTO `shop_fatura_referencia` VALUES ('10036', '5', '2014-07-08 16:17:44');
INSERT INTO `shop_fatura_referencia` VALUES ('10037', '5', '2014-07-08 16:23:13');
INSERT INTO `shop_fatura_referencia` VALUES ('10038', '5', '2014-07-08 16:24:18');
INSERT INTO `shop_fatura_referencia` VALUES ('10039', '5', '2014-07-08 16:24:55');
INSERT INTO `shop_fatura_referencia` VALUES ('10040', '5', '2014-07-08 21:39:39');
INSERT INTO `shop_fatura_referencia` VALUES ('10041', '5', '2014-07-08 22:26:37');
INSERT INTO `shop_fatura_referencia` VALUES ('10042', '5', '2014-07-08 22:29:12');
INSERT INTO `shop_fatura_referencia` VALUES ('10043', '5', '2014-07-08 22:30:29');
INSERT INTO `shop_fatura_referencia` VALUES ('10044', '5', '2014-07-08 22:35:01');
INSERT INTO `shop_fatura_referencia` VALUES ('10045', '5', '2014-07-14 23:13:23');
INSERT INTO `shop_fatura_referencia` VALUES ('10046', '5', '2015-01-29 15:39:41');
INSERT INTO `shop_fatura_referencia` VALUES ('10047', '5', '2016-02-29 15:41:27');
INSERT INTO `shop_fatura_referencia` VALUES ('10048', '5', '2016-02-29 17:09:19');
INSERT INTO `shop_fatura_referencia` VALUES ('10049', '5', '2016-01-30 17:10:31');
INSERT INTO `shop_fatura_referencia` VALUES ('10050', '5', '2015-06-01 19:09:02');
INSERT INTO `shop_fatura_referencia` VALUES ('10051', '5', '2015-06-05 15:17:52');
INSERT INTO `shop_fatura_referencia` VALUES ('10052', '5', '2015-06-05 15:31:19');
INSERT INTO `shop_fatura_referencia` VALUES ('10053', '5', '2015-06-05 15:32:07');
INSERT INTO `shop_fatura_referencia` VALUES ('10054', '5', '2015-06-05 15:32:28');
INSERT INTO `shop_fatura_referencia` VALUES ('10055', '5', '2015-06-05 15:44:56');
INSERT INTO `shop_fatura_referencia` VALUES ('10056', '5', '2015-06-05 15:45:51');
INSERT INTO `shop_fatura_referencia` VALUES ('10057', '5', '2015-06-05 16:50:19');
INSERT INTO `shop_fatura_referencia` VALUES ('10058', '5', '2015-06-05 17:37:12');
INSERT INTO `shop_fatura_referencia` VALUES ('10059', '5', '2015-06-05 17:41:20');
INSERT INTO `shop_fatura_referencia` VALUES ('10060', '5', '2015-06-05 17:42:25');
INSERT INTO `shop_fatura_referencia` VALUES ('10061', '5', '2015-06-05 17:43:14');
INSERT INTO `shop_fatura_referencia` VALUES ('10062', '5', '2015-06-05 17:52:57');
INSERT INTO `shop_fatura_referencia` VALUES ('10063', '5', '2015-06-05 18:09:48');
INSERT INTO `shop_fatura_referencia` VALUES ('10064', '5', '2015-08-06 00:00:08');
INSERT INTO `shop_fatura_referencia` VALUES ('10065', '2', '2015-08-06 00:00:18');
INSERT INTO `shop_fatura_referencia` VALUES ('10067', '5', '2015-08-08 20:32:47');
INSERT INTO `shop_fatura_referencia` VALUES ('10068', '5', '2015-08-08 20:36:12');
INSERT INTO `shop_fatura_referencia` VALUES ('10069', '5', '2015-09-20 01:54:45');
INSERT INTO `shop_fatura_referencia` VALUES ('10070', '5', '2015-09-20 01:55:15');
INSERT INTO `shop_fatura_referencia` VALUES ('10071', '5', '2016-01-06 00:00:08');
INSERT INTO `shop_fatura_referencia` VALUES ('10072', '2', '2016-01-06 00:00:18');
INSERT INTO `shop_fatura_referencia` VALUES ('10074', '5', '2016-04-06 03:05:28');
INSERT INTO `shop_fatura_referencia` VALUES ('10075', '2', '2016-04-06 03:05:38');
INSERT INTO `shop_fatura_referencia` VALUES ('10077', '5', '2016-04-27 18:20:50');
INSERT INTO `shop_fatura_referencia` VALUES ('10078', '5', '2016-04-28 19:08:43');
INSERT INTO `shop_fatura_referencia` VALUES ('10079', '5', '2016-05-06 16:43:00');
INSERT INTO `shop_fatura_referencia` VALUES ('10080', '2', '2016-05-06 16:43:08');
INSERT INTO `shop_fatura_referencia` VALUES ('10082', '5', '2016-07-06 00:00:09');
INSERT INTO `shop_fatura_referencia` VALUES ('10083', '2', '2016-07-06 00:00:18');
INSERT INTO `shop_fatura_referencia` VALUES ('10084', '5', '2016-10-14 22:36:36');
INSERT INTO `shop_fatura_referencia` VALUES ('10085', '5', '2016-10-14 22:37:06');
INSERT INTO `shop_fatura_referencia` VALUES ('10086', '5', '2016-10-21 04:14:41');

-- ----------------------------
-- Table structure for shop_frete_gratis
-- ----------------------------
DROP TABLE IF EXISTS `shop_frete_gratis`;
CREATE TABLE `shop_frete_gratis` (
  `id_frete` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `regiao_name` char(15) NOT NULL,
  `regiao_valor` decimal(10,2) DEFAULT NULL,
  `ativo` tinyint(4) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id_frete`),
  UNIQUE KEY `frete_gratis_1_idx` (`id_shop_default`,`regiao_name`),
  KEY `shop_frete_gratis_fk_1_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_frete_gratis
-- ----------------------------
INSERT INTO `shop_frete_gratis` VALUES ('87', '5', 'nordeste', '10.00', '1', '2016-10-24 14:52:41');
INSERT INTO `shop_frete_gratis` VALUES ('88', '5', 'norte', '10000.00', '1', '2016-10-24 14:52:41');

-- ----------------------------
-- Table structure for shop_grade
-- ----------------------------
DROP TABLE IF EXISTS `shop_grade`;
CREATE TABLE `shop_grade` (
  `id_grade` int(11) NOT NULL AUTO_INCREMENT,
  `grade_default` int(11) NOT NULL DEFAULT '2',
  `id_shop_default` int(11) DEFAULT NULL,
  `nome` varchar(128) NOT NULL,
  `tipo` varchar(128) DEFAULT NULL,
  `default` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_grade`),
  UNIQUE KEY `nome_Unique` (`id_shop_default`,`nome`),
  KEY `shop_grade_fk_1_idx` (`id_shop_default`)) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_grade
-- ----------------------------
INSERT INTO `shop_grade` VALUES ('1', '1', null, 'Gênero', 'Gênero', '1', '2014-07-15 15:41:42', '2014-07-15 16:41:48');
INSERT INTO `shop_grade` VALUES ('2', '1', null, 'Produto com uma cor', 'Cor', '1', '2014-07-15 15:41:42', '2014-07-15 16:41:51');
INSERT INTO `shop_grade` VALUES ('3', '1', null, 'Produto com duas cores', 'Cor', '1', '2014-07-15 15:41:42', '2014-07-15 16:41:51');
INSERT INTO `shop_grade` VALUES ('4', '1', null, 'Tamanho de anel/aliança', 'Tamanho ', '1', '2014-07-15 15:41:42', '2014-07-15 16:41:51');
INSERT INTO `shop_grade` VALUES ('5', '1', null, 'Tamanho de calça', 'Tamanho ', '1', '2014-07-15 15:41:42', '2014-07-15 16:41:52');
INSERT INTO `shop_grade` VALUES ('6', '1', null, 'Tamanho de camisa/camiseta', 'Tamanho ', '1', '2014-07-15 15:41:42', '2014-07-15 16:41:55');
INSERT INTO `shop_grade` VALUES ('7', '1', null, 'Tamanho de capacete', 'Tamanho ', '1', '2014-07-15 15:41:42', '2014-07-15 16:41:53');
INSERT INTO `shop_grade` VALUES ('8', '1', null, 'Tamanho de tênis', 'Tamanho', '1', '2014-07-15 15:41:42', '2014-07-15 16:41:53');
INSERT INTO `shop_grade` VALUES ('9', '1', null, 'Voltagem', 'Voltagem', '1', '2014-07-15 15:41:42', '2014-07-15 16:41:42');
INSERT INTO `shop_grade` VALUES ('12', '2', '5', 'Cursos', null, null, '2016-04-22 01:44:26', '2016-08-11 04:58:25');

-- ----------------------------
-- Table structure for shop_grade_variacao
-- ----------------------------
DROP TABLE IF EXISTS `shop_grade_variacao`;
CREATE TABLE `shop_grade_variacao` (
  `id_variacao` int(11) NOT NULL AUTO_INCREMENT,
  `id_grade_default` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `hex` char(7) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_variacao`),
  UNIQUE KEY `nome_Unique` (`id_grade_default`,`nome`),
  KEY `shop_grade_variacao_fk_1_idx` (`id_grade_default`)) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_grade_variacao
-- ----------------------------
INSERT INTO `shop_grade_variacao` VALUES ('1', '1', 'Feminino', null, '2014-07-15 16:18:02', null);
INSERT INTO `shop_grade_variacao` VALUES ('2', '1', 'Masculino', null, '2014-07-15 16:18:26', '2014-07-15 20:27:56');
INSERT INTO `shop_grade_variacao` VALUES ('3', '4', '10', null, '2014-07-15 16:19:32', null);
INSERT INTO `shop_grade_variacao` VALUES ('4', '4', '11', null, '2014-07-15 16:22:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('5', '4', '12', null, '2014-07-15 16:22:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('6', '4', '13', null, '2014-07-15 16:22:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('7', '4', '14', null, '2014-07-15 16:22:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('8', '4', '15', null, '2014-07-15 16:22:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('9', '4', '16', null, '2014-07-15 16:22:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('10', '4', '17', null, '2014-07-15 16:22:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('11', '4', '18', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('12', '4', '19', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('13', '4', '20', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('14', '4', '21', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('15', '4', '22', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('16', '4', '23', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('17', '4', '24', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('18', '4', '25', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('19', '4', '26', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('20', '4', '27', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('21', '4', '28', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('22', '4', '29', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('23', '4', '30', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('24', '4', '31', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('25', '4', '32', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('26', '4', '33', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('27', '4', '34', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('28', '4', '35', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('29', '4', '36', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('30', '4', '37', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('31', '4', '38', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('32', '4', '39', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('33', '4', '40', null, '2014-07-15 16:22:51', null);
INSERT INTO `shop_grade_variacao` VALUES ('34', '5', '34', null, '2014-07-15 16:23:41', null);
INSERT INTO `shop_grade_variacao` VALUES ('35', '5', '36', null, '2014-07-15 16:23:41', null);
INSERT INTO `shop_grade_variacao` VALUES ('36', '5', '38', null, '2014-07-15 16:23:41', null);
INSERT INTO `shop_grade_variacao` VALUES ('37', '5', '40', null, '2014-07-15 16:23:41', null);
INSERT INTO `shop_grade_variacao` VALUES ('38', '5', '42', null, '2014-07-15 16:23:41', null);
INSERT INTO `shop_grade_variacao` VALUES ('39', '5', '44', null, '2014-07-15 16:23:41', null);
INSERT INTO `shop_grade_variacao` VALUES ('40', '5', '46', null, '2014-07-15 16:23:42', null);
INSERT INTO `shop_grade_variacao` VALUES ('41', '5', '48', null, '2014-07-15 16:23:42', null);
INSERT INTO `shop_grade_variacao` VALUES ('42', '5', '50', null, '2014-07-15 16:23:42', null);
INSERT INTO `shop_grade_variacao` VALUES ('43', '5', '52', null, '2014-07-15 16:23:42', null);
INSERT INTO `shop_grade_variacao` VALUES ('44', '5', '54', null, '2014-07-15 16:23:42', null);
INSERT INTO `shop_grade_variacao` VALUES ('45', '5', '56', null, '2014-07-15 16:23:42', null);
INSERT INTO `shop_grade_variacao` VALUES ('46', '5', '58', null, '2014-07-15 16:23:42', null);
INSERT INTO `shop_grade_variacao` VALUES ('47', '5', '60', null, '2014-07-15 16:23:42', null);
INSERT INTO `shop_grade_variacao` VALUES ('48', '6', '1', null, '2014-07-15 16:25:06', null);
INSERT INTO `shop_grade_variacao` VALUES ('49', '6', '2', null, '2014-07-15 16:25:06', null);
INSERT INTO `shop_grade_variacao` VALUES ('50', '6', '3', null, '2014-07-15 16:25:06', null);
INSERT INTO `shop_grade_variacao` VALUES ('51', '6', '4', null, '2014-07-15 16:25:06', null);
INSERT INTO `shop_grade_variacao` VALUES ('52', '6', '5', null, '2014-07-15 16:25:06', null);
INSERT INTO `shop_grade_variacao` VALUES ('53', '6', 'G', null, '2014-07-15 16:25:06', null);
INSERT INTO `shop_grade_variacao` VALUES ('54', '6', 'GG', null, '2014-07-15 16:25:06', null);
INSERT INTO `shop_grade_variacao` VALUES ('55', '6', 'M', null, '2014-07-15 16:25:06', null);
INSERT INTO `shop_grade_variacao` VALUES ('56', '6', 'P', null, '2014-07-15 16:25:07', null);
INSERT INTO `shop_grade_variacao` VALUES ('57', '6', 'PP', null, '2014-07-15 16:25:07', null);
INSERT INTO `shop_grade_variacao` VALUES ('58', '6', 'U', null, '2014-07-15 16:25:07', null);
INSERT INTO `shop_grade_variacao` VALUES ('59', '6', 'XG', null, '2014-07-15 16:25:07', null);
INSERT INTO `shop_grade_variacao` VALUES ('60', '6', 'XGG', null, '2014-07-15 16:25:07', null);
INSERT INTO `shop_grade_variacao` VALUES ('61', '7', '53-54', null, '2014-07-15 16:26:08', null);
INSERT INTO `shop_grade_variacao` VALUES ('62', '7', '55-56', null, '2014-07-15 16:26:08', null);
INSERT INTO `shop_grade_variacao` VALUES ('63', '7', '57-58', null, '2014-07-15 16:26:08', null);
INSERT INTO `shop_grade_variacao` VALUES ('64', '7', '59-60', null, '2014-07-15 16:26:09', null);
INSERT INTO `shop_grade_variacao` VALUES ('65', '7', '61-62', null, '2014-07-15 16:26:09', null);
INSERT INTO `shop_grade_variacao` VALUES ('66', '7', '63-64', null, '2014-07-15 16:26:09', null);
INSERT INTO `shop_grade_variacao` VALUES ('67', '8', '16', null, '2014-07-15 16:26:48', null);
INSERT INTO `shop_grade_variacao` VALUES ('68', '8', '17', null, '2014-07-15 16:26:48', null);
INSERT INTO `shop_grade_variacao` VALUES ('69', '8', '18', null, '2014-07-15 16:26:48', null);
INSERT INTO `shop_grade_variacao` VALUES ('70', '8', '19', null, '2014-07-15 16:26:48', null);
INSERT INTO `shop_grade_variacao` VALUES ('71', '8', '20', null, '2014-07-15 16:26:48', null);
INSERT INTO `shop_grade_variacao` VALUES ('72', '8', '21', null, '2014-07-15 16:26:49', null);
INSERT INTO `shop_grade_variacao` VALUES ('73', '8', '22', null, '2014-07-15 16:26:49', null);
INSERT INTO `shop_grade_variacao` VALUES ('74', '8', '23', null, '2014-07-15 16:26:49', null);
INSERT INTO `shop_grade_variacao` VALUES ('75', '8', '24', null, '2014-07-15 16:26:49', null);
INSERT INTO `shop_grade_variacao` VALUES ('76', '8', '25', null, '2014-07-15 16:26:49', null);
INSERT INTO `shop_grade_variacao` VALUES ('77', '8', '26', null, '2014-07-15 16:26:49', null);
INSERT INTO `shop_grade_variacao` VALUES ('78', '8', '27', null, '2014-07-15 16:26:49', null);
INSERT INTO `shop_grade_variacao` VALUES ('79', '8', '28', null, '2014-07-15 16:26:49', null);
INSERT INTO `shop_grade_variacao` VALUES ('80', '8', '29', null, '2014-07-15 16:26:49', null);
INSERT INTO `shop_grade_variacao` VALUES ('81', '8', '30', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('82', '8', '31', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('83', '8', '32', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('84', '8', '33', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('85', '8', '34', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('86', '8', '35', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('87', '8', '36', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('88', '8', '37', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('89', '8', '38', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('90', '8', '39', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('91', '8', '40', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('92', '8', '41', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('93', '8', '42', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('94', '8', '43', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('95', '8', '44', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('96', '8', '45', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('97', '8', '46', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('98', '8', '47', null, '2014-07-15 16:26:50', null);
INSERT INTO `shop_grade_variacao` VALUES ('99', '9', '110V', null, '2014-07-15 16:26:50', '2016-08-11 16:16:52');
INSERT INTO `shop_grade_variacao` VALUES ('100', '9', '220V', null, '2014-07-15 16:26:50', '2016-08-11 16:18:12');
INSERT INTO `shop_grade_variacao` VALUES ('102', '2', 'Creme', '#FFF2CC', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('103', '2', 'Marrom', '#B45F06', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('104', '2', 'Vermelho', '#FF0000', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('105', '2', 'Cinza Claro', '#CCCCCC', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('106', '2', 'Púrpura', '#741B47', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('107', '2', 'Laranja', '#FF9900', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('108', '2', 'Fúcsia', '#E828FF', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('109', '2', 'Lilás', '#8E7CC3', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('110', '2', 'Marrom amarelado', '#F6B26B', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('111', '2', 'Ciano escuro', '#76A5AF', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('112', '2', 'Verde escuro', '#38761D', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('113', '2', 'Rosa', '#F4CCCC', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('114', '2', 'Esmeralda', '#93C47D', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('115', '2', 'Salmão', '#EAD1DC', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('116', '2', 'Verde', '#0C9800', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('117', '2', 'Fúcsia escuro', '#C27BA0', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('118', '2', 'Dourado', '#BF9000', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('119', '2', 'Lavanda', '#D9D2E9', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('120', '2', 'Água', '#83DDFF', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('121', '2', 'Azul Céu', '#D0E0E3', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('122', '2', 'Preto', '#000000', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('123', '2', 'Azul', '#1717FF', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('124', '2', 'Azul claro', '#CFE2F3', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('125', '2', 'Azul aço', '#6FA8DC', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('126', '2', 'Vermelho escuro', '#990000', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('127', '2', 'Azul escuro', '#0B5394', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('128', '2', 'Índigo', '#351C75', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('129', '2', 'Branco', '#FFFFFF', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('130', '2', 'Branco Navajo', '#FCE5CD', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('131', '2', 'Mocassim', '#FFD966', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('132', '2', 'Azul petróleo', '#134F5C', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('133', '2', 'Amarelo', '#FFFF00', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('134', '2', 'Terracota', '#E06666', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('135', '2', 'Violeta escuro', '#7600FF', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('136', '2', 'Cinza', '#666666', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('137', '2', 'Verde claro', '#D9EAD3', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('138', '3', 'Creme', '#FFF2CC', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('139', '3', 'Marrom', '#B45F06', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('140', '3', 'Vermelho', '#FF0000', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('141', '3', 'Cinza Claro', '#CCCCCC', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('142', '3', 'Púrpura', '#741B47', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('143', '3', 'Laranja', '#FF9900', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('144', '3', 'Fúcsia', '#E828FF', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('145', '3', 'Lilás', '#8E7CC3', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('146', '3', 'Marrom amarelado', '#F6B26B', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('147', '3', 'Ciano escuro', '#76A5AF', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('148', '3', 'Verde escuro', '#38761D', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('149', '3', 'Rosa', '#F4CCCC', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('150', '3', 'Esmeralda', '#93C47D', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('151', '3', 'Salmão', '#EAD1DC', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('152', '3', 'Verde', '#0C9800', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('153', '3', 'Fúcsia escuro', '#C27BA0', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('154', '3', 'Dourado', '#BF9000', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('155', '3', 'Lavanda', '#D9D2E9', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('156', '3', 'Água', '#83DDFF', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('157', '3', 'Azul Céu', '#D0E0E3', null, '2015-04-25 18:18:45');
INSERT INTO `shop_grade_variacao` VALUES ('158', '3', 'Preto', '#000000', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('159', '3', 'Azul', '#1717FF', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('160', '3', 'Azul claro', '#CFE2F3', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('161', '3', 'Azul aço', '#6FA8DC', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('162', '3', 'Vermelho escuro', '#990000', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('163', '3', 'Azul escuro', '#0B5394', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('164', '3', 'Índigo', '#351C75', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('165', '3', 'Branco', '#FFFFFF', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('166', '3', 'Branco Navajo', '#FCE5CD', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('167', '3', 'Mocassim', '#FFD966', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('168', '3', 'Azul petróleo', '#134F5C', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('169', '3', 'Amarelo', '#FFFF00', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('170', '3', 'Terracota', '#E06666', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('171', '3', 'Violeta escuro', '#7600FF', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('172', '3', 'Cinza', '#666666', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('173', '3', 'Verde claro', '#D9EAD3', null, null);
INSERT INTO `shop_grade_variacao` VALUES ('186', '12', 'Autismo', null, '2016-04-22 01:44:40', '2016-04-22 02:44:40');

-- ----------------------------
-- Table structure for shop_marca
-- ----------------------------
DROP TABLE IF EXISTS `shop_marca`;
CREATE TABLE `shop_marca` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `ativo` enum('False','True') DEFAULT 'True',
  `destaque` enum('False','True') DEFAULT 'False',
  `nome` varchar(128) NOT NULL,
  `apelido` varchar(128) NOT NULL,
  `url` varchar(128) DEFAULT NULL,
  `descricao` text,
  `logo` varchar(128) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_marca`),
  UNIQUE KEY `marca_Unique` (`id_shop_default`,`nome`) USING BTREE,
  KEY `shop_marca_fk_1_idx` (`id_shop_default`),
  KEY `ativo` (`ativo`)) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_marca
-- ----------------------------
INSERT INTO `shop_marca` VALUES ('13', '5', 'True', 'False', 'Polo Teste', 'polo-teste', null, null, null, '2016-09-01 03:08:58', '2016-09-01 04:08:58');
INSERT INTO `shop_marca` VALUES ('14', '5', 'True', 'False', 'Cargo Teste', 'cargo-teste', null, null, null, '2016-09-01 03:08:59', '2016-09-01 04:08:59');
INSERT INTO `shop_marca` VALUES ('15', '5', 'True', 'False', 'Alta Books Teste', 'alta-books-teste', null, null, null, '2016-09-01 03:08:59', '2016-09-01 04:08:59');

-- ----------------------------
-- Table structure for shop_pagamento
-- ----------------------------
DROP TABLE IF EXISTS `shop_pagamento`;
CREATE TABLE `shop_pagamento` (
  `id_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_config_pagamento` int(11) unsigned NOT NULL,
  `ativo` enum('False','True') DEFAULT 'False',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pagamento`),
  UNIQUE KEY `shop_pagamento` (`id_shop_default`,`id_config_pagamento`),
  KEY `shop_pagamento_fk_1_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_pagamento
-- ----------------------------
INSERT INTO `shop_pagamento` VALUES ('19', '15', '4', 'True', '2016-04-20 23:55:08', '2016-04-21 00:55:08');
INSERT INTO `shop_pagamento` VALUES ('20', '15', '5', 'True', '2016-04-20 23:55:08', '2016-04-21 00:55:08');
INSERT INTO `shop_pagamento` VALUES ('32', '25', '3', 'True', '2016-04-23 03:39:30', '2016-04-23 04:39:30');
INSERT INTO `shop_pagamento` VALUES ('39', '5', '3', 'True', '2016-10-21 03:47:40', '2016-10-21 04:47:40');

-- ----------------------------
-- Table structure for shop_pagamento_boleto
-- ----------------------------
DROP TABLE IF EXISTS `shop_pagamento_boleto`;
CREATE TABLE `shop_pagamento_boleto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_config_pagamento` int(11) NOT NULL,
  `id_pagamento_default` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_pagamento_boleto_Unique` (`id_shop_default`,`id_config_pagamento`,`id_pagamento_default`) USING BTREE,
  KEY `shop_pagamento_boleto_fk_1_idx` (`id_shop_default`) USING BTREE,
  KEY `shop_pagamento_boleto_fk_2_idx` (`id_pagamento_default`) USING BTREE,
  KEY `shop_pagamento_boleto_fk_0_idx` (`id_config_pagamento`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of shop_pagamento_boleto
-- ----------------------------

-- ----------------------------
-- Table structure for shop_pagamento_deposito
-- ----------------------------
DROP TABLE IF EXISTS `shop_pagamento_deposito`;
CREATE TABLE `shop_pagamento_deposito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT NULL,
  `id_config_pagamento` int(11) DEFAULT NULL,
  `id_pagamento_default` int(11) DEFAULT NULL,
  `email_comprovante` varchar(255) DEFAULT NULL,
  `desconto` enum('on') DEFAULT NULL,
  `desconto_valor` decimal(10,2) DEFAULT NULL,
  `informacao_complementar` text,
  `aplicar_no_total` enum('on') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_pagamento_deposito_Unique` (`id_shop_default`,`id_config_pagamento`,`id_pagamento_default`) USING BTREE,
  KEY `shop_pagamento_deposito_fk_1_idx` (`id_shop_default`) USING BTREE,
  KEY `shop_pagamento_deposito_fk_2_idx` (`id_pagamento_default`) USING BTREE,
  KEY `shop_pagamento_deposito_fk_0_idx` (`id_config_pagamento`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_pagamento_deposito
-- ----------------------------

-- ----------------------------
-- Table structure for shop_pagamento_deposito_config
-- ----------------------------
DROP TABLE IF EXISTS `shop_pagamento_deposito_config`;
CREATE TABLE `shop_pagamento_deposito_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT NULL,
  `id_pagamento_deposito_default` int(11) DEFAULT NULL,
  `numero_banco_default` char(3) DEFAULT NULL,
  `ativo` enum('False','True') DEFAULT 'False',
  `agencia` varchar(128) DEFAULT NULL,
  `numero_conta` varchar(45) DEFAULT NULL,
  `operacao` char(3) DEFAULT NULL,
  `poupanca` varchar(45) DEFAULT NULL,
  `cpf_cnpj` varchar(128) DEFAULT NULL,
  `favorecido` varchar(128) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_pagamento_deposito_config_Unique` (`id_shop_default`,`id_pagamento_deposito_default`,`numero_banco_default`) USING BTREE,
  KEY `shop_pagamento_deposito_config_fk_2_idx` (`id_pagamento_deposito_default`) USING BTREE,
  KEY `shop_pagamento_deposito_config_fk_1_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of shop_pagamento_deposito_config
-- ----------------------------

-- ----------------------------
-- Table structure for shop_pagamento_facilitador
-- ----------------------------
DROP TABLE IF EXISTS `shop_pagamento_facilitador`;
CREATE TABLE `shop_pagamento_facilitador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `id_config_pagamento` int(11) DEFAULT NULL,
  `id_pagamento_default` int(11) DEFAULT NULL,
  `usuario` varchar(128) DEFAULT NULL,
  `token` varchar(128) DEFAULT NULL,
  `valor_minimo_aceitavel` decimal(10,2) DEFAULT NULL,
  `valor_minimo_parcela` decimal(10,2) DEFAULT NULL,
  `mostrar_parcelamento` enum('on') DEFAULT NULL,
  `maximo_parcelas` smallint(6) DEFAULT NULL,
  `parcelas_sem_juros` smallint(6) DEFAULT NULL,
  `li_msg` enum('on') DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_pagamento_facilitador_Unique` (`id_shop_default`,`id_pagamento_default`,`id_config_pagamento`) USING BTREE,
  KEY `shop_pagamento_facilitador_fk_1_idx` (`id_shop_default`) USING BTREE,
  KEY `shop_pagamento_facilitador_fk_2_idx` (`id_pagamento_default`),
  KEY `shop_pagamento_facilitador_fk_0_idx` (`id_config_pagamento`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_pagamento_facilitador
-- ----------------------------

-- ----------------------------
-- Table structure for shop_pagina
-- ----------------------------
DROP TABLE IF EXISTS `shop_pagina`;
CREATE TABLE `shop_pagina` (
  `id_pagina` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `ativo` enum('False','True') DEFAULT 'True',
  `titulo` varchar(128) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `conteudo` mediumtext,
  `posicao` tinyint(4) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modifield` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pagina`),
  UNIQUE KEY `url_Unique` (`id_shop_default`,`url`) USING BTREE,
  KEY `shop_pagina_FK_1_idx` (`id_shop_default`),
  KEY `ativo` (`ativo`)) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_pagina
-- ----------------------------
INSERT INTO `shop_pagina` VALUES ('11', '7', 'True', 'teste', 'teste', '&lt;p&gt;fsdf&lt;/p&gt;\r\n', '0', '2014-09-05 23:18:17', null);
INSERT INTO `shop_pagina` VALUES ('15', '5', 'True', 'Pedidos e Devoluções', 'pedidos-e-devolucoes', '&lt;p&gt;&lt;a href=&quot;http://styleshop.vialoja.com.br/#&quot;&gt;Pedidos e Devolu&amp;ccedil;&amp;otilde;es&lt;/a&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;tesrte&lt;/p&gt;\r\n', '0', '2015-02-11 22:55:21', null);

-- ----------------------------
-- Table structure for shop_pedido
-- ----------------------------
DROP TABLE IF EXISTS `shop_pedido`;
CREATE TABLE `shop_pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente_default` int(11) DEFAULT NULL,
  `id_shop_default` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_pedido
-- ----------------------------

-- ----------------------------
-- Table structure for shop_pedido_historico
-- ----------------------------
DROP TABLE IF EXISTS `shop_pedido_historico`;
CREATE TABLE `shop_pedido_historico` (
  `id_pedido_historico` int(11) NOT NULL,
  `id_pedido_default` int(11) DEFAULT NULL,
  `id_cliente_default` int(11) DEFAULT NULL,
  `id_shop_default` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pedido_historico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_pedido_historico
-- ----------------------------

-- ----------------------------
-- Table structure for shop_produto
-- ----------------------------
DROP TABLE IF EXISTS `shop_produto`;
CREATE TABLE `shop_produto` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT NULL,
  `parente_id` int(11) DEFAULT '0',
  `status_parente_id` enum('False','True') DEFAULT 'True',
  `id_marca` int(11) DEFAULT NULL,
  `tipo` enum('atributo','normal') DEFAULT NULL,
  `ativo` enum('False','True') DEFAULT 'True',
  `lixo` enum('True','False') DEFAULT 'False',
  `data_lixeira` date DEFAULT NULL,
  `usado` enum('False','True') DEFAULT 'False',
  `destaque` enum('False','True') DEFAULT 'False',
  `nome` varchar(128) NOT NULL,
  `apelido` varchar(128) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `sku` varchar(128) DEFAULT NULL,
  `ncm` char(10) DEFAULT NULL,
  `preco_sob_consulta` enum('True') DEFAULT NULL,
  `preco_custo` decimal(10,2) DEFAULT NULL,
  `preco_cheio` decimal(10,2) DEFAULT NULL,
  `preco_promocional` double(10,2) DEFAULT NULL,
  `busca_marca` varchar(255) DEFAULT NULL,
  `busca_categoria` varchar(255) DEFAULT NULL,
  `url_video_youtube` varchar(255) DEFAULT NULL,
  `descricao_completa` text,
  `title` varchar(70) DEFAULT NULL,
  `description` varchar(160) DEFAULT NULL,
  `peso` decimal(10,3) DEFAULT NULL,
  `altura` int(11) DEFAULT NULL,
  `largura` int(11) DEFAULT NULL,
  `comprimento` int(11) DEFAULT NULL,
  `gerenciado` enum('False','True') DEFAULT 'False',
  `situacao_em_estoque` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `reservado` int(11) DEFAULT '0',
  `total_vendido` int(11) DEFAULT '0',
  `situacao_sem_estoque` int(11) DEFAULT NULL,
  `renomear_imagem` enum('False','True') DEFAULT 'False',
  `tipo_importacao_xls` enum('insert','update') DEFAULT NULL,
  `produto_sex_shop` enum('False','True') DEFAULT 'False',
  `produto_key` char(32) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_produto`),
  UNIQUE KEY `sku_Unique` (`id_shop_default`,`sku`) USING BTREE,
  KEY `shop_produto_fk_1_idx` (`id_shop_default`),
  KEY `marca` (`id_marca`),
  KEY `ativo` (`ativo`),
  KEY `gerenciado` (`gerenciado`),
  KEY `parente_id` (`parente_id`) USING BTREE,
  KEY `preco_custo` (`preco_custo`),
  KEY `preco_cheio` (`preco_cheio`),
  KEY `preco_promocional` (`preco_promocional`),
  FULLTEXT KEY `nome_descricao` (`nome`,`descricao_completa`),
  FULLTEXT KEY `nome` (`nome`),
  FULLTEXT KEY `busca_interna_app` (`nome`,`descricao_completa`,`url`,`sku`)) ENGINE=InnoDB AUTO_INCREMENT=1179 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of shop_produto
-- ----------------------------
INSERT INTO `shop_produto` VALUES ('1171', '5', '0', 'True', '13', 'normal', 'True', 'False', null, 'False', 'False', 'Camiseta Marrom', 'camiseta-marrom', 'camiseta-marrom', '7P7EE868P130', null, null, '75.49', '169.00', '161.00', null, null, 'https://www.youtube.com/watch?v=w3Omp7Zymtg', 'Camisa masculina 100% algod&atilde;o.', null, null, '0.500', '15', '13', '13', 'False', '10', '0', '0', '0', '0', 'False', 'insert', 'False', 'a53984be540722aeeeb6191616b0a637', '2016-09-02 17:56:20', '2016-09-02 18:56:20');
INSERT INTO `shop_produto` VALUES ('1172', '5', '0', 'True', '14', 'normal', 'True', 'False', null, 'False', 'False', 'Cargo Camera Bag Large', 'cargo-camera-bag-large', 'cargo-camera-bag-large', 'N3B937VN4130', null, null, '108.00', '188.00', '172.80', null, null, 'https://www.youtube.com/watch?v=w3Omp7Zymtg', 'Esta bolsa lhe permite dar mais seguran&ccedil;a a sua c&acirc;mera. Seu design foi projetado para acomodar melhor o equipamento.', null, null, '2.000', '15', '13', '13', 'False', '10', '0', '0', '0', '0', 'False', 'insert', 'False', 'f9621e00f8e13347e1712b1269f3b2a5', '2016-09-02 17:56:20', '2016-09-02 18:56:20');
INSERT INTO `shop_produto` VALUES ('1173', '5', '0', 'True', '15', 'normal', 'True', 'False', null, 'True', 'False', 'Livro Construindo Sistemas Linux Embarcados', 'livro-construindo-sistemas-linux-embarcados', 'livro-construindo-sistemas-linux-embarcados', 'V3HCWQTSC130', null, null, '16.00', '46.00', '43.00', null, null, 'https://www.youtube.com/watch?v=QozCc2wX85U', 'Este &eacute; o livro para Linux embarcado. Embora muitas empresas usem o Linux em todo tipo de sistemas embarcados, h&aacute; poucas fontes de informa&ccedil;&atilde;o sobre a cria&ccedil;&atilde;o, instala&ccedil;&atilde;o e realiza&ccedil;&atilde;o de testes no kernel do Linux e nas ferramentas relacionadas a ele.', null, null, '0.800', '15', '20', '15', 'True', '10', '10', '0', '0', '10', 'False', 'insert', 'False', '43ab498b5e475b78ee2ff90c46856fc7', '2016-09-02 17:56:21', '2016-09-02 18:56:21');
INSERT INTO `shop_produto` VALUES ('1174', '5', '0', 'True', '16', 'normal', 'True', 'False', null, 'False', 'False', 'Business Holster', 'business-holster', 'business-holster', 'DV83PB4LT130', null, null, '21.00', '47.00', '39.00', null, null, 'https://www.youtube.com/watch?v=w3Omp7Zymtg', 'O Business Holster &eacute; um colete/coldre moderno que serve para guardar aparelhos como iPod ou smartphone, al&eacute;m da carteira, entre outros gadgets que pode ser usado por baixo do palit&oacute; de um terno ou jaqueta.', null, null, '0.300', '15', '16', '15', 'True', '10', '10', '0', '0', '0', 'False', 'insert', 'False', 'd4728a68c9b62ac8f165d9649b917943', '2016-09-02 17:56:21', '2016-09-02 18:56:21');
INSERT INTO `shop_produto` VALUES ('1175', '5', '0', 'True', '17', 'atributo', 'True', 'False', null, 'False', 'False', 'Button Pinguim', 'button-pinguim', 'button-pinguim', 'KNNT9GQSY130', null, null, '0.00', '0.00', '0.00', null, null, 'https://www.youtube.com/watch?v=QozCc2wX85U', 'Coisa linda este Button, muito bonito e barato!', null, null, '0.000', '0', '0', '0', 'False', '10', '0', '0', '0', '0', 'False', 'insert', 'False', 'a2884820e991814b8b9ef013b839cfe3', '2016-09-02 17:56:21', '2016-09-02 18:56:21');
INSERT INTO `shop_produto` VALUES ('1176', '5', '1175', 'True', '18', 'atributo', 'True', 'False', null, 'False', 'False', 'Button Pinguim', 'button-pinguim', 'button-pinguim', '7PWXWU6RE130', null, null, '5.00', '13.00', '0.00', null, null, null, 'Coisa linda este Button, muito bonito e barato!', null, null, '0.600', '9', '11', '11', 'True', '10', '35', '0', '0', '0', 'False', 'insert', 'False', 'a73a5e1b29b73c5787c7630d47443d53', '2016-09-02 17:56:21', '2016-09-02 18:56:21');
INSERT INTO `shop_produto` VALUES ('1177', '5', '1175', 'True', '18', 'atributo', 'True', 'False', null, 'False', 'False', 'Button Pinguim', 'button-pinguim', 'button-pinguim', '6ZM6ASBYJ130', null, null, '5.00', '1600.00', '0.00', null, null, null, 'Coisa linda este Button, muito bonito e barato!', null, null, '0.600', '9', '11', '11', 'True', '10', '50', '0', '0', '0', 'False', 'insert', 'False', '189744c8239babafd464c8165c25218d', '2016-09-02 17:56:21', '2016-09-02 18:56:21');
INSERT INTO `shop_produto` VALUES ('1178', '5', '1175', 'True', '18', 'atributo', 'True', 'False', null, 'False', 'False', 'Button Pinguim', 'button-pinguim', 'button-pinguim', '3H23SQCKZ130', null, null, '5.00', '21.00', '0.00', null, null, null, 'Coisa linda este Button, muito bonito e barato!', null, null, '0.600', '9', '11', '11', 'True', '10', '60', '0', '0', '0', 'False', 'insert', 'False', '5e44e5e50c45c04cd1c70cf1d90e6dbe', '2016-09-02 17:56:21', '2016-09-02 18:56:21');

-- ----------------------------
-- Table structure for shop_produto_categoria
-- ----------------------------
DROP TABLE IF EXISTS `shop_produto_categoria`;
CREATE TABLE `shop_produto_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto_default` int(11) NOT NULL,
  `id_categoria_default` int(11) NOT NULL,
  `categoria_primaria` enum('True') DEFAULT NULL,
  `categoria_secudaria` enum('True') DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `posicao` int(11) unsigned DEFAULT '0',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_produto_categoria_fk_1_idx` (`id_produto_default`),
  KEY `categoria` (`id_categoria_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of shop_produto_categoria
-- ----------------------------
INSERT INTO `shop_produto_categoria` VALUES ('2', '1171', '241', 'True', null, null, '0', '2016-09-02 17:56:20');
INSERT INTO `shop_produto_categoria` VALUES ('4', '1172', '243', 'True', null, null, '0', '2016-09-02 17:56:21');
INSERT INTO `shop_produto_categoria` VALUES ('7', '1173', '246', 'True', null, null, '0', '2016-09-02 17:56:21');
INSERT INTO `shop_produto_categoria` VALUES ('8', '1174', '247', 'True', null, null, '0', '2016-09-02 17:56:21');
INSERT INTO `shop_produto_categoria` VALUES ('9', '1176', '248', 'True', null, null, '0', '2016-09-02 17:56:21');
INSERT INTO `shop_produto_categoria` VALUES ('10', '1177', '248', 'True', null, null, '0', '2016-09-02 17:56:21');
INSERT INTO `shop_produto_categoria` VALUES ('11', '1178', '248', 'True', null, null, '0', '2016-09-02 17:56:21');

-- ----------------------------
-- Table structure for shop_produto_grade
-- ----------------------------
DROP TABLE IF EXISTS `shop_produto_grade`;
CREATE TABLE `shop_produto_grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_grade_default` int(11) NOT NULL,
  `id_produto_default` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `grade_Unique` (`id_grade_default`,`id_produto_default`),
  KEY `shop_produto_grade_fk_1_idx` (`id_produto_default`) USING BTREE,
  KEY `shop_produto_grade_fk_2_idx` (`id_grade_default`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_produto_grade
-- ----------------------------

-- ----------------------------
-- Table structure for shop_produto_hits
-- ----------------------------
DROP TABLE IF EXISTS `shop_produto_hits`;
CREATE TABLE `shop_produto_hits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto_default` int(11) NOT NULL,
  `id_shop_default` int(11) NOT NULL,
  `hits` int(11) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unique_produto_usuario` (`id_produto_default`,`id_shop_default`) USING BTREE,
  KEY `id_produto_default` (`id_produto_default`) USING BTREE,
  KEY `shop_produto_hits_fk_1_idx` (`id_produto_default`) USING BTREE,
  KEY `shop_produto_hits_fk_3_idx` (`id_shop_default`) USING BTREE,
  KEY `hits` (`hits`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of shop_produto_hits
-- ----------------------------

-- ----------------------------
-- Table structure for shop_produto_imagem
-- ----------------------------
DROP TABLE IF EXISTS `shop_produto_imagem`;
CREATE TABLE `shop_produto_imagem` (
  `id_imagem` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto_default` int(11) DEFAULT NULL,
  `nome_imagem` varchar(128) NOT NULL COMMENT 'Tamanho 85 x 108',
  `posicao` smallint(6) DEFAULT '0',
  `status` tinyint(4) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_imagem`),
  KEY `posicao` (`posicao`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_produto_imagem
-- ----------------------------

-- ----------------------------
-- Table structure for shop_produto_imagem_associada
-- ----------------------------
DROP TABLE IF EXISTS `shop_produto_imagem_associada`;
CREATE TABLE `shop_produto_imagem_associada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_imagem_default` int(11) NOT NULL,
  `id_produto_default` int(11) NOT NULL,
  `id_variacao_default` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_produto_imagem_associada_fk_1_idx` (`id_imagem_default`),
  KEY `shop_produto_imagem_associada_fk_2_idx` (`id_produto_default`),
  KEY `shop_produto_imagem_associada_fk_3_idx` (`id_variacao_default`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_produto_imagem_associada
-- ----------------------------

-- ----------------------------
-- Table structure for shop_produto_variacao
-- ----------------------------
DROP TABLE IF EXISTS `shop_produto_variacao`;
CREATE TABLE `shop_produto_variacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_grade_default` int(11) NOT NULL,
  `id_grade_variacao_default` int(11) NOT NULL,
  `id_produto_default` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `cor` enum('False','True') DEFAULT 'False',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `variacao_Unique` (`id_grade_default`,`id_grade_variacao_default`,`id_produto_default`) USING BTREE,
  KEY `shop_produto_variacao_fk_1_idx` (`id_produto_default`) USING BTREE,
  KEY `shop_produto_variacao_fk_2_idx` (`id_grade_default`) USING BTREE,
  KEY `shop_produto_variacao_fk_3_idx` (`id_grade_variacao_default`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of shop_produto_variacao
-- ----------------------------

-- ----------------------------
-- Table structure for shop_produto_visualizado
-- ----------------------------
DROP TABLE IF EXISTS `shop_produto_visualizado`;
CREATE TABLE `shop_produto_visualizado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto_default` int(11) NOT NULL,
  `id_shop_default` int(11) NOT NULL,
  `id_cliente_default` int(11) DEFAULT NULL,
  `session_id` varchar(130) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Unique_produto_usuario` (`id_produto_default`,`id_shop_default`,`session_id`) USING BTREE,
  KEY `id_produto_default` (`id_produto_default`) USING BTREE,
  KEY `shop_produto_visualizado_fk_2_idx` (`id_cliente_default`),
  KEY `shop_produto_visualizado_fk_1_idx` (`id_produto_default`) USING BTREE,
  KEY `shop_produto_visualizado_fk_3_idx` (`id_shop_default`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_produto_visualizado
-- ----------------------------

-- ----------------------------
-- Table structure for shop_rede_social
-- ----------------------------
DROP TABLE IF EXISTS `shop_rede_social`;
CREATE TABLE `shop_rede_social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `facebook` varchar(150) DEFAULT NULL,
  `twitter` varchar(150) DEFAULT NULL,
  `pinterest` varchar(150) DEFAULT NULL,
  `instagram` varchar(150) DEFAULT NULL,
  `google_plus` varchar(150) DEFAULT NULL,
  `youtube` varchar(150) DEFAULT NULL,
  `skype` varchar(45) DEFAULT NULL,
  `whatsapp` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_shop_default_UNIQUE` (`id_shop_default`),
  KEY `shop_rede_social_fk_1_idx` (`id_shop_default`)) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_rede_social
-- ----------------------------
INSERT INTO `shop_rede_social` VALUES ('44', '25', 'https://www.facebook.com/vialoja.com.br', 'https://twitter.com/vialoja.com.br', 'https://www.pinterest.com/vialoja.com.br', 'http://instagram.com/vialoja.com.br', 'https://plus.google.com/vialoja.com.br', 'https://www.youtube.com/vialoja.com.br', 'vialoja.com.br', 'vialoja.com.br', '2016-04-23 04:03:03');
INSERT INTO `shop_rede_social` VALUES ('45', '5', 'https://www.facebook.com/LegiaoDosHeroisd', 'https://twitter.com/wsduartefds', 'https://www.pinterest.com/breenrawwk', 'http://instagram.com/androids/', 'https://plus.google.com/sssssssssss', 'https://www.youtube.com/user/BrooklynAndBailey', 'tvcanal13.com', '(65) 9991-6303', '2016-09-21 15:37:32');

-- ----------------------------
-- Table structure for shop_selos
-- ----------------------------
DROP TABLE IF EXISTS `shop_selos`;
CREATE TABLE `shop_selos` (
  `id_selos` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `selo_ebit` text,
  `banner_ebit` text,
  `selo_google_safe` enum('off','on') DEFAULT 'off',
  `selo_norton_secured` enum('off','on') DEFAULT 'off',
  `selo_seomaster` enum('off','on') DEFAULT 'on',
  `created` datetime DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_selos`),
  UNIQUE KEY `id_shop_default_UNIQUE` (`id_shop_default`),
  KEY `shop_selo_fk_1_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_selos
-- ----------------------------
INSERT INTO `shop_selos` VALUES ('6', '5', '&lt;a id=&quot;seloEbit&quot; href=&quot;http://www.ebit.com.br/#&quot; target=&quot;_blank&quot; onclick=&quot;redir(this.href);&quot;&gt;Avalia&ccedil;&atilde;o de Lojas e-bit&lt;/a&gt;\r\n							&lt;script type=&quot;text/javascript&quot; id=&quot;getSelo&quot; src=&quot;https://a248.e.akamai.net/f/248/52872/0s/img.ebit.com.br/ebitBR/selo-ebit/js/getSelo.js?12345&quot; &gt;\r\n							&lt;/script&gt;', '', 'off', 'off', 'off', '2016-04-21 01:16:18', null);
INSERT INTO `shop_selos` VALUES ('7', '25', 'fsdfsdfsd', 'dfsdf', 'off', 'off', 'on', '2016-04-23 02:06:47', '2016-07-25 16:57:00');

-- ----------------------------
-- Table structure for shop_tema
-- ----------------------------
DROP TABLE IF EXISTS `shop_tema`;
CREATE TABLE `shop_tema` (
  `id_tema` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modifield` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tema`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_tema
-- ----------------------------

-- ----------------------------
-- Table structure for shop_tema_customizacao
-- ----------------------------
DROP TABLE IF EXISTS `shop_tema_customizacao`;
CREATE TABLE `shop_tema_customizacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT NULL,
  `id_shop_tema_default` int(11) DEFAULT NULL,
  `id_tema_default` varchar(255) DEFAULT NULL,
  `css` mediumtext,
  `created` datetime DEFAULT NULL,
  `modifield` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `shop_tema_customizacao_fk_1_idx` (`id_shop_default`),
  KEY `shop_tema_customizacao_fk_1` (`id_shop_tema_default`)) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_tema_customizacao
-- ----------------------------
INSERT INTO `shop_tema_customizacao` VALUES ('16', '5', null, null, '/*!\r\n * Bootstrap v3.0.3 (http://getbootstrap.com)\r\n * Copyright 2013 Twitter, Inc.\r\n * Licensed under http://www.apache.org/licenses/LICENSE-2.0\r\n */\r\n\r\n/*! normalize.css v2.1.3 | MIT License | git.io/normalize */\r\n\r\narticle,\r\naside,\r\ndetails,\r\nfigcaption,\r\nfigure,\r\nfooter,\r\nheader,\r\nhgroup,\r\nmain,\r\nnav,\r\nsection,\r\nsummary {\r\n  display: block;\r\n}\r\n\r\naudio,\r\ncanvas,\r\nvideo {\r\n  display: inline-block;\r\n}\r\n\r\naudio:not([controls]) {\r\n  display: none;\r\n  height: 0;\r\n}\r\n\r\n[hidden],\r\ntemplate {\r\n  display: none;\r\n}\r\n\r\nhtml {\r\n  font-family: sans-serif;\r\n  -webkit-text-size-adjust: 100%;\r\n      -ms-text-size-adjust: 100%;\r\n}\r\n\r\nbody {\r\n  margin: 0;\r\n}\r\n\r\na {\r\n  background: transparent;\r\n}\r\n\r\na:focus {\r\n  outline: thin dotted;\r\n}\r\n\r\na:active,\r\na:hover {\r\n  outline: 0;\r\n}\r\n\r\nh1 {\r\n  margin: 0.67em 0;\r\n  font-size: 2em;\r\n}\r\n\r\nabbr[title] {\r\n  border-bottom: 1px dotted;\r\n}\r\n\r\nb,\r\nstrong {\r\n  font-weight: bold;\r\n}\r\n\r\ndfn {\r\n  font-style: italic;\r\n}\r\n\r\nhr {\r\n  height: 0;\r\n  -moz-box-sizing: content-box;\r\n       box-sizing: content-box;\r\n}\r\n\r\nmark {\r\n  color: #000;\r\n  background: #ff0;\r\n}\r\n\r\ncode,\r\nkbd,\r\npre,\r\nsamp {\r\n  font-family: monospace, serif;\r\n  font-size: 1em;\r\n}\r\n\r\npre {\r\n  white-space: pre-wrap;\r\n}\r\n\r\nq {\r\n  quotes: &quot;201C&quot; &quot;201D&quot; &quot;2018&quot; &quot;2019&quot;;\r\n}\r\n\r\nsmall {\r\n  font-size: 80%;\r\n}\r\n\r\nsub,\r\nsup {\r\n  position: relative;\r\n  font-size: 75%;\r\n  line-height: 0;\r\n  vertical-align: baseline;\r\n}\r\n\r\nsup {\r\n  top: -0.5em;\r\n}\r\n\r\nsub {\r\n  bottom: -0.25em;\r\n}\r\n\r\nimg {\r\n  border: 0;\r\n}\r\n\r\nsvg:not(:root) {\r\n  overflow: hidden;\r\n}\r\n\r\nfigure {\r\n  margin: 0;\r\n}\r\n\r\nfieldset {\r\n  padding: 0.35em 0.625em 0.75em;\r\n  margin: 0 2px;\r\n  border: 1px solid #c0c0c0;\r\n}\r\n\r\nlegend {\r\n  padding: 0;\r\n  border: 0;\r\n}\r\n\r\n\r\nbutton,\r\nselect {\r\n  text-transform: none;\r\n}\r\n\r\ntextarea {\r\n  overflow: auto;\r\n  vertical-align: top;\r\n}\r\n\r\ntable {\r\n  border-collapse: collapse;\r\n  border-spacing: 0;\r\n}\r\n\r\n@media print {\r\n  * {\r\n    color: #000 !important;\r\n    text-shadow: none !important;\r\n    background: transparent !important;\r\n    box-shadow: none !important;\r\n  }\r\n  a,\r\n  a:visited {\r\n    text-decoration: underline;\r\n  }\r\n  a[href]:after {\r\n    content: &quot; (&quot; attr(href) &quot;)&quot;;\r\n  }\r\n  abbr[title]:after {\r\n    content: &quot; (&quot; attr(title) &quot;)&quot;;\r\n  }\r\n  a[href^=&quot;javascript:&quot;]:after,\r\n  a[href^=&quot;#&quot;]:after {\r\n    content: &quot;&quot;;\r\n  }\r\n  pre,\r\n  blockquote {\r\n    border: 1px solid #999;\r\n    page-break-inside: avoid;\r\n  }\r\n  thead {\r\n    display: table-header-group;\r\n  }\r\n  tr,\r\n  img {\r\n    page-break-inside: avoid;\r\n  }\r\n  img {\r\n    max-width: 100% !important;\r\n  }\r\n  @page  {\r\n    margin: 2cm .5cm;\r\n  }\r\n  p,\r\n  h2,\r\n  h3 {\r\n    orphans: 3;\r\n    widows: 3;\r\n  }\r\n  h2,\r\n  h3 {\r\n    page-break-after: avoid;\r\n  }\r\n  select {\r\n    background: #fff !important;\r\n  }\r\n  .navbar {\r\n    display: none;\r\n  }\r\n  .table td,\r\n  .table th {\r\n    background-color: #fff !important;\r\n  }\r\n  .btn &gt; .caret,\r\n  .dropup &gt; .btn &gt; .caret {\r\n    border-top-color: #000 !important;\r\n  }\r\n  .label {\r\n    border: 1px solid #000;\r\n  }\r\n  .table {\r\n    border-collapse: collapse !important;\r\n  }\r\n  .table-bordered th,\r\n  .table-bordered td {\r\n    border: 1px solid #ddd !important;\r\n  }\r\n}\r\n\r\nhtml {\r\n  font-size: 62.5%;\r\n  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);\r\n}\r\n\r\nbody {\r\n  font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\r\n  font-size: 14px;\r\n  line-height: 1.428571429;\r\n  color: #333333;\r\n  background-color: #ffffff;\r\n}\r\n\r\na {\r\n  color: #428bca;\r\n  text-decoration: none;\r\n}\r\n\r\na:hover,\r\na:focus {\r\n  color: #2a6496;\r\n  text-decoration: underline;\r\n}\r\n\r\na:focus {\r\n  outline: thin dotted;\r\n  outline: 5px auto -webkit-focus-ring-color;\r\n  outline-offset: -2px;\r\n}\r\n\r\nimg {\r\n  vertical-align: middle;\r\n}\r\n\r\n.img-responsive {\r\n  display: block;\r\n  height: auto;\r\n  max-width: 100%;\r\n}\r\n\r\n.img-rounded {\r\n  border-radius: 6px;\r\n}\r\n\r\n.img-thumbnail {\r\n  display: inline-block;\r\n  height: auto;\r\n  max-width: 100%;\r\n  padding: 4px;\r\n  line-height: 1.428571429;\r\n  background-color: #ffffff;\r\n  border: 1px solid #dddddd;\r\n  border-radius: 4px;\r\n  -webkit-transition: all 0.2s ease-in-out;\r\n          transition: all 0.2s ease-in-out;\r\n}\r\n\r\n.img-circle {\r\n  border-radius: 50%;\r\n}\r\n\r\nhr {\r\n  margin-top: 20px;\r\n  margin-bottom: 20px;\r\n  border: 0;\r\n  border-top: 1px solid #eeeeee;\r\n}\r\n\r\n.sr-only {\r\n  position: absolute;\r\n  width: 1px;\r\n  height: 1px;\r\n  padding: 0;\r\n  margin: -1px;\r\n  overflow: hidden;\r\n  clip: rect(0, 0, 0, 0);\r\n  border: 0;\r\n}\r\n\r\nh1,\r\nh2,\r\nh3,\r\nh4,\r\nh5,\r\nh6,\r\n.h1,\r\n.h2,\r\n.h3,\r\n.h4,\r\n.h5,\r\n.h6 {\r\n  font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\r\n  font-weight: 500;\r\n  line-height: 1.1;\r\n  color: inherit;\r\n}\r\n\r\nh1 small,\r\nh2 small,\r\nh3 small,\r\nh4 small,\r\nh5 small,\r\nh6 small,\r\n.h1 small,\r\n.h2 small,\r\n.h3 small,\r\n.h4 small,\r\n.h5 small,\r\n.h6 small,\r\nh1 .small,\r\nh2 .small,\r\nh3 .small,\r\nh4 .small,\r\nh5 .small,\r\nh6 .small,\r\n.h1 .small,\r\n.h2 .small,\r\n.h3 .small,\r\n.h4 .small,\r\n.h5 .small,\r\n.h6 .small {\r\n  font-weight: normal;\r\n  line-height: 1;\r\n  color: #999999;\r\n}\r\n\r\nh1,\r\nh2,\r\nh3 {\r\n  margin-top: 20px;\r\n  margin-bottom: 10px;\r\n}\r\n\r\nh1 small,\r\nh2 small,\r\nh3 small,\r\nh1 .small,\r\nh2 .small,\r\nh3 .small {\r\n  font-size: 65%;\r\n}\r\n\r\nh4,\r\nh5,\r\nh6 {\r\n  margin-top: 10px;\r\n  margin-bottom: 10px;\r\n}\r\n\r\nh4 small,\r\nh5 small,\r\nh6 small,\r\nh4 .small,\r\nh5 .small,\r\nh6 .small {\r\n  font-size: 75%;\r\n}\r\n\r\nh1,\r\n.h1 {\r\n  font-size: 36px;\r\n}\r\n\r\nh2,\r\n.h2 {\r\n  font-size: 30px;\r\n}\r\n\r\nh3,\r\n.h3 {\r\n  font-size: 24px;\r\n}\r\n\r\nh4,\r\n.h4 {\r\n  font-size: 18px;\r\n}\r\n\r\nh5,\r\n.h5 {\r\n  font-size: 14px;\r\n}\r\n\r\nh6,\r\n.h6 {\r\n  font-size: 12px;\r\n}\r\n\r\np {\r\n  margin: 0 0 10px;\r\n}\r\n\r\n.lead {\r\n  margin-bottom: 20px;\r\n  font-size: 16px;\r\n  font-weight: 200;\r\n  line-height: 1.4;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .lead {\r\n    font-size: 21px;\r\n  }\r\n}\r\n\r\nsmall,\r\n.small {\r\n  font-size: 85%;\r\n}\r\n\r\ncite {\r\n  font-style: normal;\r\n}\r\n\r\n.text-muted {\r\n  color: #999999;\r\n}\r\n\r\n.text-primary {\r\n  color: #428bca;\r\n}\r\n\r\n.text-primary:hover {\r\n  color: #3071a9;\r\n}\r\n\r\n.text-warning {\r\n  color: #8a6d3b;\r\n}\r\n\r\n.text-warning:hover {\r\n  color: #66512c;\r\n}\r\n\r\n.text-danger {\r\n  color: #a94442;\r\n}\r\n\r\n.text-danger:hover {\r\n  color: #843534;\r\n}\r\n\r\n.text-success {\r\n  color: #3c763d;\r\n}\r\n\r\n.text-success:hover {\r\n  color: #2b542c;\r\n}\r\n\r\n.text-info {\r\n  color: #31708f;\r\n}\r\n\r\n.text-info:hover {\r\n  color: #245269;\r\n}\r\n\r\n.text-left {\r\n  text-align: left;\r\n}\r\n\r\n.text-right {\r\n  text-align: right;\r\n}\r\n\r\n.text-center {\r\n  text-align: center;\r\n}\r\n\r\n.page-header {\r\n  padding-bottom: 9px;\r\n  margin: 40px 0 20px;\r\n  border-bottom: 1px solid #eeeeee;\r\n}\r\n\r\nul,\r\nol {\r\n  margin-top: 0;\r\n  margin-bottom: 10px;\r\n}\r\n\r\nul ul,\r\nol ul,\r\nul ol,\r\nol ol {\r\n  margin-bottom: 0;\r\n}\r\n\r\n.list-unstyled {\r\n  padding-left: 0;\r\n  list-style: none;\r\n}\r\n\r\n.list-inline {\r\n  padding-left: 0;\r\n  list-style: none;\r\n}\r\n\r\n.list-inline &gt; li {\r\n  display: inline-block;\r\n  padding-right: 5px;\r\n  padding-left: 5px;\r\n}\r\n\r\n.list-inline &gt; li:first-child {\r\n  padding-left: 0;\r\n}\r\n\r\ndl {\r\n  margin-top: 0;\r\n  margin-bottom: 20px;\r\n}\r\n\r\ndt,\r\ndd {\r\n  line-height: 1.428571429;\r\n}\r\n\r\ndt {\r\n  font-weight: bold;\r\n}\r\n\r\ndd {\r\n  margin-left: 0;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .dl-horizontal dt {\r\n    float: left;\r\n    width: 160px;\r\n    overflow: hidden;\r\n    clear: left;\r\n    text-align: right;\r\n    text-overflow: ellipsis;\r\n    white-space: nowrap;\r\n  }\r\n  .dl-horizontal dd {\r\n    margin-left: 180px;\r\n  }\r\n  .dl-horizontal dd:before,\r\n  .dl-horizontal dd:after {\r\n    display: table;\r\n    content: &quot; &quot;;\r\n  }\r\n  .dl-horizontal dd:after {\r\n    clear: both;\r\n  }\r\n  .dl-horizontal dd:before,\r\n  .dl-horizontal dd:after {\r\n    display: table;\r\n    content: &quot; &quot;;\r\n  }\r\n  .dl-horizontal dd:after {\r\n    clear: both;\r\n  }\r\n}\r\n\r\nabbr[title],\r\nabbr[data-original-title] {\r\n  cursor: help;\r\n  border-bottom: 1px dotted #999999;\r\n}\r\n\r\n.initialism {\r\n  font-size: 90%;\r\n  text-transform: uppercase;\r\n}\r\n\r\nblockquote {\r\n  padding: 10px 20px;\r\n  margin: 0 0 20px;\r\n  border-left: 5px solid #eeeeee;\r\n}\r\n\r\nblockquote p {\r\n  font-size: 17.5px;\r\n  font-weight: 300;\r\n  line-height: 1.25;\r\n}\r\n\r\nblockquote p:last-child {\r\n  margin-bottom: 0;\r\n}\r\n\r\nblockquote small,\r\nblockquote .small {\r\n  display: block;\r\n  line-height: 1.428571429;\r\n  color: #999999;\r\n}\r\n\r\nblockquote small:before,\r\nblockquote .small:before {\r\n  content: &#039;2014 A0&#039;;\r\n}\r\n\r\nblockquote.pull-right {\r\n  padding-right: 15px;\r\n  padding-left: 0;\r\n  border-right: 5px solid #eeeeee;\r\n  border-left: 0;\r\n}\r\n\r\nblockquote.pull-right p,\r\nblockquote.pull-right small,\r\nblockquote.pull-right .small {\r\n  text-align: right;\r\n}\r\n\r\nblockquote.pull-right small:before,\r\nblockquote.pull-right .small:before {\r\n  content: &#039;&#039;;\r\n}\r\n\r\nblockquote.pull-right small:after,\r\nblockquote.pull-right .small:after {\r\n  content: &#039;A0 2014&#039;;\r\n}\r\n\r\nblockquote:before,\r\nblockquote:after {\r\n  content: &quot;&quot;;\r\n}\r\n\r\naddress {\r\n  margin-bottom: 20px;\r\n  font-style: normal;\r\n  line-height: 1.428571429;\r\n}\r\n\r\ncode,\r\nkbd,\r\npre,\r\nsamp {\r\n  font-family: Menlo, Monaco, Consolas, &quot;Courier New&quot;, monospace;\r\n}\r\n\r\ncode {\r\n  padding: 2px 4px;\r\n  font-size: 90%;\r\n  color: #c7254e;\r\n  white-space: nowrap;\r\n  background-color: #f9f2f4;\r\n  border-radius: 4px;\r\n}\r\n\r\npre {\r\n  display: block;\r\n  padding: 9.5px;\r\n  margin: 0 0 10px;\r\n  font-size: 13px;\r\n  line-height: 1.428571429;\r\n  color: #333333;\r\n  word-break: break-all;\r\n  word-wrap: break-word;\r\n  background-color: #f5f5f5;\r\n  border: 1px solid #cccccc;\r\n  border-radius: 4px;\r\n}\r\n\r\npre code {\r\n  padding: 0;\r\n  font-size: inherit;\r\n  color: inherit;\r\n  white-space: pre-wrap;\r\n  background-color: transparent;\r\n  border-radius: 0;\r\n}\r\n\r\n.pre-scrollable {\r\n  max-height: 340px;\r\n  overflow-y: scroll;\r\n}\r\n\r\n.container {\r\n  padding-right: 15px;\r\n  padding-left: 15px;\r\n  margin-right: auto;\r\n  margin-left: auto;\r\n}\r\n\r\n.container:before,\r\n.container:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.container:after {\r\n  clear: both;\r\n}\r\n\r\n.container:before,\r\n.container:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.container:after {\r\n  clear: both;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .container {\r\n    width: 750px;\r\n  }\r\n}\r\n\r\n@media (min-width: 992px) {\r\n  .container {\r\n    width: 970px;\r\n  }\r\n}\r\n\r\n@media (min-width: 1200px) {\r\n  .container {\r\n    width: 1170px;\r\n  }\r\n}\r\n\r\n.row {\r\n  margin-right: -15px;\r\n  margin-left: -15px;\r\n}\r\n\r\n.row:before,\r\n.row:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.row:after {\r\n  clear: both;\r\n}\r\n\r\n.row:before,\r\n.row:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.row:after {\r\n  clear: both;\r\n}\r\n\r\n.col-xs-1,\r\n.col-sm-1,\r\n.col-md-1,\r\n.col-lg-1,\r\n.col-xs-2,\r\n.col-sm-2,\r\n.col-md-2,\r\n.col-lg-2,\r\n.col-xs-3,\r\n.col-sm-3,\r\n.col-md-3,\r\n.col-lg-3,\r\n.col-xs-4,\r\n.col-sm-4,\r\n.col-md-4,\r\n.col-lg-4,\r\n.col-xs-5,\r\n.col-sm-5,\r\n.col-md-5,\r\n.col-lg-5,\r\n.col-xs-6,\r\n.col-sm-6,\r\n.col-md-6,\r\n.col-lg-6,\r\n.col-xs-7,\r\n.col-sm-7,\r\n.col-md-7,\r\n.col-lg-7,\r\n.col-xs-8,\r\n.col-sm-8,\r\n.col-md-8,\r\n.col-lg-8,\r\n.col-xs-9,\r\n.col-sm-9,\r\n.col-md-9,\r\n.col-lg-9,\r\n.col-xs-10,\r\n.col-sm-10,\r\n.col-md-10,\r\n.col-lg-10,\r\n.col-xs-11,\r\n.col-sm-11,\r\n.col-md-11,\r\n.col-lg-11,\r\n.col-xs-12,\r\n.col-sm-12,\r\n.col-md-12,\r\n.col-lg-12 {\r\n  position: relative;\r\n  min-height: 1px;\r\n  padding-right: 15px;\r\n  padding-left: 15px;\r\n}\r\n\r\n.col-xs-1,\r\n.col-xs-2,\r\n.col-xs-3,\r\n.col-xs-4,\r\n.col-xs-5,\r\n.col-xs-6,\r\n.col-xs-7,\r\n.col-xs-8,\r\n.col-xs-9,\r\n.col-xs-10,\r\n.col-xs-11,\r\n.col-xs-12 {\r\n  float: left;\r\n}\r\n\r\n.col-xs-12 {\r\n  width: 100%;\r\n}\r\n\r\n.col-xs-11 {\r\n  width: 91.66666666666666%;\r\n}\r\n\r\n.col-xs-10 {\r\n  width: 83.33333333333334%;\r\n}\r\n\r\n.col-xs-9 {\r\n  width: 75%;\r\n}\r\n\r\n.col-xs-8 {\r\n  width: 66.66666666666666%;\r\n}\r\n\r\n.col-xs-7 {\r\n  width: 58.333333333333336%;\r\n}\r\n\r\n.col-xs-6 {\r\n  width: 50%;\r\n}\r\n\r\n.col-xs-5 {\r\n  width: 41.66666666666667%;\r\n}\r\n\r\n.col-xs-4 {\r\n  width: 33.33333333333333%;\r\n}\r\n\r\n.col-xs-3 {\r\n  width: 25%;\r\n}\r\n\r\n.col-xs-2 {\r\n  width: 16.666666666666664%;\r\n}\r\n\r\n.col-xs-1 {\r\n  width: 8.333333333333332%;\r\n}\r\n\r\n.col-xs-pull-12 {\r\n  right: 100%;\r\n}\r\n\r\n.col-xs-pull-11 {\r\n  right: 91.66666666666666%;\r\n}\r\n\r\n.col-xs-pull-10 {\r\n  right: 83.33333333333334%;\r\n}\r\n\r\n.col-xs-pull-9 {\r\n  right: 75%;\r\n}\r\n\r\n.col-xs-pull-8 {\r\n  right: 66.66666666666666%;\r\n}\r\n\r\n.col-xs-pull-7 {\r\n  right: 58.333333333333336%;\r\n}\r\n\r\n.col-xs-pull-6 {\r\n  right: 50%;\r\n}\r\n\r\n.col-xs-pull-5 {\r\n  right: 41.66666666666667%;\r\n}\r\n\r\n.col-xs-pull-4 {\r\n  right: 33.33333333333333%;\r\n}\r\n\r\n.col-xs-pull-3 {\r\n  right: 25%;\r\n}\r\n\r\n.col-xs-pull-2 {\r\n  right: 16.666666666666664%;\r\n}\r\n\r\n.col-xs-pull-1 {\r\n  right: 8.333333333333332%;\r\n}\r\n\r\n.col-xs-pull-0 {\r\n  right: 0;\r\n}\r\n\r\n.col-xs-push-12 {\r\n  left: 100%;\r\n}\r\n\r\n.col-xs-push-11 {\r\n  left: 91.66666666666666%;\r\n}\r\n\r\n.col-xs-push-10 {\r\n  left: 83.33333333333334%;\r\n}\r\n\r\n.col-xs-push-9 {\r\n  left: 75%;\r\n}\r\n\r\n.col-xs-push-8 {\r\n  left: 66.66666666666666%;\r\n}\r\n\r\n.col-xs-push-7 {\r\n  left: 58.333333333333336%;\r\n}\r\n\r\n.col-xs-push-6 {\r\n  left: 50%;\r\n}\r\n\r\n.col-xs-push-5 {\r\n  left: 41.66666666666667%;\r\n}\r\n\r\n.col-xs-push-4 {\r\n  left: 33.33333333333333%;\r\n}\r\n\r\n.col-xs-push-3 {\r\n  left: 25%;\r\n}\r\n\r\n.col-xs-push-2 {\r\n  left: 16.666666666666664%;\r\n}\r\n\r\n.col-xs-push-1 {\r\n  left: 8.333333333333332%;\r\n}\r\n\r\n.col-xs-push-0 {\r\n  left: 0;\r\n}\r\n\r\n.col-xs-offset-12 {\r\n  margin-left: 100%;\r\n}\r\n\r\n.col-xs-offset-11 {\r\n  margin-left: 91.66666666666666%;\r\n}\r\n\r\n.col-xs-offset-10 {\r\n  margin-left: 83.33333333333334%;\r\n}\r\n\r\n.col-xs-offset-9 {\r\n  margin-left: 75%;\r\n}\r\n\r\n.col-xs-offset-8 {\r\n  margin-left: 66.66666666666666%;\r\n}\r\n\r\n.col-xs-offset-7 {\r\n  margin-left: 58.333333333333336%;\r\n}\r\n\r\n.col-xs-offset-6 {\r\n  margin-left: 50%;\r\n}\r\n\r\n.col-xs-offset-5 {\r\n  margin-left: 41.66666666666667%;\r\n}\r\n\r\n.col-xs-offset-4 {\r\n  margin-left: 33.33333333333333%;\r\n}\r\n\r\n.col-xs-offset-3 {\r\n  margin-left: 25%;\r\n}\r\n\r\n.col-xs-offset-2 {\r\n  margin-left: 16.666666666666664%;\r\n}\r\n\r\n.col-xs-offset-1 {\r\n  margin-left: 8.333333333333332%;\r\n}\r\n\r\n.col-xs-offset-0 {\r\n  margin-left: 0;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .col-sm-1,\r\n  .col-sm-2,\r\n  .col-sm-3,\r\n  .col-sm-4,\r\n  .col-sm-5,\r\n  .col-sm-6,\r\n  .col-sm-7,\r\n  .col-sm-8,\r\n  .col-sm-9,\r\n  .col-sm-10,\r\n  .col-sm-11,\r\n  .col-sm-12 {\r\n    float: left;\r\n  }\r\n  .col-sm-12 {\r\n    width: 100%;\r\n  }\r\n  .col-sm-11 {\r\n    width: 91.66666666666666%;\r\n  }\r\n  .col-sm-10 {\r\n    width: 83.33333333333334%;\r\n  }\r\n  .col-sm-9 {\r\n    width: 75%;\r\n  }\r\n  .col-sm-8 {\r\n    width: 66.66666666666666%;\r\n  }\r\n  .col-sm-7 {\r\n    width: 58.333333333333336%;\r\n  }\r\n  .col-sm-6 {\r\n    width: 50%;\r\n  }\r\n  .col-sm-5 {\r\n    width: 41.66666666666667%;\r\n  }\r\n  .col-sm-4 {\r\n    width: 33.33333333333333%;\r\n  }\r\n  .col-sm-3 {\r\n    width: 25%;\r\n  }\r\n  .col-sm-2 {\r\n    width: 16.666666666666664%;\r\n  }\r\n  .col-sm-1 {\r\n    width: 8.333333333333332%;\r\n  }\r\n  .col-sm-pull-12 {\r\n    right: 100%;\r\n  }\r\n  .col-sm-pull-11 {\r\n    right: 91.66666666666666%;\r\n  }\r\n  .col-sm-pull-10 {\r\n    right: 83.33333333333334%;\r\n  }\r\n  .col-sm-pull-9 {\r\n    right: 75%;\r\n  }\r\n  .col-sm-pull-8 {\r\n    right: 66.66666666666666%;\r\n  }\r\n  .col-sm-pull-7 {\r\n    right: 58.333333333333336%;\r\n  }\r\n  .col-sm-pull-6 {\r\n    right: 50%;\r\n  }\r\n  .col-sm-pull-5 {\r\n    right: 41.66666666666667%;\r\n  }\r\n  .col-sm-pull-4 {\r\n    right: 33.33333333333333%;\r\n  }\r\n  .col-sm-pull-3 {\r\n    right: 25%;\r\n  }\r\n  .col-sm-pull-2 {\r\n    right: 16.666666666666664%;\r\n  }\r\n  .col-sm-pull-1 {\r\n    right: 8.333333333333332%;\r\n  }\r\n  .col-sm-pull-0 {\r\n    right: 0;\r\n  }\r\n  .col-sm-push-12 {\r\n    left: 100%;\r\n  }\r\n  .col-sm-push-11 {\r\n    left: 91.66666666666666%;\r\n  }\r\n  .col-sm-push-10 {\r\n    left: 83.33333333333334%;\r\n  }\r\n  .col-sm-push-9 {\r\n    left: 75%;\r\n  }\r\n  .col-sm-push-8 {\r\n    left: 66.66666666666666%;\r\n  }\r\n  .col-sm-push-7 {\r\n    left: 58.333333333333336%;\r\n  }\r\n  .col-sm-push-6 {\r\n    left: 50%;\r\n  }\r\n  .col-sm-push-5 {\r\n    left: 41.66666666666667%;\r\n  }\r\n  .col-sm-push-4 {\r\n    left: 33.33333333333333%;\r\n  }\r\n  .col-sm-push-3 {\r\n    left: 25%;\r\n  }\r\n  .col-sm-push-2 {\r\n    left: 16.666666666666664%;\r\n  }\r\n  .col-sm-push-1 {\r\n    left: 8.333333333333332%;\r\n  }\r\n  .col-sm-push-0 {\r\n    left: 0;\r\n  }\r\n  .col-sm-offset-12 {\r\n    margin-left: 100%;\r\n  }\r\n  .col-sm-offset-11 {\r\n    margin-left: 91.66666666666666%;\r\n  }\r\n  .col-sm-offset-10 {\r\n    margin-left: 83.33333333333334%;\r\n  }\r\n  .col-sm-offset-9 {\r\n    margin-left: 75%;\r\n  }\r\n  .col-sm-offset-8 {\r\n    margin-left: 66.66666666666666%;\r\n  }\r\n  .col-sm-offset-7 {\r\n    margin-left: 58.333333333333336%;\r\n  }\r\n  .col-sm-offset-6 {\r\n    margin-left: 50%;\r\n  }\r\n  .col-sm-offset-5 {\r\n    margin-left: 41.66666666666667%;\r\n  }\r\n  .col-sm-offset-4 {\r\n    margin-left: 33.33333333333333%;\r\n  }\r\n  .col-sm-offset-3 {\r\n    margin-left: 25%;\r\n  }\r\n  .col-sm-offset-2 {\r\n    margin-left: 16.666666666666664%;\r\n  }\r\n  .col-sm-offset-1 {\r\n    margin-left: 8.333333333333332%;\r\n  }\r\n  .col-sm-offset-0 {\r\n    margin-left: 0;\r\n  }\r\n}\r\n\r\n@media (min-width: 992px) {\r\n  .col-md-1,\r\n  .col-md-2,\r\n  .col-md-3,\r\n  .col-md-4,\r\n  .col-md-5,\r\n  .col-md-6,\r\n  .col-md-7,\r\n  .col-md-8,\r\n  .col-md-9,\r\n  .col-md-10,\r\n  .col-md-11,\r\n  .col-md-12 {\r\n    float: left;\r\n  }\r\n  .col-md-12 {\r\n    width: 100%;\r\n  }\r\n  .col-md-11 {\r\n    width: 91.66666666666666%;\r\n  }\r\n  .col-md-10 {\r\n    width: 83.33333333333334%;\r\n  }\r\n  .col-md-9 {\r\n    width: 75%;\r\n  }\r\n  .col-md-8 {\r\n    width: 66.66666666666666%;\r\n  }\r\n  .col-md-7 {\r\n    width: 58.333333333333336%;\r\n  }\r\n  .col-md-6 {\r\n    width: 50%;\r\n  }\r\n  .col-md-5 {\r\n    width: 41.66666666666667%;\r\n  }\r\n  .col-md-4 {\r\n    width: 33.33333333333333%;\r\n  }\r\n  .col-md-3 {\r\n    width: 25%;\r\n  }\r\n  .col-md-2 {\r\n    width: 16.666666666666664%;\r\n  }\r\n  .col-md-1 {\r\n    width: 8.333333333333332%;\r\n  }\r\n  .col-md-pull-12 {\r\n    right: 100%;\r\n  }\r\n  .col-md-pull-11 {\r\n    right: 91.66666666666666%;\r\n  }\r\n  .col-md-pull-10 {\r\n    right: 83.33333333333334%;\r\n  }\r\n  .col-md-pull-9 {\r\n    right: 75%;\r\n  }\r\n  .col-md-pull-8 {\r\n    right: 66.66666666666666%;\r\n  }\r\n  .col-md-pull-7 {\r\n    right: 58.333333333333336%;\r\n  }\r\n  .col-md-pull-6 {\r\n    right: 50%;\r\n  }\r\n  .col-md-pull-5 {\r\n    right: 41.66666666666667%;\r\n  }\r\n  .col-md-pull-4 {\r\n    right: 33.33333333333333%;\r\n  }\r\n  .col-md-pull-3 {\r\n    right: 25%;\r\n  }\r\n  .col-md-pull-2 {\r\n    right: 16.666666666666664%;\r\n  }\r\n  .col-md-pull-1 {\r\n    right: 8.333333333333332%;\r\n  }\r\n  .col-md-pull-0 {\r\n    right: 0;\r\n  }\r\n  .col-md-push-12 {\r\n    left: 100%;\r\n  }\r\n  .col-md-push-11 {\r\n    left: 91.66666666666666%;\r\n  }\r\n  .col-md-push-10 {\r\n    left: 83.33333333333334%;\r\n  }\r\n  .col-md-push-9 {\r\n    left: 75%;\r\n  }\r\n  .col-md-push-8 {\r\n    left: 66.66666666666666%;\r\n  }\r\n  .col-md-push-7 {\r\n    left: 58.333333333333336%;\r\n  }\r\n  .col-md-push-6 {\r\n    left: 50%;\r\n  }\r\n  .col-md-push-5 {\r\n    left: 41.66666666666667%;\r\n  }\r\n  .col-md-push-4 {\r\n    left: 33.33333333333333%;\r\n  }\r\n  .col-md-push-3 {\r\n    left: 25%;\r\n  }\r\n  .col-md-push-2 {\r\n    left: 16.666666666666664%;\r\n  }\r\n  .col-md-push-1 {\r\n    left: 8.333333333333332%;\r\n  }\r\n  .col-md-push-0 {\r\n    left: 0;\r\n  }\r\n  .col-md-offset-12 {\r\n    margin-left: 100%;\r\n  }\r\n  .col-md-offset-11 {\r\n    margin-left: 91.66666666666666%;\r\n  }\r\n  .col-md-offset-10 {\r\n    margin-left: 83.33333333333334%;\r\n  }\r\n  .col-md-offset-9 {\r\n    margin-left: 75%;\r\n  }\r\n  .col-md-offset-8 {\r\n    margin-left: 66.66666666666666%;\r\n  }\r\n  .col-md-offset-7 {\r\n    margin-left: 58.333333333333336%;\r\n  }\r\n  .col-md-offset-6 {\r\n    margin-left: 50%;\r\n  }\r\n  .col-md-offset-5 {\r\n    margin-left: 41.66666666666667%;\r\n  }\r\n  .col-md-offset-4 {\r\n    margin-left: 33.33333333333333%;\r\n  }\r\n  .col-md-offset-3 {\r\n    margin-left: 25%;\r\n  }\r\n  .col-md-offset-2 {\r\n    margin-left: 16.666666666666664%;\r\n  }\r\n  .col-md-offset-1 {\r\n    margin-left: 8.333333333333332%;\r\n  }\r\n  .col-md-offset-0 {\r\n    margin-left: 0;\r\n  }\r\n}\r\n\r\n@media (min-width: 1200px) {\r\n  .col-lg-1,\r\n  .col-lg-2,\r\n  .col-lg-3,\r\n  .col-lg-4,\r\n  .col-lg-5,\r\n  .col-lg-6,\r\n  .col-lg-7,\r\n  .col-lg-8,\r\n  .col-lg-9,\r\n  .col-lg-10,\r\n  .col-lg-11,\r\n  .col-lg-12 {\r\n    float: left;\r\n  }\r\n  .col-lg-12 {\r\n    width: 100%;\r\n  }\r\n  .col-lg-11 {\r\n    width: 91.66666666666666%;\r\n  }\r\n  .col-lg-10 {\r\n    width: 83.33333333333334%;\r\n  }\r\n  .col-lg-9 {\r\n    width: 75%;\r\n  }\r\n  .col-lg-8 {\r\n    width: 66.66666666666666%;\r\n  }\r\n  .col-lg-7 {\r\n    width: 58.333333333333336%;\r\n  }\r\n  .col-lg-6 {\r\n    width: 50%;\r\n  }\r\n  .col-lg-5 {\r\n    width: 41.66666666666667%;\r\n  }\r\n  .col-lg-4 {\r\n    width: 33.33333333333333%;\r\n  }\r\n  .col-lg-3 {\r\n    width: 25%;\r\n  }\r\n  .col-lg-2 {\r\n    width: 16.666666666666664%;\r\n  }\r\n  .col-lg-1 {\r\n    width: 8.333333333333332%;\r\n  }\r\n  .col-lg-pull-12 {\r\n    right: 100%;\r\n  }\r\n  .col-lg-pull-11 {\r\n    right: 91.66666666666666%;\r\n  }\r\n  .col-lg-pull-10 {\r\n    right: 83.33333333333334%;\r\n  }\r\n  .col-lg-pull-9 {\r\n    right: 75%;\r\n  }\r\n  .col-lg-pull-8 {\r\n    right: 66.66666666666666%;\r\n  }\r\n  .col-lg-pull-7 {\r\n    right: 58.333333333333336%;\r\n  }\r\n  .col-lg-pull-6 {\r\n    right: 50%;\r\n  }\r\n  .col-lg-pull-5 {\r\n    right: 41.66666666666667%;\r\n  }\r\n  .col-lg-pull-4 {\r\n    right: 33.33333333333333%;\r\n  }\r\n  .col-lg-pull-3 {\r\n    right: 25%;\r\n  }\r\n  .col-lg-pull-2 {\r\n    right: 16.666666666666664%;\r\n  }\r\n  .col-lg-pull-1 {\r\n    right: 8.333333333333332%;\r\n  }\r\n  .col-lg-pull-0 {\r\n    right: 0;\r\n  }\r\n  .col-lg-push-12 {\r\n    left: 100%;\r\n  }\r\n  .col-lg-push-11 {\r\n    left: 91.66666666666666%;\r\n  }\r\n  .col-lg-push-10 {\r\n    left: 83.33333333333334%;\r\n  }\r\n  .col-lg-push-9 {\r\n    left: 75%;\r\n  }\r\n  .col-lg-push-8 {\r\n    left: 66.66666666666666%;\r\n  }\r\n  .col-lg-push-7 {\r\n    left: 58.333333333333336%;\r\n  }\r\n  .col-lg-push-6 {\r\n    left: 50%;\r\n  }\r\n  .col-lg-push-5 {\r\n    left: 41.66666666666667%;\r\n  }\r\n  .col-lg-push-4 {\r\n    left: 33.33333333333333%;\r\n  }\r\n  .col-lg-push-3 {\r\n    left: 25%;\r\n  }\r\n  .col-lg-push-2 {\r\n    left: 16.666666666666664%;\r\n  }\r\n  .col-lg-push-1 {\r\n    left: 8.333333333333332%;\r\n  }\r\n  .col-lg-push-0 {\r\n    left: 0;\r\n  }\r\n  .col-lg-offset-12 {\r\n    margin-left: 100%;\r\n  }\r\n  .col-lg-offset-11 {\r\n    margin-left: 91.66666666666666%;\r\n  }\r\n  .col-lg-offset-10 {\r\n    margin-left: 83.33333333333334%;\r\n  }\r\n  .col-lg-offset-9 {\r\n    margin-left: 75%;\r\n  }\r\n  .col-lg-offset-8 {\r\n    margin-left: 66.66666666666666%;\r\n  }\r\n  .col-lg-offset-7 {\r\n    margin-left: 58.333333333333336%;\r\n  }\r\n  .col-lg-offset-6 {\r\n    margin-left: 50%;\r\n  }\r\n  .col-lg-offset-5 {\r\n    margin-left: 41.66666666666667%;\r\n  }\r\n  .col-lg-offset-4 {\r\n    margin-left: 33.33333333333333%;\r\n  }\r\n  .col-lg-offset-3 {\r\n    margin-left: 25%;\r\n  }\r\n  .col-lg-offset-2 {\r\n    margin-left: 16.666666666666664%;\r\n  }\r\n  .col-lg-offset-1 {\r\n    margin-left: 8.333333333333332%;\r\n  }\r\n  .col-lg-offset-0 {\r\n    margin-left: 0;\r\n  }\r\n}\r\n\r\ntable {\r\n  max-width: 100%;\r\n  background-color: transparent;\r\n}\r\n\r\nth {\r\n  text-align: left;\r\n}\r\n\r\n.table {\r\n  width: 100%;\r\n  margin-bottom: 20px;\r\n}\r\n\r\n.table &gt; thead &gt; tr &gt; th,\r\n.table &gt; tbody &gt; tr &gt; th,\r\n.table &gt; tfoot &gt; tr &gt; th,\r\n.table &gt; thead &gt; tr &gt; td,\r\n.table &gt; tbody &gt; tr &gt; td,\r\n.table &gt; tfoot &gt; tr &gt; td {\r\n  padding: 8px;\r\n  line-height: 1.428571429;\r\n  border-top: 1px solid #dddddd;\r\n}\r\n\r\n.table &gt; thead &gt; tr &gt; th {\r\n  vertical-align: bottom;\r\n  border-bottom: 2px solid #dddddd;\r\n}\r\n\r\n.table &gt; caption + thead &gt; tr:first-child &gt; th,\r\n.table &gt; colgroup + thead &gt; tr:first-child &gt; th,\r\n.table &gt; thead:first-child &gt; tr:first-child &gt; th,\r\n.table &gt; caption + thead &gt; tr:first-child &gt; td,\r\n.table &gt; colgroup + thead &gt; tr:first-child &gt; td,\r\n.table &gt; thead:first-child &gt; tr:first-child &gt; td {\r\n  border-top: 0;\r\n}\r\n\r\n.table &gt; tbody + tbody {\r\n  border-top: 2px solid #dddddd;\r\n}\r\n\r\n.table .table {\r\n  background-color: #ffffff;\r\n}\r\n\r\n.table-condensed &gt; thead &gt; tr &gt; th,\r\n.table-condensed &gt; tbody &gt; tr &gt; th,\r\n.table-condensed &gt; tfoot &gt; tr &gt; th,\r\n.table-condensed &gt; thead &gt; tr &gt; td,\r\n.table-condensed &gt; tbody &gt; tr &gt; td,\r\n.table-condensed &gt; tfoot &gt; tr &gt; td {\r\n  padding: 5px;\r\n}\r\n\r\n.table-bordered {\r\n  border: 1px solid #dddddd;\r\n}\r\n\r\n.table-bordered &gt; thead &gt; tr &gt; th,\r\n.table-bordered &gt; tbody &gt; tr &gt; th,\r\n.table-bordered &gt; tfoot &gt; tr &gt; th,\r\n.table-bordered &gt; thead &gt; tr &gt; td,\r\n.table-bordered &gt; tbody &gt; tr &gt; td,\r\n.table-bordered &gt; tfoot &gt; tr &gt; td {\r\n  border: 1px solid #dddddd;\r\n}\r\n\r\n.table-bordered &gt; thead &gt; tr &gt; th,\r\n.table-bordered &gt; thead &gt; tr &gt; td {\r\n  border-bottom-width: 2px;\r\n}\r\n\r\n.table-striped &gt; tbody &gt; tr:nth-child(odd) &gt; td,\r\n.table-striped &gt; tbody &gt; tr:nth-child(odd) &gt; th {\r\n  background-color: #f9f9f9;\r\n}\r\n\r\n.table-hover &gt; tbody &gt; tr:hover &gt; td,\r\n.table-hover &gt; tbody &gt; tr:hover &gt; th {\r\n  background-color: #f5f5f5;\r\n}\r\n\r\ntable col[class*=&quot;col-&quot;] {\r\n  position: static;\r\n  display: table-column;\r\n  float: none;\r\n}\r\n\r\ntable td[class*=&quot;col-&quot;],\r\ntable th[class*=&quot;col-&quot;] {\r\n  display: table-cell;\r\n  float: none;\r\n}\r\n\r\n.table &gt; thead &gt; tr &gt; .active,\r\n.table &gt; tbody &gt; tr &gt; .active,\r\n.table &gt; tfoot &gt; tr &gt; .active,\r\n.table &gt; thead &gt; .active &gt; td,\r\n.table &gt; tbody &gt; .active &gt; td,\r\n.table &gt; tfoot &gt; .active &gt; td,\r\n.table &gt; thead &gt; .active &gt; th,\r\n.table &gt; tbody &gt; .active &gt; th,\r\n.table &gt; tfoot &gt; .active &gt; th {\r\n  background-color: #f5f5f5;\r\n}\r\n\r\n.table-hover &gt; tbody &gt; tr &gt; .active:hover,\r\n.table-hover &gt; tbody &gt; .active:hover &gt; td,\r\n.table-hover &gt; tbody &gt; .active:hover &gt; th {\r\n  background-color: #e8e8e8;\r\n}\r\n\r\n.table &gt; thead &gt; tr &gt; .success,\r\n.table &gt; tbody &gt; tr &gt; .success,\r\n.table &gt; tfoot &gt; tr &gt; .success,\r\n.table &gt; thead &gt; .success &gt; td,\r\n.table &gt; tbody &gt; .success &gt; td,\r\n.table &gt; tfoot &gt; .success &gt; td,\r\n.table &gt; thead &gt; .success &gt; th,\r\n.table &gt; tbody &gt; .success &gt; th,\r\n.table &gt; tfoot &gt; .success &gt; th {\r\n  background-color: #dff0d8;\r\n}\r\n\r\n.table-hover &gt; tbody &gt; tr &gt; .success:hover,\r\n.table-hover &gt; tbody &gt; .success:hover &gt; td,\r\n.table-hover &gt; tbody &gt; .success:hover &gt; th {\r\n  background-color: #d0e9c6;\r\n}\r\n\r\n.table &gt; thead &gt; tr &gt; .danger,\r\n.table &gt; tbody &gt; tr &gt; .danger,\r\n.table &gt; tfoot &gt; tr &gt; .danger,\r\n.table &gt; thead &gt; .danger &gt; td,\r\n.table &gt; tbody &gt; .danger &gt; td,\r\n.table &gt; tfoot &gt; .danger &gt; td,\r\n.table &gt; thead &gt; .danger &gt; th,\r\n.table &gt; tbody &gt; .danger &gt; th,\r\n.table &gt; tfoot &gt; .danger &gt; th {\r\n  background-color: #f2dede;\r\n}\r\n\r\n.table-hover &gt; tbody &gt; tr &gt; .danger:hover,\r\n.table-hover &gt; tbody &gt; .danger:hover &gt; td,\r\n.table-hover &gt; tbody &gt; .danger:hover &gt; th {\r\n  background-color: #ebcccc;\r\n}\r\n\r\n.table &gt; thead &gt; tr &gt; .warning,\r\n.table &gt; tbody &gt; tr &gt; .warning,\r\n.table &gt; tfoot &gt; tr &gt; .warning,\r\n.table &gt; thead &gt; .warning &gt; td,\r\n.table &gt; tbody &gt; .warning &gt; td,\r\n.table &gt; tfoot &gt; .warning &gt; td,\r\n.table &gt; thead &gt; .warning &gt; th,\r\n.table &gt; tbody &gt; .warning &gt; th,\r\n.table &gt; tfoot &gt; .warning &gt; th {\r\n  background-color: #fcf8e3;\r\n}\r\n\r\n.table-hover &gt; tbody &gt; tr &gt; .warning:hover,\r\n.table-hover &gt; tbody &gt; .warning:hover &gt; td,\r\n.table-hover &gt; tbody &gt; .warning:hover &gt; th {\r\n  background-color: #faf2cc;\r\n}\r\n\r\n@media (max-width: 767px) {\r\n  .table-responsive {\r\n    width: 100%;\r\n    margin-bottom: 15px;\r\n    overflow-x: scroll;\r\n    overflow-y: hidden;\r\n    border: 1px solid #dddddd;\r\n    -ms-overflow-style: -ms-autohiding-scrollbar;\r\n    -webkit-overflow-scrolling: touch;\r\n  }\r\n  .table-responsive &gt; .table {\r\n    margin-bottom: 0;\r\n  }\r\n  .table-responsive &gt; .table &gt; thead &gt; tr &gt; th,\r\n  .table-responsive &gt; .table &gt; tbody &gt; tr &gt; th,\r\n  .table-responsive &gt; .table &gt; tfoot &gt; tr &gt; th,\r\n  .table-responsive &gt; .table &gt; thead &gt; tr &gt; td,\r\n  .table-responsive &gt; .table &gt; tbody &gt; tr &gt; td,\r\n  .table-responsive &gt; .table &gt; tfoot &gt; tr &gt; td {\r\n    white-space: nowrap;\r\n  }\r\n  .table-responsive &gt; .table-bordered {\r\n    border: 0;\r\n  }\r\n  .table-responsive &gt; .table-bordered &gt; thead &gt; tr &gt; th:first-child,\r\n  .table-responsive &gt; .table-bordered &gt; tbody &gt; tr &gt; th:first-child,\r\n  .table-responsive &gt; .table-bordered &gt; tfoot &gt; tr &gt; th:first-child,\r\n  .table-responsive &gt; .table-bordered &gt; thead &gt; tr &gt; td:first-child,\r\n  .table-responsive &gt; .table-bordered &gt; tbody &gt; tr &gt; td:first-child,\r\n  .table-responsive &gt; .table-bordered &gt; tfoot &gt; tr &gt; td:first-child {\r\n    border-left: 0;\r\n  }\r\n  .table-responsive &gt; .table-bordered &gt; thead &gt; tr &gt; th:last-child,\r\n  .table-responsive &gt; .table-bordered &gt; tbody &gt; tr &gt; th:last-child,\r\n  .table-responsive &gt; .table-bordered &gt; tfoot &gt; tr &gt; th:last-child,\r\n  .table-responsive &gt; .table-bordered &gt; thead &gt; tr &gt; td:last-child,\r\n  .table-responsive &gt; .table-bordered &gt; tbody &gt; tr &gt; td:last-child,\r\n  .table-responsive &gt; .table-bordered &gt; tfoot &gt; tr &gt; td:last-child {\r\n    border-right: 0;\r\n  }\r\n  .table-responsive &gt; .table-bordered &gt; tbody &gt; tr:last-child &gt; th,\r\n  .table-responsive &gt; .table-bordered &gt; tfoot &gt; tr:last-child &gt; th,\r\n  .table-responsive &gt; .table-bordered &gt; tbody &gt; tr:last-child &gt; td,\r\n  .table-responsive &gt; .table-bordered &gt; tfoot &gt; tr:last-child &gt; td {\r\n    border-bottom: 0;\r\n  }\r\n}\r\n\r\nfieldset {\r\n  padding: 0;\r\n  margin: 0;\r\n  border: 0;\r\n}\r\n\r\nlegend {\r\n  display: block;\r\n  width: 100%;\r\n  padding: 0;\r\n  margin-bottom: 20px;\r\n  font-size: 21px;\r\n  line-height: inherit;\r\n  color: #333333;\r\n  border: 0;\r\n  border-bottom: 1px solid #e5e5e5;\r\n}\r\n\r\nlabel {\r\n  display: inline-block;\r\n  margin-bottom: 5px;\r\n  font-weight: bold;\r\n}\r\n\r\nselect[multiple],\r\nselect[size] {\r\n  height: auto;\r\n}\r\n\r\nselect optgroup {\r\n  font-family: inherit;\r\n  font-size: inherit;\r\n  font-style: inherit;\r\n}\r\n\r\noutput {\r\n  display: block;\r\n  padding-top: 7px;\r\n  font-size: 14px;\r\n  line-height: 1.428571429;\r\n  color: #555555;\r\n  vertical-align: middle;\r\n}\r\n\r\n.form-control {\r\n  display: block;\r\n  width: 100%;\r\n  height: 34px;\r\n  padding: 6px 12px;\r\n  font-size: 14px;\r\n  line-height: 1.428571429;\r\n  color: #555555;\r\n  vertical-align: middle;\r\n  background-color: #ffffff;\r\n  background-image: none;\r\n  border: 1px solid #cccccc;\r\n  border-radius: 4px;\r\n  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n  -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;\r\n          transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;\r\n}\r\n\r\n.form-control:focus {\r\n  border-color: #66afe9;\r\n  outline: 0;\r\n  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);\r\n          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);\r\n}\r\n\r\n.form-control:-moz-placeholder {\r\n  color: #999999;\r\n}\r\n\r\n.form-control::-moz-placeholder {\r\n  color: #999999;\r\n  opacity: 1;\r\n}\r\n\r\n.form-control:-ms-input-placeholder {\r\n  color: #999999;\r\n}\r\n\r\n.form-control::-webkit-input-placeholder {\r\n  color: #999999;\r\n}\r\n\r\n.form-control[disabled],\r\n.form-control[readonly],\r\nfieldset[disabled] .form-control {\r\n  cursor: not-allowed;\r\n  background-color: #eeeeee;\r\n}\r\n\r\ntextarea.form-control {\r\n  height: auto;\r\n}\r\n\r\n.form-group {\r\n  margin-bottom: 15px;\r\n}\r\n\r\n.radio,\r\n.checkbox {\r\n  display: block;\r\n  min-height: 20px;\r\n  padding-left: 20px;\r\n  margin-top: 10px;\r\n  margin-bottom: 10px;\r\n  vertical-align: middle;\r\n}\r\n\r\n.radio label,\r\n.checkbox label {\r\n  display: inline;\r\n  margin-bottom: 0;\r\n  font-weight: normal;\r\n  cursor: pointer;\r\n}\r\n\r\n.radio + .radio,\r\n.checkbox + .checkbox {\r\n  margin-top: -5px;\r\n}\r\n\r\n.radio-inline,\r\n.checkbox-inline {\r\n  display: inline-block;\r\n  padding-left: 20px;\r\n  margin-bottom: 0;\r\n  font-weight: normal;\r\n  vertical-align: middle;\r\n  cursor: pointer;\r\n}\r\n\r\n.radio-inline + .radio-inline,\r\n.checkbox-inline + .checkbox-inline {\r\n  margin-top: 0;\r\n  margin-left: 10px;\r\n}\r\n\r\n\r\n.has-warning .help-block,\r\n.has-warning .control-label,\r\n.has-warning .radio,\r\n.has-warning .checkbox,\r\n.has-warning .radio-inline,\r\n.has-warning .checkbox-inline {\r\n  color: #8a6d3b;\r\n}\r\n\r\n.has-warning .form-control {\r\n  border-color: #8a6d3b;\r\n  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n}\r\n\r\n.has-warning .form-control:focus {\r\n  border-color: #66512c;\r\n  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #c0a16b;\r\n          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #c0a16b;\r\n}\r\n\r\n\r\n.has-error .help-block,\r\n.has-error .control-label,\r\n.has-error .radio,\r\n.has-error .checkbox,\r\n.has-error .radio-inline,\r\n.has-error .checkbox-inline {\r\n  color: #a94442;\r\n}\r\n\r\n.has-error .form-control {\r\n  border-color: #a94442;\r\n  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n}\r\n\r\n.has-error .form-control:focus {\r\n  border-color: #843534;\r\n  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #ce8483;\r\n          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #ce8483;\r\n}\r\n\r\n.has-error .input-group-addon {\r\n  color: #a94442;\r\n  background-color: #f2dede;\r\n  border-color: #a94442;\r\n}\r\n\r\n.has-success .help-block,\r\n.has-success .control-label,\r\n.has-success .radio,\r\n.has-success .checkbox,\r\n.has-success .radio-inline,\r\n.has-success .checkbox-inline {\r\n  color: #3c763d;\r\n}\r\n\r\n.has-success .form-control {\r\n  border-color: #3c763d;\r\n  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);\r\n}\r\n\r\n.has-success .form-control:focus {\r\n  border-color: #2b542c;\r\n  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #67b168;\r\n          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #67b168;\r\n}\r\n\r\n.has-success .input-group-addon {\r\n  color: #3c763d;\r\n  background-color: #dff0d8;\r\n  border-color: #3c763d;\r\n}\r\n\r\n.form-control-static {\r\n  margin-bottom: 0;\r\n}\r\n\r\n.help-block {\r\n  display: block;\r\n  margin-top: 5px;\r\n  margin-bottom: 10px;\r\n  color: #737373;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .form-inline .form-group {\r\n    display: inline-block;\r\n    margin-bottom: 0;\r\n    vertical-align: middle;\r\n  }\r\n  .form-inline .form-control {\r\n    display: inline-block;\r\n  }\r\n  .form-inline select.form-control {\r\n    width: auto;\r\n  }\r\n  .form-inline .radio,\r\n  .form-inline .checkbox {\r\n    display: inline-block;\r\n    padding-left: 0;\r\n    margin-top: 0;\r\n    margin-bottom: 0;\r\n  }\r\n\r\n}\r\n\r\n.form-horizontal .control-label,\r\n.form-horizontal .radio,\r\n.form-horizontal .checkbox,\r\n.form-horizontal .radio-inline,\r\n.form-horizontal .checkbox-inline {\r\n  padding-top: 7px;\r\n  margin-top: 0;\r\n  margin-bottom: 0;\r\n}\r\n\r\n.form-horizontal .radio,\r\n.form-horizontal .checkbox {\r\n  min-height: 27px;\r\n}\r\n\r\n.form-horizontal .form-group {\r\n  margin-right: -15px;\r\n  margin-left: -15px;\r\n}\r\n\r\n.form-horizontal .form-group:before,\r\n.form-horizontal .form-group:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.form-horizontal .form-group:after {\r\n  clear: both;\r\n}\r\n\r\n.form-horizontal .form-group:before,\r\n.form-horizontal .form-group:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.form-horizontal .form-group:after {\r\n  clear: both;\r\n}\r\n\r\n.form-horizontal .form-control-static {\r\n  padding-top: 7px;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .form-horizontal .control-label {\r\n    text-align: right;\r\n  }\r\n}\r\n\r\n.btn {\r\n  display: inline-block;\r\n  padding: 6px 12px;\r\n  margin-bottom: 0;\r\n  font-size: 14px;\r\n  font-weight: normal;\r\n  line-height: 1.428571429;\r\n  text-align: center;\r\n  white-space: nowrap;\r\n  vertical-align: middle;\r\n  cursor: pointer;\r\n  background-image: none;\r\n  border: 1px solid transparent;\r\n  border-radius: 4px;\r\n  -webkit-user-select: none;\r\n     -moz-user-select: none;\r\n      -ms-user-select: none;\r\n       -o-user-select: none;\r\n          user-select: none;\r\n}\r\n\r\n.btn:focus {\r\n  outline: thin dotted;\r\n  outline: 5px auto -webkit-focus-ring-color;\r\n  outline-offset: -2px;\r\n}\r\n\r\n.btn:hover,\r\n.btn:focus {\r\n  color: #333333;\r\n  text-decoration: none;\r\n}\r\n\r\n.btn:active,\r\n.btn.active {\r\n  background-image: none;\r\n  outline: 0;\r\n  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);\r\n          box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);\r\n}\r\n\r\n.btn.disabled,\r\n.btn[disabled],\r\nfieldset[disabled] .btn {\r\n  pointer-events: none;\r\n  cursor: not-allowed;\r\n  opacity: 0.65;\r\n  filter: alpha(opacity=65);\r\n  -webkit-box-shadow: none;\r\n          box-shadow: none;\r\n}\r\n\r\n\r\n.btn-link {\r\n  font-weight: normal;\r\n  color: #428bca;\r\n  cursor: pointer;\r\n  border-radius: 0;\r\n}\r\n\r\n.btn-link,\r\n.btn-link:active,\r\n.btn-link[disabled],\r\nfieldset[disabled] .btn-link {\r\n  background-color: transparent;\r\n  -webkit-box-shadow: none;\r\n          box-shadow: none;\r\n}\r\n\r\n.btn-link,\r\n.btn-link:hover,\r\n.btn-link:focus,\r\n.btn-link:active {\r\n  border-color: transparent;\r\n}\r\n\r\n.btn-link:hover,\r\n.btn-link:focus {\r\n  color: #2a6496;\r\n  text-decoration: underline;\r\n  background-color: transparent;\r\n}\r\n\r\n.btn-link[disabled]:hover,\r\nfieldset[disabled] .btn-link:hover,\r\n.btn-link[disabled]:focus,\r\nfieldset[disabled] .btn-link:focus {\r\n  color: #999999;\r\n  text-decoration: none;\r\n}\r\n\r\n.btn-lg {\r\n  padding: 10px 16px;\r\n  font-size: 18px;\r\n  line-height: 1.33;\r\n  border-radius: 6px;\r\n}\r\n\r\n.btn-sm {\r\n  padding: 5px 10px;\r\n  font-size: 12px;\r\n  line-height: 1.5;\r\n  border-radius: 3px;\r\n}\r\n\r\n.btn-xs {\r\n  padding: 1px 5px;\r\n  font-size: 12px;\r\n  line-height: 1.5;\r\n  border-radius: 3px;\r\n}\r\n\r\n.btn-block {\r\n  display: block;\r\n  width: 100%;\r\n  padding-right: 0;\r\n  padding-left: 0;\r\n}\r\n\r\n.btn-block + .btn-block {\r\n  margin-top: 5px;\r\n}\r\n\r\n\r\n@font-face {\r\n  font-family: &#039;Glyphicons Halflings&#039;;\r\n  src: url(&#039;../fonts/glyphicons-halflings-regular.eot&#039;);\r\n  src: url(&#039;../fonts/glyphicons-halflings-regular.eot?#iefix&#039;) format(&#039;embedded-opentype&#039;), url(&#039;../fonts/glyphicons-halflings-regular.woff&#039;) format(&#039;woff&#039;), url(&#039;../fonts/glyphicons-halflings-regular.ttf&#039;) format(&#039;truetype&#039;), url(&#039;../fonts/glyphicons-halflings-regular.svg#glyphicons-halflingsregular&#039;) format(&#039;svg&#039;);\r\n}\r\n\r\n.glyphicon {\r\n  position: relative;\r\n  top: 1px;\r\n  display: inline-block;\r\n  font-family: &#039;Glyphicons Halflings&#039;;\r\n  -webkit-font-smoothing: antialiased;\r\n  font-style: normal;\r\n  font-weight: normal;\r\n  line-height: 1;\r\n  -moz-osx-font-smoothing: grayscale;\r\n}\r\n\r\n.glyphicon:empty {\r\n  width: 1em;\r\n}\r\n\r\n.glyphicon-asterisk:before {\r\n  content: &quot;2a&quot;;\r\n}\r\n\r\n.glyphicon-plus:before {\r\n  content: &quot;2b&quot;;\r\n}\r\n\r\n.glyphicon-euro:before {\r\n  content: &quot;20ac&quot;;\r\n}\r\n\r\n.glyphicon-minus:before {\r\n  content: &quot;2212&quot;;\r\n}\r\n\r\n.glyphicon-cloud:before {\r\n  content: &quot;2601&quot;;\r\n}\r\n\r\n.glyphicon-envelope:before {\r\n  content: &quot;2709&quot;;\r\n}\r\n\r\n.glyphicon-pencil:before {\r\n  content: &quot;270f&quot;;\r\n}\r\n\r\n.glyphicon-glass:before {\r\n  content: &quot;e001&quot;;\r\n}\r\n\r\n.glyphicon-music:before {\r\n  content: &quot;e002&quot;;\r\n}\r\n\r\n.glyphicon-search:before {\r\n  content: &quot;e003&quot;;\r\n}\r\n\r\n.glyphicon-heart:before {\r\n  content: &quot;e005&quot;;\r\n}\r\n\r\n.glyphicon-star:before {\r\n  content: &quot;e006&quot;;\r\n}\r\n\r\n.glyphicon-star-empty:before {\r\n  content: &quot;e007&quot;;\r\n}\r\n\r\n.glyphicon-user:before {\r\n  content: &quot;e008&quot;;\r\n}\r\n\r\n.glyphicon-film:before {\r\n  content: &quot;e009&quot;;\r\n}\r\n\r\n.glyphicon-th-large:before {\r\n  content: &quot;e010&quot;;\r\n}\r\n\r\n.glyphicon-th:before {\r\n  content: &quot;e011&quot;;\r\n}\r\n\r\n.glyphicon-th-list:before {\r\n  content: &quot;e012&quot;;\r\n}\r\n\r\n.glyphicon-ok:before {\r\n  content: &quot;e013&quot;;\r\n}\r\n\r\n.glyphicon-remove:before {\r\n  content: &quot;e014&quot;;\r\n}\r\n\r\n.glyphicon-zoom-in:before {\r\n  content: &quot;e015&quot;;\r\n}\r\n\r\n.glyphicon-zoom-out:before {\r\n  content: &quot;e016&quot;;\r\n}\r\n\r\n.glyphicon-off:before {\r\n  content: &quot;e017&quot;;\r\n}\r\n\r\n.glyphicon-signal:before {\r\n  content: &quot;e018&quot;;\r\n}\r\n\r\n.glyphicon-cog:before {\r\n  content: &quot;e019&quot;;\r\n}\r\n\r\n.glyphicon-trash:before {\r\n  content: &quot;e020&quot;;\r\n}\r\n\r\n.glyphicon-home:before {\r\n  content: &quot;e021&quot;;\r\n}\r\n\r\n.glyphicon-file:before {\r\n  content: &quot;e022&quot;;\r\n}\r\n\r\n.glyphicon-time:before {\r\n  content: &quot;e023&quot;;\r\n}\r\n\r\n.glyphicon-road:before {\r\n  content: &quot;e024&quot;;\r\n}\r\n\r\n.glyphicon-download-alt:before {\r\n  content: &quot;e025&quot;;\r\n}\r\n\r\n.glyphicon-download:before {\r\n  content: &quot;e026&quot;;\r\n}\r\n\r\n.glyphicon-upload:before {\r\n  content: &quot;e027&quot;;\r\n}\r\n\r\n.glyphicon-inbox:before {\r\n  content: &quot;e028&quot;;\r\n}\r\n\r\n.glyphicon-play-circle:before {\r\n  content: &quot;e029&quot;;\r\n}\r\n\r\n.glyphicon-repeat:before {\r\n  content: &quot;e030&quot;;\r\n}\r\n\r\n.glyphicon-refresh:before {\r\n  content: &quot;e031&quot;;\r\n}\r\n\r\n.glyphicon-list-alt:before {\r\n  content: &quot;e032&quot;;\r\n}\r\n\r\n.glyphicon-lock:before {\r\n  content: &quot;e033&quot;;\r\n}\r\n\r\n.glyphicon-flag:before {\r\n  content: &quot;e034&quot;;\r\n}\r\n\r\n.glyphicon-headphones:before {\r\n  content: &quot;e035&quot;;\r\n}\r\n\r\n.glyphicon-volume-off:before {\r\n  content: &quot;e036&quot;;\r\n}\r\n\r\n.glyphicon-volume-down:before {\r\n  content: &quot;e037&quot;;\r\n}\r\n\r\n.glyphicon-volume-up:before {\r\n  content: &quot;e038&quot;;\r\n}\r\n\r\n.glyphicon-qrcode:before {\r\n  content: &quot;e039&quot;;\r\n}\r\n\r\n.glyphicon-barcode:before {\r\n  content: &quot;e040&quot;;\r\n}\r\n\r\n.glyphicon-tag:before {\r\n  content: &quot;e041&quot;;\r\n}\r\n\r\n.glyphicon-tags:before {\r\n  content: &quot;e042&quot;;\r\n}\r\n\r\n.glyphicon-book:before {\r\n  content: &quot;e043&quot;;\r\n}\r\n\r\n.glyphicon-bookmark:before {\r\n  content: &quot;e044&quot;;\r\n}\r\n\r\n.glyphicon-print:before {\r\n  content: &quot;e045&quot;;\r\n}\r\n\r\n.glyphicon-camera:before {\r\n  content: &quot;e046&quot;;\r\n}\r\n\r\n.glyphicon-font:before {\r\n  content: &quot;e047&quot;;\r\n}\r\n\r\n.glyphicon-bold:before {\r\n  content: &quot;e048&quot;;\r\n}\r\n\r\n.glyphicon-italic:before {\r\n  content: &quot;e049&quot;;\r\n}\r\n\r\n.glyphicon-text-height:before {\r\n  content: &quot;e050&quot;;\r\n}\r\n\r\n.glyphicon-text-width:before {\r\n  content: &quot;e051&quot;;\r\n}\r\n\r\n.glyphicon-align-left:before {\r\n  content: &quot;e052&quot;;\r\n}\r\n\r\n.glyphicon-align-center:before {\r\n  content: &quot;e053&quot;;\r\n}\r\n\r\n.glyphicon-align-right:before {\r\n  content: &quot;e054&quot;;\r\n}\r\n\r\n.glyphicon-align-justify:before {\r\n  content: &quot;e055&quot;;\r\n}\r\n\r\n.glyphicon-list:before {\r\n  content: &quot;e056&quot;;\r\n}\r\n\r\n.glyphicon-indent-left:before {\r\n  content: &quot;e057&quot;;\r\n}\r\n\r\n.glyphicon-indent-right:before {\r\n  content: &quot;e058&quot;;\r\n}\r\n\r\n.glyphicon-facetime-video:before {\r\n  content: &quot;e059&quot;;\r\n}\r\n\r\n.glyphicon-picture:before {\r\n  content: &quot;e060&quot;;\r\n}\r\n\r\n.glyphicon-map-marker:before {\r\n  content: &quot;e062&quot;;\r\n}\r\n\r\n.glyphicon-adjust:before {\r\n  content: &quot;e063&quot;;\r\n}\r\n\r\n.glyphicon-tint:before {\r\n  content: &quot;e064&quot;;\r\n}\r\n\r\n.glyphicon-edit:before {\r\n  content: &quot;e065&quot;;\r\n}\r\n\r\n.glyphicon-share:before {\r\n  content: &quot;e066&quot;;\r\n}\r\n\r\n.glyphicon-check:before {\r\n  content: &quot;e067&quot;;\r\n}\r\n\r\n.glyphicon-move:before {\r\n  content: &quot;e068&quot;;\r\n}\r\n\r\n.glyphicon-step-backward:before {\r\n  content: &quot;e069&quot;;\r\n}\r\n\r\n.glyphicon-fast-backward:before {\r\n  content: &quot;e070&quot;;\r\n}\r\n\r\n.glyphicon-backward:before {\r\n  content: &quot;e071&quot;;\r\n}\r\n\r\n.glyphicon-play:before {\r\n  content: &quot;e072&quot;;\r\n}\r\n\r\n.glyphicon-pause:before {\r\n  content: &quot;e073&quot;;\r\n}\r\n\r\n.glyphicon-stop:before {\r\n  content: &quot;e074&quot;;\r\n}\r\n\r\n.glyphicon-forward:before {\r\n  content: &quot;e075&quot;;\r\n}\r\n\r\n.glyphicon-fast-forward:before {\r\n  content: &quot;e076&quot;;\r\n}\r\n\r\n.glyphicon-step-forward:before {\r\n  content: &quot;e077&quot;;\r\n}\r\n\r\n.glyphicon-eject:before {\r\n  content: &quot;e078&quot;;\r\n}\r\n\r\n.glyphicon-chevron-left:before {\r\n  content: &quot;e079&quot;;\r\n}\r\n\r\n.glyphicon-chevron-right:before {\r\n  content: &quot;e080&quot;;\r\n}\r\n\r\n.glyphicon-plus-sign:before {\r\n  content: &quot;e081&quot;;\r\n}\r\n\r\n.glyphicon-minus-sign:before {\r\n  content: &quot;e082&quot;;\r\n}\r\n\r\n.glyphicon-remove-sign:before {\r\n  content: &quot;e083&quot;;\r\n}\r\n\r\n.glyphicon-ok-sign:before {\r\n  content: &quot;e084&quot;;\r\n}\r\n\r\n.glyphicon-question-sign:before {\r\n  content: &quot;e085&quot;;\r\n}\r\n\r\n.glyphicon-info-sign:before {\r\n  content: &quot;e086&quot;;\r\n}\r\n\r\n.glyphicon-screenshot:before {\r\n  content: &quot;e087&quot;;\r\n}\r\n\r\n.glyphicon-remove-circle:before {\r\n  content: &quot;e088&quot;;\r\n}\r\n\r\n.glyphicon-ok-circle:before {\r\n  content: &quot;e089&quot;;\r\n}\r\n\r\n.glyphicon-ban-circle:before {\r\n  content: &quot;e090&quot;;\r\n}\r\n\r\n.glyphicon-arrow-left:before {\r\n  content: &quot;e091&quot;;\r\n}\r\n\r\n.glyphicon-arrow-right:before {\r\n  content: &quot;e092&quot;;\r\n}\r\n\r\n.glyphicon-arrow-up:before {\r\n  content: &quot;e093&quot;;\r\n}\r\n\r\n.glyphicon-arrow-down:before {\r\n  content: &quot;e094&quot;;\r\n}\r\n\r\n.glyphicon-share-alt:before {\r\n  content: &quot;e095&quot;;\r\n}\r\n\r\n.glyphicon-resize-full:before {\r\n  content: &quot;e096&quot;;\r\n}\r\n\r\n.glyphicon-resize-small:before {\r\n  content: &quot;e097&quot;;\r\n}\r\n\r\n.glyphicon-exclamation-sign:before {\r\n  content: &quot;e101&quot;;\r\n}\r\n\r\n.glyphicon-gift:before {\r\n  content: &quot;e102&quot;;\r\n}\r\n\r\n.glyphicon-leaf:before {\r\n  content: &quot;e103&quot;;\r\n}\r\n\r\n.glyphicon-fire:before {\r\n  content: &quot;e104&quot;;\r\n}\r\n\r\n.glyphicon-eye-open:before {\r\n  content: &quot;e105&quot;;\r\n}\r\n\r\n.glyphicon-eye-close:before {\r\n  content: &quot;e106&quot;;\r\n}\r\n\r\n.glyphicon-warning-sign:before {\r\n  content: &quot;e107&quot;;\r\n}\r\n\r\n.glyphicon-plane:before {\r\n  content: &quot;e108&quot;;\r\n}\r\n\r\n.glyphicon-calendar:before {\r\n  content: &quot;e109&quot;;\r\n}\r\n\r\n.glyphicon-random:before {\r\n  content: &quot;e110&quot;;\r\n}\r\n\r\n.glyphicon-comment:before {\r\n  content: &quot;e111&quot;;\r\n}\r\n\r\n.glyphicon-magnet:before {\r\n  content: &quot;e112&quot;;\r\n}\r\n\r\n.glyphicon-chevron-up:before {\r\n  content: &quot;e113&quot;;\r\n}\r\n\r\n.glyphicon-chevron-down:before {\r\n  content: &quot;e114&quot;;\r\n}\r\n\r\n.glyphicon-retweet:before {\r\n  content: &quot;e115&quot;;\r\n}\r\n\r\n.glyphicon-shopping-cart:before {\r\n  content: &quot;e116&quot;;\r\n}\r\n\r\n.glyphicon-folder-close:before {\r\n  content: &quot;e117&quot;;\r\n}\r\n\r\n.glyphicon-folder-open:before {\r\n  content: &quot;e118&quot;;\r\n}\r\n\r\n.glyphicon-resize-vertical:before {\r\n  content: &quot;e119&quot;;\r\n}\r\n\r\n.glyphicon-resize-horizontal:before {\r\n  content: &quot;e120&quot;;\r\n}\r\n\r\n.glyphicon-hdd:before {\r\n  content: &quot;e121&quot;;\r\n}\r\n\r\n.glyphicon-bullhorn:before {\r\n  content: &quot;e122&quot;;\r\n}\r\n\r\n.glyphicon-bell:before {\r\n  content: &quot;e123&quot;;\r\n}\r\n\r\n.glyphicon-certificate:before {\r\n  content: &quot;e124&quot;;\r\n}\r\n\r\n.glyphicon-thumbs-up:before {\r\n  content: &quot;e125&quot;;\r\n}\r\n\r\n.glyphicon-thumbs-down:before {\r\n  content: &quot;e126&quot;;\r\n}\r\n\r\n.glyphicon-hand-right:before {\r\n  content: &quot;e127&quot;;\r\n}\r\n\r\n.glyphicon-hand-left:before {\r\n  content: &quot;e128&quot;;\r\n}\r\n\r\n.glyphicon-hand-up:before {\r\n  content: &quot;e129&quot;;\r\n}\r\n\r\n.glyphicon-hand-down:before {\r\n  content: &quot;e130&quot;;\r\n}\r\n\r\n.glyphicon-circle-arrow-right:before {\r\n  content: &quot;e131&quot;;\r\n}\r\n\r\n.glyphicon-circle-arrow-left:before {\r\n  content: &quot;e132&quot;;\r\n}\r\n\r\n.glyphicon-circle-arrow-up:before {\r\n  content: &quot;e133&quot;;\r\n}\r\n\r\n.glyphicon-circle-arrow-down:before {\r\n  content: &quot;e134&quot;;\r\n}\r\n\r\n.glyphicon-globe:before {\r\n  content: &quot;e135&quot;;\r\n}\r\n\r\n.glyphicon-wrench:before {\r\n  content: &quot;e136&quot;;\r\n}\r\n\r\n.glyphicon-tasks:before {\r\n  content: &quot;e137&quot;;\r\n}\r\n\r\n.glyphicon-filter:before {\r\n  content: &quot;e138&quot;;\r\n}\r\n\r\n.glyphicon-briefcase:before {\r\n  content: &quot;e139&quot;;\r\n}\r\n\r\n.glyphicon-fullscreen:before {\r\n  content: &quot;e140&quot;;\r\n}\r\n\r\n.glyphicon-dashboard:before {\r\n  content: &quot;e141&quot;;\r\n}\r\n\r\n.glyphicon-paperclip:before {\r\n  content: &quot;e142&quot;;\r\n}\r\n\r\n.glyphicon-heart-empty:before {\r\n  content: &quot;e143&quot;;\r\n}\r\n\r\n.glyphicon-link:before {\r\n  content: &quot;e144&quot;;\r\n}\r\n\r\n.glyphicon-phone:before {\r\n  content: &quot;e145&quot;;\r\n}\r\n\r\n.glyphicon-pushpin:before {\r\n  content: &quot;e146&quot;;\r\n}\r\n\r\n.glyphicon-usd:before {\r\n  content: &quot;e148&quot;;\r\n}\r\n\r\n.glyphicon-gbp:before {\r\n  content: &quot;e149&quot;;\r\n}\r\n\r\n.glyphicon-sort:before {\r\n  content: &quot;e150&quot;;\r\n}\r\n\r\n.glyphicon-sort-by-alphabet:before {\r\n  content: &quot;e151&quot;;\r\n}\r\n\r\n.glyphicon-sort-by-alphabet-alt:before {\r\n  content: &quot;e152&quot;;\r\n}\r\n\r\n.glyphicon-sort-by-order:before {\r\n  content: &quot;e153&quot;;\r\n}\r\n\r\n.glyphicon-sort-by-order-alt:before {\r\n  content: &quot;e154&quot;;\r\n}\r\n\r\n.glyphicon-sort-by-attributes:before {\r\n  content: &quot;e155&quot;;\r\n}\r\n\r\n.glyphicon-sort-by-attributes-alt:before {\r\n  content: &quot;e156&quot;;\r\n}\r\n\r\n.glyphicon-unchecked:before {\r\n  content: &quot;e157&quot;;\r\n}\r\n\r\n.glyphicon-expand:before {\r\n  content: &quot;e158&quot;;\r\n}\r\n\r\n.glyphicon-collapse-down:before {\r\n  content: &quot;e159&quot;;\r\n}\r\n\r\n.glyphicon-collapse-up:before {\r\n  content: &quot;e160&quot;;\r\n}\r\n\r\n.glyphicon-log-in:before {\r\n  content: &quot;e161&quot;;\r\n}\r\n\r\n.glyphicon-flash:before {\r\n  content: &quot;e162&quot;;\r\n}\r\n\r\n.glyphicon-log-out:before {\r\n  content: &quot;e163&quot;;\r\n}\r\n\r\n.glyphicon-new-window:before {\r\n  content: &quot;e164&quot;;\r\n}\r\n\r\n.glyphicon-record:before {\r\n  content: &quot;e165&quot;;\r\n}\r\n\r\n.glyphicon-save:before {\r\n  content: &quot;e166&quot;;\r\n}\r\n\r\n.glyphicon-open:before {\r\n  content: &quot;e167&quot;;\r\n}\r\n\r\n.glyphicon-saved:before {\r\n  content: &quot;e168&quot;;\r\n}\r\n\r\n.glyphicon-import:before {\r\n  content: &quot;e169&quot;;\r\n}\r\n\r\n.glyphicon-export:before {\r\n  content: &quot;e170&quot;;\r\n}\r\n\r\n.glyphicon-send:before {\r\n  content: &quot;e171&quot;;\r\n}\r\n\r\n.glyphicon-floppy-disk:before {\r\n  content: &quot;e172&quot;;\r\n}\r\n\r\n.glyphicon-floppy-saved:before {\r\n  content: &quot;e173&quot;;\r\n}\r\n\r\n.glyphicon-floppy-remove:before {\r\n  content: &quot;e174&quot;;\r\n}\r\n\r\n.glyphicon-floppy-save:before {\r\n  content: &quot;e175&quot;;\r\n}\r\n\r\n.glyphicon-floppy-open:before {\r\n  content: &quot;e176&quot;;\r\n}\r\n\r\n.glyphicon-credit-card:before {\r\n  content: &quot;e177&quot;;\r\n}\r\n\r\n.glyphicon-transfer:before {\r\n  content: &quot;e178&quot;;\r\n}\r\n\r\n.glyphicon-cutlery:before {\r\n  content: &quot;e179&quot;;\r\n}\r\n\r\n.glyphicon-header:before {\r\n  content: &quot;e180&quot;;\r\n}\r\n\r\n.glyphicon-compressed:before {\r\n  content: &quot;e181&quot;;\r\n}\r\n\r\n.glyphicon-earphone:before {\r\n  content: &quot;e182&quot;;\r\n}\r\n\r\n.glyphicon-phone-alt:before {\r\n  content: &quot;e183&quot;;\r\n}\r\n\r\n.glyphicon-tower:before {\r\n  content: &quot;e184&quot;;\r\n}\r\n\r\n.glyphicon-stats:before {\r\n  content: &quot;e185&quot;;\r\n}\r\n\r\n.glyphicon-sd-video:before {\r\n  content: &quot;e186&quot;;\r\n}\r\n\r\n.glyphicon-hd-video:before {\r\n  content: &quot;e187&quot;;\r\n}\r\n\r\n.glyphicon-subtitles:before {\r\n  content: &quot;e188&quot;;\r\n}\r\n\r\n.glyphicon-sound-stereo:before {\r\n  content: &quot;e189&quot;;\r\n}\r\n\r\n.glyphicon-sound-dolby:before {\r\n  content: &quot;e190&quot;;\r\n}\r\n\r\n.glyphicon-sound-5-1:before {\r\n  content: &quot;e191&quot;;\r\n}\r\n\r\n.glyphicon-sound-6-1:before {\r\n  content: &quot;e192&quot;;\r\n}\r\n\r\n.glyphicon-sound-7-1:before {\r\n  content: &quot;e193&quot;;\r\n}\r\n\r\n.glyphicon-copyright-mark:before {\r\n  content: &quot;e194&quot;;\r\n}\r\n\r\n.glyphicon-registration-mark:before {\r\n  content: &quot;e195&quot;;\r\n}\r\n\r\n.glyphicon-cloud-download:before {\r\n  content: &quot;e197&quot;;\r\n}\r\n\r\n.glyphicon-cloud-upload:before {\r\n  content: &quot;e198&quot;;\r\n}\r\n\r\n.glyphicon-tree-conifer:before {\r\n  content: &quot;e199&quot;;\r\n}\r\n\r\n.glyphicon-tree-deciduous:before {\r\n  content: &quot;e200&quot;;\r\n}\r\n\r\n.caret {\r\n  display: inline-block;\r\n  width: 0;\r\n  height: 0;\r\n  margin-left: 2px;\r\n  vertical-align: middle;\r\n  border-top: 4px solid;\r\n  border-right: 4px solid transparent;\r\n  border-left: 4px solid transparent;\r\n}\r\n\r\n.dropdown {\r\n  position: relative;\r\n}\r\n\r\n.dropdown-toggle:focus {\r\n  outline: 0;\r\n}\r\n\r\n.dropdown-menu {\r\n  position: absolute;\r\n  top: 100%;\r\n  left: 0;\r\n  z-index: 1000;\r\n  display: none;\r\n  float: left;\r\n  min-width: 160px;\r\n  padding: 5px 0;\r\n  margin: 2px 0 0;\r\n  font-size: 14px;\r\n  list-style: none;\r\n  background-color: #ffffff;\r\n  border: 1px solid #cccccc;\r\n  border: 1px solid rgba(0, 0, 0, 0.15);\r\n  border-radius: 4px;\r\n  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);\r\n          box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);\r\n  background-clip: padding-box;\r\n}\r\n\r\n.dropdown-menu.pull-right {\r\n  right: 0;\r\n  left: auto;\r\n}\r\n\r\n.dropdown-menu .divider {\r\n  height: 1px;\r\n  margin: 9px 0;\r\n  overflow: hidden;\r\n  background-color: #e5e5e5;\r\n}\r\n\r\n.dropdown-menu &gt; li &gt; a {\r\n  display: block;\r\n  padding: 3px 20px;\r\n  clear: both;\r\n  font-weight: normal;\r\n  line-height: 1.428571429;\r\n  color: #333333;\r\n  white-space: nowrap;\r\n}\r\n\r\n.dropdown-menu &gt; li &gt; a:hover,\r\n.dropdown-menu &gt; li &gt; a:focus {\r\n  color: #262626;\r\n  text-decoration: none;\r\n  background-color: #f5f5f5;\r\n}\r\n\r\n.dropdown-menu &gt; .active &gt; a,\r\n.dropdown-menu &gt; .active &gt; a:hover,\r\n.dropdown-menu &gt; .active &gt; a:focus {\r\n  color: #ffffff;\r\n  text-decoration: none;\r\n  background-color: #428bca;\r\n  outline: 0;\r\n}\r\n\r\n.dropdown-menu &gt; .disabled &gt; a,\r\n.dropdown-menu &gt; .disabled &gt; a:hover,\r\n.dropdown-menu &gt; .disabled &gt; a:focus {\r\n  color: #999999;\r\n}\r\n\r\n.dropdown-menu &gt; .disabled &gt; a:hover,\r\n.dropdown-menu &gt; .disabled &gt; a:focus {\r\n  text-decoration: none;\r\n  cursor: not-allowed;\r\n  background-color: transparent;\r\n  background-image: none;\r\n  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);\r\n}\r\n\r\n.open &gt; .dropdown-menu {\r\n  display: block;\r\n}\r\n\r\n.open &gt; a {\r\n  outline: 0;\r\n}\r\n\r\n.dropdown-header {\r\n  display: block;\r\n  padding: 3px 20px;\r\n  font-size: 12px;\r\n  line-height: 1.428571429;\r\n  color: #999999;\r\n}\r\n\r\n.dropdown-backdrop {\r\n  position: fixed;\r\n  top: 0;\r\n  right: 0;\r\n  bottom: 0;\r\n  left: 0;\r\n  z-index: 990;\r\n}\r\n\r\n.pull-right &gt; .dropdown-menu {\r\n  right: 0;\r\n  left: auto;\r\n}\r\n\r\n.dropup .caret,\r\n.navbar-fixed-bottom .dropdown .caret {\r\n  border-top: 0;\r\n  border-bottom: 4px solid;\r\n  content: &quot;&quot;;\r\n}\r\n\r\n.dropup .dropdown-menu,\r\n.navbar-fixed-bottom .dropdown .dropdown-menu {\r\n  top: auto;\r\n  bottom: 100%;\r\n  margin-bottom: 1px;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .navbar-right .dropdown-menu {\r\n    right: 0;\r\n    left: auto;\r\n  }\r\n}\r\n\r\n.btn-group,\r\n.btn-group-vertical {\r\n  position: relative;\r\n  display: inline-block;\r\n  vertical-align: middle;\r\n}\r\n\r\n.btn-group &gt; .btn,\r\n.btn-group-vertical &gt; .btn {\r\n  position: relative;\r\n  float: left;\r\n}\r\n\r\n.btn-group &gt; .btn:hover,\r\n.btn-group-vertical &gt; .btn:hover,\r\n.btn-group &gt; .btn:focus,\r\n.btn-group-vertical &gt; .btn:focus,\r\n.btn-group &gt; .btn:active,\r\n.btn-group-vertical &gt; .btn:active,\r\n.btn-group &gt; .btn.active,\r\n.btn-group-vertical &gt; .btn.active {\r\n  z-index: 2;\r\n}\r\n\r\n.btn-group &gt; .btn:focus,\r\n.btn-group-vertical &gt; .btn:focus {\r\n  outline: none;\r\n}\r\n\r\n.btn-group .btn + .btn,\r\n.btn-group .btn + .btn-group,\r\n.btn-group .btn-group + .btn,\r\n.btn-group .btn-group + .btn-group {\r\n  margin-left: -1px;\r\n}\r\n\r\n.btn-toolbar:before,\r\n.btn-toolbar:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.btn-toolbar:after {\r\n  clear: both;\r\n}\r\n\r\n.btn-toolbar:before,\r\n.btn-toolbar:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.btn-toolbar:after {\r\n  clear: both;\r\n}\r\n\r\n.btn-toolbar .btn-group {\r\n  float: left;\r\n}\r\n\r\n.btn-toolbar &gt; .btn + .btn,\r\n.btn-toolbar &gt; .btn-group + .btn,\r\n.btn-toolbar &gt; .btn + .btn-group,\r\n.btn-toolbar &gt; .btn-group + .btn-group {\r\n  margin-left: 5px;\r\n}\r\n\r\n.btn-group &gt; .btn:not(:first-child):not(:last-child):not(.dropdown-toggle) {\r\n  border-radius: 0;\r\n}\r\n\r\n.btn-group &gt; .btn:first-child {\r\n  margin-left: 0;\r\n}\r\n\r\n.btn-group &gt; .btn:first-child:not(:last-child):not(.dropdown-toggle) {\r\n  border-top-right-radius: 0;\r\n  border-bottom-right-radius: 0;\r\n}\r\n\r\n.btn-group &gt; .btn:last-child:not(:first-child),\r\n.btn-group &gt; .dropdown-toggle:not(:first-child) {\r\n  border-bottom-left-radius: 0;\r\n  border-top-left-radius: 0;\r\n}\r\n\r\n.btn-group &gt; .btn-group {\r\n  float: left;\r\n}\r\n\r\n.btn-group &gt; .btn-group:not(:first-child):not(:last-child) &gt; .btn {\r\n  border-radius: 0;\r\n}\r\n\r\n.btn-group &gt; .btn-group:first-child &gt; .btn:last-child,\r\n.btn-group &gt; .btn-group:first-child &gt; .dropdown-toggle {\r\n  border-top-right-radius: 0;\r\n  border-bottom-right-radius: 0;\r\n}\r\n\r\n.btn-group &gt; .btn-group:last-child &gt; .btn:first-child {\r\n  border-bottom-left-radius: 0;\r\n  border-top-left-radius: 0;\r\n}\r\n\r\n.btn-group .dropdown-toggle:active,\r\n.btn-group.open .dropdown-toggle {\r\n  outline: 0;\r\n}\r\n\r\n.btn-group-xs &gt; .btn {\r\n  padding: 1px 5px;\r\n  font-size: 12px;\r\n  line-height: 1.5;\r\n  border-radius: 3px;\r\n}\r\n\r\n.btn-group-sm &gt; .btn {\r\n  padding: 5px 10px;\r\n  font-size: 12px;\r\n  line-height: 1.5;\r\n  border-radius: 3px;\r\n}\r\n\r\n.btn-group-lg &gt; .btn {\r\n  padding: 10px 16px;\r\n  font-size: 18px;\r\n  line-height: 1.33;\r\n  border-radius: 6px;\r\n}\r\n\r\n.btn-group &gt; .btn + .dropdown-toggle {\r\n  padding-right: 8px;\r\n  padding-left: 8px;\r\n}\r\n\r\n.btn-group &gt; .btn-lg + .dropdown-toggle {\r\n  padding-right: 12px;\r\n  padding-left: 12px;\r\n}\r\n\r\n.btn-group.open .dropdown-toggle {\r\n  -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);\r\n          box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);\r\n}\r\n\r\n.btn-group.open .dropdown-toggle.btn-link {\r\n  -webkit-box-shadow: none;\r\n          box-shadow: none;\r\n}\r\n\r\n.btn .caret {\r\n  margin-left: 0;\r\n}\r\n\r\n.btn-lg .caret {\r\n  border-width: 5px 5px 0;\r\n  border-bottom-width: 0;\r\n}\r\n\r\n.dropup .btn-lg .caret {\r\n  border-width: 0 5px 5px;\r\n}\r\n\r\n.btn-group-vertical &gt; .btn,\r\n.btn-group-vertical &gt; .btn-group,\r\n.btn-group-vertical &gt; .btn-group &gt; .btn {\r\n  display: block;\r\n  float: none;\r\n  width: 100%;\r\n  max-width: 100%;\r\n}\r\n\r\n.btn-group-vertical &gt; .btn-group:before,\r\n.btn-group-vertical &gt; .btn-group:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.btn-group-vertical &gt; .btn-group:after {\r\n  clear: both;\r\n}\r\n\r\n.btn-group-vertical &gt; .btn-group:before,\r\n.btn-group-vertical &gt; .btn-group:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.btn-group-vertical &gt; .btn-group:after {\r\n  clear: both;\r\n}\r\n\r\n.btn-group-vertical &gt; .btn-group &gt; .btn {\r\n  float: none;\r\n}\r\n\r\n.btn-group-vertical &gt; .btn + .btn,\r\n.btn-group-vertical &gt; .btn + .btn-group,\r\n.btn-group-vertical &gt; .btn-group + .btn,\r\n.btn-group-vertical &gt; .btn-group + .btn-group {\r\n  margin-top: -1px;\r\n  margin-left: 0;\r\n}\r\n\r\n.btn-group-vertical &gt; .btn:not(:first-child):not(:last-child) {\r\n  border-radius: 0;\r\n}\r\n\r\n.btn-group-vertical &gt; .btn:first-child:not(:last-child) {\r\n  border-top-right-radius: 4px;\r\n  border-bottom-right-radius: 0;\r\n  border-bottom-left-radius: 0;\r\n}\r\n\r\n.btn-group-vertical &gt; .btn:last-child:not(:first-child) {\r\n  border-top-right-radius: 0;\r\n  border-bottom-left-radius: 4px;\r\n  border-top-left-radius: 0;\r\n}\r\n\r\n.btn-group-vertical &gt; .btn-group:not(:first-child):not(:last-child) &gt; .btn {\r\n  border-radius: 0;\r\n}\r\n\r\n.btn-group-vertical &gt; .btn-group:first-child &gt; .btn:last-child,\r\n.btn-group-vertical &gt; .btn-group:first-child &gt; .dropdown-toggle {\r\n  border-bottom-right-radius: 0;\r\n  border-bottom-left-radius: 0;\r\n}\r\n\r\n.btn-group-vertical &gt; .btn-group:last-child &gt; .btn:first-child {\r\n  border-top-right-radius: 0;\r\n  border-top-left-radius: 0;\r\n}\r\n\r\n.btn-group-justified {\r\n  display: table;\r\n  width: 100%;\r\n  border-collapse: separate;\r\n  table-layout: fixed;\r\n}\r\n\r\n.btn-group-justified &gt; .btn,\r\n.btn-group-justified &gt; .btn-group {\r\n  display: table-cell;\r\n  float: none;\r\n  width: 1%;\r\n}\r\n\r\n.btn-group-justified &gt; .btn-group .btn {\r\n  width: 100%;\r\n}\r\n\r\n\r\n.tab-content &gt; .tab-pane {\r\n  display: none;\r\n}\r\n\r\n.tab-content &gt; .active {\r\n  display: block;\r\n}\r\n\r\n.nav-tabs .dropdown-menu {\r\n  margin-top: -1px;\r\n  border-top-right-radius: 0;\r\n  border-top-left-radius: 0;\r\n}\r\n\r\n.navbar {\r\n  position: relative;\r\n  min-height: 50px;\r\n  margin-bottom: 20px;\r\n  border: 1px solid transparent;\r\n}\r\n\r\n.navbar:before,\r\n.navbar:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.navbar:after {\r\n  clear: both;\r\n}\r\n\r\n.navbar:before,\r\n.navbar:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.navbar:after {\r\n  clear: both;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .navbar {\r\n    border-radius: 4px;\r\n  }\r\n}\r\n\r\n.navbar-header:before,\r\n.navbar-header:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.navbar-header:after {\r\n  clear: both;\r\n}\r\n\r\n.navbar-header:before,\r\n.navbar-header:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.navbar-header:after {\r\n  clear: both;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .navbar-header {\r\n    float: left;\r\n  }\r\n}\r\n\r\n.navbar-collapse {\r\n  max-height: 340px;\r\n  padding-right: 15px;\r\n  padding-left: 15px;\r\n  overflow-x: visible;\r\n  border-top: 1px solid transparent;\r\n  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);\r\n  -webkit-overflow-scrolling: touch;\r\n}\r\n\r\n.navbar-collapse:before,\r\n.navbar-collapse:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.navbar-collapse:after {\r\n  clear: both;\r\n}\r\n\r\n.navbar-collapse:before,\r\n.navbar-collapse:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.navbar-collapse:after {\r\n  clear: both;\r\n}\r\n\r\n.navbar-collapse.in {\r\n  overflow-y: auto;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .navbar-collapse {\r\n    width: auto;\r\n    border-top: 0;\r\n    box-shadow: none;\r\n  }\r\n  .navbar-collapse.collapse {\r\n    display: block !important;\r\n    height: auto !important;\r\n    padding-bottom: 0;\r\n    overflow: visible !important;\r\n  }\r\n  .navbar-collapse.in {\r\n    overflow-y: visible;\r\n  }\r\n  .navbar-fixed-top .navbar-collapse,\r\n  .navbar-static-top .navbar-collapse,\r\n  .navbar-fixed-bottom .navbar-collapse {\r\n    padding-right: 0;\r\n    padding-left: 0;\r\n  }\r\n}\r\n\r\n.container &gt; .navbar-header,\r\n.container &gt; .navbar-collapse {\r\n  margin-right: -15px;\r\n  margin-left: -15px;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .container &gt; .navbar-header,\r\n  .container &gt; .navbar-collapse {\r\n    margin-right: 0;\r\n    margin-left: 0;\r\n  }\r\n}\r\n\r\n.navbar-static-top {\r\n  z-index: 1000;\r\n  border-width: 0 0 1px;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .navbar-static-top {\r\n    border-radius: 0;\r\n  }\r\n}\r\n\r\n.navbar-fixed-top,\r\n.navbar-fixed-bottom {\r\n  position: fixed;\r\n  right: 0;\r\n  left: 0;\r\n  z-index: 1030;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .navbar-fixed-top,\r\n  .navbar-fixed-bottom {\r\n    border-radius: 0;\r\n  }\r\n}\r\n\r\n.navbar-fixed-top {\r\n  top: 0;\r\n  border-width: 0 0 1px;\r\n}\r\n\r\n.navbar-fixed-bottom {\r\n  bottom: 0;\r\n  margin-bottom: 0;\r\n  border-width: 1px 0 0;\r\n}\r\n\r\n.navbar-brand {\r\n  float: left;\r\n  padding: 15px 15px;\r\n  font-size: 18px;\r\n  line-height: 20px;\r\n}\r\n\r\n.navbar-brand:hover,\r\n.navbar-brand:focus {\r\n  text-decoration: none;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .navbar &gt; .container .navbar-brand {\r\n    margin-left: -15px;\r\n  }\r\n}\r\n\r\n.navbar-toggle {\r\n  position: relative;\r\n  float: right;\r\n  padding: 9px 10px;\r\n  margin-top: 8px;\r\n  margin-right: 15px;\r\n  margin-bottom: 8px;\r\n  background-color: transparent;\r\n  background-image: none;\r\n  border: 1px solid transparent;\r\n  border-radius: 4px;\r\n}\r\n\r\n.navbar-toggle .icon-bar {\r\n  display: block;\r\n  width: 22px;\r\n  height: 2px;\r\n  border-radius: 1px;\r\n}\r\n\r\n.navbar-toggle .icon-bar + .icon-bar {\r\n  margin-top: 4px;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .navbar-toggle {\r\n    display: none;\r\n  }\r\n}\r\n\r\n.navbar-nav {\r\n  margin: 7.5px -15px;\r\n}\r\n\r\n.navbar-nav &gt; li &gt; a {\r\n  padding-top: 10px;\r\n  padding-bottom: 10px;\r\n  line-height: 20px;\r\n}\r\n\r\n@media (max-width: 767px) {\r\n  .navbar-nav .open .dropdown-menu {\r\n    position: static;\r\n    float: none;\r\n    width: auto;\r\n    margin-top: 0;\r\n    background-color: transparent;\r\n    border: 0;\r\n    box-shadow: none;\r\n  }\r\n  .navbar-nav .open .dropdown-menu &gt; li &gt; a,\r\n  .navbar-nav .open .dropdown-menu .dropdown-header {\r\n    padding: 5px 15px 5px 25px;\r\n  }\r\n  .navbar-nav .open .dropdown-menu &gt; li &gt; a {\r\n    line-height: 20px;\r\n  }\r\n  .navbar-nav .open .dropdown-menu &gt; li &gt; a:hover,\r\n  .navbar-nav .open .dropdown-menu &gt; li &gt; a:focus {\r\n    background-image: none;\r\n  }\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .navbar-nav {\r\n    float: left;\r\n    margin: 0;\r\n  }\r\n  .navbar-nav &gt; li {\r\n    float: left;\r\n  }\r\n  .navbar-nav &gt; li &gt; a {\r\n    padding-top: 15px;\r\n    padding-bottom: 15px;\r\n  }\r\n  .navbar-nav.navbar-right:last-child {\r\n    margin-right: -15px;\r\n  }\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .navbar-left {\r\n    float: left !important;\r\n  }\r\n  .navbar-right {\r\n    float: right !important;\r\n  }\r\n}\r\n\r\n.navbar-form {\r\n  padding: 10px 15px;\r\n  margin-top: 8px;\r\n  margin-right: -15px;\r\n  margin-bottom: 8px;\r\n  margin-left: -15px;\r\n  border-top: 1px solid transparent;\r\n  border-bottom: 1px solid transparent;\r\n  -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 0 rgba(255, 255, 255, 0.1);\r\n          box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1), 0 1px 0 rgba(255, 255, 255, 0.1);\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .navbar-form .form-group {\r\n    display: inline-block;\r\n    margin-bottom: 0;\r\n    vertical-align: middle;\r\n  }\r\n  .navbar-form .form-control {\r\n    display: inline-block;\r\n  }\r\n  .navbar-form select.form-control {\r\n    width: auto;\r\n  }\r\n  .navbar-form .radio,\r\n  .navbar-form .checkbox {\r\n    display: inline-block;\r\n    padding-left: 0;\r\n    margin-top: 0;\r\n    margin-bottom: 0;\r\n  }\r\n\r\n}\r\n\r\n@media (max-width: 767px) {\r\n  .navbar-form .form-group {\r\n    margin-bottom: 5px;\r\n  }\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .navbar-form {\r\n    width: auto;\r\n    padding-top: 0;\r\n    padding-bottom: 0;\r\n    margin-right: 0;\r\n    margin-left: 0;\r\n    border: 0;\r\n    -webkit-box-shadow: none;\r\n            box-shadow: none;\r\n  }\r\n  .navbar-form.navbar-right:last-child {\r\n    margin-right: -15px;\r\n  }\r\n}\r\n\r\n.navbar-nav &gt; li &gt; .dropdown-menu {\r\n  margin-top: 0;\r\n  border-top-right-radius: 0;\r\n  border-top-left-radius: 0;\r\n}\r\n\r\n.navbar-fixed-bottom .navbar-nav &gt; li &gt; .dropdown-menu {\r\n  border-bottom-right-radius: 0;\r\n  border-bottom-left-radius: 0;\r\n}\r\n\r\n.navbar-nav.pull-right &gt; li &gt; .dropdown-menu,\r\n.navbar-nav &gt; li &gt; .dropdown-menu.pull-right {\r\n  right: 0;\r\n  left: auto;\r\n}\r\n\r\n.navbar-btn {\r\n  margin-top: 8px;\r\n  margin-bottom: 8px;\r\n}\r\n\r\n.navbar-btn.btn-sm {\r\n  margin-top: 10px;\r\n  margin-bottom: 10px;\r\n}\r\n\r\n.navbar-btn.btn-xs {\r\n  margin-top: 14px;\r\n  margin-bottom: 14px;\r\n}\r\n\r\n.navbar-text {\r\n  margin-top: 15px;\r\n  margin-bottom: 15px;\r\n}\r\n\r\n@media (min-width: 768px) {\r\n  .navbar-text {\r\n    float: left;\r\n    margin-right: 15px;\r\n    margin-left: 15px;\r\n  }\r\n  .navbar-text.navbar-right:last-child {\r\n    margin-right: 0;\r\n  }\r\n}\r\n\r\n.navbar-default {\r\n  background-color: #f8f8f8;\r\n  border-color: #e7e7e7;\r\n}\r\n\r\n.navbar-default .navbar-brand {\r\n  color: #777777;\r\n}\r\n\r\n.navbar-default .navbar-brand:hover,\r\n.navbar-default .navbar-brand:focus {\r\n  color: #5e5e5e;\r\n  background-color: transparent;\r\n}\r\n\r\n.navbar-default .navbar-text {\r\n  color: #777777;\r\n}\r\n\r\n.navbar-default .navbar-nav &gt; li &gt; a {\r\n  color: #777777;\r\n}\r\n\r\n.navbar-default .navbar-nav &gt; li &gt; a:hover,\r\n.navbar-default .navbar-nav &gt; li &gt; a:focus {\r\n  color: #333333;\r\n  background-color: transparent;\r\n}\r\n\r\n.navbar-default .navbar-nav &gt; .active &gt; a,\r\n.navbar-default .navbar-nav &gt; .active &gt; a:hover,\r\n.navbar-default .navbar-nav &gt; .active &gt; a:focus {\r\n  color: #555555;\r\n  background-color: #e7e7e7;\r\n}\r\n\r\n.navbar-default .navbar-nav &gt; .disabled &gt; a,\r\n.navbar-default .navbar-nav &gt; .disabled &gt; a:hover,\r\n.navbar-default .navbar-nav &gt; .disabled &gt; a:focus {\r\n  color: #cccccc;\r\n  background-color: transparent;\r\n}\r\n\r\n.navbar-default .navbar-toggle {\r\n  border-color: #dddddd;\r\n}\r\n\r\n.navbar-default .navbar-toggle:hover,\r\n.navbar-default .navbar-toggle:focus {\r\n  background-color: #dddddd;\r\n}\r\n\r\n.navbar-default .navbar-toggle .icon-bar {\r\n  background-color: #cccccc;\r\n}\r\n\r\n.navbar-default .navbar-collapse,\r\n.navbar-default .navbar-form {\r\n  border-color: #e7e7e7;\r\n}\r\n\r\n.navbar-default .navbar-nav &gt; .open &gt; a,\r\n.navbar-default .navbar-nav &gt; .open &gt; a:hover,\r\n.navbar-default .navbar-nav &gt; .open &gt; a:focus {\r\n  color: #555555;\r\n  background-color: #e7e7e7;\r\n}\r\n\r\n@media (max-width: 767px) {\r\n  .navbar-default .navbar-nav .open .dropdown-menu &gt; li &gt; a {\r\n    color: #777777;\r\n  }\r\n  .navbar-default .navbar-nav .open .dropdown-menu &gt; li &gt; a:hover,\r\n  .navbar-default .navbar-nav .open .dropdown-menu &gt; li &gt; a:focus {\r\n    color: #333333;\r\n    background-color: transparent;\r\n  }\r\n  .navbar-default .navbar-nav .open .dropdown-menu &gt; .active &gt; a,\r\n  .navbar-default .navbar-nav .open .dropdown-menu &gt; .active &gt; a:hover,\r\n  .navbar-default .navbar-nav .open .dropdown-menu &gt; .active &gt; a:focus {\r\n    color: #555555;\r\n    background-color: #e7e7e7;\r\n  }\r\n  .navbar-default .navbar-nav .open .dropdown-menu &gt; .disabled &gt; a,\r\n  .navbar-default .navbar-nav .open .dropdown-menu &gt; .disabled &gt; a:hover,\r\n  .navbar-default .navbar-nav .open .dropdown-menu &gt; .disabled &gt; a:focus {\r\n    color: #cccccc;\r\n    background-color: transparent;\r\n  }\r\n}\r\n\r\n.navbar-default .navbar-link {\r\n  color: #777777;\r\n}\r\n\r\n.navbar-default .navbar-link:hover {\r\n  color: #333333;\r\n}\r\n\r\n.navbar-inverse {\r\n  background-color: #222222;\r\n  border-color: #080808;\r\n}\r\n\r\n.navbar-inverse .navbar-brand {\r\n  color: #999999;\r\n}\r\n\r\n.navbar-inverse .navbar-brand:hover,\r\n.navbar-inverse .navbar-brand:focus {\r\n  color: #ffffff;\r\n  background-color: transparent;\r\n}\r\n\r\n.navbar-inverse .navbar-text {\r\n  color: #999999;\r\n}\r\n\r\n.navbar-inverse .navbar-nav &gt; li &gt; a {\r\n  color: #999999;\r\n}\r\n\r\n.navbar-inverse .navbar-nav &gt; li &gt; a:hover,\r\n.navbar-inverse .navbar-nav &gt; li &gt; a:focus {\r\n  color: #ffffff;\r\n  background-color: transparent;\r\n}\r\n\r\n.navbar-inverse .navbar-nav &gt; .active &gt; a,\r\n.navbar-inverse .navbar-nav &gt; .active &gt; a:hover,\r\n.navbar-inverse .navbar-nav &gt; .active &gt; a:focus {\r\n  color: #ffffff;\r\n  background-color: #080808;\r\n}\r\n\r\n.navbar-inverse .navbar-nav &gt; .disabled &gt; a,\r\n.navbar-inverse .navbar-nav &gt; .disabled &gt; a:hover,\r\n.navbar-inverse .navbar-nav &gt; .disabled &gt; a:focus {\r\n  color: #444444;\r\n  background-color: transparent;\r\n}\r\n\r\n.navbar-inverse .navbar-toggle {\r\n  border-color: #333333;\r\n}\r\n\r\n.navbar-inverse .navbar-toggle:hover,\r\n.navbar-inverse .navbar-toggle:focus {\r\n  background-color: #333333;\r\n}\r\n\r\n.navbar-inverse .navbar-toggle .icon-bar {\r\n  background-color: #ffffff;\r\n}\r\n\r\n.navbar-inverse .navbar-collapse,\r\n.navbar-inverse .navbar-form {\r\n  border-color: #101010;\r\n}\r\n\r\n.navbar-inverse .navbar-nav &gt; .open &gt; a,\r\n.navbar-inverse .navbar-nav &gt; .open &gt; a:hover,\r\n.navbar-inverse .navbar-nav &gt; .open &gt; a:focus {\r\n  color: #ffffff;\r\n  background-color: #080808;\r\n}\r\n\r\n@media (max-width: 767px) {\r\n  .navbar-inverse .navbar-nav .open .dropdown-menu &gt; .dropdown-header {\r\n    border-color: #080808;\r\n  }\r\n  .navbar-inverse .navbar-nav .open .dropdown-menu .divider {\r\n    background-color: #080808;\r\n  }\r\n  .navbar-inverse .navbar-nav .open .dropdown-menu &gt; li &gt; a {\r\n    color: #999999;\r\n  }\r\n  .navbar-inverse .navbar-nav .open .dropdown-menu &gt; li &gt; a:hover,\r\n  .navbar-inverse .navbar-nav .open .dropdown-menu &gt; li &gt; a:focus {\r\n    color: #ffffff;\r\n    background-color: transparent;\r\n  }\r\n  .navbar-inverse .navbar-nav .open .dropdown-menu &gt; .active &gt; a,\r\n  .navbar-inverse .navbar-nav .open .dropdown-menu &gt; .active &gt; a:hover,\r\n  .navbar-inverse .navbar-nav .open .dropdown-menu &gt; .active &gt; a:focus {\r\n    color: #ffffff;\r\n    background-color: #080808;\r\n  }\r\n  .navbar-inverse .navbar-nav .open .dropdown-menu &gt; .disabled &gt; a,\r\n  .navbar-inverse .navbar-nav .open .dropdown-menu &gt; .disabled &gt; a:hover,\r\n  .navbar-inverse .navbar-nav .open .dropdown-menu &gt; .disabled &gt; a:focus {\r\n    color: #444444;\r\n    background-color: transparent;\r\n  }\r\n}\r\n\r\n.navbar-inverse .navbar-link {\r\n  color: #999999;\r\n}\r\n\r\n.navbar-inverse .navbar-link:hover {\r\n  color: #ffffff;\r\n}\r\n\r\n.breadcrumb {\r\n  padding: 8px 15px;\r\n  margin-bottom: 20px;\r\n  list-style: none;\r\n  background-color: #f5f5f5;\r\n  border-radius: 4px;\r\n}\r\n\r\n.breadcrumb &gt; li {\r\n  display: inline-block;\r\n}\r\n\r\n.breadcrumb &gt; li + li:before {\r\n  padding: 0 5px;\r\n  color: #cccccc;\r\n  content: &quot;/a0&quot;;\r\n}\r\n\r\n.breadcrumb &gt; .active {\r\n  color: #999999;\r\n}\r\n\r\n.pagination {\r\n  display: inline-block;\r\n  padding-left: 0;\r\n  margin: 20px 0;\r\n  border-radius: 4px;\r\n}\r\n\r\n.pagination &gt; li {\r\n  display: inline;\r\n}\r\n\r\n.pagination &gt; li &gt; a,\r\n.pagination &gt; li &gt; span {\r\n  position: relative;\r\n  float: left;\r\n  padding: 6px 12px;\r\n  margin-left: -1px;\r\n  line-height: 1.428571429;\r\n  text-decoration: none;\r\n  background-color: #ffffff;\r\n  border: 1px solid #dddddd;\r\n}\r\n\r\n.pagination &gt; li:first-child &gt; a,\r\n.pagination &gt; li:first-child &gt; span {\r\n  margin-left: 0;\r\n  border-bottom-left-radius: 4px;\r\n  border-top-left-radius: 4px;\r\n}\r\n\r\n.pagination &gt; li:last-child &gt; a,\r\n.pagination &gt; li:last-child &gt; span {\r\n  border-top-right-radius: 4px;\r\n  border-bottom-right-radius: 4px;\r\n}\r\n\r\n.pagination &gt; li &gt; a:hover,\r\n.pagination &gt; li &gt; span:hover,\r\n.pagination &gt; li &gt; a:focus,\r\n.pagination &gt; li &gt; span:focus {\r\n  background-color: #eeeeee;\r\n}\r\n\r\n.pagination &gt; .active &gt; a,\r\n.pagination &gt; .active &gt; span,\r\n.pagination &gt; .active &gt; a:hover,\r\n.pagination &gt; .active &gt; span:hover,\r\n.pagination &gt; .active &gt; a:focus,\r\n.pagination &gt; .active &gt; span:focus {\r\n  z-index: 2;\r\n  color: #ffffff;\r\n  cursor: default;\r\n  background-color: #428bca;\r\n  border-color: #428bca;\r\n}\r\n\r\n.pagination &gt; .disabled &gt; span,\r\n.pagination &gt; .disabled &gt; span:hover,\r\n.pagination &gt; .disabled &gt; span:focus,\r\n.pagination &gt; .disabled &gt; a,\r\n.pagination &gt; .disabled &gt; a:hover,\r\n.pagination &gt; .disabled &gt; a:focus {\r\n  color: #999999;\r\n  cursor: not-allowed;\r\n  background-color: #ffffff;\r\n  border-color: #dddddd;\r\n}\r\n\r\n.pagination-lg &gt; li &gt; a,\r\n.pagination-lg &gt; li &gt; span {\r\n  padding: 10px 16px;\r\n  font-size: 18px;\r\n}\r\n\r\n.pagination-lg &gt; li:first-child &gt; a,\r\n.pagination-lg &gt; li:first-child &gt; span {\r\n  border-bottom-left-radius: 6px;\r\n  border-top-left-radius: 6px;\r\n}\r\n\r\n.pagination-lg &gt; li:last-child &gt; a,\r\n.pagination-lg &gt; li:last-child &gt; span {\r\n  border-top-right-radius: 6px;\r\n  border-bottom-right-radius: 6px;\r\n}\r\n\r\n.pagination-sm &gt; li &gt; a,\r\n.pagination-sm &gt; li &gt; span {\r\n  padding: 5px 10px;\r\n  font-size: 12px;\r\n}\r\n\r\n.pagination-sm &gt; li:first-child &gt; a,\r\n.pagination-sm &gt; li:first-child &gt; span {\r\n  border-bottom-left-radius: 3px;\r\n  border-top-left-radius: 3px;\r\n}\r\n\r\n.pagination-sm &gt; li:last-child &gt; a,\r\n.pagination-sm &gt; li:last-child &gt; span {\r\n  border-top-right-radius: 3px;\r\n  border-bottom-right-radius: 3px;\r\n}\r\n\r\n.pager {\r\n  padding-left: 0;\r\n  margin: 20px 0;\r\n  text-align: center;\r\n  list-style: none;\r\n}\r\n\r\n.pager:before,\r\n.pager:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.pager:after {\r\n  clear: both;\r\n}\r\n\r\n.pager:before,\r\n.pager:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.pager:after {\r\n  clear: both;\r\n}\r\n\r\n.pager li {\r\n  display: inline;\r\n}\r\n\r\n.pager li &gt; a,\r\n.pager li &gt; span {\r\n  display: inline-block;\r\n  padding: 5px 14px;\r\n  background-color: #ffffff;\r\n  border: 1px solid #dddddd;\r\n  border-radius: 15px;\r\n}\r\n\r\n.pager li &gt; a:hover,\r\n.pager li &gt; a:focus {\r\n  text-decoration: none;\r\n  background-color: #eeeeee;\r\n}\r\n\r\n.pager .next &gt; a,\r\n.pager .next &gt; span {\r\n  float: right;\r\n}\r\n\r\n.pager .previous &gt; a,\r\n.pager .previous &gt; span {\r\n  float: left;\r\n}\r\n\r\n.pager .disabled &gt; a,\r\n.pager .disabled &gt; a:hover,\r\n.pager .disabled &gt; a:focus,\r\n.pager .disabled &gt; span {\r\n  color: #999999;\r\n  cursor: not-allowed;\r\n  background-color: #ffffff;\r\n}\r\n\r\n.label {\r\n  display: inline;\r\n  padding: .2em .6em .3em;\r\n  font-size: 75%;\r\n  font-weight: bold;\r\n  line-height: 1;\r\n  color: #ffffff;\r\n  text-align: center;\r\n  white-space: nowrap;\r\n  vertical-align: baseline;\r\n  border-radius: .25em;\r\n}\r\n\r\n.label[href]:hover,\r\n.label[href]:focus {\r\n  color: #ffffff;\r\n  text-decoration: none;\r\n  cursor: pointer;\r\n}\r\n\r\n.label:empty {\r\n  display: none;\r\n}\r\n\r\n.btn .label {\r\n  position: relative;\r\n  top: -1px;\r\n}\r\n\r\n.label-default {\r\n  background-color: #999999;\r\n}\r\n\r\n.label-default[href]:hover,\r\n.label-default[href]:focus {\r\n  background-color: #808080;\r\n}\r\n\r\n.label-primary {\r\n  background-color: #428bca;\r\n}\r\n\r\n.label-primary[href]:hover,\r\n.label-primary[href]:focus {\r\n  background-color: #3071a9;\r\n}\r\n\r\n.label-success {\r\n  background-color: #5cb85c;\r\n}\r\n\r\n.label-success[href]:hover,\r\n.label-success[href]:focus {\r\n  background-color: #449d44;\r\n}\r\n\r\n.label-info {\r\n  background-color: #5bc0de;\r\n}\r\n\r\n.label-info[href]:hover,\r\n.label-info[href]:focus {\r\n  background-color: #31b0d5;\r\n}\r\n\r\n.label-warning {\r\n  background-color: #f0ad4e;\r\n}\r\n\r\n.label-warning[href]:hover,\r\n.label-warning[href]:focus {\r\n  background-color: #ec971f;\r\n}\r\n\r\n.label-danger {\r\n  background-color: #d9534f;\r\n}\r\n\r\n.label-danger[href]:hover,\r\n.label-danger[href]:focus {\r\n  background-color: #c9302c;\r\n}\r\n\r\n.badge {\r\n  display: inline-block;\r\n  min-width: 10px;\r\n  padding: 3px 7px;\r\n  font-size: 12px;\r\n  font-weight: bold;\r\n  line-height: 1;\r\n  color: #ffffff;\r\n  text-align: center;\r\n  white-space: nowrap;\r\n  vertical-align: baseline;\r\n  background-color: #999999;\r\n  border-radius: 10px;\r\n}\r\n\r\n.badge:empty {\r\n  display: none;\r\n}\r\n\r\n.btn .badge {\r\n  position: relative;\r\n  top: -1px;\r\n}\r\n\r\na.badge:hover,\r\na.badge:focus {\r\n  color: #ffffff;\r\n  text-decoration: none;\r\n  cursor: pointer;\r\n}\r\n\r\na.list-group-item.active &gt; .badge,\r\n.nav-pills &gt; .active &gt; a &gt; .badge {\r\n  color: #428bca;\r\n  background-color: #ffffff;\r\n}\r\n\r\n.nav-pills &gt; li &gt; a &gt; .badge {\r\n  margin-left: 3px;\r\n}\r\n\r\n.jumbotron {\r\n  padding: 30px;\r\n  margin-bottom: 30px;\r\n  font-size: 21px;\r\n  font-weight: 200;\r\n  line-height: 2.1428571435;\r\n  color: inherit;\r\n  background-color: #eeeeee;\r\n}\r\n\r\n.jumbotron h1,\r\n.jumbotron .h1 {\r\n  line-height: 1;\r\n  color: inherit;\r\n}\r\n\r\n.jumbotron p {\r\n  line-height: 1.4;\r\n}\r\n\r\n.container .jumbotron {\r\n  border-radius: 6px;\r\n}\r\n\r\n.jumbotron .container {\r\n  max-width: 100%;\r\n}\r\n\r\n@media screen and (min-width: 768px) {\r\n  .jumbotron {\r\n    padding-top: 48px;\r\n    padding-bottom: 48px;\r\n  }\r\n  .container .jumbotron {\r\n    padding-right: 60px;\r\n    padding-left: 60px;\r\n  }\r\n  .jumbotron h1,\r\n  .jumbotron .h1 {\r\n    font-size: 63px;\r\n  }\r\n}\r\n\r\n.thumbnail {\r\n  display: block;\r\n  padding: 4px;\r\n  margin-bottom: 20px;\r\n  line-height: 1.428571429;\r\n  background-color: #ffffff;\r\n  border: 1px solid #dddddd;\r\n  border-radius: 4px;\r\n  -webkit-transition: all 0.2s ease-in-out;\r\n          transition: all 0.2s ease-in-out;\r\n}\r\n\r\n.thumbnail &gt; img,\r\n.thumbnail a &gt; img {\r\n  display: block;\r\n  height: auto;\r\n  max-width: 100%;\r\n  margin-right: auto;\r\n  margin-left: auto;\r\n}\r\n\r\na.thumbnail:hover,\r\na.thumbnail:focus,\r\na.thumbnail.active {\r\n  border-color: #428bca;\r\n}\r\n\r\n.thumbnail .caption {\r\n  padding: 9px;\r\n  color: #333333;\r\n}\r\n\r\n.alert {\r\n  padding: 15px;\r\n  margin-bottom: 20px;\r\n  border: 1px solid transparent;\r\n  border-radius: 4px;\r\n}\r\n\r\n.alert h4 {\r\n  margin-top: 0;\r\n  color: inherit;\r\n}\r\n\r\n.alert .alert-link {\r\n  font-weight: bold;\r\n}\r\n\r\n.alert &gt; p,\r\n.alert &gt; ul {\r\n  margin-bottom: 0;\r\n}\r\n\r\n.alert &gt; p + p {\r\n  margin-top: 5px;\r\n}\r\n\r\n.alert-dismissable {\r\n  padding-right: 35px;\r\n}\r\n\r\n.alert-dismissable .close {\r\n  position: relative;\r\n  top: -2px;\r\n  right: -21px;\r\n  color: inherit;\r\n}\r\n\r\n.alert-success {\r\n  color: #3c763d;\r\n  background-color: #dff0d8;\r\n  border-color: #d6e9c6;\r\n}\r\n\r\n.alert-success hr {\r\n  border-top-color: #c9e2b3;\r\n}\r\n\r\n.alert-success .alert-link {\r\n  color: #2b542c;\r\n}\r\n\r\n.alert-info {\r\n  color: #31708f;\r\n  background-color: #d9edf7;\r\n  border-color: #bce8f1;\r\n}\r\n\r\n.alert-info hr {\r\n  border-top-color: #a6e1ec;\r\n}\r\n\r\n.alert-info .alert-link {\r\n  color: #245269;\r\n}\r\n\r\n.alert-warning {\r\n  color: #8a6d3b;\r\n  background-color: #fcf8e3;\r\n  border-color: #faebcc;\r\n}\r\n\r\n.alert-warning hr {\r\n  border-top-color: #f7e1b5;\r\n}\r\n\r\n.alert-warning .alert-link {\r\n  color: #66512c;\r\n}\r\n\r\n.alert-danger {\r\n  color: #a94442;\r\n  background-color: #f2dede;\r\n  border-color: #ebccd1;\r\n}\r\n\r\n.alert-danger hr {\r\n  border-top-color: #e4b9c0;\r\n}\r\n\r\n.alert-danger .alert-link {\r\n  color: #843534;\r\n}\r\n\r\n@-webkit-keyframes progress-bar-stripes {\r\n  from {\r\n    background-position: 40px 0;\r\n  }\r\n  to {\r\n    background-position: 0 0;\r\n  }\r\n}\r\n\r\n@keyframes progress-bar-stripes {\r\n  from {\r\n    background-position: 40px 0;\r\n  }\r\n  to {\r\n    background-position: 0 0;\r\n  }\r\n}\r\n\r\n.progress {\r\n  height: 20px;\r\n  margin-bottom: 20px;\r\n  overflow: hidden;\r\n  background-color: #f5f5f5;\r\n  border-radius: 4px;\r\n  -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);\r\n          box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);\r\n}\r\n\r\n.progress-bar {\r\n  float: left;\r\n  width: 0;\r\n  height: 100%;\r\n  font-size: 12px;\r\n  line-height: 20px;\r\n  color: #ffffff;\r\n  text-align: center;\r\n  background-color: #428bca;\r\n  -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);\r\n          box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);\r\n  -webkit-transition: width 0.6s ease;\r\n          transition: width 0.6s ease;\r\n}\r\n\r\n.progress-striped .progress-bar {\r\n  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n  background-size: 40px 40px;\r\n}\r\n\r\n.progress.active .progress-bar {\r\n  -webkit-animation: progress-bar-stripes 2s linear infinite;\r\n          animation: progress-bar-stripes 2s linear infinite;\r\n}\r\n\r\n.progress-bar-success {\r\n  background-color: #5cb85c;\r\n}\r\n\r\n.progress-striped .progress-bar-success {\r\n  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n}\r\n\r\n.progress-bar-info {\r\n  background-color: #5bc0de;\r\n}\r\n\r\n.progress-striped .progress-bar-info {\r\n  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n}\r\n\r\n.progress-bar-warning {\r\n  background-color: #f0ad4e;\r\n}\r\n\r\n.progress-striped .progress-bar-warning {\r\n  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n}\r\n\r\n.progress-bar-danger {\r\n  background-color: #d9534f;\r\n}\r\n\r\n.progress-striped .progress-bar-danger {\r\n  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);\r\n}\r\n\r\n.media,\r\n.media-body {\r\n  overflow: hidden;\r\n  zoom: 1;\r\n}\r\n\r\n.media,\r\n.media .media {\r\n  margin-top: 15px;\r\n}\r\n\r\n.media:first-child {\r\n  margin-top: 0;\r\n}\r\n\r\n.media-object {\r\n  display: block;\r\n}\r\n\r\n.media-heading {\r\n  margin: 0 0 5px;\r\n}\r\n\r\n.media &gt; .pull-left {\r\n  margin-right: 10px;\r\n}\r\n\r\n.media &gt; .pull-right {\r\n  margin-left: 10px;\r\n}\r\n\r\n.media-list {\r\n  padding-left: 0;\r\n  list-style: none;\r\n}\r\n\r\n.list-group {\r\n  padding-left: 0;\r\n  margin-bottom: 20px;\r\n}\r\n\r\n.list-group-item {\r\n  position: relative;\r\n  display: block;\r\n  padding: 10px 15px;\r\n  margin-bottom: -1px;\r\n  background-color: #ffffff;\r\n  border: 1px solid #dddddd;\r\n}\r\n\r\n.list-group-item:first-child {\r\n  border-top-right-radius: 4px;\r\n  border-top-left-radius: 4px;\r\n}\r\n\r\n.list-group-item:last-child {\r\n  margin-bottom: 0;\r\n  border-bottom-right-radius: 4px;\r\n  border-bottom-left-radius: 4px;\r\n}\r\n\r\n.list-group-item &gt; .badge {\r\n  float: right;\r\n}\r\n\r\n.list-group-item &gt; .badge + .badge {\r\n  margin-right: 5px;\r\n}\r\n\r\na.list-group-item {\r\n  color: #555555;\r\n}\r\n\r\na.list-group-item .list-group-item-heading {\r\n  color: #333333;\r\n}\r\n\r\na.list-group-item:hover,\r\na.list-group-item:focus {\r\n  text-decoration: none;\r\n  background-color: #f5f5f5;\r\n}\r\n\r\na.list-group-item.active,\r\na.list-group-item.active:hover,\r\na.list-group-item.active:focus {\r\n  z-index: 2;\r\n  color: #ffffff;\r\n  background-color: #428bca;\r\n  border-color: #428bca;\r\n}\r\n\r\na.list-group-item.active .list-group-item-heading,\r\na.list-group-item.active:hover .list-group-item-heading,\r\na.list-group-item.active:focus .list-group-item-heading {\r\n  color: inherit;\r\n}\r\n\r\na.list-group-item.active .list-group-item-text,\r\na.list-group-item.active:hover .list-group-item-text,\r\na.list-group-item.active:focus .list-group-item-text {\r\n  color: #e1edf7;\r\n}\r\n\r\n.list-group-item-heading {\r\n  margin-top: 0;\r\n  margin-bottom: 5px;\r\n}\r\n\r\n.list-group-item-text {\r\n  margin-bottom: 0;\r\n  line-height: 1.3;\r\n}\r\n\r\n.panel {\r\n  margin-bottom: 20px;\r\n  background-color: #ffffff;\r\n  border: 1px solid transparent;\r\n  border-radius: 4px;\r\n  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);\r\n          box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);\r\n}\r\n\r\n.panel-body {\r\n  padding: 15px;\r\n}\r\n\r\n.panel-body:before,\r\n.panel-body:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.panel-body:after {\r\n  clear: both;\r\n}\r\n\r\n.panel-body:before,\r\n.panel-body:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.panel-body:after {\r\n  clear: both;\r\n}\r\n\r\n.panel &gt; .list-group {\r\n  margin-bottom: 0;\r\n}\r\n\r\n.panel &gt; .list-group .list-group-item {\r\n  border-width: 1px 0;\r\n}\r\n\r\n.panel &gt; .list-group .list-group-item:first-child {\r\n  border-top-right-radius: 0;\r\n  border-top-left-radius: 0;\r\n}\r\n\r\n.panel &gt; .list-group .list-group-item:last-child {\r\n  border-bottom: 0;\r\n}\r\n\r\n.panel-heading + .list-group .list-group-item:first-child {\r\n  border-top-width: 0;\r\n}\r\n\r\n.panel &gt; .table,\r\n.panel &gt; .table-responsive &gt; .table {\r\n  margin-bottom: 0;\r\n}\r\n\r\n.panel &gt; .panel-body + .table,\r\n.panel &gt; .panel-body + .table-responsive {\r\n  border-top: 1px solid #dddddd;\r\n}\r\n\r\n.panel &gt; .table &gt; tbody:first-child th,\r\n.panel &gt; .table &gt; tbody:first-child td {\r\n  border-top: 0;\r\n}\r\n\r\n.panel &gt; .table-bordered,\r\n.panel &gt; .table-responsive &gt; .table-bordered {\r\n  border: 0;\r\n}\r\n\r\n.panel &gt; .table-bordered &gt; thead &gt; tr &gt; th:first-child,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; thead &gt; tr &gt; th:first-child,\r\n.panel &gt; .table-bordered &gt; tbody &gt; tr &gt; th:first-child,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; tbody &gt; tr &gt; th:first-child,\r\n.panel &gt; .table-bordered &gt; tfoot &gt; tr &gt; th:first-child,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; tfoot &gt; tr &gt; th:first-child,\r\n.panel &gt; .table-bordered &gt; thead &gt; tr &gt; td:first-child,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; thead &gt; tr &gt; td:first-child,\r\n.panel &gt; .table-bordered &gt; tbody &gt; tr &gt; td:first-child,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; tbody &gt; tr &gt; td:first-child,\r\n.panel &gt; .table-bordered &gt; tfoot &gt; tr &gt; td:first-child,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; tfoot &gt; tr &gt; td:first-child {\r\n  border-left: 0;\r\n}\r\n\r\n.panel &gt; .table-bordered &gt; thead &gt; tr &gt; th:last-child,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; thead &gt; tr &gt; th:last-child,\r\n.panel &gt; .table-bordered &gt; tbody &gt; tr &gt; th:last-child,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; tbody &gt; tr &gt; th:last-child,\r\n.panel &gt; .table-bordered &gt; tfoot &gt; tr &gt; th:last-child,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; tfoot &gt; tr &gt; th:last-child,\r\n.panel &gt; .table-bordered &gt; thead &gt; tr &gt; td:last-child,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; thead &gt; tr &gt; td:last-child,\r\n.panel &gt; .table-bordered &gt; tbody &gt; tr &gt; td:last-child,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; tbody &gt; tr &gt; td:last-child,\r\n.panel &gt; .table-bordered &gt; tfoot &gt; tr &gt; td:last-child,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; tfoot &gt; tr &gt; td:last-child {\r\n  border-right: 0;\r\n}\r\n\r\n.panel &gt; .table-bordered &gt; thead &gt; tr:last-child &gt; th,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; thead &gt; tr:last-child &gt; th,\r\n.panel &gt; .table-bordered &gt; tbody &gt; tr:last-child &gt; th,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; tbody &gt; tr:last-child &gt; th,\r\n.panel &gt; .table-bordered &gt; tfoot &gt; tr:last-child &gt; th,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; tfoot &gt; tr:last-child &gt; th,\r\n.panel &gt; .table-bordered &gt; thead &gt; tr:last-child &gt; td,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; thead &gt; tr:last-child &gt; td,\r\n.panel &gt; .table-bordered &gt; tbody &gt; tr:last-child &gt; td,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; tbody &gt; tr:last-child &gt; td,\r\n.panel &gt; .table-bordered &gt; tfoot &gt; tr:last-child &gt; td,\r\n.panel &gt; .table-responsive &gt; .table-bordered &gt; tfoot &gt; tr:last-child &gt; td {\r\n  border-bottom: 0;\r\n}\r\n\r\n.panel &gt; .table-responsive {\r\n  margin-bottom: 0;\r\n  border: 0;\r\n}\r\n\r\n.panel-heading {\r\n  padding: 10px 15px;\r\n  border-bottom: 1px solid transparent;\r\n  border-top-right-radius: 3px;\r\n  border-top-left-radius: 3px;\r\n}\r\n\r\n.panel-heading &gt; .dropdown .dropdown-toggle {\r\n  color: inherit;\r\n}\r\n\r\n.panel-title {\r\n  margin-top: 0;\r\n  margin-bottom: 0;\r\n  font-size: 16px;\r\n  color: inherit;\r\n}\r\n\r\n.panel-title &gt; a {\r\n  color: inherit;\r\n}\r\n\r\n.panel-footer {\r\n  padding: 10px 15px;\r\n  background-color: #f5f5f5;\r\n  border-top: 1px solid #dddddd;\r\n  border-bottom-right-radius: 3px;\r\n  border-bottom-left-radius: 3px;\r\n}\r\n\r\n.panel-group .panel {\r\n  margin-bottom: 0;\r\n  overflow: hidden;\r\n  border-radius: 4px;\r\n}\r\n\r\n.panel-group .panel + .panel {\r\n  margin-top: 5px;\r\n}\r\n\r\n.panel-group .panel-heading {\r\n  border-bottom: 0;\r\n}\r\n\r\n.panel-group .panel-heading + .panel-collapse .panel-body {\r\n  border-top: 1px solid #dddddd;\r\n}\r\n\r\n.panel-group .panel-footer {\r\n  border-top: 0;\r\n}\r\n\r\n.panel-group .panel-footer + .panel-collapse .panel-body {\r\n  border-bottom: 1px solid #dddddd;\r\n}\r\n\r\n.panel-default {\r\n  border-color: #dddddd;\r\n}\r\n\r\n.panel-default &gt; .panel-heading {\r\n  color: #333333;\r\n  background-color: #f5f5f5;\r\n  border-color: #dddddd;\r\n}\r\n\r\n.panel-default &gt; .panel-heading + .panel-collapse .panel-body {\r\n  border-top-color: #dddddd;\r\n}\r\n\r\n.panel-default &gt; .panel-footer + .panel-collapse .panel-body {\r\n  border-bottom-color: #dddddd;\r\n}\r\n\r\n.panel-primary {\r\n  border-color: #428bca;\r\n}\r\n\r\n.panel-primary &gt; .panel-heading {\r\n  color: #ffffff;\r\n  background-color: #428bca;\r\n  border-color: #428bca;\r\n}\r\n\r\n.panel-primary &gt; .panel-heading + .panel-collapse .panel-body {\r\n  border-top-color: #428bca;\r\n}\r\n\r\n.panel-primary &gt; .panel-footer + .panel-collapse .panel-body {\r\n  border-bottom-color: #428bca;\r\n}\r\n\r\n.panel-success {\r\n  border-color: #d6e9c6;\r\n}\r\n\r\n.panel-success &gt; .panel-heading {\r\n  color: #3c763d;\r\n  background-color: #dff0d8;\r\n  border-color: #d6e9c6;\r\n}\r\n\r\n.panel-success &gt; .panel-heading + .panel-collapse .panel-body {\r\n  border-top-color: #d6e9c6;\r\n}\r\n\r\n.panel-success &gt; .panel-footer + .panel-collapse .panel-body {\r\n  border-bottom-color: #d6e9c6;\r\n}\r\n\r\n.panel-warning {\r\n  border-color: #faebcc;\r\n}\r\n\r\n.panel-warning &gt; .panel-heading {\r\n  color: #8a6d3b;\r\n  background-color: #fcf8e3;\r\n  border-color: #faebcc;\r\n}\r\n\r\n.panel-warning &gt; .panel-heading + .panel-collapse .panel-body {\r\n  border-top-color: #faebcc;\r\n}\r\n\r\n.panel-warning &gt; .panel-footer + .panel-collapse .panel-body {\r\n  border-bottom-color: #faebcc;\r\n}\r\n\r\n.panel-danger {\r\n  border-color: #ebccd1;\r\n}\r\n\r\n.panel-danger &gt; .panel-heading {\r\n  color: #a94442;\r\n  background-color: #f2dede;\r\n  border-color: #ebccd1;\r\n}\r\n\r\n.panel-danger &gt; .panel-heading + .panel-collapse .panel-body {\r\n  border-top-color: #ebccd1;\r\n}\r\n\r\n.panel-danger &gt; .panel-footer + .panel-collapse .panel-body {\r\n  border-bottom-color: #ebccd1;\r\n}\r\n\r\n.panel-info {\r\n  border-color: #bce8f1;\r\n}\r\n\r\n.panel-info &gt; .panel-heading {\r\n  color: #31708f;\r\n  background-color: #d9edf7;\r\n  border-color: #bce8f1;\r\n}\r\n\r\n.panel-info &gt; .panel-heading + .panel-collapse .panel-body {\r\n  border-top-color: #bce8f1;\r\n}\r\n\r\n.panel-info &gt; .panel-footer + .panel-collapse .panel-body {\r\n  border-bottom-color: #bce8f1;\r\n}\r\n\r\n.well {\r\n  min-height: 20px;\r\n  padding: 19px;\r\n  margin-bottom: 20px;\r\n  background-color: #f5f5f5;\r\n  border: 1px solid #e3e3e3;\r\n  border-radius: 4px;\r\n  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);\r\n          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);\r\n}\r\n\r\n.well blockquote {\r\n  border-color: #ddd;\r\n  border-color: rgba(0, 0, 0, 0.15);\r\n}\r\n\r\n.well-lg {\r\n  padding: 24px;\r\n  border-radius: 6px;\r\n}\r\n\r\n.well-sm {\r\n  padding: 9px;\r\n  border-radius: 3px;\r\n}\r\n\r\n.close {\r\n  float: right;\r\n  font-size: 21px;\r\n  font-weight: bold;\r\n  line-height: 1;\r\n  color: #000000;\r\n  text-shadow: 0 1px 0 #ffffff;\r\n  opacity: 0.2;\r\n  filter: alpha(opacity=20);\r\n}\r\n\r\n.close:hover,\r\n.close:focus {\r\n  color: #000000;\r\n  text-decoration: none;\r\n  cursor: pointer;\r\n  opacity: 0.5;\r\n  filter: alpha(opacity=50);\r\n}\r\n\r\nbutton.close {\r\n  padding: 0;\r\n  cursor: pointer;\r\n  background: transparent;\r\n  border: 0;\r\n  -webkit-appearance: none;\r\n}\r\n\r\n\r\n.tooltip {\r\n  position: absolute;\r\n  z-index: 1030;\r\n  display: block;\r\n  font-size: 12px;\r\n  line-height: 1.4;\r\n  opacity: 0;\r\n  filter: alpha(opacity=0);\r\n  visibility: visible;\r\n}\r\n\r\n.tooltip.in {\r\n  opacity: 0.9;\r\n  filter: alpha(opacity=90);\r\n}\r\n\r\n.tooltip.top {\r\n  padding: 5px 0;\r\n  margin-top: -3px;\r\n}\r\n\r\n.tooltip.right {\r\n  padding: 0 5px;\r\n  margin-left: 3px;\r\n}\r\n\r\n.tooltip.bottom {\r\n  padding: 5px 0;\r\n  margin-top: 3px;\r\n}\r\n\r\n.tooltip.left {\r\n  padding: 0 5px;\r\n  margin-left: -3px;\r\n}\r\n\r\n.tooltip-inner {\r\n  max-width: 200px;\r\n  padding: 3px 8px;\r\n  color: #ffffff;\r\n  text-align: center;\r\n  text-decoration: none;\r\n  background-color: #000000;\r\n  border-radius: 4px;\r\n}\r\n\r\n.tooltip-arrow {\r\n  position: absolute;\r\n  width: 0;\r\n  height: 0;\r\n  border-color: transparent;\r\n  border-style: solid;\r\n}\r\n\r\n.tooltip.top .tooltip-arrow {\r\n  bottom: 0;\r\n  left: 50%;\r\n  margin-left: -5px;\r\n  border-top-color: #000000;\r\n  border-width: 5px 5px 0;\r\n}\r\n\r\n.tooltip.top-left .tooltip-arrow {\r\n  bottom: 0;\r\n  left: 5px;\r\n  border-top-color: #000000;\r\n  border-width: 5px 5px 0;\r\n}\r\n\r\n.tooltip.top-right .tooltip-arrow {\r\n  right: 5px;\r\n  bottom: 0;\r\n  border-top-color: #000000;\r\n  border-width: 5px 5px 0;\r\n}\r\n\r\n.tooltip.right .tooltip-arrow {\r\n  top: 50%;\r\n  left: 0;\r\n  margin-top: -5px;\r\n  border-right-color: #000000;\r\n  border-width: 5px 5px 5px 0;\r\n}\r\n\r\n.tooltip.left .tooltip-arrow {\r\n  top: 50%;\r\n  right: 0;\r\n  margin-top: -5px;\r\n  border-left-color: #000000;\r\n  border-width: 5px 0 5px 5px;\r\n}\r\n\r\n.tooltip.bottom .tooltip-arrow {\r\n  top: 0;\r\n  left: 50%;\r\n  margin-left: -5px;\r\n  border-bottom-color: #000000;\r\n  border-width: 0 5px 5px;\r\n}\r\n\r\n.tooltip.bottom-left .tooltip-arrow {\r\n  top: 0;\r\n  left: 5px;\r\n  border-bottom-color: #000000;\r\n  border-width: 0 5px 5px;\r\n}\r\n\r\n.tooltip.bottom-right .tooltip-arrow {\r\n  top: 0;\r\n  right: 5px;\r\n  border-bottom-color: #000000;\r\n  border-width: 0 5px 5px;\r\n}\r\n\r\n.popover {\r\n  position: absolute;\r\n  top: 0;\r\n  left: 0;\r\n  z-index: 1010;\r\n  display: none;\r\n  max-width: 276px;\r\n  padding: 1px;\r\n  text-align: left;\r\n  white-space: normal;\r\n  background-color: #ffffff;\r\n  border: 1px solid #cccccc;\r\n  border: 1px solid rgba(0, 0, 0, 0.2);\r\n  border-radius: 6px;\r\n  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n          box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);\r\n  background-clip: padding-box;\r\n}\r\n\r\n.popover.top {\r\n  margin-top: -10px;\r\n}\r\n\r\n.popover.right {\r\n  margin-left: 10px;\r\n}\r\n\r\n.popover.bottom {\r\n  margin-top: 10px;\r\n}\r\n\r\n.popover.left {\r\n  margin-left: -10px;\r\n}\r\n\r\n.popover-title {\r\n  padding: 8px 14px;\r\n  margin: 0;\r\n  font-size: 14px;\r\n  font-weight: normal;\r\n  line-height: 18px;\r\n  background-color: #f7f7f7;\r\n  border-bottom: 1px solid #ebebeb;\r\n  border-radius: 5px 5px 0 0;\r\n}\r\n\r\n.popover-content {\r\n  padding: 9px 14px;\r\n}\r\n\r\n.popover .arrow,\r\n.popover .arrow:after {\r\n  position: absolute;\r\n  display: block;\r\n  width: 0;\r\n  height: 0;\r\n  border-color: transparent;\r\n  border-style: solid;\r\n}\r\n\r\n.popover .arrow {\r\n  border-width: 11px;\r\n}\r\n\r\n.popover .arrow:after {\r\n  border-width: 10px;\r\n  content: &quot;&quot;;\r\n}\r\n\r\n.popover.top .arrow {\r\n  bottom: -11px;\r\n  left: 50%;\r\n  margin-left: -11px;\r\n  border-top-color: #999999;\r\n  border-top-color: rgba(0, 0, 0, 0.25);\r\n  border-bottom-width: 0;\r\n}\r\n\r\n.popover.top .arrow:after {\r\n  bottom: 1px;\r\n  margin-left: -10px;\r\n  border-top-color: #ffffff;\r\n  border-bottom-width: 0;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.popover.right .arrow {\r\n  top: 50%;\r\n  left: -11px;\r\n  margin-top: -11px;\r\n  border-right-color: #999999;\r\n  border-right-color: rgba(0, 0, 0, 0.25);\r\n  border-left-width: 0;\r\n}\r\n\r\n.popover.right .arrow:after {\r\n  bottom: -10px;\r\n  left: 1px;\r\n  border-right-color: #ffffff;\r\n  border-left-width: 0;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.popover.bottom .arrow {\r\n  top: -11px;\r\n  left: 50%;\r\n  margin-left: -11px;\r\n  border-bottom-color: #999999;\r\n  border-bottom-color: rgba(0, 0, 0, 0.25);\r\n  border-top-width: 0;\r\n}\r\n\r\n.popover.bottom .arrow:after {\r\n  top: 1px;\r\n  margin-left: -10px;\r\n  border-bottom-color: #ffffff;\r\n  border-top-width: 0;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.popover.left .arrow {\r\n  top: 50%;\r\n  right: -11px;\r\n  margin-top: -11px;\r\n  border-left-color: #999999;\r\n  border-left-color: rgba(0, 0, 0, 0.25);\r\n  border-right-width: 0;\r\n}\r\n\r\n.popover.left .arrow:after {\r\n  right: 1px;\r\n  bottom: -10px;\r\n  border-left-color: #ffffff;\r\n  border-right-width: 0;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.carousel {\r\n  position: relative;\r\n}\r\n\r\n.carousel-inner {\r\n  position: relative;\r\n  width: 100%;\r\n  overflow: hidden;\r\n}\r\n\r\n.carousel-inner &gt; .item {\r\n  position: relative;\r\n  display: none;\r\n  -webkit-transition: 0.6s ease-in-out left;\r\n          transition: 0.6s ease-in-out left;\r\n}\r\n\r\n.carousel-inner &gt; .item &gt; img,\r\n.carousel-inner &gt; .item &gt; a &gt; img {\r\n  display: block;\r\n  height: auto;\r\n  max-width: 100%;\r\n  line-height: 1;\r\n}\r\n\r\n.carousel-inner &gt; .active,\r\n.carousel-inner &gt; .next,\r\n.carousel-inner &gt; .prev {\r\n  display: block;\r\n}\r\n\r\n.carousel-inner &gt; .active {\r\n  left: 0;\r\n}\r\n\r\n.carousel-inner &gt; .next,\r\n.carousel-inner &gt; .prev {\r\n  position: absolute;\r\n  top: 0;\r\n  width: 100%;\r\n}\r\n\r\n.carousel-inner &gt; .next {\r\n  left: 100%;\r\n}\r\n\r\n.carousel-inner &gt; .prev {\r\n  left: -100%;\r\n}\r\n\r\n.carousel-inner &gt; .next.left,\r\n.carousel-inner &gt; .prev.right {\r\n  left: 0;\r\n}\r\n\r\n.carousel-inner &gt; .active.left {\r\n  left: -100%;\r\n}\r\n\r\n.carousel-inner &gt; .active.right {\r\n  left: 100%;\r\n}\r\n\r\n.carousel-control {\r\n  position: absolute;\r\n  top: 0;\r\n  bottom: 0;\r\n  left: 0;\r\n  width: 15%;\r\n  font-size: 20px;\r\n  color: #ffffff;\r\n  text-align: center;\r\n  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);\r\n  opacity: 0.5;\r\n  filter: alpha(opacity=50);\r\n}\r\n\r\n.carousel-control.left {\r\n  background-image: -webkit-linear-gradient(left, color-stop(rgba(0, 0, 0, 0.5) 0), color-stop(rgba(0, 0, 0, 0.0001) 100%));\r\n  background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5) 0, rgba(0, 0, 0, 0.0001) 100%);\r\n  background-repeat: repeat-x;\r\n  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#80000000&#039;, endColorstr=&#039;#00000000&#039;, GradientType=1);\r\n}\r\n\r\n.carousel-control.right {\r\n  right: 0;\r\n  left: auto;\r\n  background-image: -webkit-linear-gradient(left, color-stop(rgba(0, 0, 0, 0.0001) 0), color-stop(rgba(0, 0, 0, 0.5) 100%));\r\n  background-image: linear-gradient(to right, rgba(0, 0, 0, 0.0001) 0, rgba(0, 0, 0, 0.5) 100%);\r\n  background-repeat: repeat-x;\r\n  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#039;#00000000&#039;, endColorstr=&#039;#80000000&#039;, GradientType=1);\r\n}\r\n\r\n.carousel-control:hover,\r\n.carousel-control:focus {\r\n  color: #ffffff;\r\n  text-decoration: none;\r\n  outline: none;\r\n  opacity: 0.9;\r\n  filter: alpha(opacity=90);\r\n}\r\n\r\n.carousel-control .icon-prev,\r\n.carousel-control .icon-next,\r\n.carousel-control .glyphicon-chevron-left,\r\n.carousel-control .glyphicon-chevron-right {\r\n  position: absolute;\r\n  top: 50%;\r\n  z-index: 5;\r\n  display: inline-block;\r\n}\r\n\r\n.carousel-control .icon-prev,\r\n.carousel-control .glyphicon-chevron-left {\r\n  left: 50%;\r\n}\r\n\r\n.carousel-control .icon-next,\r\n.carousel-control .glyphicon-chevron-right {\r\n  right: 50%;\r\n}\r\n\r\n.carousel-control .icon-prev,\r\n.carousel-control .icon-next {\r\n  width: 20px;\r\n  height: 20px;\r\n  margin-top: -10px;\r\n  margin-left: -10px;\r\n  font-family: serif;\r\n}\r\n\r\n.carousel-control .icon-prev:before {\r\n  content: &#039;2039&#039;;\r\n}\r\n\r\n.carousel-control .icon-next:before {\r\n  content: &#039;203a&#039;;\r\n}\r\n\r\n.carousel-indicators {\r\n  position: absolute;\r\n  bottom: 10px;\r\n  left: 50%;\r\n  z-index: 15;\r\n  width: 60%;\r\n  padding-left: 0;\r\n  margin-left: -30%;\r\n  text-align: center;\r\n  list-style: none;\r\n}\r\n\r\n.carousel-indicators li {\r\n  display: inline-block;\r\n  width: 10px;\r\n  height: 10px;\r\n  margin: 1px;\r\n  text-indent: -999px;\r\n  cursor: pointer;\r\n  background-color: #000 9;\r\n  background-color: rgba(0, 0, 0, 0);\r\n  border: 1px solid #ffffff;\r\n  border-radius: 10px;\r\n}\r\n\r\n.carousel-indicators .active {\r\n  width: 12px;\r\n  height: 12px;\r\n  margin: 0;\r\n  background-color: #ffffff;\r\n}\r\n\r\n.carousel-caption {\r\n  position: absolute;\r\n  right: 15%;\r\n  bottom: 20px;\r\n  left: 15%;\r\n  z-index: 10;\r\n  padding-top: 20px;\r\n  padding-bottom: 20px;\r\n  color: #ffffff;\r\n  text-align: center;\r\n  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);\r\n}\r\n\r\n.carousel-caption .btn {\r\n  text-shadow: none;\r\n}\r\n\r\n@media screen and (min-width: 768px) {\r\n  .carousel-control .glyphicons-chevron-left,\r\n  .carousel-control .glyphicons-chevron-right,\r\n  .carousel-control .icon-prev,\r\n  .carousel-control .icon-next {\r\n    width: 30px;\r\n    height: 30px;\r\n    margin-top: -15px;\r\n    margin-left: -15px;\r\n    font-size: 30px;\r\n  }\r\n  .carousel-caption {\r\n    right: 20%;\r\n    left: 20%;\r\n    padding-bottom: 30px;\r\n  }\r\n  .carousel-indicators {\r\n    bottom: 20px;\r\n  }\r\n}\r\n\r\n.clearfix:before,\r\n.clearfix:after {\r\n  display: table;\r\n  content: &quot; &quot;;\r\n}\r\n\r\n.clearfix:after {\r\n  clear: both;\r\n}\r\n\r\n.center-block {\r\n  display: block;\r\n  margin-right: auto;\r\n  margin-left: auto;\r\n}\r\n\r\n.pull-right {\r\n  float: right !important;\r\n}\r\n\r\n.pull-left {\r\n  float: left !important;\r\n}\r\n\r\n.show {\r\n  display: block !important;\r\n}\r\n\r\n.invisible {\r\n  visibility: hidden;\r\n}\r\n\r\n.text-hide {\r\n  font: 0/0 a;\r\n  color: transparent;\r\n  text-shadow: none;\r\n  background-color: transparent;\r\n  border: 0;\r\n}\r\n\r\n.hidden {\r\n  display: none !important;\r\n  visibility: hidden !important;\r\n}\r\n\r\n.affix {\r\n  position: fixed;\r\n}\r\n\r\n\r\n.visible-xs,\r\ntr.visible-xs,\r\nth.visible-xs,\r\ntd.visible-xs {\r\n  display: none !important;\r\n}\r\n\r\n\r\n@media (max-width: 767px) {\r\n  .visible-xs {\r\n    display: block !important;\r\n  }\r\n  table.visible-xs {\r\n    display: table;\r\n  }\r\n  tr.visible-xs {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-xs,\r\n  td.visible-xs {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 768px) and (max-width: 991px) {\r\n  .visible-xs.visible-sm {\r\n    display: block !important;\r\n  }\r\n  table.visible-xs.visible-sm {\r\n    display: table;\r\n  }\r\n  tr.visible-xs.visible-sm {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-xs.visible-sm,\r\n  td.visible-xs.visible-sm {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 992px) and (max-width: 1199px) {\r\n  .visible-xs.visible-md {\r\n    display: block !important;\r\n  }\r\n  table.visible-xs.visible-md {\r\n    display: table;\r\n  }\r\n  tr.visible-xs.visible-md {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-xs.visible-md,\r\n  td.visible-xs.visible-md {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 1200px) {\r\n  .visible-xs.visible-lg {\r\n    display: block !important;\r\n  }\r\n  table.visible-xs.visible-lg {\r\n    display: table;\r\n  }\r\n  tr.visible-xs.visible-lg {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-xs.visible-lg,\r\n  td.visible-xs.visible-lg {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n.visible-sm,\r\ntr.visible-sm,\r\nth.visible-sm,\r\ntd.visible-sm {\r\n  display: none !important;\r\n}\r\n\r\n@media (max-width: 767px) {\r\n  .visible-sm.visible-xs {\r\n    display: block !important;\r\n  }\r\n  table.visible-sm.visible-xs {\r\n    display: table;\r\n  }\r\n  tr.visible-sm.visible-xs {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-sm.visible-xs,\r\n  td.visible-sm.visible-xs {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 768px) and (max-width: 991px) {\r\n  .visible-sm {\r\n    display: block !important;\r\n  }\r\n  table.visible-sm {\r\n    display: table;\r\n  }\r\n  tr.visible-sm {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-sm,\r\n  td.visible-sm {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 992px) and (max-width: 1199px) {\r\n  .visible-sm.visible-md {\r\n    display: block !important;\r\n  }\r\n  table.visible-sm.visible-md {\r\n    display: table;\r\n  }\r\n  tr.visible-sm.visible-md {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-sm.visible-md,\r\n  td.visible-sm.visible-md {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 1200px) {\r\n  .visible-sm.visible-lg {\r\n    display: block !important;\r\n  }\r\n  table.visible-sm.visible-lg {\r\n    display: table;\r\n  }\r\n  tr.visible-sm.visible-lg {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-sm.visible-lg,\r\n  td.visible-sm.visible-lg {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n.visible-md,\r\ntr.visible-md,\r\nth.visible-md,\r\ntd.visible-md {\r\n  display: none !important;\r\n}\r\n\r\n@media (max-width: 767px) {\r\n  .visible-md.visible-xs {\r\n    display: block !important;\r\n  }\r\n  table.visible-md.visible-xs {\r\n    display: table;\r\n  }\r\n  tr.visible-md.visible-xs {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-md.visible-xs,\r\n  td.visible-md.visible-xs {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 768px) and (max-width: 991px) {\r\n  .visible-md.visible-sm {\r\n    display: block !important;\r\n  }\r\n  table.visible-md.visible-sm {\r\n    display: table;\r\n  }\r\n  tr.visible-md.visible-sm {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-md.visible-sm,\r\n  td.visible-md.visible-sm {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 992px) and (max-width: 1199px) {\r\n  .visible-md {\r\n    display: block !important;\r\n  }\r\n  table.visible-md {\r\n    display: table;\r\n  }\r\n  tr.visible-md {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-md,\r\n  td.visible-md {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 1200px) {\r\n  .visible-md.visible-lg {\r\n    display: block !important;\r\n  }\r\n  table.visible-md.visible-lg {\r\n    display: table;\r\n  }\r\n  tr.visible-md.visible-lg {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-md.visible-lg,\r\n  td.visible-md.visible-lg {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n.visible-lg,\r\ntr.visible-lg,\r\nth.visible-lg,\r\ntd.visible-lg {\r\n  display: none !important;\r\n}\r\n\r\n@media (max-width: 767px) {\r\n  .visible-lg.visible-xs {\r\n    display: block !important;\r\n  }\r\n  table.visible-lg.visible-xs {\r\n    display: table;\r\n  }\r\n  tr.visible-lg.visible-xs {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-lg.visible-xs,\r\n  td.visible-lg.visible-xs {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 768px) and (max-width: 991px) {\r\n  .visible-lg.visible-sm {\r\n    display: block !important;\r\n  }\r\n  table.visible-lg.visible-sm {\r\n    display: table;\r\n  }\r\n  tr.visible-lg.visible-sm {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-lg.visible-sm,\r\n  td.visible-lg.visible-sm {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 992px) and (max-width: 1199px) {\r\n  .visible-lg.visible-md {\r\n    display: block !important;\r\n  }\r\n  table.visible-lg.visible-md {\r\n    display: table;\r\n  }\r\n  tr.visible-lg.visible-md {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-lg.visible-md,\r\n  td.visible-lg.visible-md {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 1200px) {\r\n  .visible-lg {\r\n    display: block !important;\r\n  }\r\n  table.visible-lg {\r\n    display: table;\r\n  }\r\n  tr.visible-lg {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-lg,\r\n  td.visible-lg {\r\n    display: table-cell !important;\r\n  }\r\n}\r\n\r\n.hidden-xs {\r\n  display: block !important;\r\n}\r\n\r\ntable.hidden-xs {\r\n  display: table;\r\n}\r\n\r\ntr.hidden-xs {\r\n  display: table-row !important;\r\n}\r\n\r\nth.hidden-xs,\r\ntd.hidden-xs {\r\n  display: table-cell !important;\r\n}\r\n\r\n@media (max-width: 767px) {\r\n  .hidden-xs,\r\n  tr.hidden-xs,\r\n  th.hidden-xs,\r\n  td.hidden-xs {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 768px) and (max-width: 991px) {\r\n  .hidden-xs.hidden-sm,\r\n  tr.hidden-xs.hidden-sm,\r\n  th.hidden-xs.hidden-sm,\r\n  td.hidden-xs.hidden-sm {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 992px) and (max-width: 1199px) {\r\n  .hidden-xs.hidden-md,\r\n  tr.hidden-xs.hidden-md,\r\n  th.hidden-xs.hidden-md,\r\n  td.hidden-xs.hidden-md {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 1200px) {\r\n  .hidden-xs.hidden-lg,\r\n  tr.hidden-xs.hidden-lg,\r\n  th.hidden-xs.hidden-lg,\r\n  td.hidden-xs.hidden-lg {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n.hidden-sm {\r\n  display: block !important;\r\n}\r\n\r\ntable.hidden-sm {\r\n  display: table;\r\n}\r\n\r\ntr.hidden-sm {\r\n  display: table-row !important;\r\n}\r\n\r\nth.hidden-sm,\r\ntd.hidden-sm {\r\n  display: table-cell !important;\r\n}\r\n\r\n@media (max-width: 767px) {\r\n  .hidden-sm.hidden-xs,\r\n  tr.hidden-sm.hidden-xs,\r\n  th.hidden-sm.hidden-xs,\r\n  td.hidden-sm.hidden-xs {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 768px) and (max-width: 991px) {\r\n  .hidden-sm,\r\n  tr.hidden-sm,\r\n  th.hidden-sm,\r\n  td.hidden-sm {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 992px) and (max-width: 1199px) {\r\n  .hidden-sm.hidden-md,\r\n  tr.hidden-sm.hidden-md,\r\n  th.hidden-sm.hidden-md,\r\n  td.hidden-sm.hidden-md {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 1200px) {\r\n  .hidden-sm.hidden-lg,\r\n  tr.hidden-sm.hidden-lg,\r\n  th.hidden-sm.hidden-lg,\r\n  td.hidden-sm.hidden-lg {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n.hidden-md {\r\n  display: block !important;\r\n}\r\n\r\ntable.hidden-md {\r\n  display: table;\r\n}\r\n\r\ntr.hidden-md {\r\n  display: table-row !important;\r\n}\r\n\r\nth.hidden-md,\r\ntd.hidden-md {\r\n  display: table-cell !important;\r\n}\r\n\r\n@media (max-width: 767px) {\r\n  .hidden-md.hidden-xs,\r\n  tr.hidden-md.hidden-xs,\r\n  th.hidden-md.hidden-xs,\r\n  td.hidden-md.hidden-xs {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 768px) and (max-width: 991px) {\r\n  .hidden-md.hidden-sm,\r\n  tr.hidden-md.hidden-sm,\r\n  th.hidden-md.hidden-sm,\r\n  td.hidden-md.hidden-sm {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 992px) and (max-width: 1199px) {\r\n  .hidden-md,\r\n  tr.hidden-md,\r\n  th.hidden-md,\r\n  td.hidden-md {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 1200px) {\r\n  .hidden-md.hidden-lg,\r\n  tr.hidden-md.hidden-lg,\r\n  th.hidden-md.hidden-lg,\r\n  td.hidden-md.hidden-lg {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n.hidden-lg {\r\n  display: block !important;\r\n}\r\n\r\ntable.hidden-lg {\r\n  display: table;\r\n}\r\n\r\ntr.hidden-lg {\r\n  display: table-row !important;\r\n}\r\n\r\nth.hidden-lg,\r\ntd.hidden-lg {\r\n  display: table-cell !important;\r\n}\r\n\r\n@media (max-width: 767px) {\r\n  .hidden-lg.hidden-xs,\r\n  tr.hidden-lg.hidden-xs,\r\n  th.hidden-lg.hidden-xs,\r\n  td.hidden-lg.hidden-xs {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 768px) and (max-width: 991px) {\r\n  .hidden-lg.hidden-sm,\r\n  tr.hidden-lg.hidden-sm,\r\n  th.hidden-lg.hidden-sm,\r\n  td.hidden-lg.hidden-sm {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 992px) and (max-width: 1199px) {\r\n  .hidden-lg.hidden-md,\r\n  tr.hidden-lg.hidden-md,\r\n  th.hidden-lg.hidden-md,\r\n  td.hidden-lg.hidden-md {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n@media (min-width: 1200px) {\r\n  .hidden-lg,\r\n  tr.hidden-lg,\r\n  th.hidden-lg,\r\n  td.hidden-lg {\r\n    display: none !important;\r\n  }\r\n}\r\n\r\n.visible-print,\r\ntr.visible-print,\r\nth.visible-print,\r\ntd.visible-print {\r\n  display: none !important;\r\n}\r\n\r\n@media print {\r\n  .visible-print {\r\n    display: block !important;\r\n  }\r\n  table.visible-print {\r\n    display: table;\r\n  }\r\n  tr.visible-print {\r\n    display: table-row !important;\r\n  }\r\n  th.visible-print,\r\n  td.visible-print {\r\n    display: table-cell !important;\r\n  }\r\n  .hidden-print,\r\n  tr.hidden-print,\r\n  th.hidden-print,\r\n  td.hidden-print {\r\n    display: none !important;\r\n  }\r\n}', '2016-04-22 01:37:21', null);

-- ----------------------------
-- Table structure for shop_url_uso
-- ----------------------------
DROP TABLE IF EXISTS `shop_url_uso`;
CREATE TABLE `shop_url_uso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_referencia_categoria` int(11) DEFAULT NULL,
  `id_referencia_produto` int(11) DEFAULT NULL,
  `base_url` varchar(45) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shop_url_uso_fk_1_idx` (`id_referencia_produto`) USING BTREE,
  KEY `shop_url_uso_fk_2_idx` (`id_referencia_categoria`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=338 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_url_uso
-- ----------------------------
INSERT INTO `shop_url_uso` VALUES ('332', null, null, 'produto', 'ssssssssssss', '2015-05-16 13:52:41');
INSERT INTO `shop_url_uso` VALUES ('334', null, null, 'produto', 'ssssssssssssssssssssssssssssss', '2015-05-16 14:36:00');
INSERT INTO `shop_url_uso` VALUES ('336', null, null, 'produto', 'ssssssssssssss-dfasdas', '2015-05-16 18:08:28');
INSERT INTO `shop_url_uso` VALUES ('337', null, null, 'produto', 'sgfasdg', '2015-05-16 18:11:00');

-- ----------------------------
-- Table structure for situacao_fatura
-- ----------------------------
DROP TABLE IF EXISTS `situacao_fatura`;
CREATE TABLE `situacao_fatura` (
  `id_situacao` int(11) NOT NULL AUTO_INCREMENT,
  `situacao` varchar(45) NOT NULL,
  PRIMARY KEY (`id_situacao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of situacao_fatura
-- ----------------------------
INSERT INTO `situacao_fatura` VALUES ('1', 'Aguardando processamento... ');
INSERT INTO `situacao_fatura` VALUES ('2', 'Pendente');
INSERT INTO `situacao_fatura` VALUES ('3', 'Cancelado');
INSERT INTO `situacao_fatura` VALUES ('4', 'Em suspenso');
INSERT INTO `situacao_fatura` VALUES ('5', 'Pago');

-- ----------------------------
-- Table structure for sub
-- ----------------------------
DROP TABLE IF EXISTS `sub`;
CREATE TABLE `sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `virtual_uri` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sub
-- ----------------------------
INSERT INTO `sub` VALUES ('1', 'wizard', '2014-06-25 21:48:11');
INSERT INTO `sub` VALUES ('2', 'g1testes', '2014-06-25 21:51:27');

-- ----------------------------
-- Table structure for subdominio_nao_permitido
-- ----------------------------
DROP TABLE IF EXISTS `subdominio_nao_permitido`;
CREATE TABLE `subdominio_nao_permitido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subdominio` varchar(150) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subdominio_Unique` (`subdominio`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of subdominio_nao_permitido
-- ----------------------------
INSERT INTO `subdominio_nao_permitido` VALUES ('1', 'painel-admin', '2014-06-16 00:07:56');
INSERT INTO `subdominio_nao_permitido` VALUES ('2', 'ajuda', '2014-06-16 00:07:56');
INSERT INTO `subdominio_nao_permitido` VALUES ('3', 'accounts', '2014-06-16 00:07:56');
INSERT INTO `subdominio_nao_permitido` VALUES ('4', 'painel', '2014-06-16 00:07:56');
INSERT INTO `subdominio_nao_permitido` VALUES ('5', 'shopping', '2014-06-16 00:07:56');
INSERT INTO `subdominio_nao_permitido` VALUES ('6', 'suporte', '2014-06-16 00:07:56');
INSERT INTO `subdominio_nao_permitido` VALUES ('7', 'loja', '2014-06-16 00:07:56');
INSERT INTO `subdominio_nao_permitido` VALUES ('8', 'webmail', '2014-06-16 00:07:56');
INSERT INTO `subdominio_nao_permitido` VALUES ('9', 'forum', '2014-06-16 00:07:56');
INSERT INTO `subdominio_nao_permitido` VALUES ('10', 'lojas', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('11', 'blog', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('12', 'templates', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('13', 'template', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('14', 'blogs', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('15', 'atendimento', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('16', 'sac', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('17', 'ticket', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('18', 'tickets', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('19', 'conta', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('20', 'news', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('21', 'newsletter', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('22', 'mkt', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('23', 'marketing', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('24', 'sistema', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('25', 'app', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('26', 'mobile', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('27', 'm', '2014-06-16 00:23:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('28', 'layouts', '2014-06-16 00:46:10');
INSERT INTO `subdominio_nao_permitido` VALUES ('29', 'layout', '2014-06-16 00:46:13');
INSERT INTO `subdominio_nao_permitido` VALUES ('30', 'admin', '2014-06-16 00:46:14');
INSERT INTO `subdominio_nao_permitido` VALUES ('31', 'login', '2014-06-16 00:46:15');
INSERT INTO `subdominio_nao_permitido` VALUES ('32', 'email', '2014-06-16 00:47:12');
INSERT INTO `subdominio_nao_permitido` VALUES ('33', 'contas', '2014-06-16 00:47:14');
INSERT INTO `subdominio_nao_permitido` VALUES ('34', 'loja-exemplo', '2014-06-16 17:21:28');
INSERT INTO `subdominio_nao_permitido` VALUES ('35', 'loja-teste', '2015-02-07 21:27:29');
INSERT INTO `subdominio_nao_permitido` VALUES ('36', 'teste', '2015-02-07 21:27:31');
INSERT INTO `subdominio_nao_permitido` VALUES ('37', 'wiki', '2015-02-07 21:27:33');
INSERT INTO `subdominio_nao_permitido` VALUES ('38', 'apps', '2015-02-07 21:27:35');
INSERT INTO `subdominio_nao_permitido` VALUES ('41', 'sistemas', '2015-02-07 21:27:51');
INSERT INTO `subdominio_nao_permitido` VALUES ('42', 'contato', '2015-02-07 21:28:20');
INSERT INTO `subdominio_nao_permitido` VALUES ('45', 'contatos', '2015-02-07 21:28:26');

-- ----------------------------
-- Table structure for theme
-- ----------------------------
DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme` (
  `id_theme` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `diretorio` varchar(64) NOT NULL,
  `responsivo` tinyint(1) NOT NULL DEFAULT '0',
  `default_left_coluna` tinyint(1) NOT NULL DEFAULT '0',
  `default_right_coluna` tinyint(1) NOT NULL DEFAULT '0',
  `produto_por_pagina` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_theme`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of theme
-- ----------------------------
INSERT INTO `theme` VALUES ('1', 'default-bootstrap', 'default-bootstrap', '1', '1', '0', '12');

-- ----------------------------
-- Table structure for ticket
-- ----------------------------
DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT '1',
  `id_cliente_default` int(11) DEFAULT NULL,
  `id_prioridade_default` int(11) DEFAULT NULL,
  `id_departamento_default` int(11) DEFAULT NULL,
  `id_status_departamento_default` int(11) DEFAULT '1',
  `id_status_cliente_default` int(11) DEFAULT '1',
  `leitura_departamento` enum('True','False') DEFAULT 'False',
  `leitura_cliente` enum('True','False') DEFAULT 'False',
  `ultima_acao` enum('cliente','suporte') DEFAULT 'cliente',
  `acao_datetime` datetime DEFAULT NULL,
  `hash` varchar(40) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ticket_fk_1_idx` (`id_shop_default`) USING BTREE,
  KEY `ticket_fk_2_idx` (`id_prioridade_default`) USING BTREE,
  KEY `ticket_fk_3_idx` (`id_departamento_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ticket
-- ----------------------------
INSERT INTO `ticket` VALUES ('1', '7', '6', '3', '1', '1', '1', 'False', 'False', 'cliente', '2016-10-05 02:15:41', '39c0b39994e858f6d55200a9edb73f70e1fbea93', '127.0.0.1', '2015-06-27 21:14:25', '2016-10-28 15:23:44');
INSERT INTO `ticket` VALUES ('2', '7', '6', '2', '2', '2', '4', 'False', 'False', 'cliente', '2016-10-05 18:23:48', '39c0b39994e858f6d55200a9edb73f70e1fbea93', '127.0.0.1', '2015-06-27 21:17:07', '2016-10-28 15:23:29');
INSERT INTO `ticket` VALUES ('3', '7', '6', '1', '3', '4', null, 'False', 'False', 'cliente', '2016-10-05 20:23:51', '39c0b39994e858f6d55200a9edb73f70e1fbea93', '127.0.0.1', '2015-06-27 21:22:41', '2016-10-28 15:23:32');
INSERT INTO `ticket` VALUES ('4', '7', '5', null, '1', '3', null, 'False', 'False', 'cliente', '2016-10-05 22:40:41', '39c0b39994e858f6d55200a9edb73f70e1fbea93', '127.0.0.1', '2015-07-17 12:07:28', '2016-10-28 15:23:34');
INSERT INTO `ticket` VALUES ('10', '7', '5', null, '1', null, null, 'False', 'False', 'cliente', '2016-10-05 22:23:57', '39c0b39994e858f6d55200a9edb73f70e1fbea93', '127.0.0.1', '2016-04-22 19:20:53', '2016-10-28 15:23:37');
INSERT INTO `ticket` VALUES ('21', '7', '5', null, '1', null, null, 'False', 'False', 'cliente', '2016-10-28 13:23:45', '39c0b39994e858f6d55200a9edb73f70e1fbea93', '127.0.0.1', '2016-07-29 00:51:26', '2016-10-28 15:23:50');

-- ----------------------------
-- Table structure for ticket_anexo
-- ----------------------------
DROP TABLE IF EXISTS `ticket_anexo`;
CREATE TABLE `ticket_anexo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket_conteudo_default` int(11) NOT NULL,
  `anexo` varchar(128) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ticket_anexo
-- ----------------------------

-- ----------------------------
-- Table structure for ticket_conteudo
-- ----------------------------
DROP TABLE IF EXISTS `ticket_conteudo`;
CREATE TABLE `ticket_conteudo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket_default` int(11) DEFAULT NULL,
  `id_cliente_default` int(11) DEFAULT NULL,
  `id_admin_default` int(11) DEFAULT NULL,
  `id_departamento_default` int(11) DEFAULT NULL,
  `assunto` varchar(128) DEFAULT NULL,
  `mensagem` text,
  `ip` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_conteudo_fk_1_idx` (`id_ticket_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ticket_conteudo
-- ----------------------------
INSERT INTO `ticket_conteudo` VALUES ('1', '1', '6', null, '1', 'Ticket 1', '&lt;p&gt;gsdfg&lt;/p&gt;\r\n', '127.0.0.1', '2015-06-27 21:14:25');
INSERT INTO `ticket_conteudo` VALUES ('2', '2', '6', null, '1', 'Ticket 2', '&lt;p&gt;dasdasdas&lt;/p&gt;\r\n', '127.0.0.1', '2015-06-27 21:17:07');
INSERT INTO `ticket_conteudo` VALUES ('3', '3', '6', null, '1', 'Ticket 3', '&lt;p&gt;gsdfgsdfgsd&lt;/p&gt;\r\n', '127.0.0.1', '2015-06-27 21:22:41');
INSERT INTO `ticket_conteudo` VALUES ('4', '4', '5', null, '1', 'Ticket 4', '&lt;p&gt;fsadf&lt;/p&gt;\r\n', '127.0.0.1', '2015-07-17 12:07:28');
INSERT INTO `ticket_conteudo` VALUES ('10', null, '5', null, '1', null, '&lt;p&gt;Qualque coisa estamos a disposi&amp;ccedil;&amp;atilde;o&lt;/p&gt;\r\n', '127.0.0.1', '2016-04-22 19:20:53');
INSERT INTO `ticket_conteudo` VALUES ('21', null, '5', null, '1', null, 'sds', '127.0.0.1', '2016-07-29 00:51:26');

-- ----------------------------
-- Table structure for ticket_copy
-- ----------------------------
DROP TABLE IF EXISTS `ticket_copy`;
CREATE TABLE `ticket_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_shop_default` int(11) DEFAULT '1',
  `id_cliente_default` int(11) DEFAULT NULL,
  `id_prioridade_default` int(11) DEFAULT NULL,
  `id_departamento_default` int(11) DEFAULT NULL,
  `id_status_departamento_default` int(11) DEFAULT '1',
  `id_status_cliente_default` int(11) DEFAULT '1',
  `leitura_departamento` enum('True','False') DEFAULT 'False',
  `leitura_cliente` enum('True','False') DEFAULT 'False',
  `ultima_acao` enum('cliente','suporte') DEFAULT 'cliente',
  `acao_datetime` datetime DEFAULT NULL,
  `hash` varchar(40) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ticket_fk_1_idx` (`id_shop_default`) USING BTREE,
  KEY `ticket_fk_2_idx` (`id_prioridade_default`) USING BTREE,
  KEY `ticket_fk_3_idx` (`id_departamento_default`) USING BTREE) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ticket_copy
-- ----------------------------
INSERT INTO `ticket_copy` VALUES ('1', '7', '6', '3', '1', '1', '1', 'False', 'False', 'cliente', '2016-10-05 02:15:41', '39c0b39994e858f6d55200a9edb73f70e1fbea93', '127.0.0.1', '2015-06-27 21:14:25', '2016-10-28 15:23:44');
INSERT INTO `ticket_copy` VALUES ('2', '7', '6', '2', '2', '2', '4', 'False', 'False', 'cliente', '2016-10-05 18:23:48', '39c0b39994e858f6d55200a9edb73f70e1fbea93', '127.0.0.1', '2015-06-27 21:17:07', '2016-10-28 15:23:29');
INSERT INTO `ticket_copy` VALUES ('3', '7', '6', '1', '3', '4', null, 'False', 'False', 'cliente', '2016-10-05 20:23:51', '39c0b39994e858f6d55200a9edb73f70e1fbea93', '127.0.0.1', '2015-06-27 21:22:41', '2016-10-28 15:23:32');
INSERT INTO `ticket_copy` VALUES ('4', '7', '5', null, '1', '3', null, 'False', 'False', 'cliente', '2016-10-05 22:40:41', '39c0b39994e858f6d55200a9edb73f70e1fbea93', '127.0.0.1', '2015-07-17 12:07:28', '2016-10-28 15:23:34');
INSERT INTO `ticket_copy` VALUES ('10', '7', '5', null, '1', null, null, 'False', 'False', 'cliente', '2016-10-05 22:23:57', '39c0b39994e858f6d55200a9edb73f70e1fbea93', '127.0.0.1', '2016-04-22 19:20:53', '2016-10-28 15:23:37');
INSERT INTO `ticket_copy` VALUES ('21', '7', '5', null, '1', null, null, 'False', 'False', 'cliente', '2016-10-28 13:23:45', '39c0b39994e858f6d55200a9edb73f70e1fbea93', '127.0.0.1', '2016-07-29 00:51:26', '2016-10-28 15:23:50');

-- ----------------------------
-- Table structure for ticket_departamento
-- ----------------------------
DROP TABLE IF EXISTS `ticket_departamento`;
CREATE TABLE `ticket_departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departamento` varchar(45) NOT NULL,
  `email_departamento` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departamento_UNIQUE` (`departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ticket_departamento
-- ----------------------------
INSERT INTO `ticket_departamento` VALUES ('1', 'Suporte', 'suporte@vialoja.com.br');
INSERT INTO `ticket_departamento` VALUES ('2', 'Comercial', 'comercial@vialoja.com.br');
INSERT INTO `ticket_departamento` VALUES ('3', 'Financeiro', 'financeiro@vialoja.com.br');
INSERT INTO `ticket_departamento` VALUES ('4', 'teste', 'teste@teste.com');

-- ----------------------------
-- Table structure for ticket_prioridade
-- ----------------------------
DROP TABLE IF EXISTS `ticket_prioridade`;
CREATE TABLE `ticket_prioridade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prioridade` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ticket_prioridade
-- ----------------------------
INSERT INTO `ticket_prioridade` VALUES ('1', 'Baixa');
INSERT INTO `ticket_prioridade` VALUES ('2', 'Média');
INSERT INTO `ticket_prioridade` VALUES ('3', 'Alta');

-- ----------------------------
-- Table structure for ticket_status_cliente
-- ----------------------------
DROP TABLE IF EXISTS `ticket_status_cliente`;
CREATE TABLE `ticket_status_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ticket_status_cliente
-- ----------------------------
INSERT INTO `ticket_status_cliente` VALUES ('1', 'Enviado');
INSERT INTO `ticket_status_cliente` VALUES ('2', 'Resposta do atendente');
INSERT INTO `ticket_status_cliente` VALUES ('3', 'Resposta do cliente');
INSERT INTO `ticket_status_cliente` VALUES ('4', 'Reaberto');
INSERT INTO `ticket_status_cliente` VALUES ('5', 'Fechado');

-- ----------------------------
-- Table structure for ticket_status_departamento
-- ----------------------------
DROP TABLE IF EXISTS `ticket_status_departamento`;
CREATE TABLE `ticket_status_departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ticket_status_departamento
-- ----------------------------
INSERT INTO `ticket_status_departamento` VALUES ('1', 'Novo');
INSERT INTO `ticket_status_departamento` VALUES ('2', 'Aguardando resposta');
INSERT INTO `ticket_status_departamento` VALUES ('3', 'Reaberto');
INSERT INTO `ticket_status_departamento` VALUES ('4', 'Fechado');

-- ----------------------------
-- Table structure for wizard
-- ----------------------------
DROP TABLE IF EXISTS `wizard`;
CREATE TABLE `wizard` (
  `id_shop_default` int(11) NOT NULL,
  `passo` tinyint(4) DEFAULT '1',
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id_shop_default`),
  KEY `wizard_fk_1_idx` (`id_shop_default`) USING BTREE) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wizard
-- ----------------------------
INSERT INTO `wizard` VALUES ('1', '1', '2014-06-21 04:25:26', null);
INSERT INTO `wizard` VALUES ('2', '1', '2014-06-21 04:25:25', null);
INSERT INTO `wizard` VALUES ('5', '5', '2016-10-21 04:01:14', null);
INSERT INTO `wizard` VALUES ('7', '5', '2015-02-20 19:05:04', null);
INSERT INTO `wizard` VALUES ('15', '5', '2016-04-21 03:55:09', null);
INSERT INTO `wizard` VALUES ('25', '5', '2016-04-23 06:02:04', null);

-- ----------------------------
-- Procedure structure for sp_gerar_fatura
-- ----------------------------
DROP PROCEDURE IF EXISTS `sp_gerar_fatura`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_gerar_fatura`()
BEGIN
  
  DECLARE SP_id INT;
  DECLARE SP_insert_ID INT;
  DECLARE SP_periodo VARCHAR(45);
  DECLARE SP_id_shop INT;
  DECLARE SP_fatura_count_free INT;
  DECLARE SP_fatura_count_pay INT;
  DECLARE SP_id_plano INT;
  DECLARE SP_valor DOUBLE(10,2);
  DECLARE SP_data_dia INT;
  DECLARE SP_data_inicial DATE DEFAULT CURDATE();
  DECLARE SP_data_final_full DATE DEFAULT CURDATE();
  DECLARE SP_data_final DATE DEFAULT CURDATE();

  
  
  SET SP_data_dia     = ( SELECT( DAYOFMONTH( CURDATE() ) ) );
  SET SP_data_inicial = ( SELECT( CURDATE() ) );
  SET SP_data_final_full = ( SELECT( DATE_ADD( CURDATE(), INTERVAL 1 MONTH ) ) );
  SET SP_data_final = ( SELECT( DATE_SUB( SP_data_final_full, INTERVAL 1 DAY ) ) );
  
  
  
  SELECT COUNT(*) FROM `shop_fatura_config` 
  WHERE (`dia_mes_free` = SP_data_dia 
  AND `id_plano` = '1' 
  AND `data_status_fatura_free` < CURDATE()) LIMIT 1
  INTO SP_fatura_count_free;

  IF SP_fatura_count_free > 0 

    THEN SELECT 
    `id`, `id_shop_default`, `id_plano`, `periodicidade`
    INTO SP_id, SP_id_shop, SP_id_plano, SP_periodo   
    FROM `shop_fatura_config` 
    WHERE (`dia_mes_free` = SP_data_dia 
    AND `id_plano` = '1' 
    AND `data_status_fatura_free` < CURDATE()) LIMIT 1;
    
    INSERT INTO `shop_fatura` SET 
    `id_shop_default` = SP_id_shop,
    `data_dia` = DATE_FORMAT(CURDATE(), '%d'),
    `data_mes_inicial` = SP_data_inicial,
    `data_mes_final` = SP_data_final,
    `periodicidade` = SP_periodo,
    `situacao` = '5',
    `created` = NOW();
    
    UPDATE `shop_fatura_config` SET 
    `data_status_fatura_free` = NOW()
    WHERE ( `id` = SP_id );     

  END IF;
  
  
  
  SELECT COUNT(*) FROM `shop_fatura_config` 
  WHERE (`dia_mes_pay` = SP_data_dia 
  AND `id_plano` != '1' 
  AND `data_status_fatura_pay` < CURDATE()) LIMIT 1
  INTO SP_fatura_count_pay;

  IF SP_fatura_count_pay > 0 

    THEN SELECT 
    `id`, `id_shop_default`, `id_plano`, `periodicidade`
    INTO SP_id, SP_id_shop, SP_id_plano, SP_periodo   
    FROM `shop_fatura_config` 
    WHERE (`dia_mes_pay` = SP_data_dia 
    AND `id_plano` != '1' 
    AND `data_status_fatura_pay` < CURDATE()) LIMIT 1;
    
    
    SELECT `valor` INTO SP_valor FROM `plano_shop` 
    WHERE (`id_plano` = SP_id_plano) LIMIT 1;
    
    INSERT INTO `shop_fatura_referencia` SET 
    `id_shop_default` = SP_id_shop,
    `created` = NOW();
    SET SP_insert_ID = Last_Insert_ID();
    
    INSERT INTO `shop_fatura` SET 
    `id_shop_default` = SP_id_shop,
    `id_plano` = SP_id_plano,
    `valor` = SP_valor,
    `referencia` = SP_insert_ID,
    `data_dia` = DATE_FORMAT(CURDATE(), '%d'),
    `data_mes_inicial` = SP_data_inicial,
    `data_mes_final` = SP_data_final,
    `periodicidade` = SP_periodo,
    `situacao` = '2',
    `token` = SHA1(RAND() * 100 * SP_id_shop),
    `created` = NOW();
    
    UPDATE `shop_fatura_config` SET 
    `data_status_fatura_pay` = NOW()
    WHERE ( `id` = SP_id );     

  END IF;
  
END
;;
DELIMITER ;

-- ----------------------------
-- Event structure for EV_sp_gerar_fatura
-- ----------------------------
DROP EVENT IF EXISTS `EV_sp_gerar_fatura`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` EVENT `EV_sp_gerar_fatura` ON SCHEDULE EVERY 10 SECOND STARTS '2016-10-23 14:24:33' ON COMPLETION NOT PRESERVE ENABLE DO CALL `sp_gerar_fatura`()
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `acionadores_shop`;
DELIMITER ;;
CREATE TRIGGER `acionadores_shop` AFTER INSERT ON `shop` FOR EACH ROW BEGIN
  
    INSERT INTO `wizard` SET `id_shop_default` = NEW.`id_shop`; 
    UPDATE `cliente` SET `id_shop` = NEW.`id_shop`, `nivel` = '5' WHERE (`id_cliente` = NEW.`id_cliente`);
  
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `acionadores_shop_dominio`;
DELIMITER ;;
CREATE TRIGGER `acionadores_shop_dominio` BEFORE UPDATE ON `shop_dominio` FOR EACH ROW BEGIN
  
  
  IF (SELECT count(*) FROM `shop_dominio_redirect` WHERE (`created` <= (SELECT DATE_SUB(CURDATE(), INTERVAL 90 DAY))) ) > 0
  
      THEN DELETE FROM `shop_dominio_redirect` WHERE (`created` <= (SELECT DATE_SUB(CURDATE(), INTERVAL 90 DAY)));
    
  END IF;
    
  
  IF (SELECT count(*) FROM `shop_dominio_redirect` WHERE (`dominio` = NEW.`dominio`) ) > 0  
      THEN DELETE FROM `shop_dominio_redirect` WHERE (`dominio` = NEW.`dominio`);
    
  END IF;
  
  IF (SELECT count(*) FROM `shop_dominio_redirect` WHERE `dominio` = OLD.`dominio` ) < 1 AND OLD.`created` < (SELECT DATE_SUB(CURDATE(), INTERVAL 10 DAY)) AND NEW.`ativo` = 1
  
      THEN DELETE FROM `shop_dominio_redirect` WHERE (`id_shop_default` = OLD.`id_shop_default` AND `created` <= (SELECT DATE_SUB(CURDATE(), INTERVAL 30 DAY)));
    
      INSERT INTO `shop_dominio_redirect` SET 
    `id_dominio` = OLD.`id_dominio`,
    `id_shop_default` = OLD.`id_shop_default`,
    `dominio`  = OLD.`dominio`,
    `subdominio_plataforma`  = OLD.`subdominio_plataforma`,
    `dominio_ssl` = OLD.`dominio_ssl`,
    `physical_uri` = OLD.`physical_uri`,
    `virtual_uri` = OLD.`virtual_uri`,
    `main` = OLD.`main`,
    `ativo` = OLD.`ativo`,
    `created` = NOW(),
    `modified` = NOW();
  
  END IF;
  
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `acionadores_wizard`;
DELIMITER ;;
CREATE TRIGGER `acionadores_wizard` AFTER UPDATE ON `wizard` FOR EACH ROW BEGIN
  
  IF ( NEW.`passo`  > 1  AND NEW.`passo`  < 3 )
  
    THEN INSERT INTO `shop_fatura_config` SET 
    `id_shop_default` = NEW.`id_shop_default`,
    `dia_mes_free` = DAYOFMONTH( CURDATE() ),
    `created` = NOW();

  END IF;
  
END
;;
DELIMITER ;
SET FOREIGN_KEY_CHECKS=1;
