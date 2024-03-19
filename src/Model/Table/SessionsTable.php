<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sessions Model
 *
 * @property \App\Model\Table\PacketsTable&\Cake\ORM\Association\BelongsTo $Packets
 *
 * @method \App\Model\Entity\Session newEmptyEntity()
 * @method \App\Model\Entity\Session newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Session> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Session get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Session findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Session patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Session> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Session|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Session saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Session>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Session>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Session>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Session> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Session>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Session>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Session>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Session> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SessionsTable extends Table
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

        $this->setTable('sessions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Packets', [
            'foreignKey' => 'packet_id',
            'joinType' => 'INNER',
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
            ->scalar('session_uid')
            ->maxLength('session_uid', 32)
            ->requirePresence('session_uid', 'create')
            ->notEmptyString('session_uid');

        $validator
            ->integer('packet_id')
            ->notEmptyString('packet_id');

        $validator
            ->integer('expected_folder')
            ->notEmptyString('expected_folder');

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
        $rules->add($rules->existsIn(['packet_id'], 'Packets'), ['errorField' => 'packet_id']);

        return $rules;
    }
}
