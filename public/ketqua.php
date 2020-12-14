<?php
require_once "init.php";
use ProcessForward\ProcessManager;
$id = @$_COOKIE["id_process"];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pm = new ProcessManager();
    $process = $pm->get($id);
    $result = [
        "data" => $process->getResult()
    ];
    $pm->release($result);
    exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Facebook Group Scaner</title>
  </head>
  <body>
    <div class="container">
        <h1>Facebook Group Scaner</h1>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Địa chỉ bài viết</th>
                    <th>Nội dung</th>
                    <th>Ngưởi đăng</th>
                    <th>Nhóm sở hữu</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Địa chỉ bài viết</th>
                    <th>Nội dung</th>
                    <th>Ngưởi đăng</th>
                    <th>Nhóm sở hữu</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url":"ketqua.php",
                    "type": "POST"
                }
            });
        });
        updateData();
        function updateData(){
            setInterval(function(){ 
                $('#example').DataTable().ajax.reload();
            },2000);
        }
    </script>
  </body>
</html>