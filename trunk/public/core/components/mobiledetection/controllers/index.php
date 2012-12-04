<?php

/**
 * Controller index.php for the MobileDetection package
 * @author Zuriel Andrusyshyn
 * 2/4/11
 *
 * @package mobiledetection

 */

/* This file is not used in the package. It's an example of a possible controller */

require_once dirname(dirname(__FILE__)).'/model/mobiledetection/mobiledetection.class.php';
$mobiledetection = new MobileDetection($modx, $scriptProperties);
return $mobiledetection->init('mgr');
