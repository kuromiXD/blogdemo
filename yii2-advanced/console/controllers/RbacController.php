<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();


        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);


        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = 'Delete a post';
        $auth->add($deletePost);

        $approveComment = $auth->createPermission('approveComment');
        $approveComment->description = 'Approve comment';
        $auth->add($approveComment);


        $postAdmin = $auth->createRole('postAdmin');
        $auth->add($postAdmin);
        $auth->addChild($postAdmin, $createPost);
        $auth->addChild($postAdmin, $updatePost);
        $auth->addChild($postAdmin, $deletePost);

        $postOperator = $auth->createRole('postOperator');
        $auth->add($postOperator);
        $auth->addChild($postOperator,$deletePost);

        $commentAuditor = $auth->createRole('commentAuditor');
        $auth->add($commentAuditor);
        $auth->addChild($commentAuditor, $approveComment);

        $admin=$auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($postAdmin,$admin);
        $auth->addChild($commentAuditor,$admin);


        $auth->assign($admin, 1);
        $auth->assign($postAdmin, 2);
        $auth->assign($postOperator,3);
        $auth->assign($commentAuditor,4);
    }
}