$(document).ready(function () {
    $.ajax({
        url:'../../ajax/profile.php',
        method:'POST',
        data:{var:'11'},
        success:function (data) {
            var value=data.split(',');
            if(value[0]!=0){
                document.getElementById("btn1").disabled=true;
                document.getElementById("btn1").value='Taken';
            }
            if(value[1]!=0){
                document.getElementById("btn2").disabled=true;
                document.getElementById("btn2").value='Taken';

            }
            if(value[2]!=0){
                document.getElementById("btn3").disabled=true;
                document.getElementById("btn3").value='Taken';
            }
        }
    });
})