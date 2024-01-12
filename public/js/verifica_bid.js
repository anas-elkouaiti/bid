$(document).ready(function(){
    $("#form_bid").submit(function(){
        var response = true;

        // controlla che prezzo sia numerico
        var prezzo_attuale = parseFloat($("#div_prezzo").data('prezzo'));
        var prezzo_offerta = parseFloat($("#prezzo_bid").val().replace(",", ""));
        var num_offerte = $("#div_prezzo").data('numofferte');

        console.log(prezzo_attuale);
        console.log(prezzo_offerta);

        if(!$.isNumeric(prezzo_offerta)){
            response = false;
            $("#errore_prezzo_bid").html('L\'offerta deve essere nel formato numerico').css('color', 'red');
        }else{
            $("#errore_prezzo_bid").html('');
        }

        // verifica prezzo
        if(response){
            if(num_offerte == 0){
                if(prezzo_offerta < prezzo_attuale){
                    response = false;
                    $("#errore_prezzo_bid").html('L\'offerta deve superare o eguagliare la base d\'asta').css('color', 'red');
                }else{
                    $("#errore_prezzo_bid").html('');
                }
            }else{
                if(prezzo_offerta <= prezzo_attuale){
                    response = false;
                    $("#errore_prezzo_bid").html('L\'offerta deve superare l\'offerta attuale').css('color', 'red');
                }else{
                    $("#errore_prezzo_bid").html('');
                }
            }
        }

        // verifica budget
        if(response){
            var id_utente = $("#div_prezzo").data('utente');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                async: false
            });

            $.post('http://localhost:8000/user/verifyBudget',
                {
                    'offerta': prezzo_offerta,
                    'id_utente': id_utente
                },
                function(data){à
                    if(!data){
                        response = false
                        $("#errore_prezzo_bid").html('Non hai budget sufficiente per procedere con questa offerta').css('color', 'red');
                    }
                }
            );
        }

        console.log(response);
        return response;
    });
});