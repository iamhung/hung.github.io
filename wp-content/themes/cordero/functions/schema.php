<?php
/**
 * Adds schema tags
 *
 * @package Cordero
 */


/**
 * Adds schema tags to the body
 *
 */
if ( !function_exists( 'cordero_schema_body' ) ) {
	function cordero_schema_body() {

		if ( !get_theme_mod( 'schema_off' ) ) {

			$is_blog = ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() ) ? true : false;

			$itemtype = 'WebPage';

			$itemtype = ( $is_blog ) ? 'Blog' : $itemtype;

			$itemtype = ( is_search() ) ? 'SearchResultsPage' : $itemtype;

			// Make itemtype filterable
			$itemtype = apply_filters( 'cordero_schema_body_itemtype', $itemtype );

			// Output if not WooCommerce as it has it's own schema
			if ( class_exists( 'WooCommerce' ) ) {
				if ( !is_woocommerce() ) {
					echo ' itemtype="https://schema.org/' . esc_attr( $itemtype ) . '" itemscope="itemscope"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			} else {
				echo ' itemtype="https://schema.org/' . esc_attr( $itemtype ) . '" itemscope="itemscope"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

		}

	}
}


/**
 * Adds schema itemtypes
 *
 */
if ( !function_exists( 'cordero_schema_item' ) ) {
	function cordero_schema_item( $type = '', $echo = 'true' ) {

		if ( !get_theme_mod( 'schema_off' ) ) {

			$itemtype = '';
			$itemid = '';
			$itemprop = '';

			if ( $type === 'masthead' ) {
				$itemtype = 'WPHeader';
				$itemid = ' itemid="#masthead"';
			} elseif ( $type === 'org' ) {
				$itemtype = 'Organization';
			} elseif ( $type === 'nav' ) {
				$itemtype = 'SiteNavigationElement';
			} elseif ( $type === 'article' ) {
				$itemtype = 'CreativeWork';
			} elseif ( $type === 'author' ) {
				$itemtype = 'Person';
				$itemprop = ' itemprop="author"';
			} elseif ( $type === 'sidebar' ) {
				$itemtype = 'WPSideBar';
			} elseif ( $type === 'footer' ) {
				$itemtype = 'WPFooter';
				$itemid = ' itemid="#colophon"';
			}

			if ( $itemtype !== '' ) {
				$result = ' itemtype="https://schema.org/' . $itemtype . '" itemscope="itemscope"' . $itemprop . $itemid; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} else {
				$result = '';
			}

			if ( $echo === 'false' ) {
				return $result;
			} else {
				echo $result;
			}

		} else {
			return NULL;
		}

	}
}


/**
 * Adds schema itemprops
 *
 */
if ( !function_exists( 'cordero_schema_prop' ) ) {
	function cordero_schema_prop( $prop = '', $echo = 'true' ) {

		if ( !get_theme_mod( 'schema_off' ) ) {

			$itemprop = '';

			if ( $prop === 'name' ) {
				$itemprop = 'name';
			} elseif ( $prop === 'url' ) {
				$itemprop = 'url';
			} elseif ( $prop === 'desc' ) {
				$itemprop = 'description';
			} elseif ( $prop === 'headline' ) {
				$itemprop = 'headline';
			} elseif ( $prop === 'text' ) {
				$itemprop = 'text';
			} elseif ( $prop === 'image' ) {
				$itemprop = 'image';
			} elseif ( $prop === 'wp-thumb' ) {
				$itemprop = 'wp-thumb';
			} elseif ( $prop === 'time-publish' ) {
				$itemprop = 'datePublished';
			} elseif ( $prop === 'time-update' ) {
				$itemprop = 'dateModified';
			}

			if ( $itemprop !== '' ) {
				if ( $itemprop === 'wp-thumb' ) {
					$result = ' itemprop=image'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} else {
					$result = ' itemprop="' . $itemprop . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			} else {
				$result = '';
			}

			if ( $echo === 'false' ) {
				return $result;
			} else {
				echo $result;
			}

		} else {
			return NULL;
		}

	}
}
