<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $company
 * @property string $avatar
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $token
 * @property string $password_reset_token
 * @property string $role
 * @property string $account_type
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $last_login
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'first_name', 'last_name', 'company', 'avatar', 'email', 'password_hash', 'auth_key', 'token', 'password_reset_token', 'account_type'], 'required'],
            [['account_type'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at', 'last_login','company','company_website'], 'safe'],
            [['username'], 'string', 'max' => 30],
            [['first_name', 'last_name', 'company', 'password_reset_token'], 'string', 'max' => 250],
            [['avatar', 'email'], 'string', 'max' => 100],
            [['password_hash'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['token'], 'string', 'max' => 53],
            [['role'], 'string', 'max' => 64],
            [['username'], 'unique'],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'company' => 'Company',
            'avatar' => 'Avatar',
            'email' => 'Email',
            'company_website' => 'company_website',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'token' => 'Token',
            'password_reset_token' => 'Password Reset Token',
            'role' => 'Role',
            'account_type' => 'Account Type',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_login' => 'Last Login',
        ];
    }
}
