<?php
$this->title = 'Category Search';
?>

<?php
use yii\helpers\Html;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 col-xl-2-offset-0">
            <div class="btn-group btn-group-justified">
                <?= Html::a('Новинки', ['site/index'], ['class' => 'btn btn-default btn-sm ']) ?>
                <?= Html::a('Популярні', ['site/sort-popular'], ['class' => 'btn btn-default btn-sm']) ?>
            </div>
        </div>
    </div>
</div>
<h3>Категорії</h3>
<div class="container">
    <div class="alert alert-success">
        <?php
        echo '<ul>';
for($x=0;$x<$tag_count;$x++){   //виводимо усі теги. біля них пишемо кількість постів з цим тегом(категорією)
    //при натисканні на тег буде відбуватися перехід на сторінку з постами цієї категорії
    echo'
    <a href="index.php?r=site/filter-categories&id='.$tags[$x]->id.'" class="alert-link"><li>'.$tags[$x]->name.' ('.$tags[$x]->countPosts().')</li></a>
    <br>
    ';
}
echo '</ul>';
?>
</div>
</div>
<?php
echo '
        <h3>Пости категорії <b>'. $tag_name .'</b></h3>';    //будуть виводитисб пости лише певної категорії. список цх постів ми уже отримали від контроллера

        if($posts==null){
            echo 'У цій категорії постів не знайдено...';
            return;
        }

        $indetef=0;
        for ($x = 0; $posts[$x]; $x++) {
            $indetef++;
        }

        $number_of_post=0;
        for ($x = $indetef-1; $x>=0; $x--) {    //виводимо в зворотньому порядку. виходить сортування по даті
            echo '
            <a href="index.php?r=post/view&id='.$posts[$x]->id.'"><li><b>' . (($number_of_post++) + 1) . ' post</b></li></a>
            <li>' . $posts[$x]->title . '</li>
            <li><img src="/Blog/yii2-app-basic/web/uploads/' . $posts[$x]->image . '" width="200"></li>
            <li>' . $posts[$x]->text . '</li>
            <li>' . $posts[$x]->status . ' (переглядів)</li>
            <li>' . $posts[$x]->tag->name . '</li>
            <li>' . $posts[$x]->create_time . '</li>
            <li>' . $posts[$x]->update_time . '</li>
            <li>' . $posts[$x]->user->login . '</li>
            <br>
            ';
        }
        ?>