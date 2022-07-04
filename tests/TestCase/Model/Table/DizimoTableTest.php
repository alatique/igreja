<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DizimoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DizimoTable Test Case
 */
class DizimoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DizimoTable
     */
    public $Dizimo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Dizimo',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Dizimo') ? [] : ['className' => DizimoTable::class];
        $this->Dizimo = TableRegistry::getTableLocator()->get('Dizimo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dizimo);

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
