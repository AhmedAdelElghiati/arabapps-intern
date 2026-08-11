<?php
namespace App\Repositories\Admin;
use App\Models\Faq;
class FaqsRepository 
{

    public function getAllFaqs()
    {
        $query = Faq::query();
        $faqs=$query->paginate(10);
        return $faqs;
    }
    public function getFaqById($id)
    {
        return  Faq::find($id);

    }
    public function createFaq(array $data)
    {
        return Faq::create($data);
    }
    public function updateFaq($id, array $data)
    {

        $faq = Faq::find($id);

        return $faq->update($data);

    }
    public function deleteFaq($id)
    {
        $faq = Faq::find($id);
        return $faq->delete();
    }
}