<?php

namespace OAuthServer\Model\Table;

use Cake\ORM\Table;
use Cake\Database\Schema\TableSchema;

/**
 * RefreshToken Model
 *
 * @property Client $Client
 * @property User $User
 */
class RefreshTokensTable extends Table
{
    /**
     * @param array $config Config
     * @return void
     */
    public function initialize(array $config)
    {
        $this->setTable('oauth_refresh_tokens');
        $this->primaryKey('refresh_token');
        $this->belongsTo('AccessTokens', [
            'className' => 'OAuthServer.AccessTokens',
            'foreignKey' => 'oauth_token'
        ]);

        $table = new TableSchema($this->getTable());
        $table
            ->addColumn('refresh_token', 'string', [
                'default' => null,
                'limit' => 40,
                'null' => false,
            ])
            ->addColumn('oauth_token', 'string', [
                'default' => null,
                'limit' => 40,
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
