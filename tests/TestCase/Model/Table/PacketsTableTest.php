<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PacketsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PacketsTable Test Case
 */
class PacketsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PacketsTable
     */
    protected $Packets;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Packets',
        'app.Users',
        'app.Flashcards',
        'app.Sessions',
        'app.Keywords',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Packets') ? [] : ['className' => PacketsTable::class];
        $this->Packets = $this->getTableLocator()->get('Packets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Packets);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PacketsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PacketsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
