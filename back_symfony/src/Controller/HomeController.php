<?php

namespace App\Controller;

use PDOException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        /*$dsn = 'mysql:host=127.0.0.1;dbname=boutiquity';
        $username = 'root';
        $password = 'password';
        try { $dbh = new \PDO($dsn, $username, $password); 
            echo "Connected successfully"; 
        } catch (PDOException $e) {
             echo 'Connection failed: ' . $e->getMessage(); 
        }*/
        //exit();
        //phpinfo();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
