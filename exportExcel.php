<?php
error_reporting(0);
include_once('classes/ExportToExcel.class.php');
$exp = ExportToExcel ::getInstance();
//$exp=new ExportToExcel();

$qry="select * from tb_newsletter";
$exp->exportWithQuery($qry,"newsletter.xls");

//header("Location: newsletter.php");

?>