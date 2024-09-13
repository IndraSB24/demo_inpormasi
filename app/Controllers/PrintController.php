<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class PrintController extends Controller
{
    public function index()
    {
        // IP address and port of the printer
        $printer_ip = '192.168.0.99';
        $printer_port = 9100;

        // Create a socket to connect to the printer
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false) {
            return "Failed to create socket: " . socket_strerror(socket_last_error());
        }

        // Connect to the printer
        $result = socket_connect($socket, $printer_ip, $printer_port);
        if ($result === false) {
            return "Failed to connect to printer: " . socket_strerror(socket_last_error());
        }

        // Print data to send to the printer
        $print_data = "This is a test print from PHP.";

        // Send print data to the printer
        $result = socket_write($socket, $print_data, strlen($print_data));
        if ($result === false) {
            return "Failed to send print data to printer: " . socket_strerror(socket_last_error());
        } else {
            return "Print data sent successfully.";
        }

        // Close the socket connection
        socket_close($socket);
    }
}
