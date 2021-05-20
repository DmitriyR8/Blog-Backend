<?php

namespace App\Admin\Controllers;

use App\SingleReview;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Str;
use function request;

/**
 * Class SingleReviewController
 * @package App\Admin\Controllers
 */
class SingleReviewController extends AdminController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SingleReviews';

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
            ->header('Create Review')
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
        return Admin::grid(SingleReview::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->slug('Slug')->style('max-width:200px; word-break:break-all; ');
            $grid->h1_title('H1 Title')->style('max-width:200px; word-break:break-all; ');
            $grid->title('Title')->style('max-width:200px; word-break:break-all; ');
            $grid->overall_rating('Overall Rating');
            $grid->quality('Quality');
            $grid->price('Price');
            $grid->customer_support('Customer Support');
            $grid->author('Author Name')->style('max-width:200px; word-break:break-all; ');
            $grid->short_desc('Short Description')->style('max-width:200px; word-break:break-all; ');
            $grid->hardcode_id('Hardcode ID');
            $grid->link('Referral Link')->link();
            $grid->filter(function ($filter){
               $filter->scope('hardcode_id', 'Banners')->whereBetween('hardcode_id', [1,3]);
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
        return Admin::show(SingleReview::findOrFail($id), function (Show $show){

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
        return Admin::form(SingleReview::class, function (Form $form) {

            $form->text('slug', 'Slug')
                ->rules("required|max:255|unique:single_reviews")
                ->updateRules(['required', "unique:single_reviews,slug,{{id}}"]);
            $form->text('h1_title', 'H1')
                ->rules("required|max:255");
            $form->text('title', 'Title')
                ->rules("required|max:255");
            $form->ckeditor('description','Description')
                ->rules("required");
            $form->decimal('overall_rating', 'Overall Rating')
                ->default(0.1)
                ->options(['min' => 0.1, 'max' => 5.0])
                ->rules("required|max:3");
            $form->number('quality', 'Quality')
                ->rules("required|Regex:/[0-9]/|numeric")
                ->default(1)
                ->min(1)
                ->max(100);
            $form->number('price', 'Price')
                ->rules("required|Regex:/[0-9]/|numeric")
                ->default(1)
                ->min(1)
                ->max(100);
            $form->number('customer_support', 'Customer Support')
                ->rules("required|Regex:/[0-9]/|numeric")
                ->default(1)
                ->min(1)
                ->max(100);
            $form->text('author', 'Author Name')
                ->rules("required");
            $form->image('back_img', 'Background Image')
                ->required()
                ->retainable();
            $form->text('back_alt_img', 'Alt Background Image')
                ->rules('max:255');
            $form->textarea('short_desc', 'Short Description')
                ->rules("required|max:350");
            $form->ckeditor('main_text', 'Main Text')
                ->rules("required");
            $form->number('hardcode_id', 'Hardcode ID')
                ->default(1)
                ->min(1)
                ->rules("unique:single_reviews|numeric|required")
                ->updateRules(['required', "unique:single_reviews,hardcode_id,{{id}}"]);
            $form->url('link', ' Referral link')
                ->rules("required|max:255");
            $form->url('url', 'URL')
                ->rules("required|max:255");
            $form->image('logo_img', 'Logo Image')
                ->required()
                ->retainable();
            $form->text('logo', 'Logo Name Site')
                ->rules("required|max:255");

            $form->footer(function ($footer) {
                $footer->disableViewCheck();
                $footer->disableEditingCheck();
                $footer->disableCreatingCheck();

            });

            return $form;
        });
    }
}
