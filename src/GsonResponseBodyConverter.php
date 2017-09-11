<?php
/*
 * Copyright (c) Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

declare(strict_types=1);

namespace Tebru\RetrofitConverter\Gson;

use Psr\Http\Message\StreamInterface;
use Tebru\Gson\Gson;
use Tebru\PhpType\TypeToken;
use Tebru\Retrofit\ResponseBodyConverter;

/**
 * Converts a [@see StreamInterface] to any type
 *
 * @author Nate Brunette <n@tebru.net>
 */
class GsonResponseBodyConverter implements ResponseBodyConverter
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
     * Convert from stream to any type
     *
     * @param StreamInterface $value
     * @return mixed
     */
    public function convert(StreamInterface $value)
    {
        if ($this->type->isA(StreamInterface::class)) {
            return $value;
        }

        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return $this->gson->fromJson((string)$value, (string)$this->type);
    }
}
