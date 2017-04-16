$(document).ready(function() {
    $("#id_apelido").keyup(function (e) {
    
        //remove espacos em dominio
        $(this).val($(this).val().replace(/\s/g, ''));
        $(this).val($(this).val().replace(/[^a-z0-9_-]+/gi, ''));
        
        var id_apelido = $(this).val();
        
        if(id_apelido.length < 3) {
            $("#apelido-result").html('');
            return;
        }
        
        if(id_apelido.length >= 3){
			
            $("#apelido-result").html('<img src="/admin/img/ajax-loader-domain.gif" />');
			
            $.post('/admin/shopDominio/checaDominioAjax', {'dominio':id_apelido}, function(data) {
	
				if(data == 'True'){
					$("#apelido-result").html('<img src="/admin/img/not-available-domain.png" />');
				} else {
					$("#apelido-result").html('<img src="/admin/img/available-domain.png" />');
				}				
                
            });
			
        }
		
    });
	
});