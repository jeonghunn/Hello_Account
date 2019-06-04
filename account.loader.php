<?php
/**
 *
 * User: JHRunning
 * Date: 2/10/15
 * Time: 2:32 PM
 */



//load model
require_once 'modules/account/model/account.model.php';
require_once 'modules/account/model/member.model.php';


//load class
require_once 'modules/account/controller/account.class.php';
require_once 'modules/account/controller/member.class.php';
require_once 'modules/account/controller/tarks_account.class.php';


//load api class
require_once 'modules/account/api/account.api.class.php';
//require_once 'api/tarks_account.api.class.php';


//load apis
$AccountAPI = new AccoutApiClass();

