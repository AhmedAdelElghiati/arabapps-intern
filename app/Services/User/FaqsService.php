<?php 
namespace App\Services\User;

use App\Repositories\User\FaqsRepository;

class FaqsService{
    private $faqsRepository;
    public function __construct(FaqsRepository $faqsRepository)
    {
        $this->faqsRepository = $faqsRepository;
    }
    public function getAllFaqs(){
        return $this->faqsRepository->getAllFaqs();
    }
    public function getFaqById($id){
        return $this->faqsRepository->getFaqById($id);
    }
   
}
