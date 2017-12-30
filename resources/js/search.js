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

$(document).ready(function () {
    $('#search2').on('keyup',function(e){
        var name=$(this).val();
        if(name != ''){
            $.ajax({
                url:'../../ajax/search.php',
                method:'POST',
                data:{home:name},
                success:function (data) {
                    $('#namelist2').html(data);
                }
            });
        }
        else {
            $('#namelist2').html("");
        }
    });
});