<?php
/**
 * Plugin Name: Elementor Table By Uchit
 * Description: Advanced responsive table widget for Elementor with extensive styling options
 * Version: 1.0.0
 * Author: Uchit Chakma
 * License: GPLv2 or later
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Main Plugin Class
 */
class ElementorCustomTable {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
    }
    
    public function init() {
        // Check if Elementor is installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', array($this, 'admin_notice_missing_main_plugin'));
            return;
        }
        
        // Register widget
        add_action('elementor/widgets/register', array($this, 'register_widgets'));
        
        // Enqueue styles and scripts
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('elementor/frontend/after_enqueue_styles', array($this, 'enqueue_styles'));
    }
    
    public function admin_notice_missing_main_plugin() {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'elementor-table-by-uchit'),
            '<strong>' . esc_html__('Elementor Table By Uchit', 'elementor-table-by-uchit') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementor-table-by-uchit') . '</strong>'
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }
    
    public function register_widgets($widgets_manager) {
        require_once(__DIR__ . '/includes/custom-table-widget.php');
        $widgets_manager->register(new \CustomTableWidget());
    }
    
    public function enqueue_scripts() {
        wp_enqueue_script(
            'elementor-table-script',
            plugin_dir_url(__FILE__) . 'assets/js/main.js',
            array('jquery'),
            '1.0.0',
            true
        );
    }
    
    
    public function enqueue_styles() {
        wp_enqueue_style(
            'elementor-table-style',
            plugin_dir_url(__FILE__) . 'assets/css/style.css',
            array(),
            '1.0.0'
        );
    }
}

// Initialize the plugin
new ElementorCustomTable();
