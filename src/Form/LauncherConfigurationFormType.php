<?php

namespace Bwlab\Launcher\Form;


use Bwlab\Launcher\Configuration\LauncherTextDataConfiguration;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LauncherConfigurationFormType extends TranslatorAwareType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(LauncherTextDataConfiguration::NEW_URLS, TextareaType::class, [
                'label' => $this->trans('Command', 'Modules.Bwlauncher.Admin', []),
                'help' => $this->trans('command name:<domain>?....&<param>=VALUE1&<param>=VALUE2.....', 'Modules.Bwlauncher.Admin', []),
                'attr'=>[
                    'rows' => 10,
                ]
            ]);
    }

}