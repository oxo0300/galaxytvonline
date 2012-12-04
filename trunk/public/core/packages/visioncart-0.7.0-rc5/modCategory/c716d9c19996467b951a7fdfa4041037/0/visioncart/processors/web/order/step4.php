<?php

$vc =& $modx->visioncart;
$options = array_merge($options, $scriptProperties);
$order = $vc->getBasket();
$action = $modx->makeUrl($modx->resource->get('id'), '', 'step=4');
$previousStep = $modx->makeUrl($modx->resource->get('id'), '', 'step=3');
$content = '';
$shop = $vc->shop;

// Check for authentication and a full basket ;-)
if (!$modx->user->isAuthenticated()) {
	$modx->sendUnauthorizedPage();	
	exit();
} elseif ($order->get('basket') == '' || !is_array($order->get('basket')) || sizeof($order->get('basket')) == 0 || $order->get('status') > 2) {
	$modx->sendRedirect($modx->makeUrl($modx->resource->get('id'), '', 'step=1'));
	exit();
}

// Check for minimum order amount
if ($vc->getShopSetting('enableMinimumOrderAmount') == 1) {
	if ($order->get('totalorderamountin') <= $vc->getShopSetting('minimumOrderAmount')) {
		$modx->sendRedirect($modx->makeUrl($modx->resource->get('id'), '', 'step=1'));
		exit();
	} 
}

// Protection for skipping steps
if (!isset($_SESSION['vc-order-step']) || $_SESSION['vc-order-step'] < 4) {
	$modx->sendRedirect($modx->makeUrl($modx->resource->get('id'), '', 'step=3'));
	exit();
}

$vc->fireEvent('vcEventOrderStep4', '', array(
	'order' => $order
));

// Get theme configuration
$scriptProperties['config'] = $modx->getOption('config', $scriptProperties, 'default');
$config = $vc->getConfigFile($order->get('shopid'), 'orderStep4', null, array('config' => $scriptProperties['config']));
$config = array_merge($config, $scriptProperties);

$chunkArray = array(
	'vcOrderStep4' => '', 
	'vcPaymentRow' => '', 
	'vcPaymentWrapper' => ''
); 

foreach($chunkArray as $key => $value) {
	if (isset($config[$key])) {
		$chunkArray[$key] = $config[$key];	
	} else {
		$chunkArray[$key] = $key;	
	}
}

// Fetch all payment modules
$paymentModules = $modx->getCollection('vcModule', array(
	'type' => 'payment',
	'active' => 1
));

// Get highest tax
$highestTax = $vc->getOrderHighestTax($order);

// Fetch shop payment modules
$activeModules = $vc->getShopSetting('paymentModules', $order->get('shopid'));

$paymentModuleArray = array();

foreach($paymentModules as $paymentModule) {
	$moduleFound = false;
	foreach($activeModules as $module) {
		if ($module['id'] == $paymentModule->get('id') && $module['active'] == 1) {
			$moduleFound = true;
		}	
	}
	
	if (!$moduleFound) {
		continue;	
	}
	
	$moduleConfig = $paymentModule->get('config');
	
	// Check if order is too expensive
	if (isset($moduleConfig['paymentMaximimumAmount']) && $moduleConfig['paymentMaximimumAmount'] != 0) {
		if ($order->get('totalorderamountin') > $moduleConfig['paymentMaximimumAmount']) {
			continue;	
		}
	}
	
	// Include the controller to give it a chance to do some stuff as well
	if ($paymentModule->get('controller') != '') {
		$controller = $vc->config['corePath'].'modules/payment/'.$paymentModule->get('controller');
		if (is_file($controller)) {	
			$vcAction = 'getParams';
			
			$returnValue = include($controller);	
			
			if (!is_array($returnValue)) {
				$returnValue = array();	
			}
			
			if (isset($returnValue['enabled']) && $returnValue['enabled'] == false) {
				continue;
			}
			
			if (isset($module)) {
				unset($module);	
			}
		}
	}
	
	$paymentModuleArray[] = $paymentModule->get('id');
	$paymentModule = $paymentModule->toArray();
	
	if (is_array($returnValue)) {
		$paymentModule = array_merge($paymentModule, $returnValue);
	}

	$paymentModule['selected'] = '';
	if ($order->get('paymentid') == $paymentModule['id'] && $order->get('paymentid') != '') {
		$paymentModule['selected'] = '1';	
	} 
	
	// Get the shipping row
	$content .= $vc->parseChunk($chunkArray['vcPaymentRow'], $paymentModule, array('isChunk' => true));

	unset($returnValue, $module);
}

// Check if a payment method is chosen, and if so redirect to the next page
if (isset($_REQUEST['vc_payment_method'])) {
	$paymentMethod = (int) $_REQUEST['vc_payment_method'];

	// Check if the module exists
	if ($paymentMethod != 0 && in_array($paymentMethod, $paymentModuleArray)) {
		// Update order step
		if ($_SESSION['vc-order-step'] <= 4) {
			$_SESSION['vc-order-step'] = 5;
		}

		// Update the order and continue
		$order->set('paymentid', $paymentMethod);
		$order->save();
		
		$vc->calculateOrderPrice($order);
		$vc->fireEvent('vcEventChoosePayment', '', array(
			'order' => $order
		));
		
		$modx->sendRedirect($modx->makeUrl($modx->resource->get('id'), '', 'step=5'));
		exit();
	}
}

$content = $vc->parseChunk($chunkArray['vcPaymentWrapper'], array(
	'action' => $action,
	'previousStep' => $previousStep,
	'content' => $content
), array('isChunk' => true));

return $vc->parseChunk($chunkArray['vcOrderStep4'], array(
	'action' => $action,
	'previousStep' => $previousStep,
	'content' => $content
), array('isChunk' => true)); 