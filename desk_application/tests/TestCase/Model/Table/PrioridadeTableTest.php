<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PrioridadeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PrioridadeTable Test Case
 */
class PrioridadeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PrioridadeTable
     */
    public $Prioridade;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.prioridade',
        'app.sh_ticket',
        'app.sh_ticket_prioridade'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Prioridade') ? [] : ['className' => 'App\Model\Table\PrioridadeTable'];
        $this->Prioridade = TableRegistry::get('Prioridade', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Prioridade);

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
