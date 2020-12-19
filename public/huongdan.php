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
        <div class="form-group">
                <label for="">Danh sách nhóm</label>
                <textarea spellcheck="false" name="groups" class="form-control" rows="29" disabled>
                -Lấy dữ liệu từ group chỉ cần 1 tài khoản là đủ:
                -Vui lòng đợi kết quả trả về:
                -Cấu hình:
                    -total_scrolls giá trị này càng lớn kết quả trả về càng nhiều
                    -frequency tần suất hoạt động tùy thuộc cấu hình máy chủ
                    -usecookie dùng cookie để tương tác với facebook
                    -email_receiver là email nhận thông báo bài viết mởi nhất(*)
                    -comment nội dung cho chức năng bình luận bài viết
                    -fastmode chế độ nhanh mặt định True
                    -error_report nhận thông báo lỗi(*)
                    -debug_report nhận thông báo tiến trình(*)
                -Ký hiệu:
                    * Tính năng đang update
                </textarea>
            </div>
        <?php require_once "footer.php"; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>