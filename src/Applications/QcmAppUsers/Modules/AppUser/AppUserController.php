<?php
namespace Aftral\Qcm\Applications\QcmAppUsers\Modules\AppUser;

use Aftral\Qcm\Library\Core\BackController;
use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\HTTPRequest;
use Aftral\Qcm\Library\FormBuilder\AppUser\AppUserDeleteFormBuilder;
use Aftral\Qcm\Library\FormBuilder\AppUser\AppUserSigninFormBuilder;
use Aftral\Qcm\Library\FormBuilder\AppUser\AppUserUpdateFormBuilder;
use Aftral\Qcm\Library\FormInitializer\AppUser\AppUserDeleteFormInitializer;
use Aftral\Qcm\Library\FormInitializer\AppUser\AppUserSigninFormInitializer;
use Aftral\Qcm\Library\FormInitializer\AppUser\AppUserUpdateFormInitializer;
use Aftral\Qcm\Library\FormProcessor\AppUser\AppUserDeleteFormProcessor;
use Aftral\Qcm\Library\FormProcessor\AppUser\AppUserSigninFormProcessor;
use Aftral\Qcm\Library\FormProcessor\AppUser\AppUserUpdateFormProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserController extends BackController
{
    /**
     * 
     * @param HTTPRequest $request
     */
    public function executeSignin(HTTPRequest $request)
    {
        //on initialise le formulaire
        $formInitializer = new AppUserSigninFormInitializer($request);
        $appUserSigninForm = $formInitializer->initialize();
        
        //on construit le formulaire
        $formBuilder = new AppUserSigninFormBuilder($appUserSigninForm);
        $formBuilder->build();
        
        //on rend le formulaire
        $form = $formBuilder->form();
        
        //on créée les conteneurs de données
        $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
        
        //on execute le formulaire
        $formProcessor = new AppUserSigninFormProcessor($form, $this->managers(), $dataFluxContainer, $appUserSigninForm);
        $formProcessor->process();
        
        $this->app()->session()->setFormToken();
        $this->page()->addVar('title', 'Bienvenue sur AFTRAL\'s Logistics QCM !');
        $this->page()->addVar('form', $form->createView());
        
        $this->page()->addVar('appUserSigninAction', '/users/user/signin');
        $this->page()->addVar('formMethod', 'POST');
        $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"/>');
        $this->page()->addVar('button', '<button type="submit" class="btn btn-primary">Se connecter</button>');
    }
    
    /**
     * 
     * @param HTTPRequest $request
     */
    public function executeHome(HTTPRequest $request)
    {
        if ($this->app()->session()->isAuthenticated())
        {
            //on recupere l'utilisateur en session
            $sessionAppUser = $this->app()->session()->getAttribute('sessionAppUser');
            
            $this->page()->addVar('sessionAppUser', $sessionAppUser);
            $this->page()->addVar('title', 'Bienvenue sur le portail utilisateurs');
            
            $this->page()->addVar('appUserUpdatePath', '/users/user/update');
            $this->page()->addVar('appUserDeletePath', '/users/user/delete');
            $this->page()->addVar('appUserDisconnectPath', '/users/user/disconnect');
            
            $this->page()->addVar('qcmReceptionButton', '<button class="btn btn-outline-primary"><a href="/users/qcm/reception">Réception</a></button>');
            $this->page()->addVar('qcmExpeditionButton', '<button class="btn btn-outline-primary"><a href="/users/qcm/expedition">Expédition</a></button>');
            $this->page()->addVar('qcmGestionButton', '<button class="btn btn-outline-primary"><a href="/users/qcm/gestion">Gestion de stocks</a></button>');
            $this->page()->addVar('qcmPreparationButton', '<button class="btn btn-outline-primary"><a href="/users/qcm/preparation">Préparation de commandes</a></button>');
            
            $this->page()->addVar('userScoresButton', '<button class="btn btn-outline-primary"><a href="">Vos scores</a></button>');
            $this->page()->addVar('usersBestScoresButton', '<button class="btn btn-outline-primary"><a href="">Les derniers meilleurs scores</a></button>');
        }
        else
        {
            $this->app()->httpResponse()->redirect('/users/user/signin');
        }
    }
    
    public function executeDisconnect()
    {
        //on vide les variabkes de session
        $this->app()->session()->empty();
        
        //on redirige l'utilisateur à la page de connexion
        $this->app()->httpResponse()->redirect('/users/user/signin');
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
            $formInitializer = new AppUserUpdateFormInitializer($request);
            $appUserUpdateForm = $formInitializer->initialize();
            
            //on construit le formulaire
            $formBuilder = new AppUserUpdateFormBuilder($appUserUpdateForm);
            $formBuilder->build();
            
            //on rend le formulaire
            $form = $formBuilder->form();
            
            //on créée les conteneurs de données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //on execute le formulaire
            $formProcessor = new AppUserUpdateFormProcessor($form, $this->managers(), $dataFluxContainer, $appUserUpdateForm);
            $formProcessor->process();
            
            $this->app()->session()->setFormToken();
            $this->page()->addVar('title', 'Modifier un utilisateur');
            $this->page()->addVar('form', $form->createView());
            
            $this->page()->addVar('appUserUpdateAction', '/users/user/update');
            $this->page()->addVar('appUserHomePath', '/users/user/home');
            $this->page()->addVar('formMethod', 'POST');
            $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"/>');
            $this->page()->addVar('button', '<button type="submit" class="btn btn-success">Modifier mot de passe</button>');
        }
        else
        {
            $this->app()->httpResponse()->redirect('/users/user/signin');
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
            $formInitializer = new AppUserDeleteFormInitializer($request);
            $appUserDeleteForm = $formInitializer->initialize();
            
            //on construit le formulaire
            $formBuilder = new AppUserDeleteFormBuilder($appUserDeleteForm);
            $formBuilder->build();
            
            //on rend le formulaire
            $form = $formBuilder->form();
            
            //on créée les conteneurs de données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //on execute le formulaire
            $formProcessor = new AppUserDeleteFormProcessor($form, $this->managers(), $dataFluxContainer, $appUserDeleteForm);
            $formProcessor->process();
            
            $this->app()->session()->setFormToken();
            $this->page()->addVar('title', 'Supprimer un utilisateur');
            $this->page()->addVar('form', $form->createView());
            
            $this->page()->addVar('appUserDeleteAction', '/users/user/delete');
            $this->page()->addVar('appUserHomePath', '/users/user/home');
            $this->page()->addVar('formMethod', 'POST');
            $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"/>');
            $this->page()->addVar('button', '<button type="submit" class="btn btn-danger">Supprimer utilisateur</button>');
        }
        else
        {
            $this->app()->httpResponse()->redirect('/users/user/signin');
        }
    }
}

