<?php

namespace OAuthServer\Model\Table;

use Cake\ORM\Table;
use Cake\Database\Schema\TableSchema;

/**
 * AuthCode Model
 *
 * @property Client $Client
 * @property User $User
 */
class AuthCodesTable extends Table
{
    /**
     * @param array $config Config
     * @return void
     */
    public function initialize(array $config)
    {
        $this->setTable('oauth_auth_codes');
        $this->primaryKey('code');

        $this->belongsTo(
            'Sessions',
            [
                'className' => 'OAuthServer.Sessions',
                'foreignKey' => 'session_id'
            ]
        );
        $this->hasMany(
            'AuthCodeScopes',
            [
                'className' => 'OAuthServer.AuthCodeScopes',
                'foreignKey' => 'auth_code',
                'dependant' => true
            ]
        );

        $table = new TableSchema($this->getTable());
        $table
            ->addColumn('code', 'string', [
                'default' => null,
                'limit' => 40,
                'null' => false,
            ])
            ->addColumn('session_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('redirect_uri', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => false,
            ])
            ->addColumn('expires', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ]);
        $this->setSchema($table);

        $table->addConstraint('primary', [
          'type' => 'primary',
          'columns' => ['code']
        ]);

        parent::initialize($config);
    }
}
