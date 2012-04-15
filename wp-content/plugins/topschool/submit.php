<?php

/**
 * Description
 *
 * @package
 * @subpackage
 * @author     Joshua Estes
 * @copyright  2012
 * @version    0.1.0
 * @category
 * @license
 *
 */

// Let's get wordpress in here
define('WP_USE_THEMES', false);
require_once realpath(__DIR__ . '/../../../wp-blog-header.php');

// Load up topschool class
require_once realpath(__DIR__ . '/lib/topschool.class.php');
$topschool = new Topschool();





/**
 * Redirect user to page
 */

/* @var $page stdClass */
$page = get_page_by_path('home');
wp_redirect($page->guid);