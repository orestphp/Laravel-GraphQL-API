<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use App\Models\Role;
use DanielDeWit\LighthouseSanctum\Contracts\Services\EmailVerificationServiceInterface;
use DanielDeWit\LighthouseSanctum\Exceptions\HasApiTokensException;
use DanielDeWit\LighthouseSanctum\GraphQL\Mutations\Register as RegisterOriginal;
use Illuminate\Auth\AuthManager;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\Contracts\HasApiTokens;

final class Register extends RegisterOriginal
{

    public function __construct(
        AuthManager $authManager,
        Config $config,
        Hasher $hash,
        EmailVerificationServiceInterface $emailVerificationService
    ) {
        $this->authManager              = $authManager;
        $this->config                   = $config;
        $this->hash                     = $hash;
        $this->emailVerificationService = $emailVerificationService;

        parent::__construct($this->authManager, $this->config, $this->hash,$this->emailVerificationService);
    }

    /**
     * @param mixed $_
     * @param array<string, mixed> $args
     * @return array<string, string|null>
     * @throws Exception
     */
    public function resolve($_, array $args): array
    {
        /** @var EloquentUserProvider $userProvider */
        $userProvider = $this->createUserProvider();

        $user = $this->saveUser(
            $userProvider->createModel(),
            $this->getPropertiesFromArgs($args),
        );

        if ($user instanceof MustVerifyEmail) {
            if (isset($args['verification_url'])) {
                /** @var array<string, string> $verificationUrl */
                $verificationUrl = $args['verification_url'];

                $this->emailVerificationService->setVerificationUrl($verificationUrl['url']);
            }

            $user->sendEmailVerificationNotification();

            return [
                'token'  => null,
                'status' => 'MUST_VERIFY_EMAIL',
            ];
        }

        if (! $user instanceof HasApiTokens) {
            throw new HasApiTokensException($user);
        }

        return [
            'token'  => $user->createToken('default')->plainTextToken,
            'status' => 'SUCCESS',
        ];
    }

    /**
     * @param User $user
     * @param array<string, mixed> $attributes
     * @return User
     */
    protected function saveUser(Model $user, array $attributes): User
    {
        $user = $user::create($attributes);
        $user->assignRole('user');

        return $user;
    }
}

