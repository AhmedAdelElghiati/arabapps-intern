<?php
namespace App\Repositories\User;

use App\Models\Faq;
class FaqsRepository 
{

    public function getAllFaqs(?string $search = null)
    {
        $query = Faq::query();

        if ($search) {
            $query->where('question', 'like', "%{$search}%")
                ->orWhere('answer', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%");
        }

        return $query->paginate(10)->withQueryString();
    }
    public function getFaqById($id)
    {
        return  Faq::findOrFail($id);

    }

}