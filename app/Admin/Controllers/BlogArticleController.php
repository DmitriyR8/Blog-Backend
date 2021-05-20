<?php

namespace App\Admin\Controllers;

use App\BlogArticle;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Str;
use function request;

/**
 * Class BlogArticleController
 * @package App\Admin\Controllers
 */
class BlogArticleController extends AdminController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'BlogArticles';

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
     * Create interface
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create Article')
            ->description('description')
            ->body($this->form());
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
        return Admin::grid(BlogArticle::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->slug('Slug')->style('max-width:200px; word-break:break-all; ');
            $grid->h1_title('H1 Title')->style('max-width:200px; word-break:break-all; ');
            $grid->title('Title')->style('max-width:200px; word-break:break-all; ');
            $grid->views('Views');
            $grid->short_desc('Short Description')->style('max-width:200px; word-break:break-all; ');
            $grid->author('Author')->style('max-width:200px; word-break:break-all; ');
            $grid->read_time('Read Time');
            $grid->related_articles('Related Articles')->table();
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
        return Admin::show(BlogArticle::findOrFail($id), function (Show $show){
            $show->id('id');
            $show->slug('slug');
            $show->h1_title('h1_title');
            $show->title('title');
            $show->description('description');
            $show->url('url');
            $show->views('views');
            $show->short_desc('short_desc');
            $show->author('author');
            $show->read_time('read_time');
            $show->back_img('back_img');
            $show->back_alt_img('back_alt_img');

            $show->related_articles('related_articles')->as(function ($relatedArticles){
                return json_encode($relatedArticles);
            });

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
        if (request()->get('slug')) {
            request()->merge([
                'slug' => Str::slug(request()->get('slug'), '-')
            ]);
        }
        return Admin::form(BlogArticle::class, function (Form $form) {

            $form->text('slug', 'Slug')
                ->rules("required|max:255|unique:blog_articles")
                ->updateRules(['required', "unique:blog_articles,slug,{{id}}"]);
            $form->text('h1_title', 'H1')
                ->rules("required|max:255");
            $form->text('title', 'Title')
                ->rules("required|max:255");
            $form->ckeditor('description', 'Description')
                ->rules("required");
            $form->url('url', 'Url')
                ->rules("required|max:255");
            $form->number('views', 'Views')
                ->rules("required|Regex:/[0-9]/|numeric")
                ->default(1)
                ->min(1)
                ->max(1000000);
            $form->textarea('short_desc', 'Short Description')
                ->rules("required|max:350");
            $form->text('author', 'Author Name')
                ->rules("required|max:255");
            $form->ckeditor('main_text', 'Main Text')
                ->rules("required");
            $form->time('read_time', 'Read Time')
                ->rules("required");
            $form->image('back_img', 'Background Image')
                ->required()
                ->retainable();
            $form->text('back_alt_img', 'Background Alt Image')
                ->rules('max:255');
            $form->table('related_articles', 'Related Articles', function ($table) {
                $table->text('Title')->rules("required|max:255");
                $table->url('Link')->rules("required|max:255");
            });

            $form->footer(function ($footer) {
                $footer->disableViewCheck();
                $footer->disableEditingCheck();
                $footer->disableCreatingCheck();

            });

            return $form;
        });
    }
}