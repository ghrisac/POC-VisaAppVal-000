<?php

$fields_with_validation = [
	[
		'text' => '성 Family Name   명 Given Names',
		'indexes' => [
			1,
			2
		],
		'boundery' => '명'
	],
	[
		'text' => '성 Family Name   명 Given Names',
		'indexes' => [
			4,
			5
		],
		'boundery' => ''
	],
	[
		'text' => '1.4 생년월일 Date of Birth (yyyy/mm/dd) 1.5 국적  Nationality',
		'indexes' => [
			2,
			3,
			4,
			5
		],
		'boundery' => '1.5'
	],
	[
		'text' => '1.4 생년월일 Date of Birth (yyyy/mm/dd) 1.5 국적  Nationality',
		'indexes' => [
			8
		],
		'boundery' => ''
	],
	[
		'text' => '1.6 출생국가 Country of Birth',
		'indexes' => [
			2,
			3,
			4
		],
		'boundery' => ''
	],
	[
		'text' => '1.7 국가신분증번호 National Identity No.',
		'indexes' => [
			2,
			3,
			4
		],
		'boundery' => ''
	]
];

?>