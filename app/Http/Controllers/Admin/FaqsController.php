<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateFaqsRequest;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Services\FaqsService;
use App\Http\Requests\FaqsRequest;
class FaqsController extends Controller
{
    //

    private $faqsService;
    public function __construct(FaqsService $faqsService)
    {
        $this->faqsService = $faqsService;
    }
    public function index()
    {
        $faqs = $this->faqsService->getAllFaqs();
        if (!$faqs) {
            return redirect()->route('faqs.index')->with('error', 'No faqs found');
        }
        return view('faqs.index', compact('faqs'));
    }
    public function show($id){
        $faq=$this->faqsService->getFaqById($id);
        if (!$faq) {
            return redirect()->route('faqs.index')->with('error', 'Faq not found');
        }
        return view('faqs.show', compact('faq'));

    }
    public function create()
    {
        return view('faqs.create');
    }
    public function store(FaqsRequest $request)
    {
       $this->faqsService->createFaq($request);
        return redirect()->route('faqs.index')->with('success', 'Faq created successfully');
    }
    public function edit($id){
        $faq=$this->faqsService->getFaqById($id);
        if (!$faq) {
            return redirect()->route('faqs.index')->with('error', 'Faq not found');
        }
        return view('faqs.update',compact('faq'));
    }
    public function update(UpdateFaqsRequest $request, $id)
    {
        $this->faqsService->updateFaq($id, $request);
        if (!$this->faqsService->getFaqById($id)) {
            return redirect()->route('faqs.index')->with('error', 'Faq not found');
        }
       return redirect()->route('faqs.index')->with('success', 'Faq updated successfully');
    }
    public function delete($id){
       $this->faqsService->deleteFaq($id);
       if (!$this->faqsService->getFaqById($id)) {
        return redirect()->route('faqs.index')->with('error', 'Faq not found');
       }
      
        return redirect()->route('faqs.index')->with('success', 'Faq deleted successfully');
    }

}
