$(document).ready(function() {
    /* Ajax busca cidade */
    $("select[name=estadoId]").change(function() {
        $("select[name=cidadeId]").html('<option value="0">Carregando...</option>');

        $.get("includes/selecionarCidade.php?acao=ajax", {
            estadoId: $(this).val()
        }, function(valor) {
            $("select[name=cidadeId]").html(valor);
        })

    });
});

$(document).ready(function () {
    $('#load').hide();
});

$(function () {
    $(".delete").click(function () {
        $('#load').fadeIn();
        var commentContainer = $(this).parent();
        var id = $(this).attr("id");
        var string = 'module=ajax&token=' + id;

        $.ajax({
            type: "GET",
            url: "includes/ajax/deleteInvitation.php",
            data: string,
            cache: false,
            success: function () {
                commentContainer.slideUp('slow', function () {
                    $(this).remove();
                });
                $('#load').fadeOut();
            }

        });

        return false;
    });
});

function tmt_confirm(msg){
    document.MM_returnValue=(confirm(unescape(msg)));
}

$(document).ready(function () {
    $('#conteudo').hide();
    $('#mostrar').click(function (event) {
        event.preventDefault();
        $("#conteudo").show("slow");
    });
    $('#ocultar').click(function (event) {
        event.preventDefault();
        $("#conteudo").hide("slow");
    });
});

function loadingOpenDiv(){
    document.getElementById("__loadingOpen").style.display = "block";
}

function loadingClosedDiv(){
    document.getElementById("__loadingOpen").style.display = "none";
}

function bodyOnReady(func){
//by Micox - based in jquery bindReady and Diego Perini IEContentLoaded
    //flag global para indicar que já rodou e function que roda realmente
    done = false
    init = function(){ if(!done) { done=true; func() } }
    var d=document; //apelido para o document
    //pra quem tem o DOMContent (FF)
    if(document.addEventListener){ d.addEventListener("DOMContentLoaded", init, false );}

    if( /msie/i.test( navigator.userAgent ) ){ //IE
        (function () {
            try { // throws errors until after ondocumentready
                d.documentElement.doScroll("left");
            } catch (e) {
                setTimeout(arguments.callee, 10); return;
            }
            // no errors, fire
            init();
        })();
    }
    if ( window.opera ){
        d.addEventListener( "DOMContentLoaded", function () {
            if (done) return;
            //no opera, os estilos só são habilitados no fim do DOMready
            for (var i = 0; i < d.styleSheets.length; i++){
                if (d.styleSheets[i].disabled)
                    setTimeout( arguments.callee, 10 ); return;
            }
            // fire
            init();
        }, false);
    }
    if (/webkit/i.test( navigator.userAgent )){ //safari's
        if(done) return;
        //testando o readyState igual a loaded ou complete
        if ( /loaded|complete/i.test(d.readyState)===false ) {
            setTimeout( arguments.callee, 10 ); return;
        }
        init();
    }
    //se nada funfou eu mando a velha window.onload lenta mesmo
    if(!done) window.onload = init
}