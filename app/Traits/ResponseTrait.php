<?php

namespace App\Traits;

use Illuminate\Http\Response as illuminateResponse;
use Illuminate\Pagination\LengthAwarePaginator;

trait ResponseTrait
{
    protected $statusCode = 200;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param  $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    protected function respondCreated($message, $data = null)
    {
        return $this->setStatusCode(illuminateResponse::HTTP_CREATED)->respond([
            'message' => $message,
            'data' => $data,
        ]);
    }

    public function respondWithSuccess($message, $data = null)
    {
        return $this->respond([
            'message' => $message,
            'data' => $data,
        ]);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'message' => $message,
        ]);
    }

    /**
     * @param $data
     * @param  array  $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    protected function respondWithPagination(LengthAwarePaginator $paginatedResult, $data)
    {
        $data = array_merge($data, [

            'paginator' => [
                'totalCount' => $paginatedResult->total(),
                'totalPages' => ceil($paginatedResult->total() / $paginatedResult->perPage()),
                'currentPage' => $paginatedResult->currentPage(),
                'limit' => $paginatedResult->perPage(),
            ],
        ]);

        return $this->respond($data);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondBadRequest($message = 'Something Went Wrong With Request')
    {
        return $this->setStatusCode(illuminateResponse::HTTP_BAD_REQUEST)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondUnAuthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(illuminateResponse::HTTP_UNAUTHORIZED)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondAccessDenied($message = 'Access denied')
    {
        return $this->setStatusCode(illuminateResponse::HTTP_FORBIDDEN)->respondWithError($message);
    }
}
