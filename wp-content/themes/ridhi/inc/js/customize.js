jQuery(document).ready(function($){
    //Scroll to section
    $('body').on('click', '#sub-accordion-panel-frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        ridhiScrollToSection( section_id );
    });  
    
    /* Home page preview url */
    wp.customize.panel( 'frontpage_settings', function( section ){
        section.expanded.bind( function( isExpanded ) {
            if( isExpanded ){
                wp.customize.previewer.previewUrl.set( ridhi_cdata.home );
            }
        });
    });
});

function ridhiScrollToSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-about_section':
        preview_section_id = "home_about_section";
        break;
        
        case 'accordion-section-service_section':
        preview_section_id = "service_section";
        break;

        case 'accordion-section-client_section':
        preview_section_id = "client_section";
        break;
        
        case 'accordion-section-team_section':
        preview_section_id = "team_section";
        break;

        case 'accordion-section-testimonial_section':
        preview_section_id = "testimonial_section";
        break;
        
        case 'accordion-section-newsletter_section':
        preview_section_id = "newsletter_section";
        break;
        
        case 'accordion-section-blog_section':
        preview_section_id = "blog_section";
        break;

        case 'accordion-section-contact_section':
        preview_section_id = "contact_section";
        break;

        case 'accordion-section-social_section':
        preview_section_id = "social_section";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}

( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['ridhi-pro-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );