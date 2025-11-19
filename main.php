<?php
/**
 * Plugin Name: Elementor Table By Uchit
 * Description: Advanced responsive table widget for Elementor with extensive styling options
 * Version: 1.0.4
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
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        // Force CSS loading with higher priority
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'), 999);
        add_action('elementor/frontend/after_enqueue_styles', array($this, 'enqueue_styles'), 999);
        
        // Add inline CSS as backup
        add_action('wp_head', array($this, 'add_inline_css'), 999);
    }
    
    public function init() {
        // Check if Elementor is installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', array($this, 'admin_notice_missing_main_plugin'));
            return;
        }
        
        // Register widget
        add_action('elementor/widgets/register', array($this, 'register_widgets'));
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
    
    public function add_admin_menu() {
        add_menu_page(
            __('Table by Uchit', 'elementor-table-by-uchit'),
            __('Table by Uchit', 'elementor-table-by-uchit'),
            'manage_options',
            'table-by-uchit',
            array($this, 'admin_page_content'),
            'dashicons-grid-view',
            30
        );
    }
    
    public function admin_page_content() {
        ?>
        <div class="wrap">
            <div style="max-width: 800px; margin: 40px auto; padding: 40px; background: #fff; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                <div style="text-align: center; margin-bottom: 30px;">
                    <h1 style="color: #1e3a8a; font-size: 2.5em; margin-bottom: 10px;">
                        <span class="dashicons dashicons-grid-view" style="font-size: 1em; margin-right: 15px; vertical-align: middle;"></span>
                        Table by Uchit
                    </h1>
                    <p style="font-size: 1.2em; color: #666; margin: 0;">Advanced Elementor Table Widget</p>
                </div>
                
                <div style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); padding: 30px; border-radius: 8px; color: white; text-align: center; margin-bottom: 30px;">
                    <h2 style="margin: 0 0 15px 0; font-size: 1.8em;">Premium Customization Available</h2>
                    <p style="margin: 0 0 20px 0; font-size: 1.1em; opacity: 0.9;">
                        Looking for advanced table features, custom styling options, or personalized modifications?
                    </p>
                    <a href="https://uchitchakma.com" target="_blank" 
                       style="display: inline-block; background: white; color: #1e3a8a; padding: 12px 30px; text-decoration: none; border-radius: 25px; font-weight: 600; font-size: 1.1em; transition: all 0.3s ease; box-shadow: 0 2px 10px rgba(0,0,0,0.2);"
                       onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.3)';"
                       onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.2)';">
                        Visit UchitChakma.com
                        <span class="dashicons dashicons-external" style="margin-left: 8px; font-size: 0.9em;"></span>
                    </a>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
                    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #1e3a8a;">
                        <h3 style="margin: 0 0 10px 0; color: #1e3a8a;">
                            <span class="dashicons dashicons-admin-customizer" style="margin-right: 8px;"></span>
                            Custom Styling
                        </h3>
                        <p style="margin: 0; color: #666;">Personalized table designs tailored to your brand requirements.</p>
                    </div>
                    
                    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #1e3a8a;">
                        <h3 style="margin: 0 0 10px 0; color: #1e3a8a;">
                            <span class="dashicons dashicons-chart-line" style="margin-right: 8px;"></span>
                            Advanced Features
                        </h3>
                        <p style="margin: 0; color: #666;">Enhanced functionality including sorting, filtering, and data import options.</p>
                    </div>
                    
                    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #1e3a8a;">
                        <h3 style="margin: 0 0 10px 0; color: #1e3a8a;">
                            <span class="dashicons dashicons-businessman" style="margin-right: 8px;"></span>
                            Priority Support
                        </h3>
                        <p style="margin: 0; color: #666;">Dedicated technical support and consultation for your projects.</p>
                    </div>
                </div>
                
                <div style="text-align: center; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                    <p style="color: #666; margin: 0 0 15px 0;">
                        <strong>Need help with the current widget?</strong><br>
                        Find the "Table by Uchit" widget in your Elementor editor under the General category.
                    </p>
                    <p style="color: #999; font-size: 0.9em; margin: 0;">
                        Plugin Version 1.0.1 | Created by <a href="https://uchitchakma.com" target="_blank" style="color: #1e3a8a; text-decoration: none;">Uchit Chakma</a>
                    </p>
                </div>
            </div>
        </div>
        
        <style>
            .wrap {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                min-height: calc(100vh - 32px);
                margin-left: -20px;
                padding: 20px;
            }
        </style>
        <?php
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
            '1.0.4', // Updated
            true
        );
    }
    
    public function enqueue_styles() {
        wp_enqueue_style(
            'elementor-table-style',
            plugin_dir_url(__FILE__) . 'assets/css/style.css',
            array(),
            '1.0.4' // Updated
        );
    }
    
    // Add inline CSS as backup to ensure styles are applied
     public function add_inline_css() {
        if (!$this->should_load_styles()) {
            return;
        }
        
        ?>
        <style id="elementor-table-backup-css">
        /* Backup Critical CSS - Only !important on layout properties */
        .elementor-widget-custom-table .custom-table-container {
            position: relative !important;
            overflow: hidden !important;
            box-sizing: border-box !important;
        }
        
        .elementor-widget-custom-table .table-desktop {
            display: block !important;
            overflow-x: auto !important;
        }
        
        .elementor-widget-custom-table .custom-table {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            margin: 0 !important;
        }
        
        /* Header - Default styles, can be overridden */
        .elementor-widget-custom-table .custom-table thead th {
            background-color: #1e3a8a;
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
            padding: 15px 20px;
            text-align: left;
            border: none;
            position: relative;
            white-space: nowrap;
            vertical-align: middle;
        }
        
        .elementor-widget-custom-table .custom-table thead th:first-child {
            border-top-left-radius: 8px;
        }
        
        .elementor-widget-custom-table .custom-table thead th:last-child {
            border-top-right-radius: 8px;
        }
        
        /* Body - Default styles, can be overridden */
        .elementor-widget-custom-table .custom-table tbody td {
            padding: 12px 20px;
            border-bottom: 1px solid #e5e7eb;
            color: #374151;
            font-size: 14px;
            line-height: 1.5;
            vertical-align: middle;
            background-color: #ffffff;
        }
        
        /* Style 2 - Default styles, can be overridden */
        .elementor-widget-custom-table .table-style2 {
            display: flex !important;
            flex-direction: column !important;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .elementor-widget-custom-table .table-style2 .table-row {
            display: flex !important;
        }
        
        .elementor-widget-custom-table .table-style2 .table-row .row-header {
            background-color: #1e3a8a;
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
            padding: 15px 20px;
            min-width: 200px;
            max-width: 200px;
            flex-shrink: 0 !important;
            display: flex !important;
            align-items: center !important;
        }
        
        .elementor-widget-custom-table .table-style2 .table-row .row-data {
            display: flex !important;
            flex: 1 !important;
            background-color: #ffffff;
        }
        
        .elementor-widget-custom-table .table-style2 .table-row .row-data .data-cell {
            flex: 1 !important;
            padding: 15px 20px;
            border-right: 1px solid #e5e7eb;
            color: #374151;
            font-size: 14px;
            display: flex !important;
            align-items: center !important;
        }
        
        .elementor-widget-custom-table .table-style2 .table-row .row-data .data-cell:last-child {
            border-right: none;
        }
        
        /* Style 3 Backup - Default styles, can be overridden */
        .elementor-widget-custom-table .table-style3 .table-header-row {
            display: flex !important;
            background-color: #1e3a8a;
        }
        
        .elementor-widget-custom-table .table-style3 .table-header-row .header-cell {
            flex: 1 !important;
            padding: 15px 20px;
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        
        .elementor-widget-custom-table .table-style3 .table-data-row {
            display: flex !important;
        }
        
        .elementor-widget-custom-table .table-style3 .table-data-row .data-cell {
            flex: 1 !important;
            padding: 15px 20px;
            color: #374151;
            font-size: 14px;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        
        .elementor-widget-custom-table .table-style3 .table-data-row .data-cell.row-header-cell {
            background-color: #1e3a8a;
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
        }
        
        /* Mobile Styles - Layout only with !important */
        .elementor-widget-custom-table .table-mobile {
            display: none !important;
        }
        
        .elementor-widget-custom-table .table-mobile-style2 {
            display: none !important;
        }
        
        .elementor-widget-custom-table .table-mobile-style3 {
            display: none !important;
        }
        
        @media (max-width: 768px) {
            .elementor-widget-custom-table .table-desktop {
                display: none !important;
            }
            
            .elementor-widget-custom-table .table-style1 .table-mobile {
                display: block !important;
            }
            
            .elementor-widget-custom-table .table-style2 .table-mobile-style2 {
                display: block !important;
            }
            
            .elementor-widget-custom-table .table-style3 .table-mobile-style3 {
                display: block !important;
            }
        }
        </style>
        <?php
    }
    
    private function should_load_styles() {
        // Only load on pages with Elementor content
        global $post;
        
        if (is_admin()) {
            return false;
        }
        
        // Load if we're in Elementor editor
        if (isset($_GET['elementor-preview'])) {
            return true;
        }
        
        // Load if current post/page uses Elementor
        if ($post && get_post_meta($post->ID, '_elementor_edit_mode', true)) {
            return true;
        }
        
        // Load if any post on current page uses our widget
        if (is_singular() && $post) {
            $content = get_post_field('post_content', $post->ID);
            return (strpos($content, 'custom-table') !== false);
        }
        
        return false;
    }
}

// Initialize the plugin
new ElementorCustomTable();