<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatusClienteTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatusClienteTable Test Case
 */
class StatusClienteTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StatusClienteTable
     */
    public $StatusCliente;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.status_cliente',
        'app.sh_ticket',
        'app.sh_ticket_status_cliente'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StatusCliente') ? [] : ['className' => 'App\Model\Table\StatusClienteTable'];
        $this->StatusCliente = TableRegistry::get('StatusCliente', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StatusCliente);

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
