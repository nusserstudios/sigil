<?php

namespace Sigil;

use WP_Query;

class Pagination
{
    public const SVG_PREV = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" width="16" height="16">
        <path fill-rule="evenodd" d="M9.78 4.22a.75.75 0 0 1 0 1.06L7.06 8l2.72 2.72a.75.75 0 1 1-1.06 1.06L5.47 8.53a.75.75 0 0 1 0-1.06l3.25-3.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
    </svg>';

    public const SVG_NEXT = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" width="16" height="16">
        <path fill-rule="evenodd" d="M6.22 4.22a.75.75 0 0 1 1.06 0l3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06L8.94 8 6.22 5.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
    </svg>';

    public static function render(?WP_Query $query = null): void
    {
        if (is_singular()) {
            return;
        }

        global $wp_query;
        $original_query = null;

        if ($query) {
            $original_query = $wp_query;
            $wp_query = $query;
        }

        if ($wp_query->max_num_pages <= 1) {
            return;
        }

        $paged = max(1, absint($wp_query->get('paged', 1)));
        $max = (int) $wp_query->max_num_pages;
        $links = self::generate_pagination_links($paged, $max);

        echo '<nav class="pagination-navigation" aria-label="' . esc_attr__('Posts pagination', 'sigil') . '" role="navigation">';
        echo '<ul class="pagination">';

        self::render_previous_link($paged, $links);
        self::render_page_links($paged, $links);
        self::render_next_link($paged, $max, $links);

        echo '</ul></nav>';

        if ($original_query) {
            $wp_query = $original_query;
        }
    }

    private static function generate_pagination_links(int $paged, int $max): array
    {
        $links = [$paged];

        if ($paged >= 3) {
            $links[] = $paged - 2;
            $links[] = $paged - 1;
        }

        if ($paged + 2 <= $max) {
            $links[] = $paged + 1;
            $links[] = $paged + 2;
        }

        sort($links);
        return array_unique($links);
    }

    private static function render_previous_link(int $paged, array $links): void
    {
        if (in_array(1, $links)) {
            return;
        }

        $prev_link = get_previous_posts_link();
        if ($prev_link) {
            $prev_url = get_pagenum_link($paged - 1);
            printf(
                '<li><a href="%s" class="page-link page-link-prev" aria-label="%s" rel="prev">%s<span class="screen-reader-text">%s</span></a></li>',
                esc_url($prev_url),
                esc_attr__('Go to previous page', 'sigil'),
                self::SVG_PREV,
                esc_html__('Previous page', 'sigil')
            );
        }

        if (!in_array(2, $links)) {
            echo '<li class="page-item-spacer" aria-hidden="true">...</li>';
        }
    }

    private static function render_page_links(int $paged, array $links): void
    {
        foreach ($links as $link) {
            if ($paged === $link) {
                // Current page - use span with aria-current
                printf(
                    '<li><span class="page-link current" aria-current="page" aria-label="%s">%s</span></li>',
                    esc_attr(sprintf(__('Current page %d', 'sigil'), $link)),
                    esc_html($link)
                );
            } else {
                // Other pages - use links with aria-label
                printf(
                    '<li><a href="%s" class="page-link" aria-label="%s">%s</a></li>',
                    esc_url(get_pagenum_link($link)),
                    esc_attr(sprintf(__('Go to page %d', 'sigil'), $link)),
                    esc_html($link)
                );
            }
        }
    }

    private static function render_next_link(int $paged, int $max, array $links): void
    {
        if (!in_array($max, $links)) {
            if (!in_array($max - 1, $links)) {
                echo '<li class="page-item-spacer" aria-hidden="true">...</li>';
            }
        }

        $next_link = get_next_posts_link();
        if ($next_link) {
            $next_url = get_pagenum_link($paged + 1);
            printf(
                '<li><a href="%s" class="page-link page-link-next" aria-label="%s" rel="next">%s<span class="screen-reader-text">%s</span></a></li>',
                esc_url($next_url),
                esc_attr__('Go to next page', 'sigil'),
                self::SVG_NEXT,
                esc_html__('Next page', 'sigil')
            );
        }
    }
} 