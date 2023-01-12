<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Utils;
use Aro\Elementor\Aro_Base_Widgets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor image gallery widget.
 *
 * Elementor widget that displays a set of images in an aligned grid.
 *
 * @since 1.0.0
 */
class Aro_Elementor_Image_Masonry extends Aro_Base_Widgets {

    /**
     * Get widget name.
     *
     * Retrieve image gallery widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'aro-image-masonry';
    }

    /**
     * Get widget title.
     *
     * Retrieve image gallery widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Aro Image Masonry', 'aro');
    }

    public function get_categories() {
        return ['aro-addons'];
    }

    /**
     * Get widget icon.
     *
     * Retrieve image gallery widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-gallery-justified';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @return array Widget keywords.
     * @since  2.1.0
     * @access public
     *
     */
    public function get_keywords() {
        return ['image', 'photo', 'visual', 'masonry'];
    }

    /**
     * Register image gallery widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_masonry',
            [
                'label' => esc_html__('Image Masonry', 'aro'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label'       => __('Choose Image', 'aro'),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'wp_gallery_size',
            [
                'label'   => esc_html__('Size', 'aro'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''     => 'Default',
                    'wide' => 'Wide',
                    'tall' => 'Tall',
                    'big'  => 'Big',
                ],
            ]
        );

        $this->add_control(
            'wp_gallerys',
            [
                'label'  => '',
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout', 'aro'),
                'tab'   => Controls_Manager::TAB_LAYOUT
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image',
                'separator' => 'none',
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label'      => esc_html__('Width', 'aro'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 900,
                    ],
                ],
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .grid-wrapper' => 'grid-template-columns: repeat(auto-fit, minmax({{SIZE}}{{UNIT}}, 1fr));;'
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'      => esc_html__('Height', 'aro'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .grid-wrapper' => 'grid-auto-rows: {{SIZE}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'gutter',
            [
                'label'      => esc_html__('Gutter', 'aro'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .grid-wrapper' => 'grid-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render image gallery widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', 'class', 'image-grid-wrapper');
        $this->add_render_attribute('row', 'class', 'grid-wrapper');
        $gallerys = $settings['wp_gallerys'];
        $this->add_render_attribute('link', 'data-elementor-lightbox-slideshow', $this->get_id());

        if (Elementor\Plugin::$instance->editor->is_edit_mode()) {
            $this->add_render_attribute('link', [
                'class' => 'elementor-clickable',
            ]);
        }
        ?>
        <div <?php echo aro_elementor_get_render_attribute_string('wrapper', $this) ?>>
            <div <?php echo aro_elementor_get_render_attribute_string('row', $this) ?>>
                <?php foreach ($gallerys as $gallery):

                    $image = Group_Control_Image_Size::get_attachment_image_src($gallery['image']['id'], 'image', $settings);
                    $image_url_full = wp_get_attachment_image_url($gallery['image']['id'], 'full');
                    ?>
                    <div class="<?php echo esc_attr($gallery['wp_gallery_size']) ?>">
                        <a data-elementor-open-lightbox="yes" <?php echo aro_elementor_get_render_attribute_string('link', $this); ?>
                           href="<?php echo esc_url($image_url_full); ?>">
                            <img src="<?php echo esc_url($image); ?>">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
        <?php
    }
}

$widgets_manager->register(new Aro_Elementor_Image_Masonry());





