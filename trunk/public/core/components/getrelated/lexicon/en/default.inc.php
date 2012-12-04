<?php

$_lang['getrelated'] = 'getRelated';
$_lang['getrelated.desc'] = 'List related pages.';
$_lang['getrelated.pagesfound'] = 'The following [[+count]] pages may interest you as well:';
$_lang['getrelated.error.loadingclass'] = 'Error loading class getRelated from [[+path]].';
$_lang['getrelated.error.nofields'] = 'No fields or template variables found to search in.';
$_lang['getrelated.error.nodistinctivedata'] = 'Error collecting distinctive data from the resource to match against.';
$_lang['getrelated.error.invalidresource'] = 'The specified or default resource is invalid.';

/* Stop words are words that will be ignored in the data collected from the resource that would normally be used to match otehr resources with. */
$_lang['getrelated.stopwords'] = "a,able,about,above,abroad,according,accordingly,across,actually,adj,after,afterwards,again,against,ago,ahead,ain't,all,allow,allows,almost,alone,along,alongside,already,also,although,always,am,amid,amidst,among,amongst,an,and,another,any,anybody,anyhow,anyone,anything,anyway,anyways,anywhere,apart,appear,appreciate,appropriate,are,aren't,around,as,a's,aside,ask,asking,associated,at,available,away,awfully,b,back,backward,backwards,be,became,because,become,becomes,becoming,been,before,beforehand,begin,behind,being,believe,below,beside,besides,best,better,between,beyond,both,brief,but,by,c,came,can,cannot,cant,can't,caption,cause,causes,certain,certainly,changes,clearly,c'mon,co,co.,com,come,comes,concerning,consequently,consider,considering,contain,containing,contains,corresponding,could,couldn't,course,c's,currently,d,dare,daren't,definitely,described,despite,did,didn't,different,directly,do,does,doesn't,doing,done,don't,down,downwards,during,e,each,edu,eg,eight,eighty,either,else,elsewhere,end,ending,enough,entirely,especially,et,etc,even,ever,evermore,every,everybody,everyone,everything,everywhere,ex,exactly,example,except,f,fairly,far,farther,few,fewer,fifth,first,five,followed,following,follows,for,forever,former,formerly,forth,forward,found,four,from,further,furthermore,g,get,gets,getting,given,gives,go,goes,going,gone,got,gotten,greetings,h,had,hadn't,half,happens,hardly,has,hasn't,have,haven't,having,he,he'd,he'll,hello,help,hence,her,here,hereafter,hereby,herein,here's,hereupon,hers,herself,he's,hi,him,himself,his,hither,hopefully,how,howbeit,however,hundred,i,i'd,ie,if,ignored,i'll,i'm,immediate,in,inasmuch,inc,inc.,indeed,indicate,indicated,indicates,inner,inside,insofar,instead,into,inward,is,isn't,it,it'd,it'll,its,it's,itself,i've,j,just,k,keep,keeps,kept,know,known,knows,l,last,lately,later,latter,latterly,least,less,lest,let,let's,like,liked,likely,likewise,little,look,looking,looks,low,lower,ltd,m,made,mainly,make,makes,many,may,maybe,mayn't,me,mean,meantime,meanwhile,merely,might,mightn't,mine,minus,miss,more,moreover,most,mostly,mr,mrs,much,must,mustn't,my,myself,n,name,namely,nd,near,nearly,necessary,need,needn't,needs,neither,never,neverf,neverless,nevertheless,new,next,nine,ninety,no,nobody,non,none,nonetheless,noone,no-one,nor,normally,not,nothing,notwithstanding,novel,now,nowhere,o,obviously,of,off,often,oh,ok,okay,old,on,once,one,ones,one's,only,onto,opposite,or,other,others,otherwise,ought,oughtn't,our,ours,ourselves,out,outside,over,overall,own,p,particular,particularly,past,per,perhaps,placed,please,plus,possible,presumably,probably,provided,provides,q,que,quite,qv,r,rather,rd,re,really,reasonably,recent,recently,regarding,regardless,regards,relatively,respectively,right,round,s,said,same,saw,say,saying,says,second,secondly,see,seeing,seem,seemed,seeming,seems,seen,self,selves,sensible,sent,serious,seriously,seven,several,shall,shan't,she,she'd,she'll,she's,should,shouldn't,since,six,so,some,somebody,someday,somehow,someone,something,sometime,sometimes,somewhat,somewhere,soon,sorry,specified,specify,specifying,still,sub,such,sup,sure,t,take,taken,taking,tell,tends,th,than,thank,thanks,thanx,that,that'll,thats,that's,that've,the,their,theirs,them,themselves,then,thence,there,thereafter,thereby,there'd,therefore,therein,there'll,there're,theres,there's,thereupon,there've,these,they,they'd,they'll,they're,they've,thing,things,think,third,thirty,this,thorough,thoroughly,those,though,three,through,throughout,thru,thus,till,to,together,too,took,toward,towards,tried,tries,truly,try,trying,t's,twice,two,u,un,under,underneath,undoing,unfortunately,unless,unlike,unlikely,until,unto,up,upon,upwards,us,use,used,useful,uses,using,usually,v,value,various,versus,very,via,viz,vs,w,want,wants,was,wasn't,way,we,we'd,welcome,well,we'll,went,were,we're,weren't,we've,what,whatever,what'll,what's,what've,when,whence,whenever,where,whereafter,whereas,whereby,wherein,where's,whereupon,wherever,whether,which,whichever,while,whilst,whither,who,who'd,whoever,whole,who'll,whom,whomever,who's,whose,why,will,willing,wish,with,within,without,wonder,won't,would,wouldn't,x,y,yes,yet,you,you'd,you'll,your,you're,yours,yourself,yourselves,you've,z,zero";

$_lang['getrelated.prop_desc.resource'] = 'Either the Resource ID to find related resources for or "current" or empty to find related for the current resource.';
$_lang['getrelated.prop_desc.fields'] = 'Comma separated list of fieldname:weight to use in the comparison. Prefix TVs with "tv.". Don\'t use the content unless you want to kill performance. Example of use: pagetitle:3,tv.MyTags:7,tv.MySubjects:15,introtext:2';
$_lang['getrelated.prop_desc.returnFields'] = 'Resource Fields (use returnTVs for template variables) to include in the eventual output.';
$_lang['getrelated.prop_desc.returnTVs'] = 'Template Variables names (comma separated) to include in the result set. Do not prefix with "tv.".';
$_lang['getrelated.prop_desc.parents'] = 'Comma separated list of parents to use in finding related resources.';
$_lang['getrelated.prop_desc.exclude'] = 'Comma separated list of resource IDs to exclude from the results.';
$_lang['getrelated.prop_desc.parentsDepth'] = 'The depth to search parents for.';
$_lang['getrelated.prop_desc.contexts'] = 'Comma separated list of Contexts to search in.';
$_lang['getrelated.prop_desc.includeUnpublished'] = 'Also use unpublished resources in the result set.';
$_lang['getrelated.prop_desc.includeHidden'] = 'Also use resources marked as hidden in menus in the result set.';
$_lang['getrelated.prop_desc.limit'] = 'Number of results to output.';
$_lang['getrelated.prop_desc.fieldSample'] = 'Number of resources to use in comparing based on resource fields. Can have a huge impact on performance so if you\'re experiencing long load times, try decreasing this number.';
$_lang['getrelated.prop_desc.fieldSort'] = 'Resource field to sort by, used in conjunction with the fieldSample property.';
$_lang['getrelated.prop_desc.fieldSortDir'] = 'Sort direction for the fieldSort property.';
$_lang['getrelated.prop_desc.tvSample'] = 'Number of TV results to include (note: one resource can have more than one result depending on your fields property) when comparing against TV values.';
$_lang['getrelated.prop_desc.tvSort'] = 'Resource field to sort by in the TV query, used in conjunction with the tvSample property.';
$_lang['getrelated.prop_desc.tvSortDir'] = 'Sort direction for the tvSort property.';
$_lang['getrelated.prop_desc.tplOuter'] = 'Chunk name to as outer template, see default in core/components/getrelated/elements/snippets/chunks/.';
$_lang['getrelated.prop_desc.tplRow'] = 'Chunk name to as row template, see default in core/components/getrelated/elements/snippets/chunks/.';
$_lang['getrelated.prop_desc.noResults'] = 'Text or output when there are no related resources found.';
$_lang['getrelated.prop_desc.toPlaceholder'] = 'To output the results to a placeholder instead of directly, define the name of the placeholder here.';
$_lang['getrelated.prop_desc.rowSeparator'] = 'String to use as separator between rows.';
$_lang['getrelated.prop_desc.defaultWeight'] = 'Weight to assign to fields that don\'t have a weight set specifically.';
$_lang['getrelated.prop_desc.debug'] = 'Enable/disable debug mode. When enabled it will dump lots of information on screen.';

?>
