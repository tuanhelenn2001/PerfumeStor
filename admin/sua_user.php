<?php

?>
<?php
//function KT_Trung_2($GiaTri,$ThuocTinh,$GiaTri2,$ThuocTinh2,$query)
//{
//    while($r=$query->fetch_assoc())
//    {
//        if($GiaTri==$r[$ThuocTinh])
//            if($GiaTri2==$r[$ThuocTinh2])
//                return true;
//            else
//                return false;
//    }
//    return true;
//}
include_once ('../connection/connect_database.php');
$sql="select * from Users ";
$query=mysqli_query($conn,$sql);
$sl="select * from Users where idUser=".$_GET['idUser'];
$kq=mysqli_query($conn,$sl);
$d=mysqli_fetch_array($kq);
$thongbao="";
if(isset($_POST['Sua'])) {
        if ($_POST['Username'] != "" &&$_POST['Password_old'] != "" && $_POST['Password'] != "" && $_POST['Password_1'] != "" && $_POST['DienThoai'] != "") {
            if (md5($_POST["Password_old"]) != $d['Password']) {
                $thongbao = $thongbao . "Mật khẩu không chính xác ";
            }
            $thongbao = "";
            while ($r = $query->fetch_assoc()) {
                if ($r['HoTen'] == $_POST['Username'])
                    if ($r['idUser'] != $d['idUser'])
                        $thongbao = $thongbao . 'Username đã tồn tại ';
                if ($r['Email'] == $_POST['Email'])
                    if ($r['idUser'] != $d['idUser'])
                        $thongbao = $thongbao . 'Email đã tồn tại ';
                if ($r['DienThoai'] == $_POST['DienThoai'])
                    if ($r['idUser'] != $d['idUser'])
                        $thongbao = $thongbao . 'Số điện thoại đã tồn tại ';
            }
            if (md5($_POST['Password']) != md5($_POST['Password_1'])) {
                $thongbao = $thongbao . "Mật khẩu không trùng khớp ";
            }
            if ($thongbao != "") {
                echo "<script language='javascript'>alert('$thongbao');</script>";
            } else {
                $sl1 = "update Users set HoTen='" . $_POST['Username'] . "',
                HoTenK='" . $_POST['HoTenK'] . "',
                Password='" .md5( $_POST['Password'] ). "',
                DiaChi='" . $_POST['DiaChi'] . "',
                DienThoai='" . $_POST['DienThoai'] . "',
                Email='" . $_POST['Email'] . "',
                NgayDangKy='" . $_POST['NgayDangKy'] . "'
                where idUser='" . $_GET['idUser'] . "'";
                $kq1 = mysqli_query($conn, $sl1);
                if ($kq1) {
                    echo "<script language='javascript'>alert('Sửa thành công');";
                    echo "location.href='../admin/index_user.php';</script>";
                }
            }
        }
        else
            echo "<script language='javascript'>alert('Vui lòng nhập đầy đủ thông tin!!!');</script>";
}
?>
<!DOCTYPE html>
<html>
<header>
    <?php include_once ("header1.php");?>
    <title>Sửa Users </title>
    <?php include_once('header2.php');?>
    <style>div.row {
            padding-top: 2%;
        }</style>
</header>
<body>
<?php include_once ('header3.php');?>
<!-- Nội dung ở đây -->
<h3 style="text-align: center">Thêm User</h3>
<form method="post" action="" name="ThemUser" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2"  style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Username:</strong></div>
        <div class="col-md-9" style="color: red;"><input style="border-radius: 5px; color: black;" type="text" name="Username" placeholder="ví dụ: abc" size="50" value="<?php echo $d['HoTen'];?>"/></div>
    </div>
    <div class="row">
        <div class="col-md-2"  style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Họ Tên Khách:</strong></div>
        <div class="col-md-9" style="color: red;"><input style="border-radius: 5px; color: black;" type="text" name="HoTenK" placeholder="ví dụ: abc" size="50" value="<?php echo $d['HoTenK'];?>"/></div>
    </div>
    <div class="row">
        <div class="col-md-2" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Password cũ:</strong></div>
        <div class="col-md-9" style="color: red;"><input style="border-radius: 5px; color: black;" type="password" name="Password_old" placeholder="Nhập password cũ" size="50"/>(*)</div>
    </div>
    <div class="row">
        <div class="col-md-2" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Password mới:</strong></div>
        <div class="col-md-9" style="color: red;"><input style="border-radius: 5px; color: black;" type="password" name="Password" placeholder="Nhập password mới" size="50"/>(*)</div>
    </div>
    <div class="row">
        <div class="col-md-2" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Nhập lại Password:</strong></div>
        <div class="col-md-9" style="color: red;"><input style="border-radius: 5px; color: black;" type="password" name="Password_1" placeholder="Nhập lại password mới" size="50"/>(*)</div>
    </div>
    <div class="row">
        <div class="col-md-2" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Địa chỉ:</strong></div>
        <div class="col-md-9" style="color: red;"><input style="border-radius: 5px; color: black;" type="text" name="DiaChi" placeholder="Ví dụ: TpHCM, Quảng Ngãi" size="50" value="<?php echo $d['DiaChi'];?>"/></div>
    </div>
    <div class="row">
        <div class="col-md-2" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Điện thoại: </strong></div>
        <div class="col-md-9" style="color: red;"><input style="border-radius: 5px; color: black;" type="tel" name="DienThoai" placeholder="ví dụ: 0965555555" maxlength="13"size="50" value="<?php echo $d['DienThoai'];?> "/></div>
    </div>
    <div class="row">
        <div class="col-md-2" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Email: </strong></div>
        <div class="col-md-9" style="color: red;"><input style="border-radius: 5px; color: black;" type="email" name="Email" placeholder="ví dụ: abc@gmail.com" size="50" value="<?php echo $d['Email'];?>" /></div>
    </div>
    <div class="row">
        <div class="col-md-2" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;"><strong>Ngày đăng ký: </strong></div>
        <div class="col-md-9"><input style="border-radius: 5px; color: black;" type="text" name="NgayDangKy" readonly="readonly" size="50" value="<?php echo $d["NgayDangKy"]?>"/></div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-9"><button id="Sua" name="Sua"  class="btn btn-success">Sửa</button>   <button class="btn btn-success"><a style="text-decoration: none; color: #FFFFFF;" href="../admin/index_user.php">Thoát</a></button> </div>
    </div>

</form>
<?php include_once ('footer.php');?>
</body>
</html>
