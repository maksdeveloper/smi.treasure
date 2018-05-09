<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>

<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
<?php
foreach($articles as $item):
    $author = ($item->article->author) ? $item->article->author->name : 'Noname';

    ?>
                <article class="post post-list">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="post-thumb">
                                <a href="<?php echo Url::toRoute(['site/view', 'id' => $item->article->id]); ?>"><img src="<?php echo $item->article->getImage();?>" alt="" class="pull-left"></a>

                                <a href="<?php echo Url::toRoute(['site/view', 'id' => $item->article->id]); ?>" class="post-thumb-overlay text-center">
                                    <div class="text-uppercase text-center">View Post</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="post-content">
                                <header class="entry-header text-uppercase">
                                    <h6><a href="<?php echo Url::toRoute(['site/category', 'id' => $item->article->category->id]); ?>"> <?php echo $item->article->category->title;?></a></h6>

                                    <h1 class="entry-title"><a href="<?php echo Url::toRoute(['site/view', 'id' => $item->article->id]); ?>"><?php echo $item->article->title;?></a></h1>
                                </header>
                                <div class="entry-content">
                                    <p><?php echo $item->article->description;?>
                                    </p>
                                </div>
                                <div class="social-share">
                                    <span class="social-share-title pull-left text-capitalize">By <?php echo $author;?> On <?php echo $item->article->getDate();?></span>

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