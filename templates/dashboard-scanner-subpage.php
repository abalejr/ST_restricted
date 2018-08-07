<?php
/**
 * Template Name: Dashboard - Scanner Subpage
 */

wl_redirect_if_not_logged_in();
get_header();
?>

<a id="top"></a>

<?php while (have_posts()): the_post(); ?>
    <script async>var copyToClipboard=str=>{const el=document.createElement('textarea');el.value=str;el.setAttribute('readonly','');el.style.position='absolute';el.style.left='-9999px';document.body.appendChild(el);const selected=document.getSelection().rangeCount>0?document.getSelection().getRangeAt(0):false;el.select();document.execCommand('copy');document.body.removeChild(el);if(selected){document.getSelection().removeAllRanges();document.getSelection().addRange(selected);}};</script>
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
                        <div class="scanner-title-wrap">
                            <h2 class="section-title u--margin-bottom-0">
                                <?php the_title() ?>
                            </h2>
                            <?php if (!empty(get_field('information'))): ?>
                                <div class="dropdown display-inline-block">
                                    <a href="#" class="u--font-size-xl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-info-circle u--color-blue"></i>
                                    </a>
                                    <nav class="dropdown-menu dropdown-menu--position-bottom-right">
                                        <ul class="check-list check-list--dropdown">
                                            <?php foreach (get_field('information') as $item): ?>
                                                <li><?= $item['information_item'] ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </nav>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="scanner-load-content u--squash">
                            <?php the_content() ?>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
<?php endwhile; ?>

<?php get_template_part('inc/partials/dashboard/sticky-utilities'); ?>

<?php get_footer(); ?>
