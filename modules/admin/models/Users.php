<?php

namespace app\modules\admin\models;

use app\models\BaseModel;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $username
 * @property string|null $password
 * @property string|null $position
 * @property string|null $email
 * @property string|null $address
 * @property string|null $content
 * @property int|null $status
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_by
 * @property int|null $updated_at
 */
class Users extends BaseModel implements IdentityInterface
{
    public $confirmPassword;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'username', 'password', 'status', 'confirmPassword'], 'required'],
            [['address', 'content'], 'string'],
            [['status', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['name', 'username', 'password'], 'string', 'max' => 100],
            [['position'], 'string', 'max' => 150],
            [['username'], 'unique'],
            [['email'], 'email'],
            ['confirmPassword', 'confirm'],
        ];
    }

    /**
     * @param $son
     */
    public function confirm($son){
        if ($this->password != $this->confirmPassword) {
            $this->addError($son, 'Password and Confirm Password are not compatible!');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'confirmPassword' => Yii::t('app', 'Confirm Password'),
            'position' => Yii::t('app', 'Position'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Address'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    ////////////////////////////////////
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }


    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        //  return $this->authKey;
    }


    public function validateAuthKey($authKey)
    {
        //  return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
}
