<?php

use App\Enums\Program;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateK22TransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (env('PROGRAM') != Program::K22) {
            return;
        }

        Schema::getConnection()->statement('
        CREATE TABLE "k22_transaction" (
            "id" SERIAL PRIMARY KEY,
            "PAYMENT_ID" VARCHAR(256),
            "TRANSACTION_ID" VARCHAR(256),
            "KDP_SERIAL_NUMER" VARCHAR(60),
            "CRM_ID" VARCHAR(60),
            "XF_STORECODE" VARCHAR(20),
            "XF_TXDATE" TIMESTAMP,
            "XF_DOCNO" VARCHAR(60),
            "XF_VIPCODE" VARCHAR(20),
            "XF_AMT" NUMERIC(38,4),
            "XF_BONUS" NUMERIC(38,4),
            "XF_REMARK" VARCHAR(80),
            "XF_TILLID" VARCHAR(3),
            "XF_VIPID" VARCHAR(100),
            "XF_SALESMEMOPHOTO" VARCHAR(1024),
            "XF_PAYMETHODCODE" VARCHAR(4),
            "XF_CREATETIME" TIMESTAMP,
            "XF_CURRENCYCODE" VARCHAR(4),
            "XF_TXTIME" VARCHAR(6),
            "XF_RULEID" VARCHAR(256),
            "XF_GVAMOUNT" NUMERIC(38,4),
            "XF_ITEMCODE" VARCHAR(2048),
            "XF_TRADESOURCES" VARCHAR(20),
            "XF_PROMOTIONAMOUNT" NUMERIC(38,4),
            "XF_TENDERCODE" VARCHAR(512),
            "XF_BANKCARDPHOTO" VARCHAR(1024),
            "XF_SALESTIME" VARCHAR(30),
            "XF_REMARK2" VARCHAR(256),
            "XF_PROMOTYPE" VARCHAR(30),
            "XF_STANDARDBONUS" NUMERIC(38,4),
            "XF_PROMOBONUS" NUMERIC(38,4),
            "XF_ISSUINGBANK" VARCHAR(100),
            "XF_VIPGRADE" VARCHAR(2),
            "XF_EXPERIENCECARD" VARCHAR(1),
            "ORADOCNO" VARCHAR(60),
            "BONUSOURCE" VARCHAR(10),
            "ORAGINAMOUNT" NUMERIC(38,4),
            "XF_BATCH_ID" VARCHAR(500),
            "XF_BONUS_EXPIRE_TYPE" VARCHAR(30),
            "XF_BONUS_EXPIRE_TIME" DATE,
            "XF_CONFIRMBY" VARCHAR(256),
            "XF_CONFIRMDATE" DATE,
            "XF_VOIDSTATUS" VARCHAR(30),
            "XF_STORENAME" VARCHAR(2048),
            "VIPACCOUNTNO" VARCHAR(60),
            "COMPLETED_DATE" TIMESTAMP,
            "XF_ACTION" VARCHAR(1),
            "XF_MALLID" VARCHAR(30),
            "XF_STORENAME_SC" VARCHAR(2048),
            "XF_STORENAME_TC" VARCHAR(2048),
            "XF_APPROVAL_ID" VARCHAR(32),
            "XF_ISPROVED" VARCHAR(2),
            "OCRAPPROVEUPLOADBATCHID" VARCHAR(256),
            "NEW_DATA_IND" VARCHAR(1) DEFAULT \'1\',
            "XF_VOIDREASON" VARCHAR(2048),
            "PointRegAmt" NUMERIC(18,4),
            "ServiceChargeAmt" NUMERIC(18,4),
            "KDorllaerAmt" NUMERIC(18,4),
            "CouponAmt" NUMERIC(18,4),
            "CouponIds" TEXT,
            "UploadChannel" TEXT,
            "AuthCode" VARCHAR(191),
            "CardNumber" TEXT,
            "LASTMODIFYDATE" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            "LASTMODIFYUSER" VARCHAR(200),
            "campaign" TEXT
        );
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('k22_transaction');
    }
}