<?
session_start();

#print_r($_SESSION['mealPlanArray']);

$mealPlan = $_SESSION['mealPlanArray'];

$week = $mealPlan['week_start'];


require('fpdf17/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(60,10,'Meal Plan Recipe List');
$pdf->Ln( 10 );
$pdf->SetFont('Arial','',13);
$pdf->Cell(60,10,'For the week of '.$week);
$pdf->Ln( 20 );

foreach ($mealPlan['meals'] as $meal){
	
	$pdf->SetFont('Arial','B',13);
	$pdf->Cell(60,10,$meal['cook_date'],1,0,'C');
	$pdf->Ln( 10 );
	
	foreach($meal['dishes'] as $dish){
		
		//print recipe name
		$pdf->SetFont('Arial','B',13);
		$pdf->Cell(60,10,'Name:');
		$pdf->Ln( 5 );
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(60,10,$dish['recipe_name']);
		$pdf->Ln( 8 );
		
		//print recipe cook time
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(60,10,'Cook Time:');
		$pdf->Ln( 7 );
		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(150,5,$dish['cook_time']);
		$pdf->Ln( 2 );
		
		
		$pdf->SetFont('Arial','',12);
				$pdf->Cell(60,10,'Ingredients:');
				$pdf->Ln( 9 );
		
		foreach($dish['ingredients'] as $ingredient){
				
				$pdf->SetFont('Arial','',10);
				$pdf->MultiCell(150,2,$ingredient['amount'].' '.$ingredient['units'].' of '.$ingredient['food_name']);
				$pdf->Ln( 2 );
					
		}
		
		
		//print recipe description
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(60,10,'Description:');
		$pdf->Ln( 7 );
		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(150,5,$dish['description']);
		$pdf->Ln( 2 );
		
		//print recipe instructions
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(60,10,'Instructions:');
		$pdf->Ln( 7 );
		$pdf->SetFont('Arial','',10);
		$pdf->MultiCell(150,5,$dish['instructions']);
		$pdf->Ln( 8 );
		
		
	}
	
	$pdf->Ln( 10 );
	$pdf->Cell(60,10,'-------------------------');
	$pdf->Ln( 10 );
}



$pdf->Output();

?>