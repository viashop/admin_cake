<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 28/09/16 às 19:41
 */

namespace Email\Template;
use Email\Config\SendMail;

abstract class AbstractThemeFactory extends SendMail
{

    /**
     * Template em HTML
     * @param string $linkLoja
     */
    public function templateHTML($linkLoja='')
    {
        $theme = new ThemeDefaultHTML();
        $theme->setLinkLoja( trim( $linkLoja ) );
        return $theme->template();
    }

    public function templateTXT($linkLoja='')
    {
        $theme = new ThemeDefaultTXT();
        $theme->setLinkLoja( trim( $linkLoja ) );
        return $theme->template();
    }

    abstract public function draw();

}