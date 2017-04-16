<?php

namespace Lib;

use Respect\Validation\Validator as v;
use SplFileInfo;
use finfo;
use DateTime;

class Validate
{

    /**
     * Verificação se Esta na lista de Autorizados para upload
     * com Validaçao Profunda do Mime com FINFO em TMP
     * @param array $file
     * @param array $acceptable
     * @return bool
     */
    public static function isFileValidAuthorized($file = array(), $acceptable = array())
    {

        if (!v::arrayVal()->notEmpty()->validate($file)) {
            return false;
        }

        if (!v::arrayVal()->notEmpty()->validate($acceptable)) {
            trigger_error('Erro: Informe um Array Valido, parametro $acceptable', E_USER_NOTICE);
            exit();
        }

        $fileAuthorized = array(

            'image/jpeg',
            'image/jpg',
            'image/pjpeg',
            'image/gif',
            'image/png',
            'image/x-png',
            'application/pdf',
            'application/x-pdf',
            'application/x-javascript',
            'application/javascript',
            'application/ecmascript',
            'text/javascript',
            'text/ecmascript',
            'application/x-pointplus',
            'text/css',
            'text/plain',
            'text/html',
            'application/vnd.ms-office',
            'application/vnd.ms-excel',
            'application/msexcel',
            'application/x-msexcel',
            'application/x-ms-excel',
            'application/x-excel',
            'application/x-dos_ms_excel',
            'application/xls',
            'application/x-xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'

        );

        foreach ($acceptable as $type) {

            if (!in_array($type, $fileAuthorized)) {
                return false;
            }

        }

        /**
         *
         * Outro Formato
         * $finfo = finfo_open(FILEINFO_MIME_TYPE);
         * $mime = finfo_file($finfo, $file['tmp_name']);
         */

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);

        if (!in_array($mime, $acceptable)) {
            return false;
        }

        return true;

    }

    /**
     * Verifica se é um arquivo xlsx valido
     * @param string $file
     * @return bool
     */
    public static function isFileExcel($file = '')
    {

        if (!v::arrayVal()->notEmpty()->validate($file)) {
            return false;
        }

        if (!Validate::isFileError($file['error'])) {
            return false;
        }

        if (!v::notEmpty()->validate($file['name'])) {
            return false;
        }

        //Verifica a extensão do arquivo
        $info = new SplFileInfo($file['name']);

        $array = array('xlsx');
        if (!in_array($info->getExtension(), $array)) {
            return false;
        }

        $acceptable = array(
            'application/vnd.ms-office',
            'application/vnd.ms-excel',
            'application/msexcel',
            'application/x-msexcel',
            'application/x-ms-excel',
            'application/x-excel',
            'application/x-dos_ms_excel',
            'application/xls',
            'application/x-xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );

        if (!in_array($file['type'], $acceptable)) {
            return false;
        }

        if (!Validate::isFileValidAuthorized($file, $acceptable)) {
            return false;
        }

        return true;

    }

    /**
     * Verificaçao de Arquivos da Galeria
     * @param string $file
     * @return bool
     */
    public static function isFileGalery($file = '')
    {

        if (!v::arrayVal()->notEmpty()->validate($file)) {
            return false;
        }

        if (!Validate::isFileError($file['error'])) {
            return false;
        }

        if (!v::notEmpty()->validate($file['name'])) {
            return false;
        }

        //Verifica a extensão do arquivo
        $info = new SplFileInfo($file['name']);
        $array = array('jpg', 'jpeg', 'gif', 'png', 'pdf', 'js', 'css');
        if (!in_array($info->getExtension(), $array)) {
            return false;
        }

        $acceptable = array(

            'image/jpeg',
            'image/jpg',
            'image/pjpeg',
            'image/gif',
            'image/png',
            'image/x-png',
            'application/pdf',
            'application/x-pdf',
            'application/x-javascript',
            'application/javascript',
            'application/ecmascript',
            'text/javascript',
            'text/ecmascript',
            'application/x-pointplus',
            'text/css'

        );

        if (!in_array($file['type'], $acceptable)) {
            return false;
        }

        if (!Validate::isFileValidAuthorized($file, $acceptable)) {
            return false;
        }

        return true;

    }

    /**
     * Verifica se é uma imagem válida
     * @param string $file
     * @return bool
     */
    public static function isImage($file = '')
    {

        if (!v::arrayVal()->notEmpty()->validate($file)) {
            return false;
        }

        if (!Validate::isFileError($file['error'])) {
            return false;
        }

        if (!is_string($file['name'])) {
            return false;
        }

        //Verifica a extensão do arquivo
        $info = new SplFileInfo($file['name']);
        $array = array('jpg', 'jpeg', 'gif', 'png');

        if (!in_array($info->getExtension(), $array)) {
            return false;
        }

        $acceptable = array(
            'image/jpeg',
            'image/jpg',
            'image/pjpeg',
            'image/gif',
            'image/png',
            'image/x-png'
        );

        if (!in_array($file['type'], $acceptable)) {
            return false;
        }

        if (!Validate::isFileValidAuthorized($file, $acceptable)) {
            return false;
        }

        return true;

    }


    /**
     * Verifica se é o type da imagem é válida
     * @param string $type
     * @return bool
     */
    public static function isTypeImage($type = '')
    {

        if (!v::notEmpty()->validate($type)) {
            return false;
        }

        $acceptable = array(
            'image/jpeg',
            'image/jpg',
            'image/pjpeg',
            'image/gif',
            'image/png',
            'image/x-png'
        );

        if (in_array($type, $acceptable)) {
            return true;
        } else {
            return false;
        }

    }


    /**
     * Verifica se o formulário foi enviado
     *
     * @return bool
     */
    public static function isPost()
    {
        //
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return TRUE;
        }
    }

    /**
     * Validar URL Google
     * @param string $uri Url de verificação do Google
     * @return bool
     */
    public static function isGoogleVerification($uri = '')
    {
        if (preg_match('#[Gg]oogle([a-z0-9]*).[a-z]#', $uri))
            return true;
        return false;
    }

    /**
     * Verifica se esta se a variavel esta vazio
     * @param $value
     * @return bool
     */
    public static function isNotNull($value)
    {

        if (is_array($value)) {

            $value = array_filter($value);
            if (!empty($value)) {
                return true;
            } else {
                return false;
            }

        } else {
            if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
                return true;
            } else {
                return false;
            }
        }
    }


    /**
     * Checa se a imagem retorna erro
     * @param int $error
     * @return bool true or false
     */
    public static function isFileError($error = 0)
    {

        if ($error !== 0)
            return false;
        return true;

    }


    /**
     * Checa valores maior ou menor
     * @param float $max valor maior
     * @param float $min valor menor custo ou promoção
     * @return bool true or false
     */
    public static function isValueBigger($max, $min)
    {

        if (!is_numeric($max)) {
            $max = (float)Tools::convertToDecimal($max);
        }

        if ($min) {
            $min = (float)Tools::convertToDecimal($min);
        }

        if ($max >= $min)
            return true;
        return false;

    }

    /**
     * Verifica se o Numero é decimal
     * @param $number
     * @return float|int
     */
    public static function isDecimal($number)
    {
        return is_numeric( Tools::convertToDecimal($number) ) ? Tools::convertToDecimal($number) : 0;
    }


    public static function isBot()
    {
        if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/bot|crawl|slurp|spider|feed|social|validator|site|monitor/i', $_SERVER['HTTP_USER_AGENT']))
            return true;
        return false;

    }


    /**
     * Checa se o valor é o minimo autorizado pela plataforma
     * @param $price
     * @param float $min
     * @return bool
     */
    public static function isPriceMinimum($price, $min = 0.05)
    {

        if (empty($price))
            return false;

        $price = floatval($price);
        $min = floatval($min);

        if (!Validate::isPrice($price))
            return false;

        if ($price < $min)
            return false;

        return true;
    }


    /**
     * Check for price validity
     * @param $price
     * @return int
     */
    public static function isPrice($price)
    {
        return preg_match('/^[0-9]{1,10}(\.[0-9]{1,9})?$/', $price);
    }

    /**
     * Check for session_id string validity
     * @param $id
     * @return boolean Validity is ok or not
     */
    public static function isSessionId($id)
    {
        return preg_match('/^[a-fA-F0-9]{64,130}$/', $id);
    }

    /**
     * Check for MD5 string validity
     *
     * @param string $md5 MD5 string to validate
     * @return boolean Validity is ok or not
     */
    public static function isMd5($md5)
    {
        return preg_match('/^[a-f0-9A-F]{32}$/', $md5);
    }

    /**
     * Check for SHA1 string validity
     *
     * @param string $sha1 SHA1 string to validate
     * @return boolean Validity is ok or not
     */
    public static function isSha1($sha1)
    {
        return preg_match('/^[a-fA-F0-9]{40}$/', $sha1);
    }

    /**
     * Check for SHA 256 string validity
     *
     * @param string $sha1 SHA1 string to validate
     * @return boolean Validity is ok or not
     */
    public static function isSha256($sha1)
    {
        return preg_match('/^[a-fA-F0-9]{64}$/', $sha1);
    }

    /**
     * Check for a float number validity
     *
     * @param float $float Float number to validate
     * @return boolean Validity is ok or not
     */
    public static function isFloat($float)
    {
        return strval((float)$float) == strval($float);
    }


    /**
     * Checa o tamanho maximo permitido
     * @param $size
     * @param int $max
     * @return bool
     */
    public static function isMaxSize($size, $max = 2)
    {

        $string = 1024 * 1024 * $max; //2Mb
        if ($size < $string)
            return true;
        return false;

    }

    /**
     * Check for an image size validity
     *
     * @param string $size Image size to validate
     * @return boolean Validity is ok or not
     */
    public static function isImageSize($size)
    {
        return preg_match('/^[0-9]{1,4}$/', $size);
    }

    /**
     * Checa se o valor é posito e maior que zero
     *
     * @param string $price Price to validate
     * @return boolean Validity is ok or not
     */
    public static function isPricePositive($price)
    {

        if (empty($price))
            return false;

        $price = floatval($price);
        if (!Validate::isPrice($price))
            return false;

        if ($price <= 0)
            return false;

        return true;
    }

    /**
     * Check for price validity (including negative price)
     *
     * @param string $price Price to validate
     * @return boolean Validity is ok or not
     */
    public static function isNegativePrice($price)
    {
        return preg_match('/^[-]?[0-9]{1,10}(\.[0-9]{1,9})?$/', $price);
    }

    /**
     * Check for HTML field validity (no XSS please !)
     *
     * @param string $html HTML field to validate
     * @return boolean Validity is ok or not
     */
    public static function isCleanHtml($html, $allow_iframe = false)
    {
        $events = 'onmousedown|onmousemove|onmmouseup|onmouseover|onmouseout|onload|onunload|onfocus|onblur|onchange';
        $events .= '|onsubmit|ondblclick|onclick|onkeydown|onkeyup|onkeypress|onmouseenter|onmouseleave|onerror|onselect|onreset|onabort|ondragdrop|onresize|onactivate|onafterprint|onmoveend';
        $events .= '|onafterupdate|onbeforeactivate|onbeforecopy|onbeforecut|onbeforedeactivate|onbeforeeditfocus|onbeforepaste|onbeforeprint|onbeforeunload|onbeforeupdate|onmove';
        $events .= '|onbounce|oncellchange|oncontextmenu|oncontrolselect|oncopy|oncut|ondataavailable|ondatasetchanged|ondatasetcomplete|ondeactivate|ondrag|ondragend|ondragenter|onmousewheel';
        $events .= '|ondragleave|ondragover|ondragstart|ondrop|onerrorupdate|onfilterchange|onfinish|onfocusin|onfocusout|onhashchange|onhelp|oninput|onlosecapture|onmessage|onmouseup|onmovestart';
        $events .= '|onoffline|ononline|onpaste|onpropertychange|onreadystatechange|onresizeend|onresizestart|onrowenter|onrowexit|onrowsdelete|onrowsinserted|onscroll|onsearch|onselectionchange';
        $events .= '|onselectstart|onstart|onstop';

        if (preg_match('/<[\s]*script/ims', $html) || preg_match('/(' . $events . ')[\s]*=/ims', $html) || preg_match('/.*script\:/ims', $html))
            return false;

        if (!$allow_iframe && preg_match('/<[\s]*(i?frame|form|input|embed|object)/ims', $html))
            return false;

        return true;
    }

    public static function isPasswdAdmin($passwd)
    {
        return Validate::isPasswd($passwd, 8);
    }

    /**
     * Check for password validity
     *
     * @param string $passwd Password to validate
     * @param int $size
     * @return boolean Validity is ok or not
     */
    public static function isPasswd($passwd, $size = 6)
    {
        return (Tools::strlen($passwd) >= $size && Tools::strlen($passwd) < 255);
    }

    /**
     * Check for date validity
     *
     * @param string $date Date to validate
     * @return boolean Validity is ok or not
     */
    public static function isDate($date, $format = 'd/m/Y')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * Check for date future
     *
     * @param string $date Date to validate
     * @return boolean Validity is ok or not
     */
    public static function isDateFuture($date_future)
    {

        $date = new DateTime(date('Y-m-d'));
        if ($date->format('Y-m-d') < implode('-', array_reverse(explode('/', $date_future))))
            return true;
        return false;

    }

    /**
     * Check for boolean validity
     *
     * @param boolean $bool Boolean to validate
     * @return boolean Validity is ok or not
     */
    public static function isBool($bool)
    {
        return $bool === null || is_bool($bool) || preg_match('/^0|1$/', $bool);
    }

    /**
     * Check for phone number validity
     *
     * @param string $number Phone number to validate
     * @return boolean Validity is ok or not
     */
    public static function isPhoneNumber($number)
    {
        return preg_match('/^[+0-9. ()-]*$/', $number);
    }

     /**
     * Check for zip code format validity
     *
     * @param string $zip_code zip code format to validate
     * @return boolean Validity is ok or not
     */
    public static function isZipCodeFormat($zip_code)
    {
        if (!empty($zip_code))
            return preg_match('/^[NLCnlc 0-9-]+$/', $zip_code);
        return true;
    }

    /**
     * Check for an integer validity
     *
     * @param integer $value Integer to validate
     * @return boolean Validity is ok or not
     */
    public static function isInt($value)
    {
        return ((string)(int)$value === (string)$value || $value === false);
    }

    /**
     * Check for an percentage validity (between 0 and 100)
     *
     * @param float $value Float to validate
     * @return boolean Validity is ok or not
     */
    public static function isPercentage($value)
    {
        return (Validate::isFloat($value) && $value >= 0 && $value <= 100);
    }


    /**
     * Check object validity
     *
     * @param integer $object Object to validate
     * @return boolean Validity is ok or not
     */
    public static function isColor($color)
    {
        return preg_match('/^(#[0-9a-fA-F]{6}|[a-zA-Z0-9-]*)$/', $color);
    }


    /**
     * Check url validity (disallowed empty string)
     *
     * @param string $url Url to validate
     * @return boolean Validity is ok or not
     */
    public static function isUrl($url)
    {
        return preg_match('/^[~:#,%&_=\(\)\.\? \+\-@\/a-zA-Z0-9]+$/', $url);
    }

    /**
     * Check for standard name file validity
     *
     * @param string $name Name to validate
     * @return boolean Validity is ok or not
     */
    public static function isFileName($name)
    {
        return preg_match('/^[a-zA-Z0-9_.-]+$/', $name);
    }

    /**
     * Check for standard name directory validity
     *
     * @param string $dir Directory to validate
     * @return boolean Validity is ok or not
     */
    public static function isDirName($dir)
    {
        return (bool)preg_match('/^[a-zA-Z0-9_.-]*$/', $dir);
    }

    public static function isDomainName($domain)
    {
        return preg_match('/^[a-zA-Z0-9-_]*$/', $domain);
    }

    /**
     * Check for PHP serialized data
     *
     * @param string $data Serialized data to validate
     * @return boolean Validity is ok or not
     */
    public static function isSerializedArray($data)
    {
        return $data === null || (is_string($data) && preg_match('/^a:[0-9]+:{.*;}$/s', $data));
    }

    /**
     * Verifica senhas comuns
     * @param  string $pass senha
     * @return bool true or false
     */
    public static function weakPassword($pass)
    {

        $array = array('111111', '11111111', '112233', '121212', '123123', '123456', '1234567', '12345678', '131313', '232323', '654321', '666666', '696969', '777777', '7777777', '8675309', '987654', 'aaaaaa', 'abc123', 'abc123', 'abcdef', 'abgrtyu', 'access', 'access14', 'action', 'albert', 'alexis', 'amanda', 'amateur', 'andrea', 'andrew', 'angela', 'angels', 'animal', 'anthony', 'apollo', 'apples', 'arsenal', 'arthur', 'asdfgh', 'asdfgh', 'ashley', 'asshole', 'august', 'austin', 'badboy', 'bailey', 'banana', 'barney', 'baseball', 'batman', 'beaver', 'beavis', 'bigcock', 'bigdaddy', 'bigdick', 'bigdog', 'bigtits', 'birdie', 'bitches', 'biteme', 'blazer', 'blonde', 'blondes', 'blowjob', 'blowme', 'bond007', 'bonnie', 'booboo', 'booger', 'boomer', 'boston', 'brandon', 'brandy', 'braves', 'brazil', 'bronco', 'broncos', 'bulldog', 'buster', 'butter', 'butthead', 'calvin', 'camaro', 'cameron', 'canada', 'captain', 'carlos', 'carter', 'casper', 'charles', 'charlie', 'cheese', 'chelsea', 'chester', 'chicago', 'chicken', 'cocacola', 'coffee', 'college', 'compaq', 'computer', 'cookie', 'cooper', 'corvette', 'cowboy', 'cowboys', 'crystal', 'cumming', 'cumshot', 'dakota', 'dallas', 'daniel', 'danielle', 'debbie', 'dennis', 'diablo', 'diamond', 'doctor', 'doggie', 'dolphin', 'dolphins', 'donald', 'dragon', 'dreams', 'driver', 'eagle1', 'eagles', 'edward', 'einstein', 'erotic', 'extreme', 'falcon', 'fender', 'ferrari', 'firebird', 'fishing', 'florida', 'flower', 'flyers', 'football', 'forever', 'freddy', 'freedom', 'fucked', 'fucker', 'fucking', 'fuckme', 'fuckyou', 'gandalf', 'gateway', 'gators', 'gemini', 'george', 'giants', 'ginger', 'golden', 'golfer', 'gordon', 'gregory', 'guitar', 'gunner', 'hammer', 'hannah', 'hardcore', 'harley', 'heather', 'helpme', 'hentai', 'hockey', 'hooters', 'horney', 'hotdog', 'hunter', 'hunting', 'iceman', 'iloveyou', 'internet', 'iwantu', 'jackie', 'jackson', 'jaguar', 'jasmine', 'jasper', 'jennifer', 'jeremy', 'jessica', 'johnny', 'johnson', 'jordan', 'joseph', 'joshua', 'junior', 'justin', 'killer', 'knight', 'ladies', 'lakers', 'lauren', 'leather', 'legend', 'letmein', 'letmein', 'little', 'london', 'lovers', 'maddog', 'madison', 'maggie', 'magnum', 'marine', 'marlboro', 'martin', 'marvin', 'master', 'matrix', 'matthew', 'maverick', 'maxwell', 'melissa', 'member', 'mercedes', 'merlin', 'michael', 'michelle', 'mickey', 'midnight', 'miller', 'mistress', 'monica', 'monkey', 'monkey', 'monster', 'morgan', 'mother', 'mountain', 'muffin', 'murphy', 'mustang', 'naked', 'nascar', 'nathan', 'naughty', 'ncc1701', 'newyork', 'nicholas', 'nicole', 'nipple', 'nipples', 'oliver', 'orange', 'packers', 'panther', 'panties', 'parker', 'password', 'password', 'password1', 'password12', 'password123', 'patrick', 'peaches', 'peanut', 'pepper', 'phantom', 'phoenix', 'player', 'please', 'pookie', 'porsche', 'prince', 'princess', 'private', 'purple', 'pussies', 'qazwsx', 'qwerty', 'qwertyui', 'rabbit', 'rachel', 'racing', 'raiders', 'rainbow', 'ranger', 'rangers', 'rebecca', 'redskins', 'redsox', 'redwings', 'richard', 'robert', 'rocket', 'rosebud', 'runner', 'rush2112', 'russia', 'samantha', 'sammy', 'samson', 'sandra', 'saturn', 'scooby', 'scooter', 'scorpio', 'scorpion', 'secret', 'sexsex', 'shadow', 'shannon', 'shaved', 'sierra', 'silver', 'skippy', 'slayer', 'smokey', 'snoopy', 'soccer', 'sophie', 'spanky', 'sparky', 'spider', 'squirt', 'srinivas', 'startrek', 'starwars', 'steelers', 'steven', 'sticky', 'stupid', 'success', 'suckit', 'summer', 'sunshine', 'superman', 'surfer', 'swimming', 'sydney', 'taylor', 'tennis', 'teresa', 'tereza', 'testes', 'tester', 'testing', 'theman', 'thomas', 'thunder', 'thx1138', 'tiffany', 'tigers', 'tigger', 'tomcat', 'toutcard', 'topgun', 'toyota', 'travis', 'trouble', 'trustno1', 'tucker', 'turtle', 'twitter', 'united', 'vagina', 'victor', 'victoria', 'viking', 'voodoo', 'voyager', 'walter', 'warrior', 'welcome', 'whatever', 'william', 'willie', 'wilson', 'winner', 'winston', 'winter', 'wizard', 'xavier', 'xxxxxx', 'xxxxxxxx', 'yamaha', 'yankee', 'yankees', 'yellow', 'zxcvbn', 'zxcvbnm', 'zzzzzz');

        $key = array_search($pass, $array);

        if (isset($key) && is_numeric($key)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verifica se o nome do arquivo já existe,
     * se existir adiciona um numero ao nome e verifica novamente.
     * @param $imagem
     * @param $dir
     * @return string
     */
    public static function checkNameFile($imagem, $dir)
    {
        $imagem_info = pathinfo($dir . $imagem);
        $imagem_nome = Tools::slug($imagem_info['filename']) . '.' . $imagem_info['extension'];
        $conta = 2;
        while (file_exists($dir . $imagem_nome)) {
            $imagem_nome = Tools::slug($imagem_info['filename']) . '-' . $conta;
            $imagem_nome .= '.' . $imagem_info['extension'];
            $conta++;
        }
        return $imagem_nome;
    }

}
