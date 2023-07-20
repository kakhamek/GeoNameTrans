███╗   ██╗ █████╗ ███╗   ███╗███████╗████████╗██████╗  █████╗ ███╗   ██╗███████╗
████╗  ██║██╔══██╗████╗ ████║██╔════╝╚══██╔══╝██╔══██╗██╔══██╗████╗  ██║██╔════╝
██╔██╗ ██║███████║██╔████╔██║█████╗     ██║   ██████╔╝███████║██╔██╗ ██║███████╗
██║╚██╗██║██╔══██║██║╚██╔╝██║██╔══╝     ██║   ██╔══██╗██╔══██║██║╚██╗██║╚════██║
██║ ╚████║██║  ██║██║ ╚═╝ ██║███████╗   ██║   ██║  ██║██║  ██║██║ ╚████║███████║
╚═╝  ╚═══╝╚═╝  ╚═╝╚═╝     ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝╚══════╝

# GeoNameTrans
Translate Georgian firstname and lastname into English, Russian

Usage
```
require_once 'classes/NameTrans.php';

$output1 = new NameTrans('EN','კახაბერ მექვაბიშვილი');

// Print Converted name
echo $output1->convert();

$output2 = new NameTrans('RU','კახაბერ მექვაბიშვილი',$caps = true);

// Print Converted name
echo $output2->convert();


// Print languages
print_r($output1->languages());
```
