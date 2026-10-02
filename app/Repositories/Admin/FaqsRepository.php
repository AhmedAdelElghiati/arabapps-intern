<?php
namespace App\Repositories\Admin;
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
        return Faq::findOrFail($id);

    }
    public function createFaq(array $data)
    {
        return Faq::create($data);
    }
    public function updateFaq($id, array $data)
    {

        $faq = Faq::findOrFail($id);

        return $faq->update($data);

    }
    public function deleteFaq($id)
    {
        $faq = Faq::findOrFail($id);
        return $faq->delete();
    }
}