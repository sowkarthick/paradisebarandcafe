<?php

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WPZOOM_Theme_Customize_Range_Control' ) ) :
	class WPZOOM_Theme_Customize_Range_Control extends WP_Customize_Control {
		public $type = 'range';
		public $mode = 'slider';

		public function enqueue() {
			wp_enqueue_script( 'jquery-ui-slider' );
		}

		protected function render() {
			$id    = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
			$class = 'customize-control customize-control-' . $this->type . ' customize-control-' . $this->type . '-' . $this->mode;

			?><li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
			<?php $this->render_content(); ?>
			</li><?php
		}

		protected function render_content() { ?>
			<label>
				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo $this->description; ?></span>
				<?php endif; ?>
				<div id="slider_<?php echo $this->id; ?>" class="wpzoom-theme-range-slider"></div>
				<input id="input_<?php echo $this->id; ?>" class="wpzoom-theme-control-range" type="number" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
			</label>
		<?php
		}
	}
endif;
