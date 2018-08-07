<?php
/**
 * Template Name: Dashboard - Landing
 */

wl_redirect_if_not_logged_in();
get_header();

$template = wl_get_dashboard_template_name();
?>

<a id="top"></a>

<?php while (have_posts()): the_post(); ?>
    <div class="dashboard">
        <aside class="dashboard__sidebar">
            <?php get_template_part('inc/partials/dashboard/nav', 'primary'); ?>
            <?php get_template_part('inc/partials/dashboard/nav', 'secondary'); ?>
        </aside>
        <main class="dashboard__main <?= $template === 'dashboard-trial' ? 'dashboard__main--gradient-fade' : '' ?>">
            <?php if ($template !== 'dashboard-trial'): ?>
                <?php get_template_part('inc/partials/dashboard/header', 'landing'); ?>
                <?php get_template_part('inc/partials/dashboard/nav', 'tertiary'); ?>
            <?php endif; ?>

            <div class="dashboard__content">
                <div class="dashboard__content-main">
                    <?php get_template_part('inc/partials/dashboard/templates/content', $template); ?>
                </div>

                <?php if ($template !== 'dashboard-trial'): ?>
                    <?php get_template_part('inc/partials/dashboard/sidebar'); ?>
                <?php endif; ?>
            </div>
        </main>
    </div>
<?php endwhile; ?>

<?php get_template_part('inc/partials/dashboard/sticky-utilities'); ?>

<?php get_footer(); ?>
