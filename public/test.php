<?php
	
	$old_db = new PDO('mysql:host=mysql.galaxytvonline.com;dbname=galaxytvonline_cms;charset=utf8;', 'sigmastudioz', 'internetx1');
	
	$db = new PDO('mysql:host=mysql.galaxytvonline.com;dbname=galaxytvonline_devcms;charset=utf8;', 'sigmastudioz', 'internetx1');
	//print_r($db);
	
	$pattern = array('/\s\s+/', '/<br>/i','/ s /i','/\n/i','/\r/i','~&.+;~U');
	$replace = array(' ',' ','\'s ',' ',' ',' ');
	
	$action = $_GET['action']? $_GET['action'] :  $action;
	
	if($action=="updateprodtodev_tmpvars_imagepath"){
		$startupdate = "SELECT * FROM `modx_site_tmplvar_contentvalues` WHERE tmplvarid = 1";
		$rows = $db->prepare($startupdate);
		if ($rows->execute()) {
			while ($row = $rows->fetch()) {
				$path = explode("/", $row['value']);
				//print_r($row);
				echo "UPDATE `modx_site_tmplvar_contentvalues` SET value = \"".$path[count($path)-1]."\" WHERE id = ".$row['id'].";";
			}
		}
	}
	
	if($action=="updateprodtodev_tmpvars"){
		$lastvalue = "SELECT id FROM `modx_site_tmplvar_contentvalues` ORDER BY id DESC LIMIT 1";
		echo $lastvalue.'<br/>';
		
		$rows = $db->prepare($lastvalue);
		if ($rows->execute()) {
			$data = $rows->fetch(PDO::FETCH_ASSOC);
		
			$startupdate = "SELECT * FROM `modx_site_tmplvar_contentvalues` WHERE id > ".$data['id']. " ORDER BY id ASC";
			
			echo $startupdate.'<br/>';
			
			$old_db_rows = $old_db->prepare($startupdate);
			if ($old_db_rows->execute()) {
		   	 	while ($old_db_row = $old_db_rows->fetch()) {
		   	 		$old_value = str_replace('%20','\ ',$old_db_row['value']);
		   	 		$value = str_replace('/assets/images/','',$old_value);
					if($old_db_row['tmplvarid']==1){
						$value = (strrpos($value, "articles/")===false)? $value : $value;
					} else {
						$value = $old_db_row['tmplvarid'];
					}
					
		   	 		$insert_db = "INSERT INTO `modx_site_tmplvar_contentvalues` (
							        `id`, 
							        `tmplvarid`, 
							        `contentid`, 
							        `value`
							      ) VALUES (
							          '".$old_db_row['id']."', 
							          '".$old_db_row['tmplvarid']."', 
							          '".$old_db_row['contentid']."', 
							          '".$value."'
							    )";
					$oldurl = "/home/galaxytvonline/public_html".$old_value;
					$newurl = "/home/galaxytvonline/domains/dev.galaxytvonline.com/public_html/media/articles/".$value;
					$exec = 'cp -f '.$oldurl.' '.$newurl;
					
					
					//echo $insert_db.'</br>';
					//echo $old_db_row['value'].'</br>';
					
					
					if($old_db_row['tmplvarid']==1){
						exec($exec);
						//echo $exec.'</br>';
					}
					$update_rows = $db->prepare($insert_db);
					if ($update_rows->execute()) {
						echo "New TmpVar Row Inserted from Prod to Dev <br/>";
					}
				}
				
			}
		}
	}
	if($action=="updateprodtodev_content"){
		$lastvalue = "SELECT id FROM `modx_site_content` ORDER BY id DESC LIMIT 1";
		
		$rows = $db->prepare($lastvalue);
		if ($rows->execute()) {
			$data = $rows->fetch(PDO::FETCH_ASSOC);
		
			$startupdate = "SELECT * FROM `modx_site_content` WHERE id > ".$data['id']." ORDER BY createdon ASC";
			
			//echo $startupdate.'<br/>';
			
			$old_db_rows = $old_db->prepare($startupdate);
			if ($old_db_rows->execute()) {
		   	 	/*while ($old_db_row = $old_db_rows->fetch()) {
		   	 		updateprodtodev_content($old_db_row);
				}*/
				updateprodtodev_content($old_db_rows);
			}
		}
	}
	
	if($action=="updateprodtodev_content_cleanupdate"){
		$lastvalue = "TRUNCATE `modx_site_content`";
		
		$rows = $db->prepare($lastvalue);
		if ($rows->execute()) {
			//echo "DEV Content DB is Clean<br/>:::::<br/>";
			
			$startupdate = "SELECT * FROM `modx_site_content` ORDER BY createdon ASC LIMIT 2295";
			//echo $startupdate.'<br/>';
			
			$old_db_rows = $old_db->prepare($startupdate);
			if ($old_db_rows->execute()) {
		   	 	/*while ($old_db_row = $old_db_rows->fetch()) {
		   	 		updateprodtodev_content($old_db_row);
				}*/
				
				updateprodtodev_content($old_db_rows);
			}
		}
	}
	
	
	if($action=="updatedevalias"){
		$sql = "SELECT * FROM `modx_site_content` WHERE parent = 25";
		
		$output = "";
		$rows = $db->prepare($sql);
		if ($rows->execute()) {
	   	 	while ($row = $rows->fetch()) {
				//print_r($row);
				//echo $row['alias']+";";
				
				
				
				//$update = $db->prepare("UPDATE `modx_site_content` SET url = 'news/main-news/"+$row['alias']+"'WHERE parent = 25");
				//$update->execute();
				
				$update = $db->prepare("UPDATE `modx_site_content` SET uri = 'news/main-news/".$row['alias']."' WHERE id = ".$row['id']."");
				if ($update->execute()) {
					echo "Success :: ".$row['id'];
				}
			}
		}
	}
	
	if($action=="update_missing_content"){
		$lastvalue = "SELECT * FROM  `modx_site_content` WHERE content =  \"\"";
		
		$rows = $db->prepare($lastvalue);
		if ($rows->execute()) {
			while ($row = $rows->fetch()) {
				$startupdate = "SELECT content FROM `modx_site_content` WHERE id = ".$row['id']."";
	   	 		
				//echo $startupdate.'<br/>';
				
				$old_db_rows = $old_db->prepare($startupdate);
				if ($old_db_rows->execute()) {
					$data = $old_db_rows->fetch(PDO::FETCH_ASSOC);
					$dont_strip_tags = "<p><a><u><i><b><img><ul><li><br>";
			
					$content = trim(strip_tags(html_entity_decode($data['content'], ENT_QUOTES), $dont_strip_tags));
					$content = addcslashes(addcslashes($content,"'"),'"');
					$updatevalue = "UPDATE `modx_site_content` SET content=\"".$content."\" WHERE id = ".$row['id']."";
					//$updatevalue_prepare = $db->prepare($updatevalue);
					//$db->execute();
					echo $updatevalue.';';
				}
			}
		}
	}
	
	function updateprodtodev_content($old_db_rows){
		$datarow = $old_db_rows->fetch();
		if(count($datarow) > 0){
			$old_db_row = $datarow;
			$alias = "";
			$template = 9;
	 		$menushow = 0;
	 		
	 		//$text =  $old_db_row['content'];
			
			
			$search = array('/\r\r+/','/\s\s+/','#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu', '#<p[^>]*>(.*?)</p>#isu'); 
	        $replace = array(' ',' ','<b>$2</b>', '<i>$2</i>', '<u>$1</u>', '<p>$1</p>'); 
			//$content = str_replace('"','&quot;', $old_db_row['content']); 
			$content = addcslashes($old_db_row['content'],'"');
			$content = addcslashes($content,"'");
	        //$content = preg_replace($search, $replace, $content); 
			//$content =  $old_db_row['content'];
			$dont_strip_tags = "<p><a><u><i><b><img><ul><li><br>";
			
			$content = trim(strip_tags(html_entity_decode($content, ENT_QUOTES), $dont_strip_tags));
			
			$config = array('indent' => TRUE,
                'output-xhtml' => TRUE,
                'wrap' => 200);
			
			//$tidy = tidy_parse_string($content);
			
			//if($tidy->cleanRepair()){
				//echo "Content has been cleaned. Updating Database<br/>";
				//$content = $tidy;
				//$content = $content;
				//$content = addcslashes(addcslashes($content,"'"),'"');
				
				//$content = preg_replace('/\s\s+/', ' ', $content);
				//$content = trim(strip_tags(html_entity_decode($content, ENT_QUOTES), $dont_strip_tags));
				
				$text =  strip_tags($content);
				//$text = preg_replace($pattern,$replace,$text);
				$text =  trim($text);
				
				
				$words = explode(". ", $text);   
			    $description_text = array_slice($words,0,1);
				$summary_text = array_slice($words,0,2);
			    
			    $description = $old_db_row['description']? $old_db_row['description'] : implode(". ",$description_text);
				
				$summary = $old_db_row['introtext']? $old_db_row['introtext'] : implode(". ",$summary_text);
				
				$description = strip_tags(addcslashes(addcslashes($description,"'"),'"'));
				$summary = strip_tags(addcslashes(addcslashes($summary,"'"),'"'));
		 		
				switch ($old_db_row['parent']) {
					case 25:
						$alias = "news/main-news/".$old_db_row['alias'];
						break;
						
					case 20:
						$alias = "news/national-pulse/".$old_db_row['alias'];
						break;
						
					case 21:
						$alias = "news/spectrum/".$old_db_row['alias'];
						break;
						
					case 22:
						$alias = "news/sports-news/".$old_db_row['alias'];
						break;
					
					case 23:
						$alias = "news/entertainment-news/".$old_db_row['alias'];
						break;
					
					case 24:
						$alias = "news/business-news/".$old_db_row['alias'];
						break;
						
					case 65:
						$alias = "news/opinion-circle/".$old_db_row['alias'];
						break;
						
					case 2220:
						$alias = "news/ntfs/".$old_db_row['alias'];
						break;
					
					default:
						$alias = ($old_db_row['isfolder']==1)? $old_db_row['alias'].'/' : $old_db_row['alias'];
						$template = 11;
						$menushow = $old_db_row['hidemenu'];
						break;
				}
				
				switch ($old_db_row['id']) {
					case 1:
						$template = 7;
						break;
					case 2:
						$template = 17;
						break;
					case 25:
						$template = 10;
						break;
						
					case 20:
						$template = 10;
						break;
						
					case 21:
						$template = 10;
						break;
						
					case 22:
						$template = 10;
						break;
					
					case 23:
						$template = 10;
						break;
					
					case 24:
						$template = 10;
						break;
						
					case 65:
						$template = 18;
						break;
						
					case 2220:
						$template = 18;
						break;
				}
		
				
				
				
				//$text =  html_entity_decode($text, ENT_QUOTES);
				//$text = preg_replace(']]>', ']]&gt;', $text);
			    /* remove line breaks */
			    //$text = preg_replace('/\s\s+/', ' ', $text);
			   
		
			    
					//echo $old_db_row['id'].'<br/>';
				
					//echo $content.'<br/><br/>';
					
					$insert_db = 'INSERT INTO `modx_site_content` (
							        `id`, 
							        `type`, 
							        `contentType`, 
							        `pagetitle`, 
							        `longtitle`, 
							        `description`, 
							        `alias`, 
							        `link_attributes`, 
							        `published`, 
							        `pub_date`, 
							        `unpub_date`, 
							        `parent`, 
							        `isfolder`, 
							        `introtext`, 
							        `content`, 
							        `richtext`, 
							        `template`, 
							        `menuindex`, 
							        `searchable`, 
							        `cacheable`, 
							        `createdby`, 
							        `createdon`, 
							        `editedby`, 
							        `editedon`, 
							        `deleted`, 
							        `deletedon`, 
							        `deletedby`, 
							        `publishedon`, 
							        `publishedby`, 
							        `menutitle`, 
							        `donthit`, 
							        `privateweb`, 
							        `privatemgr`, 
							        `content_dispo`, 
							        `hidemenu`, 
							        `class_key`, 
							        `context_key`, 
							        `content_type`, 
							        `uri`, 
							        `uri_override`
							      ) VALUES (
							          "'.$old_db_row['id'].'", 
							          "'.$old_db_row['type'].'", 
							          "'.$old_db_row['contentType'].'", 
							          "'.$old_db_row['pagetitle'].'", 
							          "'.$old_db_row['pagetitle'].'", 
							          "'.$description.'", 
							          "'.$old_db_row['alias'].'", 
							          "'.$old_db_row['link_attributes'].'", 
							          "'.$old_db_row['published'].'", 
							          "'.$old_db_row['pub_date'].'", 
							          "'.$old_db_row['unpub_date'].'", 
							          "'.$old_db_row['parent'].'", 
							          "'.$old_db_row['isfolder'].'", 
							          "'.$summary.'", 
							          "'.$content.'", 
							          "'.$old_db_row['richtext'].'", 
							          "'.$template.'", 
							          "'.$old_db_row['menuindex'].'", 
							          "'.$old_db_row['searchable'].'", 
							          "'.$old_db_row['cacheable'].'", 
							          "'.$old_db_row['createdby'].'", 
							          "'.$old_db_row['createdon'].'", 
							          "'.$old_db_row['editedby'].'", 
							          "'.$old_db_row['editedon'].'",
							          "'.$old_db_row['deleted'].'", 
							          "'.$old_db_row['deletedon'].'", 
							          "'.$old_db_row['deletedby'].'", 
							          "'.$old_db_row['publishedon'].'", 
							          "'.$old_db_row['publishedby'].'", 
							          "'.$old_db_row['menutitle'].'", 
							          "0", 
							          "0", 
							          "0",
							          "0", 
							          "'.$menushow.'", 
							          "modDocument", 
							          "web", 
							          "1",
							          "'.$alias.'", 
							          "0"
							    )';
				    echo $insert_db.';';
					/*$update_rows = $db->prepare($insert_db);
					if ($update_rows->execute()) {
					   echo "New Row Inserted from Prod to Dev<br/>::::: ".$old_db_row['id']." :::::<br/><br/>";
					  // $datarow = array_slice($datarow, 1, count($datarow));
					   updateprodtodev_content($old_db_rows);
					}*/
					//echo "Total: ".count($datarow)."<br/>";	
				 	//$datarow = array_slice($datarow, 1, count($datarow));
				 	updateprodtodev_content($old_db_rows);
				//}
			}
		}
		
?>