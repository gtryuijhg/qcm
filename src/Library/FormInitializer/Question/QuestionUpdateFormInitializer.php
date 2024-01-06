<?php
namespace Aftral\Qcm\Library\FormInitializer\Question;

use Aftral\Qcm\Library\Core\HTTPRequest;
use Aftral\Qcm\Library\Entities\Question\QuestionDatabase\QuestionDatabase;
use Aftral\Qcm\Library\Entities\Question\QuestionForm\QuestionUpdateForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionUpdateFormInitializer extends FormInitializer
{
    private $_questionUpdateForm;
    private $_questionInBase;
    
    public function __construct(HTTPRequest $request, QuestionDatabase $questionInBase)
    {
        parent::__construct($request);
        
        $this->_questionInBase = $questionInBase;
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
            $this->_questionUpdateForm = new QuestionUpdateForm([
                'questionBody' => $this->request()->postData('questionBody'),
                'questionType' => $this->request()->postData('questionType'),
                'solutionsNumber' => $this->request()->postData('solutionsNumber'),
                'id' => $this->request()->getData('id')
            ]);
        }
        else
        {
            $this->_questionUpdateForm = new QuestionUpdateForm([
                'questionBody' => $this->_questionInBase->questionBody()
            ]);           
        }
        
        return $this->_questionUpdateForm;
    }
}

