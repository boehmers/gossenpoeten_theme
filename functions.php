<?php
/**
 * gossenpoeten_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package gossenpoeten_theme
 */

if (!function_exists('gossenpoeten_theme_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function gossenpoeten_theme_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on gossenpoeten_theme, use a find and replace
         * to change 'gossenpoeten_theme' to the name of your theme in all the template files.
         */
        load_theme_textdomain('gossenpoeten_theme', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'gossenpoeten_theme'),
            'social' => __( 'Social Links Menu', 'gossenpoeten_theme' ),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('gossenpoeten_theme_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
    }
endif;
add_action('after_setup_theme', 'gossenpoeten_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gossenpoeten_theme_content_width()
{
    $GLOBALS['content_width'] = apply_filters('gossenpoeten_theme_content_width', 640);
}

add_action('after_setup_theme', 'gossenpoeten_theme_content_width', 0);

if ( !function_exists( 'gossenpoeten_theme_the_custom_logo' ) ) :
    /**
     * Displays the optional custom logo.
     *
     * Does nothing if the custom logo is not available.
     *
     */
    function gossenpoeten_theme_the_custom_logo() {
        // Try to retrieve the Custom Logo
        $output = '';
        if (function_exists('get_custom_logo'))
            $output = get_custom_logo();

        echo $output;
    }
endif;

// Add logo upload in customizer WordPress 4.5+
add_theme_support( 'custom-logo' );

/**
 * widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * scripts
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Bootstrap Walker Menu
 */
require get_template_directory() . '/inc/bootstrap-walker.php';

// 18.04.2017 Max: Custom-Post-Type für Termine erstellen
    add_action('init', 'create_post_type_events');
    function create_post_type_events() {
        register_post_type( 'event_dates',
            array(
                'labels' => array(
                'name' => __( 'Termine' ),
                'singular_name' => __( 'Termine' ),
            ),
                'public' => true,
                'has_archive' => true
            )
        );
    }

// 18.04.2017 Max: Custom-Fields für Termine hinzufügen
    add_action( 'admin_init', 'add_tour_dates_meta_box' );
    function add_tour_dates_meta_box() {
        add_meta_box(   'tour_dates_meta_box',
                        'Termine Details',
                        'display_tour_dates_meta_box',
                        'event_dates'
        );
    }

    const META_DATE = 'dates_date'; // Datum
    const META_LOCATION = 'dates_location'; // Ort
    const META_TIME = 'dates_time'; // Uhrzeit
    const META_ADDRESS = 'dates_address'; // Adresse für Google Maps
    const META_ORGANIZER = 'dates_organizer'; // Veranstalter
    const META_ORGANIZER_LINK = 'dates_organizer_link'; // Verlinkung zum Veranstalter
    const META_TICKETS = 'dates_tickets'; // Link zu etwaigen Tickets
    const META_ICAL_FILENAME = 'dates_ical_filename'; // Link iCal-Datei

    function display_tour_dates_meta_box( $post ) {
        $date = esc_html( get_post_meta($post->ID, META_DATE, true ));
        $location = esc_html( get_post_meta($post->ID, META_LOCATION, true ));
        $time = esc_html( get_post_meta($post->ID, META_TIME, true ));
        $address = esc_html( get_post_meta($post->ID, META_ADDRESS, true ));
        $organizer = esc_html( get_post_meta($post->ID, META_ORGANIZER, true ));
        $organizer_link = esc_html( get_post_meta($post->ID, META_ORGANIZER_LINK, true ));
        $tickets = esc_html( get_post_meta($post->ID, META_TICKETS, true )); ?>
        <table>
            <tr>
                <td style="width: 100%">Datum (Format: DD.MM.YYYY)</td>
                <td><input type="text" size="50" name="<?php echo META_DATE;?>" value="<?php echo $date; ?>"></td>
            </tr>
            <tr>
                <td style="width: 100%">Ort (Bsp.: "München")</td>
                <td><input type="text" size="50" name="<?php echo META_LOCATION;?>" value="<?php echo $location; ?>"></td>
            </tr>
            <tr>
                <td style="width: 100%">Veranstalter/Location (Bsp.: "Löwensaal")</td>
                <td><input type="text" size="50" name="<?php echo META_ORGANIZER;?>" value="<?php echo $organizer; ?>"></td>
            </tr>
            <tr>
                <td style="width: 100%">Veranstalter-Website (für richtige Verlinkung; Format: "www.xyz.de" ohne "http://")</td>
                <td><input type="text" size="50" name="<?php echo META_ORGANIZER_LINK;?>" value="<?php echo $organizer_link; ?>"></td>
            </tr>
            <tr>
                <td style="width: 100%">Uhrzeit (ohne "Uhr" -> Bsp.: "20:30")</td>
                <td><input type="text" size="50" name="<?php echo META_TIME;?>" value="<?php echo $time; ?>"></td>
            </tr>
            <tr>
                <td style="width: 100%">Adresse (zur richtigen Verlinkung zu Google Maps)</td>
                <td><input type="text" size="50" name="<?php echo META_ADDRESS;?>" value="<?php echo $address; ?>"></td>
            </tr>
            <tr>
                <td style="width: 100%">Tickets-Link ("Tickets" wird in der Tabelle nur angezeigt, wenn dieses Feld nicht leer ist)</td>
                <td><input type="text" size="50" name="<?php echo META_TICKETS;?>" value="<?php echo $tickets; ?>"></td>
            </tr>
        </table> <?php
    }

    add_action( 'save_post', 'save_tour_dates_meta' );
    function save_tour_dates_meta( $post_id ) {
        include_once("helpers/ical-export.php");
        // Speichere die Extra-Felder
            if ( $_POST['post_type']=='event_dates' ) {
                if ( isset( $_POST[META_DATE] ) ) {
                    update_post_meta($post_id, META_DATE, $_POST[META_DATE]);

                    // Aufbereiten für iCal-Export
                        $date = explode(".", $_POST[META_DATE]);
                        $date = array_reverse($date);
                        $date = implode("", $date);
                }
                if ( isset( $_POST[META_LOCATION] ) ) {
                    update_post_meta($post_id, META_LOCATION, $_POST[META_LOCATION]);
                }
                if ( isset( $_POST[META_ORGANIZER] ) ) {
                    update_post_meta($post_id, META_ORGANIZER, $_POST[META_ORGANIZER]);
                }
                if ( isset( $_POST[META_TIME] ) ) {
                    update_post_meta($post_id, META_TIME, $_POST[META_TIME]);

                    //Aufbereiten für iCal-Export
                        $time = "T".str_replace(":", "", $_POST[META_TIME])."00";
                }
                if ( isset( $_POST[META_ADDRESS] ) ) {
                    update_post_meta($post_id, META_ADDRESS, $_POST[META_ADDRESS]);
                }
                if ( isset( $_POST[META_ORGANIZER_LINK] ) ) {
                    update_post_meta($post_id, META_ORGANIZER_LINK, $_POST[META_ORGANIZER_LINK]);
                }
                if ( isset( $_POST[META_TICKETS] ) ) {
                    update_post_meta($post_id, META_TICKETS, $_POST[META_TICKETS]);
                }

                // Erzeuge/Aktualisiere die iCal-Datei
                    if(isset($date) && isset($time)){
                        $event_array = array();
                        $event_array["start"] = $date.$time;
                        $event_array["location"] = $_POST[META_ORGANIZER]." ".$_POST[META_LOCATION];
                        date_default_timezone_set('Europe/Berlin');
                        $event_array["current_time"] = date("Ymd")."T".date("His");
                        $event_array["title"] = "Gossenpoeten - ".$_POST["post_title"];
                        $event_array["url"] = $_POST[META_ORGANIZER_LINK];
                        $filename = createICalFile($event_array);
                        update_post_meta($post_id, META_ICAL_FILENAME, $filename);
                    }
            }

    }

//Sidebar Widget um den nächsten (öffentlichen) Termin anzuzeigen
    // Register and load the widget
        function wpb_load_widget() {
            register_widget( 'tour_widget' );
        }
        add_action('widgets_init','wpb_load_widget');

// Creating the widget
    class tour_widget extends WP_Widget {

        function __construct() {
            $widget_options = array('description' => 'Einfaches Widget um den nächsten öffentlichen Termin anzuzeigen');

            parent::__construct('tour_widget', "Tour-Widget", $widget_options);
        }

        // Creating widget front-end
            public function widget( $args, $instance ) {
                $title = apply_filters( 'widget_title', $instance['title'] );

                // before and after widget arguments are defined by themes
                    echo $args['before_widget'];
                    if ( ! empty( $title ) )
                        echo $args['before_title'] . $title . $args['after_title'];

                // Get the next event
                    $args = array('post_type' => 'event_dates');
                    $loop = new WP_Query( $args );
                    $events_array = array();

                    while ( $loop->have_posts() ) {
                        $loop->the_post();
                        $post_id = get_the_ID();

                        $event = array();
                        $event["name"] = get_the_title();
                        $event["date"] = get_post_meta($post_id, 'dates_date', true);
                        $event["time"] = get_post_meta($post_id, 'dates_time', true);
                        $event["location"] = get_post_meta($post_id, 'dates_location', true);
                        $event["address"] = get_post_meta($post_id, 'dates_address', true);
                        $event["organizer"] = get_post_meta($post_id, 'dates_organizer', true);
                        $event["organizer_link"] = get_post_meta($post_id, 'dates_organizer_link', true);
                        $event["tickets"] = get_post_meta($post_id, 'dates_tickets', true);

                        $events_array[] = $event;
                    }

                    function timeSort($item1,$item2)
                    {
                        if (strtotime($item1['date']) == strtotime($item2['date'])){
                            return (str_replace(':', '', $item1['time']) > str_replace(':', '', $item2['time'])) ? 1 : -1;
                        }else {
                            return (strtotime($item1['date']) > strtotime($item2['date'])) ? 1 : -1;
                        }
                    }
                    usort($events_array,'timeSort');

                    $upcoming_events = array();
                    foreach ($events_array as $event){
                        $timestamp_now = time();
                        $timestamp_event = strtotime($event["date"]." ".$event["time"].":0");

                        if($timestamp_now <= $timestamp_event){
                            $upcoming_events[] = $event;
                        }
                    }


                // This is where you run the code and display the output
                    echo "<div class='tour_widget'>";
                        echo "<p>";
                            echo "<b>".$upcoming_events[0]["name"]."</b><br>";
                            echo "<span class='widget_small_text'>".$upcoming_events[0]["date"]." ".$upcoming_events[0]["time"]."<br>";
                            echo $upcoming_events[0]["organizer"]."<br>";
                            echo $upcoming_events[0]["location"]."</span>";
                            echo "<br><a href=\"tour\">Mehr Infos</a>";
                            if($upcoming_events[0]["tickets"] !== ""){
                                echo "<br><a target='_blank' href='http://".$upcoming_events[0]["tickets"]."'><button class='btn btn-success btn-xs'>Tickets</button></a>";
                            }
                        echo "</p>";
                    echo "</div>";

                echo $args['after_widget'];
            }

        // Widget Backend
            public function form($instance){
                if (isset($instance['title'])){
                    $title = $instance['title'];
                }
                else{
                    $title = "Neuer Titel";
                }
                // Widget admin form
                    ?>
                    <p>
                        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Titel</label>
                        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
                    </p>
                    <?php
            }

        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            return $instance;
        }
    } // Class
