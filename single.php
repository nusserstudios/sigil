<?php
/**
 * Single post template file.
 *
 * @package Sigil
 */

get_header();
?>

<main class="wp-block-post-content">
    <div class="single-content">
        <?php if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('inc/content', 'single'); ?>

                <?php if (comments_open() || get_comments_number()): ?>
                    <?php comments_template(); ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
