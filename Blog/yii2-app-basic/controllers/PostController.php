<?php

namespace app\controllers;

use app\models\Comment;
use app\models\ImageUpload;
use app\models\LikePost;
use app\models\Tag;
use app\models\Likes;
use app\models\User;
use PHPUnit\Framework\Constraint\Count;
use Yii;
use app\models\Post;
use app\models\PostSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model_comment=new Comment();
        $model=$this->findModel($id);
        $comments=Comment::findAll(['id_post' => $id]);

        if(Yii::$app->user->identity->id!=$model->id_user) {    //щоб сам собі кількість переглядів не накручував
            $views = $model->status;
            $model->setViews(++$views);
        }

        return $this->render('view', [
            'model' => $model,
            'comments'=>$comments,
            'model_comment'=>$model_comment,
        ]);
    }

    public function actionLikePost(){
        $id=Yii::$app->request->post('id');
        $likes=LikePost::findOne([
            'id_post' => $id,
            'id_user'=>Yii::$app->user->identity->id,
        ]);

        if($likes==null){   //якщо лайк не існує, то створимо його
            $likes=new LikePost();
            $likes->id_user=Yii::$app->user->identity->id;
            $likes->id_post=$id;
            $likes->save(true);
        }else{                 //якщо існує - видалимо
            $likes->deleteLike();
        }

        echo $likes->getCount($id);die();
    }

    public function actionLike(){
        $id=Yii::$app->request->post('id');
        $likes=Likes::findOne([
            'id_comment' => $id,
            'id_user'=>Yii::$app->user->identity->id,
        ]);

        if($likes==null){   //якщо лайк не існує, то створимо його
            $likes=new Likes();
            $likes->id_user=Yii::$app->user->identity->id;
            $likes->id_comment=$id;
            $likes->save(true);
        }else{                 //якщо існує - видалимо
            $likes->deleteLike();
        }

        echo $likes->getCount($id);die();
    }

    public function actionComment(){
        $id=Yii::$app->request->post('id');
        $contant=Yii::$app->request->post('contant');

        $comment=new Comment();
        $comment->content=$contant;
        $comment->id_author=Yii::$app->user->identity->id;
        $comment->id_post=$id;
        $comment->save(true);

        $comments=Comment::findAll(['id_post' => $comment->id_post]);

        $model_comment=new Comment();
        $model=Post::findOne([
            'id' => $comment->id_post,
        ]);

        Yii::$app->controller->redirect('index.php?r=post/view&id='.$id.'', array('model' => $model,'comments'=>$comments,
            'model_comment'=>$model_comment) );
    }

    public function actionCreate()
    {
        $model = new Post();    //створюємо новий пост
        $model2=new ImageUpload;
        $model_comment=new Comment();
        $selectedTag=1;
        $action='create';
        $tags=ArrayHelper::map(Tag::find()->all(),'id','name');
        if (isset($_POST['Post'])) {
            $model->attributes = Yii::$app->request->post('Post');
            $model->id_user=Yii::$app->user->identity->id;
            $model->id_tag=Yii::$app->request->post('id_tag');
            $file = UploadedFile::getInstance($model2,'image');
            $model->image=$model2->uploadFile($file,'image.jpg');

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id, 'model_comment'=>$model_comment,]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'tags'=>$tags,
            'model2'=>$model2,
            'selectedTag'=>$selectedTag,
            'action'=>$action,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $selectedTag=$model->id_tag;
        $tags=ArrayHelper::map(Tag::find()->all(),'id','name');
        $action='update';

        if (Yii::$app->request->isPost) {
            $model->attributes = Yii::$app->request->post('Post');
            $model->id_tag=Yii::$app->request->post('id_tag');
            if(Yii::$app->user->identity->admin===1) {
                $model->update_time = date('d-m-Y, h:i:s') . ' (admin)';
            }else{
                $model->update_time = date('d-m-Y, h:i:s');
            }

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'tags'=>$tags,
            'selectedTag'=>$selectedTag,
            'action'=>$action,
        ]);
    }

    public function actionDelete($id)
    {
        if (file_exists(Yii::getAlias('@app') . '/web/uploads/' . $this->findModel($id)->image)) {
            unlink(Yii::getAlias('@app') . '/web/uploads/' . $this->findModel($id)->image);
        }
        $this->findModel($id)->delete();
        return $this->goHome();
    }

    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetImage($id){
        $model=new ImageUpload;

        if(Yii::$app->request->isPost)
        {
            $article = $this->findModel($id);
            $file = UploadedFile::getInstance($model,'image');

            if($article->saveImage( $model->uploadFile($file,$article->image))){
                return $this->redirect(['view','id'=>$article->id]);
            }
        }
        return $this->render('image', ['model'=>$model]);
    }

   /* public function actionSetCategory($id){
       $article=$this->findModel($id);
       $selectedTag=$article->tag->id;
       $tags=ArrayHelper::map(Tag::find()->all(),'id','name');

       if(Yii::$app->request->isPost){
           $tag=Yii::$app->request->post('tag');
           if($article->saveTag($tag)){
                return $this->redirect(['view','id'=>$article->id]);
           }
       }

       return $this->render('tag',['article'=>$article,'selectedTag'=>$selectedTag,'tags'=>$tags]);
    }*/
}
