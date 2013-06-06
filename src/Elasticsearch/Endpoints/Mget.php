<?php
/**
 * User: zach
 * Date: 05/31/2013
 * Time: 16:47:11 pm
 */

namespace Elasticsearch\Endpoints;

use Elasticsearch\Endpoints\AbstractEndpoint;
use Elasticsearch\Common\Exceptions;

/**
 * Class Mget
 * @package Elasticsearch\Endpoints
 */
class Mget extends AbstractEndpoint
{

    /**
     * @param array $body
     *
     * @throws \Elasticsearch\Common\Exceptions\InvalidArgumentException
     * @return $this
     */
    public function setBody($body)
    {
        if (is_array($body) !== true) {
            throw new Exceptions\InvalidArgumentException(
                'Body of Mget must be an array'
            );
        }
        $this->body = $body;
        return $this;
    }


    /**
     * @return string
     */
    protected function getURI()
    {

        $uri = array();
        $uri[] = $this->getIndex();
        $uri[] = $this->getType();
        $uri[] = '_mget';
        $uri =  array_filter($uri);

        $uri =  '/' . implode('/', $uri);

        return $uri;
    }

    /**
     * @return string[]
     */
    protected function getParamWhitelist()
    {
        return array(
            'fields',
            'parent',
            'preference',
            'realtime',
            'refresh',
            'routing',
        );
    }

    /**
     * @return string
     */
    protected function getMethod()
    {
        return 'GET';
    }

    private function getIndex()
    {
        if (isset($this->index) === true){
            return $this->index;
        } else {
            return '_all';
        }
    }

    private function getType()
    {
        if (isset($this->type) === true){
            return $this->type;
        } else {
            return '';
        }
    }
}