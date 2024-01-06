<?php
namespace Aftral\Qcm\Library\Core;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class BackController extends ApplicationComponent
{
    private $_action = '';
    private $_module = '';
    private $_page = NULL;
    private $_view = '';
    private $_managers = NULL;
    
    /**
     * 
     * @param Application $app
     * @param string $module
     * @param string $action
     */
    public function __construct(Application $app, string $module, string $action)
    {
        parent::__construct($app);
        
        $this->_managers = new Managers('PDO', PDOFactory::getDatabaseConnection());
        $this->_page = new Page($app);
        
        $this->setModule($module);
        $this->setAction($action);
        $this->setView($action);
    }
    
    /**
     * 
     * @throws \RuntimeException
     */
    //on execute un controller
    public function execute()
    {
        $method = 'execute'.ucfirst($this->_action);
        
        if (!is_callable([$this, $method]))
        {
            throw new \RuntimeException('L\'action '.$this->_action.'n\'est pas définie sur ce module');
        }
        
        $this->$method($this->app()->httpRequest());
    }
    
    /**
     * 
     * @return \Aftral\Qcm\Library\Core\Page
     */
    public function page():Page
    {
        return $this->_page;
    }
   
    /**
     * 
     * @return \Aftral\Qcm\Library\Core\Managers
     */
    public function managers():Managers
    {
        return $this->_managers;
    }
    
    /**
     * 
     * @param string $module
     * @throws \InvalidArgumentException
     */
    public function setModule(string $module):void
    {
        if (empty($module))
        {
            throw new \InvalidArgumentException('Le module doit être une chaine de caractères valide');
        }
        
        $this->_module = $module;
    }
    
    /**
     * 
     * @param string $action
     * @throws \InvalidArgumentException
     */
    public function setAction(string $action):void
    {
        if (empty($action))
        {
            throw new \InvalidArgumentException('L\'action doit être une chaine de caractères valide');
        }
        
        $this->_action = $action;
    }
    
    /**
     * 
     * @param string $view
     * @throws \InvalidArgumentException
     */
    public function setView(string $view):void
    {
        if (empty($view))
        {
            throw new \InvalidArgumentException('La vue doit être une chaine de caractères valide');
        }
        
        $this->_view = $view;
        
        $this->_page->setContentFile(__DIR__.'/../../Applications/'.$this->app()->name().'/Modules/'.$this->_module.'/Views/'.$this->_view.'.php');
    }
}

