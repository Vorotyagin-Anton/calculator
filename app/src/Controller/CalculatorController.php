<?php

namespace App\Controller;

use App\Service\SimpleCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    #[Route('/', name: 'app_calculator', methods: ['GET', 'POST'])]
    public function index(Request $request, SimpleCalculator $simpleCalculator): Response
    {
        $postData = $request->request->all();

        if (isset($postData['submit'])) {
            $total = $simpleCalculator->getCalculationResult($postData);
        }

        return $this->render('calculator.twig', [
            'postData' => $postData,
            'total' => $total ?? ''
        ]);
    }
}
