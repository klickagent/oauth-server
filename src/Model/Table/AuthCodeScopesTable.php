<?php
namespace OAuthServer\Model\Table;

use Cake\ORM\Table;
use Cake\Database\Schema\TableSchema;

class AuthCodeScopesTable extends Table
{
    /**
     * @param array $config Config
     * @return void
     */
    public function initialize(array $config)
    {
        $this->setTable('oauth_auth_code_scopes');
        $this->belongsTo('AuthCodes', [
                'className' => 'OAuthServer.AuthCodes',
                'foreignKey' => 'auth_code',
                'propertyName' => 'code'
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
            ->addColumn('auth_code', 'string', [
                'default' => null,
                'limit' => 40,
                'null' => false,
            ])
            ->addColumn('scope_id', 'string', [
                'default' => '',
                'limit' => 200,
                'null' => false,
            ]);

        $table->addConstraint('primary', [
          'type' => 'primary',
          'columns' => ['id']
        ]);

        $this->setSchema($table);
        parent::initialize($config);
    }
}
