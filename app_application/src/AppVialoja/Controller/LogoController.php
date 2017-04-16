<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 19/10/16 às 01:39
 */

use Lib\Tools;
use Lib\Validate;
use WideImage\WideImage;


class LogoController extends AppController
{

    public $uses = array('Shop');
    private $json = array();
    private $datasource;

    private $sizeX;
    private $sizeY;
    private $msg;
    private $img_name;
    private $move;
    private $img_temp;
    private $diretorio;


    /**
     * Efetua o Upload de Arquivos
     */
    private function upload()
    {
        $this->img_name = Tools::slugFile($this->img_name);
        $this->move = new \Lib\MoveUploadedFile($this->img_temp, $this->img_name);
        $this->move->folder($this->diretorio);
    }

    /**
     * Update em tabela e Upload de Arquivo
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    private function upArquivoPath($column_path='')
    {

        $this->datasource = $this->Shop->getDataSource();

        try {

            $this->datasource->begin();

            if ($this->Shop instanceof Shop) {
                $this->Shop->setIdShop($this->Session->read('id_shop'));
            }

            switch ($column_path) {

                case 'logo':
                    $this->msg = 'Logo da página alterado com sucesso.';
                    $this->sizeX = 200;
                    $this->sizeY = 300;
                    break;

                case 'background':
                    $this->msg = 'O Background da página foi alterado com sucesso.';
                    $this->sizeX = 1130;
                    $this->sizeY = 188;
                    break;

                case 'logo_social':
                    $this->msg = 'O logo social foi alterado com sucesso.';
                    $this->sizeX = 200;
                    $this->sizeY = 200;
                    break;

                case 'favicon':
                    $this->msg = 'Ícone da página alterado com sucesso.';
                    $this->sizeX = 128;
                    $this->sizeY = 128;
                    break;

            }

            $this->diretorio = CDN_ROOT_UPLOAD .
                $this->Session->read('id_shop') .
                DS . $column_path . DS;

            /** Verifica se o diretorio existe or cria **/
            $arquivo = isset( $_FILES[ $column_path ] ) ? $_FILES[ $column_path ] : FALSE;

            if (empty($arquivo['name'])) {

                $this->Session->write('erro_'. $column_path, true);

                throw new \InvalidArgumentException("Alguns dados inseridos não estão corretos
                    <br /><h5><span style='font-weight:normal;'>Por favor verifique abaixo para corrigir o problema.</span></h5>", E_USER_WARNING);
            }

            $this->img_name = $arquivo['name'];
            $this->img_temp = $arquivo['tmp_name'];

            $std = new \stdClass();
            $std->column_path = $column_path;
            $dados = $this->Shop->getPathImagem($this->Shop, $std);

            if ($arquivo['type'] == 'image/x-icon') {

                self::upload();

            } else {

                if (!Validate::isMaxSize($arquivo['size'])) {
                    throw new \InvalidArgumentException("O arquivo enviado é muito grande, envie arquivos de no máximo 2Mb.", E_USER_WARNING);
                }

                if (!Validate::isImage($arquivo)) {
                    throw new \InvalidArgumentException("Atenção! Envie uma imagem válida. O arquivo enviado não é uma imagem ou está corrompido.", E_USER_WARNING);
                }

                self::upload();

                $original = WideImage::load($this->diretorio . $this->img_name);
                $original->resize($this->sizeX, $this->sizeY, 'inside')->saveToFile($this->diretorio . $this->img_name);
                $original->destroy();

            }

            $std = new \stdClass();
            $std->column_path = $column_path;
            $std->img_name = $this->img_name;

            if ($this->Shop->updatePathImagem($this->Shop, $std)) {
                if (!empty($dados['Shop'][$column_path])) {
                    Tools::deleteFile($this->diretorio . $dados['Shop'][$column_path]);
                }
                $this->setMsgAlertSuccess( $this->msg );

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {
            $this->datasource->rollback();
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\InvalidArgumentException $e) {
            $this->setMsgAlertError($e->getMessage());
        } catch (\Exception\VialojaInvalidTransactionException $e) {
            $this->setMsgAlertError($e->getMessage());
        } catch (\Exception $e) {
            $this->setMsgAlertError($e->getMessage());
        } finally {
            $this->redirect( $this->referer() );
        }

    }

    /**
     * Altera a logo social da loja
     * @access public
     * @return string
     */
    public function alterar_logo_social()
    {
        $this->layout = false;
        $this->render(false);
        self::upArquivoPath('logo_social');
    }

    /**
     * Altera o favicon da loja
     * @access public
     * @return string
     */
    public function alterar_favicon()
    {

        $this->layout = false;
        $this->render(false);
        self::upArquivoPath('favicon');

    }

    /**
     * Remove logo
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function remover_logo()
    {
        self::deletaArquivo('logo');
    }

    /**
     * Deleta Arquivo
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    private function deletaArquivo($column_path='')
    {

        $this->render(false);
        $this->datasource = $this->Shop->getDataSource();

        try {

            $this->datasource->begin();

            if ($this->request->is('get')) {

                if ($this->Shop instanceof Shop) {
                    $this->Shop->setIdShop($this->Session->read('id_shop'));
                }

                $std = new \stdClass();
                $std->column_path = $column_path;
                $dados = $this->Shop->getPathImagem($this->Shop, $std);

                $std = new \stdClass();
                $std->column_path = $column_path;
                $ok = $this->Shop->removePathImage($this->Shop, $std);

                if (is_bool($ok) && $ok === true) {

                    switch ($column_path) {

                        case 'logo':
                            $this->setMsgAlertSuccess('A logomarca foi removida com sucesso.');
                            break;

                        case 'background':
                            $this->setMsgAlertSuccess('O Background da página foi removida com sucesso.');
                            break;

                        case 'logo_social':
                            $this->setMsgAlertSuccess('O logo social foi removida com sucesso.');
                            break;

                        case 'favicon':
                            $this->setMsgAlertSuccess('O ícone da página foi removido com sucesso.');
                            break;

                    }

                    $this->diretorio = CDN_ROOT_UPLOAD .
                        $this->Session->read('id_shop') .
                        DS . $column_path . DS;

                    /** Deleta a logo se existir **/
                    if (!empty($dados['Shop'][$column_path])) {
                        Tools::deleteFile($this->diretorio . $dados['Shop'][$column_path]);
                    }

                } else {
                    throw new \RuntimeException(ERROR_PROCESS);
                }

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {
            $this->datasource->rollback();
            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\RuntimeException $e) {
            $this->setMsgAlertError($e->getMessage());
        } finally {
            $this->redirect( $this->referer() );
        }

    }

    /**
     * Remove background logo
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function remover_background()
    {
        self::deletaArquivo('background');
    }

    /**
     * Remove logo social
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function remover_logo_social()
    {
        self::deletaArquivo('logo_social');
    }

    /**
     * Remove logo social
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function remover_favicon()
    {
        self::deletaArquivo('favicon');
    }

    /**
     * Altera a logomarca da loja em wizard
     * @return bool
     */
    public function alterar_logo_json()
    {

        $this->layout = false;
        $this->render(false);

        try {

            if (!$this->request->is('post')) {
                return false;
            }

            if (!$this->request->is('ajax')) {
                return false;
            }

            $this->diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'logo' . DS;
            $arquivo = isset( $_FILES[ 'logo' ] ) ? $_FILES[ 'logo' ] : FALSE;

            $this->img_name = $arquivo['name'];
            $this->img_temp = $arquivo['tmp_name'];

            if (!Validate::isMaxSize($arquivo['size'])) {
                throw new \InvalidArgumentException("O arquivo enviado é muito grande, envie arquivos de no máximo 2Mb.", E_USER_WARNING);
            }

            if (!Validate::isImage($arquivo)) {
                throw new \InvalidArgumentException("Atenção! Envie uma imagem válida. O arquivo enviado não é uma imagem ou está corrompido.", E_USER_WARNING);
            }

            self::upload();

            $original = WideImage::load($this->diretorio . $this->img_name);
            $original->resize(300, 200, 'inside')->saveToFile($this->diretorio . $this->img_name);
            $original->destroy();

            if ($this->Shop instanceof Shop) {

                $this->Shop->setIdShop($this->Session->read('id_shop'));

                /** Deleta a logo se existir **/
                $std = new \stdClass();
                $std->column_path = 'logo';
                $dados = $this->Shop->getPathImagem($this->Shop, $std);

                if (!empty($dados['Shop']['logo'])) {
                    Tools::deleteFile($this->diretorio . $dados['Shop']['logo']);
                }

                $std = new \stdClass();
                $std->img_name = $this->img_name;
                if ($this->Shop->updatePathImagemWizard($this->Shop, $std)) {

                    $this->json['estado']   = "SUCESSO";
                    $this->json['filename'] = $this->Session->read('id_shop') . '/logo/' . $this->img_name;
                    $this->Session->write('filename_wizard', $this->json['filename']);

                } else {
                    $this->json['logo'] = ERROR_PROCESS;
                }

            }

        } catch (\PDOException $e) {
            $this->json['logo'] = ERROR_PROCESS;
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\InvalidArgumentException $e) {
            $this->json['logo'] = $e->getMessage();
        } catch (\Exception\VialojaInvalidTransactionException $e) {
            $this->json['logo'] = $e->getMessage();
        } catch (\Exception\VialojaUploadFailsException $e) {
            $this->json['logo'] = $e->getMessage();
        } catch (\Exception $e) {
            $this->json['logo'] = $e->getMessage();
        } finally {
            header('Content-Type: application/json');
            echo json_encode($this->json);
            exit;
        }

    }

    /**
     * Altera a background logomarca da loja
     * @access public
     * @return string
     */
    public function alterar_background()
    {

        $this->layout = false;
        $this->render(false);
        self::upArquivoPath('background');

    }

    /**
     * Altera a logomarca da loja
     * @access public
     * @return string
     */
    public function alterar_logo()
    {
        $this->layout = false;
        $this->render(false);
        self::upArquivoPath('logo');
    }

}
