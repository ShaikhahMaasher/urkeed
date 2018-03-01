<?php if(isset($_GET['e'])){
	$csvExport = new CSVExport();
	die();

	// echo 'test 1';
}



class CSVExport

{
	public function __construct()
	{
			$csv = $this->generate_csv();
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="' . 'test.csv' . '"');
			header('Pragma: no-cache');
			header('Expires: 0');
      ob_start();
      $file = fopen("php://output", 'w');
      // Add headers to file
      $headers = array(
          'Commission',
          'Tax',
          'Total',
          'Status'
      );

      fputcsv($file, $headers);
      // Add data to file
      // foreach ($commissions_data as $commission) {
          fputcsv($file, array(
              '$recipient',
              '$currency',
              'yy',
              '$commission_staus'
          ));
      // }
      // Close file and get data from output buffer
      fclose($file);
      $csv = ob_get_clean();
      // Send CSV to browser for download
      echo $csv;
      die();
	}


	public

	function generate_csv()
	{
		$csv_output = 'Test,test,test';
		$table = 'users';
		// $result = mysql_query("SHOW COLUMNS FROM " . $table . "");
		// $i = 0;
		// if (mysql_num_rows($result) > 0) {
		// 	while ($row = mysql_fetch_assoc($result)) {
		// 		$csv_output = $csv_output . $row['Field'] . ",";
		// 		$i++;
		// 	}
		// }
    //
		// $csv_output.= "\n";
		// $values = mysql_query("SELECT * FROM " . $table . "");
		// while ($rowr = mysql_fetch_row($values)) {
		// 	for ($j = 0; $j < $i; $j++) {
		// 		$csv_output.= $rowr[$j] . ",";
		// 	}
    //
		// 	$csv_output.= "\n";
		// }

		return $csv_output;
	}
}

/*
echo 'entered the page';
// if(isset($_GET['exp'])){
  echo 'entered the isset';

global $WCFM ;
echo '( WCFM )'.$WCFM;
$wcfm_all_vendors = $WCFM->wcfm_vendor_support->wcfm_get_vendor_list( true, '', '', '' );
unset($wcfm_all_vendors[0]);

echo $wcfm_all_vendors;
pre($wcfm_all_vendors);

echo 'after the print vendors';


$new_list = array();
foreach ($wcfm_all_vendors as $id => $dispkay_name) {
  $user_info = get_userdata($id);
  $email = $user_info->user_email;

  $new_list[] = array(
    "ID" => $id ,
    "First Name" => get_user_meta($id , 'first_name' , true) ,
    "Last Name" =>  get_user_meta($id , 'last_name' , true) ,
    "Registered Email" => $email,
    "Phone" =>  get_user_meta($id , '_vendor_phone' , true),
    "Responsible Fisrt Name" =>  get_user_meta($id , '_vendor_resp_fname' , true),
    "Responsible Last Name" =>  get_user_meta($id , '_vendor_resp_lname' , true),
    "Responsible Phone" =>  get_user_meta($id , '_vendor_resp_phone' , true),
    "Responsible Email" =>  get_user_meta($id , '_vendor_resp_email' , true),
    "Company Name" => get_user_meta($id , '_vendor_company' , true)  ,
    "Bank Name" => get_user_meta($id , '_vendor_bank_name' , true) ,
    "Bank Account Name" => get_user_meta($id , '_vendor_bank_account_number' , true) ,
    "IBAN" =>  get_user_meta($id , '_vendor_iban' , true),
    "Commercial Registration Number/ ID" => get_user_meta($id , '_vendor_commercial_ID_input' , true) ,
    "Shipping Country" =>  get_user_meta($id , '_vendor_country' , true),
    "Shipping City" => get_user_meta($id , '_vendor_city' , true) ,
    "Shipping Address 1" =>  get_user_meta($id , '_vendor_address_1' , true),
    "Return Country" => get_user_meta($id , '_vendor_csd_return_country' , true) ,
    "Return City" =>  get_user_meta($id , '_vendor_csd_return_city' , true),
    "Return Address 1" =>  get_user_meta($id , '_vendor_csd_return_address1' , true),
    "Return Phone" => get_user_meta($id , '_vendor_resp_phone' , true) ,
    "Return Email" => get_user_meta($id , '_vendor_customer_email' , true) ,
    "Commission Percentage(%)" =>  get_user_meta($id , '_vendor_commission_percentage' , true),
    "Commission Fixed Per Unit" =>  get_user_meta($id , '_vendor_commission_fixed_with_percentage_qty' , true),
  );
}

// $columnHeader = "ID"."\t"."First Name"."\t"."Last Name"."\t"."Registered Email"."\t"."Phone" ."\t".
// "Responsible Fisrt Name"."\t"."Responsible Last Name" ."\t"."Responsible Phone" ."\t"."Responsible Email"
// ."\t"."Company Name" ."\t"."Bank Name" ."\t"."Bank Account Name"."\t"."IBAN" ."\t"."Commercial Registration Number/ ID"
// ."\t"."Shipping Country"."\t"."Shipping City"."\t"."Shipping Address 1"
// ."\t"."Return Country" ."\t"."Return City" ."\t"."Return Address 1" ."\t"."Return Phone" ."\t"."Return Email"
// ."\t"."Commission Percentage(%)" ."\t"."Commission Fixed Per Unit";
// echo ucwords($columnHeader)."\n".$new_list."\n";


    // function filterData(&$str)
    // {
    //     $str = preg_replace("/\t/", "\\t", $str);
    //     $str = preg_replace("/\r?\n/", "\\n", $str);
    //     if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    // }

    // file name for download
    $fileName = "codexworld_export_data" . date('Ymd') . ".xls";

    // headers for download
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Content-Type: application/vnd.ms-excel");

    $flag = false;
    foreach($new_list as $row) {
        if(!$flag) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag = true;
        }
        // filter data
        array_walk($row, 'filterData');
        echo implode("\t", array_values($row)) . "\n";

    }

  // }

  */
?>
