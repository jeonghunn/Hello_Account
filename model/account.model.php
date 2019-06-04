<?php


function Model_Account_AccountByPage($page_srl ){
    return DBQuery("SELECT * FROM  `accounts` WHERE  `page_srl` = '$page_srl'  AND  `status` < 5");


}

function Model_Account_UpdatePassword($page_srl, $new_password_hash){
    return DBQuery("UPDATE `accounts` SET `password` = '$new_password_hash'   WHERE `page_srl` = '$page_srl' AND `status` < 5");
}



function Model_Account_CheckAccountByPage($page_srl, $password_hash){
    return mysqli_fetch_array(DBQuery("SELECT * FROM  `accounts` WHERE  `page_srl` = '$page_srl'  AND `password` = '$password_hash'  AND  `status` < 5"));


}



function Model_Account_setStatus($srl, $status)
{
    return DBQuery("UPDATE `accounts` SET `status` = '$status'   WHERE `srl` = '$srl' AND `status` < 5");
}


function Model_Account_setStatusByPage($page_srl, $status)
{
    return DBQuery("UPDATE `accounts` SET `status` = '$status'   WHERE `page_srl` = '$page_srl' AND `status` < 5");
}

