<?php if(!defined("642979")) exit();
/**
 * Created by tarks
 * User: JHRunning
 */

class TarksAccountAPIClass{


    function API_AuthTarksAccount(){
        $TARKS_ACCOUNT = new TarksAccountClass();
        $MEMBER_CLASS = new MemberClass();

        $id = REQUEST('id');
        $password = POST('password');

        $auth = $TARKS_ACCOUNT-> TarksAccountLogin($MEMBER_CLASS ,$id, $password);


        echo $auth;



    }


    function API_MakeTarksAccountAuth(){

        $TARKS_ACCOUNT = new TarksAccountClass();
        $id = REQUEST('id');
        $password = POST('password');

        $auth = $TARKS_ACCOUNT-> MakeTarksAccountAuthCode($id, $password);


        echo $auth;



    }



    function API_SignUpTarksAccount(){
        APICheckAct();
        $TARKS_ACCOUNT = new TarksAccountClass();
        $MEMBER_CLASS = new MemberClass();

        $email = REQUEST('email');
        $id = REQUEST('id');
        $password = POST('password');

        $tarks_signup = $TARKS_ACCOUNT -> SignUpTarksAccount($MEMBER_CLASS, $email, $id, $password);

        if($tarks_signup == "true"){
            echo "success";
        }else{

            if($tarks_signup != false){
                echo $tarks_signup;
            }else{
                echo "error";
            }


        }
    }





}