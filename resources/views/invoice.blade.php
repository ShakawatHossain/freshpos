<?php
require_once './public/dompdf/autoload.inc.php';

$name = "Shakawat Hossain";
$age = "23";
$sex = "Male";
$lab_id = "lab-789";
$date = "2020-08-31";
$phn = "01987665";
$adds = "Dhaka, Bangladesh";
$cls_id ="Class ID";
$ref = "IEDCR";


$coll_site = $date;
$mail_address = "Email";
$spec = "Specimen";
$spec_date = $date;
$test_name = "Real Time PCR for SARS-CoV-2.";
$comments = "Please correlate clinically";
$result = "Positive";
$result.= " for  SARS-CoV-2 (COVID-19).";

use Dompdf\Dompdf;

//initialize dompdf class

$document = new Dompdf();

$html = '
<table width="100%">
  <tr>
    <td><img src="bdgov.png" alt="BD GOVT" height="80" width="80"/><td>
    <td><center>
      <p>Government of the People\'s Republic of Bangladesh
      <br/>
      Institute of Epidemiology, Disease Control &amp; Research
      <br/>
      Mohakhali, Dhaka-1212, Bangladesh</p>
    </center></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>

    <td><img src="iedcr.jpg" alt="BD GOVT" height="60" width="60"/></td>
  </tr>
</table>
<center><h1>Laboratory Test Report</h1></center>
<br/>
<hr/>
';
$html .='
<table width="100%">
  <tr>
  <td colspan="3">Lab ID: '.$lab_id.' '.$cls_id.'</td>
  <td>Date: '.$date.'</td>
  </tr>
  <tr>
  <td colspan="2">Patient\'s name: '.$name.'</td>
  <td>Age: '.$age.'</td>
  <td>Sex: '.$sex.'</td>
  </tr>
  <tr>
    <td colspan="2">Phone no: '.$phn.'</td>
    <td colspan="2">Email: '.$mail_address.'</td>
  </tr>
  <tr>
    <td colspan="2">Address: '.$adds.'</td>
    <td colspan="2">Specimen colletion Site: '.$coll_site.'</td>
  </tr>
  <tr>
    <td colspan="2">Specimen : '.$spec.'</td>
    <td colspan="2">Specimen Collection Date: '.$spec_date.'</td>
    
  </tr>
  <tr>
    <td colspan="3">Test Performed: '.$test_name.'</td>
    <td>Referred BY: '.$ref.'</td>
  </tr>
</table>
<hr/>
<center><h1>Result</h1></center>
<br/>
<p><strong>Result:</strong> '.$result.'</p>
<br/>
<p><strong>Comments:</strong> '.$comments.'</p>
<br/>
<br/>
<br/>
<br/>
<br/>
<table>
<tr>
<td>
<hr/>
<center>Head of the Department of Virology</center>
<td>
<td>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td>
<td>
<hr/>
<center>Director, IEDCR</center>
</td>
<tr/>
<table>
';


$document->loadHtml($html);
$document->setPaper('A4', 'portrait');
$document->render();
$document->stream("COVID-19 report", array("Attachment"=>0));


?>
