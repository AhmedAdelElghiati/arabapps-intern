<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqsResource;
use App\Http\Requests\SearchRequest;
use App\Traits\ApiResponder;

use App\Services\User\FaqsService;
class FaqsController extends Controller
{
    //
    use ApiResponder;
    private $faqservice;
    public function __construct(FaqsService $faqservice)
    {
        $this->faqservice = $faqservice;
    }
    public function show($id)
    {
        $faqs = $this->faqservice->getFaqById($id);
        if (!$faqs) {
            return $this->respondNotFound('FAQ not found');
        }
        return $this->respondResource(
            new FaqsResource($faqs)
        );
    }
    public function index(SearchRequest $request)
    {
        $faqs = $this->faqservice->getAllFaqs($request->validated('search'));

       return $this->respondResource(
            FaqsResource::collection($faqs)
        );
    }
}
