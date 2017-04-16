<?php
/**
 * Plugin Name: Canonical Seo Wordpress Plugin
 * Plugin URI: www.shoutmeloud.com/
 * Description: Canonical Plugin for SEO.
 * Version: 1.1
 * Author: Harsh Agrawal
 * Author URI: www.shoutmeloud.com/
 * License: GPL2
 */

add_action( 'wp_head', 'Seo_plugin_canonical_tag' );

// Creates the canonical tag
function Seo_plugin_canonical_tag() {
	if(is_front_page()){
	$canonical_url ="\t";
        $canonical_url .= '<link rel="canonical" href="' . trailingslashit( home_url() ) . '"/>';
        $canonical_url .= "\n\n";        
        echo apply_filters('Seo_plugin_canonical_tag', $canonical_url);
	}
    if ( is_singular() ) {
	global $post;
	$Seo_plugin_meta_canonical = get_post_meta($post->ID, '_Seo_plugin_meta_canonical_tag', true);//get the key id _Seo_plugin_meta_canonical_tag
	if( $Seo_plugin_meta_canonical){
	//calls the custom meta text
		$canonical_url ="\t";
        $canonical_url .= '<link rel="canonical" href="' . $Seo_plugin_meta_canonical . '"/>';
        $canonical_url .= "\n\n";        
        echo apply_filters('Seo_plugin_canonical_tag', $canonical_url);
	}
	
	else{
        $canonical_url ="\t";
        $canonical_url .= '<link rel="canonical" href="' . get_permalink() . '"/>';
        $canonical_url .= "\n\n";        
        echo apply_filters('Seo_plugin_canonical_tag', $canonical_url);
		}
    }

}

//call the filters

//Here to add metaboxes under post and page
// Create your custom meta box
add_action( 'add_meta_boxes', 'Seo_plugin_add_custom_canonical_url' );
// Save your meta box content

add_action( 'save_post', 'Seo_plugin_save_custom_canonical_tag_box' );
// Add a custom meta box to a post

function Seo_plugin_add_custom_canonical_url( $post ) {
	  add_meta_box(
	  'Meta Box', // ID, should be a string
	  'Seo_plugin Canonical Settings', // Meta Box Title
	  'Seo_plugin_custom_meta_box_content_canonical_url', // Your call back function, this is where your form field will go
	  'page', // The post type you want this to show up on, can be post, page, or custom post type
	  'normal', // The placement of your meta box, can be normal or side
	  'high' // The priority in which this will be displayed
	  );

	  add_meta_box(
	  'Meta Box', // ID, should be a string
	  'Seo_plugin Canonical Settings', // Meta Box Title
	  'Seo_plugin_custom_meta_box_content_canonical_url', // Your call back function, this is where your form field will go
	  'post', // The post type you want this to show up on, can be post, page, or custom post type
	  'normal', // The placement of your meta box, can be normal or side
	  'high' // The priority in which this will be displayed
	  );


}


//Custom Document Title Meta Box
// save newsletter content
function Seo_plugin_save_custom_canonical_tag_box(){
global $post;
// Get our form field
if( $_POST ) :

$Seo_plugin_meta_canonical = esc_attr( $_POST['Seo_plugin-meta-canonical-url'] );
// Update post meta canonical url
update_post_meta($post->ID, '_Seo_plugin_meta_canonical_tag', $Seo_plugin_meta_canonical);


endif;
}

// Content for the custom meta box
function Seo_plugin_custom_meta_box_content_canonical_url( $post ) {?>
<script type="text/javascript">
//Count the characters in meta title and meta description
$(document).ready(function(){
    var totalChars      = 150; //Total characters allowed in textarea
    var countTextBox    = $('#counttextarea') // Textarea input box
    var charsCountEl    = $('#countchars'); // Remaining chars count will be displayed here
	
	var totalChars1      = 70; //Total characters allowed in textarea
    var countTextBox1   = $('#counttextarea1') // Textarea input box
    var charsCountEl1    = $('#countchars1'); // Remaining chars count will be displayed here
    
    charsCountEl.text(totalChars); //initial value of countchars element
    countTextBox.keyup(function() { //user releases a key on the keyboard
        var thisChars = this.value.replace(/{.*}/g, '').length; //get chars count in textarea
        if(thisChars > totalChars) //if we have more chars than it should be
        {
            var CharsToDel = (thisChars-totalChars); // total extra chars to delete
            this.value = this.value.substring(0,this.value.length-CharsToDel); //remove excess chars from textarea
        }else{
            charsCountEl.text( totalChars - thisChars ); //count remaining chars
        }
    });
	
	charsCountEl1.text(totalChars1); //initial value of countchars element
    countTextBox1.keyup(function() { //user releases a key on the keyboard
        var thisChars = this.value.replace(/{.*}/g, '').length; //get chars count in textarea
        if(thisChars > totalChars1) //if we have more chars than it should be
        {
            var CharsToDel = (thisChars-totalChars1); // total extra chars to delete
            this.value = this.value.substring(0,this.value.length-CharsToDel); //remove excess chars from textarea
        }else{
            charsCountEl1.text( totalChars1 - thisChars ); //count remaining chars
        }
    });
});
</script>
<?php

	  // Get post Custom Canonical Url
	  $Seo_plugin_meta_canonical = get_post_meta($post->ID, '_Seo_plugin_meta_canonical_tag', true);
	  echo '<p><label>Custom Canonical Url:</label></p>';
	  echo '<p><input style="width:99%;" class="meta-text" type="text" name="Seo_plugin-meta-canonical-url" value="'.$Seo_plugin_meta_canonical.'" /></p>';


?>
<?php
}