<?php

namespace App\Controller;

use App\Entity\User;
use App\GraphQL\Context;
use App\GraphQL\TypeRegistry;
use GraphQL\Error\DebugFlag;
use GraphQL\GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\Validator\Rules;
use GraphQL\Server\ServerConfig;
use GraphQL\Server\StandardServer;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class GraphqlController extends AbstractController
{
    private TypeRegistry $typeRegistry;
    private HttpMessageFactoryInterface $httpFactory;

    public function __construct(
        TypeRegistry $typeRegistry,
        HttpMessageFactoryInterface $httpFactory
    ) {
        $this->typeRegistry = $typeRegistry;
        $this->httpFactory = $httpFactory;
    }

    /**
     * @Route("/", name="graphql", methods={"POST"})
     */
    public function index(Request $request): Response
    {
        $typeRegistry = $this->typeRegistry;
        $schema = new Schema([
            'query' => $typeRegistry->getType('Query'),
            'mutation' => $typeRegistry->getType('Mutation'),
            'typeLoader' => static function (string $typeName) use ($typeRegistry): Type {
                return $typeRegistry->getType($typeName);
            }
        ]);

        $validatorRules = array_merge(
            GraphQL::getStandardValidationRules(),
            [
                new Rules\QueryComplexity(PHP_INT_MAX),
            ]
        );
        $debugFlag = DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE | DebugFlag::RETHROW_INTERNAL_EXCEPTIONS | DebugFlag::RETHROW_UNSAFE_EXCEPTIONS;
        $psrRequest = $this->httpFactory->createRequest($request);
        /** @var User|null $user */
        $user = $this->getUser();
        $config = ServerConfig::create()
            ->setSchema($schema)
            ->setContext(new Context($user))
            ->setDebugFlag($debugFlag)
            ->setValidationRules($validatorRules)
        ;

        $server = new StandardServer($config);
        $psrResponse = $server->executePsrRequest($psrRequest);
        return new JsonResponse($psrResponse);
    }
}
