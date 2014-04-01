<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2014-04-01 15:08:54 --> Severity: Notice  --> Undefined variable: targetPath /Applications/XAMPP/xamppfiles/htdocs/activorm/coding/application/controllers/welcome.php 223
ERROR - 2014-04-01 15:20:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '1) VALUES ('')' at line 1 - Invalid query: INSERT INTO `project__photo_temp` (1) VALUES ('')
ERROR - 2014-04-01 15:20:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '1) VALUES ('')' at line 1 - Invalid query: INSERT INTO `project__photo_temp` (1) VALUES ('')
ERROR - 2014-04-01 23:12:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'FROM
		project__photo_temp ppt
		WHERE 1
		AND ppt.token = 'd2c40ec69bc5853d5bb4' at line 3 - Invalid query: 
		SELECT 
		GROUP_CONCAT(ppt.photo SEPARATOR '/:/') photos,
		FROM
		project__photo_temp ppt
		WHERE 1
		AND ppt.token = 'd2c40ec69bc5853d5bb4e6ae9e6040e11251dc7e'
		AND ppt.business_id = '1'
		AND ppt.isactive = 0
		ORDER BY ppt.tid ASC
		
ERROR - 2014-04-01 23:16:40 --> Query error: Unknown column 'ppt.token' in 'where clause' - Invalid query: 
		UPDATE project__photo_temp SET
		ppt.isactive = 1
		WHERE 1
		AND ppt.token = 'c8759a251d2197012ea1b8c6824657c9c558da30'
		AND ppt.business_id = '1'
		
ERROR - 2014-04-01 23:17:37 --> The path to the image is not correct.
ERROR - 2014-04-01 23:17:37 --> Your server does not support the GD function required to process this type of image.
ERROR - 2014-04-01 23:17:37 --> The path to the image is not correct.
ERROR - 2014-04-01 23:17:37 --> Your server does not support the GD function required to process this type of image.
ERROR - 2014-04-01 23:17:37 --> The path to the image is not correct.
ERROR - 2014-04-01 23:17:37 --> Your server does not support the GD function required to process this type of image.
