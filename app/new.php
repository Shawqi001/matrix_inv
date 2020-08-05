<?php
 require_once('../includes/load.php');
 
  $pdf= new pdf ('p','mm','a4');
  $pdf->AddPage();
 $pdf->Output();
 
 
 $pdf->SetFont('Arial','B',14);
 
?>