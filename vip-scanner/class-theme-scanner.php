<?php

class ThemeScanner extends DirectoryScanner
{
	function __construct( $theme, $review ) {
		if( ! function_exists( 'get_theme_root' ) )
			return $this->add_error( 'wp-load', sprintf( '%s requires WordPress to be loaded.', get_class( $this ) ), 'blocker' );

        if ( strpos( $theme, '/' ) !== false && is_dir( $theme )  ) {
            $path = $theme;
        } else {
            // If theme is not a path, then we scan the current theme
            $path = sprintf( '%s/%s', get_theme_root(), $theme );
        }

		// Call Parent Constructor
		parent::__construct( $path, $review );
	}
}
