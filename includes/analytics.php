<?php
	if ( !defined('ABSPATH') ){ //Redirect (for logging) if accessed directly
		header('Location: http://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], "wp-content/")) . '?ndaat=' . basename($_SERVER['PHP_SELF']));
		die('Error 403: Forbidden.');
	}
?>

<?php if ( !empty($GLOBALS['ga']) ): //Universal Google Analytics ?>
	<script>
		<?php //@TODO "Analytics" 5: Admin > View Settings - Turn on Site Search Tracking and enter "s,rs" in the Query Parameter input field! ?>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/<?php echo ( is_debug() )? 'analytics_debug.js' : 'analytics.js'; ?>','ga');

		ga('create', '<?php echo $GLOBALS['ga']; ?>', 'auto'); <?php //Change Tracking ID in Nebula Options or functions.php! ?>
		<?php if ( nebula_adwords_enabled() ): //Enable AdWords integration in Nebula Options, or delete this conditional. ?>
			ga('require', 'displayfeatures');
		<?php endif; ?>
		ga('send', 'pageview');
	</script>
<?php else: ?>
	<?php if ( is_dev() ): ?>
		<script>console.error('WARNING: No Google Analytics tracking ID!');</script>
	<?php endif; ?>
<?php endif; ?>

<?php if ( !nebula_options_conditional('nebula_facebook_custom_audience_pixel', 'disabled') ): //Facebook Custom Audience Pixel ?>
	<?php if ( get_option('nebula_facebook_custom_audience_pixel_id') != '' ): ?>
		<script>
			!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
			n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
			document,'script','//connect.facebook.net/en_US/fbevents.js');

			fbq('init', '<?php echo get_option('nebula_facebook_custom_audience_pixel_id'); ?>');
			fbq('track', 'PageView');
		</script>
		<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo get_option('nebula_facebook_custom_audience_pixel_id'); ?>&ev=PageView&noscript=1"/></noscript>
	<?php else: ?>
		<?php if ( is_dev() ): ?>
			<script>console.warn('Facebook Custom Audience Pixel is enabled, but the pixel ID is empty!');</script>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>