<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body>
	<div class="error-page">
		<div class="error-content">
			<div class="error-message">
				<div class="error-code">404</div>
				<div class="error-divider"></div>
				<p class="error-text"><?php _e( 'Sorry, the page you are looking for could not be found.', 'sigil' ); ?></p>
				<a href="<?php echo get_bloginfo( 'url' ); ?>" role="button">
					<?php _e( 'Go Home', 'sigil' ); ?>
				</a>
			</div>
		</div>
	</div>

    <?php wp_footer(); ?>
</body>
</html>
