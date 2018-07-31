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

include_once 'config.php';
class Database{
	private $connection ;
	//private $result;
	private $rowCount;
	public $singleField;
        
	public function __construct(){
		try{
		$this->connection = new PDO('mysql:host='.DBHOST.';port='.DBPORT.';dbname='.DBNAME,DBUSER,DBPASS);
		}
		catch(PDOException $e){
			echo "Connection error".$e->getMessage();
		}
	}
	
	private function query($sql,$array){
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
            try{
            $result = $this->connection->prepare($sql);
                if(!$result){
                    var_dump($this->connection->errorInfo());
                }
                
                if(!$result->execute(array_values($array)))
                {
                    //echo 'failed';
                }
		
                
		$this->setRowCount($result->rowCount());
                
            }
            catch (Exception $e){
                echo $e->getMessage();
            }
            catch(PDOException $e){
                echo $e->getMessage();
                echo 'fold';
            }
		return $result;
		
	}
	
        public function fastQuery($statement){
            $result = $this->connection->query($statement);
            return $result;
        
        }
        
	public function singleColumn($sql,$array){
            $result = $this->query($sql,$array);
           
            if($this->getRowCount() > 0){
                $this->singleField = $result->fetchAll();
                return $this->getRowCount();
            }
            else{
                return false;
            }
	}
	
	public function multipleColumn($sql,$array){
           $result = $this->query($sql, $array) ;
           return $result->fetchAll();
	}
	
        public function insert($sql,$array){
             $result = $this->query($sql, $array);
             return $this->getRowCount();
        }
        
	public function getRowCount(){
		return $this->rowCount;
	}
	
	public function setRowCount($count){
		$this->rowCount = $count;
	}
	
	public function __destruct(){
		$this->connection = null;
	}
        
        public function studentsInClass($class_id){
        $sql = 'SELECT `reg_no` FROM `students` WHERE `class_id` = ?';
        return $this->multipleColumn($sql, [$class_id]);
        }
    
    
}


?>