<?php
require_once "Zend/Db.php";

class Mycart extends Zend_Db_Table
{
    protected $_name = 'mycart';
    protected $_primary = 'id';

    private $totalPrice = 0;
    //添加
    public function addProduct($userId,$productID,$nums = 1)
    {
        //UPDATE
        $now = time();

        $where = "userid = $userId and bookid=$productID";
        $res = $this->fetchAll($where)->toArray();
        if (count($res) > 0)
        {
            $set = array(
                     "nums"=>($res[0]["nums"] + 1),
                     "cartDate"=>$now
                    );

            if ($this->update($set,$where) > 0)
                 return true;
            else
                 return false;
        }

        //INSERT
        $data = array(
                "userid"=>$userId,
                "bookid"=>$productID,
                "nums"=>$nums,
                "cartDate"=>$now
                );    

        if ($this->insert($data) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //删除
    public function delProduct($userId,$id)
    {
        if ($this->delete("userid=$userId and bookid=$id") > 0)
            return true;
        else
            return false;
    }
    //修改
    public function updateProduct($userId,$id,$nums)
    {
        $set = array(
           "nums"=>$nums 
                ); 

        $where = "userid = $userId AND bookid = $id";

        if ($this->update($set,$where) > 0)
             return true;
        else
             return false;
    }

    //计算总价

    //显示购物车
    public function showMyCart($userId)
    {
        $db = $this->getAdapter();

        $sql = "select b.id,b.name,b.author,b.price,b.publishHouse,m.nums from ";
        $sql .= "book b, mycart m where b.id = m.bookid and ";
        $sql .= $db->quoteInto("m.userid = ?",$userId);

        $res = $db->query($sql)->fetchAll();

        for ($i = 0; $i < count($res); $i++)
        {
            $this->totalPrice += $res[$i]['price'] * $res[$i]['nums'];
        }

        return $res;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
}
?>
