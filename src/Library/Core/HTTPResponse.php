<?php
namespace Aftral\Qcm\Library\Core;

use Aftral\Qcm\Library\Core\Page;

/**
 * 
 * @author gregoire.huteau
 *
 */
class HTTPResponse extends ApplicationComponent
{
    private $_page;
    
    /**
     * 
     * @param string $location
     */
    public function redirect(string $location)
    {
        header('Location: '.$location);
    }
    
    public function redirect404()
    {
        $this->_page = new Page($this->app());
        $this->_page->setContentFile(__DIR__.'/../../Errors/404.html');
        
        $this->send();
    }
    
    public function send()
    {
        exit($this->_page->getGeneratedPage());
    }
    
    /**
     * 
     * @param Page $page
     */
    public function setPage(Page $page):void
    {
        $this->_page = $page;
    }
}

