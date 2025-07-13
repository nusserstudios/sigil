<?php
/**
 * Comments template.
 *
 * @package Sigil
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()): ?>
        <h2 class="comments-title">
            <?php
            printf(
                esc_html(_nx(
                    'One comment',
                    '%1$s comments',
                    get_comments_number(),
                    'comments title',
                    	'sigil'
                )),
                esc_html(number_format_i18n(get_comments_number()))
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments([
                'format'      => 'html5',
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 56,
                'walker'      => new \Sigil\Walkers\CommentWalker(),
            ]);
            ?>
        </ol>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
            <nav class="comment-navigation" id="comment-nav-above" aria-label="<?php esc_attr_e('Comment navigation', 'sigil'); ?>">
                <div class="nav-previous">
                    <?php previous_comments_link(esc_html__('Older Comments &larr;', 'sigil')); ?>
                </div>
                <div class="nav-next">
                    <?php next_comments_link(esc_html__('Newer Comments &rarr;', 'sigil')); ?>
                </div>
            </nav>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'sigil'); ?></p>
    <?php endif; ?>

    <?php
        $commenter = wp_get_current_commenter();

        $req = get_option('require_name_email');
        $aria_req = ($req ? ' aria-required="true"' : '');

        comment_form([
            'fields' => apply_filters('comment_form_default_fields', [
                'author' =>
                    '<p class="comment-form-author">' .
                    '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
                    '" size="30"' . $aria_req . ' placeholder="' . esc_attr__('Your Name*', 'sigil') . '" /></p>',

                'email' =>
                    '<p class="comment-form-email">' .
                    '<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) .
                    '" size="30"' . $aria_req . ' placeholder="' . esc_attr__('Your Email Address*', 'sigil') . '" /></p>',

                'url' =>
                    '<p class="comment-form-url">' .
                    '<input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) .
                    '" size="30" placeholder="' . esc_attr__('Your Website URL', 'sigil') . '" /></p>'
            ]),
            'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
            'class_submit'      => 'comment-submit-btn',
            'comment_field'     => '<textarea id="comment" name="comment" aria-required="true" placeholder="' . esc_attr__('Your comment', 'sigil') . '"></textarea>',
            'logged_in_as'      => '<p class="logged-in-as">',
        ]);
    ?>
</div>
