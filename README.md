# Coinbase Pro

A library written in PHP to interact with Coinbase Pro via API.

https://packagist.org/packages/blakedhamilton/coinbase-pro<br>
https://docs.pro.coinbase.com/

<br>

# Table of contents
- [Installation](#installation-with-composer)
- [Usage](#usage)
    - [Getting started](#getting-started)
    - [Making requests](#making-requests)
        - [Accounts](#accounts)
        - [Orders](#orders)
        - [Fills](#fills)
        - [Limits](#limits)
        - [Deposits](#deposits)
        - [Withdrawals](#withdrawals)
        - [Stablecoin Conversions](#stablecoin-conversions)
        - [Payment Methods](#payment-methods)
        - [Coinbase Accounts](#coinbase-accounts)
        - [Fees](#fees)
        - [Reports](#reports)
        - [Profiles](#profiles)
        - [Oracle](#oracle)
        - [Market data](#market-data)
            - [Products](#products)
            - [Currencies](#currencies)
            - [Time](#time)

<br>

# Installation with Composer
The latest version can be installed via Composer, therefore you will need to [install Composer](https://getcomposer.org/download/) if you do not have it installed already.  
  
<br>

Next, require the library with:
```console
composer require blakedhamilton/coinbase-pro
```

<br>

# Usage
## Getting started
First you'll need to obtain an instance of the base Coinbase class by providing your API credentials.   
Your API credentials can be obtained at:
- Production: https://pro.coinbase.com/profile/api
- Sandbox: https://public.sandbox.pro.coinbase.com/profile/api


Once you have your API credentials, obtain an instance of the Coinbase class with:
```php
<?php

use Coinbase\Coinbase;

// Your API key, secret, and passphrase.
$key = 'API_KEY';
$secret = 'API_SECRET';
$passphrase = 'API_PASSPHRASE';

// Sandbox mode indicates whether you want to
// make API calls against Coinbase's production
// or sandbox servers for development.
$sandbox = true;

// Create an instance of the Coinbase base class.
$coinbase = Coinbase::create($key, $secret, $passphrase, $sandbox);
```

<br>

## Making requests

<br>

### Accounts
https://docs.pro.coinbase.com/#accounts
```php
// Get a list of trading accounts from the profile of the API key.
$accounts = $coinbase->accounts->list();

// Get a single trading account.
$account = $coinbase->accounts->get('account_id');

// Get trading account history.
// Available options can be found at: https://docs.pro.coinbase.com#get-account-history
$history = $coinbase->accounts->getHistory('account_id');
$history = $coinbase->accounts->getHistory('account_id', $options = []);

// Get trading account holds.
// Available options can be found at: https://docs.pro.coinbase.com#get-holds
$holds = $coinbase->accounts->getHolds('account_id');
$holds = $coinbase->accounts->getHolds('account_id', $options = []);
```

<br>

### Orders
https://docs.pro.coinbase.com/#orders
```php
// Get a list of orders.
// Available options can be found at: https://docs.pro.coinbase.com#list-orders
$orders = $coinbase->orders->list();
$orders = $coinbase->orders->list($options = []);

// Get a single order.
$order = $coinbase->orders->get('order_id');

// Place a new order.
// Available options can be found at: https://docs.pro.coinbase.com#place-a-new-order
$order = $coinbase->orders->place($options = []);

// Cancel an order.
// Available options can be found at: https://docs.pro.coinbase.com#cancel-an-order
$result = $coinbase->orders->delete('order_id');
$result = $coinbase->orders->delete('order_id', $options = []);

// Cancel all orders.
// Available options can be found at: https://docs.pro.coinbase.com#cancel-all
$result = $coinbase->orders->deleteAll();
```

<br>

### Fills
https://docs.pro.coinbase.com/#fills
```php
// Get a list of recent fills of the API key's profile.
// Available options can be found at: https://docs.pro.coinbase.com#list-fills
$fills = $coinbase->fills->list();
$fills = $coinbase->fills->list($options = []);
```

<br>

### Limits
https://docs.pro.coinbase.com/#limits
```php
// Get current exchange limits.
$limits = $coinbase->limits->get();
```

<br>

### Deposits
https://docs.pro.coinbase.com/#deposits
```php
// Get a list of deposits from the profile of the API key.
// Available options can be found at: https://docs.pro.coinbase.com#list-deposits
$deposits = $coinbase->deposits->list();
$deposits = $coinbase->deposits->list($options = []);

// Get information on a single deposit.
$deposit = $coinbase->deposits->get('deposit_id');

// Deposit funds from a payment method.
// Available options can be found at:
// - https://docs.pro.coinbase.com#payment-method
// - https://docs.pro.coinbase.com#coinbase
$deposit = $coinbase->deposits->create($options = []);

// Generate an address for crypto deposits.
$address = $coinbase->deposits->createCryptoDepositAddress('coinbase_account_id');
```

<br>

### Withdrawals
https://docs.pro.coinbase.com/#withdrawals
```php
// Get a list of withdrawals from the profile of the API key.
// Available options can be found at: https://docs.pro.coinbase.com#list-withdrawals
$withdrawals = $coinbase->withdrawals->list();
$withdrawals = $coinbase->withdrawals->list($options = []);

// Get information on a single withdrawal.
$withdrawal = $coinbase->withdrawals->get('withdrawal_id');

// Withdraw funds to a payment method.
// Available options can be found at:
// - https://docs.pro.coinbase.com#payment-method55
// - https://docs.pro.coinbase.com#coinbase56
// - https://docs.pro.coinbase.com/#crypto
$withdrawal = $coinbase->withdrawals->create($options = []);

// Gets the network fee estimate when sending to the given address.
// Available options can be found at: https://docs.pro.coinbase.com#fee-estimate
$estimate = $coinbase->withdrawals->getFeeEstimate($options);
```

<br>

### Stablecoin Conversions
https://docs.pro.coinbase.com/#stablecoin-conversions
```php
// Create a conversion.
// Available options can be found at: https://docs.pro.coinbase.com#stablecoin-conversions
$conversion = $coinbase->stablecoinConversions->create($options = []);
```

<br>

### Payment Methods
https://docs.pro.coinbase.com/#payment-methods
```php
// Get a list of payment methods.
$paymentMethods = $coinbase->paymentMethods->get();
```

<br>

### Coinbase Accounts
https://docs.pro.coinbase.com/#list-accounts64
```php
// Get a list of your Coinbase accounts.
$coinbaseAccounts = $coinbase->coinbaseAccounts->get();
```

<br>

### Fees
https://docs.pro.coinbase.com/#fees
```php
// Get your current maker & taker fee rates, as well as your 30-day trailing volume.
$fees = $coinbase->fees->get();
```

<br>

### Reports
https://docs.pro.coinbase.com/#reports
```php
// Get all reports for a profile.
// Available options can be found at: https://docs.pro.coinbase.com#get-report-status
$reports = $coinbase->reports->list();
$reports = $coinbase->reports->list($options = []);

// Get a report's status.
$status = $coinbase->reports->get('report_id');

// Create a new report.
// Available options can be found at: https://docs.pro.coinbase.com#create-a-new-report
$report = $coinbase->reports->create($options = []);
```

<br>

### Profiles
https://docs.pro.coinbase.com/#profiles26
```php
// Get a List of your profiles.
// Available options can be found at: https://docs.pro.coinbase.com#list-profiles
$profiles = $coinbase->profiles->list();
$profiles = $coinbase->profiles->list($options = []);

// Get a single profile.
$profile = $coinbase->profiles->get('profile_id');

// Transfer funds from API key's profile to another user owned profile.
// Available options can be found at: https://docs.pro.coinbase.com#create-profile-transfer
$result = $coinbase->profiles->create($options = []);
```

<br>

### Oracle
https://docs.pro.coinbase.com/#oracle
```php
// Get cryptographically signed prices ready to be posted on-chain using Open Oracle smart contracts.
$result = $coinbase->oracle->get();
```

<br>

### Market data
#### Products
https://docs.pro.coinbase.com/#products
```php
// List all products.
$products = $coinbase->marketData->products->get();

// Get a single product.
$product = $coinbase->marketData->products->get('product_id');

// Get product order book data.
// Available options can be found at: https://docs.pro.coinbase.com#get-product-order-book
$orderBook = $coinbase->marketData->products->getOrderBook('product_id');
$orderBook = $coinbase->marketData->products->getOrderBook('product_id', $options = []);

// Get product ticker data.
$ticker = $coinbase->marketData->products->getTicker('product_id');

// List the latest trades of a product.
// Available options can be found at: https://docs.pro.coinbase.com/#get-trades
$orderBook = $coinbase->marketData->products->getTrades('product_id');
$orderBook = $coinbase->marketData->products->getTrades('product_id', $options = []);

// Get historic rates of a product.
// Available options can be found at: https://docs.pro.coinbase.com/#get-historic-rates
$historicRates = $coinbase->marketData->products->getHistoricRates('product_id');
$historicRates = $coinbase->marketData->products->getHistoricRates('product_id', $options = []);

// Get 24 hr stats of a product.
$stats = $coinbase->marketData->products->getDailyStats('product_id');
```

<br>

#### Currencies
https://docs.pro.coinbase.com/#currencies
```php
// List known currencies.
$currencies = $coinbase->marketData->currencies->get();

// Get a single currency.
$currency = $coinbase->marketData->currencies->get('currency_id');
```

<br>

#### Time
https://docs.pro.coinbase.com/#time
```php
// Get the API server time.
$time = $coinbase->marketData->time->get();
```