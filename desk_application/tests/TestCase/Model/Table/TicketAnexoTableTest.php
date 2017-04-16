<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TicketAnexoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TicketAnexoTable Test Case
 */
class TicketAnexoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TicketAnexoTable
     */
    public $TicketAnexo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ticket_anexo'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TicketAnexo') ? [] : ['className' => 'App\Model\Table\TicketAnexoTable'];
        $this->TicketAnexo = TableRegistry::get('TicketAnexo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TicketAnexo);

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
