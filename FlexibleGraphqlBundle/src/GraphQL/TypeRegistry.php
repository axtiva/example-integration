<?php
/**
 * Autogenerated file by axtiva/flexible-graphql-php Do not edit it manually
 */ 
namespace App\GraphQL;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use Axtiva\FlexibleGraphql\Type\EnumType;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\CustomScalarType;
use GraphQL\Type\Definition\UnionType;
use GraphQL\Type\Definition\Directive;
use GraphQL\Type\Definition\FieldArgument;
use GraphQL\Type\Definition\FieldDefinition;
use GraphQL\Type\Definition\InputObjectField;
use Psr\Container\ContainerInterface;
use GraphQL\Type\Schema;

class TypeRegistry
{
    private ContainerInterface $container;
    
    /**
     * @var array<string, Type>
     */
    private array $types = [];
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getType(string $name): Type
    {
        return $this->types[$name] ??= $this->{$name}();
    }
    
    
            public function Query()
            {
                return new ObjectType([
            'name' => 'Query',
            'description' => NULL,
            'fields' => fn() => ['currentUser' => FieldDefinition::create([
            'name' => 'currentUser',
            'description' => NULL,
            'deprecationReason' => NULL,
            'resolve' => (function ($rootValue, $args, $context, $info) {
    
    return $this->container->get('App\GraphQL\Resolver\Query\CurrentUserResolver')($rootValue, $args, $context, $info);
}),
            'type' => function() { return $this->getType('User'); },
            'args' => [],
        ]),'mod' => FieldDefinition::create([
            'name' => 'mod',
            'description' => NULL,
            'deprecationReason' => NULL,
            'resolve' => function($rootValue, $args, $context, $info) {
                        return $this->container->get('App\GraphQL\Directive\PowDirective')(
                        (function ($rootValue, $args, $context, $info) {
    $args = new \App\GraphQL\ResolverArgs\Query\ModResolverArgs($args);
    return $this->container->get('App\GraphQL\Resolver\Query\ModResolver')($rootValue, $args, $context, $info);
}), 
                        array (
  'ex' => '3',
),
                        $rootValue, $args, $context, $info
                        );
                    },
            'type' => function() { return Type::nonNull(function() { return Type::int(); }); },
            'args' => ['input' => [
            'name' => 'input',
            'type' => function() { return Type::nonNull(function() { return $this->getType('ModInput'); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]],
        ]),'echo' => FieldDefinition::create([
            'name' => 'echo',
            'description' => NULL,
            'deprecationReason' => NULL,
            'resolve' => function($rootValue, $args, $context, $info) {
                        return $this->container->get('App\GraphQL\Directive\IsAuthenticatedDirective')(
                        (function ($rootValue, $args, $context, $info) {
    $args = new \App\GraphQL\ResolverArgs\Query\EchoResolverArgs($args);
    return $this->container->get('App\GraphQL\Resolver\Query\EchoResolver')($rootValue, $args, $context, $info);
}), 
                        array (
),
                        $rootValue, $args, $context, $info
                        );
                    },
            'type' => function() { return Type::nonNull(function() { return Type::string(); }); },
            'args' => ['input' => [
            'name' => 'input',
            'type' => function() { return Type::nonNull(function() { return Type::string(); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]],
        ]),'print' => FieldDefinition::create([
            'name' => 'print',
            'description' => NULL,
            'deprecationReason' => 'Use echo field',
            'resolve' => function($rootValue, $args, $context, $info) {
                        return $this->container->get('App\GraphQL\Directive\IsAuthenticatedDirective')(
                        (function ($rootValue, $args, $context, $info) {
    $args = new \App\GraphQL\ResolverArgs\Query\PrintResolverArgs($args);
    return $this->container->get('App\GraphQL\Resolver\Query\PrintResolver')($rootValue, $args, $context, $info);
}), 
                        array (
),
                        $rootValue, $args, $context, $info
                        );
                    },
            'type' => function() { return Type::nonNull(function() { return Type::string(); }); },
            'args' => ['input' => [
            'name' => 'input',
            'type' => function() { return Type::nonNull(function() { return Type::string(); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]],
        ]),'dayTime' => FieldDefinition::create([
            'name' => 'dayTime',
            'description' => NULL,
            'deprecationReason' => NULL,
            'resolve' => (function ($rootValue, $args, $context, $info) {
    $args = new \App\GraphQL\ResolverArgs\Query\DayTimeResolverArgs($args);
    return $this->container->get('App\GraphQL\Resolver\Query\DayTimeResolver')($rootValue, $args, $context, $info);
}),
            'type' => function() { return new ListOfType(function() { return $this->getType('DateTime'); }); },
            'args' => ['timestamps' => [
            'name' => 'timestamps',
            'type' => function() { return Type::nonNull(function() { return new ListOfType(function() { return Type::nonNull(function() { return new ListOfType(function() { return Type::nonNull(function() { return $this->getType('TimestampInput'); }); }); }); }); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]],
        ]),'time' => FieldDefinition::create([
            'name' => 'time',
            'description' => NULL,
            'deprecationReason' => NULL,
            'resolve' => function($rootValue, $args, $context, $info) {
                        return $this->container->get('App\GraphQL\Directive\HasRoleDirective')(
                        (function ($rootValue, $args, $context, $info) {
    
    return $this->container->get('App\GraphQL\Resolver\Query\TimeResolver')($rootValue, $args, $context, $info);
}), 
                        array (
  'role' => 'watcher',
),
                        $rootValue, $args, $context, $info
                        );
                    },
            'type' => function() { return Type::nonNull(function() { return $this->getType('Time'); }); },
            'args' => [],
        ]),'account' => FieldDefinition::create([
            'name' => 'account',
            'description' => NULL,
            'deprecationReason' => NULL,
            'resolve' => (function ($rootValue, $args, $context, $info) {
    $args = new \App\GraphQL\ResolverArgs\Query\AccountResolverArgs($args);
    return $this->container->get('App\GraphQL\Resolver\Query\AccountResolver')($rootValue, $args, $context, $info);
}),
            'type' => function() { return $this->getType('Account'); },
            'args' => ['id' => [
            'name' => 'id',
            'type' => function() { return Type::nonNull(function() { return Type::id(); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]],
        ]),'accounts' => FieldDefinition::create([
            'name' => 'accounts',
            'description' => NULL,
            'deprecationReason' => NULL,
            'resolve' => (function ($rootValue, $args, $context, $info) {
    
    return $this->container->get('App\GraphQL\Resolver\Query\AccountsResolver')($rootValue, $args, $context, $info);
}),
            'type' => function() { return new ListOfType(function() { return $this->getType('Account'); }); },
            'args' => [],
        ]),'_service' => FieldDefinition::create([
            'name' => '_service',
            'description' => NULL,
            'deprecationReason' => NULL,
            'resolve' => (function ($rootValue, $args, $context, $info) {
    
    return $this->container->get('App\GraphQL\Resolver\Query\_serviceResolver')($rootValue, $args, $context, $info);
}),
            'type' => function() { return Type::nonNull(function() { return $this->getType('_Service'); }); },
            'args' => [],
        ]),'_entities' => FieldDefinition::create([
            'name' => '_entities',
            'description' => NULL,
            'deprecationReason' => NULL,
            'resolve' => (function ($rootValue, $args, $context, $info) {
    $args = new \App\GraphQL\ResolverArgs\Query\_entitiesResolverArgs($args);
    return $this->container->get('App\GraphQL\Resolver\Query\_entitiesResolver')($rootValue, $args, $context, $info);
}),
            'type' => function() { return Type::nonNull(function() { return new ListOfType(function() { return $this->getType('_Entity'); }); }); },
            'args' => ['representations' => [
            'name' => 'representations',
            'type' => function() { return Type::nonNull(function() { return new ListOfType(function() { return Type::nonNull(function() { return $this->getType('_Any'); }); }); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]],
        ])],
        ]);
            }
        


            public function User()
            {
                return new ObjectType([
            'name' => 'User',
            'description' => NULL,
            'fields' => fn() => ['username' => FieldDefinition::create([
            'name' => 'username',
            'description' => NULL,
            'deprecationReason' => NULL,
            // No resolver. Default used
            'type' => function() { return Type::nonNull(function() { return Type::string(); }); },
            'args' => [],
        ]),'role' => FieldDefinition::create([
            'name' => 'role',
            'description' => NULL,
            'deprecationReason' => NULL,
            // No resolver. Default used
            'type' => function() { return Type::nonNull(function() { return Type::string(); }); },
            'args' => [],
        ])],
        ]);
            }
        


            public function ModInput()
            {
                return new InputObjectType([
        'name' => 'ModInput',
        'description' =>  NULL,
        'fields' => fn() => ['x' => [
            'name' => 'x',
            'description' => NULL,
            'defaultValue' => NULL,
            'type' => Type::nonNull(function() { return Type::int(); }),
        ],'y' => [
            'name' => 'y',
            'description' => NULL,
            'defaultValue' => NULL,
            'type' => Type::nonNull(function() { return $this->getType('NotZeroInt'); }),
        ]],
        ]);
            }
        


            public function NotZeroInt()
            {
                return new CustomScalarType([
            'name' => 'NotZeroInt',
            'description' => 'Accept not 0 value',
            'serialize' => function($value) {return ($this->container->get('App\GraphQL\Scalar\NotZeroIntScalar'))->serialize($value);},
            'parseValue' => function($value) {return ($this->container->get('App\GraphQL\Scalar\NotZeroIntScalar'))->parseValue($value);},
            'parseLiteral' => function($value, $variables) {return ($this->container->get('App\GraphQL\Scalar\NotZeroIntScalar'))->parseLiteral($value, $variables);},
        ]);
            }
        


            public function TimestampInput()
            {
                return new InputObjectType([
        'name' => 'TimestampInput',
        'description' =>  NULL,
        'fields' => fn() => ['ts' => [
            'name' => 'ts',
            'description' => NULL,
            'defaultValue' => NULL,
            'type' => Type::nonNull(function() { return Type::int(); }),
        ]],
        ]);
            }
        


            public function DateTime()
            {
                return new CustomScalarType([
            'name' => 'DateTime',
            'description' => 'Format: ISO8601 YYYY-MM-DDTHH:MM:SS+0000',
            'serialize' => function($value) {return ($this->container->get('App\GraphQL\Scalar\DateTimeScalar'))->serialize($value);},
            'parseValue' => function($value) {return ($this->container->get('App\GraphQL\Scalar\DateTimeScalar'))->parseValue($value);},
            'parseLiteral' => function($value, $variables) {return ($this->container->get('App\GraphQL\Scalar\DateTimeScalar'))->parseLiteral($value, $variables);},
        ]);
            }
        


            public function Time()
            {
                return new CustomScalarType([
            'name' => 'Time',
            'description' => 'Format: HH:MM:SS',
            'serialize' => function($value) {return ($this->container->get('App\GraphQL\Scalar\TimeScalar'))->serialize($value);},
            'parseValue' => function($value) {return ($this->container->get('App\GraphQL\Scalar\TimeScalar'))->parseValue($value);},
            'parseLiteral' => function($value, $variables) {return ($this->container->get('App\GraphQL\Scalar\TimeScalar'))->parseLiteral($value, $variables);},
        ]);
            }
        


            public function Account()
            {
                return new ObjectType([
            'name' => 'Account',
            'description' => NULL,
            'fields' => fn() => ['id' => FieldDefinition::create([
            'name' => 'id',
            'description' => NULL,
            'deprecationReason' => NULL,
            // No resolver. Default used
            'type' => function() { return Type::nonNull(function() { return Type::id(); }); },
            'args' => [],
        ]),'number' => FieldDefinition::create([
            'name' => 'number',
            'description' => NULL,
            'deprecationReason' => NULL,
            // No resolver. Default used
            'type' => function() { return Type::nonNull(function() { return Type::string(); }); },
            'args' => [],
        ]),'currency' => FieldDefinition::create([
            'name' => 'currency',
            'description' => NULL,
            'deprecationReason' => NULL,
            // No resolver. Default used
            'type' => function() { return Type::nonNull(function() { return $this->getType('Currency'); }); },
            'args' => [],
        ]),'status' => FieldDefinition::create([
            'name' => 'status',
            'description' => NULL,
            'deprecationReason' => NULL,
            // No resolver. Default used
            'type' => function() { return Type::nonNull(function() { return $this->getType('AccountStatus'); }); },
            'args' => [],
        ]),'amount' => FieldDefinition::create([
            'name' => 'amount',
            'description' => NULL,
            'deprecationReason' => NULL,
            // No resolver. Default used
            'type' => function() { return Type::nonNull(function() { return Type::int(); }); },
            'args' => [],
        ]),'createdAt' => FieldDefinition::create([
            'name' => 'createdAt',
            'description' => NULL,
            'deprecationReason' => NULL,
            // No resolver. Default used
            'type' => function() { return Type::nonNull(function() { return $this->getType('DateTime'); }); },
            'args' => [],
        ])],
        ]);
            }
        


            public function Currency()
            {
                return new UnionType([
            'name' => 'Currency',
            'description' => NULL,
            'types' => function() { return [$this->getType('NamedCurrency'),$this->getType('CodedCurrency')];},
            'resolveType' => $this->container->get('App\GraphQL\UnionResolveType\CurrencyTypeResolver'),
        ]);
            }
        


            public function NamedCurrency()
            {
                return new ObjectType([
            'name' => 'NamedCurrency',
            'description' => NULL,
            'fields' => fn() => ['name' => FieldDefinition::create([
            'name' => 'name',
            'description' => NULL,
            'deprecationReason' => NULL,
            // No resolver. Default used
            'type' => function() { return Type::nonNull(function() { return Type::string(); }); },
            'args' => [],
        ]),'accounts' => FieldDefinition::create([
            'name' => 'accounts',
            'description' => NULL,
            'deprecationReason' => NULL,
            // No resolver. Default used
            'type' => function() { return Type::nonNull(function() { return new ListOfType(function() { return Type::nonNull(function() { return $this->getType('Account'); }); }); }); },
            'args' => [],
        ])],
        ]);
            }
        


            public function CodedCurrency()
            {
                return new ObjectType([
            'name' => 'CodedCurrency',
            'description' => NULL,
            'fields' => fn() => ['code' => FieldDefinition::create([
            'name' => 'code',
            'description' => NULL,
            'deprecationReason' => NULL,
            // No resolver. Default used
            'type' => function() { return Type::nonNull(function() { return Type::int(); }); },
            'args' => [],
        ]),'accounts' => FieldDefinition::create([
            'name' => 'accounts',
            'description' => NULL,
            'deprecationReason' => NULL,
            // No resolver. Default used
            'type' => function() { return Type::nonNull(function() { return new ListOfType(function() { return Type::nonNull(function() { return $this->getType('Account'); }); }); }); },
            'args' => [],
        ])],
        ]);
            }
        


            public function AccountStatus()
            {
                return new EnumType([
        'name' => 'AccountStatus',
        'description' => NULL,
        'values' => ['ACTIVE' => [
            'name' => 'ACTIVE', 
            'value' => 'ACTIVE',
            'description' => NULL,
            'deprecationReason' => NULL,
            ],
'BLOCKED' => [
            'name' => 'BLOCKED', 
            'value' => 'BLOCKED',
            'description' => NULL,
            'deprecationReason' => NULL,
            ]],
        ]);
            }
        


            public function _Service()
            {
                return new ObjectType([
            'name' => '_Service',
            'description' => NULL,
            'fields' => fn() => ['sdl' => FieldDefinition::create([
            'name' => 'sdl',
            'description' => NULL,
            'deprecationReason' => NULL,
            // No resolver. Default used
            'type' => function() { return Type::nonNull(function() { return Type::string(); }); },
            'args' => [],
        ])],
        ]);
            }
        


            public function _Any()
            {
                return new CustomScalarType([
            'name' => '_Any',
            'description' => NULL,

        ]);
            }
        


            public function _Entity()
            {
                return new UnionType([
            'name' => '_Entity',
            'description' => NULL,
            'types' => function() { return [$this->getType('Account'),$this->getType('NamedCurrency'),$this->getType('CodedCurrency')];},
            'resolveType' => $this->container->get('App\GraphQL\UnionResolveType\_EntityTypeResolver'),
        ]);
            }
        


            public function Mutation()
            {
                return new ObjectType([
            'name' => 'Mutation',
            'description' => NULL,
            'fields' => fn() => ['setAmountAccount' => FieldDefinition::create([
            'name' => 'setAmountAccount',
            'description' => NULL,
            'deprecationReason' => NULL,
            'resolve' => (function ($rootValue, $args, $context, $info) {
    $args = new \App\GraphQL\ResolverArgs\Mutation\SetAmountAccountResolverArgs($args);
    return $this->container->get('App\GraphQL\Resolver\Mutation\SetAmountAccountResolver')($rootValue, $args, $context, $info);
}),
            'type' => function() { return $this->getType('Account'); },
            'args' => ['idAccount' => [
            'name' => 'idAccount',
            'type' => function() { return Type::nonNull(function() { return Type::id(); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ],'amount' => [
            'name' => 'amount',
            'type' => function() { return Type::nonNull(function() { return Type::int(); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]],
        ]),'createAccount' => FieldDefinition::create([
            'name' => 'createAccount',
            'description' => NULL,
            'deprecationReason' => NULL,
            'resolve' => (function ($rootValue, $args, $context, $info) {
    $args = new \App\GraphQL\ResolverArgs\Mutation\CreateAccountResolverArgs($args);
    return $this->container->get('App\GraphQL\Resolver\Mutation\CreateAccountResolver')($rootValue, $args, $context, $info);
}),
            'type' => function() { return $this->getType('Account'); },
            'args' => ['number' => [
            'name' => 'number',
            'type' => function() { return Type::nonNull(function() { return Type::string(); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]],
        ])],
        ]);
            }
        


            public function link__Purpose()
            {
                return new EnumType([
        'name' => 'link__Purpose',
        'description' => NULL,
        'values' => ['SECURITY' => [
            'name' => 'SECURITY', 
            'value' => 'SECURITY',
            'description' => '`SECURITY` features provide metadata necessary to securely resolve fields.',
            'deprecationReason' => NULL,
            ],
'EXECUTION' => [
            'name' => 'EXECUTION', 
            'value' => 'EXECUTION',
            'description' => '`EXECUTION` features provide metadata necessary for operation execution.',
            'deprecationReason' => NULL,
            ]],
        ]);
            }
        


            public function link__Import()
            {
                return new CustomScalarType([
            'name' => 'link__Import',
            'description' => NULL,

        ]);
            }
        


            public function FieldSet()
            {
                return new CustomScalarType([
            'name' => 'FieldSet',
            'description' => NULL,

        ]);
            }
        


    public function directive_link()
    {
        static $directive = null;
        if ($directive === null) {
            $directive = new Directive([
            'name' => 'link',
            'description' => 'Apollo federation directives',
            'isRepeatable' => true,
            'locations' => ['SCHEMA'],
            'args' => [
                [
            'name' => 'url',
            'type' => function() { return Type::string(); },
            'defaultValue' => NULL,
            'description' => NULL,
        ],[
            'name' => 'as',
            'type' => function() { return Type::string(); },
            'defaultValue' => NULL,
            'description' => NULL,
        ],[
            'name' => 'for',
            'type' => function() { return $this->getType('link__Purpose'); },
            'defaultValue' => NULL,
            'description' => NULL,
        ],[
            'name' => 'import',
            'type' => function() { return new ListOfType(function() { return $this->getType('link__Import'); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]
            ],
        ]);
        }
        
        return $directive;
    }
        


    public function directive_external()
    {
        static $directive = null;
        if ($directive === null) {
            $directive = new Directive([
            'name' => 'external',
            'description' => NULL,
            'isRepeatable' => false,
            'locations' => ['FIELD_DEFINITION'],
            'args' => [
                
            ],
        ]);
        }
        
        return $directive;
    }
        


    public function directive_requires()
    {
        static $directive = null;
        if ($directive === null) {
            $directive = new Directive([
            'name' => 'requires',
            'description' => NULL,
            'isRepeatable' => false,
            'locations' => ['FIELD_DEFINITION'],
            'args' => [
                [
            'name' => 'fields',
            'type' => function() { return Type::nonNull(function() { return $this->getType('FieldSet'); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]
            ],
        ]);
        }
        
        return $directive;
    }
        


    public function directive_provides()
    {
        static $directive = null;
        if ($directive === null) {
            $directive = new Directive([
            'name' => 'provides',
            'description' => NULL,
            'isRepeatable' => false,
            'locations' => ['FIELD_DEFINITION'],
            'args' => [
                [
            'name' => 'fields',
            'type' => function() { return Type::nonNull(function() { return $this->getType('FieldSet'); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]
            ],
        ]);
        }
        
        return $directive;
    }
        


    public function directive_key()
    {
        static $directive = null;
        if ($directive === null) {
            $directive = new Directive([
            'name' => 'key',
            'description' => NULL,
            'isRepeatable' => true,
            'locations' => ['OBJECT','INTERFACE'],
            'args' => [
                [
            'name' => 'fields',
            'type' => function() { return Type::nonNull(function() { return $this->getType('FieldSet'); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ],[
            'name' => 'resolvable',
            'type' => function() { return Type::boolean(); },
            'defaultValue' => true,
            'description' => NULL,
        ]
            ],
        ]);
        }
        
        return $directive;
    }
        


    public function directive_shareable()
    {
        static $directive = null;
        if ($directive === null) {
            $directive = new Directive([
            'name' => 'shareable',
            'description' => NULL,
            'isRepeatable' => false,
            'locations' => ['OBJECT','FIELD_DEFINITION'],
            'args' => [
                
            ],
        ]);
        }
        
        return $directive;
    }
        


    public function directive_inaccessible()
    {
        static $directive = null;
        if ($directive === null) {
            $directive = new Directive([
            'name' => 'inaccessible',
            'description' => NULL,
            'isRepeatable' => false,
            'locations' => ['FIELD_DEFINITION','OBJECT','INTERFACE','UNION','ARGUMENT_DEFINITION','SCALAR','ENUM','ENUM_VALUE','INPUT_OBJECT','INPUT_FIELD_DEFINITION'],
            'args' => [
                
            ],
        ]);
        }
        
        return $directive;
    }
        


    public function directive_override()
    {
        static $directive = null;
        if ($directive === null) {
            $directive = new Directive([
            'name' => 'override',
            'description' => NULL,
            'isRepeatable' => false,
            'locations' => ['FIELD_DEFINITION'],
            'args' => [
                [
            'name' => 'from',
            'type' => function() { return Type::nonNull(function() { return Type::string(); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]
            ],
        ]);
        }
        
        return $directive;
    }
        


    public function directive_extends()
    {
        static $directive = null;
        if ($directive === null) {
            $directive = new Directive([
            'name' => 'extends',
            'description' => NULL,
            'isRepeatable' => false,
            'locations' => ['OBJECT','INTERFACE'],
            'args' => [
                
            ],
        ]);
        }
        
        return $directive;
    }
        


    public function directive_uppercase()
    {
        static $directive = null;
        if ($directive === null) {
            $directive = new Directive([
            'name' => 'uppercase',
            'description' => NULL,
            'isRepeatable' => false,
            'locations' => ['FIELD','FIELD_DEFINITION'],
            'args' => [
                
            ],
        ]);
        }
        
        return $directive;
    }
        


    public function directive_pow()
    {
        static $directive = null;
        if ($directive === null) {
            $directive = new Directive([
            'name' => 'pow',
            'description' => NULL,
            'isRepeatable' => false,
            'locations' => ['FIELD','FIELD_DEFINITION'],
            'args' => [
                [
            'name' => 'ex',
            'type' => function() { return Type::nonNull(function() { return Type::int(); }); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]
            ],
        ]);
        }
        
        return $directive;
    }
        


    public function directive_isAuthenticated()
    {
        static $directive = null;
        if ($directive === null) {
            $directive = new Directive([
            'name' => 'isAuthenticated',
            'description' => NULL,
            'isRepeatable' => false,
            'locations' => ['FIELD','FIELD_DEFINITION'],
            'args' => [
                
            ],
        ]);
        }
        
        return $directive;
    }
        


    public function directive_hasRole()
    {
        static $directive = null;
        if ($directive === null) {
            $directive = new Directive([
            'name' => 'hasRole',
            'description' => NULL,
            'isRepeatable' => false,
            'locations' => ['FIELD','FIELD_DEFINITION'],
            'args' => [
                [
            'name' => 'role',
            'type' => function() { return Type::string(); },
            'defaultValue' => NULL,
            'description' => NULL,
        ]
            ],
        ]);
        }
        
        return $directive;
    }
        


    public function getDirectives()
    {
        return [$this->directive_link(),$this->directive_external(),$this->directive_requires(),$this->directive_provides(),$this->directive_key(),$this->directive_shareable(),$this->directive_inaccessible(),$this->directive_override(),$this->directive_extends(),$this->directive_uppercase(),$this->directive_pow(),$this->directive_isAuthenticated(),$this->directive_hasRole()];
    }
        

}
