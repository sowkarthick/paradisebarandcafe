<?php

require_once WPZOOM_INC . "/components/featured-posts/list-table-checkbox/list-table-checkbox.php";

class WPZOOM_Featured_Posts {

	protected $component_uri = '';
	protected $post_type;
	protected $menu_title;
	protected $menu_names = array();
	protected $featured_metakey = '';
	protected $posts_limit = '';

	public function __construct( $args, $component_directory_uri ) {

		$this->component_uri    = $component_directory_uri;
		$this->post_type        = $args['post_type'];
		$this->menu_title       = $args['menu_title'];
		$this->featured_metakey = isset( $args['name'] ) ? $args['name'] : '';
		$this->posts_limit      = isset( $args['posts_limit'] ) ? $args['posts_limit'] : '';

		add_action( 'admin_menu', array( $this, 'add_featured_page_in_menu' ) );

		add_action( 'current_screen', array( $this, 'check_current_screen' ) );

		add_filter( 'wp_insert_post_data', array( $this, 'insert_post_data' ), 10, 2 );

		add_action( $this->get_ajax_action_name( 'set_featured' ), array(
			$this,
			'set_featured'
		) );
		add_action( $this->get_ajax_action_name( 'save_order' ), array(
			$this,
			'save_order'
		) );

		add_action( 'after_switch_theme', array( $this, 'switch_theme_callback' ) );
		add_action( 'switch_theme', array( $this, 'switch_theme_callback' ) );
		add_action( 'wpzoom_demo_theme_setup_options', array( $this, 'import_demo_setup_callback' ) );
	}

	public function import_demo_setup_callback() {
		delete_option( $this->get_option_key( $this->post_type ) );
	}

	public function switch_theme_callback() {

		if ( $this->get_menu_order_limit( 'MIN' ) == 0 ) {
			delete_option( $this->get_option_key( $this->post_type ) );
		}

	}

	public function add_featured_page_in_menu() {
		$this->menu_names[ $this->post_type ] = $this->add_featured_page(
			$this->menu_title,
			$this->menu_title,
			'edit_posts',
			'wpzoom_featured_sorting_menu_' . $this->post_type,
			array( $this, 'render' )
		);
	}

	public function add_featured_page( $page_title, $menu_title, $capability, $menu_slug, $function = '' ) {

		$link = ( $this->post_type == 'post' ) ? 'edit.php' : 'edit.php?post_type=' . $this->post_type;

		return add_submenu_page( $link, $page_title, $menu_title, $capability, $menu_slug, $function );
	}

	public function admin_js_templates() {
		?>
		<script type="text/x-template" id="tmpl-zoom-featured-posts">
			<?php $this->get_featured_posts_template(); ?>
		</script>
		<?php
	}

	public function get_featured_posts_template() {
		?>

		<div class="wpzoom-featured-posts-wrapper wrap">
			<h1>{{headingTitle}}</h1>
			<draggable :list="posts" class="wpzoom-featured-posts-ul" :options="{handle:'.dashicons-menu'}" @end="onEnd"
			           :move="onMove">
				<div v-for="(post, key) in posts" :style="styleObject(key)">
					<span class="dashicons dashicons-menu"></span>
					<a
						:href="post.edit_href"
						class="thumb"
						:class="{'dashicons dashicons-format-image': !post.thumbnail}"
						v-html="post.thumbnail"></a>
					<div class="el-wrap">
						<a :href="post.edit_href" class="row-title"> {{ post.post_title}}</a>
						<abbr :title="post.formatted_date.time_format">{{ post.formatted_date.date_format }}</abbr>
						<div class="controls">
						<span v-show="key > 0"
						      class="dashicons dashicons-arrow-up-alt2"
						      @click.prevent="down(key)"></span>
						<span v-show="key < posts.length - 1"
						      class="dashicons dashicons-arrow-down-alt2"
						      @click="up(key)"></span>
						<span v-if="showRemoveControl"
						      class="dashicons dashicons-no-alt"
						      @click.prevent="remove(key)"></span>
						</div>
					</div>


				</div>

				<slot>
					<img src="<?php echo esc_url( admin_url( 'images/spinner-2x.gif' ) ); ?>" width="20" height="20"
					     alt=""
					     class="wpzoom-preloader" :class="{hidden:!isAjax}"/>
				</slot>
			</draggable>
			<div class="wpzoom-featured-posts-description">
				<?php $this->render_description() ?>
				<button type="button" class="button button-primary" :class="hasChangedPosts" @click.prevent="save">{{
					buttonLabel }}
				</button>
			</div>

		</div>
		<?php
	}

	public function insert_post_data( $data, $postarr ) {

		global $pagenow;

		if ( empty( $this->featured_metakey ) &&
		     $data['post_type'] == $this->post_type &&
		     in_array( $pagenow, array( 'post-new.php' ) )

		) {
			$max_menu_order = $this->get_menu_order_limit( 'MAX' );

			$data['menu_order'] = ++ $max_menu_order;
		}

		return $data;
	}

	public function admin_enqueue_scripts() {

		wp_enqueue_style(
			'wpzoom-featured-posts',
			$this->get_css_uri( 'style.css' ),
			array(),
			WPZOOM::$themeVersion
		);

		wp_enqueue_script(
			'vue-for-featured-posts',
			$this->get_js_uri( 'vue.js' ),
			array(),
			WPZOOM::$themeVersion,
			true
		);

		wp_enqueue_script(
			'vue-for-featured-posts-sortable',
			$this->get_js_uri( 'sortable.min.js' ),
			array(),
			WPZOOM::$themeVersion,
			true
		);

		wp_enqueue_script(
			'vue-for-featured-posts-sortable-vue',
			$this->get_js_uri( 'vue.draggable.min.js' ),
			array(),
			WPZOOM::$themeVersion,
			true
		);

		wp_enqueue_script(
			'wpzoom-featured-posts-app',
			$this->get_js_uri( 'app.js' ),
			array( 'jquery', 'wp-util' ),
			WPZOOM::$themeVersion,
			true
		);

		wp_localize_script( 'wpzoom-featured-posts-app', 'wpzoom_featured_posts_data',
			array(
				"posts"              => wp_json_encode( $this->get_featured_posts() ),
				"indexedPosts"       => wp_json_encode( $this->get_indexed_featured_posts() ),
				"postsLimit"         => $this->posts_limit,
				"showRemoveControl"  => ! empty( $this->featured_metakey ),
				"buttonLabel"        => __( 'Save list order', 'wpzoom' ),
				"headingTitle"       => $this->menu_title,
				"nonce_set_featured" => wp_create_nonce( 'set_featured' ),
				"nonce_save_order"   => wp_create_nonce( 'save_order' )
			)
		);
	}

	function check_current_screen() {
		$current_screen = get_current_screen();

		if ( $current_screen->id === $this->menu_names[ $this->post_type ] ) {

			$this->set_menu_order_on_first_run();

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			add_action( 'admin_print_footer_scripts', array( $this, 'admin_js_templates' ) );
		}
	}

	public function get_css_uri( $name = '' ) {
		return $this->get_assets_uri( 'css' ) . $name;
	}

	public function get_assets_uri( $name = '' ) {
		return trailingslashit( trailingslashit( $this->component_uri ) . 'assets/' . $name );
	}

	public function get_js_uri( $name = '' ) {
		return $this->get_assets_uri( 'js' ) . $name;
	}

	public function get_ajax_action_name( $action ) {
		return sprintf( 'wp_ajax_%s', $action );
	}

	public function set_featured() {

		$sliced = wp_array_slice_assoc( $_POST, array( 'post_id', 'value', 'nonce_set_featured' ) );

		$response = array(
			'success' => false,
			'data'    => array(
				'message' => sprintf( 'The nonce is invalid' )
			)
		);

		if ( wp_verify_nonce( $sliced['nonce_set_featured'], 'set_featured' ) ) {

			$msg = sprintf( 'The menu_order is set to 0.' );
			if ( ! empty( $this->featured_metakey ) ) {
				$msg .= sprintf( 'And the %s metakey is set to 0.', $this->featured_metakey );
				update_post_meta( $sliced['post_id'], $this->featured_metakey, $sliced['value'] );
			}

			wp_update_post( array(
				'ID'         => $sliced['post_id'],
				'menu_order' => 0,
				'post_type'  => $this->post_type
			) );

			$response['success']         = true;
			$response['data']['message'] = $msg;
		}

		wp_send_json( $response );

	}

	public function get_post_time( $post ) {

		if ( '0000-00-00 00:00:00' === $post->post_date ) {
			$t_time    = $h_time = __( 'Unpublished', 'wpzoom' );
			$time_diff = 0;
		} else {
			$t_time = get_the_time( 'Y/m/d g:i:s a', $post );
			$m_time = $post->post_date;
			$time   = get_post_time( 'G', true, $post );

			$time_diff = time() - $time;

			if ( $time_diff > 0 && $time_diff < DAY_IN_SECONDS ) {
				$h_time = sprintf( __( '%s ago', 'wpzoom' ), human_time_diff( $time ) );
			} else {
				$h_time = mysql2date( 'Y/m/d', $m_time );
			}
		}

		return array( 'date_format' => $h_time, 'time_format' => $t_time );

	}

	public function save_order() {

		$sliced = wp_array_slice_assoc( $_POST, array( 'posts', 'nonce_save_order' ) );

		$response = array(
			'success' => false,
			'data'    => array(
				'message' => sprintf( 'The nonce is invalid' )
			)
		);

		if (
			wp_verify_nonce( $sliced['nonce_save_order'], 'save_order' ) &&
			! empty( $sliced['posts'] ) &&
			is_array( $sliced )
		) {
			foreach ( $sliced['posts'] as $post ) {
				wp_update_post( array(
					'ID'         => $post['ID'],
					'menu_order' => $post['menu_order'],
					'post_type'  => $this->post_type
				) );

			}
			$response['success']         = true;
			$response['data']['message'] = sprintf( 'The menu_order was updated for %d posts.', count( $sliced['posts'] ) );
		}

		wp_send_json( $response );

	}

	public function render_description() {
		printf( __( '<p>Your slideshow is limited to show %d posts.</p>', 'wpzoom' ), $this->posts_limit );
		printf( __( '<p>You can change the number of the posts in <a href="%s">Theme Options</a>.</p>', 'wpzoom' ), menu_page_url( 'wpzoom_options', false ) );
	}

	public function get_featured_posts() {

		static $plucked = array();

		if ( empty( $plucked ) ) {
			$args = $this->get_query_args();

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {

				foreach ( $query->posts as $post ) {
					$sliced                   = wp_array_slice_assoc( get_object_vars( $post ), array(
						'post_title',
						'ID',
						'menu_order'
					) );
					$sliced['edit_href']      = get_edit_post_link( $post->ID, false );
					$sliced['formatted_date'] = $this->get_post_time( $post );
					$sliced['thumbnail']      = get_the_post_thumbnail( $post, array( 60, 60 ) );
					array_push( $plucked, $sliced );
				}
			}

			wp_reset_postdata();

		}

		return $plucked;
	}

	protected function get_query_args() {
		$args = array(
			'post_type'   => $this->post_type,
			'post_status' => array( 'publish' ),
			'orderby'     => 'menu_order date',
			'posts_per_page' => -1
		);

		if ( ! empty( $this->featured_metakey ) ) {
			$args['posts_per_page'] = $this->posts_limit;
			$args['meta_query']     = array(
				array(
					'key'   => $this->featured_metakey,
					'value' => '1',
				),
			);
		}

		return $args;
	}

	public function get_option_key( $post_type ) {
		return "wpzoom_featured_posts_ordered_{$post_type}";
	}

	public function set_menu_order_on_first_run() {

		$is_called = get_option( $this->get_option_key( $this->post_type ) );

		if ( false === $is_called ) {

			update_option( $this->get_option_key( $this->post_type ), true );
			$this->update_menu_order_in_posts();
		}

	}

	public function update_menu_order_in_posts() {
		$args = $this->get_query_args();

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {

			$max_order = $this->get_menu_order_limit( 'MAX', $this->post_type );

			foreach ( $query->posts as $post ) {

				wp_update_post( array(
					'ID'         => $post->ID,
					'menu_order' => $max_order,
					'post_type'  => $this->post_type
				) );
				$max_order --;
			}
		}

		wp_reset_postdata();
	}

	public function get_menu_order_limit( $limit = 'MIN' ) {
		return ! empty( $this->featured_metakey ) ?
			$this->get_menu_order_limit_for_featured( $limit ) :
			$this->get_menu_order_limit_for_all( $limit );
	}

	public function get_menu_order_limit_for_all( $limit = 'MIN' ) {

		global $wpdb;

		$limit = in_array( $limit, array( 'MAX', 'MIN' ) ) ? $limit : 'MIN';

		$sql = "SELECT IFNULL($limit(menu_order),0) FROM $wpdb->posts
            WHERE $wpdb->posts.post_status = 'publish'
            AND $wpdb->posts.post_type =%s";

		return $wpdb->get_var( $wpdb->prepare( $sql, $this->post_type ) );
	}

	public function get_menu_order_limit_for_featured( $limit = 'MIN' ) {

		global $wpdb;

		$limit = in_array( $limit, array( 'MAX', 'MIN' ) ) ? $limit : 'MIN';

		$sql = "SELECT IFNULL($limit(menu_order),0) FROM $wpdb->posts
            INNER JOIN $wpdb->postmeta
            ON ( $wpdb->posts.ID = $wpdb->postmeta.post_id )
            WHERE ( ($wpdb->postmeta.meta_key = %s
            AND $wpdb->postmeta.meta_value = %s ) )
            AND $wpdb->posts.post_status = 'publish'
            AND $wpdb->posts.post_type =%s";

		return $wpdb->get_var( $wpdb->prepare( $sql, $this->featured_metakey, '1', $this->post_type ) );
	}

	public function get_indexed_featured_posts() {

		static $indexed = array();
		if ( empty( $indexed ) ) {
			$featured_posts = $this->get_featured_posts();
			foreach ( $featured_posts as $item ) {
				$indexed[ $item['ID'] ] = $item;
			}
		}

		return $indexed;
	}

	public function render() {
		printf( '<div id="wpzoom-featured-posts-wrapper"></div>' );
	}
}