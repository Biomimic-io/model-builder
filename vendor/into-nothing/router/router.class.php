<?php
# m3956: router
namespace Into_Nothing;

class Router {
	public static function Route(){
		$req = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : strval(@getenv('QUERY_STRING'));
		if(!$req or false === strpos($req,'/') or strpos($req,'/') > strpos($req,'?') or strpos($req,'/') > strpos($req,'&'))
			$req = !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : strval(@getenv('REQUEST_URI'));
		if(false !== ($q = strpos($req,'?')) or false !== ($a = strpos($req,'&'))){
			if($q and $a)
				$x = ($q > $a) ? $a : $q;
			else
				$x = ($a) ? $a : $q;
			$req = substr($req,0,$x);
			if(isset($_GET[substr($req,0,$x)]))
				unset($_GET[substr($req,0,$x)]);
		}
		if('/' == substr($req,0,1))
			$req = substr($req,1);
		$route = (strpos($req,'/') !== false) ? explode('/',$req) : [$req];
		return $route;
	}
}
