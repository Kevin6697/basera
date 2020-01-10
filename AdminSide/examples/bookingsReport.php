<?php
	require_once '../../fpdf/fpdf.php';
	include 'controller.php';
    class PDF extends FPDF
    {
		// Page header
					
	    function Header()
	    {
	    	$dbConnection = new Controller();
			$y = 102;
	        $this->SetFont('Arial', '', 12);
            
                $this->SetFont('Arial','B',10);    
    
    //lines and table header
        $this->Line(10,50,200,50,50,50);//header mainline
        $this->Text(10,55,'Sr.',1,0,'C');
        $this->Text(16,55,'Customer Name',1,0,'C');

        $this->Text(72,55,'House Name',1,0,'C');
        //$this->Text(73,55,'Owner Name',1,0,'C');
        $this->Text(119,55,'Check In',1,0,'C');
        $this->Text(138,55,'Check Out',1,0,'C');
        $this->Text(159,55,'Paid Amt.',1,0,'C');
        $this->Text(181,55,'Price',1,0,'C');


        $this->Line(10,58,200,58,50,50);//table headerline 1           
        $this->Line(10,50,10,260,0);//first line
        $this->Line(15,50,15,254,0);//sr
    $this->Line(45,50,45,254,0);//customer name

    $this->Line(117,50,117,254,0);//house name
        //$this->Line(100,50,100,254,0);//owner name
        //$this->Line(125,42,125,254,0);//service
        $this->Line(137,50,137,254,0);//check in
       $this->Line(157,50,157,260,0);//check out

        $this->Line(179,50,179,260,0);//paid amount
        $this->Line(200,50,200,260,0);//total house price

        $this->Line(10,254,200,254,50,50);//footerline border
        $this->Line(10,260,200,260,50,50);//footerline border

        $y=56;
    $i=0;
    $paidTotal=0;
    $grandTotal=0;
    $this->SetFont('Arial','',12);
    $result=$dbConnection->allBookings();    
    while($rows= (mysqli_fetch_assoc($result)))
        {
            $i=$i+1;
            $y=$y+6;
            $toatalHousePrice=0;
            //$aid = $rows['ap_id'];
            $cid = $rows['BookingId'];
            $name = $rows['CustFirstName']." ".$rows['CustLastName'];
            $houseName = $rows['HouseName'];
            $checkIn=$rows['CheckInDate'];
            $checkOut=$rows['CheckOutDate'];
            $adPayment=$rows['AdvancePayment'];
            $totalHousePrice=($rows['AdvancePayment']+$rows['DuePayment']);

            //  $service = $rows['gender'];

            $this->SetFontSize(8);
                $this->SetTextColor(0,0,0);
            
                $this->SetXY (11,$y);
                $this->Write(7,$i);
            // $this->SetXY (23,$y);
            // $this->Write(7,$cid);

            $this->SetXY (16,$y);
                $this->Write(7,$name);
                $this->SetXY (46,$y);
                $this->Write(7,$houseName);
            $this->SetXY (119,$y);
            $this->Write(7,$checkIn);


            $this->SetFontSize(8);
            $this->SetXY (139,$y);
            $this->Write(7,$checkOut);
                $this->SetXY (159,$y);
                $this->Write(7,$adPayment);

                $this->SetXY (180,$y);
                $this->Write(7,$totalHousePrice);

                $this->Ln();
                


               $paidTotal=$paidTotal+$adPayment;  
               $grandTotal=$grandTotal+$totalHousePrice;
        }
                $this->SetFont('Arial','B',12);    
                
                $this->SetXY (139,254);
                $this->Write(7,'Total:');
                $this->SetXY (159,254);
                $this->Write(7,$paidTotal);
                $this->SetXY (180,254);
                $this->Write(7,$grandTotal);
    

        // Logo
        $this->Image('../../HostSide/images/icon-ups-drinks.png', 10, 5, 30, 20);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 18);

        // Move to the right
        // Title
        $this->Text(14, 30, 'Basera', 10, 0, 'C');

         //table header
        $this->SetFont('Arial', 'B', 16);
        $this->Text(80, 45, 'Bookings Report', 1, 0, 'C');
        //$this->Text(65, 90, 'House Name : ', 1, 0, 'C');
        //$this->Text(105, 90, $housename, 1, 0, 'C');
        //lines
        $this->SetLineWidth(0.5);

        // date
        $this->SetFont('Arial', 'B', 12);
        $this->Text(125, 10, 'Date:', 10);
        date_default_timezone_set('Asia/Calcutta');
        $this->Text(136, 10, date('Y-m-d H:i:s'), 10);
        // $this->Line(125, 12, 200, 12, 50, 50);

        //mob and email
        $this->Text(125, 18, 'MO: 8200285930', 20);
        $this->Text(125, 26, 'Email: basera.support@gmail.com', 25);

        $this->Ln(20,20);
        $this->Line(10, 35, 200, 35, 50, 50);

	    }
	    function Footer()
	    {
	        // Position at 1.5 cm from bottom
	        $this->SetY(-50);
	        // Arial italic 8
	        $this->SetFont('Arial', 'U', 'B', 8);
	        // $this->Ln(20,20);
	        //lines
	        $this->SetLineWidth(0.5);
	        // $this->Line(10, 260, 200, 260, 10, 10);
	        //$this->Cell(0,10, 'THANK YOU FOR TRAVELING WITH BASERA! WE LOOK FORWARD TO SERVE YOU AGAIN!',0, 0, 'C');
	    }
	 }
  	$pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times', '', 12);
   	$pdf->Output();	
	// return"Success";
 ?>   