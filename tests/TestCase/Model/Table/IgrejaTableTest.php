<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IgrejaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IgrejaTable Test Case
 */
class IgrejaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IgrejaTable
     */
    public $Igreja;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Igreja',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Igreja') ? [] : ['className' => IgrejaTable::class];
        $this->Igreja = TableRegistry::getTableLocator()->get('Igreja', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Igreja);

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
}
