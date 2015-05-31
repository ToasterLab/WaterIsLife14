<?php
	$troll=0;
	if ($api->is_school())
	{
		$troll=0;
	}
	else
	{
		$troll=1;
	}
	require_once("fpdf/fpdf.php");
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',11);
	if (!$troll)
	{
		$pdf->Image('img/letterhead.png',10,10,210);
		$pdf->SetMargins(30, 0, 30);
		$pdf->MultiCell(0,12,"\n\n\n\n");
		$pdf->MultiCell(0,12,date("j F Y"));
		$pdf->MultiCell(0,12,"\n".$school_address);
		$pdf->MultiCell(0,12,"\nDear ".$t_name.",");
		$pdf->SetFont('Arial','B',10);
		$pdf->MultiCell(0,12,"RE - Letter of invitation, RI-Maurick International Water Conference, June 9th - 13th 2014, Singapore\n");
		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(0,12,"\nI am pleased to invite you to attend the RI-Maurick International Water Conference to be held at Raffles Institution, Singapore, from June 9th to 13th 2014. \n");
		$pdf->MultiCell(0,12,"\nPlease consider this letter as an official invitation to facilitate the processing of any visas or documents needed to enable you to attend the RI-Maurick International Water Conference. \n");
		$pdf->MultiCell(0,12,"\nThe purpose of your visit will be a scientific participation at the water conference. Accommodation, a cultural and scientific exchange program will be provided. The registration fee for the conference is SGD$350/student and SGD$500/teacher for the duration of the conference.\n");
		$pdf->AddPage(); //add page
		$pdf->MultiCell(0,12,"\n\n\nThis letter of invitation does not commit the conference organisers to any kind of financial support, nor does it guarantee an entry visa. The organisers will not be held responsible for visas that are not granted. If an entry visa is required, please allow sufficient time for this procedure.");
		$pdf->MultiCell(0,12,"\nWe look forward to welcoming you to Raffles Institution in Singapore. \n\n\n\nSincerely yours,");
		$pdf->Image('img/da_signature.png');
		$pdf->MultiCell(0,12,"Mr Wong Tze Yang\nOn behalf of the organizing committee ");
	}
	else
	{
		$pdf->MultiCell(0,10,"Dear Hacker,\n\nPlease consider this letter as an indication of your non-authorisation on this webpage.\nNote: You might see this if you take hours to fill up this form. We appologise in that case, go to waterislife2014.riicc.sg and login again\n\nBest Regards, Webmaster");
	}
	$pdf->Output("pdfs/visa_documentation_".$school_id.$id.".pdf","F");
?>