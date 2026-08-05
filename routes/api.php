use App\Http\Controllers\User\Api\SuccessStoryApiController;

Route::get('/success-stories', [SuccessStoryApiController::class, 'index']);
