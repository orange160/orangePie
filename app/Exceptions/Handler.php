<?php

namespace App\Exceptions;

use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param Throwable $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($this->isApiRequest($request)) {
            return $this->renderApiException($e);
        }

        // Handle notify exceptions which will redirect to the
        // specified location then show a notification message.
        if ($this->isExceptionType($e, NotifyException::class)) {
            $message = $this->getOriginalMessage($e);
            if (!empty($message)) {
                session()->flash('error', $message);
            }
            return redirect($e->redirectLocation);
        }

        // Handle pretty exceptions which will show a friendly application-fitting page
        // which will include the basic message to point the user roughly to the cause
        if ($this->isExceptionType($e, PrettyException::class) && !config('app.debug')) {
            $message = $this->getOriginalMessage($e);
            $code = ($e->getCode() === 0) ? 500 : $e->getCode();
            return response()->view('errors/'.$code, ['message' => $message], $code);
        }

        // Handle 404 errors with a loaded session to enable showing user-specific information
        if ($this->isExceptionType($e, NotFoundHttpException::class)) {
            return \Route::responseWithRoute('fallback');
        }

        return parent::render($request, $e);
    }

    /**
     * 判断获取的request是否来自API
     * @param Request $request
     * @return bool
     */
    protected function isApiRequest(Request $request): bool
    {
        return strpos($request->path(), 'api/') === 0;
    }

    /**
     * 返回一个API的异常信息
     * @param Exception $e
     * @return JsonResponse
     */
    protected function renderApiException(Exception $e): JsonResponse
    {
        $code = $e->getCode() === 0 ? 500 : $e->getCode();
        $headers = [];
        if ($e instanceof HttpException) {
            $code = $e->getStatusCode();
            $headers = $e->getHeaders();
        }

        $responseData = [
            'error' => [
                'message' => $e->getMessage()
            ]
        ];

        if ($e instanceof ValidationException) {
            $responseData['error']['validation'] = $e->errors();
            $code = $e->status;
        }

        $responseData['error']['code'] = $code;
        return new JsonResponse($responseData, $code, $headers);
    }

    /**
     * 检查异常是否是指定类型
     * @param Exception $e
     * @param $type
     * @return bool
     */
    protected function isExceptionType(Exception $e, $type) {
        do {
            if (is_a($e, $type)) {
                return true;
            }
        } while ($e = $e->getPrevious());
        return false;
    }

    /**
     * 获取最原始的异常信息
     * @param Exception $e
     * @return string
     */
    protected function getOriginalMessage(Exception $e)
    {
        do {
            $message = $e->getMessage();
        } while($e = $e->getPrevious());
        return $message;
    }

    /**
     * Convert an authentication exception into an unauthenticated response
     *
     * @param Request $request
     * @param AuthenticationException $exception
     * @return JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated', 401]);
        }
        return redirect()->guest('login');
    }

    /**
     * Convert a validation exception into a JSON response
     *
     * @param Request $request
     * @param \Illuminate\Validation\ValidationException $exception
     * @return JsonResponse
     */
    protected function invalidJson($request, \Illuminate\Validation\ValidationException $exception)
    {
        return response()->json($exception->errors(), $exception->status);
    }

}
