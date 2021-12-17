<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Facebook;
use Illuminate\Contracts\Support\DeferrableProvider;

class FacebookServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Facebook::class, function ($app) {
            return new Facebook('Secret Key ABC123');
            // return new Facebook(auth()->user()->facebook_api_key);
        });
        /**
         * Above is an example of what an actual registration of this container could look like,
         * getting the api key for facebook that the user would set in the "settings" of the app.
         * This way this service could use this key to perform actions on facebook using the API
         * provided by facebook, as if it were the user themselves. For example, posting or sharing
         * their posts from my application on their facebook accounts to all their facebook friends.
         */
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Facebook::class];
    }
}
