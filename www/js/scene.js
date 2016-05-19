$(document).ready(function () {

    $.getJSON('api/balance.php',function(resp) {

        console.log(resp);

    });

});
