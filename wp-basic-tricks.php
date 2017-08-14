<?php/** * Plugin Name: WP Basic Tricks  * Plugin URI: http://www.tricksofit.com/2014/09/some-useful-basic-tricks-of-wordpress * Description: Some Basic tricks to manage admin bar and revisions. * Version: 1.3.1 * Author: Tricks Of IT * Author URI: http://www.tricksofit.com/ */$domain = "wpbasictricks";add_action( 'init', 'toi_wpbt_init' );if ( is_admin() ){	add_action( 'admin_menu', 'toi_wpbt_add_settings_menu');	add_filter( 'plugin_action_links', 'toi_wpbt_add_settings_link', 20, 2 );}function toi_wpbt_add_settings_menu() {	add_options_page( __( 'WP Basic Tricks Settings', $domain ), __( 'WP Basic Tricks', $domain ), 'manage_options', 'wp-basic-tricks', 'toi_wpbt_settings_page' );}function toi_wpbt_add_settings_link( $links, $file ) {	if ( plugin_basename( __FILE__ ) == $file ) {		$settings_link = '<a href="' . add_query_arg( array( 'page' => 'wp-basic-tricks' ), admin_url( 'options-general.php' ) ) . '">' . __( 'Settings', $domain ) . '</a>';		array_unshift( $links, $settings_link );	}	return $links;}function toi_wpbt_settings_page() {	if (!current_user_can('manage_options'))  {		wp_die('You do not have sufficient permissions to access this page.');	}		if (!empty($_POST) && isset($_POST['wpbasictricks_settings']) && check_admin_referer('wpbt_update_settings','wpbt_nonce_field'))	{		$wpbt_options = $_POST['wpbasictricks_settings'];		update_option("wpbasictricks_settings", $wpbt_options);				echo '<div class="updated"><p><strong>'.__('Settings saved successfully.', $domain).'</strong></p></div>';	}		$wpbt_options = get_option("wpbasictricks_settings", null);?>	<div class="wrap">		<?php if ( function_exists('screen_icon') ) screen_icon(); ?>		<h2><?php _e( 'WP Basic Tricks Settings', $domain ); ?></h2>				<form method="post" action="">			<?php if (function_exists('wp_nonce_field') === true) wp_nonce_field('wpbt_update_settings','wpbt_nonce_field'); ?>						<table class="form-table"><tbody>				<tr valign="top">					<th scope="row"><?php _e( 'Hide admin bar from front', $domain ); ?></th>					<td>						<fieldset>							<legend class="hidden"><?php _e( 'Hide Admin Bar', $domain ); ?></legend>							<label for="wpbasictricks-hideadminbarfromall"><input name="wpbasictricks_settings[hideadminbarfromall]" type="checkbox" id="wpbasictricks-hideadminbarfromall" value="1" <?php echo isset($wpbt_options['hideadminbarfromall'])?'checked':'' ?> /> <?php _e( 'Hide admin bar from front screen to better display your theme for logged-in users', $domain ); ?></label>						</fieldset>					</td>				</tr>								<tr valign="top">					<th scope="row"><?php _e( 'Show admin bar in front for admin', $domain ); ?></th>					<td>						<fieldset>							<legend class="hidden"><?php _e( 'Show Admin Bar', $domain ); ?></legend>							<label for="wpbasictricks-showadminbarforadmin"><input name="wpbasictricks_settings[showadminbarforadmin]" type="checkbox" id="wpbasictricks-showadminbarforadmin" value="1" <?php echo isset($wpbt_options['showadminbarforadmin'])?'checked':'' ?> /> <?php _e( 'Show admin bar in front screen for admin, this will work if above option is checked.', $domain ); ?></label>						</fieldset>					</td>				</tr>								<tr valign="top">					<th scope="row"><?php _e( 'Remove the WordPress Generator Meta Tag', $domain ); ?></th>					<td>						<fieldset>							<legend class="hidden"><?php _e( 'Remove generator meta', $domain ); ?></legend>							<label for="wpbasictricks-removegeneratormeta"><input name="wpbasictricks_settings[removegeneratormeta]" type="checkbox" id="wpbasictricks-removegeneratormeta" value="1" <?php echo isset($wpbt_options['removegeneratormeta'])?'checked':'' ?> /> <?php _e( 'WordPress puts a meta tag indicating site generated by wordpress with version of CMS. To remove this meta tag check this checkbox.', $domain ); ?></label>						</fieldset>					</td>				</tr>												<tr valign="top">					<th scope="row"><?php _e( 'Change AutoSave Interval', $domain ); ?></th>					<td>						<fieldset>							<legend class="hidden"><?php _e( 'Change AutoSave Interval', $domain ); ?></legend>							<label for="wpbasictricks-autosaveinterval"><input name="wpbasictricks_settings[autosaveinterval]" type="text" id="wpbasictricks-autosaveinterval" value="<?php echo isset($wpbt_options['autosaveinterval'])?$wpbt_options['autosaveinterval']:'60' ?>" /> <?php _e( 'To change post autosave interval. default intervel is 60 seconds.', $domain ); ?></label>						</fieldset>					</td>				</tr>								<tr valign="top">					<th scope="row"><?php _e( 'Disable AutoSave', $domain ); ?></th>					<td>						<fieldset>							<legend class="hidden"><?php _e( 'Disable AutoSave', $domain ); ?></legend>							<label for="wpbasictricks-disableautosave"><input name="wpbasictricks_settings[disableautosave]" type="checkbox" id="wpbasictricks-disableautosave" value="1" <?php echo isset($wpbt_options['disableautosave'])?'checked':'' ?> /> <?php _e( 'To disable post autosave feature.', $domain ); ?></label>						</fieldset>					</td>				</tr>								<tr valign="top">					<th scope="row"><?php _e( 'Limit Post Revision', $domain ); ?></th>					<td>						<fieldset>							<legend class="hidden"><?php _e( 'Limit Post Revision', $domain ); ?></legend>							<label for="wpbasictricks-limitpostrevision"><input name="wpbasictricks_settings[limitpostrevision]" type="text" id="wpbasictricks-limitpostrevision" value="<?php echo isset($wpbt_options['limitpostrevision'])?$wpbt_options['limitpostrevision']:'' ?>"  /> <?php _e( 'To limit post revision enter any number you like. Put 0 to disable this feature.', $domain ); ?></label>						</fieldset>					</td>				</tr>								<tr valign="top">					<th scope="row"><?php _e( 'Featured Image in RSS', $domain ); ?></th>					<td>						<fieldset>							<legend class="hidden"><?php _e( 'Featured Image in RSS', $domain ); ?></legend>							<label for="wpbasictricks-featuredimagerss"><input name="wpbasictricks_settings[featuredimagerss]" type="checkbox" id="wpbasictricks-featuredimagerss" value="1" <?php echo isset($wpbt_options['featuredimagerss'])?'checked':'' ?> /> <?php _e( 'To include featured image in RSS feeds.', $domain ); ?></label>						</fieldset>					</td>				</tr>												</tbody>			</table>			<p class="submit">			  <input type="hidden" name="action" value="wpbt_update_settings"/>			  <input type="submit" name="wpbt_update_settings" class="button-primary" value="<?php _e('Save Changes', $domain); ?>"/>			</p>						</form>				<?php 			$wpbt_wpconfig_txt = "";			if(!empty($wpbt_options)){								if(isset($wpbt_options['autosaveinterval']) && $wpbt_options['autosaveinterval']){					if(isset($wpbt_options['disableautosave']) && $wpbt_options['disableautosave']){					} else{						$wpbt_wpconfig_txt .= "define( 'AUTOSAVE_INTERVAL', ".$wpbt_options['autosaveinterval']." );<br/>";					}				}								if(isset($wpbt_options['limitpostrevision']) && $wpbt_options['limitpostrevision'] ){					if($wpbt_options['limitpostrevision'] > 0){						$wpbt_wpconfig_txt .= "define( 'WP_POST_REVISIONS', ".$wpbt_options['limitpostrevision']." );<br/>";					} else if($wpbt_options['limitpostrevision'] == 0){						$wpbt_wpconfig_txt .= "define( 'WP_POST_REVISIONS', false );<br/>";					}									}			}						if(!empty($wpbt_wpconfig_txt)){				?>				<p>Please put following lines to <strong>wp-config.php</strong> just before "That's all, stop editing! Happy blogging" </p>								<div style="border:1px solid #ccc;color:#333; padding:10px 20px;">					<?php echo $wpbt_wpconfig_txt ?>				</div>				<?php			}					?>					</div>		<?php}function toi_wpbt_init(){	$wpbt_options = get_option("wpbasictricks_settings", null);		if(!empty($wpbt_options)){		if(isset($wpbt_options['hideadminbarfromall']) && $wpbt_options['hideadminbarfromall']){			if(isset($wpbt_options['showadminbarforadmin']) && $wpbt_options['showadminbarforadmin'] && current_user_can('manage_options')){			} else{				add_filter('show_admin_bar', '__return_false');			}		}				if(isset($wpbt_options['removegeneratormeta']) && $wpbt_options['removegeneratormeta']){			remove_action('wp_head', 'wp_generator');		}				if(isset($wpbt_options['disableautosave']) && $wpbt_options['disableautosave']){			wp_deregister_script( 'autosave' );		}				if(isset($wpbt_options['featuredimagerss']) && $wpbt_options['featuredimagerss']){			add_filter ('the_content_feed', 'toi_rss_post_thumbnail');			add_filter ('the_excerpt_rss', 'toi_rss_post_thumbnail');					}			}}function toi_rss_post_thumbnail($content) {	global $post;	if (has_post_thumbnail ($post->ID))		$content = '<p>'. get_the_post_thumbnail ($post->ID, 'post-thumbnail'). '</p>'. $content;	return $content;}