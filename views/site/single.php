<?php
use yii\helpers\Html;
use yii\helpers\Url;

$author = ($article->author) ? $article->author->name : 'Noname';


?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                       <img src="<?php echo $article->getImage();?>" alt="">
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="<?php echo Url::toRoute(['site/category', 'id' => $article->category->id]); ?>"> <?php echo $article->category->title;?></a></h6>

                            <h1 class="entry-title"><a href="<?php echo Url::toRoute(['site/view', 'id' => $article->id]); ?>"><?php echo $article->title;?></a></h1>


                        </header>
                        <div class="entry-content">
                           <?php echo $article->content;?>
                        </div>
                        <div class="decoration">
                            <?php foreach ($tags as $kay=>$tag): ?>
                            <a href="<?php echo Url::toRoute(['site/tag', 'id' => $kay]); ?>" class="btn btn-default"><?php echo $tag;?></a>
                            <?php endforeach; ?>
                        </div>

                        <div class="social-share">
							<span
                                class="social-share-title pull-left text-capitalize">By <?php echo $author;?> <?php echo $article->getDate();?></span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>

                <div class="row next-prev"><!--blog next previous-->


                    <div class="col-md-6">
                        <?php if($prev !== null): ?>
                        <div class="single-blog-box">
                         <a href="<?php echo Url::current(['id' => $prev->id], true);?>">


                                <div class="overlay" style="background-image: url('<?php echo $prev->getImage();?>'); height: 120px">

                                    <div class="promo-text">
                                        <p><i class=" pull-left fa fa-angle-left"></i></p>
                                        <h5><?php echo $prev->title;?></h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6">
                        <?php if($next !== null): ?>
                        <div class="single-blog-box">
                         <a href="<?php echo Url::current(['id' => $next->id], true); ?>">

                                <div class="overlay" style="background-image: url('<?php echo $next->getImage();?>'); height: 120px">
                                    <div class="promo-text">
                                        <p><i class=" pull-right fa fa-angle-right"></i></p>
                                        <h5><?php echo $next->title;?></h5>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>

                </div><!--blog next previous end-->

                <?php if(!empty($gallery)): ?>
                <div class="related-post-carousel">
                    <div class="related-heading">
                        <h4>Beautiful places in <?php echo $article->category->title;?></h4>
                    </div>
                    <div class="items">
                        <?php foreach($gallery as $image): ?>
                        <div class="single-item" style="background-image: url('<?php echo $image->getUrl('small'); ?>')" >


                                <p><?php echo $image->name; ?></p>


                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif;?>


                <?php echo $this->render('/partials/comment', [
                    'article'=>$article,
                    'comments'=>$comments,
                    'commentForm'=>$commentForm
                ])?>
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