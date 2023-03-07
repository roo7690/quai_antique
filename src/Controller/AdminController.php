<?php

namespace App\Controller;

use App\Repository\HoraireController\HoraireController;
use App\Repository\User\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController {

    public function Admin(): Response{

        $admins=(new Admin())->getAdmins();

        if(isset($_GET['chgHour'])){
            (new HoraireController)->changeCreneaux();
        }

        return $this->render('Administration/Admin.html.twig',[
            'Admin'=>$admins
        ]);
    }
}