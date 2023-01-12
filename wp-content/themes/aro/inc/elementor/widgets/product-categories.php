<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!aro_is_woocommerce_activated()) {
    return;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Aro\Elementor\Aro_Base_Widgets;

/**
 * Elementor Aro_Elementor_Products_Categories
 * @since 1.0.0
 */
class Aro_Elementor_Products_Categories extends Aro_Base_Widgets {

    public function get_categories() {
        return array('aro-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'aro-product-categories';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Aro Product Categories', 'aro');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_script_depends() {
        return ['aro-elementor-product-categories', 'slick'];
    }

    public function on_export($element) {
        unset($element['settings']['category_image']['id']);

        return $element;
    }

    protected function register_controls() {

        //Section Query
        $this->start_controls_section(
            'section_setting',
            [
                'label' => esc_html__('Categories', 'aro'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'categories_name',
            [
                'label' => esc_html__('Alternate Name', 'aro'),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'categories_sub_name',
            [
                'label' => esc_html__('Sub', 'aro'),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'categories',
            [
                'label'       => esc_html__('Categories', 'aro'),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'options'     => $this->get_product_categories(),
                'multiple'    => false,
            ]
        );

        $repeater->add_control(
            'category_image',
            [
                'label'      => esc_html__('Choose Image', 'aro'),
                'default'    => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
            ]

        );


        $repeater->add_control(
            'categories_bg_color',
            [
                'label'     => esc_html__('Background Color', 'aro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .row.layout-1 {{CURRENT_ITEM}} .category-product-img:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .row:not(.layout-1) {{CURRENT_ITEM}} .product-cat-link'      => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'categories_list',
            [
                'label'       => esc_html__('Items', 'aro'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ categories }}}',
            ]
        );
        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `brand_image_size` and `brand_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
            ]
        );


        $this->add_control(
            'product_cate_layout',
            [
                'label'   => esc_html__('Layout', 'aro'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('Layout 1', 'aro'),
                    '2' => esc_html__('Layout 2', 'aro'),
                    '3' => esc_html__('Layout 3', 'aro'),
                ]
            ]
        );


        $this->add_responsive_control(
            'alignment',
            [
                'label'     => esc_html__('Alignment', 'aro'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'aro'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'aro'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'aro'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'center',
                'condition' => [
                    'product_cate_layout' => '1',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .product-cat-caption'        => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'box_vertical_position',
            [
                'label'        => esc_html__('Vertical Position', 'aro'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'aro'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center'     => [
                        'title' => esc_html__('Middle', 'aro'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__('Bottom', 'aro'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'condition'    => [
                    'product_cate_layout' => '3',
                ],
                'prefix_class' => 'box-valign-',
                'separator'    => 'none',
                'selectors'    => [
                    '{{WRAPPER}} .layout-3 .product-cat-caption' => 'justify-content:{{VALUE}} ;',
                ],
            ]
        );

        $this->add_responsive_control(
            'horizontal_align',
            [
                'label'     => esc_html__('Horizontal Align', 'aro'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'aro'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'aro'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__('Right', 'aro'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'condition' => [
                    'product_cate_layout' => '3',
                ],
                'default'   => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .layout-3 .product-cat-caption' => 'align-items: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'   => esc_html__('Columns', 'aro'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 1,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8],
            ]
        );
        $this->add_responsive_control(
            'product_gutter',
            [
                'label'      => esc_html__('Gutter', 'aro'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} [data-elementor-columns] .column-item' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .aro-carousel .column-item'        => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} .row'                                  => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
                ],
            ]
        );

        $this->add_control(
            'hidden_total',
            [
                'label'        => esc_html__('Hidden Total', 'aro'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'hidden-total-',
                'selectors'    => [
                    '{{WRAPPER}}.hidden-total-yes .product-cat .cat-total' => 'display: none',
                    '{{WRAPPER}}.hidden-total-yes .product-cat .product-cat-link .cat-title .count' => 'display: none',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'product_cate_style',
            [
                'label' => esc_html__('Box', 'aro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__('Padding', 'aro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} div .product-cat-link'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .layout-3 .product-cat-link'    => 'padding: 0;',
                    '{{WRAPPER}} .layout-3 .product-cat-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',

                ],
            ]
        );

        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => esc_html__('Margin', 'aro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} div:not(.layout-3) .product-cat-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .layout-3 .product-cat-caption'       => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'min-height',
            [
                'label'      => esc_html__('Height', 'aro'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'vh'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cat .product-cat-link'      => 'min-height: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .layout-3 .category-product-img img' => 'min-height: {{SIZE}}{{UNIT}}; max-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'aro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cat .product-cat-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_box_style');
        $this->start_controls_tab(
            'box_img_normal',
            [
                'label' => esc_html__('Normal', 'aro'),
            ]
        );


        $this->add_control(
            'box_background',
            [
                'label'     => esc_html__('Background Color', 'aro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-cat' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'box_opacity',
            [
                'label'     => esc_html__('Opacity', 'aro'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-cat .product-cat-link' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_box_hover',
            [
                'label' => esc_html__('Hover', 'aro'),
            ]
        );


        $this->add_control(
            'box_background_hover',
            [
                'label'     => esc_html__('Background Color', 'aro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .product-cat-link' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'box_opacity_hover',
            [
                'label'     => esc_html__('Opacity', 'aro'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .product-cat-link' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();

        $this->start_controls_section(
            'image_style',
            [
                'label' => esc_html__('Image', 'aro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'effect_image_position',
            [
                'label'        => esc_html__('Hover Effect Image Position', 'aro'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'img-position-',
            ]
        );

        $this->add_responsive_control(
            'image_margin_position',
            [
                'label'      => esc_html__('Position', 'aro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .column-item.elementor-categories-item:nth-child(2n)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'

                ],
                'condition'      => [
                    'effect_image_position' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .category-product-img',
            ]
        );

        $this->add_responsive_control(
            'image_max_width',
            [
                'label'          => esc_html__('Max Width', 'aro'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'condition'      => [
                    'product_cate_layout!' => '3',
                ],
                'selectors'      => [
                    '{{WRAPPER}} .category-product-img'           => 'max-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .layout-3 .category-product-img' => 'max-width: 100%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label'          => esc_html__('Width', 'aro'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'condition'      => [
                    'product_cate_layout!' => '3',
                ],
                'selectors'      => [
                    '{{WRAPPER}} .category-product-img'           => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .category-product-img img'       => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .layout-3 .category-product-img' => 'width: 100%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'          => esc_html__('Height', 'aro'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', 'vh'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'condition'      => [
                    'product_cate_layout!' => '3',
                ],
                'selectors'      => [
                    '{{WRAPPER}} .category-product-img'           => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .category-product-img img'       => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .layout-3 .product-cat-link'     => 'height: 100%;',
                    '{{WRAPPER}} .layout-3 .category-product-img' => 'height: 100%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_object_fit',
            [
                'label'     => esc_html__('Object Fit', 'aro'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'image_height[size]!' => '',
                ],
                'options'   => [
                    ''        => esc_html__('Default', 'aro'),
                    'fill'    => esc_html__('Fill', 'aro'),
                    'cover'   => esc_html__('Cover', 'aro'),
                    'contain' => esc_html__('Contain', 'aro'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'aro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .category-product-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .category-product-img'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'product_cate_layout!' => '1',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => esc_html__('Padding', 'aro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .category-product-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => esc_html__('Margin', 'aro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .category-product-img'                        => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .layout-1 .product-cat .category-product-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_img_style');
        $this->start_controls_tab(
            'tab_img_normal',
            [
                'label' => esc_html__('Normal', 'aro'),
            ]
        );


        $this->add_control(
            'img_background',
            [
                'label'     => esc_html__('Background Color', 'aro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .layout-1 .product-cat .category-product-img:before'    => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .row:not(.layout-1) .product-cat .category-product-img' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .layout-1 .product-cat .product-cat-link .category-product-img:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'img_opacity',
            [
                'label'     => esc_html__('Opacity', 'aro'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .layout-1 .product-cat .category-product-img:before'    => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .row:not(.layout-1) .product-cat .category-product-img img' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .layout-1 .product-cat .product-cat-link .category-product-img:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_img_hover',
            [
                'label' => esc_html__('Hover', 'aro'),
            ]
        );

        $this->add_control(
            'img_background_hover',
            [
                'label'     => esc_html__('Background Color', 'aro'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .row.layout-1 .product-cat:hover .category-product-img:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .row:not(.layout-1) .product-cat:hover .category-product-img'  => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'img_opacity_hover',
            [
                'label'     => esc_html__('Opacity', 'aro'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .layout-1 .product-cat:hover .category-product-img:before'     => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .row:not(.layout-1) .product-cat:hover .category-product-img img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'aro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tilte_typography',
                'selector' => '{{WRAPPER}} .row .cat-title',
            ]
        );


        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__('Margin', 'aro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .cat-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => esc_html__('Padding', 'aro'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .cat-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tab_title');
        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => esc_html__('Normal', 'aro'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'aro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-title'                                                    => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-cat .product-cat-link .cat-title:hover .title:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => esc_html__('Hover', 'aro'),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'aro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-title:hover'                                              => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-cat .product-cat-link .cat-title:hover .title:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'total_style',
            [
                'label' => esc_html__('Total', 'aro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'total_effects',
            [
                'label'        => esc_html__('Effects', 'aro'),
                'type'         => Controls_Manager::SWITCHER,

                'prefix_class' => 'total-effects-'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'total_typography',
                'selector' => '{{WRAPPER}} .cat-total',
            ]
        );


        $this->start_controls_tabs('tab_total');
        $this->start_controls_tab(
            'tab_total_normal',
            [
                'label' => esc_html__('Normal', 'aro'),
            ]
        );

        $this->add_control(
            'total_color_text',
            [
                'label'     => esc_html__('Color Text', 'aro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .row .product-cat .product-cat-caption .cat-total .text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'total_color',
            [
                'label'     => esc_html__('Color Count', 'aro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .row .product-cat .product-cat-caption .count'           => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_total_hover',
            [
                'label' => esc_html__('Hover', 'aro'),
            ]
        );

        $this->add_control(
            'total_color_text_hover',
            [
                'label'     => esc_html__('Color Text', 'aro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .row .product-cat:hover .cat-total .text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'total_color_hover',
            [
                'label'     => esc_html__('Color Count', 'aro'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .row .product-cat:hover .product-cat-caption .count'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // Carousel options
        $this->add_control_for_carousel();
    }

    protected function get_product_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
            )
        );
        $results    = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['categories_list']) && is_array($settings['categories_list'])) {
            $this->add_render_attribute('wrapper', 'class', 'elementor-categories-item-wrapper');

            if ($settings['product_cate_layout'] == '2'):
                $this->add_render_attribute('wrapper', 'class', 'layout-overflow-' . esc_attr($settings['product_cate_layout']));
            endif;

            // Row
            $this->add_render_attribute('row', 'class', 'row');
            $this->add_render_attribute('row', 'class', 'layout-' . esc_attr($settings['product_cate_layout']));
            $this->get_data_elementor_columns();
            // Item
            $this->add_render_attribute('item', 'class', 'column-item elementor-categories-item');

            ?>
            <div <?php echo aro_elementor_get_render_attribute_string('wrapper', $this); // WPCS: XSS ok. ?>>
                <div <?php echo aro_elementor_get_render_attribute_string('row', $this); // WPCS: XSS ok. ?>>
                    <?php foreach ($settings['categories_list'] as $index => $item): ?>

                        <?php
                        $class_item            = 'elementor-repeater-item-' . $item['_id'];
                        $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);
                        $this->add_render_attribute($tab_title_setting_key, ['class' => ['product-cat', $class_item],]); ?>

                        <div <?php echo aro_elementor_get_render_attribute_string('item', $this); // WPCS: XSS ok. ?>>
                            <?php if (empty($item['categories'])) {
                                echo esc_html__('Choose Category', 'aro');
                                return;
                            }
                            $category = get_term_by('slug', $item['categories'], 'product_cat');
                            if (!is_wp_error($category) && !empty($category)) {
                                if (!empty($item['category_image']['id'])) {
                                    $image = Group_Control_Image_Size::get_attachment_image_src($item['category_image']['id'], 'image', $settings);
                                } else {
                                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                                    if (!empty($thumbnail_id)) {
                                        $image = wp_get_attachment_url($thumbnail_id);
                                    } else {
                                        $image = wc_placeholder_img_src();
                                    }
                                } ?>

                                <div <?php echo aro_elementor_get_render_attribute_string($tab_title_setting_key, $this); ?>>
                                    <a class="product-cat-link" href="<?php echo esc_url(get_term_link($category)); ?>"
                                       title="<?php echo esc_attr($category->name); ?>">
                                        <?php if ($settings['product_cate_layout'] == '1'): ?>
                                            <div class="category-product-img">
                                                <img src="<?php echo esc_url_raw($image); ?>"
                                                     alt="<?php echo esc_attr($category->name); ?>">
                                            </div>
                                            <div class="product-cat-caption">
                                                <div class="cat-title">
                                                    <span class="title"><?php echo empty($item['categories_name']) ? esc_html($category->name) : sprintf('%s', $item['categories_name']); ?> </span>
                                                </div>
                                                <div class="cat-total">
                                                    <span class="count"><?php echo esc_html($category->count); ?></span>
                                                    <span class="text"><?php echo esc_html__('products', 'aro'); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($settings['product_cate_layout'] == '2'): ?>
                                            <div class="category-product-img">
                                                <img src="<?php echo esc_url_raw($image); ?>"
                                                     alt="<?php echo esc_attr($category->name); ?>">
                                            </div>
                                            <div class="product-cat-caption">
                                                <div class="cat-title">
                                                    <span class="title"><?php echo empty($item['categories_name']) ? esc_html($category->name) : sprintf('%s', $item['categories_name']); ?></span>
                                                </div>
                                                <div class="cat-total">
                                                    <span class="count"><?php echo esc_html($category->count); ?></span>
                                                    <span class="text"><?php echo esc_html__('products', 'aro'); ?></span>
                                                </div>

                                            </div>
                                        <?php endif; ?>

                                        <?php if ($settings['product_cate_layout'] == '3'): ?>

                                            <div class="category-product-img">
                                                <img src="<?php echo esc_url_raw($image); ?>"
                                                     alt="<?php echo esc_attr($category->name); ?>">
                                            </div>
                                            <div class="product-cat-caption">
                                                <div class="cat-title">
                                                    <span class="title"><?php echo empty($item['categories_name']) ? esc_html($category->name) : sprintf('%s', $item['categories_name']); ?></span>
                                                </div>
                                                <div class="cat-total">
                                                    <span class="count"><?php echo esc_html($category->count); ?></span>
                                                    <span class="text"><?php echo esc_html__('products', 'aro'); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }
}

$widgets_manager->register(new Aro_Elementor_Products_Categories());

