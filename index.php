<?php

include_once 'header.php';

navigate();

$control->initialize();
$view->initialize();
?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset='UTF-8' />
		<meta name="author" content="Zuzana Vilhelmova" />
    	<meta name="description" content="Wiki for Minecraft mode - Industrial Craft Experimental" />
   	 	<meta name="keywords" content="minecraft, mode, industrial, experimental, wiki" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->
		<script type="text/javascript" src="./tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector: "textarea",
				theme: "modern",
				schema: "html5",
				skin: "custom",
				menubar: false,
				add_unload_trigger: false,
				relative_urls: "false",
				style_formats: [
					{
						title: "Headers",
						items: [
							{title: "Header 3", format: "h3"},
							{title: "Header 4", format: "h4"},
							{title: "Header 5", format: "h5"},
							{title: "Header 6", format: "h6"}
						]
					},
					{
						title: "Blocks",
						items: [
							{title: "Paragraph", format: "p"},
							{title: "Pre", format: "pre"}
						]
					},
					{
						title: "Font Family",
						items: [
							{title: 'Arial', inline: 'span', styles: { 'font-family': 'arial'}},
							{title: 'Book Antiqua', inline: 'span', styles: { 'font-family': 'book antiqua'}},
							{title: 'Comic Sans MS', inline: 'span', styles: { 'font-family': 'comic sans ms,sans-serif'}},
							{title: 'Courier New', inline: 'span', styles: { 'font-family': 'courier new,courier'}},
							{title: 'Georgia', inline: 'span', styles: { 'font-family': 'georgia,palatino'}},
							{title: 'Helvetica', inline: 'span', styles: { 'font-family': 'helvetica'}},
							{title: 'Impact', inline: 'span', styles: { 'font-family': 'impact,chicago'}},
							{title: 'Open Sans', inline: 'span', styles: { 'font-family': 'Open Sans'}},
							{title: 'Symbol', inline: 'span', styles: { 'font-family': 'symbol'}},
							{title: 'Tahoma', inline: 'span', styles: { 'font-family': 'tahoma'}},
							{title: 'Terminal', inline: 'span', styles: { 'font-family': 'terminal,monaco'}},
							{title: 'Times New Roman', inline: 'span', styles: { 'font-family': 'times new roman,times'}},
							{title: 'Verdana', inline: 'span', styles: { 'font-family': 'Verdana'}}
						]
					},
					{title: "Font Size", items: [
						{title: '8pt', inline: 'span', styles: { fontSize: '12px', 'font-size': '8px' } },
						{title: '10pt', inline: 'span', styles: { fontSize: '12px', 'font-size': '10px' } },
						{title: '12pt', inline: 'span', styles: { fontSize: '12px', 'font-size': '12px' } },
						{title: '14pt', inline: 'span', styles: { fontSize: '12px', 'font-size': '14px' } },
						{title: '16pt', inline: 'span', styles: { fontSize: '12px', 'font-size': '16px' } }
					]
					}
				],
				toolbar: "undo redo | searchreplace cut copy paste | emoticons | bold italic underline strikethrough superscript subscript | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect charmap |  link media image jbimages  | insertdatetime preview code visualblocks",
				plugins: [
					"advlist autolink link image lists charmap preview",
					"searchreplace wordcount visualblocks code insertdatetime media",
					"contextmenu emoticons template paste jbimages tabfocus textcolor"
				],
				templates: [
					{title: 'Article', description: 'Article with header h3', url: './tinymce/templates/test.html'}
				]
			});



		</script>
		<link rel='stylesheet' type='text/css' href='css/style.css' title='default' />
		<link rel="icon" type="image/x-icon" href="pictures/icon.ico" />
	<title><?php $view->printTitle(); ?></title>
	</head>
	<body>
		<div class="wrapper">
		<header><?php include_once 'menu.php'; ?>
			<nav><?php $view->printNavigation(); ?></nav>
		<h1><?php $view->printPageHeader(); ?></h1>
		</header>
			<section>
				<div id='sectionContent'>
	<!--				    <pre>-->
	<!--				            --><?php
					//				            echo "get: ";
					//				            var_dump($_GET);
					//				            echo "</br>post: ";
					//				            var_dump($_POST);

					?>
					<!--				    </pre>-->
					<?php
					$view->printBody();
					?>
				</div>
			</section>

			<footer>
				<?php
				$view->printFooter();
				?>
			</footer>
			<br class='clear' />

		</div>
	</body>
</html>
<?php

/*

$test = new UserIcon(1, addslashes(file_get_contents("BronzeChestplate.png")));

UserIconDAO::reset($test);
*/
//var_dump($test);

/*
header("Content-type: image/png");
$result = $test->getImage();
echo "$result";
*/