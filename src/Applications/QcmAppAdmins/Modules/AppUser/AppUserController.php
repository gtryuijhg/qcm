<?php
namespace Aftral\Qcm\Applications\QcmAppAdmins\Modules\AppUser;

use Aftral\Qcm\Library\Core\BackController;
use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\HTTPRequest;
use Aftral\Qcm\Library\EntitySearcher\AppUser\AppUserSearcher;
use Aftral\Qcm\Library\FormBuilder\AppUser\AppUserDeleteByAdminFormBuilder;
use Aftral\Qcm\Library\FormBuilder\AppUser\AppUserRegisterFormBuilder;
use Aftral\Qcm\Library\FormBuilder\AppUser\AppUserUpdateByAdminFormBuilder;
use Aftral\Qcm\Library\FormInitializer\AppUser\AppUserDeleteByAdminFormInitializer;
use Aftral\Qcm\Library\FormInitializer\AppUser\AppUserRegisterFormInitializer;
use Aftral\Qcm\Library\FormInitializer\AppUser\AppUserUpdateByAdminFormInitializer;
use Aftral\Qcm\Library\FormProcessor\AppUser\AppUserDeleteByAdminFormProcessor;
use Aftral\Qcm\Library\FormProcessor\AppUser\AppUserRegisterFormProcessor;
use Aftral\Qcm\Library\FormProcessor\AppUser\AppUserUpdateByAdminFormProcessor;

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
    public function executeRegister(HTTPRequest $request)
    {
        if ($this->app()->session()->isAuthenticated())
        {
            //on iniialise le formulaire
            $formInitializer = new AppUserRegisterFormInitializer($request);
            $appUserRegisterForm = $formInitializer->initialize();
            
            //on construit le formulaire
            $formBuilder = new AppUserRegisterFormBuilder($appUserRegisterForm);
            $formBuilder->build();
            
            //on rend le formulaire
            $form = $formBuilder->form();
            
            //on créée les conteneurs de données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //on execute le formulaire
            $formProcessor = new AppUserRegisterFormProcessor($form, $this->managers(), $dataFluxContainer, $appUserRegisterForm);
            $formProcessor->process();
            
            $this->app()->session()->setFormToken();
            $this->page()->addVar('title', 'Créer un utilisateur');
            $this->page()->addVar('form', $form->createView());
            
            $this->page()->addVar('appUserRegisterAction', '/admins/user/register');
            $this->page()->addVar('appAdminHomePath', '/admins/admin/home');
            $this->page()->addVar('formMethod', 'POST');
            $this->page()->addVar('token', '<input type="hidden" name="formoToken" value="'.$this->app()->session()->getFormToken().'"/>');
            $this->page()->addVar('button', '<button type="submit" class="btn btn-primary">Créer un utilisateur</button>');
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
            //on recupere la liste des utilisateurs
            $appUserList = $this->managers()->getManagerOf('AppUser')->getUserList();
            
            $this->page()->addVar('appUserList', $appUserList);
            $this->page()->addVar('title', 'Liste des utilisateurs');
            
            $this->page()->addVar('appUserUpdatePath', '/admins/user/update/');
            $this->page()->addVar('appUserDeletePath', '/admins/user/delete/');
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
            //on cherche si l'utilisateur existe
            $entitySearcher = new AppUserSearcher($request, $this->managers(), $this->app()->httpResponse());
            $entitySearcher->search();
            
            //on initialise le formulaire
            $formInitializer = new AppUserUpdateByAdminFormInitializer($request);
            $appUserUpdateByAdminForm = $formInitializer->initialize();
            
            //on construit le formulaire
            $formBuilder = new AppUserUpdateByAdminFormBuilder($appUserUpdateByAdminForm);
            $formBuilder->build();
            
            //on rend le formulaire
            $form = $formBuilder->form();
            
            //on créée les conteneurs de données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //on execute le formulaire
            $formProcessor = new AppUserUpdateByAdminFormProcessor($form, $this->managers(), $dataFluxContainer, $appUserUpdateByAdminForm);
            $formProcessor->process();
            
            $this->app()->session()->setFormToken();
            $this->page()->addVar('title', 'Modifier un utilisateur');
            $this->page()->addVar('form', $form->createView());
            $this->page()->addVar('appUserUpdateAction', '/admins/user/update/'.$request->getData('id'));
            $this->page()->addVar('appUserListPath', '/admins/user/list');
            $this->page()->addVar('formMethod', 'POST');
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
            //on cherche si l'utilisateur existe
            $entitySearcher = new AppUserSearcher($request, $this->managers(), $this->app()->httpResponse());
            $entitySearcher->search();
            
            //on initialise le formulaire
            $formInitializer = new AppUserDeleteByAdminFormInitializer($request);
            $appUserDeleteByAdminForm = $formInitializer->initialize();
            
            //on construit le formulaire
            $formBuilder = new AppUserDeleteByAdminFormBuilder($appUserDeleteByAdminForm);
            $formBuilder->build();
            
            //on rend le formulaire
            $form = $formBuilder->form();
            
            //on créée les conteneurs de données
            $dataFluxContainer = new DataFluxContainer($request, $this->app()->session(), $this->app()->httpResponse());
            
            //on execute le formulaire
            $formProcessor = new AppUserDeleteByAdminFormProcessor($form, $this->managers(), $dataFluxContainer, $appUserDeleteByAdminForm);
            $formProcessor->process();
            
            $this->app()->session()->setFormToken();
            $this->page()->addVar('title', 'Supprimer un utilisateur');
            $this->page()->addVar('form', $form->createView());
            
            $this->page()->addVar('appUserDeleteAction', '/admins/user/delete/'.$request->getData('id'));
            $this->page()->addVar('appUserListPath', '/admins/user/list');
            $this->page()->addVar('formMethod', 'POST');
            $this->page()->addVar('token', '<input type="hidden" name="formToken" value="'.$this->app()->session()->getFormToken().'"/>');
            $this->page()->addVar('button', '<button type="submit" class="btn btn-danger">Supprimer l\'utilisateur</button>');
        }
        else
        {
            $this->app()->httpResponse()->redirect('/admins/admin/disconnect');
        }
    }
}

