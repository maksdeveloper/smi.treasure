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
                <div class="top-comment"><!--top comment-->
                    <img src="/uploads/images/comment.jpg" class="pull-left img-circle" alt="">
                    <h4>Rubel Miah</h4>

                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy hello ro mod tempor
                        invidunt ut labore et dolore magna aliquyam erat.</p>
                </div><!--top comment end-->
                <div class="row"><!--blog next previous-->
                    <div class="col-md-6">
                        <div class="single-blog-box">
       <a href="#">
           <?php //echo Url::current(['id' => $article->id - 1], true);
                            //TODO create the check for the first and last page
           ?>

                                <img src="/uploads/images/blog-next.jpg" alt="">

                                <div class="overlay">

                                    <div class="promo-text">
                                        <p><i class=" pull-left fa fa-angle-left"></i></p>
                                        <h5>Rubel is doing Cherry theme</h5>
                                    </div>
                                </div>


                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="single-blog-box">
                         <a href="#">
                         <?php //echo Url::current(['id' => $article->id + 1], true)
                            //TODO create the check for the first and last page
                         ?>
                                <img src="/uploads/images/blog-next.jpg" alt="">

                                <div class="overlay">
                                    <div class="promo-text">
                                        <p><i class=" pull-right fa fa-angle-right"></i></p>
                                        <h5>Rubel is doing Cherry theme</h5>

                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div><!--blog next previous end-->

                <?php if(isset($gallery)): ?>
                <div class="related-post-carousel">
                    <div class="related-heading">
                        <h4>Beautiful places in <?php echo $article->category->title;?></h4>
                    </div>
                    <div class="items">
                        <?php
                        foreach($gallery as $image):

                            ?>
                        <div class="single-item" style="background-image: url('<?php echo $image->getUrl('small'); ?>')" >


                                <p><?php echo $image->name; ?></p>


                        </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
                <?php endif;?>

                <div class="bottom-comment"><!--bottom comment-->
                    <h4>3 comments</h4>

                    <div class="comment-img">
                        <img class="img-circle" src="/uploads/images/comment-img.jpg" alt="">
                    </div>

                    <div class="comment-text">
                        <a href="#" class="replay btn pull-right"> Replay</a>
                        <h5>Rubel Miah</h5>

                        <p class="comment-date">
                            December, 02, 2015 at 5:57 PM
                        </p>


                        <p class="para">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            diam nonumy
                            eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                            voluptua. At vero eos et cusam et justo duo dolores et ea rebum.</p>
                    </div>
                </div>
                <!-- end bottom comment-->


                <div class="leave-comment"><!--leave comment-->
                    <h4>Leave a reply</h4>


                    <form class="form-horizontal contact-form" role="form" method="post" action="#">
                        <div class="form-group">
                            <div class="col-md-12">
										<textarea class="form-control" rows="6" name="message"
                                                  placeholder="Write Massage"></textarea>
                            </div>
                        </div>
                        <a href="#" class="btn send-btn">Post Comment</a>
                    </form>
                </div><!--end leave comment-->
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