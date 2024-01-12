$(document).ready(function(){
    $("#form_login").submit(function(){
        var response = true;

        //email
        const regex_email = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        if(!regex_email.test($("#email_login").val())){
            $("#errore_email_login").html('Formato email non valido!').css('color', 'red');
            response = false;
        }else{
            $("#errore_email_login").html('');
        }

        //checkbox
        if($("#termini_login").is(":checked") === false){
            $("#errore_termini_login").html('Necessario accettare i termini e le condzioni!').css('color', 'red');
            response = false;
        }else{
            $("#errore_termini_login").html('');
        }

        return response;
    })
}); 