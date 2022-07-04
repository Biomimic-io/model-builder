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

# lib
function fillAttributes($source,$keys){
	$out = [];
	if(!is_array($keys) or !$keys)
		return $out;
	foreach($keys as $k)
		$out[$k] = isset($source[$k]) ? $k.'="'.$source[$k].'"' : '';
	return implode(' ',$out);
}
# /lib

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
$tpl = 'main';
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
				} elseif('form' == $act){ # * /model/:name/form
					$tpl = 'form';
					$j = json_decode(file_get_contents("./models/$model.json"),true);
					$form = [];
					foreach($j as $ctl){
						if('header' == $ctl['type'] or 'paragraph' == $ctl['type'])
							$form[] = <<<TPL
<{$ctl['subtype']}>{$ctl['label']}</{$ctl['subtype']}>
TPL;
						elseif('hidden' == $ctl['type']){
							$attrz = fillAttributes($ctl,['name','value']);
							$form[] = <<<TPL
<input type="{$ctl['type']}"$attrz>
TPL;
						} elseif('text' == $ctl['type'] or 'number' == $ctl['type'] or 'date' == $ctl['type'] or 'file' == $ctl['type']){ # TODO: more simple types here?
							$ctl['class'] = isset($ctl['className']) ? $ctl['className'] : '';
							$ctl['placeholder'] = isset($ctl['label']) ? $ctl['label'] : '';
							$attrz = fillAttributes($ctl,['name','value','class','placeholder']);
							$form[] = <<<TPL
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<input type="{$ctl['type']}"$attrz>
		</div>
	</div>
	<!-- /col-sm-12 -->
</div>
<!-- /row -->
TPL;
						} elseif('textarea' == $ctl['type']){
							$ctl['class'] = isset($ctl['className']) ? $ctl['className'] : '';
							$ctl['placeholder'] = isset($ctl['label']) ? $ctl['label'] : '';
							$attrz = fillAttributes($ctl,['name','value','class','placeholder']);
							$form[] = <<<TPL
<div class="form-group">
	<textarea $attrz></textarea>
</div>
TPL;
						} elseif('radio-group' == $ctl['type'] or 'checkbox-group' == $ctl['type']){
							$attrz = fillAttributes($ctl,['name']);
							$type = ('radio-group' == $ctl['type']) ? 'radio' : 'checkbox';
							$valz = [];
							foreach($ctl['values'] as $vv){
								$sel = $vv['selected'] ? ' checked' : '';
								$valz[] = <<<TPL
<label><input type="$type" value="{$vv['value']}" $sel $attrz class="icheck">{$vv['label']}</label>
TPL;
							}
							$valz = implode("\n",$valz);
							$form[] = <<<TPL
<div class="form-group radio_input">
	$valz
</div>
TPL;
						} elseif('select' == $ctl['type']){
							$ctl['class'] = isset($ctl['className']) ? $ctl['className'] : '';
							$attrz = fillAttributes($ctl,['name','class']);
							$valz = [];
							foreach($ctl['values'] as $vv){
								$sel = $vv['selected'] ? ' selected' : '';
								$valz[] = <<<TPL
<option value="{$vv['value']}"$sel>{$vv['label']}</option>
TPL;
							}
							$valz = implode("\n",$valz);
							$form[] = <<<TPL
<div class="styled-select">
	<select $attz>
		$valz
	</select>
</div>
TPL;
						} elseif('button' == $ctl['type']){
							$attrz = fillAttributes($ctl,['name','class']);
							$form[] = <<<TPL
<button type="{$ctl['subtype']}" $attrz>{$ctl['label']}</button>
TPL;
						}
					}
					$out = implode("\n",$form);
				} else $out = file_get_contents("./models/$model.json"); # * /model/:name/*
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
require_once "template-$tpl.php";
exit;
# /output
