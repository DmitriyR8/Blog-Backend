<?php

namespace App\Admin\Controllers;

use App\Email;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

/**
 * Class EmailController
 * @package App\Admin\Controllers
 */
class EmailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Emails';

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
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Email::class, function (Grid $grid){
            $grid->id('ID')->sortable();
            $grid->email('Email')->style('max-width:200px; word-break:break-all; ');;
            $grid->action('Resource');
            $grid->created_at('Data');
            $grid->disableCreation();

            $grid->actions(function ($actions){
                $actions->disableEdit();
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
        return Admin::show(Email::findOrFail($id), function (Show $show){
            $show->panel()->tools(function ($actions){
                $actions->disableEdit();
            });

            return $show;
        });
    }
}
