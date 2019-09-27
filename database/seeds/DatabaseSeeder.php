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

        $restaurant = new Restaurant();
        $restaurant->title = 'Bedjennes wraps';
        $restaurant->kvk = 123456789;
        $restaurant->address = 'wrapweg 10';
        $restaurant->zipcode = '1120AM';
        $restaurant->city = 'Amsterdam';
        $restaurant->phone = '0612345678';
        $restaurant->email = 'info@wraps.nl';
        $restaurant->user_id = $user->id;
        $restaurant->save();

    }
}
