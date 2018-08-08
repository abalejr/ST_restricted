<?php
/**
 * Template Name: Dashboard - Archive
 */

st_redirect_if_not_logged_in();
st_redirect_if_not_member();
get_header();

$query_args = array(
    'post_type'      => get_field('post_type'),
    'post_status'    => 'publish',
    'posts_per_page' => 12,
    'order'          => 'DESC',
    'orderby'        => 'date',
    'facetwp'        => TRUE
);
if (get_field('post_type') === 'daily' && get_field('access')) {
    $query_args['tax_query'] = array(
        array (
            'taxonomy' => 'access',
            'field'    => 'term_id',
            'terms'    => get_field('access')
        )
    );
} else if (get_field('post_type') === 'chat-archives' && get_field('access')) {
    $query_args['tax_query'] = array(
        array (
            'taxonomy' => 'access',
            'field'    => 'term_id',
            'terms'    => get_field('access')
        )
    );
} else if (get_field('post_type') === 'learningcenter' && get_field('access')) {
    $query_args['tax_query'] = array(
        array (
            'taxonomy' => 'access',
            'field'    => 'term_id',
            'terms'    => get_field('access')
        )
    );
} else if (get_field('post_type') === 'webinars' && (get_field('member-webinar-type') || get_field('access'))) {
    $query_args['tax_query'] = array();
    if (get_field('member-webinar-type')) {
        $query_args['tax_query'][] = array(
            'taxonomy' => 'member-webinar-type',
            'field'    => 'term_id',
            'terms'    => get_field('member-webinar-type')
        );
    }
    if (get_field('access')) {
        $query_args['tax_query'][] = array(
            'taxonomy' => 'access',
            'field'    => 'term_id',
            'terms'    => get_field('access')
        );
    }
} else if (get_field('post_type') === 'updates' && get_field('update-type')) {
    $query_args['tax_query'] = array(
        array (
            'taxonomy' => 'update-type',
            'field'    => 'term_id',
            'terms'    => get_field('update-type')
        )
    );
}
$query = new WP_Query($query_args);
?>

<a id="top"></a>

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
                <section class="dashboard__content-section">
                    <h2 class="section-title"><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                    <div class="dashboard-filters">
                        <div class="dashboard-filters__count">
                            Showing <?= facetwp_display('counts'); ?>
                        </div>
                        <div class="dashboard-filters__search">
                            <?= facetwp_display('facet', 'search'); ?>
                        </div>
                    </div>
                    <div class="facetwp-template">
                        <?php if ($query->have_posts()): ?>
                            <?php if (get_field('post_type') === 'daily'): ?>
                                <div class="card-grid flex-grid row">
                                    <?php while ($query->have_posts()): $query->the_post(); ?>
                                        <article class="card-grid-spacer flex-grid-item col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="card flex-grid-panel">
                                                <?php
                                                    $image = NULL;
                                                    if (has_post_thumbnail()) {
                                                        $image = get_the_post_thumbnail_url($post->ID);
                                                    }
                                                ?>
                                                <?php if ($image): ?>
                                                    <figure class="card-media card-media--video">
                                                        <a href="<?php the_permalink(); ?>" class="card-image" style="background-image: url(<?= $image ?>);">
                                                            <img src="https://placehold.it/325x183" alt="<?php the_title(); ?>">
                                                        </a>
                                                    </figure>
                                                <?php endif; ?>
                                                <section class="card-body">
                                                    <h4 class="h5 card-title">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h4>
                                                    <span class="article-card__meta"><small><?php echo get_the_date('F d, Y', ''); ?> with <?php the_author(); ?></small></span><br>

                                                    <div class="card-description">
                                                        <div class="u--hide-read-more u--squash"><?php the_excerpt(); ?></div>
                                                    </div>
                                                </section>
                                                <footer class="card-footer">
                                                    <a class="btn btn-tiny btn-default" href="<?php the_permalink(); ?>">Watch Now</a>
                                                </footer>
                                            </div>
                                        </article>
                                    <?php endwhile; ?>
                                </div>
                            <?php elseif (get_field('post_type') === 'chat-archives'): ?>
                                <div class="card-grid flex-grid row">
                                    <?php while ($query->have_posts()): $query->the_post(); ?>
                                        <article class="card-grid-spacer flex-grid-item col-xs-6 col-sm-4 col-md-3">
                                            <div class="card flex-grid-panel">
                                                <section class="card-body text-center">
                                                    <h4 class="h5 card-title u--margin-bottom-0">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h4>
                                                </section>
                                            </div>
                                        </article>
                                    <?php endwhile; ?>
                                </div>
                            <?php elseif (get_field('post_type') === 'learningcenter'): ?>
                                <div class="card-grid flex-grid row">
                                    <?php while ($query->have_posts()): $query->the_post(); ?>
                                        <article class="card-grid-spacer flex-grid-item col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="card flex-grid-panel">
                                                <?php
                                                    $image = NULL;
                                                    if (has_post_thumbnail()) {
                                                        $image = get_the_post_thumbnail_url($post->ID);
                                                    }
                                                ?>
                                                <?php if ($image): ?>
                                                    <figure class="card-media">
                                                        <a href="<?php the_permalink(); ?>" class="card-image" style="background-image: url(<?= $image ?>);">
                                                            <img src="https://placehold.it/325x183" alt="<?php the_title(); ?>">
                                                        </a>
                                                    </figure>
                                                <?php endif; ?>
                                                <section class="card-body">
                                                    <h4 class="h5 card-title">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h4>
                                                    <div class="card-description">
                                                        <div class="u--hide-read-more u--squash"><?php the_excerpt(); ?></div>
                                                    </div>
                                                </section>
                                                <footer class="card-footer">
                                                    <a class="btn btn-tiny btn-default" href="<?php the_permalink(); ?>">Read More</a>
                                                </footer>
                                            </div>
                                        </article>
                                    <?php endwhile; ?>
                                </div>
                            <?php elseif (get_field('post_type') === 'webinars'): ?>
                                <div class="card-grid flex-grid row">
                                    <?php while ($query->have_posts()): $query->the_post(); ?>
                                        <article class="card-grid-spacer flex-grid-item col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="card flex-grid-panel">
                                                <?php
                                                    $image = NULL;
                                                    if (has_post_thumbnail()) {
                                                        $image = get_the_post_thumbnail_url($post->ID);
                                                    }
                                                ?>
                                                <?php if ($image): ?>
                                                    <figure class="card-media">
                                                        <a href="<?php the_permalink(); ?>" class="card-image" style="background-image: url(<?= $image ?>);">
                                                            <img src="https://placehold.it/325x183" alt="<?php the_title(); ?>">
                                                        </a>
                                                    </figure>
                                                <?php endif; ?>
                                                <section class="card-body">
                                                    <h4 class="h5 card-title">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h4>
                                                    <div class="card-description">
                                                        <div class="u--hide-read-more u--squash"><?php the_excerpt(); ?></div>
                                                    </div>
                                                </section>
                                                <footer class="card-footer">
                                                    <a class="btn btn-tiny btn-default" href="<?php the_permalink(); ?>">Read More</a>
                                                </footer>
                                            </div>
                                        </article>
                                    <?php endwhile; ?>
                                </div>
                            <?php elseif (get_field('post_type') === 'updates'): ?>
                                <div class="card-grid flex-grid row">
                                    <?php while ($query->have_posts()): $query->the_post(); ?>
                                        <article class="card-grid-spacer flex-grid-item col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                            <div class="card flex-grid-panel">
                                                <?php
                                                    $image = NULL;
                                                    if (has_post_thumbnail()) {
                                                        $image = get_the_post_thumbnail_url($post->ID);
                                                    }
                                                ?>
                                                <?php if ($image): ?>
                                                    <figure class="card-media">
                                                        <a href="<?php the_permalink(); ?>" class="card-image" style="background-image: url(<?= $image ?>);">
                                                            <img src="https://placehold.it/325x183" alt="<?php the_title(); ?>">
                                                        </a>
                                                    </figure>
                                                <?php endif; ?>
                                                <section class="card-body u--squash">
                                                    <h4 class="h5 card-title u--margin-bottom-0">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h4>
                                                    <p>
                                                        <small>by <?php the_author_link(); ?> on <?= get_the_date('F j, Y') ?></small>
                                                    </p>
                                                </section>
                                                <section class="card-body">
                                                    <div class="card-description">
                                                        <div class="u--hide-read-more u--squash"><?php the_excerpt(); ?></div>
                                                    </div>
                                                </section>
                                                <footer class="card-footer">
                                                    <a class="btn btn-tiny btn-default" href="<?php the_permalink(); ?>">Read More</a>
                                                </footer>
                                            </div>
                                        </article>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                            <div class="facetwp-pagination">
                                <?= facetwp_display('pager'); ?>
                            </div>
                        <?php else: ?>
                            <div class="dashboard-filters__no-results">
                                <div class="content-box">
                                    <div class="content-box__section text-center">
                                        <h2>Your search returned no results.</h2>
                                        <button class="facetwp-reset btn btn-orange btn-lg" onClick="FWP.reset()">Reset Search</button>
                                    </div>
                                </div>
                            </div>
                        <?php endif; wp_reset_query(); ?>
                    </div>
                </section>
            </div>
        </div>
    </main>
</div>

<?php get_template_part('inc/partials/dashboard/sticky-utilities'); ?>

<?php get_footer(); ?>
