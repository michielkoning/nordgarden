<?php

function adler_add_translations()
{
  load_theme_textdomain('nordgarden', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'adler_add_translations');
