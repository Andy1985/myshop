<?php
require_once "Zend/Db.php";

class Book extends Zend_Db_Table
{
    protected $_name = 'book';
    protected $_primary = 'id';
}
?>
