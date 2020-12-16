<?php

$str = "[\'Tên tài khoản | Mật khẩu | Fa2 | Cookie\']";

var_dump(json_decode($str,true,JSON_THROW_ON_ERROR));