<?php
$this->title = 'My Posts';
?>

<?php
echo '<h3>Мої пости</h3><ul>';  //виводимо усі пости
$indetef=0;
for ($x = 0; $posts[$x]; $x++) {
    $indetef++;
}

$number_of_post=0;
for ($x = $indetef-1; $x>=0; $x--)  { //виводимо в зворотньому порядку. виходить сортування по даті
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
