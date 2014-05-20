<?php
/*
 * Settings and administration
 * @since 1.0
 */

add_action('admin_menu', 'demomentsomtres_restaurant_add_page');
add_action('admin_init', 'demomentsomtres_restaurant_admin_init');

/**
 * @since 1.0
 */
function demomentsomtres_restaurant_add_page() {
    add_options_page(__('DMS3-Restaurant', DMS3_RESTAURANT_TEXT_DOMAIN), __('Restaurant', DMS3_RESTAURANT_TEXT_DOMAIN), 'manage_options', DMS3_RESTAURANT_OPTIONS, 'demomentsomtres_restaurant_option_page');
}

/**
 * @since 1.0
 */
function demomentsomtres_restaurant_option_page() {
    ?>
    <div class="wrap" style="float:left;width:70%;">
        <?php screen_icon(); ?>
        <h2><?php _e('DeMomentSomTres - Restaurant', DMS3_RESTAURANT_TEXT_DOMAIN); ?></h2>
        <form action="options.php" method="post">
            <?php settings_fields('dmst_restaurant_options'); ?>
            <?php do_settings_sections('dmst_restaurant'); ?>
            <input name="Submit" class="button button-primary" type="submit" value="<?php _e('Save Changes', DMS3_RESTAURANT_TEXT_DOMAIN); ?>"/>
        </form>
    </div>
    <?php
    echo '<div style="background-color:#eee; width:25%;float:right;padding:10px;">';
    echo '<h3>' . __('Options', DMS3_RESTAURANT_TEXT_DOMAIN) . '</h3>' . '<pre style="font-size:0.8em;">';
    print_r(get_option(DMS3_RESTAURANT_OPTIONS));
    echo '</pre>';
    echo '</div>';
}

/**
 * @since 1.0
 */
function demomentsomtres_restaurant_admin_init() {
    register_setting('dmst_restaurant_options', DMS3_RESTAURANT_OPTIONS, 'demomentsomtres_restaurant_validate_options');
    add_settings_section('dmst_restaurant_template', __('Template', DMS3_RESTAURANT_TEXT_DOMAIN), 'demomentsomtres_restaurant_section_template', 'dmst_restaurant');
}

/**
 * @since 1.0
 */
function demomentsomtres_restaurant_validate_options($input) {
    $result = $input;
    $result['template']=trim(preg_replace('/\r\n/', '', $input['template']));
    return $result;
}

/**
 * @since 1.0
 */
function demomentsomtres_restaurant_section_template() {
    echo '<p>' . __("This content will be inserted as a template of menu.", DMS3_RESTAURANT_TEXT_DOMAIN) . '</p>';

    $template = dmst_admin_helper_get_option(DMS3_RESTAURANT_OPTIONS, 'template', '');
    dmst_admin_helper_input(null, DMS3_RESTAURANT_OPTIONS . "[template]", $template,'editor');
    echo '<br/><br/>';
}
