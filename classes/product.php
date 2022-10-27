<?php

include_once 'database.php';
?>



<?php
class product
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function store($data, $file)
    {
        $name = $data['name'];
        $price = $data['price'];
        $image = $file['name'];
        $desc = $data['desc'];
        $brand = $data['brand'];
        $sql = "insert into tbl_sanpham(TenSanPham,GiaSanPham,HinhAnhSanPham,MoTaSanPham,LoaiSanPham) values ('$name','$price','$image','$desc','$brand');";
        $insert = $this->db->insert($sql);
        if ($insert && move_uploaded_file($file['tmp_name'], 'uploads/' . $image)) {
            return true;
        } else {
            return false;
        }
    }
    public function getAll()
    {
        $sql = "SELECT * FROM `tbl_sanpham`,tbl_loaisanpham WHERE LoaiSanPham=MaLoai ";
        $result = $this->db->select($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    public function get_product_by_id($id)
    {
        $sql = "SELECT * FROM tbl_sanpham where MaSanPham =" . $id;
        // echo($sql);
        return $this->db->select($sql) ? $this->db->select($sql) : false;
    }
    public function update($data, $file)
    {
        var_dump($file);
        if ($file['name'] != "") {
            $id = $data['id'];
            $name = $data['name'];
            $price = $data['price'];
            $image = $file['name'];
            $desc = $data['desc'];
            $brand = $data['brand'];
            $sql = "update tbl_sanpham set TenSanPham='$name',GiaSanPham='$price',HinhAnhSanPham='$image',MoTaSanPham='$desc',LoaiSanPham='$brand' WHERE MaSanPham='$id'";
            $insert = $this->db->update($sql);
            if ($insert && move_uploaded_file($file['tmp_name'], 'uploads/' . $image)) {
                return true;
            } else {
                return false;
            }
        } else {
            $id = $data['id'];
            $name = $data['name'];
            $price = $data['price'];
            $desc = $data['desc'];
            $brand = $data['brand'];
            $sql = "update tbl_sanpham set TenSanPham='$name',GiaSanPham='$price',MoTaSanPham='$desc',LoaiSanPham='$brand'  WHERE MaSanPham='$id'";
            $insert = $this->db->update($sql);
            if ($insert) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function delete($id)
    {
        $sql = "update tbl_sanpham set TrangThaiSanPham = 0 WHERE MaSanPham = " . $id;
        $update = $this->db->update($sql);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }
}


?>