<?php
//ini_set("session.use_cookies", 0);
require_once "../dir.php";
require_once BASE_DIR . "/vendor/autoload.php";
require_once BASE_DIR."/core/Config.php";
require_once BASE_DIR."/core/Environment.php";
require_once BASE_DIR."/routes/web.php";
Config::init('include');
$app =new App();