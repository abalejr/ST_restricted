<?php
/**
 * Generate child theme functions and definitions
 * @package Generate
 */

// Custom Functions
require_once(__DIR__ . '/inc/st-functions/st-functions.php');

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