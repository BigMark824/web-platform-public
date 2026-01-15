<?php

namespace App\Helpers;
use Illuminate\Support\Facades\{Cookie, Auth, Cache};

use GooberBlox\Membership\Enums\GenderType;
class UserHelper {
    private static $gendersCount = 3;

    public static function getDisplayGuestId(): int
    {
        $guestId = self::getOrCreateCurrentGuestId(createCookie: false);

        if (!$guestId) {
            $guestId = self::getOrCreateCurrentGuestId(createCookie: true);
        }

        $guestId = abs((int) $guestId);

        while ($guestId >= 10000) {
            $guestId = (int) floor($guestId / 10);
        }

        return $guestId;
    }

    public static function generateRandomGuestId(): int
    {
        $guestId = -mt_rand(self::$gendersCount, 2147483647 - self::$gendersCount);
        return $guestId;
    }
    public static function getGenderedGuestId(int $genderTypeId): int
    {
        $randomGuestId = -self::generateRandomGuestId();
        return -($randomGuestId + $genderTypeId - ($randomGuestId % self::$gendersCount + 1)) ;
    }
    private static function getGuestGenderType(int $guestId): GenderType
    {
        if ($guestId >= 0) {
            return GenderType::Unknown;
        }

        $value = ((-$guestId % self::$gendersCount) + 1);

        return GenderType::from($value);
    }
    public static function getGuestCharacterId(int $guestId) : int
    {
        $genderType = self::getGuestGenderType($guestId);
        $characterId = config('guests.Default.DefaultGuestCharacterID');
        
        if($genderType == GenderType::Male) 
        {
            $characterId = config('guests.Default.BoyGuestCharacterID');
        }
        else if ($genderType == GenderType::Female)
        {
            $characterId = config('guests.Default.GirlGuestCharacterID');
        }

        return $characterId;
    }

    public static function getGuestUser()
    {
        $guestId = self::getOrCreateCurrentGuestId(false);
        if(!$guestId)
            $guestId = self::getOrCreateCurrentGuestId(true);

        return (object) [
            'id' => $guestId,
            'name' => 'Guest ' . self::getDisplayGuestId(),
        ];
    }
    // TODO: make this more accurate
    public static function getOrCreateCurrentGuestId(bool $createCookie)
    {
        if ($createCookie) {
            $guestId = UserHelper::generateRandomGuestId();

            $guestData = 'UserID=' . $guestId;

            Cookie::queue(
                'GuestData',
                $guestData,
                10000 * 1440
            );

            return $guestId;
        }

        $guestData = Cookie::get('GuestData');

        if ($guestData) {
            parse_str($guestData, $cookieData);
            $guestId = $cookieData['UserID'] ?? UserHelper::generateRandomGuestId();

            $cacheKey = 'guest: ' . $guestId;
            Cache::put($cacheKey, ['id' => $guestId], 3600);

            return $guestId; 
        }

        return null;
    }
}