<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

include_once('vendor_product_page.php');
include_once('vendor_manage_page.php');
include_once('admin_product_page.php');
include_once('vendor_settings.php');
include_once('pending_vendor_application.php');
include_once('vendor_view_backend.php');
// ############################################################################################
// ############################################################################################

add_filter('wcfm_is_allow_order_status_update','disallow_vendor_from_change_order_status',50);
function disallow_vendor_from_change_order_status($is_allowed){
	if(!current_user_can( 'administrator' )){
		$is_allowed = false;
	}
	return $is_allowed;
}

add_filter('wcmp_completed_commission_statuses','add_commission_only_with_completed_order',50,1);
function add_commission_only_with_completed_order($statuses){
	if(isset($statuses[1])){
		unset($statuses[1]);
	}
	return $statuses;
}
add_filter('wcfm_allow_customer_billing_details','disallow_vendor_from_view_customer',50);
add_filter('wcfm_is_allow_view_customer','disallow_vendor_from_view_customer',50);
add_filter('wcfm_allow_customer_shipping_details','disallow_vendor_from_view_customer',50);
add_filter('woocommerce_enable_order_notes_field','disallow_vendor_from_view_customer',50);
add_filter('wcfm_is_allow_view_customer','disallow_vendor_from_view_customer',50);
function disallow_vendor_from_view_customer($choice){
	if(current_user_can('dc_vendor')){
		$choice = false;
	}

		return $choice;
}
// ############################################################################################

// global functions
function wc_get_phone_keys(){
	return array(
		'SA'=>array('name'=>'SAUDI ARABIA','code'=>'966'),
    'TR'=>array('name'=>'TURKEY','code'=>'90'),
    'AD'=>array('name'=>'ANDORRA','code'=>'376'),
    'AE'=>array('name'=>'UNITED ARAB EMIRATES','code'=>'971'),
    'AF'=>array('name'=>'AFGHANISTAN','code'=>'93'),
    'AG'=>array('name'=>'ANTIGUA AND BARBUDA','code'=>'1268'),
    'AI'=>array('name'=>'ANGUILLA','code'=>'1264'),
    'AL'=>array('name'=>'ALBANIA','code'=>'355'),
    'AM'=>array('name'=>'ARMENIA','code'=>'374'),
    'AN'=>array('name'=>'NETHERLANDS ANTILLES','code'=>'599'),
    'AO'=>array('name'=>'ANGOLA','code'=>'244'),
    'AQ'=>array('name'=>'ANTARCTICA','code'=>'672'),
    'AR'=>array('name'=>'ARGENTINA','code'=>'54'),
    'AS'=>array('name'=>'AMERICAN SAMOA','code'=>'1684'),
    'AT'=>array('name'=>'AUSTRIA','code'=>'43'),
    'AU'=>array('name'=>'AUSTRALIA','code'=>'61'),
    'AW'=>array('name'=>'ARUBA','code'=>'297'),
    'AZ'=>array('name'=>'AZERBAIJAN','code'=>'994'),
    'BA'=>array('name'=>'BOSNIA AND HERZEGOVINA','code'=>'387'),
    'BB'=>array('name'=>'BARBADOS','code'=>'1246'),
    'BD'=>array('name'=>'BANGLADESH','code'=>'880'),
    'BE'=>array('name'=>'BELGIUM','code'=>'32'),
    'BF'=>array('name'=>'BURKINA FASO','code'=>'226'),
    'BG'=>array('name'=>'BULGARIA','code'=>'359'),
    'BH'=>array('name'=>'BAHRAIN','code'=>'973'),
    'BI'=>array('name'=>'BURUNDI','code'=>'257'),
    'BJ'=>array('name'=>'BENIN','code'=>'229'),
    'BL'=>array('name'=>'SAINT BARTHELEMY','code'=>'590'),
    'BM'=>array('name'=>'BERMUDA','code'=>'1441'),
    'BN'=>array('name'=>'BRUNEI DARUSSALAM','code'=>'673'),
    'BO'=>array('name'=>'BOLIVIA','code'=>'591'),
    'BR'=>array('name'=>'BRAZIL','code'=>'55'),
    'BS'=>array('name'=>'BAHAMAS','code'=>'1242'),
    'BT'=>array('name'=>'BHUTAN','code'=>'975'),
    'BW'=>array('name'=>'BOTSWANA','code'=>'267'),
    'BY'=>array('name'=>'BELARUS','code'=>'375'),
    'BZ'=>array('name'=>'BELIZE','code'=>'501'),
    'CA'=>array('name'=>'CANADA','code'=>'1'),
    'CC'=>array('name'=>'COCOS (KEELING) ISLANDS','code'=>'61'),
    'CD'=>array('name'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE','code'=>'243'),
    'CF'=>array('name'=>'CENTRAL AFRICAN REPUBLIC','code'=>'236'),
    'CG'=>array('name'=>'CONGO','code'=>'242'),
    'CH'=>array('name'=>'SWITZERLAND','code'=>'41'),
    'CI'=>array('name'=>'COTE D IVOIRE','code'=>'225'),
    'CK'=>array('name'=>'COOK ISLANDS','code'=>'682'),
    'CL'=>array('name'=>'CHILE','code'=>'56'),
    'CM'=>array('name'=>'CAMEROON','code'=>'237'),
    'CN'=>array('name'=>'CHINA','code'=>'86'),
    'CO'=>array('name'=>'COLOMBIA','code'=>'57'),
    'CR'=>array('name'=>'COSTA RICA','code'=>'506'),
    'CU'=>array('name'=>'CUBA','code'=>'53'),
    'CV'=>array('name'=>'CAPE VERDE','code'=>'238'),
    'CX'=>array('name'=>'CHRISTMAS ISLAND','code'=>'61'),
    'CY'=>array('name'=>'CYPRUS','code'=>'357'),
    'CZ'=>array('name'=>'CZECH REPUBLIC','code'=>'420'),
    'DE'=>array('name'=>'GERMANY','code'=>'49'),
    'DJ'=>array('name'=>'DJIBOUTI','code'=>'253'),
    'DK'=>array('name'=>'DENMARK','code'=>'45'),
    'DM'=>array('name'=>'DOMINICA','code'=>'1767'),
    'DO'=>array('name'=>'DOMINICAN REPUBLIC','code'=>'1809'),
    'DZ'=>array('name'=>'ALGERIA','code'=>'213'),
    'EC'=>array('name'=>'ECUADOR','code'=>'593'),
    'EE'=>array('name'=>'ESTONIA','code'=>'372'),
    'EG'=>array('name'=>'EGYPT','code'=>'20'),
    'ER'=>array('name'=>'ERITREA','code'=>'291'),
    'ES'=>array('name'=>'SPAIN','code'=>'34'),
    'ET'=>array('name'=>'ETHIOPIA','code'=>'251'),
    'FI'=>array('name'=>'FINLAND','code'=>'358'),
    'FJ'=>array('name'=>'FIJI','code'=>'679'),
    'FK'=>array('name'=>'FALKLAND ISLANDS (MALVINAS)','code'=>'500'),
    'FM'=>array('name'=>'MICRONESIA, FEDERATED STATES OF','code'=>'691'),
    'FO'=>array('name'=>'FAROE ISLANDS','code'=>'298'),
    'FR'=>array('name'=>'FRANCE','code'=>'33'),
    'GA'=>array('name'=>'GABON','code'=>'241'),
    'GB'=>array('name'=>'UNITED KINGDOM','code'=>'44'),
    'GD'=>array('name'=>'GRENADA','code'=>'1473'),
    'GE'=>array('name'=>'GEORGIA','code'=>'995'),
    'GH'=>array('name'=>'GHANA','code'=>'233'),
    'GI'=>array('name'=>'GIBRALTAR','code'=>'350'),
    'GL'=>array('name'=>'GREENLAND','code'=>'299'),
    'GM'=>array('name'=>'GAMBIA','code'=>'220'),
    'GN'=>array('name'=>'GUINEA','code'=>'224'),
    'GQ'=>array('name'=>'EQUATORIAL GUINEA','code'=>'240'),
    'GR'=>array('name'=>'GREECE','code'=>'30'),
    'GT'=>array('name'=>'GUATEMALA','code'=>'502'),
    'GU'=>array('name'=>'GUAM','code'=>'1671'),
    'GW'=>array('name'=>'GUINEA-BISSAU','code'=>'245'),
    'GY'=>array('name'=>'GUYANA','code'=>'592'),
    'HK'=>array('name'=>'HONG KONG','code'=>'852'),
    'HN'=>array('name'=>'HONDURAS','code'=>'504'),
    'HR'=>array('name'=>'CROATIA','code'=>'385'),
    'HT'=>array('name'=>'HAITI','code'=>'509'),
    'HU'=>array('name'=>'HUNGARY','code'=>'36'),
    'ID'=>array('name'=>'INDONESIA','code'=>'62'),
    'IE'=>array('name'=>'IRELAND','code'=>'353'),
    'IL'=>array('name'=>'ISRAEL','code'=>'972'),
    'IM'=>array('name'=>'ISLE OF MAN','code'=>'44'),
    'IN'=>array('name'=>'INDIA','code'=>'91'),
    'IQ'=>array('name'=>'IRAQ','code'=>'964'),
    'IR'=>array('name'=>'IRAN, ISLAMIC REPUBLIC OF','code'=>'98'),
    'IS'=>array('name'=>'ICELAND','code'=>'354'),
    'IT'=>array('name'=>'ITALY','code'=>'39'),
    'JM'=>array('name'=>'JAMAICA','code'=>'1876'),
    'JO'=>array('name'=>'JORDAN','code'=>'962'),
    'JP'=>array('name'=>'JAPAN','code'=>'81'),
    'KE'=>array('name'=>'KENYA','code'=>'254'),
    'KG'=>array('name'=>'KYRGYZSTAN','code'=>'996'),
    'KH'=>array('name'=>'CAMBODIA','code'=>'855'),
    'KI'=>array('name'=>'KIRIBATI','code'=>'686'),
    'KM'=>array('name'=>'COMOROS','code'=>'269'),
    'KN'=>array('name'=>'SAINT KITTS AND NEVIS','code'=>'1869'),
    'KP'=>array('name'=>'KOREA DEMOCRATIC PEOPLES REPUBLIC OF','code'=>'850'),
    'KR'=>array('name'=>'KOREA REPUBLIC OF','code'=>'82'),
    'KW'=>array('name'=>'KUWAIT','code'=>'965'),
    'KY'=>array('name'=>'CAYMAN ISLANDS','code'=>'1345'),
    'KZ'=>array('name'=>'KAZAKSTAN','code'=>'7'),
    'LA'=>array('name'=>'LAO PEOPLES DEMOCRATIC REPUBLIC','code'=>'856'),
    'LB'=>array('name'=>'LEBANON','code'=>'961'),
    'LC'=>array('name'=>'SAINT LUCIA','code'=>'1758'),
    'LI'=>array('name'=>'LIECHTENSTEIN','code'=>'423'),
    'LK'=>array('name'=>'SRI LANKA','code'=>'94'),
    'LR'=>array('name'=>'LIBERIA','code'=>'231'),
    'LS'=>array('name'=>'LESOTHO','code'=>'266'),
    'LT'=>array('name'=>'LITHUANIA','code'=>'370'),
    'LU'=>array('name'=>'LUXEMBOURG','code'=>'352'),
    'LV'=>array('name'=>'LATVIA','code'=>'371'),
    'LY'=>array('name'=>'LIBYAN ARAB JAMAHIRIYA','code'=>'218'),
    'MA'=>array('name'=>'MOROCCO','code'=>'212'),
    'MC'=>array('name'=>'MONACO','code'=>'377'),
    'MD'=>array('name'=>'MOLDOVA, REPUBLIC OF','code'=>'373'),
    'ME'=>array('name'=>'MONTENEGRO','code'=>'382'),
    'MF'=>array('name'=>'SAINT MARTIN','code'=>'1599'),
    'MG'=>array('name'=>'MADAGASCAR','code'=>'261'),
    'MH'=>array('name'=>'MARSHALL ISLANDS','code'=>'692'),
    'MK'=>array('name'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','code'=>'389'),
    'ML'=>array('name'=>'MALI','code'=>'223'),
    'MM'=>array('name'=>'MYANMAR','code'=>'95'),
    'MN'=>array('name'=>'MONGOLIA','code'=>'976'),
    'MO'=>array('name'=>'MACAU','code'=>'853'),
    'MP'=>array('name'=>'NORTHERN MARIANA ISLANDS','code'=>'1670'),
    'MR'=>array('name'=>'MAURITANIA','code'=>'222'),
    'MS'=>array('name'=>'MONTSERRAT','code'=>'1664'),
    'MT'=>array('name'=>'MALTA','code'=>'356'),
    'MU'=>array('name'=>'MAURITIUS','code'=>'230'),
    'MV'=>array('name'=>'MALDIVES','code'=>'960'),
    'MW'=>array('name'=>'MALAWI','code'=>'265'),
    'MX'=>array('name'=>'MEXICO','code'=>'52'),
    'MY'=>array('name'=>'MALAYSIA','code'=>'60'),
    'MZ'=>array('name'=>'MOZAMBIQUE','code'=>'258'),
    'NA'=>array('name'=>'NAMIBIA','code'=>'264'),
    'NC'=>array('name'=>'NEW CALEDONIA','code'=>'687'),
    'NE'=>array('name'=>'NIGER','code'=>'227'),
    'NG'=>array('name'=>'NIGERIA','code'=>'234'),
    'NI'=>array('name'=>'NICARAGUA','code'=>'505'),
    'NL'=>array('name'=>'NETHERLANDS','code'=>'31'),
    'NO'=>array('name'=>'NORWAY','code'=>'47'),
    'NP'=>array('name'=>'NEPAL','code'=>'977'),
    'NR'=>array('name'=>'NAURU','code'=>'674'),
    'NU'=>array('name'=>'NIUE','code'=>'683'),
    'NZ'=>array('name'=>'NEW ZEALAND','code'=>'64'),
    'OM'=>array('name'=>'OMAN','code'=>'968'),
    'PA'=>array('name'=>'PANAMA','code'=>'507'),
    'PE'=>array('name'=>'PERU','code'=>'51'),
    'PF'=>array('name'=>'FRENCH POLYNESIA','code'=>'689'),
    'PG'=>array('name'=>'PAPUA NEW GUINEA','code'=>'675'),
    'PH'=>array('name'=>'PHILIPPINES','code'=>'63'),
    'PK'=>array('name'=>'PAKISTAN','code'=>'92'),
    'PL'=>array('name'=>'POLAND','code'=>'48'),
    'PM'=>array('name'=>'SAINT PIERRE AND MIQUELON','code'=>'508'),
    'PN'=>array('name'=>'PITCAIRN','code'=>'870'),
    'PR'=>array('name'=>'PUERTO RICO','code'=>'1'),
    'PT'=>array('name'=>'PORTUGAL','code'=>'351'),
    'PW'=>array('name'=>'PALAU','code'=>'680'),
    'PY'=>array('name'=>'PARAGUAY','code'=>'595'),
    'QA'=>array('name'=>'QATAR','code'=>'974'),
    'RO'=>array('name'=>'ROMANIA','code'=>'40'),
    'RS'=>array('name'=>'SERBIA','code'=>'381'),
    'RU'=>array('name'=>'RUSSIAN FEDERATION','code'=>'7'),
    'RW'=>array('name'=>'RWANDA','code'=>'250'),
    'SB'=>array('name'=>'SOLOMON ISLANDS','code'=>'677'),
    'SC'=>array('name'=>'SEYCHELLES','code'=>'248'),
    'SD'=>array('name'=>'SUDAN','code'=>'249'),
    'SE'=>array('name'=>'SWEDEN','code'=>'46'),
    'SG'=>array('name'=>'SINGAPORE','code'=>'65'),
    'SH'=>array('name'=>'SAINT HELENA','code'=>'290'),
    'SI'=>array('name'=>'SLOVENIA','code'=>'386'),
    'SK'=>array('name'=>'SLOVAKIA','code'=>'421'),
    'SL'=>array('name'=>'SIERRA LEONE','code'=>'232'),
    'SM'=>array('name'=>'SAN MARINO','code'=>'378'),
    'SN'=>array('name'=>'SENEGAL','code'=>'221'),
    'SO'=>array('name'=>'SOMALIA','code'=>'252'),
    'SR'=>array('name'=>'SURINAME','code'=>'597'),
    'ST'=>array('name'=>'SAO TOME AND PRINCIPE','code'=>'239'),
    'SV'=>array('name'=>'EL SALVADOR','code'=>'503'),
    'SY'=>array('name'=>'SYRIAN ARAB REPUBLIC','code'=>'963'),
    'SZ'=>array('name'=>'SWAZILAND','code'=>'268'),
    'TC'=>array('name'=>'TURKS AND CAICOS ISLANDS','code'=>'1649'),
    'TD'=>array('name'=>'CHAD','code'=>'235'),
    'TG'=>array('name'=>'TOGO','code'=>'228'),
    'TH'=>array('name'=>'THAILAND','code'=>'66'),
    'TJ'=>array('name'=>'TAJIKISTAN','code'=>'992'),
    'TK'=>array('name'=>'TOKELAU','code'=>'690'),
    'TL'=>array('name'=>'TIMOR-LESTE','code'=>'670'),
    'TM'=>array('name'=>'TURKMENISTAN','code'=>'993'),
    'TN'=>array('name'=>'TUNISIA','code'=>'216'),
    'TO'=>array('name'=>'TONGA','code'=>'676'),
    'TT'=>array('name'=>'TRINIDAD AND TOBAGO','code'=>'1868'),
    'TV'=>array('name'=>'TUVALU','code'=>'688'),
    'TW'=>array('name'=>'TAIWAN, PROVINCE OF CHINA','code'=>'886'),
    'TZ'=>array('name'=>'TANZANIA, UNITED REPUBLIC OF','code'=>'255'),
    'UA'=>array('name'=>'UKRAINE','code'=>'380'),
    'UG'=>array('name'=>'UGANDA','code'=>'256'),
    'US'=>array('name'=>'UNITED STATES','code'=>'1'),
    'UY'=>array('name'=>'URUGUAY','code'=>'598'),
    'UZ'=>array('name'=>'UZBEKISTAN','code'=>'998'),
    'VA'=>array('name'=>'HOLY SEE (VATICAN CITY STATE)','code'=>'39'),
    'VC'=>array('name'=>'SAINT VINCENT AND THE GRENADINES','code'=>'1784'),
    'VE'=>array('name'=>'VENEZUELA','code'=>'58'),
    'VG'=>array('name'=>'VIRGIN ISLANDS, BRITISH','code'=>'1284'),
    'VI'=>array('name'=>'VIRGIN ISLANDS, U.S.','code'=>'1340'),
    'VN'=>array('name'=>'VIET NAM','code'=>'84'),
    'VU'=>array('name'=>'VANUATU','code'=>'678'),
    'WF'=>array('name'=>'WALLIS AND FUTUNA','code'=>'681'),
    'WS'=>array('name'=>'SAMOA','code'=>'685'),
    'XK'=>array('name'=>'KOSOVO','code'=>'381'),
    'YE'=>array('name'=>'YEMEN','code'=>'967'),
    'YT'=>array('name'=>'MAYOTTE','code'=>'262'),
    'ZA'=>array('name'=>'SOUTH AFRICA','code'=>'27'),
    'ZM'=>array('name'=>'ZAMBIA','code'=>'260'),
    'ZW'=>array('name'=>'ZIMBABWE','code'=>'263')
  );
}
function wc_get_countries() {
		$countries = array(
			'' => __('-- Select country --' , 'countries'),
		'AF' => __( 'Afghanistan', 'countries' ),
		'AL' => __( 'Albania', 'countries' ),
		'DZ' => __( 'Algeria', 'countries' ),
		'AS' => __( 'American Samoa', 'countries' ),
		'AD' => __( 'Andorra', 'countries' ),
		'AO' => __( 'Angola', 'countries' ),
		'AI' => __( 'Anguilla', 'countries' ),
		'AQ' => __( 'Antarctica', 'countries' ),
		'AG' => __( 'Antigua and Barbuda', 'countries' ),
		'AR' => __( 'Argentina', 'countries' ),
		'AM' => __( 'Armenia', 'countries' ),
		'AW' => __( 'Aruba', 'countries' ),
		'AU' => __( 'Australia', 'countries' ),
		'AT' => __( 'Austria', 'countries' ),
		'AZ' => __( 'Azerbaijan', 'countries' ),
		'BS' => __( 'Bahamas', 'countries' ),
		'BH' => __( 'Bahrain', 'countries' ),
		'BD' => __( 'Bangladesh', 'countries' ),
		'BB' => __( 'Barbados', 'countries' ),
		'BY' => __( 'Belarus', 'countries' ),
		'BE' => __( 'Belgium', 'countries' ),
		'BZ' => __( 'Belize', 'countries' ),
		'BJ' => __( 'Benin', 'countries' ),
		'BM' => __( 'Bermuda', 'countries' ),
		'BT' => __( 'Bhutan', 'countries' ),
		'BO' => __( 'Bolivia', 'countries' ),
		'BA' => __( 'Bosnia and Herzegovina', 'countries' ),
		'BW' => __( 'Botswana', 'countries' ),
		'BV' => __( 'Bouvet Island', 'countries' ),
		'BR' => __( 'Brazil', 'countries' ),
		'BQ' => __( 'British Antarctic Territory', 'countries' ),
		'IO' => __( 'British Indian Ocean Territory', 'countries' ),
		'VG' => __( 'British Virgin Islands', 'countries' ),
		'BN' => __( 'Brunei', 'countries' ),
		'BG' => __( 'Bulgaria', 'countries' ),
		'BF' => __( 'Burkina Faso', 'countries' ),
		'BI' => __( 'Burundi', 'countries' ),
		'KH' => __( 'Cambodia', 'countries' ),
		'CM' => __( 'Cameroon', 'countries' ),
		'CA' => __( 'Canada', 'countries' ),
		'CT' => __( 'Canton and Enderbury Islands', 'countries' ),
		'CV' => __( 'Cape Verde', 'countries' ),
		'KY' => __( 'Cayman Islands', 'countries' ),
		'CF' => __( 'Central African Republic', 'countries' ),
		'TD' => __( 'Chad', 'countries' ),
		'CL' => __( 'Chile', 'countries' ),
		'CN' => __( 'China', 'countries' ),
		'CX' => __( 'Christmas Island', 'countries' ),
		'CC' => __( 'Cocos [Keeling] Islands', 'countries' ),
		'CO' => __( 'Colombia', 'countries' ),
		'KM' => __( 'Comoros', 'countries' ),
		'CG' => __( 'Congo - Brazzaville', 'countries' ),
		'CD' => __( 'Congo - Kinshasa', 'countries' ),
		'CK' => __( 'Cook Islands', 'countries' ),
		'CR' => __( 'Costa Rica', 'countries' ),
		'HR' => __( 'Croatia', 'countries' ),
		'CU' => __( 'Cuba', 'countries' ),
		'CY' => __( 'Cyprus', 'countries' ),
		'CZ' => __( 'Czech Republic', 'countries' ),
		'CI' => __( 'Côte d’Ivoire', 'countries' ),
		'DK' => __( 'Denmark', 'countries' ),
		'DJ' => __( 'Djibouti', 'countries' ),
		'DM' => __( 'Dominica', 'countries' ),
		'DO' => __( 'Dominican Republic', 'countries' ),
		'NQ' => __( 'Dronning Maud Land', 'countries' ),
		'DD' => __( 'East Germany', 'countries' ),
		'EC' => __( 'Ecuador', 'countries' ),
		'EG' => __( 'Egypt', 'countries' ),
		'SV' => __( 'El Salvador', 'countries' ),
		'GQ' => __( 'Equatorial Guinea', 'countries' ),
		'ER' => __( 'Eritrea', 'countries' ),
		'EE' => __( 'Estonia', 'countries' ),
		'ET' => __( 'Ethiopia', 'countries' ),
		'FK' => __( 'Falkland Islands', 'countries' ),
		'FO' => __( 'Faroe Islands', 'countries' ),
		'FJ' => __( 'Fiji', 'countries' ),
		'FI' => __( 'Finland', 'countries' ),
		'FR' => __( 'France', 'countries' ),
		'GF' => __( 'French Guiana', 'countries' ),
		'PF' => __( 'French Polynesia', 'countries' ),
		'TF' => __( 'French Southern Territories', 'countries' ),
		'FQ' => __( 'French Southern and Antarctic Territories', 'countries' ),
		'GA' => __( 'Gabon', 'countries' ),
		'GM' => __( 'Gambia', 'countries' ),
		'GE' => __( 'Georgia', 'countries' ),
		'DE' => __( 'Germany', 'countries' ),
		'GH' => __( 'Ghana', 'countries' ),
		'GI' => __( 'Gibraltar', 'countries' ),
		'GR' => __( 'Greece', 'countries' ),
		'GL' => __( 'Greenland', 'countries' ),
		'GD' => __( 'Grenada', 'countries' ),
		'GP' => __( 'Guadeloupe', 'countries' ),
		'GU' => __( 'Guam', 'countries' ),
		'GT' => __( 'Guatemala', 'countries' ),
		'GG' => __( 'Guernsey', 'countries' ),
		'GN' => __( 'Guinea', 'countries' ),
		'GW' => __( 'Guinea-Bissau', 'countries' ),
		'GY' => __( 'Guyana', 'countries' ),
		'HT' => __( 'Haiti', 'countries' ),
		'HM' => __( 'Heard Island and McDonald Islands', 'countries' ),
		'HN' => __( 'Honduras', 'countries' ),
		'HK' => __( 'Hong Kong SAR China', 'countries' ),
		'HU' => __( 'Hungary', 'countries' ),
		'IS' => __( 'Iceland', 'countries' ),
		'IN' => __( 'India', 'countries' ),
		'ID' => __( 'Indonesia', 'countries' ),
		'IR' => __( 'Iran', 'countries' ),
		'IQ' => __( 'Iraq', 'countries' ),
		'IE' => __( 'Ireland', 'countries' ),
		'IM' => __( 'Isle of Man', 'countries' ),
		'IL' => __( 'Israel', 'countries' ),
		'IT' => __( 'Italy', 'countries' ),
		'JM' => __( 'Jamaica', 'countries' ),
		'JP' => __( 'Japan', 'countries' ),
		'JE' => __( 'Jersey', 'countries' ),
		'JT' => __( 'Johnston Island', 'countries' ),
		'JO' => __( 'Jordan', 'countries' ),
		'KZ' => __( 'Kazakhstan', 'countries' ),
		'KE' => __( 'Kenya', 'countries' ),
		'KI' => __( 'Kiribati', 'countries' ),
		'KW' => __( 'Kuwait', 'countries' ),
		'KG' => __( 'Kyrgyzstan', 'countries' ),
		'LA' => __( 'Laos', 'countries' ),
		'LV' => __( 'Latvia', 'countries' ),
		'LB' => __( 'Lebanon', 'countries' ),
		'LS' => __( 'Lesotho', 'countries' ),
		'LR' => __( 'Liberia', 'countries' ),
		'LY' => __( 'Libya', 'countries' ),
		'LI' => __( 'Liechtenstein', 'countries' ),
		'LT' => __( 'Lithuania', 'countries' ),
		'LU' => __( 'Luxembourg', 'countries' ),
		'MO' => __( 'Macau SAR China', 'countries' ),
		'MK' => __( 'Macedonia', 'countries' ),
		'MG' => __( 'Madagascar', 'countries' ),
		'MW' => __( 'Malawi', 'countries' ),
		'MY' => __( 'Malaysia', 'countries' ),
		'MV' => __( 'Maldives', 'countries' ),
		'ML' => __( 'Mali', 'countries' ),
		'MT' => __( 'Malta', 'countries' ),
		'MH' => __( 'Marshall Islands', 'countries' ),
		'MQ' => __( 'Martinique', 'countries' ),
		'MR' => __( 'Mauritania', 'countries' ),
		'MU' => __( 'Mauritius', 'countries' ),
		'YT' => __( 'Mayotte', 'countries' ),
		'FX' => __( 'Metropolitan France', 'countries' ),
		'MX' => __( 'Mexico', 'countries' ),
		'FM' => __( 'Micronesia', 'countries' ),
		'MI' => __( 'Midway Islands', 'countries' ),
		'MD' => __( 'Moldova', 'countries' ),
		'MC' => __( 'Monaco', 'countries' ),
		'MN' => __( 'Mongolia', 'countries' ),
		'ME' => __( 'Montenegro', 'countries' ),
		'MS' => __( 'Montserrat', 'countries' ),
		'MA' => __( 'Morocco', 'countries' ),
		'MZ' => __( 'Mozambique', 'countries' ),
		'MM' => __( 'Myanmar [Burma]', 'countries' ),
		'NA' => __( 'Namibia', 'countries' ),
		'NR' => __( 'Nauru', 'countries' ),
		'NP' => __( 'Nepal', 'countries' ),
		'NL' => __( 'Netherlands', 'countries' ),
		'AN' => __( 'Netherlands Antilles', 'countries' ),
		'NT' => __( 'Neutral Zone', 'countries' ),
		'NC' => __( 'New Caledonia', 'countries' ),
		'NZ' => __( 'New Zealand', 'countries' ),
		'NI' => __( 'Nicaragua', 'countries' ),
		'NE' => __( 'Niger', 'countries' ),
		'NG' => __( 'Nigeria', 'countries' ),
		'NU' => __( 'Niue', 'countries' ),
		'NF' => __( 'Norfolk Island', 'countries' ),
		'KP' => __( 'North Korea', 'countries' ),
		'VD' => __( 'North Vietnam', 'countries' ),
		'MP' => __( 'Northern Mariana Islands', 'countries' ),
		'NO' => __( 'Norway', 'countries' ),
		'OM' => __( 'Oman', 'countries' ),
		'PC' => __( 'Pacific Islands Trust Territory', 'countries' ),
		'PK' => __( 'Pakistan', 'countries' ),
		'PW' => __( 'Palau', 'countries' ),
		'PS' => __( 'Palestinian Territories', 'countries' ),
		'PA' => __( 'Panama', 'countries' ),
		'PZ' => __( 'Panama Canal Zone', 'countries' ),
		'PG' => __( 'Papua New Guinea', 'countries' ),
		'PY' => __( 'Paraguay', 'countries' ),
		'YD' => __( 'People\'s Democratic Republic of Yemen', 'countries' ),
		'PE' => __( 'Peru', 'countries' ),
		'PH' => __( 'Philippines', 'countries' ),
		'PN' => __( 'Pitcairn Islands', 'countries' ),
		'PL' => __( 'Poland', 'countries' ),
		'PT' => __( 'Portugal', 'countries' ),
		'PR' => __( 'Puerto Rico', 'countries' ),
		'QA' => __( 'Qatar', 'countries' ),
		'RO' => __( 'Romania', 'countries' ),
		'RU' => __( 'Russia', 'countries' ),
		'RW' => __( 'Rwanda', 'countries' ),
		'RE' => __( 'Réunion', 'countries' ),
		'BL' => __( 'Saint Barthélemy', 'countries' ),
		'SH' => __( 'Saint Helena', 'countries' ),
		'KN' => __( 'Saint Kitts and Nevis', 'countries' ),
		'LC' => __( 'Saint Lucia', 'countries' ),
		'MF' => __( 'Saint Martin', 'countries' ),
		'PM' => __( 'Saint Pierre and Miquelon', 'countries' ),
		'VC' => __( 'Saint Vincent and the Grenadines', 'countries' ),
		'WS' => __( 'Samoa', 'countries' ),
		'SM' => __( 'San Marino', 'countries' ),
		'SA' => __( 'Saudi Arabia', 'countries' ),
		'SN' => __( 'Senegal', 'countries' ),
		'RS' => __( 'Serbia', 'countries' ),
		'CS' => __( 'Serbia and Montenegro', 'countries' ),
		'SC' => __( 'Seychelles', 'countries' ),
		'SL' => __( 'Sierra Leone', 'countries' ),
		'SG' => __( 'Singapore', 'countries' ),
		'SK' => __( 'Slovakia', 'countries' ),
		'SI' => __( 'Slovenia', 'countries' ),
		'SB' => __( 'Solomon Islands', 'countries' ),
		'SO' => __( 'Somalia', 'countries' ),
		'ZA' => __( 'South Africa', 'countries' ),
		'GS' => __( 'South Georgia and the South Sandwich Islands', 'countries' ),
		'KR' => __( 'South Korea', 'countries' ),
		'ES' => __( 'Spain', 'countries' ),
		'LK' => __( 'Sri Lanka', 'countries' ),
		'SD' => __( 'Sudan', 'countries' ),
		'SR' => __( 'Suriname', 'countries' ),
		'SJ' => __( 'Svalbard and Jan Mayen', 'countries' ),
		'SZ' => __( 'Swaziland', 'countries' ),
		'SE' => __( 'Sweden', 'countries' ),
		'CH' => __( 'Switzerland', 'countries' ),
		'SY' => __( 'Syria', 'countries' ),
		'ST' => __( 'São Tomé and Príncipe', 'countries' ),
		'TW' => __( 'Taiwan', 'countries' ),
		'TJ' => __( 'Tajikistan', 'countries' ),
		'TZ' => __( 'Tanzania', 'countries' ),
		'TH' => __( 'Thailand', 'countries' ),
		'TL' => __( 'Timor-Leste', 'countries' ),
		'TG' => __( 'Togo', 'countries' ),
		'TK' => __( 'Tokelau', 'countries' ),
		'TO' => __( 'Tonga', 'countries' ),
		'TT' => __( 'Trinidad and Tobago', 'countries' ),
		'TN' => __( 'Tunisia', 'countries' ),
		'TR' => __( 'Turkey', 'countries' ),
		'TM' => __( 'Turkmenistan', 'countries' ),
		'TC' => __( 'Turks and Caicos Islands', 'countries' ),
		'TV' => __( 'Tuvalu', 'countries' ),
		'UM' => __( 'U.S. Minor Oucountriesying Islands', 'countries' ),
		'PU' => __( 'U.S. Miscellaneous Pacific Islands', 'countries' ),
		'VI' => __( 'U.S. Virgin Islands', 'countries' ),
		'UG' => __( 'Uganda', 'countries' ),
		'UA' => __( 'Ukraine', 'countries' ),
		'SU' => __( 'Union of Soviet Socialist Republics', 'countries' ),
		'AE' => __( 'United Arab Emirates', 'countries' ),
		'GB' => __( 'United Kingdom', 'countries' ),
		'US' => __( 'United States', 'countries' ),
		'ZZ' => __( 'Unknown or Invalid Region', 'countries' ),
		'UY' => __( 'Uruguay', 'countries' ),
		'UZ' => __( 'Uzbekistan', 'countries' ),
		'VU' => __( 'Vanuatu', 'countries' ),
		'VA' => __( 'Vatican City', 'countries' ),
		'VE' => __( 'Venezuela', 'countries' ),
		'VN' => __( 'Vietnam', 'countries' ),
		'WK' => __( 'Wake Island', 'countries' ),
		'WF' => __( 'Wallis and Futuna', 'countries' ),
		'EH' => __( 'Western Sahara', 'countries' ),
		'YE' => __( 'Yemen', 'countries' ),
		'ZM' => __( 'Zambia', 'countries' ),
		'ZW' => __( 'Zimbabwe', 'countries' ),
		'AX' => __( 'Åland Islands', 'countries' ),
		);
		$countries = apply_filters( 'wc_countries', $countries );
		return $countries;
}
function phone_key_selector($name ='' , $classes ='', $selected =''){
  $countryArray = wc_get_phone_keys();
  $output = "<select id='".$name."'  name='".$name."' class='".$classes."'>";

	foreach($countryArray as $code => $country){
		if($country["code"] == $selected){
			$output .= "<option value='".$country["code"]."' selected > +".$country["code"]."</option>";
		}else{
			$output .= "<option value='".$country["code"]."' > +".$country["code"]."</option>";
		}
	}

	$output .= "</select>";

	return $output; // or echo $output; to print directly
}
function countries_names_selector($name ='' , $classes ='', $selected =''){
  $countryArray = WC()->countries->get_allowed_countries();
  $output = "<select id='".$name."' name='".$name."' class='".$classes."'>";

	foreach($countryArray as $code => $country){
        if($code == $selected){
          $output .= "<option value='".$code."' selected > ".$country."</option>";
        }else{
          $output .= "<option value='".$code."' > ".$country."</option>";
        }
	     }

  	$output .= "</select>";

  	return $output;
    }
function get_country_by_code($find_code){
	$countryArray = wc_get_countries();
	return $countryArray[$find_code];
}

function fill_vendor_cities($name ='' , $classes ='', $selected ='') {
	// connect with aramex API
	$location_wsdl_file = get_stylesheet_directory_uri() . '/aramex/Location-API -WSDL.wsdl';
	$cities_soap = new SoapClient($location_wsdl_file);
	$countries = WC()->countries->get_allowed_countries();
	$cities[''] = array();
	foreach ( $countries as $code => $country ) {
		$fetch_cities_array = array(
		'ClientInfo'=> array(
									'AccountCountryCode'		=> 'JO',
									'AccountEntity'		 	=> 'AMM',
									'AccountNumber'		 	=> '20016',
									'AccountPin'		 	=> '331421',
									'UserName'			=> 'testingapi@aramex.com',
									'Password'		 	=> 'R123456789$r',
									'Version'		 	=> 'v1.0',
									'Source' 			=> NULL
								),
		'Transaction'=> array(
									'Reference1'			=> '',
									'Reference2'			=> '',
									'Reference3'			=> '',
									'Reference4'			=> '',
									'Reference5'			=> ''),
		'CountryCode'			=> 'SA',
		'State'				=> NULL
		);
		$fetch_cities = $cities_soap->FetchCities($fetch_cities_array);
		$cities = $fetch_cities->Cities->string;
	}

  	$output = "<select id='".$name."' name='".$name."' class='".$classes."'>";

	foreach($cities as $code => $city){
        if($code == $selected){
          $output .= "<option value='".$city."' selected > ".__($city,'city')."</option>";
        }else{
          $output .= "<option value='".$city."' > ".__($city,'city')."</option>";
        }
	}

  	$output .= "</select>";

  	return $output;
}
// ############################################################################################

function get_vendor_meta_data(){
	$vendor_fields = array(
		'first_name'  => 'first_name', //owner
		'last_name'  => 'last_name',
		'_vendor_bank_name'  => 'vendor_bank_name',
		'_vendor_bank_account_number'  => 'vendor_bank_account_number',
		'_vendor_iban'  => 'vendor_iban',
		'_vendor_company'  => 'vendor_company',
		'_vendor_phone_key'  => 'vendor_phone_key',
		'_vendor_phone'  => 'vendor_phone',
		'_id-crn'  => 'id-crn',
		'_vendor_commercial_ID_input'  => 'vendor_commercial_ID_input',
		'_vendor_country' => 'vendor_country',// shipping
		'_vendor_city'  => 'vendor_city',
		'_vendor_address_1'  => 'vendor_address_1',
		'_vendor_resp_fname'  => 'vendor_resp_fname', // responsible
		'_vendor_resp_lname'  => 'vendor_resp_lname',
		'_vendor_resp_email'  => 'vendor_resp_email',
		'_vendor_resp_phone_key'  => 'vendor_resp_phone_key',
		'_vendor_resp_phone'  => 'vendor_resp_phone',
		'_vendor_customer_email'  => 'vendor_customer_email', // return
		'_vendor_customer_phone_key'  => 'vendor_customer_phone_key',
		'_vendor_customer_phone'  => 'vendor_customer_phone',
		'_vendor_csd_return_country' => 'vendor_csd_return_country' ,
		'_vendor_csd_return_city'  => 'vendor_csd_return_city',
		'_vendor_csd_return_address1'  => 'vendor_csd_return_address1',
		'relationship_manager_ID' => 'relationship_manager_ID',
		'relationship_manager_name' => 'relationship_manager_name',
		'relationship_manager_email' => 'relationship_manager_email',
		'relationship_manager_phone' => 'relationship_manager_phone',
		);

	return $vendor_fields;

}
// save vendor data when he create or edit his info
function save_vendor_data($user_id, $form , $santi){
	$vendor_fields = get_vendor_meta_data();
	foreach( $vendor_fields as $key => $field ) {
		if( isset( $form[$field] ) ) {
			if($santi == 1){
				update_user_meta($user_id, $key, sanitize_text_field($form[$field]));
			}else{
				update_user_meta($user_id, $key, $form[$field]);
			}
		}
	}
}

// ############################################################################################
// disallow wordpress link from frontend
add_filter('wcfm_allow_wp_admin_view', 'disallow_wp_admin_view' ,500);
function disallow_wp_admin_view(){
  return false;
}

// ############################################################################################
// remove UNLIMITED PRODUCTS label from frontend
add_filter( 'wcfm_products_limit_label', 'reset_product_limit' ,500);
function reset_product_limit($msg){
  return '';
}


// ############################################################################################
// change welcome text in vendor dashboard
function change_welcome_text($text)
	{
	$name = get_bloginfo();
	if (wcfm_is_vendor())
		{
		$name = get_user_meta(get_current_user_id() , '_vendor_page_title', true);
		}

	$text = sprintf(__('Welcome to %s Dashboard', 'wc-frontend-manager') , $name);
	return $text;
	}
add_filter('wcfm_dashboard_welcometext', 'change_welcome_text', 50);

// ############################################################################################



// ############################################################################################
// add currency and language to the vendor dashboard
add_action('wcfm_before_header_panel_item', 'vendor_dashboard_currency_language_widgets', 10);
function vendor_dashboard_currency_language_widgets()
{
	echo '<ul class="woocom lang-switcher"><li class="woo-bar-lang-switcher">' . do_shortcode('[wpml_language_switcher type="footer" flags=1 link_current=
		0 translated = 0 native = 1][/wpml_language_switcher]') . '</li>' . "\n";

	// if (is_plugin_active('woocommerce-product-price-based-on-countries/woocommerce-product-price-based-on-countries.php')) {
	// 	echo '<li>' . do_shortcode('[wcpbc_currency_switcher currency_display_style="{code}"]') . '</li>';
	// }
	echo '</ul>' . "\n";
}

/**
 * Display vendor commission amount in USD at WCMp
 * @param: post id of the commission, boolean is updated, general commission value for vendors
 * @return: void - update the commission amount to be in USD only
 * @author: Shaikhah
*/

add_action('woocommerce_order_status_processing', 'vendor_commission_amount_USD', 99);
add_action('woocommerce_order_status_completed', 'vendor_commission_amount_USD', 99);
function vendor_commission_amount_USD($order_id){
  $commission_ids = get_post_meta($order_id, '_commission_ids', true) ? get_post_meta($order_id, '_commission_ids', true) : array();
  if (!empty($commission_ids) && is_array($commission_ids)) {
    foreach ($commission_ids as $commission_id) {
      $commission_amount = get_wcmp_vendor_order_amount(array('commission_id' => $commission_id, 'order_id' => $order_id));
      $commission_amount = ($commission_amount['commission_amount'] / get_post_meta( $order_id, '_exchange_rate', true ) );
      update_post_meta($commission_id, '_commission_amount', (float) $commission_amount);
    }
  }
}

/**
 * Display prices in WCFM vendors report in USD
 * @param: gross sale, total fees, paid fees
 * @return: void
 * @author: Shaikhah
*/
add_filter( 'wcfm_vednors_gross_sales_data', 'change_gross_sales_in_WCFM', 10, 2);
function change_gross_sales_in_WCFM($gross_sale, $vendor_id) {
  $gross_sale = (float) priceToFloat($gross_sale, true) / WCPBC()->customer->exchange_rate;
  $gross_sale = priceToFloat(wc_price($gross_sale), false) . wcpbc_get_base_currency();
  return $gross_sale;
}

function change_earned_commission_in_WCFM($earned, $vendor_id, $report_for) {
  $earned = (float) priceToFloat($earned, true) / WCPBC()->customer->exchange_rate;
  $earned = priceToFloat(wc_price($earned), false) . wcpbc_get_base_currency();
  return $earned;
}
add_filter( 'wcfm_vednors_earned_commission_data', 'change_earned_commission_in_WCFM', 10, 3);

function change_received_commission_in_WCFM($received, $vendor_id, $report_for) {
  $received = (float) priceToFloat($received, true) / WCPBC()->customer->exchange_rate;
  $received = priceToFloat(wc_price($received), false) . wcpbc_get_base_currency();
  return $received;
}
add_filter( 'wcfm_vednors_received_commission_data', 'change_received_commission_in_WCFM', 10, 3);


/**
 * Convert WC_Price to regular price
 * @param: wc_price value
 * @return: regular float price
 * @Author: Shaikhah
*/
function priceToFloat($s, $all)
 {
  if ($all) {
    // remove everything except numbers and dot "."
    $s = str_replace(',', '', $s);
    $s = preg_replace("/[^0-9\.]/", "", $s);
  }
  else {
    // Remove currency symbol
    $s = preg_replace("/[^0-9\.,]/", "", $s);
  }
    return $s;
}

add_filter('wcfm_orders_args' , 'filter_orders_shipped_by_aramex');
function filter_orders_shipped_by_aramex($args){
	if(current_user_can('shipping_monitor')){
		$args['meta_key'] = 'shipping_status';
		$args['meta_value'] = 1;
	}
	return $args;
}


function approve_vendor($user_id){
	if($user_id){
			$user = new WP_User(absint($user_id));
			if($user->roles[0] === 'dc_vendor')
				return ;
			$user->set_role('dc_vendor');
			$user_dtl = get_userdata(absint($user_id));
			$email = WC()->mailer()->emails['WC_Email_Approved_New_Vendor_Account'];
			$email->trigger($user_id, $user_dtl->user_pass);

			// echo '<span>'.__('Approved Successfully' ,'sc-woocommerce-multi-vendor').'</span>';
	}
}
function reject_vendor($user_id){
	if($user_id){
			$user = new WP_User(absint($user_id));
			if($user->roles[0] === 'dc_rejected_vendor')
				return ;
			$user->set_role('dc_rejected_vendor');
			$user_dtl = get_userdata(absint($user_id));
			$email = WC()->mailer()->emails['WC_Email_Rejected_New_Vendor_Account'];
			$email->trigger($user_id, $user_dtl->user_pass);
			// echo '<span>'.__('Rejected Successfully' ,'sc-woocommerce-multi-vendor').'</span>';
	}
}

function remove_querystring_var($url, $key) {
	$url = preg_replace('/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');
	$url = substr($url, 0, -1);
	return $url;
}

add_action('after_wcfm_vendors','pending_vendor_table');


function pending_vendor_table(){
	if(isset($_GET['v_action'])){
		if($_GET['v_action'] === 'approve'){
			approve_vendor($_GET['user_id']);
		}
		if($_GET['v_action'] === 'reject'){
			reject_vendor($_GET['user_id']);
		}
	}

	// $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	// $url = remove_querystring_var($url ,'v_action');
	// $url = remove_querystring_var($url ,'user_id');
	// echo '<script type="text/javascript">location.href = "'.$url.'";</script>';

	global $WCFM;
	$args = array(
		'role__in'     => array( 'dc_pending_vendor', 'dc_rejected_vendor'),
		'orderby'      => 'login',
		'order'        => 'ASC',
		'count_total'  => false,
		'fields'       => array( 'ID', 'user_email' )
	 );
	$pending_vendors = get_users( $args );
	?>
	<div class="wcfm-clearfix"></div>
	<br>
	<div class="wcfm-container wcfm-top-element-container">
			<h2><?php _e('Pending Vendors', 'wc-frontend-manager' ); ?></h2>
	</div>

	<br>
	<div class="wcfm-container">
		<div id="wcfm_pending_vendors_listing_expander" class="wcfm-content">
			<table id="wcfm-pending-vendors" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php _e( 'Vendor ID', 'wc-frontend-manager' ); ?></th>
						<th><?php _e( 'Company', 'wc-frontend-manager' ); ?></th>
						<th><?php _e( 'Email', 'wc-frontend-manager' ); ?></th>
						<th><?php _e( 'Phone Number', 'wc-frontend-manager' ); ?></th>
						<th><?php _e( 'Action', 'wc-frontend-manager' ); ?></th>
					</tr>
				</thead>
				<?php foreach ($pending_vendors as $pending_vendor):
					$id = $pending_vendor->ID;
					$company = get_user_meta($id , '_vendor_company' , true);
					$email = $pending_vendor->user_email;
					$phone_number = get_user_meta($id , '_vendor_phone' , true);

					$id_link = '<a href="' .  get_wcfm_vendors_manage_url($id) . '" class="wcfm_dashboard_item_title">#' . esc_attr( $id ) . '</a>';
					?>
					<tr>
						<td><?php echo $id_link;?></td>
						<td><?php echo (empty($company))? '-':$company;?></td>
						<td><?php echo (empty($email))? '-':$email;?></td>
						<td><?php echo (empty($phone_number))? '-':$phone_number;?></td>
						<td>
							<a href ="?v_action=approve&user_id=<?php echo $id;?>"><i class="fa fa-check"><?php _e('Approve' , 'wc-frontend-manager');?></i></a>
						<a href ="?v_action=reject&user_id=<?php echo $id;?>"><i class="fa fa-times"><?php _e('Reject' , 'wc-frontend-manager');?></i></a>
					</td>
					</tr>
				<?php endforeach; ?>
				<tfoot>
					<tr>
						<th><?php _e( 'Vendor ID', 'wc-frontend-manager' ); ?></th>
						<th><?php _e( 'Company', 'wc-frontend-manager' ); ?></th>
						<th><?php _e( 'Email', 'wc-frontend-manager' ); ?></th>
						<th><?php _e( 'Phone Number', 'wc-frontend-manager' ); ?></th>
						<th><?php _e( 'Action', 'wc-frontend-manager' ); ?></th>
					</tr>
				</tfoot>
			</table>
			<div class="wcfm-clearfix"></div>
		</div>
	</div>

	<div class="wcfm-clearfix"></div>
	<br>
	<?php
}



// store interests
function update_vendor_commission( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
       return false;
	  update_user_meta( $user_id, '_vendor_commission_percentage' , $_POST['vendor_commission_percentage'] );
		update_user_meta( $user_id, '_vendor_commission_fixed_with_percentage_qty', $_POST['vendor_commission_fixed_with_percentage_qty'] );
		update_user_meta( $user_id, 'relationship_manager_ID', $_POST['relationship_manager_ID'] );
		update_user_meta( $user_id, 'relationship_manager_name', $_POST['relationship_manager_name'] );
		update_user_meta( $user_id, 'relationship_manager_email', $_POST['relationship_manager_email'] );
	  update_user_meta( $user_id, 'relationship_manager_phone', $_POST['relationship_manager_phone'] );
}
add_action( 'personal_options_update', 'update_vendor_commission' ,20);
add_action( 'edit_user_profile_update', 'update_vendor_commission',20 );
