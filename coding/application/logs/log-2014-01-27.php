<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2014-01-27 22:26:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ns.newsletter_id = '1'' at line 12 - Invalid query: 
		SELECT
		ns.newsletter_id,
		ns.newsletter_subject,
		ns.newsletter_body,
		ns.newsletter_target,
		ns.newsletter_testing_email,
		ns.newsletter_sending_schedule,
		ns.status
		FROM
		newsletter ns
		WHERE 1
		ns.newsletter_id = '1'
		
