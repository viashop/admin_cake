<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 28/09/16 às 19:41
 */

namespace Email\Template;

class ThemeDefaultHTML
{

    private $linkLoja;

    /**
     * @param mixed $linkLoja
     */
    public function setLinkLoja($linkLoja)
    {
        $this->linkLoja = $linkLoja;
    }

    /**
     * @param $link_loja
     * @return string
     */
    public function template()
    {

        $html = "<html>
        <head>
            <style type=\"text/css\">

                /* Email Client BUG Fixes */
                .ReadMsgBody, .ExternalClass {
                    width: 100%;
                    background-color: #f7f7f7;
                }

                .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
                    line-height: 100%;
                }

                body {
                    -webkit-text-size-adjust: none;
                    -ms-text-size-adjust: none;
                }

                body {
                    margin: 0;
                    padding: 0;
                }

                table {
                    border-spacing: 0;
                    border-collapse: collapse;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                }

                table td {
                    border-collapse: collapse;
                }

                img {
                    border: 0;
                }

                html {
                    width: 100%;
                    height: 100%;
                }

                /* End Email Client BUG Fixes */

                /* Embedded CSS link color */
                a {
                    color: #0080b7;
                    text-decoration: none;
                }

                a:link {
                    color: #0080b7;
                    text-decoration: none;
                }

                a:visited {
                    color: #0080b7;
                    text-decoration: none;
                }

                a:focus {
                    color: #0080b7 !important;
                }

                a:hover {
                    color: #0080b7 !important;
                }

                .button a:hover, .button a:visited, .button a:link, .button a:active {
                    text-decoration: none;
                    color: #fff !important;
                }

                /* End of Embedded CSS link color */

                /* Clickable phone numbers */
                a[href^=\"tel\"], a[href^=\"sms\"] {
                    text-decoration: none;
                    color: #525252;
                    pointer-events: none;
                    cursor: default;
                }

                .mobile_link a[href^=\"tel\"], .mobile_link a[href^=\"sms\"] {
                    text-decoration: none;
                    color: #0080b7 !important;
                    pointer-events: auto;
                    cursor: default;
                }

                /* End of Clickable phone numbers */

                /* Media Queries */

                @media only screen and (max-width: 639px) {
                    body {
                        width: auto !important;
                    }

                    /* Adjust table widths at smaller screen sizes */
                    body[yahoo] .table {
                        width: 320px !important;
                    }

                    body[yahoo] .inside {
                        width: 250px !important;
                    }

                    body[yahoo] .remove {
                        width: 0px !important;
                    }

                    /* Center Elements in Tables */
                    body[yahoo] .content-center {
                        text-align: center !important;
                    }

                    /* Center Buttons in Tables */
                    body[yahoo] .button-center {
                        display: block !important;
                        margin-left: auto !important;
                        margin-right: auto !important;
                        text-align: center !important;
                    }

                    /* Header columns */
                    body[yahoo] .header-left {
                        width: 320px !important;
                    }

                    body[yahoo] .header-left img {
                        display: block !important;
                        margin-left: auto !important;
                        margin-right: auto !important;
                    }

                    body[yahoo] .socials-right {
                        display: none !important;
                    }

                    /* Footer columns */
                    body[yahoo] .footer {
                        width: 320px !important;
                        text-align: center !important;
                    }

                    body[yahoo] .footer img {
                        display: none !important;
                    }

                    /* Image 600 Resized */
                    body[yahoo] .image600 img {
                        width: 300px !important;
                        display: block !important;
                        margin-left: auto !important;
                        margin-right: auto !important;
                    }

                    /* Image 560 Resized */
                    body[yahoo] .image560 img {
                        width: 280px !important;
                        height: 100px !important;
                    }

                    /* Image 270 and Text  Resized */
                    body[yahoo] .image270 img {
                        width: 280px !important;
                        height: 208px !important;
                        display: block !important;
                        margin-left: auto !important;
                        margin-right: auto !important;
                    }

                    body[yahoo] .image270-2 img {
                        width: 280px !important;
                        height: 208px !important;
                    }

                    body[yahoo] .text270 {
                        width: 310px !important;
                    }

                    body[yahoo] .text270-2 {
                        width: 300px !important;
                    }

                    body[yahoo] .distance {
                        height: 15px !important;
                    }

                    body[yahoo] .hideable {
                        display: none !important;
                    }

                /* End of Media Queries */

            </style>
        </head>

        <body style=\"width:100% !important; color:#333333; background:#f7f7f7; font-family: Helvetica,sans-serif;
              font-size:13px; line-height:130%; margin:0; padding:0;\" yahoo=\"fix\">


        <!-- * Header Module * -->
        <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"width:100% !important;
               margin:0; padding:0; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\">";

        if (isset($this->linkLoja) && !empty($this->linkLoja)) {

            $html .= "<tr>
            <td bgcolor=\"#f7f7f7\">
                <!-- Tables Width -->
                <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"table\">

                    <!-- Top Header -->
                    <tr>
                        <td>
                            <table width=\"100%\" cellpadding=\"10\" cellspacing=\"0\" border=\"0\">
                                <tr>
                                    <td height=\"24\" valign=\"middle\" style=\"font-size:11px; color:#808080; text-align:right\" class=\"content-center\">
                                    <a href=\"{$this->linkLoja}\" target=\"_blank\" style=\"color:#525252;
                                        text-decoration:none;\">Link de acesso</a>
                                    para a sua loja.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- End of Top Header -->

                </table>
                <!-- End of Tables Width -->
            </td>
        </tr>";

        }

        $html .= "
        <tr>
            <td height=\"10\" bgcolor=\"#f7f7f7\" align=\"center\" class=\"image600\"><img
                    src=\"http:".CDN_IMG."/vialoja/logos/email/shadow_header_top.jpg\" width=\"600\" height=\"10\" border=\"0\"
                    alt=\"\" title=\"\" style=\"display:block; border:none; outline:none; text-decoration:none;\" />
            </td>
        </tr>
        <tr>
            <td height=\"1\" bgcolor=\"#d7d7d7\"></td>
        </tr>
        <tr>
            <td bgcolor=\"#ffffff\">
                <!-- Tables Width -->
                <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"table\">
                    <tr>
                        <td>

                            <!-- A1 -->
                            <table align=\"left\" bgcolor=\"#ffffff\" width=\"300\" cellpadding=\"0\" cellspacing=\"0\"
                                   border=\"0\" class=\"header-left\">
                                <tr>
                                    <td width=\"20\"></td>

                                    <!-- Logo Image -->
                                    <td width=\"247\" align=\"left\" valign=\"top\">
                                        <a href=\"". VIALOJA_HTTP_HOST ."\" target=\"_blank\"><img src=\"http:". CDN_IMG ."/vialoja/logos/email/default-header.png\"
                                        width=\"252\" height=\"80\" border=\"0\" alt=\"ViaLoja Logo Header\"
                                        style=\"display:block; border:none; outline:none; text-decoration:none;
                                        margin-top:5px;\"/></a>
                                    </td>
                                    <!-- End of Logo Image -->

                                    <td width=\"20\"></td>
                                </tr>
                            </table>
                            <!-- End of A1 -->

                            <!-- Social Links -->
                            <table align=\"right\" width=\"295\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"
                                   class=\"socials-right\">
                                <tr>
                                    <td width=\"15\" bgcolor=\"#ffffff\"></td>
                                    <td width=\"260\" height=\"50\" bgcolor=\"#ffffff\">
                                        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"right\">
                                            <tr>
                                                <td>
                                                    <a href=\"https://twitter.com/vialoja\" target=\"_blank\"
                                                       style=\"text-decoration: none;\">
                                                    <img src=\"http:".CDN_IMG."/vialoja/logos/email/social_twitter.png\"
                                                         width=\"34\" height=\"90\" border=\"0\" alt=\"Twitter\"
                                                         title=\"Twitter\" style=\"display:block; border:none; outline:none;
                                                         text-decoration:none;\" />
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href=\"https://www.facebook.com/vialoja.com.br\" target=\"_blank\"
                                                       style=\"text-decoration: none;\">
                                                    <img src=\"http:".CDN_IMG."/vialoja/logos/email/social_facebook.png\"
                                                         width=\"34\" height=\"90\" border=\"0\" alt=\"Facebook\"
                                                         title=\"Facebook\" style=\"display:block; border:none; outline:none;
                                                         text-decoration:none;\" />
                                                    </a>
                                                </td>

                                                <td>
                                                    <a href=\"https://plus.google.com/+VialojaBr\" target=\"_blank\"
                                                       style=\"text-decoration: none;\">
                                                    <img src=\"http:".CDN_IMG."/vialoja/logos/email/social_google.png\"
                                                         width=\"34\" height=\"90\" border=\"0\" alt=\"Google\" title=\"Google\"
                                                         style=\"display:block; border:none; outline:none;
                                                         text-decoration:none;\" />
                                                    </a>
                                                </td>
                                                <!--
                                                <td>
                                                    <a href=\"#\" target=\"_blank\" style=\"text-decoration: none;\">
                                                        <img src=\"images/social-skype.jpg\" width=\"34\" height=\"90\" border=\"0\" alt=\"Skype\" title=\"Skype\" style=\"display:block; border:none; outline:none; text-decoration:none;\" />
                                                    </a>
                                                </td>

                                                <td>
                                                    <a href=\"#\" target=\"_blank\" style=\"text-decoration: none;\">
                                                        <img src=\"images/social-vimeo.jpg\" width=\"34\" height=\"90\" border=\"0\" alt=\"Vimeo\" title=\"Vimeo\" style=\"display:block; border:none; outline:none; text-decoration:none;\" />
                                                    </a>
                                                </td>
                                                 -->
                                            </tr>
                                        </table>

                                    </td>
                                    <td width=\"20\" bgcolor=\"#ffffff\"></td>
                                </tr>
                            </table>
                            <!-- End of Social Links -->

                        </td>
                    </tr>
                </table>
                <!-- End of Tables Width -->
            </td>
        </tr>
        <tr>
            <td height=\"1\" bgcolor=\"#d7d7d7\"></td>
        </tr>
        <tr>
            <td height=\"16\" bgcolor=\"#f7f7f7\" align=\"center\" class=\"image600\"><img
                    src=\"http:".CDN_IMG."/vialoja/logos/email/shadow_header_bottom.jpg\" width=\"600\" height=\"16\"
                    border=\"0\" alt=\"\" title=\"\" style=\"display:block; border:none; outline:none; text-decoration:none;\"
                />
            </td>
        </tr>
        </table>
        
        <!-- * End of Header Module * -->%%%content%%%<!-- * Footer Module * -->
        
        <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"width:100% !important; margin:0; padding:0; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\">
        <tr>
            <td bgcolor=\"#f7f7f7\">
                <!-- Tables Width -->
                <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" bgcolor=\"#f7f7f7\"
                       class=\"table\">
                    <tr>
                        <td height=\"20\" bgcolor=\"#f7f7f7\"></td>
                    </tr>
                    <tr>
                        <td>

                            <!-- F1 -->
                            <table align=\"left\" bgcolor=\"#f7f7f7\" width=\"300\" cellpadding=\"0\" cellspacing=\"0\"
                                   border=\"0\" class=\"footer\">
                                <tr>
                                    <td width=\"20\"></td>

                                    <!-- First Colomn Links  -->
                                    <td width=\"120\" style=\"vertical-align: top; color: #0080b7; font-size: 15px; font-family:
                                        Helvetica, Arial, sans-serif; font-weight: bold; line-height:160%\">
                                    Access rápido
                                    <a href=\"". VIALOJA_ADMIN ."\" target=\"_blank\" style=\"text-decoration: none; color:
                                    #525252; line-height:160%; font-size: 12px;\"><br/>
                                    Painel de controle</a>
                                    <a href=\"". VIALOJA_TICKET ."\" target=\"_blank\" style=\"text-decoration: none; color:
                                    #525252; line-height:160%; font-size: 12px;\"><br/>
                                    Ticket de suporte</a>
                                    <a href=\"". VIALOJA_FORUM ."\" target=\"_blank\" style=\"text-decoration: none; color:
                                    #525252; line-height:160%; font-size: 12px;\"><br/>
                                    Fórum de ajuda</a>
                                    <a href=\"". VIALOJA_PUBLIC . '/esqueceu/senha/' ."\" target=\"_blank\"
                                    style=\"text-decoration: none; color: #525252; line-height:160%; font-size: 12px;\"><br/>
                                    Recuperar senha</a>
                                    <a href=\"". VIALOJA_PUBLIC . '/login/' ."\" target=\"_blank\" style=\"text-decoration:
                                    none; color: #525252; line-height:160%; font-size: 12px;\"><br/>
                                    Login</a>
                                    <!--
                                    <a href=\"#\" target=\"_blank\" style=\"text-decoration: none; color: #525252; line-height:160%; font-size: 12px;\"><br />
                                    Alterar dados</a>
                                    -->

                                    </td>
                                    <!-- End of First Colomn Links -->

                                    <td width=\"20\"></td>

                                    <!-- Second Colomn Links -->
                                    <td width=\"120\" style=\"vertical-align: top; color: #0080b7; font-size: 15px; font-family:
                                        Helvetica, Arial, sans-serif; font-weight: bold; line-height:160%\">
                                        Fale Conosco
                                    <a href=\"". VIALOJA_FALE_CONOSCO ."\" target=\"_blank\" style=\"text-decoration: none;
                                    color: #525252; line-height:160%; font-size: 12px;\"><br/>
                                    Contato</a>

                                    </td>
                                    <!-- End of Second Colomn Links -->

                                    <td width=\"20\"></td>
                                </tr>
                            </table>
                            <!-- End of F1 -->

                            <!-- F2 -->
                            <table align=\"right\" bgcolor=\"#f7f7f7\" width=\"295\" cellpadding=\"0\" cellspacing=\"0\"
                                   border=\"0\" class=\"footer\">
                                <tr>
                                    <td width=\"15\"></td>

                                    <td width=\"260\" align=\"right\" style=\"vertical-align: top; font-size: 12px;color:#525252;\">

                                    <!-- Logo Image -->
                                    <a href=\"#\" target=\"_blank\" style=\"text-decoration: none;\">
                                    <img src=\"http:".CDN_IMG."/vialoja/logos/email/default-transparente-footer.png\"
                                         width=\"158\" height=\"50\" border=\"0\" alt=\"ViaLoja Logo footer\" title=\"Logo\"
                                    style=\"display:block; border:none; outline:none; text-decoration:none;\" />
                                    </a>
                                    <!-- End of Logo Image -->

                                    </td>
                                    <td width=\"20\"></td>
                                </tr>
                                <tr>
                                    <td width=\"15\"></td>
                                    <td style=\"text-align:right; vertical-align: top; font-size: 12px; font-family: Helvetica,
                                        Arial, sans-serif; color:#525252;\" class=\"content-center \">
                                    <br/>
                                    Centro de suporte
                                    <br/>
                                    <span class=\"mobile_link\">
                                        <a href=\"". VIALOJA_SUPORTE ."\" style=\"text-decoration: none;\">". VIALOJA_SUPORTE_TXT_EMAIL ."</a>
                                    </span>
                                    <!--
                                    <br />
                                    LordThemes Street, London, UK
                                    <br />
                                    <span class=\"mobile_link\">
                                        Support Center:
                                        <a href=\"tel:(321) 555-985\" style=\"text-decoration: none; color: #525252;\">(321) 555-985</a>
                                    </span>
                                    -->
                                    </td>
                                    <td width=\"20\"></td>
                                </tr>
                            </table>
                            <!-- End of F2 -->

                        </td>
                    </tr>
                    <tr>
                        <td height=\"15\" bgcolor=\"#f7f7f7\"></td>
                    </tr>
                    <tr>
                        <td height=\"9\" bgcolor=\"#f7f7f7\" align=\"center\" class=\"image600\"><img
                                src=\"http:".CDN_IMG."/vialoja/logos/email/shadow_footer.jpg\" width=\"600\" height=\"9\"
                                border=\"0\" alt=\"\" title=\"\" style=\"display:block; border:none; outline:none;
                                text-decoration:none;\" />
                        </td>
                    </tr>
                </table>
                <!-- End of Tables Width -->
            </td>
        </tr>
        </table>

        <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"width:100% !important; margin:0; padding:0; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\">
        <tr>
            <td height=\"1\" bgcolor=\"#d7d7d7\"></td>
        </tr>
        <tr>
            <td bgcolor=\"#f7f7f7\">
                <!-- Tables Width -->
                <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" bgcolor=\"#f7f7f7\"
                       class=\"table\">
                    <tr>
                        <td height=\"20\"></td>
                    </tr>
                    <tr>
                        <!-- Copyright -->
                        <td bgcolor=\"#f7f7f7\" align=\"center\" style=\"font-size: 12px; color: #808080; font-weight: normal;
                            text-align: center; font-family: Helvetica, Arial, sans-serif;\">
            Este é um e-mail automático disparado pelo sistema.
                        <br/>
                        Favor não respondê-lo.
                        <br/>
                        Atenciosamente Equipe Vialoja
                        </td>
                        <!-- End of Copyright -->
                    </tr>
                </table>
                <!-- End of Tables Width -->
            </td>
        </tr>

        <tr>
            <td bgcolor=\"#f7f7f7\">
                <!-- Tables Width -->
                <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" bgcolor=\"#f7f7f7\"
                       class=\"table\">
                    <tr>
                        <td height=\"20\"></td>
                    </tr>
                    <tr>

                        <!-- Copyright -->
                        <td bgcolor=\"#f7f7f7\" align=\"center\" style=\"font-size: 12px; color: #808080; font-weight: bold;
                            text-align: center; font-family: Helvetica, Arial, sans-serif;\">
            Copyright &copy; ". date('Y') ." - ViaLoja
                        <a href=\"http://". ltrim( env('HTTP_BASE') , "." ) ."\" target=\"_blank\" style=\"text-decoration:
                        none; color: #808080;\">". ltrim( env('HTTP_BASE') , "." ) ." </a>
                        </td>
                        <!-- End of Copyright -->

                    </tr>
                    <tr>
                        <td height=\"20\"></td>
                    </tr>
                </table>
                <!-- End of Tables Width -->
            </td>
        </tr>
        </table>
        <!-- * End of Footer Module * -->

        </body>

        </html>";

        return $html;

    }

}