<?php

namespace Bwlab\Launcher\Controller;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LauncherController extends FrameworkBundleAdminController
{
    public function configurationAction(Request $request): Response
    {
        $textFormDataHandler = $this->get('bwlab.launcher.handler.launcher_configuration_text_form_data_handler');

        $textForm = $textFormDataHandler->getForm();
        $textForm->handleRequest($request);

        if ($textForm->isSubmitted() && $textForm->isValid()) {
            /** You can return array of errors in form handler and they can be displayed to user with flashErrors */
            $errors = $textFormDataHandler->save($textForm->getData());


            empty($errors) ?
                $this->addFlash('success', $this->trans('Successful update.', 'Admin.Notifications.Success')) :
                $this->flashErrors($errors);

        }

        $textForm = $textForm->createView();

        return $this->render(
            '@Modules/bwlauncher/views/templates/admin/controller/launcher_configuration_view.html.twig',
            [
                'form' => $textForm,
            ]
        );
    }

}
