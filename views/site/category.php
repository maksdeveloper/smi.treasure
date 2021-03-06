<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>

<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
<?php
foreach($articles as $article):
    $author = ($article->author) ? $article->author->name : 'Noname';

    ?>
                <article class="post post-list">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="post-thumb">
                                <a href="<?php echo Url::toRoute(['site/view', 'id' => $article->id]); ?>"><img src="<?php echo $article->getImage();?>" alt="" class="pull-left"></a>

                                <a href="<?php echo Url::toRoute(['site/view', 'id' => $article->id]); ?>" class="post-thumb-overlay text-center">
                                    <div class="text-uppercase text-center">View Post</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="post-content">
                                <header class="entry-header text-uppercase">
                                    <h6><a href="<?php echo Url::toRoute(['site/category', 'id' => $article->category->id]); ?>"> <?php echo $article->category->title;?></a></h6>

                                    <h1 class="entry-title"><a href="<?php echo Url::toRoute(['site/view', 'id' => $article->id]); ?>"><?php echo $article->title;?></a></h1>
                                </header>
                                <div class="entry-content">
                                    <p><?php echo $article->description;?>
                                    </p>
                                </div>
                                <div class="social-share">
                                    <span class="social-share-title pull-left text-capitalize">By <?php echo $author;?> On <?php echo $article->getDate();?></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </article>
<?php endforeach; ?>
                <?php

                echo LinkPager::widget([
                    'pagination' => $pagination,
                ]);
                ?>
            </div>
            <?php echo $this->render('/partials/sidebar',[
                'popular' => $popular,
                'recent' => $recent,
                'categories' => $categories
            ]);
            ?>
        </div>
    </div>
</div>