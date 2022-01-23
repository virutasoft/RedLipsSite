<?php

namespace MasterAddons\Modules\MegaMenu;

defined('ABSPATH') || exit;

class JLTMA_Megamenu_Cpt
{

    private static $_instance = null;

    public function __construct()
    {
        add_action('init', [$this, 'post_types']);
    }

    public function post_types()
    {

        $labels = array(
            'name'                  => _x('Master Addons Items', 'Post Type General Name', JLTMA_TD),
            'singular_name'         => _x('Master Addons Item', 'Post Type Singular Name', JLTMA_TD),
            'menu_name'             => esc_html__('Master Addons item', JLTMA_TD),
            'name_admin_bar'        => esc_html__('Master Addons item', JLTMA_TD),
            'archives'              => esc_html__('Item Archives', JLTMA_TD),
            'attributes'            => esc_html__('Item Attributes', JLTMA_TD),
            'parent_item_colon'     => esc_html__('Parent Item:', JLTMA_TD),
            'all_items'             => esc_html__('All Items', JLTMA_TD),
            'add_new_item'          => esc_html__('Add New Item', JLTMA_TD),
            'add_new'               => esc_html__('Add New', JLTMA_TD),
            'new_item'              => esc_html__('New Item', JLTMA_TD),
            'edit_item'             => esc_html__('Edit Item', JLTMA_TD),
            'update_item'           => esc_html__('Update Item', JLTMA_TD),
            'view_item'             => esc_html__('View Item', JLTMA_TD),
            'view_items'            => esc_html__('View Items', JLTMA_TD),
            'search_items'          => esc_html__('Search Item', JLTMA_TD),
            'not_found'             => esc_html__('Not found', JLTMA_TD),
            'not_found_in_trash'    => esc_html__('Not found in Trash', JLTMA_TD),
            'featured_image'        => esc_html__('Featured Image', JLTMA_TD),
            'set_featured_image'    => esc_html__('Set featured image', JLTMA_TD),
            'remove_featured_image' => esc_html__('Remove featured image', JLTMA_TD),
            'use_featured_image'    => esc_html__('Use as featured image', JLTMA_TD),
            'insert_into_item'      => esc_html__('Insert into item', JLTMA_TD),
            'uploaded_to_this_item' => esc_html__('Uploaded to this item', JLTMA_TD),
            'items_list'            => esc_html__('Items list', JLTMA_TD),
            'items_list_navigation' => esc_html__('Items list navigation', JLTMA_TD),
            'filter_items_list'     => esc_html__('Filter items list', JLTMA_TD),
        );
        $rewrite = array(
            'slug'                  => 'mastermega-content',
            'with_front'            => true,
            'pages'                 => false,
            'feeds'                 => false,
        );
        $args = array(
            'label'                 => esc_html__('Master Addons Item', JLTMA_TD),
            'description'           => esc_html__('mastermega_content', JLTMA_TD),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'elementor', 'permalink'),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => false,
            'show_in_menu'          => false,
            'menu_position'         => 5,
            'show_in_admin_bar'     => false,
            'show_in_nav_menus'     => false,
            'can_export'            => true,
            'has_archive'           => false,
            'publicly_queryable' => true,
            'rewrite'               => $rewrite,
            'query_var' => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
            'rest_base'             => 'mastermega-content',
        );
        register_post_type('mastermega_content', $args);
    }

    public static function get_instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}


/*
* Returns Instanse of the Master Mega Menu
*/
if (!function_exists('jltma_megamenu_cpt')) {
    function jltma_megamenu_cpt()
    {
        return JLTMA_Megamenu_Cpt::get_instance();
    }
}

jltma_megamenu_cpt();
