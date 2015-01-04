<?php
namespace HcbFaq\Stdlib\Extractor;

use Doctrine\ORM\EntityManager;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;

use HcbFaq\Entity\Faq as FaqEntity;

class Resource implements ExtractorInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Extract values from an object
     *
     * @param  FaqEntity $faqEntity
     *
     * @throws \Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException
     * @return array
     */
    public function extract($faqEntity)
    {
        if (!$faqEntity instanceof FaqEntity) {
            throw new InvalidArgumentException
                ("Expected HcbFaq\\Entity\\Faq object, invalid object given");
        }

        $localized = $faqEntity->getLocalized();
        $question = $answer = "";
        if ($localized->count() > 0) {
            $localizedEntity = $localized->current();
            $question = $localizedEntity->getQuestion();
            $answer = $localizedEntity->getAnswer();
        }

        return array('id'=> $faqEntity->getId(),
                     'question'=>$question,
                     'answer'=>$answer);
    }
}
