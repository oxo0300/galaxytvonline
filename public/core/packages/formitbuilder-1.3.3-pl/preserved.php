<?php return array (
  'e905d35e42e305c897c032b0e6f8081c' => 
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
  '9eb146b793c4f74cf3f04ee7cf9a898c' => 
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
  '0fa3259149589b55f90297a06e7e2851' => 
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
  '4523c264b63d5cb023d6d7b189a190f4' => 
  array (
    'criteria' => 
    array (
      'name' => 'FormItBuilderAutoResponderEmailTpl',
    ),
    'object' => 
    array (
      'id' => 39,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'FormItBuilderAutoResponderEmailTpl',
      'description' => '',
      'editor_type' => 0,
      'category' => 5,
      'cache_type' => 0,
      'snippet' => '[[+FormItBuilderAutoResponderEmailTpl]]',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '[[+FormItBuilderAutoResponderEmailTpl]]',
    ),
  ),
  'b1144cb43e29d5e79f810611b64bf835' => 
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
  '123a6a36fd1f5c65eca1c2c16be2b99a' => 
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