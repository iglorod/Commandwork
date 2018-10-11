<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <?php if(Yii::$app->user->identity->id===$model->id_user) {

        echo '<p>';
        ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item ? ',
                'method' => 'post',
            ],
        ]) ?>
        <?php
        echo '</p>';
    }
    ?>


    <?php
    echo '<h3>'.$model->title.'</h3><img src="/Blog/yii2-app-basic/web/uploads/' . $model->image . '" width="600">';
        echo '
					<div>' . $model->text . '</div>
					<div>' . $model->status . ' (переглядів)</div>
					<div>' . $model->tag->name . '</div>
					<div>' . $model->create_time . '</div>
					<div>' . $model->update_time . '</div>
					<div>' . $model->user->login . '</div>
					<br>
        ';
    ?>

    <?php
    if(Yii::$app->user->isGuest){
        echo '<a href="index.php?r=site/login"><button type="button" class="btn btn-default">Like '. $model->count .'</button></a><hr>';
    }else {
        echo '<button type="button" class="btn btn-default like_post" post="' . $model->id . '">Like '. $model->count .'</button><hr>';
    }?>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model_comment, 'content')->textarea(['rows' => 6,'id'=>'com_cont']) ?>

    <?php
    if(Yii::$app->user->isGuest){
        echo '<a href="index.php?r=site/login"><button type="button" class="btn btn-success comments"">COMMENT</button></a>';
    }else {
        echo '<button type="button" class="btn btn-success comments" id_post="' . $model->id . '">COMMENT</button>';
    }?>
    <?php ActiveForm::end(); ?>
    <?php
        if($comments!=null){
            echo '<hr><h3>Коментарі</h3><hr>';
            echo '<div id="content">';
            for($x=0;$comments[$x];$x++){
                echo '
					<div><b>' . $comments[$x]->author->login . '</b><em>, '.$comments[$x]->create_time.'</em></div>
					<div>' . $comments[$x]->content . '</div>
					
					<button type="button" class="btn btn-danger like like'.$comments[$x]->id.'" id_comment="'.$comments[$x]->id.'">Like '. $comments[$x]->count .'</button>
					<br><br>
        ';
        }
            echo '</div>';
        }

    ?>


    <script>
        $(".like").click(function(){
            var id_comment = {
                'id':$(this).attr('id_comment')
            };
            var l=$(this).attr('id_comment');

          $.post('index.php?r=post/like',id_comment,function(data){
             $(".like"+l).text('Like'+data);
          });
        });

        $(".like_post").click(function(){
            var id_post = {
                'id':$(this).attr('post')
            };

            $.post('index.php?r=post/like-post',id_post,function(data){
                $(".like_post").text('Like'+data);
            });
        });

        $(".comments").click(function(){
            var b=document.getElementById('com_cont');
            var contant=b.value;
            b.value='';
            var id_post = {
                'id':$(this).attr('id_post'),
                'contant':contant
        };
            $.post('index.php?r=post/comment',id_post,function(){

            });
        });
    </script>
</div>
