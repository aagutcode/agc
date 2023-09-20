<?php
/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Custom logo Support
    add_theme_support('custom-logo');
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('agutcode', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// AGUTCODE navigation
function agutcode_nav($location = 'header-menu')
{
	wp_nav_menu(
	array(
		'theme_location'  => $location,
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load AGUTCODE scripts (header.php)
function agutcode_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        wp_register_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('owl-carousel'); // Enqueue it!
        wp_register_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js', array('jquery'), '3.5.1'); // gsap scripts
        wp_enqueue_script('gsap'); // Enqueue it!
        wp_register_script('scroll-trigger', get_template_directory_uri() . '/assets/js/ScrollTrigger.min.js', array('jquery'), '3.6.1'); // Custom scripts
        wp_enqueue_script('scroll-trigger'); // Enqueue it!
        wp_register_script('smooth-scrollbar', 'https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.js', array('jquery'), '4.1.4'); // Custom scripts
        wp_enqueue_script('smooth-scrollbar'); // Enqueue it!
        wp_register_script('magic-mouse', get_template_directory_uri() . '/assets/js/magic_mouse.js', array(), '1.0.0'); // Custom scripts
        wp_enqueue_script('magic-mouse'); // Enqueue it!
        wp_register_script('agutcodescripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('agutcodescripts'); // Enqueue it!
    }
}

// Load AGUTCODE conditional scripts
function agutcode_conditional_scripts()
{
    if (is_front_page()) {       
        wp_register_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAOJqdLfEmCW2hg8K-TZjhgvNjuG2WAcHM&callback=initMap'); // Conditional script(s)
        wp_enqueue_script('google-maps'); 
    }
}


// Load AGUTCODE styles
function agutcode_styles(){
    if(!is_admin()){
        wp_register_style('agutcode', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0', 'all');
        wp_enqueue_style('agutcode'); 
        wp_register_style('magic-mouse', get_template_directory_uri() . '/assets/css/magic-mouse.css', array(), '1.0', 'all');
        wp_enqueue_style('magic-mouse'); 
        wp_register_style('owl', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '1.0', 'all');
        wp_enqueue_style('owl'); 
    }
    if(is_admin()){
        wp_register_style('agutcode-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), '1.0', 'all');
        wp_enqueue_style('agutcode-admin'); 
    }
}

// Register AGUTCODE Navigation
function register_agutcode_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'agutcode'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'agutcode'), // Sidebar Navigation
        'footer-menu' => __('Footer Menu', 'agutcode'), // Footer Navigation
        'extra-menu' => __('Extra Menu', 'agutcode') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Header', 'agutcode'),
        'description' => __('Header Right Area. Small widgets only.', 'agutcode'),
        'id' => 'header-widget-area',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Footer Widgets 1', 'agutcode'),
        'description' => __('Footer First Column.', 'agutcode'),
        'id' => 'footer-widgets-1',
        'before_widget' => '<div id="%1$s" class="%2$s widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Footer Widgets 2', 'agutcode'),
        'description' => __('Footer Second Column.', 'agutcode'),
        'id' => 'footer-widgets-2',
        'before_widget' => '<div id="%1$s" class="%2$s widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    register_sidebar(array(
        'name' => __('Footer Widgets 3', 'agutcode'),
        'description' => __('Footer Third Column.', 'agutcode'),
        'id' => 'footer-widgets-3',
        'before_widget' => '<div id="%1$s" class="%2$s widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function agutcode_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function agutcode_index($length) // Create 20 Word Callback for Index page Excerpts, call using agutcode_excerpt('agutcode_index');
{
    return 12;
}
// Custom Excerpts
function agutcode_short($length) // Create 20 Word Callback for Index page Excerpts, call using agutcode_excerpt('agutcode_index');
{
    return 22;
}

// Create 40 Word Callback for Custom Post Excerpts, call using agutcode_excerpt('agutcode_custom_post');
function agutcode_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function agutcode_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function agutcode_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '"></a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function agutcode_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function agutcodegravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function agutcodecomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

function agutcode_categories($tax='category'){
    $terms = get_terms( array(
        'taxonomy' => $tax,
        'hide_empty' => true
    ) );
    $categories = '<span class="cat-filter cat-0 active" data-cat-slug="all">All</span>';
    foreach ($terms as $term) {
        $categories .= '<span class="cat-filter cat-'.$term->term_id.'" data-cat-slug="'.$term->slug.'">'.$term->name.'</span>';
    }
    return $categories;
}
function agutcode_post_terms($id, $tax='category'){    
    $return_terms = '';
    if($id){
        $terms = get_the_terms($id, $tax);
        
        foreach ($terms as $term) {
            $term_link = get_term_link( $term );
    
            // If there was an error, continue to the next term.
            if ( is_wp_error( $term_link ) ) {
                continue;
            }
         
            $return_terms .= '<a href="' . esc_url( $term_link ) . '" rel="tag">' . $term->name . '</a>, ';
            
        }
        $return_terms = substr($return_terms, 0, -2);

    }

    return $return_terms;
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'agutcode_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'agutcode_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('init', 'agutcode_styles'); // Add Theme Stylesheet
add_action('init', 'register_agutcode_menu'); // Add AGUTCODE Menu
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'agutcode_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);

// Add Filters
add_filter('avatar_defaults', 'agutcodegravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'agutcode_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'agutcode_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

?>
