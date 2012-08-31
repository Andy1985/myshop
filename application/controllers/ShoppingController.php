<?php
require_once "BaseController.php";
require_once APPLICATION_PATH . "/models/Mycart.php";

class ShoppingController extends BaseController
{
    public function addproductAction()
    {
        $bookId = $this->getRequest()->getParam("bookid");
        $mycartModel = new Mycart();
        session_start();

        if ($mycartModel->addProduct($_SESSION["loginuser"]["id"],$bookId))
        {
            $this->view->info = "添加商品成功";
            $this->view->gourl = "/hall/gohallui";
            $this->_forward("ok","global");
        }
        else
        {
            $this->view->info = "添加商品失败";
            $this->view->gourl = "/hall/gohallui";
            $this->_forward("error","global");
        }
    }

    public function showcartAction()
    {
        $mycartModel = new Mycart();
        session_start();
        $this->view->books = $mycartModel->showMyCart($_SESSION['loginuser']['id']);
        $this->view->totalPrice = $mycartModel->getTotalPrice();

        $this->render("mycart");
    }

    public function delproductAction()
    {
        $id = $this->getRequest()->getParam('id');
        $mycartModel = new Mycart();
        
        session_start();
        if ($mycartModel->delProduct($_SESSION['loginuser']['id'],$id))
        {
            $this->view->info = "商品从购物车中删除成功";
            $this->view->gourl = "/shopping/showcart";
            $this->_forward("ok","global");
        }
        else
        {
            $this->view->info = "商品从购物车中删除失败";
            $this->_forward("err","global");
            $this->view->gourl = "/shopping/showcart";
        }
    }

    public function updatecartAction()
    {
        $bookids = $this->getRequest()->getParam('id');
        $booknums = $this->getRequest()->getParam('nums');

        $mycartModel = new Mycart();
        session_start();
        $userId = $_SESSION['loginuser']['id'];
        for ($i = 0; $i < count($bookids); ++$i)
        {
            $mycartModel->updateProduct($userId,$bookids[$i],$booknums[$i]);
        }

        $this->view->info = "更新成功";
        $this->view->gourl = "/shopping/showcart";
        $this->_forward("ok","global");
    }
}
