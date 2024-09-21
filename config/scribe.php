<?php

use Knuckles\Scribe\Extracting\Strategies;
return [
    'title' => env('APP_NAME', 'Laravel') . ' API Documentation',
    'description' => 'This is the API documentation for ' . env('APP_NAME', 'Laravel') . '.',
    'base_url' => env('APP_URL', 'http://localhost'),
    'routes' => [
        [
            'match' => [
                'prefixes' => ['api/*'],
                'domains' => ['*'],
            ],
            'include' => ['*'],
            'exclude' => [],
        ],
    ],
    'auth' => [
        'enabled' => false, // 인증을 사용하도록 설정
        'in' => 'bearer', // 인증 방식 (bearer, query, header 등)
        'name' => 'Authorization', // 인증 헤더 이름
        'use_value' => env('SCRIBE_AUTH_KEY'), // 실제 인증 키 값
        'default' => true, // 기본적으로 모든 엔드포인트에 인증을 적용할지 여부
        'placeholder' => '{YOUR_AUTH_KEY}', // 예제 요청에서 사용할 플레이스홀더
        'extra_info' => 'You can retrieve your token by visiting your dashboard and clicking <b>Generate API token</b>.',
    ],
    'intro_text' => <<<INTRO
Welcome to the API documentation for {app_name}. This documentation provides detailed information about the API endpoints and how to use them.
안녕하세요 api 문서입니다.
INTRO,

    'example_languages' => ['bash', 'javascript'],
    'groups' => [
        // Endpoints which don't have a @group will be placed in this default group.
        'default' => '', // General 그룹을 비워서 표시하지 않음
        // By default, Scribe will sort groups alphabetically, and endpoints in the order their routes are defined.
        // You can override this by listing the groups, subgroups and endpoints here in the order you want them.
        // See https://scribe.knuckles.wtf/blog/laravel-v4#easier-sorting and https://scribe.knuckles.wtf/laravel/reference/config#order for details
        'order' => [
            '사용자 관리', // 사용자 관리 그룹을 먼저 표시
        ],
    ],
    // The type of documentation output to generate.
    // - "static" will generate a static HTMl page in the /public/docs folder,
    // - "laravel" will generate the documentation as a Blade view, so you can add routing and authentication.
    // - "external_static" and "external_laravel" do the same as above, but generate a basic template,
    // passing the OpenAPI spec as a URL, allowing you to easily use the docs with an external generator
    'type' => 'static',
    // See https://scribe.knuckles.wtf/laravel/reference/config#theme for supported options
    'theme' => 'default',
    'static' => [
        // HTML documentation, assets and Postman collection will be generated to this folder.
        // Source Markdown will still be in resources/docs.
        'output_path' => 'public/docs',
    ],
    'laravel' => [
        // Whether to automatically create a docs endpoint for you to view your generated docs.
        // If this is false, you can still set up routing manually.
        'add_routes' => true,
        // URL path to use for the docs endpoint (if `add_routes` is true).
        // By default, `/docs` opens the HTML page, `/docs.postman` opens the Postman collection, and `/docs.openapi` the OpenAPI spec.
        'docs_url' => '/docs',
        // Directory within `public` in which to store CSS and JS assets.
        // By default, assets are stored in `public/vendor/scribe`.
        // If set, assets will be stored in `public/{{assets_directory}}`
        'assets_directory' => null,
        // Middleware to attach to the docs endpoint (if `add_routes` is true).
        'middleware' => [],
    ],
    'external' => ['html_attributes' => []],
    'try_it_out' => [
        // Add a Try It Out button to your endpoints so consumers can test endpoints right from their browser.
        // Don't forget to enable CORS headers for your endpoints.
        'enabled' => true,
        // The base URL for the API tester to use (for example, you can set this to your staging URL).
        // Leave as null to use the current app URL when generating (config("app.url")).
        'base_url' => null,
        // [Laravel Sanctum] Fetch a CSRF token before each request, and add it as an X-XSRF-TOKEN header.
        'use_csrf' => false,
        // The URL to fetch the CSRF token from (if `use_csrf` is true).
        'csrf_url' => '/sanctum/csrf-cookie',
    ],
    // Generate a Postman collection (v2.1.0) in addition to HTML docs.
    // For 'static' docs, the collection will be generated to public/docs/collection.json.
    // For 'laravel' docs, it will be generated to storage/app/scribe/collection.json.
    // Setting `laravel.add_routes` to true (above) will also add a route for the collection.
    'postman' => ['enabled' => true, 'overrides' => []],
    // Generate an OpenAPI spec (v3.0.1) in addition to docs webpage.
    // For 'static' docs, the collection will be generated to public/docs/openapi.yaml.
    // For 'laravel' docs, it will be generated to storage/app/scribe/openapi.yaml.
    // Setting `laravel.add_routes` to true (above) will also add a route for the spec.
    'openapi' => ['enabled' => true, 'overrides' => []],
    // Custom logo path. This will be used as the value of the src attribute for the <img> tag,
    // so make sure it points to an accessible URL or path. Set to false to not use a logo.
    // For example, if your logo is in public/img:
    // - 'logo' => '../img/logo.png' // for `static` type (output folder is public/docs)
    // - 'logo' => 'img/logo.png' // for `laravel` type
    'logo' => false,
    // Customize the "Last updated" value displayed in the docs by specifying tokens and formats.
    // Examples:
    // - {date:F j Y} => March 28, 2022
    // - {git:short} => Short hash of the last Git commit
    // Available tokens are `{date:<format>}` and `{git:<format>}`.
    // The format you pass to `date` will be passed to PHP's `date()` function.
    // The format you pass to `git` can be either "short" or "long".
    'last_updated' => 'Last updated: {date:F j, Y}',
    'examples' => [
        // Set this to any number (eg. 1234) to generate the same example values for parameters on each run,
        'faker_seed' => null,
        // With API resources and transformers, Scribe tries to generate example models to use in your API responses.
        // By default, Scribe will try the model's factory, and if that fails, try fetching the first from the database.
        // You can reorder or remove strategies here.
        'models_source' => ['factoryCreate', 'factoryMake', 'databaseFirst'],
    ],
    'fractal' => [
        // If you are using a custom serializer with league/fractal, you can specify it here.
        'serializer' => null,
    ],
    'routeMatcher' => \Knuckles\Scribe\Matching\RouteMatcher::class,
];