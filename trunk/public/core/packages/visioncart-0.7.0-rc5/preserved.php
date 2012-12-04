<?php return array (
  '94db43cb59f970cbc8c9dd20c13fb368' => 
  array (
    'criteria' => 
    array (
      'name' => 'vcEmailOuter',
    ),
    'object' => 
    array (
      'id' => 71,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'vcEmailOuter',
      'description' => '',
      'editor_type' => 0,
      'category' => 35,
      'cache_type' => 0,
      'snippet' => '<img src="[[++site_url]]/assets/components/visioncart/web/themes/default/images/emailheader.jpg" /><hr />
[[+innerChunk]]
<hr />
<a href="http://www.visioncart.net">[[+shop.name]]</a>',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => '',
      'content' => '<img src="[[++site_url]]/assets/components/visioncart/web/themes/default/images/emailheader.jpg" /><hr />
[[+innerChunk]]
<hr />
<a href="http://www.visioncart.net">[[+shop.name]]</a>',
    ),
  ),
  'ea85b24064c1fb3f7056a43618b8eb3b' => 
  array (
    'criteria' => 
    array (
      'name' => 'vcGetProducts',
    ),
    'object' => 
    array (
      'id' => 53,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'vcGetProducts',
      'description' => '',
      'editor_type' => 0,
      'category' => 37,
      'cache_type' => 0,
      'snippet' => '/**
 * @package visioncart
 */

$vc =& $modx->visioncart;

$output = array(
    \'master\' => \'\'
);

$scriptProperties[\'config\'] = $modx->getOption(\'config\', $scriptProperties, \'default\');
$config = $vc->getConfigFile($vc->shop->get(\'id\'), \'getProducts\', null, array(\'config\' => $scriptProperties[\'config\']));

$scriptProperties = array_merge($config, $scriptProperties);

// Settings
$scriptProperties[\'parents\'] = $modx->getOption(\'parents\', $scriptProperties, 0);
$scriptProperties[\'limit\'] = $modx->getOption(\'limit\', $scriptProperties, 0);
$scriptProperties[\'offset\'] = $modx->getOption(\'offset\', $scriptProperties, 0);
$scriptProperties[\'hideInactive\'] = $modx->getOption(\'hideInactive\', $scriptProperties, 0);
$scriptProperties[\'includeContent\'] = $modx->getOption(\'includeContent\', $scriptProperties, 0);
$scriptProperties[\'hideSKU\'] = $modx->getOption(\'hideSKU\', $scriptProperties, true);
$scriptProperties[\'exclude\'] = $modx->getOption(\'exclude\', $scriptProperties, \'\');
$scriptProperties[\'scheme\'] = $modx->getOption(\'scheme\', $scriptProperties, -1);

// Sorting settings
$scriptProperties[\'sort\'] = $modx->getOption(\'sort\', $scriptProperties, \'ASC\');
$scriptProperties[\'sortBy\'] = $modx->getOption(\'sortBy\', $scriptProperties, \'name\');
$scriptProperties[\'sortable\'] = $modx->getOption(\'sortable\', $scriptProperties, \'name,price\');

// Sorting settings for extra fields
$scriptProperties[\'extraFieldSort\'] = $modx->getOption(\'extraFieldSort\', $scriptProperties, \'ASC\');
$scriptProperties[\'extraFieldSortBy\'] = $modx->getOption(\'extraFieldSortBy\', $scriptProperties, \'\');

// Templating
$scriptProperties[\'tpl\'] = $modx->getOption(\'tpl\', $scriptProperties, \'\');
$scriptProperties[\'tplOdd\'] = $modx->getOption(\'tplOdd\', $scriptProperties, $scriptProperties[\'tpl\']);
$scriptProperties[\'tplFirst\'] = $modx->getOption(\'tplFirst\', $scriptProperties, $scriptProperties[\'tpl\']);
$scriptProperties[\'tplLast\'] = $modx->getOption(\'tplLast\', $scriptProperties, $scriptProperties[\'tpl\']);

if (!isset($scriptProperties[\'tpl\'])  || $scriptProperties[\'tpl\'] == \'\') {
    return \'\';
}

// Querystring based search
$router = $vc->router[\'query\'];
unset($router[\'q\']);

$scriptProperties[\'sort\'] = $modx->getOption(\'sort\', $router, \'asc\');

if (isset($router[\'index\']) && in_array($router[\'index\'], explode(\',\', $scriptProperties[\'sortable\']))) {
    $scriptProperties[\'sortBy\'] = $modx->getOption(\'index\', $router, \'asc\');    
}

$internal = array(
    \'limit\' => 0,
    \'offset\' => 0
);

if ($scriptProperties[\'parents\'] == false) {
    return \'\';
}

foreach($scriptProperties as $parameter => $property) {
    if (substr($parameter, 0, 3) == \'tpl\' && !in_array($parameter, array(\'tpl\', \'tplOdd\', \'tplFirst\', \'tplLast\'))) {
        if (!is_numeric(substr($parameter, 3))) {
            continue;
        }
        
        $scriptProperties[\'tplNth\'][] = array(
            \'nth\' => (int) substr($parameter, 3),
            \'tpl\' => $property
        );
        
        unset($scriptProperties[$parameter]); // Clean up on isle 5!
    }
}

if ($scriptProperties[\'parents\'] == 0) {
    return \'\';
}

$scriptProperties[\'parents\'] = explode(\',\',  $scriptProperties[\'parents\']);
$scriptProperties[\'exclude\'] = explode(\',\',  $scriptProperties[\'exclude\']);

$products = array();
foreach($scriptProperties[\'parents\'] as $parent) {
    // Fetch the parent (for shop ID)
    if (!isset($modx->visioncart) || !isset($modx->visioncart->shop)) {
        $category = $modx->getObject(\'vcCategory\', (int) $parent);
        $shopId = $category->get(\'shopid\');
    } else {
        $shopId = $modx->visioncart->shop->get(\'id\');
    }

    $stack = $vc->getProducts($parent, array(
        \'hideSKU\' => $scriptProperties[\'hideSKU\'],
        \'shopId\' => $shopId
    ));

    if ($stack[\'total\'] != 0 && !empty($stack[\'data\'])) {
        foreach($stack[\'data\'] as $product) {
            if (in_array($product->get(\'id\'), $scriptProperties[\'exclude\'])) {
            	continue;	
            }
            
            $product->set(\'url\', $vc->makeUrl(array(
                \'productCategory\' => $product->get(\'linkId\'),
                \'shopId\' => $product->get(\'shopid\'),
                \'scheme\' => $scriptProperties[\'scheme\']
            )));
            
            $priceData = $vc->calculateProductPrice($product, true);
            $product->set(\'display\', array(\'price\' => $priceData));

            $products[] = $product->toArray();    
        }
    }
    
    unset($stack);
}

if ($scriptProperties[\'extraFieldSortBy\'] != \'\') {
    $products = array_values($vc->multiNaturalSort($products, \'customfields.\'.$scriptProperties[\'extraFieldSortBy\'], strtolower($scriptProperties[\'extraFieldSort\'])));
} else {
    $products = array_values($vc->multiNaturalSort($products, $scriptProperties[\'sortBy\'], strtolower($scriptProperties[\'sort\'])));
}

for($inc = 0; $inc < count($products); $inc++) {
    if ($scriptProperties[\'offset\'] != 0 && $internal[\'offset\'] <= $scriptProperties[\'offset\']) {
        $internal[\'offset\']++;
        continue;
    }
    
    if ($scriptProperties[\'limit\'] != 0 && $internal[\'limit\'] >= $scriptProperties[\'limit\']) {
        break;
    }
    
    $internal[\'limit\']++;
    
    if ($inc == 0) {
        $output[\'master\'] .= $vc->parseChunk($scriptProperties[\'tplFirst\'], array_merge($products[$inc], array(
            \'count\' => $inc
        )));
        continue;
    } else if ($inc == count($products)) {
        $output[\'master\'] .= $vc->parseChunk($scriptProperties[\'tplLast\'], array_merge($products[$inc], array(
            \'count\' => $inc
        )));
        continue;
    }
    
    // Raffle through a set of nth templates, if they\'ve been set
    if (isset($scriptProperties[\'tplNth\']) && !empty($scriptProperties[\'tplNth\'])) {
        $break = false;
        
        foreach($scriptProperties[\'tplNth\'] as $tpl) {
            if ($tpl[\'nth\'] == $inc) {
                $output[\'master\'] .= $vc->parseChunk($tpl[\'tpl\'], array_merge($products[$inc], array(
                    \'count\' => $inc
                )));
                $break = true;
                break;
            }
        }
    }
    
    // Break the loop since a nth tpl has been found
    if (isset($break) && $break == true) {
        continue;
    }
    
    if ($inc % 2) {
        $output[\'master\'] .= $vc->parseChunk($scriptProperties[\'tplOdd\'], array_merge($products[$inc], array(
            \'count\' => $inc
        )));
        continue;
    }
    
    $output[\'master\'] .= $vc->parseChunk($scriptProperties[\'tpl\'], array_merge($products[$inc], array(
        \'count\' => $inc
    )));
}

unset($scriptProperties, $products, $product, $interal);
return $output[\'master\'];',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * @package visioncart
 */

$vc =& $modx->visioncart;

$output = array(
    \'master\' => \'\'
);

$scriptProperties[\'config\'] = $modx->getOption(\'config\', $scriptProperties, \'default\');
$config = $vc->getConfigFile($vc->shop->get(\'id\'), \'getProducts\', null, array(\'config\' => $scriptProperties[\'config\']));

$scriptProperties = array_merge($config, $scriptProperties);

// Settings
$scriptProperties[\'parents\'] = $modx->getOption(\'parents\', $scriptProperties, 0);
$scriptProperties[\'limit\'] = $modx->getOption(\'limit\', $scriptProperties, 0);
$scriptProperties[\'offset\'] = $modx->getOption(\'offset\', $scriptProperties, 0);
$scriptProperties[\'hideInactive\'] = $modx->getOption(\'hideInactive\', $scriptProperties, 0);
$scriptProperties[\'includeContent\'] = $modx->getOption(\'includeContent\', $scriptProperties, 0);
$scriptProperties[\'hideSKU\'] = $modx->getOption(\'hideSKU\', $scriptProperties, true);
$scriptProperties[\'exclude\'] = $modx->getOption(\'exclude\', $scriptProperties, \'\');
$scriptProperties[\'scheme\'] = $modx->getOption(\'scheme\', $scriptProperties, -1);

// Sorting settings
$scriptProperties[\'sort\'] = $modx->getOption(\'sort\', $scriptProperties, \'ASC\');
$scriptProperties[\'sortBy\'] = $modx->getOption(\'sortBy\', $scriptProperties, \'name\');
$scriptProperties[\'sortable\'] = $modx->getOption(\'sortable\', $scriptProperties, \'name,price\');

// Sorting settings for extra fields
$scriptProperties[\'extraFieldSort\'] = $modx->getOption(\'extraFieldSort\', $scriptProperties, \'ASC\');
$scriptProperties[\'extraFieldSortBy\'] = $modx->getOption(\'extraFieldSortBy\', $scriptProperties, \'\');

// Templating
$scriptProperties[\'tpl\'] = $modx->getOption(\'tpl\', $scriptProperties, \'\');
$scriptProperties[\'tplOdd\'] = $modx->getOption(\'tplOdd\', $scriptProperties, $scriptProperties[\'tpl\']);
$scriptProperties[\'tplFirst\'] = $modx->getOption(\'tplFirst\', $scriptProperties, $scriptProperties[\'tpl\']);
$scriptProperties[\'tplLast\'] = $modx->getOption(\'tplLast\', $scriptProperties, $scriptProperties[\'tpl\']);

if (!isset($scriptProperties[\'tpl\'])  || $scriptProperties[\'tpl\'] == \'\') {
    return \'\';
}

// Querystring based search
$router = $vc->router[\'query\'];
unset($router[\'q\']);

$scriptProperties[\'sort\'] = $modx->getOption(\'sort\', $router, \'asc\');

if (isset($router[\'index\']) && in_array($router[\'index\'], explode(\',\', $scriptProperties[\'sortable\']))) {
    $scriptProperties[\'sortBy\'] = $modx->getOption(\'index\', $router, \'asc\');    
}

$internal = array(
    \'limit\' => 0,
    \'offset\' => 0
);

if ($scriptProperties[\'parents\'] == false) {
    return \'\';
}

foreach($scriptProperties as $parameter => $property) {
    if (substr($parameter, 0, 3) == \'tpl\' && !in_array($parameter, array(\'tpl\', \'tplOdd\', \'tplFirst\', \'tplLast\'))) {
        if (!is_numeric(substr($parameter, 3))) {
            continue;
        }
        
        $scriptProperties[\'tplNth\'][] = array(
            \'nth\' => (int) substr($parameter, 3),
            \'tpl\' => $property
        );
        
        unset($scriptProperties[$parameter]); // Clean up on isle 5!
    }
}

if ($scriptProperties[\'parents\'] == 0) {
    return \'\';
}

$scriptProperties[\'parents\'] = explode(\',\',  $scriptProperties[\'parents\']);
$scriptProperties[\'exclude\'] = explode(\',\',  $scriptProperties[\'exclude\']);

$products = array();
foreach($scriptProperties[\'parents\'] as $parent) {
    // Fetch the parent (for shop ID)
    if (!isset($modx->visioncart) || !isset($modx->visioncart->shop)) {
        $category = $modx->getObject(\'vcCategory\', (int) $parent);
        $shopId = $category->get(\'shopid\');
    } else {
        $shopId = $modx->visioncart->shop->get(\'id\');
    }

    $stack = $vc->getProducts($parent, array(
        \'hideSKU\' => $scriptProperties[\'hideSKU\'],
        \'shopId\' => $shopId
    ));

    if ($stack[\'total\'] != 0 && !empty($stack[\'data\'])) {
        foreach($stack[\'data\'] as $product) {
            if (in_array($product->get(\'id\'), $scriptProperties[\'exclude\'])) {
            	continue;	
            }
            
            $product->set(\'url\', $vc->makeUrl(array(
                \'productCategory\' => $product->get(\'linkId\'),
                \'shopId\' => $product->get(\'shopid\'),
                \'scheme\' => $scriptProperties[\'scheme\']
            )));
            
            $priceData = $vc->calculateProductPrice($product, true);
            $product->set(\'display\', array(\'price\' => $priceData));

            $products[] = $product->toArray();    
        }
    }
    
    unset($stack);
}

if ($scriptProperties[\'extraFieldSortBy\'] != \'\') {
    $products = array_values($vc->multiNaturalSort($products, \'customfields.\'.$scriptProperties[\'extraFieldSortBy\'], strtolower($scriptProperties[\'extraFieldSort\'])));
} else {
    $products = array_values($vc->multiNaturalSort($products, $scriptProperties[\'sortBy\'], strtolower($scriptProperties[\'sort\'])));
}

for($inc = 0; $inc < count($products); $inc++) {
    if ($scriptProperties[\'offset\'] != 0 && $internal[\'offset\'] <= $scriptProperties[\'offset\']) {
        $internal[\'offset\']++;
        continue;
    }
    
    if ($scriptProperties[\'limit\'] != 0 && $internal[\'limit\'] >= $scriptProperties[\'limit\']) {
        break;
    }
    
    $internal[\'limit\']++;
    
    if ($inc == 0) {
        $output[\'master\'] .= $vc->parseChunk($scriptProperties[\'tplFirst\'], array_merge($products[$inc], array(
            \'count\' => $inc
        )));
        continue;
    } else if ($inc == count($products)) {
        $output[\'master\'] .= $vc->parseChunk($scriptProperties[\'tplLast\'], array_merge($products[$inc], array(
            \'count\' => $inc
        )));
        continue;
    }
    
    // Raffle through a set of nth templates, if they\'ve been set
    if (isset($scriptProperties[\'tplNth\']) && !empty($scriptProperties[\'tplNth\'])) {
        $break = false;
        
        foreach($scriptProperties[\'tplNth\'] as $tpl) {
            if ($tpl[\'nth\'] == $inc) {
                $output[\'master\'] .= $vc->parseChunk($tpl[\'tpl\'], array_merge($products[$inc], array(
                    \'count\' => $inc
                )));
                $break = true;
                break;
            }
        }
    }
    
    // Break the loop since a nth tpl has been found
    if (isset($break) && $break == true) {
        continue;
    }
    
    if ($inc % 2) {
        $output[\'master\'] .= $vc->parseChunk($scriptProperties[\'tplOdd\'], array_merge($products[$inc], array(
            \'count\' => $inc
        )));
        continue;
    }
    
    $output[\'master\'] .= $vc->parseChunk($scriptProperties[\'tpl\'], array_merge($products[$inc], array(
        \'count\' => $inc
    )));
}

unset($scriptProperties, $products, $product, $interal);
return $output[\'master\'];',
    ),
  ),
  'bb255e77fa475a23c8ea0de16652120a' => 
  array (
    'criteria' => 
    array (
      'name' => 'vcWayfinder',
    ),
    'object' => 
    array (
      'id' => 54,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'vcWayfinder',
      'description' => 'Use wayfinder to build a path from the inherit shop or a specified one',
      'editor_type' => 0,
      'category' => 37,
      'cache_type' => 0,
      'snippet' => '/**
 * @package visioncart
 */

$vc =& $modx->visioncart;

return $vc->wayFinder($scriptProperties);',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * @package visioncart
 */

$vc =& $modx->visioncart;

return $vc->wayFinder($scriptProperties);',
    ),
  ),
  'e376898f9b6a43df29a8a8e7a4c76472' => 
  array (
    'criteria' => 
    array (
      'name' => 'vcGetProductCustomField',
    ),
    'object' => 
    array (
      'id' => 55,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'vcGetProductCustomField',
      'description' => '',
      'editor_type' => 0,
      'category' => 37,
      'cache_type' => 0,
      'snippet' => '/**
 * @package visioncart
 */

$vc =& $modx->visioncart;

if (isset($scriptProperties[\'id\']) || !is_numeric($scriptProperties[\'id\'])) {
	return \'\';
}

$product = $vc->getProduct($scriptProperties[\'id\']);

if ($product == null) {
	return \'\';
}

$link = $product->getOne(\'ProductCategory\');

$product = $product->toArray();
$link = $link->toArray();

if ($product[\'customfields\'] != \'\' && is_array($product[\'customfields\'])) {
	if (isset($product[\'customfields\'][$link[\'categoryid\']][$field])) {
		return $product[\'customfields\'][$link[\'categoryid\']][$field];
	}
}

return \'\';',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * @package visioncart
 */

$vc =& $modx->visioncart;

if (isset($scriptProperties[\'id\']) || !is_numeric($scriptProperties[\'id\'])) {
	return \'\';
}

$product = $vc->getProduct($scriptProperties[\'id\']);

if ($product == null) {
	return \'\';
}

$link = $product->getOne(\'ProductCategory\');

$product = $product->toArray();
$link = $link->toArray();

if ($product[\'customfields\'] != \'\' && is_array($product[\'customfields\'])) {
	if (isset($product[\'customfields\'][$link[\'categoryid\']][$field])) {
		return $product[\'customfields\'][$link[\'categoryid\']][$field];
	}
}

return \'\';',
    ),
  ),
  'f3568eaa0647d141c029c6c1ab5c663f' => 
  array (
    'criteria' => 
    array (
      'name' => 'vcGetProduct',
    ),
    'object' => 
    array (
      'id' => 56,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'vcGetProduct',
      'description' => '',
      'editor_type' => 0,
      'category' => 37,
      'cache_type' => 0,
      'snippet' => '/**
 * @package visioncart
 */
 
$vc =& $modx->visioncart;

$scriptProperties[\'config\'] = $modx->getOption(\'config\', $scriptProperties, \'default\');
$config = $vc->getConfigFile($vc->shop->get(\'id\'), \'getProduct\', null, array(\'config\' => $scriptProperties[\'config\']));

$scriptProperties = array_merge($config, $scriptProperties);
$scriptProperties[\'category\'] = $modx->getOption(\'category\', $scriptProperties, 0);
$scriptProperties[\'scheme\'] = $modx->getOption(\'scheme\', $scriptProperties, -1);

// Load the product
if (isset($scriptProperties[\'id\'])) {
    $product = $vc->getProduct($scriptProperties[\'id\']);
} else {
	if (isset($vc->product)) {
		$product = $vc->product;
	} else {
    	$product = $vc->getProduct($vc->router[\'product\'][\'id\']);
	}
}

if (!isset($product) || is_null($product) || $product == false) {
	return false;
}

if ($scriptProperties[\'category\'] != 0) {
	$link = $product->getOne(\'ProductCategory\', array(
		\'categoryid\' => $scriptProperties[\'category\']
	));
	
	// Add the product URL for reference
	$product->set(\'url\', $vc->makeUrl(array(
		\'productCategory\' => $link->get(\'id\'),
		\'scheme\' => $scriptProperties[\'scheme\']
	)));
}

// Convert prices and so on for display purposes, leaving the database values intact for re-usage
$product->set(\'display\', array(
	\'price\' => $vc->calculateProductPrice($product, true),
	\'shippingprice\' => $vc->money($product->get(\'shippingprice\'), array(\'shopId\' => $product->get(\'shopid\')))
));



if (isset($scriptProperties[\'id\'])) {
    $modx->toPlaceholders($product->toArray(), \'vc.product\');
}

if ($scriptProperties[\'tpl\'] != \'\') { 
	return $vc->parseChunk($scriptProperties[\'tpl\'], array_merge($product->toArray(), array(
		\'link\' => $link != null ? $link->toArray() : array()
	)));
}

return \'\';',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * @package visioncart
 */
 
$vc =& $modx->visioncart;

$scriptProperties[\'config\'] = $modx->getOption(\'config\', $scriptProperties, \'default\');
$config = $vc->getConfigFile($vc->shop->get(\'id\'), \'getProduct\', null, array(\'config\' => $scriptProperties[\'config\']));

$scriptProperties = array_merge($config, $scriptProperties);
$scriptProperties[\'category\'] = $modx->getOption(\'category\', $scriptProperties, 0);
$scriptProperties[\'scheme\'] = $modx->getOption(\'scheme\', $scriptProperties, -1);

// Load the product
if (isset($scriptProperties[\'id\'])) {
    $product = $vc->getProduct($scriptProperties[\'id\']);
} else {
	if (isset($vc->product)) {
		$product = $vc->product;
	} else {
    	$product = $vc->getProduct($vc->router[\'product\'][\'id\']);
	}
}

if (!isset($product) || is_null($product) || $product == false) {
	return false;
}

if ($scriptProperties[\'category\'] != 0) {
	$link = $product->getOne(\'ProductCategory\', array(
		\'categoryid\' => $scriptProperties[\'category\']
	));
	
	// Add the product URL for reference
	$product->set(\'url\', $vc->makeUrl(array(
		\'productCategory\' => $link->get(\'id\'),
		\'scheme\' => $scriptProperties[\'scheme\']
	)));
}

// Convert prices and so on for display purposes, leaving the database values intact for re-usage
$product->set(\'display\', array(
	\'price\' => $vc->calculateProductPrice($product, true),
	\'shippingprice\' => $vc->money($product->get(\'shippingprice\'), array(\'shopId\' => $product->get(\'shopid\')))
));



if (isset($scriptProperties[\'id\'])) {
    $modx->toPlaceholders($product->toArray(), \'vc.product\');
}

if ($scriptProperties[\'tpl\'] != \'\') { 
	return $vc->parseChunk($scriptProperties[\'tpl\'], array_merge($product->toArray(), array(
		\'link\' => $link != null ? $link->toArray() : array()
	)));
}

return \'\';',
    ),
  ),
  'd561db7c7291e147027634a76460182b' => 
  array (
    'criteria' => 
    array (
      'name' => 'vcMoney',
    ),
    'object' => 
    array (
      'id' => 71,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'vcMoney',
      'description' => 'Currency number format modifer',
      'editor_type' => 0,
      'category' => 39,
      'cache_type' => 0,
      'snippet' => '/**
 * @package visioncart
 */

$vc =& $modx->visioncart;

if ($scriptProperties[\'options\'] != \'\') {
	$scriptProperties[\'options\'] = explode(\',\', $scriptProperties[\'options\']);
	foreach($scriptProperties[\'options\'] as $key => $value) {
		$value = explode(\'==\', $value);
		$scriptProperties[$value[0]] = $value[1];
	}
}

return $vc->money($scriptProperties[\'input\'], $scriptProperties);',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * @package visioncart
 */

$vc =& $modx->visioncart;

if ($scriptProperties[\'options\'] != \'\') {
	$scriptProperties[\'options\'] = explode(\',\', $scriptProperties[\'options\']);
	foreach($scriptProperties[\'options\'] as $key => $value) {
		$value = explode(\'==\', $value);
		$scriptProperties[$value[0]] = $value[1];
	}
}

return $vc->money($scriptProperties[\'input\'], $scriptProperties);',
    ),
  ),
  '7a5e04a80f98b6c227f6929a4fac68d8' => 
  array (
    'criteria' => 
    array (
      'name' => 'vcOptionOutputComboRow',
    ),
    'object' => 
    array (
      'id' => 76,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'vcOptionOutputComboRow',
      'description' => '',
      'editor_type' => 0,
      'category' => 44,
      'cache_type' => 0,
      'snippet' => '<option value="[[+id]]" [[+selected]]>[[+value]]</option>',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => '',
      'content' => '<option value="[[+id]]" [[+selected]]>[[+value]]</option>',
    ),
  ),
  '6383fb906fd283876aac6e59cfcd743d' => 
  array (
    'criteria' => 
    array (
      'name' => 'vcOptionOutputCombo',
    ),
    'object' => 
    array (
      'id' => 77,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'vcOptionOutputCombo',
      'description' => '',
      'editor_type' => 0,
      'category' => 44,
      'cache_type' => 0,
      'snippet' => '[[+name]]:<br /><select onchange="vc.setOptionValue([[+id]], this.value);">
[[+innerChunk]]
</select>
<hr />',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => '',
      'content' => '[[+name]]:<br /><select onchange="vc.setOptionValue([[+id]], this.value);">
[[+innerChunk]]
</select>
<hr />',
    ),
  ),
  'c7ef4016b0d72f61334ca222c74d2ae2' => 
  array (
    'criteria' => 
    array (
      'name' => 'vcOptionOutputCombo',
    ),
    'object' => 
    array (
      'id' => 72,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'vcOptionOutputCombo',
      'description' => 'Default output snippet',
      'editor_type' => 0,
      'category' => 44,
      'cache_type' => 0,
      'snippet' => '/**
 * @package visioncart
 */

$option = $modx->getOption(\'option\', $scriptProperties, array());
$values = $modx->getOption(\'values\', $scriptProperties, array());
$tpl = $modx->getOption(\'tpl\', $scriptProperties, \'vcOptionOutputCombo\');
$rowTpl = $modx->getOption(\'rowTpl\', $scriptProperties, \'vcOptionOutputComboRow\');
$selectedValue = $modx->getOption(\'selectedValue\', $scriptProperties, \'0\');

$innerChunk = \'\';
foreach($values as $value) {
	if ($value[\'id\'] == $selectedValue) {
		$value[\'selected\'] = \'selected="selected"\';	
	} else {
		$value[\'selected\'] = \'\';	
	}
	$innerChunk .= $modx->getChunk($rowTpl, $value);
}

return $modx->getChunk($tpl, array_merge($option, array(\'innerChunk\' => $innerChunk)));',
      'locked' => 0,
      'properties' => NULL,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * @package visioncart
 */

$option = $modx->getOption(\'option\', $scriptProperties, array());
$values = $modx->getOption(\'values\', $scriptProperties, array());
$tpl = $modx->getOption(\'tpl\', $scriptProperties, \'vcOptionOutputCombo\');
$rowTpl = $modx->getOption(\'rowTpl\', $scriptProperties, \'vcOptionOutputComboRow\');
$selectedValue = $modx->getOption(\'selectedValue\', $scriptProperties, \'0\');

$innerChunk = \'\';
foreach($values as $value) {
	if ($value[\'id\'] == $selectedValue) {
		$value[\'selected\'] = \'selected="selected"\';	
	} else {
		$value[\'selected\'] = \'\';	
	}
	$innerChunk .= $modx->getChunk($rowTpl, $value);
}

return $modx->getChunk($tpl, array_merge($option, array(\'innerChunk\' => $innerChunk)));',
    ),
  ),
  '6b58c8eccb66fd5fa4609eee502b2477' => 
  array (
    'files' => 
    array (
      0 => '/home/oojo/dev.galaxytvonline.com/assets/components',
    ),
  ),
  '8a5d33a3f712ca515f980637185227c5' => 
  array (
    'criteria' => 
    array (
      'namespace' => 'visioncart',
      'controller' => 'index',
    ),
    'object' => 
    array (
      'id' => 86,
      'namespace' => 'visioncart',
      'controller' => 'index',
      'haslayout' => 1,
      'lang_topics' => 'visioncart:default',
      'assets' => '',
      'help_url' => '',
    ),
  ),
  '1e29ac816de100eca4ea9f9ce23465b7' => 
  array (
    'criteria' => 
    array (
      'namespace' => 'visioncart',
      'controller' => 'index',
    ),
    'object' => 
    array (
      'id' => 86,
      'namespace' => 'visioncart',
      'controller' => 'index',
      'haslayout' => 1,
      'lang_topics' => 'visioncart:default',
      'assets' => '',
      'help_url' => '',
    ),
  ),
  '050b4fa59c07609842a675b7625c8dcb' => 
  array (
    'criteria' => 
    array (
      'namespace' => 'visioncart',
      'controller' => 'index',
    ),
    'object' => 
    array (
      'id' => 86,
      'namespace' => 'visioncart',
      'controller' => 'index',
      'haslayout' => 1,
      'lang_topics' => 'visioncart:default',
      'assets' => '',
      'help_url' => '',
    ),
  ),
);