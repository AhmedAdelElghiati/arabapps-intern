<?php 
namespace App\Services;
use App\Models\Faqs;
use App\Repositories\Interfaces\FaqsInterface;
use App\Http\Requests\FaqsRequest;
use App\Repositories\Eloquent\FaqsRepositories;
use App\Http\Requests\UpdateFaqsRequest;
class FaqsService{
    private $faqsRepository;
    public function __construct(FaqsRepositories $faqsRepository)
    {
        $this->faqsRepository = $faqsRepository;
    }
    public function getAllFaqs(){
        return $this->faqsRepository->getAllFaqs();
    }
    public function getFaqById($id){
        return $this->faqsRepository->getFaqById($id);
    }
    public function createFaq(FaqsRequest $request){
        $data = $request->validated();
        // dd($data);
        return $this->faqsRepository->createFaq($data);
    }
    public function updateFaq($id,UpdateFaqsRequest $request){
       $data = $request->validated();      
       return $this->faqsRepository->updateFaq($id,$data);
    
       
    }
    public function deleteFaq($id){
        return $this->faqsRepository->deleteFaq($id);
        
    }
    
}
