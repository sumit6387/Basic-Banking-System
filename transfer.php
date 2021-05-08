<?php
include "assets/header.php";
include "assets/conn.php";
?>
<style>
.transfer-to{
    background-color : skyblue;
    padding:4% 4% 3% 4%;
}
label{
    font-size : 20px;
}
</style>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 my-5">
        <?php
$id = $_GET['id'];
$sql = "SELECT * FROM `users` WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);
?>
        <span style="margin-left:30%;"><b style="font-size:20px;">Your Current Balance :</b> <?php echo $data['balance']; ?></span>
        <div class="card transfer-to my-3">
        <h3 align="center" style="color:blue;">Transfer Money</h3>
            <form action="transferAmountProcess.php" method="POST" class="database_operation">
                <div>
                    <label for="from">From :</label>
                    <input type="text" class="form-control" value="<?php echo $data['name']; ?>" name="from" disabled>
                    <input type="hidden" name="from_id" value="<?php echo $id; ?>">
                </div>
                <div>
                    <label for="to">To :</label>
                    <select class="form-select" name="to_id" aria-label="Default select example">
                        <?php
$sql1 = "SELECT * FROM `users` WHERE id != '$id'";
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1)) {
    while ($row = mysqli_fetch_assoc($result1)) {
        ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] . "  ( Balance : " . $row['balance'] . ")"; ?></option>
                        <?php
}
}
?>
                    </select>
                </div>
                <div>
                    <label for="from">Amount :</label>
                    <input type="number" class="form-control" name="amount" required placeholder="Enter Amount">
                </div>
                <button class="btn btn-primary my-4">Transfer</button>
            </form>
        </div>
        </div>
        <div class="col-md-3"></div>
    </div>








<?php
include "assets/footer.php";
?>
<script>
    $(document).ready(function(){
        $('.database_operation').submit(function(){
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.post(url,data,function(data,status){
                var data = JSON.parse(data);
                if(data.status){
                    alert(data.msg);
                    window.location.href="history.php";
                }else{
                    alert(data.msg);
                }
            });
            return false;
        });
    });
</script>
