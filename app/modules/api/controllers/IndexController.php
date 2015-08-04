<?php
/**
 * @author Patsura Dmitry http://github.com/ovr <talk@dmtry.me>
 */

namespace RestApp\Api\Controller;

use Exception;
use ReflectionExtension;

/**
 * Class IndexController
 * @Path("/api")
 */
class IndexController extends \Owl\Mvc\Controller
{
    /**
     * @Get
     * @Url("/", name="default")
     */
    public function indexAction()
    {
        return array(
            'info' => array(
                'php' => array(
                    'version' => PHP_VERSION
                ),
                'time' => time()
            )
        );
    }

    /**
     * @Get
     * @Url("/ping", name="api-ping")
     */
    public function pingAction()
    {
        return ['pong'];
    }

    /**
     * @Get
     * @Url("/version", name="api-show-version")
     */
    public function versionAction()
    {
        $ext = new ReflectionExtension('owl');

        return [
            'version' => '0.1-dev',
            'owl' => $ext->getVersion()
        ];
    }

    public function errorAction()
    {
        return array(
            'message' => 'Not found',
            'uri' => $this->request->getUri()
        );
    }

    public function exceptionAction(Exception $e)
    {
        if ($e->getCode() >= 400) {
            $this->response->getStatusCode($e->getCode());
        }

        return array(
            $e->getMessage()
        );
    }
}
