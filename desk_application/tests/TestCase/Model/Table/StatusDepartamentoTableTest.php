<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatusDepartamentoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatusDepartamentoTable Test Case
 */
class StatusDepartamentoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StatusDepartamentoTable
     */
    public $StatusDepartamento;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.status_departamento',
        'app.sh_ticket',
        'app.sh_ticket_status_departamento'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StatusDepartamento') ? [] : ['className' => 'App\Model\Table\StatusDepartamentoTable'];
        $this->StatusDepartamento = TableRegistry::get('StatusDepartamento', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StatusDepartamento);

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
