<?php
require_once "init.php";
use ProcessForward\ProcessManager;
$id = @$_COOKIE["id_process"];
$accounts = isset($_COOKIE["accounts"]) ? $_COOKIE["accounts"] : "Tên tài khoản | Mật khẩu | Fa2 | Cookie" ;
$groups = isset($_COOKIE["groups"]) ? $_COOKIE["groups"] : "Địa chỉ" ;
$options = isset($_COOKIE["options"]) ? $_COOKIE["options"] : "fastMode=true\ncookie=true\nemail=quachvanhao@cmnd.vn" ;
$action = "instance";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Facebook Group Scaner</title>
  </head>
  <body>
    <div class="container">
        <h1>Facebook Group Scaner</h1>
        <form action="/xuly.php" method="post">
            <div class="form-group">
                <label for="">Tài khoản</label>
                <textarea name="accounts" class="form-control" rows="3"><?php echo $accounts ?></textarea>
            </div>
            <div class="form-group">
                <label for="">Danh sách nhóm</label>
                <textarea name="groups" class="form-control" rows="3"><?php echo $groups ?></textarea>
            </div>
            <div class="form-group">
                <label for="">Cấu hình</label>
                <textarea name="options" class="form-control" rows="3"><?php echo $options ?></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="process_forward_aware" value="process_forward_aware" >
            </div>
            <?php if(!$id){ ?>
            <div class="form-group">
                <input type="hidden" class="form-control" name="action" value="instance" >
            </div>
            <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
            <?php }else{?>
            <div class="form-group">
                <input type="hidden" class="form-control" name="action" value="kill" >
            </div>
            <button type="submit" class="btn btn-danger">Hủy yêu cầu</button>
            <a class="btn btn-success" href="ketqua.php" role="button">Nhận kết quả</a>
            <?php }; ?>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>
