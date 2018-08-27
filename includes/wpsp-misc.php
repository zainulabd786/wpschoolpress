<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Initilize SchoolPress
 * 
 * Handle to initilize Settings of SchoolPress
 * 
 * @package SchoolWeb
 * @since 2.0.0
 */
function wpsp_get_setting() {
	
	global $wpsp_settings_data, $wpdb;
	
	$wpsp_settings_table	=	$wpdb->prefix."wpsp_settings";
	$wpsp_settings_edit		=	$wpdb->get_results("SELECT * FROM $wpsp_settings_table" );
	foreach($wpsp_settings_edit as $sdat) {
		$wpsp_settings_data[$sdat->option_name]	=	$sdat->option_value;
	}
}

/*
* Send mail when new user register
* @package SchoolWeb
* @since 2.0.0
*/
function wpsp_send_user_register_mail( $userInfo = array(), $user_id ) {
	if( !empty( $user_id ) && $user_id > 0 ) {
		wp_new_user_notification( $user_id, '', 'user');
	}
}


/*
* Check current user is authorized or not
* @package SchoolWeb
* @since 2.0.0
*/
function wpsp_Authenticate() {
	global $current_user;
	if($current_user->roles[0]!='administrator' && $current_user->roles[0]!='teacher' && $current_user->roles[0]!='editor' ) {
		echo "Unauthorized Access!";
		exit;
	}
}

/*
* Check current user has update access or not
* @package SchoolWeb
* @since 2.0.0
*/
function wpsp_UpdateAccess($role,$id){
	global $current_user;
	$current_user_role=$current_user->roles[0];
	if( $current_user_role=='administrator' || $current_user_role=='editor'  || ( $current_user_role==$role && $current_user->ID==$id ) ) {
		return true;	
	} else {
		return false;
	}
}

/*
* Get role of current user
* @package SchoolWeb
* @since 2.0.0
*/
function wpsp_CurrentUserRole(){
	global $current_user;
	return isset( $current_user->roles[0] ) ? $current_user->roles[0] : '';
}

/*
* Get add as per given setting
* @package SchoolWeb
* @since 2.0.0
*/
function wpsp_ViewDate($date){
	
	global $wpdb, $wpsp_settings_data;	
	$date_format	=	isset( $wpsp_settings_data['date_format'] ) ? $wpsp_settings_data['date_format'] : '';	
	$dformat		=	empty( $date_format ) ? 'm/d/Y' : $date_format;		
	return ( !empty( $date ) && $date!='0000-00-00' ) ? date( $dformat,strtotime($date) ) : $date;
}

/*
* Store date as per given setting
* @package SchoolWeb
* @since 2.0.0
*/
function wpsp_StoreDate($date) {
	return ( !empty ( $date ) && $date!='0000-00-00' ) ? date('Y-m-d',strtotime($date)) : $date;
}

/*
* Check for username exists or not
* @package SchoolWeb
* @since 2.0.0
*/
function wpsp_CheckUsername($username='',$return=false){
	$username	=	empty( $username ) ? esc_sql($_POST['username'] ) : $username ;
	if ( username_exists( $username ) ) {
        if ($return)
            return true;
        else{
            echo "true";
            wp_die();
        }
    } else {
        if ($return)
            return false;
        else {
            echo "false";
            wp_die();
        }
    }
}

/*
* Check for emailID exists or not
* @package SchoolWeb
* @since 2.0.0
*/
function wpsp_CheckEmail(){
	$email=esc_sql($_POST['email']);
	echo email_exists( $email ) ? "true" : "false";
	wp_die();
}

/*
* Create dynamic email id if not specified
* @package SchoolWeb
* @since 2.0.0
*/
function wpsp_EmailGen($username){
	//return $username."@spischool.org";
	return $username."@".$_SERVER['HTTP_HOST'];
}

function wpsp_send_mail( $to, $subject, $body, $attachment='' ) {
	global $wpsp_settings_data;	
	$email			=	$wpsp_settings_data['sch_email'];
	$from			=	$wpsp_settings_data['sch_name'];
	$admin_email	=	get_option( 'admin_email' );
		
	$email		=	!empty( $email ) ? $email : $admin_email;
	$from		=	!empty( $from ) ? $from : get_option( 'blogname'  );
	$headers	=	 array();
	
	if( !empty( $email ) && !empty( $from ) ) {
		$headers[]	=	"From: $from <$email>";
		$headers[] 	=	'Content-Type: text/html; charset=UTF-8';
	}	
	if( wp_mail( $to, $subject, $body, $headers, $attachment )) return true;	
	else return false;
}

function wpsp_county_list() {
	return array(
	'AF' => __( 'Afghanistan', 'SchoolWeb' ),
	'AX' => __( '&#197;land Islands', 'SchoolWeb' ),
	'AL' => __( 'Albania', 'SchoolWeb' ),
	'DZ' => __( 'Algeria', 'SchoolWeb' ),
	'AD' => __( 'Andorra', 'SchoolWeb' ),
	'AO' => __( 'Angola', 'SchoolWeb' ),
	'AI' => __( 'Anguilla', 'SchoolWeb' ),
	'AQ' => __( 'Antarctica', 'SchoolWeb' ),
	'AG' => __( 'Antigua and Barbuda', 'SchoolWeb' ),
	'AR' => __( 'Argentina', 'SchoolWeb' ),
	'AM' => __( 'Armenia', 'SchoolWeb' ),
	'AW' => __( 'Aruba', 'SchoolWeb' ),
	'AU' => __( 'Australia', 'SchoolWeb' ),
	'AT' => __( 'Austria', 'SchoolWeb' ),
	'AZ' => __( 'Azerbaijan', 'SchoolWeb' ),
	'BS' => __( 'Bahamas', 'SchoolWeb' ),
	'BH' => __( 'Bahrain', 'SchoolWeb' ),
	'BD' => __( 'Bangladesh', 'SchoolWeb' ),
	'BB' => __( 'Barbados', 'SchoolWeb' ),
	'BY' => __( 'Belarus', 'SchoolWeb' ),
	'BE' => __( 'Belgium', 'SchoolWeb' ),
	'PW' => __( 'Belau', 'SchoolWeb' ),
	'BZ' => __( 'Belize', 'SchoolWeb' ),
	'BJ' => __( 'Benin', 'SchoolWeb' ),
	'BM' => __( 'Bermuda', 'SchoolWeb' ),
	'BT' => __( 'Bhutan', 'SchoolWeb' ),
	'BO' => __( 'Bolivia', 'SchoolWeb' ),
	'BQ' => __( 'Bonaire, Saint Eustatius and Saba', 'SchoolWeb' ),
	'BA' => __( 'Bosnia and Herzegovina', 'SchoolWeb' ),
	'BW' => __( 'Botswana', 'SchoolWeb' ),
	'BV' => __( 'Bouvet Island', 'SchoolWeb' ),
	'BR' => __( 'Brazil', 'SchoolWeb' ),
	'IO' => __( 'British Indian Ocean Territory', 'SchoolWeb' ),
	'VG' => __( 'British Virgin Islands', 'SchoolWeb' ),
	'BN' => __( 'Brunei', 'SchoolWeb' ),
	'BG' => __( 'Bulgaria', 'SchoolWeb' ),
	'BF' => __( 'Burkina Faso', 'SchoolWeb' ),
	'BI' => __( 'Burundi', 'SchoolWeb' ),
	'KH' => __( 'Cambodia', 'SchoolWeb' ),
	'CM' => __( 'Cameroon', 'SchoolWeb' ),
	'CA' => __( 'Canada', 'SchoolWeb' ),
	'CV' => __( 'Cape Verde', 'SchoolWeb' ),
	'KY' => __( 'Cayman Islands', 'SchoolWeb' ),
	'CF' => __( 'Central African Republic', 'SchoolWeb' ),
	'TD' => __( 'Chad', 'SchoolWeb' ),
	'CL' => __( 'Chile', 'SchoolWeb' ),
	'CN' => __( 'China', 'SchoolWeb' ),
	'CX' => __( 'Christmas Island', 'SchoolWeb' ),
	'CC' => __( 'Cocos (Keeling) Islands', 'SchoolWeb' ),
	'CO' => __( 'Colombia', 'SchoolWeb' ),
	'KM' => __( 'Comoros', 'SchoolWeb' ),
	'CG' => __( 'Congo (Brazzaville)', 'SchoolWeb' ),
	'CD' => __( 'Congo (Kinshasa)', 'SchoolWeb' ),
	'CK' => __( 'Cook Islands', 'SchoolWeb' ),
	'CR' => __( 'Costa Rica', 'SchoolWeb' ),
	'HR' => __( 'Croatia', 'SchoolWeb' ),
	'CU' => __( 'Cuba', 'SchoolWeb' ),
	'CW' => __( 'Cura&Ccedil;ao', 'SchoolWeb' ),
	'CY' => __( 'Cyprus', 'SchoolWeb' ),
	'CZ' => __( 'Czech Republic', 'SchoolWeb' ),
	'DK' => __( 'Denmark', 'SchoolWeb' ),
	'DJ' => __( 'Djibouti', 'SchoolWeb' ),
	'DM' => __( 'Dominica', 'SchoolWeb' ),
	'DO' => __( 'Dominican Republic', 'SchoolWeb' ),
	'EC' => __( 'Ecuador', 'SchoolWeb' ),
	'EG' => __( 'Egypt', 'SchoolWeb' ),
	'SV' => __( 'El Salvador', 'SchoolWeb' ),
	'GQ' => __( 'Equatorial Guinea', 'SchoolWeb' ),
	'ER' => __( 'Eritrea', 'SchoolWeb' ),
	'EE' => __( 'Estonia', 'SchoolWeb' ),
	'ET' => __( 'Ethiopia', 'SchoolWeb' ),
	'FK' => __( 'Falkland Islands', 'SchoolWeb' ),
	'FO' => __( 'Faroe Islands', 'SchoolWeb' ),
	'FJ' => __( 'Fiji', 'SchoolWeb' ),
	'FI' => __( 'Finland', 'SchoolWeb' ),
	'FR' => __( 'France', 'SchoolWeb' ),
	'GF' => __( 'French Guiana', 'SchoolWeb' ),
	'PF' => __( 'French Polynesia', 'SchoolWeb' ),
	'TF' => __( 'French Southern Territories', 'SchoolWeb' ),
	'GA' => __( 'Gabon', 'SchoolWeb' ),
	'GM' => __( 'Gambia', 'SchoolWeb' ),
	'GE' => __( 'Georgia', 'SchoolWeb' ),
	'DE' => __( 'Germany', 'SchoolWeb' ),
	'GH' => __( 'Ghana', 'SchoolWeb' ),
	'GI' => __( 'Gibraltar', 'SchoolWeb' ),
	'GR' => __( 'Greece', 'SchoolWeb' ),
	'GL' => __( 'Greenland', 'SchoolWeb' ),
	'GD' => __( 'Grenada', 'SchoolWeb' ),
	'GP' => __( 'Guadeloupe', 'SchoolWeb' ),
	'GT' => __( 'Guatemala', 'SchoolWeb' ),
	'GG' => __( 'Guernsey', 'SchoolWeb' ),
	'GN' => __( 'Guinea', 'SchoolWeb' ),
	'GW' => __( 'Guinea-Bissau', 'SchoolWeb' ),
	'GY' => __( 'Guyana', 'SchoolWeb' ),
	'HT' => __( 'Haiti', 'SchoolWeb' ),
	'HM' => __( 'Heard Island and McDonald Islands', 'SchoolWeb' ),
	'HN' => __( 'Honduras', 'SchoolWeb' ),
	'HK' => __( 'Hong Kong', 'SchoolWeb' ),
	'HU' => __( 'Hungary', 'SchoolWeb' ),
	'IS' => __( 'Iceland', 'SchoolWeb' ),
	'IN' => __( 'India', 'SchoolWeb' ),
	'ID' => __( 'Indonesia', 'SchoolWeb' ),
	'IR' => __( 'Iran', 'SchoolWeb' ),
	'IQ' => __( 'Iraq', 'SchoolWeb' ),
	'IE' => __( 'Republic of Ireland', 'SchoolWeb' ),
	'IM' => __( 'Isle of Man', 'SchoolWeb' ),
	'IL' => __( 'Israel', 'SchoolWeb' ),
	'IT' => __( 'Italy', 'SchoolWeb' ),
	'CI' => __( 'Ivory Coast', 'SchoolWeb' ),
	'JM' => __( 'Jamaica', 'SchoolWeb' ),
	'JP' => __( 'Japan', 'SchoolWeb' ),
	'JE' => __( 'Jersey', 'SchoolWeb' ),
	'JO' => __( 'Jordan', 'SchoolWeb' ),
	'KZ' => __( 'Kazakhstan', 'SchoolWeb' ),
	'KE' => __( 'Kenya', 'SchoolWeb' ),
	'KI' => __( 'Kiribati', 'SchoolWeb' ),
	'KW' => __( 'Kuwait', 'SchoolWeb' ),
	'KG' => __( 'Kyrgyzstan', 'SchoolWeb' ),
	'LA' => __( 'Laos', 'SchoolWeb' ),
	'LV' => __( 'Latvia', 'SchoolWeb' ),
	'LB' => __( 'Lebanon', 'SchoolWeb' ),
	'LS' => __( 'Lesotho', 'SchoolWeb' ),
	'LR' => __( 'Liberia', 'SchoolWeb' ),
	'LY' => __( 'Libya', 'SchoolWeb' ),
	'LI' => __( 'Liechtenstein', 'SchoolWeb' ),
	'LT' => __( 'Lithuania', 'SchoolWeb' ),
	'LU' => __( 'Luxembourg', 'SchoolWeb' ),
	'MO' => __( 'Macao S.A.R., China', 'SchoolWeb' ),
	'MK' => __( 'Macedonia', 'SchoolWeb' ),
	'MG' => __( 'Madagascar', 'SchoolWeb' ),
	'MW' => __( 'Malawi', 'SchoolWeb' ),
	'MY' => __( 'Malaysia', 'SchoolWeb' ),
	'MV' => __( 'Maldives', 'SchoolWeb' ),
	'ML' => __( 'Mali', 'SchoolWeb' ),
	'MT' => __( 'Malta', 'SchoolWeb' ),
	'MH' => __( 'Marshall Islands', 'SchoolWeb' ),
	'MQ' => __( 'Martinique', 'SchoolWeb' ),
	'MR' => __( 'Mauritania', 'SchoolWeb' ),
	'MU' => __( 'Mauritius', 'SchoolWeb' ),
	'YT' => __( 'Mayotte', 'SchoolWeb' ),
	'MX' => __( 'Mexico', 'SchoolWeb' ),
	'FM' => __( 'Micronesia', 'SchoolWeb' ),
	'MD' => __( 'Moldova', 'SchoolWeb' ),
	'MC' => __( 'Monaco', 'SchoolWeb' ),
	'MN' => __( 'Mongolia', 'SchoolWeb' ),
	'ME' => __( 'Montenegro', 'SchoolWeb' ),
	'MS' => __( 'Montserrat', 'SchoolWeb' ),
	'MA' => __( 'Morocco', 'SchoolWeb' ),
	'MZ' => __( 'Mozambique', 'SchoolWeb' ),
	'MM' => __( 'Myanmar', 'SchoolWeb' ),
	'NA' => __( 'Namibia', 'SchoolWeb' ),
	'NR' => __( 'Nauru', 'SchoolWeb' ),
	'NP' => __( 'Nepal', 'SchoolWeb' ),
	'NL' => __( 'Netherlands', 'SchoolWeb' ),
	'AN' => __( 'Netherlands Antilles', 'SchoolWeb' ),
	'NC' => __( 'New Caledonia', 'SchoolWeb' ),
	'NZ' => __( 'New Zealand', 'SchoolWeb' ),
	'NI' => __( 'Nicaragua', 'SchoolWeb' ),
	'NE' => __( 'Niger', 'SchoolWeb' ),
	'NG' => __( 'Nigeria', 'SchoolWeb' ),
	'NU' => __( 'Niue', 'SchoolWeb' ),
	'NF' => __( 'Norfolk Island', 'SchoolWeb' ),
	'KP' => __( 'North Korea', 'SchoolWeb' ),
	'NO' => __( 'Norway', 'SchoolWeb' ),
	'OM' => __( 'Oman', 'SchoolWeb' ),
	'PK' => __( 'Pakistan', 'SchoolWeb' ),
	'PS' => __( 'Palestinian Territory', 'SchoolWeb' ),
	'PA' => __( 'Panama', 'SchoolWeb' ),
	'PG' => __( 'Papua New Guinea', 'SchoolWeb' ),
	'PY' => __( 'Paraguay', 'SchoolWeb' ),
	'PE' => __( 'Peru', 'SchoolWeb' ),
	'PH' => __( 'Philippines', 'SchoolWeb' ),
	'PN' => __( 'Pitcairn', 'SchoolWeb' ),
	'PL' => __( 'Poland', 'SchoolWeb' ),
	'PT' => __( 'Portugal', 'SchoolWeb' ),
	'QA' => __( 'Qatar', 'SchoolWeb' ),
	'RE' => __( 'Reunion', 'SchoolWeb' ),
	'RO' => __( 'Romania', 'SchoolWeb' ),
	'RU' => __( 'Russia', 'SchoolWeb' ),
	'RW' => __( 'Rwanda', 'SchoolWeb' ),
	'BL' => __( 'Saint Barth&eacute;lemy', 'SchoolWeb' ),
	'SH' => __( 'Saint Helena', 'SchoolWeb' ),
	'KN' => __( 'Saint Kitts and Nevis', 'SchoolWeb' ),
	'LC' => __( 'Saint Lucia', 'SchoolWeb' ),
	'MF' => __( 'Saint Martin (French part)', 'SchoolWeb' ),
	'SX' => __( 'Saint Martin (Dutch part)', 'SchoolWeb' ),
	'PM' => __( 'Saint Pierre and Miquelon', 'SchoolWeb' ),
	'VC' => __( 'Saint Vincent and the Grenadines', 'SchoolWeb' ),
	'SM' => __( 'San Marino', 'SchoolWeb' ),
	'ST' => __( 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'SchoolWeb' ),
	'SA' => __( 'Saudi Arabia', 'SchoolWeb' ),
	'SN' => __( 'Senegal', 'SchoolWeb' ),
	'RS' => __( 'Serbia', 'SchoolWeb' ),
	'SC' => __( 'Seychelles', 'SchoolWeb' ),
	'SL' => __( 'Sierra Leone', 'SchoolWeb' ),
	'SG' => __( 'Singapore', 'SchoolWeb' ),
	'SK' => __( 'Slovakia', 'SchoolWeb' ),
	'SI' => __( 'Slovenia', 'SchoolWeb' ),
	'SB' => __( 'Solomon Islands', 'SchoolWeb' ),
	'SO' => __( 'Somalia', 'SchoolWeb' ),
	'ZA' => __( 'South Africa', 'SchoolWeb' ),
	'GS' => __( 'South Georgia/Sandwich Islands', 'SchoolWeb' ),
	'KR' => __( 'South Korea', 'SchoolWeb' ),
	'SS' => __( 'South Sudan', 'SchoolWeb' ),
	'ES' => __( 'Spain', 'SchoolWeb' ),
	'LK' => __( 'Sri Lanka', 'SchoolWeb' ),
	'SD' => __( 'Sudan', 'SchoolWeb' ),
	'SR' => __( 'Suriname', 'SchoolWeb' ),
	'SJ' => __( 'Svalbard and Jan Mayen', 'SchoolWeb' ),
	'SZ' => __( 'Swaziland', 'SchoolWeb' ),
	'SE' => __( 'Sweden', 'SchoolWeb' ),
	'CH' => __( 'Switzerland', 'SchoolWeb' ),
	'SY' => __( 'Syria', 'SchoolWeb' ),
	'TW' => __( 'Taiwan', 'SchoolWeb' ),
	'TJ' => __( 'Tajikistan', 'SchoolWeb' ),
	'TZ' => __( 'Tanzania', 'SchoolWeb' ),
	'TH' => __( 'Thailand', 'SchoolWeb' ),
	'TL' => __( 'Timor-Leste', 'SchoolWeb' ),
	'TG' => __( 'Togo', 'SchoolWeb' ),
	'TK' => __( 'Tokelau', 'SchoolWeb' ),
	'TO' => __( 'Tonga', 'SchoolWeb' ),
	'TT' => __( 'Trinidad and Tobago', 'SchoolWeb' ),
	'TN' => __( 'Tunisia', 'SchoolWeb' ),
	'TR' => __( 'Turkey', 'SchoolWeb' ),
	'TM' => __( 'Turkmenistan', 'SchoolWeb' ),
	'TC' => __( 'Turks and Caicos Islands', 'SchoolWeb' ),
	'TV' => __( 'Tuvalu', 'SchoolWeb' ),
	'UG' => __( 'Uganda', 'SchoolWeb' ),
	'UA' => __( 'Ukraine', 'SchoolWeb' ),
	'AE' => __( 'United Arab Emirates', 'SchoolWeb' ),
	'GB' => __( 'United Kingdom (UK)', 'SchoolWeb' ),
	'US' => __( 'United States (US)', 'SchoolWeb' ),
	'UY' => __( 'Uruguay', 'SchoolWeb' ),
	'UZ' => __( 'Uzbekistan', 'SchoolWeb' ),
	'VU' => __( 'Vanuatu', 'SchoolWeb' ),
	'VA' => __( 'Vatican', 'SchoolWeb' ),
	'VE' => __( 'Venezuela', 'SchoolWeb' ),
	'VN' => __( 'Vietnam', 'SchoolWeb' ),
	'WF' => __( 'Wallis and Futuna', 'SchoolWeb' ),
	'EH' => __( 'Western Sahara', 'SchoolWeb' ),
	'WS' => __( 'Western Samoa', 'SchoolWeb' ),
	'YE' => __( 'Yemen', 'SchoolWeb' ),
	'ZM' => __( 'Zambia', 'SchoolWeb' ),
	'ZW' => __( 'Zimbabwe', 'SchoolWeb' )
	);
}

function wpsp_check_pro_version( $class='wpsp_pro_version' ) {
	
	$response = array();
	$response['status']	 =true;	
	if( !empty( $class ) && !class_exists( $class ) ) {
		$response['status']		=	true;
		$response['class']		=	'upgrade-to-wpsp-version';
		$response['message']	=	'Upgrade To Pro Version';	
		return $response;
	}
	return $response;
}
?>