<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 19/10/16 às 11:13
 */

namespace Lib;


use Exception\VialojaUploadFailsException;

class MoveUploadedFile
{

    const CHMOD_WWWDATA = 0755;
    private $temp;
    private $name;
    private $folder;

    /**
     * Upload constructor.
     * @param $temp
     * @param $name
     */
    public function __construct($temp, $name)
    {
        $this->temp = $temp;
        $this->name = $name;
    }

    /**
     * Move o arquivo para o servidor e altera a permissão
     * @return bool
     */
    private function move()
    {

        chmod($this->folder, self::CHMOD_WWWDATA);
        if (!move_uploaded_file($this->temp, $this->folder . $this->name)) {
            throw new VialojaUploadFailsException(
                ERROR_UPLOAD_FILE,
                E_USER_NOTICE
            );
        }

    }

    /**
     * Recebe o path do diretório e cria
     * @param string $folder
     * @return bool|null
     */
    public function folder($folder = '')
    {

        if (empty($folder)) {
            trigger_error('Informe o nome da pasta de destino do arquivo: ', E_USER_NOTICE);
            exit;
        }

        $folder = rtrim($folder, '/');
        $this->folder = $folder . DIRECTORY_SEPARATOR;

        if (!self::isDirValid($this->folder)) {
            trigger_error('Informe um caminho válido e absoluto para o destino do arquivo: ', E_USER_NOTICE);
            exit;
        }

        if (!$this->isDir($this->folder)) {
            mkdir($this->folder, self::CHMOD_WWWDATA, true);
        }

        self::move();

    }

    /**
     * Verifica se a pasta já foi criada
     * @param $folder
     * @return bool
     */
    protected function isDir($folder)
    {
        if ($folder instanceof \SplFileInfo) {
            return $folder->isDir();
        }
        return (is_string($folder) && is_dir($folder));
    }

    /**
     * Valida Caminho da Pastas do arquivo
     * @param $dir
     * @return bool
     */
    private function isDirValid($dir)
    {
        if (is_numeric($dir)) {
            $dir = (string)$dir;
        }
        if (!is_string($dir)) {
            return false;
        }
        return (bool)preg_match('/^[a-zA-Z0-9\\/\+_.-]*$/', $dir);
    }

}
