$(document).ready(function(){
    $("#form_signup").submit(function(){
        var response = true;

        // email
        const regex_email = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        if(!regex_email.test($("#email_signup").val())){
            $("#errore_email_signup").html('Formato email non valido!').css('color', 'red');
            response = false;
        }else{
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                async: false
            });
            $.post("http://localhost:8000/user/checkEmail",
                {
                    "email": $("#email_signup").val()
                },
                function(data){
                    if(data){
                        $("#errore_email_signup").html('');
                    }else{
                        $("#errore_email_signup").html('Email già registrata!').css('color', 'red');
                    }
                }
            );
        }

        //username
        if($("#username_signup").val().length < 4){
            $("#errore_username_signup").html('Username deve essere almeno di 4 caratteri!').css('color', 'red');
            response = false;
        }else{
            $("#errore_username_signup").html('');
        }

        //password
        if($("#password_signup").val().length < 6){
            $("#errore_password_signup").html('Password deve essere almeno di 6 caratteri!').css('color', 'red');
            response = false;
        }else{
            $("#errore_password_signup").html('');
        }

        if(!$("#termini_signup").is(":checked")){
            $("#errore_termini_signup").html('Necessario accettare i termini e le condzioni!').css('color', 'red');
            response = false;
        }else{
            $("#errore_termini_signup").html('');
        }
        return response;
    });
});