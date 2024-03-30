<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Firstmigration extends AbstractMigration
{
    public bool $autoId = false;

    /**
     * Up Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-up-method
     * @return void
     */
    public function up(): void
    {
        $this->table('articles')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('url', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('body', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('auth_logs')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'user_id',
                ],
                [
                    'name' => 'FK_authlogs_userId',
                ]
            )
            ->create();

        $this->table('config')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('version', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('maintenance', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('feature_flags')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('enabled', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('flashcards')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('packet_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('question', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('answer', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('media', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('arrived', 'datetime', [
                'default' => 'current_timestamp()',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('leitner_folder', 'integer', [
                'default' => '1',
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'packet_id',
                ],
                [
                    'name' => 'FK_Flashcard_Packet',
                ]
            )
            ->create();

        $this->table('friends')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('requester_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('recipient_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('status', 'string', [
                'default' => 'pending',
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'recipient_id',
                ],
                [
                    'name' => 'Friends_Recipient_ID_Users_ID',
                ]
            )
            ->addIndex(
                [
                    'requester_id',
                ],
                [
                    'name' => 'Friends_Requester_ID_Users_ID',
                ]
            )
            ->create();

        $this->table('keywords')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('word', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->create();

        $this->table('likes')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('packet_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('liked', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'packet_id',
                ],
                [
                    'name' => 'FK_Like_Packet',
                ]
            )
            ->addIndex(
                [
                    'user_id',
                ],
                [
                    'name' => 'FK_Like_User',
                ]
            )
            ->create();

        $this->table('packets')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('packet_uid', 'string', [
                'default' => null,
                'limit' => 32,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 510,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('importation_count', 'integer', [
                'default' => '0',
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('status', 'integer', [
                'default' => '0',
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('ia', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('creator_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'user_id',
                ],
                [
                    'name' => 'FK_Packet_Users_Owner',
                ]
            )
            ->addIndex(
                [
                    'creator_id',
                ],
                [
                    'name' => 'FK_Packet_Users_Creator',
                ]
            )
            ->create();

        $this->table('packets_keywords')
            ->addColumn('packet_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('keyword_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addPrimaryKey(['packet_id', 'keyword_id'])
            ->addIndex(
                [
                    'keyword_id',
                ],
                [
                    'name' => 'FK_PacketKeywords_Keywords',
                ]
            )
            ->create();

        $this->table('sessions')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('session_uid', 'string', [
                'default' => null,
                'limit' => 32,
                'null' => false,
            ])
            ->addColumn('packet_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'packet_id',
                ],
                [
                    'name' => 'FK_SESSIONS_PACKETS',
                ]
            )
            ->create();

        $this->table('social_profiles')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => true,
            ])
            ->addColumn('provider', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('access_token', 'binary', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('identifier', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('username', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('first_name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('last_name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('full_name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('birth_date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('gender', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('picture_url', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('email_verified', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'user_id',
                ],
                [
                    'name' => 'user_id',
                ]
            )
            ->create();

        $this->table('update_notes')
            ->addColumn('UpdateID', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addPrimaryKey(['UpdateID'])
            ->addColumn('Version', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('Content', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('Fixes', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('users')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_uid', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('last_name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('username', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('birth', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('gender', 'char', [
                'default' => null,
                'limit' => 1,
                'null' => true,
            ])
            ->addColumn('profile_picture', 'text', [
                'default' => 'a21c0b2e1b225581c475320be513af6f22ff6910ccb0045b8cf8f8b09160c39f.jpg',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('permission', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'email',
                ],
                [
                    'name' => 'email',
                    'unique' => true,
                ]
            )
            ->addIndex(
                [
                    'username',
                ],
                [
                    'name' => 'username',
                    'unique' => true,
                ]
            )
            ->create();

        $this->table('auth_logs')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                    'constraint' => 'FK_authlogs_userId'
                ]
            )
            ->update();

        $this->table('flashcards')
            ->addForeignKey(
                'packet_id',
                'packets',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                    'constraint' => 'FK_Flashcard_Packet'
                ]
            )
            ->update();

        $this->table('friends')
            ->addForeignKey(
                'requester_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                    'constraint' => 'Friends_Requester_ID_Users_ID'
                ]
            )
            ->addForeignKey(
                'recipient_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                    'constraint' => 'Friends_Recipient_ID_Users_ID'
                ]
            )
            ->update();

        $this->table('likes')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                    'constraint' => 'FK_Like_User'
                ]
            )
            ->addForeignKey(
                'packet_id',
                'packets',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                    'constraint' => 'FK_Like_Packet'
                ]
            )
            ->update();

        $this->table('packets')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                    'constraint' => 'FK_Packet_Users_Owner'
                ]
            )
            ->update();

        $this->table('packets_keywords')
            ->addForeignKey(
                'packet_id',
                'packets',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                    'constraint' => 'FK_PacketKeywords_Packets'
                ]
            )
            ->addForeignKey(
                'keyword_id',
                'keywords',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                    'constraint' => 'FK_PacketKeywords_Keywords'
                ]
            )
            ->update();

        $this->table('sessions')
            ->addForeignKey(
                'packet_id',
                'packets',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE',
                    'constraint' => 'FK_SESSIONS_PACKETS'
                ]
            )
            ->update();
    }

    /**
     * Down Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-down-method
     * @return void
     */
    public function down(): void
    {
        $this->table('auth_logs')
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('flashcards')
            ->dropForeignKey(
                'packet_id'
            )->save();

        $this->table('friends')
            ->dropForeignKey(
                'requester_id'
            )
            ->dropForeignKey(
                'recipient_id'
            )->save();

        $this->table('likes')
            ->dropForeignKey(
                'user_id'
            )
            ->dropForeignKey(
                'packet_id'
            )->save();

        $this->table('packets')
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('packets_keywords')
            ->dropForeignKey(
                'packet_id'
            )
            ->dropForeignKey(
                'keyword_id'
            )->save();

        $this->table('sessions')
            ->dropForeignKey(
                'packet_id'
            )->save();

        $this->table('articles')->drop()->save();
        $this->table('auth_logs')->drop()->save();
        $this->table('config')->drop()->save();
        $this->table('feature_flags')->drop()->save();
        $this->table('flashcards')->drop()->save();
        $this->table('friends')->drop()->save();
        $this->table('keywords')->drop()->save();
        $this->table('likes')->drop()->save();
        $this->table('packets')->drop()->save();
        $this->table('packets_keywords')->drop()->save();
        $this->table('sessions')->drop()->save();
        $this->table('social_profiles')->drop()->save();
        $this->table('update_notes')->drop()->save();
        $this->table('users')->drop()->save();
    }
}
