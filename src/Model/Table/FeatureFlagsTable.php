<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FeatureFlags Model
 *
 * @method \App\Model\Entity\FeatureFlag newEmptyEntity()
 * @method \App\Model\Entity\FeatureFlag newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\FeatureFlag> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FeatureFlag get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\FeatureFlag findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\FeatureFlag patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\FeatureFlag> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FeatureFlag|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\FeatureFlag saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\FeatureFlag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\FeatureFlag>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\FeatureFlag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\FeatureFlag> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\FeatureFlag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\FeatureFlag>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\FeatureFlag>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\FeatureFlag> deleteManyOrFail(iterable $entities, array $options = [])
 */
class FeatureFlagsTable extends Table
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

        $this->setTable('feature_flags');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->boolean('enabled')
            ->requirePresence('enabled', 'create')
            ->notEmptyString('enabled');

        return $validator;
    }
}
