<?php 

class Ajax extends CI_Controller {
	
   function isAuthorized(){
      $account = $this->session->userdata('account_sales');
   
      if( $this->input->post('ajax') == 'activormsales' && !empty( $account ) ) return true;
   
      return false;
   }
   
	function getSummary(){
      $res = false;
      
      if( $this->isAuthorized() ){
         $type = $this->input->post('type');
         
         if( $type === 'week' ) {
            $members = $this->input->post('members');
            $month = $this->input->post('month');
            $year = $this->input->post('year');
            
            if( $month !== false && $year !== false ) {
               $this->load->model('s_summary_model', 'summary');
               
               $res = $this->summary->getProfitPerWeek( $members, $month, $year );
            }
         }
      }
      
      echo json_encode($res);
   }
	
}

?>