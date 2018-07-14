
<?php
wpsp_header();
//Inventory Module
	if( is_user_logged_in() ) {
		global $current_user, $wp_roles, $wpdb;

		//get_currentuserinfo();
		foreach ( $wp_roles->role_names as $role => $name ) :
		if ( current_user_can( $role ) )
			$current_user_role =  $role;
		endforeach;
		if($current_user_role=='administrator' || $current_user_role=='editor' ) {
			wpsp_topbar();
			wpsp_sidebar();
			wpsp_body_start();
			$filename	=	WPSP_PLUGIN_PATH .'includes/wpsp-invAssignedList.php';
			if( isset( $_GET['tab'] ) && $_GET['tab'] == 'AddNew' ) {
				$label	=	__( 'Add New', 'SchoolWeb');
				$filename	=	WPSP_PLUGIN_PATH .'includes/wpsp-AddInventoryForm.php';
			}
			else if( isset( $_GET['tab'] ) && $_GET['tab'] == 'Assign' ) {
				$label	=	__( 'Assign Item', 'SchoolWeb');
				$filename	=	WPSP_PLUGIN_PATH .'includes/wpsp-assignInventory.php';
			}
			else if( isset( $_GET['tab'] ) && $_GET['tab'] == 'Summary' ) {
				$label	=	__( 'Assign Item', 'SchoolWeb');
				$filename	=	WPSP_PLUGIN_PATH .'includes/wpsp-invItemsSummary.php';
			} 
			else if( isset( $_GET['tab'] ) && $_GET['tab'] == 'stock' ) {
				$label	=	__( 'Assign Item', 'SchoolWeb');
				$filename	=	WPSP_PLUGIN_PATH .'includes/wpsp-invStockList.php';
			}
			else {
				$label	=	'List of Assigned Items';
			}			
			?>
			<section class="content-header">
				<h1><?php echo $label; ?></h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo site_url('sch-dashboard'); ?> "><i class="fa fa-dashboard"></i><?php _e( 'Dashboard', 'SchoolWeb'); ?> </a></li>
					<li><a href="<?php echo site_url('sch-inv-management'); ?>"><?php _e( 'Inventory Management', 'SchoolWeb'); ?></a></li>
				</ol>
			</section>
			<?php
			include_once ( $filename );			
			do_action('wpsp_student_import_html');
			wpsp_body_end();
			wpsp_footer();
		}
	}
	else {
		//Include login
		include_once( WPSP_PLUGIN_PATH.'/includes/wpsp-login.php');
	}
	?>