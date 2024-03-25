<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Packets Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\FlashcardsTable&\Cake\ORM\Association\HasMany $Flashcards
 * @property \App\Model\Table\KeywordsTable&\Cake\ORM\Association\BelongsToMany $Keywords
 *
 * @method \App\Model\Entity\Packet newEmptyEntity()
 * @method \App\Model\Entity\Packet newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Packet> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Packet get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Packet findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Packet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Packet> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Packet|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Packet saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Packet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Packet>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Packet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Packet> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Packet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Packet>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Packet>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Packet> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PacketsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('packets');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Flashcards', [
            'foreignKey' => 'packet_id',
        ]);
        $this->hasMany('Likes', [
            'foreignKey' => 'packet_id',
        ]);
        $this->hasMany('Sessions', [
            'foreignKey' => 'packet_id',
        ]);
        $this->belongsToMany('Keywords', [
            'foreignKey' => 'packet_id',
            'targetForeignKey' => 'keyword_id',
            'joinTable' => 'packets_keywords',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('packet_uid')
            ->maxLength('packet_uid', 32)
            ->requirePresence('packet_uid', 'create')
            ->notEmptyString('packet_uid');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 510)
            ->allowEmptyString('description');

        $validator
            ->integer('importation_count')
            ->notEmptyString('importation_count');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        $validator
            ->boolean('ia')
            ->requirePresence('ia', 'create')
            ->notEmptyString('ia');

        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('creator_id')
            ->allowEmptyString('creator_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
