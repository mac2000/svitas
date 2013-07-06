<?php
function svitas_theme_setup() {
    load_theme_textdomain('svitas', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'svitas_theme_setup');


add_theme_support('post-thumbnails');

add_theme_support('menus');
if (function_exists('register_nav_menus'))
	register_nav_menus(array('menu' => 'Menu'));

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

	$wp_customize->add_setting('header_height', array(
		'default' => 100,
		'transport' => 'refresh'
	));
	$wp_customize->add_control(new Svitas_Customize_Number_Control($wp_customize, 'header_height', array(
		'label' => __('Header height', 'svitas'),
		'section' => 'svitas',
		'settings' => 'header_height',
	)));

	$wp_customize->add_setting('footer_height', array(
		'default' => 100,
		'transport' => 'refresh'
	));
	$wp_customize->add_control(new Svitas_Customize_Number_Control($wp_customize, 'footer_height', array(
		'label' => __('Footer height', 'svitas'),
		'section' => 'svitas',
		'settings' => 'footer_height',
	)));

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
		body > .header {
			height: <?php echo get_theme_mod('header_height'); ?>px;
		}

		body > .wrapper > .container {
			padding-top: <?php echo intval(get_theme_mod('header_height')) + 20; ?>px;
		}

		/* Sticky footer */
		body > .wrapper {
			margin: 0 auto -<?php echo get_theme_mod('footer_height'); ?>px;
		}

		body > .footer, body > .wrapper > .push {
			height: <?php echo get_theme_mod('footer_height'); ?>px;
		}
	</style>
<?php }
add_action('wp_head', 'svitas_customize_css');


function get_post_categories_labels() {
	return array_map(function($category){
//print_r($category);
		echo get_category_link($categoriy->term_id);
		return '<a class="label" href="' . get_category_link($categoriy->cat_ID) . '">' . $category->name . '</a>';
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