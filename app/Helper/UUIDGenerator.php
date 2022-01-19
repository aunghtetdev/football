<?php

namespace App\Helper;

use App\Models\Wallet;
use App\Models\WalletHistory;

class UUIDGenerator
{
    public static function UserCode()
    {
        $number = rand('10000000', '99999999');
        $exist = Wallet::where('user_code', $number)->exists();

        if ($exist) {
            Self::UserCode();
        }
        return $number;
    }

    public static function Trx_id()
    {
        $number = rand('10000000', '99999999');
        $exist = WalletHistory::where('trx_id', $number)->exists();

        if ($exist) {
            Self::Trx_id();
        }
        return $number;
    }
}
