<?php
# m3956: local router

Class Router {
	private static $_instance;
	private
		$handlers	= null,
		$paths		= null,
		$route		= null;
	#
	public static function Instance($route=null){
		if(!self::$_instance)
			self::$_instance = new self($route);
		return self::$_instance;
	}
	#
	private function __construct($route=null){
		$this->handlers = [];
		if(!$route)
			$route = Into_Nothing\Router::route();
		$this->route = $route;
	}
	#
	public function HandleRequest($path,$handler,$method='*'){
		if(is_callable($handler)){
			$methods = ['get','post','put','patch','delete','any','*'];
			if(!in_array(strtolower($method),$methods))
				$method = preg_split('/\b/',$method);
			else
				$method = [strtolower($method)];
			foreach($method as $m)
				$this->handlers[$path][$m] = $handler;
			#
			$handler_path = $path;
			$path = explode('/',$path);
			foreach($path as &$p){
				if(!$p)
					continue;
				if(':' == substr($p,0,1))
					$p = '([^/]+)';
			}
			$path = implode('/',$path);
			$path = "#$path#";
			$this->paths[$path] = &$this->handlers[$handler_path][$m];
		}
	}
	#
	public function ProcessRequest(){
		$route = count($this->route) ? implode('/',$this->route) : '';
		$route = "/$route";
		foreach($this->paths as $regexp => $fx){
			if(preg_match($regexp,$route,$x)){
				if(1 < count($x))
					return call_user_func_array($fx,array_slice($x,1));
				else
					return call_user_func($fx);
			}
		}
	}
}
