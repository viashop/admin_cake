<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatusUsuarioTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatusUsuarioTable Test Case
 */
class StatusUsuarioTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StatusUsuarioTable
     */
    public $StatusUsuario;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.status_usuario',
        'app.sh_ticket',
        'app.sh_ticket_status_usuario'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StatusUsuario') ? [] : ['className' => 'App\Model\Table\StatusUsuarioTable'];
        $this->StatusUsuario = TableRegistry::get('StatusUsuario', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StatusUsuario);

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
