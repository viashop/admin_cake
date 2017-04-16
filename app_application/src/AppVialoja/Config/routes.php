<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
#Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
#Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

Router::parseExtensions();

Router::connect(
    '/', array('controller' => 'default', 'action' => 'index')
);

use Lib\Tools;
use Lib\RouterUri;
use Respect\Validation\Validator as v;

$container = new \Pimple\Container();
$container['params'] = function () {
    return RouterUri::getUri();
};

if (!isset($container['params'][2])) {

    if(isset($container['params'][1]) && v::stringType()->notEmpty()->validate($container['params'][1])){
        Router::connect('/*', array('controller' => $container['params'][1], 'action' => 'index'));
    }

} elseif (v::identical($container['params'][1])->validate('public')) {

    if (isset($container['params'][2])) {

        if (v::identical($container['params'][2])->validate('login')) {

            Router::connect('/*',
                array(
                    'controller' => $container['params'][1],
                    'action' => 'login'
                )
            );

        } elseif (v::identical($container['params'][2])->validate('assinar')) {

            Router::connect('/*',
                array(
                    'controller' => $container['params'][1],
                    'action' => 'assinar'
                )
            );

        } elseif (v::identical($container['params'][2])->validate('esqueceu-a-senha')) {

            Router::connect('/*',
                array(
                    'controller' => $container['params'][1],
                    'action' => 'esqueceuSenha'
                )
            );

        } elseif (v::identical($container['params'][2])->validate('criar-conta-loja-virtual')) {

            Router::connect('/*',
                array(
                    'controller' => $container['params'][1],
                    'action' => 'criarContaLojaVirtual'
                )
            );

        } elseif (v::identical($container['params'][2])->validate('reenviar-email-confirmacao')) {

            Router::connect('/*',
                array(
                    'controller' => $container['params'][1],
                    'action' => 'reenviarEmailConfirmacao'
                )
            );

        } elseif (v::identical($container['params'][2])->validate('senha-redefinir')) {

            Router::connect('/*',
                array(
                    'controller' => $container['params'][1],
                    'action' => 'senhaRedefinir'
                )
            );

        } elseif (v::identical($container['params'][2])->validate('reativar-conta-loja')) {

            Router::connect('/*',
                array(
                    'controller' => $container['params'][1],
                    'action' => 'reativarContaLoja'
                )
            );

        } elseif (v::identical($container['params'][2])->validate('conta-loja-reativar')) {

            Router::connect('/*',
                array(
                    'controller' => $container['params'][1],
                    'action' => 'contaLojaReativar'
                )
            );

        } elseif (v::identical($container['params'][2])->validate('reativar-conta-finalizada')) {

            Router::connect('/*',
                array(
                    'controller' => $container['params'][1],
                    'action' => 'reativarContaFinalizada'
                )
            );

        } elseif (v::identical($container['params'][2])->validate('email-confirmar')) {

            Router::connect('/*',
                array(
                    'controller' => $container['params'][1],
                    'action' => 'emailConfirmar'
                )
            );

        } elseif (v::identical($container['params'][2])->validate('convite-aceitar')) {

            Router::connect('/*',
                array(
                    'controller' => $container['params'][1],
                    'action' => 'conviteAceitar'
                )
            );

        } elseif (v::identical($container['params'][2])->validate('convite-recusar')) {

            Router::connect('/*',
                array(
                    'controller' => $container['params'][1],
                    'action' => 'conviteRecusar'
                )
            );

        }

    } elseif (isset($container['params'][5]) && v::notEmpty()->validate($container['params'][5])) {

        if (v::contains('?')->validate($container['params'][5])) {
            $str_params = explode('?', $container['params'][5]);
            $container['params'][5] = $str_params[0];
        }

        Router::connect('/*',
            array(
                'controller' => $container['params'][1],
                'action' => $container['params'][2] . ucwords($container['params'][3]) . ucwords($container['params'][4]) . ucwords($container['params'][5])
            )
        );

    } elseif (isset($container['params'][4]) && v::notEmpty()->validate($container['params'][4])) {

        if (v::contains('?')->validate($container['params'][4])) {
            $str_params = explode('?', $container['params'][4]);
            $container['params'][4] = $str_params[0];
        }

        Router::connect('/*',
            array(
                'controller' => $container['params'][1],
                'action' => $container['params'][2] . ucwords($container['params'][3]) . ucwords($container['params'][4])
            )
        );

    } elseif (isset($container['params'][3]) && v::notEmpty()->validate($container['params'][3])) {

        if (v::contains('?')->validate($container['params'][3])) {
            $str_params = explode('?', $container['params'][3]);
            $container['params'][3] = $str_params[0];
        }

        Router::connect('/*',
            array(
                'controller' => $container['params'][1],
                'action' => $container['params'][2] . ucwords($container['params'][3])
            )
        );

    }

} elseif (v::identical($container['params'][1])->validate('admin')) {

    if (v::identical($container['params'][2])->validate('catalogo')) {

        if (isset($container['params'][3])) {

            if (v::identical($container['params'][3])->validate('produto')) {

                /**
                 * Importar Edição de Produto
                 */
                if (isset($container['params'][4], $container['params'][5])
                    && v::identical($container['params'][5])->validate('validacao')) {

                    Router::connect('/catalogo/*',
                        array(
                            'controller' => $container['params'][2],
                            'action' => 'produtoImportarValidacao'
                        )
                    );

                }

                /**
                 * Edição de Produto
                 */
                elseif (isset($container['params'][4], $container['params'][5])
                    && v::identical($container['params'][4])->validate('editar')
                    && v::numeric()->notBlank()->validate($container['params'][5])) {

                    Router::connect('/catalogo/*',
                        array(
                            'controller' => $container['params'][2],
                            'action' => $container['params'][3] . 'Editar'
                        )
                    );

                } elseif (Tools::getValue('q')) {

                    Router::connect('/catalogo/*',
                        array(
                            'controller' => $container['params'][2],
                            'action' => $container['params'][3] . 'Buscar'
                        )
                    );

                } else {

                    if (Tools::getValue('page') != '') {

                        Router::connect('/catalogo/*',
                            array(
                                'controller' => $container['params'][2],
                                'action' => $container['params'][3] . 'Listar'
                            )
                        );

                    }

                }

            }

            if (v::identical($container['params'][3])->validate('marca')) {

                if (Tools::getValue('page') != '') {

                    Router::connect('/catalogo/*',
                        array(
                            'controller' => $container['params'][2],
                            'action' => $container['params'][3] . 'Listar'
                        )
                    );

                }

            }

        }

        if (isset($container['params'][3], $container['params'][4], $container['params'][5])) {

            if (v::identical($container['params'][3])->validate('produto')) {

                if (v::identical($container['params'][4])->validate('grade')
                    && v::identical($container['params'][5])->validate('vincular') ) {

                    Router::connect('/catalogo/*',
                        array(
                            'controller' => $container['params'][2],
                            'action' => 'produtoGradeVincular'
                        )
                    );

                } elseif (v::identical($container['params'][4])->validate('filho')
                    && v::identical($container['params'][5])->validate('remover') ) {

                    Router::connect('/catalogo/*',
                        array(
                            'controller' => $container['params'][2],
                            'action' => 'produtoFilhoRemover'
                        )
                    );

                } elseif (v::identical($container['params'][4])->validate('grade')
                    && v::identical($container['params'][5])->validate('remover') ) {

                    Router::connect('/catalogo/*',
                        array(
                            'controller' => $container['params'][2],
                            'action' => 'produtoGradeRemover'
                        )
                    );

                }

            }

        } elseif (isset($container['params'][5], $container['params'][6])
            && v::identical($container['params'][5])->validate('variacao')
            && v::identical($container['params'][6])->validate('vincular') ) {

            Router::connect('/catalogo/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => 'produtoVariacaoVincular'
                )
            );

        } elseif (isset($container['params'][5]) && v::identical($container['params'][5])->validate('imagem')) {

            Router::connect('/catalogo/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][3] . ucwords($container['params'][4]) . ucwords($container['params'][5])
                )
            );

        } elseif (isset($container['params'][5]) && v::identical($container['params'][5])->validate('lixeira')
            || isset($container['params'][5]) && v::identical($container['params'][5])->validate('recupera') ) {

            Router::connect('/catalogo/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][3] . ucwords($container['params'][4]) . ucwords($container['params'][5])
                )
            );

        } elseif (isset($container['params'][5])
            && v::identical($container['params'][5])->validate('variacao') ) {

            if (isset($container['params'][6])) {

                Router::connect('/catalogo/*',
                    array(
                        'controller' => $container['params'][2],
                        'action' => $container['params'][5] . ucwords($container['params'][6])
                    )
                );

            }

        } else {

            if (isset($container['params'][4])) {

                Router::connect('/catalogo/*',
                    array(
                        'controller' => $container['params'][2],
                        'action' => $container['params'][3] . ucwords($container['params'][4])
                    )
                );

            }

        }

    } elseif (v::identical($container['params'][2])->validate('wizard')) {

        if (isset($container['params'][3])) {

            Router::connect('/wizard/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => str_replace('-', '', $container['params'][3])
                )
            );

        }

    } elseif (v::identical($container['params'][2])->validate('pedido')) {

        Router::connect(

            '/pedido/:action/*', array('controller' => 'pedido')

        );

    } elseif (v::identical($container['params'][2])->validate('cliente')) {

        if (Tools::getValue('q')) {

            Router::connect('/cliente/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][2] . ucwords($container['params'][3])
                )
            );

        } elseif (Tools::getValue('page') != '') {

            Router::connect('/cliente/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][2] . 'Listar'
                )
            );

        } elseif (isset($container['params'][3])) {

            if (v::identical($container['params'][3])->validate('grupo')) {

                if (isset($container['params'][4])) {

                    Router::connect('/cliente/*',
                        array(
                            'controller' => $container['params'][2],
                            'action' => $container['params'][3] . ucwords($container['params'][4])
                        )
                    );

                }

            } elseif (isset($container['params'][3])) {

                Router::connect('/cliente/*',
                    array(
                        'controller' => $container['params'][2],
                        'action' => $container['params'][2] . ucwords($container['params'][3])
                    )
                );

            }

        }

    } elseif (v::identical($container['params'][2])->validate('relatorio')) {

        if (isset($container['params'][3], $container['params'][4])
            && v::identical($container['params'][3])->validate('vendas') ) {

            Router::connect('/relatorio/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][3] . ucwords($container['params'][4])
                )
            );

        } elseif (isset($container['params'][2])) {

            Router::connect('/relatorio/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][2]
                )
            );
        }

    } elseif (v::identical($container['params'][2])->validate('loja')) {

        if (isset($container['params'][3], $container['params'][4])
            && v::identical($container['params'][3])->validate('redes_sociais')
            && v::identical($container['params'][4])->validate('verificar') ) {

            Router::connect('/loja/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][3] . ucwords($container['params'][4])
                )
            );

        } elseif (isset($container['params'][4], $container['params'][5]) && !is_numeric($container['params'][5])) {

            Router::connect('/loja/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][4] . ucwords($container['params'][5])
                )
            );

        } elseif (isset($container['params'][3], $container['params'][4])
            && !is_numeric($container['params'][4])) {

            Router::connect('/loja/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][3] . ucwords($container['params'][4])
                )
            );

        } else {

            if (isset($container['params'][3])) {

                Router::connect('/loja/*',
                    array(
                        'controller' => $container['params'][2],
                        'action' => $container['params'][3]
                    )
                );

            }

        }

    } elseif (v::identical($container['params'][2])->validate('recurso')) {

        if (isset($container['params'][3]) && Tools::getValue('page') != '') {

            Router::connect('/recurso/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][3] . 'Listar'
                )
            );

        }

        if (isset($container['params'][2], $container['params'][3])
            && v::identical($container['params'][3])->validate('xml')) {

            if (isset($container['params'][4], $container['params'][5])) {

                if (v::identical($container['params'][4])->validate('editar')
                    && !v::identical($container['params'][5])->validate('json')) {

                    Router::connect('/recurso/*',
                        array(
                            'controller' => $container['params'][2],
                            'action' => $container['params'][3] . ucwords($container['params'][4])
                        )
                    );

                } else {

                    Router::connect('/recurso/*',
                        array(
                            'controller' => $container['params'][2],
                            'action' => $container['params'][3] . ucwords($container['params'][4]) . ucwords($container['params'][5])
                        )
                    );

                }

            } elseif (isset($container['params'][4]) && v::notEmpty()->validate($container['params'][4])) {

                Router::connect('/recurso/*',
                    array(
                        'controller' => $container['params'][2],
                        'action' => $container['params'][3] . ucwords($container['params'][4])
                    )
                );

            } else {

                if (isset($container['params'][3])) {

                    Router::connect('/recurso/*',
                        array(
                            'controller' => $container['params'][2],
                            'action' => $container['params'][3]
                        )
                    );

                }

            }

        } elseif (isset($container['params'][3], $container['params'][4]) && v::identical($container['params'][3])->validate('atualizar')
            && v::identical($container['params'][4])->validate('arquivo.xlsx') ) {

            Router::connect('/recurso/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][3] . ucwords(str_replace('.', '_', $container['params'][4]))
                )
            );

        } elseif (isset($container['params'][3], $container['params'][4]) && v::identical($container['params'][3])->validate('importar')
            && v::identical($container['params'][4])->validate('modelo.xlsx') ) {

            Router::connect('/recurso/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][3] . ucwords(str_replace('.', '_', $container['params'][4]))
                )
            );

        } elseif (isset($container['params'][3]) && v::identical($container['params'][3])->validate('banner')) {

            Router::connect('/recurso/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][3] . ucwords($container['params'][4])
                )
            );

        } elseif (isset($container['params'][3], $container['params'][5]) && v::identical($container['params'][3])->validate('newsletter')
            && v::identical($container['params'][5])->validate('exportar.csv')
            || isset($container['params'][5]) && v::identical($container['params'][5])->validate('exportar.txt') ) {

            Router::connect('/recurso/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][3] . 'Exportar',
                    'formato' => $container['params'][5]
                )
            );

        } elseif (isset($container['params'][4])) {

            if (isset($container['params'][5]) && v::identical($container['params'][5])->validate('basico') ) {

                Router::connect('/recurso/*',
                    array(
                        'controller' => $container['params'][2],
                        'action' => $container['params'][3] . ucwords($container['params'][4]) . ucwords($container['params'][5])
                    )
                );

            } else {

                Router::connect('/recurso/*',
                    array(
                        'controller' => $container['params'][2],
                        'action' => $container['params'][3] . ucwords($container['params'][4])
                    )
                );

            }

        }

    } elseif (v::identical($container['params'][2])->validate('configuracao')) {

        if (isset($container['params'][8]) && v::identical($container['params'][8])->validate('faixa')) {

            if (isset($container['params'][9])) {

                if (v::identical($container['params'][9])->validate('editar')
                    || v::identical($container['params'][9])->validate('cep')
                    || v::identical($container['params'][9])->validate('peso')) {

                    Router::connect('/configuracao/*',
                        array(
                            'controller' => $container['params'][2],
                            'action' => $container['params'][4] . ucwords($container['params'][6]) . ucwords($container['params'][8]) . ucwords($container['params'][9])
                        )
                    );

                }
            }

        } elseif (isset($container['params'][6]) && v::identical($container['params'][6])->validate('regiao')) {

            if (isset($container['params'][8]) && v::identical($container['params'][8])->validate('editar')) {

                Router::connect('/configuracao/*',
                    array(
                        'controller' => $container['params'][2],
                        'action' => $container['params'][4] . ucwords($container['params'][6]) . ucwords($container['params'][8])
                    )
                );

            } elseif (isset($container['params'][7]) && v::identical($container['params'][7])->validate('criar')) {

                Router::connect('/configuracao/*',
                    array(
                        'controller' => $container['params'][2],
                        'action' => $container['params'][4] . ucwords($container['params'][6]) . ucwords($container['params'][7])
                    )
                );

            }

        } elseif (isset($container['params'][8]) && v::numeric()->notBlank()->validate($container['params'][8])) {

            Router::connect('/configuracao/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][3] . ucwords($container['params'][4]) . ucwords($container['params'][6]) . ucwords($container['params'][7])
                )
            );

        } elseif (isset($container['params'][5]) && !is_numeric($container['params'][5])) {

            Router::connect('/configuracao/*',
                array(
                    'controller' => $container['params'][2],
                    'action' => $container['params'][3] . ucwords($container['params'][4]) . ucwords($container['params'][5])
                )
            );

        } elseif (isset($container['params'][4])) {

            if (isset($container['params'][6]) && v::identical($container['params'][6])->validate('remover')
                || isset($container['params'][6]) && v::identical($container['params'][6])->validate('editar') ) {

                Router::connect('/configuracao/*',
                    array(
                        'controller' => $container['params'][2],
                        'action' => $container['params'][3] . ucwords($container['params'][4]) . ucwords($container['params'][6])
                    )
                );

            } else {

                Router::connect('/configuracao/*',
                    array(
                        'controller' => $container['params'][2],
                        'action' => $container['params'][3] . ucwords($container['params'][4])
                    )
                );

            }

        }

    }

}

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
