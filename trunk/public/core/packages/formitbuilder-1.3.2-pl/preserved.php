<?php return array (
  '408bbaaf95162c4d04aa15b8417be202' => 
  array (
    'criteria' => 
    array (
      'name' => 'formitbuilder',
    ),
    'object' => 
    array (
      'name' => 'formitbuilder',
      'path' => '{core_path}components/formitbuilder/',
      'assets_path' => '',
    ),
  ),
  '16b1562915c8359f86edc7f5827c3d4a' => 
  array (
    'criteria' => 
    array (
      'category' => 'FormItBuilder',
    ),
    'object' => 
    array (
      'id' => 5,
      'parent' => 0,
      'category' => 'FormItBuilder',
    ),
    'files' => 
    array (
      0 => '/home/oojo/dev.galaxytvonline.com/assets/components',
    ),
  ),
  '25e7971663689b27dac4f515585ea3db' => 
  array (
    'criteria' => 
    array (
      'name' => 'FormItBuilderEmailTpl',
    ),
    'object' => 
    array (
      'id' => 1,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'FormItBuilderEmailTpl',
      'description' => '',
      'editor_type' => 0,
      'category' => 5,
      'cache_type' => 0,
      'snippet' => '[[+FormItBuilderEmailTpl]]',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '[[+FormItBuilderEmailTpl]]',
    ),
  ),
  '1057bd9468356658c4dbb148195c114b' => 
  array (
    'criteria' => 
    array (
      'name' => 'FormItBuilder_customValidation',
    ),
    'object' => 
    array (
      'id' => 12,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'FormItBuilder_customValidation',
      'description' => '',
      'editor_type' => 0,
      'category' => 5,
      'cache_type' => 0,
      'snippet' => '$a_store = $GLOBALS[\'FormItBuilder_customValidation\'];
if(isset($a_store[$key])){
	require_once $modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/formitbuilder/model/formitbuilder/FormCustomValidate.class.php\';
	$a_res = FormItBuilder_customValidate::validateElement($key, $value, $a_store[$key]);
	//Some functions may auto tidy or re-format the value. If so replace current value in formIT fields array.
	if(empty($validator->fields[$key])===false && empty($a_res[\'value\'])===false){
		$validator->fields[$key] = $a_res[\'value\'];
	}

	if($a_res[\'returnStatus\']===false){
		$validator->addError($key,$a_res[\'errorMsg\']);
	}
}
//if no fails, return true
return true;',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '$a_store = $GLOBALS[\'FormItBuilder_customValidation\'];
if(isset($a_store[$key])){
	require_once $modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/formitbuilder/model/formitbuilder/FormCustomValidate.class.php\';
	$a_res = FormItBuilder_customValidate::validateElement($key, $value, $a_store[$key]);
	//Some functions may auto tidy or re-format the value. If so replace current value in formIT fields array.
	if(empty($validator->fields[$key])===false && empty($a_res[\'value\'])===false){
		$validator->fields[$key] = $a_res[\'value\'];
	}

	if($a_res[\'returnStatus\']===false){
		$validator->addError($key,$a_res[\'errorMsg\']);
	}
}
//if no fails, return true
return true;',
    ),
  ),
  '171e00b76dcd7afd5a250f59c1c554d1' => 
  array (
    'criteria' => 
    array (
      'name' => 'FormItBuilder_hooks',
    ),
    'object' => 
    array (
      'id' => 13,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'FormItBuilder_hooks',
      'description' => '',
      'editor_type' => 0,
      'category' => 5,
      'cache_type' => 0,
      'snippet' => 'require_once $modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/formitbuilder/model/formitbuilder/FormItBuilder.class.php\';
$o_form = $GLOBALS[\'FormItBuilder_hookCommands\'][\'formObj\'];
$a_commands = $GLOBALS[\'FormItBuilder_hookCommands\'][\'commands\'];
return $o_form->processHooks($a_commands);',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => 'require_once $modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/formitbuilder/model/formitbuilder/FormItBuilder.class.php\';
$o_form = $GLOBALS[\'FormItBuilder_hookCommands\'][\'formObj\'];
$a_commands = $GLOBALS[\'FormItBuilder_hookCommands\'][\'commands\'];
return $o_form->processHooks($a_commands);',
    ),
  ),
);