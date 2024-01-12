$(document).ready(function(){
    $("#myTable-1").tablesorter();
    $("#myTable-2").tablesorter();

    $("#myInput-1").keyup(function(){
        var value = $(this).val().toLowerCase();
        $("#myTable-1Body tr").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        }); 
    });

    $("#myInput-2").keyup(function(){
        var value = $(this).val().toLowerCase();
        $("#myTable-2Body tr").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        }); 
    });

    $("#form_update").submit(function(){
        var response = true;

        //email
        const regex_email = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        if(!regex_email.test($("#email_update").val())){
            $("#errore_email_update").html('Formato email non valido!').css('color', 'red');
            response = false;
        }else{
            $("#errore_email_update").html('');
        }

        //password
        var old_password = $("#old_password_update").val();
        var new_password = $("#new_password_update").val();
        var confirm_password = $("#confirm_password_update").val();
        if(old_password != ""){
            if(new_password != confirm_password || new_password == ""){
                $("#errore_confirm_password_update").html('Le password inserite sono diverse!').css('color', 'red');
                response = false;
            }else{
                $("#errore_confirm_password_update").html('');
            }
        }

        console.log(response);
        return response;
    });
});