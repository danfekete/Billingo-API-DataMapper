# Billingo API Data Mapper

***WARNING: The functions of this package are highly experimental, and not yet recommended for production use!***

This library provides CRUD access for Billingo API with data mapped models created for every API endpoint:

- Invoices (`Billingo\API\DataMapper\Models\Invoices`)
- Invoice blocks (`Billingo\API\DataMapper\Models\InvoiceBlocks`)
- Bank accounts (`Billingo\API\DataMapper\Models\BankAccounts`)
- Expenses (`Billingo\API\DataMapper\Models\Expenses`)
- Clients (`Billingo\API\DataMapper\Models\Clients`)
- Payment methods (`Billingo\API\DataMapper\Models\PaymentMethods`)
- Vat (`Billingo\API\DataMapper\Models\Vat`)



## Factory

While you can use the included models without using the Billingo Factory it is not recommended.

```php
use Billingo\API\Connector\HTTP\Request;
use Billingo\API\DataMapper\BillingoFactory;

$client = new Request([
    'public_key' => 'YOUR_PUBLIC_KEY',
    'private_key' => 'YOUR_PRIVATE_KEY',
]);
$factory = new BillingoFactory($client);
```



## Usage

### Loading using the class constant

When using PHP 5.6+, you can use the `::class` constant when specifying the model to make

```php
use Billingo\API\DataMapper\Models\Clients;
$clients = $factory->make(Clients::class)->loadAll();
```



### Loading using name

Load class using the name of the class.

```php
$vat = $factory->makeFromName('vat')->loadAll();
```



### Loading given ID

Instead of loading every model using `loadAll` you can use the `load` function to load a single resource.

```php
$client = $factory->make(Clients::class)->load('12344567');
```



### Creating a new resource

To create a new resource, you use the same factory method.

```php
use Billingo\API\DataMapper\Models\Clients;
$client = $factory->make(Clients::class);

// you can either use magic variables
$client->name = 'Test Client Co.';

// or simple fill the whole model with an array
$client->fill([
  'name' => 'Test Client Co.'
  // ...
]);

$client->save();
```



### Update a resource

You can easily update an already saved resource by first loading it then modifying the neccessary fields and calling the `save` method. The underlying library knows that it needs to update the resource instead of creating a new.

```php
use Billingo\API\DataMapper\Models\Clients;
$client = $factory->make(Clients::class)->load('12344567');
$client->name = 'Test Client Updated Co.';
$client->save();
```



### Delete a resource

To delete a resource first simple load the resource and then call the `delete` function.

```php
use Billingo\API\DataMapper\Models\Clients;
$client = $factory->make(Clients::class)->load('12344567')->delete();
```



## Special invoice functions

There are a couple of auxilary functions in the Invoice model that can make the usage even easier.

```php
use Billingo\API\DataMapper\Models\Invoices;
$invoice = $factory->make(Invoices::class)->load('12344567');
$invoice->pay(3500, 1);
```



### Pay

Set invoice paid, or partially paid

```php
public function pay($amount, $paymentMethodId, $date=null)
```



### Cancel

Cancel the invoice. The function returns the new cancel invoice.

```php
public function cancel()
```



### Send

Send the invoice to the client

```php
public function send()
```

