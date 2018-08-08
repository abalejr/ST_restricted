<?php
/**
 * Title: Helpers
 * Description: These are global helper functions for the theme.
 */

if (!function_exists('webpack')) {
    /**
     * Get the path to a versioned webpack asset.
     *
     * @param  string  $file
     * @return string
     */
    function webpack($file, $editor = FALSE)
    {
        static $manifest = NULL;

        if (is_null($manifest)) {
            $manifest = json_decode(@file_get_contents(get_theme_root() . '/simpler-trading/build/manifest.json'), TRUE);
        }
        $path     = NULL;

        if (isset($manifest[$file])) {
            $path = empty($editor) ? '/wp-content/themes/simpler-trading' . $manifest[$file] : $manifest[$file];
        }

        return $path;
    }
}

/**
 * Enqueue a given asset.
 *
 * @param  string  $file
 * @return voide
 */
function wl_enqueue_asset($file = NULL, $dependencies = [], $in_footer = TRUE)
{

    if (!is_null($file)) {
        $prefix   = 'wlion-';
        $fileinfo = pathinfo($file);
        $ext      = $fileinfo['extension'];
        $name     = $fileinfo['filename'];
        $path     = webpack($file);

        if (!is_null($path)) {
            switch($ext) {
                case 'js':
                    wp_enqueue_script($prefix . $name, $path, $dependencies, FALSE, $in_footer);
                    break;
                case 'css':
                    wp_enqueue_style($prefix . $name, $path, $dependencies, FALSE, 'all');
                    break;
                default:
                    break;
            }
        }
    }
}

if (!function_exists('slugify')) {
    /**
     * Convert a string to a slug.
     *
     * @param  string $string
     * @return string
     */
    function slugify($string)
    {
        if (is_string($string)) {
            $string = strtolower(str_replace(' ', '-', $string));
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
            return $string;
        } else {
            return FALSE;
        }
    }
}

/**
 * Setup post ID (needed primarily for post list pages).
 *
 * @param  string $section
 * @return int
 */
function wl_get_post_id($section = '')
{
    global $post;
    $post_id = NULL;

    if (is_object($post)) {
        $post_id = $post->ID;
    }

    if (is_front_page()) { // Default homepage or static homepage
        $post_id = get_option('page_on_front');
    } elseif (is_home() or is_category() or is_author() or is_tag()) { // Blog pages
        $post_id = get_option('page_for_posts');
    } elseif (is_search() or is_404()) { // Search or 404 page
        $post_id = NULL;
    }

    if ($section != 'head') {
        if (is_singular('post')) {
            $post_id = get_option('page_for_posts');
        }
    }

    return $post_id;
}

/**
 * Helper to check if we are on a product archive
 * that should have the filters applied.
 *
 * @param  string $section
 * @return int
 */
function is_product_archive_with_filters()
{
    return (is_tax('product_cat', 'courses') or is_tax('product_cat', 'indicators'));
}

/**
 * Check if the current user belongs to a
 * particular membership plan.
 *
 * @param  string|array $membership_plans
 * @return bool
 */
function wl_user_has_plan($membership_plans)
{
    $plans = wl_get_user_membership_plans_by_slug();

    if (!is_array($membership_plans)) {
        $membership_plans = [$membership_plans];
    }

    foreach ($membership_plans as $membership_plan) {
        if (in_array($membership_plan, $plans)) {
            return TRUE;
        }
    }

    return FALSE;
}

/**
 * Get a list of all membership plans by slug.
 *
 * @return array
 */
function wl_get_user_membership_plans_by_slug()
{
    $plans = [];

    $wc_plans = wl_get_user_membership_plans();
    foreach ($wc_plans as $plan) {
        $plans[] = $plan->plan->slug;

        // Need to manually normalize slug names. (i.e. optionsgold should be identified by options)
        if (strpos($plan->plan->slug, 'options') !== false) {
            $plans[] = 'options';
        } elseif (strpos($plan->plan->slug, 'futures') !== false) {
                $plans[] = 'futures';
        } elseif (strpos($plan->plan->slug, 'bias') !== false) {
            $plans[] = 'bias';
        } elseif (strpos($plan->plan->slug, 'fibonacci') !== false) {
            $plans[] = 'fibonacci';
        } elseif (strpos($plan->plan->slug, 'crypto') !== false) {
            $plans[] = 'crypto';
        } elseif (strpos($plan->plan->slug, 'scanner') !== false) {
            $plans[] = 'scanner';
        }
    }

    return $plans;
}

/**
 * Get a list of all membership plans for the
 * current user.
 *
 * @return array
 */
function wl_get_user_membership_plans()
{
    static $plans = [];
    $user_id = get_current_user_id();

    if (!$user_id) {
        $plans = [];
    } elseif (empty($plans)) {
        $plans = wc_memberships_get_user_memberships($user_id, ['active']);
    }

    return $plans;
}

/**
 * Get the base path for the dashboard
 * from the dashboard settings.
 *
 * @return string
 */
function wl_get_dashboard_base_path()
{
    static $dashboard_base_path = '';

    if (!$dashboard_base_path) {
        $dashboard_root_page_id = get_field('dashboard_root_page', 'option');
        if ($dashboard_root_page_id) {
            $dashboard_base_path = get_page($dashboard_root_page_id)->post_name;
        } else {
            $dashboard_base_path = 'dashboard';
        }
    }

    return $dashboard_base_path;
}

/**
 * Get the name of the template to be used for
 * building the page based on page name.
 *
 * @return string
 */
function wl_get_dashboard_template_name()
{
    global $post;
    $page_template = $post->post_name;

    if ($page_template === wl_get_dashboard_base_path()) {
        if (count(wl_get_user_membership_plans())) {
            $page_template = 'dashboard-default';
        } else {
            $page_template = 'dashboard-trial';
        }
    }

    return $page_template;
}

/**
 * Determine if user has access to restricted
 * page content.
 *
 * @param  int $page_id
 * @return boolean
 */
function wl_user_has_page_access($page_id)
{
    if (!$page_id) {
        return FALSE;
    }

    return current_user_can('wc_memberships_view_restricted_post_content', $page_id);
}

function wl_get_primary_dashboard_menu()
{
    global $post;
    static $nav = [];

    if (empty($nav)) {
        $nav = get_field('dashboard_menu', 'option');
        foreach ($nav as $i => $primary_page) {
            if ($primary_page['page'] && $primary_page['page']->ID === $post->ID) {
                $nav[$i]['current'] = TRUE;
            } else {
                $nav[$i]['current'] = FALSE;
            }

            if (!empty($primary_page['submenu'])) {
                foreach ($primary_page['submenu'] as $ii => $secondary_page) {
                    if ($secondary_page['page'] && $secondary_page['page']->ID === $post->ID) {
                        $nav[$i]['current'] = TRUE;
                        $nav[$i]['submenu'][$ii]['current'] = TRUE;
                    } else {
                        $nav[$i]['submenu'][$ii]['current'] = FALSE;
                    }

                    if (!empty($secondary_page['submenu'])) {
                        foreach ($secondary_page['submenu'] as $iii => $tertiary_page) {
                            if ($tertiary_page['page']->ID === $post->ID) {
                                $nav[$i]['current'] = TRUE;
                                $nav[$i]['submenu'][$ii]['current'] = TRUE;
                                $nav[$i]['submenu'][$ii]['submenu'][$iii]['current'] = TRUE;
                            } else {
                                $nav[$i]['submenu'][$ii]['submenu'][$iii]['current'] = FALSE;
                            }
                        }
                    } else {
                        $nav[$i]['submenu'][$ii]['submenu'] = [];
                    }
                }
            } else {
                $nav[$i]['submenu'] = [];
            }
        }
    }

    return $nav;
}

function wl_get_secondary_dashboard_menu()
{
    global $post;
    $nav = wl_get_primary_dashboard_menu();

    foreach ($nav as $primary_page) {
        if ($primary_page['page']->ID === $post->ID) {
            if (!empty($primary_page['submenu'])) {
                return $primary_page['submenu'];
            }
            return [];
        }

        foreach ($primary_page['submenu'] as $secondary_page) {
            if ($secondary_page['page'] && ($secondary_page['page']->ID === $post->ID || $secondary_page['page']->ID === wp_get_post_parent_id($post->ID))) {
                if (!empty($primary_page['submenu'])) {
                    return $primary_page['submenu'];
                }
                return [];
            }
        }
    }

    return [];
}

function wl_get_tertiary_dashboard_menu()
{
    global $post;
    $nav = wl_get_secondary_dashboard_menu();

    foreach ($nav as $secondary_page) {
        if ($secondary_page['page'] && $secondary_page['page']->ID === $post->ID) {
            if (!empty($secondary_page['submenu'])) {
                return $secondary_page['submenu'];
            }
            return [];
        }

        foreach ($secondary_page['submenu'] as $tertiary_page) {
            if ($tertiary_page['page']->ID === $post->ID) {
                if (!empty($secondary_page['submenu'])) {
                    return $secondary_page['submenu'];
                }
                return [];
            }
        }
    }

    return [];
}

function wl_get_latest_updates_query($access = array(), $count = 6)
{
    $query_args = array(
        'post_type'      => array( 'daily', 'learningcenter', 'webinar', 'updates' ),
        'post_status'    => 'publish',
        'posts_per_page' => $count,
        'order'          => 'DESC',
        'orderby'        => 'date',
    );

    if (!empty($access)) {
        $query_args['tax_query'] = array(
            array (
                'taxonomy' => 'access',
                'field'    => 'term_id',
                'terms'    => $access
            )
        );
    }

    return new WP_Query($query_args);
}

function wl_redirect_if_not_logged_in()
{
    if (!is_user_logged_in()) {
        $page_id = get_field('id');
        $parent_page_id = wp_get_post_parent_id($page_id);
        if ($parent_page_id === 401613) {
            wp_redirect(home_url('dashboard/options/get-access'));
        } else {
            wp_redirect(home_url('dashboard/account'));
        }
    }
}

function wl_get_dashboard_page_title($post_id)
{
    $title = get_the_title($post_id);

    if (get_post($post_id)->post_name === 'account') {
        $title = 'Settings';
    } else {
        $parent_id = wp_get_post_parent_id($post_id);
        if ($parent_id && get_post($parent_id)->post_name !== wl_get_dashboard_base_path()) {
            $title = get_post($parent_id)->post_title;

            $grandparent_id = wp_get_post_parent_id($parent_id);
            if ($grandparent_id && get_post($grandparent_id)->post_name !== wl_get_dashboard_base_path()) {
                $title = get_post($grandparent_id)->post_title;
            }
        }
    }

    return $title;
}

function wl_get_start_here_link($post_id)
{
    $start_here_link = get_field('start_here', $post_id);

    $parent_id = wp_get_post_parent_id($post_id);
    if ($parent_id && get_post($parent_id)->post_name !== wl_get_dashboard_base_path()) {
        $start_here_link = get_field('start_here', $parent_id);

        $grandparent_id = wp_get_post_parent_id($parent_id);
        if ($grandparent_id && get_post($grandparent_id)->post_name !== wl_get_dashboard_base_path()) {
            $start_here_link = get_field('start_here', $grandparent_id);
        }
    }

    return $start_here_link;
}

function wl_get_trading_room($post_id)
{
    // Get correct ID
    $parent_id = wp_get_post_parent_id($post_id);
    if ($parent_id && get_post($parent_id)->post_name !== wl_get_dashboard_base_path()) {
        $post_id = $parent_id;

        $grandparent_id = wp_get_post_parent_id($parent_id);
        if ($grandparent_id && get_post($grandparent_id)->post_name !== wl_get_dashboard_base_path()) {
            $post_id = $grandparent_id;
        }
    }

    // Get trading room fields
    if (get_field('trading_room', $post_id)) {
        $trading_room = [
            'room'  => get_field('trading_room', $post_id),
            'rules' => get_field('trading_room_rules', $post_id),
        ];

        $required_plan = [];
        foreach (get_field('trading_room_access', $post_id) as $plan) {
            $required_plan[] = $plan->post_name;
        }

        if (wl_user_has_plan($required_plan)) {
            return $trading_room;
        }
    }

    return NULL;
}
