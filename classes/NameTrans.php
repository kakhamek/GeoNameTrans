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
    const KA = [' ','ქ','ჭ','წ','ე','რ','ღ','ტ','თ','ყ','უ','ი','ო','პ','ა','ს','შ','დ','ფ','გ','ჰ','ჯ','ჟ','კ','ლ','ზ','ძ','ხ','ც','ჩ','ვ','ბ','ნ','მ'];
    const EN = [' ','k','ts','ts','e','r','gh','t','t','k','u','i','o','p','a','s','sh','d','f','g','h','j','zh','k','l','z','dz','kh','c','ch','v','b','n','m'];
    const RU = [' ','к','ч','ц','е','р','г','т','т','к','у','и','о','п','а','с','ш','д','ф','г','х','дж','ж','к','л','з','дз','х','ц','ч','в','б','н','м'];

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
        $this->check_language();

    }

    //
    // Convert 
    //
    public function convert()
    {
        for($i = 0; $i < mb_strlen($this->fullname); $i++)
        {

            $symbol = mb_substr($this->fullname,$i,1);
            $index = array_search($symbol,self::KA);

            switch($this->lang)
            {
                case 'EN':
                    $this->output .= self::EN[$index];
                    break;
                case 'RU':    
                    $this->output .= self::RU[$index];
                    break;
            }
            

        }
        
        // Break firstname lastname into array and make caps or Firstupper
        
        if($this->caps)
        {
            $arr = array_map('mb_strtoupper', explode(" ", $this->output));
        }
        else
        {
            $arr = array_map(array($this,'mb_ucfirst'), explode(" ", $this->output));
        }
        
        return implode(" ",$arr);
        
    }

    //
    // Check language
    //

    private function check_language()
    {
        if(!in_array($this->lang,self::LANGUAGES)) die('Error: Language '.$this->lang.' not found!');
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