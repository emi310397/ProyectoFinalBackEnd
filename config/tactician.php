<?php

return [

    'buses' => [

        'default' => [

            'commandbus' => 'League\Tactician\CommandBus',

            'middleware' => [
                // ...
            ],

            'commands' => [

                /*CompanyAdmin*/
                'CreateCompanyAdmin' => [
                    'command' => 'Application\Commands\CompanyAdmin\CreateCompanyAdminCommand',
                    'handler' => 'Application\Handlers\CompanyAdmin\CreateCompanyAdminHandler'
                ],
                'GetCompanyAdmin' => [
                    'command' => 'Application\Commands\CompanyAdmin\GetCompanyAdminQuery',
                    'handler' => 'Application\Handlers\CompanyAdmin\GetCompanyAdminHandler'
                ],

                /*Course*/
                'CreateCourse' => [
                    'command' => 'Application\Commands\Course\CreateCourseCommand',
                    'handler' => 'Application\Handlers\Course\CreateCourseHandler'
                ],
                'EditCourse' => [
                    'command' => 'Application\Commands\Course\EditCourseCommand',
                    'handler' => 'Application\Handlers\Course\EditCourseHandler'
                ],
                'GetCourse' => [
                    'command' => 'Application\Commands\Course\GetCourseQuery',
                    'handler' => 'Application\Handlers\Course\GetCourseHandler'
                ],
                'CancelCourse' => [
                    'command' => 'Application\Commands\Course\CancelCourseCommand',
                    'handler' => 'Application\Handlers\Course\CancelCourseHandler'
                ],

                /*Manager*/
                'CreateManager' => [
                    'command' => 'Application\Commands\Manager\CreateManagerCommand',
                    'handler' => 'Application\Handlers\Manager\CreateManagerHandler'
                ],

                /*Organization*/
                'EditOrganization' => [
                    'command' => 'Application\Commands\Organization\EditOrganizationCommand',
                    'handler' => 'Application\Handlers\Organization\EditOrganizationHandler'
                ],
                'GetOrganization' => [
                    'command' => 'Application\Commands\Organization\GetOrganizationQuery',
                    'handler' => 'Application\Handlers\Organization\GetOrganizationHandler'
                ],

                /*Tag*/
                'EditTag' => [
                    'command' => 'Application\Commands\Tag\EditTagCommand',
                    'handler' => 'Application\Handlers\Tag\EditTagHandler'
                ],
                'GetTag' => [
                    'command' => 'Application\Commands\Tag\GetTagCommand',
                    'handler' => 'Application\Handlers\Tag\GetTagHandler'
                ],

                /*Teacher*/
                'CreateTeacher' => [
                    'command' => 'Application\Commands\Teacher\CreateTeacherCommand',
                    'handler' => 'Application\Handlers\Teacher\CreateTeacherHandler'
                ],

                /*User*/
                'CreateUser' => [
                    'command' => 'Application\Commands\User\CreateUserCommand',
                    'handler' => 'Application\Handlers\User\CreateUserHandler'
                ],
                'EditUser' => [
                    'command' => 'Application\Commands\User\EditUserCommand',
                    'handler' => 'Application\Handlers\User\EditUserHandler'
                ],
                'GetUser' => [
                    'command' => 'Application\Commands\User\GetUserQuery',
                    'handler' => 'Application\Handlers\User\GetUserHandler'
                ],

                /*Auth*/
                'LoginUserViaToken' => [
                    'command' => 'Application\Commands\Auth\LoginUserViaTokenCommand',
                    'handler' => 'Application\Handlers\Auth\LoginUserViaTokenHandler'
                ],

                'AccountRecoveryRequest' => [
                    'command' => 'Application\Commands\Auth\AccountRecoveryRequestCommand',
                    'handler' => 'Application\Handlers\Auth\AccountRecoveryRequestHandler'
                ],

            ],

            'queries' => [
                'GetAllCourses' => [
                    'query' => 'Application\Queries\Course\GetAllCoursesQuery',
                    'handler' => 'Application\Handlers\Course\GetAllCoursesHandler'
                ],
            ]

        ],

    ],
];
