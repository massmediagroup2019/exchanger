<?php

namespace App\Form;

use App\Entity\Rate;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RateType
 * @package App\Form
 */
class RateType extends AbstractType
{
    /**
     * @var string
     */
    private $defaultCurrency;

    /**
     * RateType constructor.
     * @param string $defaultCurrency
     */
    public function __construct(string $defaultCurrency)
    {
        $this->defaultCurrency = $defaultCurrency;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currency', TextType::class, [
                'label' => 'Currency Code',
                'required' => true,
                'attr' => ['maxlength' => 3, 'minlength' => 3]
            ])
            ->add('rate', MoneyType::class, [
                'label' => 'Rate',
                'currency' => $this->defaultCurrency,
                'required' => true,
                'scale' => 2,

            ])
            ->add('submit', SubmitType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'class' => Rate::class,
        ]);
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'rate';
    }
}
