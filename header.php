<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php do_action( 'fl_head_open' ); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php echo apply_filters( 'fl_theme_viewport', "<meta name='viewport' content='width=device-width, initial-scale=1.0' />\n" ); ?>
<?php echo apply_filters( 'fl_theme_xua_compatible', "<meta http-equiv='X-UA-Compatible' content='IE=edge' />\n" ); ?>
<link rel="profile" href="https://gmpg.org/xfn/11" />
<?php

wp_head();

FLTheme::head();

/***Find out if the post has a custom template***/
// Set the default template status to false
$has_template = false;

// Check the post to see if it has a custom header template id
$saved_custom_templates = get_post_meta($post->ID, 'gsr-soul-theme-custom-post-templates', true);

// If it does have a custom header template id
if(isset($saved_custom_templates['_header']) && 'null' !== $saved_custom_templates['_header']){

    // Confirm that the id belongs to an existing template that is generated by BB
    $template = get_posts(array('numberposts' => 1, 'post_type' => 'fl-builder-template', 'p' => intval($saved_custom_templates['_header']) ));
    if(!empty($template)){
        // If it's good, say that we have a custom template
        $has_template = true;
    }
}

?>
</head>
<body <?php body_class(); ?><?php FLTheme::print_schema( ' itemscope="itemscope" itemtype="https://schema.org/WebPage"' ); ?>>
<?php

FLTheme::header_code();

do_action( 'fl_body_open' );

?>
<div class="fl-page">
	<?php

	do_action( 'fl_page_open' );

    FLTheme::fixed_header();

    do_action( 'fl_before_top_bar' );

    FLTheme::top_bar();

    do_action( 'fl_after_top_bar' );

    if($has_template){
        // Query and render the custom template
        FLBuilder::render_query( array(
            'post_type' => 'fl-builder-template',
            'p'         => $template[0]->ID
        ) );
    }

    do_action( 'fl_before_header' );

    FLTheme::header_layout();

	do_action( 'fl_after_header' );
	do_action( 'fl_before_content' );

	?>
	<div class="fl-page-content" itemprop="mainContentOfPage">

		<?php do_action( 'fl_content_open' ); ?>
