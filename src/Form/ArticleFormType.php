<?php

namespace App\Form;


use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotNull;


class ArticleFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Article|null $article */
        $article = $options['data'] ?? null;
        $isEdit = $article && $article->getId();

        $builder
            ->add('title',TextType::class, [
                'label' => 'Заголовок'
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Контент'
            ])
            ->add('author',TextType::class, [
                'label' => 'Автор'
            ])
        ;

        $imageConstraints = [
            new Image([
                'maxSize' => '5M'
            ])
        ];

        if (!$isEdit || !$article->getImageFilename()) {
            $imageConstraints[] = new NotNull([
                'message' => 'Пожалуйста загрузите изображение',
            ]);
        }

        $builder
            ->add('imageFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => $imageConstraints,
                'label' => 'Изображение'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class
        ]);
    }


}