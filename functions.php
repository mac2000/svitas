<?php
function svitas_theme_setup() {
    load_theme_textdomain('svitas', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'svitas_theme_setup');


add_theme_support('post-thumbnails');

add_theme_support('menus');
if (function_exists('register_nav_menus')) {
	register_nav_menus(array('menu' => 'Menu'));
}

function body_classes($classes) {
	global $post;

	foreach((get_the_category($post->ID)) as $category)
		$classes [] = 'cat-' . $category->cat_ID . '-id';

	if(has_post_thumbnail($post->ID))
		$classes[] = 'has_thumb';

	return $classes;
}
add_filter('post_class', 'body_classes');
add_filter('body_class', 'body_classes');

function active_nav_class($classes, $item){
    if(in_array('current-menu-item', $classes)){
        $classes[] = 'active ';
    }
    return $classes;
}
add_filter('nav_menu_css_class' , 'active_nav_class' , 10 , 2);



function svitas_customize_register($wp_customize) {
	// Custom customize controls
	class Svitas_Customize_Number_Control extends WP_Customize_Control {
		public $type = 'input';

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
				<input type="number" min="10" max="1000" step="10" pattern="\d+" style="width:100%;" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>">
			</label>
			<?php
		}
	}

	// Custom customize section
	$wp_customize->add_section('svitas', array(
		'title'  => __('Svitas Theme Settings', 'svitas'),
		'priority' => 30
	));

	// Customize settings
	/*$wp_customize->add_setting('link_color', array(
		'default' => '#000000',
		'transport' => 'refresh'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_color', array(
		'label' => __('Link Color', 'svitas'),
		'section' => 'svitas',
		'settings' => 'link_color',
	)));*/

	/*$wp_customize->add_setting('header_height', array(
		'default' => 100,
		'transport' => 'refresh'
	));
	$wp_customize->add_control(new Svitas_Customize_Number_Control($wp_customize, 'header_height', array(
		'label' => __('Header height', 'svitas'),
		'section' => 'svitas',
		'settings' => 'header_height',
	)));*/

	/*$wp_customize->add_setting('footer_height', array(
		'default' => 100,
		'transport' => 'refresh'
	));
	$wp_customize->add_control(new Svitas_Customize_Number_Control($wp_customize, 'footer_height', array(
		'label' => __('Footer height', 'svitas'),
		'section' => 'svitas',
		'settings' => 'footer_height',
	)));*/

	/*$wp_customize->add_setting('header_logo', array(
		'default' => bloginfo('template_url') . '/images/header_logo.png',
		'transport' => 'refresh'
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_logo', array(
		'label' => __('Header logo', 'svitas'),
		'section' => 'svitas',
		'settings' => 'header_logo',
	)));*/

	/*$wp_customize->add_setting('footer_logo', array(
		'default' => 100,
		'transport' => 'refresh'
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
		'label' => __('Footer logo', 'svitas'),
		'section' => 'svitas',
		'settings' => 'footer_logo',
	)));*/

	$wp_customize->add_setting('footer_copyright', array(
		'type' => 'option',
		'default' => 'Copyright',
		'transport' => 'refresh'
	));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'footer_copyright', array(
		'label' => __('Footer copyright', 'svitas'),
		'section' => 'svitas',
		'settings' => 'footer_copyright',
	)));
}
add_action('customize_register', 'svitas_customize_register');

function svitas_customize_css() {?>
	<style>
		/* Sticky header */
		/*body > .header {
			height: <?php echo get_theme_mod('header_height', 100); ?>px;
		}

		body > .wrapper > .container {
			padding-top: <?php echo intval(get_theme_mod('header_height', 100)) + 20; ?>px;
		}*/

		/* Sticky footer */
		/*body > .wrapper {
			margin: 0 auto -<?php echo get_theme_mod('footer_height', 100); ?>px;
		}

		body > .footer, body > .wrapper > .push {
			height: <?php echo get_theme_mod('footer_height', 100); ?>px;
		}*/
	</style>
<?php }
add_action('wp_head', 'svitas_customize_css');


function get_post_categories_labels() {
	return array_map(function($category){
		return '<a class="label" href="' . get_category_link($category->cat_ID) . '">' . $category->name . '</a>';
	}, get_the_category());
}

function post_categories_labels($separator = ' ') {
	echo implode($separator, get_post_categories_labels());
}

function svitas_list_categories() {
	$ids = array_filter(get_all_category_ids(), function($id){ return $id != 1; });
	$links = array_map(function($id){
		return '<a class="label" href="' . get_category_link($id) . '">' . get_cat_name($id) . '</a>';
	}, $ids);
	echo '<ul class="unstyled"><li>' . implode('</li><li>', $links) . '</li></ul>';
}

function get_services_page_id() {
    $id = 0;
    $query = new WP_Query(array(
        'post_type' => 'page',
        'meta_query' => array(
            array(
                'key' => '_wp_page_template',
                'value' => 'services.php'
            )
        )
    ));
    if ($query->have_posts()) {
        while ($query->have_posts()){
            $query->the_post();
            $id = get_the_ID();
        }
    }
    wp_reset_postdata();
    return $id;
}

/**
 * CUSTOM POST TYPES
 */
function svitas_service_meta_box_cb() {
    add_meta_box('svitas_standard_service', __('Standard service', 'svitas'), 'svitas_service_meta_box_render', 'service', 'side', 'default');
}
function svitas_service_meta_box_render() {
    global $post;

    echo '<input type="hidden" name="standard_service_none" id="standard_service_none" value="' . wp_create_nonce('standard_service_none') . '" />';

    $standard_service = get_post_meta($post->ID, 'standard_service', true);
    $checked = $standard_service ? 'checked="checked"' : '';
    echo '<label><input type="checkbox" name="standard_service" value="1" ' . $checked . '/> ' . __('standard service', 'svitas') . '</label>';
}
function svitas_save_standard_service($post_id, $post) {
    if (!wp_verify_nonce($_POST['standard_service_none'], 'standard_service_none')) return $post->ID;
    if (!current_user_can('edit_post', $post->ID)) return $post->ID;

    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.

    $meta['standard_service'] = $_POST['standard_service'];

    // Add values of $events_meta as custom fields

    foreach ($meta as $key => $value) { // Cycle through the $events_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }

}
add_action('save_post', 'svitas_save_standard_service', 1, 2);

function svitas_init() {

	// About Us -> Partners
	register_post_type('partner',
		array(
			'labels' => array(
				'name' => __('Partners', 'svitas'),
				'singular_name' => __('Partner', 'svitas')
			),
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'supports' => array('title', 'thumbnail')
		)
	);

	// About Us -> Examples of work
	register_post_type('example',
		array(
			'labels' => array(
				'name' => __('Examples', 'svitas'),
				'singular_name' => __('Example', 'svitas')
			),
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'supports' => array('title', 'thumbnail', 'excerpt')
		)
	);

    // Services -> Service
    register_post_type('service',
        array(
            'labels' => array(
                'name' => __('Services', 'svitas'),
                'singular_name' => __('Service', 'svitas')
            ),
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'supports' => array('title', 'thumbnail', 'editor'),
            'taxonomies' => array('service'),
            'register_meta_box_cb' => 'svitas_service_meta_box_cb'
        )
    );

    // Services -> Category
    register_taxonomy(
        'service',
        'service',
        array(
            'label' => __('Service categories', 'svitas'),
            'show_admin_column' => true,
            'hierarchical' => true
        )
    );

    // Catalog -> Item
    register_post_type('catalog',
        array(
            'labels' => array(
                'name' => __('Catalog', 'svitas'),
                'singular_name' => __('Catalog', 'svitas')
            ),
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'supports' => array('title', 'thumbnail', 'editor'),
            'taxonomies' => array('catalog')
        )
    );

    // Catalog -> Category
    register_taxonomy(
        'catalog',
        'catalog',
        array(
            'label' => __('Catalog categories', 'svitas'),
            'show_admin_column' => true,
            'hierarchical' => true
        )
    );
}
add_action('init', 'svitas_init');
