function getStatus(baby_id,b_name) {
    $.ajax({
       url:'../../ajax/admin.php',
       method:'POST',
       data:{id:baby_id},
       dataType:'JSON',
       success:function (data) {
           if (data['username']){
               $('#table').show();
               $('#msg').html(b_name+':');
               $('#username').html(data['username']);
               $('#name').html(data['name']);
               document.getElementById('seen1').disabled=false;
               $("#link1").attr('href','home.php?doctor_id='+data['doc_id']+'&slot='+data['slot']+'&baby_id='+baby_id);
           }
           else {
               $('#table').show();
               $('#username').html("empty");
               $('#name').html("empty");
               $('#msg').html(data['msg']);
               $("#msg2").html("");
               document.getElementById('seen1').disabled=true;
           }
           if (data['user_sis']){
               document.getElementById('seen2').disabled=false;
               $('#table').show();
               $('#msg').html(b_name+':');
               $('#sis_uname').html(data['user_sis']);
               $('#sis_name').html(data['name_sis']);
               $("#link2").attr('href','home.php?sister_id='+data['sis_id']+'&baby_id='+baby_id);
           }
           else {
               document.getElementById('seen2').disabled=true;
               $('#table').show();
               $('#sis_uname').html("empty");
               $('#sis_name').html("empty");
               $('#msg').html(data['msg']);
               $("#msg2").html("");
           }
       }
    });
}
$(document).ready(function () {
    $('#table').hide();
})