<?php
namespace HcbFaq\Service\Localized;

use Doctrine\ORM\EntityManagerInterface;
use HcbFaq\Data\LocalizedInterface;
use HcbFaq\Entity\Faq\Localized;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class UpdateService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var Response
     */
    protected $saveResponse;

    /**
     * @param EntityManagerInterface $entityManager
     * @param Response $saveResponse
     */
    public function __construct(EntityManagerInterface $entityManager,
                                Response $saveResponse)
    {
        $this->entityManager = $entityManager;
        $this->saveResponse = $saveResponse;
    }

    /**
     * @param \HcbFaq\Entity\Faq\Localized $localizedEntity
     * @param LocalizedInterface $localizedData
     *
     * @return Response
     */
    public function update(Localized $localizedEntity,
                           LocalizedInterface $localizedData)
    {
        try {
            $this->entityManager->beginTransaction();

            $localizedEntity->setQuestion($localizedData->getQuestion());
            $localizedEntity->setAnswer($localizedData->getAnswer());
            $localizedEntity->getFaq()->setEnabled(true);

            $this->entityManager->persist($localizedEntity);

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->saveResponse->error($e->getMessage())->failed();
            return $this->saveResponse;
        }

        $this->saveResponse->success();
        return $this->saveResponse;
    }
}
