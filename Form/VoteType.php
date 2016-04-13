<?php

namespace Prism\PollBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Choice;

/**
 * VoteType
 */
class VoteType extends AbstractType
{
    /**
     * Build Form
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('opinions', ChoiceType::class, array(
                    'multiple' => false,
                    'expanded' => true,
                    'choices' => $options['opinionsChoices'],
                    'choices_as_values' => true,
                    'constraints' => array(
                        new NotNull(array('message' => "Please select a choice.")),
                        new Choice(array('choices' => array_keys($options['opinionsChoices'])))
                    )
                )
            );
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getBlockPrefix()
    {
        return "vote";
    }

    /**
     * Set Default Options
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(array('opinionsChoices'));
    }
}