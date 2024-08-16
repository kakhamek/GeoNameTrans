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

*/


class NameTrans {


    /**
     * Supported languages for translation.
     */
    const LANGUAGES = ['EN','RU'];


    /**
     * Mapping of Georgian characters to corresponding English and Russian characters.
     */
    const SOURCE = array(
        'KA' => [' ','ქ','ჭ','წ','ე','რ','ღ','ტ','თ','ყ','უ','ი','ო','პ','ა','ს','შ','დ','ფ','გ','ჰ','ჯ','ჟ','კ','ლ','ზ','ძ','ხ','ც','ჩ','ვ','ბ','ნ','მ'],
        'EN' => [' ','k','ts','ts','e','r','gh','t','t','k','u','i','o','p','a','s','sh','d','f','g','h','j','zh','k','l','z','dz','kh','c','ch','v','b','n','m'],
        'RU' => [' ','к','ч','ц','е','р','г','т','т','к','у','и','о','п','а','с','ш','д','ф','г','х','дж','ж','к','л','з','дз','х','ц','ч','в','б','н','м'],
    );

    /**
     * Language for translation.
     * 
     * @var string
     */
    private $lang;

    /**
     * The full name to be translated.
     * 
     * @var string
     */
    private $fullname;

    /**
     * Stores the translated output.
     * 
     * @var string
     */
    private $output;

    /**
     * Indicates whether the output should be in all caps.
     * 
     * @var bool
     */
    private $caps;


    /**
     * Class constructor.
     * 
     * Initializes the language, full name, and capitalization option.
     * 
     * @param string $lang      The target language for translation (EN, RU).
     * @param string $fullname  The full name to be translated.
     * @param bool   $caps      Whether to convert the translated name to uppercase.
     */
    public function __construct(string $lang, string $fullname, bool $caps = false) 
    {

        $this->lang = $lang;
        $this->caps = $caps;
        $this->fullname = $fullname;
       
        // Validate the selected language.
        $this->validateLanguage();

    }

    /**
     * Translates the full name from Georgian to the specified language.
     * 
     * @return string The translated name.
     */
    public function translate()
    {

        for($i = 0; $i < mb_strlen($this->fullname); $i++)
        {
            // Get the current character from the name.
            $symbol = mb_substr($this->fullname,$i,1);

            // Find the index of the current char
            $index = array_search($symbol,self::SOURCE['KA']);

            // Append the translated character to the output.
            $this->output .= self::SOURCE[$this->lang][$index];
            
        }
        
        // Return the output in uppercase if the caps option is set.
        if($this->caps)
        {
            return mb_strtoupper($this->output);
        }
        
        // Capitalize the first letter of each word and return the result.
        $words = explode(" ", $this->output);
        $capitalized = array_map(array($this, 'mb_ucfirst'), $words);
        return implode(" ", $capitalized);
        
        
    }

    /**
     * Validates the selected language against the supported languages.
     * 
     * @return void
     * @throws Exception if the language is not supported.
     */
    private function validateLanguage()
    {

        if(!in_array($this->lang, self::LANGUAGES)) 
        {
            throw new Exception('Error: Language ' . $this->lang . ' not found!');
        }

    }

    /**
     * Returns the list of supported languages.
     * 
     * @return array The supported languages.
     */
    public function languages()
    {

        return self::LANGUAGES;

    }


    /**
     * UTF-8 safe ucfirst() alternative for capitalizing the first letter of a string.
     * source: https://stackoverflow.com/questions/2517947/ucfirst-function-for-multibyte-character-encodings
     * 
     * @param string $string   The input string.
     * @param string $encoding The character encoding (default is UTF-8).
     * @return string The string with the first letter capitalized.
     */
    private static function mb_ucfirst($string, $encoding = 'UTF-8'){

        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);
        
        return mb_strtoupper($firstChar, $encoding) . $then;

    }

}