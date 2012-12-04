<?php return array (
  '08c29ea61f2e20403821a0a1d1a7497b' => 
  array (
    'criteria' => 
    array (
      'name' => 'phpthumbof',
    ),
    'object' => 
    array (
      'name' => 'phpthumbof',
      'path' => '{core_path}components/phpthumbof/',
      'assets_path' => '',
    ),
  ),
  '0f257501b9d21e815c786e81aa13ff59' => 
  array (
    'criteria' => 
    array (
      'name' => 'phpThumbOfCacheManager',
    ),
    'object' => 
    array (
      'id' => 7,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'phpThumbOfCacheManager',
      'description' => 'Handles cache cleaning when clearing the Site Cache.',
      'editor_type' => 0,
      'category' => 0,
      'cache_type' => 0,
      'plugincode' => '/**
 * Handles cache management for phpthumbof filter
 * 
 * @package phpthumbof
 */
if (empty($results)) $results = array();

switch ($modx->event->name) {
    case \'OnSiteRefresh\':
        if (!$modx->loadClass(\'modPhpThumb\',$modx->getOption(\'core_path\').\'model/phpthumb/\',true,true)) {
            $modx->log(modX::LOG_LEVEL_ERROR,\'[phpThumbOf] Could not load modPhpThumb class in plugin.\');
            return;
        }
        $assetsPath = $modx->getOption(\'phpthumbof.assets_path\',$scriptProperties,$modx->getOption(\'assets_path\').\'components/phpthumbof/\');
        $phpThumb = new modPhpThumb($modx);
        $cacheDir = $assetsPath.\'cache/\';

        /* clear local cache */
        if (!empty($cacheDir)) {
            foreach (new DirectoryIterator($cacheDir) as $file) {
                if (!$file->isFile()) continue;
                @unlink($file->getPathname());
            }
        }

        /* if using amazon s3, clear our cache there */
        $useS3 = $modx->getOption(\'phpthumbof.use_s3\',$scriptProperties,false);
        if ($useS3) {
            $modelPath = $modx->getOption(\'phpthumbof.core_path\',null,$modx->getOption(\'core_path\').\'components/phpthumbof/\').\'model/\';
            $modaws = $modx->getService(\'modaws\',\'modAws\',$modelPath.\'aws/\',$scriptProperties);
            $s3path = $modx->getOption(\'phpthumbof.s3_path\',null,\'phpthumbof/\');
            
            $list = $modaws->getObjectList($s3path);
            if (!empty($list) && is_array($list)) {
                foreach ($list as $obj) {
                    if (empty($obj->Key)) continue;

                    $results[] = $modaws->deleteObject($obj->Key);
                }
            }
        }

        break;
}
return;',
      'locked' => 0,
      'properties' => NULL,
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Handles cache management for phpthumbof filter
 * 
 * @package phpthumbof
 */
if (empty($results)) $results = array();

switch ($modx->event->name) {
    case \'OnSiteRefresh\':
        if (!$modx->loadClass(\'modPhpThumb\',$modx->getOption(\'core_path\').\'model/phpthumb/\',true,true)) {
            $modx->log(modX::LOG_LEVEL_ERROR,\'[phpThumbOf] Could not load modPhpThumb class in plugin.\');
            return;
        }
        $assetsPath = $modx->getOption(\'phpthumbof.assets_path\',$scriptProperties,$modx->getOption(\'assets_path\').\'components/phpthumbof/\');
        $phpThumb = new modPhpThumb($modx);
        $cacheDir = $assetsPath.\'cache/\';

        /* clear local cache */
        if (!empty($cacheDir)) {
            foreach (new DirectoryIterator($cacheDir) as $file) {
                if (!$file->isFile()) continue;
                @unlink($file->getPathname());
            }
        }

        /* if using amazon s3, clear our cache there */
        $useS3 = $modx->getOption(\'phpthumbof.use_s3\',$scriptProperties,false);
        if ($useS3) {
            $modelPath = $modx->getOption(\'phpthumbof.core_path\',null,$modx->getOption(\'core_path\').\'components/phpthumbof/\').\'model/\';
            $modaws = $modx->getService(\'modaws\',\'modAws\',$modelPath.\'aws/\',$scriptProperties);
            $s3path = $modx->getOption(\'phpthumbof.s3_path\',null,\'phpthumbof/\');
            
            $list = $modaws->getObjectList($s3path);
            if (!empty($list) && is_array($list)) {
                foreach ($list as $obj) {
                    if (empty($obj->Key)) continue;

                    $results[] = $modaws->deleteObject($obj->Key);
                }
            }
        }

        break;
}
return;',
    ),
  ),
  'a50624ced27c6ff758296a9c2f04610d' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 7,
      'event' => 'OnSiteRefresh',
    ),
    'object' => 
    array (
      'pluginid' => 7,
      'event' => 'OnSiteRefresh',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '7b8973e12472856190ea0da40648d2ac' => 
  array (
    'criteria' => 
    array (
      'name' => 'phpthumbof',
    ),
    'object' => 
    array (
      'id' => 36,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'phpthumbof',
      'description' => 'A custom output filter that generates thumbnails securely with phpThumb.',
      'editor_type' => 0,
      'category' => 0,
      'cache_type' => 0,
      'snippet' => '/**
 * phpThumbOf
 *
 * Copyright 2009-2011 by Shaun McCormick <shaun@modx.com>
 *
 * phpThumbOf is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * phpThumbOf is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * phpThumbOf; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package phpthumbof
 */
/**
 * A custom output filter for phpThumb
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @var phpThumbOf $phpThumbOf
 * @var string $input
 * @var string|array $options
 *
 * @package phpthumbof
 */
if (empty($modx)) return \'\';
if (!$modx->loadClass(\'modPhpThumb\',$modx->getOption(\'core_path\').\'model/phpthumb/\',true,true)) {
    $modx->log(modX::LOG_LEVEL_ERROR,\'[phpThumbOf] Could not load modPhpThumb class.\');
    return \'\';
}
if (empty($input)) {
    $modx->log(modX::LOG_LEVEL_DEBUG,\'[phpThumbOf] Empty image path passed, aborting.\');
    return \'\';
}
$modelPath = $modx->getOption(\'phpthumbof.core_path\',null,$modx->getOption(\'core_path\').\'components/phpthumbof/\').\'model/\';
require_once $modelPath.\'phpthumbof/phpthumbof.class.php\';
$phpThumbOf = new phpThumbOf($modx,$scriptProperties);

$phpThumbOf->getCacheDirectory();
$phpThumbOf->ensureCacheDirectoryIsWritable();

$thumbnail = $phpThumbOf->createThumbnailObject();
$thumbnail->setInput($input);
$thumbnail->setOptions($options);
$thumbnail->initializeService();
return $thumbnail->render();',
      'locked' => 0,
      'properties' => NULL,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * phpThumbOf
 *
 * Copyright 2009-2011 by Shaun McCormick <shaun@modx.com>
 *
 * phpThumbOf is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * phpThumbOf is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * phpThumbOf; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package phpthumbof
 */
/**
 * A custom output filter for phpThumb
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @var phpThumbOf $phpThumbOf
 * @var string $input
 * @var string|array $options
 *
 * @package phpthumbof
 */
if (empty($modx)) return \'\';
if (!$modx->loadClass(\'modPhpThumb\',$modx->getOption(\'core_path\').\'model/phpthumb/\',true,true)) {
    $modx->log(modX::LOG_LEVEL_ERROR,\'[phpThumbOf] Could not load modPhpThumb class.\');
    return \'\';
}
if (empty($input)) {
    $modx->log(modX::LOG_LEVEL_DEBUG,\'[phpThumbOf] Empty image path passed, aborting.\');
    return \'\';
}
$modelPath = $modx->getOption(\'phpthumbof.core_path\',null,$modx->getOption(\'core_path\').\'components/phpthumbof/\').\'model/\';
require_once $modelPath.\'phpthumbof/phpthumbof.class.php\';
$phpThumbOf = new phpThumbOf($modx,$scriptProperties);

$phpThumbOf->getCacheDirectory();
$phpThumbOf->ensureCacheDirectoryIsWritable();

$thumbnail = $phpThumbOf->createThumbnailObject();
$thumbnail->setInput($input);
$thumbnail->setOptions($options);
$thumbnail->initializeService();
return $thumbnail->render();',
    ),
    'files' => 
    array (
      0 => '/home/oojo/dev.galaxytvonline.com/assets/components',
    ),
  ),
  '46a9dd70fdd58595117e0b8f909c6d8a' => 
  array (
    'criteria' => 
    array (
      'key' => 'phpthumbof.cache_path',
    ),
    'object' => 
    array (
      'key' => 'phpthumbof.cache_path',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'phpthumbof',
      'area' => 'paths',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '6b77318db5e97f1bc492ddc54f36d025' => 
  array (
    'criteria' => 
    array (
      'key' => 'phpthumbof.cache_url',
    ),
    'object' => 
    array (
      'key' => 'phpthumbof.cache_url',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'phpthumbof',
      'area' => 'paths',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '2f556c6363b5546e09016b846717b2c4' => 
  array (
    'criteria' => 
    array (
      'key' => 'phpthumbof.use_s3',
    ),
    'object' => 
    array (
      'key' => 'phpthumbof.use_s3',
      'value' => '',
      'xtype' => 'combo-boolean',
      'namespace' => 'phpthumbof',
      'area' => 's3',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '308211194f9d574941974446baf3df80' => 
  array (
    'criteria' => 
    array (
      'key' => 'phpthumbof.s3_key',
    ),
    'object' => 
    array (
      'key' => 'phpthumbof.s3_key',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'phpthumbof',
      'area' => 's3',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '0640c46b31c8b650ff4eb514cc54a43d' => 
  array (
    'criteria' => 
    array (
      'key' => 'phpthumbof.s3_secret_key',
    ),
    'object' => 
    array (
      'key' => 'phpthumbof.s3_secret_key',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'phpthumbof',
      'area' => 's3',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '80e31c96971ce7bb7653657dfb8e322b' => 
  array (
    'criteria' => 
    array (
      'key' => 'phpthumbof.s3_bucket',
    ),
    'object' => 
    array (
      'key' => 'phpthumbof.s3_bucket',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'phpthumbof',
      'area' => 's3',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'c3d35e2cfd17dbe6ddef6546a6174634' => 
  array (
    'criteria' => 
    array (
      'key' => 'phpthumbof.s3_host_alias',
    ),
    'object' => 
    array (
      'key' => 'phpthumbof.s3_host_alias',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'phpthumbof',
      'area' => 's3',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '2f1173c508704fef4176f962944a2166' => 
  array (
    'criteria' => 
    array (
      'key' => 'phpthumbof.s3_path',
    ),
    'object' => 
    array (
      'key' => 'phpthumbof.s3_path',
      'value' => 'phpthumbof/',
      'xtype' => 'textfield',
      'namespace' => 'phpthumbof',
      'area' => 's3',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '14af3079c21b9dac1ad1b7ada853787a' => 
  array (
    'criteria' => 
    array (
      'key' => 'phpthumbof.s3_cache_time',
    ),
    'object' => 
    array (
      'key' => 'phpthumbof.s3_cache_time',
      'value' => '24',
      'xtype' => 'textfield',
      'namespace' => 'phpthumbof',
      'area' => 's3',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '3c059f90e9bf0566c2b22b363686209a' => 
  array (
    'criteria' => 
    array (
      'key' => 'phpthumbof.s3_headers_check',
    ),
    'object' => 
    array (
      'key' => 'phpthumbof.s3_headers_check',
      'value' => '',
      'xtype' => 'combo-boolean',
      'namespace' => 'phpthumbof',
      'area' => 's3',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
);