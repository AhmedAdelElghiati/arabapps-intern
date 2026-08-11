<?php
namespace App\Repositories\User;

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

}