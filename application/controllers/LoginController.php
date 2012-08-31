<?php
require_once "BaseController.php";
require_once APPLICATION_PATH . "/models/Users.php";

class LoginController extends BaseController
{
    public function loginAction()
    {
        $userModel = new Users();
        $db = $userModel->getAdapter();
        $id = $this->getRequest()->getParam("id","");
        $pwd = $this->getRequest()->getParam("pwd","");

        $where = $db->quoteInto("name=?",$id);
        $where .= $db->quoteInto("AND pwd=?",md5($pwd));

        $res = $userModel->fetchAll($where)->toArray();

        if (count($res) == 1)
        {
            session_start();
            $_SESSION['loginuser'] = $res[0];
            $this->_forward("gohallui","hall");
        }
        else
        {
            $this->view->info = "用户名或密码错误";
            $this->view->gourl = "/";
            $this->_forward("error","global");
        }

    }

    public function logoutAction()
    {
    
    }
}

