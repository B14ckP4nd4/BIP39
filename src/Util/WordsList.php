<?php


    namespace blackpanda\bip39\Util;


    use blackpanda\bip39\Buffer\BitBuffer;
    use Illuminate\Support\Collection;

    class WordsList
    {

        protected $locales = [
            'en' => 'English',
            'fr' => 'French',
            'it' => 'Italian',
            'zh' => 'Chinese (simplified)',
            'ja' => 'Japanese',
            'ko' => 'Korean',
            'es' => 'Spanish',
        ];

        protected $locale = 'en';

        protected $words;

        public function __construct(string $locale = 'en')
        {
            // thrown an exception if there's no word list for the requested locale.
            if (!array_key_exists($locale, $this->locales)) {
                throw new \RuntimeException("Word list for the locale {$locale} is not available.");
            }
            // setups the current locale.
            $this->locale = $locale;
            // init the word list database.
            $this->words = $this->initWords();
        }

        public function wordListPath() : string
        {
            return __DIR__ . "/../WordsLists/$this->locale.list";
        }

        protected function getWordList() : string
        {
            return file_get_contents($this->wordListPath());
        }

        protected function wordListToArray() : array
        {
            return explode("\n", trim($this->getWordList()));
        }

        protected function initWords() : Collection
        {
            // get the array and make into a collection.
            return collect($this->wordListToArray());
        }

        public function getWord(BitBuffer $index) : ?string
        {
            return $this->words->get($index->toDecimal(), null);
        }

        public function getIndex(string $word) : ?BitBuffer
        {
            // flip the array and search the index for the word
            $index = $this->words->flip()->get($word);
            // if found, return as BitBuffer instance, null otherwise.
            return $index ? BitBuffer::fromDecimal($index) : null;
        }



    }
