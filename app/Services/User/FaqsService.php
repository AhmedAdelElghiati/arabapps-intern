<?php 
namespace App\Services\User;

use App\Repositories\User\FaqsRepository;

class FaqsService{
    private $faqsRepository;
    public function __construct(FaqsRepository $faqsRepository)
    {
        $this->faqsRepository = $faqsRepository;
    }
    public function getAllFaqs(?string $search = null)
    {
        return $this->faqsRepository->getAllFaqs($search);
    }
    public function getFaqById($id){
        return $this->faqsRepository->getFaqById($id);
    }
   
}
