<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>formBuilder</title>
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
		<style>
			body {
				padding: 0;
				margin: 10px 0;
				background: #f2f2f2 url('//formbuilder.online/assets/img/noise.png');
			}
		</style>
	</head>
	<body translate="no">
		<select class="model-select">
			<option selected disabled>--Please choose a Model--</option>
		</select>
		--- Model Name <span class="form_nav_ctl_wrap"></span> <input type="text" class="model-add-name"> <button class="model-add-trigger">Create New Model</button>
		<div id="build-wrap"></div>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
		<script src="//formbuilder.online/assets/js/form-builder.min.js"></script>
		<script>
			// once again, should be separated in large-scale projects
			let formData = null;
			jQuery(function($){
				const loadModel = modelName => {
					$.get(`/model/${modelName}/view`).done(rsp => {
						if(rsp.content){
							try {
								formData = JSON.parse(rsp.content);
								setTimeout(() => {formBuilder.actions.setData(formData);},50);
								$('.form_nav_ctl_wrap').html('<button>Form</button><button>Mustache</button>');
								setTimeout(() => {$('.form_nav_ctl_wrap button').eq(0).click(e => {e.preventDefault();window.open(window.location.toString().replace('/view','/form'));})},100);
								setTimeout(() => {$('.form_nav_ctl_wrap button').eq(1).click(e => {e.preventDefault();window.open(window.location.toString().replace('/view','/mustache'));})},100);
								setTimeout(() => {$('.model-add-name').val(modelName);},100);
							} catch(x){
								alert(`Can't load form data for model ${modelName}: ${x}`);
							}
						} else if(rsp.error){
							alert(`Can't load form data for model ${modelName}: ${rsp.error}`);
						}
					});
				};
				const loadModelList = (callback) => {
					$.get('/model/list').done(rsp => {
						$('.model-select').children().not('option:first').remove();
						if(rsp.content){
							for(let i in rsp.content){
								$('.model-select').children().last().after(`<option value="${i}">${i} (${rsp.content[i]})</option>`);
							}
							if(callback && 'function' == typeof callback)
								callback.call();
						} else {
							console.error(rsp.err);
						}
					});
				};
				const saveFormData = f => {
					if('undefined' != typeof window.sessionStorage && 'undefined' != typeof formBuilder){
						window.sessionStorage.setItem('formData',formBuilder.actions.getData('json'));
					}
				};
				const sendFormData = () => {
					const modelName = $('.model-add-name').val();
					saveFormData();
					const modelData = window.sessionStorage.getItem('formData');
					if('' === modelName){
						alert("Please input new model's name!");
					} else if(!modelData){
						alert("Please save your form first!");
					} else {
						$.post(`/model/${modelName}/save`,modelData).done(rsp => {
							if(rsp.err){
								alert(`Failed to save model: ${rsp.err}`);
							} else {
								loadModelList(() => {
									$('.model-select').val(modelName).change();
									if('undefined' != typeof window.history){
										history.pushState({},'',window.location.path = `/model/${modelName}/view`);
									}
								});
								loadModel(modelName);
							}
						}).fail(rsp => {
							alert(`Failed to save model: ${rsp.err}`);
						});
					}
				};
				const $fbEditor = document.getElementById('build-wrap');
				const options = {
					onSave: (e,formData) => {
						sendFormData();
					}
				};
				const formBuilder = $($fbEditor).formBuilder(options);
				document.addEventListener('fieldAdded',saveFormData);
				document.addEventListener('fieldEditClosed',saveFormData);
				$('.model-add-trigger').click(e => {
					e.preventDefault();
					sendFormData();
				});
				$('.model-select').change(e => {
					const modelName = $('.model-select').val();
					if(modelName){
						loadModel(modelName);
						if('undefined' != typeof window.history){
							history.pushState({},'',window.location.path = `/model/${modelName}/view`);
						}
					}
				});
				$(document).ready(e => {
					loadModelList();
					if('/' != window.location.pathname){
						const match = window.location.pathname.match(/^\/model\/([^\/]+)(\/view)?$/i);
						if(match && 'undefined' != typeof match[1] && match[1]){
							setTimeout(() => {$('.model-select').val(match[1]);},300);
							loadModel(match[1]);
						}
					}
				});
			});
		</script>
	</body>
</html>