<?php
namespace Aftral\Qcm\Library\EntitySearcher\Answer;

use Aftral\Qcm\Library\EntitySearcher\EntitySearcher;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerSearcher extends EntitySearcher
{
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\EntitySearcher\EntitySearcher::search()
     */
    public function search()
    {
        $answerInBase = $this->managers()->getManagerOf('Answer')->searchAnswerById($this->request()->getData('id'));
        
        if (empty($answerInBase))
        {
            $this->response()->redirect('/admins/answer/list');
        }
        
        return $answerInBase;
    }
}

