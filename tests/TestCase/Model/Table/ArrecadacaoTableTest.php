<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArrecadacaoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArrecadacaoTable Test Case
 */
class ArrecadacaoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ArrecadacaoTable
     */
    public $Arrecadacao;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Arrecadacao',
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
        $config = TableRegistry::getTableLocator()->exists('Arrecadacao') ? [] : ['className' => ArrecadacaoTable::class];
        $this->Arrecadacao = TableRegistry::getTableLocator()->get('Arrecadacao', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Arrecadacao);

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
