<?php
# m3956: HTML attributes filler
namespace Into_Nothing;

class AttribFiller {
	public static function fill($source,$keys){
		$out = [];
		if(!is_array($keys) or !$keys)
			return $out;
		foreach($keys as $k)
			$out[$k] = isset($source[$k]) ? $k.'="'.$source[$k].'"' : '';
		return implode(' ',$out);
	}
}
