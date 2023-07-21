<?php
/*

███╗   ██╗ █████╗ ███╗   ███╗███████╗████████╗██████╗  █████╗ ███╗   ██╗███████╗
████╗  ██║██╔══██╗████╗ ████║██╔════╝╚══██╔══╝██╔══██╗██╔══██╗████╗  ██║██╔════╝
██╔██╗ ██║███████║██╔████╔██║█████╗     ██║   ██████╔╝███████║██╔██╗ ██║███████╗
██║╚██╗██║██╔══██║██║╚██╔╝██║██╔══╝     ██║   ██╔══██╗██╔══██║██║╚██╗██║╚════██║
██║ ╚████║██║  ██║██║ ╚═╝ ██║███████╗   ██║   ██║  ██║██║  ██║██║ ╚████║███████║
╚═╝  ╚═══╝╚═╝  ╚═╝╚═╝     ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝╚══════╝
  
File: NameTrans.php 
Description: Translate Georgian firstname and lastname into English, Russian ...
Author: K. Mekvabishvili
Date: 2019

-------------------------------------------------
Available languages:
1. EN 
2. RU

*/


class NameTrans {


    // Languages
    const LANGUAGES = ['EN','RU'];


    // Symbols
    const SOURCE = array(
        'KA' => [' ','ქ','ჭ','წ','ე','რ','ღ','ტ','თ','ყ','უ','ი','ო','პ','ა','ს','შ','დ','ფ','გ','ჰ','ჯ','ჟ','კ','ლ','ზ','ძ','ხ','ც','ჩ','ვ','ბ','ნ','მ'],
        'EN' => [' ','k','ts','ts','e','r','gh','t','t','k','u','i','o','p','a','s','sh','d','f','g','h','j','zh','k','l','z','dz','kh','c','ch','v','b','n','m'],
        'RU' => [' ','к','ч','ц','е','р','г','т','т','к','у','и','о','п','а','с','ш','д','ф','г','х','дж','ж','к','л','з','дз','х','ц','ч','в','б','н','м'],
    );

    private $lang;
    private $fullname;
    private $caps;
    private $output;


    public function __construct(string $lang, string $fullname, bool $caps = false) 
    {

        $this->lang = $lang;
        $this->caps = $caps;
        $this->fullname = $fullname;
       
        // check language and die if not found
        $this->checkLanguage();

    }

    //
    // Translate 
    //

    public function translate()
    {

        for($i = 0; $i < mb_strlen($this->fullname); $i++)
        {
            // Get char
            $symbol = mb_substr($this->fullname,$i,1);

            // Find the index of the current char
            $index = array_search($symbol,self::SOURCE['KA']);

            // Append char 
            $this->output .= self::SOURCE[$this->lang][$index];
            
        }
        
        // Make all caps and return string
        if($this->caps)
        {
            return mb_strtoupper($this->output);
        }
        
        // Split words into an array
        $words = explode(" ", $this->output);

        // Capitalize words
        $capitalized = array_map(array($this, 'mb_ucfirst'), $words);

        // merge capitalized words and return string
        return implode(" ", $capitalized);
        
        
    }

    //
    // Check language
    //

    private function checkLanguage()
    {

        if(!in_array($this->lang, self::LANGUAGES)) 
        {
            throw new Exception('Error: Language ' . $this->lang . ' not found!');
        }

    }

    //
    // Get List of all available languages (Array)
    //

    public function languages()
    {

        return self::LANGUAGES;

    }


    //
    // uc_first() analogue function for utf-8
    // source: https://stackoverflow.com/questions/2517947/ucfirst-function-for-multibyte-character-encodings
    //

    private static function mb_ucfirst($string, $encoding = 'UTF-8'){

        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);
        
        return mb_strtoupper($firstChar, $encoding) . $then;

    }

}