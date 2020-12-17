<?php
require_once "init.php";
use ProcessForward\ProcessManager;
$id = @$_COOKIE["id_process"];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pm = new ProcessManager();
    $process = $pm->get($id);
    $result = [
        "data" => group_table_result($process->getResult())
    ];
    $pm->release($result);
    exit;
}
function group_table_result($data){
    //var_dump($data);
    $results = [];
    foreach ($data as $key => $value) {
        $posts = $value["posts"];
        foreach ($posts as $_key => $_value) {
            $_value = $_value[0];
            array_push($results,[
                $_value["id"],
                $_value["time"],
                $_value["body"],
                $_value["body2"],
                $value["id"],
            ]);
        }
    }
    return $results;
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
    <style>
        .do00u71z.ni8dbmo4.stjgntxs.l9j0dhe7{
            padding-top: 0px !important
        }
        .l9j0dhe7{
            padding-top: 0px !important
        }
    </style>
  </head>
  <body>
    <div class="container">
        <h1>Facebook Group Scaner</h1>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Địa chỉ bài viết</th>
                    <th>Thời gian</th>
                    <th>Nội dung</th>
                    <th>Nội dung 2</th>
                    <th>Ngưởi đăng</th>
                    <th>Nhóm sở hữu</th>
                </tr>
            </thead>
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
            $.fn.dataTable.ext.errMode = 'none';
        });
        updateData();
        function updateData(){
            window.myinterval = setInterval(function(){ 
                var table = $('#example').DataTable();
                table.ajax.reload();
                var count = table.rows().count();
                console.log(count);
                if(count > 0)
                clearInterval(window.myinterval);
            },5000);
        }
    </script>
  </body>
</html>