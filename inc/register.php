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



include_once 'init.php';
var_dump($_POST);
if(isset($_POST['register'])){
    if((trim($_POST['user_name']) != "") &&(trim($_POST['pass']) != "") &&(trim($_POST['lang']) != "")    ){
    $db = new Database();
    $username = trim($_POST['user_name']);
    
    $val = $db->multipleColumn("SELECT * FROM `users` WHERE `username`  LIKE ? ", array($username));
    //var_dump($val);
    if(empty($val)){
        $rc = $db->insert('INSERT INTO users (`username`, `password` , `language`) VALUES (?,?,?)',array( trim($_POST['user_name']), trim($_POST['pass']), trim($_POST['lang']) ));
        if($rc > 0){
            header('location:../index.php?msg=reg_success');
        }
    }else{
        header('location:../index.php?msg=reg_fail');
    }
    }else{
        header('location:../index.php?msg=reg_fail');
    }
}
else{
    header('location:../index.php?msg=reg_fail');
}
?>