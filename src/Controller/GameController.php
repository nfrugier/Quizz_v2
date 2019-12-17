<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Themes;
use App\Repository\AnswerRepository;
use App\Repository\ThemesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GameController extends AbstractController
{
    /**
     * @Route("/game/{id_theme}", name="game", methods={"GET", "POST"})
     */
    public function index(ThemesRepository $themesRepository, AnswerRepository $answerRepository, Request $request, $id_theme): Response
    {

        $theme = $this->getDoctrine()->getRepository(Themes::class)->findOneBy(['id' => $id_theme]);


        return $this->render('game/index.html.twig', [
            'theme' => $theme,
        ]);
    }

    /**
     * @Route("/game/{id_theme}/{id_question}", name="question")
     */
    public function question($id_theme, $id_question)
    {
        $theme = $this->getDoctrine()->getRepository(Themes::class)->findOneBy(['id' => $id_theme]);

        $question = $this->getDoctrine()->getRepository(Question::class)->findOneBy(['id' => $id_question]);

        return $this->render('game/question.html.twig', [
            'theme' => $theme,
            'question' => $question,
        ]);
    }

    /**
     * @Route("/game{id_theme}/{id_question}/{score_question}", name="answer")
     */
    public function answer($id_theme, $id_question, $score_question)
    {
        $result = null;
        if($score_question > 0)
        {
            $result = "Bravo";
        }
        else {
            $result = "Nope !";
        }



        return $this->render('game/answer.html.twig', [
            'result' => $result,
        ]);
    }
}
