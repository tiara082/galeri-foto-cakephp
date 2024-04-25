<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Photocomments Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PhotosTable&\Cake\ORM\Association\BelongsTo $Photos
 *
 * @method \App\Model\Entity\Photocomment newEmptyEntity()
 * @method \App\Model\Entity\Photocomment newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Photocomment> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Photocomment get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Photocomment findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Photocomment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Photocomment> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Photocomment|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Photocomment saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Photocomment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Photocomment>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Photocomment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Photocomment> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Photocomment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Photocomment>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Photocomment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Photocomment> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PhotocommentsTable extends Table
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

        $this->setTable('photocomments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Photos', [
            'foreignKey' => 'photo_id',
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
            ->scalar('isi')
            ->requirePresence('isi', 'create')
            ->notEmptyString('isi');

        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('photo_id')
            ->notEmptyString('photo_id');

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
        $rules->add($rules->existsIn(['photo_id'], 'Photos'), ['errorField' => 'photo_id']);

        return $rules;
    }
}
