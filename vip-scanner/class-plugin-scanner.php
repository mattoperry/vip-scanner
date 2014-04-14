<?php

class PluginScanner extends DirectoryScanner
{
    function __construct( $plugin, $review ) {

        if( ! defined( 'WP_PLUGIN_DIR' ) )
            return $this->add_error( 'wp-load', sprintf( '%s requires WordPress to be loaded.', get_class( $this ) ), 'blocker' );

        // See if the passed installed plugin name is valid, and if it's a single file or a directory
        if ( strpos( $plugin, '/' ) === false  ) {

            if ( file_exists( WP_PLUGIN_DIR . '/' . $plugin . '.php' ) ) {
                $path = WP_PLUGIN_DIR . '/' . $plugin . '.php';
            } elseif (is_dir( WP_PLUGIN_DIR . '/' . $plugin )) {
                $path = WP_PLUGIN_DIR . '/' . $plugin;
            }
        } elseif ( is_dir( $plugin ) ) {
            $path = $plugin;
        }
        //Still no path?  Then error
        if ( !isset( $path) )
            return $this->add_error( 'wp-plugin', sprintf( '%s could not find the specificed plugin %s.', get_class( $this ), $plugin ), 'blocker' );

        // Call Parent Constructor
        parent::__construct( $path, $review );
    }
}
