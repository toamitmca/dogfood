<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Policybusiness extends REST_Controller{
   

    function send_json($array){

        $this->output->set_content_type('application/json');
        $this->output->set_header('Cache-Control: no-cache, must-revalidate');
        $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
        echo json_encode($array);
        exit();
   	 }

    function policyGeneral_post(){
		
        $data = json_decode(file_get_contents("php://input"), true);
        $parameter = array(
                              'p_mode'            => $this->post('p_mode'),
                              'p_formName'        => $this->post('p_formName'),
                              'p_PolicyId'        => $this->post('p_PolicyId'),
                              'p_PolicyName'      => $this->post('p_PolicyName'),
                              'p_MaxRptAmt'       => $this->post('p_MaxRptAmt'),
                              'd_RptDueDt'        => $this->post('d_RptDueDt'),
                              'd_RptDueDt1'       => $this->post('d_RptDueDt1'),
                              'p_MaxExpAmt'       => $this->post('p_MaxExpAmt'),
                              'p_RptDueDate'      => $this->post('p_RptDueDate'),
                              'p_CashAdvAllowed'  => $this->post('p_CashAdvAllowed'),
                              'p_RecpReq'         => $this->post('p_RecpReq'),
                              'p_AboveAmt'        => $this->post('p_AboveAmt'),
                              'p_MaxRptMilage'    => $this->post('p_MaxRptMilage'),
                              'p_MilageRate'      => $this->post('p_MilageRate'),
                              'p_PerMeasuremnt'   => $this->post('p_PerMeasuremnt'),                             
                              'p_MilRateUnitValue'=> $this->post('p_MilRateUnitValue'),
                              'p_MaxExpMil'       => $this->post('p_MaxExpMil'),
                              'p_IsGPSReq'        => $this->post('p_IsGPSReq'),
                              'p_CreatedBy'       => $this->post('p_CreatedBy'),
                              'p_MonthlyExpLmt'   => $this->post('p_MonthlyExpLmt'),
                              'p_DailyExpLmt'     => $this->post('p_DailyExpLmt'),
                              'p_ReportDueBy'     => $this->post('p_ReportDueBy'),
                              'p_flagExpSubmitted'=> $this->post('p_flagExpSubmitted'),
                              'p_BusinessId'      => $this->post('p_BusinessId'),
                              'p_AdminType'       => $this->post('p_AdminType'),
                              'p_RptDueByValue'   => $this->post('p_RptDueByValue'),
                            );
         
        $data = $this->supper_admin->call_procedureRow('proc_PolicyMaster', $parameter);
      	
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }

  function policyMileage_post(){

     $data = json_decode(file_get_contents("php://input"), true);
        $parameter = array(
                              'p_mode'            => $this->post('p_mode'),
                              'p_formName'        => $this->post('p_formName'),
                              'p_PolicyId'        => $this->post('p_PolicyId'),
                              'p_PolicyName'      => $this->post('p_PolicyName'),
                              'p_MaxRptAmt'       => $this->post('p_MaxRptAmt'),
                              'd_RptDueDt'        => $this->post('d_RptDueDt'),
                              'd_RptDueDt1'       => $this->post('d_RptDueDt1'),
                              'p_MaxExpAmt'       => $this->post('p_MaxExpAmt'),
                              'p_RptDueDate'      => $this->post('p_RptDueDate'),
                              'p_CashAdvAllowed'  => $this->post('p_CashAdvAllowed'),
                              'p_RecpReq'         => $this->post('p_RecpReq'),
                              'p_AboveAmt'        => $this->post('p_AboveAmt'),
                              'p_MaxRptMilage'    => $this->post('p_MaxRptMilage'),
                              'p_MilageRate'      => $this->post('p_MilageRate'),
                              'p_PerMeasuremnt'   => $this->post('p_PerMeasuremnt'),                             
                              'p_MilRateUnitValue'=> $this->post('p_MilRateUnitValue'),
                              'p_MaxExpMil'       => $this->post('p_MaxExpMil'),
                              'p_IsGPSReq'        => $this->post('p_IsGPSReq'),
                              'p_CreatedBy'       => $this->post('p_CreatedBy'),
                              'p_MonthlyExpLmt'   => $this->post('p_MonthlyExpLmt'),
                              'p_DailyExpLmt'     => $this->post('p_DailyExpLmt'),
                              'p_ReportDueBy'     => $this->post('p_ReportDueBy'),
                              'p_flagExpSubmitted'=> $this->post('p_flagExpSubmitted'),
                              'p_BusinessId'      => $this->post('p_BusinessId'),
                              'p_AdminType'       => $this->post('p_AdminType'),
                              'p_RptDueByValue'   => $this->post('p_RptDueByValue')
                          );
         
        $data = $this->supper_admin->call_procedureRow('proc_PolicyMaster', $parameter);
        
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
  }  


  function policyspencat_post(){

     $data = json_decode(file_get_contents("php://input"), true);
          $parameter = array(
                              'p_mode'            => $this->post('p_mode'),
                              'p_PlcyCatMapId'    => $this->post('p_PlcyCatMapId'),
                              'p_XmlDatatest'     => $this->post('p_XmlDatatest'),
                              'p_PolicyId'        => $this->post('p_PolicyId'),
                              'p_CreatedBy'       => $this->post('p_CreatedBy'),
                              'p_BusinessId'      => $this->post('p_BusinessId')
                            );
         
        $this->supper_admin->call_procedureRow('proc_PolicyCatMap', $parameter);
        $data=array('Success'=>'Success');
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
  }  

// end of class
}
