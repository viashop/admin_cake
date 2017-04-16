<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TicketTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TicketTable Test Case
 */
class TicketTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TicketTable
     */
    public $Ticket;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ticket'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Ticket') ? [] : ['className' => 'App\Model\Table\TicketTable'];
        $this->Ticket = TableRegistry::get('Ticket', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ticket);

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
