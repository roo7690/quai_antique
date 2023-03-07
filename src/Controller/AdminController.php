<?php

namespace App\Controller;

use App\Repository\HoraireController\HoraireController;
use App\Repository\User\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin',name:'Admin')]
    public function Admin(): Response
    {
        $admins=(new Admin())->getAdmins();

        return $this->render('admin/Admin.html.twig',[
            'Admin'=>$admins
        ]);
    }
}