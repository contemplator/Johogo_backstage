<html>
<head>
	<script src="jquery-1.4.min.js" type="text/javascript"></script>
	<script src="jquery.flash.min.js" type="text/javascript"></script>
	<link type="text/css" rel="stylesheet" href="unrelated.css" />
	
	<script src="agile-uploader-3.0.js" type="text/javascript"></script>
	<link type="text/css" rel="stylesheet" href="agile-uploader.css" />
</head>
<body>

<div id="demo">

<form id="multipleDemo" enctype="multipart/form-data">


<div id="multiple"></div>
<br />

</form>

<a href="#" onClick="document.getElementById('agileUploaderSWF').submit();">Submit</a>
</div>

    <script type="text/javascript">
    	$('#multiple').agileUploader({
    		submitRedirect: 'results.php',
    		formId: 'multipleDemo',
			flashVars: {
			firebug: false,
    		form_action: 'process.php',
			file_limit: 3,
			max_post_size: (1000 * 1024)
    		}
    	});	
    </script>

</body>
</html>
