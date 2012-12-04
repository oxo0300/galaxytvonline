<?php return array (
  'd5f2753c3f387e81939b5768bde8593c' => 
  array (
    'criteria' => 
    array (
      'name' => 'gallery',
    ),
    'object' => 
    array (
      'name' => 'gallery',
      'path' => '{core_path}components/gallery/',
      'assets_path' => NULL,
    ),
  ),
  '568b89d0575b27699a7901bf2c9a619f' => 
  array (
    'criteria' => 
    array (
      'name' => 'GalleryCustomTV',
    ),
    'object' => 
    array (
      'id' => 4,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'GalleryCustomTV',
      'description' => '',
      'editor_type' => 0,
      'category' => 0,
      'cache_type' => 0,
      'plugincode' => '/**
 * Handles plugin events for Gallery\'s Custom TV
 * 
 * @package gallery
 */
$corePath = $modx->getOption(\'gallery.core_path\',null,$modx->getOption(\'core_path\').\'components/gallery/\');
switch ($modx->event->name) {
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath.\'elements/tv/input/\');
        break;
    case \'OnTVOutputRenderList\':
        $modx->event->output($corePath.\'elements/tv/output/\');
        break;
    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath.\'elements/tv/inputoptions/\');
        break;
    case \'OnTVOutputRenderPropertiesList\':
        $modx->event->output($corePath.\'elements/tv/properties/\');
        break;
    case \'OnManagerPageBeforeRender\':
        $gallery = $modx->getService(\'gallery\',\'Gallery\',$modx->getOption(\'gallery.core_path\',null,$modx->getOption(\'core_path\').\'components/gallery/\').\'model/gallery/\',$scriptProperties);
        if (!($gallery instanceof Gallery)) return \'\';

        $snippetIds = \'\';
        $gallerySnippet = $modx->getObject(\'modSnippet\',array(\'name\' => \'Gallery\'));
        if ($gallerySnippet) {
            $snippetIds .= \'GAL.snippetGallery = "\'.$gallerySnippet->get(\'id\').\'";\'."\\n";
        }
        $galleryItemSnippet = $modx->getObject(\'modSnippet\',array(\'name\' => \'GalleryItem\'));
        if ($galleryItemSnippet) {
            $snippetIds .= \'GAL.snippetGalleryItem = "\'.$galleryItemSnippet->get(\'id\').\'";\'."\\n";
        }

        $jsDir = $modx->getOption(\'gallery.assets_url\',null,$modx->getOption(\'assets_url\').\'components/gallery/\').\'js/mgr/\';
        $modx->controller->addLexiconTopic(\'gallery:default\');
        $modx->controller->addJavascript($jsDir.\'gallery.js\');
        $modx->controller->addJavascript($jsDir.\'tree.js\');
        $modx->controller->addHtml(\'<script type="text/javascript">
        Ext.onReady(function() {
            GAL.config.connector_url = "\'.$gallery->config[\'connectorUrl\'].\'";
            \'.$snippetIds.\'
        });
        </script>\');
        break;
    case \'OnDocFormPrerender\':
        $gallery = $modx->getService(\'gallery\',\'Gallery\',$modx->getOption(\'gallery.core_path\',null,$modx->getOption(\'core_path\').\'components/gallery/\').\'model/gallery/\',$scriptProperties);
        if (!($gallery instanceof Gallery)) return \'\';

        /* assign gallery lang to JS */
        $modx->controller->addLexiconTopic(\'gallery:tv\');

        /* @var modAction $action */
        $action = $modx->getObject(\'modAction\',array(
            \'namespace\' => \'gallery\',
            \'controller\' => \'index\',
        ));
        $modx->controller->addHtml(\'<script type="text/javascript">
        Ext.onReady(function() {
            GAL.config = {};
            GAL.config.connector_url = "\'.$gallery->config[\'connectorUrl\'].\'";
            GAL.action = "\'.($action ? $action->get(\'id\') : 0).\'";
        });
        </script>\');
        $modx->controller->addJavascript($gallery->config[\'assetsUrl\'].\'js/mgr/tv/Spotlight.js\');
        $modx->controller->addJavascript($gallery->config[\'assetsUrl\'].\'js/mgr/gallery.js\');
        $modx->controller->addJavascript($gallery->config[\'assetsUrl\'].\'js/mgr/widgets/album/album.items.view.js\');
        $modx->controller->addJavascript($gallery->config[\'assetsUrl\'].\'js/mgr/widgets/album/album.tree.js\');
        $modx->controller->addJavascript($gallery->config[\'assetsUrl\'].\'js/mgr/tv/gal.browser.js\');
        $modx->controller->addJavascript($gallery->config[\'assetsUrl\'].\'js/mgr/tv/galtv.js\');
        $modx->controller->addCss($gallery->config[\'cssUrl\'].\'mgr.css\');
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
 * Handles plugin events for Gallery\'s Custom TV
 * 
 * @package gallery
 */
$corePath = $modx->getOption(\'gallery.core_path\',null,$modx->getOption(\'core_path\').\'components/gallery/\');
switch ($modx->event->name) {
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath.\'elements/tv/input/\');
        break;
    case \'OnTVOutputRenderList\':
        $modx->event->output($corePath.\'elements/tv/output/\');
        break;
    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath.\'elements/tv/inputoptions/\');
        break;
    case \'OnTVOutputRenderPropertiesList\':
        $modx->event->output($corePath.\'elements/tv/properties/\');
        break;
    case \'OnManagerPageBeforeRender\':
        $gallery = $modx->getService(\'gallery\',\'Gallery\',$modx->getOption(\'gallery.core_path\',null,$modx->getOption(\'core_path\').\'components/gallery/\').\'model/gallery/\',$scriptProperties);
        if (!($gallery instanceof Gallery)) return \'\';

        $snippetIds = \'\';
        $gallerySnippet = $modx->getObject(\'modSnippet\',array(\'name\' => \'Gallery\'));
        if ($gallerySnippet) {
            $snippetIds .= \'GAL.snippetGallery = "\'.$gallerySnippet->get(\'id\').\'";\'."\\n";
        }
        $galleryItemSnippet = $modx->getObject(\'modSnippet\',array(\'name\' => \'GalleryItem\'));
        if ($galleryItemSnippet) {
            $snippetIds .= \'GAL.snippetGalleryItem = "\'.$galleryItemSnippet->get(\'id\').\'";\'."\\n";
        }

        $jsDir = $modx->getOption(\'gallery.assets_url\',null,$modx->getOption(\'assets_url\').\'components/gallery/\').\'js/mgr/\';
        $modx->controller->addLexiconTopic(\'gallery:default\');
        $modx->controller->addJavascript($jsDir.\'gallery.js\');
        $modx->controller->addJavascript($jsDir.\'tree.js\');
        $modx->controller->addHtml(\'<script type="text/javascript">
        Ext.onReady(function() {
            GAL.config.connector_url = "\'.$gallery->config[\'connectorUrl\'].\'";
            \'.$snippetIds.\'
        });
        </script>\');
        break;
    case \'OnDocFormPrerender\':
        $gallery = $modx->getService(\'gallery\',\'Gallery\',$modx->getOption(\'gallery.core_path\',null,$modx->getOption(\'core_path\').\'components/gallery/\').\'model/gallery/\',$scriptProperties);
        if (!($gallery instanceof Gallery)) return \'\';

        /* assign gallery lang to JS */
        $modx->controller->addLexiconTopic(\'gallery:tv\');

        /* @var modAction $action */
        $action = $modx->getObject(\'modAction\',array(
            \'namespace\' => \'gallery\',
            \'controller\' => \'index\',
        ));
        $modx->controller->addHtml(\'<script type="text/javascript">
        Ext.onReady(function() {
            GAL.config = {};
            GAL.config.connector_url = "\'.$gallery->config[\'connectorUrl\'].\'";
            GAL.action = "\'.($action ? $action->get(\'id\') : 0).\'";
        });
        </script>\');
        $modx->controller->addJavascript($gallery->config[\'assetsUrl\'].\'js/mgr/tv/Spotlight.js\');
        $modx->controller->addJavascript($gallery->config[\'assetsUrl\'].\'js/mgr/gallery.js\');
        $modx->controller->addJavascript($gallery->config[\'assetsUrl\'].\'js/mgr/widgets/album/album.items.view.js\');
        $modx->controller->addJavascript($gallery->config[\'assetsUrl\'].\'js/mgr/widgets/album/album.tree.js\');
        $modx->controller->addJavascript($gallery->config[\'assetsUrl\'].\'js/mgr/tv/gal.browser.js\');
        $modx->controller->addJavascript($gallery->config[\'assetsUrl\'].\'js/mgr/tv/galtv.js\');
        $modx->controller->addCss($gallery->config[\'cssUrl\'].\'mgr.css\');
        break;
}
return;',
    ),
  ),
  'da95b3e512a17a794d9f9178e038f30f' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnTVInputRenderList',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnTVInputRenderList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '2020a56db68a39f996a26be9c6768a60' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnTVInputPropertiesList',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnTVInputPropertiesList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'c26dff64e0917c2ba062ef2a20672031' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnTVOutputRenderList',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnTVOutputRenderList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'be011e4908a971e4b6af1fc168e81f2e' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnTVOutputRenderPropertiesList',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnTVOutputRenderPropertiesList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '36262f79cd3768ee5263eac981f12287' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnDocFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnDocFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '2faa6636938c6f4edbb1782ee364a1b1' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 4,
      'event' => 'OnManagerPageBeforeRender',
    ),
    'object' => 
    array (
      'pluginid' => 4,
      'event' => 'OnManagerPageBeforeRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '85622d95d336feea1cb9d5ddefd0cd39' => 
  array (
    'criteria' => 
    array (
      'category' => 'Gallery',
    ),
    'object' => 
    array (
      'id' => 6,
      'parent' => 0,
      'category' => 'Gallery',
    ),
    'files' => 
    array (
      0 => '/home/oojo/dev.galaxytvonline.com/core/components',
    ),
  ),
  '013a2161a13768c56c0cf05bb7bf2d52' => 
  array (
    'criteria' => 
    array (
      'name' => 'galAlbumRowTpl',
    ),
    'object' => 
    array (
      'id' => 2,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'galAlbumRowTpl',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '<li[[+cls:notempty=` class="[[+cls]]"`]]><a href="[[~[[*id]]? &[[+albumRequestVar]]=`[[+id]]`]]">[[+showName:notempty=`[[+name]]`]]</a></li>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<li[[+cls:notempty=` class="[[+cls]]"`]]><a href="[[~[[*id]]? &[[+albumRequestVar]]=`[[+id]]`]]">[[+showName:notempty=`[[+name]]`]]</a></li>',
    ),
  ),
  'b1080d0f8ef557550a4561f1dd510d3c' => 
  array (
    'criteria' => 
    array (
      'name' => 'galItemThumb',
    ),
    'object' => 
    array (
      'id' => 3,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'galItemThumb',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '<div class="[[+cls]]">
    <a href="[[+linkToImage:if=`[[+linkToImage]]`:is=`1`:then=`[[+image_absolute]]`:else=`[[~[[*id]]?
            &[[+imageGetParam]]=`[[+id]]`
            &[[+albumRequestVar]]=`[[+album]]`
            &[[+tagRequestVar]]=`[[+tag]]` ]]`]]" title="[[+name]]" [[+link_attributes]]>

        <img class="[[+imgCls]]" src="[[+thumbnail]]" alt="[[+name]]" [[+image_attributes]] />
    </a>
</div>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<div class="[[+cls]]">
    <a href="[[+linkToImage:if=`[[+linkToImage]]`:is=`1`:then=`[[+image_absolute]]`:else=`[[~[[*id]]?
            &[[+imageGetParam]]=`[[+id]]`
            &[[+albumRequestVar]]=`[[+album]]`
            &[[+tagRequestVar]]=`[[+tag]]` ]]`]]" title="[[+name]]" [[+link_attributes]]>

        <img class="[[+imgCls]]" src="[[+thumbnail]]" alt="[[+name]]" [[+image_attributes]] />
    </a>
</div>',
    ),
  ),
  '821ffe4c673c38f417d2140e20b5757a' => 
  array (
    'criteria' => 
    array (
      'name' => 'Gallery',
    ),
    'object' => 
    array (
      'id' => 14,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'Gallery',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '/**
 * Gallery
 *
 * Copyright 2010-2012 by Shaun McCormick <shaun@modx.com>
 *
 * Gallery is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Gallery is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Gallery; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package gallery
 */
/**
 * The main Gallery snippet.
 *
 * @var modX $modx
 * @var Gallery $gallery
 * 
 * @package gallery
 */
$gallery = $modx->getService(\'gallery\',\'Gallery\',$modx->getOption(\'gallery.core_path\',null,$modx->getOption(\'core_path\').\'components/gallery/\').\'model/gallery/\',$scriptProperties);
if (!($gallery instanceof Gallery)) return \'\';
$modx->lexicon->load(\'gallery:web\');

/* check for REQUEST vars if property set */
$imageGetParam = $modx->getOption(\'imageGetParam\',$scriptProperties,\'galItem\');
$albumRequestVar = $modx->getOption(\'albumRequestVar\',$scriptProperties,\'galAlbum\');
$tagRequestVar = $modx->getOption(\'tagRequestVar\',$scriptProperties,\'galTag\');
if ($modx->getOption(\'checkForRequestAlbumVar\',$scriptProperties,true)) {
    if (!empty($_REQUEST[$albumRequestVar])) $scriptProperties[\'album\'] = $_REQUEST[$albumRequestVar];
}
if ($modx->getOption(\'checkForRequestTagVar\',$scriptProperties,true)) {
    if (!empty($_REQUEST[$tagRequestVar])) $scriptProperties[\'tag\'] = $_REQUEST[$tagRequestVar];
}
if (empty($scriptProperties[\'album\']) && empty($scriptProperties[\'tag\'])) return \'\';

$data = $modx->call(\'galItem\',\'getList\',array(&$modx,$scriptProperties));

/* load plugins */
$plugin = $modx->getOption(\'plugin\',$scriptProperties,\'\');
if (!empty($plugin)) {
    $pluginPath = $modx->getOption(\'pluginPath\',$scriptProperties,\'\');
    if (empty($pluginPath)) {
        $pluginPath = $gallery->config[\'modelPath\'].\'gallery/plugins/\';
    }
    /** @var GalleryPlugin $plugin */
    if (($className = $modx->loadClass($plugin,$pluginPath,true,true))) {
        $plugin = new $className($gallery,$scriptProperties);
        $plugin->load();
        $scriptProperties = $plugin->adjustSettings($scriptProperties);
    } else {
        return $modx->lexicon(\'gallery.plugin_err_load\',array(\'name\' => $plugin,\'path\' => $pluginPath));
    }
} else {
    if ($modx->getOption(\'useCss\',$scriptProperties,true)) {
        $modx->regClientCSS($gallery->config[\'cssUrl\'].\'web.css\');
    }
}

/* iterate */
$imageProperties = $modx->getOption(\'imageProperties\',$scriptProperties,\'\');
$imageProperties = !empty($imageProperties) ? $modx->fromJSON($imageProperties) : array();
$imageProperties = array_merge(array(
    \'w\' => (int)$modx->getOption(\'imageWidth\',$scriptProperties,500),
    \'h\' => (int)$modx->getOption(\'imageHeight\',$scriptProperties,500),
    \'zc\' => (boolean)$modx->getOption(\'imageZoomCrop\',$scriptProperties,0),
    \'far\' => (string)$modx->getOption(\'imageFar\',$scriptProperties,false),
    \'q\' => (int)$modx->getOption(\'imageQuality\',$scriptProperties,90),
),$imageProperties);

$thumbProperties = $modx->getOption(\'thumbProperties\',$scriptProperties,\'\');
$thumbProperties = !empty($thumbProperties) ? $modx->fromJSON($thumbProperties) : array();
$thumbProperties = array_merge(array(
    \'w\' => (int)$modx->getOption(\'thumbWidth\',$scriptProperties,100),
    \'h\' => (int)$modx->getOption(\'thumbHeight\',$scriptProperties,100),
    \'zc\' => (boolean)$modx->getOption(\'thumbZoomCrop\',$scriptProperties,1),
    \'far\' => (string)$modx->getOption(\'thumbFar\',$scriptProperties,\'C\'),
    \'q\' => (int)$modx->getOption(\'thumbQuality\',$scriptProperties,90),
),$thumbProperties);

$idx = 0;
$output = array();
$filesUrl = $modx->call(\'galAlbum\',\'getFilesUrl\',array(&$modx));
$filesPath = $modx->call(\'galAlbum\',\'getFilesPath\',array(&$modx));
$itemCls = $modx->getOption(\'itemCls\',$scriptProperties,\'gal-item\');
$imageAttributes = $modx->getOption(\'imageAttributes\',$scriptProperties,\'\');
$linkAttributes = $modx->getOption(\'linkAttributes\',$scriptProperties,\'\');
$linkToImage = $modx->getOption(\'linkToImage\',$scriptProperties,false);
$activeCls = $modx->getOption(\'activeCls\',$scriptProperties,\'gal-item-active\');
$highlightItem = $modx->getOption($imageGetParam,$_REQUEST,false);
/** @var galItem $item */
foreach ($data[\'items\'] as $item) {
    $itemArray = $item->toArray();
    $itemArray[\'idx\'] = $idx;
    $itemArray[\'cls\'] = $itemCls;
    if ($itemArray[\'id\'] == $highlightItem) {
        $itemArray[\'cls\'] .= \' \'.$activeCls;
    }
    $itemArray[\'filename\'] = basename($item->get(\'filename\'));
    $itemArray[\'image_absolute\'] = $filesUrl.$item->get(\'filename\');
    $itemArray[\'fileurl\'] = $itemArray[\'image_absolute\'];
    $itemArray[\'filepath\'] = $filesPath.$item->get(\'filename\');
    $itemArray[\'filesize\'] = $item->get(\'filesize\');
    $itemArray[\'thumbnail\'] = $item->get(\'thumbnail\',$thumbProperties);
    $itemArray[\'image\'] = $item->get(\'thumbnail\',$imageProperties);
    $itemArray[\'image_attributes\'] = $imageAttributes;
    $itemArray[\'link_attributes\'] = $linkAttributes;
    if (!empty($scriptProperties[\'album\'])) $itemArray[\'album\'] = $scriptProperties[\'album\'];
    if (!empty($scriptProperties[\'tag\'])) $itemArray[\'tag\'] = $scriptProperties[\'tag\'];
    $itemArray[\'linkToImage\'] = $linkToImage;
    $itemArray[\'url\'] = $item->get(\'url\');
    $itemArray[\'imageGetParam\'] = $imageGetParam;
    $itemArray[\'albumRequestVar\'] = $albumRequestVar;
    $itemArray[\'tagRequestVar\'] = $tagRequestVar;
    $itemArray[\'tag\'] = \'\';
    if ($plugin) {
        $plugin->renderItem($itemArray);
    }

    $output[] = $gallery->getChunk($modx->getOption(\'thumbTpl\',$scriptProperties,\'galItemThumb\'),$itemArray);
    $idx++;
}
$output = implode("\\n",$output);

/* if set, place in a container tpl */
$containerTpl = $modx->getOption(\'containerTpl\',$scriptProperties,false);
if (!empty($containerTpl)) {
    $ct = $gallery->getChunk($containerTpl,array(
        \'thumbnails\' => $output,
        \'album_name\' => $data[\'album\'][\'name\'],
        \'album_description\' => $data[\'album\'][\'description\'],
        \'albumRequestVar\' => $albumRequestVar,
        \'albumId\' => $data[\'album\'][\'id\'],
    ));
    if (!empty($ct)) $output = $ct;
}

/* set to placeholders or output directly */
$toPlaceholder = $modx->getOption(\'toPlaceholder\',$scriptProperties,false);
if (!empty($toPlaceholder)) {
    $modx->toPlaceholders(array(
        $toPlaceholder => $output,
        $toPlaceholder.\'.id\' => $data[\'album\'][\'id\'],
        $toPlaceholder.\'.name\' => $data[\'album\'][\'name\'],
        $toPlaceholder.\'.description\' => $data[\'album\'][\'description\'],
        $toPlaceholder.\'.total\' => $data[\'total\'],
    ));
} else {
    $placeholderPrefix = $modx->getOption(\'placeholderPrefix\',$scriptProperties,\'gallery.\');
    $modx->toPlaceholders(array(
        $placeholderPrefix.\'id\' => $data[\'album\'][\'id\'],
        $placeholderPrefix.\'name\' => $data[\'album\'][\'name\'],
        $placeholderPrefix.\'description\' => $data[\'album\'][\'description\'],
        $placeholderPrefix.\'total\' => $data[\'total\'],
    ));
    return $output;
}
return \'\';',
      'locked' => 0,
      'properties' => 'a:32:{s:5:"album";a:7:{s:4:"name";s:5:"album";s:4:"desc";s:18:"gallery.album_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:3:"tag";a:7:{s:4:"name";s:3:"tag";s:4:"desc";s:16:"gallery.tag_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:6:"plugin";a:7:{s:4:"name";s:6:"plugin";s:4:"desc";s:19:"gallery.plugin_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:10:"pluginPath";a:7:{s:4:"name";s:10:"pluginPath";s:4:"desc";s:23:"gallery.pluginpath_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:8:"thumbTpl";a:7:{s:4:"name";s:8:"thumbTpl";s:4:"desc";s:21:"gallery.thumbtpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:12:"galItemThumb";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:12:"containerTpl";a:7:{s:4:"name";s:12:"containerTpl";s:4:"desc";s:25:"gallery.containertpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:7:"itemCls";a:7:{s:4:"name";s:7:"itemCls";s:4:"desc";s:22:"gallery.activecls_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:15:"gal-item-active";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:13:"toPlaceholder";a:7:{s:4:"name";s:13:"toPlaceholder";s:4:"desc";s:26:"gallery.toplaceholder_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:10:"thumbWidth";a:7:{s:4:"name";s:10:"thumbWidth";s:4:"desc";s:23:"gallery.thumbwidth_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:3:"100";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:11:"thumbHeight";a:7:{s:4:"name";s:11:"thumbHeight";s:4:"desc";s:24:"gallery.thumbheight_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:3:"100";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:13:"thumbZoomCrop";a:7:{s:4:"name";s:13:"thumbZoomCrop";s:4:"desc";s:26:"gallery.thumbzoomcrop_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:8:"thumbFar";a:7:{s:4:"name";s:8:"thumbFar";s:4:"desc";s:21:"gallery.thumbfar_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:1:"C";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:12:"thumbQuality";a:7:{s:4:"name";s:12:"thumbQuality";s:4:"desc";s:25:"gallery.thumbquality_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:90;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:15:"thumbProperties";a:7:{s:4:"name";s:15:"thumbProperties";s:4:"desc";s:28:"gallery.thumbproperties_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:11:"linkToImage";a:7:{s:4:"name";s:11:"linkToImage";s:4:"desc";s:24:"gallery.linktoimage_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:13:"imageGetParam";a:7:{s:4:"name";s:13:"imageGetParam";s:4:"desc";s:26:"gallery.imagegetparam_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:7:"galItem";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:10:"imageWidth";a:7:{s:4:"name";s:10:"imageWidth";s:4:"desc";s:23:"gallery.imagewidth_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:500;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:11:"imageHeight";a:7:{s:4:"name";s:11:"imageHeight";s:4:"desc";s:24:"gallery.imageheight_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:500;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:13:"imageZoomCrop";a:7:{s:4:"name";s:13:"imageZoomCrop";s:4:"desc";s:26:"gallery.imagezoomcrop_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:0;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:8:"imageFar";a:7:{s:4:"name";s:8:"imageFar";s:4:"desc";s:21:"gallery.imagefar_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:12:"imageQuality";a:7:{s:4:"name";s:12:"imageQuality";s:4:"desc";s:25:"gallery.imagequality_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:90;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:15:"imageProperties";a:7:{s:4:"name";s:15:"imageProperties";s:4:"desc";s:28:"gallery.imageproperties_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:4:"sort";a:7:{s:4:"name";s:4:"sort";s:4:"desc";s:17:"gallery.sort_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:4:"rank";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:3:"dir";a:7:{s:4:"name";s:3:"dir";s:4:"desc";s:16:"gallery.dir_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:3:"ASC";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:5:"limit";a:7:{s:4:"name";s:5:"limit";s:4:"desc";s:18:"gallery.limit_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:0;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:5:"start";a:7:{s:4:"name";s:5:"start";s:4:"desc";s:18:"gallery.start_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:0;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:12:"showInactive";a:7:{s:4:"name";s:12:"showInactive";s:4:"desc";s:25:"gallery.showinactive_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:0;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:23:"checkForRequestAlbumVar";a:7:{s:4:"name";s:23:"checkForRequestAlbumVar";s:4:"desc";s:36:"gallery.checkforrequestalbumvar_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:15:"albumRequestVar";a:7:{s:4:"name";s:15:"albumRequestVar";s:4:"desc";s:28:"gallery.albumrequestvar_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:8:"galAlbum";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:21:"checkForRequestTagVar";a:7:{s:4:"name";s:21:"checkForRequestTagVar";s:4:"desc";s:34:"gallery.checkforrequesttagvar_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:13:"tagRequestVar";a:7:{s:4:"name";s:13:"tagRequestVar";s:4:"desc";s:26:"gallery.tagrequestvar_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:6:"galTag";s:7:"lexicon";N;s:4:"area";s:0:"";}s:6:"useCss";a:7:{s:4:"name";s:6:"useCss";s:4:"desc";s:19:"gallery.usecss_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Gallery
 *
 * Copyright 2010-2012 by Shaun McCormick <shaun@modx.com>
 *
 * Gallery is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Gallery is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Gallery; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package gallery
 */
/**
 * The main Gallery snippet.
 *
 * @var modX $modx
 * @var Gallery $gallery
 * 
 * @package gallery
 */
$gallery = $modx->getService(\'gallery\',\'Gallery\',$modx->getOption(\'gallery.core_path\',null,$modx->getOption(\'core_path\').\'components/gallery/\').\'model/gallery/\',$scriptProperties);
if (!($gallery instanceof Gallery)) return \'\';
$modx->lexicon->load(\'gallery:web\');

/* check for REQUEST vars if property set */
$imageGetParam = $modx->getOption(\'imageGetParam\',$scriptProperties,\'galItem\');
$albumRequestVar = $modx->getOption(\'albumRequestVar\',$scriptProperties,\'galAlbum\');
$tagRequestVar = $modx->getOption(\'tagRequestVar\',$scriptProperties,\'galTag\');
if ($modx->getOption(\'checkForRequestAlbumVar\',$scriptProperties,true)) {
    if (!empty($_REQUEST[$albumRequestVar])) $scriptProperties[\'album\'] = $_REQUEST[$albumRequestVar];
}
if ($modx->getOption(\'checkForRequestTagVar\',$scriptProperties,true)) {
    if (!empty($_REQUEST[$tagRequestVar])) $scriptProperties[\'tag\'] = $_REQUEST[$tagRequestVar];
}
if (empty($scriptProperties[\'album\']) && empty($scriptProperties[\'tag\'])) return \'\';

$data = $modx->call(\'galItem\',\'getList\',array(&$modx,$scriptProperties));

/* load plugins */
$plugin = $modx->getOption(\'plugin\',$scriptProperties,\'\');
if (!empty($plugin)) {
    $pluginPath = $modx->getOption(\'pluginPath\',$scriptProperties,\'\');
    if (empty($pluginPath)) {
        $pluginPath = $gallery->config[\'modelPath\'].\'gallery/plugins/\';
    }
    /** @var GalleryPlugin $plugin */
    if (($className = $modx->loadClass($plugin,$pluginPath,true,true))) {
        $plugin = new $className($gallery,$scriptProperties);
        $plugin->load();
        $scriptProperties = $plugin->adjustSettings($scriptProperties);
    } else {
        return $modx->lexicon(\'gallery.plugin_err_load\',array(\'name\' => $plugin,\'path\' => $pluginPath));
    }
} else {
    if ($modx->getOption(\'useCss\',$scriptProperties,true)) {
        $modx->regClientCSS($gallery->config[\'cssUrl\'].\'web.css\');
    }
}

/* iterate */
$imageProperties = $modx->getOption(\'imageProperties\',$scriptProperties,\'\');
$imageProperties = !empty($imageProperties) ? $modx->fromJSON($imageProperties) : array();
$imageProperties = array_merge(array(
    \'w\' => (int)$modx->getOption(\'imageWidth\',$scriptProperties,500),
    \'h\' => (int)$modx->getOption(\'imageHeight\',$scriptProperties,500),
    \'zc\' => (boolean)$modx->getOption(\'imageZoomCrop\',$scriptProperties,0),
    \'far\' => (string)$modx->getOption(\'imageFar\',$scriptProperties,false),
    \'q\' => (int)$modx->getOption(\'imageQuality\',$scriptProperties,90),
),$imageProperties);

$thumbProperties = $modx->getOption(\'thumbProperties\',$scriptProperties,\'\');
$thumbProperties = !empty($thumbProperties) ? $modx->fromJSON($thumbProperties) : array();
$thumbProperties = array_merge(array(
    \'w\' => (int)$modx->getOption(\'thumbWidth\',$scriptProperties,100),
    \'h\' => (int)$modx->getOption(\'thumbHeight\',$scriptProperties,100),
    \'zc\' => (boolean)$modx->getOption(\'thumbZoomCrop\',$scriptProperties,1),
    \'far\' => (string)$modx->getOption(\'thumbFar\',$scriptProperties,\'C\'),
    \'q\' => (int)$modx->getOption(\'thumbQuality\',$scriptProperties,90),
),$thumbProperties);

$idx = 0;
$output = array();
$filesUrl = $modx->call(\'galAlbum\',\'getFilesUrl\',array(&$modx));
$filesPath = $modx->call(\'galAlbum\',\'getFilesPath\',array(&$modx));
$itemCls = $modx->getOption(\'itemCls\',$scriptProperties,\'gal-item\');
$imageAttributes = $modx->getOption(\'imageAttributes\',$scriptProperties,\'\');
$linkAttributes = $modx->getOption(\'linkAttributes\',$scriptProperties,\'\');
$linkToImage = $modx->getOption(\'linkToImage\',$scriptProperties,false);
$activeCls = $modx->getOption(\'activeCls\',$scriptProperties,\'gal-item-active\');
$highlightItem = $modx->getOption($imageGetParam,$_REQUEST,false);
/** @var galItem $item */
foreach ($data[\'items\'] as $item) {
    $itemArray = $item->toArray();
    $itemArray[\'idx\'] = $idx;
    $itemArray[\'cls\'] = $itemCls;
    if ($itemArray[\'id\'] == $highlightItem) {
        $itemArray[\'cls\'] .= \' \'.$activeCls;
    }
    $itemArray[\'filename\'] = basename($item->get(\'filename\'));
    $itemArray[\'image_absolute\'] = $filesUrl.$item->get(\'filename\');
    $itemArray[\'fileurl\'] = $itemArray[\'image_absolute\'];
    $itemArray[\'filepath\'] = $filesPath.$item->get(\'filename\');
    $itemArray[\'filesize\'] = $item->get(\'filesize\');
    $itemArray[\'thumbnail\'] = $item->get(\'thumbnail\',$thumbProperties);
    $itemArray[\'image\'] = $item->get(\'thumbnail\',$imageProperties);
    $itemArray[\'image_attributes\'] = $imageAttributes;
    $itemArray[\'link_attributes\'] = $linkAttributes;
    if (!empty($scriptProperties[\'album\'])) $itemArray[\'album\'] = $scriptProperties[\'album\'];
    if (!empty($scriptProperties[\'tag\'])) $itemArray[\'tag\'] = $scriptProperties[\'tag\'];
    $itemArray[\'linkToImage\'] = $linkToImage;
    $itemArray[\'url\'] = $item->get(\'url\');
    $itemArray[\'imageGetParam\'] = $imageGetParam;
    $itemArray[\'albumRequestVar\'] = $albumRequestVar;
    $itemArray[\'tagRequestVar\'] = $tagRequestVar;
    $itemArray[\'tag\'] = \'\';
    if ($plugin) {
        $plugin->renderItem($itemArray);
    }

    $output[] = $gallery->getChunk($modx->getOption(\'thumbTpl\',$scriptProperties,\'galItemThumb\'),$itemArray);
    $idx++;
}
$output = implode("\\n",$output);

/* if set, place in a container tpl */
$containerTpl = $modx->getOption(\'containerTpl\',$scriptProperties,false);
if (!empty($containerTpl)) {
    $ct = $gallery->getChunk($containerTpl,array(
        \'thumbnails\' => $output,
        \'album_name\' => $data[\'album\'][\'name\'],
        \'album_description\' => $data[\'album\'][\'description\'],
        \'albumRequestVar\' => $albumRequestVar,
        \'albumId\' => $data[\'album\'][\'id\'],
    ));
    if (!empty($ct)) $output = $ct;
}

/* set to placeholders or output directly */
$toPlaceholder = $modx->getOption(\'toPlaceholder\',$scriptProperties,false);
if (!empty($toPlaceholder)) {
    $modx->toPlaceholders(array(
        $toPlaceholder => $output,
        $toPlaceholder.\'.id\' => $data[\'album\'][\'id\'],
        $toPlaceholder.\'.name\' => $data[\'album\'][\'name\'],
        $toPlaceholder.\'.description\' => $data[\'album\'][\'description\'],
        $toPlaceholder.\'.total\' => $data[\'total\'],
    ));
} else {
    $placeholderPrefix = $modx->getOption(\'placeholderPrefix\',$scriptProperties,\'gallery.\');
    $modx->toPlaceholders(array(
        $placeholderPrefix.\'id\' => $data[\'album\'][\'id\'],
        $placeholderPrefix.\'name\' => $data[\'album\'][\'name\'],
        $placeholderPrefix.\'description\' => $data[\'album\'][\'description\'],
        $placeholderPrefix.\'total\' => $data[\'total\'],
    ));
    return $output;
}
return \'\';',
    ),
  ),
  '79cd8a2eb78267ecb49e5c2ccaa63e06' => 
  array (
    'criteria' => 
    array (
      'name' => 'GalleryAlbums',
    ),
    'object' => 
    array (
      'id' => 15,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'GalleryAlbums',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '/**
 * Gallery
 *
 * Copyright 2010-2012 by Shaun McCormick <shaun@modx.com>
 *
 * Gallery is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Gallery is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Gallery; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package gallery
 */
/**
 * Loads a list of Albums
 *
 * @var modX $modx
 * @var Gallery $gallery
 * @package gallery
 */
$gallery = $modx->getService(\'gallery\',\'Gallery\',$modx->getOption(\'gallery.core_path\',null,$modx->getOption(\'core_path\').\'components/gallery/\').\'model/gallery/\',$scriptProperties);
if (!($gallery instanceof Gallery)) return \'\';

/* setup default properties */
$rowTpl = $modx->getOption(\'rowTpl\',$scriptProperties,\'galAlbumRowTpl\');
$rowCls = $modx->getOption(\'rowCls\',$scriptProperties,\'\');
$toPlaceholder = $modx->getOption(\'toPlaceholder\',$scriptProperties,false);
$showAll = $modx->getOption(\'showAll\',$scriptProperties,false);
$albumRequestVar = $modx->getOption(\'albumRequestVar\',$scriptProperties,\'galAlbum\');
$albumCoverSort = $modx->getOption(\'albumCoverSort\',$scriptProperties,\'rank\');
$albumCoverSortDir = $modx->getOption(\'albumCoverSortDir\',$scriptProperties,\'ASC\');
$showName = $modx->getOption(\'showName\',$scriptProperties,true);

/* build query */
$albums = $modx->call(\'galAlbum\',\'getList\',array(&$modx,$scriptProperties));

/* handle sorting for album cover */
if ($albumCoverSort == \'rank\') {
    $albumCoverSort = \'AlbumItems.rank\';
}
if (in_array(strtolower($albumCoverSort),array(\'random\',\'rand()\',\'rand\'))) {
    $albumCoverSort = \'RAND()\';
    $albumCoverSortDir = \'\';
}

/* get thumb properties for album cover */
$thumbProperties = $modx->getOption(\'thumbProperties\',$scriptProperties,\'\');
$thumbProperties = !empty($thumbProperties) ? $modx->fromJSON($thumbProperties) : array();
$thumbProperties = array_merge(array(
    \'w\' => (int)$modx->getOption(\'thumbWidth\',$scriptProperties,100),
    \'h\' => (int)$modx->getOption(\'thumbHeight\',$scriptProperties,100),
    \'zc\' => (boolean)$modx->getOption(\'thumbZoomCrop\',$scriptProperties,1),
    \'far\' => (string)$modx->getOption(\'thumbFar\',$scriptProperties,\'C\'),
    \'q\' => (int)$modx->getOption(\'thumbQuality\',$scriptProperties,90),
),$thumbProperties);

/* iterate */
$output = array();
$idx = 0;
/** @var galAlbum $album */
foreach ($albums as $album) {
    $albumArray = $album->toArray();

    $coverItem = $album->getCoverItem($albumCoverSort,$albumCoverSortDir);
    if ($coverItem) {
        $albumArray[\'image\'] = $coverItem->get(\'thumbnail\',$thumbProperties);
        $albumArray[\'total\'] = $coverItem->get(\'total\');
    }

    $albumArray[\'cls\'] = $rowCls;
    $albumArray[\'idx\'] = $idx;
    $albumArray[\'showName\'] = $showName;
    $albumArray[\'albumRequestVar\'] = $albumRequestVar;
    $output[] = $gallery->getChunk($rowTpl,$albumArray);
    $idx++;
}

/* set output to placeholder or return */
$outputSeparator = $modx->getOption(\'outputSeparator\',$scriptProperties,"\\n");
$output = implode($outputSeparator,$output);
if ($toPlaceholder) {
    $modx->setPlaceholder($toPlaceholder,$output);
    return \'\';
}
return $output;',
      'locked' => 0,
      'properties' => 'a:21:{s:6:"rowTpl";a:7:{s:4:"name";s:6:"rowTpl";s:4:"desc";s:25:"galleryalbums.rowtpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:14:"galAlbumRowTpl";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:6:"rowCls";a:7:{s:4:"name";s:6:"rowCls";s:4:"desc";s:25:"galleryalbums.rowcls_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:4:"sort";a:7:{s:4:"name";s:4:"sort";s:4:"desc";s:23:"galleryalbums.sort_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:4:"rank";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:3:"dir";a:7:{s:4:"name";s:3:"dir";s:4:"desc";s:22:"galleryalbums.dir_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:4:"DESC";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:5:"limit";a:7:{s:4:"name";s:5:"limit";s:4:"desc";s:24:"galleryalbums.limit_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:2:"10";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:5:"start";a:7:{s:4:"name";s:5:"start";s:4:"desc";s:24:"galleryalbums.start_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:1:"0";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:13:"toPlaceholder";a:7:{s:4:"name";s:13:"toPlaceholder";s:4:"desc";s:32:"galleryalbums.toplaceholder_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:12:"showInactive";a:7:{s:4:"name";s:12:"showInactive";s:4:"desc";s:31:"galleryalbums.showinactive_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:0;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:13:"prominentOnly";a:7:{s:4:"name";s:13:"prominentOnly";s:4:"desc";s:32:"galleryalbums.prominentonly_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:6:"parent";a:7:{s:4:"name";s:6:"parent";s:4:"desc";s:25:"galleryalbums.parent_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:1:"0";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:7:"showAll";a:7:{s:4:"name";s:7:"showAll";s:4:"desc";s:26:"galleryalbums.showall_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:8:"showName";a:7:{s:4:"name";s:8:"showName";s:4:"desc";s:27:"galleryalbums.showname_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:15:"albumRequestVar";a:7:{s:4:"name";s:15:"albumRequestVar";s:4:"desc";s:34:"galleryalbums.albumrequestvar_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:8:"galAlbum";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:14:"albumCoverSort";a:7:{s:4:"name";s:14:"albumCoverSort";s:4:"desc";s:33:"galleryalbums.albumcoversort_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:4:"rank";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:17:"albumCoverSortDir";a:7:{s:4:"name";s:17:"albumCoverSortDir";s:4:"desc";s:36:"galleryalbums.albumcoversortdir_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:3:"ASC";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:10:"thumbWidth";a:7:{s:4:"name";s:10:"thumbWidth";s:4:"desc";s:29:"galleryalbums.thumbwidth_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:3:"100";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:11:"thumbHeight";a:7:{s:4:"name";s:11:"thumbHeight";s:4:"desc";s:30:"galleryalbums.thumbheight_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:3:"100";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:13:"thumbZoomCrop";a:7:{s:4:"name";s:13:"thumbZoomCrop";s:4:"desc";s:32:"galleryalbums.thumbzoomcrop_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:8:"thumbFar";a:7:{s:4:"name";s:8:"thumbFar";s:4:"desc";s:27:"galleryalbums.thumbfar_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:1:"C";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:12:"thumbQuality";a:7:{s:4:"name";s:12:"thumbQuality";s:4:"desc";s:31:"galleryalbums.thumbquality_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:90;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:15:"thumbProperties";a:7:{s:4:"name";s:15:"thumbProperties";s:4:"desc";s:34:"galleryalbums.thumbproperties_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Gallery
 *
 * Copyright 2010-2012 by Shaun McCormick <shaun@modx.com>
 *
 * Gallery is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Gallery is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Gallery; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package gallery
 */
/**
 * Loads a list of Albums
 *
 * @var modX $modx
 * @var Gallery $gallery
 * @package gallery
 */
$gallery = $modx->getService(\'gallery\',\'Gallery\',$modx->getOption(\'gallery.core_path\',null,$modx->getOption(\'core_path\').\'components/gallery/\').\'model/gallery/\',$scriptProperties);
if (!($gallery instanceof Gallery)) return \'\';

/* setup default properties */
$rowTpl = $modx->getOption(\'rowTpl\',$scriptProperties,\'galAlbumRowTpl\');
$rowCls = $modx->getOption(\'rowCls\',$scriptProperties,\'\');
$toPlaceholder = $modx->getOption(\'toPlaceholder\',$scriptProperties,false);
$showAll = $modx->getOption(\'showAll\',$scriptProperties,false);
$albumRequestVar = $modx->getOption(\'albumRequestVar\',$scriptProperties,\'galAlbum\');
$albumCoverSort = $modx->getOption(\'albumCoverSort\',$scriptProperties,\'rank\');
$albumCoverSortDir = $modx->getOption(\'albumCoverSortDir\',$scriptProperties,\'ASC\');
$showName = $modx->getOption(\'showName\',$scriptProperties,true);

/* build query */
$albums = $modx->call(\'galAlbum\',\'getList\',array(&$modx,$scriptProperties));

/* handle sorting for album cover */
if ($albumCoverSort == \'rank\') {
    $albumCoverSort = \'AlbumItems.rank\';
}
if (in_array(strtolower($albumCoverSort),array(\'random\',\'rand()\',\'rand\'))) {
    $albumCoverSort = \'RAND()\';
    $albumCoverSortDir = \'\';
}

/* get thumb properties for album cover */
$thumbProperties = $modx->getOption(\'thumbProperties\',$scriptProperties,\'\');
$thumbProperties = !empty($thumbProperties) ? $modx->fromJSON($thumbProperties) : array();
$thumbProperties = array_merge(array(
    \'w\' => (int)$modx->getOption(\'thumbWidth\',$scriptProperties,100),
    \'h\' => (int)$modx->getOption(\'thumbHeight\',$scriptProperties,100),
    \'zc\' => (boolean)$modx->getOption(\'thumbZoomCrop\',$scriptProperties,1),
    \'far\' => (string)$modx->getOption(\'thumbFar\',$scriptProperties,\'C\'),
    \'q\' => (int)$modx->getOption(\'thumbQuality\',$scriptProperties,90),
),$thumbProperties);

/* iterate */
$output = array();
$idx = 0;
/** @var galAlbum $album */
foreach ($albums as $album) {
    $albumArray = $album->toArray();

    $coverItem = $album->getCoverItem($albumCoverSort,$albumCoverSortDir);
    if ($coverItem) {
        $albumArray[\'image\'] = $coverItem->get(\'thumbnail\',$thumbProperties);
        $albumArray[\'total\'] = $coverItem->get(\'total\');
    }

    $albumArray[\'cls\'] = $rowCls;
    $albumArray[\'idx\'] = $idx;
    $albumArray[\'showName\'] = $showName;
    $albumArray[\'albumRequestVar\'] = $albumRequestVar;
    $output[] = $gallery->getChunk($rowTpl,$albumArray);
    $idx++;
}

/* set output to placeholder or return */
$outputSeparator = $modx->getOption(\'outputSeparator\',$scriptProperties,"\\n");
$output = implode($outputSeparator,$output);
if ($toPlaceholder) {
    $modx->setPlaceholder($toPlaceholder,$output);
    return \'\';
}
return $output;',
    ),
  ),
  '65fb209191af7678e3fe9c4f61823e6c' => 
  array (
    'criteria' => 
    array (
      'name' => 'GalleryItem',
    ),
    'object' => 
    array (
      'id' => 16,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'GalleryItem',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '/**
 * Gallery
 *
 * Copyright 2010-2012 by Shaun McCormick <shaun@modx.com>
 *
 * Gallery is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Gallery is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Gallery; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package gallery
 */
/**
 * Display a single Gallery Item
 *
 * @package gallery
 */
$gallery = $modx->getService(\'gallery\',\'Gallery\',$modx->getOption(\'gallery.core_path\',null,$modx->getOption(\'core_path\').\'components/gallery/\').\'model/gallery/\',$scriptProperties);
if (!($gallery instanceof Gallery)) return \'\';

/* get ID of item */
$id = (int)$modx->getOption(\'id\',$scriptProperties,false);
if ($modx->getOption(\'checkForRequestVar\',$scriptProperties,true)) {
    $getParam = $modx->getOption(\'getParam\',$scriptProperties,\'galItem\');
    if (!empty($_REQUEST[$getParam])) { $id = (int)$_REQUEST[$getParam]; }
}
if (empty($id)) return \'\';

/* setup default properties */
$tpl = $modx->getOption(\'tpl\',$scriptProperties,\'galItem\');
$toPlaceholders = $modx->getOption(\'toPlaceholders\',$scriptProperties,true);
$toPlaceholdersPrefix = $modx->getOption(\'toPlaceholdersPrefix\',$scriptProperties,\'galitem\');
$albumTpl = $modx->getOption(\'albumTpl\',$scriptProperties,\'galItemAlbum\');
$albumSeparator = $modx->getOption(\'albumSeparator\',$scriptProperties,\',&nbsp;\');
$albumRequestVar = $modx->getOption(\'albumRequestVar\',$scriptProperties,\'galAlbum\');
$tagTpl = $modx->getOption(\'tagTpl\',$scriptProperties,\'galItemTag\');
$tagSeparator = $modx->getOption(\'tagSeparator\',$scriptProperties,\',&nbsp;\');
$tagSortDir = $modx->getOption(\'tagSortDir\',$scriptProperties,\'DESC\');
$tagRequestVar = $modx->getOption(\'tagRequestVar\',$scriptProperties,\'galTag\');
/* get item */
$c = $modx->newQuery(\'galItem\');
$c->select($modx->getSelectColumns(\'galItem\',\'galItem\'));
$c->where(array(
    \'id\' => $id,
));
$item = $modx->getObject(\'galItem\',$c);
if (empty($item)) return \'\';

/* setup placeholders */
$itemArray = $item->toArray();
$itemArray[\'filename\'] = basename($item->get(\'filename\'));
$itemArray[\'filesize\'] = $item->get(\'filesize\');

/* get image+thumbnail */
$thumbProperties = $modx->getOption(\'thumbProperties\',$scriptProperties,\'\');
$thumbProperties = !empty($thumbProperties) ? $modx->fromJSON($thumbProperties) : array();
$thumbProperties = array_merge(array(
    \'w\' => (int)$modx->getOption(\'thumbWidth\',$scriptProperties,100),
    \'h\' => (int)$modx->getOption(\'thumbHeight\',$scriptProperties,100),
    \'zc\' => (boolean)$modx->getOption(\'thumbZoomCrop\',$scriptProperties,0),
    \'far\' => (string)$modx->getOption(\'thumbFar\',$scriptProperties,\'C\'),
    \'q\' => (int)$modx->getOption(\'thumbQuality\',$scriptProperties,90),
),$thumbProperties);
$itemArray[\'thumbnail\'] = $item->get(\'thumbnail\',$thumbProperties);

$imageProperties = $modx->getOption(\'imageProperties\',$scriptProperties,\'\');
$imageProperties = !empty($imageProperties) ? $modx->fromJSON($imageProperties) : array();
$imageProperties = array_merge(array(
    \'w\' => (int)$modx->getOption(\'imageWidth\',$scriptProperties,500),
    \'h\' => (int)$modx->getOption(\'imageHeight\',$scriptProperties,500),
    \'zc\' => (boolean)$modx->getOption(\'imageZoomCrop\',$scriptProperties,0),
    \'far\' => (string)$modx->getOption(\'imageFar\',$scriptProperties,false),
    \'q\' => (int)$modx->getOption(\'imageQuality\',$scriptProperties,90),
),$imageProperties);
$itemArray[\'image\'] = $item->get(\'thumbnail\',$imageProperties);

/* get albums */
$c = $modx->newQuery(\'galAlbum\');
$c->innerJoin(\'galAlbumItem\',\'AlbumItems\',$modx->getSelectColumns(\'galAlbumItem\',\'AlbumItems\',\'\',array(\'album\')).\' = \'.$modx->getSelectColumns(\'galAlbum\',\'galAlbum\',\'\',array(\'id\'))
    .\' AND \'.$modx->getSelectColumns(\'galAlbumItem\',\'AlbumItems\',\'\',array(\'item\')).\' = \'.$item->get(\'id\'));
$c->sortby(\'AlbumItems.rank\',\'ASC\');
$albums = $modx->getCollection(\'galAlbum\',$c);
$itemArray[\'albums\'] = array();
$i = 0;
foreach ($albums as $album) {
    $albumArray = $album->toArray(\'\',true,true);
    $albumArray[\'idx\'] = $i;
    $albumArray[\'albumRequestVar\'] = $albumRequestVar;
    $itemArray[\'albums\'][] = $gallery->getChunk($albumTpl,$albumArray);
    $i++;
}
$itemArray[\'albums\'] = implode($albumSeparator,$itemArray[\'albums\']);

/* get tags */
$c = $modx->newQuery(\'galTag\');
$c->where(array(
    \'item\' => $item->get(\'id\'),
));
$c->sortby(\'tag\',$tagSortDir);
$tags = $modx->getCollection(\'galTag\',$c);
$i = 0;
$itemArray[\'tags\'] = array();
foreach ($tags as $tag) {
    $tagArray = $tag->toArray();
    $tagArray[\'idx\'] = $i;
    $tagArray[\'tagRequestVar\'] = $tagRequestVar;
    $itemArray[\'tags\'][] = $gallery->getChunk($tagTpl,$tagArray);
    $i++;
}
$itemArray[\'tags\'] = implode($tagSeparator,$itemArray[\'tags\']);

/* if outputting to placeholders, use this, otherwise, use tpl */
if ($toPlaceholders) {
    $modx->toPlaceholders($itemArray,$toPlaceholdersPrefix);
    return \'\';
}

if (empty($tpl)) return \'\';
$output .= $gallery->getChunk($tpl,$itemArray);
return $output;',
      'locked' => 0,
      'properties' => 'a:23:{s:2:"id";a:7:{s:4:"name";s:2:"id";s:4:"desc";s:19:"galleryitem.id_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:14:"toPlaceholders";a:7:{s:4:"name";s:14:"toPlaceholders";s:4:"desc";s:31:"galleryitem.toplaceholders_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:20:"toPlaceholdersPrefix";a:7:{s:4:"name";s:20:"toPlaceholdersPrefix";s:4:"desc";s:37:"galleryitem.toplaceholdersprefix_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:7:"galitem";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:3:"tpl";a:7:{s:4:"name";s:3:"tpl";s:4:"desc";s:20:"galleryitem.tpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:7:"galItem";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:8:"albumTpl";a:7:{s:4:"name";s:8:"albumTpl";s:4:"desc";s:25:"galleryitem.albumtpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:12:"galItemAlbum";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:14:"albumSeparator";a:7:{s:4:"name";s:14:"albumSeparator";s:4:"desc";s:31:"galleryitem.albumseparator_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:7:",&nbsp;";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:15:"albumRequestVar";a:7:{s:4:"name";s:15:"albumRequestVar";s:4:"desc";s:32:"galleryitem.albumrequestvar_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:8:"galAlbum";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:6:"tagTpl";a:7:{s:4:"name";s:6:"tagTpl";s:4:"desc";s:23:"galleryitem.tagtpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:10:"galItemTag";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:12:"tagSeparator";a:7:{s:4:"name";s:12:"tagSeparator";s:4:"desc";s:29:"galleryitem.tagseparator_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:7:",&nbsp;";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:10:"tagSortDir";a:7:{s:4:"name";s:10:"tagSortDir";s:4:"desc";s:27:"galleryitem.tagsortdir_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:4:"DESC";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:13:"tagRequestVar";a:7:{s:4:"name";s:13:"tagRequestVar";s:4:"desc";s:30:"galleryitem.tagrequestvar_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:6:"galTag";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:10:"thumbWidth";a:7:{s:4:"name";s:10:"thumbWidth";s:4:"desc";s:27:"galleryitem.thumbwidth_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:3:"100";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:11:"thumbHeight";a:7:{s:4:"name";s:11:"thumbHeight";s:4:"desc";s:28:"galleryitem.thumbheight_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:3:"100";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:13:"thumbZoomCrop";a:7:{s:4:"name";s:13:"thumbZoomCrop";s:4:"desc";s:30:"galleryitem.thumbzoomcrop_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:8:"thumbFar";a:7:{s:4:"name";s:8:"thumbFar";s:4:"desc";s:25:"galleryitem.thumbfar_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:1:"C";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:12:"thumbQuality";a:7:{s:4:"name";s:12:"thumbQuality";s:4:"desc";s:29:"galleryitem.thumbquality_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:90;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:15:"thumbProperties";a:7:{s:4:"name";s:15:"thumbProperties";s:4:"desc";s:32:"galleryitem.thumbproperties_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:10:"imageWidth";a:7:{s:4:"name";s:10:"imageWidth";s:4:"desc";s:27:"galleryitem.imagewidth_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:11:"imageHeight";a:7:{s:4:"name";s:11:"imageHeight";s:4:"desc";s:28:"galleryitem.imageheight_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:13:"imageZoomCrop";a:7:{s:4:"name";s:13:"imageZoomCrop";s:4:"desc";s:30:"galleryitem.imagezoomcrop_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:0;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:8:"imageFar";a:7:{s:4:"name";s:8:"imageFar";s:4:"desc";s:25:"galleryitem.imagefar_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:12:"imageQuality";a:7:{s:4:"name";s:12:"imageQuality";s:4:"desc";s:29:"galleryitem.imagequality_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:90;s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}s:15:"imageProperties";a:7:{s:4:"name";s:15:"imageProperties";s:4:"desc";s:32:"galleryitem.imageproperties_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:18:"gallery:properties";s:4:"area";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Gallery
 *
 * Copyright 2010-2012 by Shaun McCormick <shaun@modx.com>
 *
 * Gallery is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Gallery is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Gallery; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package gallery
 */
/**
 * Display a single Gallery Item
 *
 * @package gallery
 */
$gallery = $modx->getService(\'gallery\',\'Gallery\',$modx->getOption(\'gallery.core_path\',null,$modx->getOption(\'core_path\').\'components/gallery/\').\'model/gallery/\',$scriptProperties);
if (!($gallery instanceof Gallery)) return \'\';

/* get ID of item */
$id = (int)$modx->getOption(\'id\',$scriptProperties,false);
if ($modx->getOption(\'checkForRequestVar\',$scriptProperties,true)) {
    $getParam = $modx->getOption(\'getParam\',$scriptProperties,\'galItem\');
    if (!empty($_REQUEST[$getParam])) { $id = (int)$_REQUEST[$getParam]; }
}
if (empty($id)) return \'\';

/* setup default properties */
$tpl = $modx->getOption(\'tpl\',$scriptProperties,\'galItem\');
$toPlaceholders = $modx->getOption(\'toPlaceholders\',$scriptProperties,true);
$toPlaceholdersPrefix = $modx->getOption(\'toPlaceholdersPrefix\',$scriptProperties,\'galitem\');
$albumTpl = $modx->getOption(\'albumTpl\',$scriptProperties,\'galItemAlbum\');
$albumSeparator = $modx->getOption(\'albumSeparator\',$scriptProperties,\',&nbsp;\');
$albumRequestVar = $modx->getOption(\'albumRequestVar\',$scriptProperties,\'galAlbum\');
$tagTpl = $modx->getOption(\'tagTpl\',$scriptProperties,\'galItemTag\');
$tagSeparator = $modx->getOption(\'tagSeparator\',$scriptProperties,\',&nbsp;\');
$tagSortDir = $modx->getOption(\'tagSortDir\',$scriptProperties,\'DESC\');
$tagRequestVar = $modx->getOption(\'tagRequestVar\',$scriptProperties,\'galTag\');
/* get item */
$c = $modx->newQuery(\'galItem\');
$c->select($modx->getSelectColumns(\'galItem\',\'galItem\'));
$c->where(array(
    \'id\' => $id,
));
$item = $modx->getObject(\'galItem\',$c);
if (empty($item)) return \'\';

/* setup placeholders */
$itemArray = $item->toArray();
$itemArray[\'filename\'] = basename($item->get(\'filename\'));
$itemArray[\'filesize\'] = $item->get(\'filesize\');

/* get image+thumbnail */
$thumbProperties = $modx->getOption(\'thumbProperties\',$scriptProperties,\'\');
$thumbProperties = !empty($thumbProperties) ? $modx->fromJSON($thumbProperties) : array();
$thumbProperties = array_merge(array(
    \'w\' => (int)$modx->getOption(\'thumbWidth\',$scriptProperties,100),
    \'h\' => (int)$modx->getOption(\'thumbHeight\',$scriptProperties,100),
    \'zc\' => (boolean)$modx->getOption(\'thumbZoomCrop\',$scriptProperties,0),
    \'far\' => (string)$modx->getOption(\'thumbFar\',$scriptProperties,\'C\'),
    \'q\' => (int)$modx->getOption(\'thumbQuality\',$scriptProperties,90),
),$thumbProperties);
$itemArray[\'thumbnail\'] = $item->get(\'thumbnail\',$thumbProperties);

$imageProperties = $modx->getOption(\'imageProperties\',$scriptProperties,\'\');
$imageProperties = !empty($imageProperties) ? $modx->fromJSON($imageProperties) : array();
$imageProperties = array_merge(array(
    \'w\' => (int)$modx->getOption(\'imageWidth\',$scriptProperties,500),
    \'h\' => (int)$modx->getOption(\'imageHeight\',$scriptProperties,500),
    \'zc\' => (boolean)$modx->getOption(\'imageZoomCrop\',$scriptProperties,0),
    \'far\' => (string)$modx->getOption(\'imageFar\',$scriptProperties,false),
    \'q\' => (int)$modx->getOption(\'imageQuality\',$scriptProperties,90),
),$imageProperties);
$itemArray[\'image\'] = $item->get(\'thumbnail\',$imageProperties);

/* get albums */
$c = $modx->newQuery(\'galAlbum\');
$c->innerJoin(\'galAlbumItem\',\'AlbumItems\',$modx->getSelectColumns(\'galAlbumItem\',\'AlbumItems\',\'\',array(\'album\')).\' = \'.$modx->getSelectColumns(\'galAlbum\',\'galAlbum\',\'\',array(\'id\'))
    .\' AND \'.$modx->getSelectColumns(\'galAlbumItem\',\'AlbumItems\',\'\',array(\'item\')).\' = \'.$item->get(\'id\'));
$c->sortby(\'AlbumItems.rank\',\'ASC\');
$albums = $modx->getCollection(\'galAlbum\',$c);
$itemArray[\'albums\'] = array();
$i = 0;
foreach ($albums as $album) {
    $albumArray = $album->toArray(\'\',true,true);
    $albumArray[\'idx\'] = $i;
    $albumArray[\'albumRequestVar\'] = $albumRequestVar;
    $itemArray[\'albums\'][] = $gallery->getChunk($albumTpl,$albumArray);
    $i++;
}
$itemArray[\'albums\'] = implode($albumSeparator,$itemArray[\'albums\']);

/* get tags */
$c = $modx->newQuery(\'galTag\');
$c->where(array(
    \'item\' => $item->get(\'id\'),
));
$c->sortby(\'tag\',$tagSortDir);
$tags = $modx->getCollection(\'galTag\',$c);
$i = 0;
$itemArray[\'tags\'] = array();
foreach ($tags as $tag) {
    $tagArray = $tag->toArray();
    $tagArray[\'idx\'] = $i;
    $tagArray[\'tagRequestVar\'] = $tagRequestVar;
    $itemArray[\'tags\'][] = $gallery->getChunk($tagTpl,$tagArray);
    $i++;
}
$itemArray[\'tags\'] = implode($tagSeparator,$itemArray[\'tags\']);

/* if outputting to placeholders, use this, otherwise, use tpl */
if ($toPlaceholders) {
    $modx->toPlaceholders($itemArray,$toPlaceholdersPrefix);
    return \'\';
}

if (empty($tpl)) return \'\';
$output .= $gallery->getChunk($tpl,$itemArray);
return $output;',
    ),
  ),
  '09c6f2f56953428741918c51d0decb91' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.backend_thumb_far',
    ),
    'object' => 
    array (
      'key' => 'gallery.backend_thumb_far',
      'value' => 'C',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'backend',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'cb3ddf813c881b6d553fe1a4f0983db8' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.backend_thumb_height',
    ),
    'object' => 
    array (
      'key' => 'gallery.backend_thumb_height',
      'value' => '100',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'backend',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '96c40f12e1f068f70e2bfd6836153121' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.backend_thumb_width',
    ),
    'object' => 
    array (
      'key' => 'gallery.backend_thumb_width',
      'value' => '100',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'backend',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'aa6752b538206300c1327c18c0e33454' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.backend_thumb_zoomcrop',
    ),
    'object' => 
    array (
      'key' => 'gallery.backend_thumb_zoomcrop',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'gallery',
      'area' => 'backend',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '59c3830cb6053526c591c64fb3643084' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.default_batch_upload_path',
    ),
    'object' => 
    array (
      'key' => 'gallery.default_batch_upload_path',
      'value' => '{assets_path}images/',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'backend',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'e3f9d7aea823d0640805250aec0e8165' => 
  array (
    'criteria' => 
    array (
      'key' => 'xhtml_urls',
    ),
    'object' => 
    array (
      'key' => 'xhtml_urls',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'core',
      'area' => 'site',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '7e3ad59b94a6bfe48fb113cfa2662bbd' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.thumbs_prepend_site_url',
    ),
    'object' => 
    array (
      'key' => 'gallery.thumbs_prepend_site_url',
      'value' => '',
      'xtype' => 'combo-boolean',
      'namespace' => 'gallery',
      'area' => '',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'e36e3d089fdc3834fe788669fa76c0c7' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.use_richtext',
    ),
    'object' => 
    array (
      'key' => 'gallery.use_richtext',
      'value' => '',
      'xtype' => 'combo-boolean',
      'namespace' => 'gallery',
      'area' => 'TinyMCE',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '084276f626ec01f45de7bad1992b79fb' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.tiny.width',
    ),
    'object' => 
    array (
      'key' => 'gallery.tiny.width',
      'value' => '95%',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'TinyMCE',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '23889b6c2a1aaa0976007cb3e8e9beab' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.tiny.height',
    ),
    'object' => 
    array (
      'key' => 'gallery.tiny.height',
      'value' => '200',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'TinyMCE',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'ec0b8dd1814c7f645a360a52eae77934' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.tiny.buttons1',
    ),
    'object' => 
    array (
      'key' => 'gallery.tiny.buttons1',
      'value' => 'undo,redo,selectall,pastetext,pasteword,charmap,separator,image,modxlink,unlink,media,separator,code,help',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'TinyMCE',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'faf7e2a9169dcca8dd17f0b4ef807bbe' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.tiny.buttons2',
    ),
    'object' => 
    array (
      'key' => 'gallery.tiny.buttons2',
      'value' => 'bold,italic,underline,strikethrough,sub,sup,separator,bullist,numlist,outdent,indent,separator,justifyleft,justifycenter,justifyright,justifyfull',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'TinyMCE',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'c0187554c088d07de19f512d884b2384' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.tiny.buttons3',
    ),
    'object' => 
    array (
      'key' => 'gallery.tiny.buttons3',
      'value' => 'styleselect,formatselect,separator,styleprops',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'TinyMCE',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '483fb4607e4b60eebd624abd5f860f1b' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.tiny.buttons4',
    ),
    'object' => 
    array (
      'key' => 'gallery.tiny.buttons4',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'TinyMCE',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '6bc7b91714bf8dc585027377c89e7ef5' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.tiny.buttons5',
    ),
    'object' => 
    array (
      'key' => 'gallery.tiny.buttons5',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'TinyMCE',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'ffba5d8ff51f2904beb113a3c343e2ca' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.tiny.custom_plugins',
    ),
    'object' => 
    array (
      'key' => 'gallery.tiny.custom_plugins',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'TinyMCE',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'da957847ef57ebb29449dca90e128860' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.tiny.theme',
    ),
    'object' => 
    array (
      'key' => 'gallery.tiny.theme',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'TinyMCE',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '7194b89a72b1d6d89bc0a463479ca6e8' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.tiny.theme_advanced_blockformats',
    ),
    'object' => 
    array (
      'key' => 'gallery.tiny.theme_advanced_blockformats',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'TinyMCE',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'bff7f3003a2cc53c45a96cdd09e68e51' => 
  array (
    'criteria' => 
    array (
      'key' => 'gallery.tiny.theme_advanced_css_selectors',
    ),
    'object' => 
    array (
      'key' => 'gallery.tiny.theme_advanced_css_selectors',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'gallery',
      'area' => 'TinyMCE',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '9aac18fa6d72f49ca46147d3933c103c' => 
  array (
    'criteria' => 
    array (
      'namespace' => 'gallery',
      'controller' => 'index',
    ),
    'object' => 
    array (
      'id' => 78,
      'namespace' => 'gallery',
      'controller' => 'index',
      'haslayout' => 1,
      'lang_topics' => 'gallery:default',
      'assets' => '',
      'help_url' => '',
    ),
  ),
  'c4d42cd413479859cad1f574ace30056' => 
  array (
    'criteria' => 
    array (
      'text' => 'gallery',
    ),
    'object' => 
    array (
      'text' => 'gallery',
      'parent' => 'components',
      'action' => 78,
      'description' => 'gallery.menu_desc',
      'icon' => 'images/icons/plugin.gif',
      'menuindex' => 0,
      'params' => '',
      'handler' => '',
      'permissions' => '',
    ),
  ),
);