<?php

use App\User;
use App\Restaurant;
use App\Order;
use App\Consumable;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Dennis';
        $user->address = 'Vredebest 15';
        $user->zipcode = '1191PM';
        $user->city = 'Ouderkerk aan de Amstel';
        $user->phone = '0638742929';
        $user->email = '1998dennis@live.nl';
        $user->password = bcrypt('admin123');
        $user->save();

        $user = new User();
        $user->name = 'Zakelijke man';
        $user->address = 'Zakelijkeweg 3';
        $user->zipcode = '1133TR';
        $user->city = 'Amsterdam';
        $user->phone = '0677894598';
        $user->email = 'zakelijke@man.nl';
        $user->password = bcrypt('admin123');
        $user->save();

        $restaurant = new Restaurant();
        $restaurant->title = 'Bedjennes wraps';
        $restaurant->kvk = '123456789';
        $restaurant->address = 'wrapweg 10';
        $restaurant->zipcode = '1120AM';
        $restaurant->city = 'Amsterdam';
        $restaurant->phone = '0612345678';
        $restaurant->email = 'info@wraps.nl';
        $restaurant->photo = '';
        $restaurant->user_id = 1;
        $restaurant->save();

        $restaurant = new Restaurant();
        $restaurant->title = 'Smoke house';
        $restaurant->kvk = '459998453';
        $restaurant->address = 'Smokeweg 10';
        $restaurant->zipcode = '1810TT';
        $restaurant->city = 'Amsterdam';
        $restaurant->phone = '0658975355';
        $restaurant->email = 'info@smokehouse.nl';
        $restaurant->photo = 'restaurant1.jpg';
        $restaurant->user_id = 2;
        $restaurant->save();

    }
}
