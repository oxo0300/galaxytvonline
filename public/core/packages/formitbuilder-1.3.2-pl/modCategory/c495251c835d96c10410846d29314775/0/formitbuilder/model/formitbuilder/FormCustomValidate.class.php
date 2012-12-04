<?php
/**
 * Core methods and properties that are extended by all FormItBuilder objects.
 * @package FormItBuilder
 */

/**
 * Required Files
 */
require_once 'FormItBuilderCore.class.php';


/**
 * This class holds validation methods that are custom to FormItBuilder and not built into FormIt/jQuery Validate. Validate methods are called via a snippet in a roundabout way using globals to get around limitations using FormIt
 * @package FormItBuilder
 */
class FormItBuilder_customValidate extends FormItBuilderCore{
	/**
	 * validateElement($elID, $value, $options)
	 * 
	 * Validates an element in a variety of ways that are not covered by FormIT
	 * @param string $elID Id of form element.
	 * @param string $value String to validate
	 * @param array $options Validation options passed as an associative array (must have a type element)
	 * @return array Returns an associative array with information on the validity of the value such as returnStatus(boolean), errorMsg(string), value(mixed) and extraInfo(mixed)
	 */
	public static function validateElement($elID, $value, array $options){
		if(isset($GLOBALS['FormItBuilder_customValidateProcessedIds'])===false){
			$GLOBALS['FormItBuilder_customValidateProcessedIds']=array();
		}
		if(in_array($elID, $GLOBALS['FormItBuilder_customValidateProcessedIds'])===true){
			return array('returnStatus'=>true,'errorMsg'=>NULL,'value'=>NULL,'extraInfo'=>NULL);
		}else{			
			$GLOBALS['FormItBuilder_customValidateProcessedIds'][]=$elID;
			$returnStatus=true; //allow pass by default
			$errorMsgs=array();
			$returnValue=$value;
			$returnExtraInfo=NULL;
			foreach($options as $option){
				switch($option['type']){
					case 'elementDate':
						if($option['required']===true){
							if(empty($_POST[$elID.'_0'])===false && empty($_POST[$elID.'_1'])===false && empty($_POST[$elID.'_2'])===false){
								//all three date elements must be selected
							}else{
								$returnStatus = false;
								$errorMsgs[] = $option['errorMessage'];
							}
						}
						break;
					case 'textfield':
						if(isset($option['minLength'])===true){
							if(strlen($value)<$option['minLength']){
								$returnStatus = false;
								$errorMsgs[] = $option['errorMessage'];
							}
						}else if(isset($option['required'])===true){
							if(empty($value)===true && $value!='0'){
								$returnStatus = false;
								$errorMsgs[] = $option['errorMessage'];
							}else{
								//pass validation - put in place because FormIt will not pass a character 0
							}
						}
						break;
					case 'date':
						$a_formatInfo = FormItBuilder::is_valid_date($value, $option['fieldFormat']);
						$returnStatus = $a_formatInfo['status'];
						$returnValue = $a_formatInfo['value'];
						$returnExtraInfo = $a_formatInfo;
						if($returnStatus===false){
							$errorMsgs[] = $option['errorMessage'];
						}
						break;
					case 'checkboxGroup':
						if(isset($option['minLength'])===true){
							if(count($value)<$option['minLength']){
								$returnStatus=false;
								$errorMsgs[] = $option['errorMessage'];
							}
						}
						if(isset($option['maxLength'])===true){
							if(count($value)>$option['maxLength']){
								$returnStatus=false;
								$errorMsgs[] = $option['errorMessage'];
							}
						}
						break;
				}
			}
			$a_ret = array('returnStatus'=>$returnStatus,'errorMsg'=>implode(',',$errorMsgs),'value'=>$returnValue,'extraInfo'=>$returnExtraInfo);
			return $a_ret;
		}
	}
}
?>
