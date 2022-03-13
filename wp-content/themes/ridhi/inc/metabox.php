<?php 
/**
 * Ridhi Metabox for Sidebar Layout
 *
 * @package Ridhi
 *
*/ 

function ridhi_add_sidebar_layout_box(){
    //for post
    add_meta_box( 
        'ridhi_sidebar_layout',
        __( 'Sidebar Layout', 'ridhi' ),
        'ridhi_sidebar_layout_callback', 
        array( 'post', 'page' ),
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ridhi_add_sidebar_layout_box' );

$ridhi_sidebar_layout = array(    
    'default-sidebar'=> array(
    	 'value'     => 'default-sidebar',
    	 'label'     => __( 'Default Sidebar', 'ridhi' ),
    	 'thumbnail' => get_template_directory_uri() . '/images/default-sidebar.png'
   	),
    'no-sidebar'     => array(
    	 'value'     => 'no-sidebar',
    	 'label'     => __( 'Full Width', 'ridhi' ),
    	 'thumbnail' => get_template_directory_uri() . '/images/full-width.png'
   	),
    'left-sidebar' => array(
         'value'     => 'left-sidebar',
    	 'label'     => __( 'Left Sidebar', 'ridhi' ),
    	 'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png'         
    ),
    'right-sidebar' => array(
         'value'     => 'right-sidebar',
    	 'label'     => __( 'Right Sidebar', 'ridhi' ),
    	 'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'         
     )    
);

function ridhi_sidebar_layout_callback(){
    global $post , $ridhi_sidebar_layout;
    wp_nonce_field( basename( __FILE__ ), 'ridhi_nonce' ); ?> 
    <table class="form-table">
        <tr>
            <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'ridhi' ); ?></em></td>
        </tr>
        <tr>
            <td>
                <?php  
                    foreach( $ridhi_sidebar_layout as $field ){  
                        $layout = get_post_meta( $post->ID, '_ridhi_sidebar_layout', true ); ?>
                        <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                            <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="ridhi_sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $layout ); if( empty( $layout ) ){ checked( $field['value'], 'default-sidebar' ); }?>/>
                            <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                                <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" />
                            </label>
                        </div>
                        <?php 
                    } // end foreach 
                ?>
                <div class="clear"></div>
            </td>
        </tr>
    </table> 
<?php 
}

function ridhi_save_sidebar_layout( $post_id ){
    global $ridhi_sidebar_layout;

    // Verify the nonce before proceeding.
    if( !isset( $_POST[ 'ridhi_nonce' ] ) || !wp_verify_nonce( $_POST[ 'ridhi_nonce' ], basename( __FILE__ ) ) )
        return;
    
    // Stop WP from clearing custom fields on autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;

    if( 'page' == $_POST['post_type'] ){  
        if( ! current_user_can( 'edit_page', $post_id ) ) return $post_id;  
    }elseif( ! current_user_can( 'edit_post', $post_id ) ){  
        return $post_id;  
    }

    $layout = isset( $_POST['ridhi_sidebar_layout'] ) ? sanitize_key( $_POST['ridhi_sidebar_layout'] ) : 'default-sidebar';

    if( array_key_exists( $layout, $ridhi_sidebar_layout ) ){
        update_post_meta( $post_id, '_ridhi_sidebar_layout', $layout );
    }else{
        delete_post_meta( $post_id, '_ridhi_sidebar_layout' );
    }
}
add_action( 'save_post', 'ridhi_save_sidebar_layout' );