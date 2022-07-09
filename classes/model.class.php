<?php
# m3956: model of model

class Model {
	private
		$name	= null,
		$data	= null;
	public function __construct($name,$content=null){
		$this->name = $name;
		if(is_array($content) and $content)
			$this->data = $content;
		elseif(file_exists(ROOT_PATH.'models/'.$this->name.'.json'))
			$this->data = json_decode(file_get_contents(ROOT_PATH.'models/'.$this->name.'.json'),true);
	}
	#
	public function __get($k){
		if('name' == $k)
			return $this->name;
		elseif('data' == $k)
			return $this->data;
		else
			return null;
	}
	public function Read(){
		return json_encode($this->data);
	}
	public function Update($content=null){
		if($content){
			if(is_array($content))
				$this->data = $content;
			else
				$this->data = json_decode($content,true);
		}
		return file_put_contents(ROOT_PATH.'models/'.$this->name.'.json',json_encode($this->data));
	}
	public function Delete(){
		if(file_exists(ROOT_PATH.'models/'.$this->name.'.json'))
			return unlink(ROOT_PATH.'models/'.$this->name.'.json');
	}
	#
	public static function List(){
		$out = [];
		foreach(glob(ROOT_PATH.'models/*.json') as $m)
			$out[] = ['name'=>basename($m,'.json'),'modified'=>date('r',filemtime($m))];
		return $out;
	}
	public static function Find($name){
		return (file_exists(ROOT_PATH.'models/'.$name.'.json')) ? new self($name) : null;
	}
}
