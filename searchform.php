<form method="GET" action="<?php echo get_bloginfo('url'); ?>" class="search-form">
    <input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php _e('Search'); ?>" aria-label="Search">
    <button type="submit" aria-label="Submit search">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" width="16" height="16">
            <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
        </svg>
    </button>
</form>
