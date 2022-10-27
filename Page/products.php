<?php
include_once './classes/product.php';
$product = new Product();
$products = $product->getAll();

?>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Loại sản phẩm</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($products) {
                while ($row = mysqli_fetch_array($products)) {
                    $trangthai = $row['TrangThaiSanPham']  == 1 ? "Hiện" : "ẨN";
                    if ($trangthai == "ẨN") {
                        echo '
                            <tr class="bg-danger">
                                <td>' . $row['MaSanPham'] . '</td>
                                <td>' . $row['TenSanPham'] . '</td>
                                <td>
                                    <img src="uploads/' . $row['HinhAnhSanPham'] . '" width="50px"/>
                                </td>
                                <td>' . $row['GiaSanPham'] . '</td>
                                <td>' .  $trangthai . '</td>
                                <td>' . $row['TenLoai'] . '</td>
                                <td>
                                    <a href="?page=add_product&id=' . $row['MaSanPham'] . '" type="button" class="btn btn-default">Sửa</a>
                                    <button type="button" class="btn btn-danger" onClick="deleteProduct(' . $row['MaSanPham'] . ');">Xóa</button>
                                </td>
                            </tr>
                        ';
                    } else {
                        echo '
                            <tr class="">
                                <td>' . $row['MaSanPham'] . '</td>
                                <td>' . $row['TenSanPham'] . '</td>
                                <td>
                                    <img src="uploads/' . $row['HinhAnhSanPham'] . '" width="50px"/>
                                </td>
                                <td>' . $row['GiaSanPham'] . '</td>
                                <td>' .  $trangthai . '</td>
                                <td>' . $row['TenLoai'] . '</td>
                                <td>
                                    <a href="?page=add_product&id=' . $row['MaSanPham'] . '" type="button" class="btn btn-default">Sửa</a>
                                    <button type="button" class="btn btn-danger" onClick="deleteProduct(' . $row['MaSanPham'] . ');">Xóa</button>
                                </td>
                            </tr>
                        ';
                    }
                }
            }
            ?>

        </tbody>
    </table>
</div>