<?php namespace ConsulConfigManager\Domain\ViewModels;

use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

/**
 * Class HttpResponseViewModel
 *
 * @package App\Domain\ViewModels
 */
class HttpResponseViewModel implements ViewModel {

    /**
     * Symfony response instance
     * @var HttpResponse
     */
    private HttpResponse $response;

    /**
     * HttpResponseViewModel Constructor.
     *
     * @param HttpResponse $response
     */
    public function __construct(HttpResponse $response) {
        $this->response = $response;
    }

    /**
     * Get response instance
     * @return HttpResponse
     */
    public function getResponse(): HttpResponse {
        return $this->response;
    }

}
