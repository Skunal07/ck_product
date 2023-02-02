<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserProfile Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserProfile newEmptyEntity()
 * @method \App\Model\Entity\UserProfile newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\UserProfile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserProfile get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserProfile findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\UserProfile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserProfile[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserProfile|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserProfile saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserProfile[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserProfile[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserProfile[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\UserProfile[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UserProfileTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('user_profile');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 50)
            ->allowEmptyString('first_name');
            // ->add('firest_name', [
            //     'notBlank' => [
            //         'rule'    => ['notBlank'],
            //         'message' => 'Please enter your first name',
            //         'last' => true
            //     ],
            //     'characters' => [
            //         'rule'    => ['custom', '/^[A-Z]+$/i'],
            //         'allowEmpty' => false,
            //         'last' => true,
            //         'message' => 'Please Enter characters only.'
            //     ],
            //     'length' => [
            //         'rule' => ['minLength', 2],
            //         'last' => true,
            //         'message' => 'First Name need to be at least 2 characters long',
            //     ],
            // ]);

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->allowEmptyString('last_name');
            // ->add('last_name', [
            //     'notBlank' => [
            //         'rule'    => ['notBlank'],
            //         'message' => 'Please enter your first name',
            //         'last' => true
            //     ],
            //     'characters' => [
            //         'rule'    => ['custom', '/^[A-Z]+$/i'],
            //         'allowEmpty' => false,
            //         'last' => true,
            //         'message' => 'Please Enter characters only.'
            //     ],
            //     'length' => [
            //         'rule' => ['minLength', 2],
            //         'last' => true,
            //         'message' => 'First Name need to be at least 2 characters long',
            //     ],
            // ]);

        $validator
            ->scalar('contact')
            ->maxLength('contact', 10)
            ->allowEmptyString('contact');
            // ->notEmptyString('contact','Please Enter your Phone No');


        $validator
            ->scalar('address')
            ->maxLength('address', 100)
            ->allowEmptyString('address');
            // ->notEmptyString('address','Please Enter your Addresss');


        $validator
            ->scalar('profile_image')
            ->maxLength('profile_image', 100)
            ->allowEmptyFile('profile_image');
            // ->add('profile_image', [
            //     'validExtension' => [
            //         'rule' => ['extension', ['gif', 'jpeg', 'png', 'jpg']], // default  ['gif', 'jpeg', 'png', 'jpg']
            //         'message' => 'These images extension are allowed: png ,jpeg, png, jpg'
            //     ],
            // ]);

        $validator
            ->dateTime('created_date')
            ->notEmptyDateTime('created_date');

        $validator
            ->dateTime('modified_date')
            ->allowEmptyDateTime('modified_date');

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
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
