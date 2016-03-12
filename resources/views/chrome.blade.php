<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<title>READI Writer's Hub</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

 	<link href='https://fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet"> -->
	<link href="{{ asset('/css/app_template.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/app_custom.css') }}" rel="stylesheet">

	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/templates.js') }}"></script>

	<!-- TinyMCE Text Editor Init -->
	<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
	<script>
		tinymce.init({
			selector: 'textarea',
			menubar: false,
			forced_root_block : "", 
			force_br_newlines : true,
			force_p_newlines : false,
			content_css: "css/app_custom.css",
			setup : function(ed){
				ed.on('init', function(){
					this.getDoc().body.style.fontSize = '14px';
				});
			}
		});
	</script>
</head>
</html>
