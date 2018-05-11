<?php
/**
 * Created by PhpStorm.
 * User: SMI
 * Date: 5/11/2018
 * Time: 10:44 AM
 */

namespace app\models;
use Yii;
use yii\base\Model;
class CommentForm extends Model
{
    public $comment;

    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3,250]]
        ];
    }
    public function saveComment($article_id)
    {
        $comment = new Comment;
        $comment->text = $this->comment;
        $comment->user_id = Yii::$app->user->id;
        $comment->article_id = $article_id;
        $comment->status = 0;
        $comment->date = date('Y-m-d');
        return $comment->save();
    }
}