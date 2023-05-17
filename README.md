# TODO

## Create controllers
* [X] Admin
* [X] User
* [X] Security
* [ ] Cart
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
//корзина:
'cart/add/([0-9]+)' => 'cart/add/$1',// actionAdd в CartController
'cart/delete/([0-9]+)' => 'cart/delete/$1',// actionDelete в CartController
'cart' => 'cart/index',// actionIndex в CartController
'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', // actionAddAjax в CartController
'cart/checkout' => 'cart/checkout',
'cart/removeAjax/([0-9]+)' => 'cart/decrementProduct/$1',