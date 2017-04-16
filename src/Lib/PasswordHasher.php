<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 21/10/16 às 00:01
 */

namespace Lib;


class PasswordHasher
{

    /**
     * PasswordHash constructor.
     * @param $password
     * @return bool|string
     */
    public static function generate($password)
    {

        $options = [
            'cost' => 7,
            //'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
        ];

        return password_hash($password, PASSWORD_BCRYPT, $options);

    }

}