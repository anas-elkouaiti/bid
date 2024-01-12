$(document).ready(function(){
    $(window).on('load', function () {
        $('#spinner-loading').hide();
    });

    $("#form_search").submit(function(){
        var response = true;
        var testo = $("#testo_search").val();
        
        if(testo.replaceAll(' ','') == ""){
            response = false;
        }
        return response;
    });

    $("#bottone_search").click(function(){
        $("#form_search").submit();
    });

    $("#form_m_search").submit(function(){
        var response = true;
        var testo = $("#testo_m_search").val();
        
        if(testo.replaceAll(' ','') == ""){
            response = false;
        }
        return response;
    });

    $("#bottone_m_search").click(function(){
        $("#form_m_search").submit();
    });
});