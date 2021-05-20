<?php

namespace App\Admin\Controllers;

use App\Discount;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

/**
 * Class DiscountController
 * @package App\Admin\Controllers
 */
class DiscountController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Discounts';

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
            ->header('Create Discount')
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
        return Admin::grid(Discount::class, function (Grid $grid){
           $grid->id('ID')->sortable();
           $grid->discount_code('Discount Code')->style('max-width:200px; word-break:break-all; ');;
           $grid->url('Url');
           $grid->description('Description')->style('max-width:200px; word-break:break-all; ');;
           $grid->percent('Percent');
           $grid->hardcode_id('Hardcode Id');
            $grid->filter(function ($filter){
                $filter->scope('hardcode_id', 'Discounts')->whereBetween('hardcode_id', [1,3]);
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
        return Admin::show(Discount::findOrFail($id), function (Show $show){

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
        return Admin::form(Discount::class, function (Form $form){
            $form->text('discount_code','Discount code')
                ->rules("required|max:255");
            $form->url('url','Url')
                ->rules("required|max:255");
            $form->ckeditor('description', 'Description')
                ->rules("required");
            $form->decimal('percent','Percent')
                ->default(1)
                ->options(['min' => 1, 'max' => 100])
                ->rules("required|max:3");
            $form->number('hardcode_id','Hardcode id')
                ->default(1)
                ->min(1)
                ->rules("unique:discounts|numeric|required")
                ->updateRules(['required', "unique:discounts,hardcode_id,{{id}}"]);
            $form->image('logo','Logo')
                ->required()
                ->retainable();

            $form->footer(function ($footer) {
                $footer->disableViewCheck();
                $footer->disableEditingCheck();
                $footer->disableCreatingCheck();

            });

            return $form;
        });

    }
}
