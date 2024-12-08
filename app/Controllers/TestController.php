<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class TestController extends Controller
{
    public function index()
    {
        $config = [
            'hostname' => '127.0.0.1',
            'username' => 'root',
            'password' => 'alsya12345',
            'database' => 'BBQ',
            'DBDriver' => 'MySQLi',
        ];

        try {
            $conn = new \mysqli(
                $config['hostname'], 
                $config['username'], 
                $config['password'], 
                $config['database']
            );

            if ($conn->connect_error) {
                throw new \Exception("Koneksi gagal: " . $conn->connect_error);
            }

            echo "Koneksi manual berhasil!";
            $conn->close();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}