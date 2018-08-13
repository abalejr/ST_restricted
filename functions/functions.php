<?php
/**
 * Generate child theme functions and definitions
 * @package Generate
 */

// Custom Functions
require_once(__DIR__ . '/inc/st-functions/st-functions.php');         // Proprietary functions
require_once(__DIR__ . '/inc/st-functions/redirection.php');          // Redirection functions

// Functions
require_once(__DIR__ . '/inc/wl-functions/helpers.php');              // Global helper functions
require_once(__DIR__ . '/inc/wl-functions/assets.php');               // Manage theme assets
require_once(__DIR__ . '/inc/wl-functions/ajax.php');                 // Ajax
require_once(__DIR__ . '/inc/wl-functions/breadcrumbs.php');          // Breadcrumbs
require_once(__DIR__ . '/inc/wl-functions/nav-menus.php');            // Nav Menus
require_once(__DIR__ . '/inc/wl-functions/taxonomies.php');           // Taxonomies
require_once(__DIR__ . '/inc/wl-functions/theme-setup.php');          // Theme Setup
require_once(__DIR__ . '/inc/wl-functions/vendor-generatepress.php'); // GeneratePress

// Woocommerce
require_once(__DIR__ . '/inc/wl-functions/vendor-facetwp.php');       // WooCommerce
require_once(__DIR__ . '/inc/wl-functions/vendor-woocommerce.php');   // WooCommerce

// Custom Fields
require_once(__DIR__ . '/inc/fields/classes.php');                    // Fields - Classes
require_once(__DIR__ . '/inc/fields/product-course.php');             // Fields - Product - Course
require_once(__DIR__ . '/inc/fields/taxonomy-trader.php');            // Fields - Taxonomy - Trader
require_once(__DIR__ . '/inc/fields/account-management.php');         // Fields - Account - Manager 
require_once(__DIR__ . '/inc/fields/daily.php');                      // Fields - Daily Video 
require_once(__DIR__ . '/inc/fields/coupon.php');                     // Fields - Coupon
require_once(__DIR__ . '/inc/fields/chatroom-archive.php');           // Fields - Room Archive
require_once(__DIR__ . '/inc/fields/dashboard-settings.php');         // Fields - Dashboard Template
require_once(__DIR__ . '/inc/fields/dashboard-sidebar.php');          // Fields - Dashboard Template
require_once(__DIR__ . '/inc/fields/dashboard-scanner.php');          // Fields - Dashboard Template
require_once(__DIR__ . '/inc/fields/dashboard-scanner-subpage.php');  // Fields - Dashboard Template
require_once(__DIR__ . '/inc/fields/dashboard-header.php');           // Fields - Dashboard Template
require_once(__DIR__ . '/inc/fields/dashboard-archive.php');          // Fields - Dashboard Template
require_once(__DIR__ . '/inc/fields/dashboard-landing.php');          // Fields - Dashboard Template
require_once(__DIR__ . '/inc/fields/dashboard-member.php');           // Fields - Dashboard Template

// Rest Endpoints
require_once(__DIR__ . '/inc/rest/daily.php');                        // Endpoint - Daily Videos

// Add Shortcodes
function options_restricted_shortcode() {

	<div class="non-member-container">
	    <h1 style="margin-bottom:5px;">Whoops! Sorry.</h1>
	    <p>Looks like you don't have access to this content! If you're already a member, you can <a href="https://www.simplertrading.com/dashboard/">sign in here</a>.</p>
	    <div class="start-trial-box">
	        <p><strong>If you&#39;re not a member, no worries!</strong></p>
	        <p style="margin-bottom:20px">Sign up here for a <strong>30-Day Trial </strong>to any of our memberships for only $7 and get full, instant access
	            to some truly amazing features like:</p>
	<div class="trial-row">
	        <div class="trial-list">
	            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Live Trading Chatroom</p>
	            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Live Trade Alerts</p>
	        </div>
	        <div class="trial-list">
	            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Member-Only Webinars</p>
	            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Premium Nightly Newsletters</p>
	        </div>
	        <div class="trial-list">
	            <p><i class="fa fa-check-circle" aria-hidden="true"></i> Dynamic Trading Forum</p>
	            <p><i class="fa fa-check-circle" aria-hidden="true"></i> And so much more!</p>
	        </div>
	</div>
	        <hr style="margin: 20px 0;">
	        <p style="margin-bottom:0.6em;">Learn More:</p>
	        <a href="https://www.simplertrading.com/join/options/o-trial/" class="non-member-btn foundation-color"><span>SIMPLER</span>TRADING<sup>&reg;</sup> &#124; Foundation</a>
	    </div>
	    <h1 class="text-center">Have Questions? Call us at (512) 266-8659<br> or email <a href="mailto:support@simplertrading.com">support@SimplerTrading.com.</a></h1>
	</div>

}
add_shortcode( 'options_restricted', 'options_restricted_shortcode' );