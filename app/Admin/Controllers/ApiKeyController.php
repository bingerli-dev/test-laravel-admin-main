<?php

namespace App\Admin\Controllers;

use App\Models\ApiKey;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ApiKeyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ApiKey';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ApiKey());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('client_id', __('Client ID'));
        $grid->column('client_secret', __('Client Secret'));
        $grid->column('name', __('Name'));
        $grid->column('is_active', __('Is Active'))->bool();


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ApiKey::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('client_id', __('Client ID'));
        $show->field('client_secret', __('Client Secret'));
        $show->field('name', __('Name'));
        $show->field('is_active', __('Is Active'))->bool();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ApiKey());

        $form->text('client_id', __('Client ID'))->rules('required|max:64')->creationRules('unique:api_keys,client_id');
        $form->text('client_secret', __('Client Secret'))->rules('required|max:64');
        $form->text('name', __('Name'))->rules('nullable');
        $form->switch('is_active', __('Is Active'))->default(true);

        return $form;
    }
}