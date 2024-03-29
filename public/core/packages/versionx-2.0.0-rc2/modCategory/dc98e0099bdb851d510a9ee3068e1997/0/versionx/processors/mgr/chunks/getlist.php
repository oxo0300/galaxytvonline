<?php
/* @var modX $modx
 * @var array $scriptProperties
 */
$start = $modx->getOption('start',$scriptProperties,0);
$limit = $modx->getOption('limit',$scriptProperties,20);
$sort = $modx->getOption('sort',$scriptProperties,'saved');
$dir = $modx->getOption('dir',$scriptProperties,'desc');

/* Filter data */
$chunk = $modx->getOption('chunk',$scriptProperties,null);
$search = $modx->getOption('search',$scriptProperties,null);
$category = $modx->getOption('category',$scriptProperties,null);
$user = $modx->getOption('user',$scriptProperties,null);
$from = $modx->getOption('from',$scriptProperties,null);
$until = $modx->getOption('until',$scriptProperties,null);

$results = array();

$c = $modx->newQuery('vxChunk');
$c->leftJoin('modUser','User','User.id = vxChunk.user');
$c->leftJoin('modUserProfile','Profile','Profile.internalKey = User.id');
$c->leftJoin('modCategory','Category','Category.id = vxChunk.category');
$c->select(array('version_id','content_id','saved','mode','marked','name','vxChunk.category','categoryname'=>'Category.category','User.username'));

/* Filter */
if ($search)
    $c->where(array('name:LIKE' => "%$search%"));
if ($chunk)
    $c->where(array('content_id' => $chunk));
if ($category)
    $c->where(array('vxChunk.category' => $category));
if ($user)
    $c->where(array('user' => $user));
if ($from)
    $c->where(array('saved:>' => $from));
if ($until)
    $c->where(array('saved:<' => $until));


$total = $modx->getCount('vxChunk',$c);

$c->sortby($sort,$dir);
$c->limit($limit,$start);

$collection = $modx->getCollection('vxChunk',$c);

/* @var vxResource $res */
foreach ($collection as $res) {
    $ta = $res->toArray('',false,true);
    $results[] = $ta;
}

$returnArray = array(
    'success' => true,
    'total' => $total,
    'results' => $results
);
return $modx->toJSON($returnArray);

?>
