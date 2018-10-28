<?php
$this->title = 'Category Search';
?>

<?php
use yii\helpers\Html;
?>
<div class="MyBodyLoL" style="margin-top: 80px">

    <div class="row">
        <div class="col col-lg-4 col-md-4  ">
            <div class="col col-lg-8 col-lg-offset-2">
                <div class="btn-group btn-group-justified m-1">
                    <?= Html::a('Новинки', ['site/index'], ['class' => 'btn btn-default ']) ?>
                    <?= Html::a('Популярні', ['site/sort-popular'], ['class' => 'btn btn-default']) ?>
                </div>

                <ul class="list-group">

                    <?php
                    for ($x = 0; $x < $tag_count; $x++) {   //виводимо усі теги. біля них пишемо кількість постів з цим тегом(категорією)
                        //при натисканні на тег буде відбуватися перехід на сторінку з постами цієї категорії
                        echo '<li class="list-group-item">
                        <a class="categoryLink" href="index.php?r=site/filter-categories&id=' . $tags[$x]->id . '" class="alert-link">' . $tags[$x]->name .
                            '<span class="badge pull-right">' . $tags[$x]->countPosts() . '</span>' . '</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="col col-lg-7 col-md-8 col-sm- ">
<?php
echo "<div class='row'>";
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
    <div class="col col-lg-6 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-lg-offset-0">
        <div class="thumbnail p-0 postThumbnail" style="border-radius: 0">
            <div class="caption">
                <div class="postTitleArea">
                    <div class="row zero">
                        <div class="col col-lg-4 col-md-4 col-sm-2 col-xs-3">
                            <div class="userImg  pull-right"></div>
                        </div>
                        <div class="col col-lg-8 col-md-8 col-sm-10 col-xs-9 zero">
                            <span class="postTitle"><a href="index.php?r=post/view&id=' . $posts[$x]->id . '">' . $posts[$x]->title . '</a></span>
                            <div class="row zero"><span class="postSecondaryText">' . $posts[$x]->user->login . '</span></div>
                        </div>
                    </div>
                </div>
                <p></p>
                <p><img class="postImg" style="background-image: url(' . Yii::getAlias('@web') . '/uploads/' . $posts[$x]->image . ')"></p>
                <div class="caption">
                    <p>' . $posts[$x]->text . '</p>
                </div>
            </div>
            <div class="row zero postFooter">
                <div class="col" style="width:15%">
                    <span class="postCountView">' . $posts[$x]->status . '<span style="font-size: 20px;padding: 5px" class="glyphicon glyphicon-eye-open"></span></span>
                    
                </div>
                <div class="col" style="width:85%">
                    <span class="postDate">' . date("F j, Y, g:i a", strtotime($posts[$x]->create_time)) . '</span>
                </div>
            </div>
        </div>
    </div>
        ';
            }
            echo '</div>';
            ?>
        </div>
    </div>
</div>



<script>
    $(".removableContainer").removeClass("container").addClass("container-fluid");
</script>