<?php $filepath = '/'; require_once 'engine/init.php'; require_once 'module.php';

// Autofetch API modules
$directory = 'modules';
$plugins = array();
$iterator = new DirectoryIterator($directory);
foreach($iterator as $entity) {
	if($entity->isDot())
		continue;
	$iterator = new DirectoryIterator($entity->getPathname());
	foreach($iterator as $entity) {
		if($entity->isFile()) {
			$file_extension = pathinfo($entity->getFilename(), PATHINFO_EXTENSION);
			if ($file_extension == 'php') {
				$path = explode('/', $entity->getPathname());
				if (count($path) === 1) $path = explode('\\', $entity->getPathname());
				$plugins[$path[1]] = $path[2];
			}
		}
	}
}
$response['modules'] = $plugins;
SendResponse($response);
?>