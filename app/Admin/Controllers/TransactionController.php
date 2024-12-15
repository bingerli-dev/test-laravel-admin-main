<?php

namespace App\Admin\Controllers;

use App\Models\K22Transaction;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TransactionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Transaction';
    private $map = [
        "id" => "ID",
        "PAYMENT_ID" => "Payment Id",
        "TRANSACTION_ID" => "Transaction Id",
        "KDP_SERIAL_NUMER" => "KDP Serial Number",
        "XF_STORECODE" => "Store Code",
        "XF_TXDATE" => "Transaction Date",
        "XF_DOCNO" => "Document Number",
        "XF_VIPCODE" => "VIP Code",
        "XF_AMT" => "Amount",
        "XF_CREATETIME" => "Transaction Create Time",
        "XF_TXTIME" => "Transaction Time",
        "XF_TENDERCODE" => "Tender Code",
        "XF_SALESTIME" => "Sales Time",
        "XF_VIPGRADE" => "VIP Grade",
        "XF_VOIDSTATUS" => "Void Status",
        "VIPACCOUNTNO" => "VIP Account Number",
        "XF_MALLID" => "Mall Id",
    ];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new K22Transaction());
        foreach ($this->map as $db_key => $view_key) {
            switch ($db_key) {
                case "id":
                    $grid->column($db_key, __($view_key))->sortable();
                    break;
                default:
                    $grid->column($db_key, __($view_key));
                    break;
            }
        }

        // 自定义过滤器
        $grid->filter(function ($filter) {
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $arr = [
                "PAYMENT_ID", "TRANSACTION_ID", "KDP_SERIAL_NUMER",
                "XF_STORECODE", "XF_TXDATE", "VIPACCOUNTNO", "XF_MALLID"
            ];
            foreach ($arr as $db_key) {
                $filter->like($db_key, $this->map[$db_key]);
            }
        });

        $grid->model()->orderBy('id', 'asc');

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
        $show = new Show(K22Transaction::findOrFail($id));
        foreach ($this->map as $db_key => $view_key) {
            $show->field($db_key, __($view_key));
        }
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new K22Transaction());
        foreach ($this->map as $db_key => $view_key) {
            switch ($db_key) {
                case "id":
                    break;
                case "XF_TXDATE":
                    $form->date($db_key, __($view_key))->format('YYYY-MM-DD')->rules('nullable');
                    break;
                case "XF_CREATETIME":
                case "XF_TXTIME":
                case "XF_SALESTIME":
                    $form->datetime($db_key, __($view_key))->format('YYYY-MM-DD HH:mm:ss')->rules('nullable');
                    break;
                default:
                    $form->text($db_key, __($view_key))->rules('nullable');
                    break;
            }
        }
        return $form;
    }
}
