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
                        'label' => __('Row Data (comma separated)', 'elementor-table-by-uchit'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => __('Cell 1, Cell 2, Cell 3, Cell 4', 'elementor-table-by-uchit'),
                        'description' => __('Enter data for each cell separated by commas', 'elementor-table-by-uchit'),
                    ],
                ],
                'default' => [
                    [
                        'row_data' => __('Year 1, 10-12 Months, ERAU Credits CPL ( +PPL+IR ), 200H Flying + 50H Ground', 'elementor-table-by-uchit'),
                    ],
                    [
                        'row_data' => __('Year 2, 18-24 Months, ERAU Credits CFI, 450-600H Flying + 100H Ground', 'elementor-table-by-uchit'),
                    ],
                    [
                        'row_data' => __('Year 3, 33-36 Month, Complete ERAU Degree CFII, 600-800H Flying + 200H Ground', 'elementor-table-by-uchit'),
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
                    '{{WRAPPER}} .custom-table-container' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .custom-table-container' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'table_border',
                'label' => __('Border', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .custom-table-container',
            ]
        );

        $this->add_responsive_control(
            'table_border_radius',
            [
                'label' => __('Border Radius', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .custom-table-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'table_box_shadow',
                'label' => __('Box Shadow', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .custom-table-container',
            ]
        );

        $this->add_responsive_control(
            'table_padding',
            [
                'label' => __('Padding', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .custom-table-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .custom-table-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'header_typography',
                'label' => __('Typography', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .custom-table thead th',
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
                    '{{WRAPPER}} .custom-table thead th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .custom-table thead th' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'header_border',
                'label' => __('Border', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .custom-table thead th',
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

        // Normal State
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
                ],
            ]
        );

        $this->add_control(
            'cell_text_color',
            [
                'label' => __('Text Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .custom-table tbody td' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover State
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
                    '{{WRAPPER}} .custom-table tbody tr:hover td' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'cell_text_color_hover',
            [
                'label' => __('Text Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-table tbody tr:hover td' => 'color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .custom-table tbody td',
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
                    '{{WRAPPER}} .custom-table tbody td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .custom-table tbody td' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'cell_border',
                'label' => __('Border', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .custom-table tbody td',
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
                    '{{WRAPPER}} .custom-table.alternating-rows tbody tr:nth-child(odd) td' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .custom-table.alternating-rows tbody tr:nth-child(even) td' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .table-mobile .table-card' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .table-mobile .table-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .table-mobile .table-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mobile_card_border',
                'label' => __('Card Border', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .table-mobile .table-card',
            ]
        );

        $this->add_responsive_control(
            'mobile_card_border_radius',
            [
                'label' => __('Card Border Radius', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 8,
                    'right' => 8,
                    'bottom' => 8,
                    'left' => 8,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .table-mobile .table-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mobile_card_box_shadow',
                'label' => __('Card Box Shadow', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .table-mobile .table-card',
            ]
        );

        $this->add_control(
            'mobile_label_color',
            [
                'label' => __('Label Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .table-mobile .table-card .card-row .card-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mobile_label_typography',
                'label' => __('Label Typography', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .table-mobile .table-card .card-row .card-label',
            ]
        );

        $this->add_control(
            'mobile_value_color',
            [
                'label' => __('Value Color', 'elementor-table-by-uchit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .table-mobile .table-card .card-row .card-value' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mobile_value_typography',
                'label' => __('Value Typography', 'elementor-table-by-uchit'),
                'selector' => '{{WRAPPER}} .table-mobile .table-card .card-row .card-value',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $headers = $settings['table_header'];
        $rows = $settings['table_rows'];
        $mobile_breakpoint = $settings['mobile_breakpoint']['size'] ?? 768;

        $alternating_class = $settings['enable_alternating_rows'] === 'yes' ? 'alternating-rows' : '';

        ?>
        <div class="custom-table-container" data-breakpoint="<?php echo esc_attr($mobile_breakpoint); ?>">
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
                            $cells = explode(',', $row['row_data']);
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
                    $cells = explode(',', $row['row_data']);
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
        </div>

        <script>
            // Add responsive behavior
            document.addEventListener('DOMContentLoaded', function() {
                const tableContainer = document.querySelector('.custom-table-container[data-breakpoint]');
                if (tableContainer) {
                    const breakpoint = parseInt(tableContainer.dataset.breakpoint);
                    
                    function handleResize() {
                        const windowWidth = window.innerWidth;
                        const desktopView = tableContainer.querySelector('.table-desktop');
                        const mobileView = tableContainer.querySelector('.table-mobile');
                        
                        if (windowWidth <= breakpoint) {
                            desktopView.style.display = 'none';
                            mobileView.style.display = 'block';
                        } else {
                            desktopView.style.display = 'block';
                            mobileView.style.display = 'none';
                        }
                    }
                    
                    // Initial check
                    handleResize();
                    
                    // Listen for window resize
                    window.addEventListener('resize', handleResize);
                }
            });
        </script>
        <?php
    }
}