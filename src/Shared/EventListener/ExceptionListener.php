<?php

declare(strict_types=1);

namespace App\Shared\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        /*
         * #BUG Exception wrapped in HandlerFailedException
         * https://stackoverflow.com/questions/55558350/custom-exception-from-messenger-handler
         * As you can see on CHANGELOG, a BC break was introduced in version 4.3. In my application
         * I was catching exceptions, and I solved by adding following code:
         */
        if ($exception instanceof HandlerFailedException) {
            $exception = $exception->getPrevious();
        }

        $message = [
            'code' => $exception->getCode(),
            'reason' => $exception->getMessage(),
        ];

        // Customize your response object to display the exception details
        $response = new JsonResponse($message);

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            // $response->headers->replace($exception->getHeaders()); # using default headers
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // sends the modified response object to the event
//        $event->setResponse($response);
    }
}
