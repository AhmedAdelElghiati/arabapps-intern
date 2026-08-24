<?php

namespace App\Traits;

trait ApiResponder
{
    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(422)->respondWithError($message);
    }

    /**
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondInternalError($message = 'Internal ServerError!')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    /**
     * @param  array  $data
     * @param  array  $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data = [], $headers = [])
    {

        $data['success'] = $this->isSuccess();

        if (isset($data['meta']) && isset($data['meta']['message'])) {
            $data['meta']['message'] = $this->formattedMessage($data['meta']['message']);
        }

        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * Wrap a JsonResource (or AnonymousResourceCollection) in our standard
     * envelope and coerce to a JsonResponse so strict controller return
     * types (`: JsonResponse`) remain valid.
     */
    public function respondResource($resource, $metaData = [], $status = 200): \Illuminate\Http\JsonResponse
    {
        $this->statusCode = $status;

        $meta = array_merge($metaData, [
            'message' => isset($metaData['message']) ? $this->formattedMessage($metaData['message']) : null,
        ]);

        if ($resource === null) {
            return response()->json([
                'data' => [],
                'success' => $this->isSuccess(),
                'meta' => $meta,
            ], $this->getStatusCode());
        }

        return $resource
            ->additional(array_merge($resource->additional, [
                'success' => $this->isSuccess(),
                'meta' => $meta,
            ]))
            ->response()
            ->setStatusCode($this->getStatusCode());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message, $code = null)
    {

        return $this->respond([
            'error' => [
                'message' => $this->formattedMessage($message),
                'status_code' => $this->getStatusCode(),
                'code' => $code,
                'payload' => request()->all(),
            ],
        ]);
    }

    /**
     * @param  $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithSuccess($message)
    {
        return $this->respond([
            'meta' => [
                'message' => $message,
            ],
        ]);
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->getStatusCode() < 300;
    }

    protected function formattedMessage($message)
    {
        if (is_array($message)) {
            foreach ($message['replace'] as $key => $value) {
                if (str_contains($value, 'app.')) {
                    $message['replace'][$key] = __($value);
                }
            }

            return __($message['text'], $message['replace']);
        }

        return __($message);
    }
}
