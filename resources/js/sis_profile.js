$(document).ready(function () {
    $.ajax({
        url:'../../ajax/sis_profile.php',
        method:'POST',
        data:{sis:'11'},
        dataType:'JSON',
        success:function (data) {
            if (data['available']==0){
                document.getElementById("btn4").disabled=true;
                document.getElementById("btn4").value='Taken';
                $('#able').text(data['available']);
            }
            else {
                $('#able').text(data['available']);
            }
        }
    });
})