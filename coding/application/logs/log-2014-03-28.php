<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2014-03-28 12:00:08 --> Severity: Notice  --> Use of undefined constant team - assumed 'team' D:\RD\document\Projects\PHP\activorm\coding\application\controllers\sales\home.php 20
ERROR - 2014-03-28 12:00:08 --> Severity: Notice  --> Undefined property: Home::$sales_account D:\RD\document\Projects\PHP\activorm\coding\application\controllers\sales\home.php 23
ERROR - 2014-03-28 12:00:19 --> Severity: Notice  --> Undefined property: Home::$sales_account D:\RD\document\Projects\PHP\activorm\coding\application\controllers\sales\home.php 23
ERROR - 2014-03-28 12:00:48 --> Severity: Notice  --> Undefined property: Home::$teams D:\RD\document\Projects\PHP\activorm\coding\application\controllers\sales\home.php 24
ERROR - 2014-03-28 12:18:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')' at line 11 - Invalid query: 
         SELECT DISTINCT
            a.account_id,
            a.account_name,
            a.account_email,
            a.account_primary_photo
         FROM
            sales__team_detail td
            JOIN member__account a ON td.member_id = a.account_id
         WHERE 1
            AND td.team_id = '3'
            AND td.member_id NOT IN ()
		
ERROR - 2014-03-28 12:20:47 --> Severity: Notice  --> Undefined property: CI_DB_mysqli_driver::$query D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 12:23:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '?
            AND td.member_id NOT IN (?,?,?)' at line 10 - Invalid query: 
         SELECT DISTINCT
            a.account_id,
            a.account_name,
            a.account_email,
            a.account_primary_photo
         FROM
            sales__team_detail td
            JOIN member__account a ON td.member_id = a.account_id
         WHERE 1
            AND td.team_id = ?
            AND td.member_id NOT IN (?,?,?)
		
ERROR - 2014-03-28 12:55:40 --> Severity: Notice  --> Undefined index: team D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 14
ERROR - 2014-03-28 12:55:40 --> Severity: Warning  --> Invalid argument supplied for foreach() D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 14
ERROR - 2014-03-28 12:57:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 17
ERROR - 2014-03-28 12:57:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 12:57:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 17
ERROR - 2014-03-28 12:57:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 12:58:18 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 17
ERROR - 2014-03-28 12:58:18 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 12:58:18 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 17
ERROR - 2014-03-28 12:58:18 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Undefined property: stdClass::$members D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 20
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:00:14 --> Severity: Warning  --> array_unshift() expects parameter 1 to be array, null given D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Undefined property: stdClass::$members D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 20
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:00:14 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:00:14 --> Severity: Warning  --> array_unshift() expects parameter 1 to be array, null given D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 114
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 115
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 116
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\models\s_team_model.php 117
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Undefined property: stdClass::$members D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 20
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:00:47 --> Severity: Warning  --> array_unshift() expects parameter 1 to be array, null given D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Undefined property: stdClass::$members D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 20
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:00:47 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:00:47 --> Severity: Warning  --> array_unshift() expects parameter 1 to be array, null given D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:00:58 --> Severity: Notice  --> Undefined property: stdClass::$members D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 20
ERROR - 2014-03-28 17:00:58 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:00:58 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:00:58 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:00:58 --> Severity: Warning  --> array_unshift() expects parameter 1 to be array, null given D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:00:58 --> Severity: Notice  --> Undefined property: stdClass::$members D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 20
ERROR - 2014-03-28 17:00:58 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:00:58 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:00:58 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:00:58 --> Severity: Warning  --> array_unshift() expects parameter 1 to be array, null given D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:02:03 --> Severity: Notice  --> Undefined property: stdClass::$members D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 20
ERROR - 2014-03-28 17:02:03 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:02:03 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:02:03 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:02:03 --> Severity: Warning  --> array_unshift() expects parameter 1 to be array, null given D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:02:03 --> Severity: Notice  --> Undefined property: stdClass::$members D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 20
ERROR - 2014-03-28 17:02:03 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:02:03 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:02:03 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:02:03 --> Severity: Warning  --> array_unshift() expects parameter 1 to be array, null given D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:02:05 --> Severity: Notice  --> Undefined property: stdClass::$members D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 20
ERROR - 2014-03-28 17:02:05 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:02:05 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:02:05 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:02:05 --> Severity: Warning  --> array_unshift() expects parameter 1 to be array, null given D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:02:05 --> Severity: Notice  --> Undefined property: stdClass::$members D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 20
ERROR - 2014-03-28 17:02:05 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:02:05 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:02:05 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:02:05 --> Severity: Warning  --> array_unshift() expects parameter 1 to be array, null given D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:02:15 --> Severity: Notice  --> Undefined property: stdClass::$members D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 20
ERROR - 2014-03-28 17:02:15 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:02:15 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:02:15 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:02:15 --> Severity: Warning  --> array_unshift() expects parameter 1 to be array, null given D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:02:15 --> Severity: Notice  --> Undefined property: stdClass::$members D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 20
ERROR - 2014-03-28 17:02:15 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:02:15 --> Severity: Notice  --> Trying to get property of non-object D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 21
ERROR - 2014-03-28 17:02:15 --> Severity: Notice  --> Undefined property: stdClass::$leader D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:02:15 --> Severity: Warning  --> array_unshift() expects parameter 1 to be array, null given D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 23
ERROR - 2014-03-28 17:17:44 --> Severity: Notice  --> Undefined offset: 5 D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 36
ERROR - 2014-03-28 17:17:44 --> Severity: Notice  --> Undefined offset: 6 D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 36
ERROR - 2014-03-28 17:17:44 --> Severity: Notice  --> Undefined offset: 7 D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 36
ERROR - 2014-03-28 17:17:46 --> Severity: Notice  --> Undefined offset: 5 D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 36
ERROR - 2014-03-28 17:17:46 --> Severity: Notice  --> Undefined offset: 6 D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 36
ERROR - 2014-03-28 17:17:46 --> Severity: Notice  --> Undefined offset: 7 D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 36
ERROR - 2014-03-28 17:26:34 --> Severity: Notice  --> Undefined variable: self_row_max D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 37
ERROR - 2014-03-28 17:26:34 --> Severity: Notice  --> Undefined variable: self_row_max D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 37
ERROR - 2014-03-28 17:30:36 --> Severity: Notice  --> Undefined offset: 5 D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 40
ERROR - 2014-03-28 17:30:36 --> Severity: Notice  --> Undefined offset: 6 D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 40
ERROR - 2014-03-28 17:30:36 --> Severity: Notice  --> Undefined offset: 7 D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 40
ERROR - 2014-03-28 17:30:36 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 40
ERROR - 2014-03-28 17:30:36 --> Severity: Notice  --> Undefined offset: 2 D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 40
ERROR - 2014-03-28 17:30:36 --> Severity: Notice  --> Undefined offset: 3 D:\RD\document\Projects\PHP\activorm\coding\application\views\s\template.php 40
ERROR - 2014-03-28 18:50:32 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:50:32 --> Severity: Warning  --> imagecreatetruecolor(): Invalid image dimensions D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 789
ERROR - 2014-03-28 18:50:32 --> Severity: Warning  --> imagecopyresampled() expects parameter 1 to be resource, boolean given D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 797
ERROR - 2014-03-28 18:50:32 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2014-03-28 18:50:33 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecreatetruecolor(): Invalid image dimensions D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 789
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecopyresampled() expects parameter 1 to be resource, boolean given D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 797
ERROR - 2014-03-28 18:50:33 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2014-03-28 18:50:33 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecreatetruecolor(): Invalid image dimensions D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 789
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecopyresampled() expects parameter 1 to be resource, boolean given D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 797
ERROR - 2014-03-28 18:50:33 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2014-03-28 18:50:33 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecreatetruecolor(): Invalid image dimensions D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 789
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecopyresampled() expects parameter 1 to be resource, boolean given D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 797
ERROR - 2014-03-28 18:50:33 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2014-03-28 18:50:33 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecreatetruecolor(): Invalid image dimensions D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 789
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecopyresampled() expects parameter 1 to be resource, boolean given D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 797
ERROR - 2014-03-28 18:50:33 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2014-03-28 18:50:33 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecreatetruecolor(): Invalid image dimensions D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 789
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecopyresampled() expects parameter 1 to be resource, boolean given D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 797
ERROR - 2014-03-28 18:50:33 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2014-03-28 18:50:33 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecreatetruecolor(): Invalid image dimensions D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 789
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecopyresampled() expects parameter 1 to be resource, boolean given D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 797
ERROR - 2014-03-28 18:50:33 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2014-03-28 18:50:33 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecreatetruecolor(): Invalid image dimensions D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 789
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecopyresampled() expects parameter 1 to be resource, boolean given D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 797
ERROR - 2014-03-28 18:50:33 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2014-03-28 18:50:33 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecreatetruecolor(): Invalid image dimensions D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 789
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecopyresampled() expects parameter 1 to be resource, boolean given D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 797
ERROR - 2014-03-28 18:50:33 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2014-03-28 18:50:33 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecreatetruecolor(): Invalid image dimensions D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 789
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecopyresampled() expects parameter 1 to be resource, boolean given D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 797
ERROR - 2014-03-28 18:50:33 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2014-03-28 18:50:33 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecreatetruecolor(): Invalid image dimensions D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 789
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecopyresampled() expects parameter 1 to be resource, boolean given D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 797
ERROR - 2014-03-28 18:50:33 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2014-03-28 18:50:33 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecreatetruecolor(): Invalid image dimensions D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 789
ERROR - 2014-03-28 18:50:33 --> Severity: Warning  --> imagecopyresampled() expects parameter 1 to be resource, boolean given D:\RD\document\Projects\PHP\activorm\coding\system\libraries\Image_lib.php 797
ERROR - 2014-03-28 18:50:33 --> Unable to save the image. Please make sure the image and file directory are writable.
ERROR - 2014-03-28 18:52:32 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:52:32 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
ERROR - 2014-03-28 18:52:32 --> Severity: Notice  --> Undefined offset: 1 D:\RD\document\Projects\PHP\activorm\coding\application\libraries\Mediamanager.php 25
