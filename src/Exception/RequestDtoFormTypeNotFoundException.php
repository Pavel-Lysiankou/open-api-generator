<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class RequestDtoFormTypeNotFoundException extends Exception
{
    private const STATUS_CODE = Response::HTTP_BAD_REQUEST;
    private const MESSAGE = 'Form type for dto: `%s` not found';

    public function __construct()
    {
        parent::__construct(self::MESSAGE, self::STATUS_CODE);
    }
}
