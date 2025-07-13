<?php
/**
 * Main template file for displaying posts.
 *
 * @package Sigil
 */

get_header();
?>
<?php if (is_front_page()): ?>
    <section class="hero-section">
        <div class="container-fluid">
            <div class="hero-content">
				<div class="container">
					<div class="hero-text">
						<h1 class="text-balance">
							Rapidly build your next WordPress theme with PicoCSS
						</h1>
						<p>
							<strong>Sigil</strong> is a <a href="https://picocss.com">PicoCSS</a> flavoured <a href="https://wordpress.org">WordPress</a>
							boilerplate theme. It's your go-to starting point for building custom WordPress themes with modern tools and practices.
						</p>
					</div>
					<div class="hero-actions">
						<a href="https://picocss.com" role="button" target="_blank" rel="noopener noreferrer">
							Documentation
						</a>
					</div>
				</div>
            </div>
        </div>
    </section>
<?php endif; ?>

<div class="container">
	<?php if (!is_singular()): ?>
		<?php if (is_archive()): ?>
			<header class="page-header">
				<h1>
					<?php the_archive_title(); ?>
				</h1>
			</header>
		<?php elseif (is_category()): ?>
			<header class="page-header">
				<h1>
					<?php single_cat_title(); ?>
				</h1>
			</header>
		<?php elseif (is_tag()): ?>
			<header class="page-header">
				<h1>
					<?php single_tag_title(); ?>
				</h1>
			</header>
		<?php elseif (is_author()): ?>
			<header class="page-header">
				<h1>
					<?php printf(__('Posts by %s', 'sigil'), get_the_author()); ?>
				</h1>
			</header>
		<?php elseif (is_day()): ?>
			<header class="page-header">
				<h1>
					<?php printf(__('Daily Archives: %s', 'sigil'), get_the_date()); ?>
				</h1>
			</header>
		<?php elseif (is_month()): ?>
			<header class="page-header">
				<h1>
					<?php printf(__('Monthly Archives: %s', 'sigil'), get_the_date('F Y')); ?>
				</h1>
			</header>
		<?php elseif (is_year()): ?>
			<header class="page-header">
				<h1>
					<?php printf(__('Yearly Archives: %s', 'sigil'), get_the_date('Y')); ?>
				</h1>
			</header>
		<?php elseif (is_search()): ?>
			<header class="page-header">
				<h1>
					<?php printf(__('Search results for: %s', 'sigil'), get_search_query()); ?>
				</h1>
			</header>
		<?php elseif (is_404()): ?>
			<header class="page-header">
				<h1>
					<?php _e('Page Not Found', 'sigil'); ?>
				</h1>
			</header>
		<?php endif; ?>
	<?php endif; ?>

    <?php if (have_posts()): ?>
        <div class="posts-list">
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('template-parts/content', is_singular() ? 'single' : ''); ?>
            <?php endwhile; ?>
        </div>

        <?php Sigil\Pagination::render(); ?>
    <?php endif; ?>
</div>

<?php
get_footer();
