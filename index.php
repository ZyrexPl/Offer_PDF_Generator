<?php
// Włączenie autoloadera
require 'autoloader.php';

// Użycie klasy z namespace 'Offer'
use Offer\PdfGenerator;

// Sprawdzenie, czy formularz został wysłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobranie danych z formularza
    $company = array(
        'name' => $_POST['companyName'],
        'address' => $_POST['companyAddress'],
        'city' => $_POST['companyCity'],
    );
    $services = $_POST['services'];
    $guarantee = $_POST['guarantee'];
    $prices = $_POST['prices'];

    // Stworzenie obiektu PdfGenerator i wywołanie metody do generowania PDF
    $pdfGenerator = new PdfGenerator();
    $pdfGenerator->generatePDF($company, $services, $prices, $guarantee);
} else {
    // Jeśli formularz nie został wysłany, wyświetl widok z formularzem
    require 'views/form.php';
}
