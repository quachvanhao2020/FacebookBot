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
    "error_report=True",
    "debug_report=False",
    "email_receiver=quachvanhao@cmnd.vn",
    "comment=.",
    "share_link=none",
];
$action = "instance";
$process = null;
$post_body = "";
if($id){
    try {
        $process = $pm->get($id);
        $parameter = $process->getParameter();
        $accounts = $parameter["accounts"];
        $groups = $parameter["groups"];
        $actions_link = $parameter["actions_link"];
        $actions_post = $parameter["actions_post"];
        $options = $parameter["options"];
        $post_body = $parameter["post_body"];
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
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
                <option value="write_post" <?php echo isset($actions_link["write_post"]) ? "selected" : "" ?>>Viết bài</option>
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
                <label for="">Nội dung bài viết (Nếu có)</label>
                <textarea spellcheck="false" name="post_body" class="form-control" rows="3"><?php echo $post_body ?></textarea>
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
                <input type="hidden" class="form-control" name="action" value="update" >
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a class="btn btn-danger" href="huy.php" role="button">Hủy yêu cầu</a>
            <a class="btn btn-success" href="ketqua.php" role="button">Nhận kết quả</a>
            <?php }; ?>
        </form>
        <?php require_once "footer.php"; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
