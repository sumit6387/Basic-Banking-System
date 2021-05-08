<?php include 'assets/header.php';
?>
<div class="row card cards">
    <h2 class="text-center" style="margin-top:2%;">Add New User</h2>
    <div class="row crd">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form action="addUserInfo.php" method="POST" class="database_operation">
                <div>
                    <label for="name">Name : </label>
                    <input type="text" class="form-control" id="username" required name="username" placeholder="Enter Users Name">
                    <small></small>
                </div>

                <div>
                    <label for="email">Email : </label>
                    <input type="email" class="form-control" required name="email" placeholder="Enter Email">
                </div>
                <div>
                    <label for="balance">Amount : </label>
                    <input type="number" class="form-control" required name="amount" placeholder="Enter Amount">
                </div>
                <div>
                    <button class="btn btn-primary my-3" name="submit">Create</button>
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<?php include 'assets/footer.php';?>
<script>
$(document).ready(function(){
$('.database_operation').submit(function(){
    var url = $(this).attr('action');
    var data = $(this).serialize();
    $.post(url,data,function(data,status){
        var data = JSON.parse(data);
        if(data.status){
            $('.form-control').val('');
            $('small').hide();
            alert(data.msg)
        }else{
            alert(data.msg);
        }
    });
    return false;
});

// for check username live
$('#username').keyup(function(){
    var username = $(this).val();
    $.post("checkUsername.php",{name : username},function(data , status){
        var data = JSON.parse(data);
        console.log(data)
        if(data.status){
            $('small').html(data.msg)
            $('small').css('color' ,"green");
        }else{
            $('small').html(data.msg)
            $('small').css('color' ,"red");
        }
    });
});
});
</script>
