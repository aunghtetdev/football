<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AdminUser
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser whereUsername($value)
 */
	class AdminUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Bet
 *
 * @property int $id
 * @property int $bet_id
 * @property int|null $user_id
 * @property int|null $live_odd_id
 * @property int|null $match_id
 * @property int|null $over_team_id
 * @property int|null $under_team_id
 * @property int|null $bet_team_id
 * @property string|null $bet_total_goal over or under
 * @property int $bet_amount
 * @property int $win_amount
 * @property string|null $date
 * @property string|null $type body or moung
 * @property string|null $bet_result
 * @property int $is_finished
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $bet_team_name
 * @property-read mixed $over_team_goal
 * @property-read mixed $over_team_name
 * @property-read mixed $under_team_goal
 * @property-read mixed $under_team_name
 * @property-read \App\Models\LiveOdd|null $live_odd
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Moung[] $moungs
 * @property-read int|null $moungs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Bet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereBetAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereBetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereBetResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereBetTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereBetTotalGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereIsFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereLiveOddId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereOverTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereUnderTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bet whereWinAmount($value)
 */
	class Bet extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\League
 *
 * @property int $id
 * @property string $name_mm
 * @property string $name_en
 * @property string|null $order
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|League newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|League newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|League query()
 * @method static \Illuminate\Database\Eloquent\Builder|League whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|League whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|League whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|League whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|League whereNameMm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|League whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|League whereUpdatedAt($value)
 */
	class League extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LiveOdd
 *
 * @property int $id
 * @property int $odd_id
 * @property string|null $body_value
 * @property string|null $goal_total_value
 * @property string|null $datetime
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $live
 * @method static \Illuminate\Database\Eloquent\Builder|LiveOdd newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveOdd newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveOdd query()
 * @method static \Illuminate\Database\Eloquent\Builder|LiveOdd whereBodyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveOdd whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveOdd whereDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveOdd whereGoalTotalValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveOdd whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveOdd whereLive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveOdd whereOddId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LiveOdd whereUpdatedAt($value)
 */
	class LiveOdd extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Match
 *
 * @property int $id
 * @property int $home_team_id
 * @property int $away_team_id
 * @property int $home_team_goal
 * @property int $away_team_goal
 * @property string $date
 * @property int $finished
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $away_team_name
 * @property-read mixed $home_team_name
 * @property-read mixed $match_date
 * @property-read mixed $match_time
 * @method static \Illuminate\Database\Eloquent\Builder|Match newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Match newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Match query()
 * @method static \Illuminate\Database\Eloquent\Builder|Match whereAwayTeamGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Match whereAwayTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Match whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Match whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Match whereFinished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Match whereHomeTeamGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Match whereHomeTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Match whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Match whereUpdatedAt($value)
 */
	class Match extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Moung
 *
 * @property int $id
 * @property int $bet_id
 * @property int|null $user_id
 * @property int|null $live_odd_id
 * @property int|null $match_id
 * @property int|null $over_team_id
 * @property int|null $under_team_id
 * @property int|null $bet_team_id
 * @property string|null $bet_total_goal over or under
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $bet_team_name
 * @property-read mixed $over_team_goal
 * @property-read mixed $over_team_name
 * @property-read mixed $under_team_goal
 * @property-read mixed $under_team_name
 * @property-read \App\Models\LiveOdd|null $live_odd
 * @method static \Illuminate\Database\Eloquent\Builder|Moung newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Moung newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Moung query()
 * @method static \Illuminate\Database\Eloquent\Builder|Moung whereBetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Moung whereBetTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Moung whereBetTotalGoal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Moung whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Moung whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Moung whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Moung whereLiveOddId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Moung whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Moung whereOverTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Moung whereUnderTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Moung whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Moung whereUserId($value)
 */
	class Moung extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Odd
 *
 * @property int $id
 * @property int $match_id
 * @property int|null $over_team_id
 * @property int|null $underteam_id
 * @property string|null $body_value
 * @property string|null $goal_total_value
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $over_team_name
 * @property-read mixed $under_team_name
 * @method static \Illuminate\Database\Eloquent\Builder|Odd newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Odd newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Odd query()
 * @method static \Illuminate\Database\Eloquent\Builder|Odd whereBodyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Odd whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Odd whereGoalTotalValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Odd whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Odd whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Odd whereOverTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Odd whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Odd whereUnderteamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Odd whereUpdatedAt($value)
 */
	class Odd extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Team
 *
 * @property int $id
 * @property int $league_id
 * @property string $name_mm
 * @property string $name_en
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereLeagueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereNameMm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 */
	class Team extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bet[] $bets
 * @property-read int|null $bets_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\Wallet|null $wallet
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Wallet
 *
 * @property int $id
 * @property int $user_id
 * @property int $user_code
 * @property string $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUserCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUserId($value)
 */
	class Wallet extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WalletHistory
 *
 * @property int $id
 * @property int $user_id
 * @property string $trx_id
 * @property int $is_deposit 1=>income,0=>expense
 * @property string $amount
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|WalletHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletHistory whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletHistory whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletHistory whereIsDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletHistory whereTrxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletHistory whereUserId($value)
 */
	class WalletHistory extends \Eloquent {}
}

