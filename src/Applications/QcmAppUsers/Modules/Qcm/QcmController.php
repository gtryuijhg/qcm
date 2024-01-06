<?php
namespace Aftral\Qcm\Applications\QcmAppUsers\Modules\Qcm;

use Aftral\Qcm\Library\Core\BackController;
use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\HTTPRequest;
use Aftral\Qcm\Library\QcmBuilder\QcmBuilder;
use Aftral\Qcm\Library\QcmTitleSwitcher\QcmTitleSwitcher;
use Aftral\Qcm\Library\FormInitializer\Qcm\QcmFormInitializer;
use Aftral\Qcm\Library\FormBuilder\Qcm\QcmFormBuilder;
use Aftral\Qcm\Library\FormProcessor\Qcm\QcmFormProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QcmController extends BackController
{
    public function executeSolve(HTTPRequest $request)
    {
        if ($this->app()->session()->isAuthenticated())
        {           
            //on donne le titre en fonction du type de question
            $titleSwitcher = new QcmTitleSwitcher($request->getData('questionType'), $this->app()->httpResponse());
            $title = $titleSwitcher->getQcmTitle();
            
            //on utilise la liste de questions pour créer un qcm
            // (lister les questions et récuperer d'abord les solutions des questions (10 questions par qcm) puis des réponses (jusqu'à 4 en tout) et les placer dans un ordre aléatoire dans les objets question qcm)
            $qcmBuilder = new QcmBuilder($request, $this->managers());
            $qcm = $qcmBuilder->build();
            
            //on initialise le formulaire avec le qcm créé (pour pouvoir l'afficher et ensuite récuperer les infos de sa requete post pour l'executer
            $formInitializer = new QcmFormInitializer($request, $qcm);
            $qcmForm = $formInitializer->initialize();
            
            //on construit le formulaire
            $formBuilder = new QcmFormBuilder($qcmForm);
            $formBuilder->build();
            
            //on rend le formulaire
            $form = $formBuilder->form();
            
            //on créée les conteneurs de données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //on execute le formulaire
            $formProcessor = new QcmFormProcessor($form, $this->managers(), $dataFluxContainer, $qcmForm);
            $formProcessor->process();
            
            $this->page()->addVar('title', $title);
            $this->page()->addVar('formMethod', 'POST');
            $this->page()->addVar('form', $form ? $form->createView() : 'Veuillez créer plus de données pour pouvoir afficher un formulaire');
            $this->page()->addVar('qcmResolveAction', '/users/qcm/'.$request->getData('questionType'));
            $this->page()->addVar('qcmUsersHomePath', '/users/user/home');
            $this->page()->addVar('button', $form ? '<button type="submit" class="btn btn-primary">Envoyer</button>' : '');
        }
        else
        {
            $this->app()->httpResponse()->redirect('/users/user/signin');
        }
    }
}

