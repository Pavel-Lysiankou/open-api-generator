<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends Exception
{
    private const STATUS_CODE = Response::HTTP_BAD_REQUEST;
    private const MESSAGE = 'Validation failed';

    public function __construct(private readonly ConstraintViolationListInterface $errors)
    {
        // @todo: format errors

        parent::__construct(self::MESSAGE, self::STATUS_CODE);
    }
}
