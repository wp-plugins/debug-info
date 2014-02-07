<script type="text/javascript">
	function showDetails(id) {
		document.getElementById(id).style.display = 'block';
	}
	function hideDetails(id) {
		document.getElementById(id).style.display = 'none';
	}
</script>
<div class="wrap">
	<div class="postbox">
		<h2><?php _e('WordPress Debug Info', 'php_info_translate'); ?></h2>
		<p><?php _e('Below is some information about your current WordPress and server setup. This information may be useful for your technical support, website developers, and plugin or theme developers who need to diagnose problems on your site.', 'php_info_translate'); ?></p>
		<p><?php echo oizuled_version_check(); ?></p>
		<p><?php _e('For more detailed PHP server related information, click the Show Details link below.', 'php_info_translate'); ?></p>
		<a href="#" onclick="showDetails('details'); return false;"><?php _e('Show Details', 'php_info_translate'); ?></a>
		<a href="#" onclick="hideDetails('details'); return false;"><?php _e('Hide Details', 'php_info_translate'); ?></a>
		<span id="details" style="display: none;"><?php echo oizuled_get_php_info(); ?></span>
	</div>
	<div class="postbox">
		<p><?php _e('If this plugin has helped you out at all, please consider making a donation to encourage future updates.<br />Your generosity is appreciated!', 'php_info_translate'); ?></p>
			<a href="#" onclick="window.open('https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H2A9X5BC7P4MN');">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" width="147" height="47">
			</a>
		<p><?php _e('To report any issues with', 'php_info_translate'); ?> <strong><?php _e('this plugin', 'php_info_translate'); ?></strong><?php _e(', please visit the ', 'php_info_translate'); ?><a href="http://wordpress.org/support/plugin/debug-info"><?php _e('support page on WordPress.org', 'php_info_translate'); ?></a>.</p>
		<p><?php _e('For all other WordPress support, please check out the following', 'php_info_translate'); ?> <a href="http://oizuled.com/wordpress-site-setup/"><?php _e('site set-up', 'php_info_translate'); ?></a>, <a href="http://oizuled.com/wordpress-support-24x7-unlimited-fast-fixes/"><?php _e('24x7 support', 'php_info_translate'); ?></a><?php _e(', and other', 'php_info_translate'); ?> <a href="http://oizuled.com/live-wordpress-support-services/"><?php _e('WordPress training', 'php_info_translate'); ?></a> <?php _e('services', 'php_info_translate'); ?>.</p>
		<p><a href="https://twitter.com/oizuled" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @oizuled</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>
	</div>
</div>