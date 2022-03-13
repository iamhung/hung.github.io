<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ridhi
 */
    /**
     * Doctype Hook
     * 
     * @hooked ridhi_doctype
    */
    do_action( 'ridhi_doctype' );
?>
<head itemscope itemtype="https://schema.org/WebSite">
	<?php 
    /**
     * Before wp_head
     * 
     * @hooked ridhi_head
    */
    do_action( 'ridhi_before_wp_head' );
    
    wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

<?php
    wp_body_open();
    
    /**
     * Before Header
     * 
     * @hooked ridhi_page_start - 20 
    */
    do_action( 'ridhi_before_header' );
    
    /**
     * Header
     * 
     * @hooked ridhi_mobile_header - 15
     * @hooked ridhi_header        - 20     
    */
    do_action( 'ridhi_header' );
    
    /**
     * Before Content
     * 
     * @hooked ridhi_top_bar - 20
    */
    do_action( 'ridhi_after_header' );
    
    /**
     * Content
     * 
     * @hooked ridhi_content_start
    */
    do_action( 'ridhi_content' );