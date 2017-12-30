
function updateDoc1() {
    $.post('../../ajax/fetch.php',{updateDoc1:'update1'},function (data) {
        if (data==1){
            document.getElementById("btn1").disabled=true;
            document.getElementById("btn1").value='Taken';
        }
        else {
            $('#msg').html(data);
        }
    });
}
function updateDoc2() {
    $.post('../../ajax/fetch.php',{updateDoc2:'update2'},function (data) {
        if (data==1){
            document.getElementById("btn2").disabled=true;
            document.getElementById("btn2").value='Taken';
        }
        else {
            $('#msg').html(data);
        }
    });
}
function updateDoc3() {
    $.post('../../ajax/fetch.php',{updateDoc3:'update3'},function (data) {
        if (data==1){
            document.getElementById("btn3").disabled=true;
            document.getElementById("btn3").value='Taken';
        }
        else {
            $('#msg').html(data);
        }
    });
}

function updateSis() {
    $.ajax({
        url:'../../ajax/assign_sis.php',
        method:'POST',
        data:{updatesis:1},
        dataType:'JSON',
        success:function (data) {
            if (data['success']==1){
                document.getElementById("btn4").disabled=true;
                document.getElementById("btn4").value='Taken';
                var num=$('#able').text();
                $('#able').text(num-1);
            }
            $('#msg').html(data['msg']);
        }
    });
}

