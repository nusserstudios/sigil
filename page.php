<?php
/**
 * Main template file for displaying posts.
 *
 * @package Sigil
 */

get_header();
?>
<main>
    <?php if (have_posts()): ?>
        <div class="posts-list">
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('inc/content', 'page'); ?>
            <?php endwhile; ?>
        </div>

        <?php Sigil\Pagination::render(); ?>
    <?php endif; ?>
</main>

<?php
get_footer();
