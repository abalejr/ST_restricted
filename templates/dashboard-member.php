<?php
/**
 * Template Name: Dashboard - Membership Dashboard
 */

wl_redirect_if_not_logged_in();
get_header();

global $post;
$query = wl_get_latest_updates_query(get_field('latest_updates_access'));
?>

<a id="top"></a>

<?php while (have_posts()): the_post(); ?>
    <div class="dashboard">
        <aside class="dashboard__sidebar">
            <?php get_template_part('inc/partials/dashboard/nav', 'primary'); ?>
            <?php get_template_part('inc/partials/dashboard/nav', 'secondary'); ?>
        </aside>
        <main class="dashboard__main">
            <?php get_template_part('inc/partials/dashboard/header'); ?>
            <?php get_template_part('inc/partials/dashboard/nav', 'tertiary'); ?>

            <div class="dashboard__content">
                <div class="dashboard__content-main">
                    <?php if ($query->have_posts()): ?>
                        <section class="dashboard__content-section u--background-color-white">
                            <h2 class="section-title">Latest Updates</h2>
                            <div class="article-cards row flex-grid">
                                <?php while ($query->have_posts()): $query->the_post(); ?>
                                    <?php get_template_part('inc/partials/dashboard/card'); ?>
                                <?php endwhile; ?>
                            </div>
                        </section>
                    <?php endif; wp_reset_postdata(); ?>
                    <?php get_template_part('inc/partials/dashboard/tow', 'feature'); ?>
                </div>

                <?php get_template_part('inc/partials/dashboard/sidebar'); ?>
            </div>
        </main>
    </div>
<?php endwhile; ?>

<?php get_template_part('inc/partials/dashboard/sticky-utilities'); ?>

<?php get_footer(); ?>
