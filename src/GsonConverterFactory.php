<?php
/*
 * Copyright (c) Nate Brunette.
 * Distributed under the MIT License (http://opensource.org/licenses/MIT)
 */

declare(strict_types=1);

namespace Tebru\RetrofitConverter\Gson;

use Tebru\Gson\Gson;
use Tebru\PhpType\TypeToken;
use Tebru\Retrofit\ConverterFactory;
use Tebru\Retrofit\RequestBodyConverter;
use Tebru\Retrofit\ResponseBodyConverter;
use Tebru\Retrofit\StringConverter;

/**
 * Creates request or response converters
 *
 * @author Nate Brunette <n@tebru.net>
 */
class GsonConverterFactory implements ConverterFactory
{
    /**
     * @var Gson
     */
    private $gson;

    /**
     * Constructor
     *
     * @param Gson $gson
     */
    public function __construct(Gson $gson)
    {
        $this->gson = $gson;
    }

    /**
     * Return a [@see ResponseBodyConverter] or null
     *
     * @param TypeToken $type
     * @return null|ResponseBodyConverter
     */
    public function responseBodyConverter(TypeToken $type): ?ResponseBodyConverter
    {
        return new GsonResponseBodyConverter($this->gson, $type);
    }

    /**
     * Return a [@see RequestBodyConverter] or null
     *
     * @param TypeToken $type
     * @return null|RequestBodyConverter
     */
    public function requestBodyConverter(TypeToken $type): ?RequestBodyConverter
    {
        return new GsonRequestBodyConverter($this->gson, $type);
    }

    /**
     * Return a [@see StringConverter] or null
     *
     * @param TypeToken $type
     * @return null|StringConverter
     */
    public function stringConverter(TypeToken $type): ?StringConverter
    {
        return null;
    }
}
