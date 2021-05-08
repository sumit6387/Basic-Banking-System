<?php
include "assets/header.php";
include "assets/conn.php";

?>
<style>
td{
    margin-left:10%;
    font-size : 20px;
}
</style>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <table class="table table-striped table-bordered my-5">
                <thead>
                    <tr style="background-color:#a29888;">
                        <th>Sr No.</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$sql = "SELECT * FROM `users`";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)) {
    $id = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
                    <tr style="background-color:#a29855;">
                        <td><?php echo $id; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['balance']; ?></td>
                        <td>
                            <a href="transfer.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Transfer</a>
                        </td>
                    </tr>
                    <?php
$id = $id + 1;
    }
}
?>
                </tbody>
            </table>
        </div>
        <div class="col-md-1"></div>
    </div>







<?php include "assets/footer.php";?>
