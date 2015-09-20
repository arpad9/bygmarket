<?php
	require 'lessc.inc.php';

	try {
		$less = new lessc();
		$less->setImportDir(array(
			Registry::get('config.dir.root'), 
		));
		lessc::ccompile(Registry::get('config.dir.design') . '/backend/css/styles.less', Registry::get('config.dir.design') . '/backend/css/twitterbootstrap.css', $less);
	} catch (exception $ex) {
		exit('lessc fatal error:<br />'.$ex->getMessage());
	}
?>