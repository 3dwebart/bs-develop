<?php
header("Content-Type: text/html; charset=utf-8");
$root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Document</title>
<script src=""></script>
<script src="assets/js/ckeditor5/classic/ckeditor.js"></script>
<!--
<script src="assets/js/ckeditor5/classic/ckeditor.js"></script>
<script src="assets/js/ckeditor5/balloon/ckeditor.js"></script>
<script src="assets/js/ckeditor5/inline/ckeditor.js"></script>
<script src="assets/js/ckeditor5/document/ckeditor.js"></script>
-->
</head>
<body>
<h1>test</h1>
<textarea name="content" id="editor" style="width: 100%; height: 250px;"></textarea>
<!-- <script>
	ClassicEditor
		.create( document.querySelector( '#editor' ) )
		.catch( error => {
			console.error( error );
		} );
</script> -->
<script>
var newMyEditor;
//var uploadPolder = '<?php echo($root); ?>' + '/ck-uploader/upload';
var uploadPolder = 'http://' + window.location.hostname + '/ck-uploader/upload/';

ClassicEditor
	.create( document.querySelector( '#editor' ), {
        cloudServices: {
            //tokenUrl: 'https://example.com/cs-token-endpoint',
            uploadUrl: uploadPolder
        }
    } )
	/*
	.create( document.querySelector( '#editor' ), {
        ckfinder: {
            uploadUrl: uploadPolder + '1234.jpg'
        }
    } )
    */
	/*
	.create( document.querySelector( '#editor' ), {
		image: {
			// You need to configure the image toolbar too, so it uses the new style buttons.
			toolbar: [ 'imageTextAlternative', '|', 'imageStyleAlignLeft', 'imageStyleFull', 'imageStyleAlignRight' ],

			styles: [
				// This option is equal to a situation where no style is applied.
				'imageStyleFull',

				// This represents an image aligned to left.
				'imageStyleAlignLeft',

				// This represents an image aligned to right.
				'imageStyleAlignRight'
			]
		},
		removePlugins: [ 'EaseImage', 'CKFinderUploadAdapter' ]
	} )
	*/
	.then( editor => {
        console.log( 'Editor was initialized');
        newMyEditor = editor;
    } )
	.catch( error => {
		console.error( error );
	} );
</script>
</body>
</html>