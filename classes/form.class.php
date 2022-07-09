<?php
# m3956: Template form builder

Class Form {
	private
		$data		= null;
	public function __construct($data){
		if($data and is_array($data))
			$this->data = $data;
	}
	public function Render($html=true){
		if($html)
			return $this->_renderHTML();
		else
			return $this->_renderMustache();
	}
	private function _renderHTML(){
		$form = [];
		foreach($this->data as $ctl){
			if('header' == $ctl['type'] or 'paragraph' == $ctl['type'])
				$form[] = <<<TPL
<{$ctl['subtype']}>{$ctl['label']}</{$ctl['subtype']}>
TPL;
			elseif('hidden' == $ctl['type']){
				$attrz = Into_Nothing\AttribFiller::fill($ctl,['name','value']);
				$form[] = <<<TPL
<input type="{$ctl['type']}"$attrz>
TPL;
			} elseif('text' == $ctl['type'] or 'number' == $ctl['type'] or 'date' == $ctl['type'] or 'file' == $ctl['type']){
				$ctl['class'] = isset($ctl['className']) ? $ctl['className'] : '';
				$ctl['placeholder'] = isset($ctl['label']) ? $ctl['label'] : '';
				$attrz = Into_Nothing\AttribFiller::fill($ctl,['name','value','class','placeholder']);
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
			} elseif('autocomplete' == $ctl['type']){
				$ctl['class'] = isset($ctl['className']) ? $ctl['className'] : '';
				$ctl['placeholder'] = isset($ctl['label']) ? $ctl['label'] : '';
				$attrz = Into_Nothing\AttribFiller::fill($ctl,['name','value','class','placeholder']);
				##
				$valz = [];
				foreach($ctl['values'] as $vv){
					$sel = $vv['selected'] ? ' checked' : '';
					$valz[] = $vv['value'];
				}
				$valz = json_encode($valz);
				##
				$form[] = <<<TPL
<div class="row">
<div class="col-md-12">
<div class="form-group">
<input type="text"$attrz>
</div>
</div>
<!-- /col-sm-12 -->
</div>
<!-- /row -->
<script defer>
window.onload = () => {
jQuery($ => {
$('input[name={$ctl['name']}]').autocomplete({source:$valz});
});
};
</script>
TPL;
			} elseif('textarea' == $ctl['type']){
				$ctl['class'] = isset($ctl['className']) ? $ctl['className'] : '';
				$ctl['placeholder'] = isset($ctl['label']) ? $ctl['label'] : '';
				$attrz = Into_Nothing\AttribFiller::fill($ctl,['name','value','class','placeholder']);
				$form[] = <<<TPL
<div class="form-group">
<textarea $attrz></textarea>
</div>
TPL;
			} elseif('radio-group' == $ctl['type'] or 'checkbox-group' == $ctl['type']){
				$attrz = Into_Nothing\AttribFiller::fill($ctl,['name']);
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
				$attrz = Into_Nothing\AttribFiller::fill($ctl,['name','class']);
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
<select $attrz>
$valz
</select>
</div>
TPL;
			} elseif('button' == $ctl['type']){
				$attrz = Into_Nothing\AttribFiller::fill($ctl,['name','class']);
				$form[] = <<<TPL
<button type="{$ctl['subtype']}" $attrz>{$ctl['label']}</button>
TPL;
			}
		}
		$out = implode("\n",$form);
		return $out;
	}
	private function _renderMustache(){
		# TODO: figure out what we gonna do
	}
}
