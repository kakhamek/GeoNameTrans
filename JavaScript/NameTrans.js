/*

███╗   ██╗ █████╗ ███╗   ███╗███████╗████████╗██████╗  █████╗ ███╗   ██╗███████╗
████╗  ██║██╔══██╗████╗ ████║██╔════╝╚══██╔══╝██╔══██╗██╔══██╗████╗  ██║██╔════╝
██╔██╗ ██║███████║██╔████╔██║█████╗     ██║   ██████╔╝███████║██╔██╗ ██║███████╗
██║╚██╗██║██╔══██║██║╚██╔╝██║██╔══╝     ██║   ██╔══██╗██╔══██║██║╚██╗██║╚════██║
██║ ╚████║██║  ██║██║ ╚═╝ ██║███████╗   ██║   ██║  ██║██║  ██║██║ ╚████║███████║
╚═╝  ╚═══╝╚═╝  ╚═╝╚═╝     ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝╚══════╝
  
File: NameTrans.js 
Description: Translate Georgian firstname and lastname into English, Russian ...
Author: K. Mekvabishvili

-------------------------------------------------
Available languages:
1. EN 
2. RU

*/

class NameTrans {

    constructor(lang, fullname, caps = false) 
    {

        this.lang = lang;
        this.fullname = fullname;
        this.caps = caps;

        this.LANGUAGES = ["EN", "RU"];
        this.KA = [' ', 'ქ', 'ჭ', 'წ', 'ე', 'რ', 'ღ', 'ტ', 'თ', 'ყ', 'უ', 'ი', 'ო', 'პ', 'ა', 'ს', 'შ', 'დ', 'ფ', 'გ', 'ჰ', 'ჯ', 'ჟ', 'კ', 'ლ', 'ზ', 'ძ', 'ხ', 'ც', 'ჩ', 'ვ', 'ბ', 'ნ', 'მ'];
        this.EN = [' ', 'k', 'ts', 'ts', 'e', 'r', 'gh', 't', 't', 'k', 'u', 'i', 'o', 'p', 'a', 's', 'sh', 'd', 'f', 'g', 'h', 'j', 'zh', 'k', 'l', 'z', 'dz', 'kh', 'c', 'ch', 'v', 'b', 'n', 'm'];
        this.RU = [' ', 'к', 'ч', 'ц', 'е', 'р', 'г', 'т', 'т', 'к', 'у', 'и', 'о', 'п', 'а', 'с', 'ш', 'д', 'ф', 'г', 'х', 'дж', 'ж', 'к', 'л', 'з', 'дз', 'х', 'ц', 'ч', 'в', 'б', 'н', 'м'];

    }

    // check language
    checkLanguage() 
    {
        if(this.LANGUAGES.includes(this.lang)) 
        {
            
            return true;
        }

        return false;
    }

    // translate
    translate() {

        if(this.checkLanguage())
        {
            let output = "";

            for(let symbol of this.fullname) 
            {
                let index = this.KA.indexOf(symbol);
                output += this[this.lang][index];
            }
    
            // Make all words caps
            if (this.caps) 
            {
                return output.toUpperCase();
            }
    
            // Capitalize all words
            return output.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
        }

        // Return error
        return `Error: Language "${this.lang}" not found, available languages are: ${this.LANGUAGES}`;
    }

}

