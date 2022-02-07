<?php

namespace App\Helper;

use App\Models\Bet;
use App\Models\Wallet;
use App\Models\WalletHistory;

class UUIDGenerator
{
    public static function BetID()
    {
        $bet_id = 10000000;
        $exist = Bet::orderBy('bet_id', 'desc')->pluck('bet_id')->first();
        
        if ($exist) {
            return ++$exist;
        }
        return $bet_id;
    }
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
