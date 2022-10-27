<?php
include_once '../classes/product.php';
$pro = new Product();
if ($_POST['id'] != "") {
    if ($pro->delete($_POST['id'])) {
        echo "Ẩn sản phẩm thành công";
    } else {
        echo "Ẩn sản phẩm thất bại";
    }
}
