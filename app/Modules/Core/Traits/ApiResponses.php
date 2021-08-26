<?php

namespace App\Modules\Core\Traits;

use Exception;
use Illuminate\Http\JsonResponse;

trait ApiResponses
{
    /**
     * @var int
     */
    public $responseCode = 200;

    /**
     * @var string
     */
    public $message = 'OK';

    /**
     * @var string
     */
    public $title = 'Success';

    /**
     * @param int $code
     * @return $this
     */
    public function setCode($code = 200)
    {
        $this->responseCode = $code;
        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function respond($data): JsonResponse
    {
        return response()
            ->json(
                [
                    'message' => $this->message,
                    'code' => $this->responseCode,
                    'data' => $data
                ],
                $this->responseCode);
    }

    /**
     * @param Exception $exception
     * @param array $data
     * @param string $title
     * @return JsonResponse
     */
    public function exceptionRespond(Exception $exception, $data = [], $title = 'Error'): JsonResponse
    {
        return response()->json([
            'title' => $title,
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
//            'data' => $data,
        ], $exception->getCode());
    }

    /**
     * @param Exception $exception
     * @param string $title
     * @return JsonResponse
     */
    public function respondWithExceptionError(Exception $exception, $title = 'Error'): JsonResponse
    {
        return response()
            ->json(
                [
                    'title' => $this->title,
                    'message' => $this->message,
                ],
                $exception->getCode());
    }

    /**
     * @param $message
     * @param $code
     * @return JsonResponse
     */
    protected function errorResponse($message, $code): JsonResponse
    {
        return response()->json(['message' => $message, 'code' => $code], $code);
    }

    /**
     * @param $data
     * @param $code
     * @return JsonResponse
     */
    private function successResponse($data, $code): JsonResponse
    {
        return response()->json($data, $code);
    }

}
