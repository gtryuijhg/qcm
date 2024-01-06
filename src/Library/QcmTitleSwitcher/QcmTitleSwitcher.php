<?php
namespace Aftral\Qcm\Library\QcmTitleSwitcher;

use Aftral\Qcm\Library\Core\HTTPResponse;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QcmTitleSwitcher
{
    private $_questionType;
    private $_title;
    private $_response;
    
    public function __construct(String $questionType, HTTPResponse $response)
    {
        $this->_questionType = $questionType;
        $this->_response = $response;
    }
    
    public function getQcmTitle()
    {
        switch ($this->_questionType)
        {
            case 'reception':
                $this->_title = 'Résoudre un QCM de réception';
                break;
                
            case 'expedition':
                $this->_title = 'Résoudre un QCM d\'expédition';
                break;
                
            case 'preparation':
                $this->_title = 'Résoudre un QCM de préparation de commandes';
                break;
                
            case 'gestion':
                $this->_title = 'Résoudre un QCM de gestion de stocks';
                break;
                
            default:
                $this->_response->redirect('/users/user/home');
        }
        
        return $this->_title;
    }
}

