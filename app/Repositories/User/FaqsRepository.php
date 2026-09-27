<?php
namespace App\Repositories\User;

use App\Models\Faq;
class FaqsRepository 
{

    public function getAllFaqs(?string $search = null)
    {
        $query = Faq::query();

        if ($search) {
            $query->where(function ($query) use ($search) {
                foreach (['question', 'answer', 'category'] as $field) {
                    $query->orWhere($field, 'like', "%{$search}%");
                }
            });
        }

        return $query->paginate(10)->withQueryString();
    }
    public function getFaqById($id)
    {
        return  Faq::find($id);

    }

}