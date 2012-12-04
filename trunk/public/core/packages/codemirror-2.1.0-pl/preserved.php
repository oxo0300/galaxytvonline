<?php return array (
  'f5b4fe014e100ef9c53a38f3c55fbbc1' => 
  array (
    'criteria' => 
    array (
      'name' => 'codemirror',
    ),
    'object' => 
    array (
      'name' => 'codemirror',
      'path' => '{core_path}components/codemirror/',
      'assets_path' => '',
    ),
  ),
  'e38a96f5c229e555e5bdead8e48559d2' => 
  array (
    'criteria' => 
    array (
      'name' => 'CodeMirror',
    ),
    'object' => 
    array (
      'id' => 2,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'CodeMirror',
      'description' => 'CodeMirror 2.0.0-pl plugin for MODx Revolution',
      'editor_type' => 0,
      'category' => 0,
      'cache_type' => 0,
      'plugincode' => '/**
 * @package codemirror
 */
if ($modx->event->name == \'OnRichTextEditorRegister\') {
    $modx->event->output(\'CodeMirror\');
    return;
}
if ($modx->getOption(\'which_element_editor\',null,\'CodeMirror\') != \'CodeMirror\') return;
if (!$modx->getOption(\'use_editor\',null,true)) return;
if (!$modx->getOption(\'codemirror.enable\',null,true)) return;

$codeMirror = $modx->getService(\'codemirror\',\'CodeMirror\',$modx->getOption(\'codemirror.core_path\',null,$modx->getOption(\'core_path\').\'components/codemirror/\').\'model/codemirror/\');
if (!($codeMirror instanceof CodeMirror)) return \'\';


$options = array(
    \'modx_path\' => $codeMirror->config[\'assetsUrl\'],
    \'electricChars\' => (boolean)$modx->getOption(\'electricChars\',$scriptProperties,true),
    \'enterMode\' => $modx->getOption(\'tabMode\',$scriptProperties,\'indent\'),
    \'firstLineNumber\' => (int)$modx->getOption(\'firstLineNumber\',$scriptProperties,1),
    \'highlightLine\' => (boolean)$modx->getOption(\'highlightLine\',$scriptProperties,true),
    \'indentUnit\' => (int)$modx->getOption(\'indentUnit\',$scriptProperties,$modx->getOption(\'indent_unit\',$scriptProperties,2)),
    \'indentWithTabs\' => (boolean)$modx->getOption(\'indentWithTabs\',$scriptProperties,true),
    \'lineNumbers\' => (boolean)$modx->getOption(\'lineNumbers\',$scriptProperties,$modx->getOption(\'line_numbers\',$scriptProperties,true)),
    \'matchBrackets\' => (boolean)$modx->getOption(\'matchBrackets\',$scriptProperties,true),
    \'showSearchForm\' => (boolean)$modx->getOption(\'showSearchForm\',$scriptProperties,true),
    \'tabMode\' => $modx->getOption(\'tabMode\',$scriptProperties,$modx->getOption(\'tab_mode\',$scriptProperties,\'classic\')),
    \'undoDepth\' => $modx->getOption(\'undoDepth\',$scriptProperties,40),
);

$load = false;
switch ($modx->event->name) {
    case \'OnSnipFormPrerender\':
        $options[\'modx_loader\'] = \'onSnippet\';
        $options[\'mode\'] = \'php\';
        $load = true;
        break;
    case \'OnTempFormPrerender\':
        $options[\'modx_loader\'] = \'onTemplate\';
        $options[\'mode\'] = \'htmlmixed\';
        $load = true;
        break;
    case \'OnChunkFormPrerender\':
        $options[\'modx_loader\'] = \'onChunk\';
        $options[\'mode\'] = \'htmlmixed\';
        $load = true;
        break;
    case \'OnPluginFormPrerender\':
        $options[\'modx_loader\'] = \'onPlugin\';
        $options[\'mode\'] = \'php\';
        $load = true;
        break;
    /* disabling TVs for now, since it causes problems with newlines
    case \'OnTVFormPrerender\':
        $options[\'modx_loader\'] = \'onTV\';
        $options[\'height\'] = \'250px\';
        $load = true;
        break;*/
    case \'OnFileEditFormPrerender\':
        $options[\'modx_loader\'] = \'onFile\';
        $options[\'mode\'] = \'php\';
        $load = true;
        break;
    /* debated whether or not to use */
    case \'OnRichTextEditorInit\':
        break;
    case \'OnRichTextBrowserInit\':
        break;
}

if ($load) {
    $options[\'searchTpl\'] = $codeMirror->getChunk(\'search\');

    $modx->regClientStartupHTMLBlock(\'<script type="text/javascript">MODx.codem = \'.$modx->toJSON($options).\';</script>\');
    $modx->regClientCSS($codeMirror->config[\'assetsUrl\'].\'css/codemirror-compressed.css\');
    $modx->regClientCSS($codeMirror->config[\'assetsUrl\'].\'css/cm.css\');
    $modx->regClientStartupScript($codeMirror->config[\'assetsUrl\'].\'js/codemirror-compressed.js\');
    $modx->regClientStartupScript($codeMirror->config[\'assetsUrl\'].\'js/cm.js\');
}

return;',
      'locked' => 0,
      'properties' => 'a:11:{s:10:"indentUnit";a:6:{s:4:"name";s:10:"indentUnit";s:4:"desc";s:23:"prop_cm.indentUnit_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:2;s:7:"lexicon";s:21:"codemirror:properties";}s:14:"indentWithTabs";a:6:{s:4:"name";s:14:"indentWithTabs";s:4:"desc";s:27:"prop_cm.indentWithTabs_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:21:"codemirror:properties";}s:7:"tabMode";a:6:{s:4:"name";s:7:"tabMode";s:4:"desc";s:20:"prop_cm.tabMode_desc";s:4:"type";s:4:"list";s:7:"options";a:4:{i:0;a:2:{s:4:"text";s:15:"prop_cm.classic";s:5:"value";s:7:"classic";}i:1;a:2:{s:4:"text";s:13:"prop_cm.shift";s:5:"value";s:5:"shift";}i:2;a:2:{s:4:"text";s:14:"prop_cm.indent";s:5:"value";s:6:"indent";}i:3;a:2:{s:4:"text";s:23:"prop_cm.browser_default";s:5:"value";s:7:"default";}}s:5:"value";s:7:"classic";s:7:"lexicon";s:21:"codemirror:properties";}s:9:"enterMode";a:6:{s:4:"name";s:9:"enterMode";s:4:"desc";s:22:"prop_cm.enterMode_desc";s:4:"type";s:4:"list";s:7:"options";a:3:{i:0;a:2:{s:4:"text";s:14:"prop_cm.indent";s:5:"value";s:6:"indent";}i:1;a:2:{s:4:"text";s:12:"prop_cm.keep";s:5:"value";s:4:"keep";}i:2;a:2:{s:4:"text";s:12:"prop_cm.flat";s:5:"value";s:4:"flat";}}s:5:"value";s:6:"indent";s:7:"lexicon";s:21:"codemirror:properties";}s:13:"electricChars";a:6:{s:4:"name";s:13:"electricChars";s:4:"desc";s:26:"prop_cm.electricChars_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:21:"codemirror:properties";}s:11:"lineNumbers";a:6:{s:4:"name";s:11:"lineNumbers";s:4:"desc";s:24:"prop_cm.lineNumbers_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:21:"codemirror:properties";}s:15:"firstLineNumber";a:6:{s:4:"name";s:15:"firstLineNumber";s:4:"desc";s:28:"prop_cm.firstLineNumber_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:1;s:7:"lexicon";s:21:"codemirror:properties";}s:13:"highlightLine";a:6:{s:4:"name";s:13:"highlightLine";s:4:"desc";s:26:"prop_cm.highlightLine_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:21:"codemirror:properties";}s:13:"matchBrackets";a:6:{s:4:"name";s:13:"matchBrackets";s:4:"desc";s:26:"prop_cm.matchBrackets_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:21:"codemirror:properties";}s:14:"showSearchForm";a:6:{s:4:"name";s:14:"showSearchForm";s:4:"desc";s:27:"prop_cm.showSearchForm_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:21:"codemirror:properties";}s:9:"undoDepth";a:6:{s:4:"name";s:9:"undoDepth";s:4:"desc";s:22:"prop_cm.undoDepth_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:40;s:7:"lexicon";s:21:"codemirror:properties";}}',
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * @package codemirror
 */
if ($modx->event->name == \'OnRichTextEditorRegister\') {
    $modx->event->output(\'CodeMirror\');
    return;
}
if ($modx->getOption(\'which_element_editor\',null,\'CodeMirror\') != \'CodeMirror\') return;
if (!$modx->getOption(\'use_editor\',null,true)) return;
if (!$modx->getOption(\'codemirror.enable\',null,true)) return;

$codeMirror = $modx->getService(\'codemirror\',\'CodeMirror\',$modx->getOption(\'codemirror.core_path\',null,$modx->getOption(\'core_path\').\'components/codemirror/\').\'model/codemirror/\');
if (!($codeMirror instanceof CodeMirror)) return \'\';


$options = array(
    \'modx_path\' => $codeMirror->config[\'assetsUrl\'],
    \'electricChars\' => (boolean)$modx->getOption(\'electricChars\',$scriptProperties,true),
    \'enterMode\' => $modx->getOption(\'tabMode\',$scriptProperties,\'indent\'),
    \'firstLineNumber\' => (int)$modx->getOption(\'firstLineNumber\',$scriptProperties,1),
    \'highlightLine\' => (boolean)$modx->getOption(\'highlightLine\',$scriptProperties,true),
    \'indentUnit\' => (int)$modx->getOption(\'indentUnit\',$scriptProperties,$modx->getOption(\'indent_unit\',$scriptProperties,2)),
    \'indentWithTabs\' => (boolean)$modx->getOption(\'indentWithTabs\',$scriptProperties,true),
    \'lineNumbers\' => (boolean)$modx->getOption(\'lineNumbers\',$scriptProperties,$modx->getOption(\'line_numbers\',$scriptProperties,true)),
    \'matchBrackets\' => (boolean)$modx->getOption(\'matchBrackets\',$scriptProperties,true),
    \'showSearchForm\' => (boolean)$modx->getOption(\'showSearchForm\',$scriptProperties,true),
    \'tabMode\' => $modx->getOption(\'tabMode\',$scriptProperties,$modx->getOption(\'tab_mode\',$scriptProperties,\'classic\')),
    \'undoDepth\' => $modx->getOption(\'undoDepth\',$scriptProperties,40),
);

$load = false;
switch ($modx->event->name) {
    case \'OnSnipFormPrerender\':
        $options[\'modx_loader\'] = \'onSnippet\';
        $options[\'mode\'] = \'php\';
        $load = true;
        break;
    case \'OnTempFormPrerender\':
        $options[\'modx_loader\'] = \'onTemplate\';
        $options[\'mode\'] = \'htmlmixed\';
        $load = true;
        break;
    case \'OnChunkFormPrerender\':
        $options[\'modx_loader\'] = \'onChunk\';
        $options[\'mode\'] = \'htmlmixed\';
        $load = true;
        break;
    case \'OnPluginFormPrerender\':
        $options[\'modx_loader\'] = \'onPlugin\';
        $options[\'mode\'] = \'php\';
        $load = true;
        break;
    /* disabling TVs for now, since it causes problems with newlines
    case \'OnTVFormPrerender\':
        $options[\'modx_loader\'] = \'onTV\';
        $options[\'height\'] = \'250px\';
        $load = true;
        break;*/
    case \'OnFileEditFormPrerender\':
        $options[\'modx_loader\'] = \'onFile\';
        $options[\'mode\'] = \'php\';
        $load = true;
        break;
    /* debated whether or not to use */
    case \'OnRichTextEditorInit\':
        break;
    case \'OnRichTextBrowserInit\':
        break;
}

if ($load) {
    $options[\'searchTpl\'] = $codeMirror->getChunk(\'search\');

    $modx->regClientStartupHTMLBlock(\'<script type="text/javascript">MODx.codem = \'.$modx->toJSON($options).\';</script>\');
    $modx->regClientCSS($codeMirror->config[\'assetsUrl\'].\'css/codemirror-compressed.css\');
    $modx->regClientCSS($codeMirror->config[\'assetsUrl\'].\'css/cm.css\');
    $modx->regClientStartupScript($codeMirror->config[\'assetsUrl\'].\'js/codemirror-compressed.js\');
    $modx->regClientStartupScript($codeMirror->config[\'assetsUrl\'].\'js/cm.js\');
}

return;',
    ),
    'files' => 
    array (
      0 => '/home/oojo/dev.galaxytvonline.com/core/components',
    ),
  ),
  '0f60fc0aff6f0d780a7f6c55d10c657b' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 2,
      'event' => 'OnChunkFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 2,
      'event' => 'OnChunkFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'a2d826ae4d0da9d9681cf8a9eb7a4791' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 2,
      'event' => 'OnPluginFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 2,
      'event' => 'OnPluginFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '32cafe7fcd5a43938c422c5b5870874e' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 2,
      'event' => 'OnSnipFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 2,
      'event' => 'OnSnipFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '7ae053defd7922a4f707f50d0b9db251' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 2,
      'event' => 'OnTempFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 2,
      'event' => 'OnTempFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '4f784a4dc026385bd07fea7adb7434f5' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 2,
      'event' => 'OnFileEditFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 2,
      'event' => 'OnFileEditFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '214cabc356fd17e74c11d3f7fccd0f80' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 2,
      'event' => 'OnRichTextEditorRegister',
    ),
    'object' => 
    array (
      'pluginid' => 2,
      'event' => 'OnRichTextEditorRegister',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '0e7873ed40fe95cf417747c3c8349c35' => 
  array (
    'criteria' => 
    array (
      'key' => 'codemirror.enable',
    ),
    'object' => 
    array (
      'key' => 'codemirror.enable',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'codemirror',
      'area' => 'Editor',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
);