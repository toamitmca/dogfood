<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Employeereport extends REST_Controller
{
    	
    function send_json($array){

      $this->output->set_content_type('application/json');
      $this->output->set_header('Cache-Control: no-cache, must-revalidate');
      $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
      echo json_encode($array);
      exit();
    }

    function empreport_post(){


         $data = json_decode(file_get_contents("php://input"), true);
         $parameter = array(   't_ReportName'         => $this->post('report_name'),
                               'n_ReportTypeId'       => $this->post('report_type'),
                               'n_Status'             => $this->post('status'),
                               'd_ClaimFrom'          => $this->post('chaim_period_form'),
                               'n_CashAdvance'        => $this->post('cash_advance'),
                               'd_ClaimTo'            => $this->post('chaim_period_to'),
                               't_ReportDesc'         => $this->post('description'),
                               'n_BusinessId'         => $this->post('n_BusinessId'),
                               'n_AdminType'          => NULL,
                               'row_id'               => NULL,
                               'act_mode'             => $this->post('act_mode'),
                               'userid'               => $this->post('userid'),
                               'b_IsVoilated'         => $this->post('b_IsVoilated'),
                               'buttonType'           => $this->post('buttonType'),
                               'grandtotal'           => $this->post('grandtotal'),
                               'n_DeptId'             => $this->post('n_DeptId'),
                               'n_policyId'           => $this->post('n_policyId'),
                               'attchment1'           =>$this->post('attchment1'),
                               'attchment2'           =>$this->post('attchment2'),
                               'attchment3'           =>$this->post('attchment3')
                            );
         
       $data = $this->supper_admin->call_procedureRow('proc_EmployeeReport', $parameter);
        
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }

    function expvoilations_post()
    {
      $data = json_decode(file_get_contents("php://input"), true);
      $parameter= array('row_id' => $this->post('row_id'),'act_mode' => $this->post('act_mode'));
      $data = $this->supper_admin->call_procedure('proc_expvoil', $parameter);
      if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

    }


     function empreportNote_post(){
     
       $data = json_decode(file_get_contents("php://input"), true);

         $parameternot = array(
                                'n_ReportId'    => $this->post('lstId'),
                                't_NoteDesc'    => $this->post('notesArray'), 
                                'businessId'    => $this->post('businessId'), 
           					            'userId'    	  => $this->post('userId'),
           					            't_Type'        => $this->post('t_Type')
							 );
         
        $data = $this->supper_admin->call_procedure('proc_EmployNotes', $parameternot);

        $data = array('asf' => 234);
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
        
      }


     function empreportmyNote_post(){
     
       $data = json_decode(file_get_contents("php://input"), true);

         $parameternot = array(
                                'p_ReportId'    => $this->post('lstId'),
                                't_NoteDesc'    => $this->post('notesArray'),
                                'businessId'    => $this->post('businessId'),
                                'userId'        => $this->post('userId'),
                                't_Type'        => $this->post('t_Type')
               );

        $data = $this->supper_admin->call_procedure('proc_EmployNotesupdate', $parameternot);

        $data = array('asf' => 234);
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

      }
      function myexpreport_post(){

       $data = json_decode(file_get_contents("php://input"), true);

         $parameterreport = array(
                                'e_Id'        => $this->post('e_Id'),
                                'act_mode'    => $this->post('act_mode'),
                                'e_UserId'    => $this->post('e_UserId'),
                              );

        $data = $this->supper_admin->call_procedure('proc_viewexprptbyuser', $parameterreport);
        //$data = array('asf' => 234);
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
        
      }
        
function expencepolicymapsave11_post(){


         $data = json_decode(file_get_contents("php://input"), true);
        
		$parameter11 = array(
								'xmlval' 	 => $this->post('xmlval'),
								'businessId' => $this->post('businessId'),
								'userId'     => $this->post('userId'),
								'n_ReportId' => $this->post('n_ReportId')
							);
         
        //$data = $this->supper_admin->call_procedureRow('proc_ExpPolicyMap', $parameter);
       $data = $this->supper_admin->call_procedureRow('proc_true_exp', $parameter11);
        
        if(!empty($data)){
            $parameter   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }



function expenseAddEdit_post(){


         $data = json_decode(file_get_contents("php://input"), true);
        
    $parameter11 = array(
                'xmlval'   => $this->post('xmlval'),
                'businessId' => $this->post('businessId'),
                'userId'     => $this->post('userId'),
                'n_ReportId' => $this->post('n_ReportId')
              );
         
        //$data = $this->supper_admin->call_procedureRow('proc_ExpPolicyMap', $parameter);
       $data = $this->supper_admin->call_procedureRow('proc_expaddupdate', $parameter11);
        
        if(!empty($data)){
            $parameter   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }



  public function empexpupdate_post(){
     $parameter = array( 'ex_id'           => $this->post('ex_id'), 
                         'ex_catval1'      => $this->post('ex_catval1'),
                         'ex_dateval1'     => $this->post('ex_dateval1'),
                         'ex_amountval1'   => $this->post('ex_amountval1'),
                         'ex_merchantval1' => $this->post('ex_merchantval1'),
                         'ex_purposeval1'  => $this->post('ex_purposeval1'),
                         'ex_reimbval1'    => $this->post('ex_reimbval1'),
                         'ex_tagval1'      => $this->post('ex_tagval1'),
                         'ex_voilaval1'    => $this->post('ex_voilaval1')
     );
      $data = $this->supper_admin->call_procedureRow('proc_singleupdateexp', $parameter);
      $data = true; 
    if($data){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }




      public function empexpupdatedetils_post(){
     $parameter = array( 'ex_id'           => $this->post('ex_id'), 
                         'ex_catval1'      => $this->post('ex_catval1'),
                         'ex_dateval1'     => $this->post('ex_dateval1'),
                         'ex_amountval1'   => $this->post('ex_amountval1'),
                         'ex_merchantval1' => $this->post('ex_merchantval1'),
                         'ex_purposeval1'  => $this->post('ex_purposeval1'),
                         'ex_reimbval1'    => $this->post('ex_reimbval1'),
                         'ex_tagval1'      => $this->post('ex_tagval1'),
                         'ex_tagval2'      => $this->post('ex_tagval2'),
                         'ex_voilaval1'    => $this->post('ex_voilaval1'),
                         'ex_city'         => $this->post('ex_city'),
                         'ex_glcode'       => $this->post('ex_glcode')

     );

      $data = $this->supper_admin->call_procedureRow('proc_singleupdatedetails', $parameter);
      $data = true; 
    if($data){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }

public function deltexp_post()
{
   $parameter = array('ex_id' => $this->post('ex_id'), 'act_mode' => $this->post('act_mode'));

    $data = $this->supper_admin->call_procedureRow('proc_deletesingle', $parameter);
    $data = true; 
    if($data){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }


    public function deltexpedit_post()
{
   $parameter = array('row_id' => $this->post('row_id'), 'act_mode' => $this->post('act_mode'));

    $data = $this->supper_admin->call_procedureRow('proc_detele', $parameter);
    $data = true; 
    if($data){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }
    public function deletereport_post(){
    	$parameter = array(
								'reportId' 	  => $this->post('reportId'),
								'userId'      => $this->post('userId'),
								'businessId'  => $this->post('businessId')
						  );
    	$data = $this->supper_admin->call_procedureRow('proc_deletereport', $parameter);
		$data = true; 
		if($data){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }

    public function cityemp_post(){
      $parameter = array('c_id'  => '', 'act_mode'    => $this->post('act_mode'));
      $data = $this->supper_admin->call_procedure('proc_viewempcity', $parameter);
       
       if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }

  public function myspndcat_post()
  {
      $parameter = array('s_id'  => '', 'act_mode'    => $this->post('act_mode'));
      $data = $this->supper_admin->call_procedure('proc_viewspndcat', $parameter);
      if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
      }else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
  }

  public function spandcatbybusid_post()
{
   $parameter = array('pol_id' => $this->post('pol_id'), 'bus_id' => $this->post('bus_id'), 'act_mode' => $this->post('act_mode'));

    $data = $this->supper_admin->call_procedure('proc_spndcatwithbusid', $parameter);
    //$data = true; 
    if($data){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }

  public function mycustomcat_post()
  {


      $parameter = array('c_id' => $this->post('c_id'), 'bus_id' => $this->post('bus_id'), 'act_mode' => $this->post('act_mode') );
      $data = $this->supper_admin->call_procedure('proc_ViewEditCustomTag', $parameter);
      if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
      }else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
  }


  public function mycurrency_post()
  {
      $parameter = array('busid' => $this->post('busid'), 'act_mode' => $this->post('act_mode') );
      $data = $this->supper_admin->call_procedureRow('proc_bussinessbybusid', $parameter);
      if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
          }
      else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

  }
  function update_empreport_post(){

         $parameter = array(   
         	                   
                               't_ReportName'         => $this->post('report_name'),
                               'n_ReportTypeId'       => $this->post('report_type'),
                               'n_Status'             => $this->post('status'),
                               'd_ClaimFrom'          => $this->post('chaim_period_form'),
                               'n_CashAdvance'        => $this->post('cash_advance'),
                               'd_ClaimTo'            => $this->post('chaim_period_to'),
                               't_ReportDesc'         => $this->post('description'),
                               'n_BusinessId'         => $this->post('n_BusinessId'),
                               'n_AdminType'          => '',
                               'row_id'               => $this->input->post('row_id'),
                               'act_mode'             => $this->post('act_mode'),
                               'userid'               => $this->post('userid'),
                               'b_IsVoilated'         => $this->post('b_IsVoilated'),
                               'buttonType'           => $this->post('buttonType'),
                               'grandtotal'           => $this->post('grandtotal'),
                               'n_DeptId'             => $this->post('n_DeptId'),
                               'n_policyId'           => $this->post('n_policyId'),
                               'attchment1'           =>$this->post('attchment1'),
                               'attchment2'           =>$this->post('attchment2'),
                               'attchment3'           =>$this->post('attchment3')
                            );
         //proc_EmployeeReport
       $data = $this->supper_admin->call_procedureRow('proc_EmployeeReport', $parameter);
        
        if(!empty($parameter)){
            $data   = $this->send_json($parameter);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }


function myexpencetravel_post()
{

       $parameter =  array( 'e_id'              => $this->post('e_id'),
                            'act_mode'          => $this->post('act_mode'),
                            'e_busid'           => $this->post('e_busid'),
                            'e_userid'          => $this->post('e_userid'),
                            'e_categoryval'     => $this->post('e_categoryval'),
                            'e_typeval'         => $this->post('e_typeval'),
                            'e_datevalval'      => $this->post('e_datevalval'),
                            'e_amountval'       => $this->post('e_amountval'), 
                            'e_distanceval'     => $this->post('e_distanceval'),
                            'e_purposeval'      => $this->post('e_purposeval'),
                            'e_cityval'         => $this->post('e_cityval'),
                            'e_gpsval'          => $this->post('e_gpsval'),
                            'e_reimbval'        => $this->post('e_reimbval'),
                            'e_glcodeval'       => $this->post('e_glcodeval'),
                            'e_tagval1'         => $this->post('e_tagval1'),
                            'e_tagval2'         => $this->post('e_tagval2'),
                            'e_Report_Id'       => $this->post('e_Report_Id'),
                            'e_violationstatus' => $this->post('e_violationstatus'),
                            'e_othercityval'    => $this->post('e_othercityval')
                           
                           );
  $data = $this->supper_admin->call_procedure('pro_addeditexpshe', $parameter);
       if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
       }else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
}//END MYEXPENCETARVEL



function myexpencelodging_post()
{

       $parameter =  array( 'e_id'              => $this->post('e_id'),
                            'act_mode'          => $this->post('act_mode'),
                            'e_busid'           => $this->post('e_busid'),
                            'e_userid'          => $this->post('e_userid'),
                            'e_categoryval'     => $this->post('e_categoryval'),
                            'e_typeval'         => $this->post('e_typeval'),
                            'e_datevalval'      => $this->post('e_datevalval'),
                            'e_amountval'       => $this->post('e_amountval'), 
                            'e_hotelval'        => $this->post('e_hotelval'),
                            'e_purposeval'      => $this->post('e_purposeval'),
                            'e_bookingval'      => $this->post('e_bookingval'),
                            'e_cityval'         => $this->post('e_cityval'),
                            'e_checkinval'      => $this->post('e_checkinval'),
                            'e_checkoutval'     => $this->post('e_checkoutval'),
                            'e_gpsval'          => $this->post('e_gpsval'),
                            'e_reimbval'        => $this->post('e_reimbval'),
                            'e_glcodeval'       => $this->post('e_glcodeval'),
                            'e_tagval1'         => $this->post('e_tagval1'),
                            'e_tagval2'         => $this->post('e_tagval2'),
                            'e_Report_Id'       => $this->post('e_Report_Id'),
                            'e_violationstatus' => $this->post('e_violationstatus'),
                            'e_othercityval'    => $this->post('e_othercityval')
                           
                           );
   $data = $this->supper_admin->call_procedureRow('pro_addeditexplodshe', $parameter);
       if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
       }else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
}//END MYLOAD EXPENCE

function mytAirTravelExpences_post()
{

       $parameter =  array( 'e_id'              => $this->post('e_id'),
                            'act_mode'          => $this->post('act_mode'),
                            'e_busid'           => $this->post('e_busid'),
                            'e_userid'          => $this->post('e_userid'),
                            'e_categoryval'     => $this->post('e_categoryval'),
                            'e_typeval'         => $this->post('e_typeval'),
                            'e_datevalval'      => $this->post('e_datevalval'),
                            'e_amountval'       => $this->post('e_amountval'), 
                            'e_carrierval'      => $this->post('e_carrierval'),
                            'e_purposeval'      => $this->post('e_purposeval'),
                            'e_bookingval'      => $this->post('e_bookingval'),
                            'e_cityval'         => $this->post('e_cityval'),
                            'e_startval'        => $this->post('e_startval'),
                            'e_endval'          => $this->post('e_endval'),
                            'e_gpsval'          => $this->post('e_gpsval'),
                            'e_reimbval'        => $this->post('e_reimbval'),
                            'e_glcodeval'       => $this->post('e_glcodeval'),
                            'e_tagval1'         => $this->post('e_tagval1'),
                            'e_tagval2'         => $this->post('e_tagval2'),
                            'e_Report_Id'       => $this->post('e_Report_Id'),
                            'e_violationstatus' => $this->post('e_violationstatus'),
                            'e_othercityval'    => $this->post('e_othercityval'),
                            'e_fromval'         => $this->post('e_fromval'),
                            'e_toval'           => $this->post('e_toval')
                           
                           );
      $data = $this->supper_admin->call_procedure('pro_addeditexpairshe', $parameter);
       if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
       }else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
}//END MYEXPENCEAIRTARVEL



     

}