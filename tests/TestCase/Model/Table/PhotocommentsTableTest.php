<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PhotocommentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PhotocommentsTable Test Case
 */
class PhotocommentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PhotocommentsTable
     */
    protected $Photocomments;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Photocomments',
        'app.Users',
        'app.Photos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Photocomments') ? [] : ['className' => PhotocommentsTable::class];
        $this->Photocomments = $this->getTableLocator()->get('Photocomments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Photocomments);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PhotocommentsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PhotocommentsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
