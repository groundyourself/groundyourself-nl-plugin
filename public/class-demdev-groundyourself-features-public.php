<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    DeMDev-GroundYourself-Features
 * @subpackage DeMDev-GroundYourself-Features/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    DeMDev-GroundYourself-Features
 * @subpackage DeMDev-GroundYourself-Features/public
 * @author     Your Name <email@example.com>
 */
class DeMDev_GroundYourself_Features_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $demdev_groundyourself_features    The ID of this plugin.
	 */
	private $demdev_groundyourself_features;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $demdev_groundyourself_features       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $demdev_groundyourself_features, $version ) {

		$this->demdev_groundyourself_features = $demdev_groundyourself_features;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in DeMDev-GroundYourself-Features_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The DeMDev-GroundYourself-Features_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_style($this->demdev_groundyourself_features, plugin_dir_url( __FILE__ ) . 'css/demdev-groundyourself-features-public.css');
        wp_enqueue_style($this->demdev_groundyourself_features);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in DeMDev-GroundYourself-Features_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The DeMDev-GroundYourself-Features_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->demdev_groundyourself_features, plugin_dir_url( __FILE__ ) . 'js/demdev-groundyourself-features-public.js', array( 'jquery' ), $this->version, false );

	}

	public function add_shortcodes() {
		add_shortcode( 'dgf_back_to_parent', array( __CLASS__, 'dgf_back_to_parent' ) );
	}

	/**
	 * @param bool $echo
	 *
	 * @return string
	 */
	public static function dgf_back_to_parent() {
		global $wp_query;
		$learn_dash_labels = new \LearnDash_Custom_Label();
		
		$lesson_id = false;

		$parent = null;

		if( is_singular() ){
			// Get singular vars (page, post, attachments)
			$post      = $wp_query->get_queried_object();
			$post_id   = absint( $wp_query->get_queried_object_id() );
			$post_type = $post->post_type;

			$parent_id = null;
			$parent_label = null;

			// course -> lesson -> topic -> quiz
			if ( 'sfwd-lessons' === $post_type ) {
				// See if Single Lesson is being displayed.
				$parent_id = learndash_get_course_id( $post_id );  // Getting Parent Course ID
				
			} elseif ( 'sfwd-topic' === $post_type ) {
				// See if single Topic is being displayed
				$course_id = learndash_get_course_id( $post_id ); // Getting Parent Course ID
				$parent_id = learndash_get_lesson_id( $post_id, $course_id ); // Getting Parent Lesson ID
				$parent_label = $learn_dash_labels::get_label( 'lesson' );

			} elseif ( 'sfwd-quiz' === $post_type ) {
				// See if quiz is being displayed
				$course_id = learndash_get_course_id( $post_id ); // Getting Parent Course ID
				$topic_id = learndash_get_lesson_id( $post_id, $course_id ); // Getting Parent Topic/Lesson ID

				if ( 'sfwd-topic' === get_post_type( $topic_id ) ) {
					$lesson_id = learndash_get_lesson_id( $topic_id, $course_id ); // Getting Parent Lesson ID
				}

				$parent_id = $course_id;
				//If $lesson_id is false, the quiz is associated with a lesson and course but not a topic.
				if ( $lesson_id ) {
					$parent_id = $lesson_id;
					$parent_label = $learn_dash_labels::get_label( 'lesson' );
				}
				//If $topic_id is false, the quiz is associated with a course but not associated with any lessons or topics.
				if ( $topic_id ) {
					$parent_id = $topic_id;
					$parent_label = $learn_dash_labels::get_label( 'topic' );
				}
				$parent_permalink = get_permalink( $parent_id );
				$parent_title = get_the_title( $parent_id );
				$parent = esc_html($parent_title);
			}
		}

		if($parent_id){
			$parent_permalink = get_permalink( $parent_id );
			$parent_title = get_the_title( $parent_id );
			if(!$parent_label){
				$parent_label = '';
			}
			$link = sprintf(
				'<div id="gy_back_to_parent"><a class="wpProQuiz_button" href="%1$s" title="%2$s" rel="%3$s">← %4$s </a></div>',
				esc_url( $parent_permalink ),
				esc_attr( $parent_title ),
				sanitize_title( $parent_title ),
				esc_html( $parent_title )
		    );
			return $link;
		}else{
			return __('not a learndash construct with parent', 'demdev-groundyourself-features');
		}
	}
}
