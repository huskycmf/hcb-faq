<?php
namespace HcbFaq\Service\Collection;

use HcbFaq\Entity\Faq as FaqEntity;
use HcCore\Data\Collection\Entities\ByIdsInterface;
use HcCore\Service\CommandInterface;
use Doctrine\ORM\EntityManagerInterface;
use Zf2Libs\Stdlib\Service\Response\Messages\Response;

class DeleteService implements CommandInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var ByIdsInterface
     */
    protected $deleteData;

    /**
     * @param EntityManagerInterface $entityManager
     * @param Response $response
     * @param ByIdsInterface $deleteData
     */
    public function __construct(EntityManagerInterface $entityManager,
                                Response $response,
                                ByIdsInterface $deleteData)
    {
        $this->entityManager = $entityManager;
        $this->response = $response;
        $this->deleteData = $deleteData;
    }

    /**
     * @return Response
     */
    public function execute()
    {
        return $this->delete($this->deleteData);
    }

    /**
     * @param \HcCore\Data\Collection\Entities\ByIdsInterface $faqsToDelete
     * @return Response
     */
    protected  function delete(ByIdsInterface $faqsToDelete)
    {
        try {
            $this->entityManager->beginTransaction();
            $faqEntities = $faqsToDelete->getEntities();

            /* @var $faqEntities FaqEntity[] */
            foreach ($faqEntities as $faqEntity) {
                $this->entityManager->remove($faqEntity);
            }
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            $this->response->error($e->getMessage())->failed();
            return $this->response;
        }

        $this->response->success();
        return $this->response;
    }
}
