<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="post-header">
        <h1 class="post-title text-balance"><?php the_title(); ?></h1>

        <?php if(! is_page()): ?>
            <div class="post-meta">
                <time datetime="<?php echo get_the_date( 'c' ); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
                <span class="post-author">by <?php the_author(); ?></span>
            </div>
        <?php endif; ?>
    </header>

    <?php if(has_post_thumbnail()): ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail('large'); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>
</article>
