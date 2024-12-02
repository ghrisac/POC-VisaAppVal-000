<?php

	class Main {

		// print validation message
		public function print_output(string $file_name) : void
		{
			include "PrepFields.php";

			$fields = new PrepFields;

			echo '<pre>';
			print_r(implode(PHP_EOL, $fields->get_result($file_name)));
		}

	}
?>