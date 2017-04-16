<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConteudoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConteudoTable Test Case
 */
class ConteudoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConteudoTable
     */
    public $Conteudo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.conteudo',
        'app.sh_ticket',
        'app.sh_ticket_conteudo'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Conteudo') ? [] : ['className' => 'App\Model\Table\ConteudoTable'];
        $this->Conteudo = TableRegistry::get('Conteudo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Conteudo);

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
