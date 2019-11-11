<?php

    namespace blackpanda\bip39;
    use \Illuminate\Support\ServiceProvider;

    class BIPServiceProvider extends ServiceProvider
    {
        public function register()
        {
            $this->app->bind('BIP39',function (){
                return new BIP39();
            });
        }
    }
