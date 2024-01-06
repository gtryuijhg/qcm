<?php
namespace Aftral\Qcm\Library\EntitySearcher\Question;

use Aftral\Qcm\Library\EntitySearcher\EntitySearcher;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionSearcher extends EntitySearcher
{
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\EntitySearcher\EntitySearcher::search()
     */
    public function search()
    {
        $questionInBase = $this->managers()->getManagerOf('Question')->searchQuestionById($this->request()->getData('id'));
        
        if (empty($questionInBase))
        {
            $this->response()->redirect('/admins/question/list');
        }
        
        return $questionInBase;
    }
}

