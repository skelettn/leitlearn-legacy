<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Flashcards Model
 *
 * @property \App\Model\Table\PacketsTable&\Cake\ORM\Association\BelongsTo $Packets
 *
 * @method \App\Model\Entity\Flashcard newEmptyEntity()
 * @method \App\Model\Entity\Flashcard newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Flashcard> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Flashcard get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Flashcard findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Flashcard patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Flashcard> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Flashcard|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Flashcard saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Flashcard>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Flashcard>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Flashcard>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Flashcard> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Flashcard>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Flashcard>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Flashcard>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Flashcard> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FlashcardsTable extends Table
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

        $this->setTable('flashcards');
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
            ->integer('packet_id')
            ->notEmptyString('packet_id');

        $validator
            ->scalar('question')
            ->requirePresence('question', 'create')
            ->notEmptyString('question');

        $validator
            ->scalar('answer')
            ->requirePresence('answer', 'create')
            ->notEmptyString('answer');

        $validator
            ->scalar('media')
            ->maxLength('media', 255)
            ->allowEmptyString('media');

        $validator
            ->integer('leitner_folder')
            ->notEmptyString('leitner_folder');

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
