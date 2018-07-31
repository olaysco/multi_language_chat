<?php

/* 
 * Copyright (C) 2018 olayiwola
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


class Processor
{
    private $db;
    private static $USERTRACK = '../usertracker.track';
    
    function __construct() {
        $this->db = new Database();
    }
    
    function updateOnlineStatus($id, $status){
        $sql = "UPDATE `multilingualchat`.`users` SET `online` = ".$status." WHERE `users`.`id` =".$id;
        $res =  $this->db->fastQuery($sql);
        touch(self::$USERTRACK);
        return $res;
    }
    
    function fetchOnlineUsers($id){
        $val = $this->db->multipleColumn("SELECT * FROM `users` WHERE `online` = ? AND `id` NOT LIKE ?", array(1,$id));
        foreach ($val as $user){
            $this->generateUsers($user['id'], $user['username'], $user['language']);
        }
        
    }
    
    function getLastOnlineTime(){
       $stat = stat(self::$USERTRACK);
       return $stat['atime'];
    }
    
    function generateUsers($id, $username, $lang){
        echo '<div class="chat_box_user_online" style="" >
                            <img class="img-thumbnail pull-right user_online" style=""/>
                            <span class="fa fa-user fa-3x user_icon" style=""></span>
                            <span class="user_name">'.$username.'</span>
                            <form><input type="hidden" value="'.$id.'" name="id"/>
                            <input type="hidden" value="'.$username.'" name="lang"/>
                            <input type="hidden" value="'.$lang.'" name="username"/>
                            </form>
                        </div>';
    }

}
