<?php 
$this->output->enable_profiler(false);
if (empty($title)) $title = 'Report ' . sha1(time().SALT);

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=" . $title . ".xls");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Expires: 0");

$this->load->view("n/excel/" . $content, $this->data);
?>