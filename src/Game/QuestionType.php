<?php


namespace App\Game;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class QuestionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $answers = ['jay', 'jo', 'jack'];

        foreach ($answers as $answer) {
            $builder->add($answer, SubmitType::class);
        }
    }
}
