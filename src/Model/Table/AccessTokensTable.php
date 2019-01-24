<?php

namespace OAuthServer\Model\Table;

use Cake\ORM\Table;
use Cake\Database\Schema\TableSchema;

/**
 * AccessToken Model
 *
 * @property Client $Client
 * @property User $User
 */
class AccessTokensTable extends Table
{
    /**
     * @param array $config Config
     * @return void
     */
    public function initialize(array $config)
    {
        $this->setTable('oauth_access_tokens');
        $this->primaryKey('oauth_token');
        $this->belongsTo('Sessions', [
            'className' => 'OAuthServer.Sessions',
        ]);
        $this->hasMany('AccessTokenScopes', [
            'className' => 'OAuthServer.AccessTokenScopes',
            'foreignKey' => 'oauth_token',
            'dependant' => true
        ]);
        $table = new TableSchema($this->getTable());
        $table
            ->addColumn('oauth_token', 'string', [
                'default' => null,
                'limit' => 40,
                'null' => false,
            ])
            ->addColumn('session_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('expires', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ]);
        $this->setSchema($table);
        parent::initialize($config);
    }
}
