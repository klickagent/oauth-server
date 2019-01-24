<?php
namespace OAuthServer\Model\Table;

use Cake\ORM\Table;
use Cake\Database\Schema\TableSchema;

class SessionScopesTable extends Table
{
    /**
     * @param array $config Config
     * @return void
     */
    public function initialize(array $config)
    {
        $this->setTable('oauth_session_scopes');
        $this->belongsTo('Sessions', [
                'className' => 'OAuthServer.Sessions',
            ]);
        $this->belongsTo('Scopes', [
                'className' => 'OAuthServer.Scopes'
            ]);

        $table = new TableSchema($this->getTable());
        $table
            ->addColumn('id', [
                'type' => 'integer',
                'length' => 11,
                'null' => false,
                'autoIncrement' => true,
            ])
            ->addColumn('session_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('scope_id', 'string', [
                'default' => '',
                'limit' => 200,
                'null' => false,
            ]);
        $this->setSchema($table);

        parent::initialize($config);
    }
}
