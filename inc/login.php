<?php

/* 
 * Copyright (C) 2018 Olayiwola Odunsi
 *
 * Github: @olaysco
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once("init.php");
session_start();
session_name('id');
session_name('username');
session_name('language');

if(isset($_POST['login'])){
$db = new Database();

$user_filter = filter_input(INPUT_POST, 'l_username', FILTER_SANITIZE_STRING);
$pass_filter = filter_input(INPUT_POST, 'l_password', FILTER_SANITIZE_STRING);

$user = ($user_filter != FALSE && $user_filter!= NULL)?$user_filter:'';

$pass = ($pass_filter != FALSE && $pass_filter!= NULL)?$pass_filter:'';

if($user != '' && $pass != ''){

$val = $db->singleColumn("SELECT * FROM `users` WHERE `username` LIKE ? AND `password` LIKE ?", array($user,$pass));


var_dump($db->singleField);

if($db->singleField != null){
    $_SESSION['id'] = $db->singleField[0]['id'];
    $_SESSION['username'] = $db->singleField[0]['username'];
    $_SESSION['language'] = $db->singleField[0]['language'];
   header('location:../home.php');
}
else{
    header('location:../index.php?msg=invalid_details');
    echo 'failed';
}
}

}
else {
    //session_destroy();
    //header('location:../index.php');
   echo 'invalid';
}
?>