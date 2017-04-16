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