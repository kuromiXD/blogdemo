<?php
namespace backend\models;

use yii\base\Model;
use common\models\Adminuser;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $id;
    public $username;
    public $nickname;
    public $email;
    public $password;
    public $password_repeat;
    public $profile;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_repeat','compare','compareAttribute'=>'password','message'=>'两次输入的密码不一致'],

            ['nickname','required'],
            ['nickname','string','max'=>12],

            ['profile','string'],

        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '管理员用户名',
            'nickname' => '昵称',
            'password' => '密码',
            'password_repeat'=>'重复密码',
            'email' => 'Email',
            'profile' => '简介',
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new Adminuser();
        $user->username = $this->username;
        $user->nickname =$this ->nickname;
        $user->email = $this->email;
        $user->profile =$this->profile;
        $user->password='******';
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if($user->save()){
            $this->id=$user->id;
            return true;
        } else {
            return false;
        }        
        //return $user->save() ? $user : null;
    }
}
