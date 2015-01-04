<?php
namespace HcbFaq\Stdlib\Service\Response;

use Zf2Libs\Stdlib\Response\DataInterface;
use Zf2Libs\Stdlib\Service\Response\ResourceInterface;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;
use HcbFaq\Stdlib\Response\Exception\InvalidArgumentException;

class CreateResponse extends Response implements DataInterface, ResourceInterface
{
    /**
     * @var number
     */
    protected $faqId;

    /**
     * @param number $faqId
     */
    public function setResource($faqId)
    {
        if (!is_numeric($faqId)) {
            throw new InvalidArgumentException("Invalid type of faq id, must be numeric");
        }

        $this->faqId = $faqId;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array('id'=>$this->faqId);
    }
}
