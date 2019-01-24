<?php
namespace OAuthServer\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Table;
use OAuthServer\Model\Entity\Client;
use Cake\Database\Schema\TableSchema;

/**
 * Client Model
 *
 * @property AccessToken $AccessToken
 * @property AuthCode $AuthCode
 * @property RefreshToken $RefreshToken
 */
class ClientsTable extends Table
{
    /**
     * @param array $config Config
     * @return void
     */
    public function initialize(array $config)
    {
        $this->setTable('oauth_clients');
        $this->primaryKey('id');
        $this->displayField('name');
        $this->hasMany('Sessions', [
            'className' => 'OAuthServer.Sessions',
            'foreignKey' => 'client_id'
        ]);

        $table = new TableSchema($this->getTable());
        $table
            ->addColumn('id', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addColumn('client_secret', 'string', [
                'default' => null,
                'limit' => 40,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => false,
            ])
            ->addColumn('redirect_uri', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('parent_model', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => true,
            ])
            ->addColumn('parent_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ]);
        $this->setSchema($table);

        parent::initialize($config);
    }

    /**
     * @param \Cake\Event\Event $event Event object
     * @param \OAuthServer\Model\Entity\Client $client Client entity
     * @return void
     */
    public function beforeSave(Event $event, Client $client)
    {
        if ($client->isNew()) {
            $client->id = base64_encode(uniqid() . substr(uniqid(), 11, 2));// e.g. NGYcZDRjODcxYzFkY2Rk (seems popular format)
            $client->generateSecret();
        }
    }
}
