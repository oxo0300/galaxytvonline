<?php return array (
  '87981ce89db51b95f8f4fd2fe5c7b1a2' => 
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
  'd5590b991a535436bcec6163165558b3' => 
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
      0 => '/home/oojo/dev.nollywoodworldwideent.com/assets/components',
    ),
  ),
  '091c8945cb01c38f86c96fb41f266f3b' => 
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
  'b7eec20792cbace3586154e6632abbdf' => 
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
  '820d9bdc4d485662c563d7f11e764a50' => 
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