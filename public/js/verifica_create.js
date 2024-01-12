$(document).ready(function(){
    $("#form_create").submit(function(){
        var response = true;

        // base asta
        if(!$.isNumeric($("#base_asta_create").val())){
            $("#errore_base_asta_create").html('Inserire una base d\'asta con formato numerico').css('color', 'red');
            response = false;
        }else{
            $("#errore_base_asta_create").html('');
        }

        // categoria
        if($("#categorie_selezionate_create").val() == "0"){
            $("#errore_categoria_create").html('Seleziona almeno una categoria').css('color', 'red');
            response = false;
        }else{
            $("#errore_categoria_create").html('');
        }

        return response;
    });

    $('#categoria_create').change(function(){
        var categoria_id = $('#categoria_create').find(":selected").val();
        var categoria_testo = $('#categoria_create').find(":selected").text();

        array_categorie = [$("#categorie_selezionate_create").val()];
        console.log(array_categorie);
        if(array_categorie[0].indexOf(categoria_id) === -1){
            array_categorie.push(categoria_id);

            $("#categorie_selezionate").append(categoria_testo + " - ");

            $("#categorie_selezionate_create").val(array_categorie);
        }
    });

    $("#cancella_create").click(function(){
        $("#categorie_selezionate").html('');
        $("#categorie_selezionate_create").val("");
        $("#form_create")[0].reset();
    });
});