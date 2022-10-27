<?php
include_once(__DIR__ . './../classes/product.php');
$pro = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['id'] == '') {
        if ($pro->store($_POST, $_FILES['file'])) {
            echo '
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Title!</strong> Thêm sản phẩm thành công
            </div>';
        } else {
            echo '
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Title!</strong> Thêm sản phẩm thất bại
            </div>';
        }
    } else {
        if ($pro->update($_POST, $_FILES['file'])) {
            echo '
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Title!</strong> Sửa sản phẩm thành công
            </div>';
        } else {
            echo '
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Title!</strong> Sửa sản phẩm thất bại
            </div>';
        }
    }
}
$detail = "";
if (isset($_GET['id'])) {
    $detail = $pro->get_product_by_id($_GET['id']);
    $detail = mysqli_fetch_assoc($detail);
}
?>
<section class="content-header">
    <h1>
        Thêm sản phẩm
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#"><i class="fa fa-dashboard"></i> Sản phẩm</a>
        </li>
        <li class="active">Thêm sản phẩm</li>
    </ol>
</section>
<form action="" method="post" class="" style=" padding:50px" enctype="multipart/form-data">
    <div class="form-group">
        <label class="sr-only" for="inputName">Hidden input label</label>
        <input type="text" class="form-control sr-only" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?>" id="inputName">
    </div>
    <div class="form-group">
        <label for="">Tên sản phẩm</label>
        <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" value="<?php echo $detail != "" ? $detail['TenSanPham'] : "" ?>" placeholder="">
        <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <div class="form-group">
        <label for="">Giá sản phẩm</label>
        <input type="text" class="form-control" name="price" id="" aria-describedby="helpId" placeholder="" value="<?= $detail != ""  ? $detail['GiaSanPham'] : "" ?>">
        <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <div class="form-group">
        <label for="">Hình ảnh sản phẩm</label>
        <input type="file" class="form-control-file" name="file" id="" placeholder="" aria-describedby="fileHelpId">
        <small id="fileHelpId" class="form-text text-muted">Help text</small>
    </div>
    <div class="form-group">
        <label for="">Mô tả sản phẩm</label>
        <textarea class="form-control" name="desc" id="" rows="3" value=""><?= $detail != ""  ? $detail['MoTaSanPham'] : "" ?></textarea>
    </div>

    <div class="form-group">
        <label for="">Loại sản phẩm</label>
        <select class="form-control" name="brand" id="">
            <?php
            require('./classes/category.php');
            $cate = new Category();
            $categories  = $cate->getALl();
            if ($categories) {
                while ($row = mysqli_fetch_array($categories)) {
                    if ($detail != "" && $row['MaLoai'] == $detail['LoaiSanPham']) {
                        echo '<option value="' . $row['MaLoai'] . '" selected>' . $row['TenLoai'] . '</option>';
                    }
                    echo '<option value="' . $row['MaLoai'] . '">' . $row['TenLoai'] . '</option>';
                }
            }
            ?>
        </select>
    </div>



    <button type="submit" class="btn btn-primary">
        <?= $detail ? "Lưu" : "Thêm Sản Phẩm" ?>
    </button>

</form>