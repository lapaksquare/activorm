<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2014-03-02 18:52:25 --> Severity: Notice  --> Trying to get property of non-object /Applications/XAMPP/xamppfiles/htdocs/activorm/coding/application/views/n/project/project_detail_view.php 183
ERROR - 2014-03-02 18:52:25 --> Severity: Notice  --> Trying to get property of non-object /Applications/XAMPP/xamppfiles/htdocs/activorm/coding/application/views/n/project/project_detail_view.php 186
ERROR - 2014-03-02 18:52:25 --> Severity: Notice  --> Trying to get property of non-object /Applications/XAMPP/xamppfiles/htdocs/activorm/coding/application/views/n/project/project_detail_view.php 186
ERROR - 2014-03-02 18:52:25 --> Severity: Notice  --> Trying to get property of non-object /Applications/XAMPP/xamppfiles/htdocs/activorm/coding/application/views/n/project/project_detail_view.php 197
ERROR - 2014-03-02 18:52:25 --> Severity: Notice  --> Trying to get property of non-object /Applications/XAMPP/xamppfiles/htdocs/activorm/coding/application/views/n/project/project_detail_view.php 183
ERROR - 2014-03-02 18:52:25 --> Severity: Notice  --> Trying to get property of non-object /Applications/XAMPP/xamppfiles/htdocs/activorm/coding/application/views/n/project/project_detail_view.php 186
ERROR - 2014-03-02 18:52:25 --> Severity: Notice  --> Trying to get property of non-object /Applications/XAMPP/xamppfiles/htdocs/activorm/coding/application/views/n/project/project_detail_view.php 186
ERROR - 2014-03-02 18:52:25 --> Severity: Notice  --> Trying to get property of non-object /Applications/XAMPP/xamppfiles/htdocs/activorm/coding/application/views/n/project/project_detail_view.php 197
ERROR - 2014-03-02 18:52:25 --> Severity: Notice  --> Trying to get property of non-object /Applications/XAMPP/xamppfiles/htdocs/activorm/coding/application/views/n/project/project_detail_view.php 183
ERROR - 2014-03-02 18:52:25 --> Severity: Notice  --> Trying to get property of non-object /Applications/XAMPP/xamppfiles/htdocs/activorm/coding/application/views/n/project/project_detail_view.php 186
ERROR - 2014-03-02 18:52:25 --> Severity: Notice  --> Trying to get property of non-object /Applications/XAMPP/xamppfiles/htdocs/activorm/coding/application/views/n/project/project_detail_view.php 186
ERROR - 2014-03-02 18:52:25 --> Severity: Notice  --> Trying to get property of non-object /Applications/XAMPP/xamppfiles/htdocs/activorm/coding/application/views/n/project/project_detail_view.php 197
ERROR - 2014-03-02 19:43:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'IFNULL(pf.jml_free, 0) jml_free_plan
		FROM
		project__profile pp
		JOIN busines' at line 22 - Invalid query: 
		SELECT
		pp.project_id,
		pp.project_uri,
		pp.project_name,
		pp.project_description,
		pp.project_primary_photo,
		pp.project_period,
		pp.project_period_int,
		pp.project_prize_detail,
		pp.project_prize_category,
		pp.project_tags,
		pp.project_actions_data,
		pp.project_hashtags,
		pp.project_live,
		pp.project_active,
		pp.project_posted,
		pp.business_id,
		pp.jml_winner,
		bp.business_name,
		brm.account_id,
		IFNULL(mp.point, 0) jml_point
		IFNULL(pf.jml_free, 0) jml_free_plan
		FROM
		project__profile pp
		JOIN business__profile bp ON
			bp.business_id = pp.business_id
		JOIN business__rel_member brm ON
			brm.business_id = bp.business_id
		LEFT JOIN member__points mp ON
			mp.account_id = brm.account_id
		LEFT JOIN project__freeplan pf ON
			pf.account_id = brm.account_id
		WHERE 1
		AND pp.project_id = '62'
		
