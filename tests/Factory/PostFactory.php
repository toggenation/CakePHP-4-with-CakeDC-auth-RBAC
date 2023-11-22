<?php

declare(strict_types=1);

namespace App\Test\Factory;

use CakephpFixtureFactories\Factory\BaseFactory as CakephpBaseFactory;
use Faker\Generator;

/**
 * PostFactory
 *
 * @method \App\Model\Entity\Post getEntity()
 * @method \App\Model\Entity\Post[] getEntities()
 * @method \App\Model\Entity\Post|\App\Model\Entity\Post[] persist()
 * @method static \App\Model\Entity\Post get(mixed $primaryKey, array $options = [])
 */
class PostFactory extends CakephpBaseFactory
{
    /**
     * Defines the Table Registry used to generate entities with
     *
     * @return string
     */
    protected function getRootTableRegistryName(): string
    {
        return 'Posts';
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
                // set the model's default values
                // For example:
                // 'name' => $faker->lastName
                'title' => $faker->words(3, true),
                'body' => $faker->paragraphs(1, true)
            ];
        });
    }

    /**
     * @param array|callable|null|int|\Cake\Datasource\EntityInterface|string $parameter
     * @return PostFactory
     */
    public function withUsers($parameter = null): PostFactory
    {
        return $this->with(
            'Users',
            UserFactory::make($parameter)
        );
    }
}
