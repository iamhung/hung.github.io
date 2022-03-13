<?php
/**
 *
 * Adds custom Block Styles to the post/page editor.
 *
 * @link https://developer.wordpress.org/block-editor/developers/filters/block-filters/
 *
 * @package Cordero
 */


register_block_style(
	'core/group',
	array(
		'name'			=> 'translucent',
		'label'			=> __( 'Translucent', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/group',
	array(
		'name'			=> 'box-shadow',
		'label'			=> __( 'Box Shadow', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/group',
	array(
		'name'			=> 'quote',
		'label'			=> __( 'Quote', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/group',
	array(
		'name'			=> 'point-down',
		'label'			=> __( 'Point - down', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);
register_block_style(
	'core/group',
	array(
		'name'			=> 'point-up',
		'label'			=> __( 'Point - up', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);


register_block_style(
	'core/heading',
	array(
		'name'			=> 'box-shadow',
		'label'			=> __( 'Box Shadow', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/heading',
	array(
		'name'			=> 'with-separator',
		'label'			=> __( 'With Separator (style 1)', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/heading',
	array(
		'name'			=> 'with-separator-2',
		'label'			=> __( 'With Separator (style 2)', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/heading',
	array(
		'name'			=> 'zero-margin',
		'label'			=> __( 'Without Bottom Margin', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/heading',
	array(
		'name'			=> 'content-width',
		'label'			=> __( 'Content Width', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/heading',
	array(
		'name'			=> 'rc-10',
		'label'			=> __( 'Rounded Corners', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);


register_block_style(
	'core/paragraph',
	array(
		'name'			=> 'box-shadow',
		'label'			=> __( 'Box Shadow', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/paragraph',
	array(
		'name'			=> 'with-separator',
		'label'			=> __( 'With Separator (style 1)', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/paragraph',
	array(
		'name'			=> 'with-separator-2',
		'label'			=> __( 'With Separator (style 2)', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/paragraph',
	array(
		'name'			=> 'zero-margin',
		'label'			=> __( 'Without Bottom Margin', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/paragraph',
	array(
		'name'			=> 'content-width',
		'label'			=> __( 'Content Width', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/paragraph',
	array(
		'name'			=> 'rc-10',
		'label'			=> __( 'Rounded Corners', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);


register_block_style(
	'core/image',
	array(
		'name'			=> 'chevron-left',
		'label'			=> __( 'Chevron - left', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/image',
	array(
		'name'			=> 'chevron-right',
		'label'			=> __( 'Chevron - right', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/image',
	array(
		'name'			=> 'point-down',
		'label'			=> __( 'Point - down', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/image',
	array(
		'name'			=> 'point-up',
		'label'			=> __( 'Point - up', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/image',
	array(
		'name'			=> 'box-shadow',
		'label'			=> __( 'Box Shadow', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);


register_block_style(
	'core/columns',
	array(
		'name'			=> 'no-spacing',
		'label'			=> __( 'No Spacing', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/columns',
	array(
		'name'			=> 'not-stacked-on-mobile',
		'label'			=> __( 'Not Stacked on Mobile', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/columns',
	array(
		'name'			=> 'no-spacing-not-stacked-on-mobile',
		'label'			=> __( 'No Spacing + Not Stacked on Mobile', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/gallery',
	array(
		'name'			=> 'no-spacing',
		'label'			=> __( 'No Spacing', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/gallery',
	array(
		'name'			=> 'box-shadow',
		'label'			=> __( 'Box Shadow', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/gallery',
	array(
		'name'			=> 'bordered',
		'label'			=> __( 'Bordered', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/gallery',
	array(
		'name'			=> 'framed',
		'label'			=> __( 'Framed', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/gallery',
	array(
		'name'			=> 'inset-frame',
		'label'			=> __( 'Inset Frame', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);


register_block_style(
	'core/cover',
	array(
		'name'			=> 'no-padding',
		'label'			=> __( 'No Padding', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/cover',
	array(
		'name'			=> 'point-down',
		'label'			=> __( 'Point - down', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/cover',
	array(
		'name'			=> 'point-up',
		'label'			=> __( 'Point - up', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/cover',
	array(
		'name'			=> 'inset-frame',
		'label'			=> __( 'Inset Frame', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);


register_block_style(
	'core/column',
	array(
		'name'			=> 'offset',
		'label'			=> __( 'Offset', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/column',
	array(
		'name'			=> 'box-shadow',
		'label'			=> __( 'Box Shadow', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/column',
	array(
		'name'			=> 'offset-box-shadow',
		'label'			=> __( 'Offset and Box Shadow', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);


register_block_style(
	'core/separator',
	array(
		'name'			=> 'extra-small',
		'label'			=> __( 'Extra Small', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/separator',
	array(
		'name'			=> 'small',
		'label'			=> __( 'Small', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/separator',
	array(
		'name'			=> 'medium',
		'label'			=> __( 'Medium', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/separator',
	array(
		'name'			=> 'large',
		'label'			=> __( 'Large', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/separator',
	array(
		'name'			=> 'extra-large',
		'label'			=> __( 'Extra Large', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/separator',
	array(
		'name'			=> 'huge',
		'label'			=> __( 'Huge', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);


register_block_style(
	'core/media-text',
	array(
		'name'			=> 'inset-frame',
		'label'			=> __( 'Inset Frame', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/media-text',
	array(
		'name'			=> 'angled-divider',
		'label'			=> __( 'Angled Divider', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);

register_block_style(
	'core/media-text',
	array(
		'name'			=> 'media-text-overlap',
		'label'			=> __( 'Overlapping Content (requires image fill)', 'cordero' ),
		'style_handle'	=> 'cordero-style',
	)
);
