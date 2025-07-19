<?php
/**
 * Theme footer template.
 *
 * @package Sigil
 */
?>
    </main>
        <?php do_action('sigil_content_end'); ?>
    </div>

    <?php do_action('sigil_content_after'); ?>

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="footer-container">
            <?php do_action('sigil_footer'); ?>
            <div class="footer-content">
                <small>&copy; <?php echo esc_html(date_i18n('Y')); ?> - <?php bloginfo('name'); ?></small>
            </div>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>
</body>

</html>
