<?php return array (
  'af8cd2687271b71152482875b3b61e74' => 
  array (
    'criteria' => 
    array (
      'name' => 'getrelated',
    ),
    'object' => 
    array (
      'name' => 'getrelated',
      'path' => '{core_path}components/getrelated/',
      'assets_path' => '',
    ),
  ),
  'b328b7608aea1695c6a0c321cd2de370' => 
  array (
    'criteria' => 
    array (
      'category' => 'getRelated',
    ),
    'object' => 
    array (
      'id' => 28,
      'parent' => 0,
      'category' => 'getRelated',
    ),
    'files' => 
    array (
      0 => '/home/oojo/dev.galaxytvonline.com/core/components',
    ),
  ),
  'c3af001947dca40e109b8a97a36d1685' => 
  array (
    'criteria' => 
    array (
      'name' => 'getRelated',
    ),
    'object' => 
    array (
      'id' => 47,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'getRelated',
      'description' => 'Lists related resources to the current (or specified) resources..',
      'editor_type' => 0,
      'category' => 28,
      'cache_type' => 0,
      'snippet' => '/**
 * getRelated
 *
 * Copyright 2011 by Mark Hamstra <hello@markhamstra.com>
 *
 * This file is part of getRelated, a snippet that fetches related pages automatically.
 *
 * getRelated is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * getRelated is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * getRelated; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
*/
/* @var modX $modx
 * @var getRelated $getRelated
 * @var array $scriptProperties
 */
$path = $modx->getOption(\'getrelated.core_path\',null,$modx->getOption(\'core_path\').\'components/getrelated/\');

$p = include $path.\'elements/snippets/getrelated.properties.php\';
$p = array_merge($p,$scriptProperties);

$getRelated = $modx->getService(\'getrelated\',\'getRelated\',$path.\'model/\',$p);
if (!($getRelated instanceof getRelated)) return $modx->lexicon(\'getrelated.errorloadingclass\',array(\'path\' => $path.\'model/\'));

/* Get the possibly related resources based on the $matchData found. */
$success = $getRelated->getRelated();

if ($p[\'debug\']) {
    echo \'<br/><strong>Config:</strong>\'; var_dump($getRelated->config);
    echo \'<br/><strong>Fields:</strong>\'; var_dump($getRelated->fields);
    echo \'<br/><strong>TVs:</strong>\'; var_dump($getRelated->tvs);
    echo \'<br/><strong>Match Data:</strong>\'; var_dump($getRelated->matchData);
    echo \'<br/><strong>All Related Resources:</strong>\'; var_dump($getRelated->related);
}

if ($success !== true) return $success;

if (count($getRelated->related) < 1) {
    return $getRelated->config[\'noResults\'];
}

$output = $getRelated->returnRelated();
return $output;',
      'locked' => 0,
      'properties' => 'a:26:{s:8:"resource";a:7:{s:4:"name";s:8:"resource";s:4:"desc";s:29:"getrelated.prop_desc.resource";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:7:"current";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:6:"fields";a:7:{s:4:"name";s:6:"fields";s:4:"desc";s:27:"getrelated.prop_desc.fields";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:23:"pagetitle:3,introtext:2";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:12:"returnFields";a:7:{s:4:"name";s:12:"returnFields";s:4:"desc";s:33:"getrelated.prop_desc.returnFields";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:29:"pagetitle,longtitle,introtext";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:9:"returnTVs";a:7:{s:4:"name";s:9:"returnTVs";s:4:"desc";s:30:"getrelated.prop_desc.returnTVs";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:7:"parents";a:7:{s:4:"name";s:7:"parents";s:4:"desc";s:28:"getrelated.prop_desc.parents";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:12:"parentsDepth";a:7:{s:4:"name";s:12:"parentsDepth";s:4:"desc";s:33:"getrelated.prop_desc.parentsDepth";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:10;s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:8:"contexts";a:7:{s:4:"name";s:8:"contexts";s:4:"desc";s:29:"getrelated.prop_desc.contexts";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:14:"includeDeleted";a:7:{s:4:"name";s:14:"includeDeleted";s:4:"desc";s:35:"getrelated.prop_desc.includeDeleted";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:18:"includeUnpublished";a:7:{s:4:"name";s:18:"includeUnpublished";s:4:"desc";s:39:"getrelated.prop_desc.includeUnpublished";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:13:"includeHidden";a:7:{s:4:"name";s:13:"includeHidden";s:4:"desc";s:34:"getrelated.prop_desc.includeHidden";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:7:"exclude";a:7:{s:4:"name";s:7:"exclude";s:4:"desc";s:28:"getrelated.prop_desc.exclude";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:14:"hideContainers";a:7:{s:4:"name";s:14:"hideContainers";s:4:"desc";s:35:"getrelated.prop_desc.hideContainers";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:5:"limit";a:7:{s:4:"name";s:5:"limit";s:4:"desc";s:26:"getrelated.prop_desc.limit";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:3;s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:11:"fieldSample";a:7:{s:4:"name";s:11:"fieldSample";s:4:"desc";s:32:"getrelated.prop_desc.fieldSample";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:125;s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:9:"fieldSort";a:7:{s:4:"name";s:9:"fieldSort";s:4:"desc";s:30:"getrelated.prop_desc.fieldSort";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:9:"createdon";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:12:"fieldSortDir";a:7:{s:4:"name";s:12:"fieldSortDir";s:4:"desc";s:33:"getrelated.prop_desc.fieldSortDir";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:4:"desc";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:8:"tvSample";a:7:{s:4:"name";s:8:"tvSample";s:4:"desc";s:29:"getrelated.prop_desc.tvSample";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:125;s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:6:"tvSort";a:7:{s:4:"name";s:6:"tvSort";s:4:"desc";s:27:"getrelated.prop_desc.tvSort";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:9:"createdon";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:9:"tvSortDir";a:7:{s:4:"name";s:9:"tvSortDir";s:4:"desc";s:30:"getrelated.prop_desc.tvSortDir";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:4:"desc";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:8:"tplOuter";a:7:{s:4:"name";s:8:"tplOuter";s:4:"desc";s:29:"getrelated.prop_desc.tplOuter";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:12:"relatedOuter";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:6:"tplRow";a:7:{s:4:"name";s:6:"tplRow";s:4:"desc";s:27:"getrelated.prop_desc.tplRow";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:10:"relatedRow";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:9:"noResults";a:7:{s:4:"name";s:9:"noResults";s:4:"desc";s:30:"getrelated.prop_desc.noResults";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:23:"No related pages found.";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:13:"toPlaceholder";a:7:{s:4:"name";s:13:"toPlaceholder";s:4:"desc";s:34:"getrelated.prop_desc.toPlaceholder";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:12:"rowSeparator";a:7:{s:4:"name";s:12:"rowSeparator";s:4:"desc";s:33:"getrelated.prop_desc.rowSeparator";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:1:"
";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:13:"defaultWeight";a:7:{s:4:"name";s:13:"defaultWeight";s:4:"desc";s:34:"getrelated.prop_desc.defaultWeight";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:5;s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}s:5:"debug";a:7:{s:4:"name";s:5:"debug";s:4:"desc";s:26:"getrelated.prop_desc.debug";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"getrelated:default";s:4:"area";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * getRelated
 *
 * Copyright 2011 by Mark Hamstra <hello@markhamstra.com>
 *
 * This file is part of getRelated, a snippet that fetches related pages automatically.
 *
 * getRelated is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * getRelated is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * getRelated; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
*/
/* @var modX $modx
 * @var getRelated $getRelated
 * @var array $scriptProperties
 */
$path = $modx->getOption(\'getrelated.core_path\',null,$modx->getOption(\'core_path\').\'components/getrelated/\');

$p = include $path.\'elements/snippets/getrelated.properties.php\';
$p = array_merge($p,$scriptProperties);

$getRelated = $modx->getService(\'getrelated\',\'getRelated\',$path.\'model/\',$p);
if (!($getRelated instanceof getRelated)) return $modx->lexicon(\'getrelated.errorloadingclass\',array(\'path\' => $path.\'model/\'));

/* Get the possibly related resources based on the $matchData found. */
$success = $getRelated->getRelated();

if ($p[\'debug\']) {
    echo \'<br/><strong>Config:</strong>\'; var_dump($getRelated->config);
    echo \'<br/><strong>Fields:</strong>\'; var_dump($getRelated->fields);
    echo \'<br/><strong>TVs:</strong>\'; var_dump($getRelated->tvs);
    echo \'<br/><strong>Match Data:</strong>\'; var_dump($getRelated->matchData);
    echo \'<br/><strong>All Related Resources:</strong>\'; var_dump($getRelated->related);
}

if ($success !== true) return $success;

if (count($getRelated->related) < 1) {
    return $getRelated->config[\'noResults\'];
}

$output = $getRelated->returnRelated();
return $output;',
    ),
  ),
);