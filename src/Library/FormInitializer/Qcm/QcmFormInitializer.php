<?php
namespace Aftral\Qcm\Library\FormInitializer\Qcm;

use Aftral\Qcm\Library\FormInitializer\FormInitializer;
use Aftral\Qcm\Library\Entities\Qcm\QcmForm;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QcmFormInitializer extends FormInitializer
{
    private $_qcm;
    private $_qcmForm;
    
    public function __construct($request, $qcm)
    {
        parent::__construct($request);
        
        $this->_qcm = $qcm;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
           
        }
        elseif ($this->request()->method() == 'GET')
        {
            if (!empty($this->_qcm))
            {
                $this->_qcmForm = new QcmForm([
                    'questions' => $this->_qcm->questions(),
                    'answers' => $this->_qcm->answers(),
                    'solutions' => $this->_qcm->solutions()
                ]);
            }           
        }
    
        return $this->_qcmForm;
    }
}

