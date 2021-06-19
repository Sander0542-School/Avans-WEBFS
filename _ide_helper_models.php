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
 * App\Models\Allergy
 *
 * @property int $id
 * @property string $name
 * @property string $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Allergy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Allergy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Allergy query()
 * @method static \Illuminate\Database\Eloquent\Builder|Allergy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allergy whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allergy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allergy whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Allergy whereUpdatedAt($value)
 */
	class Allergy extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Discount
 *
 * @property int $id
 * @property string $name
 * @property int $discount
 * @property \Illuminate\Support\Carbon $valid_until
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Dish[] $dishes
 * @property-read int|null $dishes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discount whereValidUntil($value)
 */
	class Discount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Dish
 *
 * @property int $id
 * @property int $category_id
 * @property string $number
 * @property string|null $addition
 * @property string $name
 * @property string $description
 * @property float $base_price
 * @property int $btw
 * @property int|null $spiciness_level
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Allergy[] $allergies
 * @property-read int|null $allergies_count
 * @property-read \App\Models\MenuCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Discount[] $discounts
 * @property-read int|null $discounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DishAllergy[] $dish_allergies
 * @property-read int|null $dish_allergies_count
 * @property-read mixed $base_price_inc
 * @property-read mixed $price
 * @property-read mixed $price_inc
 * @method static \Illuminate\Database\Eloquent\Builder|Dish newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dish newQuery()
 * @method static \Illuminate\Database\Query\Builder|Dish onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Dish query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereAddition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereBasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereBtw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereSpicinessLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dish whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Dish withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Dish withoutTrashed()
 */
	class Dish extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DishAllergy
 *
 * @property int $dish_id
 * @property int $allergy_id
 * @method static \Illuminate\Database\Eloquent\Builder|DishAllergy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DishAllergy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DishAllergy query()
 * @method static \Illuminate\Database\Eloquent\Builder|DishAllergy whereAllergyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DishAllergy whereDishId($value)
 */
	class DishAllergy extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DishDiscount
 *
 * @property int $id
 * @property int $dish_id
 * @property int $discount_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Discount|null $discount
 * @property-read \App\Models\Dish|null $dish
 * @method static \Illuminate\Database\Eloquent\Builder|DishDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DishDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DishDiscount query()
 * @method static \Illuminate\Database\Eloquent\Builder|DishDiscount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DishDiscount whereDiscountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DishDiscount whereDishId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DishDiscount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DishDiscount whereUpdatedAt($value)
 */
	class DishDiscount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DishRiceOption
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DishRiceOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DishRiceOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DishRiceOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|DishRiceOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DishRiceOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DishRiceOption whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DishRiceOption whereUpdatedAt($value)
 */
	class DishRiceOption extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MenuCategory
 *
 * @property int $id
 * @property string $name
 * @property bool $extra_option
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Dish[] $dishes
 * @property-read int|null $dishes_count
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereExtraOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereUpdatedAt($value)
 */
	class MenuCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property \App\Enums\OrderStatus $status
 * @property string|null $customer
 * @property int|null $user_id
 * @property int|null $table_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Dish[] $dishes
 * @property-read int|null $dishes_count
 * @property-read mixed $customer_token
 * @property-read mixed $price
 * @property-read mixed $price_inc
 * @property-read mixed $qr_code
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderDish[] $lines
 * @property-read int|null $lines_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTableNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderDish
 *
 * @property int $id
 * @property int $dish_id
 * @property int $order_id
 * @property int $amount
 * @property float $unit_price
 * @property int $btw
 * @property string|null $remark
 * @property int|null $rice_option_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Dish $dish
 * @property-read mixed $price
 * @property-read mixed $price_inc
 * @property-read mixed $unit_price_inc
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDish newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDish newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDish query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDish whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDish whereBtw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDish whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDish whereDishId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDish whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDish whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDish whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDish whereRiceOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDish whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDish whereUpdatedAt($value)
 */
	class OrderDish extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

