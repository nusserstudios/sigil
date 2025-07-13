<?php
/**
 * Single post template file.
 *
 * @package Sigil
 */

get_header();
?>

<div class="container">
    <div class="single-content">
        <?php if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('template-parts/content', 'single'); ?>

                <?php if (comments_open() || get_comments_number()): ?>
                    <?php comments_template(); ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
