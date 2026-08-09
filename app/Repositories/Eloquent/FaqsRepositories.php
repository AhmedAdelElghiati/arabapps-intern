<?php
namespace App\Repositories\Eloquent;
use App\Repositories\Interfaces\FaqsInterface;
use App\Models\Faq;
class FaqsRepositories implements FaqsInterface
{

    public function getAllFaqs()
    {
        return Faq::all();
    }
    public function getFaqById($id)
    {
        if (!Faq::find($id)) {
            return null; 
        }
        return Faq::find($id);

    }
    public function createFaq(array $data)
    {
        return Faq::create($data);
    }
    public function updateFaq($id, array $data)
    {
        $faq = Faq::find($id);
        if (!$faq) {
            return null; 
        }
        $faq->update($data);
        return $faq;

    }
    public function deleteFaq($id)
    {
        $faq = Faq::find($id);
        if (!$faq) {
            return null; 
        }
        return $faq->delete();
    }
}