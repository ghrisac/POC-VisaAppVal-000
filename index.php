<!DOCTYPE html>
<?php include "Main.php";?>
<html>

	<head>
		<link rel="stylesheet" href="style/main.css">
	</head>
	
	<body>

		<div style="margin-top: 130px; margin-bottom: 20px;">
			<h1 style="color: #444444 !important; font-weight: 500;">Simple PDF Reader</h1>
		</div>
		
		<form enctype="multipart/form-data" action="index.php" method="POST" style="margin-bottom: 30px;">
		  <div class="input-file-container">  
		  	<input type="hidden" value="1" name="submitted" />
		    <input class="input-file" id="my-file" name="userfile" type="file">
		    <label tabindex="0" for="my-file" class="input-file-trigger">Select a file...</label>
		    <input class="send-file" id="send-file" type="submit" value="Check File" style="display:none;" />
		  </div>
		  <p class="file-return"></p>
		</form>

		<div class="_result">
			<h3>Output:</h3>
			<?php

				// this will render validated form
				render();

				// upload file to target directory
				function render() : void
				{
					if (isset($_POST['submitted']))
					{
						if (is_valid_file())
						{
							$uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/pdf_text_reader/pdf_file/';
							$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);	

							$file_name = move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)
								? $_FILES['userfile']['name']
								: 'text_pdf.pdf';

							$main = new Main;

							$main->print_output($file_name);
						}
						else
						{
							echo '<pre>';
							print_r("Invalid file.");
						}
					}
				}

				// validate if file is with valid extension
				function is_valid_file() : bool
				{
					$ret = FALSE;
					$whitelist = array("pdf");
					$file = $_FILES['userfile'] ?? NULL;
					$full_path = $file['full_path'] ?? '';

					$tokenize = explode('.', $full_path);
					$extension = $tokenize[count($tokenize) - 1];

					if (in_array($extension, $whitelist))
					{
						$ret = TRUE;
					}

					return $ret;
				}

			?>
		</div>
	</body>

	<script src="js/main.js"></script>
	<script src="js/jquery.min.js"></script>

	<script>
		$('document').ready(function(){
			$('.input-file').on('change', function(){
				document.getElementById('send-file').style.display = 'block';
			});
		});
	</script>

</html>