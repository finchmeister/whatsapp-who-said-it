<?php

namespace App\Application\Controller;

use App\Game\GameRunner;
use App\Game\GameConfigWhoSaidIt;
use App\Game\QuestionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/chat/{chatId}/game", requirements={"chatId"="\d+"}, name="play_game")
     */
    public function playGame(int $chatId, GameRunner $gameRunner)
    {
        $gameConfig = new GameConfigWhoSaidIt();
        $game = $gameRunner->loadGame($gameConfig);

        return new Response("Diop");
    }

    /**
     * @Route("/chat/{chatId}", requirements={"chatId"="\d+"}, name="chat_home")
     */
    public function chatHome()
    {
        return $this->render('game/chat-home.html.twig', [
        ]);
    }

    /**
     * @Route("/question")
     */
    public function question(Request $request)
    {
        // get game


        $answers = ['Jo', 'Jay', 'Charles', 'Luke', 'Rolfe'];
        $options['answers'] = $answers;
        $answerForm = $this->createForm(
            QuestionType::class,
            $answers,
            $options
        );
        $answerForm->handleRequest($request);

        if ($answerForm->isSubmitted() && $answerForm->isValid()) {
            $submittedAnswer = null;
            foreach ($answers as $answer) {
                if ($answerForm->has($answer)) {
                    if ($answerForm->get($answer)->isClicked()) {
                        $submittedAnswer = $answer;
                        break;
                    }
                }
            }
            dump($submittedAnswer);
        }


        return $this->render('game/question.html.twig', [
            'question' => 'Who put a tenner in?',
            'no_of_questions' => 10,
            'current_question_no' => 4,
            'score' => 2,
            'answer_form' => $answerForm->createView(),
        ]);
    }


}
