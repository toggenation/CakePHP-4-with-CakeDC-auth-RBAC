<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnotherUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnotherUsersTable Test Case
 */
class AnotherUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AnotherUsersTable
     */
    protected $AnotherUsers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.AnotherUsers',
        'app.Posts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AnotherUsers') ? [] : ['className' => AnotherUsersTable::class];
        $this->AnotherUsers = $this->getTableLocator()->get('AnotherUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->AnotherUsers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AnotherUsersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AnotherUsersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
