$(document).ready(function(){
    $('.countdown').each(function() {
        var data_finale = $(this).data('countdown');
        var countDownDate = new Date(data_finale).getTime();
        var id_timer = $(this).attr('id');
        const parts = id_timer.split("-");
        var id_prodotto = parts[1];

        var x = setInterval(function(){

            var now = new Date().getTime();

            var distance = countDownDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if(distance<0){
                clearInterval(x);
                document.getElementById(id_timer).innerHTML = "<h4>SCADUTO</h4>";
                document.getElementById(id_timer).classList.remove("countdown");
                // ajax
                $.get(
                    'http://localhost:8000/prodotti/dettaglio/'+id_prodotto+'/scaduto',
                    function(data){
                        console.log(data);
                    }
                );
            }else{
                document.getElementById("days-"+id_prodotto).innerHTML = days;
                document.getElementById("hours-"+id_prodotto).innerHTML = hours;
                document.getElementById("minutes-"+id_prodotto).innerHTML = minutes;
                document.getElementById("seconds-"+id_prodotto).innerHTML = seconds;
            }
        }, 1000);
    });

    // pagina dettaglio
    $('.countdown-det').each(function() {
        var data_finale = $(this).data('countdown');
        var countDownDate = new Date(data_finale).getTime();
        var id_timer = $(this).attr('id');
        const parts = id_timer.split("-");
        var id_prodotto = parts[1];
        var num_blocco = parts[2];
        
        var y = setInterval(function(){
            var now = new Date().getTime();

            var distance = countDownDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if(distance<0){
                clearInterval(y);
                document.getElementById(id_timer).innerHTML = "<h3 id='countdown-timer-1'>SCADUTO</h3>";
                document.getElementById(id_timer).classList.remove("countdown-det");
                
                $.get(
                    'http://localhost:8000/prodotti/dettaglio/'+id_prodotto+'/scaduto',
                    function(data){
                        console.log(data);
                    }
                );
            }else{
                document.getElementById("days-"+id_prodotto+"-"+num_blocco).innerHTML = days;
                document.getElementById("hours-"+id_prodotto+"-"+num_blocco).innerHTML = hours;
                document.getElementById("minutes-"+id_prodotto+"-"+num_blocco).innerHTML = minutes;
                document.getElementById("seconds-"+id_prodotto+"-"+num_blocco).innerHTML = seconds;
            }
        }, 1000);
    });

    $('.scaduto').each(function(){
        var id_timer = $(this).attr('id');
        const parts = id_timer.split("-");
        var id_prodotto = parts[1];
        
        $.get(
            'http://localhost:8000/prodotti/dettaglio/'+id_prodotto+'/scaduto',
            function(data){
                console.log(data);
            }
        );
    });
})