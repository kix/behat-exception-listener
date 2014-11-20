Behat exception listener
========================

This is a [Behat](http://behat.org) extension that allows catching and
examining exceptions thrown in steps during a Behat run. Currently it can be
used with [`kix/behat-sf2-service-generator`](https://github.com/kix/behat-sf2-service-generator) which catches calls
to undefined Symfony services and runs PHPSpec to describe them.

Installation
------------

There's really no use to install this exception standalone, though, if you
want to, you sure can. Just run this:

```
	composer require kix/behat-exception-listener "~0.1" 
```

Now you should configure @richardmiller's phpspec-run-extension (r
[miller/phpspec-run-extension on packagist](rmiller/phpspec-run-extension)).

And then enable the extension in your `behat.yml`:

```
    Kix\ExceptionListenerExtension\ExceptionListenerExtension: ~
```