<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FeatureFlagsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FeatureFlagsTable Test Case
 */
class FeatureFlagsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FeatureFlagsTable
     */
    protected $FeatureFlags;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.FeatureFlags',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('FeatureFlags') ? [] : ['className' => FeatureFlagsTable::class];
        $this->FeatureFlags = $this->getTableLocator()->get('FeatureFlags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->FeatureFlags);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FeatureFlagsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
