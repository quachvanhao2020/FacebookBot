<?php
require_once "init.php";
use ProcessForward\ProcessManager;
$id = @$_COOKIE["id_process"];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pm = new ProcessManager();
    if($id){
        $process = $pm->get($id);
        $result = [
            "data" => group_table_result($process->getResult())
        ];
        $pm->release($result);
    }
    exit;
}

function tofloat($num) {
    $dotPos = strrpos($num, '.');
    $commaPos = strrpos($num, ',');
    $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
        ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
  
    if (!$sep) {
        return floatval(preg_replace("/[^0-9]/", "", $num));
    }

    return floatval(
        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
        preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
    );
}

function un_humman_number($string){
    $ar = [
        "K" => 1000,
        "M" => 1000000,
    ];
    foreach ($ar as $key => $value) {
        if(strpos($string,$key)){
            $string = str_replace($key,"",$string);
            $float = tofloat($string);
            return $float*$value;
        }
    }
    return 0;
}

function to_int_count($data){
    if(is_int($data)) return $data;
    $result = 0;
    if(is_string($data)){
        $p = strpos($data," ");
        $data = substr($data,0,$p);
        $result = un_humman_number($data);
    }
    return $result;
}

function group_table_result($data){
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
                $_value["owner"],
                to_int_count($_value["like_count"]),
                to_int_count($_value["comment_count"]),
                to_int_count($_value["share_count"]),
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
    <base href="https://www.facebook.com/">
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
        img{
            max-height: 100px !important
        }
        td:before {
            content: '';
            display: block; 
            width: 5em;
        }
        circle{
            display: block;
        }
        .mlqo0dh0.georvekb.s6kb5r3f{
            display: none !important;
        }
        .mytable tbody td:nth-child(0),
        .mytable tbody td:nth-child(1) {
            width: 5% !important;
            max-width: 5% !important;
        }
        .j83agx80.cbu4d94t.ew0dbk1b.irj2b8pg{
            width: 300px !important;
        }
        strong{
            font-size: small !important;
        }
        .odd{
            background-color: #0000000a !important;
        }
        .even{
            background-color: #fff !important;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <h1>Facebook Group Scaner</h1>
        <div class="row">
            <form id="myform" style="display: none;" action="<?= BASE_HOST ?>/xuly.php" method="post">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="process_forward_aware" value="process_forward_aware" >
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="action" value="reset" >
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="redirect" value="<?= BASE_HOST ?>/ketqua.php" >
                </div>
                <button type="submit" class="btn btn-danger">Làm mới</button>
            </form>
        </div>
        <hr>
        <div class="row">
            <table class="mytable" id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Địa chỉ bài viết</th>
                        <th>Thời gian</th>
                        <th style="width: 100px;">Nội dung</th>
                        <th>Nội dung 2</th>
                        <th>Ngưởi đăng</th>
                        <th>Số lượng thích</th>
                        <th>Số lượng bình luận</th>
                        <th>Số lượng chia sẻ</th>
                        <th>Nhóm sở hữu</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                processing: true,
                //serverSide: true,
                ajax: {
                    url:"<?= BASE_HOST ?>/ketqua.php",
                    type: "POST"
                },
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.22/i18n/Vietnamese.json'
                },
                columns: [
                    { 
                        searchable: false
                    },
                    { 
                        searchable: true
                    },
                    { 
                        searchable: false
                    },
                    { 
                        searchable: false
                    },
                    { 
                        searchable: true
                    },
                    { 
                        searchable: false
                    },
                    { 
                        searchable: false
                    },
                    { 
                        searchable: false
                    },
                    { 
                        searchable: true
                    },
                ],
            });
            $.fn.dataTable.ext.errMode = 'none';
        });
        updateData();
        function updateData(){
            window.myinterval = setInterval(function(){ 
                var table = $('#example').DataTable();
                table.ajax.reload();
                var count = table.rows().count();
                if(count > 0){
                    clearInterval(window.myinterval);
                    $('#myform').show();
                }
                
            },5000);
        }
    </script>
  </body>
</html>