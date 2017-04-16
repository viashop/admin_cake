<!-- Begin Loading api 1.4.4
================================================== -->
<?php
//echo $this->Html->script( '//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js');
?>
<div id="loading_processando">
    <p>
    <?php echo $this->Html->image('ajax-loader.gif', array('alt' => 'Loading')); ?> &nbsp;&nbsp;Processando aguarde...
    </p>
</div>
<script language="javascript" type="text/javascript">
        $(function(){
            $('#loading_processando').hide();
            $('#processando').click(function(){
                $('#loading_processando').show();
            });
        });
</script>
<!-- end Loading -->