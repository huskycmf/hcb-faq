<?php
namespace HcbFaq\Service\Localized;

use HcCore\Entity\EntityInterface;
use HcCore\Service\ResourceCommandInterface;
use HcbFaq\Data\LocalizedInterface;
use HcbFaq\Entity\Faq as FaqEntity;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class CreateCommand implements ResourceCommandInterface
{
    /**
     * @var LocalizedInterface
     */
    protected $localizedData;

    /**
     * @var CreateService
     */
    protected $service;

    /**
     * @param LocalizedInterface $localizedData
     * @param CreateService $service
     */
    public function __construct(LocalizedInterface $localizedData,
                                CreateService $service)
    {
        $this->localizedData = $localizedData;
        $this->service = $service;
    }

    /**
     * @param FaqEntity $faqEntity
     *
     * @return Response
     */
    public function execute(EntityInterface $faqEntity)
    {
        return $this->service->save($faqEntity, $this->localizedData);
    }
}
