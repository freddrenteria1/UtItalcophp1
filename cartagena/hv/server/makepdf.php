<?php
    require("fpdf182/fpdf.php");
    //require("conectar.php");
    class PDF extends FPDF{
        function Header(){
            $this->SetFont("Arial", "", 24);
            $this->Image("somelogo.png", 1, 1);
            $this->Cell(9);
            $this->Cell(10, 2, utf8_decode("Título del documento"), 1, 1, 'C');
        }
        function Body(){
             
            $hay =  0;
            if($hay==0){
                $this->Cell(10, 3, "No hay registros que mostrar", 1, 1, 'C');
            }else{
                $this->SetFont("Arial", 'B', 14);
                $this->Ln();
                $this->SetTextColor(62, 72, 204);
                $this->Cell(7,1,"Nombre", 1, 0, 'C');
                $this->Cell(3,1,"Sexo", 1, 0, 'C');
                $this->Cell(2,1,"Edad", 1, 0, 'C');
                $this->Cell(7,1,"Correo", 1, 1, 'C');
                $this->SetFont("Arial", '', 14);
                $this->SetTextColor(0, 0, 0);
                while($stm->fetch()){
                    $nombre = utf8_decode($nombre);
                    $this->Cell(7,1,$nombre, 1, 0, 'C');
                    $this->Cell(3,1,$sexo, 1, 0, 'C');
                    $this->Cell(2,1,$edad, 1, 0, 'C');
                    $this->Cell(7,1,$correo, 1, 1, 'C');
                }
            }
               
        }
        function Footer(){
            $this->SetY(-2);
            $this->SetFont("Arial", 'I', 10);
            $this->Cell(0, 1, "Como generar archivos PDF con PHP", 0, 0, 'C');
        }
    }
    $pdf = new PDF('P', 'cm','letter');
    $pdf->SetAuthor("CableNaranja", true);
    $pdf->SetTitle("Documento PDF de prueba", true);
    $pdf->AddPage();
    $pdf->Body();
    // Encabezado del documento
    $pdf->Output();
    $pdf->Output("Documento Final.pdf", 'F');
?>