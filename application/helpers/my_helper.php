<?php

	function p($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}

	function pend($data){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		die();
	}


	function checklogin(){
		$CI =& get_instance();
		$sessionVar = $CI->session->userdata('sessionData');
		return $sessionVar;
	}

	function businesschecklogin(){
		$CI =& get_instance();
		$sessionVar = $CI->session->userdata('sessionData');
		return $sessionVar;
	}



	function curlcall($parameters, $path){
				$apiUrl = $path; 
			   	$curl_handle = curl_init();
			   	curl_setopt($curl_handle, CURLOPT_URL, $apiUrl);
			   	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER,true);
			   	curl_setopt($curl_handle, CURLOPT_POST, true);
			   	curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $parameters);
			   	$response = curl_exec($curl_handle);
			   	curl_close($curl_handle);
   				return $response = json_decode($response);
	}
	

	function curlget($myurl){
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $myurl,
		    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		// Send the request & save response to $resp
		$response = curl_exec($curl);
		return $response = json_decode($response);
		// Close request to clear up some resources
		curl_close($curl);
	}


	if (!function_exists('fun_global')) {
		function fun_global($procname, $params = null) {
			$ci = &get_instance();
			$ci->load->model('supper_admin');
			$result = $ci->supper_admin->call_procedure("$procname", $params);
			return $result;
		}
	}


if (!function_exists('country')) {
	function country($text, $val22, $postId) {
		$parameter = array(
							'countryName' => '',
							//'d_CreatedOn' => '',
							'id'          => '',
							'act_mode'    => 'select',
							'createdBy'   => '',
							//'modifiedOn'  => '',
							//'modifiedBy'  =>  '',
							'active'      =>  '1',
							'businessId'  =>  '',
							'adminUser'   =>  ''
							);
		$country = fun_global('proc_countryManage', $parameter);
		$options = array();
		if ($text == 'list') {
			$options[''] = '---Select Country---';
			foreach ($country as $list) {
				$options[$list->a_CountryId] = $list->t_CountryName;
			}
			$AddClass = "class='country".$postId."'";
			$rcountry = '<select '.$AddClass.'onchange="return getstate('.$postId.');" name="n_CountryId_'.$postId.'" id="country">';

			foreach ($options AS $key => $value2) {
				//echo $key.',';

				if ($val22 == $key) {
					
					$rcountry .= '<option value="'.$key.'" selected >'.$value2.'</option>';
				} else {
					$rcountry .= '<option value="'.$key.'" >'.$value2.'</option>';
				}
			}
			$rcountry .= '</select>';

		} else {
			$options[''] = '';
			foreach ($country as $list) {
				$options[$list->country_id] = $list->country;
			}

			$rcountry = $options[$text];
		}
		return $rcountry;
	}
}




if (!function_exists('policy')) {
	function policy($text, $val22, $postId) {


        $CI =& get_instance();
		$sessionVar = $CI->session->userdata('sessionData');
		//print_r($sessionVar);
      
         if(isset($sessionVar['n_BusinessId']))
		 {
		    $Id = $sessionVar['n_BusinessId'];
		 }
		 else 
		 {
		 	$Id = $postId;
		 }
		$parameter = array(
							'act_mode'     => 'allview',
							'busid'       =>  $Id,
						    
							);
		$policy = fun_global('proc_ViewPolicy', $parameter);

		$options = array();
		if ($text == 'list') {
			$options[''] = '---Select Policy---';
			foreach ($policy as $list) {
				$options[$list->a_PolicyId] = $list->t_PolicyName;
			}
			$AddClass = "class='policy".$postId."'";
			$rpolicy = '<select '.$AddClass.' name="policy" id="policy">';

			foreach ($options AS $key => $value2) {
				//echo $key.',';

				if ($val22 == $key) {
					
					$rpolicy .= '<option value="'.$key.'" selected >'.$value2.'</option>';
				} else {
					$rpolicy .= '<option value="'.$key.'" >'.$value2.'</option>';
				}
			}
			$rpolicy .= '</select>';

		} else {
			$options[''] = '';
			foreach ($policy as $list) {
				$options[$list->a_PolicyId] = $list->t_PolicyName;
			}

			$rpolicy = $options[$text];
		}
		return $rpolicy;
	}
}
    
    if (!function_exists('department')) {
	function department($text, $val22, $postId) {
	     $CI =& get_instance();
		 $sessionVar = $CI->session->userdata('sessionData');
		 if(isset($sessionVar['n_BusinessId']))
		 {
		    $Id = $sessionVar['n_BusinessId'];
		 }
		 else 
		 {
		 	$Id = $postId;
		 }
	     
		 $parameter = array(
							'act_mode'     => 'viewdep',
							'busid'       => $Id,
						    
							);
		$department = fun_global('proc_ViewPolicy', $parameter);

		$options = array();
		if ($text == 'list') {
			$options[''] = '---Select Department---';
			foreach ($department as $list) {
				$options[$list->a_DeptId] = $list->t_DeptName;
			}
			$AddClass = "class='department".$postId."'";
			$rdepartment = '<select '.$AddClass.' name="department" id="department">';

			foreach ($options AS $key => $value2) {
				//echo $key.',';

				if ($val22 == $key) {
					
					$rdepartment .= '<option value="'.$key.'" selected >'.$value2.'</option>';
				} else {
					$rdepartment .= '<option value="'.$key.'" >'.$value2.'</option>';
				}
			}
			$rdepartment .= '</select>';

		} else {
			$options[''] = '';
			foreach ($department as $list) {
				$options[$list->a_DeptId] = $list->t_DeptName;
			}

			$rdepartment = $options[$text];
		}
		return $rdepartment;
	}
}
                                                     
                                                 


if (!function_exists('currency')) {
	function currency() {
		$parameter = array('Active' => '1');
		$currency = fun_global('proc_currencyList', $parameter); 
		$options = array();
		$options[''] = '---Select Currency---';
		echo '<select name="n_CurrencyId">';
		echo $options[''];
		foreach ($currency as $list) {
			echo '<option '.$list->a_CurrencyId.'>'.$list->t_CurrencyName.'</option>';					
		}
		echo '<select>';
	}
}
	function sendmail($to, $subject, $message){
        $CI =& get_instance();
        $CI->load->library('email');
        $CI->email->set_newline("\r\n");
        $CI->email->from('elite@mindztechnology.com', 'Tru Expense');
        $CI->email->to($to);
        $CI->email->subject($subject);
        $CI->email->message($message);
        $CI->email->send();     
        return $CI->email->print_debugger();   
    }



    function mymenu($type){
    	$CI  =& get_instance();
    	$parameter = array(
        					't_menunane'   => '',
        					't_url'        => '',
                            'type'   	   => $type,
                            'p_mode'       => 'pselect'
                         );
    	$return  = fun_global('proc_menu', $parameter);	
        $menu    = ""; 
    	$menu   .= "<ul>";
    	$baseUrl = base_url();
    	foreach ($return as $key => $value) {
    		$menu .= '<li><a href="'.$baseUrl.$value->t_url.'">'.$value->t_menuname.'</a></li>';
    	}
    	$menu    .= "</ul>";
    	//$menu = current_url();

    	//echo base_url(uri_string());
    	echo  $menu; 

    }


     if (!function_exists('billing')) {
	function billing($text, $val22, $postId) {
	     $CI =& get_instance();
		 $sessionVar = $CI->session->userdata('sessionData');

	   //  $Id = $sessionVar['n_BusinessId'];
		 $parameter = array(
							'act_mode'     => 'viewbill',
							'busid'        => 0,
						    
							);
		$billing = fun_global('proc_ViewPolicy', $parameter);

		$options = array();
		if ($text == 'list') {
			$options[''] = '---Select  Billing Type---';
			foreach ($billing as $list) {
				$options[$list->a_SettingId] = $list->t_SettingValue;
			}
			$AddClass = "class='n_BillingType".$postId."'";
			$rbilling = '<select '.$AddClass.' name="n_BillingType" id="n_BillingType">';

			foreach ($options AS $key => $value2) {
				//echo $key.',';

				if ($val22 == $key) {
					
					$rbilling .= '<option value="'.$key.'" selected >'.$value2.'</option>';
				} else {
					$rbilling .= '<option value="'.$key.'" >'.$value2.'</option>';
				}
			}
			$rbilling .= '</select>';

		} else {
			$options[''] = '';
			foreach ($billing as $list) {
				$options[$list->a_SettingId] = $list->t_SettingValue;
			}

			$rbilling = $options[$text];
		}
		return $rbilling;
	}
}
   

     if (!function_exists('package')) {
	function package($text, $val22, $postId) {
	     $CI =& get_instance();
		 $sessionVar = $CI->session->userdata('sessionData');

	   //  $Id = $sessionVar['n_BusinessId'];
		 $parameter = array(
							'act_mode'     => 'viewpack',
							'busid'        => 0,
						    
							);
		$package = fun_global('proc_ViewPolicy', $parameter);

		$options = array();
		if ($text == 'list') {
			$options[''] = '---Select  Package ---';
			foreach ($package as $list) {
				$options[$list->a_SettingId] = $list->t_SettingValue;
			}
			$AddClass = "class='BillingPackage".$postId."'";
			$rpackage = '<select '.$AddClass.' name="BillingPackage" id="BillingPackage">';

			foreach ($options AS $key => $value2) {
				//echo $key.',';

				if ($val22 == $key) {
					
					$rpackage .= '<option value="'.$key.'" selected >'.$value2.'</option>';
				} else {
					$rpackage .= '<option value="'.$key.'" >'.$value2.'</option>';
				}
			}
			$rpackage .= '</select>';

		} else {
			$options[''] = '';
			foreach ($package as $list) {
				$options[$list->a_SettingId] = $list->t_SettingValue;
			}

			$rpackage = $options[$text];
		}
		return $rpackage;
	}
}
   
   if (!function_exists('distance')) {
	function distance($text, $val22, $postId) {
	     $CI =& get_instance();
		 $sessionVar = $CI->session->userdata('sessionData');

	   //  $Id = $sessionVar['n_BusinessId'];
		 $parameter = array(
							'act_mode'     => 'viewdist',
							'busid'        => 0,
						    
							);
		$distance = fun_global('proc_ViewPolicy', $parameter);

		$options = array();
		if ($text == 'list') {
			$options[''] = '---Select  Distance ---';
			foreach ($distance as $list) {
				$options[$list->a_SettingId] = $list->t_SettingValue;
			}
			$AddClass = "class='n_Distance".$postId."'";
			$rdistance = '<select '.$AddClass.' name="n_Distance" id="n_Distance">';

			foreach ($options AS $key => $value2) {
				//echo $key.',';

				if ($val22 == $key) {
					
					$rdistance .= '<option value="'.$key.'" selected >'.$value2.'</option>';
				} else {
					$rdistance .= '<option value="'.$key.'" >'.$value2.'</option>';
				}
			}
			$rdistance .= '</select>';

		} else {
			$options[''] = '';
			foreach ($distance as $list) {
				$options[$list->a_SettingId] = $list->t_SettingValue;
			}

			$rdistance = $options[$text];
		}
		return $rdistance;
	}
}
   



  //

//     function mymenu1($type){
  //   	$CI  =& get_instance();
  //   	$sessionVar = $CI->session->userdata('roleAccess');
  //   	echo $sessionVar['Manage Employees'];
  //   	print_r($sessionVar);


  //   	$parameter = array(
  //       					't_menunane'   => '',
  //       					't_url'        => '',
  //                           'type'   	   => $type,
  //                           'p_mode'       => 'pselect'
  //                        );


  //   	$return  = fun_global('proc_menu', $parameter);	
  //   	$menu    = array(); 
    	
  //   	$baseUrl = base_url();
  //       if ($sessionVar['Manage Employees']=='yes')  {
	 //        $menu    .= "<ul>";
	 //    	foreach ($return as $key => $value) {
	 //    		$menu .= '<li><a href="'.$baseUrl.$value->t_url.'">'.$value->t_menuname.'</a></li>';
	 //    	}
	 //    	$menu    .= "</ul>";
	 //    	echo  $menu; 
	 //    }else{
	 //    	 $menu    .= "<ul>";
	 //    	 foreach ($return as $key => $value) {
	 //    		if($value->t_menuname!='Employees'){
	 //    			$arr[]=$value->t_menuname;
	 //    		}else{
	 //    			//$menu .= '<li><a href="'.$baseUrl.$value->t_url.'">'.$value->t_menuname.'</a></li>';
	 //    	 	}
	 //    	//$menu    .= "</ul>";
	 //    	//echo  $menu; 
	 //    	//}
 	// 	}

 	// 	for($i=0; $i<=count($arr);$i++)
 	// 	{
	 // 		echo $arr[$i];


	 // 		//$menu .= '<li><a href="'.$baseUrl.$value->t_url.'">'.$value->t_menuname.'</a></li>';
	    	 	
	 //    	//$menu    .= "</ul>";
	 //    	//echo  $menu; 
	 //    	//}
	 // 		//exit();
	 // 	}
 	// 	}
 	// }


// ########################### SHEETESH WORK START FROM HERE 24 NOV ######################

if (!function_exists('currencyMyList')) {
	function currencyMyList( $text , $value) {
	     $parameter = array('Active' => '1');
		$currency = fun_global('proc_currencyList', $parameter); 

		$options = array();
		if ($text == 'list') {
			$options[''] = '---Select Currency---';
			foreach ($currency as $list) {
				$options[$list->a_CurrencyId] = $list->t_CurrencyName;
			}
			
			$rcurrency = '<select name="n_CurrencyId" id="n_CurrencyId">';

			foreach ($options AS $key => $value2) {
				//echo $key.',';

				if ($value == $key) {
					
					$rcurrency .= '<option value="'.$key.'" selected >'.$value2.'</option>';
				} else {
					$rcurrency .= '<option value="'.$key.'" >'.$value2.'</option>';
				}
			}
			$rcurrency .= '</select>';

		} else {
			$options[''] = '';
			foreach ($currency as $list) {
				$options[$list->a_CurrencyId] = $list->t_CurrencyName;
			}

			$rcurrency = $options[$text];
		}
		return $rcurrency;
	}
}


//############################ SHEETESH WORK END HERE 24 NOV #############################


 
 ?>