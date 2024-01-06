<?php
namespace Aftral\Qcm\Applications\QcmAppAdmins\Modules\Answer;

use Aftral\Qcm\Library\Core\BackController;
use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\HTTPRequest;
use Aftral\Qcm\Library\EntitySearcher\Answer\AnswerSearcher;
use Aftral\Qcm\Library\EntitySearcher\Question\QuestionSearcher;
use Aftral\Qcm\Library\FormBuilder\Answer\AnswerCreateFormBuilder;
use Aftral\Qcm\Library\FormBuilder\Answer\AnswerDeleteFormBuilder;
use Aftral\Qcm\Library\FormBuilder\Answer\AnswerUpdateFormBuilder;
use Aftral\Qcm\Library\FormInitializer\Answer\AnswerCreateFormInitializer;
use Aftral\Qcm\Library\FormInitializer\Answer\AnswerDeleteFormInitializer;
use Aftral\Qcm\Library\FormInitializer\Answer\AnswerUpdateFormInitializer;
use Aftral\Qcm\Library\FormProcessor\Answer\AnswerCreateFormProcessor;
use Aftral\Qcm\Library\FormProcessor\Answer\AnswerDeleteFormProcessor;
use Aftral\Qcm\Library\FormProcessor\Answer\AnswerUpdateFormProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerController extends BackController
{
    
    public function executeCreate(HTTPRequest $request)
    {
        if ($this->app()->session()->isAuthenticated())
        {          
            //chercher si la question existe
            $entitySearcher = new QuestionSearcher($request, $this->managers(), $this->app()->httpResponse());
            $questionInBase = $entitySearcher->search();          
            
            //initialiser le formulaire
            $formInitializer = new AnswerCreateFormInitializer($request, $questionInBase);
            $answerCreateForm = $formInitializer->initialize();
            
            //créer le formulaire
            $formBuilder = new AnswerCreateFormBuilder($answerCreateForm);
            $formBuilder->build();
            
            //rendre le formulaire
            $form = $formBuilder->form();
            
            //conteneur de données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //executer le formulaire
            $formProcessor = new AnswerCreateFormProcessor($form, $this->managers(), $dataFluxContainer, $answerCreateForm);
            $formProcessor->process();
            
            $this->app()->session()->setFormToken();
            $this->page()->addVar('title', 'Créer une réponse');
            $this->page()->addVar('form', $form->createView());
            
            $this->page()->addVar('answerCreateAction', '/admins/answer/create/'.$request->getData('id'));
            $this->page()->addVar('questionListPath', '/admins/question/list');
            $this->page()->addVar('formMethod', 'POST');
            $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"/>');
            $this->page()->addVar('button', '<button type="submit" class="btn btn-primary">Créer une réponse</button>');
        }
        else
        {
            $this->app()->httpResponse()->redirect('/admins/admin/disconnect');
        }
    }
    
    /**
     * 
     * @param HTTPRequest $request
     */
    public function executeList(HTTPRequest $request)
    {
        if ($this->app()->session()->isAuthenticated())
        {           
            //on récupère la liste des réponses
            $answerList = $this->managers()->getManagerOf('Answer')->getAnswerList();
            
            $this->page()->addVar('answerList', $answerList);
            $this->page()->addVar('title', 'Liste des réponses');
            
            $this->page()->addVar('answerUpdatePath', '/admins/answer/update/');
            $this->page()->addVar('answerDeletePath', '/admins/answer/delete/');
            $this->page()->addVar('appAdminHomePath', '/admins/admin/home');
        }
        else
        {
            $this->app()->httpResponse()->redirect('/admins/admin/disconnect');
        }
    }
    
    /**
     * 
     * @param HTTPRequest $request
     */
    public function executeUpdate(HTTPRequest $request)
    {
        if ($this->app()->session()->isAuthenticated())
        {
            //on verifie si la reponse existe
            //si elle existe recuperer la reponse par le manager avec l'id
            $entitySearcher = new AnswerSearcher($request, $this->managers(), $this->app()->httpResponse());
            $answerInBase = $entitySearcher->search();
                        
            //integrer la reponse a l'initialiseur de formulaire en methode get/utilisation des données post en methode post
            $formInitializer = new AnswerUpdateFormInitializer($request, $answerInBase);
            $answerUpdateForm = $formInitializer->initialize();
            
            //créer le formulaire
            $formBuilder = new AnswerUpdateFormBuilder($answerUpdateForm);
            $formBuilder->build();
            
            //rendre le formulaire
            $form = $formBuilder->form();
            
            //conteneur de données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //processeur de formulaire
            $formProcessor = new AnswerUpdateFormProcessor($form, $this->managers(), $dataFluxContainer, $answerUpdateForm);
            $formProcessor->process();
            
            $this->app()->session()->setFormToken();
            $this->page()->addVar('title', 'Modifier une réponse');
            $this->page()->addVar('form', $form->createView());
            
            $this->page()->addVar('answerUpdateAction', '/admins/answer/update/'.$request->getData('id'));
            $this->page()->addVar('answerListPath', '/admins/answer/list');
            $this->page()->addVar('formMethod', 'POST');
            $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"/>');
            $this->page()->addVar('button', '<button type="submit" class="btn btn-success">Modifier une réponse</button>');
        }
        else
        {
            $this->app()->httpResponse()->redirect('/admins/admin/disconnect');
        }
    }
    
    public function executeDelete(HTTPRequest $request)
    {
        if ($this->app()->session()->isAuthenticated())
        {
            //on verifie si la reponse existe
            $entitySearcher = new AnswerSearcher($request, $this->managers(), $this->app()->httpResponse());
            $entitySearcher->search();
            
            //on initialise le formulaire
            $formInitializer = new AnswerDeleteFormInitializer($request);
            $answerDeleteForm = $formInitializer->initialize();
            
            //on construit le formulaire
            $formBuilder = new AnswerDeleteFormBuilder($answerDeleteForm);
            $formBuilder->build();
            
            //on rend le formulaire
            $form = $formBuilder->form();
            
            //on prepare les données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //on execute le formulaire
            $formProcessor = new AnswerDeleteFormProcessor($form, $this->managers(), $dataFluxContainer, $answerDeleteForm);
            $formProcessor->process();
            
            $this->app()->session()->setFormToken();
            $this->page()->addVar('title', 'Supprimer une réponse');
            $this->page()->addVar('form', $form->createView());
            
            $this->page()->addVar('answerDeleteAction', '/admins/answer/delete/'.$request->getData('id'));
            $this->page()->addVar('answerListPath', '/admins/answer/list');
            $this->page()->addVar('formMethod', 'POST');
            $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"');
            $this->page()->addVar('button', '<button type="submit" class="btn btn-danger">Supprimer une réponse</button>');
        }
        else
        {
            $this->app()->httpResponse()->redirect('/admins/admin/disconnect');
        }
    }
}

