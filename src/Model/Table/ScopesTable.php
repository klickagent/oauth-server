<?php
namespace OAuthServer\Model\Table;

use Cake\ORM\Table;
use Cake\Database\Schema\TableSchema;

class ScopesTable extends Table
{
    /**
     * @param array $config Config
     * @return void
     */
    public function initialize(array $config)
    {
        $this->setTable('oauth_scopes');
        $this->hasMany('AccessTokenScopes', [
            'className' => 'OAuthServer.AccessTokenScopes'
        ]);
        $this->hasMany('AuthCodeScopes', [
                'className' => 'OAuthServer.AuthCodeScopes'
            ]);
        $this->hasMany('SessionScopes', [
                'className' => 'OAuthServer.SessionScopes'
            ]);


        $table = new TableSchema($this->getTable());
        $table
            ->addColumn('id', 'string', [
                'default' => '',
                'limit' => 200,
                'null' => false,
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => false,
            ]);
        $this->setSchema($table);

        $table->addConstraint('primary', [
          'type' => 'primary',
          'columns' => ['id']
        ]);

        parent::initialize($config);
    }
}
