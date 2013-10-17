<?php

if(!function_exists('translate'))
{
 function translate($kata, $id = 'ina')
 {
 $id = (empty($id)) ? 'ina' : $id;	
 $ci = & get_instance();
 $ci->lang->load($id, $id);
 $jawaban = $ci->lang->line($kata);
 return $jawaban;
 }
}

?>