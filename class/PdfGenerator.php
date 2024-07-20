<?php
namespace Offer;

require_once __DIR__ . '/../vendor/fpdf/fpdf.php';

class PdfGenerator {
    public function generatePDF($company, $services, $prices) {
        // Tworzenie nowego dokumentu PDF
        $pdf = new Fpdf();
        $pdf->AddPage();

        $city = iconv('utf-8', 'iso-8859-2', 'Tarnowskie Góry ');
        $text1 = iconv('utf-8', 'iso-8859-2', 'Reprezentowaną przez DAMIAN CZERNIK z siedzibą w :');
        $text2 = iconv('utf-8', 'iso-8859-2', '42-600 Tarnowskie Góry');
        $text3 = iconv('utf-8', 'iso-8859-2', 'Zamawiający zleca ,a Wykonawca zobowiązuję się wykonać zlecenie polegające na wykonaniu: ');
        $text4 = iconv('utf-8', 'iso-8859-2', 'ul.Legionów37/2 m6');
        $text5 = iconv('utf-8', 'iso-8859-2', 'zwanym dalej Wykonawcą, a');
        $text6 = iconv('utf-8', 'iso-8859-2', 'zwanym w dalszej treści umowy Zamawiającym, została zawarta umowa o następującej treści:');
        $text7 = iconv('utf-8', 'iso-8859-2', 'Jeśli chodzi o płatność to zamawiający w dniu podpisania umowy przekazuje wykonawcy połowe');
        $text8 = iconv('utf-8', 'iso-8859-2', 'kwoty głownej t.j ');
        $text9 = iconv('utf-8', 'iso-8859-2', 'Wykonawca udziela gwarancji na okres: 24 miesiące.');
        $text10 = iconv('utf-8', 'iso-8859-2', 'W okresie gwarancji Wykonawca obowiązuje się do usunięcia wad na koszt własny w terminie do 14 dni od dnia powiadomienia o ich ujawnieniu.');

        $text11 = iconv('utf-8', 'iso-8859-2', '§1 Zamawiającemu przysługuje prawo do dochodzenia odszkodowania przewyższającego kare umowną na zasadach ogólnych.');

        $text12 = iconv('utf-8', 'iso-8859-2', '§2 Zmiany umowy wymagają formy pisemnej pod rygorem nieważności.');

        $text13 = iconv('utf-8', 'iso-8859-2', '§3 Wsprawach nie unormowanych niniejszą umowę mają zastosowanie przepisy Kodeksu cywilnego.');
        $text14 = iconv('utf-8', 'iso-8859-2', '§4 Umowę sporządzono w dwóch jednobrzmiących egzemplarzach, po jednym dla każdej ze stron.');

        $companyName = iconv('utf-8', 'iso-8859-2', $company['name']);
        $companyAddress = iconv('utf-8', 'iso-8859-2', $company['address']);
        $companyCity = iconv('utf-8', 'iso-8859-2', $company['city']);
        $sum = array_sum($prices);

        // Ustawienie czcionki
        $pdf->AddFont('sanspl', '', 'sanspl.php');
        $pdf->SetFont('sanspl', '', 11);

        $date = date('d.m.Y');
        // Dodanie tekstu "Tarnowskie Góry"
        $pdf->Cell(190, 10, $city . $date, 0, 1, 'R');

        // Dodanie obrazu
        $pdf->Image('img/logo.jpg', 10, 10, 30);

        $pdf->Ln(20); // Nowa linia
        $pdf->SetX(10);
        $pdf->Cell(40, 10, 'PRO OGRODZENIA');
        $pdf->Ln(5); // Nowa linia
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $text1);
        $pdf->Ln(5);
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $text2);
        $pdf->Ln(5);
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $text4);
        $pdf->Ln(5);
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $text5);
        $pdf->Ln(10);

        // Dodanie danych firmy
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $companyName);
        $pdf->Ln(5); // Nowa linia
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $companyAddress);
        $pdf->Ln(5);
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $companyCity);
        $pdf->Ln(7);
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $text6);
        $pdf->Ln(10);

        // Dodanie usług i cen
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $text3);
        $pdf->Ln(10); // Nowa linia
        $pdf->SetDrawColor(200, 200, 200);
        $pdf->SetFont('sanspl', '', 10);
        for ($i = 0; $i < count($services); $i++) {
            $pdf->SetX(10);
            // Usługa
            $service = iconv('utf-8', 'iso-8859-2', $services[$i]);
            $pdf->Cell(150, 10, $service, 1);
            // Cena
            $pdf->Cell(40, 10, $prices[$i] . ' PLN', 1, 1, 'R');
            $pdf->Ln(0); // Nowa linia
        }
        // Ustawienie koloru i grubości obramowania
        $pdf->SetDrawColor(150, 150, 150);
        $pdf->SetLineWidth(0.5); // Ustawienie grubości linii na 0.5 mm

        $pdf->SetFont('sanspl', '', 11);
        $pdf->SetX(10);
        $pdf->Ln(0.5);
        // Usługa
        $pdf->Cell(150, 10, 'Razem', 1);
        // Cena
        $pdf->Cell(40, 10, $sum . ' PLN', 1, 1, 'R');
        $pdf->Ln(0); // Nowa linia

        $pdf->SetX(10);
        $pdf->Cell(40, 10, $text7); 
        $pdf->Ln(5);
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $text8 . ($sum/2) . ' PLN');  
        $pdf->Ln(10);
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $text9);     
        $pdf->Ln(10);
        $pdf->SetX(10);
        $pdf->MultiCell(190, 5, $text10);  
        $pdf->SetFont('sanspl', '', 9);
        $pdf->Ln(10);
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $text11);   
        $pdf->Ln(5);
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $text12);
        $pdf->Ln(5);
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $text13);
        $pdf->Ln(5);
        $pdf->SetX(10);
        $pdf->Cell(40, 10, $text14);

        $pdf->Ln(30); // Nowa linia
        $pdf->Cell(90, 7, '...........................', 0, 0, 'L');
        $pdf->Cell(90, 7, '...........................', 0, 1, 'R');
        $pdf->Cell(90, 7, ' Zleceniodawca', 0, 0, 'L');
        $pdf->Cell(85, 7, 'Wykonawca', 0, 1, 'R');

        // Zapisanie pliku PDF
        $pdf->Output('D', 'dokument.pdf');
    }
}
