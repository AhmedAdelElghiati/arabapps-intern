<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqsResource;
use Illuminate\Http\Request;

use App\Services\FaqsService;
class FaqsController extends Controller
{
    //
    private $faqservice;
    public function __construct(FaqsService $faqservice)
    {
        $this->faqservice = $faqservice;
    }
    public function show($id)
    {
        $faqs=$this->faqservice->getFaqById($id);
        return response()->json(['faqs' =>new FaqsResource($faqs)], 200);
    }
    public function index()
    {
        $faqs=$this->faqservice->getAllFaqs();
        return response()->json(['faqs' => FaqsResource::collection($faqs)], 200);
    }
}
