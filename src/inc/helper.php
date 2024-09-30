<?php

/**
 * This file combines a number of helper functions used throughout the
 * theme.
 */

function get_text_excerpt($text, $excerpt_length = 20)
{
  $text = strip_shortcodes($text);
  $text = apply_filters('the_content', $text);
  $text = str_replace(']]>', ']]>', $text);
  $excerpt_length = apply_filters('excerpt_length', $excerpt_length);
  $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
  return wp_trim_words($text, $excerpt_length, $excerpt_more);
}
