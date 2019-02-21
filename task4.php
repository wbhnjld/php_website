<?php
/**
 * Created by PhpStorm.
 * User: riritaba
 * Date: 2018/11/27
 * Time: 8:19 PM
 */

$password1 = '12345';
$password2 = '12345';
echo md5($password1);
echo '<br>';
echo md5(md5($password2));

