<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-content">
        <div class="post-main">
            <h2 class="post-title">
                <a href="<?php the_permalink(); ?>" class="no-underline"><?php the_title(); ?></a>
            </h2>
            
            <div class="post-meta">
                <time datetime="<?php echo get_the_date( 'c' ); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
                <div class="post-author">
                    <div class="author-avatar">
                        <?php
                            echo get_avatar(get_the_author_meta( 'ID' ), 48, '', esc_attr(sprintf(__('Avatar for %s', 'sigil'), get_the_author())));
                        ?>
                    </div>
                    <div class="author-name">
                        <span><?php the_author(); ?></span>
                    </div>
                </div>
            </div>
            
            <div class="post-excerpt">
                <?php the_excerpt(); ?>
            </div>
            
            <a class="read-more-btn no-underline" 
               aria-label="<?php echo esc_attr(sprintf(__('Read more: %s', 'sigil'), get_the_title())); ?>" 
               href="<?php the_permalink(); ?>" 
               role="button">
                <?php _e('Read more', 'sigil'); ?>
            </a>
        </div>
    </div>
</article>
