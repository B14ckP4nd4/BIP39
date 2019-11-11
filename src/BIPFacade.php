<?php


    namespace blackpanda\bip39;


    use Illuminate\Support\Facades\Facade;

    class BIPFacade extends Facade
    {
        protected static function getFacadeAccessor()
        {
            return BIP39::class;
        }

    }
