<?php

namespace app\controllers;

use app\models\Article;
use app\models\ArticleTag;
use app\models\Category;
use app\models\CommentForm;
use app\models\Tag;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $data = Article::getAll(2);
        $popular = Article::getPopular();
        $recent  = Article::getRecent();
        $categories = Category::getAll();

        return $this->render('index', [
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories
        ]);


    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionView($id)
    {
        $article = Article::findOne($id);
        $popular = Article::getPopular();
        $recent  = Article::getRecent();
        $categories = Category::getAll();
        $tags = $this->actionGetTags($id);
        $gallery = Category::findOne($article->category_id)->getBehavior('galleryBehavior')->getImages();

        $prevArticle = Article::find()->where(['<', 'id', $id])->orderBy('id desc')->one();
        $nextArticle = Article::find()->where(['>', 'id', $id])->one();

        $article->viewedCounter();

        $comments = $article->getArticleComments();
        $commentForm = new CommentForm();


        return $this->render('single', [
            'article' => $article,
            'prev' => $prevArticle,
            'next' => $nextArticle,
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories,
            'tags' => $tags,
            'gallery' => $gallery,
            'comments' => $comments,
            'commentForm' => $commentForm,
        ]);
    }

    public function actionCategory($id)
    {

        $query = Article::find()->where(['category_id' => $id]);
        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['articles'] = $articles;

        $data['pagination'] = $pagination;
        $popular = Article::getPopular();
        $recent  = Article::getRecent();
        $categories = Category::getAll();




        return $this->render('category', [
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories,

        ]);
    }

    public function actionTag($id)
    {

        $query = ArticleTag::find()->where(['tag_id' => $id])->with('article');

        $countQuery = clone $query;
        $pagination = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);

        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['articles'] = $articles;
        $data['pagination'] = $pagination;
        $popular = Article::getPopular();
        $recent  = Article::getRecent();
        $categories = Category::getAll();


        return $this->render('tag', [
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories
        ]);
    }

    public function actionGetTags( $id )
    {

        $article = Article::findOne($id);

        $selectedTags = $article->getSelectedTags();

        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');

        $arrayTagsName = [];

        foreach ($selectedTags as $tag_id){

            $arrayTagsName[$tag_id] = $tags[$tag_id];
        }

        return $arrayTagsName;

    }

    public function actionComment($id)
    {
        $model = new CommentForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id))
            {
                Yii::$app->getSession()->setFlash('comment', 'Your comment will be added soon!');
                return $this->redirect(['site/view','id'=>$id]);
            }
        }
    }

}
