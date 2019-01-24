<?php
namespace OAuthServer\Model\Table;

use Cake\ORM\Table;
use Cake\Database\Schema\TableSchema;

class AccessTokenScopesTable extends Table
{

    /**
     * @param array $config Config
     * @return void
     */
    public function initialize(array $config)
    {
        $this->setTable('oauth_access_token_scopes');
        $this->belongsTo('AccessTokens', [
            'className' => 'OAuthServer.AccessTokens',
            'foreignKey' => 'oauth_token'
        ]);
        $this->belongsTo('Scopes', [
            'className' => 'OAuthServer.Scopes'
        ]);
        $table = new TableSchema($this->getTable());
        $table
            ->addColumn('oauth_token', 'string', [
                'default' => null,
                'limit' => 40,
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
