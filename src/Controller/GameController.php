<?php

namespace App\Controller;

use App\Game\QuestionType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GameController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $chatsAvailable = [1 => 'Diop', 2 => 'The Gambling Club'];

        return $this->render('game/index.html.twig', [
            'chats_available' => $chatsAvailable
        ]);
    }


    /**
     * @Route("/new/{chatId}", name="new_game")
     */
    public function selectChat()
    {
        return new Response("Diop");
    }

    /**
     * @Route("/chat/{chatId}", name="chat_home")
     */
    public function chatHome()
    {
        return $this->render('game/chat-home.html.twig', [
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
