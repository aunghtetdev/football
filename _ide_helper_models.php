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
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUser query()
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
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
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

