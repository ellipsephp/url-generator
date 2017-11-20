<?php

use function Eloquent\Phony\Kahlan\mock;

use Ellipse\Router\RouterAdapterInterface;
use Ellipse\Router\UrlGenerator;

describe('UrlGenerator', function () {

    beforeEach(function () {

        $this->adapter = mock(RouterAdapterInterface::class);

        $this->generator = new UrlGenerator($this->adapter->get());

    });

    describe('->__invoke()', function () {

        beforeEach(function () {

            $this->adapter->generate->with('name', ['data'])->returns('url');

        });

        context('when no query parameter is given', function () {

            context('when no fragment is given', function () {

                it('should return an url with no query string and no fragment', function () {

                    $test = ($this->generator)('name', ['data']);

                    expect($test)->toEqual('url');

                });

            });

            context('when a fragment is given', function () {

                it('should return an url with the fragment', function () {

                    $test = ($this->generator)('name', ['data'], [], 'fragment');

                    expect($test)->toEqual('url#fragment');

                });

            });

        });

        context('when query parameters are given', function () {

            context('when no fragment is given', function () {

                it('should return an url with the query string', function () {

                    $test = ($this->generator)('name', ['data'], ['param1' => 'value1', 'param2' => 'value2']);

                    expect($test)->toEqual('url?param1=value1&param2=value2');

                });

            });

            context('when a fragment is given', function () {

                it('should return an url with the query string and the fragment', function () {

                    $test = ($this->generator)('name', ['data'], ['param' => 'value'], 'fragment');

                    expect($test)->toEqual('url?param=value#fragment');

                });

            });

        });

    });

});
