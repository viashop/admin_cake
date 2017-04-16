<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnexoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnexoTable Test Case
 */
class AnexoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AnexoTable
     */
    public $Anexo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.anexo',
        'app.sh_ticket',
        'app.sh_ticket_anexo'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Anexo') ? [] : ['className' => 'App\Model\Table\AnexoTable'];
        $this->Anexo = TableRegistry::get('Anexo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Anexo);

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
