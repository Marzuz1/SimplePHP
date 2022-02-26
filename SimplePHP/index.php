<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
<title>index</title>

</script>
</head>
<body>
    <?php
    require "BUS/SanPhamBUS.php";
    ?>

<div class="container">
    <form method="POST">
    <?php
            if (isset($_POST["create"])) {
                $MaSP = $_POST["MaSP"];
                $TenSP = $_POST["TenSP"];
                $ThongTin = $_POST["ThongTin"];
                $GiaTien = $_POST["GiaTien"];
                $SoLuongTonKho = $_POST["SoLuongTonKho"];
                $AnhMinhHoa = "SP001.jpg";
                $MaLoaiSP = $_POST["MaLoaiSP"];


                SanPhamBUS::ThemSP($MaSP, $TenSP, $ThongTin, $GiaTien, $SoLuongTonKho, $MaLoaiSP, $AnhMinhHoa);
            }
            ?>
                           
        <?php if(isset($_POST["themsp"])){?>
            <form method="post">
                             <table class="text-right">
                                <tr>
                                    <td>Mã SP:</td>
                                    <td>
                                        <input class="form-control" type="text" name="MaSP" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tên SP:</td>
                                    <td><input  class="form-control" type="text" name="TenSP" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tác giả:</td>
                                    <td><input  class="form-control" type="text" name="ThongTin"></td>
                                </tr>
                                <tr>
                                    <td>Giá tiền:</td>
                                    <td><input class="form-control" type="text" name="GiaTien"
                                            pattern="\d+" title="Chỉ được nhập chữ số"></td>
                                </tr>
                                <tr>
                                    <td>Số lượng tồn kho:</td>
                                    <td><input  class="form-control" type="text"
                                            name="SoLuongTonKho">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Loại SP:</td>
                                    <td>
                                        <select  class="custom-select" name="MaLoaiSP">
                                            <?php
                                            $dsLoaiSP = SanPhamBUS::LayDSLoaiSP();
                                            if ($dsLoaiSP) {
                                                while ($loaiSP = $dsLoaiSP->fetch_assoc()) {
                                                    echo "<option value='" . $loaiSP["MaLoaiSP"] . "'>" . $loaiSP["TenLoaiSP"] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <button class="btn btn-primary " type="submit" name="create">Xác Nhận</button>
                            </form>
         <?php }?>
      <?php if(isset($_POST["edit"])){ 
          
          $ds = SanPhamBUS::LayTTSP($_POST["edit"]);
          ?>
          <form action="" method="post">
    Mã SP: <input type="text" value="<?php $ds["MaSP"]; ?>">
     <br>
    Tên SP: <input type="text" value="<?php $ds["TenSP"]; ?>">
     <br>
    Tác Giả: <input type="text" value="<?php $ds["ThongTin"] ?>">
     <br>
    Giá Tiền: <input type="text" value="<?php $ds["GiaTien"] ?>">
     <br>
    Số Lượng Tồn Kho: <input type="text" value="<?php $ds["SoLuongTonKho"]?>">
     <button type="submit" value="sua">Xác nhận</button>

     </form>
<?php } ?>
<?php
            if (isset($_POST["sua"])) {
                $MaSP = $_POST["update"];
                $TenSP = $_POST["tenSP"];
                $ThongTin = $_POST["thongTin"];
                $GiaTien = $_POST["giaTien"];
                $soLuongTonKho = $_POST["soLuongTonKho"];
                $anhMinhHoa = "";
                $MaLoaiSP = $_POST["maLoaiSP"];

                SanPhamBUS::SuaSP($maSP, $tenSP, $thongTin, $giaTien, $soLuongTonKho, $maLoaiSP, $anhMinhHoa);
            }
            ?>
    <button class="btn btn-primary mb-2" type="submit" name="themsp"><i class="fa fa-plus" aria-hidden="true"></i> Thêm SP</button>
    <?php 
    $sp = SanPhamBUS::LayDSSP();
    if($sp){
    ?> 
<table class="table table-light table-hover text-center">
        <thead class="thead-dark">
        <tr>
            <th>Ảnh Minh Họa</th>
            <th>Mã SP</th>
            <th>Tên SP</th>
            <th>Thông Tin</th>
            <th>Giá Tiền</th>
            <th>Số Lượng Tồn Kho</th>
            <th>Tên Loại SP</th>
            <th>Trạng thái</th>
            <th>Thao Tác</th>
        </tr>
    </thead>
    <tbody>
     <?php while ($ds =$sp->fetch_assoc()) {
     ?>
        <tr>
            <td class="align-middle"><img src="img\product\<?php echo $ds["AnhMinhHoa"];?>" style="height: 100px;" ></td>
            <td class="align-middle"><?php echo $ds["MaSP"];?></td>
            <td class="align-middle"><?php echo $ds["TenSP"];?></td>
            <td class="align-middle"><?php echo $ds["ThongTin"];?></td>
            <td class="align-middle"><?php echo number_format($ds["GiaTien"]);?> VND</td>
            <td class="align-middle"><?php echo $ds["SoLuongTonKho"];?></td>
            <td class="align-middle"><?php echo $ds["TenLoaiSP"];?></td>
            <td class="align-middle">
            <div class="custom-control custom-checkbox">
             <input class="custom-control-input" type="checkbox"
                    <?php if ($ds["TrangThai"] == 1) echo "checked"; ?>>
                 <label for="my-input" class="custom-control-label"></label>
            </div>
            </td>
            <td class="align-middle">
             <button class="btn btn-primary" type="submit" name="edit" value="<?php echo $ds["MaSP"]; ?>">Sửa</button>
             <button class="btn btn-danger" type="submit" name="delete" value="<?php echo $ds["MaSP"]; ?>">Xóa</button>
            </td>
        </tr>
    </tbody>
     <?php }?>
</table>
    <?php } ?>
    </form>
</div>
</body>
</html>