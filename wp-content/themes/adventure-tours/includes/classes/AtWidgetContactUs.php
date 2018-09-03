<?php
/**
 * Contact us widget component.
 *
 * @author    Themedelight
 * @package   Themedelight/AdventureTours
 * @version   2.1.3
 */

class AtWidgetContactUs extends WP_Widget
{
	public $allow_use_links = true;

	public $delimiter = '|';

	public function __construct() {
		parent::__construct(
			'contact_us_adventure_tours',
			'AdventureTours: ' . esc_html__( 'Contact Us', 'adventure-tours' ),
			array(
				'description' => esc_html__( 'Contact Us Widget', 'adventure-tours' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$allow_use_links = $this->allow_use_links;
		$delimiter = $this->delimiter;

		extract( $args );
		extract( $instance );

		$elements_html = '';

		if ( ! empty( $address ) ) {
			$elements_html .= '<div class="widget-contact-info__item">' .
				'<div class="widget-contact-info__item__icon"><i class="fa fa-map-marker"></i></div>' .
				'<div class="widget-contact-info__item__text"><span>' . esc_html( $address ) . '</span></div>' .
			'</div>';
		}

		if ( ! empty( $phone ) ) {
			$phones_list = $delimiter ? explode( $delimiter, $phone ) : (array) $phone;
			$elements_html .= $this->render_phone_numbers( $phones_list );
		}

		if ( ! empty( $mobile ) ) {
			$phones_list = $delimiter ? explode( $delimiter, $mobile ) : (array) $mobile;
			$elements_html .= $this->render_phone_numbers( $phones_list, 'fa fa-mobile widget-contact-info__item__icon__mobile' );
		}

		if (  ! empty( $email ) ) {
			$emails_list = $delimiter ? explode( $delimiter, $email ) : (array) $email;
			foreach ( $emails_list as $cur_email ) {
				$cur_email = trim( $cur_email );
				if ( ! $cur_email ) {
					continue;
				}

				if ( $allow_use_links ) {
					$email_html = sprintf( '<a href="%s">%s</a>',
						esc_html( 'mailto:' . $cur_email ),
						esc_html( $cur_email )
					);
				} else {
					$email_html = esc_html( $cur_email );
				}

				$elements_html .= '<div class="widget-contact-info__item">' .
					'<div class="widget-contact-info__item__icon"><i class="fa fa-envelope widget-contact-info__item__icon__email"></i></div>' .
					'<div class="widget-contact-info__item__text">' . $email_html . '</div>' .
				'</div>';
			}
		}

		if ( ! empty( $skype ) ) {
			$skypes_list = $delimiter ? explode( $delimiter, $skype ) : (array) $skype;
			foreach ( $skypes_list as $cur_skype ) {
				$cur_skype = trim( $cur_skype );
				if ( ! $cur_skype ) {
					continue;
				}

				if ( $allow_use_links ) {
					$skype_html = sprintf( '<a href="%s">%s</a>',
						esc_attr( 'skype:' . $cur_skype . '?call' ),
						esc_html( $cur_skype )
					);
				} else {
					$skype_html = esc_html( $cur_skype );
				}
				$elements_html .= '<div class="widget-contact-info__item">' .
					'<div class="widget-contact-info__item__icon"><i class="fa fa-skype"></i></div>' .
					'<div class="widget-contact-info__item__text">' . $skype_html . '</div>' .
				'</div>';
			}
		}

		if ( $elements_html ) {
			printf(
				'%s<div class="widget-contact-info">%s%s</div>%s',
				$before_widget,
				$title ? $before_title . esc_html( $title ) . $after_title : '',
				$elements_html,
				$after_widget
			);
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
		return $instance;
	}

	public function form( $instance ) {
		$default = array(
			'title' => '',
			'address' => '',
			'phone' => '',
			'mobile' => '',
			'email' => '',
			'skype' => '',
		);

		$itemTitles = array(
			'title' => esc_html__( 'Title', 'adventure-tours' ),
			'address' => esc_html__( 'Address', 'adventure-tours' ),
			'phone' => esc_html__( 'Phone', 'adventure-tours' ),
			'mobile' => esc_html__( 'Mobile', 'adventure-tours' ),
			'email' => esc_html__( 'Email', 'adventure-tours' ),
			'skype' => esc_html__( 'Skype', 'adventure-tours' ),
		);

		$instance = wp_parse_args( (array) $instance, $default );

		foreach ( $instance as $key => $val ) {
			$itemTitle = isset( $itemTitles[$key] ) ? $itemTitles[$key] : '';

			echo '<p>' .
				'<label for="' . esc_attr( $this->get_field_id( $key ) ) . '">' . esc_html( $itemTitle ) . ':</label>' .
				'<input class="widefat" id="' . esc_attr( $this->get_field_id( $key ) ) . '" name="' . esc_attr( $this->get_field_name( $key ) ) . '" type="text" value="' . esc_attr( $val ) . '">' .
			'</p>';
		}
	}

	protected function render_phone_numbers( $phones_list, $icon_class = 'fa fa-phone' ) {
		$result = '';
		if ( $phones_list ) {
			$item_template = '<div class="widget-contact-info__item">' .
					'<div class="widget-contact-info__item__icon"><i class="' . esc_attr( $icon_class ) . '"></i></div>' .
					'<div class="widget-contact-info__item__text">%s</div>' .
				'</div>';

			foreach ( $phones_list as $cur_phone ) {
				$cur_phone = trim( $cur_phone );
				if ( ! $cur_phone ) {
					continue;
				}

				if ( $this->allow_use_links && '+' == $cur_phone[0] ) {
					$phone_html = sprintf( '<a href="%s">%s</a>',
						esc_html( 'call:' . preg_replace('/ |-|\(|\)/', '', $cur_phone) ),
						esc_html( $cur_phone )
					);
				} else {
					$phone_html = esc_html( $cur_phone );
				}

				$result .= sprintf( $item_template, $phone_html );
			}
		}

		return $result;
	}
}
