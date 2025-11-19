<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class CustomTableWidget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'custom-table';
    }

    public function get_title() {
        return __('Table by Uchit', 'elementor-table-by-uchit');
    }

    public function get_icon() {
        return 'eicon-table';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['table', 'data', 'custom', 'responsive'];
    }

    protected function register_controls() {
        
        // Content Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Table Content', 'elementor-table-by-uchit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Add Table Style Selection
        $this->add_control(
            'table_style',
            [
                'label' => __('Table Style', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => __('Classic Table (Style 1)', 'elementor-table-by-uchit'),
                    'style2' => __('Row Header Table (Style 2)', 'elementor-table-by-uchit'),
                    'style3' => __('Double Header Table (Style 3)', 'elementor-table-by-uchit'),
                ],
            ]
        );

        $this->add_control(
            'table_header',
            [
                'label' => __('Table Header', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'header_text',
                        'label' => __('Header Text', 'elementor-table-by-uchit'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('Header', 'elementor-table-by-uchit'),
                    ],
                ],
                'default' => [
                    [
                        'header_text' => __('Phase', 'elementor-table-by-uchit'),
                    ],
                    [
                        'header_text' => __('Duration', 'elementor-table-by-uchit'),
                    ],
                    [
                        'header_text' => __('What You Learn', 'elementor-table-by-uchit'),
                    ],
                    [
                        'header_text' => __('Typical hours', 'elementor-table-by-uchit'),
                    ],
                ],
                'title_field' => '{{{ header_text }}}',
            ]
        );

        $this->add_control(
            'table_rows',
            [
                'label' => __('Table Rows', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'row_data',
                        'label' => __('Row Data (use /\\ separator)', 'elementor-table-by-uchit'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => __('Cell 1/\\Cell 2/\\Cell 3/\\Cell 4', 'elementor-table-by-uchit'),
                        'description' => __('Enter data for each cell separated by /\\ symbol. Example: Year 1/\\10-12 Months/\\ERAU Credits, CPL ( +PPL+IR )/\\200H Flying + 50H Ground', 'elementor-table-by-uchit'),
                    ],
                ],
                'default' => [
                    [
                        'row_data' => __('Year 1/\\10-12 Months/\\ERAU Credits, CPL ( +PPL+IR )/\\200H Flying + 50H Ground', 'elementor-table-by-uchit'),
                    ],
                    [
                        'row_data' => __('Year 2/\\18-24 Months/\\ERAU Credits, CFI/\\450-600H Flying + 100H Ground', 'elementor-table-by-uchit'),
                    ],
                    [
                        'row_data' => __('Year 3/\\33-36 Month/\\Complete ERAU Degree, CFII/\\600-800H Flying + 200H Ground', 'elementor-table-by-uchit'),
                    ],
                ],
                'title_field' => 'Row {{{ _id }}}',
            ]
        );

        $this->end_controls_section();

        // Style Tab - Table Container
        $this->start_controls_section(
            'table_container_style',
            [
                'label' => __('Table Container', 'elementor-table-by-uchit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'table_width',
            [
                'label' => __('Table Width', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 200,
                        'max' => 2000,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-table-container' => 'width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .custom-table' => 'width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-style2' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'table_background',
            [
                'label' => __('Background Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .custom-table-container' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .custom-table' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-style2' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'table_border',
                'label' => __('Border', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .custom-table-container, {{WRAPPER}} .custom-table, {{WRAPPER}} .table-style2',
            ]
        );

        $this->add_responsive_control(
            'table_border_radius',
            [
                'label' => __('Border Radius', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .custom-table-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .custom-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-style2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'table_box_shadow',
                'label' => __('Box Shadow', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .custom-table-container, {{WRAPPER}} .custom-table, {{WRAPPER}} .table-style2',
            ]
        );

        $this->add_responsive_control(
            'table_padding',
            [
                'label' => __('Padding', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .custom-table-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'table_margin',
            [
                'label' => __('Margin', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .custom-table-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        // Header Styles
        $this->start_controls_section(
            'header_style',
            [
                'label' => __('Header Style', 'elementor-table-by-uchit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'header_background',
            [
                'label' => __('Background Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3a8a',
                'selectors' => [
                    '{{WRAPPER}} .custom-table thead th' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .table-style2 .table-row .row-header' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-header' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .table-style3 .table-header-row' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .table-style3 .table-header-row .header-cell' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .table-style3 .table-data-row .data-cell.row-header-cell' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .table-style3 .table-mobile-style3 .card-main-header' => 'background-color: {{VALUE}};',
                ],
            ]
        );

         $this->add_control(
            'header_text_color',
            [
                'label' => __('Text Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .custom-table thead th' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .table-style2 .table-row .row-header' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-header' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .table-style3 .table-header-row .header-cell' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .table-style3 .table-data-row .data-cell.row-header-cell' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .table-style3 .table-mobile-style3 .card-main-header' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'header_typography',
                'label' => __('Typography', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .custom-table thead th, {{WRAPPER}} .table-style2 .table-row .row-header, {{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-header, {{WRAPPER}} .table-style3 .table-header-row .header-cell, {{WRAPPER}} .table-style3 .table-data-row .data-cell.row-header-cell, {{WRAPPER}} .table-style3 .table-mobile-style3 .card-main-header',
            ]
        );

        $this->add_responsive_control(
            'header_padding',
            [
                'label' => __('Padding', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 15,
                    'right' => 20,
                    'bottom' => 15,
                    'left' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-table thead th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-style2 .table-row .row-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'header_text_align',
            [
                'label' => __('Text Alignment', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'elementor-table-by-uchit'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elementor-table-by-uchit'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'elementor-table-by-uchit'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .custom-table thead th' => 'text-align: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-style2 .table-row .row-header' => 'text-align: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-header' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'header_border',
                'label' => __('Border', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .custom-table thead th, {{WRAPPER}} .table-style2 .table-row .row-header, {{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-header',
            ]
        );

        $this->add_responsive_control(
            'header_width_style2',
            [
                'label' => __('Header Width (Style 2)', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .table-style2 .table-row .row-header' => 'min-width: {{SIZE}}{{UNIT}} !important; max-width: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'table_style' => 'style2',
                ],
            ]
        );

        $this->end_controls_section();

        // Cell Styles
        $this->start_controls_section(
            'cell_style',
            [
                'label' => __('Cell Style', 'elementor-table-by-uchit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('cell_tabs');

        $this->start_controls_tab(
            'cell_normal',
            [
                'label' => __('Normal', 'elementor-table-by-uchit'),
            ]
        );

         $this->add_control(
            'cell_background',
            [
                'label' => __('Background Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .custom-table tbody td' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .table-style2 .table-row .row-data .data-cell' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .table-mobile .table-card' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-content' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .table-style3 .table-data-row .data-cell:not(.row-header-cell)' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .table-style3 .table-mobile-style3 .mobile-card' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .table-style3 .table-mobile-style3 .card-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
         $this->add_control(
            'style3_mobile_subheader_color',
            [
                'label' => __('Style 3: Sub-header Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1e3a8a',
                'selectors' => [
                    '{{WRAPPER}} .table-style3 .table-mobile-style3 .card-sub-header' => 'color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'table_style' => 'style3',
                ],
            ]
        );

         $this->add_control(
            'cell_text_color',
            [
                'label' => __('Text Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#374151',
                'selectors' => [
                    '{{WRAPPER}} .custom-table tbody td' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .table-style2 .table-row .row-data .data-cell' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .table-mobile .table-card .card-row .card-value' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-content .content-value' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .table-style3 .table-data-row .data-cell:not(.row-header-cell)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .table-style3 .table-mobile-style3 .card-data' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'cell_hover',
            [
                'label' => __('Hover', 'elementor-table-by-uchit'),
            ]
        );

         $this->add_control(
            'cell_background_hover',
            [
                'label' => __('Background Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-table tbody tr:hover td' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-style2 .table-row:hover .row-data .data-cell' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-mobile .table-card:hover' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card:hover .mobile-content' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'cell_text_color_hover',
            [
                'label' => __('Text Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-table tbody tr:hover td' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-style2 .table-row:hover .row-data .data-cell' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-mobile .table-card:hover .card-row .card-value' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card:hover .mobile-content .content-value' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'cell_typography',
                'label' => __('Typography', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .custom-table tbody td, {{WRAPPER}} .table-style2 .table-row .row-data .data-cell, {{WRAPPER}} .table-mobile .table-card .card-row .card-value, {{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-content .content-value, {{WRAPPER}} .table-style3 .table-data-row .data-cell:not(.row-header-cell), {{WRAPPER}} .table-style3 .table-mobile-style3 .card-data',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'cell_padding',
            [
                'label' => __('Padding', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 12,
                    'right' => 20,
                    'bottom' => 12,
                    'left' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-table tbody td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-style2 .table-row .row-data .data-cell' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-mobile .table-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'cell_text_align',
            [
                'label' => __('Text Alignment', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'elementor-table-by-uchit'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elementor-table-by-uchit'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'elementor-table-by-uchit'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .custom-table tbody td' => 'text-align: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-style2 .table-row .row-data .data-cell' => 'text-align: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-mobile .table-card .card-row .card-value' => 'text-align: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-content .content-value' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'cell_border',
                'label' => __('Border', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .custom-table tbody td, {{WRAPPER}} .table-style2 .table-row .row-data .data-cell, {{WRAPPER}} .table-mobile .table-card, {{WRAPPER}} .table-mobile-style2 .mobile-card',
            ]
        );

        $this->end_controls_section();

        // Row Spacing & Borders
        $this->start_controls_section(
            'row_style',
            [
                'label' => __('Row Style', 'elementor-table-by-uchit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label' => __('Row Gap', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-table tbody tr' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-style2 .table-row' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-mobile .table-card' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'row_border_color',
            [
                'label' => __('Row Border Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#e5e7eb',
                'selectors' => [
                    '{{WRAPPER}} .custom-table tbody td' => 'border-bottom-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-style2 .table-row .row-data .data-cell' => 'border-right-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-style2 .table-row' => 'border-bottom-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-mobile .table-card .card-row' => 'border-bottom-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-content .content-row' => 'border-bottom-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_border_width',
            [
                'label' => __('Row Border Width', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-table tbody td' => 'border-bottom-width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-style2 .table-row .row-data .data-cell' => 'border-right-width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-mobile .table-card .card-row' => 'border-bottom-width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-content .content-row' => 'border-bottom-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        // Alternating Row Colors
        $this->start_controls_section(
            'alternating_rows_style',
            [
                'label' => __('Alternating Rows', 'elementor-table-by-uchit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'enable_alternating_rows',
            [
                'label' => __('Enable Alternating Rows', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor-table-by-uchit'),
                'label_off' => __('No', 'elementor-table-by-uchit'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'odd_row_background',
            [
                'label' => __('Odd Row Background', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f8f9fa',
                'selectors' => [
                    '{{WRAPPER}} .custom-table.alternating-rows tbody tr:nth-child(odd) td' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-style2.alternating-rows .table-row:nth-child(odd) .row-data .data-cell' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'enable_alternating_rows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'even_row_background',
            [
                'label' => __('Even Row Background', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .custom-table.alternating-rows tbody tr:nth-child(even) td' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-style2.alternating-rows .table-row:nth-child(even) .row-data .data-cell' => 'background-color: {{VALUE}} !important;',
                ],
                'condition' => [
                    'enable_alternating_rows' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Mobile/Responsive Styles
        $this->start_controls_section(
            'mobile_style',
            [
                'label' => __('Mobile/Tablet Layout', 'elementor-table-by-uchit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mobile_breakpoint',
            [
                'label' => __('Mobile Breakpoint', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 320,
                        'max' => 1024,
                    ],
                ],
                'default' => [
                    'size' => 768,
                ],
                'description' => __('Screen width below which the mobile layout will be activated', 'elementor-table-by-uchit'),
            ]
        );

        $this->add_control(
            'mobile_card_background',
            [
                'label' => __('Card Background Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f8f9fa',
                'selectors' => [
                    '{{WRAPPER}} .table-mobile .table-card' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'mobile_card_padding',
            [
                'label' => __('Card Padding', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .table-mobile .table-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'mobile_card_margin',
            [
                'label' => __('Card Margin', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 15,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .table-mobile .table-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mobile_card_border',
                'label' => __('Card Border', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .table-mobile .table-card, {{WRAPPER}} .table-mobile-style2 .mobile-card',
            ]
        );

        $this->add_responsive_control(
            'mobile_card_border_radius',
            [
                'label' => __('Card Border Radius', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 12,
                    'right' => 12,
                    'bottom' => 12,
                    'left' => 12,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .table-mobile .table-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mobile_card_box_shadow',
                'label' => __('Card Box Shadow', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .table-mobile .table-card, {{WRAPPER}} .table-mobile-style2 .mobile-card',
            ]
        );

        $this->add_control(
            'mobile_label_color',
            [
                'label' => __('Label Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#374151',
                'selectors' => [
                    '{{WRAPPER}} .table-mobile .table-card .card-row .card-label' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-content .content-label' => 'color: {{VALUE}} !important;',
                ],
            ]
        );


        $this->add_control(
            'mobile_value_color',
            [
                'label' => __('Value Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#6b7280',
                'selectors' => [
                    '{{WRAPPER}} .table-mobile .table-card .card-row .card-value' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card .mobile-content .content-value' => 'color: {{VALUE}} !important;',
                ],
            ]
        );



        $this->end_controls_section();

        // Animation & Effects
        $this->start_controls_section(
            'animation_style',
            [
                'label' => __('Animation & Effects', 'elementor-table-by-uchit'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'enable_hover_effects',
            [
                'label' => __('Enable Hover Effects', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor-table-by-uchit'),
                'label_off' => __('No', 'elementor-table-by-uchit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'hover_animation_duration',
            [
                'label' => __('Hover Animation Duration (ms)', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .custom-table tbody tr' => 'transition: all {{SIZE}}ms ease !important;',
                    '{{WRAPPER}} .table-style2 .table-row' => 'transition: all {{SIZE}}ms ease !important;',
                    '{{WRAPPER}} .table-mobile .table-card' => 'transition: all {{SIZE}}ms ease !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card' => 'transition: all {{SIZE}}ms ease !important;',
                ],
                'condition' => [
                    'enable_hover_effects' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'hover_transform_scale',
            [
                'label' => __('Hover Scale', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0.9,
                        'max' => 1.1,
                        'step' => 0.01,
                    ],
                ],
                'default' => [
                    'size' => 1.02,
                ],
                'selectors' => [
                    '{{WRAPPER}} .table-mobile .table-card:hover' => 'transform: scale({{SIZE}}) !important;',
                    '{{WRAPPER}} .table-mobile-style2 .mobile-card:hover' => 'transform: scale({{SIZE}}) !important;',
                ],
                'condition' => [
                    'enable_hover_effects' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $headers = $settings['table_header'];
        $rows = $settings['table_rows'];
        $mobile_breakpoint = $settings['mobile_breakpoint']['size'] ?? 768;
        $table_style = $settings['table_style'] ?? 'style1';

        $alternating_class = $settings['enable_alternating_rows'] === 'yes' ? 'alternating-rows' : '';

        // Add inline styles for Style 3 to ensure they work on all servers
         // Add inline styles for Style 3 to ensure they work on all servers
        if ($table_style === 'style3') {
            ?>
            <style>
                /* Style 3 Critical Inline Styles - LAYOUT ONLY, NO COLORS */
                .table-style3 .table-desktop {
                    display: block !important;
                }
                
                .table-style3 .table-mobile-style3 {
                    display: none !important;
                }
                
                .table-style3 .table-style3-wrapper {
                    border: 1px solid #e5e7eb;
                    border-radius: 8px;
                    overflow: hidden;
                }
                
                .table-style3 .table-header-row {
                    display: flex !important;
                    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
                }
                
                .table-style3 .table-header-row .header-cell {
                    flex: 1 !important;
                    padding: 15px 20px;
                    font-weight: 600;
                    font-size: 16px;
                    text-align: center;
                    border-right: 1px solid rgba(0, 0, 0, 0.05);
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                }
                
                .table-style3 .table-header-row .header-cell:last-child {
                    border-right: none !important;
                }
                
                .table-style3 .table-data-row {
                    display: flex !important;
                    border-bottom: 1px solid #e5e7eb;
                }
                
                .table-style3 .table-data-row:last-child {
                    border-bottom: none !important;
                }
                
                .table-style3 .table-data-row .data-cell {
                    flex: 1 !important;
                    padding: 15px 20px;
                    font-size: 14px;
                    border-right: 1px solid #e5e7eb;
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    text-align: center;
                }
                
                .table-style3 .table-data-row .data-cell:last-child {
                    border-right: none !important;
                }
                
                .table-style3 .table-data-row .data-cell.row-header-cell {
                    font-weight: 600;
                    font-size: 16px;
                    justify-content: flex-start !important;
                }
                
                .table-style3 .table-mobile-style3 .mobile-card {
                    border: 1px solid #e5e7eb;
                    border-radius: 8px;
                    margin-bottom: 20px;
                    overflow: hidden;
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                }
                
                .table-style3 .table-mobile-style3 .mobile-card:last-child {
                    margin-bottom: 0 !important;
                }
                
                .table-style3 .table-mobile-style3 .card-main-header {
                    font-weight: 600;
                    font-size: 18px;
                    padding: 20px;
                    text-align: center;
                    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
                }
                
                .table-style3 .table-mobile-style3 .card-content {
                    padding: 15px;
                }
                
                .table-style3 .table-mobile-style3 .card-item {
                    display: flex !important;
                    padding: 12px 0;
                    border-bottom: 1px solid #e5e7eb;
                }
                
                .table-style3 .table-mobile-style3 .card-item:last-child {
                    border-bottom: none !important;
                    padding-bottom: 0 !important;
                }
                
                .table-style3 .table-mobile-style3 .card-sub-header {
                    flex: 0 0 40% !important;
                    font-weight: 600;
                    font-size: 14px;
                    padding-right: 15px;
                    display: flex !important;
                    align-items: center !important;
                }
                
                .table-style3 .table-mobile-style3 .card-data {
                    flex: 1 !important;
                    font-size: 14px;
                    display: flex !important;
                    align-items: center !important;
                }
                
                @media (max-width: 768px) {
                    .table-style3 .table-desktop {
                        display: none !important;
                    }
                    
                    .table-style3 .table-mobile-style3 {
                        display: block !important;
                    }
                    
                    .table-style3 .table-mobile-style3 .card-sub-header {
                        flex: 0 0 35% !important;
                        font-size: 13px;
                    }
                    
                    .table-style3 .table-mobile-style3 .card-data {
                        font-size: 13px;
                    }
                    
                    .table-style3 .table-mobile-style3 .card-main-header {
                        font-size: 16px;
                        padding: 15px;
                    }
                }
                
                @media (max-width: 480px) {
                    .table-style3 .table-mobile-style3 .card-item {
                        flex-direction: column !important;
                        gap: 5px !important;
                    }
                    
                    .table-style3 .table-mobile-style3 .card-sub-header {
                        flex: 1 !important;
                        padding-right: 0 !important;
                        padding-bottom: 5px !important;
                    }
                    
                    .table-style3 .table-mobile-style3 .card-data {
                        flex: 1 !important;
                    }
                }
            </style>
            <?php
        }
        ?>
        
        <div class="custom-table-container table-<?php echo esc_attr($table_style); ?>" data-breakpoint="<?php echo esc_attr($mobile_breakpoint); ?>" data-style="<?php echo esc_attr($table_style); ?>">
            
            <?php if ($table_style === 'style1') : ?>
                <!-- Style 1: Traditional Table Layout -->
                <!-- Desktop Table View -->
                <div class="table-desktop">
                    <table class="custom-table <?php echo esc_attr($alternating_class); ?>">
                        <thead>
                            <tr>
                                <?php foreach ($headers as $header) : ?>
                                    <th><?php echo esc_html($header['header_text']); ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $row) : 
                                $cells = explode('/\\', $row['row_data']);
                                $cells = array_map('trim', $cells);
                            ?>
                                <tr>
                                    <?php 
                                    $header_count = count($headers);
                                    for ($i = 0; $i < $header_count; $i++) : 
                                        $cell_content = isset($cells[$i]) ? $cells[$i] : '';
                                    ?>
                                        <td><?php echo esc_html($cell_content); ?></td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile/Tablet Card View -->
                <div class="table-mobile">
                    <?php foreach ($rows as $row_index => $row) : 
                        $cells = explode('/\\', $row['row_data']);
                        $cells = array_map('trim', $cells);
                    ?>
                        <div class="table-card">
                            <?php 
                            $header_count = count($headers);
                            for ($i = 0; $i < $header_count; $i++) : 
                                $header_text = isset($headers[$i]) ? $headers[$i]['header_text'] : '';
                                $cell_content = isset($cells[$i]) ? $cells[$i] : '';
                            ?>
                                <div class="card-row">
                                    <div class="card-label"><?php echo esc_html($header_text); ?></div>
                                    <div class="card-value"><?php echo esc_html($cell_content); ?></div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php elseif ($table_style === 'style2') : ?>
                <!-- Style 2: Vertical Header Layout -->
                <!-- Desktop View -->
                <div class="table-desktop">
                    <div class="table-style2 <?php echo esc_attr($alternating_class); ?>">
                        <?php 
                        $header_count = count($headers);
                        for ($i = 0; $i < $header_count; $i++) : 
                            $header_text = isset($headers[$i]) ? $headers[$i]['header_text'] : '';
                        ?>
                            <div class="table-row">
                                <div class="row-header"><?php echo esc_html($header_text); ?></div>
                                <div class="row-data">
                                    <?php foreach ($rows as $row_index => $row) : 
                                        $cells = explode('/\\', $row['row_data']);
                                        $cells = array_map('trim', $cells);
                                        $cell_content = isset($cells[$i]) ? $cells[$i] : '';
                                    ?>
                                        <div class="data-cell"><?php echo esc_html($cell_content); ?></div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- Mobile View for Style 2 -->
                <div class="table-mobile-style2">
                    <?php 
                    // Loop through each header to create cards
                    $header_count = count($headers);
                    for ($i = 0; $i < $header_count; $i++) : 
                        $header_text = isset($headers[$i]) ? $headers[$i]['header_text'] : '';
                    ?>
                        <div class="mobile-card">
                            <!-- Card Header - The header text -->
                            <div class="mobile-header">
                                <?php echo esc_html($header_text); ?>
                            </div>
                            
                            <!-- Card Content - All cells for this row -->
                            <div class="mobile-content">
                                <?php 
                                // Loop through each row (column in desktop) to get cells
                                foreach ($rows as $row_index => $row) : 
                                    $cells = explode('/\\', $row['row_data']);
                                    $cells = array_map('trim', $cells);
                                    $cell_content = isset($cells[$i]) ? $cells[$i] : '';
                                ?>
                                    <div class="content-value"><?php echo esc_html($cell_content); ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>

            <?php elseif ($table_style === 'style3') : ?>
                <!-- Style 3: Double Header Table -->
                <!-- Desktop Version -->
                <div class="table-desktop">
                    <div class="table-style3-wrapper <?php echo esc_attr($alternating_class); ?>">
                        <!-- Header Row (Top - from table_header) -->
                        <div class="table-header-row">
                            <?php foreach ($headers as $index => $header) : ?>
                                <div class="header-cell header-cell-<?php echo $index; ?>">
                                    <?php echo esc_html($header['header_text']); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Data Rows (each row has left header + data cells) -->
                        <?php foreach ($rows as $row_index => $row) : 
                            $cells = explode('/\\', $row['row_data']);
                            $cells = array_map('trim', $cells);
                        ?>
                            <div class="table-data-row" data-row="<?php echo $row_index; ?>">
                                <?php 
                                $header_count = count($headers);
                                for ($i = 0; $i < $header_count; $i++) : 
                                    $cell_content = isset($cells[$i]) ? $cells[$i] : '';
                                    $is_row_header = ($i === 0); // First column is row header
                                ?>
                                    <div class="data-cell data-cell-<?php echo $i; ?> <?php echo $is_row_header ? 'row-header-cell' : ''; ?>">
                                        <?php echo esc_html($cell_content); ?>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Mobile Version - Style 3 -->
                <div class="table-mobile-style3">
                    <?php foreach ($rows as $row_index => $row) : 
                        $cells = explode('/\\', $row['row_data']);
                        $cells = array_map('trim', $cells);
                        
                        // First cell is the main header (r2c1, r3c1, etc.)
                        $row_header = isset($cells[0]) ? $cells[0] : '';
                        // Remaining cells are data
                        $row_data = array_slice($cells, 1);
                    ?>
                        <div class="mobile-card" data-card="<?php echo $row_index; ?>">
                            <!-- Main Header (from first column of each row) -->
                            <div class="card-main-header">
                                <?php echo esc_html($row_header); ?>
                            </div>

                            <!-- Data Items (sub-header from top row + data from current row) -->
                            <div class="card-content">
                                <?php 
                                foreach ($row_data as $cell_index => $cell_value) : 
                                    // Get sub-header from table_header (skip first header)
                                    $sub_header_index = $cell_index + 1;
                                    $sub_header = isset($headers[$sub_header_index]) ? $headers[$sub_header_index]['header_text'] : '';
                                ?>
                                    <div class="card-item">
                                        <div class="card-sub-header">
                                            <?php echo esc_html($sub_header); ?>
                                        </div>
                                        <div class="card-data">
                                            <?php echo esc_html($cell_value); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tableContainer = document.querySelector('.custom-table-container[data-breakpoint]');
                if (tableContainer) {
                    const breakpoint = parseInt(tableContainer.dataset.breakpoint);
                    const tableStyle = tableContainer.dataset.style;
                    
                    function handleResize() {
                        const windowWidth = window.innerWidth;
                        const desktopView = tableContainer.querySelector('.table-desktop');
                        let mobileView;
                        
                        if (tableStyle === 'style1') {
                            mobileView = tableContainer.querySelector('.table-mobile');
                        } else if (tableStyle === 'style2') {
                            mobileView = tableContainer.querySelector('.table-mobile-style2');
                        } else if (tableStyle === 'style3') {
                            mobileView = tableContainer.querySelector('.table-mobile-style3');
                        }
                        
                        if (windowWidth <= breakpoint) {
                            if (desktopView) desktopView.style.display = 'none';
                            if (mobileView) mobileView.style.display = 'block';
                        } else {
                            if (desktopView) desktopView.style.display = 'block';
                            if (mobileView) mobileView.style.display = 'none';
                        }
                    }
                    
                    handleResize();
                    window.addEventListener('resize', handleResize);
                }
            });
        </script>
        <?php
    }
}