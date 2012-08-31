<?php
require_once "Zend/Db.php";

class Users extends Zend_Db_Table
{
    protected $_name = 'users';
    protected $_primary = 'id';
}
?>
