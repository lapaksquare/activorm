<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Academic Free License version 3.0
 *
 * This source file is subject to the Academic Free License (AFL 3.0) that is
 * bundled with this package in the files license_afl.txt / license_afl.rst.
 * It is also available through the world wide web at this URL:
 * http://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)
 * @license		http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

define('default_title', 'Activorm.com');

define('SALT', 'antonpacaremilevilianadiActivorm.com');

define('FACEBOOK_PAGE_URL', 'http://www.facebook.com/');
define('TWITTER_PAGE_URL', 'http://www.twitter.com/');

define('META_DESCRIPTION', 'Official Website of Activorm: Enter Prize Draws of Your Favorite Brands and Win Prizes.');
define('META_KEYWORDS', 'Activation Platform, Online Marketing Ads, Internet Marketing, Prize, Social Networks');

date_default_timezone_set('Asia/Jakarta');

define('WEB_VERSION', 1);
define('DEV_INVITATION', 0);
define('PREMIUM_PLAN', 1);

/* API FACEBOOK */
define('FACEBOOK_APP_ID', '1425256081020066');
define('FACEBOOK_APP_SECRET', '2c60fb1f43e8b851385dfdc4d866fa7f');

/* API TWITTER */
define('TWITTER_CONSUMER_KEY', 'bihlqJfhrKq3reRCU1FmtQ');
define('TWITTER_CONSUMER_SECRET', 'NVc184QzMzecjTZ8IPoNsTjuyYrwBQnvO4xOOgNU');

if (ENVIRONMENT == "production"){
	define('TWITTER_OAUTH_CALLBACK', 'http://activorm.com/auth/twitter_callback');
}else{
	define('TWITTER_OAUTH_CALLBACK', 'http://activorm.local/kkrf/auth/twitter_callback');
}


/*NOMOR REKENING*/
define('REK_BCA', 1);
define('BCA_REKENING_NOMOR', '7090258791');
define('BCA_REKENING_ATASNAMA', 'Karen Kamal');
define('BCA_REKENING_CABANG', 'KCP Rantai Mulia Kencana');

define('REK_MANDIRI', 0);
define('MANDIRI_REKENING_NOMOR', 'MANDIRI_7090258791');
define('MANDIRI_REKENING_ATASNAMA', 'Karen Kamal MANDIRI');
define('MANDIRI_REKENING_CABANG', 'KCP Rantai Mulia Kencana MANDIRI');

define('GA_CLIENT_ID', '802492281133.apps.googleusercontent.com');
define('GA_CLIENT_SECRET', 'COpdo3DmaYhTFOmQ3pgwBphK');

/* End of file constants.php */
/* Location: ./application/config/constants.php */