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
    private $detail_data = [
        "id" => "ID",
        "PAYMENT_ID" => "Payment Id",
        "TRANSACTION_ID" => "Transaction Id",
        "KDP_SERIAL_NUMER" => "KDP Serial Number",
        "CRM_ID" => "CRM Id",
        "XF_STORECODE" => "Store Code",
        "XF_TXDATE" => "Transaction Date",
        "XF_DOCNO" => "Document Number",
        "XF_VIPCODE" => "VIP Code",
        "XF_AMT" => "Amount",
        "XF_BONUS" => "Bonus",
        "XF_REMARK" => "Remark",
        "XF_SALESMEMOPHOTO" => "Sales Memo Photo",
        "XF_PAYMETHODCODE" => "Pay Method Code",
        "XF_CREATETIME" => "Transaction Create Time",
        "XF_CURRENCYCODE" => "Currency Code",
        "XF_TXTIME" => "Transaction Time",
        "XF_GVAMOUNT" => "Gift Voucher Amount",
        "XF_TRADESOURCES" => "Trade Sources",
        "XF_TENDERCODE" => "Tender Code",
        "XF_BANKCARDPHOTO" => "Bank Card Photo",
        "XF_SALESTIME" => "Sales Time",
        "XF_REMARK2" => "Remark 2",
        "XF_ISSUINGBANK" => "Issuing Bank",
        "XF_VIPGRADE" => "VIP Grade",
        "ORADOCNO" => "ORA Document Number",
        "ORAGINAMOUNT" => "ORAGIN Amount",
        "XF_BATCH_ID" => "Batch Id",
        "XF_BONUS_EXPIRE_TYPE" => "Bonus Expire Type",
        "XF_BONUS_EXPIRE_TIME" => "Bonus Expire Time",
        "Required 0 or 1 `XF_VOIDSTATUS" => "Void Status",
        "VIPACCOUNTNO" => "VIP Account Number",
        "COMPLETED_DATE" => "Completed Date",
        "XF_MALLID" => "Mall Id",
        "XF_STORENAME" => "Store Name",
        "XF_STORENAME_SC" => "Store Name SC",
        "XF_STORENAME_TC" => "Store Name TC",
        "OCRAPPROVEUPLOADBATCHID" => "OCR Approve Upload Batch Id",
        "XF_VOIDREASON" => "Void Reason",
        "PointRegAmt" => "Point Reg Amount",
        "ServiceChargeAmt" => "Service Charge Amount",
        "KDorllaerAmt" => "K Dollar Amount",
        "CouponAmt" => "Coupon Amount",
        "Campaign" => "Campaign",
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
        foreach ($this->detail_data as $db_key => $view_key) {
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
        foreach ($this->detail_data as $db_key => $view_key) {
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
