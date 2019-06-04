<?php
/**
 * User: JHRunning
 * Date: 1/8/15
 * Time: 10:59 AM
 */


class AccountClass{

function AccountLogin($MEMBER_CLASS, $email, $password){
    $password = $this -> HashPassword($password);
    $loginResult = $this -> CheckAccount($email, $password);

    if($loginResult){
        return  $MEMBER_CLASS-> getPageAuth("account", $email);
    }


   return false;
}

    function HashPassword($password){
        return hash('sha256',$password);
    }

    function CheckAccount($email, $password){
   //     if(!rtnSpecialCharCheck($password)) return false;
        if($email == null || $password == null) return false;
        $row = mysqli_fetch_array(DBQuery("SELECT * FROM  `accounts` WHERE  `email_address` LIKE '$email' AND  `password` LIKE '$password' AND status < 5"));
       // $row['email_address'] = "jeonghunn@naver.com";
        if($email == $row['email_address']) {
            return true;
        }else{
            security_passwordWrong();

        }
        return false;
    }

    function UpdatePassword($user_srl, $password, $new_password){
        $loginResult = $this -> CheckAccountByPage($user_srl, $password);

        if($loginResult){
            return  $this -> UpdatePasswordAct($user_srl, $new_password);
        }


        return false;
    }

    function CheckAccountByPage($page_srl, $password){

        if($page_srl == null || $password == null) return false;
        $row = Model_Account_CheckAccountByPage($page_srl, $this -> HashPassword($password) );
        if($page_srl == $row['page_srl']) {
            return true;
        }else{
            security_passwordWrong();

        }
        return false;
    }

    function UpdatePasswordAct($page_srl, $new_password){
        if(!$this->CheckVaildPassword($new_password)) return false;
        return Model_Account_UpdatePassword($page_srl, $this -> HashPassword($new_password));
    }

    function CheckVaildPassword($password){
        return strlen($password) >= 6 && strlen($password) <= 20;
    }

    function WithdrawalAccount($PAGE_CLASS, $MEMBER_CLASS, $user_srl, $password)
    {
        $loginResult = $this->CheckAccountByPage($user_srl, $password);

        if ($loginResult) {
            return $this->WithDrawalAccountAct($PAGE_CLASS, $MEMBER_CLASS, $user_srl);
        }


        return false;
    }

    function WithDrawalAccountAct($PAGE_CLASS, $MEMBER_CLASS, $user_srl)
    {

        //$result


        //Change Account Status
        $AccountResult = Model_Account_setStatusByPage($user_srl, 5);

        //Delete Member
        $MemberResult = $MEMBER_CLASS->setStatusByPageAct($user_srl, 5);

        //Clean Page Information
        $PAGE_CLASS->CleanPageInformation($user_srl);

        //Delete Page
        $PageResult = $PAGE_CLASS->setStatusAct($user_srl, 5);


        return ($AccountResult && $MemberResult && $PageResult);
    }

    function WithdrawalAccountWithOutPassword($PAGE_CLASS, $MEMBER_CLASS, $user_srl)
    {

        return $this->WithDrawalAccountAct($PAGE_CLASS, $MEMBER_CLASS, $user_srl);


    }

    function SignUpAccount($PAGE_CLASS ,$MEMBER_CLASS, $category,  $email, $password, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country){

        //Check This is vaild
        if($email == null || $password == null) return false;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return email_invaild_error;
        if(!$this->CheckVaildPassword($password)) return password_length_error;
        if($name_2 == "") return name_invaild_error;
        $password = hash('sha256',$password);
        $email_array = explode("@",$email);
        $email_check = mysqli_fetch_array(DBQuery("SELECT * FROM  `accounts` WHERE  `email_address` LIKE '$email'"));
        if($email_check['email_address'] == $email) return email_exist_error;

        //Create User Page
         $page_info = $PAGE_CLASS -> AddUser($category, 0, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country);
        //Create Account
      //  $last_number = $this ->  AccountLastNumber();CreateMemberInfo
       $signup = DBQuery("INSERT INTO `accounts` (  `page_srl`,  `email_address`, `password`, `email_id`, `email_host`, `status`, `date`, `ip_addr`, `last_login` ) VALUES (  '$page_info[page_srl]', '$email', '$password' ,  '$email_array[0]', '$email_array[1]', '0',  '".getTimeStamp()."', '".getIPAddr()."' ,'".getTimeStamp()."');");
        //Create Member Info
        $MEMBER_CLASS -> CreateMemberInfo($page_info['page_srl'], 'account', $email, 0);
        return $page_info;
    }

    //Find lastest number.
    function AccountLastNumber(){
        $account_table_status =mysqli_fetch_array(DBQuery("SHOW TABLE STATUS LIKE 'accounts'"));
        return $account_table_status['Auto_increment'];
    }

    //Deprecated
//    function getAccountInfo($tarks_account, $value) {
//        $xesql ="SELECT $value FROM  `xe_member` WHERE  `user_id` LIKE '$tarks_account'";
//        $xeresult = DBQuery($xesql);
//        $xerow=mysqli_fetch_array($xeresult);
//        return $xerow[$value];
//    }



    function getAccountByPage($page_srl) {
        Model_Account_AccountByPage($page_srl);
        
    }


    function LogoutAccount($PAGE_CLASS, $user_srl)
    {


        return $PAGE_CLASS->setRegIDAct($user_srl, "");
        //    return $PAGE_CLASS-> Log;
    }


}


?>