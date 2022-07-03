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
# /init

# route
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
# /route

# router
$out = $err = '';
if('model' == $route[0]){ # * /model

	# following isn't a good practice at all, it only suits tiny-scaled projects
	# normally it should be a separate routing processor
	# in that tiny projects it can save time and effort though
	if(!empty($route[1])){
		if('list' == $route[1]){ # * /model/list
			$out = [];
			foreach(glob('./models/*.json') as $json)
				$out[basename($json,'.json')] = date('r',filemtime($json));
			if(!$out)
				$err = "No models found!";
		} elseif(preg_match('/^[\da-z\-_ ]+$/i',$route[1])){ # * /model/*
			$act = !empty($route[2]) ? $route[2] : '';
			if(file_exists("./models/{$route[1]}.json") or 'save' == $act){ # * /model/:name
				$model = $route[1];
				if('save' == $act and ($data = file_get_contents('php://input'))){ # POST /model/:name/save
					if(preg_match('/^[\[\{].+[\}\]]$/',trim($data))){
						if(@file_put_contents("./models/$model.json",trim($data))){
							$out = 'ok';
						} else $err = "Can't store model!";
					} else $err = "Invalid model supplied!";
				} else $out = file_get_contents("./models/$model.json");
			} else $err = "Model not found!";
		} elseif(!empty($route[1]))
			$err = "Invalid model specified!";
	}
}

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
require_once 'template.php';
exit;
# /output
