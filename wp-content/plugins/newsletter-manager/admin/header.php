<?php if ( ! defined( 'ABSPATH' ) ) exit;?><style type="text/css">
</style>
<div style="clear: both;"></div>
<?php
if(!get_option('xyz_em_hidepmAds'))
{ 
?>
<div id="xyz-wp-newsletter-premium">

	<div style="float: left; padding: 0 5px">
		<h2 style="vertical-align: middle;">
			<a target="_blank"
				href="http://xyzscripts.com/wordpress-plugins/xyz-wp-newsletter/features">Fully
				Featured XYZ WP Newsletter Premium Plugin</a> - Just 29 USD
		</h2>
	</div>
	<div style="float: left; margin-top: 3px">
		<a target="_blank"
			href="http://xyzscripts.com/members/product/purchase/XYZWPNLM"><img 
			src="<?php  echo plugins_url("newsletter-manager/images/orange_buynow.png"); ?>">
		</a>
	</div>
<div style="float: left; padding: 0 5px">
	<h2 style="vertical-align: middle;text-shadow: 1px 1px 1px #686868">
			( <a 	href="<?php echo admin_url('admin.php?page=newsletter-manager-about');?>">Compare Features</a> ) 
	</h2>		
	</div>
</div>
<?php 
}
?>
<style>
	a.xyz_em_link:hover{text-decoration:underline;} 
	.xyz_em_link{text-decoration:none;font-weight: bold} 
</style>

<?php 

if(get_option('xyz_credit_link')=="0" &&(get_option('xyz_em_credit_dismiss')=="0")){
	
	?>
<div style="float:left;background-color: #FFECB3;border-radius:5px;padding: 0px 5px;margin-top: 10px;border: 1px solid #E0AB1B" id="xyz_backlink_div">
	
	Please do a favour by enabling backlink to our site. <a id="xyz_em_backlink"  class="xyz_em_backlink" style="cursor: pointer;" >Okay, Enable</a>.
	 <a id="xyz_em_dismiss" style="cursor: pointer;" >Dismiss</a>.
<script type="text/javascript">
jQuery(document).ready(function() {


	jQuery('#xyz_em_backlink').click(function(){
		xyz_filter_blink(1)
	});

	jQuery('#xyz_em_dismiss').click(function(){
		xyz_filter_blink(-1)
	});
	
	function xyz_filter_blink(stat){
		var backlink_nonce= '<?php echo wp_create_nonce('backlink');?>';
		var dataString = { 
				action: 'ajax_backlink_nlm', 
				enable: stat ,
				_wpnonce: backlink_nonce
			};
	

		jQuery.post(ajaxurl, dataString, function(response) {
			if(response==1)
	        	alert("You do not have sufficient permissions");
			else if(response=="em"){
			jQuery('#xyz_em_backlink').hide();
			jQuery("#xyz_backlink_div").html('Thank you for enabling backlink !');
			jQuery("#xyz_backlink_div").css('background-color', '#D8E8DA');
			jQuery("#xyz_backlink_div").css('border', '1px solid #0F801C');
			}

			else if(response==-1){
				jQuery("#xyz_backlink_div").remove();
		}
		});	
	};
});
</script>
</div>
	<?php 
}
?>

<style>
#text {margin:50px auto; width:500px}
.hotspot {color:#900; padding-bottom:1px; border-bottom:1px dotted #900; cursor:pointer}

#tt {position:absolute; display:block; }
#tttop {display:block; height:5px; margin-left:5px;}
#ttcont {display:block; padding:2px 10px 3px 7px;  margin-left:-400px; background:#666; color:#FFF}
#ttbot {display:block; height:5px; margin-left:5px; }
</style>

<div style="margin-top: 10px">
<table style="float:right; ">
<tr>
<td  style="float:right;">
	<a onmouseover="tooltip.show('Please help us to keep this plugin free forever by donating a dollar');" onmouseout="tooltip.hide();"  class="xyz_em_link" style="margin-left:8px;margin-right:12px;"  target="_blank" href="http://xyzscripts.com/donate/1">Donate</a>
</td>
<td style="float:right;">
	<a class="xyz_em_link" style="margin-left:8px;" target="_blank" href="http://help.xyzscripts.com/docs/newsletter-manager/faq/">FAQ</a> |
</td>
<td style="float:right;">
	<a class="xyz_em_link" style="margin-left:8px;" target="_blank" href="http://help.xyzscripts.com/docs/newsletter-manager/">README</a> |
</td>
<td style="float:right;">
	<a class="xyz_em_link" style="margin-left:8px;" target="_blank" href="http://xyzscripts.com/wordpress-plugins/newsletter-manager/details">About</a> |
</td>
<td style="float:right;">
	<a class="xyz_em_link" target="_blank" href="http://xyzscripts.com">XYZScripts</a> |
</td>

</tr>
</table>
</div>

<div style="clear: both"></div>