<?php

namespace App\Admin\Controllers;

use App\Comment;
use App\CommentUser;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

/**
 * Class CommentController
 * @package App\Admin\Controllers
 */
class CommentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Comments';

    /**
     * Index interface
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header($this->title)
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Comment::class, function (Grid $grid) {
            $grid->id('ID')->sortable();

            $grid->user_id('User')->display(function ($id){
                $comment = CommentUser::find($id);
                return $comment->name.'  ('.$comment->email.')';
            })->style('max-width:200px; word-break:break-all; ');
            $grid->rating('Rating');
            $grid->title('Title')->style('max-width:200px; word-break:break-all; ');
            $grid->comment_body('Comment')->style('max-width:200px; word-break:break-all; ');
            $grid->approve('Approve')->display(function ($approve){
                if (is_null($approve)){
                    return "<font color='blue'>new</font>";
                } elseif (!$approve) {
                    return "<font color='red'>no</font>";
                } else {
                    return "<font color='green'>yes</font>";
                }
            });
            $grid->commentable_id('Commentable ID');
            $grid->commentable_type('Commentable Type');
            $grid->disableCreation();

            $grid->filter(function ($filter){
                $filter->equal('approve')->radio([1 => 'yes', 0 => 'no']);
            });

            $grid->paginate(10);

            return $grid;
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        return Admin::show(Comment::findOrFail($id), function (Show $show){
            $show->id('id');
            $show->user_id('user')->as(function ($id){
                $comment = CommentUser::find($id);
                return $comment->name.'  ('.$comment->email.')';
            });
            $show->rating('rating');
            $show->comment_body('comment_body');
            $show->approve('approve');
            $show->commentable_id('commentable_id');
            $show->commentable_type('commentable_type');
            $show->created_at('created_at');
            $show->updated_at('updated_at');

            return $show;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Comment::class, function (Form $form) {
            $form->hasMany('user','User Info', function ($user){
                $user->text('name')
                    ->readonly()->rules("max:255");
                $user->email('email')
                    ->readonly()->rules("max:255");
            })->disableCreate()->disableDelete();
            $form->decimal('rating', 'Rating')
                ->default(0.1)
                ->options(['min' => 0.1, 'max' => 5.0])
                ->rules('required|max:3');
            $form->text('title', 'Title')
                ->rules('required|max:255');
            $form->ckeditor('comment_body', 'Comment')
                ->rules('required');
            $form->text('commentable_id', 'Commentable ID')
                ->setWidth(2)
                ->readonly();
            $form->text('commentable_type', 'Commentable Type')
                ->readonly()
                ->rules('max:255');

            $states = [
                'on'  => ['value' => 1, 'text' => 'yes', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => 'no', 'color' => 'danger'],
            ];

            $form->switch('approve', 'Approve')
                ->states($states);

            $form->footer(function ($footer) {
                $footer->disableViewCheck();
                $footer->disableEditingCheck();
                $footer->disableCreatingCheck();

            });

            return $form;
        });
    }
}
