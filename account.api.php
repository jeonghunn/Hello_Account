<?php
/**
 *
 * User: JHRunning
 * Date: 2/10/15
 * Time: 2:32 PM
 */


//ㄴTarks
//if($ACTION == "tarks_auth") $TarksAccountAPI -> API_AuthTarksAccount();
//if($ACTION == "make_tarks_authcode") $TarksAccountAPI -> API_MakeTarksAccountAuth();
//if($ACTION == "tarks_sign_up") $TarksAccountAPI -> API_SignUpTarksAccount();
//ㄴfacebook
//if($ACTION == "account_sign_up_with_facebook") $API -> API_MemberSignupWithFacebook();
//if($ACTION == "member_auth_facebook") $API -> API_MemberAuthByFacebook();
//ㄴAccount
if($ACTION == "account_auth") $AccountAPI -> API_AuthAccount();
if($ACTION == "account_sign_up") $AccountAPI -> API_SignUpAccount();
if($ACTION == "account_update_password") $AccountAPI -> API_UpdateAccountPassword($user_srl);
if ($ACTION == "account_withdrawal") $AccountAPI->API_WithdrawalAccount($user_srl);
if ($ACTION == "account_withdrawal_act") $AccountAPI->API_WithdrawalAccountWithOutPassword($user_srl);
if ($ACTION == "account_logout") $AccountAPI->API_AccountLogout($user_srl);