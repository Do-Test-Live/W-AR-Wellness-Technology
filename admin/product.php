<?php
session_start();
include('../include/dbController.php');
$db_handle = new DBController();

if (isset($_POST['submit'])) {
    $product_price = $_POST['product_price'];
    $product_id = $_POST['product_id'];

    $update = $db_handle->insertQuery("update products set product_price='$product_price' where id='$product_id'");

    ?>
    <script>
        alert('Product price Updated');
        window.location = 'product.php';
    </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product - AR Wellness</title>

    <?php require_once 'include/css.php'; ?>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <?php require_once 'include/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php require_once 'include/topbar.php'; ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Product Data</h1>


                <?php
                if (isset($_GET['id'])) {
                    ?>
                    <!-- Edit Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Product Data</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <?php
                                $data = $db_handle->runQuery("SELECT * FROM products where id={$_GET['id']}");
                                ?>
                                <div class="mb-3">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" placeholder=""
                                           value="<?php echo $data[0]['product_name']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Product Price</label>
                                    <input type="text" class="form-control" name="product_price" placeholder=""
                                           value="<?php echo $data[0]['product_price']; ?>" required>
                                    <input type="hidden" name="product_id" value="<?php echo $data[0]['id']; ?>"
                                           required>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Product Data</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    $data = $db_handle->runQuery("SELECT * FROM products order by id asc");
                                    $row_count = $db_handle->numRows("SELECT * FROM products order by id asc");
                                    for ($i = 0; $i < $row_count; $i++) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td><?php echo $data[$i]["product_name"]; ?></td>
                                            <td>HKD <?php echo $data[$i]["product_price"]; ?></td>
                                            <td><a href="product.php?id=<?php echo $data[$i]["id"]; ?>"
                                                   class="btn btn-info">Edit</a></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <?php require_once 'include/footer.php'; ?>

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'include/js.php'; ?>

</body>

</html>
