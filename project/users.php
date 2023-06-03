<?php

include('header.php');
checkUser();
adminArea();
$label = "Add";
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $label = "Edit";
}
if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id']) && $_GET['id'] > 0) {
    $id = get_safe_value($_GET['id']);

    mysqli_query($con, "delete from users where id=$id");
    mysqli_query($con, "delete from expense where added_by=$id");
}
$res = mysqli_query($con, "select * from users  where role='User' order by id desc ");
if (isset($_SESSION['UID']) && $_SESSION['UID'] != '') {
} else {
    redirect('index.php');
}
?>
<!-- <h2>Users</h2>
<a href="manage_users.php">Add Users</a>
<br/> -->

<?php
if (mysqli_num_rows($res) > 0) {

?>

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-9">
                            
                        <h2>Users</h2>
                        <a href="manage_users.php">Add Users</a>
                        <br><br>

                        <div class="table-responsive table--no-card m-b-30">

                            <table class="table table-borderless table-striped table-earning">
                                <thead>

                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th></th>
                                    </tr>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>

                                        <tr>

                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['username'] ?></td>
                                            <td>

                                                <a href="manage_users.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;
                                                <a href="javascript:void(0)" onclick="delete_confir('<?php echo $row['id']; ?>','users.php')">Delete</a>
                                            </td>
                                        </tr>

                                    <?php

                                    } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <div class="main-content">
                            <div class="section__content section__content--p30">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <br><br>
                                            <h2>Users</h2>
                                            <a href="manage_users.php">Add Users</a>
                                            <br><br>
                    
                    <?php    echo "Data Not found"; ?>
                   <?php     } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('footer.php');
    ?>