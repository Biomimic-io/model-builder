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
			<option disabled>--Please choose a Model--</option>
		</select>
		--- Model Name <input type="text" class="model-add-name"> <button class="model-add-trigger">Create New Model</button>
		<div id="build-wrap"></div>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
		<script src="//formbuilder.online/assets/js/form-builder.min.js"></script>
		<script>
			// once again, should be separated in large-scale projects
			let formData = null;
			jQuery(function($){
				const loadModel = modelName => {
					$.get(`/model/${modelName}`).done(rsp => {
						if(rsp.content){
							try {
								formData = JSON.parse(rsp.content);
								setTimeout(() => {formBuilder.actions.setData(formData);},50);
							} catch(x){
								alert(`Can't load form data for model ${modelName}: ${x}`);
							}
						} else if(rsp.error){
							alert(`Can't load form data for model ${modelName}: ${rsp.error}`);
						}
					});
				};
				const loadModelList = () => {
					$.get('/model/list').done(rsp => {
						$('.model-select').children().not('option:first').remove();
						if(rsp.content){
							for(let i in rsp.content){
								$('.model-select').children().last().after(`<option value="${i}">${i} (${rsp.content[i]})</option>`);
							}
						} else {
							console.error(rsp.err);
						}
					});
				};
				const $fbEditor = document.getElementById('build-wrap');
				const options = {};
				const formBuilder = $($fbEditor).formBuilder(options);
				document.addEventListener('fieldAdded',e => {
					if('undefined' != typeof window.sessionStorage){
						window.sessionStorage.setItem('formData',formBuilder.actions.getData('json'));
					}
				});
				$('.model-add-trigger').click(e => {
					e.preventDefault();
					const modelName = $('.model-add-name').val();
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
								loadModelList();
								loadModel(modelName);
							}
						}).fail(rsp => {
							alert(`Failed to save model: ${rsp.err}`);
						});
					}
				});
				$('.model-select').change(e => {
					const modelName = $('.model-select').val();
					if(modelName)
						loadModel(modelName);
				});
				$(document).ready(e => {
					loadModelList();
				});
			});
		</script>
	</body>
</html>