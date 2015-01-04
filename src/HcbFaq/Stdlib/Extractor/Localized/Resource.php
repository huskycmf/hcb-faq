<?php
namespace HcbFaq\Stdlib\Extractor\Localized;

use Doctrine\ORM\EntityManagerInterface;
use Zf2Libs\Stdlib\Extractor\ExtractorInterface;
use Zf2Libs\Stdlib\Extractor\Exception\InvalidArgumentException;
use HcbFaq\Entity\Faq\Localized as LocalizedEntity;

class Resource implements ExtractorInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Extract values from an object
     *
     * @param  LocalizedEntity $localizedEntity
     *
     * @throws InvalidArgumentException
     * @return array
     */
    public function extract( $localizedEntity)
    {
        if ( !$localizedEntity instanceof LocalizedEntity) {
            throw new InvalidArgumentException
                ("Expected HcbFaq\\Entity\\Deal\\Localized object, invalid object given");
        }

        $localeEntity = $localizedEntity->getLocale();

        $localData = array('locale'=>($localeEntity ? $localeEntity->getLocale() : ''),
                           'question'=> $localizedEntity->getQuestion(),
                           'answer'=>$localizedEntity->getAnswer());

        if ( $localizedEntity->getId()) {
            $localData['id'] = $localizedEntity->getId();
        }

        return $localData;
    }
}
