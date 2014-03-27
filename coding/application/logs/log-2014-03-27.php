<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2014-03-27 21:08:07 --> Query error: Unknown column 'bp.account_type' in 'where clause' - Invalid query: 
		SELECT
		bp.business_name,
		bp.business_uri,
		ma.account_primary_photo merchant_logo
		FROM
		business__profile bp
		JOIN business__rel_member brm ON
			brm.business_id = bp.business_id
		JOIN member__account ma ON
			ma.account_id = brm.account_id
		WHERE 1
		AND bp.account_type = 'business'
		AND bp.account_primary_photo IS NOT NULL
		ORDER BY bp.business_name ASC
		
ERROR - 2014-03-27 21:08:17 --> Query error: Unknown column 'bp.account_primary_photo' in 'where clause' - Invalid query: 
		SELECT
		bp.business_name,
		bp.business_uri,
		ma.account_primary_photo merchant_logo
		FROM
		business__profile bp
		JOIN business__rel_member brm ON
			brm.business_id = bp.business_id
		JOIN member__account ma ON
			ma.account_id = brm.account_id
		WHERE 1
		AND ma.account_type = 'business'
		AND bp.account_primary_photo IS NOT NULL
		ORDER BY bp.business_name ASC
		
