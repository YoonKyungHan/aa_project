<?php

return [

    'models' => [

        /*
         * 이 패키지의 "HasPermissions" 트레이트를 사용할 때, 
         * 어떤 Eloquent 모델을 사용하여 권한을 검색할지 알아야 합니다. 
         * 물론 일반적으로 "Permission" 모델을 사용하지만, 
         * 원하는 모델을 사용할 수 있습니다.
         *
         * 권한 모델로 사용하려는 모델은 
         * `Spatie\Permission\Contracts\Permission` 계약을 구현해야 합니다.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * 이 패키지의 "HasRoles" 트레이트를 사용할 때, 
         * 어떤 Eloquent 모델을 사용하여 역할을 검색할지 알아야 합니다. 
         * 물론 일반적으로 "Role" 모델을 사용하지만, 
         * 원하는 모델을 사용할 수 있습니다.
         *
         * 역할 모델로 사용하려는 모델은 
         * `Spatie\Permission\Contracts\Role` 계약을 구현해야 합니다.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * 이 패키지의 "HasRoles" 트레이트를 사용할 때, 
         * 어떤 테이블을 사용하여 역할을 검색할지 알아야 합니다. 
         * 기본값을 선택했지만, 원하는 테이블로 쉽게 변경할 수 있습니다.
         */

        'roles' => 'roles',

        /*
         * 이 패키지의 "HasPermissions" 트레이트를 사용할 때, 
         * 어떤 테이블을 사용하여 권한을 검색할지 알아야 합니다. 
         * 기본값을 선택했지만, 원하는 테이블로 쉽게 변경할 수 있습니다.
         */

        'permissions' => 'permissions',

        /*
         * 이 패키지의 "HasPermissions" 트레이트를 사용할 때, 
         * 어떤 테이블을 사용하여 모델의 권한을 검색할지 알아야 합니다. 
         * 기본값을 선택했지만, 원하는 테이블로 쉽게 변경할 수 있습니다.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * 이 패키지의 "HasRoles" 트레이트를 사용할 때, 
         * 어떤 테이블을 사용하여 모델의 역할을 검색할지 알아야 합니다. 
         * 기본값을 선택했지만, 원하는 테이블로 쉽게 변경할 수 있습니다.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * 이 패키지의 "HasRoles" 트레이트를 사용할 때, 
         * 어떤 테이블을 사용하여 역할의 권한을 검색할지 알아야 합니다. 
         * 기본값을 선택했지만, 원하는 테이블로 쉽게 변경할 수 있습니다.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [
        /*
         * 기본값 외에 관련 피벗의 이름을 변경하려면 여기를 변경하세요.
         */
        'role_pivot_key' => null, //기본값 'role_id',
        'permission_pivot_key' => null, //기본값 'permission_id',

        /*
         * `model_id` 외에 관련 모델의 기본 키 이름을 변경하려면 여기를 변경하세요.
         *
         * 예를 들어, 모든 기본 키가 UUID인 경우, 
         * 이 이름을 `model_uuid`로 지정하는 것이 좋습니다.
         */

        'model_morph_key' => 'model_id',

        /*
         * 팀 기능을 사용하려면 여기를 변경하세요. 
         * 관련 모델의 외래 키가 `team_id`가 아닌 경우.
         */

        'team_foreign_key' => 'team_id',
    ],

    /*
     * true로 설정하면 권한을 확인하는 메서드가 게이트에 등록됩니다.
     * 권한 확인을 위한 사용자 정의 로직을 구현하려면 false로 설정하세요.
     */

    'register_permission_check_method' => true,

    /*
     * true로 설정하면 Laravel\Octane\Events\OperationTerminated 이벤트 리스너가 등록됩니다.
     * 이 리스너는 TickTerminated, TaskTerminated 및 RequestTerminated마다 권한을 새로 고칩니다.
     * NOTE: 대부분의 경우 필요하지 않지만, Octane/Vapor 조합에서 이점을 얻었습니다.
     */
    'register_octane_reset_listener' => false,

    /*
     * 팀 기능.
     * true로 설정하면 패키지가 'team_foreign_key'를 사용하여 팀을 구현합니다.
     * 'team_foreign_key'를 등록하려면 마이그레이션을 수행하기 전에 
     * 이 값을 true로 설정해야 합니다.
     * 이미 마이그레이션을 수행한 경우, 
     * 'roles', 'model_has_roles', 'model_has_permissions'에 'team_foreign_key'를 추가하는 
     * 새 마이그레이션을 만들어야 합니다.
     * (이 패키지의 마이그레이션 파일의 최신 버전을 참조하세요.)
     */

    'teams' => false,

    /*
     * Passport 클라이언트 자격 증명 부여
     * true로 설정하면 패키지가 Passport 클라이언트를 사용하여 권한을 확인합니다.
     */

    'use_passport_client_credentials' => false,

    /*
     * true로 설정하면 필요한 권한 이름이 예외 메시지에 추가됩니다.
     * 일부 맥락에서는 정보 유출로 간주될 수 있으므로, 
     * 최적의 안전성을 위해 기본 설정은 false입니다.
     */

    'display_permission_in_exception' => false,

    /*
     * true로 설정하면 필요한 역할 이름이 예외 메시지에 추가됩니다.
     * 일부 맥락에서는 정보 유출로 간주될 수 있으므로, 
     * 최적의 안전성을 위해 기본 설정은 false입니다.
     */

    'display_role_in_exception' => false,

    /*
     * 기본적으로 와일드카드 권한 조회는 비활성화되어 있습니다.
     * 지원되는 구문을 이해하려면 문서를 참조하세요.
     */

    'enable_wildcard_permission' => false,

    /*
     * 와일드카드 권한을 해석하는 데 사용할 클래스입니다.
     * 구분 기호를 수정해야 하는 경우, 클래스를 재정의하고 
     * 여기에 이름을 지정하세요.
     */
    // 'permission.wildcard_permission' => Spatie\Permission\WildcardPermission::class,

    /* 캐시 관련 설정 */

    'cache' => [

        /*
         * 기본적으로 모든 권한은 성능 향상을 위해 24시간 동안 캐시됩니다.
         * 권한이나 역할이 업데이트되면 캐시가 자동으로 플러시됩니다.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * 모든 권한을 저장하는 데 사용되는 캐시 키입니다.
         */

        'key' => 'spatie.permission.cache',

        /*
         * 권한 및 역할 캐싱에 사용할 특정 캐시 드라이버를 
         * cache.php 구성 파일에 나열된 `store` 드라이버 중 하나로 지정할 수 있습니다.
         * 여기서 'default'를 사용하면 cache.php에 설정된 `default`를 사용합니다.
         */

        'store' => 'default',
    ],
];
