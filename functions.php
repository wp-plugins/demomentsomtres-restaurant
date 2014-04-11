<?php

/**
 * Creates all content types and taxonomies
 * @since 1.0
 */
function demomentsomtres_restaurant_create_dish_lists() {
    $labels = array(
        'name' => _x('Dish List Types', 'taxonomy general name', DMS3_RESTAURANT_TEXT_DOMAIN),
        'singular_name' => _x('Dish List Type', 'taxonomy singular name', DMS3_RESTAURANT_TEXT_DOMAIN),
        'search_items' => __('Search Type', DMS3_RESTAURANT_TEXT_DOMAIN),
        'all_items' => __('All Types', DMS3_RESTAURANT_TEXT_DOMAIN),
        'parent_item' => __('Parent Type', DMS3_RESTAURANT_TEXT_DOMAIN),
        'parent_item_colon' => __('Parent Type:', DMS3_RESTAURANT_TEXT_DOMAIN),
        'edit_item' => __('Edit Type', DMS3_RESTAURANT_TEXT_DOMAIN),
        'update_item' => __('Update Type', DMS3_RESTAURANT_TEXT_DOMAIN),
        'add_new_item' => __('Add New Type', DMS3_RESTAURANT_TEXT_DOMAIN),
        'new_item_name' => __('New Type Name', DMS3_RESTAURANT_TEXT_DOMAIN),
    );
    register_taxonomy('dish-list-type', '', array(
        'hierarchical' => true,
        'labels' => $labels
    ));
    register_post_type('dish-list', array(
        'labels' => array(
            'name' => __('Dish Lists', DMS3_RESTAURANT_TEXT_DOMAIN),
            'singular_name' => __('Dish List', DMS3_RESTAURANT_TEXT_DOMAIN),
            'add_new' => __('Add Dish List', DMS3_RESTAURANT_TEXT_DOMAIN),
            'add_new_item' => __('Add New Dish List', DMS3_RESTAURANT_TEXT_DOMAIN),
            'edit' => __('Edit', DMS3_RESTAURANT_TEXT_DOMAIN),
            'edit_item' => __('Edit Dish List', DMS3_RESTAURANT_TEXT_DOMAIN),
            'new_item' => __('New Dish List', DMS3_RESTAURANT_TEXT_DOMAIN),
            'view' => __('View', DMS3_RESTAURANT_TEXT_DOMAIN),
            'view_item' => __('View Dish List', DMS3_RESTAURANT_TEXT_DOMAIN),
            'search_items' => __('Search Dish List', DMS3_RESTAURANT_TEXT_DOMAIN),
            'not_found' => __('No Dish List found', DMS3_RESTAURANT_TEXT_DOMAIN),
            'not_found_in_trash' => __('No Dish List found in Trash', DMS3_RESTAURANT_TEXT_DOMAIN),
            'parent' => __('Parent Dish List', DMS3_RESTAURANT_TEXT_DOMAIN)
        ),
        'public' => true,
        'show_in_nav_menus' => true,
        'menu_position' => 15,
        'taxonomies' => array('dish-list-type'),
        'rewrite' => array('slug' => 'restaurant'),
        'query_var' => true,
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    ));
}

/**
 * Manages dish list shortcode
 * @since 0.1
 * @param array $attr
 * @param string $content
 * @return string the Content with the dishlist
 */
function demomentsomtres_restaurant_dish_list_shortcode($attr, $content) {
    if (!isset($attr['type'])):
        return '';
    endif;
    $type = $attr['type'];
    $count = (!isset($attr['count'])) ? 1 : $attr['count'];
    $empty = (!isset($attr['empty'])) ? "" : $attr['empty'];
    $hiddenTitles = in_array('hidden_titles', $attr) ? true : false;
    //$hiddenTitles = (!isset($attr['hidden_titles'])) ? false : true;
    $titleFormat = (!isset($attr['title_format'])) ? 'h3' : $attr['title_format'];
    $allDishLists = demomentsomtres_restaurant_get_dish_lists($type, $count);
    $output = '';
    if (count($allDishLists) == 0):
        $output .= $empty;
    else:
        foreach ($allDishLists as $dishList):
            $output .= "<div class=\"demomentsomtres-dish-list\">";
            if (!$hiddenTitles):
                $output .= "<$titleFormat class=\"demomentsomtres-dish-list-title\">";
                $output .= $dishList->post_title;
                $output .= "</$titleFormat>";
            endif;
            $output .= $dishList->post_content;
            $output .= "</div>";
        endforeach;
    endif;
//    echo '<pre style="display:hidden;">';
//    print_r($attr);
//    print_r('$hidden'.$hiddenTitles);
//    print_r($allDishLists);
//    echo '</pre>';
    return do_shortcode($content . apply_filters('the_content', $output));
}

function demomentsomtres_restaurant_eco_shortcode() {
    $output = '<i class="icon-eco">' . __('Ecological', DMS3_RESTAURANT_TEXT_DOMAIN) . '</i>';
    return $output;
}

function demomentsomtres_restaurant_veg_shortcode() {
    $output = '<i class="icon-veg">' . __('Vegetarian', DMS3_RESTAURANT_TEXT_DOMAIN) . '</i>';
    return $output;
}

function demomentsomtres_restaurant_p_shortcode($attr) {
    $output = '<span class="price">' . $attr[0] . '</span>';
    //$output='<pre>'.print_r($attr,true).'</pre>';
    return $output;
}

function demomentsomtres_restaurant_get_dish_lists($type, $count = 1) {
    $queryArgs = array(
        'post_type' => 'dish-list',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => $count,
        'tax_query' => array(
            array(
                'taxonomy' => 'dish-list-type',
                'field' => 'id',
                'terms' => $type,
            ),
        ),
        //v1.1.0+ start
        'meta_query' => array(
            array(
                'key' => 'demomentsomtres-restaurant-expiry-date',
                'value' => date('Y-m-d'),
                'compare' => '>=',
            ),
        ),
            //v1.1.0+ end
    );
    $newQuery = new WP_Query();
    $newQuery->query($queryArgs);
    return $newQuery->posts;
}

/**
 * Adds the expiry date field metabox
 * @since 1.0
 */
function demomentsomtres_restaurant_expiry_date() {
    add_meta_box('demomentsomtres-restaurant-expiry-date', __('Expiry date', DMS3_RESTAURANT_TEXT_DOMAIN), 'demomentsomtres_restaurant_expiry_date_metabox', 'dish-list', 'side', 'high');
}

/**
 * Creates the metabox for expiry date metabox
 * @since 1.0
 */
function demomentsomtres_restaurant_expiry_date_metabox($post) {
    echo '<input type="hidden" name="demomentsomtres-restaurant-nonce" value="' . wp_create_nonce(basename(__FILE__)) . '"/>';
    $expiry_date = demomentsomtres_restaurant_get_expiry_date($post->ID);
    echo '<label for="demomentsomtres-expiry">' . __('Expiry date', DMS3_RESTAURANT_TEXT_DOMAIN) . ':</label>';
    echo '<input type="date" id="demomentsomtres-expiry" name="demomentsomtres-restaurant-expiry-date" value="' . $expiry_date . '"/>';
}

/**
 * Manages the save of meta fields on dish list posts
 * @since 1.0
 */
function demomentsomtres_restaurant_meta_save($post) {
    if (!isset($_POST['demomentsomtres-restaurant-nonce']) || !wp_verify_nonce($_POST['demomentsomtres-restaurant-nonce'], basename(__FILE__))):
        return $post;
    endif;
    $expiry = $_POST['demomentsomtres-restaurant-expiry-date'];
    update_post_meta($post, 'demomentsomtres-restaurant-expiry-date', $expiry);
}

/**
 * Retrieves the expiry date associated to post based on post->ID
 * @param integer $id the post ID
 * @return date the expiry date. If none is found returns next new year's eve.
 * @since 1.0
 */
function demomentsomtres_restaurant_get_expiry_date($id) {
    $expiry = get_post_meta($id, 'demomentsomtres-restaurant-expiry-date', true);
    if (empty($expiry)):
        $expiry = DMS3_RESTAURANT_LAST_DATE;
    endif;
    return $expiry;
}

/**
 * Used to filter expired dish-list from queries
 * @param object $query a wp_query object
 * @since 1.0
 */
function demomentsomtres_restaurant_filter_expired($query) {
    if (!is_admin()):
        if ('dish-list' == $query->query_vars['post_type']):
            $meta_query = array();
            $meta_query[] = array(
                'key' => 'demomentsomtres-restaurant-expiry-date',
                'value' => date('Y-m-d'),
                'compare' => '>=',
            );
            $query->set('meta_query', $meta_query);
        endif;
    endif;
}

/**
 * Checks if restaurant buttons are required
 * @since 1.0
 * @global string $current_screen
 */
function demomentsomtres_restaurant_insert_buttons() {
    global $current_screen;
    if ((!current_user_can('edit_posts') && !current_user_can('edit_pages') ) && get_user_option('rich_editing')):
        return;
    endif;
    if ($current_screen->post_type == "dish-list"):
        if (get_user_option('rich_editing')):
            add_filter('mce_buttons', 'demomentsomtres_restaurant_register_buttons');
            add_filter("mce_external_plugins", "demomentsomtres_restaurant_add_tinymce_plugin");
        endif;
    endif;
}

/**
 * Registers buttons to TinyMCE
 * @param array $buttons
 * @return array
 * @since 1.0
 */
function demomentsomtres_restaurant_register_buttons($buttons) {
    array_push($buttons, "dms3RestaurantEco", "dms3RestaurantVeg", "dms3RestaurantPrice", "dms3RestaurantTemplate");
    return $buttons;
}

/**
 * Adds Load the TinyMCE plugin : editor_plugin.js
 * @param array $plugin_array
 * @return type
 * @since 1.0
 */
function demomentsomtres_restaurant_add_tinymce_plugin($plugin_array) {
    $plugin_array['dms3Restaurant'] = plugins_url('mce_plugins/editor_plugin.js', __FILE__);
    return $plugin_array;
}

/**
 * Modifies content post to insert the expiry date
 * @global mixed $post
 * @param text $content
 * @return string 
 * @since 1.1.0
 */
function demomentsomtres_restaurant_content_expired_filter($content) {
    global $post;
    if (($post->post_type == 'dish-list') && in_the_loop()):
        $newText = demomentsomtres_restaurant_expired_message($post->ID);
    else:
        $newText = '';
    endif;
    $content = $newText . $content;
    return $content;
}

/**
 * Checks if the post is expired
 * @param integer $postid the post to test
 * @return boolean
 * @since 1.1.0
 */
function demomentsomtres_restaurant_is_expired($postid) {
    $expiry_date = demomentsomtres_restaurant_get_expiry_date($postid);
    if ($expiry_date):
        $now = date('Y-m-d');
        return ($now >= $expiry_date);
    else:
        return false;
    endif;
}

/**
 * Generates a message to add to the dish list if it is expired
 * @param integer $postid the post id
 * @return string the message to attach
 * @since 1.1.0
 */
function demomentsomtres_restaurant_expired_message($postid) {
    if (demomentsomtres_restaurant_is_expired($postid)):
        return '<span class="demomentsomtres-restaurant-expired">' . demomentsomtres_restaurant_pretty_expiry_date($postid) . '</span>';
    else:
        return '';
    endif;
}

/**
 * Formats the expiry date to be beautiful
 * @param integer $postid   the post to consider
 * @return string the date ready to be printed
 * @since 1.1.0
 */
function demomentsomtres_restaurant_pretty_expiry_date($postid) {
    $dateFormat = get_option('date_format');
    $dateDB = demomentsomtres_restaurant_get_expiry_date($postid);
    $date = strtotime($dateDB);
    $text = date_i18n($dateFormat, $date);
    return $text;
}

/**
 * Configures tinymce settings
 * @param array $settings
 * @return array
 * @since 1.2
 */
function demomentsomtres_restaurant_tinymce_settings($settings) {
//    print_r(htmlentities(dmst_admin_helper_get_option(DMS3_RESTAURANT_OPTIONS, 'template', '')));
    $settings['dms3restauranttemplate'] = '<![CDATA[' . htmlentities(dmst_admin_helper_get_option(DMS3_RESTAURANT_OPTIONS, 'template', '')) . ']]>';
    $settings['dms3restauranttemplate'] = dmst_admin_helper_get_option(DMS3_RESTAURANT_OPTIONS, 'template', '');
//    echo '<pre>';print_r($settings);echo '</pre>';
    return $settings;
}

?>