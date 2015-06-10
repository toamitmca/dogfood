<?php

function mymenu1($type){
    	$CI  =& get_instance();
    	$sessionVar = $CI->session->userdata('roleAccess');
    	echo $sessionVar['Manage Employees'];
    	print_r($sessionVar);


    	$parameter = array(
        					't_menunane'   => '',
        					't_url'        => '',
                            'type'   	   => $type,
                            'p_mode'       => 'pselect'
                         );


    	$return  = fun_global('proc_menu', $parameter);	
    	$menu    = array(); 
    	
    	$baseUrl = base_url();
	        if ($sessionVar['Manage Employees']=='yes' && $sessionVar['Manage Admins']=='yes')  {
		        $menu    .= "<ul>";
		    	foreach ($return as $key => $value) {
		    		$menu .= '<li><a href="'.$baseUrl.$value->t_url.'">'.$value->t_menuname.'</a></li>';
		    	}
		    	$menu    .= "</ul>";
		    	echo  $menu; 


		    }else  if ($sessionVar['Manage Employees']=='No' && $sessionVar['Manage Admins']=='yes')  {
		    	 //$menu    .= "<ul>";
		    foreach ($return as $key => $value) {
		    if($value->t_menuname!='Employees' ){
		    $arr[]=$value->t_menuname;
		    $arrurl[]=$value->t_url;
		    		}
		    	}
	     $menu    .= "<ul>";
	 		for($i=0; $i<count($arr);$i++)
	 		{
		 		 


		 		$menu .= '<li><a href="'.$baseUrl.$arrurl[$i].'">'.$arr[$i].'</a></li>';
		    	 	}
		    	$menu    .= "</ul>";
		    	
		    	//}
		 		//exit();
		 	
		 	echo  $menu; 
	 		}
else  if ($sessionVar['Manage Employees']=='yes' && $sessionVar['Manage Admins']=='No')  {
		    	 //$menu    .= "<ul>";
		    foreach ($return as $key => $value) {
		    if($value->t_menuname!='Admins' ){
		    $arr[]=$value->t_menuname;
		    $arrurl[]=$value->t_url;
		    
		    		}
		    	}
	     $menu    .= "<ul>";
	 		for($i=0; $i<count($arr);$i++)
	 		{
		 		 


		 		$menu .= '<li><a href="'.$baseUrl.$arrurl[$i].'">'.$arr[$i].'</a></li>';
		    	 	}
		    	$menu    .= "</ul>";
		    	
		    	//}
		 		//exit();
		 	
		 	echo  $menu; 
	 		}
	 		else  if ($sessionVar['Manage Employees']=='No' && $sessionVar['Manage Admins']=='No')  {
		    	 //$menu    .= "<ul>";
		    foreach ($return as $key => $value) {
		    if($value->t_menuname!='Employees' && $value->t_menuname!='Admins' ){
		    $arr[]=$value->t_menuname;
		    
		    
$arrurl[]=$value->t_url;
		   

		    		}
		    	}
	     $menu    .= "<ul>";
	 		for($i=0; $i<count($arr);$i++)
	 		{
		 		 


		 		$menu .= '<li><a href="'.$baseUrl.$arrurl[$i].'">'.$arr[$i].'</a></li>';
		    	 	}
		    	$menu    .= "</ul>";
		    	
		    	//}
		 		//exit();
		 	
		 	echo  $menu; 
	 		}





	 	}
 
 ?>