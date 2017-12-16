function updateDoc(baby_id,doc_id,slot_no) {
    $.post('../../ajax/assign.php',{doc_id:doc_id,baby_id:baby_id,slot_no:slot_no},function (data) {
        if (data==1){
            $('#btn1').text('Success');
            $('#msg').text('You are successfully added doctor')
        }
        else if(data==2){
            $('#btn2').text('Success');
            $('#msg').text('You are successfully added doctor')
        }
        else if (data==3)
        {
            $('#btn3').text('Success');
            $('#msg').text('You are successfully added doctor')
        }
        else
            $('#msg').text(data);
    });
}

function updateSis(baby_id,sis_id) {
    alert(doc_id);
}