# TODO

## Create controllers
* [X] Admin
* [X] User
* [X] Security
* [X] Cart
* [ ] Site
* [ ] Product
* [ ] Catalog


//главная страница:
'/' => 'site/index',
//новости:
'news' => 'site/news',
//доставка:
'delivery' => 'site/delivery',
//гарантия:
'refund' => 'site/refund',
// О магазине
'contacts' => 'site/contact',
//товар:
'product/([0-9]+)' => 'product/view/$1',
//каталог
'catalog' => 'catalog/index',
