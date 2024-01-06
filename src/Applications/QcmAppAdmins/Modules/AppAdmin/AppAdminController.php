<?php
namespace Aftral\Qcm\Applications\QcmAppAdmins\Modules\AppAdmin;

use Aftral\Qcm\Library\Core\BackController;
use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\HTTPRequest;
use Aftral\Qcm\Library\FormBuilder\AppAdmin\AppAdminDeleteFormBuilder;
use Aftral\Qcm\Library\FormBuilder\AppAdmin\AppAdminRegisterFormBuilder;
use Aftral\Qcm\Library\FormBuilder\AppAdmin\AppAdminSigninFormBuilder;
use Aftral\Qcm\Library\FormBuilder\AppAdmin\AppAdminUpdateFormBuilder;
use Aftral\Qcm\Library\FormInitializer\AppAdmin\AppAdminDeleteFormInitializer;
use Aftral\Qcm\Library\FormInitializer\AppAdmin\AppAdminRegisterFormInitializer;
use Aftral\Qcm\Library\FormInitializer\AppAdmin\AppAdminSigninFormInitializer;
use Aftral\Qcm\Library\FormInitializer\AppAdmin\AppAdminUpdateFormInitializer;
use Aftral\Qcm\Library\FormProcessor\AppAdmin\AppAdminDeleteFormProcessor;
use Aftral\Qcm\Library\FormProcessor\AppAdmin\AppAdminRegisterFormProcessor;
use Aftral\Qcm\Library\FormProcessor\AppAdmin\AppAdminSigninFormProcessor;
use Aftral\Qcm\Library\FormProcessor\AppAdmin\AppAdminUpdateFormProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminController extends BackController
{
    /**
     * 
     * @param HTTPRequest $request
     */
    public function executeSignin(HTTPRequest $request)
    {
        //on initialise le formulaire
        $formInitializer = new AppAdminSigninFormInitializer($request);
        $appAdminSigninForm = $formInitializer->initialize();
        
        //on construit le formulaire
        $formBuilder = new AppAdminSigninFormBuilder($appAdminSigninForm);
        $formBuilder->build();
        
        //on rend le formulaire
        $form = $formBuilder->form();
        
        //on crée les conteneurs de données
        $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
        
        //on execute le formulaire
        $formProcessor = new AppAdminSigninFormProcessor($form, $this->managers(), $dataFluxContainer, $appAdminSigninForm);
        $formProcessor->process();
        
        $this->app()->session()->setFormToken();
        $this->page()->addVar('title', 'Bienvenue sur AFTRAL\'s Logistics QCM !');
        $this->page()->addVar('form', $form->createView());
        
        $this->page()->addVar('appAdminSigninAction', '/admins/admin/signin');
        $this->page()->addVar('appAdminRegisterPath', '/admins/admin/register');
        
        $this->page()->addVar('formMethod', 'POST');
        $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"/>');
        $this->page()->addVar('button', '<button type="submit" class="btn btn-primary">Se connecter</button>');
    }
    
    /**
     * 
     * @param HTTPRequest $request
     */
    public function executeRegister(HTTPRequest $request)
    {
        //on initialise le formulaire
        $formInitializer = new AppAdminRegisterFormInitializer($request);
        $appAdminRegisterForm = $formInitializer->initialize();
        
        //on construit le formulaire
        $formBuilder = new AppAdminRegisterFormBuilder($appAdminRegisterForm);
        $formBuilder->build();
        
        //on rend le formulaire
        $form = $formBuilder->form();
        
        //on créé les conteneurs de données
        $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
        
        //on execute le formulaire
        $formProcessor = new AppAdminRegisterFormProcessor($form, $this->managers(), $dataFluxContainer, $appAdminRegisterForm);
        $formProcessor->process();
        
        $this->app()->session()->setFormToken();
        $this->page()->addVar('title', 'Créer un administrateur');
        $this->page()->addVar('form', $form->createView());
        
        $this->page()->addVar('appAdminRegisterAction', '/admins/admin/register');
        $this->page()->addVar('appAdminSigninPath', '/admins/admin/signin');
        
        $this->page()->addVar('formMethod', 'POST');
        $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"/>');
        $this->page()->addVar('button', '<button type="submit" class="btn btn-primary">S\'inscrire</button>');
    }
    
    /**
     * 
     * @param HTTPRequest $request
     */
    public function executeHome(HTTPRequest $request)
    {      
        if ($this->app()->session()->isAuthenticated())
        {   
            //on recupere l'administrateur en session
            $sessionAppAdmin = $this->app()->session()->getAttribute('sessionAppAdmin');
            
            $this->page()->addVar('sessionAppAdmin', $sessionAppAdmin);
            $this->page()->addVar('title', 'Bienvenue sur le portail d\'administration');
            
            $this->page()->addVar('appAdminUpdatePath', '/admins/admin/update');
            $this->page()->addVar('appAdminDeletePath', '/admins/admin/delete');
            $this->page()->addVar('appUserRegisterPath', '/admins/user/register');
            $this->page()->addVar('appUserListPath', '/admins/user/list');
            $this->page()->addVar('questionCreatePath', '/admins/question/create');
            $this->page()->addVar('questionListPath', '/admins/question/list');
            $this->page()->addVar('answerListPath', '/admins/answer/list');
            $this->page()->addVar('appAdminDisconnectPath', '/admins/admin/disconnect');
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
            //on initialise le formulaire
            $formInitializer = new AppAdminUpdateFormInitializer($request);
            $appAdminUpdateForm = $formInitializer->initialize();
            
            //on construit le formulaire
            $formBuilder = new AppAdminUpdateFormBuilder($appAdminUpdateForm);
            $formBuilder->build();
            
            //on rend le formulaire
            $form = $formBuilder->form();
            
            //on crée les conteneurs de données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //on execute le formulaire
            $formProcessor = new AppAdminUpdateFormProcessor($form, $this->managers(), $dataFluxContainer, $appAdminUpdateForm);
            $formProcessor->process();
            
            $this->app()->session()->setFormToken();
            $this->page()->addVar('title', 'Modifier un administrateur');
            $this->page()->addVar('form', $form->createView());
            
            $this->page()->addVar('appAdminUpdateAction', '/admins/admin/update');
            $this->page()->addVar('appAdminHomePath', '/admins/admin/home');
            
            $this->page()->addvar('formMethod', 'POST');
            $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"/>');
            $this->page()->addVar('button', '<button type="submit" class="btn btn-success">Modifier le mot de passe</button>');
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
            //on initialise le formulaire
            $formInitializer = new AppAdminDeleteFormInitializer($request);
            $appAdminDeleteForm = $formInitializer->initialize();
            
            //on crée le formulaire
            $formBuilder = new AppAdminDeleteFormBuilder($appAdminDeleteForm);
            $formBuilder->build();
            
            //on rend le formulaire
            $form = $formBuilder->form();
            
            //on crée les conteneurs de données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //on execute le formulaire
            $formProcessor = new AppAdminDeleteFormProcessor($form, $this->managers(), $dataFluxContainer, $appAdminDeleteForm);
            $formProcessor->process();
            
            $this->app()->session()->setFormToken();
            $this->page()->addVar('title', 'Supprimer un administrateur');
            $this->page()->addVar('form', $form->createView());
            
            $this->page()->addVar('appAdminDeleteAction', '/admins/admin/delete');
            $this->page()->addVar('appAdminHomePath', '/admins/admin/home');
            $this->page()->addVar('formMethod', 'POST');
            $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"/>');
            $this->page()->addVar('button', '<button type="submit" class="btn btn-danger">Supprimer l\'administrateur</button>');
        }
        else
        {
            $this->app()->httpResponse()->redirect('/admins/admin/disconnect');
        }
    }
    
    public function executeDisconnect()
    {
        //on vide les variables sauvegardées en session
        $this->app()->session()->empty();
        
        //on redirige à la page de connexion
        $this->app()->httpResponse()->redirect('/admins/admin/signin');
    }
}

