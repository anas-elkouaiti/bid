$(document).ready(function(){
    $("#form_contact").submit(function(){
        var response = true;

        //email
        var email = $("#email_contact").val();
        const regex_email = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        if(!regex_email.test(email)){
            $("#errore_email_contact").html('Formato email non valido!').css('color', 'red');
            response = false;
        }else{
            $("#errore_email_contact").html('');
        }

        return response;
    });
})
