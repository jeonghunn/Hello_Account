<?php
/**
 * Created by Tarks.
 * User: JHRunning
 */

class FacebookApiClass{


    function API_MemberAuthByFacebook()
    {
        $MEMBER_CLASS = new MemberClass();
        $FACEBOOK_CLASS = new FacebookClass();

        $auth = POST('facebook_auth');
        echo $FACEBOOK_CLASS->AccountAuth($MEMBER_CLASS, $auth);


    }


    //Facebook
    function API_MemberSignupWithFacebook()
    {
        $MEMBER_CLASS = new MemberClass();
        $FACEBOOK_CLASS = new FacebookClass();
        $PAGE_CLASS = new PageClass();
        $ACCOUNT_CLASS = new AccountClass();


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
        $facebook_auth = POST('facebook_auth');

        $signup = $ACCOUNT_CLASS->SignUpAccount($PAGE_CLASS, $MEMBER_CLASS, '', $email, $password, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country);

        if (!strpos($signup, 'error')) {

            $FACEBOOK_CLASS->CreateFacebookMember($MEMBER_CLASS, $signup['page_srl'], $facebook_auth);
            print_array($signup);
        } else {

            if ($signup != false) {
                echo $signup;
            } else {
                echo "error";
            }




        }


    }

}