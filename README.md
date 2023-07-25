# GeoNameTrans
PHP/Python/JavaScript Classes for Translate Georgian firstname and lastname into English, Russian

Usage PHP
```php
    require_once 'classes/NameTrans.php';

    $output1 = new NameTrans('EN','კახაბერ მექვაბიშვილი');

    // Print translated name
    echo $output1->translate();

    $output2 = new NameTrans('RU','კახაბერ მექვაბიშვილი',$caps = true);

    // Print translated name
    echo $output2->translate();


    // Print languages
    print_r($output1->languages());
```


Usage Python
```python
    output1 = NameTrans("EN","კახაბერ მექვაბიშვილი")
    print(output1.translate())

    output2 = NameTrans("RU","კახაბერ მექვაბიშვილი",caps = True)
    print(output2.translate())
```

Usage JavaScript
```javascript
    const output1 = new NameTrans("EN", "კახაბერ მექვაბიშვილი");
    console.log(output1.translate());

    const output2 = new NameTrans("RU", "კახაბერ მექვაბიშვილი", true);
    console.log(output2.translate());

```
