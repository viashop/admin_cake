<style type="text/css">
.emkt-export .control-label { padding-top: 0; }
.emkt-export .alert { padding: 4px 20px; margin: 0; font-size: 18px; display: inline-block; }
.emkt-export p { font-size: 14px; }
.emkt-export + hr + p { margin: -15px 0 -5px; }
.news-descadastramento p { word-break: break-all; }
</style>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="#"><i class="icon-custom icon-graph"></i> Marketing</a> <span class="bread-separator">-</span></li>
        <li><span>Lista de e-mails</span></li>
    </ul>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="pull-left">
            Email Marketing
        </h3>
    </div>
    <div class="box-content form-horizontal">
        <div class="emkt-export form-group">
            <div class="span4 control-label">
                <label class="text">Emails para exportação:</label>
                <div class="alert alert-warning"><strong><?php echo \Lib\Tools::formatTotal($total); ?></strong></div>
            </div>
            <div class="span8">
                <a href="<?php echo VIALOJA_PAINEL ?>/recurso/newsletter/exportar/formato.csv" class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Exportar em formato CSV</a>
                <a href="<?php echo VIALOJA_PAINEL ?>/recurso/newsletter/exportar/formato.txt" class="btn btn-primary"><span class="glyphicon glyphicon-download-alt"></span> Exportar em formato TXT</a>
            </div>
        </div>
    
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12 text-center">
                     <h4>Não sabe como mandar seus emails?</h4>
                </div>
            </div>
            <div class="custom-box">
                <div class="span3">

                     <a href="http://bit.ly/viabenchmarkemail" target="_blank">
                    <img src="/admin/img/parceiros/benchmark.png" title="Benchmark email" />
                    </a>

                </div>
                <div class="span9">

                    <p class="margin"><a href="http://bit.ly/viabenchmarkemail" target="_blank">Registre-se agora na Benchmark <span class="glyphicon glyphicon-share"></span></a> <br />E comece a mandar seus emails. </p>

                </div>
            </div>
            <div class="custom-box">
                <div class="span3">

                     <a href="http://gr8.com/pr/Bm13" target="_blank">
                    <img src="/admin/img/parceiros/getresponse.png" title="GetResponse email" />
                    </a>

                </div>
                <div class="span9">

                    <p class="margin">Precisa de E-mail Marketing com Autoresponder? <br /><a href="http://gr8.com/pr/Bm13" target="_blank">Cadastre-se no GetResponse <span class="glyphicon glyphicon-share"></span></a> </p>

                </div>
            </div>
        </div>

    </div>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="pull-left">
            Link para descadastramento
        </h3>
    </div>
    <div class="box-content news-descadastramento">
        <p>Caso necessite, utilize o padrão do link abaixo para realizar o descadastramento dos emails:</p>
        <p>http://<?php echo $url_shop; ?>/newsletter/unsubscribe/<strong>EMAIL_CLIENTE</strong></p>
    </div>

</div>