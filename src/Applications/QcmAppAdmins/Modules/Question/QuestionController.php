<?php
namespace Aftral\Qcm\Applications\QcmAppAdmins\Modules\Question;

use Aftral\Qcm\Library\Core\BackController;
use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\HTTPRequest;
use Aftral\Qcm\Library\FormBuilder\Question\QuestionCreateFormBuilder;
use Aftral\Qcm\Library\FormInitializer\Question\QuestionCreateFormInitializer;
use Aftral\Qcm\Library\FormProcessor\Question\QuestionCreateFormProcessor;
use Aftral\Qcm\Library\EntitySearcher\Question\QuestionSearcher;
use Aftral\Qcm\Library\FormInitializer\Question\QuestionUpdateFormInitializer;
use Aftral\Qcm\Library\FormBuilder\Question\QuestionUpdateFormBuilder;
use Aftral\Qcm\Library\FormProcessor\Question\QuestionUpdateFormProcessor;
use Aftral\Qcm\Library\FormInitializer\Question\QuestionDeleteFormInitializer;
use Aftral\Qcm\Library\FormBuilder\Question\QuestionDeleteFormBuilder;
use Aftral\Qcm\Library\FormProcessor\Question\QuestionDeleteFormProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionController extends BackController
{
    /**
     * 
     * @param HTTPRequest $request
     */
    public function executeCreate(HTTPRequest $request)
    {
        if ($this->app()->session()->isAuthenticated())
        {
            //initialiser le formulaire
            $formInitializer = new QuestionCreateFormInitializer($request);
            $questionCreateForm = $formInitializer->initialize();
            
            //créer le constructeur du formulaire
            $formBuilder = new QuestionCreateFormBuilder($questionCreateForm);
            $formBuilder->build();
            
            //rendre le formulaire
            $form = $formBuilder->form();

            //créer les conteneurs de données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //créer le processeur du formulaire
            $formProcessor = new QuestionCreateFormProcessor($form, $this->managers(), $dataFluxContainer, $questionCreateForm);
            $formProcessor->process();
            
            $this->app()->session()->setFormToken();
            $this->page()->addVar('title', 'Créer une question');
            $this->page()->addVar('form', $form->createView());
            
            $this->page()->addVar('questionCreateAction', '/admins/question/create');
            $this->page()->addVar('appAdminHomePath', '/admins/admin/home');            
            $this->page()->addVar('formMethod', 'POST');
            $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"/>');
            $this->page()->addVar('button', '<button type="submit" class="btn btn-primary">Créer une question</button>');
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
            //on recupere la liste des questions
            $questionList = $this->managers()->getManagerOf('Question')->getQuestionList();
            
            $this->page()->addVar('questionList', $questionList);
            $this->page()->addVar('title', 'Liste des questions');
            
            $this->page()->addVar('answerCreatePath', '/admins/answer/create/');
            $this->page()->addVar('questionUpdatePath', '/admins/question/update/');
            $this->page()->addVar('questionDeletePath', '/admins/question/delete/');
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
            //on verifie si la question existe
            //si elle existe on la récupere pour l'initialiser dans le formulaire
            $entitySearcher = new QuestionSearcher($request, $this->managers(), $this->app()->httpResponse());
            $questionInBase = $entitySearcher->search();
            
            //initialiser le formulaire
            $formInitializer = new QuestionUpdateFormInitializer($request, $questionInBase);
            $questionUpdateForm = $formInitializer->initialize();
            
            //créer le constructeur de formulaire
            $formBuilder = new QuestionUpdateFormBuilder($questionUpdateForm);
            $formBuilder->build();
            
            //rendre le formulaire
            $form = $formBuilder->form();
            
            //conteneur de données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //processeur du formulaire
            $formProcessor = new QuestionUpdateFormProcessor($form, $this->managers(), $dataFluxContainer, $questionUpdateForm);
            $formProcessor->process();            
            
            $this->app()->session()->setFormToken();
            $this->page()->addVar('form', $form->createView());
            $this->page()->addVar('title', 'Modifier une question');
            
            $this->page()->addVar('questionUpdateAction', '/admins/question/update/'.$request->getData('id'));
            $this->page()->addVar('questionListPath', '/admins/question/list');
            $this->page()->addVar('formMethod', 'POST');
            $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"/>');
            $this->page()->addVar('button', '<button type="submit" class="btn btn-success">Modifier une question</button>');
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
    public function executeDelete(HTTPRequest $request)
    {
        if ($this->app()->session()->isAuthenticated())
        {
            //verifier si la question existe
            $entitySearcher = new QuestionSearcher($request, $this->managers(), $this->app()->httpResponse());
            $entitySearcher->search();
            
            //initialiser le formulaire
            $formInitializer = new QuestionDeleteFormInitializer($request);
            $questionDeleteForm = $formInitializer->initialize();
            
            //créer le constructeur de formulaire
            $formBuilder = new QuestionDeleteFormBuilder($questionDeleteForm);
            $formBuilder->build();
            
            //rendre le formulaire
            $form = $formBuilder->form();
            
            //conteneur de données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //processeur du formulaire
            $formProcessor = new QuestionDeleteFormProcessor($form, $this->managers(), $dataFluxContainer, $questionDeleteForm);
            $formProcessor->process();
            
            $this->app()->session()->setFormToken();
            $this->page()->addVar('title', 'Supprimer une question');
            $this->page()->addVar('form', $form->createView());
            
            $this->page()->addVar('questionDeleteAction', '/admins/question/delete/'.$request->getData('id'));
            $this->page()->addVar('questionListPath', '/admins/question/list');
            $this->page()->addVar('formMethod', 'POST');
            $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"/>');
            $this->page()->addVar('button', '<button type="submit" class="btn btn-danger">Supprimer une question</button>');
        }
        else
        {
            $this->app()->httpResponse()->redirect('/admins/admin/disconnect');
        }
    }
}

