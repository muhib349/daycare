$(document).ready(function () {
    $('#search').on('keyup',function(e){
        var name=$(this).val();
        if(name != ''){
            $.ajax({
               url:'ajax/search.php',
                method:'POST',
                data:{name:name},
                success:function (data) {
                    $('#namelist').html(data);
                }
            });
        }
        else {
            $('#namelist').html("");
        }
    });
});