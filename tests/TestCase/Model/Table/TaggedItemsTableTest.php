<?php
namespace Tags\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Tags\Model\Table\TaggedItemsTable;

/**
 * Tags\Model\Table\TaggedItemsTable Test Case
 */
class TaggedItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Tags\Model\Table\TaggedItemsTable
     */
    public $TaggedItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.tags.tagged_items',
        'plugin.tags.tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TaggedItems') ? [] : ['className' => TaggedItemsTable::class];
        $this->TaggedItems = TableRegistry::get('TaggedItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TaggedItems);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
