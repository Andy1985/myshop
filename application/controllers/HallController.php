<?php
require_once "BaseController.php";
require_once APPLICATION_PATH . "/models/Book.php";

class HallController extends BaseController
{
    public function gohalluiAction()
    {
        $bookModel = new Book();
        $res = $bookModel->fetchAll()->toArray();
        $this->view->books = $res;
        session_start();
        $this->view->username = $_SESSION["loginuser"]["name"];
        $this->render("hall","hall");
    }
}

