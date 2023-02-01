<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * Users Model
 *
 * @property \App\Model\Table\ProductCommentsTable&\Cake\ORM\Association\HasMany $ProductComments
 * @property \App\Model\Table\UserProfileTable&\Cake\ORM\Association\HasMany $UserProfile
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('ProductComments', [
            'foreignKey' => 'user_id',
        ]);
        // $this->hasMany('UserProfile', [
        //     'foreignKey' => 'user_id',
        // ]);
        $this->hasOne('UserProfile');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        // $validator
        //     ->email('email')
        //     ->requirePresence('email', 'create')
        //     ->notEmptyString('email')
        //     ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        // $validator
        //     ->scalar('password')
        //     ->maxLength('password', 200)
        //     ->requirePresence('password', 'create')
        //     ->notEmptyString('password');

            $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email', "please enter your Email")
            ->add('email', 'unique', [
                'rule' => 'validateUnique', 'provider' => 'table',
                'message' => 'Email already exist please enter another Email',
            ]);


        $validator
            ->scalar('password')
            ->maxLength('password', 225)
            ->requirePresence('password', 'create')
            ->add('password', [
                'notBlank' => [
                    'rule'    => ['notBlank'],
                    'message' => 'Please enter your password',
                ],
                'upperCase' => [
                    'rule' => function ($value) {
                        $count = mb_strlen(preg_replace('![^A-Z]+!', '', $value));
                        if ($count > 0) {
                            return true;
                        } else {
                            return false;
                        }
                    },
                    'message' => 'Please enter at least one uppercase',
                ],
                'lowerCase' => [
                    'rule' => function ($value) {
                        $count = mb_strlen(preg_replace('![^a-z]+!', '', $value));
                        if ($count > 0) {
                            return true;
                        } else {
                            return false;
                        }
                    },
                    'message' => 'Please enter at least one lowercase',
                ],
                'numeric' => [
                    'rule' => function ($value) {
                        $count = mb_strlen(preg_replace('![^0-9]+!', '', $value));
                        if ($count > 0) {
                            return true;
                        } else {
                            return false;
                        }
                    },
                    'message' => 'Please enter at least one numeric',
                ],
                'special' => [
                    'rule' => function ($value) {
                        $count = mb_strlen(preg_replace('![^@#*]+!', '', $value));
                        if ($count > 0) {
                            return true;
                        } else {
                            return false;
                        }
                    },
                    'message' => 'Please enter at least one special character',
                ],
                'minLength' => [
                    'rule' => ['minLength', 8],
                    'message' => 'Password need to be 8 characters long',
                ],
            ]);
        $validator
            ->scalar('confirm_password')
            ->maxLength('confirm_password', 225)
            ->requirePresence('confirm_password', 'create')
            ->add('confirm_password', [
                'notBlank' => [
                    'rule'    => ['notBlank'],
                    'message' => 'Please enter your confirm-password',
                    'last' => true,
                ],
                'match' => [
                    'rule' => array('compareWith', 'password'),
                    'last' => true,
                    'message' => 'Password should not match with the previous password'
                ]
            ]);

   
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
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        return $rules;
    }
    public function checktokenexist($token)
    {
        $result = $this->find('all')->where(['token' => $token])->first();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function checkEmailExist($email)
    {
        $result = $this->find('all')->where(['email' => $email])->first();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function resetPassword($token, $password)
    {
        $users = TableRegistry::get("Users");
        $query = $users->query();
        $pass=(new DefaultPasswordHasher())->hash($password);
        $result = $query->update()
            ->set(['password' => $pass, 'token' => ''])
            ->where(['token' => $token])
            ->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    public function insertToken($email, $token)
    {
        $users = TableRegistry::get("Users");
        $query = $users->query();
        $result = $query->update()
            ->set(['token' => $token])
            ->where(['email' => $email])
            ->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
