<?php
require_once "init.php";
use ProcessForward\ProcessManager;
$pm = new ProcessManager();
$id = @$_COOKIE["id_process"];
$accounts = [
    [
        "username" => "porshakeehne83@hotmail.com",
        "password" => "Np94d7mFe8hBRjxQ",
        "fa2" => "32AHABHV5MASBDNVT67SEZAHP6ZNI4VO",
    ]
];
$groups = [
    "https://www.facebook.com/groups/196060010920325",
    "https://www.facebook.com/groups/j2team.community",
] ;
$actions_link = [
    "scrap_data" => true
];
$actions_post = [
    "like" => true
];
$options = [
    "frequency=5",
    "total_scrolls=10",
    "fastmode=True",
    "usecookie=True",
    "email_receiver=quachvanhao@cmnd.vn",
    "comment=.",
    "share_link=none",
];
$action = "instance";
$process = null;
if($id){
    try {
        $process = $pm->get($id);
        $parameter = $process->getParameter();
        $accounts = $parameter["accounts"];
        $groups = $parameter["groups"];
        $actions_link = $parameter["actions_link"];
        $actions_post = $parameter["actions_post"];
        $options = $parameter["options"];
    } catch (\Throwable $ex) {
        setcookie("id_process", "", time()-3600);
    }
}
$accounts_textarea = [];
foreach ($accounts as $key => $value) {
    array_push($accounts_textarea,implode("|",$value));
}
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
                <textarea spellcheck="false" name="accounts" class="form-control" rows="3"><?php echo implode("\n",$accounts_textarea) ?></textarea>
            </div>
            <div class="form-group">
                <label for="">Danh sách nhóm</label>
                <textarea spellcheck="false" name="groups" class="form-control" rows="3"><?php echo implode("\n",$groups) ?></textarea>
            </div>
            <div class="form-group">
                <label for="">Hành động nhóm</label>
                <select name="actions_link[]" multiple class="form-control" id="">
                <option value="scrap_data" <?php echo isset($actions_link["scrap_data"]) ? "selected" : "" ?>>Lấy dữ liệu</option>
                <option value="send_mail" <?php echo isset($actions_link["send_mail"]) ? "selected" : "" ?>>Gửi mail</option>
                <option value="clear" <?php echo isset($actions_link["clear"]) ? "selected" : "" ?>>Mặc định(Không)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Hành động bài viết</label>
                <select name="actions_post[]" multiple class="form-control" id="">
                <option value="like" <?php echo isset($actions_post["like"]) ? "selected" : "" ?>>Thích</option>
                <option value="share" <?php echo isset($actions_post["share"]) ? "selected" : "" ?>>Chia sẻ</option>
                <option value="comment" <?php echo isset($actions_post["comment"]) ? "selected" : "" ?>>Bình luận</option>
                <option value="clear" <?php echo isset($actions_link["clear"]) ? "selected" : "" ?>>Mặc định(Không)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Cấu hình</label>
                <textarea spellcheck="false" name="options" class="form-control" rows="3"><?php echo implode("\n",$options) ?></textarea>
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
        <footer class="page-footer font-small blue pt-4">
            <div class="container-fluid text-center text-md-left">
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <h5 class="text-uppercase">Facebook Group Scaner</h5>
                    <p>Mark ơi là Mark!</p>
                </div>
                <div class="col-md-3 mb-md-0 mb-3">
                    <h5 class="text-uppercase">Liên kết</h5>
                    <ul class="list-unstyled">
                        <li>
                        <a href="huongdan.php">Hướng dẫn</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 mb-md-0 mb-3">
                    <h5 class="text-uppercase">.</h5>
                    <ul class="list-unstyled">
                        <li>
                        <a href="#!"></a>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
            <div class="footer-copyright text-center py-3">© 2020 Copyright:
                <a href="#">quachvanhao@cmnd.vn</a>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>
