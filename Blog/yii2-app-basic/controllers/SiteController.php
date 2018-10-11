<?php

namespace app\controllers;

use app\models\Post;
use app\models\Tag;
use Yii;
use yii\web\Controller;
use app\models\Signup;
use app\models\Login;

class SiteController extends Controller
{

    public function actionIndex()   //виводимо усі пости
    {
        $posts=Post::find()->all(); //список всіх постів
        $count=Post::find()->count();   //та їхня кількість

        $tags=Tag::find()->all();   //список всіх тегів
        $tag_count=Tag::find()->count();    //та їхня кількість

        return $this->render('index',['posts'=>$posts,'count'=>$count,'tags'=>$tags,'tag_count'=>$tag_count]);
    }

    public function actionFilterCategories($id){

        $posts=Post::findAll(['id_tag' => $id]);    //список постів лише певної категрії

        $tags=Tag::find()->all();   //список всіх тегів
        $tag_name=Tag::findOne(['id' => $id]);
        $tag_name=$tag_name->name;  //ім'я тегу, по якому відбувається пошук постів
        $tag_count=Tag::find()->count();    //загальна кількість тегів

        return $this->render('filtercategories',['posts'=>$posts,'tags'=>$tags,'tag_count'=>$tag_count,'tag_name'=>$tag_name]);
    }

    public function actionSortPopular(){

        $posts=Post::find()->orderBy('status DESC')->all(); //список постів відсортований по переглядах


        $tags=Tag::find()->all();   //список всіх тегів
        $tag_count=Tag::find()->count();    //та їхня кількість

        return $this->render('sortpopular',['posts'=>$posts,'tags'=>$tags,'tag_count'=>$tag_count]);
    }

    public function actionAuthors(){
        return $this->render('authors');
    }

    public function actionMyPosts()
    {
        $posts=Post::findAll(['id_user' => Yii::$app->user->identity->id]);

        $tags=Tag::find()->all();   //список всіх тегів

        $tag_count=Tag::find()->count();    //загальна кількість тегів
        return $this->render('myposts',['posts'=>$posts,'tags'=>$tags,'tag_count'=>$tag_count]);
    }

    public function actionSignup()
    {
        $model = new Signup();

        if(isset($_POST['Signup'])){
            $model->attributes=Yii::$app->request->post('Signup');

            if($model->validate() && $model->signup())
            {
                Yii::$app->user->login($model->getUser());
                return $this->goHome();
            }
        }

        return $this->render('signup',['model'=>$model]);
    }

    public function actionLogin(){
        if(!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Login();
        if (isset($_POST['Login'])) {
            $model->attributes = Yii::$app->request->post('Login');

            if ($model->validate()) {
                Yii::$app->user->login($model->getUser());
                return $this->goHome();
            }
        }
        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        if(!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
            return $this->goHome();
        }
    }


}
