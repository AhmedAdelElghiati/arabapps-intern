<?php 
namespace App\Repositories\Interfaces;
interface FaqsInterface
{
    public function getAllFaqs();
    public function getFaqById($id);
    public function createFaq(array $data);
    public function updateFaq($id, array $data);
    public function deleteFaq($id);
}
