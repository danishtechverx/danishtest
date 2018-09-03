<?php
/**
 * Class contains methods/helper functions related to Wordpress SEO plugin integration.
 * Fixes canonical urls for tours archive page and tours archive page title.
 *
 * @author    Themedelight
 * @package   Themedelight/AdventureTours
 * @version   2.2.4
 */

class AtWordpressSEOIntegrationHelper extends TdComponent {
	/**
	 * If canoncal urls for tours archive page should be fixed.
	 *
	 * @var boolean
	 */
	public $fix_tour_archive_canonical_urls = true;

	/**
	 * If page title for tours archive page should be fixed.
	 *
	 * @var boolean
	 */
	public $fix_tour_archive_page_title = true;

	protected $tours_page_url;

	public function init() {
		if ( ! parent::init() ) {
			return false;
		}

		if( $this->fix_tour_archive_canonical_urls || $this->fix_tour_archive_page_title ) {
			add_action( 'template_redirect', array( &$this, 'on_template_redirect' ) );
		}

		return true;
	}

	public function on_template_redirect() {
		if ( adventure_tours_check( 'is_tour_search' ) ) {
			if ( $this->fix_tour_archive_canonical_urls ) {
				$tours_page_id = adventure_tours_get_option( 'tours_page' );
				$this->tours_page_url = $tours_page_id ? get_permalink( $tours_page_id ) : '';

				if ( $this->tours_page_url ) {
					add_action( 'wpseo_head', array( &$this, 'activate_tour_type_filter' ), 19 );
					add_action( 'wpseo_head', array( &$this, 'deactivate_tour_type_filter' ), 21 );
				}
			}

			if ( $this->fix_tour_archive_page_title ) {
				add_filter( 'wpseo_replacements', array( &$this, 'wpseo_replacements_fix_plular_for_tours_archive' ) );
			}
		}
	}

	public function activate_tour_type_filter() {
		$this->switch_post_type_filter( true );
	}

	public function deactivate_tour_type_filter() {
		$this->switch_post_type_filter( false );
	}

	protected function switch_post_type_filter( $enable ) {
		$callback = array( &$this, 'post_type_filter' );
		$priority = 20;
		if ( $enable ) {
			add_filter( 'post_type_archive_link', $callback, $priority, 2 );
		} else {
			remove_filter( 'post_type_archive_link', $callback, $priority, 2 );
		}
	}

	public function post_type_filter( $url, $post_type ) {
		if ( 'product' == $post_type && $this->tours_page_url ) {
			return $this->tours_page_url;
		}
		return $url;
	}

	public function wpseo_replacements_fix_plular_for_tours_archive( $replacements ){
		if ( isset( $replacements['%%pt_plural%%'] ) ) {
			$tours_page_id = adventure_tours_get_option( 'tours_page' );
			$replacements['%%pt_plural%%'] = $tours_page_id ? get_the_title( $tours_page_id ) : __( 'Tours', 'adventure_tours' );
		}
		return $replacements;
	}
}
