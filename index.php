<?php
# since we have a rather tiny-scaled project, it will be better to keep it all in one file to minimize complexity
# never ever try to use such approach for any larger-scale projects!
# I'm usually selecting approach basing on particular project specifics

# anyway, here we go!

# init
@ob_start();
@ob_implicit_flush(0);

# debug
# @error_reporting(E_ALL);
# @ini_set('display_errors','on');
# /debug

date_default_timezone_set('Europe/Kiev'); # set desired timezone here

define('ROOT_PATH',str_replace('\\','/',realpath(dirname(__FILE__)).'/'));

spl_autoload_register(function($class){
	if(class_exists($class))
		return;
	if(strpos($class,'\\')){
		$fqcn = explode('\\',$class);
		foreach($fqcn as &$np)
			$np = str_replace('_','-',strtolower($np));
		$fpn = implode('/',$fqcn);
		if(file_exists(ROOT_PATH.'vendor/'.$fpn.'/'.strtolower($fqcn[count($fqcn)-1]).'.class.php'))
			require_once ROOT_PATH.'vendor/'.$fpn.'/'.strtolower($fqcn[count($fqcn)-1]).'.class.php';
	} else {
		$fn = 'classes/'.str_replace('_','-',strtolower($class)).'.class.php';
		if(file_exists(ROOT_PATH.$fn))
			require_once ROOT_PATH.$fn;
	}
});
# /init

$tpl = 'builder';
$out = $err = '';

$R = Router::Instance();
$R->HandleRequest('/model/list',function(){
	$xl = Model::List();
	$ls = [];
	foreach($xl as $x)
		$ls[$x['name']] = $x['modified'];
	return [$ls,''];
});
$R->HandleRequest('/model/:name/save',function($name){
	$data = file_get_contents('php://input');
	if(preg_match('/^[\[\{].+[\}\]]$/',trim($data))){
		$m = new Model($name);
		if($m->Update($data))
			return ['ok',''];
		else
			return ['',"Can't store model!"];
	} else return ['',"Invalid model supplied!"];
},'POST');
$R->HandleRequest('/model/:name/form',function($name){
	global $tpl;
	$tpl = 'form';
	$m = Model::Find($name);
	if($m){
		$f = new Form($m->data);
		return [$f->Render(),''];
	} else return ['','Model not found!'];
});
$R->HandleRequest('/model/:name/mustache',function($name){
	global $tpl;
	$tpl = 'mustache';
	$m = Model::Find($name);
	if($m){
		$f = new Form($m->data);
		return [$f->Render(false),''];
	} else return ['','Model not found!'];
});
$R->HandleRequest('/model/:name',function($name){
	$m = Model::Find($name);
	if($m){
		return [$m->Read(),''];
	} else return ['','Model ['.$name.'] not found!'];
});

[$out,$err] = $R->ProcessRequest();

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) and 'xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])){
	$out = json_encode(['content'=>$out,'error'=>$err]);
	ob_end_clean();
	header('Content-Type: application/json; charset=UTF-8');
	echo $out;
	exit;
}
# /router

# assume AJAX app
# output
ob_end_clean();
header('Content-Type: text/html; charset=UTF-8');
require_once ROOT_PATH."templates/$tpl.tpl";
exit;
# /output
