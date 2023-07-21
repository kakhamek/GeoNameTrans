"""

███╗   ██╗ █████╗ ███╗   ███╗███████╗████████╗██████╗  █████╗ ███╗   ██╗███████╗
████╗  ██║██╔══██╗████╗ ████║██╔════╝╚══██╔══╝██╔══██╗██╔══██╗████╗  ██║██╔════╝
██╔██╗ ██║███████║██╔████╔██║█████╗     ██║   ██████╔╝███████║██╔██╗ ██║███████╗
██║╚██╗██║██╔══██║██║╚██╔╝██║██╔══╝     ██║   ██╔══██╗██╔══██║██║╚██╗██║╚════██║
██║ ╚████║██║  ██║██║ ╚═╝ ██║███████╗   ██║   ██║  ██║██║  ██║██║ ╚████║███████║
╚═╝  ╚═══╝╚═╝  ╚═╝╚═╝     ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝╚══════╝
  
File: main.py 
Description: Translate Georgian firstname and lastname into English, Russian ...
Author: K. Mekvabishvili

-------------------------------------------------
Available languages:
1. EN 
2. RU

"""
class NameTrans:
  
    #avaiable languages
    LANGUAGES = ["EN","RU"]

    KA = [' ','ქ','ჭ','წ','ე','რ','ღ','ტ','თ','ყ','უ','ი','ო','პ','ა','ს','შ','დ','ფ','გ','ჰ','ჯ','ჟ','კ','ლ','ზ','ძ','ხ','ც','ჩ','ვ','ბ','ნ','მ'];
    EN = [' ','k','ts','ts','e','r','gh','t','t','k','u','i','o','p','a','s','sh','d','f','g','h','j','zh','k','l','z','dz','kh','c','ch','v','b','n','m'];
    RU = [' ','к','ч','ц','е','р','г','т','т','к','у','и','о','п','а','с','ш','д','ф','г','х','дж','ж','к','л','з','дз','х','ц','ч','в','б','н','м'];
                 
    def __init__(self, lang, fullname, caps = False):
        self.lang = lang
        self.fullname = fullname
        self.caps = caps

        self.check_language()
            

    # check language
    def check_language(self):
        if self.lang not in self.LANGUAGES:
            raise ValueError("Error: Language not found, available languages are: {}".format(self.LANGUAGES))

    
    # translate
    def translate(self):

        output = ""

        for symbol in self.fullname:
            index = self.KA.index(symbol)
            output += f"{getattr(self, self.lang)[index]}"
       
        # make all words caps
        if self.caps:
            return output.upper()
              
        # Capitalize all words
        return ' '.join([x.capitalize() for x in output.split()])


# **************************************************************************
# Usage
output1 = NameTrans("EN","კახაბერ მექვაბიშვილი")
print(output1.translate())

output2 = NameTrans("RU","კახაბერ მექვაბიშვილი",caps = True)
print(output2.translate())