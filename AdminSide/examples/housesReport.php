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
        $this->Text(29,55,'House Name',1,0,'C');

        $this->Text(75,55,'Area',1,0,'C');
        $this->Text(99,55,'City',1,0,'C');
        $this->Text(120,55,'State',1,0,'C');
        $this->Text(140,55,'Verified',1,0,'C');
       
        $this->Text(157,54,'Price',1,0,'C');
        $this->Text(157,58,'per Person',1,0,'C');
        // $this->Ln();
        $this->Text(179,55,'Base Price',1,0,'C');
        


        $this->Line(10,60,200,60,50,50);//table headerline 1           
        $this->Line(10,50,10,260,0);//first line
        $this->Line(15,50,15,254,0);//sr
    $this->Line(70,50,70,254,0);//customer name

    $this->Line(94,50,94,254,0);//area
    $this->Line(117,50,117,254,0);//city
    $this->Line(139,50,139,254,0);//state
       
       $this->Line(155,50,155,260,0);//verification
        $this->Line(177,50,177,260,0);//price per person
      
        $this->Line(200,50,200,260,0);// baseprice

        $this->Line(10,254,200,254,50,50);//footerline border
        $this->Line(10,260,200,260,50,50);//footerline border

        $y=56;
    $i=0;
    $perPersonTotal=0;
    $baseTotal=0;
    
    $this->SetFont('Arial','',12);
    $result=$dbConnection->allHouseDetails();    
    while($rows= (mysqli_fetch_assoc($result)))
        {
            $i=$i+1;
            $y=$y+6;
          
            $cid = $rows['HouseId'];
            $name = $rows['HouseName'];
            $area = $rows['AreaName'];
            $city = $rows['CityName'];
            $state = $rows['StateName'];
            $pericePerPerson=$rows['HousePricePerPerson'];
            $basePrice=$rows['HouseBasePrice'];
            $verification=$rows['IsHouseVerified'];
            // $date=$splitDateTime[0];
            $perPersonTotal+=$pericePerPerson;
            $baseTotal+=$basePrice;

            $this->SetFontSize(8);
                $this->SetTextColor(0,0,0);
            
                $this->SetXY (11,$y);
                $this->Write(7,$i);
            
            $this->SetXY (16,$y);
                $this->Write(7,$name);
                $this->SetXY (71,$y);
                $this->Write(7,$area);
                $this->SetXY (95,$y);
                $this->Write(7,$city);
                $this->SetXY (118,$y);
                $this->Write(7,$state);
                if($verification==1)
                {
                    $this->SetXY (141,$y);
                    $this->Write(7,"YES");
                    
                }
                else
                {
                    $this->SetXY (141,$y);
                    $this->Write(7,"No");   
                }
                
             $this->SetXY (157,$y);
             $this->Write(7,$pericePerPerson);


            $this->SetFontSize(8);

                $this->SetXY (180,$y);
                $this->Write(7,$basePrice);

                $this->Ln();
                


              
        }
                $this->SetFont('Arial','B',12);    
                
                $this->SetXY (139,254);
                $this->Write(7,'Total:');
                $this->SetXY (159,254);
                $this->Write(7,$perPersonTotal);
                $this->SetXY (180,254);
                $this->Write(7,$baseTotal);
    

        // Logo
        $this->Image('../../HostSide/images/icon-ups-drinks.png', 10, 5, 30, 20);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 18);

        // Move to the right
        // Title
        $this->Text(14, 30, 'Basera', 10, 0, 'C');

         //table header
        $this->SetFont('Arial', 'B', 16);
        $this->Text(80, 45, 'House Report', 1, 0, 'C');
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