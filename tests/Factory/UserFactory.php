<?php

declare(strict_types=1);

namespace App\Test\Factory;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use CakephpFixtureFactories\Factory\BaseFactory as CakephpBaseFactory;
use Faker\Generator;

/**
 * UserFactory
 *
 * @method \App\Model\Entity\User getEntity()
 * @method \App\Model\Entity\User[] getEntities()
 * @method \App\Model\Entity\User|\App\Model\Entity\User[] persist()
 * @method static \App\Model\Entity\User get(mixed $primaryKey, array $options = [])
 */
class UserFactory extends CakephpBaseFactory
{
    /**
     * Defines the Table Registry used to generate entities with
     *
     * @return string
     */
    protected function getRootTableRegistryName(): string
    {
        return 'Users';
    }

    /**
     * Defines the factory's default values. This is useful for
     * not nullable fields. You may use methods of the present factory here too.
     *
     * @return void
     */
    protected function setDefaultTemplate(): void
    {
        $this->setDefaultData(function (Generator $faker) {
            return [
                'is_superuser' => false,
                'password' => (new DefaultPasswordHasher())->hash('123'),
                'role' => 'user',
                // set the model's default values
                // For example:
                // 'name' => $faker->lastName
                'username' => $faker->userName()
            ];
        });
    }

    /**
     * @param array|callable|null|int|\Cake\Datasource\EntityInterface|string $parameter
     * @param int $n
     * @return UserFactory
     */
    public function withPosts($parameter = null, int $n = 1): UserFactory
    {
        return $this->with(
            'Posts',
            PostFactory::make($parameter, $n)
        );
    }
}
