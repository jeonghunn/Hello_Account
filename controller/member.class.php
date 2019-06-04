<?php
/**
 *
 * User: JHRunning
 * Date: 2/10/15
 * Time: 2:32 PM
 */

class MemberClass{


    function getPageAuth($category, $value){

//return "authcode";
        return  FindAuthCode($this -> getPageSrl($category, $value), "user_srl");
    }

    function getPageSrl($category, $value)
    {

        $member_info = mysqli_fetch_array(DBQuery("SELECT * FROM  `member` WHERE  `category` LIKE '$category' AND `value` LIKE '$value'  AND `status` <= 0  AND ( `expired` = 0 OR `expired` < " . getTimeStamp() . ")"));

        return $member_info['page_srl'];

    }

    function CreateMemberInfo($page_srl, $category, $value, $expired){
        return DBQuery("INSERT INTO `member` (`category`, `page_srl`, `value`, `date`, `expired`, `status`) VALUES ('$category', '$page_srl', '$value' , '".getTimeStamp()."', '$expired', '0');");
    }


    function setStatusByPage($page_srl, $status)
    {

    }

    function setStatusByPageAct($page_srl, $status)
    {

        return Model_Account_Member_setStatusByPage($page_srl, $status);
    }


}


?>
