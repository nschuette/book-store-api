<?php

declare(strict_types=1);

namespace App\Handler\BookList;

use App\Exception\InvalidRequest;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\InputFilter\Factory;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\InArray;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class BookListRequestMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $queryParams = $request->getQueryParams();

        $requestFilter = $this->createRequestFilter();
        $requestFilter->setData($queryParams);

        if ($requestFilter->isValid() === false) {
            throw InvalidRequest::byErrorMessages($requestFilter->getMessages());
        }

        $bookListRequest = BookListRequest::createFromArray($requestFilter->getValues());

        return $handler->handle(
            $request->withAttribute(BookListRequest::class, $bookListRequest)
        );
    }

    private function createRequestFilter(): InputFilterInterface
    {
        $factory = new Factory();

        return $factory->createInputFilter([
            'sort_by' => [
                'required'    => false,
                'allow_empty' => true,
                'filters'     => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class],
                ],
                'validators'  => [
                    [
                        'name'    => InArray::class,
                        'options' => [
                            'haystack' => BookListHandler::ALLOWED_SORT_BY_FIELDS,
                            'messages' => [
                                InArray::NOT_IN_ARRAY => sprintf(
                                    'Invalid sort field given. Allowed are: %s',
                                    implode(', ', BookListHandler::ALLOWED_SORT_BY_FIELDS)
                                ),
                            ]
                        ],
                    ]
                ],
            ],
            'order'   => [
                'required'    => false,
                'allow_empty' => true,
                'filters'     => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class],
                ],
                'validators'  => [
                    [
                        'name'    => InArray::class,
                        'options' => [
                            'haystack' => BookListHandler::ALLOWED_ORDERINGS,
                            'messages' => [
                                InArray::NOT_IN_ARRAY => sprintf(
                                    'Invalid ordering given. Allowed are: %s',
                                    implode(', ', BookListHandler::ALLOWED_ORDERINGS)
                                ),
                            ]
                        ],
                    ]
                ],
            ],
        ]);
    }
}