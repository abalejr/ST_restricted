<?php
/**
 * Template Name: Dashboard - Account
 */

$template = wl_get_dashboard_template_name();
get_header();
?>

<a id="top"></a>

<?php while (have_posts()): the_post(); ?>
    <div class="dashboard">
        <aside class="dashboard__sidebar">
            <?php get_template_part('inc/partials/dashboard/nav', 'primary'); ?>
            <?php get_template_part('inc/partials/dashboard/nav', 'secondary'); ?>
        </aside>
        <main class="dashboard__main <?= !is_user_logged_in() ? 'dashboard__main--gradient' : '' ?>">
            <?php get_template_part('inc/partials/dashboard/header', 'simple'); ?>

            <div class="dashboard__content">
                <div class="dashboard__content-main">
                    <section class="dashboard__content-section">
                        <?php the_content() ?>
                    </section>
                </div>
            </div>
        </main>
    </div>
<?php endwhile; ?>

<?php get_template_part('inc/partials/dashboard/sticky-utilities'); ?>

<?php get_footer(); ?>
