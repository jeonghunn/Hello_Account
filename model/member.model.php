<?php


function Model_Account_Member_setStatus($srl, $status)
{
    return DBQuery("UPDATE `accounts` SET `status` = '$status'   WHERE `srl` = '$srl' AND `status` < 5");
}


function Model_Account_Member_setStatusByPage($page_srl, $status)
{
    return DBQuery("UPDATE `member` SET `status` = '$status'   WHERE `page_srl` = '$page_srl' AND `status` < 5");
}

