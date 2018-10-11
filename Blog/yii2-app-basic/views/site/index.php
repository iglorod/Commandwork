<?php
$this->title = 'All Posts';
?>

<?php
use yii\helpers\Html;
?>
<?= Html::a('Новинки', ['site/index'], ['class' => 'btn btn-warning']) ?>
<?= Html::a('Популярні пости', ['site/sort-popular'], ['class' => 'btn btn-warning']) ?>

<h3>Категорії</h3>
<?php
echo '<ul>';
for($x=0;$x<$tag_count;$x++){   //виводимо усі теги. біля них пишемо кількість постів з цим тегом(категорією)
    //при натисканні на тег буде відбуватися перехід на сторінку з постами цієї категорії
    echo'
                    <a href="index.php?r=site/filter-categories&id='.$tags[$x]->id.'"><li>'.$tags[$x]->name.' ('.$tags[$x]->countPosts().')</li></a>
					<br>
        ';
}
echo '</ul>';
?>

<?php
    echo '<h3>Пости</h3><ul>';  //виводимо усі пости
    $number_of_post=0;
    for ($x = $count-1; $x >=0; $x--) { //виводимо в зворотньому порядку. виходить сортування по даті
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
    echo '</ul>';
?>
<div class="site-index">

</div>
