<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderWallet extends Model
{
    //
    protected $table = "provider_wallet";

    protected $fillable = ['user_id','amount_credited','amount_debited','balance','type','wallet_status','payment_history_id','amount_due'];
}
