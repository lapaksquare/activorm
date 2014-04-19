<?php 

class S_summary_model extends CI_Model{
   
   function getProfitPerWeek( $members = '', $month = 0, $year = 0 ) {   
      $sql = "
         SELECT
            id,
            name,
            sum(price) as profit,
            week
         FROM(
            SELECT
               ma.account_id as id,
               ma.account_name as name,
               ocd.order_total_price as price,
               CEIL(DAY(op.payment_date)/7) as "week"
            FROM
               sales__rel_responsibility srr
               JOIN member__account ma ON srr.account_id = ma.account_id 
               JOIN order__cart oc ON srr.account_id = oc.account_id
                  AND order_status = 'completed'
               JOIN order__cart_detail ocd ON oc.order_id = ocd.order_id
               JOIN order__payment op ON oc.order_id = op.order_id
                  AND op.payment_amount >= oc.order_total_price
            WHERE
               srr.sales_id IN(
                  ?
               )
               AND MONTH(op.payment_date) = ?
               AND YEAR(op.payment_date) = ?
         ) a
         GROUP BY id, name, week
         ORDER BY id ASC, week ASC
      ";
      
      $m = $members;
      if( is_array( $members ) ) $m = explode( ',' , array($members );
      
      $res = $this->db->query($sql, $m)->result();
      $arr = array();
      
      foreach($res as $r){
         $arr[] = array(
            'id'  => $r->id,
            'name' => $r->name,
            'profit' => $r->profit,
            'week' => $r-> week
         );
      }
   }
   
}

?>