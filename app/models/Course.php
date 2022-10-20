<?php

class Course
{
 private $db;

 public function __construct()
 {
     $this->db = Mysqldb::getInstance()->getDatabase();
 }

 public function getCourses()
 {

 }

}