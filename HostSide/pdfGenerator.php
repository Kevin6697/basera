<?php
	require_once '../fpdf/fpdf.php';
	require_once 'Host.php';
    class PDF extends FPDF
    {
		// Page header
					
	    function Header()
	    {
	    	$host = new HostController();
			$y = 102;
	        $total = 0;
	        $damagePenalty=0;
	        $this->SetFont('Arial', '', 12);

             while ($rows = mysqli_fetch_assoc($_SESSION['resultSet']))
	            {

                $y = $y + 6;
                $BookingId=$rows['BookingId'];
                $tid = $rows['TranactionId'];
                $date = $rows['CheckInDate'];
                $pm = $rows['CheckOutDate'];
                $paid = $rows['AdvancePayment'];
                $remaining=$rows['DuePayment'];
    
                $CustomerResult=$host->fetchCustomerForCheckOut($rows['CustId']);
                while ($CustomerData= mysqli_fetch_assoc($CustomerResult))
                {
                    $name = $CustomerData['CustFirstName']." ".$CustomerData['CustLastName'];
                    $cusmail = $CustomerData['CustEmail'];
                    $number = $CustomerData['CustNumber'];
                }
                $HouseResult=$host->fetchHouseForCheckOut($rows['HouseId']);
                while ($HouseData= mysqli_fetch_assoc($HouseResult))
                {
                     $ownername = $HouseData['OwnerFirstName']." ".$HouseData['OwnerLastName'];
                    $ownmail = $HouseData['OwnerEmail'];
                    $ownnumber = $HouseData['OwnerNumber'];
                
                    $housename = $HouseData['HouseName'];
                }
                $OrderResult=$host->fetchOrderForCheckOut($BookingId);
                while ($OrderData= mysqli_fetch_assoc($OrderResult))
                {
                    $isDamage=$OrderData['IsDamage'];                    
                }
                $this->SetFontSize(12);
                $this->SetTextColor(0, 0, 0);

                $this->SetXY(12, $y);
                $this->SetXY(50, $y);
                $this->Write(14, "Advanced Paid");
                $this->SetXY(12, $y);
                $this->SetXY(50, $y);
                $this->Write(35, "Remaining Amount");
                // $this->SetXY(127, $y);
                // $this->Write(7, $amt);

                // $this->SetXY(157, $y);
                // $this->Write(7, $discount);

                // $price = 10 + 0;
                $this->SetXY(185, $y);
                $this->Write(7, $paid);

                $this->SetXY(185, $y);
                $this->Write(35, $remaining);

                $this->Ln();
			}

      
        $subtotal = $paid + $remaining;
        $this->SetFont('Arial', 'B', 12);
        // $this->SetXY(130, 148);
        // $this->Write(7, 'Sub-Total : ');
        // $this->SetXY(185, 150);
        // $this->Write(7, $subtotal);

       
		if($isDamage==1)
		{
			$y2=104;
			$damageResult=$host->fetchDamageForCheckOut($BookingId);
			while ($damageData= mysqli_fetch_assoc($damageResult))
		    {
		    		// $this->Line(10,160,200,160);
		    		$this->SetFont('Arial', 'B', 12);
					$this->SetXY(12, 150);
    		    	$this->Write(7, 'Damages :');
    		    	$this->SetFont('Arial', '', 12);  
    		    	$damagePenalty=$damagePenalty+$damageData['Price'];
    		    	$y2 = $y2 +8 ;
    		    	
    		    	$this->SetXY(12, $y2);
                	$this->SetXY(50, $y2);
           //      	$this->Write(100, "Remaining Amount");


    		    	// $this->SetXY(500,$y2);
               	 	$this->Write(100, $damageData['ItemName']."  ");
               	 	$this->SetXY(-25, $y2);
        			$this->Write(100, $damageData['Price']);

		  	}
		}
       	
       	$total=$total+$subtotal+$damagePenalty;
        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(135, 212);
        $this->Write(7, 'Total:');
        $this->SetXY(185, 212);
        $this->Write(7, $total);

        // Logo
        $this->Image('images/icon-ups-drinks.png', 10, 5, 30, 20);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 18);

        // Move to the right
        // Title
        $this->Text(14, 30, 'Basera', 10, 0, 'C');

         //table header
        $this->SetFont('Arial', 'B', 16);
        $this->Text(80, 45, 'INVOICE', 1, 0, 'C');
        $this->Text(65, 90, 'House Name : ', 1, 0, 'C');
        $this->Text(105, 90, $housename, 1, 0, 'C');
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

        //$this->Ln(20,20);
        $this->Line(10, 35, 200, 35, 50, 50);

        //Details Section

        //table header
        $this->SetFont('Arial', 'B', 16);
        
        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(124, 28);
        $this->Write(7, 'Tranasction ID:');
        // $this->SetTextColor(0,0,250);
        $this->Write(7, $tid);
        $this->SetTextColor(0,0,0);
        $this->SetXY(15, 65);
        $this->Write(-20, 'Customer Name : ');
        $this->Write(-20, $name);

        $this->SetXY(15,85);
        $this->Write(-20, 'Customer Number : ');
        $this->Write(-20, $number);
       	
       	$this->SetXY(15,75);
        $this->Write(-20, 'Customer Email : ');
        $this->Write(-20, $cusmail);

         $this->SetXY(105, 65);
        $this->Write(-20, 'Owner Name : ');
        $this->Write(-20, $ownername);

        $this->SetXY(105,85);
        $this->Write(-20, 'Owner Number : ');
        $this->SetXY(134,75);
        $this->Write(-20.5, $ownmail);
		
       	$this->SetXY(105,75);
        $this->Write(-20, 'Owner Email : ');
        $this->SetXY(139, 78);
        $this->Write(-5.5, $ownnumber);
       	
        
        //table
        $this->SetFont('Arial', 'B', 10);
        $this->SetLineWidth(0.1);

        //lines and table header
        $this->Line(10, 100, 200, 100, 50, 50);//header mainline
        $this->Text(55, 105, 'DESC.', 1, 0, 'C');
                 // $this->Text(110, 105, 'QTY', 1, 0, 'C');
        // $this->Text(125, 105, 'QTY', 1, 0, 'C');
        // $this->Text(150, 105, 'DISCOUNT', 1, 0, 'C');
        $this->Text(180, 105, 'AMOUNT', 1, 0, 'C');
        /*	$this->Text(151,47,'Payment Method',1,0,'C');
            $this->Text(183,47,'Amount',1,0,'C');  */

        $this->Line(10, 106, 200, 106, 50, 50);//table headerline 1
        $this->Line(10, 100, 10, 220, 0);//first line
//            $this->Line(105, 100, 105, 254, 0);//line btw item n qty
        // $this->Line(120, 100, 120, 254, 0);//line btw QTY n PRICE
        // $this->Line(145, 100, 145, 254, 0);//line btw PRICE N DIS
        // $this->Line(175, 100, 175, 260, 0);//line btw DIS N AMT
        $this->Line(155, 100, 155, 220, 0);
        $this->Line(200, 100, 200, 220, 0);//amount

        $this->Line(10, 212, 200, 212, 50, 50);//footerline border
        $this->Line(10, 220, 200, 220, 50, 50);//footerline border
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
	        $this->Cell(0,10, 'THANK YOU FOR TRAVELING WITH BASERA! WE LOOK FORWARD TO SERVE YOU AGAIN!',0, 0, 'C');
	    }
	 }
  	// $pdf = new PDF();
    // $pdf->AliasNbPages();
    // $pdf->AddPage();
    // $pdf->SetFont('Times', '', 12);
   	// $pdf->Output();	
	// return"Success";
 ?>   