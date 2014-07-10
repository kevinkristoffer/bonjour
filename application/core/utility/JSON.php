<?php
/**
 * 解析json格式的字串
 * @author Administrator
 *
 */
class Bonjour_Core_Utility_JSON {
	
	public static function translateJSONFilter($decoded_obj){
		
		$output='';
		
		if(array_key_exists('rules', $decoded_obj) && array_key_exists('op', $decoded_obj)){
			$temp_array=array();
			for($i=0;$i<count($decoded_obj['rules']);$i++){
				$output=$decoded_obj['rules'][$i]['field'].' '.$decoded_obj['rules'][$i]['op'].' '.$decoded_obj['rules'][$i]['value'];
				array_push($temp_array, $output);
			}
			if(array_key_exists('groups', $decoded_obj)){
				for($j=0;$j<count($decoded_obj['groups']);$j++){
					$output=' ( '.self::translateJSONFilter($decoded_obj['groups'][$j]).' ) ';
					array_push($temp_array, $output);
				}
			}
			$output=implode(' '.$decoded_obj['op'].' ', $temp_array);
		}
		
		return $output;
		
	}
}

?>