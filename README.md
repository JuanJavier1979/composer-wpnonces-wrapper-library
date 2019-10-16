# Composer WPnonces Wrapper Library
An OOP wrapper for all WordPress nonces functions

## Methods included

- `generate` as a wrapper for `wp_create_nonce`
- `generate_url` as a wrapper for `wp_nonce_url`
- `verify` as a wrapper for `wp_verify_nonce`
- `field` as a wrapper for `wp_nonce_field`
- `display_ays` as a wrapper for `wp_nonce_ays`
- `check_admin_referer` as a wrapper for `check_admin_referer`
- `check_ajax_referer` as a wrapper for `check_ajax_referer`

## Installation

```sh
compose require juanjavier1979/composer-wpnonces-wrapper-library
```

As this is not a published package you would need to manually add this folder to your theme's/plugin's vendor folder.

## How to use
First you must include (use) the composer library.
Then create an instance of Nonce class and use it's methods, as listed above.
All methods use the same WordPress function parameters.

Generate a nonce example:

```php
use WpnoncesWrapperLibrary\Nonce;

$nonce = new Nonce();
$test  = $nonce->generate( 'test' );
```

Generate an URL nonce example:

```php
use WpnoncesWrapperLibrary\Nonce;

$nonce = new Nonce();
$url   = $nonce->generate_url( get_home_url(), 'doing_something', 'my_nonce' );
```

Verify a nonce example:

```php
use WpnoncesWrapperLibrary\Nonce;

$nonce = new Nonce();
if ( ! $nonce->verify( $test, 'test' ) ) {
  echo 'test verify: Failed';
} else {
  echo 'test verify: Passing';
}
```

Generate a form hidden nonce input example:

```php
use WpnoncesWrapperLibrary\Nonce;

$nonce = new Nonce();
echo '<form method="post">';
echo $nonce->field( 'name_of_my_action', 'name_of_nonce_field' );
echo '</form>';
```

## Approach taken

This has been a really nice challenge to take. I never before created a composer package on my own. For functionality work I have always created WordPress plugins.
But I have used some composer packages on several projects, like this example below.

```sh
composer require fightbulc/moment
```

```php
class DeliveryTimes {

  private $current_day;
  private $current_time;
  private $tomorrow;

  function __construct() {
      $this->current_day  = $this->getDay();
      $this->current_time = $this->getTime();
      $this->tomorrow     = $this->getTomorrow();
  }

  private function getMoment() {
    \Moment\Moment::setDefaultTimezone( 'America/New_York' );
    $m = new \Moment\Moment();
    return $m;
  }

  private function getDay() {
    return $this->getMoment()->format( 'l' );
  }

  public function getTomorrow() {
    return $this->getMoment()->addDays(1)->format( 'l' );
  }

  private function getTime() {
    return $this->getMoment()->format( 'Hi' );
  }

  private function isWeekend() {
    $is_weekend  = false;
    $current_day = $this->current_day;
    $weekends    = ['Saturday','Sunday'];
    if( in_array( $current_day, $weekends ) ) {
      $is_weekend = true;
    }
    return $is_weekend;
  }

}
```

```php
$dt = new DeliveryTimes();
echo $dt->getTomorrow();
```

My main target was to make it as simple as possible maintainning the project scope: create a OOP wrapper for wp_nonces_* related functions.
I created a class called `Nonce` with seven custom methods to wrap the WordPress functions.
They use the same parameters as the original WordPress functions.

The thing that I struggled with this test project was the Unit Testing.
Honestly, I never did once before on my own. And, as stated in my CV, is something I wanted to be trained in the company I'll work for.
So, I am very glad you take care of this part I lack expertise.

As I saw in your repos, your main product (the one I have used most of yours) MultilingualPress have some tests.

## Minimum Requirements

- PHP 7.0
- Composer to install

## Change Log

Please see [CHANGELOG.md](CHANGELOG.md).

## License

The WordPress Plugin Boilerplate Powered is licensed under the GPL v2 or later; however, if you opt to use third-party code that is not compatible with v2, then you may need to switch to using code that is GPL v3 compatible.