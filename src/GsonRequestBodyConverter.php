<?php
/*
 * Copyright (c) Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

declare(strict_types=1);

namespace Tebru\RetrofitConverter\Gson;

use GuzzleHttp\Psr7;
use Psr\Http\Message\StreamInterface;
use Tebru\Gson\Gson;
use Tebru\PhpType\TypeToken;
use Tebru\Retrofit\RequestBodyConverter;

/**
 * Converts any type to a [@see StreamInterface]
 *
 * @author Nate Brunette <n@tebru.net>
 */
class GsonRequestBodyConverter implements RequestBodyConverter
{
    /**
     * @var Gson
     */
    private $gson;

    /**
     * @var TypeToken
     */
    private $type;

    /**
     * Constructor
     *
     * @param Gson $gson
     * @param TypeToken $type
     */
    public function __construct(Gson $gson, TypeToken $type)
    {
        $this->gson = $gson;
        $this->type = $type;
    }

    /**
     * Convert to stream
     *
     * @param mixed $value
     * @return StreamInterface
     */
    public function convert($value): StreamInterface
    {
        if ($this->type->isA(StreamInterface::class)) {
            return $value;
        }

        return Psr7\stream_for($this->gson->toJson($value));
    }
}
