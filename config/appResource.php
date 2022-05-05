<?php

return [
	'title' => 'Ressource',
	'layouts' => [
		'main' => 'blog.admin.default'
	],
	'images' => [
		'path' => [
			'public' => '/images/pages/',
			'upload' => public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pages' // voir storage_path
		]
	],
];