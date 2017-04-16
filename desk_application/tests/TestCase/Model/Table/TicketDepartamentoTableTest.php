<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TicketDepartamentoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TicketDepartamentoTable Test Case
 */
class TicketDepartamentoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TicketDepartamentoTable
     */
    public $TicketDepartamento;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ticket_departamento'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Departamento') ? [] : ['className' => 'App\Model\Table\TicketDepartamentoTable'];
        $this->TicketDepartamento = TableRegistry::get('Departamento', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TicketDepartamento);

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
