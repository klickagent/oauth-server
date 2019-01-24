<?php
namespace OAuthServer\Model\Table;

use Cake\ORM\Table;
use Cake\Database\Schema\TableSchema;

class SessionsTable extends Table
{
    /**
     * @param array $config Config
     * @return void
     */
    public function initialize(array $config)
    {
        $this->setTable('oauth_sessions');
        $this->hasMany('SessionScopes', [
                'className' => 'OAuthServer.SessionScopes',
                'foreignKey' => 'session_id',
                'dependant' => true
            ]);
        $this->hasMany('AuthCodes', [
            'className' => 'OAuthServer.AuthCodes',
            'foreignKey' => 'session_id',
            'dependant' => true
        ]);
        $this->hasMany('AccessTokens', [
                'className' => 'OAuthServer.AccessTokens',
                'foreignKey' => 'session_id',
                'dependant' => true
            ]);
        $this->hasMany('RefreshTokens', [
                'className' => 'OAuthServer.RefreshTokens',
                'foreignKey' => 'session_id',
                'dependant' => true
            ]);
        $this->belongsTo('Clients', [
                'className' => 'OAuthServer.Clients',
                'foreignKey' => 'client_id'
            ]);

        $table = new TableSchema($this->getTable());
        $table
            ->addColumn('id', [
                'type' => 'integer',
                'length' => 11,
                'null' => false,
                'autoIncrement' => true,
            ])
            ->addColumn('owner_model', 'string', [
                'default' => '',
                'limit' => 200,
                'null' => false,
            ])
            ->addColumn('owner_id', 'string', [
                'default' => '',
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('client_id', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('client_redirect_uri', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ]);

        $table->addConstraint('primary', [
          'type' => 'primary',
          'columns' => ['id']
        ]);
        $this->setSchema($table);

        parent::initialize($config);
    }
}
