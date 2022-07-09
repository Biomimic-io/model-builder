<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="formBuilder">
		<meta name="author" content="Ansonika">
		<title>formBuilder</title>
		<!-- Favicons-->
		<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
		<link rel="apple-touch-icon" type="image/x-icon" href="/img/apple-touch-icon-57x57-precomposed.png">
		<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="/img/apple-touch-icon-72x72-precomposed.png">
		<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="/img/apple-touch-icon-114x114-precomposed.png">
		<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="/img/apple-touch-icon-144x144-precomposed.png">
		<!-- GOOGLE WEB FONT -->
		<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
		<!-- BASE CSS -->
		<link href="/css/bootstrap.min.css" rel="stylesheet">
		<link href="/css/style.css" rel="stylesheet">
		<link href="/css/responsive.css" rel="stylesheet">
		<link href="/css/menu.css" rel="stylesheet">
		<link href="/css/animate.min.css" rel="stylesheet">
		<link href="/css/icon_fonts/css/all_icons_min.css" rel="stylesheet">
		<link href="/css/skins/square/grey.css" rel="stylesheet">
		<!-- YOUR CUSTOM CSS -->
		<link href="/css/custom.css" rel="stylesheet">
		<script src="/js/modernizr.js"></script>
		<!-- Modernizr -->
	</head>
	<body>
		<div id="preloader">
			<div data-loader="circle-side"></div>
		</div><!-- /Preload -->
		<div id="loader_form">
			<div data-loader="circle-side-2"></div>
		</div><!-- /loader_form -->
		<header>
			<div class="container-fluid">
				<div class="row">
					<div class="col-3">
						<div id="logo_home">
							<h1><a href="index.html">MAVIA | Register, Reservation, Questionare, Reviews form wizard</a></h1>
						</div>
					</div>
					<div class="col-9">
						<div id="social">
							<ul>
								<li><a href="#0"><i class="icon-facebook"></i></a></li>
								<li><a href="#0"><i class="icon-twitter"></i></a></li>
								<li><a href="#0"><i class="icon-google"></i></a></li>
								<li><a href="#0"><i class="icon-linkedin"></i></a></li>
							</ul>
						</div>
						<!-- /social -->
						<nav>
							<ul class="cd-primary-nav">
								<li><a href="index.html" class="animated_link">Register Version</a></li>
								<li><a href="reservation_version.html" class="animated_link">Reservation Version</a></li>
								<li><a href="questionare_version.html" class="animated_link">Questionare Version</a></li>
								<li><a href="review_version.html" class="animated_link">Review Version</a></li>
								<li><a href="about.html" class="animated_link">About Us</a></li>
								<li><a href="contacts.html" class="animated_link">Contact Us</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
			<!-- container -->
		</header>
		<!-- End Header -->
		<main>
			<div id="form_container">
				<div class="row">
					<div class="col-lg-5">
						<div id="left_form">
							<figure><img src="img/registration_bg.svg" alt=""></figure>
							<h2>Registration</h2>
							<p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p>
							<a href="#0" id="more_info" data-bs-toggle="modal" data-bs-target="#more-info"><i class="pe-7s-info"></i></a>
						</div>
					</div>
					<div class="col-lg-7">

						<div id="wizard_container">
							<div id="top-wizard">
								<div id="progressbar"></div>
							</div>
							<!-- /top-wizard -->
							<form name="example-1" id="wrapped" method="POST">
								<input id="website" name="website" type="text" value="">
								<!-- Leave for security protection, read docs for details -->
								<div id="middle-wizard">
									<div class="submit step" id="form-anchor"></div>
									<!-- /step-->
								</div>
								<!-- /middle-wizard -->
								<div id="bottom-wizard">
									<button type="button" name="backward" class="backward">Backward </button>
									<button type="button" name="forward" class="forward">Forward</button>
									<button type="submit" name="process" class="submit">Submit</button>
								</div>
								<!-- /bottom-wizard -->
							</form>
						</div>
						<!-- /Wizard container -->
					</div>
				</div><!-- /Row -->
			</div><!-- /Form_container -->
		</main>
		<footer id="home" class="clearfix">
			<p>© 2022</p>
			<!--
			<p>© 2022 Mavia</p>
			<ul>
				<li><a href="#0" class="animated_link">Purchase this template</a></li>
				<li><a href="#0" class="animated_link">Terms and conditions</a></li>
				<li><a href="#0" class="animated_link">Contacts</a></li>
			</ul>
			-->
		</footer>
		<!-- end footer-->
		<div class="cd-overlay-nav">
			<span></span>
		</div>
		<!-- cd-overlay-nav -->
		<div class="cd-overlay-content">
			<span></span>
		</div>
		<!-- cd-overlay-content -->
		<a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a>
		<!-- Modal terms -->
		<div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
						<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
						<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn_1" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		<!-- Modal info -->
		<div class="modal fade" id="more-info" tabindex="-1" role="dialog" aria-labelledby="more-infoLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="more-infoLabel">Frequently asked questions</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
						<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
						<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn_1" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		<!-- SCRIPTS -->
		<!-- Jquery-->
		<script src="/js/jquery-3.6.0.min.js"></script>
		<!-- Common script -->
		<script src="/js/common_scripts_min.js"></script>
		<!-- Wizard script -->
		<script src="/js/registration_wizard_func.js"></script>
		<!-- Menu script -->
		<script src="/js/velocity.min.js"></script>
		<script src="/js/main.js"></script>
		<!-- Theme script -->
		<script src="/js/functions.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/mustache.js/2.3.0/mustache.min.js"></script>
		<script>
			const templates = {
				'header': '<{{subtype}}>{{label}}</{{subtype}}>',
				'paragraph': '<{{subtype}}>{{label}}</{{subtype}}>',
				'hidden': '<input type="{{type}}" name="{{name}}" value="{{value}}">',
				'text': '<div class="row"><div class="col-md-12"><div class="form-group"><input type="{{type}}" name="{{name}}" value="{{value}}" class="{{className}}" placeholder="{{label}}"></div></div><!-- /col-sm-12 --></div><!-- /row -->',
				'date': '<div class="row"><div class="col-md-12"><div class="form-group"><input type="{{type}}" name="{{name}}" value="{{value}}" class="{{className}}" placeholder="{{label}}"></div></div><!-- /col-sm-12 --></div><!-- /row -->',
				'number': '<div class="row"><div class="col-md-12"><div class="form-group"><input type="{{type}}" name="{{name}}" value="{{value}}" class="{{className}}" placeholder="{{label}}"></div></div><!-- /col-sm-12 --></div><!-- /row -->',
				'file': '<div class="row"><div class="col-md-12"><div class="form-group"><input type="{{type}}" name="{{name}}" value="{{value}}" class="{{className}}" placeholder="{{label}}"></div></div><!-- /col-sm-12 --></div><!-- /row -->',
				'button': '<button type="{{subtype}}" name="{{name}}" class="{{className}}">{{label}}</button>',
				'autocomplete': '<div class="row"><div class="col-md-12"><div class="form-group"><input type="text" name="{{name}}" value="{{value}}" class="{{className}}" placeholder="{{label}}"></div></div><!-- /col-sm-12 --></div><!-- /row --><script defer>window.onload = () => {jQuery($ => {$("input[name={{name}}]").autocomplete({source:{{mt_values}}});});};</scr'+'ipt>',
				'textarea': '<div class="form-group"><textarea name="{{name}}" class="{{className}}" placeholder="{{label}}">{{value}}</textarea></div>',
				'select': '<div class="styled-select"><select name="{{name}} class="{{className}}">{{#values}}<option value="{{value}}">{{label}}</option>{{/values}}</select></div>',
				'radio-group': '<div class="form-group radio_input">{{#values}}<label><input type="{{mt_type}}" name="{{mt_name}}" value="{{value}}" class="icheck" {{mt_checked}}{{mt_disabled}}>{{label}}</label>{{/values}}</div>',
				'checkbox-group': '<div class="form-group radio_input">{{#values}}<label><input type="{{mt_type}}" name="{{mt_name}}" value="{{value}}" class="icheck" {{mt_checked}}{{mt_disabled}}>{{label}}</label>{{/values}}</div>',
			};
			const formData = <?php echo $out;?>;
			jQuery($ => {
				let rendered = [];
				for(var i in formData){
					const t = formData[i].type;
					rendered.push(Mustache.render(templates[t],formData[i]));
				}
				$('#form-anchor').html(rendered.join(''));
			});
		</script>
	</body>
</html>