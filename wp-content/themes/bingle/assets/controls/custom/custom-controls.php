<?php
/**
 * Customizer custom controls
 *
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Checkbox toggle custom control
	 *
	 */
	class Checkbox_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'toogle_checkbox';

		private function abs_path_to_url( $path = '' ) {
			$url = str_replace(
				wp_normalize_path( untrailingslashit( ABSPATH ) ),
				site_url(),
				wp_normalize_path( $path )
			);
			return esc_url_raw( $url );
		}
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_script( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/js/custom-controls.js' ), array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/css/custom-controls.css' ) );
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<div class="checkbox_switch">
				<div class="onoffswitch">
					<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="onoffswitch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> <?php $this->link() . checked( $this->value() ); ?>>
					<label class="onoffswitch-label" for="<?php echo esc_attr( $this->id ); ?>"></label>
				</div>
				<span class="customize-control-title onoffswitch_label"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
			</div>
			<?php
		}
	}

	/**
	 * Info custom control
	 *
	 */
	class Info_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'info';
		public $linkto = '';
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<p><?php echo wp_kses_post( $this->description ); ?></p>
			<?php
			if(!empty($this->linkto)){
				echo '<a class="bingle-cus-linkto" href="#'.$this->linkto['value'].'" rel="bingle-'.$this->linkto['type'].'"><h3 class="accordion-section-title">'.__('Manage','bingle').' '.$this->label.' '.__('Items','bingle').' <i class="dashicons dashicons-redo"></i></h3></a>';
			}
		}
	}

	/**
	 * Separator custom control
	 *
	 */
	class Separator_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'separator';
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<p><hr></p>
			<?php
		}
	}

	/**
	 * Multi input custom control
	 *
	 */
	class Multi_Input_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'multi_input';

		private function abs_path_to_url( $path = '' ) {
			$url = str_replace(
				wp_normalize_path( untrailingslashit( ABSPATH ) ),
				site_url(),
				wp_normalize_path( $path )
			);
			return esc_url_raw( $url );
		}
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_script( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/js/custom-controls.js' ), array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/css/custom-controls.css' ) );
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<label class="customize_multi_input">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize_multi_value_field" <?php $this->link(); ?> />
				<div class="customize_multi_fields">
					<div class="set">
						<input type="text" value="" class="customize_multi_single_field"/>
						<span class="customize_multi_remove_field"><span class="dashicons dashicons-no-alt"></span></span>
					</div>
				</div>
				<a href="#" class="button button-primary customize_multi_add_field"><?php esc_html_e( 'Add More', 'bingle' ) ?></a>
			</label>
			<?php
		}
	}

	/**
	 * Sidebar dropdown custom control
	 *
	 */
	class Sidebar_Dropdown_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'sidebar_dropdown';

		private function abs_path_to_url( $path = '' ) {
			$url = str_replace(
				wp_normalize_path( untrailingslashit( ABSPATH ) ),
				site_url(),
				wp_normalize_path( $path )
			);
			return esc_url_raw( $url );
		}

		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_script( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/js/custom-controls.js'), array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/css/custom-controls.css') );
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<label class="customize_dropdown_input">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
				<?php
				global $wp_registered_sidebars;
				?>
				<select id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?> >
					<?php
					$sidebar_shop = $wp_registered_sidebars;
					if ( is_array( $sidebar_shop ) && ! empty( $sidebar_shop ) ) {
						foreach ( $sidebar_shop as $sidebar ) {
							echo '<option value="' . esc_attr( $sidebar['name'] ) . '" ' . selected( $this->value(), $sidebar['name'], false ) . '>' . esc_html( $sidebar['name'] ) . '</option>';
						}
					}
					?>
				</select>
				<br>
			</label>
			<?php
		}
	}

	/**
	 * Image layout picker custom control
	 *
	 */
	class Image_Radio_Buttons extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'image_radio_buttons';
		public $changednd = '';

		private function abs_path_to_url( $path = '' ) {
			$url = str_replace(
				wp_normalize_path( untrailingslashit( ABSPATH ) ),
				site_url(),
				wp_normalize_path( $path )
			);
			return esc_url_raw( $url );
		}
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_style( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/css/custom-controls.css'));
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<div class="image_radio_buttons">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
				<?php
				foreach ( $this->choices as $choices_key => $choices_value ) {
					?>
					<label rel="<?php echo esc_attr($this->changednd);?>">
						<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $choices_key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $choices_key ), $this->value() ); ?>/>
						<img src="<?php echo esc_attr( $choices_value['image'] ); ?>" alt="<?php echo esc_attr( $choices_value['name'] ); ?>" title="<?php echo esc_attr( $choices_value['name'] ); ?>" />
					</label>
					<?php
				}
				?>
			</div>
			<?php
		}
	}

	/**
	 * Slider custom control
	 *
	 */
	class Slider_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'slider_control';

		private function abs_path_to_url( $path = '' ) {
			$url = str_replace(
				wp_normalize_path( untrailingslashit( ABSPATH ) ),
				site_url(),
				wp_normalize_path( $path )
			);
			return esc_url_raw( $url );
		}
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_script( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/js/custom-controls.js'), array( 'jquery', 'jquery-ui-slider' ), '1.0', true );
			wp_enqueue_style( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/css/custom-controls.css'));
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			$input_vars = $this->input_attrs;
			?>
			<div class="slider_control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
				<div class="slider-r-wrap">
					<input class="slider_input" type="number" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" min="<?php echo esc_attr($input_vars['min']);?>" max="<?php echo esc_attr($input_vars['max']);?>" step="<?php echo esc_attr($input_vars['step']);?>" suffix="<?php echo esc_attr($input_vars['suffix']);?>" <?php $this->link(); ?> />
					<div class="slider-range"></div>
					<span class="slider_value"><?php echo esc_html( $this->value() ); ?><?php echo esc_html($input_vars['suffix']);?></span>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Margin and padding box model custom control
	 */
	class Box_Model extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'box_model';

		private function abs_path_to_url( $path = '' ) {
			$url = str_replace(
				wp_normalize_path( untrailingslashit( ABSPATH ) ),
				site_url(),
				wp_normalize_path( $path )
			);
			return esc_url_raw( $url );
		}
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_script( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/js/custom-controls.js'), array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/css/custom-controls.css'));
		}

		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<p class="description customize-control-description"><?php echo esc_html( $this->description ); ?></p>
			<?php endif;
			$saved_values = ( ! is_array( $this->value() ) && ! empty( $this->value() ) ) ? explode( ', ', $this->value() ) : explode( ', ', '\'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\'' ); ?>
			<div class="box-model-wrapper">
				<?php
				//print_r($saved_values);
				foreach ( $this->choices as $key => $value ) {
					$padding_count = 4;
					$margin_count = 0;
					if ( 'margin' === $key ) { ?>
						<div class="box-model-margin">
							<span><?php esc_html_e( 'Margin', 'bingle' ); ?></span>
							<?php							
							foreach ( $value as $m_key => $m_value ) {
								echo '<input type="number" placeholder="-" value="' . esc_attr( $saved_values[ $margin_count ] ) . '" class="box-model-field ' . esc_html( $m_key ) . '">';
								$margin_count++;
							} ?>
						</div>
						<?php
					}
					if ( 'padding' === $key ) { ?>
						<div class="box-model-padding">
							<span><?php esc_html_e( 'Padding', 'bingle' ); ?></span>
							<?php							
							foreach ( $value as $p_key => $p_value ) {
								echo '<input type="number" placeholder="-" value="' . esc_attr( $saved_values[ $padding_count ] ) . '" class="box-model-field ' . esc_html( $p_key ) . '">';
								$padding_count++;
							} ?>
						</div>
						<?php
					}
				} ?>
				<div class="box-model-content">
					<span><?php esc_html_e( 'Content', 'bingle' ); ?></span>
				</div>
				<input type="hidden" class="box-model-saved" <?php $this->link(); ?> value="<?php echo esc_attr( $saved_values ); ?>" />
			</div>
			<?php
		}
	}

	/**
	 * Alignment layout picker custom control
	 */
	class Alignment_Radio_Buttons extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'align_radio_buttons';
		
		private function abs_path_to_url( $path = '' ) {
			$url = str_replace(
				wp_normalize_path( untrailingslashit( ABSPATH ) ),
				site_url(),
				wp_normalize_path( $path )
			);
			return esc_url_raw( $url );
		}
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_style( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/css/custom-controls.css'));
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<div class="image_radio_buttons icon_radio">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
				<div class="radios-icon-wrap">
					<?php
					foreach ( $this->choices as $choices_key => $choices_value ) {
						?>
						<label>
							<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $choices_key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $choices_key ), $this->value() ); ?>/>
							<i class="<?php echo esc_attr($choices_value); ?>"></i>
						</label>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Sortables custom control
	 */
	class Bingle_Sortable_Elements extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'sort_select';
		
		private function abs_path_to_url( $path = '' ) {
			$url = str_replace(
				wp_normalize_path( untrailingslashit( ABSPATH ) ),
				site_url(),
				wp_normalize_path( $path )
			);
			return esc_url_raw( $url );
		}
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_script( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/js/custom-controls.js'), array( 'jquery','jquery-ui-sortable' ), '1.0', true );
			wp_enqueue_style( 'custom-controls', $this->abs_path_to_url( dirname( __FILE__ ) . '/css/custom-controls.css'));
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<div class="sortable-elements">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
				<div class="sortable-elements-wrap">
					<?php
					if(!empty($this->value())){
						$saved_choices_arr = json_decode($this->value(),true);
						$sort_choices = $saved_choices_arr;
					}else{
						$sort_choices = $this->choices;
					}
					
					foreach ( $sort_choices as $choices_key => $choices_value ) {
						if(isset($choices_value['id']) && isset($choices_value['enable']) && isset($choices_value['name']) ){
							?>
							<div id="<?php echo esc_attr($choices_value['id']) ?>" class="elem-drag <?php echo esc_attr($choices_value['id']) ?> <?php echo ($choices_value['enable']==0)?'section-disable':''; ?>">
								<?php if($choices_value['enable']=='1'){ ?>
									<i class="section-trigger dashicons dashicons-visibility"></i>
								<?php } else { ?>
									<i class="section-trigger dashicons dashicons-hidden"></i>
								<?php } ?>
								<h3 class="elem-drag-title"><?php echo esc_html($choices_value['name']);?></h3>
								<i class="dashicons dashicons-move section-drag"></i>
							</div>
							<?php
						}
					}
					?>
					<input class="sortable-val-store" type="hidden" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr($this->value());?>" <?php $this->link(); ?> />
				</div>
			</div>
			<?php
		}
	}

}//customizer check close