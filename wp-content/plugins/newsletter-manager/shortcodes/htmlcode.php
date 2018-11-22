<?php 
global $wpdb;
?>
<script>
function xyz_em_verify_fields()
{
var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,})$/;
var address = document.subscription.xyz_em_email.value;
if(reg.test(address) == false) {
	alert("<?php _e( 'Please check whether the email is correct.', 'newsletter-manager' ); ?>");
return false;
}else{
//document.subscription.submit();
return true;
}
}


function xyz_unsubscribe_tckbox(){
//tb_show("Unsubscribe Your Email","#TB_inline?width=50%&amp;height=20%&amp;inlineId=show_nlm_email_unsubscribe&class=thickbox");
	document.getElementById("show_nlm_email_unsubscribe").style.display = "block";
	document.getElementById("outer_div").style.display = "block";
	
}
function xyz_em_email_unsubscribe(){


	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,})$/;
	var address = document.unsubscribe_form.xyz_nlm_email_unsubscribe.value;
	if(reg.test(address) == false)
	{
		alert("<?php _e( 'Please check whether the email is correct.', 'newsletter-manager' ); ?>");
		document.unsubscribe_form.xyz_nlm_email_unsubscribe.focus();
		return false;
	}
	else
	{
		return true;
	}
}
function xyz_nlm_close_thickbox()
{
	document.getElementById("show_nlm_email_unsubscribe").style.display = "none";
	document.getElementById("outer_div").style.display = "none";
	

	}
</script>
<style>
#tdTop{
	border-top:none;
}
</style>
<form method="POST" name="subscription" action="<?php echo get_site_url()."/index.php?wp_nlm=subscribe";?>">
<?php wp_nonce_field( 'xyz_em_subscription' );?>

<table border="0">
<tr>
<td id="tdTop"  colspan="2">
<span style="font-size:14px;"><b><?php echo esc_html(get_option('xyz_em_widgetName'))?></b></span>
</td>
</tr>
<tr >
<td id="tdTop" width="200px"><?php _e( 'Name', 'newsletter-manager' ); ?></td>
<td id="tdTop" >
<input  name="xyz_em_name" type="text" />
</td>
</tr>
<tr >
<td id="tdTop" ><?php _e( 'Email Address', 'newsletter-manager' ); ?></td>
<td id="tdTop">
<input  name="xyz_em_email" type="text" /><span style="color:#FF0000">*</span>
</td>
</tr>
	<?php if(get_option('xyz_em_captcha')=="1")
	{ 
	    $publickey = get_option('xyz_em_recaptcha_public_key');

	   ?>
	   <tr >
<td id="tdTop" ></td>
<td id="tdTop">

<?php 

if($publickey != ''){
    $url = '//www.google.com/recaptcha/api.js';
    ?>
   <div class="g-recaptcha"  data-sitekey="<?php  echo $publickey;?> "  >
  </div><span style="color:red;">*</span><script type="text/javascript" src="<?php  echo $url ;?> "></script>
    
 <div style="font-weight: normal;color:red;" ></div>
 <?php 
}else
{
    ?>
    <span style="color:red;"><?php _e( 'Set reCaptcha Site key & Secret key', 'newsletter-manager' ); ?></span>
    <?php 
}
	?></td>
</tr>
	<?php 
	
	}
	
?>

	    
<tr>
<td></td>
<td id="tdTop">
<div style="height:40px;"><input name="htmlSubmit"  id="submit_em" class="button-primary" type="submit" value="<?php _e( 'Subscribe', 'newsletter-manager' ); ?>" onclick="javascript: if(!xyz_em_verify_fields()) return false; "  /></div>
</td>
</tr>
<tr>
<td id="tdTop" id="tdTop">
</td>
<td id="tdTop" id="tdTop">
<a  onclick=xyz_unsubscribe_tckbox();><?php _e( 'Unsubscribe Your Email', 'newsletter-manager' ); ?></a>

</td>
<td id="tdTop" id="tdTop"></td>
</tr>
</table>
</form>
<div id="outer_div" style="display:none;" >
</div>
<div id="show_nlm_email_unsubscribe"  class="xyz_nlm_thickbox" style="display:none;">
<form method="POST" name="unsubscribe_form" >
<?php wp_nonce_field('email_unsubscribe' );?>

<table>
<tr>
<td>
<b><?php _e( 'Unsubscribe Your Email', 'newsletter-manager' ); ?></b>

</td>
<td>
</td>
<td >
<img src="<?php echo plugins_url("newsletter-manager/images/close.png");?>" style="
    height: 20%;cursor: pointer; text-align: right;" onclick="xyz_nlm_close_thickbox()">
							

</td>
</tr>
<tr >
	<td id="tdTop" ><?php _e( 'Email Address', 'newsletter-manager' ); ?></td>
	<td id="tdTop">
	<input style="width: 100% !important;"  name="xyz_nlm_email_unsubscribe" id="xyz_nlm_email_unsubscribe"  type="text" />&nbsp;<span style="color:red;">*</span>
	</td>
</tr>
<tr>
<td id="tdTop" ></td>
<td id="tdTop" >
<input type="submit" name="unsubscribe_sub" id="unsubscribe_sub" value="<?php _e( 'Submit', 'newsletter-manager' ); ?>" onclick="javascript: if(!xyz_em_email_unsubscribe()) return false; " ></td>

</tr>

<tr >
<td colspan="2" id="tdTop"><?php _e( 'We shall send a confirmation email to the address provided,Please follow the link in the email.', 'newsletter-manager' ); ?></td></tr>


</table>
</form>
</div>
<?php 
if(isset($_POST['unsubscribe_sub']))
{
    if (
        ! isset( $_REQUEST['_wpnonce'] )
        || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'email_unsubscribe')
        ) {
            
            wp_nonce_ays( 'email_unsubscribe');
            
            exit();
            
        }
    
    $unsubscribe_email=$_POST['xyz_nlm_email_unsubscribe'];
    $xyz_em_email_count = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_em_email_address WHERE  email =%s',$unsubscribe_email )) ;
   
    
    
    if(count($xyz_em_email_count)!= 0){
        
        $xyz_em_emailTempalteDetails = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'xyz_em_email_template WHERE id=4') ;
        $xyz_em_emailTempalteDetails = $xyz_em_emailTempalteDetails[0];
        $xyz_em_emailTempalteMessage = $xyz_em_emailTempalteDetails->message;
        
        $xyz_em_fieldInfoDetails = $wpdb->get_results( 'SELECT default_value FROM '.$wpdb->prefix.'xyz_em_additional_field_info WHERE field_name="Name"' ) ;
        $xyz_em_fieldInfoDetails = $xyz_em_fieldInfoDetails[0];
        
        $xyz_em_fieldValueDetails = $wpdb->get_results( $wpdb->prepare( "SELECT field1 FROM ".$wpdb->prefix."xyz_em_additional_field_value WHERE ea_id= %d",$xyz_em_email_count->id) ) ;
        $xyz_em_fieldValueDetails = $xyz_em_fieldValueDetails[0];
        
        if($xyz_em_fieldValueDetails->field1 != ""){
            
            $xyz_em_emailTempalteMessage =  str_replace("{field1}",$xyz_em_fieldValueDetails->field1,$xyz_em_emailTempalteMessage);
            $xyz_em_subject = str_replace("{field1}",$xyz_em_fieldValueDetails->field1,$xyz_em_emailTempalteDetails->subject);
            
        }else{
            $xyz_em_emailTempalteMessage =  str_replace("{field1}",$xyz_em_fieldInfoDetails->default_value,$xyz_em_emailTempalteMessage);
            $xyz_em_subject = str_replace("{field1}",$xyz_em_fieldValueDetails->default_value,$xyz_em_emailTempalteDetails->subject);
        }
        
        $xyz_em_conf_unsub_link = '{update_sub_status_url}';
        
      $xyz_em_senderName = get_option('xyz_em_pm_dsn');
      require_once ABSPATH . WPINC . '/class-phpmailer.php';
      $phpmailer = new PHPMailer();
      $phpmailer->CharSet=get_option('blog_charset');
      if(get_option('xyz_em_pm_sendViaSmtp') == 1){
        
        $xyz_em_SmtpDetails = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'xyz_em_sender_email_address WHERE  set_default ="1"' ) ;
        $xyz_em_SmtpDetails = $xyz_em_SmtpDetails[0];
        
        $phpmailer->IsSMTP();
        $phpmailer->Host = $xyz_em_SmtpDetails->host;
        $phpmailer->SMTPDebug = get_option('xyz_em_pm_SmtpDebug');
        if($xyz_em_SmtpDetails->authentication=='true')
            $phpmailer->SMTPAuth = TRUE;
            
            $phpmailer->SMTPSecure = $xyz_em_SmtpDetails->security;
            $phpmailer->Port = $xyz_em_SmtpDetails->port;
            
            $phpmailer->Username = $xyz_em_SmtpDetails->user;
            $phpmailer->Password = $xyz_em_SmtpDetails->password;
            
            if(is_email(get_option('xyz_em_pm_dse'))){
                $phpmailer->From     = get_option('xyz_em_pm_dse');
            }else{
                $phpmailer->From     = $xyz_em_SmtpDetails->user;
            }
            $phpmailer->FromName = $xyz_em_senderName;
            
            $phpmailer->AddReplyTo($xyz_em_SmtpDetails->user,$xyz_em_senderName);
            
    }else{
        
        $phpmailer->IsMail();
        
        $xyz_em_senderEmail = get_option('xyz_em_pm_dse');
        
        $phpmailer->From     = $xyz_em_senderEmail;
        $phpmailer->FromName = $xyz_em_senderName;
        
        $phpmailer->AddReplyTo($xyz_em_senderEmail,$xyz_em_senderName);
        
    }
    $list_id=1;
    $combineValues =  $xyz_em_email_count->id.$list_id.strtolower($xyz_em_email_count->email);
    $both = md5($combineValues);
    $campId=0;
    $unsubscriptionLink = get_site_url()."/index.php?wp_nlm=unsubscribe&eId=".$xyz_em_email_count->id."&lId=".$list_id."&both=".$both."&campId=".$campId;
    $xyz_em_messageToSendPending = nl2br(str_replace($xyz_em_conf_unsub_link,$unsubscriptionLink,$xyz_em_emailTempalteMessage));
    
    
    
    
    
    
    $phpmailer->Subject = $xyz_em_subject;
    
    $phpmailer->MsgHTML($xyz_em_messageToSendPending);
  //  print_r($xyz_em_messageToSendPending);
    
   
    $phpmailer->AddAddress($unsubscribe_email);
    $sent = $phpmailer->Send();
    
    if($sent == FALSE) {
      //  echo  "Mailer Error: " .$phpmailer->ErrorInfo;die;
    }
    
    
}

}
?>
<style>

.xyz_nlm_thickbox{
    position: fixed;
    background-color: rgb(255, 255, 255);
    text-align: left;
    top: 35%;
    left: 28%;
    width: 50%;
    box-shadow: rgba(0, 0, 0, 0.3) 0px 3px 6px;
    padding: 20px;
    z-index: 999 !important;
}
@media screen and (max-width: 532px){
    .xyz_nlm_thickbox { width: 80%;
    left: 10%;}}
    
    
    
    #outer_div {
    background: #000;
    opacity: 0.7;
    filter: alpha(opacity=70);
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 99; /* Above DFW. */
}

</style>
