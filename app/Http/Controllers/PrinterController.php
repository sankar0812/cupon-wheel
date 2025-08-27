<?php

namespace App\Http\Controllers;

use Mike42\Escpos\Printer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class PrinterController extends Controller
{
    public function index()
    {
        try {
            // Specify the correct printer port, e.g., "COM1" for a physical printer
            $printerPort = "COM1";
        
            // Attempt to connect to the printer
            $connector = new WindowsPrintConnector($printerPort);
            $printer = new Printer($connector);
        
            // Print the test message
            $printer->text("This is a test print from PHP/Laravel.\n");
        
            // Cut the paper (if supported by the printer)
            $printer->cut();
        
            // Close the printer connection
            $printer->close();
        
            return "Print job sent successfully.";
        } catch (\Exception $e) {
            // Handle any exceptions that occur during printing
            return "Failed to print: " . $e->getMessage();
        }
    }

    public function view()
{
    return view('superadmin.print');

}
    
}
