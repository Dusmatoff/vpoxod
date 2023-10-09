<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    /**
     * @Route("/calculator", name="app_calculator", methods={"POST"})
     */
    public function index(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (empty($data) || !isset($data['num1'], $data['num2'], $data['operation'])) {
            return $this->json(['error' => 'Add all required parameters'], 400);
        }

        $num1 = $data['num1'];
        $num2 = $data['num2'];
        $operation = $data['operation'];

        $result = 0;

        switch ($operation) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '/':
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    return $this->json(['error' => 'Division by zero is not allowed.'], 400);
                }
                break;
            default:
                return $this->json(['error' => 'Invalid operation.'], 400);
        }

        return $this->json(['result' => $result, 'calculated' => "$num1 $operation $num2"]);
    }
}
