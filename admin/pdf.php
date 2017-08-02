<?php
include("../mpdf/mpdf.php");
include("../db.php");
$stylesheet = file_get_contents('../mpdf/mpdf.css');
$id='1';
$sqlm="SELECT * FROM orders WHERE order_id='$id'";
$stmt = $connection->query($sqlm);
$user  = $stmt->fetch_assoc();

$username=$user['buyer_name'];
$buyer_id=$user['buyer_id'];

$userphone=$user['phone'];
$receiptno=$user['order_id'];

$sqlmt="SELECT * FROM users WHERE id='$buyer_id'";
$stmtm = $connection->query($sqlmt);
$userm  = $stmtm->fetch_assoc();
$email=$userm['email'];




$mpdf=new mPDF('c','A4'
,12 //font-size
,'Times New Romans' //font name default family
,10 //margin_left
,10 //margin_right
,10 //margin_top
,45 //margin_bottom
,0 //margin_header
,10 //margin_footer
,'P' //potrait
);
$mpdf->AddPage();
//adding a page i.e overriding thefpdf class in mfpdf.php
$mpdf->MultiCell(190,6,"",0,'C');
$mpdf->MultiCell(190,6,"",0,'C');
$mpdf->MultiCell(190,6,"",0,'C');
$mpdf->SetFont('Times','B',20);	
$mpdf->MultiCell(190,6,"FRUITFARM",0,'C');
$mpdf->MultiCell(200,6,"",0,'C');
$mpdf->MultiCell(200,6,"",0,'C');

//$mpdf->Image("image/gok.gif",90,18,40,0,'C');
$mpdf->SetFont('Times','B',20);	
$mpdf->MultiCell(200,6,"RECEIPT ",0,'C');


$html= "'<p align='left'><b>Name.        </b>$username</p>";
$html.= "<p align='left'><b>Phone Number. </b>$userphone</p>";
$html.= "<p align='left'><b>Receipt No. </b>#$receiptno</p>";

$mpdf->setFooter('{PAGENO}');

// $mpdf->SetFont('Times','B',12);	
// $mpdf->MultiCell(200,6,"P.O. BOX 254",0,'C');
// $mpdf->SetFont('Times','B',12);	
// $mpdf->MultiCell(200,6,"Kenya",0,'C');
// $mpdf->SetHTMLFooter('
// 	<br><br><br><br><br><br>
// 	<div style=" font-size: 16px;">
// 		<div style="text-align:center;">Sign:.........................................</div>
// 		<div style="text-align:center;">(Project Manager)</div>
// 	</div>
// 	<div style="text-align:center; font-weight: bold; font-size: 12px;">Printed by: '.$usernames.' on '.date("d"."-"."M"."-"."Y")." at ".date("h:i a").' </div>
// 	<div style="text-align:center; font-weight: bold; font-size: 16px;">CIMES &copy; Copyright '. $year.' All rights reserved.</div>
// 	<div style="text-align:right; font-weight: bold; font-size: 12px;">{PAGENO} out of {nb}</div><div style="text-align: left; font-weight: bold; font-size: 12px;">'.$wardname.' Ward '.$subcountyname.' Subcounty</div>','O');
$mpdf->setAutoTopmargin="stretch";
$mpdf->watermarkImageAlpha=0.05;
// $mpdf->SetWatermarkImage("image/gok.gif",-50,"","","C");
// $mpdf->showWatermarkImage=true;
// $mpdf->watermarkTextAlpha=0.1;
// $mpdf->SetWatermarkText(strtoupper("$wardname " .$financial_year));
// $mpdf->showWatermarkText=true;
// include 'database.php';
// $status='Booked';
//  if($status=='Booked'){
// 		$state=intval('1');
// 	}
// 	if($status=='Not Booked'){
// 		$state=intval('0');
// 	}
$html.='          
  <table border="1" style="border-collapse:collapse; width: 100%;">
	<thead>
		<tr class="headerrow" >
               <th>SI. NO.</th>
               <th>Item</th>
               <th>Quantity</th>
               <th>Unit Price</th>
               <th>Total</th>
               
               
               </tr>
               </thead>';
               

$sql="SELECT * FROM order_details WHERE order_id='$id'";
$st = $connection->query($sql);
//$st->bindValue(":orderid", $id, PDO::PARAM_STR);
//$st->execute();
$sn=0;
$total1=0;

$rows = $st->num_rows;

      if ($rows>0) {

      	while($details   = $st->fetch_assoc()){
      		$item_name=$details['item_name'];
          $sn=$sn+1;
      		$Quantity=intval($details['quantity']);
          $unitPrice=intval($details['price']);
          $total=$Quantity*$unitPrice;
          $total1=$total+$total1;
      		
   
			$html.='<tr>
               <td >'.
               $sn.'
               </td>
               <td>'
               .$item_name.
               '</td>
               <td>'.
               $Quantity.
               '</td>
               <td>'
               .$unitPrice.
               '</td>
                <td>'
               .$total.
               '</td>
               </tr>';


			








} $html.='<tr>
               <td >'.
               "".'
               </td>
               <td>'
               ."".
               '</td>
               <td>'.
               "".
               '</td>
               <td>'
               ."Net Total".
               '</td>
                <td>'
               .$total1.
               '</td>
               </tr>'; }



$html.='</table>';
$html.="<p align='center'> Fruitfarm is a fruit selling website which is involved in health education on the benefits of fruits. We also partner with suppliers of the fruits to make them available to users wanting to live a more healthy life.</p>
";
  
               
              



$ffname='receipt.pdf';

$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output($ffname,'F');

function multi_attach_mail($to, $subject, $message, $senderMail, $senderName, $files){

    $from = $senderName." <".$senderMail.">"; 
    $headers = "From: $from";

    // boundary 
    $semi_rand = md5(time()); 
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

    // headers for attachment 
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

    // multipart boundary 
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 

    // preparing attachments
    if(count($files) > 0){
        for($i=0;$i<count($files);$i++){
            if(is_file($files[$i])){
                $message .= "--{$mime_boundary}\n";
                $fp =    @fopen($files[$i],"rb");
                $data =  @fread($fp,filesize($files[$i]));

                @fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"".basename($files[$i])."\"\n" . 
                "Content-Description: ".basename($files[$i])."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($files[$i])."\"; size=".filesize($files[$i]).";\n" . 
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
        }
    }

    $message .= "--{$mime_boundary}--";
    $returnpath = "-f" . $senderMail;

    //send email
    $mail = @mail($to, $subject, $message, $headers, $returnpath); 

    //function return true, if email sent, otherwise return fasle
    if($mail){ return TRUE; } else { return FALSE; }

}

//email variables
$to = $email;
$from = 'muthomimate@gmail.com';
$from_name = 'Muthomi Mate';

//attachment files path array
$files = array($ffname);
$subject = 'Receipt Confirmation'; 
$html_content = '<h1>Thanks for shopping with us</h1>
            <p><b>Total Attachments : </b>'.count($files).' attachments</p>';

//call multi_attach_mail() function and pass the required arguments
$send_email = multi_attach_mail($to,$subject,$html_content,$from,$from_name,$files);

//print message after email sent
echo $send_email?"<h1> Mail Sent</h1>":"<h1> Mail not SENT</h1>";
unlink($ffname);
?>
