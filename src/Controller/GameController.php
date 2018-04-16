<?php

namespace App\Controller;

use App\Game\QuestionType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GameController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }

    /**
     * @Route("/question")
     */
    public function question()
    {
        $answerForm = $this->createForm(QuestionType::class);

        return $this->render('game/question.html.twig', [
            'question' => 'Who put a tenner in?',
            'no_of_questions' => 10,
            'current_question_no' => 4,
            'score' => 2,
            'answer_form' => $answerForm,
        ]);
    }


}
