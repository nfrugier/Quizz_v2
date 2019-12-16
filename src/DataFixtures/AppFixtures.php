<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use App\Entity\Themes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;



class AppFixtures extends Fixture
{
	public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {

        // $product = new Product();
        // $manager->persist($product);
		$user=new User();
		$user->setUsername('user');
		$password = $this->encoder->encodePassword($user, '1234');
		$user->setPassword($password);
		$user->setAvatar('https://www.zooplus.fr/magazine/wp-content/uploads/2017/11/fotolia_87538728-768x512.jpg');
		$user->setScore('');
        $manager->persist($user);

        $theme = new Themes();
        $theme->setName("Test theme");
        $manager->persist($theme);

        $question1 = new Question();
        $question1->setTheme($theme);
        $question1->setSujet("est-ce vrai ? (spoiler : oui)");
        $manager->persist($question1);

        $question2 = new Question();
        $question2->setSujet('est-ce faux ? (spoiler : oui)');
        $question2->setTheme($theme);
        $manager->persist($question2);

        $answer1_1 = new Answer();
        $answer1_1->setProposition('vrai');
        $answer1_1->setQuestion($question1);
        $answer1_1->setScore(10);
        $manager->persist($answer1_1);
        $answer1_2 = new Answer();
        $answer1_2->setProposition('faux');
        $answer1_2->setQuestion($question1);
        $answer1_2->setScore(0);
        $manager->persist($answer1_2);

        $answer2_1 = new Answer();
        $answer2_1->setProposition('vrai');
        $answer2_1->setQuestion($question2);
        $answer2_1->setScore(0);
        $manager->persist($answer2_1);
        $answer2_2 = new Answer();
        $answer2_2->setProposition('faux');
        $answer2_2->setQuestion($question2);
        $answer2_2->setScore(10);
        $manager->persist($answer2_2);

		$manager->flush();
        
    }
}
