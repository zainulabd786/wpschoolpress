<?php 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
if( isset( $_POST['saveoptions'] ) && $_POST['saveoptions']=='Save' ) {
    $remove_data	=	isset( $_POST['remove_data'] ) &&  $_POST['remove_data']== 1 ? 1 : 0;
	update_option( 'wpsp_remove_data', $remove_data );
}
$remove_data_status	=	get_option( 'wpsp_remove_data');

if( isset( $_POST['save-custom-options'] ) && $_POST['save-custom-options']=='Save-custom-settings' ) {
    $num_sms = $_POST['set-num-sms'];
    if(!empty($_POST['set-pay-gateway'])) $gateway_status = $_POST['set-pay-gateway'];
    global $wpdb;
    ($gateway_status == 'on') ? $gateway_status = 1 : $gateway_status = 0;
    $wpdb->query("UPDATE $settings_table SET option_value = '$num_sms' WHERE option_name='sch_num_sms'");
    $wpdb->query("UPDATE $settings_table SET option_value = '$gateway_status' WHERE option_name='sch_enable_payment_gateway'");
}
?>
<div id="wpbody">
    <div aria-label="Main content" tabindex="0">
        <div class="wrap">
            <h1>SchoolWeb</h1>
            <div id="dashboard-widgets-wrap">
                <div id="dashboard-widgets" class="metabox-holder columns-2">
                    <div id="postbox-container-1" class="postbox-container">
                        <div id="normal-sortables" class="meta-box-sortables">
                            <div class="postbox ">
                                <h2 class="hndle"><span><?php _e( 'Settings', 'SchoolWeb'); ?> </span></h2>
                                <div class="inside">
                                    <form name="post" action="" method="post" >
                                       <table class="plg-form-table">
                                            <tr class="spaceUnder">
												<td class="plg-option"><label for="lcode"><strong>Delete Data</strong></label></td>
												<td class="plg-value"><input type="checkbox" name="remove_data" id="lcode" value="1" <?php checked( $remove_data_status, 1, true ); ?>><br>											
													<i>If you don't want to use the SchoolWeb Plugin on your site anymore, you can check the delete data box. 
													This makes sure, that all the pages and tables are being deleted from the database when you delete the plugin.</i>
												</td>
											</tr>
											<tr>
												<td class="plg-option"><label for="lcode"><strong>Import </strong></label></td>
												<td class="plg-value">
													<button name="wpsp-import-data" id="wpsp-import-data" class="button button-primary">Import Demo Data</button>
													<span class="spinner"></span>
													<br>													
													<i>If you want to import demo data, click on Import Demo Data button</i>													
												</td>
											</tr>												
                                        </table>
										<p class="response"></p>	
                                        <p class="submit">
                                            <input type="submit" name="saveoptions" class="button button-primary" value="Save">
                                            <br class="clear">
                                        </p>
                                    </form>                                    
                                </div>
                            </div>
                        </div>
                    </div>                  
                </div>
            </div><!-- dashboard-widgets-wrap -->
        </div><!-- wrap -->
    </div><!-- wpbody-content -->
</div>


<div id="wpbody">
    <div aria-label="Main content" tabindex="0">
        <div class="wrap">
            <div id="dashboard-widgets-wrap">
                <div id="dashboard-widgets" class="metabox-holder columns-2">
                    <div id="postbox-container-1" class="postbox-container">
                        <div id="normal-sortables" class="meta-box-sortables">
                            <div class="postbox ">
                                <h2 class="hndle"><span><?php _e( 'Gateway & SMS Settings', 'SchoolWeb'); ?> </span></h2>
                                <div class="inside">
                                    <form name="post" action="" method="post" >
                                        <div class="plg-set-wrapper">
                                            <label><strong>Number of SMS: </strong></label>
                                            <input type="text" value="<?php echo $num_sms; ?>" name="set-num-sms" > 
                                        </div>
                                        <div class="plg-set-wrapper">
                                            <label><strong>Enable Payment Gateway: </strong></label> 
                                            <input type="checkbox" name="set-pay-gateway" <?php if(!empty($gateway_status)) echo "checked"; ?>>
                                        </div>
                                        <p class="submit">
                                            <input type="submit" name="save-custom-options" class="button button-primary" value="Save-custom-settings">
                                            <br class="clear">
                                        </p>
                                    </form>                                    
                                </div>
                            </div>
                        </div>
                    </div>                  
                </div>
            </div><!-- dashboard-widgets-wrap -->
        </div><!-- wrap -->
    </div><!-- wpbody-content -->
</div>

<?php 

?>
