$(document).ready(function () {
    $.ajax({
        url:'../../ajax/profile.php',
        method:'POST',
        data:{var:'11'},
        dataType:'JSON',
        success:function (data) {
            if(data['slot-1']!=0){
                document.getElementById("btn1").disabled=true;
                document.getElementById("btn1").value='Taken';
            }
            if(data['slot-2']!=0){
                document.getElementById("btn2").disabled=true;
                document.getElementById("btn2").value='Taken';

            }
            if(data['slot-3']!=0){
                document.getElementById("btn3").disabled=true;
                document.getElementById("btn3").value='Taken';
            }
        }
    });
})