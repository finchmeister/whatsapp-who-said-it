<?php

namespace App\Application\Controller;

use App\Application\Game\CreateNewGameService;
use App\Application\Game\GameService;
use App\Domain\Chat\ChatId;
use App\Game\GameRunner;
use App\Game\GameConfigWhoSaidIt;
use App\Game\QuestionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Router;

class GameController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        if (getenv('APP_ENV') === 'prod') {
            return new Response('Under Construction');
        }

        $chatsAvailable = [1 => 'Diop', 2 => 'The Gambling Club'];

        return $this->render('game/index.html.twig', [
            'chats_available' => $chatsAvailable
        ]);
    }

    /**
     * @Route("/chat/{chatId}", name="chat_home")
     */
    public function chatHome(string $chatId)
    {
        // Get stats etc

        $newGameUrl = $this->generateUrl('play_game', ['chatId' => $chatId, 'new' => 'true']);

        return $this->render('game/chat-home.html.twig', [
            'chat_id' => $chatId,
            'new_game_url' => $newGameUrl,
        ]);
    }

    /**
     * @Route("/chat/{chatUuid}/play", name="play_game")
     */
    public function playGame(
        Request $request,
        string $chatUuid,
        CreateNewGameService $createNewGameService,
        GameService $gameService
    ) {
        $player = $this->getUser();
        $chatId = ChatId::fromString($chatUuid);
        $isNew = $request->get('new', false);
        if ($isNew) {
            // chat service
            $game = $createNewGameService->createNewGame($chatId);
        } else {
            // Find game from chatid and player id
            $game = $gameService->getGame();
        }

        // create new game

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
