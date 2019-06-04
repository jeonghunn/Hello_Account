<?php
/**
 * Created by Tarks.
 * User: JHRunning
 */

class AccoutApiClass{


    function API_AuthAccount()
    {
        $MEMBER_CLASS = new MemberClass();
        $ACCOUNT_CLASS = new AccountClass();

        $email = REQUEST('email');
        $password = POST('password');
        //$reg) = POST('password');

        $auth = $ACCOUNT_CLASS->AccountLogin($MEMBER_CLASS, $email, $password);

        echo $auth;
if($auth == false) ErrorPrint("login_error", "Wrong ID or Password. Please try again");

    }

//Sign up Account
    function API_SignUpAccount()
    {
        APICheckAct();
        $PAGE_CLASS = new PageClass();
        $ACCOUNT_CLASS = new AccountClass();
        $MEMBER_CLASS = new MemberClass();

        $email = REQUEST('email');
        $password = POST('password');
        $name_1 = REQUEST('name_1');
        $name_2 = REQUEST('name_2');
        $gender = REQUEST('gender');
        $birthday = REQUEST('birthday');
        $country_code = REQUEST('country_code');
        $phone_number = REQUEST('phone_number');
        $profile_pic = REQUEST('profile_pic');
        $reg_id = REQUEST('reg_id');
        $lang = REQUEST('lang');
        $country = REQUEST('country');

        $signup = $ACCOUNT_CLASS->SignUpAccount($PAGE_CLASS, $MEMBER_CLASS, '', $email, $password, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country);

        if (!strpos($signup, 'error')) {
            print_array($signup);
        } else {

            if ($signup != false) {
                echo ErrorMessage($signup);
            } else {
                ErrorMessage("unknown_error");
            }


        }


    }



    function API_UpdateAccountPassword($user_srl)
    {

        $ACCOUNT_CLASS = new AccountClass();

        $password = POST('password');
        $new_password = POST('new_password');
        //$reg) = POST('password');

        $UpdatePassword = $ACCOUNT_CLASS->UpdatePassword($user_srl, $password, $new_password);

        if($UpdatePassword == true){
            
           SuccessMessage("update_account_password_success");
        }else{
            echo ErrorMessage("update_account_password_error");
        }

    }


    function API_WithdrawalAccount($user_srl)
    {
        $ACCOUNT_CLASS = new AccountClass();
        $PAGE_CLASS = new PageClass();
        $MEMBER_CLASS = new MemberClass();

        $password = POST('password');
        //$reg) = POST('password');

        $WithdrawalAccount = $ACCOUNT_CLASS->WithdrawalAccount($PAGE_CLASS, $MEMBER_CLASS, $user_srl, $password);

        if ($WithdrawalAccount == true) {

            SuccessMessage("withdrawal_account_success");
        } else {
            echo ErrorMessage("withdrawal_account_error");
        }
    }

    function API_WithdrawalAccountWithOutPassword($user_srl)
    {
        $ACCOUNT_CLASS = new AccountClass();
        $PAGE_CLASS = new PageClass();
        $MEMBER_CLASS = new MemberClass();

        //$reg) = POST('password');

        $WithdrawalAccount = $ACCOUNT_CLASS->WithdrawalAccountWithOutPassword($PAGE_CLASS, $MEMBER_CLASS, $user_srl);

        if ($WithdrawalAccount == true) {

            SuccessMessage("withdrawal_account_success");
        } else {
            echo ErrorMessage("withdrawal_account_error");
        }
    }

    function API_AccountLogout($user_srl)
    {

        $ACCOUNT_CLASS = new AccountClass();
        $PAGE_CLASS = new PageClass();

        $result = $ACCOUNT_CLASS->LogoutAccount($PAGE_CLASS, $user_srl);

        if ($result == true) {

            SuccessMessage("logout_account_success");
        } else {
            echo ErrorMessage("logout_account_error");
        }

    }

}